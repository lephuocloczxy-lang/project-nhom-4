<?php
namespace Admin\Nhom4\Models;

use PDO;

class TaiKhoanModel {
    private $conn;
    private $table = "khachhang"; // Tên bảng trong database

    public function __construct($db) {
        $this->conn = $db;
    }

    /** 🧩 Đăng ký (kèm token xác thực email) */
    public function dangKy($data) {
        // Kiểm tra email trùng
        $check = $this->conn->prepare("SELECT COUNT(*) FROM {$this->table} WHERE email = :email");
        $check->execute([':email' => $data['email']]);
        if ($check->fetchColumn() > 0) return "duplicate";

        // Tạo token xác thực email
        $token = bin2hex(random_bytes(32));
        $query = "INSERT INTO {$this->table} 
                  (hoten, email, matkhau, dienthoai, diachi, ngaysinh, gioitinh, trangthai, verify_token)
                  VALUES (:hoten, :email, :matkhau, :dienthoai, :diachi, :ngaysinh, :gioitinh, 0, :verify_token)";
        
        $stmt = $this->conn->prepare($query);
        $data['matkhau'] = password_hash($data['matkhau'], PASSWORD_DEFAULT);
        $data['verify_token'] = $token;
        $stmt->execute($data);
        return $token;
    }

    /** 🧩 Xác thực email */
    public function xacThucEmail($token) {
        $query = "SELECT * FROM {$this->table} WHERE verify_token = :token AND trangthai = 0 LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':token' => $token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $update = "UPDATE {$this->table} SET trangthai = 1, verify_token = NULL WHERE id = :id";
            $stmt = $this->conn->prepare($update);
            $stmt->execute([':id' => $user['id']]);
            return true;
        }
        return false;
    }
    /** 🧩 Đăng nhập */
   public function dangNhap($email, $matkhau) {
    $query = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['trangthai'] == 1 && password_verify($matkhau, $user['matkhau'])) {
        return $user;
    }
    return false;
}


    /** 🧩 Cập nhật hồ sơ */
    public function capNhat($data) {
        $query = "UPDATE {$this->table}
                  SET hoten = :hoten,
                      gioitinh = :gioitinh,
                      ngaysinh = :ngaysinh,
                      dienthoai = :dienthoai,
                      diachi = :diachi,
                      avatar = :avatar
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    /** 🧩 Tạo token khôi phục mật khẩu */
    public function taoTokenKhoiPhuc($email) {
        $token = bin2hex(random_bytes(32));
        $query = "UPDATE {$this->table} 
                  SET reset_token = :token, reset_expire = DATE_ADD(NOW(), INTERVAL 30 MINUTE)
                  WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':token' => $token, ':email' => $email]);
        return $token;
    }

    /** 🧩 Xác minh token hợp lệ khi đặt lại mật khẩu */
    public function kiemTraTokenKhoiPhuc($token) {
        $query = "SELECT * FROM {$this->table} 
                  WHERE reset_token = :token AND reset_expire > NOW() LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** 🧩 Đặt lại mật khẩu (quên mật khẩu) */
    public function datLaiMatKhau($token, $matKhauMoi) {
        $hash = password_hash($matKhauMoi, PASSWORD_DEFAULT);
        $query = "UPDATE {$this->table} 
                  SET matkhau = :matkhau, reset_token = NULL, reset_expire = NULL 
                  WHERE reset_token = :token";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':matkhau' => $hash, ':token' => $token]);
    }

    /** ✅ Đổi mật khẩu (theo ID) */
   public function doiMatKhau($id, $matkhaumoi) {
    $hash = password_hash($matkhaumoi, PASSWORD_DEFAULT);
    $query = "UPDATE {$this->table} SET matkhau = :matkhau WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    return $stmt->execute([':matkhau' => $hash, ':id' => $id]);
}
    /** 🧩 Lấy thông tin tài khoản theo ID */
    public function layThongTin($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** 🧩 Lấy thông tin bằng email */
    public function getByEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   public function quenMatKhau($email, $matkhauMoi)
{
    $check = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
    $check->execute([':email' => $email]);
    $user = $check->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return false;
    }

    $hash = password_hash($matkhauMoi, PASSWORD_DEFAULT);

    $stmt = $this->conn->prepare("UPDATE {$this->table} SET matkhau = :matkhau WHERE email = :email");
    $stmt->execute([':matkhau' => $hash, ':email' => $email]);

    return true;
}

}
