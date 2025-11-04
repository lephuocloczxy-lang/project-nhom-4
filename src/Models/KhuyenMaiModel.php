<?php
namespace Admin\Nhom4\Models;
use PDO;
use PDOException;
class KhuyenMaiModel {  // Đổi lại đúng tên class
    private $conn;
    private $table = "khuyenmai"; // Bảng đúng
    public function __construct($db) {
        $this->conn = $db;
    }
    // Lấy tất cả chương trình khuyến mãi
    public function getAll() {
        try {
            $sql = "SELECT * FROM khuyenmai ORDER BY id DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi getAll(): " . $e->getMessage());
            return [];
        }
    }
    // Lấy 1 bản ghi theo ID
    public function getById($id) {
        try {
            $sql = "SELECT * FROM khuyenmai WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi getById(): " . $e->getMessage());
            return null;
        }
    }
    // Thêm mới
public function insert($data) {
    try {
        $sql = "INSERT INTO khuyenmai 
                (ten, ma, loai_giam, gia_tri, dieu_kien, ngay_bat_dau, ngay_ket_thuc, ngay_tao)
                VALUES (:ten, :ma, :loai_giam, :gia_tri, :dieu_kien, :ngay_bat_dau, :ngay_ket_thuc, NOW())";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':ten' => $data['ten'],
            ':ma' => $data['ma'],
            ':loai_giam' => $data['loai_giam'],
            ':gia_tri' => $data['gia_tri'],
            ':dieu_kien' => $data['dieu_kien'],
            ':ngay_bat_dau' => $data['ngay_bat_dau'],
            ':ngay_ket_thuc' => $data['ngay_ket_thuc']
        ]);
    } catch (PDOException $e) {
        echo "<pre style='color:red;'>❌ Lỗi SQL khi thêm khuyến mãi: " . $e->getMessage() . "</pre>";
        return false;
    }
}
    // Cập nhật
    public function update($id, $data) {
        try {
            $sql = "UPDATE khuyenmai 
                    SET ten = :ten,
                        ma = :ma,
                        loai_giam = :loai_giam,
                        gia_tri = :gia_tri,
                        dieu_kien = :dieu_kien,
                        ngay_bat_dau = :ngay_bat_dau,
                        ngay_ket_thuc = :ngay_ket_thuc
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':id' => $id,
                ':ten' => $data['ten'],
                ':ma' => $data['ma'],
                ':loai_giam' => $data['loai_giam'],
                ':gia_tri' => $data['gia_tri'],
                ':dieu_kien' => $data['dieu_kien'],
                ':ngay_bat_dau' => $data['ngay_bat_dau'],
                ':ngay_ket_thuc' => $data['ngay_ket_thuc']
            ]);
        } catch (PDOException $e) {
            error_log("Lỗi update(): " . $e->getMessage());
            return false;
        }
    }
    // Xóa
    public function delete($id) {
        try {
            $sql = "DELETE FROM khuyenmai WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Lỗi delete(): " . $e->getMessage());
            return false;
        }
    }
   // Kiểm tra trùng mã giảm giá
public function getByCode($ma) {
    try {
        $sql = "SELECT * FROM khuyenmai WHERE ma = :ma";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':ma', $ma, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi getByCode(): " . $e->getMessage());
        return null;
    }
}
// Lấy danh sách có phân trang
public function getPaginated($limit, $offset) {
    try {
        $sql = "SELECT * FROM khuyenmai ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi getPaginated(): " . $e->getMessage());
        return [];
    }
}
// Đếm tổng số bản ghi
public function countAll() {
    try {
        $sql = "SELECT COUNT(*) AS total FROM khuyenmai";
        $stmt = $this->conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['total'];
    } catch (PDOException $e) {
        error_log("Lỗi countAll(): " . $e->getMessage());
        return 0;
    }
}
// Lấy danh sách có tìm kiếm + phân trang
public function searchPaginated($keyword, $limit, $offset) {
    try {
        $sql = "SELECT * FROM khuyenmai 
                WHERE ten LIKE :kw OR ma LIKE :kw 
                ORDER BY id DESC 
                LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':kw', "%$keyword%");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi searchPaginated(): " . $e->getMessage());
        return [];
    }
}
public function countSearch($keyword) {
    try {
        $sql = "SELECT COUNT(*) FROM khuyenmai WHERE ten LIKE :kw OR ma LIKE :kw";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':kw', "%$keyword%");
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log("Lỗi countSearch(): " . $e->getMessage());
        return 0;
    }
}
// Kiểm tra trùng mã giảm giá nhưng loại trừ ID hiện tại
public function getByCodeButExcludeId($code, $id) {
    try {
        $sql = "SELECT * FROM khuyenmai WHERE ma = :ma AND id != :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ma', $code, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    } catch (PDOException $e) {
        error_log("Lỗi getByCodeButExcludeId(): " . $e->getMessage());
        return null;
    }
}
}
