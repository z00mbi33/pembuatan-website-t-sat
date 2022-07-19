-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2022 at 03:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsat`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(5) NOT NULL,
  `maskapai` int(5) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `berangkat` datetime NOT NULL,
  `tiba` datetime NOT NULL,
  `harga` int(25) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `tersedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `maskapai`, `asal`, `tujuan`, `berangkat`, `tiba`, `harga`, `kapasitas`, `tersedia`) VALUES
(7, 1, 'jakarta', 'bali', '2022-07-09 18:34:00', '2022-07-09 20:35:00', 1000000, 150, 150),
(10, 1, 'surabaya', 'aceh', '2022-07-09 10:24:00', '2022-07-09 10:24:00', 1000000, 150, 150),
(12, 8, 'surabaya', 'jakarta', '2022-07-09 11:39:00', '2022-07-09 11:39:00', 1000000, 200, 195),
(13, 9, 'surabaya', 'jakarta', '2022-07-09 16:40:00', '2022-07-09 17:40:00', 900000, 150, 150),
(14, 7, 'surabaya', 'jakarta', '2022-07-09 14:51:49', '2022-07-09 15:41:00', 900000, 150, 150),
(15, 7, 'papua', 'surabaya', '2022-07-19 20:36:00', '2022-07-19 23:36:00', 1000000, 100, 100),
(16, 9, 'surabaya', 'jakarta', '2022-07-09 10:54:00', '2022-07-09 11:54:00', 900000, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`id`, `nama`, `kode`) VALUES
(1, 'Sriwijaya Air', 'SRWJY'),
(7, 'Lion Air', 'LION'),
(8, 'Garuda', 'GRD'),
(9, 'Batik Air', 'BTK');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_byr` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id`, `user_id`, `jadwal_id`, `jumlah`, `total_byr`, `created_at`) VALUES
(1, 2, 13, 2, 1800000, '2022-07-06 03:18:05'),
(2, 2, 12, 1, 1000000, '2022-07-06 03:18:18'),
(3, 2, 14, 3, 2700000, '2022-07-06 11:14:36'),
(4, 2, 12, 2, 2000000, '2022-07-06 11:21:10'),
(5, 6, 13, 3, 2700000, '2022-07-19 20:34:57'),
(6, 2, 12, 5, 5000000, '2022-07-19 20:48:32');

--
-- Triggers `tiket`
--
DELIMITER $$
CREATE TRIGGER `jadwal_update_trigger` AFTER UPDATE ON `tiket` FOR EACH ROW UPDATE jadwal set jadwal.tersedia = jadwal.tersedia - new.jumlah WHERE jadwal.id = new.jadwal_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 1 COMMENT '0=admin, 1=customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `telepon`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin@admin.com', '123', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, 'gian', 'user@user.com', '321', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 1),
(6, 'alfin', 'alfin@alfin.com', '123', 'alfin', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tiket_user` (`user_id`),
  ADD KEY `tiket_jadwal` (`jadwal_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiket_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
