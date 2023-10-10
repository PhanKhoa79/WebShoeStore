-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3310
-- Thời gian đã tạo: Th10 10, 2023 lúc 02:51 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `projectphp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_product`
--

CREATE TABLE `category_product` (
  `id_category` varchar(20) NOT NULL,
  `name_category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_product`
--

INSERT INTO `category_product` (`id_category`, `name_category`) VALUES
('ADS', 'Giày Adidas'),
('CV', 'Giày Converse'),
('JORDAN', 'Giày Jordan'),
('LV', 'Giày LV Tranner'),
('MLB', 'Giày MLB'),
('NB', 'Giày New Balance'),
('NIKE', 'Giày Nike'),
('SALE', 'Flash Sale');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prodcut`
--

CREATE TABLE `prodcut` (
  `IdProduct` varchar(50) NOT NULL,
  `NameProduct` varchar(100) NOT NULL,
  `QuantityProduct` int(11) DEFAULT NULL,
  `DesProduct` varchar(200) DEFAULT NULL,
  `ImageProduct` varchar(100) DEFAULT NULL,
  `Size` varchar(50) DEFAULT NULL,
  `Price` varchar(20) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `ProvideProducts` varchar(100) DEFAULT NULL,
  `id_category` varchar(20) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_product`
--

CREATE TABLE `type_product` (
  `id_type` int(11) NOT NULL,
  `name_type` varchar(50) DEFAULT NULL,
  `id_category` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type_product`
--

INSERT INTO `type_product` (`id_type`, `name_type`, `id_category`) VALUES
(8, 'NB550', 'NB'),
(9, 'NB300', 'NB'),
(10, 'ULTRA BOOST', 'ADS'),
(11, 'SUPER START', 'ADS'),
(12, 'AIR FORCE 1', 'NIKE'),
(13, 'SB DUNK', 'NIKE'),
(14, 'JORDAN 1', 'JORDAN'),
(15, 'JORDAN 4', 'JORDAN');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `PassWord` varchar(50) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `Avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`ID`, `UserName`, `PassWord`, `Email`, `role`, `Avatar`) VALUES
(18, 'khoahihi79', '12345678', 'admin@gmail.com', 1, NULL),
(19, 'khanhehe79', '12345678', 'khanhhehe@gmail.com', 0, '../assets/img/avatar.png'),
(20, 'khoahaha79', '12345678', 'khoahaha@gmail.com', 0, NULL),
(21, 'Hiếu ăn cứt', '12345678', 'hieuancut@gmail.com', 0, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id_category`);

--
-- Chỉ mục cho bảng `prodcut`
--
ALTER TABLE `prodcut`
  ADD PRIMARY KEY (`IdProduct`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_type` (`id_type`);

--
-- Chỉ mục cho bảng `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`id_type`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `type_product`
--
ALTER TABLE `type_product`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `prodcut`
--
ALTER TABLE `prodcut`
  ADD CONSTRAINT `prodcut_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category_product` (`id_category`),
  ADD CONSTRAINT `prodcut_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `type_product` (`id_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
