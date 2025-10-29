<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 40px 35px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 370px;
            text-align: center;
            animation: fadeIn 0.8s ease;
        }

        h1 {
            color: #007bff;
            margin-bottom: 25px;
            font-size: 26px;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 6px rgba(0, 123, 255, 0.4);
            outline: none;
        }

        button {
            width: 100%;
            padding: 11px;
            background: linear-gradient(to right, #007bff, #00c6ff);
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        /* Thông báo lỗi & thành công */
        .alert {
            padding: 10px 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 14px;
            text-align: left;
            animation: fadeIn 0.5s ease;
        }

        .alert.error {
            background-color: #fdecea;
            color: #d8000c;
            border: 1px solid #f5c2c7;
        }

        .alert.success {
            background-color: #e8f9ee;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .switch-form {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #444;
        }

        .switch-form a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .switch-form a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Đăng nhập hệ thống</h1>

        <!-- ✅ Hiển thị thông báo -->
        <?php if (!empty($success)): ?>
            <div class="alert success"><?= htmlspecialchars($success) ?></div>
        <?php elseif (!empty($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <!-- ✅ Form đăng nhập -->
        <form action="index.php?action=do_login" method="POST">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username"
                       value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Đăng nhập</button>
        </form>

        <div class="switch-form">
            Chưa có tài khoản? 
            <a href="index.php?action=register">Đăng ký ngay</a>
        </div>
    </div>
</body>
</html>
