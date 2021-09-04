-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2021 at 12:39 PM
-- Server version: 10.2.40-MariaDB-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakj3132_restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `cara_pembayaran`
--

CREATE TABLE `cara_pembayaran` (
  `id` int(11) NOT NULL,
  `kode` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cara_pembayaran`
--

INSERT INTO `cara_pembayaran` (`id`, `kode`, `nama`) VALUES
(1, 1, 'Transfer'),
(2, 2, 'Bayar di tempat');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_order`
--

CREATE TABLE `jenis_order` (
  `id` int(11) NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_order`
--

INSERT INTO `jenis_order` (`id`, `kode`, `nama`) VALUES
(1, 1, 'Delivery'),
(2, 2, 'Reservasi');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`id`, `nama`) VALUES
(1, 'makanan'),
(2, 'minuman'),
(3, 'cemilan');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_user`, `id_produk`, `harga`, `qty`) VALUES
(14, 26, 33636, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_reservasi`
--

CREATE TABLE `keranjang_reservasi` (
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` int(11) NOT NULL,
  `nomor` varchar(100) DEFAULT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id`, `nomor`, `id_produk`, `qty`, `harga`) VALUES
(48, '2021719799114', 4, 2, 6000),
(49, '2021719799114', 5, 1, 15000),
(52, '202171974947214', 1, 1, 15000),
(53, '202171974947214', 16, 1, 30000),
(55, '20217197581115', 16, 6, 30000),
(56, '202171975852215', 2, 7, 20000),
(57, '202171984935114', 1, 3, 15000),
(58, '202171985252214', 1, 1, 15000),
(59, '202171985252214', 2, 1, 20000),
(60, '202171923515114', 2, 1, 20000),
(61, '202171923515114', 4, 1, 6000),
(62, '20217209204116', 23, 1, 37272),
(63, '20217209204116', 30, 1, 26363),
(64, '20217209204116', 32, 1, 31818),
(65, '2021720105954216', 18, 1, 35454),
(66, '2021720105954216', 19, 1, 36363),
(67, '2021720105954216', 30, 1, 26363),
(68, '2021720105954216', 31, 1, 29090),
(69, '2021720201155118', 19, 1, 36363),
(70, '2021720201155118', 31, 1, 29090),
(72, '2021720201351218', 19, 1, 36363),
(73, '2021720201351218', 32, 1, 31818),
(74, '2021811488214', 22, 1, 43636);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_master`
--

CREATE TABLE `pesanan_master` (
  `id` int(11) NOT NULL,
  `jenis_pesanan` int(11) DEFAULT NULL,
  `nomor` varchar(100) DEFAULT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `ongkir` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `meja` varchar(10) DEFAULT NULL,
  `tgl_reservasi` date DEFAULT NULL,
  `cara_bayar` varchar(1) DEFAULT NULL,
  `foto_transfer` varchar(100) DEFAULT NULL,
  `cicilan` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `id_wilayah` int(11) DEFAULT NULL,
  `status_pesanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan_master`
--

INSERT INTO `pesanan_master` (`id`, `jenis_pesanan`, `nomor`, `tanggal`, `ongkir`, `total`, `id_user`, `meja`, `tgl_reservasi`, `cara_bayar`, `foto_transfer`, `cicilan`, `alamat`, `id_wilayah`, `status_pesanan`) VALUES
(22, 1, '2021719799114', '2021-08-19', 5000, 32000, 14, NULL, NULL, '1', '1629378226.jpeg', NULL, 'Jl. Nayu Barat RT 05/XIV, Nusukan, Solo', 3, 1),
(24, 2, '202171974947214', '2021-08-19', NULL, 45000, 14, '26', '2021-08-20', '1', NULL, NULL, NULL, NULL, 1),
(25, 1, '20217197581115', '2021-08-19', 9000, 189000, 15, NULL, NULL, '1', NULL, NULL, 'Jl. Naykfsjalfdjasl alsf;alsfjdals fsadf', 5, 6),
(26, 2, '202171975852215', '2021-08-19', NULL, 140000, 15, '27', '2021-08-21', '1', NULL, NULL, NULL, NULL, 1),
(27, 1, '202171984935114', '2021-08-19', 6000, 51000, 14, NULL, NULL, '1', NULL, NULL, 'Jl. Majapara 3 no 25, Surabaya', 1, 1),
(29, 2, '202171985252214', '2021-08-19', NULL, 35000, 14, '17', '2021-08-23', '1', NULL, NULL, NULL, NULL, 2),
(30, 1, '202171923515114', '2021-08-19', 9000, 35000, 14, NULL, NULL, '2', NULL, NULL, 'Jl sumatra', 5, 6),
(31, 1, '20217209204116', '2021-08-20', 8000, 103453, 16, NULL, NULL, '1', NULL, NULL, 'Jalan Sungai Raya Dalam', 4, 1),
(32, 2, '2021720105954216', '2021-08-20', NULL, 127270, 16, '8', '2021-08-24', '1', NULL, NULL, NULL, NULL, 1),
(33, 1, '2021720201155118', '2021-08-20', 8000, 73453, 18, NULL, NULL, '2', NULL, NULL, 'jl sungai ', 4, 1),
(34, 2, '2021720201351218', '2021-08-20', NULL, 68181, 18, '27', '2021-08-24', '1', NULL, NULL, NULL, NULL, 1),
(35, 2, '2021811488214', '2021-09-01', NULL, 43636, 14, '21', '2019-09-01', '1', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(80) DEFAULT NULL,
  `jenis` tinyint(1) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `gambar` varchar(80) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `jenis`, `harga`, `gambar`, `keterangan`) VALUES
(18, 'Nasi Ayam Cah Jamur', 1, 35454, 'Nasi ayam cah jamur.jpeg', 'Nasi ayam dengan jamur '),
(19, 'Kangkung Sapi Telur Puyuh', 1, 36363, 'Kangkung sapi telur puyuh.jpeg', 'Kangkung dengan tambahan sapi dan telur puyuh'),
(20, 'Nasi Ayam Goreng Kremes', 1, 35454, 'Nasi Ayam Goreng Kremes.jpeg', 'Nasi dengan ayam goreng dan kremes'),
(21, 'Nasi Sop Tulang Iga', 1, 50909, 'Nasi Sop Tulang Iga.jpeg', 'Sop Tulang Iga yang dipadukan dengan Nasi Panas'),
(22, 'Nasi Bakar Cakalang', 1, 43636, 'Nasi Bakar Cakalang.jpeg', 'Nasi bakar dengan isian ikan cakalang'),
(23, 'Nasi Uduk Komplit', 1, 37272, 'Nasi Uduk Komplit.jpeg', 'Nasi uduk komplit super enak'),
(24, 'Nasi Goreng Istimewa', 1, 33636, 'Nasi Goreng Istimewa.jpeg', 'Nasi gorengnya istimewa seperti kamu yang baca'),
(25, 'Nasi Goreng Seafood', 1, 33636, 'Nasi Goreng Seafood.jpeg', 'Nasi Goreng dengan Tambahan Olahan Laut Segar'),
(26, 'Kwetiaw Goreng Istimewa', 1, 33636, 'Kwetiaw Goreng Istimewa.jpeg', 'Kwetiaw Goreng Istimewa'),
(30, 'Es Campur', 2, 26363, 'Es Campur.jpeg', 'Es Campur segar menyegarkan tenggorokan '),
(31, 'Es Doger', 2, 29090, 'Es Doger.jpeg', 'Menyegarkan dan menyejukkan'),
(32, 'Es Alpukat Kerok', 2, 31818, 'Es Alpukat Kerok.jpeg', 'Es Alpukat dengan kerokan daging alpukat yang tebal');

-- --------------------------------------------------------

--
-- Table structure for table `status_pesanan`
--

CREATE TABLE `status_pesanan` (
  `id` int(11) NOT NULL,
  `kode` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_pesanan`
--

INSERT INTO `status_pesanan` (`id`, `kode`, `keterangan`) VALUES
(1, 1, 'Pesanan diterima, belum ada transfer'),
(2, 2, 'Pesanan diterima, sudah ada transfer minimal 50%'),
(3, 3, 'Pesanan diproses'),
(4, 4, 'Pesanan dikirim'),
(5, 5, 'Pesanan diterima pelanggan'),
(6, 6, 'Transaksi selesai');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`) VALUES
(1, 'Nanda', 'nanda@gmail.com', '$2y$10$RzXf22YzA3rtP1kTDcwCVOCM7hlpUcG/Yw/MhLrVJfpdbVeiOQYZa'),
(3, 'Sheira', 'sheira@gmail.com', '$2y$10$SU0NMdDTYe9dfCYI2GXzWuH4NIJ44hnM3iBvcpLGRJq3ALJ5CKjFu'),
(4, 'Putri', 'putri@gmail.com', '$2y$10$6UVKi97Jx0Raw75KotPsoOuK.P0P9Ncd0C15hbZQeisQEJdbYo4GG'),
(5, 'prima', 'prima@gmail.com', '$2y$10$nK72fQ7.U6YZSxYfEZJVruApzDlLVR6huNSo2V.xDrgaeRhRGZPdW'),
(14, 'inez', 'inez@gmail.com', '$2y$10$CtlHwq4bjJ.SNfpZx46WneMrBh4.E/UJRjV0DFFHA3552BPSbdMjm'),
(15, 'susan', 'susan@gmail.com', '$2y$10$jroXnikyXJ0VGNfD3bo1Y.yT2DPLB7O6c7McYwpb9GzeFArCHThGm'),
(16, 'Nama', 'Nama', '$2y$10$p2oZ17tyKJEKtLdAeEWzBu4QxmdMDNGKOFMDwa3D8dJ3jQTvhK08W'),
(17, 'juniar', 'juniar', '$2y$10$2z2UaQ4GsHJ5C9/0Z.3CnO.hX/qNwy9uWWPBiJeJbivVdOC6bq7RC'),
(18, 'juniar', 'juni', '$2y$10$HHhXKndmrY/4ce1L3oWAgebG59azLGSTpax6Fq3H/8XtHqGzw8vJK');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jarak` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id`, `nama`, `jarak`, `harga`) VALUES
(1, 'Pontianak Kota', 1, 6000),
(2, 'Pontianak Barat', 2, 7000),
(3, 'Pontianak Selatan', 1, 5000),
(4, 'Pontianak Tenggara', 1, 8000),
(5, 'Pontianak Timur', 3, 9000),
(6, 'Pontianak Utara', 4, 11000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cara_pembayaran`
--
ALTER TABLE `cara_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_order`
--
ALTER TABLE `jenis_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_master`
--
ALTER TABLE `pesanan_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pesanan`
--
ALTER TABLE `status_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cara_pembayaran`
--
ALTER TABLE `cara_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_order`
--
ALTER TABLE `jenis_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `pesanan_master`
--
ALTER TABLE `pesanan_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `status_pesanan`
--
ALTER TABLE `status_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
