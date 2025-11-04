<?php
// file: public/admin.php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

// 1. IMPORT TẤT CẢ CONTROLLERS ADMIN
use Admin\Nhom4\Controllers\AdminController;
use Admin\Nhom4\Controllers\KhuyenMaiController; // <--- DÒNG BỊ THIẾU
// use Admin\Nhom4\Controllers\SanPhamController; // Thêm nếu cần

// 🧩 Kết nối CSDL
try {
    $db = new PDO("mysql:host=localhost;dbname=nhom4;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối database: " . $e->getMessage());
}

// ✅ Kiểm tra quyền truy cập (Giữ nguyên)
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo "<script>alert('Bạn không có quyền truy cập trang Admin!'); 
          window.location='index.php';</script>";
    exit;
}


// 2. XÁC ĐỊNH CONTROLLER VÀ ACTION
// Lấy controller (mặc định là 'admin')
$controllerName = $_GET['controller'] ?? 'admin'; 
// Lấy action (mặc định là 'dashboard' nếu là AdminController, hoặc 'index' cho các Controller khác)
$action = $_GET['action'] ?? 'index'; 

// 3. ĐỊNH TUYẾN (ROUTING MAP)
$adminControllersMap = [
    'admin' => new AdminController($db),
    'khuyenmai' => new KhuyenMaiController($db), // <--- DÒNG KHUYENMAI BỊ THIẾU
    // 'sanpham' => new SanPhamController($db), 
    // ... Thêm các controllers Admin khác vào đây
];


// 4. XỬ LÝ YÊU CẦU CHUNG
if (isset($adminControllersMap[$controllerName])) {
    $controllerInstance = $adminControllersMap[$controllerName];

    // Riêng cho AdminController, nếu không có action, ta gọi dashboard
    if ($controllerName === 'admin' && !isset($_GET['action'])) {
        $action = 'dashboard';
    }
    
    // Xử lý action đặc biệt như 'dangxuat' ngay tại Router
    if ($action === 'dangxuat') {
        session_destroy();
        header("Location: index.php?action=dangnhap");
        exit;
    }
    
    // Kiểm tra và gọi hàm
    if (method_exists($controllerInstance, $action)) {
        // Truyền ID nếu có
        $id = $_GET['id'] ?? null; 
        if ($id !== null && is_numeric($id)) {
            $controllerInstance->{$action}((int)$id);
        } else {
            $controllerInstance->{$action}();
        }
    } else {
        // Lỗi: Action không tồn tại
        http_response_code(404);
        die("Lỗi 404: Hành động '{$action}' không tồn tại trong Controller '{$controllerName}'!");
    }
} else {
    // Lỗi: Controller không tồn tại
    http_response_code(404);
    die("Lỗi 404: Controller '{$controllerName}' không được định tuyến!");
}

?>