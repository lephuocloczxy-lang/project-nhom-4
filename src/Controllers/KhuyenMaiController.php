<?php
namespace Admin\Nhom4\Controllers;
use Admin\Nhom4\Models\KhuyenMaiModel;
class KhuyenMaiController {
    private $model;
    public function __construct($db) {
        // Kiểm tra và truyền kết nối database
        $this->model = new KhuyenMaiModel($db);
    }
public function index() {
    $limit = 5;
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $offset = ($page - 1) * $limit;
    $keyword = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Nếu có từ khóa => tìm kiếm trong DB
    if (!empty($keyword)) {
        $list = $this->model->searchPaginated($keyword, $limit, $offset);
        $totalRecords = $this->model->countSearch($keyword);
    } else {
        $list = $this->model->getPaginated($limit, $offset);
        $totalRecords = $this->model->countAll();
    }
    $totalPages = ceil($totalRecords / $limit);
    include __DIR__ . '/../Views/khuyenmai/danh_sach.php';
}
    //HIỂN THỊ FORM THÊM
    public function create() {
        include __DIR__ . '/../Views/khuyenmai/form_them.php';
    }
// XỬ LÝ LƯU KHUYẾN MÃI MỚI
public function store() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ?controller=khuyenmai&action=index");
        exit;
    }
    // Lấy dữ liệu từ form
    $data = [
        'ten' => trim($_POST['ten'] ?? ''),
        'ma' => trim($_POST['ma'] ?? ''),
        'loai_giam' => $_POST['loai_giam'] ?? '',
        'gia_tri' => (int)($_POST['gia_tri'] ?? 0),
        'dieu_kien' => trim($_POST['dieu_kien'] ?? ''),
        'ngay_bat_dau' => $_POST['ngay_bat_dau'] ?? '',
        'ngay_ket_thuc' => $_POST['ngay_ket_thuc'] ?? ''
    ];
    // Kiểm tra dữ liệu cơ bản
    if ($data['ten'] === '' || $data['ma'] === '') {
        echo "<p style='color:red;text-align:center;'>❌ Thiếu thông tin bắt buộc!</p>";
        include __DIR__ . '/../Views/khuyenmai/form_them.php';
        exit;
    }
    // 🔍 Kiểm tra mã giảm giá có bị trùng không
    $exists = $this->model->getByCode($data['ma']);
    if ($exists) {
        echo "<p style='color:red;text-align:center;'>❌ Mã giảm giá <b>{$data['ma']}</b> đã tồn tại, vui lòng nhập mã khác!</p>";
        include __DIR__ . '/../Views/khuyenmai/form_them.php';
        exit;
    }
    // Gọi model để thêm
    $ok = $this->model->insert($data);

    if ($ok) {
        header("Location: ?controller=khuyenmai&action=index");
        exit;
    } else {
        echo "<p style='color:red;text-align:center;'>❌ Không thể lưu khuyến mãi. Vui lòng kiểm tra kết nối CSDL.</p>";
    }
}
    // FORM SỬA
    public function edit($id) {
        $item = $this->model->getById($id);
        if (!$item) {
            echo "<p style='color:red;text-align:center;'>❌ Không tìm thấy khuyến mãi!</p>";
            echo "<p style='text-align:center;'><a href='?controller=khuyenmai&action=index'>← Quay lại danh sách</a></p>";
            exit;
        }
        include __DIR__ . '/../Views/khuyenmai/form_sua.php';
    }
    // CẬP NHẬT
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ?controller=khuyenmai&action=index");
            exit;
        }

        $data = [
            'ten' => trim($_POST['ten'] ?? ''),
            'ma' => trim($_POST['ma'] ?? ''),
            'loai_giam' => $_POST['loai_giam'] ?? '',
            'gia_tri' => (int)($_POST['gia_tri'] ?? 0),
            'dieu_kien' => trim($_POST['dieu_kien'] ?? ''),
            'ngay_bat_dau' => $_POST['ngay_bat_dau'] ?? '',
            'ngay_ket_thuc' => $_POST['ngay_ket_thuc'] ?? ''
        ];
        $ok = $this->model->update($id, $data);

        if ($ok) {
            header("Location: ?controller=khuyenmai&action=index");
            exit;
        } else {
            echo "<p style='color:red;text-align:center;'>❌ Cập nhật thất bại!</p>";
        }
    }
    // XÓA
    public function delete($id) {
        $this->model->delete($id);
        header("Location: ?controller=khuyenmai&action=index");
        exit;
    }
}
