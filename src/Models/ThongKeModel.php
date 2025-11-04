<?php
namespace Admin\Nhom4\Models;

use PDO;

class ThongKeModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function dem($table) {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM {$table}");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    public function demAdmin() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM taikhoan WHERE role='admin'");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }
}
