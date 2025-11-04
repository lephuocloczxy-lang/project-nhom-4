<?php
// Dữ liệu giả định để tránh lỗi PHP khi chạy độc lập
$list = $list ?? [
    ['id' => 1, 'ten' => 'Giảm 20% cho Đơn hàng đầu', 'ma' => 'HELLO20', 'loai_giam' => 'Phần trăm', 'gia_tri' => '20%', 'dieu_kien' => 'Tối thiểu 100k', 'ngay_bat_dau' => '2025-11-01', 'ngay_ket_thuc' => '2025-11-30'],
    ['id' => 2, 'ten' => 'Miễn phí vận chuyển', 'ma' => 'FREESHIP0', 'loai_giam' => 'VND', 'gia_tri' => '15k', 'dieu_kien' => 'Tối thiểu 50k', 'ngay_bat_dau' => '2025-10-01', 'ngay_ket_thuc' => '2025-12-31'],
    ['id' => 3, 'ten' => 'Flash Sale 50%', 'ma' => 'FLASH50', 'loai_giam' => 'Phần trăm', 'gia_tri' => '50%', 'dieu_kien' => 'Áp dụng cho A', 'ngay_bat_dau' => '2025-11-04', 'ngay_ket_thuc' => '2025-11-04'],
];
$page = $page ?? 1;
$totalPages = $totalPages ?? 3;
$offset = $offset ?? 0;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>🎁 Quản lý khuyến mãi & Mã giảm giá | Shopee Mini Admin</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    /* ===================== RESET & GLOBAL ===================== */
    * {
        margin: 0; padding: 0; box-sizing: border-box;
    }
    body {
        font-family: 'Segoe UI', Tahoma, sans-serif;
        background-color: #f6f7f9;
        color: #333;
    }
    a { text-decoration: none; }

    /* ===================== HEADER ===================== */
    header {
        /* Màu giống Shopee */
        background: #ee4d2d; 
        color: #fff;
        padding: 18px 0;
        text-align: center;
        font-size: 22px;
        font-weight: 600;
        letter-spacing: 0.3px;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    /* ===================== CONTAINER (WHITE BOX) ===================== */
    .content-wrapper {
        /* Wrapper chứa tất cả nội dung trừ Header và Footer */
        width: 90%;
        max-width: 1100px;
        margin: 30px auto;
    }
    .container {
        /* Khung trắng như hình mẫu */
        background: #fff;
        border-radius: 8px; /* Giảm nhẹ bo góc */
        padding: 25px 30px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1); /* Shadow nhẹ hơn */
        animation: fadeIn 0.4s ease-in-out;
        margin: 0 auto; /* Đảm bảo căn giữa */
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* TIÊU ĐỀ GIỮA KHUNG TRẮNG */
    h2 {
        text-align: center;
        /* Đổi màu thành đen */
        color: #333; 
        font-size: 20px; /* Nhỏ hơn một chút */
        font-weight: 600;
        margin-bottom: 25px;
        /* Thêm icon và padding để giống hình mẫu */
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    h2 i {
        color: #ee4d2d; /* Icon màu cam */
    }

    /* ===================== TOP TOOLBAR (Giữ nguyên) ===================== */
    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }
    .search-box {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .search-input {
        padding: 9px 14px;
        border-radius: 4px; /* Giảm nhẹ bo góc */
        border: 1px solid #ddd;
        font-size: 14px;
        min-width: 260px;
        transition: 0.2s;
    }
    .search-input:focus {
        border-color: #ee4d2d;
        box-shadow: 0 0 3px rgba(238,77,45,0.3);
        outline: none;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: none;
        border-radius: 4px; /* Giảm nhẹ bo góc */
        font-size: 14px;
        font-weight: 500;
        padding: 9px 15px;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-orange {
        background-color: #ee4d2d;
        color: #fff;
    }
    .btn-orange:hover {
        background-color: #d94426;
        box-shadow: 0 2px 6px rgba(238,77,45,0.3);
    }
    .btn-gray {
        background-color: #9e9e9e;
        color: #fff;
    }
    .btn-gray:hover {
        background-color: #7e7e7e;
    }


    /* ===================== TABLE ===================== */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
        margin-top: 10px;
        border-radius: 4px; 
        overflow: hidden;
    }

    th, td {
        padding: 12px 10px;
        text-align: center;
    }

    th {
        /* Màu nền tiêu đề cam */
        background-color: #ee4d2d; 
        color: white;
        text-transform: uppercase;
        font-weight: 600;
    }

    /* Bỏ màu nền cho tr:nth-child(even) để giống hình mẫu */
    tr:nth-child(even) { background-color: #fff; } 
    tr:hover { background-color: #f5f5f5; } /* Hover nhẹ nhàng hơn */

    .no-data {
        text-align: center;
        color: #888;
        font-style: italic;
        padding: 20px;
    }

    /* Nút hành động trong bảng */
    .action-link {
        color: #ee4d2d; /* Đổi sang màu cam để thống nhất */
        margin: 0 3px;
        font-weight: 500;
    }
    .action-link.delete {
        color: #e74c3c; /* Màu đỏ cho Xóa */
    }
    .action-link:hover {
        text-decoration: underline;
    }

    /* ===================== PAGINATION (Giữ nguyên) ===================== */
    .pagination {
        text-align: center;
        margin-top: 25px;
    }
    .page-btn {
        display: inline-block;
        margin: 0 5px;
        padding: 8px 14px;
        border-radius: 4px;
        border: 1px solid #ee4d2d;
        color: #ee4d2d;
        background-color: #fff;
        font-weight: 500;
        transition: 0.2s;
    }
    .page-btn:hover {
        background-color: #ee4d2d;
        color: white;
    }
    .page-btn.active {
        background-color: #ee4d2d;
        color: #fff;
        font-weight: bold;
    }

    /* ===================== BACK LINK (Giống hình mẫu) ===================== */
    .back-link-wrapper {
        text-align: center; /* Đảm bảo căn giữa */
        margin-top: 25px;
    }
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        /* Đổi màu cho giống chữ xám trên hình mẫu */
        color: #666; 
        padding: 0;
        font-weight: 500;
        transition: 0.25s;
    }
    .back-link:hover {
        color: #ee4d2d;
        text-decoration: underline;
    }
    .back-link i {
        /* Icon Home */
        font-size: 1rem;
    }
</style>
</head>

<body>
<header>Quản Trị Hệ Thống Shopee Mini</header>

<div class="content-wrapper">
    <div class="container">
        <h2>
            <i class="fa-solid fa-gift"></i> Quản lý khuyến mãi & Mã giảm giá
        </h2>

        <div class="top-bar">
            <form method="GET" class="search-box">
                <input type="hidden" name="controller" value="khuyenmai">
                <input type="hidden" name="action" value="index">
                <input type="text" 
                        name="search" 
                        placeholder="🔍 Tìm khuyến mãi theo tên hoặc mã..."
                        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                        class="search-input">
                <button type="submit" class="btn btn-orange"><i class="fa-solid fa-search"></i> Tìm</button>
                <?php if (!empty($_GET['search'])): ?>
                    <a href="?controller=khuyenmai&action=index" class="btn btn-gray"><i class="fa-solid fa-rotate-left"></i> Reset</a>
                <?php endif; ?>
            </form>

            <a class="btn btn-orange" href="?controller=khuyenmai&action=create">
                <i class="fa-solid fa-plus"></i> Thêm khuyến mãi
            </a>
        </div>

        <table>
            <tr>
                <th>STT</th> 
                <th>Tên khuyến mãi</th>
                <th>Mã</th>
                <th>Loại giảm</th>
                <th>Giá trị</th>
                <th>Điều kiện</th>
                <th>Bắt đầu</th>
                <th>Kết thúc</th>
                <th>Hành động</th>
            </tr>

            <?php if (empty($list)): ?>
                <tr><td colspan="9" class="no-data">Không có dữ liệu khuyến mãi.</td></tr>
            <?php else: 
                $stt = $offset + 1;
                foreach ($list as $row): ?>
                <tr>
                    <td><?= $stt++ ?></td> 
                    <td><?= htmlspecialchars($row['ten']) ?></td>
                    <td><?= htmlspecialchars($row['ma']) ?></td>
                    <td><?= htmlspecialchars($row['loai_giam']) ?></td>
                    <td><?= htmlspecialchars($row['gia_tri']) ?></td>
                    <td><?= htmlspecialchars($row['dieu_kien']) ?></td>
                    <td><?= htmlspecialchars($row['ngay_bat_dau']) ?></td>
                    <td><?= htmlspecialchars($row['ngay_ket_thuc']) ?></td>
                    <td>
                        <a class="action-link" href="?controller=khuyenmai&action=edit&id=<?= $row['id'] ?>"><i class="fa-solid fa-pen-to-square"></i> Sửa</a> | 
                        <a class="action-link delete" href="?controller=khuyenmai&action=delete&id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa khuyến mãi này?')"><i class="fa-solid fa-trash"></i> Xóa</a>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
        </table>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php 
                $search_param = isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '';
                if ($page > 1): ?>
                    <a href="?controller=khuyenmai&action=index&page=<?= $page - 1 ?><?= $search_param ?>" class="page-btn">« Trước</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?controller=khuyenmai&action=index&page=<?= $i ?><?= $search_param ?>" 
                       class="page-btn <?= $i == $page ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?controller=khuyenmai&action=index&page=<?= $page + 1 ?><?= $search_param ?>" class="page-btn">Sau »</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="back-link-wrapper">
        <a href="/nhom4/public/admin.php?action=dashboard" class="back-link">
            <i class="fa-solid fa-house"></i> Quay lại trang Quản trị
        </a>
    </div>
</div>

</body>
</html>