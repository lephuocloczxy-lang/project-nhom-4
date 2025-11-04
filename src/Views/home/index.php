<?php
// src/Views/home/index.php
// Đảm bảo các biến dữ liệu được định nghĩa
if (!isset($featured_products)) $featured_products = [];
if (!isset($new_products)) $new_products = [];
if (!isset($promotions)) $promotions = [];
if (!isset($banners)) $banners = [];
if (!isset($news)) $news = [];
if (!isset($categories)) $categories = [];
if (!isset($user)) $user = null;

// Lấy thông tin user (đã có ở phần đầu file PHP)
$hoten = $user['hoten'] ?? '';
$email = $user['email'] ?? '';

// Dữ liệu mẫu (Giả lập)
if (empty($featured_products)) {
    $featured_products = [
        ['id' => 1, 'name' => 'Điện thoại thông minh X - Màn hình lớn 6.7 inch', 'price' => 12000000],
        ['id' => 2, 'name' => 'Laptop siêu mỏng Y - Chip M2, RAM 16GB, SSD 512GB', 'price' => 25000000],
        ['id' => 3, 'name' => 'Tai nghe không dây Z Pro - Khử tiếng ồn ANC', 'price' => 2500000],
        ['id' => 4, 'name' => 'Smartwatch A thế hệ mới - Theo dõi sức khỏe', 'price' => 4500000],
    ];
}
if (empty($new_products)) {
    $new_products = [
        ['id' => 5, 'name' => 'Sạc dự phòng 10000mAh - Sạc nhanh 22.5W', 'price' => 350000],
        ['id' => 6, 'name' => 'Bàn phím cơ RGB TKL - Blue Switch', 'price' => 1800000],
        ['id' => 7, 'name' => 'Chuột gaming không dây - DPI 16000, đèn LED', 'price' => 750000],
        ['id' => 8, 'name' => 'Ốp lưng silicon dẻo cho Smartphone X', 'price' => 150000],
    ];
}
if (empty($categories)) {
    $categories = [
        ['id' => 1, 'name' => '📱 Điện thoại'],
        ['id' => 2, 'name' => '💻 Laptop'],
        ['id' => 3, 'name' => '🎧 Phụ kiện'],
        ['id' => 4, 'name' => '⌚ Đồng hồ'],
        ['id' => 5, 'name' => '📷 Camera'],
    ];
}
if (empty($banners)) {
    $banners = [
        ['title' => 'SALE SỐC 11.11 - GIẢM ĐẾN 50%'],
        ['title' => 'HOÀN XU ĐẶC BIỆT'],
        ['title' => 'MUA KÈM DEAL SỐC'],
    ];
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee Mini - Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5; /* Nền xám nhạt */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header Styles (Thanh điều hướng chính) */
        header {
            background-color: #ee4d2d; /* Màu cam Shopee */
            color: white;
            padding: 10px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 8px;
        }

        /* Search Bar */
        .search-bar {
            flex: 1;
            max-width: 600px;
            background: white;
            border-radius: 4px;
            overflow: hidden;
            border: 2px solid #f05d40; /* Viền nổi bật */
        }

        .search-bar form {
            display: flex;
        }

        .search-bar input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            font-size: 14px;
            outline: none;
        }

        .search-bar button {
            padding: 10px 15px;
            background: #f05d40;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .search-bar button:hover {
            background: #ff735c;
        }

        /* Cart and User section */
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-icon-link {
            color: white;
            font-size: 1.5rem;
            text-decoration: none;
            position: relative;
            transition: color 0.2s;
        }

        .nav-icon-link:hover {
            color: #ffeb3b; /* Vàng sáng */
        }
        
        /* User Info Dropdown */
        .user-info {
            position: relative;
            display: inline-block;
            color: white;
            padding: 5px 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .user-info > span {
            display: block;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            background: white;
            min-width: 180px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            z-index: 1000;
            top: 100%;
            right: 0;
            margin-top: 10px;
            white-space: nowrap; /* Ngăn chữ bị xuống dòng */
        }
        
        .user-dropdown::before {
            content: "";
            position: absolute;
            top: -10px;
            right: 15px;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 10px solid white;
        }

        .user-dropdown a {
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            font-size: 0.9rem;
            transition: background 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-dropdown a:hover {
            background: #fff8f5;
            color: #ee4d2d;
        }

        .user-info:hover .user-dropdown {
            display: block;
        }
        
        .auth-links a {
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            margin-left: 10px;
            padding: 5px 10px;
            border-radius: 3px;
            transition: background 0.2s;
            border: 1px solid rgba(255, 255, 255, 0.5); /* Viền mờ */
        }
        
        .auth-links a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Navigation Menu (Ngang) */
        .category-nav {
            background: white;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); /* Đổ bóng nhẹ */
        }

        .category-nav ul {
            display: flex;
            list-style: none;
            justify-content: space-around;
            gap: 10px;
            flex-wrap: wrap;
        }

        .category-nav a {
            color: #555;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            transition: color 0.2s, background 0.2s;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .category-nav a:hover {
            color: #ee4d2d;
            background: #fcfcfc;
        }

        /* Main Content Sections */
        main {
            padding: 20px 0;
        }
        
        .section-card {
            background: white;
            border-radius: 4px;
            padding: 20px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08); /* Đổ bóng rõ hơn */
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #ee4d2d;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f05d40;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Banner & Category Grid */
        .top-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        .main-banner {
            background: linear-gradient(135deg, #ff735c, #ee4d2d); /* Gradient màu Shopee */
            height: 200px;
            border-radius: 4px;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }
        
        .sub-banners {
            display: grid;
            grid-template-rows: 1fr 1fr;
            gap: 10px;
        }
        
        .sub-banner {
            background: #ff914d;
            border-radius: 4px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.2s;
        }

        .sub-banner:hover {
            background: #ff735c;
        }
        
        /* Category Icon Grid */
        .category-icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 10px;
            text-align: center;
        }
        
        .category-icon a {
            display: block;
            text-decoration: none;
            color: #555;
            padding: 10px 5px;
            border-radius: 4px;
            transition: transform 0.2s, box-shadow 0.2s;
            background: #fff8f5; /* Nền nhẹ cho icon */
        }
        
        .category-icon a:hover {
            transform: translateY(-5px);
            color: #ee4d2d;
            box-shadow: 0 5px 15px rgba(238, 77, 45, 0.15);
        }
        
        .category-icon i {
            font-size: 2.2rem;
            color: #ee4d2d;
            margin-bottom: 5px;
            display: block;
        }
        
        .category-icon span {
            font-size: 0.85rem;
            display: block;
            font-weight: 500;
        }
        
        /* Product Grid (Sản phẩm gợi ý) */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .product-card {
            background: white;
            border-radius: 4px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
            text-align: left;
            display: block; /* Đảm bảo thẻ a chiếm toàn bộ */
            text-decoration: none;
            color: #333;
        }
        
        .product-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 0.9rem;
        }

        .product-info {
            padding: 10px;
        }
        
        .product-info h3 {
            font-size: 0.9rem;
            margin-bottom: 5px;
            min-height: 36px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            color: #333; /* Đảm bảo màu chữ hiển thị rõ */
        }

        .price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #ee4d2d;
            margin-bottom: 0;
            display: block;
            margin-top: 5px;
        }

        .add-to-cart {
            background: #ffede6; /* Màu nền nhẹ của Shopee */
            color: #ee4d2d;
            border: 1px solid #ee4d2d;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8rem;
            margin-top: 10px;
            transition: background 0.2s, color 0.2s;
            width: 100%;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        
        .add-to-cart:hover {
            background: #ee4d2d;
            color: white;
        }
        
        /* Footer */
        footer {
            background: #fff;
            color: #555;
            text-align: center;
            padding: 30px 0;
            border-top: 4px solid #ee4d2d;
            margin-top: 20px;
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .top-grid {
                grid-template-columns: 1fr;
            }

            .main-banner {
                height: 150px;
            }

            .category-nav ul {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            header .container {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .logo {
                flex-basis: 100%;
                text-align: center;
                margin-bottom: 10px;
            }

            .search-bar {
                max-width: 100%;
                margin: 0;
            }
            
            .nav-icons {
                margin-top: 10px;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="index.php" class="logo">
                <i class="fas fa-store"></i> Shopee Mini
            </a>

            <div class="search-bar">
                <form action="index.php" method="GET">
                    <input type="hidden" name="action" value="timkiem">
                    <input type="text" name="q" placeholder="Tìm kiếm sản phẩm, thương hiệu...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="nav-icons">
                <a href="index.php?action=cart" class="nav-icon-link" title="Giỏ hàng">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                
                <?php if (isset($user) && $hoten != ''): ?>
                    <div class="user-info">
                        <i class="fas fa-user-circle" style="font-size: 1.5rem; vertical-align: middle;"></i>
                        <span><?= htmlspecialchars($hoten) ?> <i class="fas fa-caret-down"></i></span>

                        <div class="user-dropdown">
                            <a href="index.php?action=hoso"><i class="fas fa-id-card"></i> Hồ sơ cá nhân</a>
                            <a href="index.php?action=donhang"><i class="fas fa-receipt"></i> Quản lý đơn hàng</a>
                            <a href="index.php?action=yeuthich"><i class="fas fa-heart"></i> Danh sách yêu thích</a>
                            <a href="index.php?action=dangxuat"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="auth-links">
                        <a href="index.php?action=dangky">Đăng ký</a>
                        <a href="index.php?action=dangnhap">Đăng nhập</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
    
    <nav class="category-nav">
        <div class="container">
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li>
                        <a href="index.php?action=danhmuc&id=<?= $category['id'] ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container">
            
            <section class="top-grid">
                <div class="main-banner">
                    <i class="fas fa-ad"></i> <span><?= htmlspecialchars($banners[0]['title'] ?? 'Banner Quảng Cáo Lớn') ?></span>
                </div>
                
                <div class="sub-banners">
                    <a href="#" class="sub-banner"><i class="fas fa-fire-alt"></i> Săn Deal Hot!</a>
                    <a href="index.php?action=tintuc" class="sub-banner"><i class="fas fa-newspaper"></i> Tin Tức & Ưu Đãi</a>
                </div>
            </section>
            
            <section class="section-card">
                <h2 class="section-title"><i class="fas fa-th-large"></i> Danh Mục Nổi Bật</h2>
                <div class="category-icon-grid">
                    <div class="category-icon"><a href="#"><i class="fas fa-mobile-alt"></i><span>Điện thoại</span></a></div>
                    <div class="category-icon"><a href="#"><i class="fas fa-laptop"></i><span>Laptop</span></a></div>
                    <div class="category-icon"><a href="#"><i class="fas fa-headphones"></i><span>Phụ kiện</span></a></div>
                    <div class="category-icon"><a href="#"><i class="fas fa-clock"></i><span>Đồng hồ</span></a></div>
                    <div class="category-icon"><a href="#"><i class="fas fa-tshirt"></i><span>Thời trang</span></a></div>
                    <div class="category-icon"><a href="#"><i class="fas fa-utensils"></i><span>Đồ gia dụng</span></a></div>
                    <div class="category-icon"><a href="#"><i class="fas fa-baby-carriage"></i><span>Mẹ & Bé</span></a></div>
                    <div class="category-icon"><a href="#"><i class="fas fa-ellipsis-h"></i><span>Xem tất cả</span></a></div>
                </div>
            </section>
            
            <section class="section-card">
                <h2 class="section-title"><i class="fas fa-star"></i> Gợi Ý Hôm Nay (Sản phẩm nổi bật/mới)</h2>
                <div class="products-grid">
                    <?php 
                        $combined_products = array_merge($featured_products, $new_products);
                        if (!empty($combined_products)): 
                            foreach ($combined_products as $product): 
                    ?>
                        <div class="product-card">
                            <a href="index.php?action=chitietsanpham&id=<?= $product['id'] ?>" title="<?= htmlspecialchars($product['name']) ?>">
                                <div class="product-image">
                                    <i class="fas fa-image"></i> </div>
                                <div class="product-info">
                                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                                    <p class="price"><?= number_format($product['price'] ?? 0, 0, ',', '.') ?>₫</p>
                                </div>
                            </a>
                            <div style="padding: 0 10px 10px;">
                                <button class="add-to-cart" type="button" data-product-id="<?= $product['id'] ?>">
                                    <i class="fas fa-plus"></i> Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    <?php 
                            endforeach; 
                        else: 
                    ?>
                        <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #777;">
                            <p><i class="fas fa-box-open"></i> Không có sản phẩm nào được gợi ý.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
            
        </div>
    </main>

    <footer>
        <div class="container">
            <p>© 2025 Shopee Mini. <i class="far fa-copyright"></i> Được tạo bởi nhóm 4.</p>
            <p>Chức năng: <a href="index.php?action=dathang" style="color: #ee4d2d; text-decoration: none;">Đặt hàng</a> | <a href="index.php?action=danhgia" style="color: #ee4d2d; text-decoration: none;">Đánh giá</a></p>
        </div>
    </footer>

    <script>
        // JavaScript cho chức năng thêm vào giỏ hàng giả lập
        document.addEventListener('DOMContentLoaded', function () {
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    // **QUAN TRỌNG: Ngăn chặn sự kiện click lan truyền lên thẻ cha (thẻ <a>)
                    e.stopPropagation(); 
                    e.preventDefault(); 
                    
                    const productId = this.getAttribute('data-product-id');
                    alert('Đã thêm sản phẩm ID: ' + productId + ' vào Giỏ hàng (Chức năng 5)!');
                });
            });
            
            // Cải thiện hiển thị tên user khi không có dữ liệu
            const userInfoSpan = document.querySelector('.user-info span');
            if (userInfoSpan && userInfoSpan.textContent.trim().startsWith('<i class="fas fa-caret-down">')) {
                userInfoSpan.textContent = 'Tài khoản ';
                userInfoSpan.innerHTML += '<i class="fas fa-caret-down"></i>';
            }
        });
    </script>
</body>
</html>