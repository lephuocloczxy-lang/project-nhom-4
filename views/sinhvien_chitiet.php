<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Chi tiết sinh viên</title>
<style>
    body {
        font-family: "Poppins", sans-serif;
        margin: 0;
        background: linear-gradient(135deg, #2a9df4, #00c6ff);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .detail-wrapper {
        background-color: #fff;
        border-radius: 16px;
        width: 90%;
        max-width: 650px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .detail-header {
        background: linear-gradient(90deg, #0061f2, #007bff);
        color: #fff;
        text-align: center;
        padding: 25px 20px;
    }

    .detail-header h1 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
    }

    .detail-content {
        padding: 30px 40px;
        text-align: center;
    }

    .detail-content img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #0061f2;
        margin-bottom: 20px;
    }

    .detail-content h2 {
        color: #0061f2;
        font-size: 22px;
        margin-bottom: 20px;
    }

    .info-list {
        text-align: left;
        margin: 0 auto;
        max-width: 400px;
    }

    .info-item {
        background: #f8f9fc;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-item strong {
        color: #0061f2;
        font-weight: 600;
    }

    .back-btn {
        display: inline-block;
        background: linear-gradient(90deg, #00b894, #00cec9);
        color: #fff;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        margin-top: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 190, 150, 0.3);
    }

    .back-btn:hover {
        background: linear-gradient(90deg, #00a383, #00b2b2);
        transform: translateY(-2px);
    }
</style>
</head>
<body>

<div class="detail-wrapper">
    <div class="detail-header">
        <h1>📘 Thông tin chi tiết sinh viên</h1>
    </div>

    <div class="detail-content">
        <img src="uploads/<?= htmlspecialchars($student['avatar'] ?? 'default.png') ?>" alt="Ảnh đại diện">
        <h2><?= htmlspecialchars($student['name']) ?></h2>

        <div class="info-list">
            <div class="info-item"><strong>Email:</strong> <span><?= htmlspecialchars($student['email']) ?></span></div>
            <div class="info-item"><strong>Số điện thoại:</strong> <span><?= htmlspecialchars($student['phone']) ?></span></div>
            <div class="info-item"><strong>Lớp:</strong> <span><?= htmlspecialchars($student['class'] ?? 'CNTT17A') ?></span></div>
           <!-- class="info-item"><strong>Ngày sinh:</strong> <span><= htmlspecialchars($student['dob'] ?? '-')  -->
        </div>

        <a href="index.php" class="back-btn">← Quay lại danh sách</a>
    </div>
</div>

</body>
</html>
