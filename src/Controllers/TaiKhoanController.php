<?php
namespace Admin\Nhom4\Controllers;
use Admin\Nhom4\Models\TaiKhoanModel;

class TaiKhoanController
{
    private $model;

    /** 🧩 Khởi tạo controller, truyền kết nối CSDL */
    public function __construct($db)
    {
        $this->model = new TaiKhoanModel($db); // ✅ Sửa: bỏ named parameter
    }
    /** 🧭 Đăng nhập */
    public function dangNhap(): void
    {
        // Nếu đã đăng nhập, chuyển hướng thẳng đến trang chủ
        if (isset($_SESSION['user'])) {
            header("Location: index.php?action=trangchu");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? "";
            $matkhau = $_POST['matkhau'] ?? "";

            // Validate input
            if (empty($email) || empty($matkhau)) {
                $error = "Vui lòng nhập đầy đủ email và mật khẩu!";
                require_once __DIR__ . '/../Views/taikhoan/dangnhap.php';
                return;
            }

            $user = $this->model->dangNhap($email, $matkhau);

            if ($user) {
                if ($user['trangthai'] == 0) {
                    $error = "⚠️ Vui lòng xác thực email trước khi đăng nhập!";
                    require_once __DIR__ . '/../Views/taikhoan/dangnhap.php';
                    return;
                }

                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['hoten'] = $user['hoten'];
                $_SESSION['role'] = $user['role'] ?? 'user';

                header("Location: index.php?action=trangchu");
                exit();
            } else {
                $error = "❌ Email hoặc mật khẩu không đúng!";
                require_once __DIR__ . '/../Views/taikhoan/dangnhap.php';
            }
        } else {
            // Hiển thị form đăng nhập
            require_once __DIR__ . '/../Views/taikhoan/dangnhap.php';
        }
    }
    /** 🧩 Đăng ký (gửi email xác thực) */
    public function dangKy()
    {
        // Nếu đã đăng nhập, chuyển về trang chủ
        if (isset($_SESSION['user'])) {
            header("Location: index.php?action=trangchu");
            exit();
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => trim($_POST['email'] ?? ''),
                'matkhau' => $_POST['matkhau'] ?? '',
                'dienthoai' => trim($_POST['dienthoai'] ?? ''),
                'diachi' => trim($_POST['diachi'] ?? ''),
                'ngaysinh' => $_POST['ngaysinh'] ?? null,
                'gioitinh' => $_POST['gioitinh'] ?? null,
                'hoten' => trim($_POST['hoten'] ?? '')
            ];

            // Validate required fields
            if (empty($data['email']) || empty($data['matkhau']) || empty($data['hoten'])) {
                $error = "Vui lòng điền đầy đủ thông tin bắt buộc!";
            } elseif ($data['matkhau'] !== ($_POST['nhaplai_matkhau'] ?? '')) {
                $error = "Mật khẩu nhập lại không khớp!";
            } else {
                $token = $this->model->dangKy($data);

                if ($token === "duplicate") {
                    $error = "⚠️ Email đã tồn tại, vui lòng sử dụng email khác.";
                } elseif ($token) {
                    // Gửi email xác thực
                    require_once __DIR__ . '/../Views/gmail.php';

                    $name = htmlspecialchars($data['hoten']);
                    $email = htmlspecialchars($data['email']);
                    $body = "
                        <h2>Xin chào {$name}!</h2>
                        <p>Cảm ơn bạn đã đăng ký tài khoản tại hệ thống của chúng tôi.</p>
                        <p>Nhấn vào liên kết dưới đây để xác nhận tài khoản:</p>
                        <a href='http://localhost/nhom4/public/index.php?action=verify&token={$token}'>
                            👉 Xác nhận đăng ký
                        </a>
                        <br><br>
                        <p>Nếu bạn không thực hiện đăng ký, vui lòng bỏ qua email này.</p>
                    ";

                    \Admin\Nhom4\Views\guiEmail($email, 'Xác nhận đăng ký tài khoản', $body);

                    $success = "✅ Đăng ký thành công! Vui lòng kiểm tra email để xác nhận tài khoản.";
                } else {
                    $error = "❌ Đăng ký thất bại, vui lòng thử lại.";
                }
            }
        }

        // Truyền biến error và success ra view
        require_once __DIR__ . '/../Views/taikhoan/dangky.php';
    }

    /** 🚪 Đăng xuất */
    public function dangXuat()
    {
        session_destroy();
        header("Location: index.php?action=trangchu");
        exit;
    }

    /** 👤 Hồ sơ cá nhân */
    public function hoSo()
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect_url'] = 'hoso';
            header("Location: index.php?action=dangnhap");
            exit;
        }

        // Lấy dữ liệu người dùng từ session
        $user = $_SESSION['user'];

        // Gọi view và truyền biến $user
        require_once __DIR__ . '/../Views/taikhoan/hoso.php';
    }

    /** ✏️ Sửa thông tin cá nhân */
    public function suaThongTin()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=dangnhap");
            exit;
        }

        $user = $_SESSION['user'];
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $user['id'],
                'hoten' => trim($_POST['hoten'] ?? ''),
                'gioitinh' => $_POST['gioitinh'] ?? '',
                'ngaysinh' => $_POST['ngaysinh'] ?? null,
                'dienthoai' => trim($_POST['dienthoai'] ?? ''),
                'diachi' => trim($_POST['diachi'] ?? ''),
                'avatar' => $user['avatar'] ?? null
            ];

            // Validate
            if (empty($data['hoten'])) {
                $error = "Vui lòng nhập họ tên!";
            } else {
                // Xử lý upload avatar
                if (!empty($_FILES['avatar']['name'])) {
                    $fileTmp = $_FILES['avatar']['tmp_name'];
                    $fileName = time() . "_" . basename($_FILES['avatar']['name']);
                    $uploadDir = __DIR__ . '/../../public/uploads/';

                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                    if (in_array($fileExt, $allowed)) {
                        if (move_uploaded_file($fileTmp, $uploadDir . $fileName)) {
                            $data['avatar'] = 'uploads/' . $fileName;
                        } else {
                            $error = "Lỗi khi upload ảnh!";
                        }
                    } else {
                        $error = "Chỉ chấp nhận file ảnh JPG, PNG, GIF!";
                    }
                }

                if (empty($error)) {
                    if ($this->model->capNhat($data)) {
                        $_SESSION['user'] = $this->model->layThongTin($user['id']);
                        $success = "Cập nhật thông tin thành công!";
                    } else {
                        $error = "Cập nhật thông tin thất bại!";
                    }
                }
            }
        }

        require_once __DIR__ . '/../Views/taikhoan/suathongtin.php';
    }

    /** 🔐 Đổi mật khẩu */
    public function doiMatKhau()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=dangnhap");
            exit;
        }

        $user = $_SESSION['user'];
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $matkhaucu = $_POST['matkhaucu'] ?? '';
            $matkhaumoi = $_POST['matkhaumoi'] ?? '';
            $nhaplai = $_POST['nhaplai'] ?? '';

            // Kiểm tra mật khẩu cũ
            if (!password_verify($matkhaucu, $user['matkhau'])) {
                $error = "❌ Mật khẩu cũ không đúng!";
            } elseif (empty($matkhaumoi)) {
                $error = "⚠️ Vui lòng nhập mật khẩu mới!";
            } elseif ($matkhaumoi !== $nhaplai) {
                $error = "⚠️ Mật khẩu nhập lại không khớp!";
            } else {
                // ✅ Gọi model để cập nhật
                if ($this->model->doiMatKhau($user['id'], $matkhaumoi)) {
                    // Cập nhật lại session user mới nhất
                    $_SESSION['user'] = $this->model->layThongTin($user['id']);
                    $success = "✅ Đổi mật khẩu thành công!";
                } else {
                    $error = "❌ Đổi mật khẩu thất bại!";
                }
            }
        }

        require_once __DIR__ . '/../Views/taikhoan/doimatkhau.php';
    }

    /** 🔑 Quên mật khẩu */
    public function quenMatKhau()
    {
        // Nếu đã đăng nhập, chuyển về trang chủ
        if (isset($_SESSION['user'])) {
            header("Location: index.php?action=trangchu");
            exit();
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $matkhauMoi = $_POST['matkhaumoi'] ?? '';
            $nhaplai = $_POST['nhaplai'] ?? '';

            if (empty($email) || empty($matkhauMoi) || empty($nhaplai)) {
                $error = "⚠️ Vui lòng nhập đầy đủ thông tin.";
            } elseif ($matkhauMoi !== $nhaplai) {
                $error = "⚠️ Mật khẩu nhập lại không khớp!";
            } else {
                // ✅ Gọi model và xử lý
                if ($this->model->quenMatKhau($email, $matkhauMoi)) {
                    $success = "✅ Đặt lại mật khẩu thành công! Bạn có thể đăng nhập lại.";
                } else {
                    $error = "❌ Không tìm thấy tài khoản với email này!";
                }
            }
        }

        require_once __DIR__ . '/../Views/taikhoan/quenmatkhau.php';
    }

    /** ✅ Xác nhận tài khoản qua email */
    public function xacNhanTaiKhoan()
    {
        $token = $_GET['token'] ?? null;
        $result = '';

        if (!$token) {
            $result = 'missing'; // Không có token
        } elseif ($this->model->xacThucEmail($token)) {
            $result = 'success'; // Xác thực thành công
        } else {
            $result = 'invalid'; // Token sai hoặc đã dùng
        }

        // 👉 Gọi giao diện riêng
        require_once __DIR__ . '/../Views/taikhoan/xacnhan_email.php';
    }
}