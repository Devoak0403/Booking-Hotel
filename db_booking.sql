-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2022 at 03:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `group_room`
--

CREATE TABLE `group_room` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_room`
--

INSERT INTO `group_room` (`id`, `room_name`, `room_price`) VALUES
(1, 'Room Standard', '4000'),
(2, 'Room Superior', '6000'),
(3, 'Room Deluxe', '8000'),
(4, 'Room Suite', '12000');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(11) NOT NULL,
  `p_vat` varchar(255) NOT NULL,
  `p_bank` varchar(255) NOT NULL,
  `p_dep` varchar(255) NOT NULL,
  `p_date` datetime NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `r_id` int(11) NOT NULL,
  `id_room` varchar(255) NOT NULL,
  `u_id` int(11) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `price_room` varchar(255) NOT NULL,
  `filepayment` varchar(255) NOT NULL,
  `status_reser` varchar(255) NOT NULL,
  `pathfile` varchar(255) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`r_id`, `id_room`, `u_id`, `start_datetime`, `end_datetime`, `firstname`, `lastname`, `tel`, `email`, `bank`, `price_room`, `filepayment`, `status_reser`, `pathfile`, `dateCreate`) VALUES
(1, 'STD001', 7, '2022-05-07 19:14:00', '2022-05-08 19:14:00', 'นพพร', 'จันทร์วิไล', '0926302464', 'okeza2010admin@gmail.com', 'ธนาคารกรุงไทย', '4000', 'payment_92482548520220507_191504.jpg', 'จองสำเร็จ', 'uploadpayment/payment_92482548520220507_191504.jpg', '2022-05-07 12:17:14'),
(3, 'DUX001', 7, '2022-05-12 19:15:00', '2022-05-22 19:15:00', 'นพพร', 'จันทร์วิไล', '0926302464', 'okeza2010admin@gmail.com', 'ธนาคารทหารไทย', '8000', 'payment_158597448120220507_191539.jpg', 'รอการตรวจสอบ', 'uploadpayment/payment_158597448120220507_191539.jpg', '2022-05-07 12:15:39'),
(4, 'SUT001', 7, '2022-05-27 19:15:00', '2022-06-12 19:15:00', 'นพพร', 'จันทร์วิไล', '0926302464', 'okeza2010admin@gmail.com', 'ธนาคารซิตี้แบงก์', '12000', 'payment_221236020220507_191559.jpg', 'รอการตรวจสอบ', 'uploadpayment/payment_221236020220507_191559.jpg', '2022-05-07 12:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `room_all`
--

CREATE TABLE `room_all` (
  `id` int(11) NOT NULL,
  `id_room` varchar(255) NOT NULL,
  `group_room` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room_all`
--

INSERT INTO `room_all` (`id`, `id_room`, `group_room`, `room_name`, `price`, `status`) VALUES
(1, 'STD001', 1, 'Room Standard', '4000', 'เต็ม'),
(2, 'STD002', 1, 'Room Standard', '4000', 'ว่าง'),
(3, 'SUP001', 2, 'Room Superior', '6000', 'ว่าง'),
(4, 'SUP002', 2, 'Room Superior', '6000', 'ว่าง'),
(5, 'DUX001', 3, 'Room Deluxe', '8000', 'เต็ม'),
(6, 'DUX002', 3, 'Room Deluxe', '8000', 'ว่าง'),
(7, 'SUT001', 4, 'Room Suite', '12000', 'เต็ม'),
(8, 'SUT002', 4, 'Room Suite', '12000', 'ว่าง'),
(9, 'STD003', 1, 'Room Standard', '4000', 'ว่าง'),
(10, 'STD004', 1, 'Room Standard', '4000', 'ว่าง'),
(11, 'STD005', 1, 'Room Standard', '4000', 'ว่าง'),
(13, 'STD006', 1, 'Room Standard', '4000', 'ว่าง');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `creat_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `firstname`, `lastname`, `email`, `tel`, `password`, `urole`, `creat_at`) VALUES
(1, 'นพพร', 'จันทร์วิไล', 'okeza2010admin@gmail.com', '', '$2y$10$PlgQxTqZNqOOQgonvG9tQeAJcUHAki.vSre7PnRD4nerOES/HI3ya', 'Adminstrator', '2022-05-07 12:56:45'),
(2, 'นพพร', 'จันทร์วิไล', 'okeza2010user@gmail.com', '', '$2y$10$LjedMOmK9eIYEFhULSwuv.USmTk0HPcbn3XtzTMatRVzflwPvia8O', 'User', '2022-05-07 12:57:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_room`
--
ALTER TABLE `group_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `room_all`
--
ALTER TABLE `room_all`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_room`
--
ALTER TABLE `group_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room_all`
--
ALTER TABLE `room_all`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
