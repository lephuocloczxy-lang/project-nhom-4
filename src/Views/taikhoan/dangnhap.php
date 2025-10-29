<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đăng nhập</title>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 0;
  }

  .form-container {
    max-width: 400px;
    margin: 80px auto;
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

  input {
    padding: 12px 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 15px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  input:focus {
    border-color: #f53d2d;
    box-shadow: 0 0 0 2px rgba(245,61,45,0.15);
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

  .error-msg {
    color: #d22e1e;
    text-align: center;
    margin-top: 10px;
    font-weight: 500;
  }

  .link-group {
    text-align: center;
    margin-top: 12px;
    font-size: 15px;
  }

  .link-group a {
    color: #f53d2d;
    text-decoration: none;
    font-weight: 500;
  }

  .link-group a:hover {
    text-decoration: underline;
  }

  .forgot-password {
    text-align: right;
    font-size: 14px;
    margin-top: -8px;
  }

  .forgot-password a {
    color: #888;
    text-decoration: none;
  }

  .forgot-password a:hover {
    color: #f53d2d;
  }

</style>
</head>
<body>
  <div class="form-container">
    <h2>🔑 Đăng nhập</h2>
    <form method="post">
      <input name="email" type="email" placeholder="Nhập email của bạn" required>
      <input name="matkhau" type="password" placeholder="Nhập mật khẩu" required>

      <div class="forgot-password">
        <a href="index.php?action=quenmatkhau">Quên mật khẩu?</a>
      </div>

      <button type="submit" class="btn-primary">Đăng nhập</button>
    </form>

    <?php if (!empty($error)): ?>
      <p class="error-msg"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="link-group">
      Chưa có tài khoản? <a href="index.php?action=dangky">Đăng ký ngay</a>
    </div>
  </div>
</body>
</html>
