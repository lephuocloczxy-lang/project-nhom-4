<?php
namespace Admin\Bai01QuanlySv\Controllers;

use Admin\Bai01QuanlySv\Models\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';


class UserController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // 🧾 Hiển thị form đăng ký
    public function showRegisterForm(string $error = '', string $success = ''): void
    {
        include __DIR__ . '/../../views/dangky.php';
    }

    // ➕ Xử lý đăng ký người dùng mới
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($name) || empty($username) || empty($email) || empty($password)) {
                $error = "⚠️ Vui lòng nhập đầy đủ thông tin!";
                $this->showRegisterForm($error);
                return;
            }

            // ✅ Tạo người dùng mới
            if ($this->userModel->createUser($name, $username, $email, $password)) {

                // ✅ Sau khi tạo thành công → gửi email xác nhận
                $this->sendConfirmEmail($email, $name);

                $success = "✅ Đăng ký thành công! Vui lòng kiểm tra email để xác nhận tài khoản.";
                $this->showLoginForm('', $success);

            } else {
                $error = "❌ Username hoặc Email đã tồn tại!";
                $this->showRegisterForm($error);
            }
        } else {
            $this->showRegisterForm();
        }
    }

    // 📨 Hàm gửi email xác nhận
   private function sendConfirmEmail(string $email, string $name): void
{
    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // ⚠️ Sử dụng chính email thật của bạn và App Password
        $mail->Username = 'dvkhiem-cntt17@tdu.edu.vn';
        $mail->Password = 'ggxa bstd nuai hpvf';  // App password 16 ký tự
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // Người gửi và người nhận
        $mail->setFrom('dvkhiem-cntt17@tdu.edu.vn', 'Hệ thống Quản lý Sinh viên');
        $mail->addAddress($email, $name);

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Xác nhận đăng ký tài khoản';
        $mail->Body = "
            <h2>Xin chào {$name}!</h2>
            <p>Cảm ơn bạn đã đăng ký tài khoản tại hệ thống của chúng tôi.</p>
            <p>Nhấn vào liên kết dưới đây để xác nhận tài khoản:</p>
            <p><a href='http://localhost/bai01_quanly_sv/public/index.php?action=verify&email={$email}'>
                👉 Xác nhận đăng ký
            </a></p>
            <br>
            <p>Nếu bạn không thực hiện đăng ký, vui lòng bỏ qua email này.</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        error_log("❌ Không thể gửi email xác nhận: " . $mail->ErrorInfo);
    }
}

    // 🔑 Xử lý đăng nhập (giữ nguyên)
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header('Location: index.php');
                exit;
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu!";
                $this->showLoginForm($error);
            }
        } else {
            $this->showLoginForm();
        }
    }

    public function showLoginForm(string $error = '', string $success = ''): void
    {
        include __DIR__ . '/../../views/dangnhap.php';
    }

    public function logout(): void
    {
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
    public function verify(string $email): void
{
    if ($this->userModel->verifyUser($email)) {
        $success = "🎉 Xác nhận tài khoản thành công! Bạn có thể đăng nhập.";
    } else {
        $error = "Liên kết xác nhận không hợp lệ hoặc tài khoản đã được kích hoạt.";
    }
    $this->showLoginForm($error ?? '', $success ?? '');
}
// Hiển thị form đổi mật khẩu
    public function changePasswordForm() {
        require_once __DIR__ . '/../../views/doimatkhau.php';
    }

    // Xử lý đổi mật khẩu
    public function changePasswordSubmit() {
        session_start();
        require_once __DIR__ . '/../../src/auth.php';
        $userId = $_SESSION['user_id'];
        $oldPassword = $_POST['old_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($newPassword !== $confirmPassword) {
            echo "<script>alert('Mật khẩu xác nhận không khớp!'); history.back();</script>";
            exit;
        }

        $user = $this->userModel->getUserById($userId);

        if (!$user || !password_verify($oldPassword, $user['password'])) {
            echo "<script>alert('Mật khẩu cũ không đúng!'); history.back();</script>";
            exit;
        }
        $newHashed = password_hash($newPassword, PASSWORD_DEFAULT);
        if ($this->userModel->updatePassword($userId, $newHashed)) {
            echo "<script>alert('✅ Đổi mật khẩu thành công!'); window.location='index.php?action=dashboard';</script>";
        } else {
            echo "<script>alert('❌ Lỗi khi cập nhật mật khẩu!'); history.back();</script>";
        }
    }

}
