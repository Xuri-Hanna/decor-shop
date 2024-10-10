-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 01, 2024 lúc 02:39 PM
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
-- Cơ sở dữ liệu: `shop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile`) VALUES
('6mMEfZSwXn5N1NdQtRtK', 'hieu', 'trunghieu04112003@gmail.com', '123', 'wp9052004-hd-4k-art-wallpapers.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `price`, `qty`) VALUES
('YT6t87Zxc3tGOfHgfDIZ', 'OTNCGOd5MG', 'jKOyGsBWlyb', 150000, 1),
('XM87JMrpoUCY2xrLOcDO', 'OTNCGOd5MG', 'Tuce1JKL4QS', 20, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` int(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `address` varchar(60) NOT NULL,
  `address_type` varchar(60) NOT NULL,
  `method` varchar(60) NOT NULL,
  `product_id` varchar(60) NOT NULL,
  `price` varchar(60) NOT NULL,
  `qty` int(2) NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`, `date`, `status`, `payment_status`) VALUES
('daFEEeXfQXp2hGxDriKA', 'OTNCGOd5MG', 'trung hieu', 2147483647, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'cash on delivery', '2', '40', 2, '', 'in progress', 'pending'),
('DMPZ8qxq5dcFGYYcKbmy', 'OTNCGOd5MG', 'trung hieu', 2147483647, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'cash on delivery', '1', '50', 3, '', 'canceled', 'pending'),
('gUmKQAPhUUCgxAp12GOC', 'OTNCGOd5MG', 'trung hieu', 961169379, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'net banking', '3', '45', 1, '', 'in progress', 'complete'),
('HKeHTip045Xd2bq0Fch2', 'OTNCGOd5MG', 'trung hieu', 2147483647, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'cash on delivery', '2', '40', 2, '', 'in progress', 'complete'),
('hpE83QyMUZDYtiubfLyA', 'OTNCGOd5MG', 'trung hieu', 2147483647, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'cash on delivery', '3', '45', 3, '', 'canceled', 'complete'),
('mZW1HOxQ1yfrrQ0SRouO', 'OTNCGOd5MG', 'trung hieu', 344234234, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'cash on delivery', '2', '40', 6, '', 'in progress', 'complete'),
('Qh36mhZU8g5kjXEXAttg', 'OTNCGOd5MG', 'trung hieu', 961169379, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'net banking', '1', '50', 1, '', 'in progress', 'pending'),
('ROmmkC2pDecPrK36iG2L', 'OTNCGOd5MG', 'trung hieu', 2147483647, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'cash on delivery', '3', '45', 3, '', 'canceled', ''),
('spII3IEaEN4bWp09tzC2', 'OTNCGOd5MG', 'trung hieu', 2147483647, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'cash on delivery', '1', '50', 3, '', 'canceled', ''),
('UbEg5rjhqaOwz4X9jK3F', 'OTNCGOd5MG', 'trung hieu', 961169379, 'phamtrunghieu04112003@gmail.com', '342342,43241fa, feafawfea', 'home', 'net banking', '2', '40', 1, '', 'in progress', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` varchar(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `product_detail` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `product_detail`, `status`) VALUES
('Tuce1JKL4QS', 'latte1', '20', 'latte.jpg', '    product form latte with storm milk', 'active'),
('jKOyGsBWlyb', 'cold brew', '150000', 'coldbrew2.jpg', 'qweqweqw', 'deactive');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
('OTNCGOd5MG', 'trung hieu', 'phamtrunghieu04112003@gmail.com', '04112003', '', ''),
('wQdAKiiPhb', 'trung hieu', 'hieudeptrai04112003@gmail.com', '12345678', '', ''),
('9OSfrGXL4N', 'hieu', 'trunghieu@gmail.com', '04112003', '', ''),
('TgxSr1Y2ld', 'fasfasdf', 'fake@gmail.com', '1234', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishist`
--

CREATE TABLE `wishist` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `wishist`
--

INSERT INTO `wishist` (`id`, `user_id`, `product_id`, `price`) VALUES
('fltYjERmWgZGjzHoUoFc', 'OTNCGOd5MG', 'Tuce1JKL4QS', 20);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
