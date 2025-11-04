<?php
namespace Admin\Nhom4\Controllers;

use Admin\Nhom4\Models\TaiKhoanModel;

class AdminController
{
    private $model;
    // Thêm biến baseUrl để dễ dàng quản lý đường dẫn
    private $baseUrl = '/nhom4/public/';

    public function __construct($db)
    {
        // ✅ Bắt đầu session nếu chưa có
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Gọi model để thao tác với cơ sở dữ liệu
        $this->model = new TaiKhoanModel($db);
    }

    /** ✅ Kiểm tra quyền admin */
    private function checkAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            // Chuyển hướng về trang chủ
            header('Location: ' . $this->baseUrl . 'index.php');
            exit;
        }
    }

    /** ✅ Trang danh sách tài khoản */
    public function quanLyTaiKhoan()
    {
        $this->checkAdmin(); // chỉ admin được phép truy cập

        // Giả định Model có hàm getAll() để lấy tất cả tài khoản
        $taiKhoans = $this->model->getAll();

        // ✅ Gọi view hiển thị danh sách tài khoản
        include __DIR__ . '/../Views/admin/taikhoan_list.php';

    }

    /** ✅ Xử lý khóa / mở khóa tài khoản */
    public function doiTrangThai($id)
    {
        $this->checkAdmin(); // chỉ admin mới được quyền khóa/mở tài khoản
        
        // 1. Lấy thông tin user hiện tại. Hàm getById() đã được thêm vào Model.
        $tk = $this->model->getById($id);

        if ($tk) {
            // 2. Xác định trạng thái mới:
            // tk['trangthai'] = 1 (hoạt động) -> newStatus = 0 (khóa)
            // tk['trangthai'] = 0 (khóa) -> newStatus = 1 (hoạt động)
            
            // Chú ý: Tên trường trong DB phải là 'trangthai' (hoặc bạn phải sửa lại trong Model)
            $currentStatus = (int) $tk['trangthai']; 
            $newStatus = ($currentStatus === 1) ? 0 : 1;
            
            // 3. Cập nhật trạng thái
            // Giả định Model có hàm setTrangThai($id, $newStatus)
            $this->model->setTrangThai($id, $newStatus);
        }

        // ✅ Quay lại trang danh sách tài khoản
        header('Location: ' . $this->baseUrl . 'admin.php?action=quanlytaikhoan');
        exit;
    }
    
    public function dashboard()
    {
        $this->checkAdmin();
        include __DIR__ . '/../Views/admin/dashboard.php';
    }
}
