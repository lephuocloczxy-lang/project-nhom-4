<?php
// src/Views/home/index.php
if (!isset($featured_products)) $featured_products = [];
if (!isset($new_products)) $new_products = [];
if (!isset($promotions)) $promotions = [];
if (!isset($banners)) $banners = [];
if (!isset($news)) $news = [];
if (!isset($categories)) $categories = [];
if (!isset($user)) $user = null;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Cửa hàng</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        /* Search Bar */
        .search-bar {
            flex: 1;
            max-width: 500px;
            margin: 0 20px;
        }

        .search-bar form {
            display: flex;
        }

        .search-bar input {
            flex: 1;
            padding: 12px 16px;
            border: none;
            border-radius: 25px 0 0 25px;
            font-size: 14px;
            outline: none;
        }

        .search-bar button {
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
        }

        .product-image {
            width: 100%;
            height: 200px;
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
            }
        }
    </style>
</head>

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
                    </div>
                <?php endif; ?>
            </div>
        </div>
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
        </div>
    </footer>

    <script>
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

</html>