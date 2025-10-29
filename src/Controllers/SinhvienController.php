<?php
namespace Admin\Bai01QuanlySv\Controllers;

require_once __DIR__ . '/../auth.php';

use Admin\Bai01QuanlySv\Models\SinhvienModel;
use Admin\Bai01QuanlySv\Models\LogModel; // ✅ thêm dòng này để gọi log model

class SinhvienController {
    private $sinhvienModel;
    private $logModel;

  public function __construct() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // ✅ Khởi tạo model sinh viên
    $this->sinhvienModel = new SinhvienModel();

    // ✅ Lấy kết nối DB
    $this->db = \Admin\Bai01QuanlySv\Database::getInstance()->getConnection();

    // ✅ Khởi tạo LogModel với kết nối DB
    $this->logModel = new LogModel($this->db);
}
    // ============================
    // HIỂN THỊ DANH SÁCH SINH VIÊN
    // =============================
    public function index() {
        $recordsPerPage = 5;
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($currentPage - 1) * $recordsPerPage;

        $keyword = $_GET['keyword'] ?? null;
        $sort = $_GET['sort'] ?? 'id';
        $order = $_GET['order'] ?? 'asc';

        $validColumns = ['id', 'name', 'email', 'phone', 'class'];
        if (!in_array($sort, $validColumns)) $sort = 'id';
        $order = strtolower($order) === 'desc' ? 'desc' : 'asc';

        $result = $this->sinhvienModel->getStudents($keyword, $recordsPerPage, $offset, $sort, $order);
        $students = $result['data'];
        $totalRecords = $result['total'];
        $totalPages = ceil($totalRecords / $recordsPerPage);

        require_once __DIR__ . '/../../views/sinhvien_list.php';
    }

    // =============================
    // THÊM SINH VIÊN
    // =============================
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $avatarPath = null;

            // 🖼️ Upload ảnh
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $fileTmp  = $_FILES['avatar']['tmp_name'];
                $fileName = basename($_FILES['avatar']['name']);
                $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $allowed = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExt, $allowed)) {
                    $newName = uniqid('sv_', true) . '.' . $fileExt;
                    move_uploaded_file($fileTmp, $uploadDir . $newName);
                    $avatarPath = $newName;
                } else {
                    $_SESSION['error'] = "❌ Định dạng ảnh không hợp lệ!";
                }
            }

            if ($name && $email && $phone) {
                $this->sinhvienModel->addStudent($name, $email, $phone, $avatarPath);

                // ✅ Ghi log
                if (!empty($_SESSION['user_id'])) {
                    $this->logModel->addLog($_SESSION['user_id'], "Thêm sinh viên: $name ($email)");
                }

                $_SESSION['success'] = "✅ Thêm sinh viên thành công!";
            } else {
                $_SESSION['error'] = "⚠️ Vui lòng nhập đầy đủ thông tin!";
            }

            header('Location: index.php');
            exit();
        }
    }

    // =============================
    // CHỈNH SỬA SINH VIÊN
    // =============================
    public function edit() {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "⚠️ Thiếu ID sinh viên!";
            header('Location: index.php');
            exit();
        }

        $id = $_GET['id'];
        $student = $this->sinhvienModel->getStudentById($id);

        if (!$student) {
            $_SESSION['error'] = "❌ Không tìm thấy sinh viên!";
            header('Location: index.php');
            exit();
        }

        require_once __DIR__ . '/../../views/sinhvien_edit.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id    = $_POST['id'] ?? null;
            $name  = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $avatarPath = $_POST['old_avatar'] ?? null;

            // 🖼️ Upload ảnh mới
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $fileTmp  = $_FILES['avatar']['tmp_name'];
                $fileName = basename($_FILES['avatar']['name']);
                $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($fileExt, $allowed)) {
                    $newName = uniqid('sv_', true) . '.' . $fileExt;
                    move_uploaded_file($fileTmp, $uploadDir . $newName);

                    if (!empty($_POST['old_avatar']) && file_exists($uploadDir . $_POST['old_avatar'])) {
                        unlink($uploadDir . $_POST['old_avatar']);
                    }

                    $avatarPath = $newName;
                } else {
                    $_SESSION['error'] = "❌ Ảnh không hợp lệ!";
                }
            }

            if ($id && $name && $email && $phone) {
                $updated = $this->sinhvienModel->updateStudent($id, $name, $email, $phone, $avatarPath);

                if ($updated && !empty($_SESSION['user_id'])) {
                    // ✅ Ghi log
                    $this->logModel->addLog($_SESSION['user_id'], "Cập nhật sinh viên ID=$id ($name)");
                }

                $_SESSION[$updated ? 'success' : 'error'] =
                    $updated ? "✅ Cập nhật sinh viên thành công!" : "❌ Không thể cập nhật dữ liệu!";
            } else {
                $_SESSION['error'] = "⚠️ Dữ liệu không hợp lệ!";
            }

            header('Location: index.php');
            exit();
        }
    }

    // =============================
    // XÓA SINH VIÊN
    // =============================
    public function delete() {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "⚠️ Thiếu ID sinh viên!";
            header('Location: index.php');
            exit();
        }

        $id = $_GET['id'];
        $student = $this->sinhvienModel->getStudentById($id);

        if ($student) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!empty($student['avatar']) && file_exists($uploadDir . $student['avatar'])) {
                unlink($uploadDir . $student['avatar']);
            }

            $deleted = $this->sinhvienModel->deleteStudent($id);

            if ($deleted && !empty($_SESSION['user_id'])) {
                // ✅ Ghi log
                $this->logModel->addLog($_SESSION['user_id'], "Xóa sinh viên ID=$id ({$student['name']})");
            }

            $_SESSION[$deleted ? 'success' : 'error'] =
                $deleted ? "✅ Xóa sinh viên thành công!" : "❌ Không thể xóa sinh viên!";
        } else {
            $_SESSION['error'] = "❌ Không tìm thấy sinh viên để xóa!";
        }

        header('Location: index.php');
        exit();
    }

    // =============================
    // THỐNG KÊ SINH VIÊN
    // =============================
    public function stats() {
        $stats = $this->sinhvienModel->getStatistics();
        require_once __DIR__ . '/../../views/sinhvien_stats.php';
    }

    public function detail() {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $_SESSION['error'] = "ID không hợp lệ!";
            header("Location: index.php");
            exit;
        }

        $model = new SinhvienModel();
        $student = $model->getById($id);

        if (!$student) {
            $_SESSION['error'] = "Không tìm thấy sinh viên!";
            header("Location: index.php");
            exit;
        }

        require_once __DIR__ . '/../../views/sinhvien_chitiet.php';
    }

    // =============================
    // XUẤT CSV
    // =============================
    public function exportCSV() {
        $model = new SinhvienModel();
        $students = $model->getAll();
        $filename = "sinhvien_" . date('Ymd_His') . ".csv";

        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo "\xEF\xBB\xBF";

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Họ tên', 'Email', 'Số điện thoại']);

        foreach ($students as $sv) {
            fputcsv($output, [
                $sv['id'] ?? '',
                $sv['name'] ?? '',
                $sv['email'] ?? '',
                $sv['phone'] ?? ''
            ]);
        }

        fclose($output);
        exit;
    }
}
