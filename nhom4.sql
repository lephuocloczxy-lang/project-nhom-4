-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 03, 2025 lúc 02:17 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhom4`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`, `link`, `position`, `status`) VALUES
(1, 'Siêu sale tháng 12', 'banner1.jpg', '/san-pham', 1, 1),
(2, 'iPhone 15 Series', 'banner2.jpg', '/iphone', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `parent_id`, `status`) VALUES
(1, 'Điện thoại', 'dien-thoai', '?', NULL, 1),
(2, 'Laptop', 'laptop', '?', NULL, 1),
(3, 'Tablet', 'tablet', '?', NULL, 1),
(4, 'Tai nghe', 'tai-nghe', '?', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `id` int(11) NOT NULL,
  `hoten` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `matkhau` varchar(255) DEFAULT NULL,
  `dienthoai` varchar(20) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `gioitinh` varchar(10) DEFAULT NULL,
  `ngaysinh` date DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0,
  `reset_token` varchar(255) DEFAULT NULL,
  `trangthai` tinyint(4) DEFAULT 0,
  `verify_token` varchar(255) DEFAULT NULL,
  `reset_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`id`, `hoten`, `email`, `matkhau`, `dienthoai`, `diachi`, `avatar`, `gioitinh`, `ngaysinh`, `verified`, `reset_token`, `trangthai`, `verify_token`, `reset_expire`) VALUES
(12, 'Phạm Quang Nhựt', 'pqnhut1612@gmail.com', '$2y$10$cwgx5SiiqpopFauy4JMxU.v0wtyXUKoE5dgElQ59qCNafuWJXycjG', '0854153971', 'năm căn, lai hòa1', 'uploads/1762136472_0ef95b1c7ad9c6879fc8.jpg', 'Nam', '2004-12-16', 0, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `stock_quantity` int(11) DEFAULT 10,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `featured`, `status`, `stock_quantity`, `created_at`) VALUES
(1, 'iPhone 15 Pro', 25990000.00, 'iphone15-pro.jpg', 'iPhone 15 Pro 128GB - Titan tự nhiên', 1, 1, 15, '2025-11-03 12:35:07'),
(2, 'Samsung Galaxy S24 Ultra', 28990000.00, 'samsung-s24-ultra.jpg', 'Samsung Galaxy S24 Ultra 5G 256GB', 1, 1, 12, '2025-11-03 12:35:07'),
(3, 'MacBook Air M2', 32990000.00, 'macbook-air-m2.jpg', 'MacBook Air 13 inch chip M2 256GB', 1, 1, 8, '2025-11-03 12:35:07'),
(4, 'AirPods Pro 2', 7490000.00, 'airpods-pro-2.jpg', 'AirPods Pro thế hệ 2 - Chống ồn chủ động', 0, 1, 20, '2025-11-03 12:35:07'),
(5, 'iPad Air 5', 17990000.00, 'ipad-air-5.jpg', 'iPad Air 5 64GB WiFi - Xanh dương', 0, 1, 10, '2025-11-03 12:35:07'),
(6, 'Apple Watch Series 9', 11990000.00, 'apple-watch-9.jpg', 'Apple Watch Series 9 45mm - GPS', 1, 1, 18, '2025-11-03 12:35:07'),
(7, 'Sony WH-1000XM5', 8990000.00, 'sony-wh1000xm5.jpg', 'Tai nghe Sony WH-1000XM5 - Chống ồn', 0, 1, 25, '2025-11-03 12:35:07'),
(8, 'Dell XPS 13', 24990000.00, 'dell-xps-13.jpg', 'Laptop Dell XPS 13 9315 - Core i7', 1, 1, 6, '2025-11-03 12:35:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `description`, `image`, `start_date`, `end_date`, `status`) VALUES
(1, 'Giảm 20% tất cả sản phẩm', 'Áp dụng cho đơn hàng từ 2 triệu', NULL, '2025-11-03', '2025-12-03', 1),
(2, 'Miễn phí vận chuyển', 'Miễn phí vận chuyển toàn quốc', NULL, '2025-11-03', '2025-11-18', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `khachhang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
