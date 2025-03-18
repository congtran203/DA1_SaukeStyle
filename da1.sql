-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 04, 2024 lúc 04:50 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `da1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(255) DEFAULT NULL,
  `cate_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cate_id`, `cate_name`, `cate_image`) VALUES
(1, 'Áo thun', 'tshirt.png'),
(2, 'Áo sơ mi', 'shirt.png'),
(3, 'Áo khoác', 'jacket.png'),
(4, 'Quần', 'pants.png'),
(5, 'Balo', 'balo.png'),
(6, 'Phụ kiện', 'accessories.png'),
(13, 'a cong', '271138786_970087580580277_1345205034434895745_n.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `delivery_status` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `pro_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(255) DEFAULT NULL,
  `pro_image` varchar(255) DEFAULT NULL,
  `pro_price` decimal(10,2) DEFAULT NULL,
  `pro_description` text DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_image`, `pro_price`, `pro_description`, `cate_id`) VALUES
(1, 'Áo thun Akash tee black', 'aothun1.webp', 340000.00, NULL, 1),
(2, 'Áo thun Bình tây Market tea black', 'aothun2.webp', 210000.00, NULL, 1),
(3, 'Áo thun CRAYON DEVIL TEE', 'aothun3.webp', 240000.00, NULL, 1),
(4, 'Áo thun Chalk logo tee black', 'aothun4.webp', 265000.00, NULL, 1),
(5, 'Áo thun DREAM TEE', 'aothun5.webp', 245000.00, NULL, 1),
(6, 'Áo thun Friends tee', 'aothun6.webp', 215000.00, NULL, 1),
(7, 'Áo thun Glowing logo tee', 'aothun7.webp', 199000.00, NULL, 1),
(8, 'Áo thun LONELINESS TEE', 'aothun8.webp', 210000.00, NULL, 1),
(9, 'Áo thun patch tee ', 'aothun9.webp', 230000.00, NULL, 1),
(10, 'Áo thun shadow tee', 'aothun10.webp', 249000.00, NULL, 1),
(11, 'Áo thun SNOWY MOUNTAIN TEE', 'aothun11.webp', 219000.00, NULL, 1),
(12, 'Áo thun Tân định church tee', 'aothun12.webp', 259000.00, NULL, 1),
(13, 'Áo thun town tee', 'aothun13.webp', 229000.00, NULL, 1),
(14, 'Áo thun URANUS TEE', 'aothun14.webp', 259000.00, NULL, 1),
(15, 'Áo thun Vsc tee white', 'aothun15.webp', 279000.00, NULL, 1),
(16, 'Áo thun Zoo park tee', 'aothun16.webp', 249000.00, NULL, 1),
(49, '2-TONE ZIP JACKET', 'aokhoac1.webp', 340000.00, NULL, 3),
(50, 'BUTTON WINDBREAKER JACKET - CREAM', 'aokhoac2.webp', 500000.00, NULL, 3),
(51, 'MULTICOLOR EMBROIDERED JACKET', 'aokhoac3.webp', 350000.00, NULL, 3),
(52, 'NOWSAIGON COACHES JACKET-BLACK', 'aokhoac4.webp', 400000.00, NULL, 3),
(53, 'NOWSAIGON COACHES JACKET-PINK', 'aokhoac5.webp\r\n', 450000.00, NULL, 3),
(54, 'NOWSAIGON COACHES JACKET', 'aokhoac6.webp', 360000.00, NULL, 3),
(55, 'CARGO NYLON SHORTS - BLACK', 'quan1.webp\r\n', 200000.00, NULL, 4),
(56, 'DISTRESSED STRETCH SKINNY JEANS', 'quan2.webp', 250000.00, NULL, 4),
(57, 'EMBROIDERED NOWSG SWEATSHORTS - BLACK', 'quan3.webp', 300000.00, NULL, 4),
(58, 'KHAKI PANTS - BLACK', 'quan4.webp', 200000.00, NULL, 4),
(59, 'KHAKI PANTS - CREAM', 'quan5.webp', 250000.00, NULL, 4),
(63, 'CARGO NYLON SHORTS - BLACK', 'quan6.webp', 450000.00, NULL, 4),
(64, 'DRAGON PRINTED SHIRTS - BLACK', 'somi1.webp', 300000.00, NULL, 2),
(65, 'DRAGON PRINTED SHIRTS - BLUE', 'somi2.webp', 300000.00, NULL, 2),
(66, 'DRAGON PRINTED SHIRTS - RED', 'somi3.webp', 300000.00, NULL, 2),
(67, 'DRAGON PRINTED SHIRTS - GREEN', 'somi4.webp', 300000.00, NULL, 2),
(70, 'BUTTON WINDBREAKER JACKET - BLACK', 'aokhoac7.webp', 430000.00, NULL, 3),
(71, 'INTRO FLEECE VARSITY JACKET', 'aokhoac8.webp', 400000.00, NULL, 3),
(72, 'kính mát Polygon', 'phukien1.webp', 200000.00, NULL, 6),
(73, 'Kính mát Rhombus', 'phukien2.webp', 300000.00, NULL, 6),
(74, 'Kính mát Rhound', 'phukien3.webp', 200000.00, NULL, 6),
(75, 'Kính mát Dior', 'phukien4.webp', 400000.00, NULL, 6),
(76, 'Kính mát Audi\r\n', 'phukien5.webp', 230000.00, NULL, 6),
(77, 'Kính mát Chanel', 'phukien6.webp', 360000.00, NULL, 6),
(78, 'Kính mát Burberry', 'phukien7.webp', 250000.00, NULL, 6),
(79, 'Mũ hiphop nam', 'phukien8.jpg', 150000.00, NULL, 6),
(80, 'Mũ lưỡi trai calssic', 'phukien9.jpg', 120000.00, NULL, 6),
(81, 'Mũ snapback', 'phukien10.jpg', 160000.00, NULL, 6),
(82, 'Mũ snapback sn49', 'phukien11.jpg', 300000.00, NULL, 6),
(83, 'Mũ snapback sn101', 'phukien12.jpg', 250000.00, NULL, 6),
(84, 'Mũ snapback sn102', 'phukien13.jpg', 300000.00, NULL, 6),
(85, 'Vòng đeo tay sokolov', 'phukien14.avif', 450000.00, NULL, 6),
(86, 'Vòng đeo tay sokolov bạc', 'phukien15.avif', 350000.00, NULL, 6),
(87, 'vòng tay dainiel', 'phukien16.avif', 400000.00, NULL, 6),
(88, 'Vòng tay dainiel vàng hồng', 'phukien17.avif', 600000.00, NULL, 6),
(89, 'Vòng tay dainiel welling', 'phukien18.avif', 550000.00, NULL, 6),
(90, 'vòng tay dainiel welling pave', 'phukien19.avif', 450000.00, NULL, 6),
(91, 'Túi đeo chéo Tomtoc X Monster Hunter', 'balo1.jpg', 430000.00, NULL, 5),
(92, 'Túi đeo chéo Tomtoc H02 Urban Codura Sling Bag Travel', 'balo2.jpg', 400000.00, NULL, 5),
(93, 'Túi đeo chéo Tomtoc H13-A01 Tablet Shoulder Bag', 'balo3.jpg', 600000.00, NULL, 5),
(94, 'Túi đeo chéo Tomtoc A54-A1D1 CroxBody', 'balo4.jpg', 360000.00, NULL, 5),
(95, 'Túi đeo chéo Tomtoc Slash-T27', 'balo5.jpg', 450000.00, NULL, 5),
(96, 'Túi đeo chéo Tomtoc A0532K1', 'balo6.jpg', 300000.00, NULL, 5),
(97, 'Túi đeo Mikkor The Panny Pack - Black', 'balo7.jpg', 400000.00, NULL, 5),
(98, 'Túi - Cặp Mikkor The Felix Messenger', 'balo8.jpg', 350000.00, NULL, 5),
(111, 'aaaa', '1732989219_271138786_970087580580277_1345205034434895745_n.jpg', 10000000.00, 'aaaa', 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `variant_id` int(11) NOT NULL,
  `variant_size` varchar(50) DEFAULT NULL,
  `variant_price` decimal(10,2) DEFAULT NULL,
  `variant_material` varchar(50) DEFAULT NULL,
  `variant_discounted_price` decimal(10,2) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`variant_id`, `variant_size`, `variant_price`, `variant_material`, `variant_discounted_price`, `pro_id`) VALUES
(1, 'S', 340000.00, 'COTTON', 310000.00, 1),
(2, 'L', 360000.00, 'COTTON', 320000.00, 1),
(3, 'XL', 370000.00, 'COTTON', 330000.00, 1),
(4, 'S', 210000.00, 'COTTON', 200000.00, 2),
(5, 'L', 230000.00, 'COTTON', 220000.00, 2),
(6, 'M', 240000.00, 'COTTON', 220000.00, 3),
(7, 'L', 250000.00, 'COTTON', 240000.00, 3),
(8, 'XL', 260000.00, 'COTTON', 250000.00, 3),
(9, 'M', 265000.00, 'COTTON', 250000.00, 4),
(10, 'L', 275000.00, 'COTTON', 260000.00, 4),
(11, 'XXL', 285000.00, 'COTTON', 270000.00, 4),
(12, 'S', 245000.00, 'COTTON', 235000.00, 5),
(13, 'M', 255000.00, 'COTTON', 245000.00, 5),
(14, 'L', 265000.00, 'COTTON', 255000.00, 5),
(15, 'M', 215000.00, 'COTTON', 205000.00, 6),
(16, 'L', 225000.00, 'COTTON', 215000.00, 6),
(17, 'S', 199000.00, 'COTTON', NULL, 7),
(18, 'M', 209000.00, 'COTTON', NULL, 7),
(19, 'XL', 219000.00, 'COTTON', NULL, 7),
(20, 'S', 210000.00, 'COTTON', 200000.00, 8),
(21, 'L', 220000.00, 'COTTON', 210000.00, 8),
(22, 'L', 230000.00, 'COTTON', 220000.00, 9),
(23, 'XL', 240000.00, 'COTTON', 230000.00, 9),
(24, 'S', 249000.00, 'COTTON', NULL, 10),
(25, 'M', 259000.00, 'COTTON', NULL, 10),
(26, 'L', 219000.00, 'COTTON', NULL, 11),
(27, 'XL', 229000.00, 'COTTON', NULL, 11),
(28, 'XXL', 239000.00, 'COTTON', NULL, 11),
(29, 'S', 259000.00, 'COTTON', NULL, 12),
(30, 'M', 269000.00, 'COTTON', NULL, 12),
(31, 'L', 279000.00, 'COTTON', NULL, 12),
(32, 'S', 229000.00, 'COTTON', 219000.00, 13),
(33, '239000', 0.00, 'COTTON', 229000.00, 13),
(34, 'L', 249000.00, 'COTTON', 239000.00, 13),
(35, 'L', 259000.00, 'COTTON', 249000.00, 14),
(36, 'XL', 269000.00, 'COTTON', 259000.00, 14),
(37, 'M', 279000.00, 'COTTON', 269000.00, 15),
(38, 'L', 289000.00, 'COTTON', 279000.00, 15),
(39, 'L', 249000.00, 'COTTON', 239000.00, 16),
(40, 'XL', 259000.00, 'COTTON', 249000.00, 16),
(41, 'M', 340000.00, 'Vải dù', 320000.00, 49),
(42, 'XL', 360000.00, 'Vải dù', 340000.00, 49),
(43, 'L', 500000.00, 'Vãi dù', 470000.00, 50),
(44, 'XXL', 540000.00, 'Vãi dù', 510000.00, 50),
(45, 'S', 350000.00, 'Vải dù', 340000.00, 51),
(46, 'M', 370000.00, 'Vải dù', 360000.00, 51),
(47, 'L', 400000.00, 'Vãi dù', 390000.00, 52),
(48, 'XL', 420000.00, 'Vãi dù', 400000.00, 52),
(49, 'M', 450000.00, 'Vãi dù', 430000.00, 53),
(50, 'L', 470000.00, 'Vãi dù', 450000.00, 53),
(51, 'M', 360000.00, 'Vải dù', 350000.00, 54),
(52, 'L', 380000.00, 'Vãi dù', 360000.00, 54),
(53, 'L', 430000.00, 'Vãi dù', 410000.00, 70),
(54, 'XL', 450000.00, 'Vãi dù', 430000.00, 70),
(55, 'M', 400000.00, 'Vải dù', 390000.00, 71),
(56, 'L', 420000.00, 'Vãi dù', 410000.00, 71),
(57, 'M', 200000.00, 'KAKI', 190000.00, 55),
(58, 'L', 220000.00, 'KAKI', 210000.00, 55),
(59, 'L', 250000.00, 'JEANS', 230000.00, 56),
(60, 'XL', 260000.00, 'JEANS', 250000.00, 56),
(61, 'M', 300000.00, 'KAKI', 290000.00, 57),
(62, 'L', 320000.00, 'KAKI', 310000.00, 57),
(63, 'L', 200000.00, 'KAKI', 190000.00, 58),
(64, 'XL', 220000.00, 'KAKI', 210000.00, 58),
(65, 'M', 250000.00, 'KAKI', 240000.00, 59),
(66, 'L', 260000.00, 'KAKI', 250000.00, 59),
(67, 'M', 450000.00, 'KAKI', 430000.00, 63),
(68, 'L', 470000.00, 'KAKI', 450000.00, 63),
(69, 'M', 300000.00, 'COTTON', 290000.00, 64),
(70, 'L', 320000.00, 'COTTON', 300000.00, 64),
(71, 'L', 320000.00, 'COTTON', 300000.00, 65),
(72, 'XL', 340000.00, 'COTTON', 320000.00, 65),
(73, 'M', 300000.00, 'COTTON', 290000.00, 66),
(74, 'L', 320000.00, 'COTTON', 320000.00, 66),
(75, 'M', 300000.00, 'COTTON', 290000.00, 67),
(76, 'L', 320000.00, 'COTTON', 320000.00, 67);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product__images`
--

CREATE TABLE `product__images` (
  `pro_img_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `account`, `password`, `email`, `address`, `role`, `phone`) VALUES
(3, 'Nguyễn Nhật Huy', 'nn23012001', '$2y$10$VLwpbAUUzyR2g6td0W8g7.DLfJgDTVnewVGoe6O4mo25/zNqr9A1W', 'nn23012001@gmail.com', '133/5 hồ văn huê', 'admin', '0397736714');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`variant_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Chỉ mục cho bảng `product__images`
--
ALTER TABLE `product__images`
  ADD PRIMARY KEY (`pro_img_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `account` (`account`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `product__images`
--
ALTER TABLE `product__images`
  MODIFY `pro_img_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`cate_id`);

--
-- Các ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);

--
-- Các ràng buộc cho bảng `product__images`
--
ALTER TABLE `product__images`
  ADD CONSTRAINT `product__images_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
