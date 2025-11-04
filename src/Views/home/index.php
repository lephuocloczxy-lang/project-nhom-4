<?php
// src/Views/home/index.php
<<<<<<< HEAD
// Đảm bảo các biến dữ liệu được định nghĩa
=======
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
if (!isset($featured_products)) $featured_products = [];
if (!isset($new_products)) $new_products = [];
if (!isset($promotions)) $promotions = [];
if (!isset($banners)) $banners = [];
if (!isset($news)) $news = [];
if (!isset($categories)) $categories = [];
if (!isset($user)) $user = null;
<<<<<<< HEAD

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
=======
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Shopee Mini - Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
=======
    <title>Trang chủ - Cửa hàng</title>
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
<<<<<<< HEAD
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5; /* Nền xám nhạt */
=======
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
<<<<<<< HEAD
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
=======
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
<<<<<<< HEAD
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
=======
            flex-wrap: wrap;
            gap: 20px;
        }

        /* User Section */
        .user-section {
            display: flex;
            align-items: center;
        }

        .auth-links a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            padding: 8px 16px;
            border: 1px solid white;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .auth-links a:hover {
            background: white;
            color: #667eea;
        }

        .user-info {
            position: relative;
            display: inline-block;
        }

        .user-info span {
            color: white;
            font-weight: 500;
            cursor: pointer;
            padding: 8px 16px;
            display: inline-block;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            background: white;
            min-width: 180px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1000;
            top: 100%;
            right: 0;
            margin-top: 10px;
        }

        .user-dropdown::before {
            content: '';
            position: absolute;
            top: -10px;
            /* Khoảng cách giữa menu và tên user */
            left: 0;
            width: 100%;
            height: 10px;
            /* Chiều cao vùng an toàn */
            background: transparent;
        }

        .user-dropdown a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #eee;
            transition: background 0.3s ease;
        }

        .user-dropdown a:hover {
            background: #f8f9fa;
            color: #667eea;
        }

        .user-dropdown a:last-child {
            border-bottom: none;
        }

        .user-info:hover .user-dropdown {
            display: block;
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        }

        /* Search Bar */
        .search-bar {
            flex: 1;
<<<<<<< HEAD
            max-width: 600px;
            background: white;
            border-radius: 4px;
            overflow: hidden;
            border: 2px solid #f05d40; /* Viền nổi bật */
=======
            max-width: 500px;
            margin: 0 20px;
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        }

        .search-bar form {
            display: flex;
        }

        .search-bar input {
            flex: 1;
<<<<<<< HEAD
            padding: 10px 15px;
            border: none;
=======
            padding: 12px 16px;
            border: none;
            border-radius: 25px 0 0 25px;
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            font-size: 14px;
            outline: none;
        }

        .search-bar button {
<<<<<<< HEAD
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
=======
            padding: 12px 24px;
            background: #ff6b6b;
            color: white;
            border: none;
            border-radius: 0 25px 25px 0;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .search-bar button:hover {
            background: #ff5252;
        }

        /* Category Menu */
        .category-menu ul {
            display: flex;
            list-style: none;
            gap: 20px;
            flex-wrap: wrap;
        }

        .category-menu a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            transition: background 0.3s ease;
            font-weight: 500;
        }

        .category-menu a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Banner Section */
        .banners {
            padding: 40px 0;
            background: white;
        }

        .banners .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .banner {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .banner:hover {
            transform: translateY(-5px);
        }

        /* Product Sections */
        .featured-products,
        .new-products {
            padding: 60px 0;
            background: white;
            margin: 20px 0;
        }

        .featured-products h2,
        .new-products h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            color: #333;
            position: relative;
        }

        .featured-products h2::after,
        .new-products h2::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 10px auto;
            border-radius: 2px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            border: 1px solid #eee;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        }

        .product-image {
            width: 100%;
            height: 200px;
<<<<<<< HEAD
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
=======
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .product-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .price {
            font-size: 1.3rem;
            font-weight: bold;
            color: #ff6b6b;
            margin-bottom: 15px;
        }

        .add-to-cart {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .add-to-cart:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        /* News & Promotions */
        .news-promotions {
            padding: 60px 0;
            background: #f8f9fa;
        }

        .news-promotions .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .news-section,
        .promotions-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .news-section h2,
        .promotions-section h2 {
            color: #333;
            margin-bottom: 25px;
            font-size: 1.8rem;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }

        .news-item,
        .promo-item {
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .news-item:last-child,
        .promo-item:last-child {
            border-bottom: none;
        }

        .news-item h4,
        .promo-item h4 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .news-item p,
        .promo-item p {
            color: #666;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .news-item a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .news-item a:hover {
            text-decoration: underline;
        }

        .promo-item small {
            color: #888;
            font-size: 0.9rem;
        }

        /* Footer */
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 30px 0;
            margin-top: 40px;
        }

        /* Empty State Styles */
        .empty-state {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 40px;
            grid-column: 1 / -1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header .container {
                flex-direction: column;
                text-align: center;
            }

            .search-bar {
                margin: 15px 0;
                max-width: 100%;
            }

            .category-menu ul {
                justify-content: center;
            }

            .news-promotions .container {
                grid-template-columns: 1fr;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .featured-products h2,
            .new-products h2 {
                font-size: 2rem;
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
            }
        }
    </style>
</head>
<<<<<<< HEAD
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
=======

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <!-- Phần tài khoản -->
            <div class="user-section">
                <?php if (isset($user)): ?>
                    <!-- Đã đăng nhập -->
                    <div class="user-info">
                        <span>Xin chào, <strong><?= htmlspecialchars($user['hoten'] ?? $user['email']) ?></strong></span>
                        <div class="user-dropdown">
                            <a href="index.php?action=hoso">👤 Hồ sơ</a>
                            <a href="index.php?action=doimatkhau">🔐 Đổi mật khẩu</a>
                            <a href="index.php?action=dangxuat">🚪 Đăng xuất</a>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Chưa đăng nhập -->
                    <div class="auth-links">
                        <a href="index.php?action=dangnhap">🔑 Đăng nhập</a>
                        <a href="index.php?action=dangky">📝 Đăng ký</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Thanh tìm kiếm -->
            <div class="search-bar">
                <form action="index.php" method="GET">
                    <input type="hidden" name="action" value="timkiem">
                    <input type="text" name="q" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit">🔍 Tìm kiếm</button>
                </form>
            </div>

            <!-- Menu danh mục -->
            <nav class="category-menu">
                <ul>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="index.php?action=danhmuc&id=<?= $category['id'] ?>">
                                    <?= htmlspecialchars($category['name']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><a href="#">📱 Điện thoại</a></li>
                        <li><a href="#">💻 Laptop</a></li>
                        <li><a href="#">🎧 Phụ kiện</a></li>
                        <li><a href="#">⌚ Đồng hồ</a></li>
                        <li><a href="#">📺 Thiết bị điện tử</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Banner quảng cáo -->
    <section class="banners">
        <div class="container">
            <?php if (!empty($banners)): ?>
                <?php foreach ($banners as $banner): ?>
                    <div class="banner">
                        <?= htmlspecialchars($banner['title'] ?? 'Khuyến mãi đặc biệt') ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="banner">🎉 Khuyến mãi lên đến 50%</div>
                <div class="banner">🚚 Miễn phí vận chuyển</div>
                <div class="banner">💳 Thanh toán an toàn</div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Sản phẩm nổi bật -->
    <section class="featured-products">
        <div class="container">
            <h2>🔥 Sản phẩm nổi bật</h2>
            <div class="products-grid">
                <?php if (!empty($featured_products)): ?>
                    <?php foreach ($featured_products as $product): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <?= htmlspecialchars($product['name']) ?>
                            </div>
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="price"><?= number_format($product['price'] ?? 0) ?>₫</p>
                            <button class="add-to-cart" data-product-id="<?= $product['id'] ?>">
                                🛒 Thêm vào giỏ
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <p>📦 Chưa có sản phẩm nổi bật</p>
                        <small>Sản phẩm sẽ được cập nhật sớm nhất</small>
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
                    </div>
                <?php endif; ?>
            </div>
        </div>
<<<<<<< HEAD
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
=======
    </section>

    <!-- Sản phẩm mới -->
    <section class="new-products">
        <div class="container">
            <h2>🆕 Sản phẩm mới</h2>
            <div class="products-grid">
                <?php if (!empty($new_products)): ?>
                    <?php foreach ($new_products as $product): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <?= htmlspecialchars($product['name']) ?>
                            </div>
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="price"><?= number_format($product['price'] ?? 0) ?>₫</p>
                            <button class="add-to-cart" data-product-id="<?= $product['id'] ?>">
                                🛒 Thêm vào giỏ
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <p>📦 Chưa có sản phẩm mới</p>
                        <small>Sản phẩm mới sẽ được cập nhật sớm nhất</small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Tin tức & Khuyến mãi -->
    <section class="news-promotions">
        <div class="container">
            <div class="news-section">
                <h2>📰 Tin tức mới</h2>
                <?php if (!empty($news)): ?>
                    <?php foreach ($news as $item): ?>
                        <div class="news-item">
                            <h4><?= htmlspecialchars($item['title']) ?></h4>
                            <p><?= substr($item['summary'] ?? 'Nội dung tin tức', 0, 100) ?>...</p>
                            <a href="index.php?action=tintuc&id=<?= $item['id'] ?>">📖 Xem thêm</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="news-item">
                        <h4>Chào mừng đến với cửa hàng</h4>
                        <p>Khám phá những sản phẩm mới nhất và ưu đãi đặc biệt dành cho bạn...</p>
                        <a href="#">📖 Xem thêm</a>
                    </div>
                    <div class="news-item">
                        <h4>Ưu đãi đặc biệt cuối năm</h4>
                        <p>Giảm giá lên đến 50% cho tất cả sản phẩm công nghệ...</p>
                        <a href="#">📖 Xem thêm</a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="promotions-section">
                <h2>🎯 Khuyến mãi hot</h2>
                <?php if (!empty($promotions)): ?>
                    <?php foreach ($promotions as $promo): ?>
                        <div class="promo-item">
                            <h4>🔥 <?= htmlspecialchars($promo['title']) ?></h4>
                            <p><?= $promo['description'] ?? 'Khuyến mãi đặc biệt' ?></p>
                            <small>Áp dụng: <?= date('d/m/Y', strtotime($promo['start_date'] ?? 'now')) ?> -
                                <?= date('d/m/Y', strtotime($promo['end_date'] ?? '+30 days')) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="promo-item">
                        <h4>🔥 Giảm 20% tất cả sản phẩm</h4>
                        <p>Áp dụng cho đơn hàng từ 1 triệu đồng</p>
                        <small>Áp dụng: <?= date('d/m/Y') ?> - <?= date('d/m/Y', strtotime('+30 days')) ?></small>
                    </div>
                    <div class="promo-item">
                        <h4>🎁 Miễn phí vận chuyển</h4>
                        <p>Miễn phí vận chuyển toàn quốc cho đơn hàng từ 500k</p>
                        <small>Áp dụng: <?= date('d/m/Y') ?> - <?= date('d/m/Y', strtotime('+15 days')) ?></small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>© 2024 Cửa hàng công nghệ. All rights reserved.</p>
            <p>📞 Hotline: 1900 1234 | 📧 Email: support@cuahang.com</p>
>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
        </div>
    </footer>

    <script>
<<<<<<< HEAD
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
=======
        // JavaScript đơn giản cho các tương tác
        document.addEventListener('DOMContentLoaded', function () {
            // Hiệu ứng cho nút thêm vào giỏ
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const productId = this.getAttribute('data-product-id');
                    alert('Đã thêm sản phẩm vào giỏ hàng! ID: ' + productId);
                    // Có thể thêm AJAX call ở đây
                });
            });
        });
    </script>
</body>

>>>>>>> f8f5135baf5eda4667bd59475c0c753a61c16618
</html>