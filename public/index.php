<?php
session_start(); // ⚙️ Bắt đầu session trước mọi output
require_once __DIR__ . '/../vendor/autoload.php';

use Admin\Nhom4\Controllers\TaiKhoanController;
use Admin\Nhom4\Controllers\HomeController; // ✅ THÊM DÒNG NÀY

// 🧩 Kết nối CSDL (PDO)
try {
    $db = new PDO("mysql:host=localhost;dbname=nhom4;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối database: " . $e->getMessage());
}

// ⚙️ Xác định action
$action = $_GET['action'] ?? 'trangchu'; // ✅ ĐỔI MẶC ĐỊNH THÀNH TRANG CHỦ

// ✅ Khởi tạo controllers
$taiKhoanController = new TaiKhoanController($db);
$homeController = new HomeController($db);

switch ($action) {
    case 'trangchu':
    case 'home':
    case '':
        $homeController->index();
        break;
        
    case 'dangky':
        $taiKhoanController->dangKy();
        break;

    case 'dangnhap':
        $taiKhoanController->dangNhap();
        break;

    case 'dangxuat':
        $taiKhoanController->dangXuat();
        break;

    case 'hoso':
        // ✅ Kiểm tra đăng nhập trước khi vào hồ sơ
        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect_url'] = 'hoso';
            header("Location: index.php?action=dangnhap");
            exit();
        }
        $taiKhoanController->hoSo();
        break;

    case 'quenmatkhau':
        $taiKhoanController->quenMatKhau();
        break;

    case 'doimatkhau':
        // ✅ Kiểm tra đăng nhập trước khi đổi mật khẩu
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=dangnhap");
            exit();
        }
        $taiKhoanController->doiMatKhau();
        break;

    case 'suathongtin':
        // ✅ Kiểm tra đăng nhập trước khi sửa thông tin
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=dangnhap");
            exit();
        }
        $taiKhoanController->suaThongTin();
        break;

    case 'verify':
        $taiKhoanController->xacNhanTaiKhoan();
        break;

    default:
        // ✅ Mặc định về trang chủ thay vì đăng nhập
        $homeController->index();
        break;
}