-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th7 17, 2024 lúc 10:58 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `SalesSQL`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `apartment_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `province`, `district`, `ward`, `apartment_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(195, 45, 'Trà Vinh', 'Cầu Ngang', 'Mỹ Long Nam', '166', '2024-07-17 00:57:04', '2024-07-17 00:57:04', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deletad_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `deletad_at`) VALUES
(1, 'admin1', '12345678', 'admin1@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Levents', NULL, NULL, NULL),
(2, 'Hades', NULL, NULL, NULL),
(3, 'Coolmate', NULL, NULL, NULL),
(14, 'Áo Cool', '2024-06-30 00:43:56', '2024-06-30 08:30:32', '2024-06-30 08:30:32'),
(15, 'Áo ViColl', '2024-06-30 00:45:31', '2024-06-30 08:30:34', '2024-06-30 08:30:34'),
(16, 'Áo ViCods', '2024-06-30 00:46:01', '2024-06-30 00:51:04', '2024-06-30 00:51:04'),
(17, 'dsadsa123', '2024-06-30 00:47:22', '2024-06-30 00:50:48', '2024-06-30 00:50:48'),
(18, 'Nike', '2024-07-12 23:05:32', '2024-07-12 23:05:38', '2024-07-12 23:05:38'),
(19, 'Adadas', '2024-07-17 01:02:06', '2024-07-17 01:02:23', '2024-07-17 01:02:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `parent_id`, `slug`) VALUES
(3, 'Áo Polo', NULL, NULL, NULL, 1, 'ao-polo'),
(4, 'Áo Thun', NULL, NULL, NULL, 1, 'ao-thun'),
(5, 'Áo Khoác', NULL, NULL, NULL, 1, 'ao-khoac'),
(6, 'Quần jeans', NULL, NULL, NULL, 1, 'quan-jeans'),
(8, 'Quần Short', NULL, '2024-07-10 05:50:11', NULL, 1, 'quan-short'),
(17, 'Quần jogger', '2024-07-05 19:34:55', '2024-07-12 23:04:28', NULL, 1, 'quan-jogger'),
(19, 'Quần Âu', '2024-07-17 01:03:54', '2024-07-17 01:03:54', NULL, 1, 'quan-au');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Đen', NULL, NULL, NULL),
(3, 'Xám', NULL, NULL, NULL),
(4, 'Đỏ', NULL, NULL, NULL),
(5, 'Vàng', NULL, NULL, NULL),
(6, 'Xanh', NULL, NULL, NULL),
(7, 'Ghi', NULL, NULL, NULL),
(8, 'Xanh Nhạt', NULL, NULL, NULL),
(9, 'Cream', NULL, NULL, NULL),
(10, 'Be', NULL, NULL, NULL),
(11, 'Nâu', NULL, NULL, NULL),
(12, 'Xanh Rêu', NULL, '2024-06-30 01:29:36', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_money` double NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `transport_fee` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_money`, `order_status`, `deleted_at`, `transport_fee`, `note`, `created_at`, `updated_at`) VALUES
(62, 45, 640000, 1, NULL, 'Free Ship', 'vận chuyển cẩn thận', '2024-07-17', '2024-07-17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `product_size_id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `size`, `product_size_id`, `color`, `unit_price`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(58, 62, 55, 'M', 2, 'Đỏ', 320000, 2, '2024-07-17 00:58:11', '2024-07-17 00:58:11', NULL);

--
-- Bẫy `order_details`
--
DELIMITER $$
CREATE TRIGGER `validate_quantity` AFTER INSERT ON `order_details` FOR EACH ROW BEGIN
            declare _quantity int;
            select quantity into _quantity from products_size where id = new.product_size_id;
            if (new.quantity <= 0 || _quantity < new.quantity) then
                SIGNAL sqlstate "45001" set message_text = "error";
            end if;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(100) NOT NULL,
  `price_import` double NOT NULL,
  `product_sold` int(11) DEFAULT NULL,
  `price_sell` double NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `thumnail` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price_import`, `product_sold`, `price_sell`, `description`, `status`, `category_id`, `brand_id`, `created_at`, `updated_at`, `deleted_at`, `thumnail`, `quantity`) VALUES
(55, 'Graphic Tee', 300000, 27, 320000, 'Áo có độ dài phủ qua mông, phần tay áo rộng rãi,  form dáng thoải mái khi mặc. Màu sắc nổi bật.', 1, 4, 1, '2024-07-06 16:11:05', '2024-07-17 01:00:25', NULL, 'at0213.png', 0),
(56, 'Popular Tee', 300000, NULL, 320000, 'Áo có độ dài phủ qua mông, phần tay áo rộng rãi,  form dáng thoải mái khi mặc. Màu sắc nổi bật.', 1, 4, 1, '2024-07-06 16:12:21', '2024-07-06 16:12:21', NULL, 'at0153.png', NULL),
(57, 'I Love Me Tee', 300000, NULL, 320000, 'Áo có độ dài phủ qua mông, phần tay áo rộng rãi,  form dáng thoải mái khi mặc. Màu sắc nổi bật.', 1, 4, 1, '2024-07-06 16:14:37', '2024-07-06 16:14:37', NULL, 'at97.png', NULL),
(58, 'Classic Regular Polo', 300000, NULL, 350000, '- Chất Liệu: Cá Sấu TC 2 Chiều\r\n- Form Áo: Regular\r\n- Độ Co Giãn: Trung Bình\r\n- Tay Áo: Tay Ngắn\r\n- Phong Cách: Casual\r\n- Chi Tiết: Logo Thêu', 1, 3, 1, '2024-07-06 16:17:37', '2024-07-06 16:17:37', NULL, 'ap58.png', NULL),
(59, 'Classic Oversized Polo', 300000, NULL, 350000, 'Chất Liệu: Cá Sấu TC 2 Chiều\r\n- Form Áo: Oversize\r\n- Độ Co Giãn: Trung Bình\r\n- Tay Áo: Tay Ngắn\r\n- Phong Cách: Casual\r\n- Chi Tiết: Logo Thêu', 1, 3, 1, '2024-07-06 16:18:59', '2024-07-06 16:18:59', NULL, 'ap012.png', NULL),
(60, 'STRIPE POLO', 300000, NULL, 350000, 'Chất Liệu: Cá Sấu TC 2 Chiều\r\n- Form Áo: Regular\r\n- Độ Co Giãn: Trung Bình\r\n- Tay Áo: Tay Ngắn\r\n- Phong Cách: Casual\r\n- Chi Tiết: Logo Thêu', 1, 3, 1, '2024-07-06 16:20:14', '2024-07-06 16:20:14', NULL, 'ap022.png', NULL),
(61, 'Classic Hoodie', 450000, NULL, 470000, 'Form oversize mặc thoải mái, độ dài áo ngang mông, vải dày dặn.', 1, 5, 1, '2024-07-06 16:24:20', '2024-07-06 16:24:20', NULL, 'ah19.png', NULL),
(63, 'Quần Jeans Nam Copper Denim Straight', 430000, NULL, 470000, 'Chất liệu: 100% Cotton / 12 Oz\r\nDáng Straigh suông rộng phóng thoáng, thoải mái\r\nVải Denim được wash trước khi may nên không rút và hạn chế ra màu sau khi giặt\r\nCảm giác khi chạm không thô ráp', 1, 6, 3, '2024-07-11 21:55:21', '2024-07-11 21:55:21', NULL, 'qj87.png', NULL),
(64, 'Quần Jeans Nam Basics dáng Straight', 400000, NULL, 420000, 'Chất liệu: Denim\r\nThành phần: 100% Cotton\r\nCông nghệ Laser Marking tạo các vệt hiệu ứng chuẩn xác trên sản phẩm\r\nBề mặt quần không thô ráp\r\nCo giãn tốt giúp quần ôm vừa vặn, thoải mái\r\nDáng Regular Straight suông rộng, thoải mái, không thùng thình', 1, 6, 3, '2024-07-11 22:00:11', '2024-07-11 22:00:11', NULL, 'qj254.png', NULL),
(65, 'Quần Jeans Nam Clean Denim Slimfit S3', 300000, NULL, 309000, 'Công nghệ nhuộm Rope Dyeing mang lại độ bền màu cao hơn cho vải\r\nKiểu dáng: Slim fit, không bo ống, có co giãn nhẹ thoải mái', 1, 6, 3, '2024-07-11 22:07:20', '2024-07-11 22:07:20', NULL, 'qj374.png', NULL),
(66, 'Áo Thun C&S in Mèo', 100000, NULL, 149000, 'Chất liệu: 100% Cotton mềm mại\r\nĐịnh lượng vải: 200gsm, dày dặn', 1, 4, 3, '2024-07-11 22:11:46', '2024-07-11 22:11:46', NULL, 'at0418.png', NULL),
(67, 'Áo Thun Care & Share Than', 100000, NULL, 139000, 'Chất liệu: 100% Cotton\r\nĐịnh lượng vải 220gsm dày dặn\r\nVải được xử lí hoàn thiện giúp bề mặt vải ít xù lông, mềm mịn và bền màu hơn\r\nĐộ dày vải vừa phải, thoải mái, thoáng mát', 1, 4, 3, '2024-07-11 22:14:27', '2024-07-11 22:14:27', NULL, 'at0512.png', NULL),
(68, 'Green Heart Hoodie', 500000, NULL, 600000, 'Form hoodie oversize có độ dài phủ qua mông, phần tay áo rộng rãi, form dáng thoải mái, thoáng mát khi mặc. Màu sắc trung tính, chống bẩn, tôn da, dễ dàng kết hợp với mọi trang phục, phụ kiện.', 1, 5, 1, '2024-07-11 22:23:59', '2024-07-11 22:23:59', NULL, 'ak231.png', NULL),
(69, 'Department Sporty Short Pants', 350000, NULL, 370000, 'Form shortpants với độ dài trên đầu gối, độ rộng vừa phải, thoải mái vận động cả ngày dài. Dễ phối với mọi outfits, cho những buổi cafe với bạn bè hay thể dục hằng ngày.', 1, 8, 1, '2024-07-11 22:25:43', '2024-07-11 22:25:43', NULL, 'qs88.png', NULL),
(70, 'Classic Wrinkle Nylon Cargo ShortPants', 350000, NULL, 400000, 'Form shortpants với độ dài trên đầu gối, độ rộng vừa phải, thoải mái vận động cả ngày dài. Dễ phối với mọi outfits, cho những buổi cafe với bạn bè hay thể dục hằng ngày.', 1, 8, 2, '2024-07-11 22:29:08', '2024-07-12 20:15:20', NULL, 'qs0244.png', NULL),
(71, 'ADAM SPREAD JEANS', 670000, 5, 759000, '• Quần jeans form suông, cạp quần trễ, độ dài phủ gót\r\n• Xử lý wash tạo hiệu ứng riêng biệt \r\n• Quần có hai túi mổ sâu phía trước và hai túi phía sau\r\n• Nameplate inox đính ở nắp túi mặt sau tạo điểm nhấn\r\n• Chất liệu: Jeans', 1, 6, 2, '2024-07-11 22:33:13', '2024-07-15 00:56:48', NULL, '1720849762.png', 0),
(72, 'Quần Âu', 300000, NULL, 350000, 'Quần âu đẹp', 1, 6, 2, '2024-07-17 01:03:42', '2024-07-17 01:03:42', NULL, 'qa97.png', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_color`
--

CREATE TABLE `products_color` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_color`
--

INSERT INTO `products_color` (`id`, `img`, `color_id`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(49, '1720770664.png', 4, 55, '2024-07-12 00:51:04', '2024-07-12 00:51:04', NULL),
(50, '1720849795.png', 2, 71, '2024-07-12 22:49:55', '2024-07-12 22:49:55', NULL),
(51, '1720961355.png', 2, 55, '2024-07-14 05:49:15', '2024-07-14 05:49:15', NULL),
(54, '1721204540.png', 2, 72, '2024-07-17 01:22:20', '2024-07-17 01:22:20', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_size`
--

CREATE TABLE `products_size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_size`
--

INSERT INTO `products_size` (`id`, `product_color_id`, `size_id`, `created_at`, `updated_at`, `quantity`, `deleted_at`) VALUES
(55, 49, 1, '2024-07-12 00:51:04', '2024-07-12 00:51:04', 50, NULL),
(56, 49, 2, '2024-07-12 00:51:04', '2024-07-12 00:51:04', 50, NULL),
(58, 50, 1, '2024-07-12 22:49:55', '2024-07-12 22:49:55', 50, NULL),
(59, 50, 2, '2024-07-12 22:49:55', '2024-07-12 22:49:55', 50, NULL),
(60, 50, 3, '2024-07-12 22:49:55', '2024-07-12 22:49:55', 60, NULL),
(61, 51, 1, '2024-07-14 05:49:15', '2024-07-14 05:49:15', 50, NULL),
(62, 51, 2, '2024-07-14 05:49:15', '2024-07-14 05:49:15', 40, NULL),
(67, 54, 1, '2024-07-17 01:22:20', '2024-07-17 01:22:20', 50, NULL),
(68, 54, 2, '2024-07-17 01:22:20', '2024-07-17 01:22:20', 50, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_feedback`
--

CREATE TABLE `product_feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_feedback`
--

INSERT INTO `product_feedback` (`id`, `user_id`, `product_id`, `rating`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(45, 45, 55, 5, 'tuyệt vời', '2024-07-17 00:58:38', '2024-07-17 00:58:38', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'S', NULL, NULL, NULL),
(2, 'M', NULL, NULL, NULL),
(3, 'L', NULL, NULL, NULL),
(4, 'XL', NULL, NULL, NULL),
(5, '2XL', NULL, NULL, NULL),
(7, 'XS', '2024-07-12 23:05:14', '2024-07-12 23:05:14', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `statistical`
--

CREATE TABLE `statistical` (
  `id` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `sales` varchar(50) NOT NULL,
  `profit` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `statistical`
--

INSERT INTO `statistical` (`id`, `order_date`, `sales`, `profit`, `quantity`, `total_order`) VALUES
(26, '2024-07-12', '960000', 60000, 3, 1),
(27, '2024-07-13', '640000', 40000, 2, 2),
(28, '2024-07-15', '5395000', 545000, 10, 8),
(29, '2024-07-17', '640000', 40000, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`, `created_at`, `updated_at`, `deleted_at`, `remember_token`, `email_verified_at`, `expires_at`) VALUES
(45, 'Trần Trí Tài', 'trantritai747@gmail.com', '$2y$12$jBXFBRbVVMTZMZ7qwnSLTetNbU5t4fLPWMC54EWfFJnpyYHm3v8yO', '123456789', '2024-07-17 00:57:04', '2024-07-17 00:57:25', NULL, NULL, '2024-07-17 00:57:25', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_verifies`
--

CREATE TABLE `user_verifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `email_verify` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_id` (`product_size_id`),
  ADD KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `order_details_ibfk_2` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `products_color`
--
ALTER TABLE `products_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_color_color_id_foreign` (`color_id`),
  ADD KEY `products_color_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `products_size`
--
ALTER TABLE `products_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_size_product_color_id_foreign` (`product_color_id`),
  ADD KEY `products_size_size_id_foreign` (`size_id`);

--
-- Chỉ mục cho bảng `product_feedback`
--
ALTER TABLE `product_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `fk_user_feeback` (`user_id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `statistical`
--
ALTER TABLE `statistical`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_verifies`
--
ALTER TABLE `user_verifies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_verifies` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `products_color`
--
ALTER TABLE `products_color`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `products_size`
--
ALTER TABLE `products_size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `product_feedback`
--
ALTER TABLE `product_feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `statistical`
--
ALTER TABLE `statistical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `user_verifies`
--
ALTER TABLE `user_verifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `products_color`
--
ALTER TABLE `products_color`
  ADD CONSTRAINT `products_color_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `products_color_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products_size`
--
ALTER TABLE `products_size`
  ADD CONSTRAINT `products_size_product_color_id_foreign` FOREIGN KEY (`product_color_id`) REFERENCES `products_color` (`id`),
  ADD CONSTRAINT `products_size_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Các ràng buộc cho bảng `product_feedback`
--
ALTER TABLE `product_feedback`
  ADD CONSTRAINT `fk_user_feeback` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `product_feedback_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `user_verifies`
--
ALTER TABLE `user_verifies`
  ADD CONSTRAINT `fk_user_verifies` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
