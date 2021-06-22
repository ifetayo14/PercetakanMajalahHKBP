-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 09:41 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hkbp`
--
CREATE DATABASE IF NOT EXISTS `db_hkbp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_hkbp`;

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `Artikel_Id` varchar(255) NOT NULL,
  `Judul_Artikel` varchar(255) NOT NULL,
  `Isi_Artikel` varchar(255) NOT NULL,
  `File_Artikel` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Approved1` varchar(255) DEFAULT NULL,
  `Approved2` varchar(255) DEFAULT NULL,
  `Approved1_By` varchar(255) DEFAULT NULL,
  `Approved2_By` varchar(255) DEFAULT NULL,
  `Periode` varchar(255) NOT NULL,
  `Created_By` varchar(255) DEFAULT NULL,
  `Created_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `Berita_Id` varchar(255) NOT NULL,
  `Judul_Berita` varchar(255) NOT NULL,
  `Isi_Berita` varchar(255) NOT NULL,
  `File_Berita` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Approved1` varchar(255) DEFAULT NULL,
  `Approved2` varchar(255) DEFAULT NULL,
  `Approved1_By` varchar(255) DEFAULT NULL,
  `Approved2_By` varchar(255) DEFAULT NULL,
  `Periode` varchar(255) NOT NULL,
  `Created_By` varchar(255) NOT NULL,
  `Created_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `khotbah`
--

CREATE TABLE `khotbah` (
  `Khotbah_Id` varchar(255) NOT NULL,
  `Judul_Khotbah` varchar(255) NOT NULL,
  `Isi_Khotbah` varchar(255) NOT NULL,
  `Nats_Alkitab` varchar(255) NOT NULL,
  `File_Khotbah` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Approved1` varchar(255) DEFAULT NULL,
  `Approved2` varchar(255) DEFAULT NULL,
  `Approved1_By` varchar(255) DEFAULT NULL,
  `Approved2_By` varchar(255) DEFAULT NULL,
  `Periode` varchar(255) NOT NULL,
  `Created_By` varchar(255) DEFAULT NULL,
  `Created_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `majalah`
--

CREATE TABLE `majalah` (
  `Majalah_Id` varchar(255) NOT NULL,
  `Periode` varchar(255) NOT NULL,
  `Judul_Majalah` varchar(255) NOT NULL,
  `File_Majalah` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Created_By` varchar(255) NOT NULL,
  `Created_Date` datetime NOT NULL,
  `Updated_By` varchar(255) NOT NULL,
  `Update_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_Id` varchar(255) NOT NULL,
  `Users` varchar(255) NOT NULL,
  `Order_Date` datetime NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Ship_Date` datetime NOT NULL,
  `Ship_Name` varchar(255) NOT NULL,
  `Ship_Address` varchar(255) NOT NULL,
  `Ship_City` varchar(255) NOT NULL,
  `Ship_Region` varchar(255) NOT NULL,
  `Ship_Postal_Code` varchar(255) NOT NULL,
  `Ship_Country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `Order_Detail_Id` varchar(255) NOT NULL,
  `Orders` varchar(255) NOT NULL,
  `Product` varchar(255) NOT NULL,
  `Qty` varchar(255) NOT NULL,
  `Unit_Price` varchar(255) NOT NULL,
  `Discount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `Pengumuman_Id` varchar(255) NOT NULL,
  `Judul_Pengumuman` varchar(255) NOT NULL,
  `Isi_Pengumuman` varchar(255) NOT NULL,
  `Deskripsi_Pengumuman` varchar(255) NOT NULL,
  `Expired_Date` datetime NOT NULL,
  `File` varchar(255) NOT NULL,
  `Created_By` varchar(255) NOT NULL,
  `Created_Date` datetime NOT NULL,
  `Updated_By` varchar(255) NOT NULL,
  `Updated_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `Periode_Id` varchar(255) NOT NULL,
  `Bulan` varchar(255) NOT NULL,
  `Tahun` varchar(255) NOT NULL,
  `Tema` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Deskripsi` varchar(255) NOT NULL,
  `Created_By` varchar(255) NOT NULL,
  `Created_Date` datetime NOT NULL,
  `Updated_By` varchar(255) NOT NULL,
  `Update_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_Id` varchar(255) NOT NULL,
  `Periode` varchar(255) NOT NULL,
  `Product_Name` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Total_Stock` bigint(20) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Deskripsi_Product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `Report_Id` varchar(255) NOT NULL,
  `Periode` varchar(255) NOT NULL,
  `Total_Cetak` bigint(20) NOT NULL,
  `Total_Terjual` bigint(20) DEFAULT NULL,
  `Total_Ready_Stock` bigint(20) DEFAULT NULL,
  `Total_Pendapatan` bigint(20) DEFAULT NULL,
  `Status` varchar(255) NOT NULL,
  `Keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `Role_Id` varchar(255) NOT NULL,
  `Role_Name` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Deskripsi` varchar(255) NOT NULL,
  `Updated_By` varchar(255) NOT NULL,
  `Update_Date` datetime NOT NULL,
  `Created_By` varchar(255) NOT NULL,
  `Created_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_Id` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `Created_By` varchar(255) NOT NULL,
  `Created_Date` datetime NOT NULL,
  `Updated_By` varchar(255) NOT NULL,
  `Update_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`Artikel_Id`),
  ADD KEY `Periode` (`Periode`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`Berita_Id`),
  ADD KEY `Periode` (`Periode`);

--
-- Indexes for table `khotbah`
--
ALTER TABLE `khotbah`
  ADD PRIMARY KEY (`Khotbah_Id`),
  ADD KEY `Periode` (`Periode`);

--
-- Indexes for table `majalah`
--
ALTER TABLE `majalah`
  ADD KEY `Periode` (`Periode`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_Id`),
  ADD KEY `Users` (`Users`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`Order_Detail_Id`),
  ADD KEY `Orders` (`Orders`),
  ADD KEY `Product` (`Product`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`Pengumuman_Id`),
  ADD KEY `Created_By` (`Created_By`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`Periode_Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_Id`),
  ADD KEY `Periode` (`Periode`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`Report_Id`),
  ADD KEY `Periode` (`Periode`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Role_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD KEY `Role` (`Role`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`Periode`) REFERENCES `periode` (`Periode_Id`);

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`Periode`) REFERENCES `periode` (`Periode_Id`) ON DELETE CASCADE;

--
-- Constraints for table `khotbah`
--
ALTER TABLE `khotbah`
  ADD CONSTRAINT `khotbah_ibfk_1` FOREIGN KEY (`Periode`) REFERENCES `periode` (`Periode_Id`);

--
-- Constraints for table `majalah`
--
ALTER TABLE `majalah`
  ADD CONSTRAINT `majalah_ibfk_1` FOREIGN KEY (`Periode`) REFERENCES `periode` (`Periode_Id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Users`) REFERENCES `users` (`User_Id`) ON DELETE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`Orders`) REFERENCES `orders` (`Order_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`Product`) REFERENCES `product` (`Product_Id`) ON DELETE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`Created_By`) REFERENCES `users` (`User_Id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Periode`) REFERENCES `periode` (`Periode_Id`) ON DELETE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`Periode`) REFERENCES `periode` (`Periode_Id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Role`) REFERENCES `role` (`Role_Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
