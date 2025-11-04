<?php
// Mô phỏng dữ liệu người dùng (Lấy từ Session/Database, đồng bộ với trang Hồ sơ trước)
if (!isset($user)) {
    $user = [
        'hoten' => 'Nguyễn Văn A (CN 2)',
        'email' => 'nguyen.vana@example.com',
        // Lưu ý: Input type="date" cần format YYYY-MM-DD
        'ngaysinh' => '1995-08-15', 
        'dienthoai' => '0901 234 567',
        'gioitinh' => 'Nam',
        'diachi' => 'Số 123, Đường ABC, Phường 1, Quận XYZ, TP.HCM',
        'avatar' => 'https://via.placeholder.com/100/ee4d2d/ffffff?text=A',
    ];
}

// Nếu ngaysinh không có, gán rỗng để tránh lỗi input date
$user['ngaysinh'] = $user['ngaysinh'] ?? '';
$user['diachi'] = $user['diachi'] ?? '';
$user['dienthoai'] = $user['dienthoai'] ?? '';
$user['hoten'] = $user['hoten'] ?? '';

// Hàm format giá trị an toàn (đã có trong code gốc, giữ lại)
function safe_html($text) {
    return htmlspecialchars($text ?? '');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa hồ sơ - Shopee Mini (CN 2)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS Reset and Global Styles (Đồng bộ) */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto; /* Giảm margin trên/dưới */
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px 40px;
        }

        h2 {
            text-align: center;
            color: #ee4d2d; /* Màu cam Shopee */
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        /* ------------------------------------- */
        /* Form Element Styles */
        /* ------------------------------------- */

        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            font-weight: 500;
            color: #555;
            display: block;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #eee;
            border-radius: 4px; /* Bo góc nhẹ hơn */
            background: #fcfcfc;
            color: #333;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #ee4d2d;
            outline: none;
            background: #fff;
            box-shadow: 0 0 0 2px rgba(238, 77, 45, 0.15); /* Đổ bóng cam nhạt */
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* ------------------------------------- */
        /* Avatar Upload Section */
        /* ------------------------------------- */
        .avatar-upload-section {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            gap: 20px;
        }

        .current-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ee4d2d;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .upload-controls {
            flex: 1;
        }
        
        /* Ẩn input file mặc định, dùng label làm button */
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 8px 12px;
            cursor: pointer;
            background: #f0f0f0;
            border-radius: 4px;
            transition: background 0.2s;
            font-size: 0.9rem;
        }
        
        .custom-file-upload:hover {
            background: #e0e0e0;
        }
        
        input[type="file"] {
            display: none; /* Ẩn input file gốc */
        }

        /* ------------------------------------- */
        /* Buttons */
        /* ------------------------------------- */
        .btn-primary {
            background: #ee4d2d;
            color: #fff;
            padding: 12px 22px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
            width: 100%;
            margin-top: 15px;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: #d53727;
        }

        .back-link {
            display: block; /* Đặt link ra giữa */
            text-align: center;
            margin-top: 20px;
            color: #ee4d2d;
            text-decoration: none;
            font-weight: 500;
            transition: text-decoration 0.2s;
        }

        .back-link:hover {
            text-decoration: underline;
        }
        
        /* Responsive */
        @media (max-width: 650px) {
            .form-container {
                margin: 0;
                border-radius: 0;
                padding: 20px;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .avatar-upload-section {
                flex-direction: column;
                text-align: center;
            }
            
            .upload-controls {
                width: 100%;
            }
            
            .current-avatar {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2><i class="fas fa-edit"></i> Chỉnh Sửa Hồ Sơ</h2>
        <form method="post" enctype="multipart/form-data">
            
            <div class="avatar-upload-section">
                <?php if (!empty($user['avatar'])): ?>
                    <img src="<?= safe_html($user['avatar']) ?>" alt="Ảnh đại diện" class="current-avatar">
                <?php endif; ?>
                
                <div class="upload-controls">
                    <label style="margin-bottom: 10px;">Thay đổi Ảnh đại diện:</label>
                    <label for="avatar-upload" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Chọn Ảnh
                    </label>
                    <input type="file" name="avatar" id="avatar-upload" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label for="hoten">Họ và tên:</label>
                <input type="text" id="hoten" name="hoten" value="<?= safe_html($user['hoten']) ?>" required placeholder="Nhập họ và tên của bạn">
            </div>

            <div class="form-group">
                <label for="gioitinh">Giới tính:</label>
                <select id="gioitinh" name="gioitinh">
                    <option value="" disabled <?= ($user['gioitinh'] ?? '') === '' ? 'selected' : '' ?>>Chọn giới tính</option>
                    <option value="Nam" <?= ($user['gioitinh'] ?? '') === 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= ($user['gioitinh'] ?? '') === 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                    <option value="Khác" <?= ($user['gioitinh'] ?? '') === 'Khác' ? 'selected' : '' ?>>Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ngaysinh">Ngày sinh:</label>
                <input type="date" id="ngaysinh" name="ngaysinh" value="<?= safe_html($user['ngaysinh']) ?>">
            </div>

            <div class="form-group">
                <label for="dienthoai">Số điện thoại:</label>
                <input type="text" id="dienthoai" name="dienthoai" value="<?= safe_html($user['dienthoai']) ?>" placeholder="Nhập số điện thoại">
            </div>

            <div class="form-group">
                <label for="diachi">Địa chỉ (Chi tiết):</label>
                <textarea id="diachi" name="diachi" placeholder="Số nhà, đường, phường/xã..."><?= safe_html($user['diachi']) ?></textarea>
            </div>

            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Lưu thay đổi
            </button>
            
            <a href="index.php?action=hoso" class="back-link">
                <i class="fas fa-arrow-left"></i> Quay lại Hồ sơ cá nhân
            </a>
        </form>
    </div>
</body>
</html>