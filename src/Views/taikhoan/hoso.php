<?php
// Mô phỏng dữ liệu người dùng đã đăng nhập (Lấy từ Session hoặc Database)
// Thường thì biến $user sẽ được truyền từ Controller vào View này.
if (!isset($user)) {
    $user = [
        'hoten' => 'Nguyễn Văn A (CN 2)',
        'email' => 'nguyen.vana@example.com',
        'dienthoai' => '0901 234 567',
        'gioitinh' => 'Nam',
        'ngaysinh' => '15/08/1995',
        'diachi' => 'Số 123, Đường ABC, Phường 1, Quận XYZ, TP.HCM',
        'avatar' => 'https://via.placeholder.com/120/ee4d2d/ffffff?text=A', // Avatar giả lập
    ];
}

// Hàm format giá trị an toàn (đã có trong code gốc, giữ lại)
function safe_html($text) {
    return htmlspecialchars($text ?? 'Chưa cập nhật');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ cá nhân - Shopee Mini (CN 2)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS Reset and Global Styles */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f5f5f5; /* Nền đồng bộ với trang chủ */
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .profile-container {
            display: flex;
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px; /* Bo góc nhẹ hơn */
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        /* ------------------------------------- */
        /* Sidebar trái */
        /* ------------------------------------- */
        .profile-sidebar {
            width: 280px;
            background-color: #fff;
            border-right: 1px solid #f0f0f0;
            padding: 30px 20px; /* Giảm padding một chút */
            text-align: center;
        }

        .profile-avatar-area {
            display: flex;
            align-items: center;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .profile-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ee4d2d;
            margin-right: 15px;
        }

        .profile-name-small {
            text-align: left;
        }

        .profile-name-small .name {
            font-weight: 600;
            font-size: 1rem;
            color: #222;
            display: block;
        }
        
        .profile-name-small .edit-link {
            font-size: 0.85rem;
            color: #777;
            text-decoration: none;
            display: block;
            margin-top: 2px;
        }
        
        .profile-name-small .edit-link i {
            margin-right: 5px;
        }


        .profile-menu {
            text-align: left;
        }

        .profile-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            color: #555;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s ease;
            margin-bottom: 5px;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .profile-menu a i {
            font-size: 1.1rem;
            width: 20px; /* Cố định khoảng cách icon */
        }

        .profile-menu a:hover,
        .profile-menu a.active {
            background: #fff5f4; /* Nền cam nhạt */
            color: #ee4d2d;
            font-weight: 600;
        }
        
        /* ------------------------------------- */
        /* Nội dung bên phải */
        /* ------------------------------------- */
        .profile-content {
            flex: 1;
            padding: 40px 50px;
            background-color: #fff;
        }
        
        .breadcrumb {
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        .breadcrumb a {
            color: #777;
            text-decoration: none;
        }
        
        .breadcrumb a:hover {
            color: #ee4d2d;
            text-decoration: underline;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .profile-header h2 {
            color: #ee4d2d; /* Tiêu đề màu cam */
            font-size: 1.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .info-label {
            flex-basis: 150px; /* Cố định chiều rộng label */
            color: #777;
            font-weight: 500;
            font-size: 0.95rem;
            text-align: right;
            padding-right: 20px;
        }

        .info-value {
            flex: 1;
            background: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 4px;
            padding: 12px 15px;
            color: #333;
            font-weight: 500;
            font-size: 1rem;
        }

        .btn-primary {
            background: #ee4d2d;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none; /* Dùng cho thẻ a */
        }

        .btn-primary:hover {
            background: #d53727;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-container {
                flex-direction: column;
                margin: 0;
                border-radius: 0;
            }

            .profile-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #eee;
                padding: 15px;
            }
            
            .profile-avatar-area {
                border-bottom: none;
                margin-bottom: 0;
                padding-bottom: 0;
            }

            .profile-content {
                padding: 20px 15px;
            }
            
            .info-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-label {
                text-align: left;
                padding-right: 0;
                margin-bottom: 5px;
            }
            
            .info-value {
                width: 100%;
            }
            
            .profile-header h2 {
                font-size: 1.5rem;
            }
            
            .profile-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .btn-primary {
                width: 100%;
                margin-top: 15px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">

        <div class="profile-sidebar">
            
            <div class="profile-avatar-area">
                <img src="<?= safe_html($user['avatar'] ?? '/public/images/default-avatar.png') ?>" alt="Avatar" class="profile-avatar">
                <div class="profile-name-small">
                    <span class="name"><?= safe_html($user['hoten'] ?? 'Người dùng') ?></span>
                    <a href="index.php?action=suathongtin" class="edit-link">
                        <i class="fas fa-edit"></i> Chỉnh sửa hồ sơ
                    </a>
                </div>
            </div>

            <div class="profile-menu">
                <a href="index.php?action=hoso" class="active">
                    <i class="fas fa-user"></i> Hồ sơ của tôi
                </a>
                <a href="index.php?action=donhang">
                    <i class="fas fa-receipt"></i> Đơn mua
                </a>
                <a href="index.php?action=yeuthich">
                    <i class="fas fa-heart"></i> Yêu thích
                </a>
                <a href="index.php?action=doimatkhau">
                    <i class="fas fa-lock"></i> Đổi mật khẩu
                </a>
                <a href="index.php?action=dangxuat">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
            </div>
        </div>

        <div class="profile-content">
            
            <div class="breadcrumb">
                <a href="index.php"><i class="fas fa-home"></i> Trang chủ</a> 
                / Hồ sơ cá nhân
            </div>

            <div class="profile-header">
                <h2><i class="fas fa-id-card"></i> Thông tin tài khoản</h2>
                <a class="btn-primary" href="index.php?action=suathongtin">
                    <i class="fas fa-pencil-alt"></i> Chỉnh sửa
                </a>
            </div>

            <div class="info-group">
                <label class="info-label">Họ và tên</label>
                <div class="info-value"><?= safe_html($user['hoten']) ?></div>
            </div>

            <div class="info-group">
                <label class="info-label">Email</label>
                <div class="info-value"><?= safe_html($user['email']) ?></div>
            </div>

            <div class="info-group">
                <label class="info-label">Số điện thoại</label>
                <div class="info-value"><?= safe_html($user['dienthoai']) ?></div>
            </div>

            <div class="info-group">
                <label class="info-label">Giới tính</label>
                <div class="info-value"><?= safe_html($user['gioitinh']) ?></div>
            </div>

            <div class="info-group">
                <label class="info-label">Ngày sinh</label>
                <div class="info-value"><?= safe_html($user['ngaysinh']) ?></div>
            </div>

            <div class="info-group">
                <label class="info-label">Địa chỉ</label>
                <div class="info-value"><?= safe_html($user['diachi']) ?></div>
            </div>
        </div>
    </div>
</body>
</html>