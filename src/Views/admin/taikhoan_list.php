<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📋 Quản lý Tài khoản Người dùng</title>
    <!-- Google Font Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome cho icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --shopee-orange: #ee4d2d;
            --shopee-light-orange: #ff5733;
            --shopee-gray: #f2f4f6;
            --shopee-dark-gray: #666;
            --color-success: #2ecc71;
            --color-info: #3498db;
            --color-warning: #f1c40f;
            --color-danger: #e74c3c;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: var(--shopee-gray);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333;
        }

        header {
            background: var(--shopee-orange);
            color: white;
            padding: 20px 30px;
            font-size: 28px;
            font-weight: 700;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .main-content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .panel {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 25px;
        }

        .panel-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--shopee-orange);
            margin-bottom: 25px;
            text-align: center;
        }

        /* --- STYLES CHO BẢNG DỮ LIỆU --- */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .data-table th, .data-table td {
            padding: 12px 10px;
            text-align: center;
        }

        .data-table thead th {
            background: var(--shopee-orange);
            color: white;
            font-weight: 500;
            text-transform: uppercase;
        }

        /* Bo góc cho thead */
        .data-table thead tr:first-child th:first-child { border-top-left-radius: 8px; }
        .data-table thead tr:first-child th:last-child { border-top-right-radius: 8px; }

        .data-table tbody tr {
            border-bottom: 1px solid #eee;
        }
        
        .data-table tbody tr:last-child {
            border-bottom: none;
        }

        .data-table tbody tr:nth-child(even) {
            background: #fafafa;
        }

        /* --- STYLES CHO NÚT HÀNH ĐỘNG --- */
        .action-link {
            text-decoration: none;
            padding: 5px 8px;
            border-radius: 4px;
            font-weight: 500;
            margin: 0 2px;
            transition: background 0.2s, color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
        }
        
        /* Sửa */
        .action-link.edit { color: var(--color-info); }
        .action-link.edit:hover { background: rgba(52, 152, 219, 0.1); }
        
        /* Xóa */
        .action-link.delete { color: var(--color-danger); }
        .action-link.delete:hover { background: rgba(231, 76, 60, 0.1); }
        
        /* Khóa/Mở Khóa */
        .action-link.lock { color: var(--shopee-orange); }
        .action-link.lock:hover { background: rgba(238, 77, 45, 0.1); }


        /* --- STYLES CHO TRẠNG THÁI --- */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            color: white; /* Đặt màu chữ chung là trắng */
        }

        .status-0 { background: #f1c40f; color: #333; } /* Chưa xác thực - Vàng */
        .status-1 { background: #2ecc71; } /* Hoạt động - Xanh lá */
        .status-2 { background: #e74c3c; } /* Bị khóa - Đỏ */

        /* --- NÚT CHUNG --- */
        .top-actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .add-button {
            background: var(--color-success);
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }
        .add-button:hover { background: #27ae60; }

        /* Quay lại Dashboard */
        .back-link {
            display: block;
            margin-top: 25px;
            text-align: center;
            font-size: 15px;
            color: var(--shopee-dark-gray);
            text-decoration: none;
            font-weight: 500;
        }
        .back-link:hover {
            color: var(--shopee-orange);
        }

        /* --- MODAL (Thay thế cho confirm()) --- */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4); 
            padding-top: 50px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            text-align: center;
        }

        .modal-content button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
        }

        #confirm-btn {
            background-color: var(--color-danger);
            color: white;
        }

        #cancel-btn {
            background-color: #ccc;
            color: #333;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .data-table th, .data-table td {
                padding: 8px 5px;
                font-size: 12px;
            }
            .data-table thead {
                display: none; /* Ẩn tiêu đề trên mobile */
            }
            .data-table, .data-table tbody, .data-table tr, .data-table td {
                display: block;
                width: 100%;
            }
            .data-table tr {
                margin-bottom: 10px;
                border: 1px solid #ddd;
                border-radius: 8px;
            }
            .data-table td {
                text-align: right;
                position: relative;
                padding-left: 50%;
                border: none;
            }
            .data-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: 500;
                color: var(--shopee-dark-gray);
            }
            .action-link { margin: 5px; }
            .top-actions { justify-content: center; }
        }

    </style>
</head>
<body>

<header>Quản Trị Hệ Thống Shopee Mini</header>

<div class="main-content">
    <div class="panel">
        <h2 class="panel-title"><i class="fa-solid fa-users-gear"></i> 📋 Quản lý Tài khoản Người dùng</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="account-list">
                <!-- KHỐI CODE PHP ĐÃ ĐƯỢC TÍCH HỢP VÀ THAY THẾ CSS CŨ -->
                <?php foreach ($taiKhoans as $tk): ?>
                    <tr>
                        <td data-label="ID"><?= htmlspecialchars($tk['id']) ?></td>
                        <td data-label="Họ tên"><?= htmlspecialchars($tk['hoten']) ?></td>
                        <td data-label="Email"><?= htmlspecialchars($tk['email']) ?></td>
                        <td data-label="Vai trò"><?= htmlspecialchars($tk['role']) ?></td>
                        <td data-label="Trạng thái">
                            <?php 
                                $status_class = '';
                                $status_text = '';
                                if ($tk['trangthai'] == 0) {
                                    $status_class = 'status-0'; $status_text = '⏳ Chưa xác thực';
                                } elseif ($tk['trangthai'] == 1) {
                                    $status_class = 'status-1'; $status_text = '✅ Hoạt động';
                                } else {
                                    $status_class = 'status-2'; $status_text = '🔒 Bị khóa';
                                }
                            ?>
                            <span class="status-badge <?= $status_class ?>"><?= $status_text ?></span>
                        </td>
                        <td data-label="Hành động">
                            <!-- Nút Xóa (Đã thay thế confirm() bằng modal trigger) -->
                            <a href="#" data-id="<?= $tk['id'] ?>" class="action-link delete delete-trigger"><i class="fa-solid fa-trash-can"></i> Xóa</a>
                            
                            <!-- Nút Khóa/Mở khóa -->
                            <?php $is_active = $tk['trangthai'] == 1; ?>
                            <a href="admin.php?action=doitrangthai&id=<?= $tk['id'] ?>" class="action-link lock" 
                                style="color: <?= $is_active ? 'var(--shopee-orange)' : 'var(--color-success)' ?>;">
                                <i class="fa-solid <?= $is_active ? 'fa-lock' : 'fa-lock-open' ?>"></i> 
                                <?= $is_active ? 'Khóa' : 'Mở khóa' ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Link Quay lại Dashboard (Đã sửa lại href theo cấu trúc cũ của bạn) -->
        <a href="/nhom4/public/admin.php?action=dashboard" class="back-link">
            <i class="fa-solid fa-house"></i> Quay lại trang Quản trị
        </a>
    </div>
</div>

<!-- Modal Xác Nhận Xóa -->
<div id="delete-modal" class="modal">
    <div class="modal-content">
        <p><i class="fa-solid fa-circle-exclamation" style="color: var(--color-danger); font-size: 20px; margin-right: 10px;"></i> Bạn có chắc muốn xóa tài khoản này không?</p>
        <button id="cancel-btn">Hủy</button>
        <button id="confirm-btn">Xóa</button>
    </div>
</div>


<script>
    // Định nghĩa các biến DOM và ID cho Modal
    const accountList = document.getElementById('account-list');
    const modal = document.getElementById('delete-modal');
    const confirmBtn = document.getElementById('confirm-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    let accountToDeleteId = null;

    // Xử lý Modal
    cancelBtn.onclick = function() {
        modal.style.display = 'none';
        accountToDeleteId = null;
    }

    confirmBtn.onclick = function() {
        // Sau khi xác nhận, chuyển hướng đến URL xóa đã được định nghĩa trong PHP
        console.log(`Đang chuyển hướng để xóa tài khoản ID: ${accountToDeleteId}`);
        window.location.href = `admin.php?action=xoa&id=${accountToDeleteId}`;
        
        modal.style.display = 'none';
        accountToDeleteId = null;
    }

    // Đóng Modal khi click ra ngoài
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
            accountToDeleteId = null;
        }
    }

    // Gắn listener cho các nút Xóa sau khi PHP đã render nội dung
    window.onload = () => {
        document.querySelectorAll('.delete-trigger').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                // Lấy ID từ data-id của thẻ <a>
                accountToDeleteId = e.currentTarget.dataset.id;
                modal.style.display = 'block'; // Hiển thị Modal
            });
        });
    };
</script>

</body>
</html>
