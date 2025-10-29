<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Xác định trang hiện tại (action trong URL)
$current = $_GET['action'] ?? 'home';

// Hàm set class active
function isActive($page, $current) {
    return $page === $current ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống quản lý sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #00c6ff, #0072ff);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        nav {
            background-color: #007bff;
            color: white;
            padding: 8px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .left a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-weight: 600;
        }
        nav .left a.active {
            border-bottom: 2px solid yellow;
        }
        nav .right span {
            margin-right: 15px;
        }
        nav .btn {
            font-size: 14px;
            padding: 4px 10px;
            margin-left: 5px;
        }
    </style>
</head>
<body>

<nav>
    <div class="left">
        <a href="index.php?action=home" class="<?= isActive('home', $current) ?>">Trang chủ</a>
        <a href="index.php?action=stats" class="<?= isActive('stats', $current) ?>">Thống kê</a>
        <a href="index.php?action=contact" class="<?= isActive('contact', $current) ?>">Liên hệ</a>
        <a href="index.php?action=export_csv" class="<?= isActive('export_csv', $current) ?>">Xuất CSV</a>
    </div>
    <div class="right">
        <?php if (!empty($_SESSION['user_name'])): ?>
            <span>Xin chào, <strong><?= htmlspecialchars($_SESSION['user_name']); ?></strong></span>
            <a href="index.php?action=doimatkhau" class="btn btn-success btn-sm">Đổi mật khẩu</a>
            <a href="index.php?action=logout" class="btn btn-primary btn-sm">Đăng xuất</a>
        <?php else: ?>
            <a href="index.php?action=dangnhap" class="btn btn-light btn-sm">Đăng nhập</a>
        <?php endif; ?>
    </div>
</nav>
