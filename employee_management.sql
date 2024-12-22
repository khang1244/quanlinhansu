-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3307
-- Thời gian đã tạo: Th12 22, 2024 lúc 12:06 PM
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
-- Cơ sở dữ liệu: `employee_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `cccd` varchar(20) DEFAULT NULL,
  `position` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `type` enum('full-time','part-time','contract') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`id`, `name`, `gender`, `address`, `cccd`, `position`, `department`, `type`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, 'Hoàng Văn E', 'Nam', 'ccc', '54543535354', 'Nhân viên Marketing', 'Marketing', 'full-time', '2024-12-22 16:18:14', '2024-12-22 17:14:35', NULL, NULL),
(8, 'Đỗ Thị H', 'Nữ', 'TP.HCM', '987654321098', 'Trưởng phòng Nhân sự', 'Nhân sự', 'full-time', '2024-12-22 16:18:14', '2024-12-22 17:09:56', NULL, NULL),
(9, 'Phan Văn I', 'Nam', 'dd', '454545454', 'Nhân viên IT', 'Công nghệ thông tin1', 'full-time', '2024-12-22 16:18:14', '2024-12-22 17:26:34', NULL, NULL),
(10, 'Lý Thị K', 'Nam', 'rrtrt', '44444', 'Nhân viên Marketing', 'Marketing', 'part-time', '2024-12-22 16:18:14', '2024-12-22 17:16:51', NULL, NULL),
(11, 'Lê Hoàng Khang', 'Nam', 'vvvvv', '11111111', 'Nhân viên Kế toán1', 'Kế toán1', 'contract', '2024-12-22 16:32:35', '2024-12-22 17:16:58', 1, NULL),
(12, 'Lê chí tường', 'Nam', 'Đại thành', '123456789', 'Nhân viên IT', 'Công nghệ thông tin', 'contract', '2024-12-22 17:17:42', '2024-12-22 17:17:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `plain_password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `plain_password`, `role`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin123', 'admin'),
(2, 'user1', '6ad14ba9986e3615423dfca256d04e3f', 'user123', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
