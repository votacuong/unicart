-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2026 at 09:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uni-cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_activities_session`
--

CREATE TABLE `app_activities_session` (
  `id` int(11) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `symbol` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `session_id` text NOT NULL,
  `date_created` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_activities_session`
--

INSERT INTO `app_activities_session` (`id`, `currency`, `symbol`, `language`, `session_id`, `date_created`) VALUES
(3011, 'AUD', 'AUD', 'English', '76f21674e2e4s3b3r5i4n5l5f416p3s2b2z5k4d4k473l5d4r5z5a213p3n3t536q5j4f4e5e5t2a4r244d2w3w3d4u5m5g456j4q3x4o3l344w2n22403g2t3b4s52354e482r494y2d4l3z5t41324a42334t2x3d2r4a474r5x5x354q26444o21444w2q2m3b3h4k474k5n416b5n2s274230414r3r2d2r5j5j4m5f2e4f2x4k4u4p5u5d4j582s4o5i4i5l5n4p4o3l2i2o474w5r4m5u5e4d2d4g23454d4t2r2n324g2x5h4h5p4m5k4m4t5s3z2s3n4r5t544s526r4b2y3b2o434m4y5d4v5t5a213p3h2u3g4h494l4s556p4m5n4i4v3l5n4n4p5x5f4a6a3r5x554j5u5w4t4t5l4g474k4v33495248204y3m2h4d436c4l4w5r5l4v573b5t21423q286j5m286533495m2a5x3p2c2o3u4', '2026-03-03'),
(3012, 'USD', '$', 'Vietnamese', '76f21674e2e4s383q5i4x5s554n3z3i2m4x564q47394j5m4x5p3y2d2w4l446m5t5j4449554z234t2o3l275e4i4k5x5o416820535822434u2p2d492z3b4g48403c4n3o4x274n2m3i4x5n4f4i595b4j5k3p5p4c5s2x274d4n294u2q3v3f3p435p3h3y392k4b4d4j5g2o4k534e4u5n2m3k4p5p4i4q5n52444u284y224t2q24444p2q3n3j5l514v5o544o274s233o2t284i2x3p3e444s5b4o3b4r3i3i4s5p5i4m5d2n4d4y5k4h4l5s3l2s3m4n5x5j4m5u5m4b2c4b2x2u2v204w2z334m2r2p3q2o3t5t584n4j5x5o4u5f2e4f236e4i4k5x5o416a224p3g4e5z5s464w5f4i203c2p3o2g4f424l4u5t4x5i5z593t3i506p4q5k4u5x4n4d4m4v5v564a6f426n554v5w334x3149254l2i2h483z5k5i4m4o5l4s5f4c5v2o2a444y4i5q266a314z3q2d504i2t3a2b6', '2026-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `app_cart`
--

CREATE TABLE `app_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_id` text NOT NULL,
  `cart` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `app_cart`
--

INSERT INTO `app_cart` (`id`, `user_id`, `cart_id`, `cart`) VALUES
(163, 1, '76f21674e2e4s3b3r5i4n5l5f416p3s2b2z5k4d4k473l5d4r5z5a213p3n3t536q5j4f4e5e5t2a4r244d2w3w3d4u5m5g456j4q3x4o3l344w2n22403g2t3b4s52354e482r494y2d4l3z5t41324a42334t2x3d2r4a474r5x5x354q26444o21444w2q2m3b3h4k474k5n416b5n2s274230414r3r2d2r5j5j4m5f2e4f2x4k4u4p5u5d4j582s4o5i4i5l5n4p4o3l2i2o474w5r4m5u5e4d2d4g23454d4t2r2n324g2x5h4h5p4m5k4m4t5s3z2s3n4r5t544s526r4b2y3b2o434m4y5d4v5t5a213p3h2u3g4h494l4s556p4m5n4i4v3l5n4n4p5x5f4a6a3r5x554j5u5w4t4t5l4g474k4v33495248204y3m2h4d436c4l4w5r5l4v573b5t21423q286j5m286533495m2a5x3p2c2o3u4', '{\"6\":{\"quanlity\":\"2\"},\"2\":{\"quanlity\":3},\"3\":{\"quanlity\":1},\"1\":{\"quanlity\":1},\"7\":{\"quanlity\":1}}'),
(164, NULL, '76f21674e2e4s383q5i4x5s554n3z3i2m4x564q47394j5m4x5p3y2d2w4l446m5t5j4449554z234t2o3l275e4i4k5x5o416820535822434u2p2d492z3b4g48403c4n3o4x274n2m3i4x5n4f4i595b4j5k3p5p4c5s2x274d4n294u2q3v3f3p435p3h3y392k4b4d4j5g2o4k534e4u5n2m3k4p5p4i4q5n52444u284y224t2q24444p2q3n3j5l514v5o544o274s233o2t284i2x3p3e444s5b4o3b4r3i3i4s5p5i4m5d2n4d4y5k4h4l5s3l2s3m4n5x5j4m5u5m4b2c4b2x2u2v204w2z334m2r2p3q2o3t5t584n4j5x5o4u5f2e4f236e4i4k5x5o416a224p3g4e5z5s464w5f4i203c2p3o2g4f424l4u5t4x5i5z593t3i506p4q5k4u5x4n4d4m4v5v564a6f426n554v5w334x3149254l2i2h483z5k5i4m4o5l4s5f4c5v2o2a444y4i5q266a314z3q2d504i2t3a2b6', '{\"2\":{\"quanlity\":1}}');

-- --------------------------------------------------------

--
-- Table structure for table `app_currency`
--

CREATE TABLE `app_currency` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `symbol` varchar(50) NOT NULL,
  `exchange` text NOT NULL,
  `state` tinyint(3) NOT NULL,
  `date_sync` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `app_currency`
--

INSERT INTO `app_currency` (`id`, `code`, `symbol`, `exchange`, `state`, `date_sync`) VALUES
(2, 'USD', '$', '{\"VND\":26100.9304,\"USD\":1,\"AUD\":1.4114,\"EUR\":0.8542,\"COP\":3763.5705,\"BRL\":5.1796}', 1, '2026-03-03'),
(5, 'AUD', 'AUD', '{\"AUD\":1,\"VND\":18480.9064,\"USD\":0.7085,\"EUR\":0.6044,\"COP\":2658.0543,\"BRL\":3.6695}', 1, '2026-03-03'),
(6, 'EUR', '€', '{\"EUR\":1,\"AUD\":1.6545,\"USD\":1.1706,\"COP\":4409.5276,\"BRL\":6.0619,\"VND\":30400.1191}', 1, '2026-03-03'),
(12, 'VND', 'VND', '{\"USD\":3.832e-5,\"AUD\":5.412e-5,\"EUR\":3.272e-5,\"VND\":1}', 1, '2026-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `app_orders`
--

CREATE TABLE `app_orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cart` text NOT NULL,
  `reward` varchar(100) NOT NULL,
  `coupon` varchar(100) NOT NULL,
  `time_add` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `app_orders`
--

INSERT INTO `app_orders` (`id`, `customer_id`, `cart`, `reward`, `coupon`, `time_add`) VALUES
(76, 1, '{\"1\":{\"quanlity\":1},\"2\":{\"quanlity\":\"7\"},\"6\":{\"quanlity\":\"4\"},\"3\":{\"quanlity\":3}}', '', '', '2026-03-03'),
(77, 1, '{\"1\":{\"quanlity\":1},\"2\":{\"quanlity\":\"7\"},\"6\":{\"quanlity\":\"4\"},\"3\":{\"quanlity\":3}}', '', '', '2026-03-03'),
(78, 1, '{\"2\":{\"quanlity\":1}}', '', '', '2026-03-03'),
(79, 1, '{\"2\":{\"quanlity\":2},\"3\":{\"quanlity\":1}}', '', '', '2026-03-03'),
(80, 1, '{\"3\":{\"quanlity\":1}}', '', '', '2026-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `app_payment`
--

CREATE TABLE `app_payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `time_add` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `app_payment`
--

INSERT INTO `app_payment` (`id`, `order_id`, `customer_id`, `total`, `time_add`, `status`) VALUES
(76, 76, 1, '916', '2026-03-03', 'completed'),
(77, 77, 1, '916', '2026-03-03', 'completed'),
(78, 78, 1, '28', '2026-03-03', 'completed'),
(79, 79, 1, '91', '2026-03-03', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `app_product`
--

CREATE TABLE `app_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `state` tinyint(3) NOT NULL,
  `address` text NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `app_product`
--

INSERT INTO `app_product` (`id`, `name`, `description`, `price`, `sku`, `state`, `address`, `latitude`, `longitude`) VALUES
(1, 'Card Grahphic', 'A graphics processing unit (GPU) is a specialized electronic circuit designed for digital image processing and to accelerate computer graphics', '15', 'ABC', 1, '', '', ''),
(2, 'CPU', 'A CPU (Central Processing Unit) is the primary \"brain\" of a computer, responsible for executing instructions, processing data, and managing system operations. It performs calculations and controls data flow between components. Key components include the Arithmetic Logic Unit (ALU), Control Unit, and Registers', '28', 'ADB', 1, '', '', ''),
(3, 'Screen', '\"Screen\" in English refers to a display surface for televisions, computers, or phones, as well as a partition, mesh, or sieve. As a verb, it means to examine/test (e.g., for disease), show a movie, or protect/conceal. It also refers to the film industry, known as \"the screen', '35', 'ACB', 1, '', '', ''),
(5, 'Mouse', 'Mouse Computer (tiếng Anh: Mouse Computer Co., Ltd.) là một công ty sản xuất máy tính nội địa Nhật Bản có trụ sở tại Chūō, Tokyo.', '100', '', 1, '', '', ''),
(6, 'Keyboard', 'Write English letters online using the QWERTY and the DVORAK layouts. This online keyboard allows you to type English letters using any computer keyboard, ...', '150', '', 1, '', '', ''),
(7, 'Sound', '<div>Learn to pronounce sounds in American English. Learn the pronunciation for each sound, how to spell each sound, and practice each sound for free.</div>', '200', '', 1, 'Hà Nội, Việt Nam', '21.0277644', '105.8341598');

-- --------------------------------------------------------

--
-- Table structure for table `app_resetpassword`
--

CREATE TABLE `app_resetpassword` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_resetpassword`
--

INSERT INTO `app_resetpassword` (`id`, `email`, `code`) VALUES
(37, 'votacuong2608@gmail.com', 'pNSg0xhD8X');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `user_type` int(3) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `settings` text NOT NULL,
  `state` tinyint(3) NOT NULL,
  `signup_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `user_type`, `firstname`, `lastname`, `phone`, `email`, `password`, `settings`, `state`, `signup_date`) VALUES
(1, 1, 'Green World', 'Specialist', '+61481611125', 'votacuong2608@gmail.com', '$2y$10$zzlgsyDsnwZ9mX33zfo89uq8628FVvBvS3xoxatps461Kio3vs0Ei', '', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_activities_session`
--
ALTER TABLE `app_activities_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_cart`
--
ALTER TABLE `app_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_currency`
--
ALTER TABLE `app_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_orders`
--
ALTER TABLE `app_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_payment`
--
ALTER TABLE `app_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_product`
--
ALTER TABLE `app_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_resetpassword`
--
ALTER TABLE `app_resetpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_activities_session`
--
ALTER TABLE `app_activities_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3013;

--
-- AUTO_INCREMENT for table `app_cart`
--
ALTER TABLE `app_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `app_currency`
--
ALTER TABLE `app_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `app_orders`
--
ALTER TABLE `app_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `app_payment`
--
ALTER TABLE `app_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `app_product`
--
ALTER TABLE `app_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `app_resetpassword`
--
ALTER TABLE `app_resetpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
