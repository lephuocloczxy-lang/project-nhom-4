<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận tài khoản</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff, #ffeaea);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .verify-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            padding: 40px 50px;
            text-align: center;
            max-width: 420px;
            width: 90%;
        }

        .verify-container h2 {
            color: #f53d2d;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .verify-container p {
            color: #555;
            margin: 10px 0 25px;
            line-height: 1.6;
        }

        .btn-primary {
            display: inline-block;
            background: #f53d2d;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.25s;
        }

        .btn-primary:hover {
            background: #d53727;
        }

        .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .success { color: #28a745; }
        .error { color: #f53d2d; }
    </style>
</head>
<body>
<div class="verify-container">
    <?php if ($result === 'missing'): ?>
        <div class="icon error">❌</div>
        <h2>Thiếu mã xác thực!</h2>
        <p>Liên kết xác thực không hợp lệ hoặc đã hết hạn. Vui lòng kiểm tra lại email của bạn.</p>
        <a href="index.php?action=dangnhap" class="btn-primary">Quay lại đăng nhập</a>

    <?php elseif ($result === 'success'): ?>
        <div class="icon success">✅</div>
        <h2>Xác thực thành công!</h2>
        <p>Tài khoản của bạn đã được kích hoạt. Bây giờ bạn có thể đăng nhập để sử dụng hệ thống.</p>
        <a href="index.php?action=dangnhap" class="btn-primary">Đăng nhập ngay</a>

    <?php else: ?>
        <div class="icon error">⚠️</div>
        <h2>Mã xác thực không hợp lệ!</h2>
        <p>Liên kết này có thể đã được sử dụng hoặc không tồn tại. Vui lòng thử lại hoặc đăng ký mới.</p>
        <a href="index.php?action=dangky" class="btn-primary">Đăng ký tài khoản</a>
    <?php endif; ?>
</div>
</body>
</html>
