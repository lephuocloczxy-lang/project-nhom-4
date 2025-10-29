<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🎓 Quản lý sinh viên</title>

<style>
:root {
    --main-color: #0061f2;
    --accent-color: #1cc88a;
    --danger-color: #e74a3b;
    --bg-gradient: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    --card-bg: #ffffff;
    --radius: 12px;
    --shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

/* ==== Tổng thể ==== */
body {
    font-family: "Poppins", "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    margin: 0;
    padding: 40px 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    color: #333;
}

/* ==== Khung chính ==== */
.container {
    width: 90%;
    max-width: 1200px;
    background: var(--card-bg);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    animation: fadeIn 0.6s ease;
    backdrop-filter: blur(6px);
}

/* ==== Thanh chào mừng ==== */
.top-bar {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 18px 40px;
    background: rgba(255, 255, 255, 0.9);
    border-bottom: 1px solid #e0e0e0;
    font-size: 15px;
}

.top-bar strong {
    color: var(--main-color);
}

.logout-btn {
    margin-left: 15px;
    background: linear-gradient(to right, var(--main-color), var(--accent-color));
    color: #fff;
    padding: 8px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 3px 10px rgba(0, 97, 242, 0.3);
    transition: all 0.3s ease;
}

.logout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 97, 242, 0.4);
}

/* ==== Header ==== */
header {
    background: linear-gradient(135deg, var(--main-color), #00b4d8);
    color: #fff;
    text-align: center;
    padding: 40px 20px;
}

header h1 {
    margin: 0;
    font-size: 32px;
    letter-spacing: 0.5px;
    text-shadow: 0 3px 8px rgba(0, 0, 0, 0.25);
}

/* ==== Thông báo ==== */
.alert {
    margin: 20px auto 0;
    width: 90%;
    max-width: 800px;
    padding: 14px 18px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 500;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    animation: fadeIn 0.5s ease;
}
.alert.success {
    background-color: #e8f9ee;
    border: 1px solid #b6dfc5;
    color: #0f5132;
}
.alert.error {
    background-color: #fdecea;
    border: 1px solid #f5c2c7;
    color: #d8000c;
}

/* ==== Thanh tìm kiếm ==== */
.search-section {
    padding: 30px 50px 10px 50px;
    text-align: center;
}

.search-section h2 {
    font-size: 22px;
    color: var(--main-color);
    margin-bottom: 20px;
}

.search-box {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 12px;
}

.search-box input {
    width: 350px;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: var(--radius);
    font-size: 15px;
    background: #fafafa;
    transition: all 0.3s ease;
}

.search-box input:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 4px rgba(28,200,138,0.2);
    outline: none;
    background: #fff;
}

.search-box button,
.search-box a {
    background: var(--accent-color);
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: var(--radius);
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 3px 10px rgba(28,200,138,0.2);
}

.search-box button:hover,
.search-box a:hover {
    background: #17a673;
    transform: translateY(-1px);
}

/* ==== Form thêm sinh viên ==== */
form.add-form {
    padding: 30px 50px;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
    align-items: center;
}

form.add-form h3 {
    grid-column: 1 / -1;
    text-align: center;
    color: var(--main-color);
    font-size: 20px;
    margin-bottom: 5px;
}

.add-form input {
    padding: 12px 15px;
    font-size: 15px;
    border-radius: var(--radius);
    border: 1px solid #ccc;
    transition: all 0.3s ease;
}

.add-form input:focus {
    border-color: var(--main-color);
    box-shadow: 0 0 0 3px rgba(78,115,223,0.15);
    outline: none;
}

.add-form button {
    grid-column: 1 / -1; /* chiếm toàn bộ hàng trong grid */
    justify-self: center; /* căn giữa nút theo chiều ngang */
    background: var(--main-color);
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: var(--radius);
    font-size: 20px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.add-form button:hover {
    background: #0049c7;
    transform: translateY(-1px);
}
/* ==== Bảng sinh viên ==== */
.table-section {
    padding: 35px 50px;
}

.table-section h2 {
    text-align: center;
    color: var(--main-color);
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-radius: var(--radius);
    overflow: hidden;
    font-size: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

th {
    background: var(--main-color);
    color: white;
    padding: 14px;
    text-align: left;
    font-weight: 600;
}

td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}

tr:nth-child(even) {
    background: #f9fbff;
}

tr:hover {
    background: #eef4ff;
}

/* ==== Nút hành động ==== */
a.edit, a.delete {
    padding: 7px 12px;
    border-radius: 6px;
    color: white;
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s;
}

a.edit { background: var(--accent-color); }
a.delete { background: var(--danger-color); }

a.edit:hover { background: #17a673; }
a.delete:hover { background: #c0392b; }

/* ==== Phân trang ==== */
.pagination {
    text-align: center;
    padding: 20px 0 40px;
}

.pagination a {
    display: inline-block;
    margin: 0 5px;
    padding: 8px 14px;
    background: #e9ecef;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    font-weight: 500;
    transition: all 0.3s;
}

.pagination a.active {
    background: var(--main-color);
    color: #fff;
}

.pagination a:hover {
    background: var(--accent-color);
    color: #fff;
}

/* ==== Hiệu ứng ==== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
/* ==== Nhóm nút phụ ==== */
.action-buttons {
    grid-column: 1 / -1;
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 10px;
}

.stats-link, .contact-link {
    display: inline-block;
    background: linear-gradient(135deg, #1cc88a, #00c6ff);
    color: #fff;
    padding: 10px 26px;
    border-radius: var(--radius);
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 3px 10px rgba(0, 198, 255, 0.3);
    transition: all 0.3s ease;
}

.contact-link {
    background: linear-gradient(135deg, #0061f2, #00b4d8);
    box-shadow: 0 3px 10px rgba(0, 97, 242, 0.25);
}

.stats-link:hover, .contact-link:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}
table a {
    color: inherit; /* kế thừa màu chữ tự nhiên của bảng */
    text-decoration: none;
    font-weight: normal;
}
table a:hover {
    text-decoration: underline;
}
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(90deg, #007bff, #00c6ff);
    color: white;
    padding: 14px 30px;
    border-radius: 10px;
    font-size: 16px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
.export-link {
    background: linear-gradient(135deg, #28a745, #00d084);
    color: #fff;
    padding: 10px 26px;
    border-radius: var(--radius);
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 3px 10px rgba(40, 167, 69, 0.3);
    transition: all 0.3s ease;
}

.export-link:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}


/* --- Thanh trên cùng --- */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(90deg, #007bff, #00c6ff);
    color: white;
    padding: 12px 24px;
    border-radius: 10px;
    font-size: 16px;
}

/* --- Khối bên trái: Chào mừng + tên --- */
.user-info {
    flex: 1;
    text-align: left; /* căn giữa toàn dòng */
    font-weight: 500;
    color: #ffffff;
    letter-spacing: 0.3px;
    display: inline-block;
}

.user-info strong {
    color: #ffffff;
    font-weight: 600;
    margin-left: 4px; /* cách nhẹ giữa chữ và tên */
}

/* --- Các nút bên phải --- */
.top-buttons a {
    margin-left: 10px;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s;
}

.btn-change {
    background-color: #28a745;
    color: white;
}
.btn-change:hover {
    background-color: #218838;
}

.logout-btn {
    background-color: #dc3545;
    color: white;
}
.logout-btn:hover {
    background-color: #c82333;
}
/* ==== Menu điều hướng ==== */
.navbar {
    display: flex;
    justify-content: center;
    gap: 30px;
    background: linear-gradient(90deg, #007bff, #00c6ff);
    padding: 12px 0;
    font-size: 17px;
    font-weight: 600;
    border-bottom: 2px solid #e3e6f0;
}

.navbar a {
    color: white;
    text-decoration: none;
    position: relative;
    transition: 0.3s;
}

.navbar a.active::after {
    content: "";
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 100%;
    height: 3px;
    background: yellow;
    border-radius: 2px;
}

</style>
</head>

<body>
    <?php
$current = $_GET['action'] ?? 'home';
function isActive($page, $current) {
    return $page === $current ? 'active' : '';
}
?>
    <div class="container">
        <div class="top-bar">
           <div class="user-info">
        Xin chào, <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Khách'); ?></strong>
    </div>
            <div class="top-buttons">
                <a href="index.php?action=change_password" class="btn-change">Đổi mật khẩu</a>
                <a href="index.php?action=logout" class="logout-btn">Đăng xuất</a>
            </div>
        </div>
        <header><h1>🎓 Hệ thống quản lý sinh viên</h1></header>
<!-- MENU ĐIỀU HƯỚNG -->
<nav class="navbar">
    <a href="index.php?action=home" class="<?= isActive('home', $current) ?>">Trang chủ</a>
    <a href="index.php?action=stats" class="<?= isActive('stats', $current) ?>">Thống kê</a>
    <a href="index.php?action=contact" class="<?= isActive('contact', $current) ?>">Liên hệ</a>
    <a href="index.php?action=active" class="<?= isActive('active', $current) ?>">Nhật ký</a>
</nav>

        <!-- THÔNG BÁO -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert success"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php elseif (!empty($_SESSION['error'])): ?>
            <div class="alert error"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Thanh tìm kiếm -->
        <div class="search-section">
            <h2>
                <?= isset($keyword) && $keyword
                    ? "🔍 Kết quả tìm kiếm cho: <span style='color: var(--accent-color);'>'" . htmlspecialchars($keyword) . "'</span>"
                    : "📘 Danh sách sinh viên"; ?>
            </h2>

            <form action="index.php" method="GET" class="search-box">
    <input 
        type="text" 
        name="keyword" 
        placeholder="🔎 Tìm kiếm theo tên, email, sđt..." 
        value="<?= htmlspecialchars($keyword ?? ''); ?>">
    
    <button type="submit" class="btn-main">🔍 Tìm kiếm</button>
    <a href="index.php" class="btn-reset">🔄 Làm mới</a>
    <a href="index.php?action=export_csv" class="btn-export">📤 Xuất CSV</a>
</form>

        </div>

<!-- Form thêm sinh viên -->
<form action="index.php?action=add" method="POST" class="add-form" enctype="multipart/form-data">
    <h3>➕ Thêm sinh viên mới</h3>
    <input type="text" name="name" placeholder="Họ và tên" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Số điện thoại" required>
    <input type="file" name="avatar" accept="image/*">

    <!-- Nút chính -->
    <button type="submit">Thêm sinh viên</button>
</form>
<?php
// ====== Lấy các giá trị sort / order hiện tại ======
$sort = $_GET['sort'] ?? 'id';
$order = $_GET['order'] ?? 'desc';
$toggleOrder = ($order === 'asc') ? 'desc' : 'asc';
$keyword = $_GET['keyword'] ?? '';
?>
<!-- Bảng danh sách sinh viên -->
<div class="table-section">
    <h2>📋 Danh sách sinh viên</h2>
    <table>
        <thead>
            <tr>
                <th>
                    <a href="index.php?action=index&sort=id&order=<?= $toggleOrder ?>&keyword=<?= urlencode($keyword) ?>">
                        ID <?= $sort === 'id' ? ($order === 'asc' ? '↑' : '↓') : '' ?>
                    </a>
                </th>
                <th>Ảnh</th>
                <th>
                    <a href="index.php?action=index&sort=name&order=<?= $toggleOrder ?>&keyword=<?= urlencode($keyword) ?>">
                        Họ và tên <?= $sort === 'name' ? ($order === 'asc' ? '↑' : '↓') : '' ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?action=index&sort=email&order=<?= $toggleOrder ?>&keyword=<?= urlencode($keyword) ?>">
                        Email <?= $sort === 'email' ? ($order === 'asc' ? '↑' : '↓') : '' ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?action=index&sort=phone&order=<?= $toggleOrder ?>&keyword=<?= urlencode($keyword) ?>">
                        Số điện thoại <?= $sort === 'phone' ? ($order === 'asc' ? '↑' : '↓') : '' ?>
                    </a>
                </th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($students)): ?>
                <?php foreach ($students as $sv): ?>
                    <tr>
                        <td><?= htmlspecialchars($sv['id']); ?></td>
                        <td>
                            <?php if (!empty($sv['avatar'])): ?>
                                <img src="uploads/<?= htmlspecialchars($sv['avatar']); ?>" 
                                     alt="Ảnh" width="50" height="50"
                                     style="border-radius: 50%; object-fit: cover;">
                            <?php else: ?>
                                <img src="uploads/default.png" 
                                     alt="Mặc định" width="50" height="50"
                                     style="border-radius: 50%; object-fit: cover;">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?action=detail&id=<?= $sv['id'] ?>">
                                <?= htmlspecialchars($sv['name']); ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($sv['email']); ?></td>
                        <td><?= htmlspecialchars($sv['phone']); ?></td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $sv['id']; ?>" class="edit">Sửa</a>
                            <a href="index.php?action=delete&id=<?= $sv['id']; ?>" class="delete"
                               onclick="return confirm('Xóa sinh viên này?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;">Chưa có sinh viên nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
        <!-- Phân trang -->
        <div class="pagination">
            <?php if ($totalPages > 1): ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?keyword=<?= urlencode($keyword ?? ''); ?>&page=<?= $i; ?>" class="<?= ($i == $currentPage) ? 'active' : ''; ?>">
                        <?= $i; ?>
                    </a>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) alert.style.display = 'none';
    }, 3000);
    </script>
</body>
</html>
