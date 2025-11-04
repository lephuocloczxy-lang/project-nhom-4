<!DOCTYPE html>
<html lang="vi">
<head>
<<<<<<< HEAD
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  
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

    /* CSS MỚI CHO TÍNH NĂNG CON MẮT */
    .password-wrapper {
      position: relative; /* Bắt buộc để định vị icon */
    }

    input {
      width: 100%; /* Đảm bảo input chiếm hết chiều rộng */
      padding: 12px 14px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      box-sizing: border-box; /* Quan trọng để padding không làm tăng chiều rộng */
    }

    /* Sửa lại padding cho ô mật khẩu để chừa chỗ cho con mắt */
    .password-wrapper input {
      padding-right: 40px; 
    }

    input:focus {
      border-color: #f53d2d;
      box-shadow: 0 0 0 2px rgba(245,61,45,0.15);
    }
    
    /* ĐỊNH VỊ VÀ TẠO KIỂU CHO ICON CON MẮT */
    #toggle-password {
      position: absolute;
      top: 50%;
      right: 15px; /* Khoảng cách từ lề phải */
      transform: translateY(-50%); /* Căn giữa hoàn hảo */
      cursor: pointer;
      color: #aaa;
      z-index: 10;
    }

    #toggle-password:hover {
      color: #f53d2d;
    }
    
    /* ... (Giữ nguyên các style khác) ... */
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
=======
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
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
</head>
<body>
  <div class="form-container">
    <h2>🔑 Đăng nhập</h2>
<<<<<<< HEAD

    <form method="post" action="">
      <input 
        name="email" 
        type="email" 
        placeholder="Nhập email của bạn" 
        required 
        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
      >

      <div class="password-wrapper">
        <input 
          name="matkhau" 
          type="password" 
          id="matkhau" 
          placeholder="Nhập mật khẩu" 
          required
        >
        <i class="fa-solid fa-eye-slash" id="toggle-password"></i>
      </div>
=======
    <form method="post">
      <input name="email" type="email" placeholder="Nhập email của bạn" required>
      <input name="matkhau" type="password" placeholder="Nhập mật khẩu" required>
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618

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
<<<<<<< HEAD

  <script>
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('matkhau'); // Dùng ID này

    togglePassword.addEventListener('click', function () {
        // Thay đổi type của input (password <-> text)
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Thay đổi icon (mắt đóng <-> mắt mở)
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>
=======
</body>
</html>
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
