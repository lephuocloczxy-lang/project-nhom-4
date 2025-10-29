<?php
namespace Admin\Bai01QuanlySv\Models;

use PDO;
use Admin\Bai01QuanlySv\Database; // 🟢 thêm dòng này

class ContactModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();  // Kết nối DB
    }

    public function saveContact($name, $email, $message) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $sql = "INSERT INTO contacts (name, email, message, created_at) 
                VALUES (:name, :email, :message, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message
        ]);
    }
}
