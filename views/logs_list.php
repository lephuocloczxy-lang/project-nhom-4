<?php
// Hàm đánh dấu menu đang chọn
function isActive($name, $current) {
  return $name === $current ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>📜 Nhật ký hoạt động người dùng</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #007bff;
      --secondary: #00c6ff;
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
      border-radius: var(--radius);
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

    .top-bar strong { color: #fff; }

    .top-buttons a {
      margin-left: 10px;
      padding: 6px 14px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      color: #fff;
      transition: 0.3s;
    }

    .btn-change { background-color: #28a745; }
    .btn-change:hover { background-color: #218838; }

    .btn-logout { background-color: #dc3545; }
    .btn-logout:hover { background-color: #c82333; }

    header {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      text-align: center;
      padding: 28px 20px;
    }

    header h1 {
      font-size: 26px;
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

    nav a:hover { opacity: 0.85; }

    .content {
      padding: 40px;
    }

    .content h2 {
      text-align: center;
      color: var(--primary);
      margin-bottom: 30px;
      font-size: 22px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: var(--shadow);
    }

    th, td {
      padding: 12px 16px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    th {
      background-color: var(--primary);
      color: #fff;
      font-weight: 600;
      font-size: 15px;
    }

    tr:hover { background-color: #eef6ff; }
    tr:last-child td { border-bottom: none; }

    .no-data {
      text-align: center;
      padding: 20px;
      color: #777;
      font-style: italic;
    }

    .back {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 22px;
      background: var(--primary);
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      transition: 0.3s;
    }

    .back:hover { background: #0056b3; }
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

  <header>
    <h1>📜 Nhật ký hoạt động người dùng</h1>
  </header>

  <nav>
    <a href="index.php?action=home" class="<?= isActive('home', $current) ?>">Trang chủ</a>
    <a href="index.php?action=stats" class="<?= isActive('stats', $current) ?>">Thống kê</a>
    <a href="index.php?action=contact" class="<?= isActive('contact', $current) ?>">Liên hệ</a>
    <a href="index.php?action=active" class="<?= isActive('active', $current) ?>">Nhật ký</a>
  </nav>

  <div class="content">
    <?php if (!empty($logs)): ?>
      <table>
        <thead>
          <tr>
            <th>User ID</th>
            <th>Hành động</th>
            <th>Ngày tạo</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($logs as $log): ?>
            <tr>
              <td><?= htmlspecialchars($log['user_id']) ?></td>
              <td><?= htmlspecialchars($log['action']) ?></td>
              <td><?= htmlspecialchars($log['created_at']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="no-data">Không có dữ liệu log</div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
