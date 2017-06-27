-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th6 23, 2017 lúc 05:21 PM
-- Phiên bản máy phục vụ: 5.7.17-0ubuntu0.16.04.1
-- Phiên bản PHP: 5.6.29-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlykhachsan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Hà Nội'),
(2, 'Hồ Chí Minh'),
(3, 'Đà Nẵng'),
(4, 'Hải Phòng'),
(5, 'Cần Thơ'),
(6, 'An Giang'),
(7, 'Bà Rịa Vũng Tàu'),
(8, 'Bạc Liêu'),
(9, 'Bắc Cạn'),
(10, 'Bắc Giang'),
(11, 'Hải Dương'),
(12, 'Bắc Ninh'),
(13, 'Bến Tre'),
(14, 'Bình Dương'),
(15, 'Bình Định'),
(16, 'Bình Phước'),
(17, 'Bình Thuận'),
(18, 'Cà Mau'),
(19, 'Cao Bằng'),
(20, 'Đắk Lắk'),
(21, 'Đăk Nông'),
(22, 'Điện Biên'),
(23, 'Đồng Nai'),
(24, 'Đồng Tháp'),
(25, 'Gia Lai'),
(26, 'Hà Giang'),
(27, 'Hà Nam'),
(28, 'Hà Tĩnh'),
(29, 'Hậu Giang'),
(30, 'Hòa Bình'),
(31, 'Hưng Yên'),
(32, 'Khánh Hòa'),
(33, 'Kiên Giang'),
(34, 'Kon Tum'),
(35, 'Lai Châu'),
(36, 'Lâm Đồng'),
(37, 'Lạng Sơn'),
(38, 'Lào Cai'),
(39, 'Long An'),
(40, 'Nam Định'),
(41, 'Nghệ An'),
(42, 'Ninh Bình'),
(43, 'Ninh Thuận'),
(44, 'Phú Thọ'),
(45, 'Phú Yên'),
(46, 'Quảng Bình'),
(47, 'Quảng Nam'),
(48, 'Quảng Ngãi'),
(49, 'Quảng Ninh'),
(50, 'Quảng Trị'),
(51, 'Sóc Trăng'),
(52, 'Sơn La'),
(53, 'Tây Ninh'),
(54, 'Thái Bình'),
(55, 'Thái Nguyên'),
(56, 'Thanh Hóa'),
(57, 'Huế'),
(58, 'Tiền Giang'),
(59, 'Trà Vinh'),
(60, 'Tuyên Quang'),
(61, 'Vĩnh Long'),
(62, 'Vĩnh Phúc'),
(63, 'Yên Bái');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `birthmonth` int(11) DEFAULT NULL,
  `birthyear` int(11) DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `cmt` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_hotel`
--

CREATE TABLE `customer_hotel` (
  `id_customer` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_city` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `districts`
--

INSERT INTO `districts` (`id`, `name`, `id_city`) VALUES
(1, 'Quận Ba Đình', 1),
(2, 'Quận Cầu Giấy', 1),
(3, 'Quận Đống Đa', 1),
(4, 'Quận Hà Đông', 1),
(5, 'Quận Hai Bà Trưng', 1),
(6, 'Quận Hoàn Kiếm', 1),
(7, 'Quận Hoàng Mai', 1),
(8, 'Quận Long Biên', 1),
(9, 'Quận Tây Hồ', 1),
(10, 'Quận Thanh Xuân', 1),
(11, 'Thị xã Sơn Tây', 1),
(12, 'Huyện Ba Vì', 1),
(13, 'Huyện Chương Mỹ', 1),
(14, 'Huyện Đan Phượng', 1),
(15, 'Huyện Đông Anh', 1),
(16, 'Huyện Gia Lâm', 1),
(17, 'Huyện Hoài Đức', 1),
(18, 'Huyện Mê Linh', 1),
(19, 'Huyện Mỹ Đức', 1),
(20, 'Huyện Phú Xuyên', 1),
(21, 'Huyện Phúc Thọ', 1),
(22, 'Huyện Quốc Oai', 1),
(23, 'Huyện Sóc Sơn', 1),
(24, 'Huyện Thạch Thất', 1),
(25, 'Huyện Thanh Oai', 1),
(26, 'Huyện Thanh Trì', 1),
(27, 'Huyện Thường Tín', 1),
(28, 'Quận Nam Từ Liêm', 1),
(29, 'Huyện Ứng Hòa', 1),
(30, 'Quận Bắc Từ Liêm', 1),
(31, 'Quận 1', 2),
(32, 'Quận 2', 2),
(33, 'Quận 3', 2),
(34, 'Quận 4', 2),
(35, 'Quận 5', 2),
(36, 'Quận 6', 2),
(37, 'Quận 7', 2),
(38, 'Quận 8', 2),
(39, 'Quận 9', 2),
(40, 'Quận 10', 2),
(41, 'Quận 11', 2),
(42, 'Quận 12', 2),
(43, 'Quận Bình Tân', 2),
(44, 'Quận Bình Thạnh', 2),
(45, 'Quận Gò Vấp', 2),
(46, 'Quận Phú Nhuận', 2),
(47, 'Quận Tân Bình', 2),
(48, 'Quận Tân Phú', 2),
(49, 'Quận Thủ Đức', 2),
(50, 'Huyện Bình Chánh', 2),
(51, 'Huyện Cần Giờ', 2),
(52, 'Huyện Củ Chi', 2),
(53, 'Huyện Hóc Môn', 2),
(54, 'Huyện Nhà Bè', 2),
(55, 'Quận Hải Châu', 3),
(56, 'Quận Thanh Khê', 3),
(57, 'Quận Sơn Trà', 3),
(58, 'Quận Ngũ Hành Sơn', 3),
(59, 'Quận Liên Chiểu', 3),
(60, 'Quận Cẩm Lệ', 3),
(61, 'Huyện Hòa Vang', 3),
(62, 'Quận Dương Kinh', 4),
(63, 'Quận Đồ Sơn', 4),
(64, 'Quận Hải An', 4),
(65, 'Quận Kiến An', 4),
(66, 'Quận Hồng Bàng', 4),
(67, 'Quận Ngô Quyền', 4),
(68, 'Quận Lê Chân', 4),
(69, 'Huyện An Dương', 4),
(70, 'Huyện An Lão', 4),
(71, 'Huyện Bạch Long Vĩ', 4),
(72, 'Huyện Cát Hải', 4),
(73, 'Huyện Kiến Thụy', 4),
(74, 'Huyện Tiên Lãng', 4),
(75, 'Huyện Vĩnh Bảo', 4),
(76, 'Huyện Thủy Nguyên', 4),
(77, 'Quận Ninh Kiều', 5),
(78, 'Quận Bình Thủy', 5),
(79, 'Quận Cái Răng', 5),
(80, 'Quận Ô Môn', 5),
(81, 'Quận Thốt Nốt', 5),
(82, 'Huyện Phong Điền', 5),
(83, 'Huyện Cờ Đỏ', 5),
(84, 'Huyện Thới Lai', 5),
(85, 'Huyện Vĩnh Thạnh', 5),
(86, 'Thành phố Long Xuyên', 6),
(87, 'Thị xã Châu Đốc', 6),
(88, 'Thị xã Tân Châu', 6),
(89, 'Huyện An Phú', 6),
(90, 'Huyện Châu Phú', 6),
(91, 'Huyện Châu Thành', 6),
(92, 'Huyện Chợ Mới', 6),
(93, 'Huyện Phú Tân', 6),
(94, 'Huyện Thoại Sơn', 6),
(95, 'Huyện Tịnh Biên', 6),
(96, 'Huyện Tri Tôn', 6),
(97, 'Thành phố Vũng Tàu', 7),
(98, 'Thành phố Bà Rịa', 7),
(99, 'Huyện Châu Đức', 7),
(100, 'Huyện Côn Đảo', 7),
(101, 'Huyện Đất Đỏ', 7),
(102, 'Huyện Long Điền', 7),
(103, 'Huyện Tân Thành', 7),
(104, 'Huyện Xuyên Mộc', 7),
(105, 'Thành phố Bạc Liêu', 8),
(106, 'Huyện Đông Hải', 8),
(107, 'Huyện Giá Rai', 8),
(108, 'Huyện Hòa Bình', 8),
(109, 'Huyện Hồng Dân', 8),
(110, 'Huyện Phước Long', 8),
(111, 'Huyện Vĩnh Lợi', 8),
(112, 'Thị xã Bắc Kạn', 9),
(113, 'Huyện Ba Bể', 9),
(114, 'Huyện Bạch Thông', 9),
(115, 'Huyện Chợ Đồn', 9),
(116, 'Huyện Chợ Mới', 9),
(117, 'Huyện Na Rì', 9),
(118, 'Huyện Ngân Sơn', 9),
(119, 'Huyện Pác Nặm', 9),
(120, 'Thành phố Bắc Giang', 10),
(121, 'Huyện Hiệp Hoà', 10),
(122, 'Huyện Lạng Giang', 10),
(123, 'Huyện Lục Nam', 10),
(124, 'Huyện Lục Ngạn', 10),
(125, 'Huyện Sơn Động', 10),
(126, 'Huyện Tân Yên', 10),
(127, 'Huyện Việt Yên', 10),
(128, 'Huyện Yên Dũng', 10),
(129, 'Huyện Yên Thế', 10),
(130, 'Thành phố Hải Dương', 11),
(131, 'Thị xã Chí Linh', 11),
(132, 'Huyện Bình Giang', 11),
(133, 'Huyện Cẩm Giàng', 11),
(134, 'Huyện Gia Lộc', 11),
(135, 'Huyện Kim Thành', 11),
(136, 'Huyện Kinh Môn', 11),
(137, 'Huyện Nam Sách', 11),
(138, 'Huyện Ninh Giang', 11),
(139, 'Huyện Thanh Hà', 11),
(140, 'Huyện Thanh Miện', 11),
(141, 'Huyện Tứ Kỳ', 11),
(142, 'Thành phố Bắc Ninh', 12),
(143, 'Thị xã Từ Sơn', 12),
(144, 'Huyện Gia Bình', 12),
(145, 'Huyện Lương Tài', 12),
(146, 'Huyện Quế Võ', 12),
(147, 'Huyện Thuận Thành', 12),
(148, 'Huyện Tiên Du', 12),
(149, 'Huyện Yên Phong', 12),
(150, 'Thành phố Bến Tre', 13),
(151, 'Huyện Ba Tri', 13),
(152, 'Huyện Bình Đại', 13),
(153, 'Huyện Châu Thành', 13),
(154, 'Huyện Chợ Lách', 13),
(155, 'Huyện Giồng Trôm', 13),
(156, 'Huyện Mỏ Cày Bắc', 13),
(157, 'Huyện Mỏ Cày Nam', 13),
(158, 'Huyện Thạnh Phú', 13),
(159, 'Thị xã Thủ Dầu Một', 14),
(160, 'Thị xã Thuận An', 14),
(161, 'Thị xã Dĩ An', 14),
(162, 'Huyện Bến Cát', 14),
(163, 'Huyện Phú Giáo', 14),
(164, 'Huyện Dầu Tiếng', 14),
(165, 'Huyện Tân Uyên', 14),
(166, 'Thành phố Quy Nhơn', 15),
(167, 'Huyện An Lão', 15),
(168, 'Huyện An Nhơn', 15),
(169, 'Huyện Hoài Ân', 15),
(170, 'Huyện Hoài Nhơn', 15),
(171, 'Huyện Phù Cát', 15),
(172, 'Huyện Phù Mỹ', 15),
(173, 'Huyện Tuy Phước', 15),
(174, 'Huyện Tây Sơn', 15),
(175, 'Huyện Vân Canh', 15),
(176, 'Huyện Vĩnh Thạnh', 15),
(177, 'Thị xã Đồng Xoài', 16),
(178, 'Thị xã Bình Long', 16),
(179, 'Thị xã Phước Long', 16),
(180, 'Huyện Bù Đăng', 16),
(181, 'Huyện Bù Đốp', 16),
(182, 'Huyện Bù Gia Mập', 16),
(183, 'Huyện Chơn Thành', 16),
(184, 'Huyện Đồng Phú', 16),
(185, 'Huyện Hớn Quản', 16),
(186, 'Huyện Lộc Ninh', 16),
(187, 'Thành phố Phan Thiết', 17),
(188, 'Thị xã La Gi', 17),
(189, 'Huyện Tuy Phong', 17),
(190, 'Huyện Bắc Bình', 17),
(191, 'Huyện Hàm Thuận Bắc', 17),
(192, 'Huyện Hàm Thuận Nam', 17),
(193, 'Huyện Tánh Linh', 17),
(194, 'Huyện Hàm Tân', 17),
(195, 'Huyện Đức Linh', 17),
(196, 'Huyện Phú Quý', 17),
(197, 'Thành phố Cà Mau', 18),
(198, 'Huyện Cái Nước', 18),
(199, 'Huyện Đầm Dơi', 18),
(200, 'Huyện Năm Căn', 18),
(201, 'Huyện Ngọc Hiển', 18),
(202, 'Huyện Phú Tân', 18),
(203, 'Huyện Thới Bình', 18),
(204, 'Huyện Trần Văn Thời', 18),
(205, 'Huyện U Minh', 18),
(206, 'Thị xã Cao Bằng', 19),
(207, 'Huyện Bảo Lạc', 19),
(208, 'Huyện Bảo Lâm', 19),
(209, 'Huyện Hạ Lang', 19),
(210, 'Huyện Hà Quảng', 19),
(211, 'Huyện Hòa An', 19),
(212, 'Huyện Nguyên Bình', 19),
(213, 'Huyện Phục Hòa', 19),
(214, 'Huyện Quảng Uyên', 19),
(215, 'Huyện Thạch An', 19),
(216, 'Huyện Thông Nông', 19),
(217, 'Huyện Trà Lĩnh', 19),
(218, 'Huyện Trùng Khánh', 19),
(219, 'Thành phố Buôn Ma Thuột', 20),
(220, 'Huyện Buôn Đôn', 20),
(221, 'Huyện Cư Kuin', 20),
(222, 'Huyện Cư M gar', 20),
(223, 'Huyện Ea H leo', 20),
(224, 'Huyện Ea Kar', 20),
(225, 'Huyện Ea Súp', 20),
(226, 'Huyện Krông Bông', 20),
(227, 'Huyện Krông Buk', 20),
(228, 'Huyện Krông Pak', 20),
(229, 'Huyện Lắk', 20),
(230, 'Huyện M Drăk', 20),
(231, 'Huyện Krông Ana', 20),
(232, 'Huyện Krông Năng', 20),
(233, 'Huyện Buôn Hồ', 20),
(234, 'Thị xã Gia Nghĩa', 21),
(235, 'Huyện Cư Jút', 21),
(236, 'Huyện Đắk Glong', 21),
(237, 'Huyện Đắk Mil', 21),
(238, 'Huyện Đắk R Lấp', 21),
(239, 'Huyện Đắk Song', 21),
(240, 'Huyện Krông Nô', 21),
(241, 'Huyện Tuy Đức', 21),
(242, 'Thành phố Điện Biên Phủ', 22),
(243, 'Thị xã Mường Lay', 22),
(244, 'Huyện Điện Biên', 22),
(245, 'Huyện Điện Biên Đông', 22),
(246, 'Huyện Mường Ảng', 22),
(247, 'Huyện Mường Chà', 22),
(248, 'Huyện Mường Nhé', 22),
(249, 'Huyện Tủa Chùa', 22),
(250, 'Huyện Tuần Giáo', 22),
(251, 'Thành phố Biên Hoà', 23),
(252, 'Thị xã Long Khánh', 23),
(253, 'Huyện Cẩm Mỹ', 23),
(254, 'Huyện Định Quán', 23),
(255, 'Huyện Long Thành', 23),
(256, 'Huyện Nhơn Trạch', 23),
(257, 'Huyện Tân Phú', 23),
(258, 'Huyện Thống Nhất', 23),
(259, 'Huyện Trảng Bom', 23),
(260, 'Huyện Vĩnh Cửu', 23),
(261, 'Huyện Xuân Lộc', 23),
(262, 'Thành phố Cao Lãnh', 24),
(263, 'Thị xã Hồng Ngự', 24),
(264, 'Thị xã Sa Đéc', 24),
(265, 'Huyện Cao Lãnh', 24),
(266, 'Huyện Châu Thành', 24),
(267, 'Huyện Hồng Ngự', 24),
(268, 'Huyện Lai Vung', 24),
(269, 'Huyện Lấp Vò', 24),
(270, 'Huyện Tam Nông', 24),
(271, 'Huyện Tân Hồng', 24),
(272, 'Huyện Thanh Bình', 24),
(273, 'Huyện Tháp Mười', 24),
(274, 'Thành phố Pleiku', 25),
(275, 'Thị xã An Khê', 25),
(276, 'Thị xã Ayun Pa', 25),
(277, 'Huyện Chư Păh', 25),
(278, 'Huyện Chư Prông', 25),
(279, 'Huyện Chư Pưh', 25),
(280, 'Huyện Chư Sê', 25),
(281, 'Huyện Đắk Đoa', 25),
(282, 'Huyện Đak Pơ', 25),
(283, 'Huyện Đức Cơ', 25),
(284, 'Huyện Ia Grai', 25),
(285, 'Huyện Ia Pa', 25),
(286, 'Huyện K Bang', 25),
(287, 'Huyện Kông Chro', 25),
(288, 'Huyện Krông Pa', 25),
(289, 'Huyện Mang Yang', 25),
(290, 'Huyện Phú Thiện', 25),
(291, 'Thành phố Hà Giang', 26),
(292, 'Huyện Bắc Mê', 26),
(293, 'Huyện Bắc Quang', 26),
(294, 'Huyện Đồng Văn', 26),
(295, 'Huyện Hoàng Su Phì', 26),
(296, 'Huyện Mèo Vạc', 26),
(297, 'Huyện Quản Bạ', 26),
(298, 'Huyện Quang Bình', 26),
(299, 'Huyện Vị Xuyên', 26),
(300, 'Huyện Xín Mần', 26),
(301, 'Huyện Yên Minh', 26),
(302, 'Thành phố Phủ Lý', 27),
(303, 'Huyện Bình Lục', 27),
(304, 'Huyện Duy Tiên', 27),
(305, 'Huyện Kim Bảng', 27),
(306, 'Huyện Lý Nhân', 27),
(307, 'Huyện Thanh Liêm', 27),
(308, 'Thành phố Hà Tĩnh', 28),
(309, 'Thị xã Hồng Lĩnh', 28),
(310, 'Huyện Cẩm Xuyên', 28),
(311, 'Huyện Can Lộc', 28),
(312, 'Huyện Đức Thọ', 28),
(313, 'Huyện Hương Khê', 28),
(314, 'Huyện Hương Sơn', 28),
(315, 'Huyện Kỳ Anh', 28),
(316, 'Huyện Lộc Hà', 28),
(317, 'Huyện Nghi Xuân', 28),
(318, 'Huyện Thạch Hà', 28),
(319, 'Huyện Vũ Quang', 28),
(320, 'Thành phố Vị Thanh', 29),
(321, 'Thị xã Ngã Bảy', 29),
(322, 'Huyện Châu Thành', 29),
(323, 'Huyện Châu Thành A', 29),
(324, 'Huyện Long Mỹ', 29),
(325, 'Huyện Phụng Hiệp', 29),
(326, 'Huyện Vị Thủy', 29),
(327, 'Thành phố Hòa Bình', 30),
(328, 'Huyện Lương Sơn', 30),
(329, 'Huyện Cao Phong', 30),
(330, 'Huyện Đà Bắc', 30),
(331, 'Huyện Kim Bôi', 30),
(332, 'Huyện Kỳ Sơn', 30),
(333, 'Huyện Lạc Sơn', 30),
(334, 'Huyện Lạc Thủy', 30),
(335, 'Huyện Mai Châu', 30),
(336, 'Huyện Tân Lạc', 30),
(337, 'Huyện Yên Thủy', 30),
(338, 'Thành phố Hưng Yên', 31),
(339, 'Huyện Ân Thi', 31),
(340, 'Huyện Khoái Châu', 31),
(341, 'Huyện Kim Động', 31),
(342, 'Huyện Mỹ Hào', 31),
(343, 'Huyện Phù Cừ', 31),
(344, 'Huyện Tiên Lữ', 31),
(345, 'Huyện Văn Giang', 31),
(346, 'Huyện Văn Lâm', 31),
(347, 'Huyện Yên Mỹ', 31),
(348, 'Thành phố Nha Trang', 32),
(349, 'Thành phố Cam Ranh', 32),
(350, 'Thị xã Ninh Hòa', 32),
(351, 'Huyện Cam Lâm', 32),
(352, 'Huyện Diên Khánh', 32),
(353, 'Huyện Khánh Sơn', 32),
(354, 'Huyện Khánh Vĩnh', 32),
(355, 'Huyện Vạn Ninh', 32),
(356, 'Thành phố Rạch Giá', 33),
(357, 'Thị xã Hà Tiên', 33),
(358, 'Huyện An Biên', 33),
(359, 'Huyện An Minh', 33),
(360, 'Huyện Châu Thành', 33),
(361, 'Huyện Giồng Riềng', 33),
(362, 'Huyện Gò Quao', 33),
(363, 'Huyện Hòn Đất', 33),
(364, 'Huyện Kiên Hải', 33),
(365, 'Huyện Kiên Lương', 33),
(366, 'Huyện Phú Quốc', 33),
(367, 'Huyện Tân Hiệp', 33),
(368, 'Huyện Vĩnh Thuận', 33),
(369, 'Huyện U Minh Thượng', 33),
(370, 'Thành phố Kon Tum', 34),
(371, 'Huyện Đắk Glei', 34),
(372, 'Huyện Đắk Hà', 34),
(373, 'Huyện Đắk Tô', 34),
(374, 'Huyện Kon Plông', 34),
(375, 'Huyện Kon Rẫy', 34),
(376, 'Huyện Ngọc Hồi', 34),
(377, 'Huyện Sa Thầy', 34),
(378, 'Huyện Tu Mơ Rông', 34),
(379, 'Thị xã Lai Châu', 35),
(380, 'Huyện Mường Tè', 35),
(381, 'Huyện Phong Thổ', 35),
(382, 'Huyện Sìn Hồ', 35),
(383, 'Huyện Tam Đường', 35),
(384, 'Huyện Than Uyên', 35),
(385, 'Huyện Tân Uyên', 35),
(386, 'Huyện Nậm Nhùn', 35),
(387, 'Thành phố Đà Lạt', 36),
(388, 'Thành phố Bảo Lộc', 36),
(389, 'Huyện Bảo Lâm', 36),
(390, 'Huyện Cát Tiên', 36),
(391, 'Huyện Đạ Huoai', 36),
(392, 'Huyện Đạ Tẻh', 36),
(393, 'Huyện Đam Rông', 36),
(394, 'Huyện Di Linh', 36),
(395, 'Huyện Đơn Dương', 36),
(396, 'Huyện Đức Trọng', 36),
(397, 'Huyện Lạc Dương', 36),
(398, 'Huyện Lâm Hà', 36),
(399, 'Thành phố Lạng Sơn', 37),
(400, 'Huyện Bắc Sơn', 37),
(401, 'Huyện Bình Gia', 37),
(402, 'Huyện Cao Lộc', 37),
(403, 'Huyện Chi Lăng', 37),
(404, 'Huyện Đình Lập', 37),
(405, 'Huyện Hữu Lũng', 37),
(406, 'Huyện Lộc Bình', 37),
(407, 'Huyện Tràng Định', 37),
(408, 'Huyện Văn Lãng', 37),
(409, 'Huyện Văn Quan', 37),
(410, 'Thành phố Lào Cai', 38),
(411, 'Huyện Bảo Thắng', 38),
(412, 'Huyện Bảo Yên', 38),
(413, 'Huyện Bát Xát', 38),
(414, 'Huyện Bắc Hà', 38),
(415, 'Huyện Mường Khương', 38),
(416, 'Huyện Sa Pa', 38),
(417, 'Huyện Si Ma Cai', 38),
(418, 'Huyện Văn Bàn', 38),
(419, 'Huyện Than Uyên', 38),
(420, 'Thành phố Tân An', 39),
(421, 'Huyện Bến Lức', 39),
(422, 'Huyện Cần Đước', 39),
(423, 'Huyện Cần Giuộc', 39),
(424, 'Huyện Châu Thành', 39),
(425, 'Huyện Đức Hòa', 39),
(426, 'Huyện Đức Huệ', 39),
(427, 'Huyện Mộc Hóa', 39),
(428, 'Huyện Tân Hưng', 39),
(429, 'Huyện Tân Thạnh', 39),
(430, 'Huyện Tân Trụ', 39),
(431, 'Huyện Thạnh Hóa', 39),
(432, 'Huyện Thủ Thừa', 39),
(433, 'Huyện Vĩnh Hưng', 39),
(434, 'Huyện Liên Hưng', 39),
(435, 'Thị xã Kiến Tường', 39),
(436, 'Thành phố Nam Định', 40),
(437, 'Huyện Giao Thủy', 40),
(438, 'Huyện Hải Hậu', 40),
(439, 'Huyện Mỹ Lộc', 40),
(440, 'Huyện Nam Trực', 40),
(441, 'Huyện Nghĩa Hưng', 40),
(442, 'Huyện Trực Ninh', 40),
(443, 'Huyện Vụ Bản', 40),
(444, 'Huyện Xuân Trường', 40),
(445, 'Huyện Ý Yên', 40),
(446, 'Thành phố Vinh', 41),
(447, 'Thị xã Cửa Lò', 41),
(448, 'Thị xã Thái Hòa', 41),
(449, 'Huyện Anh Sơn', 41),
(450, 'Huyện Con Cuông', 41),
(451, 'Huyện Diễn Châu', 41),
(452, 'Huyện Đô Lương', 41),
(453, 'Huyện Hưng Nguyên', 41),
(454, 'Huyện Quỳ Châu', 41),
(455, 'Huyện Kỳ Sơn', 41),
(456, 'Huyện Nam Đàn', 41),
(457, 'Huyện Nghi Lộc', 41),
(458, 'Huyện Nghĩa Đàn', 41),
(459, 'Huyện Quế Phong', 41),
(460, 'Huyện Quỳ Hợp', 41),
(461, 'Huyện Quỳnh Lưu', 41),
(462, 'Huyện Tân Kỳ', 41),
(463, 'Huyện Thanh Chương', 41),
(464, 'Huyện Tương Dương', 41),
(465, 'Huyện Yên Thành', 41),
(466, 'Thành phố Ninh Bình', 42),
(467, 'Thị xã Tam Điệp', 42),
(468, 'Huyện Gia Viễn', 42),
(469, 'Huyện Hoa Lư', 42),
(470, 'Huyện Kim Sơn', 42),
(471, 'Huyện Nho Quan', 42),
(472, 'Huyện Yên Khánh', 42),
(473, 'Huyện Yên Mô', 42),
(474, 'Thành phố Phan Rang', 43),
(475, 'Huyện Bác Ái', 43),
(476, 'Huyện Ninh Hải', 43),
(477, 'Huyện Ninh Phước', 43),
(478, 'Huyện Ninh Sơn', 43),
(479, 'Huyện Thuận Bắc', 43),
(480, 'Huyện Thuận Nam', 43),
(481, 'Thành phố Việt Trì', 44),
(482, 'Thị xã Phú Thọ', 44),
(483, 'Huyện Cẩm Khê', 44),
(484, 'Huyện Đoan Hùng', 44),
(485, 'Huyện Hạ Hòa', 44),
(486, 'Huyện Lâm Thao', 44),
(487, 'Huyện Phù Ninh', 44),
(488, 'Huyện Tam Nông', 44),
(489, 'Huyện Tân Sơn', 44),
(490, 'Huyện Thanh Ba', 44),
(491, 'Huyện Thanh Sơn', 44),
(492, 'Huyện Thanh Thủy', 44),
(493, 'Huyện Yên Lập', 44),
(494, 'Huyện Sông Thao', 44),
(495, 'Thành phố Tuy Hòa', 45),
(496, 'Thị xã Sông Cầu', 45),
(497, 'Huyện Đông Hòa', 45),
(498, 'Huyện Đồng Xuân', 45),
(499, 'Huyện Phú Hòa', 45),
(500, 'Huyện Sơn Hòa', 45),
(501, 'Huyện Sông Hinh', 45),
(502, 'Huyện Tây Hòa', 45),
(503, 'Huyện Tuy An', 45),
(504, 'Thành phố Đồng Hới', 46),
(505, 'Huyện Bố Trạch', 46),
(506, 'Huyện Lệ Thủy', 46),
(507, 'Huyện Minh Hóa', 46),
(508, 'Huyện Quảng Trạch', 46),
(509, 'Huyện Quảng Ninh', 46),
(510, 'Huyện Tuyên Hóa', 46),
(511, 'Thành phố Tam Kỳ', 47),
(512, 'Thành phố Hội An', 47),
(513, 'Huyện Điện Bàn', 47),
(514, 'Huyện Thăng Bình', 47),
(515, 'Huyện Bắc Trà My', 47),
(516, 'Huyện Nam Trà My', 47),
(517, 'Huyện Núi Thành', 47),
(518, 'Huyện Phước Sơn', 47),
(519, 'Huyện Tiên Phước', 47),
(520, 'Huyện Hiệp Đức', 47),
(521, 'Huyện Nông Sơn', 47),
(522, 'Huyện Đông Giang', 47),
(523, 'Huyện Nam Giang', 47),
(524, 'Huyện Đại Lộc', 47),
(525, 'Huyện Tây Giang', 47),
(526, 'Huyện Phú Ninh', 47),
(527, 'Huyện Duy Xuyên', 47),
(528, 'Huyện Quế Sơn', 47),
(529, 'Thành phố Quảng Ngãi', 48),
(530, 'Huyện Ba Tơ', 48),
(531, 'Huyện Bình Sơn', 48),
(532, 'Huyện Đức Phổ', 48),
(533, 'Huyện Minh Long', 48),
(534, 'Huyện Mộ Đức', 48),
(535, 'Huyện Nghĩa Hành', 48),
(536, 'Huyện Sơn Hà', 48),
(537, 'Huyện Sơn Tây', 48),
(538, 'Huyện Sơn Tịnh', 48),
(539, 'Huyện Tây Trà', 48),
(540, 'Huyện Trà Bồng', 48),
(541, 'Huyện Tư Nghĩa', 48),
(542, 'Huyện Lý Sơn', 48),
(543, 'Thành phố Hạ Long', 49),
(544, 'Thành phố Móng Cái', 49),
(545, 'Thành phố Uông Bí', 49),
(546, 'Thành phố Cẩm Phả', 49),
(547, 'Huyện Ba Chẽ', 49),
(548, 'Huyện Bình Liêu', 49),
(549, 'Huyện Đầm Hà', 49),
(550, 'Huyện Đông Triều', 49),
(551, 'Huyện Hải Hà', 49),
(552, 'Huyện Hoành Bồ', 49),
(553, 'Huyện Tiên Yên', 49),
(554, 'Huyện Vân Đồn', 49),
(555, 'Thị xã Yên Hưng', 49),
(556, 'Huyện Cô Tô', 49),
(557, 'Thị xã Quảng Yên', 49),
(558, 'Thành phố Đông Hà', 50),
(559, 'Thị xã Quảng Trị', 50),
(560, 'Huyện Cam Lộ', 50),
(561, 'Huyện Cồn Cỏ', 50),
(562, 'Huyện Đa Krông', 50),
(563, 'Huyện Gio Linh', 50),
(564, 'Huyện Hải Lăng', 50),
(565, 'Huyện Hướng Hóa', 50),
(566, 'Huyện Triệu Phong', 50),
(567, 'Huyện Vĩnh Linh', 50),
(568, 'Thành phố Sóc Trăng', 51),
(569, 'Huyện Châu Thành', 51),
(570, 'Huyện Cù Lao Dung', 51),
(571, 'Huyện Kế Sách', 51),
(572, 'Huyện Long Phú', 51),
(573, 'Huyện Mỹ Tú', 51),
(574, 'Huyện Mỹ Xuyên', 51),
(575, 'Huyện Ngã Năm', 51),
(576, 'Huyện Thạnh Trị', 51),
(577, 'Huyện Trần Đề', 51),
(578, 'Huyện Vĩnh Châu', 51),
(579, 'Thành phố Sơn La', 52),
(580, 'Huyện Bắc Yên', 52),
(581, 'Huyện Mai Sơn', 52),
(582, 'Huyện Mộc Châu', 52),
(583, 'Huyện Mường La', 52),
(584, 'Huyện Phù Yên', 52),
(585, 'Huyện Quỳnh Nhai', 52),
(586, 'Huyện Sông Mã', 52),
(587, 'Huyện Sốp Cộp', 52),
(588, 'Huyện Thuận Châu', 52),
(589, 'Huyện Yên Châu', 52),
(590, 'Thị xã Tây Ninh', 53),
(591, 'Huyện Bến Cầu', 53),
(592, 'Huyện Châu Thành', 53),
(593, 'Huyện Dương Minh Châu', 53),
(594, 'Huyện Gò Dầu', 53),
(595, 'Huyện Hòa Thành', 53),
(596, 'Huyện Tân Biên', 53),
(597, 'Huyện Tân Châu', 53),
(598, 'Huyện Trảng Bàng', 53),
(599, 'Thành phố Thái Bình', 54),
(600, 'Huyện Đông Hưng', 54),
(601, 'Huyện Hưng Hà', 54),
(602, 'Huyện Kiến Xương', 54),
(603, 'Huyện Quỳnh Phụ', 54),
(604, 'Huyện Thái Thụy', 54),
(605, 'Huyện Tiền Hải', 54),
(606, 'Huyện Vũ Thư', 54),
(607, 'Thành phố Thái Nguyên', 55),
(608, 'Thị xã Sông Công', 55),
(609, 'Huyện Đại Từ', 55),
(610, 'Huyện Định Hóa', 55),
(611, 'Huyện Đồng Hỷ', 55),
(612, 'Huyện Phổ Yên', 55),
(613, 'Huyện Phú Bình', 55),
(614, 'Huyện Phú Lương', 55),
(615, 'Huyện Võ Nhai', 55),
(616, 'Thành phố Thanh Hóa', 56),
(617, 'Thị xã Bỉm Sơn', 56),
(618, 'Thị xã Sầm Sơn', 56),
(619, 'Huyện Bá Thước', 56),
(620, 'Huyện Cẩm Thủy', 56),
(621, 'Huyện Đông Sơn', 56),
(622, 'Huyện Hà Trung', 56),
(623, 'Huyện Hậu Lộc', 56),
(624, 'Huyện Hoằng Hóa', 56),
(625, 'Huyện Lang Chánh', 56),
(626, 'Huyện Mường Lát', 56),
(627, 'Huyện Nga Sơn', 56),
(628, 'Huyện Ngọc Lặc', 56),
(629, 'Huyện Như Thanh', 56),
(630, 'Huyện Như Xuân', 56),
(631, 'Huyện Nông Cống', 56),
(632, 'Huyện Quan Hóa', 56),
(633, 'Huyện Quan Sơn', 56),
(634, 'Huyện Quảng Xương', 56),
(635, 'Huyện Thạch Thành', 56),
(636, 'Huyện Thiệu Hóa', 56),
(637, 'Huyện Thọ Xuân', 56),
(638, 'Huyện Thường Xuân', 56),
(639, 'Huyện Tĩnh Gia', 56),
(640, 'Huyện Triệu Sơn', 56),
(641, 'Huyện Vĩnh Lộc', 56),
(642, 'Huyện Yên Định', 56),
(643, 'Thành phố Huế', 57),
(644, 'Thị xã Hương Thủy', 57),
(645, 'Huyện A Lưới', 57),
(646, 'Huyện Hương Trà', 57),
(647, 'Huyện Nam Đông', 57),
(648, 'Huyện Phong Điền', 57),
(649, 'Huyện Phú Lộc', 57),
(650, 'Huyện Phú Vang', 57),
(651, 'Huyện Quảng Điền', 57),
(652, 'Thành phố Mỹ Tho', 58),
(653, 'Thị xã Gò Công', 58),
(654, 'Huyện Cái Bè', 58),
(655, 'Huyện Cai Lậy', 58),
(656, 'Huyện Châu Thành', 58),
(657, 'Huyện Chợ Gạo', 58),
(658, 'Huyện Gò Công Đông', 58),
(659, 'Huyện Gò Công Tây', 58),
(660, 'Huyện Tân Phú Đông', 58),
(661, 'Huyện Tân Phước', 58),
(662, 'Thành phố Trà Vinh', 59),
(663, 'Huyện Càng Long', 59),
(664, 'Huyện Cầu Kè', 59),
(665, 'Huyện Cầu Ngang', 59),
(666, 'Huyện Châu Thành', 59),
(667, 'Huyện Duyên Hải', 59),
(668, 'Huyện Tiểu Cần', 59),
(669, 'Huyện Trà Cú', 59),
(670, 'Thành phố Tuyên Quang', 60),
(671, 'Huyện Chiêm Hóa', 60),
(672, 'Huyện Hàm Yên', 60),
(673, 'Huyện Lâm Bình', 60),
(674, 'Huyện Na Hang', 60),
(675, 'Huyện Sơn Dương', 60),
(676, 'Huyện Yên Sơn', 60),
(677, 'Thành phố Vĩnh Long', 61),
(678, 'Huyện Bình Minh', 61),
(679, 'Huyện Bình Tân', 61),
(680, 'Huyện Long Hồ', 61),
(681, 'Huyện Mang Thít', 61),
(682, 'Huyện Tam Bình', 61),
(683, 'Huyện Trà Ôn', 61),
(684, 'Huyện Vũng Liêm', 61),
(685, 'Thành phố Vĩnh Yên', 62),
(686, 'Thị xã Phúc Yên', 62),
(687, 'Huyện Bình Xuyên', 62),
(688, 'Huyện Lập Thạch', 62),
(689, 'Huyện Sông Lô', 62),
(690, 'Huyện Tam Dương', 62),
(691, 'Huyện Tam Đảo', 62),
(692, 'Huyện Vĩnh Tường', 62),
(693, 'Huyện Yên Lạc', 62),
(694, 'Thành phố Yên Bái', 63),
(695, 'Thị xã Nghĩa Lộ', 63),
(696, 'Huyện Lục Yên', 63),
(697, 'Huyện Mù Cang Chải', 63),
(698, 'Huyện Trấn Yên', 63),
(699, 'Huyện Trạm Tấu', 63),
(700, 'Huyện Văn Chấn', 63),
(701, 'Huyện Văn Yên', 63),
(702, 'Huyện Yên Bình', 63);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `histories`
--

CREATE TABLE `histories` (
  `id` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `services` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `id_tax` varchar(68) COLLATE utf8_unicode_ci NOT NULL,
  `coin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `address`, `phone`, `images`, `district`, `city`, `id_tax`, `coin`) VALUES
(1, 'Dong Anh', 'so 138 to 11', '0973619398', NULL, 15, 1, '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `state` int(11) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `room_id`, `customer_id`, `created_by`, `created_at`, `state`, `updated_at`) VALUES
(1, 1, NULL, 3, '2017-06-23 09:44:41', 1, '2017-06-23 09:44:41'),
(2, 1, NULL, 3, '2017-06-23 09:48:21', 1, '2017-06-23 09:48:21'),
(3, 1, NULL, 3, '2017-06-23 09:57:31', 1, '2017-06-23 09:57:31'),
(4, 1, NULL, 3, '2017-06-23 09:58:45', 1, '2017-06-23 09:58:45'),
(5, 1, NULL, 3, '2017-06-23 10:03:06', 1, '2017-06-23 10:03:06'),
(6, 1, NULL, 3, '2017-06-23 10:03:40', 1, '2017-06-23 10:03:40'),
(7, 1, NULL, 3, '2017-06-23 10:03:49', 1, '2017-06-23 10:03:49'),
(8, 1, NULL, 3, '2017-06-23 10:05:37', 1, '2017-06-23 10:05:37'),
(9, 1, NULL, 3, '2017-06-23 10:08:35', 1, '2017-06-23 10:08:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `number_count` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `service_id`, `order_id`, `number_count`, `created_by`, `created_at`) VALUES
(1, 1, 3, 1, 3, '2017-06-23 09:57:31'),
(2, 1, 4, 1, 3, '2017-06-23 09:58:45'),
(3, 2, 4, 3, 3, '2017-06-23 09:58:45'),
(4, 1, 7, 1, 3, '2017-06-23 10:03:49'),
(5, 1, 8, 1, 3, '2017-06-23 10:05:37'),
(6, 2, 8, 3, 3, '2017-06-23 10:05:37'),
(7, 1, 9, 1, 3, '2017-06-23 10:08:35'),
(8, 2, 9, 3, 3, '2017-06-23 10:08:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room_type` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `id_hotel` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `room_type`, `state`, `id_hotel`, `created_by`) VALUES
(1, '101', 1, 0, 1, 3),
(2, '102', 1, 0, 1, 3),
(3, '103', 1, 0, 1, 3),
(4, '104', 1, 0, 1, 3),
(5, '201', 1, 0, 1, 3),
(6, '202', 1, 0, 1, 3),
(7, '203', 1, 0, 1, 3),
(8, '204', 1, 0, 1, 3),
(9, '301', 1, 0, 1, 3),
(10, '302', 1, 0, 1, 3),
(11, '303', 1, 0, 1, 3),
(12, '304', 1, 0, 1, 3),
(13, '401', 1, 0, 3, 3),
(14, '402', 1, 0, 3, 3),
(15, '403', 1, 0, 3, 3),
(16, '404', 1, 0, 3, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_type`
--

CREATE TABLE `room_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priceinroom` int(11) NOT NULL,
  `priceahour` int(11) NOT NULL,
  `priceovernight` int(11) DEFAULT NULL,
  `priceaday` int(11) DEFAULT NULL,
  `priceaweek` int(11) DEFAULT NULL,
  `priceamonth` int(11) DEFAULT NULL,
  `id_hotel` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `room_type`
--

INSERT INTO `room_type` (`id`, `name`, `priceinroom`, `priceahour`, `priceovernight`, `priceaday`, `priceaweek`, `priceamonth`, `id_hotel`, `created_by`) VALUES
(1, 'Vip 1', 70, 70, 150, 250, 1700, 7000, 1, 3),
(2, 'Vip 2', 100, 100, 300, 500, 3500, 15000, 1, 3),
(3, 'Vip 3', 500, 500, 1000, 2000, 12000, 36000, 1, 3),
(4, 'Vip 4', 1000, 1000, 10000, 20000, 50000, 200000, 1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `id_hotel` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `number`, `id_supplier`, `id_hotel`, `created_by`) VALUES
(1, 'Nuoc Khoang', 10000, 1000, 1, 1, 3),
(2, 'Bia Ha Noi', 30000, 1000, 1, 1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_supplier`
--

CREATE TABLE `service_supplier` (
  `id_service` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `priceaunit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` int(11) NOT NULL,
  `city` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `birthmonth` int(11) DEFAULT NULL,
  `birthyear` int(11) DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `firstname`, `lastname`, `birthday`, `birthmonth`, `birthyear`, `phone`, `address`, `email`, `remember_token`, `ip_address`, `created_at`, `updated_at`) VALUES
(2, 'aaa', '$2y$10$snOi0iMY9pH4QQNYaPGolu8O0MTSlXybbCY4oIowP1JF5sFiaHob.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aaa@aaa.aaa', 'bVlrMAhj2xiKHnuAVMTtbaX5CZuPqNugawU6LQi9SQJndyaTNWdcCStgwinA', NULL, '2017-05-30 08:19:14', '2017-05-30 08:19:14'),
(3, 'Tran Thanh Tuan', '$2y$10$x2L4FRmHrcHOab7RBJtOxu0jFSXKs.ath1zKm9ct9RuosVfOOj696', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tran.thanh.tuan269@gmail.com', 'hyHsGDKfTnCcMAj28j3wfxPnOag4C0srw62Hx2lRrhi9Lj3E4hq5U9jzeGXL', NULL, '2017-05-30 08:56:50', '2017-05-30 08:56:50'),
(4, 'bbb', '$2y$10$x9n1pei1UN94jEgtz1EdoeZCJhNcsmYtbeM/ghtTvJ3h1bBz3Fbi6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bbb@bbb.bbb', NULL, NULL, '2017-05-30 17:45:20', '2017-05-30 17:45:20'),
(5, 'Tạ Diệu Linh', '$2y$10$CnKktDVsqF3biX/mRXhMJ.4OZ8hQ7NgaBZhqOW4lMrz4gK.Drhbu.', 'Tạ Diệu', 'Linh', NULL, NULL, NULL, '0973619398', 'Đông Anh - Hà Nội', 'tadieulinh@gmail.com', '9UKBUMc5oV5IyTuanNI4Ew9zxXF7beO6zA7xTAXXIUMp3ZmmH4l7jZs78rTy', NULL, '2017-06-03 05:28:15', '2017-06-03 05:28:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_hotel`
--

CREATE TABLE `user_hotel` (
  `id_user` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `privilege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_hotel`
--

INSERT INTO `user_hotel` (`id_user`, `id_hotel`, `privilege`) VALUES
(3, 1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_hotel`
--
ALTER TABLE `customer_hotel`
  ADD PRIMARY KEY (`id_customer`,`id_hotel`);

--
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `service_supplier`
--
ALTER TABLE `service_supplier`
  ADD PRIMARY KEY (`id_service`,`id_supplier`);

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_hotel`
--
ALTER TABLE `user_hotel`
  ADD PRIMARY KEY (`id_user`,`id_hotel`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=703;
--
-- AUTO_INCREMENT cho bảng `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT cho bảng `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT cho bảng `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
