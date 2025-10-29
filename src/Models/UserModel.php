<?php
namespace Admin\Bai01QuanlySv\Models;

use Admin\Bai01QuanlySv\Database;
use PDO;

class UserModel
{
    private PDO $conn;

    public function __construct()
    {
        // ✅ KHÔNG gọi new Database() vì __construct là private
        $this->conn = Database::getInstance()->getConnection();
    }

    public function isUserExists(string $username, string $email): bool
    {
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function findUserByUsername(string $username): ?array
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

   public function createUser(string $name, string $username, string $email, string $password): bool
{
    // Nếu username hoặc email đã tồn tại → không cho tạo
    if ($this->isUserExists($username, $email)) {
        return false;
    }

    // Mã hóa mật khẩu
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Thêm cột verified mặc định = 0
    $sql = "INSERT INTO users (name, username, email, password, verified, created_at)
            VALUES (:name, :username, :email, :password, 0, NOW())";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);

    return $stmt->execute();
}
public function verifyUser(string $email): bool
{
    $stmt = $this->pdo->prepare("UPDATE users SET verified = 1 WHERE email = :email AND verified = 0");
    $stmt->execute(['email' => $email]);
    return $stmt->rowCount() > 0;
}
   // Lấy user theo ID
    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật mật khẩu
    public function updatePassword($id, $newHashedPassword)
    {
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        return $stmt->execute([$newHashedPassword, $id]);
    }
}


