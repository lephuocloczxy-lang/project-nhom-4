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
                'avatar' => $user['avatar'] ?? null 
            ];

            if ($data['hoten'] === '') {
                $error = "⚠️ Vui lòng nhập họ tên!";
            } else {
                if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    $fileTmp = $_FILES['avatar']['tmp_name'];
                    $fileName = time() . "_" . basename($_FILES['avatar']['name']);
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
                        if ($user['avatar'] && file_exists($uploadDir . basename($user['avatar']))) {
                            @unlink($uploadDir . basename($user['avatar']));
                        }
                        $data['avatar'] = 'uploads/' . $fileName; 
                    }
                }

                if ($error === '') {
                    if ($this->model->capNhat($data)) {
                        $user_updated = $this->model->layThongTin($user['id']); 
                        $_SESSION['user'] = [
                            'id' => $user_updated['id'],
                            'email' => $user_updated['email'],
                            'hoten' => $user_updated['hoten'],
                            'role' => $user_updated['role'] ?? 'user',
                            'avatar' => $user_updated['avatar'] ?? null
                        ];
                        $success = "✅ Cập nhật thành công!";
                        $user = $user_updated;
                    } else {
                        $error = "❌ Cập nhật thất bại! Vui lòng kiểm tra log hệ thống.";
                    }
                }
            }
        }

        $user = $this->model->layThongTin($_SESSION['user']['id']); 
        require __DIR__ . '/../Views/taikhoan/suathongtin.php';
    }

    /** 🔐 Đổi mật khẩu */
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
}
