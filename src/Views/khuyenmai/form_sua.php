<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>✏️ Sửa chương trình khuyến mãi | Quản trị Shopee</title>
<style>
    :root {
        --main-color: #ee4d2d;
        --main-hover: #d73211;
        --text-color: #333;
        --border-color: #ddd;
        --bg-light: #fff;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
    }

    .header {
        background: var(--main-color);
        color: white;
        padding: 16px 0;
        text-align: center;
        font-size: 22px;
        font-weight: 600;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .container {
        max-width: 650px;
        background: var(--bg-light);
        margin: 50px auto;
        padding: 35px 45px;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .container:hover {
        box-shadow: 0 6px 22px rgba(0,0,0,0.1);
    }

    h3 {
        color: var(--main-color);
        text-align: center;
        margin-bottom: 25px;
        font-size: 22px;
    }

    label {
        display: block;
        margin-bottom: 12px;
        font-weight: 500;
        color: var(--text-color);
    }

    input, select {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 15px;
        margin-top: 6px;
        box-sizing: border-box;
        background-color: #fff;
        transition: border 0.2s, box-shadow 0.2s;
    }

    input:focus, select:focus {
        outline: none;
        border-color: var(--main-color);
        box-shadow: 0 0 5px rgba(238,77,45,0.3);
    }

    .btn-submit {
        width: 100%;
        background: var(--main-color);
        color: #fff;
        border: none;
        padding: 14px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: 0.25s;
        margin-top: 25px;
    }

    .btn-submit:hover {
        background: var(--main-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(238,77,45,0.3);
    }

    .btn-back {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: var(--main-color);
        font-weight: 500;
        font-size: 15px;
        text-align: center;
    }

    .btn-back:hover {
        text-decoration: underline;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    @media (max-width: 600px) {
        .container {
            padding: 25px;
        }
        .grid {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>
<body>

<div class="header">Hệ thống quản lý khuyến mãi Shopee</div>

<div class="container">
    <h3>✏️ Sửa chương trình khuyến mãi</h3>

    <?php
    // ✅ Đảm bảo biến $item tồn tại
    if (!isset($item) || !is_array($item)) {
        echo "<p style='text-align:center;color:red;'>Không tìm thấy dữ liệu khuyến mãi.</p>";
        echo "<p style='text-align:center;'><a href='?controller=khuyenmai&action=index'>← Quay lại danh sách</a></p>";
        exit;
    }
    ?>

    <form method="post" action="?controller=khuyenmai&action=update&id=<?= htmlspecialchars($item['id']) ?>">
        <label>Tên khuyến mãi:
            <input type="text" name="ten" value="<?= htmlspecialchars($item['ten']) ?>" required>
        </label>

        <div class="grid">
            <label>Mã giảm giá:
                <input type="text" name="ma" value="<?= htmlspecialchars($item['ma']) ?>" required>
            </label>

            <label>Loại giảm:
                <select name="loai_giam">
                    <option value="%" <?= $item['loai_giam'] == '%' ? 'selected' : '' ?>>Phần trăm (%)</option>
                    <option value="vnd" <?= $item['loai_giam'] == 'vnd' ? 'selected' : '' ?>>Số tiền (VND)</option>
                </select>
            </label>
        </div>

        <div class="grid">
            <label>Giá trị giảm:
                <input type="number" name="gia_tri" value="<?= htmlspecialchars($item['gia_tri']) ?>" min="1" required>
            </label>

            <label>Điều kiện áp dụng:
                <input type="text" name="dieu_kien" value="<?= htmlspecialchars($item['dieu_kien']) ?>">
            </label>
        </div>

        <div class="grid">
            <label>Ngày bắt đầu:
                <input type="date" name="ngay_bat_dau" value="<?= htmlspecialchars($item['ngay_bat_dau']) ?>" required>
            </label>

            <label>Ngày kết thúc:
                <input type="date" name="ngay_ket_thuc" value="<?= htmlspecialchars($item['ngay_ket_thuc']) ?>" required>
            </label>
        </div>

        <button type="submit" class="btn-submit">💾 Cập nhật khuyến mãi</button>
    </form>

    <div style="text-align:center">
        <a href="?controller=khuyenmai&action=index" class="btn-back">← Quay lại danh sách</a>
    </div>
</div>

</body>
</html>
