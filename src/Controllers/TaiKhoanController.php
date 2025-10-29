<?php
namespace Admin\Nhom4\Controllers;
use Admin\Nhom4\Models\TaiKhoanModel;
class TaiKhoanController {
    private $model;

    /** 🧩 Khởi tạo controller, truyền kết nối CSDL */
    public function __construct($db)
    {
        $this->model = new TaiKhoanModel($db);
    }
/** 🧭 Đăng nhập */
public function dangNhap()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $matkhau = $_POST['matkhau'] ?? '';

        $user = $this->model->getByEmail($email);

        if ($user && password_verify($matkhau, $user['matkhau'])) {
            if ($user['trangthai'] == 0) {
                echo "<script>alert('⚠️ Vui lòng xác thực email trước khi đăng nhập!'); window.location.href='index.php?action=dangnhap';</script>";
                exit;
            }

            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['hoten'] = $user['hoten'];
            $_SESSION['role'] = $user['role'] ?? 'user';

            // ✅ Chuyển sang trang hồ sơ
            echo "<script>alert('✅ Đăng nhập thành công!'); window.location.href='index.php?action=hoso';</script>";
            exit;
        } else {
            echo "<script>alert('❌ Sai email hoặc mật khẩu!'); window.location.href='index.php?action=dangnhap';</script>";
            exit;
        }
    }
    include __DIR__ . '/../Views/taikhoan/dangnhap.php';
}
    /** 🧩 Đăng ký (gửi email xác thực) */
    public function dangKy()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email'     => $_POST['email'] ?? '',
                'matkhau'   => $_POST['matkhau'] ?? '',
                'dienthoai' => $_POST['dienthoai'] ?? '',
                'diachi'    => $_POST['diachi'] ?? '',
                'ngaysinh'  => $_POST['ngaysinh'] ?? null,
                'gioitinh'  => $_POST['gioitinh'] ?? null,
                'hoten'     => $_POST['hoten'] ?? ''
            ];

            $token = $this->model->dangKy($data);

            if ($token === "duplicate") {
                echo "<script>alert('⚠️ Email đã tồn tại, vui lòng sử dụng email khác.');</script>";
            } elseif ($token) {
                require_once __DIR__ . '/../Views/gmail.php';

                $name  = htmlspecialchars($data['hoten']);
                $email = htmlspecialchars($data['email']);
                $body  = "
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

                echo "<script>
                    alert('✅ Đăng ký thành công! Vui lòng kiểm tra email để xác nhận tài khoản.');
                    window.location.href='index.php?action=dangnhap';
                </script>";
                exit;
            } else {
                echo "<script>alert('❌ Đăng ký thất bại, vui lòng thử lại.');</script>";
            }
        }

        include __DIR__ . '/../Views/taikhoan/dangky.php';
    }

    /** 🚪 Đăng xuất */
    public function dangXuat()
    {
        session_destroy();
        header("Location: index.php?action=dangnhap");
        exit;
    }
/** 👤 Hồ sơ cá nhân */
public function hoSo()
{
    // Kiểm tra đăng nhập
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('⚠️ Vui lòng đăng nhập trước!'); window.location.href='index.php?action=dangnhap';</script>";
        exit;
    }
    // Lấy dữ liệu người dùng từ session
    $user = $_SESSION['user'];
    // Gọi view và truyền biến $user
    include __DIR__ . '/../Views/taikhoan/hoso.php';
}
    /** ✏️ Sửa thông tin cá nhân */
    public function suaThongTin()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=dangnhap");
            exit;
        }
        $user = $_SESSION['user'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id'        => $user['id'],
                'hoten'     => trim($_POST['hoten']),
                'gioitinh'  => $_POST['gioitinh'] ?? '',
                'ngaysinh'  => $_POST['ngaysinh'] ?? null,
                'dienthoai' => trim($_POST['dienthoai']),
                'diachi'    => trim($_POST['diachi']),
                'avatar'    => $user['avatar'] ?? null
            ];

            if (!empty($_FILES['avatar']['name'])) {
                $fileTmp  = $_FILES['avatar']['tmp_name'];
                $fileName = time() . "_" . basename($_FILES['avatar']['name']);
                $uploadDir = __DIR__ . '/../../public/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExt, $allowed)) {
                    move_uploaded_file($fileTmp, $uploadDir . $fileName);
                    $data['avatar'] = 'uploads/' . $fileName;
                }
            }

            $this->model->capNhat($data);
            $_SESSION['user'] = $this->model->layThongTin($user['id']);

            header("Location: index.php?action=hoso");
            exit;
        }

        include __DIR__ . '/../Views/taikhoan/suathongtin.php';
    }

    /** 🔐 Đổi mật khẩu */
    public function doiMatKhau()
{
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?action=dangnhap");
        exit;
    }

    $user = $_SESSION['user'];
    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $matkhaucu = $_POST['matkhaucu'];
        $matkhaumoi = $_POST['matkhaumoi'];
        $nhaplai = $_POST['nhaplai'];

        // Kiểm tra mật khẩu cũ
        if (!password_verify($matkhaucu, $user['matkhau'])) {
            $message = "❌ Mật khẩu cũ không đúng!";
        } elseif ($matkhaumoi !== $nhaplai) {
            $message = "⚠️ Mật khẩu nhập lại không khớp!";
        } else {
            // ✅ Gọi model để cập nhật (KHÔNG hash trước)
            $this->model->doiMatKhau($user['id'], $matkhaumoi);

            // Cập nhật lại session user mới nhất
            $_SESSION['user'] = $this->model->layThongTin($user['id']);
            $message = "✅ Đổi mật khẩu thành công!";
        }
    }

    include __DIR__ . '/../Views/taikhoan/doimatkhau.php';
}

/** 🔑 Quên mật khẩu */
public function quenMatKhau()
{
    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $matkhauMoi = $_POST['matkhaumoi'] ?? '';
        $nhaplai = $_POST['nhaplai'] ?? '';

        if (empty($email) || empty($matkhauMoi) || empty($nhaplai)) {
            $message = "⚠️ Vui lòng nhập đầy đủ thông tin.";
        } elseif ($matkhauMoi !== $nhaplai) {
            $message = "⚠️ Mật khẩu nhập lại không khớp!";
        } else {
            // ✅ Gọi model và xử lý
            if ($this->model->quenMatKhau($email, $matkhauMoi)) {
                $message = "✅ Đặt lại mật khẩu thành công! Bạn có thể đăng nhập lại.";
            } else {
                $message = "❌ Không tìm thấy tài khoản với email này!";
            }
        }
    }

    include __DIR__ . '/../Views/taikhoan/quenmatkhau.php';
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
    include __DIR__ . '/../Views/taikhoan/xacnhan_email.php';
}
}
