<?php
namespace Admin\Bai01QuanlySv;
use PDO;
use PDOException;
class Database
{
    private static ?Database $instance = null; // Singleton
    private PDO $connection; // PDO object
    // 🔧 Cấu hình kết nối
    private string $host = 'localhost';
    private string $db_name = 'quanlysinhvien';
    private string $username = 'root';
    private string $password = '';

    // 🧱 Hàm khởi tạo riêng (private)
    private function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("❌ Lỗi kết nối CSDL: " . $e->getMessage());
        }
    }

    /**
     * 🔁 Lấy instance duy nhất của Database (Singleton)
     */
    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * 🔌 Lấy đối tượng PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

