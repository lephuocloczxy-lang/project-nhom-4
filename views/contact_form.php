<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>📩 Liên hệ - Hệ thống quản lý sinh viên</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #007bff;
      --secondary: #00c6ff;
      --success: #28a745;
      --danger: #dc3545;
      --bg-light: #ffffff;
      --radius: 12px;
      --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      margin: 0;
      padding: 40px 0;
      display: flex;
      justify-content: center;
      min-height: 100vh;
      color: #333;
    }

    .wrapper {
      width: 90%;
      max-width: 1100px;
      background: var(--bg-light);
      border-radius: 16px;
      box-shadow: var(--shadow);
      overflow: hidden;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(15px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      color: white;
      padding: 10px 24px;
      font-size: 15px;
    }

    .top-bar strong {
      color: #fff;
    }

    .top-buttons a {
      margin-left: 10px;
      padding: 6px 14px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      color: #fff;
      transition: 0.3s;
    }

    .btn-change {
      background-color: var(--success);
    }
    .btn-change:hover {
      background-color: #218838;
    }

    .btn-logout {
      background-color: var(--danger);
    }
    .btn-logout:hover {
      background-color: #c82333;
    }

    header {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      text-align: center;
      padding: 28px 20px;
    }

    header h1 {
      font-size: 28px;
      margin: 0;
      text-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    nav {
      display: flex;
      justify-content: center;
      background: #0091ff;
      padding: 10px 0;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      padding: 10px 25px;
      transition: 0.3s;
      position: relative;
    }

    nav a.active::after {
      content: "";
      position: absolute;
      bottom: 5px;
      left: 25%;
      width: 50%;
      height: 3px;
      background: yellow;
      border-radius: 3px;
    }

    nav a:hover {
      opacity: 0.8;
    }

    .content {
      padding: 40px;
      text-align: center;
    }

    .content h2 {
      color: var(--primary);
      font-size: 22px;
      margin-bottom: 30px;
    }

    /* === FORM LIÊN HỆ === */
    form {
      max-width: 500px;
      margin: 0 auto;
      background: #f9f9f9;
      padding: 30px 35px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      text-align: left;
    }

    form label {
      font-weight: 600;
      display: block;
      margin-bottom: 6px;
      color: #333;
    }

    form input, form textarea {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 18px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      transition: 0.2s;
    }

    form input:focus, form textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
      outline: none;
    }

    form button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      color: white;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    form button:hover {
      transform: scale(1.03);
      opacity: 0.95;
    }

    footer {
      text-align: center;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      color: white;
      padding: 12px;
      font-size: 14px;
      font-weight: 500;
    }

  </style>
</head>
<body>
 <div class="wrapper">
    <div class="top-bar">
      <div>Xin chào, <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Khách'); ?></strong></div>
      <div class="top-buttons">
        <a href="index.php?action=change_password" class="btn-change">Đổi mật khẩu</a>
        <a href="index.php?action=logout" class="btn-logout">Đăng xuất</a>
      </div>
    </div>

    <!-- Header -->
    <header>
      <h1>🎓 Hệ thống quản lý sinh viên</h1>
    </header>

    <!-- Menu -->
 <nav>
      <a href="index.php?action=home" class="<?= isActive('home', $current) ?>">Trang chủ</a>
      <a href="index.php?action=stats" class="<?= isActive('stats', $current) ?>">Thống kê</a>
      <a href="index.php?action=contact" class="<?= isActive('contact', $current) ?>">Liên hệ</a>
       <a href="index.php?action=active" class="<?= isActive('active', $current) ?>">Nhật ký</a>
    </nav>

    <!-- Nội dung -->
    <div class="content">
      <h2>📬 Gửi liên hệ / phản hồi</h2>

      <form action="index.php?action=send_contact" method="POST">
        <label for="name">Họ và tên</label>
        <input type="text" id="name" name="name" placeholder="Nhập họ và tên của bạn" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required>

        <label for="subject">Tiêu đề</label>
        <input type="text" id="subject" name="subject" placeholder="Nhập tiêu đề liên hệ" required>

        <label for="message">Nội dung</label>
        <textarea id="message" name="message" rows="5" placeholder="Nhập nội dung bạn muốn gửi..." required></textarea>

        <button type="submit">Gửi liên hệ</button>
      </form>
    </div>
  </div>
</body>
</html>
