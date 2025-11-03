<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chỉnh sửa hồ sơ - ShopOnline</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fafafa;
      margin: 0;
      padding: 0;
    }

    .form-container {
      max-width: 600px;
      margin: 60px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.05);
      padding: 40px 50px;
    }

    h2 {
      text-align: center;
      color: #f53d2d;
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 30px;
    }

    label {
      font-weight: 500;
      color: #555;
      display: block;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="date"],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #eee;
      border-radius: 8px;
      background: #f9f9f9;
      color: #333;
      margin-bottom: 18px;
      font-family: inherit;
      transition: all 0.2s ease;
    }

    input:focus,
    textarea:focus,
    select:focus {
      border-color: #f53d2d;
      outline: none;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(245, 61, 45, 0.1);
    }

    input[type="file"] {
      margin-bottom: 15px;
    }

    img {
      border-radius: 10px;
      margin-bottom: 15px;
      border: 2px solid #f0f0f0;
    }

    .btn-primary {
      background: #f53d2d;
      color: #fff;
      padding: 12px 22px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.25s;
      width: 100%;
      margin-top: 10px;
    }

    .btn-primary:hover {
      background: #d53727;
    }

    .back-link {
      display: inline-block;
      text-align: center;
      margin-top: 15px;
      color: #f53d2d;
      text-decoration: none;
      font-weight: 500;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Chỉnh sửa hồ sơ</h2>
    <form method="post" enctype="multipart/form-data">
      
      <label>Ảnh đại diện:</label>
      <input type="file" name="avatar" accept="image/*">
      <?php if (!empty($user['avatar'])): ?>
        <img src="<?= htmlspecialchars($user['avatar']) ?>" width="100">
      <?php endif; ?>

      <label>Họ và tên:</label>
      <input type="text" name="hoten" value="<?= htmlspecialchars($user['hoten']) ?>" required>

      <label>Giới tính:</label>
      <select name="gioitinh">
        <option value="">Chọn giới tính</option>
        <option value="Nam" <?= ($user['gioitinh'] ?? '') === 'Nam' ? 'selected' : '' ?>>Nam</option>
        <option value="Nữ" <?= ($user['gioitinh'] ?? '') === 'Nữ' ? 'selected' : '' ?>>Nữ</option>
        <option value="Khác" <?= ($user['gioitinh'] ?? '') === 'Khác' ? 'selected' : '' ?>>Khác</option>
      </select>

      <label>Ngày sinh:</label>
      <input type="date" name="ngaysinh" value="<?= htmlspecialchars($user['ngaysinh'] ?? '') ?>">

      <label>Số điện thoại:</label>
      <input type="text" name="dienthoai" value="<?= htmlspecialchars($user['dienthoai']) ?>">

      <label>Địa chỉ:</label>
      <textarea name="diachi"><?= htmlspecialchars($user['diachi']) ?></textarea>

      <button type="submit" class="btn-primary">💾 Lưu thay đổi</button>
      <a href="index.php?action=hoso" class="back-link">← Quay lại hồ sơ</a>
    </form>
  </div>
</body>
</html>
