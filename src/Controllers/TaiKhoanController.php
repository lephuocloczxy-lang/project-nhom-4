<?php
namespace Admin\Nhom4\Controllers;

use Admin\Nhom4\Models\TaiKhoanModel;

class TaiKhoanController
{
    private TaiKhoanModel $model;
    private string $baseUrl = "/nhom4/public/"; // Định nghĩa BASE_URL ở Controller
    private string $domain = "http://localhost"; // Thêm domain gốc để tạo link tuyệt đối

    /** 🧩 Khởi tạo controller */
    public function __construct($db)
    {
        $this->model = new TaiKhoanModel($db);
    }

    // --- CÁC HÀM XỬ LÝ CHUYỂN HƯỚNG VÀ KIỂM TRA ---

    /** 🧭 Chuyển hướng theo quyền */
    private function redirectByRole(string $role): void
    {
        $adminPath = $this->baseUrl . "admin.php";
        $homePath = $this->baseUrl . "index.php";

        if ($role === 'admin') {
            header("Location: {$adminPath}?action=dashboard");
        } else {
            // Sửa lỗi: Nếu có redirect_url (từ hoso), dùng nó, không thì về trang chủ
            $redirectUrl = $_SESSION['redirect_url'] ?? $homePath;
            unset($_SESSION['redirect_url']);
            header("Location: {$redirectUrl}");
        }
        exit;
    }

    /** 🧩 Kiểm tra quyền user */
    private function checkUser(): void
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
            header('Location: ' . $this->baseUrl);
            exit;
        }
    }

    // --- CÁC HÀM CHỨC NĂNG CHÍNH ---

    /** 🔑 Đăng nhập */
    public function dangNhap(): void
    {
        if (isset($_SESSION['user'])) {
            $this->redirectByRole($_SESSION['user']['role']);
            return;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? "");
            $matkhau = trim($_POST['matkhau'] ?? "");

            if ($email === '' || $matkhau === '') {
                $error = "⚠️ Vui lòng nhập đầy đủ email và mật khẩu!";
            } else {
                $result = $this->model->dangNhap($email, $matkhau);

                if (isset($result['error'])) {
                    $error = $result['error'];
                } else {
                    $user = $result;

                    if ((int) ($user['trangthai'] ?? 0) !== 1) {
                        $error = "⚠️ Tài khoản chưa kích hoạt hoặc bị khóa!";
                    } else {
                        // Lưu session (chỉ lưu thông tin cần thiết)
                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'email' => $user['email'],
                            'hoten' => $user['hoten'],
                            'role' => $user['role'] ?? 'user'
                        ];
                        $this->redirectByRole($_SESSION['user']['role']);
                        return;
                    }
                }
            }
        }

        require __DIR__ . '/../Views/taikhoan/dangnhap.php';
    }

    /** 🚪 Đăng xuất */
    public function dangXuat(): void
    {
        session_destroy();
        header("Location: {$this->baseUrl}?action=trangchu");
        exit;
    }

    /** 👤 Hồ sơ cá nhân */
    public function hoSo(): void
    {
        $this->checkUser();
        $user = $this->model->layThongTin($_SESSION['user']['id']);
        require __DIR__ . '/../Views/taikhoan/hoso.php';
    }

    /** ✏️ Sửa thông tin cá nhân */
public function suaThongTin(): void
{
    $this->checkUser();
    // Lấy dữ liệu user hiện tại từ Model (Cần lấy từ Model để có đủ các trường, bao gồm cả avatar)
    $user = $this->model->layThongTin($_SESSION['user']['id']); 
    $error = $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $data = [
             'id' => $user['id'],
             'hoten' => trim($_POST['hoten'] ?? ''),
             'gioitinh' => $_POST['gioitinh'] ?? '',
             'ngaysinh' => $_POST['ngaysinh'] ?? null,
             'dienthoai' => trim($_POST['dienthoai'] ?? ''),
             'diachi' => trim($_POST['diachi'] ?? ''),
             // Mặc định giữ avatar cũ nếu không có upload mới
             'avatar' => $user['avatar'] ?? null 
        ];

        if ($data['hoten'] === '') {
            $error = "⚠️ Vui lòng nhập họ tên!";
        } else {
            // Xử lý ảnh đại diện
            if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                
                 $fileTmp = $_FILES['avatar']['tmp_name'];
                 $fileName = time() . "_" . basename($_FILES['avatar']['name']);
                 // Đường dẫn vật lý đến thư mục uploads
                 $uploadDir = __DIR__ . '/../../public/uploads/'; 
                 if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                 $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                 $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                 if (!in_array($ext, $allowed)) {
                     $error = "❌ Chỉ chấp nhận ảnh JPG, PNG, GIF!";
                 } elseif ($_FILES['avatar']['size'] > 2 * 1024 * 1024) {
                     $error = "❌ Ảnh vượt quá 2MB!";
                 } elseif (!move_uploaded_file($fileTmp, $uploadDir . $fileName)) {
                     $error = "❌ Lỗi khi tải ảnh lên!";
                 } else {
                     // *** THÀNH CÔNG: XÓA ẢNH CŨ VÀ CẬP NHẬT ĐƯỜNG DẪN MỚI ***
                     
                     // 1. Xóa ảnh cũ (nếu tồn tại)
                     if ($user['avatar'] && file_exists($uploadDir . basename($user['avatar']))) {
                         @unlink($uploadDir . basename($user['avatar']));
                     }
                     
                     // 2. Lưu đường dẫn tương đối (để dùng trong thẻ <img>)
                     $data['avatar'] = 'uploads/' . $fileName; 
                 }
            }
            
            if ($error === '') {
                 if ($this->model->capNhat($data)) {
                     // Lấy lại toàn bộ thông tin mới từ DB sau khi cập nhật
                     $user_updated = $this->model->layThongTin($user['id']); 
                     
                     // Cập nhật lại session (rất quan trọng)
                     $_SESSION['user'] = [
                         'id' => $user_updated['id'],
                         'email' => $user_updated['email'],
                         'hoten' => $user_updated['hoten'],
                         'role' => $user_updated['role'] ?? 'user',
                         'avatar' => $user_updated['avatar'] ?? null // Thêm avatar vào session
                     ];
                     $success = "✅ Cập nhật thành công!";
                     $user = $user_updated; // Cập nhật biến $user cho View
                 } else {
                     $error = "❌ Cập nhật thất bại! Vui lòng kiểm tra log hệ thống.";
                 }
            }
        }
    }
    
    // Đảm bảo $user là dữ liệu mới nhất (dùng cho lần tải trang đầu tiên và sau khi POST thất bại)
    $user = $this->model->layThongTin($_SESSION['user']['id']); 

    require __DIR__ . '/../Views/taikhoan/suathongtin.php';
}

    /** 🔐 Đổi mật khẩu (Cho người dùng đã đăng nhập) */
    public function doiMatKhau(): void
    {
        $this->checkUser();
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user']['id'];
            $matKhauCu = $_POST['matkhaucu'] ?? '';
            $matKhauMoi = $_POST['matkhaumoi'] ?? '';
            $nhapLai = $_POST['nhaplai'] ?? '';

            $user = $this->model->layThongTin($id);

            if (!isset($user['matkhau']) || !password_verify($matKhauCu, $user['matkhau'])) {
                $message = '❌ Mật khẩu cũ không chính xác!';
            } elseif ($matKhauMoi !== $nhapLai) {
                $message = '⚠️ Mật khẩu mới không khớp!';
            } elseif (strlen($matKhauMoi) < 6) {
                $message = '⚠️ Mật khẩu mới phải có ít nhất 6 ký tự!';
            } else {
                if ($this->model->doiMatKhau($id, $matKhauMoi)) {
                    $message = '✅ Đổi mật khẩu thành công!';
                } else {
                    $message = '❌ Đổi mật khẩu thất bại!';
                }
            }
        }

        include __DIR__ . '/../Views/taikhoan/doimatkhau.php';
    }


    // --- CHỨC NĂNG QUÊN MẬT KHẨU (2 BƯỚC) ---

    /** 🔑 Quên mật khẩu (Bước 1: Nhận Email và Gửi Token) */
    public function quenMatKhau(): void
    {
        $error = $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');

            // 1. Kiểm tra email có tồn tại không
            $user = $this->model->layThongTinByEmail($email);

            if (!$user) {
                $error = "❌ Email không tồn tại trong hệ thống!";
            } elseif ((int) ($user['trangthai'] ?? 0) !== 1) {
                $error = "❌ Tài khoản chưa được kích hoạt hoặc đã bị khóa!";
            } else {
                // 2. Tạo và lưu Token đặt lại mật khẩu vào CSDL
                $token = $this->model->taoTokenKhoiPhuc($email);

                if ($token) {

                    // 3. Gửi email
                    // Đã sửa lỗi đường dẫn:
                    require_once __DIR__ . '/../Views/gmail.php';

                    // Đã sửa lỗi link tuyệt đối:
                    $link = $this->domain . $this->baseUrl . "?action=datlaimatkhau&token=" . $token;
                    $subject = "Đặt lại mật khẩu của bạn";
                    $content = "
                        <h3>Xin chào {$user['hoten']}</h3>
                        <p>Bạn đã yêu cầu đặt lại mật khẩu. Vui lòng nhấn vào liên kết dưới đây để tiếp tục:</p>
                        <a href='{$link}' target='_blank' style='display: inline-block; padding: 10px 20px; background-color: #f53d2d; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;'>👉 Đặt lại mật khẩu (Liên kết hết hạn sau 30 phút)</a>
                        <p>Nếu bạn không yêu cầu, vui lòng bỏ qua email này.</p>
                    ";

                    // *** ĐIỂM SỬA CHÍNH: Thêm \ để gọi hàm Global ***
                    // *** ĐIỂM SỬA CHÍNH: Thêm \ để gọi hàm Global ***
                    if (\guiEmail($email, $subject, $content)) { // <--- CẦN THÊM \ VÀO TRƯỚC guiEmail
                        $success = "✅ Email đặt lại mật khẩu đã được gửi! Vui lòng kiểm tra hộp thư của bạn.";

                    } else {
                        $error = "❌ Lỗi khi gửi email xác nhận. Vui lòng thử lại!";
                    }

                } else {
                    $error = "❌ Lỗi hệ thống khi tạo token. Vui lòng thử lại!";
                }
            }
        }

        require __DIR__ . '/../Views/taikhoan/quenmatkhau.php'; // View chỉ có ô Email
    }

    /** 🔐 Đặt lại mật khẩu (Bước 2: Nhận Token và Xử lý Form) */
    public function datLaiMatKhau(): void
    {
        $token = $_GET['token'] ?? '';
        $error = '';

        // 1. Kiểm tra token có hợp lệ không (Model tự kiểm tra thời hạn)
        $tokenData = $this->model->kiemTraTokenKhoiPhuc($token);

        // TokenData trả về FALSE hoặc NULL nếu token không tồn tại, hết hạn, hoặc không khớp
        if (!$tokenData) {
            $error = "❌ Liên kết đặt lại mật khẩu không hợp lệ hoặc đã hết hạn!";
            // View loi.php sẽ giúp thông báo lỗi chung
            require __DIR__ . '/../Views/taikhoan/loi.php';
            return;
        }

        // Token hợp lệ, giờ xử lý POST form đặt mật khẩu mới
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $matkhauMoi = $_POST['matkhauMoi'] ?? '';
            $nhapLai = $_POST['nhaplai'] ?? '';

            if ($matkhauMoi !== $nhapLai) {
                $error = "⚠️ Mật khẩu nhập lại không khớp!";
            } elseif (strlen($matkhauMoi) < 6) {
                $error = "⚠️ Mật khẩu mới phải có ít nhất 6 ký tự!";
            } else {
                // 2. Cập nhật mật khẩu và xóa token
                if ($this->model->datLaiMatKhau($token, $matkhauMoi)) {

                    echo "<script>
                            alert('✅ Đặt lại mật khẩu thành công! Hãy đăng nhập.');
                            window.location.href = '{$this->baseUrl}?action=dangnhap';
                          </script>";
                    exit;
                } else {
                    $error = "❌ Lỗi khi cập nhật mật khẩu!";
                }
            }
        }

        // Hiển thị form đặt mật khẩu mới (chỉ khi token hợp lệ)
        require __DIR__ . '/../Views/taikhoan/datlaimatkhau.php';
    }

    // --- CHỨC NĂNG ĐĂNG KÝ VÀ XÁC THỰC ---

    /** ✅ Đăng ký tài khoản + gửi email xác nhận */
    public function dangKy(): void
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'hoten' => $_POST['hoten'] ?? '',
                'email' => $_POST['email'] ?? '',
                'matkhau' => $_POST['matkhau'] ?? '',
                'dienthoai' => $_POST['dienthoai'] ?? '',
                'diachi' => $_POST['diachi'] ?? '',
                'ngaysinh' => $_POST['ngaysinh'] ?? '',
                'gioitinh' => $_POST['gioitinh'] ?? ''
            ];

            $token = $this->model->dangKy($data); // Model trả về token hoặc thông báo lỗi

            if ($token === "duplicate") {
                $error = "Email đã được sử dụng!";
            } elseif (str_starts_with($token, "error")) {
                $error = "Lỗi khi lưu tài khoản!";
            } else {
                // 📧 Gửi email xác nhận
                // Đã sửa lỗi đường dẫn:
                require_once __DIR__ . '/../Views/gmail.php';

                $link = $this->domain . $this->baseUrl . "?action=verify&token=" . $token;
                $subject = "Xác nhận tài khoản của bạn";
                $content = "
                    <h3>Xin chào {$data['hoten']}</h3>
                    <p>Vui lòng nhấn vào liên kết bên dưới để kích hoạt tài khoản:</p>
                    <a href='{$link}' target='_blank'>👉 Kích hoạt tài khoản</a>
                ";

                // Đã sửa lỗi Namespace:
                if (\guiEmail($data['email'], $subject, $content)) {
                    echo "<script>
                        alert('✅ Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt.');
                        window.location.href='{$this->baseUrl}?action=dangnhap';
                    </script>";
                    exit;
                } else {
                    $error = "❌ Đăng ký thành công nhưng không gửi được email!";
                }
            }
        }

        include __DIR__ . '/../Views/taikhoan/dangky.php';
    }

    /** 📧 Xác thực tài khoản qua email (kích hoạt tài khoản) */
    public function verify()
    { // Đổi tên hàm thành verify để phù hợp với action
        $this->xacThucEmail();
    }

    private function xacThucEmail()
    {
        if (!isset($_GET['token'])) {
            echo "<script>alert('Liên kết không hợp lệ!'); window.location.href='{$this->baseUrl}';</script>";
            exit;
        }

        $token = $_GET['token'];
        $thanhCong = $this->model->xacThucEmail($token);

        if ($thanhCong) {
            echo "<script>
                alert('✅ Tài khoản của bạn đã được kích hoạt thành công! Hãy đăng nhập.');
                window.location.href = '{$this->baseUrl}?action=dangnhap';
              </script>";
        } else {
            echo "<script>
                alert('❌ Liên kết kích hoạt không hợp lệ hoặc đã hết hạn!');
                window.location.href = '{$this->baseUrl}';
              </script>";
        }
    }
}