<?php
session_start(); // ⚙️ Bắt đầu session trước mọi output
require_once __DIR__ . '/../vendor/autoload.php';

use Admin\Nhom4\Controllers\TaiKhoanController;

// 🧩 Kết nối CSDL (PDO)
$db = new PDO("mysql:host=localhost;dbname=nhom4;charset=utf8", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ⚙️ Xác định action
$action = $_GET['action'] ?? 'dangnhap';

// ✅ Chỉ cần tạo 1 lần controller
$controller = new TaiKhoanController($db);

switch ($action) {
    case 'dangky':
        $controller->dangKy();
        break;

    case 'dangnhap':
        $controller->dangNhap();
        break;

    case 'dangxuat':
        $controller->dangXuat();
        break;

    case 'hoso':
        $controller->hoSo();
        break;

    case 'quenmatkhau':
        $controller->quenMatKhau();
        break;

    case 'doimatkhau':
        $controller->doiMatKhau();
        break;

    case 'suathongtin':
        $controller->suaThongTin();
        break;

    case 'verify':
        $controller->xacNhanTaiKhoan();
        break;

    default:
        $controller->dangNhap();
        break;
}
