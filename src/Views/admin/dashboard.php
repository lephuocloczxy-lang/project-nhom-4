<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển Quản trị viên</title>
    <!-- Google Font Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Chart.js for graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <!-- Font Awesome cho icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --shopee-orange: #ee4d2d;
            --shopee-light-orange: #ff5733;
            --shopee-gray: #f2f4f6;
            --shopee-dark-gray: #666;
            --color-success: #2ecc71;
            --color-info: #3498db;
            --color-warning: #f1c40f;
            --color-secondary: #95a5a6;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: var(--shopee-gray);
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* === HEADER === */
        header {
            background: var(--shopee-orange);
            color: white;
            padding: 20px 30px;
            font-size: 28px;
            font-weight: 700;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Nút đăng xuất */
        .logout-btn {
            position: absolute;
            right: 30px;
            background: white;
            color: var(--shopee-orange);
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .logout-btn i {
            font-size: 16px;
        }

        .logout-btn:hover {
            background: var(--shopee-light-orange);
            color: white;
        }

        /* === MAIN CONTENT === */
        .main-content {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .stat-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            flex: 1 1 200px;
            padding: 20px;
            border-left: 5px solid;
            transition: transform 0.2s;
        }

        .stat-card:nth-child(1) { border-left-color: var(--shopee-orange); }
        .stat-card:nth-child(2) { border-left-color: var(--color-success); }
        .stat-card:nth-child(3) { border-left-color: var(--color-info); }
        .stat-card:nth-child(4) { border-left-color: var(--color-warning); }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .stat-card h4 {
            font-size: 14px;
            font-weight: 500;
            color: var(--shopee-dark-gray);
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 32px;
            font-weight: 700;
        }

        .stat-card:nth-child(1) .value { color: var(--shopee-orange); }
        .stat-card:nth-child(2) .value { color: var(--color-success); }
        .stat-card:nth-child(3) .value { color: var(--color-info); }
        .stat-card:nth-child(4) .value { color: var(--color-warning); }

        .grid-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .panel {
            background: white;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .panel-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--shopee-orange);
            margin-bottom: 20px;
            border-bottom: 2px solid var(--shopee-gray);
            padding-bottom: 10px;
        }

        .order-list li {
            list-style: none;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        .order-status {
            padding: 3px 8px;
            border-radius: 4px;
            color: white;
            font-size: 12px;
            font-weight: 500;
        }

        .status-confirm { background: var(--shopee-orange); }
        .status-ship { background: var(--color-info); }
        .status-complete { background: var(--color-success); }
        .status-cancel { background: #e74c3c; }

        .admin-button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .admin-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px 15px;
            width: 140px;
            height: 100px;
            transition: all 0.3s ease;
            color: #333;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #ddd;
        }

        .admin-button:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
            border-color: var(--shopee-orange);
            color: var(--shopee-orange);
        }

        .admin-button i {
            font-size: 30px;
            margin-bottom: 8px;
            color: var(--color-secondary);
        }

        .admin-button:hover i {
            color: var(--shopee-orange);
        }

        a.button {
            background: var(--shopee-orange);
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
        }

        a.button:hover {
            background: var(--shopee-light-orange);
        }

        footer {
            text-align: center;
            padding: 15px;
            background: white;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 13px;
            margin-top: 40px;
        }

        @media (max-width: 1000px) {
            .grid-layout { grid-template-columns: 1fr; }
            .admin-button { width: 45%; height: 80px; }
        }

        @media (max-width: 500px) {
            .admin-button { width: 100%; }
        }
    </style>
</head>
<body>

<header>
    Quản Trị Hệ Thống Shopee Mini
    <button class="logout-btn" onclick="window.location.href='admin.php?action=dangxuat'">

        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
    </button>
</header>

<div class="main-content">

    <!-- KHỐI THỐNG KÊ -->
    <div class="stat-container">
        <div class="stat-card"><h4>Tổng Doanh Thu</h4><p class="value">123,456,000đ</p></div>
        <div class="stat-card"><h4>Sản phẩm bán chạy</h4><p class="value">987</p></div>
        <div class="stat-card"><h4>Đơn hàng cần xác nhận</h4><p class="value">42</p></div>
        <div class="stat-card"><h4>Sản phẩm hết hàng</h4><p class="value">15</p></div>
    </div>

    <div class="grid-layout">
        <div class="panel">
            <h2 class="panel-title">Báo Cáo Doanh Thu 6 Tháng Gần Nhất</h2>
            <canvas id="revenueChart"></canvas>
        </div>

        <div class="panel">
            <h2 class="panel-title">🛒 Đơn Hàng Mới Nhất</h2>
            <ul class="order-list" style="padding-left: 0;">
                <li><span>#DH1001 - Khách A</span><span class="order-status status-confirm">Chờ Xác Nhận</span></li>
                <li><span>#DH1000 - Khách B</span><span class="order-status status-ship">Đang Giao</span></li>
                <li><span>#DH0999 - Khách C</span><span class="order-status status-complete">Hoàn Thành</span></li>
                <li><span>#DH0998 - Khách D</span><span class="order-status status-confirm">Chờ Xác Nhận</span></li>
                <li><span>#DH0997 - Khách E</span><span class="order-status status-cancel">Đã Hủy</span></li>
            </ul>
            <div style="text-align: center; margin-top: 20px;">
                <a href="admin.php?action=quanlydonhang" class="button">Xem Tất Cả Đơn Hàng</a>
            </div>
        </div>
    </div>

    <h2 class="panel-title" style="text-align:center;margin:40px 0 20px;">🧩 Quản Lý Chức Năng Chính</h2>

    <div class="admin-button-container">
        <a href="admin.php?action=quanlytaikhoan" class="admin-button"><i class="fa-solid fa-users"></i><span>Quản lý Người Dùng</span></a>
        <a href="admin.php?action=quanlysanpham" class="admin-button"><i class="fa-solid fa-box-open"></i><span>Quản lý Sản Phẩm</span></a>
        <a href="admin.php?action=quanlydonhang" class="admin-button"><i class="fa-solid fa-receipt"></i><span>Quản lý Đơn Hàng</span></a>
        <a href="admin.php?action=quanlykhachhang" class="admin-button"><i class="fa-solid fa-user-tag"></i><span>Quản lý Khách hàng</span></a>
        <a href="admin.php?controller=khuyenmai" class="admin-button"><i class="fa-solid fa-gift"></i><span>Quản lý Khuyến mãi</span></a>
        <a href="admin.php?action=quanlydanhgia" class="admin-button"><i class="fa-solid fa-star"></i><span>Quản lý Đánh giá</span></a>
        <a href="admin.php?action=quanlyvanchuyen" class="admin-button"><i class="fa-solid fa-truck"></i><span>Vận chuyển & Thanh toán</span></a>
        <a href="admin.php?action=quanlycms" class="admin-button"><i class="fa-solid fa-newspaper"></i><span>Quản lý Nội dung (CMS)</span></a>
        <a href="admin.php?action=thongke" class="admin-button"><i class="fa-solid fa-chart-line"></i><span>Thống kê & Báo cáo</span></a>
    </div>

</div>

<footer>© <?= date('Y') ?> Hệ thống Quản Trị Shopee Mini | Phiên bản Admin</footer>

<script>
// function createRevenueChart() {
//     const ctx = document.getElementById('revenueChart').getContext('2d');
//     const labels = ['T5/25', 'T6/25', 'T7/25', 'T8/25', 'T9/25', 'T10/25'];
//     const data = [150, 180, 120, 220, 250, 300];
//     new Chart(ctx, {
//         type: 'line',
//         data: {
//             labels: labels,
//             datasets: [{
//                 label: 'Doanh thu (Triệu VNĐ)',
//                 data: data,
//                 backgroundColor: 'rgba(238,77,45,0.2)',
//                 borderColor: 'rgba(238,77,45,1)',
//                 borderWidth: 3,
//                 tension: 0.3,
//                 fill: true,
//                 pointBackgroundColor: 'white',
//                 pointBorderColor: 'rgba(238,77,45,1)',
//                 pointBorderWidth: 2,
//                 pointRadius: 5
//             }]
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             scales: { y: { beginAtZero: true, title: { display: true, text: 'Triệu VNĐ' } } },
//             plugins: { legend: { display: false } }
//         }
//     });
// }
window.onload = createRevenueChart;
</script>

</body>
</html>
