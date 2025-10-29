<?php
// ✅ Bảo vệ trang: chỉ cho người đã đăng nhập
require_once __DIR__ . '/../src/auth.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đổi mật khẩu</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #3bb2ff, #00c6ff);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 100px auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            padding: 40px;
        }
        h2 {
            text-align: center;
            color: #0066cc;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }
        button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🔐 Đổi mật khẩu</h2>
    <form method="POST" action="index.php?action=change_password_submit">
        <div class="form-group">
            <label for="old_password">Mật khẩu cũ:</label>
            <input type="password" id="old_password" name="old_password" required>
        </div>

        <div class="form-group">
            <label for="new_password">Mật khẩu mới:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu mới:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <button type="submit">Cập nhật mật khẩu</button>

        <a href="index.php" class="back-link">⬅ Quay lại Trang chủ</a>
    </form>
</div>

</body>
</html>
