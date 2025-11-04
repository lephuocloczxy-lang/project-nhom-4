<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <style>
        /* CSS của bạn (Đã chỉnh sửa chút ít) */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .form-container {
            max-width: 420px;
            margin: 80px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 35px 40px;
        }

        h2 {
            color: #f53d2d;
            text-align: center;
            font-size: 24px;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input {
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #f53d2d;
            box-shadow: 0 0 0 2px rgba(245,61,45,0.15);
        }

        .btn-primary {
            background: #f53d2d;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.25s;
        }

        .btn-primary:hover {
            background: #d22e1e;
        }

        .msg {
            text-align: center;
            font-weight: 500;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .error {
            color: #a94442; 
            background-color: #f2dede; 
            border: 1px solid #ebccd1;
        }
        
        .success {
            color: #3c763d; 
            background-color: #dff0d8; 
            border: 1px solid #d6e9c6;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #f53d2d;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <?php $basePath = $baseUrl ?? "/nhom4/public/"; ?> 
    
    <div class="form-container">
        <h2>🔒 Đặt lại mật khẩu</h2>
        <p style="text-align: center; color: #666; font-size: 14px; margin-bottom: 20px;">
            Vui lòng nhập mật khẩu mới.
        </p>
        
        <?php if (!empty($error)): ?>
            <p class="msg error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="<?= htmlspecialchars($basePath . "?action=datlaimatkhau&token=" . ($token ?? '')) ?>">
            <input type="password" name="matkhauMoi" placeholder="Nhập mật khẩu mới" required minlength="6">
            <input type="password" name="nhaplai" placeholder="Nhập lại mật khẩu mới" required minlength="6">
            <button type="submit" class="btn-primary">Cập nhật mật khẩu</button>
        </form>

        <a href="<?= htmlspecialchars($basePath . "?action=dangnhap") ?>" class="back-link">← Quay lại đăng nhập</a>
    </div>
</body>
</html>