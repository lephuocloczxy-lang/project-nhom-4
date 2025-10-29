<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>✏️ Chỉnh sửa thông tin sinh viên</title>

<style>
:root {
    --main-color: #4e73df;
    --accent-color: #1cc88a;
    --danger-color: #e74a3b;
    --bg-light: #f4f6f9;
    --radius: 10px;
}

/* ==== Tổng thể ==== */
body {
    font-family: "Poppins", "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    margin: 0;
    padding: 40px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* ==== Khung chính ==== */
.container {
    background: #fff;
    width: 90%;
    max-width: 650px;
    border-radius: var(--radius);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    overflow: hidden;
    animation: fadeIn 0.7s ease;
    padding: 35px 45px 45px;
}

/* ==== Header ==== */
header {
    text-align: center;
    background: linear-gradient(135deg, var(--main-color), var(--accent-color));
    color: #fff;
    padding: 25px 20px;
    border-radius: var(--radius);
    margin-bottom: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

header h1 {
    margin: 0;
    font-size: 26px;
    letter-spacing: 0.5px;
}

/* ==== Form ==== */
form {
    padding: 25px 20px;
    border-radius: var(--radius);
    background: #fdfdfd;
    border: 1px solid #e3e6f0;
    box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.03);
}

form label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
    color: #444;
}

form input {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    font-size: 15px;
    border-radius: var(--radius);
    border: 1px solid #ccc;
    background: #fafafa;
    transition: all 0.3s ease;
}

form input:focus {
    border-color: var(--main-color);
    box-shadow: 0 0 0 3px rgba(78,115,223,0.15);
    outline: none;
    background: #fff;
}

/* ==== Ảnh ==== */
.avatar-preview {
    text-align: center;
    margin-bottom: 20px;
}
.avatar-preview img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ccc;
}

/* ==== Nút lưu ==== */
form button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(to right, var(--main-color), var(--accent-color));
    color: #fff;
    font-size: 16px;
    border: none;
    border-radius: var(--radius);
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

form button:hover {
    transform: translateY(-2px);
    opacity: 0.95;
    box-shadow: 0 4px 12px rgba(76,115,223,0.3);
}

/* ==== Link quay lại ==== */
p {
    text-align: center;
    margin-top: 20px;
}

p a {
    color: var(--main-color);
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s;
}

p a:hover {
    color: var(--accent-color);
}

/* ==== Hiệu ứng ==== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>
    <div class="container">
        <header>
            <h1>✏️ Chỉnh sửa thông tin sinh viên</h1>
        </header>

        <!-- 🧩 Quan trọng: thêm enctype để upload ảnh -->
        <form action="index.php?action=update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']); ?>">
            <input type="hidden" name="old_avatar" value="<?= htmlspecialchars($student['avatar'] ?? ''); ?>">

            <label for="name">Họ và tên:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($student['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($student['email']); ?>" required>

            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($student['phone']); ?>" required>

            <!-- 🖼️ Ảnh hiện tại -->
            <label>Ảnh hiện tại:</label>
            <div class="avatar-preview">
                <?php if (!empty($student['avatar'])): ?>
                    <img src="uploads/<?= htmlspecialchars($student['avatar']); ?>" alt="Ảnh sinh viên">
                <?php else: ?>
                    <img src="uploads/default.png" alt="Mặc định">
                <?php endif; ?>
            </div>

            <!-- 🆕 Chọn ảnh mới -->
            <label for="avatar">Chọn ảnh mới:</label>
            <input type="file" id="avatar" name="avatar" accept="image/*">

            <button type="submit">💾 Lưu thay đổi</button>
        </form>

        <p><a href="index.php">⬅ Quay về danh sách</a></p>
    </div>
</body>
</html>
