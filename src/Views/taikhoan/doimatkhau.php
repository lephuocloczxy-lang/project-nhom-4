<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đổi mật khẩu</title>
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
    padding: 30px 35px;
  }

  h2 {
    color: #f53d2d;
    text-align: center;
    margin-bottom: 25px;
    font-size: 24px;
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
    font-weight: 600;
    border: none;
    border-radius: 8px;
    padding: 12px;
    cursor: pointer;
    transition: background 0.2s;
  }

  .btn-primary:hover {
    background: #d22e1e;
  }

  .back-link {
    text-align: center;
    display: block;
    margin-top: 10px;
    color: #f53d2d;
    text-decoration: none;
    font-weight: 500;
  }

  .back-link:hover {
    text-decoration: underline;
  }

  .msg {
    text-align: center;
    font-weight: 500;
    margin-top: 15px;
    padding: 10px;
    border-radius: 6px;
  }

  .msg.success { background: #e8f9f1; color: #1e7e34; border: 1px solid #b2f0cd; }
  .msg.error { background: #fdecea; color: #a71d2a; border: 1px solid #f5c2c7; }
  .msg.warning { background: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
</style>
</head>
<body>
  <div class="form-container">
    <h2>🔒 Đổi mật khẩu</h2>

    <!-- ✅ Form gửi lại chính trang -->
    <form method="post" action="" autocomplete="off">
      <input type="password" name="matkhaucu" placeholder="Nhập mật khẩu cũ" required>
      <input type="password" name="matkhaumoi" placeholder="Nhập mật khẩu mới" required>
      <input type="password" name="nhaplai" placeholder="Nhập lại mật khẩu mới" required>

      <button type="submit" class="btn-primary">💾 Cập nhật mật khẩu</button>
      <a href="index.php?action=hoso" class="back-link">← Quay lại hồ sơ</a>
    </form>

    <!-- ✅ Hiển thị thông báo -->
    <?php if (!empty($message)): ?>
      <?php
        $class = 'msg';
        if (strpos($message, '✅') !== false) $class .= ' success';
        elseif (strpos($message, '⚠️') !== false) $class .= ' warning';
        else $class .= ' error';
      ?>
      <p class="<?= $class ?>"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
