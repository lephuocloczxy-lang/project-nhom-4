<?php
namespace Admin\Nhom4\Models;

use PDO;
<<<<<<< HEAD
use Exception;

class TaiKhoanModel {
    private $conn;
    private $table = "khachhang"; // ⚙️ Đổi nếu bảng khác (khách hàng hoặc user)
=======

class TaiKhoanModel {
    private $conn;
    private $table = "khachhang"; // Tên bảng trong database
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618

    public function __construct($db) {
        $this->conn = $db;
    }

<<<<<<< HEAD
    // --- CHỨC NĂNG CƠ BẢN ---
    
    /** 🧩 Kiểm tra email đã tồn tại chưa */
    public function kiemTraTonTai($email) {
        $sql = "SELECT 1 FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }
    
    /** 🧩 Lấy thông tin người dùng theo ID (ĐỔI TÊN HÀM để khớp với AdminController::doiTrangThai) */
    public function getById(int $id): ?array { 
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    /** 🧩 Lấy thông tin người dùng theo ID (Dùng cho các Controller cũ) */
    public function layThongTin(int $id): ?array {
        return $this->getById($id);
    }
    
    /** 🧩 Lấy thông tin người dùng theo Email */
    public function layThongTinByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // --- CHỨC NĂNG TÀI KHOẢN (NGƯỜI DÙNG) ---

    /** 🧩 Đăng ký tài khoản */
    public function dangKy($data) {
        try {
            if ($this->kiemTraTonTai($data['email'])) {
                return "duplicate";
            }

            $token = bin2hex(random_bytes(32));
            $hashed = password_hash($data['matkhau'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO {$this->table} 
                     (hoten, email, matkhau, dienthoai, diachi, ngaysinh, gioitinh, role, trangthai, verify_token)
                     VALUES (:hoten, :email, :matkhau, :dienthoai, :diachi, :ngaysinh, :gioitinh, 'user', 0, :verify_token)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':hoten'        => $data['hoten'],
                ':email'        => $data['email'],
                ':matkhau'      => $hashed,
                ':dienthoai'    => $data['dienthoai'],
                ':diachi'       => $data['diachi'],
                ':ngaysinh'     => $data['ngaysinh'],
                ':gioitinh'     => $data['gioitinh'],
                ':verify_token' => $token
            ]);

            return $token;
        } catch (Exception $e) {
            return "error: " . $e->getMessage();
        }
=======
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
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
    }

    /** 🧩 Xác thực email */
    public function xacThucEmail($token) {
<<<<<<< HEAD
        $sql = "SELECT * FROM {$this->table} WHERE verify_token = :token AND trangthai = 0 LIMIT 1";
        $stmt = $this->conn->prepare($sql);
=======
        $query = "SELECT * FROM {$this->table} WHERE verify_token = :token AND trangthai = 0 LIMIT 1";
        $stmt = $this->conn->prepare($query);
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        $stmt->execute([':token' => $token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
<<<<<<< HEAD
            $update = "UPDATE {$this->table}
                          SET trangthai = 1, verify_token = NULL 
                          WHERE id = :id";
=======
            $update = "UPDATE {$this->table} SET trangthai = 1, verify_token = NULL WHERE id = :id";
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            $stmt = $this->conn->prepare($update);
            $stmt->execute([':id' => $user['id']]);
            return true;
        }
        return false;
    }
<<<<<<< HEAD

    /** 🧩 Đăng nhập */
    public function dangNhap($email, $matkhau) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) return ['error' => 'Tài khoản không tồn tại!'];
        
        // 0: Chưa kích hoạt, 1: Hoạt động, (Có thể dùng 2: Khóa thủ công)
        if ((int)$user['trangthai'] !== 1)
            return ['error' => $user['trangthai'] == 0 ? 'Tài khoản chưa xác thực!' : 'Tài khoản đã bị khóa!'];

        if (!password_verify($matkhau, $user['matkhau']))
            return ['error' => 'Mật khẩu không đúng!'];

        return [
            'id' => $user['id'],
            'hoten' => $user['hoten'],
            'email' => $user['email'],
            'role' => $user['role'] ?? 'user',
            'trangthai' => $user['trangthai'],
            'avatar' => $user['avatar'] ?? null
        ];
    }

    /** 🧩 Đổi mật khẩu (cho người dùng đã đăng nhập) */
    public function doiMatKhau($id, $matKhauMoi) {
        $hash = password_hash($matKhauMoi, PASSWORD_DEFAULT);
        $sql = "UPDATE {$this->table} SET matkhau = :matkhau WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':matkhau' => $hash, ':id' => $id]);
    }
    
    /** 🧩 Cập nhật hồ sơ (Cho phép cập nhật role và trạng thái bởi Admin) */
    public function capNhat(array $data): bool
    {
        // Khởi tạo các trường sẽ được cập nhật
        $setClauses = [
            "hoten = :hoten",
            "gioitinh = :gioitinh",
            "ngaysinh = :ngaysinh",
            "dienthoai = :dienthoai",
            "diachi = :diachi"
        ];
        
        $bindParams = [
            ':hoten' => $data['hoten'],
            ':gioitinh' => $data['gioitinh'],
            ':ngaysinh' => $data['ngaysinh'],
            ':dienthoai' => $data['dienthoai'],
            ':diachi' => $data['diachi'],
            ':id' => $data['id']
        ];

        // 🎯 LOGIC BỔ SUNG CHO ADMIN (Nếu các trường này tồn tại trong $data)
        if (isset($data['role'])) {
            $setClauses[] = "role = :role";
            $bindParams[':role'] = $data['role'];
        }
        if (isset($data['trangthai'])) {
            $setClauses[] = "trangthai = :trangthai";
            $bindParams[':trangthai'] = $data['trangthai'];
        }
        
        // Chỉ thêm trường avatar nếu nó được truyền vào
        if (isset($data['avatar']) && $data['avatar']) {
            $setClauses[] = "avatar = :avatar";
            $bindParams[':avatar'] = $data['avatar'];
        }

        $sql = "UPDATE {$this->table} SET " . implode(', ', $setClauses) . " WHERE id = :id";
        
        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($bindParams);
            
        } catch (\PDOException $e) {
            error_log("Lỗi cập nhật tài khoản: " . $e->getMessage());
            return false;
        }
    }
    
    // --- CHỨC NĂNG ADMIN ---

    /** 🧩 Lấy tất cả tài khoản */
    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /** 🧩 Cập nhật trạng thái (Dùng cho Khóa/Mở Khóa nhanh) */
    public function setTrangThai($id, $status) {
        // $status phải là 0 hoặc 1 (được truyền từ AdminController)
        $sql = "UPDATE {$this->table} SET trangthai = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':status' => (int)$status,
            ':id' => $id
        ]);
    }

    // --- CHỨC NĂNG QUÊN MẬT KHẨU (TOKEN-BASED) ---

    /** 🧩 Tạo token khôi phục mật khẩu (Gửi Email) */
    public function taoTokenKhoiPhuc($email) {
        $token = bin2hex(random_bytes(32));
        $sql = "UPDATE {$this->table}
                  SET reset_token = :token, reset_expire = DATE_ADD(NOW(), INTERVAL 30 MINUTE)
                  WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
=======
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
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        $stmt->execute([':token' => $token, ':email' => $email]);
        return $token;
    }

<<<<<<< HEAD
    /** 🧩 Kiểm tra token khôi phục hợp lệ */
    public function kiemTraTokenKhoiPhuc($token) {
        $sql = "SELECT id, email, reset_token, reset_expire FROM {$this->table}
                  WHERE reset_token = :token AND reset_expire > NOW()
                  LIMIT 1";
        $stmt = $this->conn->prepare($sql);
=======
    /** 🧩 Xác minh token hợp lệ khi đặt lại mật khẩu */
    public function kiemTraTokenKhoiPhuc($token) {
        $query = "SELECT * FROM {$this->table} 
                  WHERE reset_token = :token AND reset_expire > NOW() LIMIT 1";
        $stmt = $this->conn->prepare($query);
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
    /** 🧩 Đặt lại mật khẩu (Sau khi xác nhận token) */
    public function datLaiMatKhau($token, $matKhauMoi) {
        $hash = password_hash($matKhauMoi, PASSWORD_DEFAULT);
        $sql = "UPDATE {$this->table}
                  SET matkhau = :matkhau, reset_token = NULL, reset_expire = NULL
                  WHERE reset_token = :token"; 
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':matkhau' => $hash, ':token' => $token]);
    }
=======
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

>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
}
