<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký tài khoản</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .form-container {
      max-width: 450px;
      margin: 60px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 35px 40px;
    }

    h2 {
      color: #f53d2d;
      text-align: center;
      font-size: 24px;
      margin-bottom: 25px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      font-weight: 500;
      color: #444;
    }

    input, select {
      padding: 12px 14px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    input:focus, select:focus {
      border-color: #f53d2d;
      box-shadow: 0 0 0 2px rgba(245,61,45,0.15);
    }

    .gender-group {
      display: flex;
      gap: 15px;
      align-items: center;
    }

    .gender-group label {
      font-weight: 400;
    }

    .btn-primary {
      background: #f53d2d;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 12px;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      transition: background 0.25s;
    }

    .btn-primary:hover {
      background: #d22e1e;
    }

    .login-link {
      text-align: center;
      margin-top: 10px;
    }

    .login-link a {
      color: #f53d2d;
      text-decoration: none;
      font-weight: 500;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>📝 Đăng ký tài khoản</h2>
    <form method="post" action="">
      <label>Họ và tên</label>
      <input type="text" name="hoten" placeholder="Nhập họ tên của bạn" required 
             value="<?= htmlspecialchars($_POST['hoten'] ?? '') ?>">

      <label>Email</label>
      <input type="email" name="email" placeholder="Nhập địa chỉ email" required
             value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

      <label>Mật khẩu</label>
      <input type="password" name="matkhau" placeholder="Tạo mật khẩu" required>

      <label>Số điện thoại</label>
      <input type="text" name="dienthoai" placeholder="Nhập số điện thoại"
             value="<?= htmlspecialchars($_POST['dienthoai'] ?? '') ?>">

      <label>Địa chỉ</label>
      <input type="text" name="diachi" placeholder="Nhập địa chỉ của bạn"
             value="<?= htmlspecialchars($_POST['diachi'] ?? '') ?>">

      <label>Ngày sinh</label>
      <input type="date" name="ngaysinh" required
             value="<?= htmlspecialchars($_POST['ngaysinh'] ?? '') ?>">

      <label>Giới tính</label>
      <div class="gender-group">
        <label><input type="radio" name="gioitinh" value="Nam" <?= (($_POST['gioitinh'] ?? '') == 'Nam') ? 'checked' : '' ?>> Nam</label>
        <label><input type="radio" name="gioitinh" value="Nữ" <?= (($_POST['gioitinh'] ?? '') == 'Nữ') ? 'checked' : '' ?>> Nữ</label>
        <label><input type="radio" name="gioitinh" value="Khác" <?= (($_POST['gioitinh'] ?? '') == 'Khác') ? 'checked' : '' ?>> Khác</label>
      </div>
<?php if (!empty($error)): ?>
  <p style="color: red; text-align: center; font-weight: 500;">
    <?= htmlspecialchars($error) ?>
  </p>
<?php endif; ?>

      <button type="submit" class="btn-primary">Đăng ký ngay</button>

      <div class="login-link">
        Đã có tài khoản? <a href="index.php?action=dangnhap">Đăng nhập</a>
      </div>
    </form>
  </div>
</body>
</html>
