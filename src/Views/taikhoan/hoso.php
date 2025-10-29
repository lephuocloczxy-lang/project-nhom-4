<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Hồ sơ cá nhân - ShopOnline</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fafafa;
      margin: 0;
      padding: 0;
    }

    .profile-container {
      display: flex;
      max-width: 1100px;
      margin: 40px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.05);
      overflow: hidden;
    }

    /* Sidebar trái */
    .profile-sidebar {
      width: 280px;
      background-color: #fff;
      border-right: 1px solid #f0f0f0;
      padding: 40px 25px;
      text-align: center;
    }

    .profile-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #f53d2d;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      margin-bottom: 15px;
    }

    .profile-name {
      font-weight: 600;
      font-size: 18px;
      color: #222;
    }

    .profile-email {
      font-size: 14px;
      color: #888;
      margin-bottom: 25px;
    }

    .profile-menu a {
      display: block;
      padding: 12px;
      color: #555;
      text-decoration: none;
      border-radius: 6px;
      transition: all 0.25s ease;
      margin-bottom: 8px;
      font-weight: 500;
    }

    .profile-menu a:hover,
    .profile-menu a.active {
      background: #fff5f4;
      color: #f53d2d;
      font-weight: 600;
    }

    /* Nội dung bên phải */
    .profile-content {
      flex: 1;
      padding: 40px 50px;
    }

    .profile-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .profile-header h2 {
      color: #f53d2d;
      font-size: 22px;
      font-weight: 600;
    }

    .info-group {
      margin-bottom: 18px;
    }

    .info-label {
      color: #555;
      font-weight: 500;
      display: block;
      margin-bottom: 6px;
    }

    .info-value {
      background: #f9f9f9;
      border: 1px solid #eee;
      border-radius: 8px;
      padding: 12px;
      color: #333;
    }

    .btn-primary {
      background: #f53d2d;
      color: #fff;
      padding: 12px 22px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.25s;
    }

    .btn-primary:hover {
      background: #d53727;
    }

    .btn-link {
      color: #f53d2d;
      text-decoration: none;
      margin-left: 15px;
      font-weight: 500;
    }

    .btn-link:hover {
      text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .profile-container {
        flex-direction: column;
      }

      .profile-sidebar {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid #eee;
      }

      .profile-content {
        padding: 25px;
      }
    }
  </style>
</head>
<body>
  <div class="profile-container">

    <!-- Sidebar trái -->
    <div class="profile-sidebar">
      <img src="<?= htmlspecialchars($user['avatar'] ?? '/public/images/default-avatar.png') ?>" alt="Avatar" class="profile-avatar">
      <div class="profile-name"><?= htmlspecialchars($user['hoten'] ?? 'Người dùng') ?></div>
      <div class="profile-email"><?= htmlspecialchars($user['email'] ?? '') ?></div>

      <div class="profile-menu">
        <a href="index.php?action=hoso" class="active">👤 Hồ sơ của tôi</a>
        <a href="index.php?action=doimatkhau">🔒 Đổi mật khẩu</a>
        <a href="index.php?action=dangxuat">🚪 Đăng xuất</a>
      </div>
    </div>

    <!-- Nội dung bên phải -->
    <div class="profile-content">
      <div class="profile-header">
        <h2>Thông tin tài khoản</h2>
        <button class="btn-primary" onclick="window.location='index.php?action=suathongtin'">✏️ Chỉnh sửa</button>
      </div>

      <div class="info-group">
        <label class="info-label">Họ và tên</label>
        <div class="info-value"><?= htmlspecialchars($user['hoten'] ?? '') ?></div>
      </div>

      <div class="info-group">
        <label class="info-label">Email</label>
        <div class="info-value"><?= htmlspecialchars($user['email'] ?? '') ?></div>
      </div>

      <div class="info-group">
        <label class="info-label">Số điện thoại</label>
        <div class="info-value"><?= htmlspecialchars($user['dienthoai'] ?? 'Chưa cập nhật') ?></div>
      </div>

      <div class="info-group">
        <label class="info-label">Giới tính</label>
        <div class="info-value"><?= htmlspecialchars($user['gioitinh'] ?? 'Chưa cập nhật') ?></div>
      </div>

      <div class="info-group">
        <label class="info-label">Ngày sinh</label>
        <div class="info-value"><?= htmlspecialchars($user['ngaysinh'] ?? 'Chưa cập nhật') ?></div>
      </div>

      <div class="info-group">
        <label class="info-label">Địa chỉ giao hàng</label>
        <div class="info-value"><?= htmlspecialchars($user['diachi'] ?? 'Chưa cập nhật') ?></div>
  </div>
</body>
</html>
