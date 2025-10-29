<?php
namespace Admin\Bai01QuanlySv\Models;

use PDO;

class LogModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Thêm log (gọi khi có hành động người dùng)
    public function addLog($userId, $action)
    {
        $sql = "INSERT INTO logs (user_id, action, created_at) VALUES (:user_id, :action, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':action', $action);
        return $stmt->execute();
    }

    // Lấy toàn bộ log
    public function getAll()
    {
        $sql = "SELECT * FROM logs ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
