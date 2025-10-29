<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>📊 Thống kê sinh viên</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    .stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 24px;
      margin-bottom: 40px;
    }

    .card {
      background: #f9f9f9;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 24px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
    }

    .card h3 {
      margin-bottom: 10px;
      color: #007bff;
      font-size: 18px;
    }

    .card p {
      font-size: 26px;
      font-weight: 700;
      color: #333;
    }

    /* ==== Biểu đồ ==== */
    .chart-container {
      background: #fff;
      padding: 20px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      max-width: 700px;
      margin: 0 auto 40px;
    }

    canvas {
      width: 100%;
      height: 400px;
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

    .back:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
<?php
$current = $_GET['action'] ?? 'stats';
function isActive($page, $current) {
  return $page === $current ? 'active' : '';
}

// Dữ liệu thống kê mẫu (nếu chưa có $stats)
$stats = $stats ?? [
  'total' => 120,
  'gmail_count' => 85,
  'phone_09_count' => 40
];
?>

  <div class="wrapper">
    <div class="top-bar">
      <div>Xin chào, <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Khách'); ?></strong></div>
      <div class="top-buttons">
        <a href="index.php?action=change_password" class="btn-change">Đổi mật khẩu</a>
        <a href="index.php?action=logout" class="btn-logout">Đăng xuất</a>
      </div>
    </div>

    <header>
      <h1>🎓 Hệ thống quản lý sinh viên</h1>
    </header>

    <nav>
      <a href="index.php?action=home" class="<?= isActive('home', $current) ?>">Trang chủ</a>
      <a href="index.php?action=stats" class="<?= isActive('stats', $current) ?>">Thống kê</a>
      <a href="index.php?action=contact" class="<?= isActive('contact', $current) ?>">Liên hệ</a>
       <a href="index.php?action=active" class="<?= isActive('active', $current) ?>">Nhật ký</a>
    </nav>

    <div class="content">
      <h2>📊 Thống kê sinh viên</h2>

      <div class="stats">
        <div class="card">
          <h3>Tổng số sinh viên</h3>
          <p><?= $stats['total'] ?? 0; ?></p>
        </div>
        <div class="card">
          <h3>Dùng Gmail</h3>
          <p><?= $stats['gmail_count'] ?? 0; ?></p>
        </div>
        <div class="card">
          <h3>Số điện thoại</h3>
          <p><?= $stats['phone_09_count'] ?? 0; ?></p>
        </div>
      </div>

      <!-- Biểu đồ thống kê -->
      <div class="chart-container">
        <canvas id="studentChart"></canvas>
      </div>

      <a href="index.php?action=home" class="back">⬅ Quay lại trang chủ</a>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('studentChart').getContext('2d');
    const studentChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Tổng SV', 'Dùng Gmail', 'SĐT'],
        datasets: [{
          label: 'Số lượng',
          data: [
            <?= $stats['total'] ?? 0; ?>,
            <?= $stats['gmail_count'] ?? 0; ?>,
            <?= $stats['phone_09_count'] ?? 0; ?>
          ],
          backgroundColor: ['#007bff', '#00c6ff', '#28a745'],
          borderRadius: 8
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          title: {
            display: true,
            text: 'Biểu đồ thống kê sinh viên',
            font: { size: 18 }
          }
        },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  </script>
</body>
</html>
