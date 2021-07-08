-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2021 pada 11.34
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hkbp1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `artikel_id` bigint(20) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `approved1_by` varchar(255) NOT NULL,
  `approved2_by` varchar(255) NOT NULL,
  `periode_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `berita_id` bigint(20) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `approved1_by` varchar(255) NOT NULL,
  `approved2_by` varchar(255) NOT NULL,
  `periode_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kotbah`
--

CREATE TABLE `kotbah` (
  `kotbah_id` bigint(20) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` varchar(255) NOT NULL,
  `nats_alkitab` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `approved1_by` varchar(255) NOT NULL,
  `approved2_by` varchar(255) NOT NULL,
  `periode_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `majalah`
--

CREATE TABLE `majalah` (
  `majalah_id` bigint(11) NOT NULL,
  `periode_id` bigint(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderdetail`
--

CREATE TABLE `orderdetail` (
  `order_detail_id` bigint(20) NOT NULL,
  `orders_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` double NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `orders_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `ship_date` datetime NOT NULL,
  `ship_name` varchar(255) NOT NULL,
  `ship_address` varchar(255) NOT NULL,
  `ship_city` varchar(255) NOT NULL,
  `ship_region` varchar(255) NOT NULL,
  `ship_postal_code` varchar(255) NOT NULL,
  `ship_country` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `pengumuman_id` bigint(20) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `expired_date` datetime NOT NULL,
  `file` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `periode_id` bigint(20) NOT NULL,
  `bulan` int(255) NOT NULL,
  `tahun` int(255) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `product_id` bigint(20) NOT NULL,
  `periode_id` bigint(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `total_stock` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `report`
--

CREATE TABLE `report` (
  `report_id` bigint(20) NOT NULL,
  `periode_id` bigint(20) NOT NULL,
  `total_cetak` int(11) NOT NULL,
  `total_terjual` int(11) NOT NULL,
  `total_ready_stock` int(11) NOT NULL,
  `total_pengeluaran` double NOT NULL,
  `harga_satuan` double NOT NULL,
  `total_pendapatan` double NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` bigint(255) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(255) NOT NULL,
  `role_id` bigint(255) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artikel_id`),
  ADD KEY `periode_id` (`periode_id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`berita_id`),
  ADD KEY `periode_id` (`periode_id`);

--
-- Indeks untuk tabel `kotbah`
--
ALTER TABLE `kotbah`
  ADD PRIMARY KEY (`kotbah_id`),
  ADD KEY `periode_id` (`periode_id`);

--
-- Indeks untuk tabel `majalah`
--
ALTER TABLE `majalah`
  ADD PRIMARY KEY (`majalah_id`),
  ADD KEY `periode_id` (`periode_id`);

--
-- Indeks untuk tabel `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `orders_id` (`orders_id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`pengumuman_id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`periode_id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `periode_id` (`periode_id`);

--
-- Indeks untuk tabel `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `periode_id` (`periode_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artikel_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `berita_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kotbah`
--
ALTER TABLE `kotbah`
  MODIFY `kotbah_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `majalah`
--
ALTER TABLE `majalah`
  MODIFY `majalah_id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `order_detail_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `pengumuman_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `periode_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `report`
--
ALTER TABLE `report`
  MODIFY `report_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`);

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`);

--
-- Ketidakleluasaan untuk tabel `kotbah`
--
ALTER TABLE `kotbah`
  ADD CONSTRAINT `kotbah_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`);

--
-- Ketidakleluasaan untuk tabel `majalah`
--
ALTER TABLE `majalah`
  ADD CONSTRAINT `majalah_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`);

--
-- Ketidakleluasaan untuk tabel `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`orders_id`);

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`);

--
-- Ketidakleluasaan untuk tabel `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`periode_id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
