<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quên mật khẩu</title>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 0;
  }

  .form-container {
    max-width: 420px;
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

  .msg {
    text-align: center;
    font-weight: 500;
    margin-top: 10px;
    color: #333;
  }

  .back-link {
    display: block;
    text-align: center;
    margin-top: 15px;
    text-decoration: none;
    color: #f53d2d;
    font-weight: 500;
  }

  .back-link:hover {
    text-decoration: underline;
  }

</style>
</head>
<body>
  <div class="form-container">
    <h2>🔐 Quên mật khẩu</h2>
    <form method="post">
      <input type="email" name="email" placeholder="Nhập email của bạn" required>
      <input type="password" name="matkhaumoi" placeholder="Nhập mật khẩu mới" required>
      <input type="password" name="nhaplai" placeholder="Nhập lại mật khẩu mới" required>
      <button type="submit" class="btn-primary">Cập nhật mật khẩu</button>
    </form>

    <?php if (!empty($message)): ?>
      <p class="msg"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <a href="index.php?action=dangnhap" class="back-link">← Quay lại đăng nhập</a>
  </div>
</body>
</html>
