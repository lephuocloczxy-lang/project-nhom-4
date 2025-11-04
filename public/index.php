<?php
// 1. CHUẨN HÓA ĐƯỜNG DẪN GỐC DỰ ÁN
// Tùy vào server của bạn, bạn cần định nghĩa đường dẫn gốc để dùng trong header()
// Dựa trên cấu trúc dự án (thư mục nhom4), tôi đoán đường dẫn gốc là /nhom4/public/
$BASE_URL = "/nhom4/public/";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';

use Admin\Nhom4\Controllers\TaiKhoanController;
use Admin\Nhom4\Controllers\HomeController;
// Thêm Controller Khuyến mãi vào đây
use Admin\Nhom4\Controllers\KhuyenMaiController; // <--- ĐÃ THÊM

// 🧩 Kết nối CSDL (PDO)
try {
    $db = new PDO("mysql:host=localhost;dbname=nhom4;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // ⚠️ Tốt hơn nên hiển thị trang lỗi thân thiện hơn thay vì die()
    die("Lỗi kết nối database: " . $e->getMessage());
}

// 🧭 Xác định action
$action = $_GET['action'] ?? 'trangchu';
$controller = $_GET['controller'] ?? 'home'; // <--- Cần lấy controller để biết phải chuyển hướng admin nào

// ✅ Khởi tạo controllers
$taiKhoanController = new TaiKhoanController($db);
$homeController = new HomeController($db);
$khuyenMaiController = new KhuyenMaiController($db); // <--- ĐÃ THÊM


// --- LOGIC ROUTING CHUNG ---
// Nếu người dùng yêu cầu một Controller/Action dành cho Admin, 
// thì chúng ta chuyển hướng sang admin.php để xử lý logic đó.

// Danh sách các Controller chỉ dành cho Admin (dự đoán dựa trên tên)
$admin_controllers = [
    'taikhoanadmin',
    'sanpham',
    'donhang',
    'khachhang',
    'khuyenmai', // <--- KHUYENMAI NẰM TRONG DANH SÁCH ADMIN
    'danhgia',
    'vanchuyen',
    'noidung',
    'baocao'
];

if (in_array($controller, $admin_controllers)) {
    // 1. Kiểm tra quyền truy cập admin ngay tại index.php
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
        // CHUYỂN HƯỚNG SANG admin.php, giữ nguyên controller và action
        $adminFile = str_replace('index.php', 'admin.php', $_SERVER['PHP_SELF']); // Dùng $_SERVER['PHP_SELF'] để an toàn hơn
        header("Location: {$adminFile}?controller={$controller}&action={$action}");
        exit();
    }
    
    // 2. Nếu không phải admin, show alert và chuyển về trang chủ
    echo "<script>alert('Bạn không có quyền truy cập chức năng quản trị!'); window.location='{$BASE_URL}';</script>";
    exit();
}
// --- KẾT THÚC LOGIC CHUYỂN HƯỚNG ADMIN ---


switch ($action) {
    /** 🏠 Trang chủ */
    case 'trangchu':
    case 'home':
    case '':
        $homeController->index();
        break;

    /** 🧩 Đăng ký */
    case 'dangky':
        $taiKhoanController->dangKy();
        break;

    /** 🔑 Đăng nhập */
    case 'dangnhap':
        $taiKhoanController->dangNhap();
        break;

    /** 🚪 Đăng xuất */
    case 'dangxuat':
        $taiKhoanController->dangXuat();
        break;

    /** 👤 Hồ sơ cá nhân */
    case 'hoso':
        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect_url'] = $BASE_URL . "?action=hoso"; 
            header("Location: {$BASE_URL}?action=dangnhap");
            exit();
        }
        $taiKhoanController->hoSo();
        break;

    /** 🔁 Quên mật khẩu & 🔐 Đổi mật khẩu & 📝 Sửa thông tin & 📧 Xác thực */
    case 'quenmatkhau':
    case 'datlaimatkhau':
    case 'doimatkhau':
    case 'suathongtin':
    case 'verify':
        $taiKhoanController->{$action}(); 
        break;

    // Các case Admin (như 'admin', 'dashboard') không cần ở đây nữa 
    // vì chúng ta đã xử lý chuyển hướng ở khối if-else phía trên
    // theo cơ chế kiểm tra $controller.

    /** ❌ Mặc định — về trang chủ */
    default:
        $homeController->index();
        break;
}
