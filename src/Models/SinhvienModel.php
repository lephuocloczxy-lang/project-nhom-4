<?php
namespace Admin\Bai01QuanlySv\Models;
use PDO;
use Admin\Bai01QuanlySv\Database; // ✅ CHÚ Ý: namespace này khớp với file bạn đang có

class SinhvienModel {
    private PDO $conn;

    public function __construct() {
        // ✅ Lấy kết nối PDO thông qua Singleton
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getStudents($keyword = null, $limit = 5, $offset = 0, $sort = 'id', $order = 'desc') {
    // 🟢 Kiểm tra cột hợp lệ để tránh SQL injection
    $allowedColumns = ['id', 'name', 'email', 'phone', 'class'];
    if (!in_array($sort, $allowedColumns)) {
        $sort = 'id';
    }

    // 🟢 Chỉ cho phép asc hoặc desc
    $order = strtolower($order) === 'asc' ? 'ASC' : 'DESC';

    // 🟡 Tạo câu lệnh SQL cơ bản
    $sql = "SELECT * FROM students";
    $countSql = "SELECT COUNT(*) FROM students";

    // 🟢 Nếu có tìm kiếm
    if ($keyword) {
        $sql .= " WHERE name LIKE :keyword OR email LIKE :keyword OR phone LIKE :keyword";
        $countSql .= " WHERE name LIKE :keyword OR email LIKE :keyword OR phone LIKE :keyword";
    }
    // 🟢 Thêm sắp xếp + phân trang
    $sql .= " ORDER BY $sort $order LIMIT :limit OFFSET :offset";

    // 🟡 Chuẩn bị và gán giá trị
    $stmt = $this->conn->prepare($sql);
    if ($keyword) {
        $stmt->bindValue(':keyword', "%$keyword%");
    }
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 🟢 Đếm tổng bản ghi
    $countStmt = $this->conn->prepare($countSql);
    if ($keyword) {
        $countStmt->bindValue(':keyword', "%$keyword%");
    }
    $countStmt->execute();
    $total = $countStmt->fetchColumn();

    return ['data' => $data, 'total' => $total];
}
    // =============================
    // LẤY SINH VIÊN THEO ID
    // =============================
    public function getStudentById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // =============================
    // THÊM SINH VIÊN
    // =============================
    public function addStudent($name, $email, $phone, $avatar = null) {
        $stmt = $this->conn->prepare("
            INSERT INTO students (name, email, phone, avatar)
            VALUES (:name, :email, :phone, :avatar)
        ");
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'avatar' => $avatar
        ]);
    }
    // =============================
    // CẬP NHẬT SINH VIÊN
    // =============================
    public function updateStudent($id, $name, $email, $phone, $avatar = null) {
        if ($avatar) {
            $sql = "UPDATE students SET name=:name, email=:email, phone=:phone, avatar=:avatar WHERE id=:id";
            $params = compact('id', 'name', 'email', 'phone', 'avatar');
        } else {
            $sql = "UPDATE students SET name=:name, email=:email, phone=:phone WHERE id=:id";
            $params = compact('id', 'name', 'email', 'phone');
        }
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }
    // =============================
    // XÓA SINH VIÊN
    // =============================
    public function deleteStudent($id) {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public function getStatistics() {
    $sql = "
        SELECT 
            COUNT(*) AS total,
            SUM(email LIKE '%@gmail.com') AS gmail_count,
            SUM(phone LIKE '09%') AS phone_09_count,
            SUM(phone LIKE '08%') AS phone_08_count
        FROM students
    ";
    $stmt = $this->conn->query($sql);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}
 public function getById($id) {
        $sql = "SELECT * FROM students WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAll() {
    $stmt = $this->conn->query("SELECT * FROM students ORDER BY id ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
