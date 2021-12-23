-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 03:33 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_masyarakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `nik` char(16) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`) VALUES
('041325670872028', 'winarno', 'win', '123', '081477083547'),
('1523733829373', 'masyarakat', 'masyarakat', 'masyarakat', '0814770841671'),
('3312431517156', 'winarno2', 'winarno2', '123', '081477084167'),
('7344', 'winarno', 'winarno', '123', '0814770841671');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `tgl_pengaduan` date DEFAULT NULL,
  `nik` char(16) DEFAULT NULL,
  `isi_laporan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('0','proses','selesai') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `status`) VALUES
(15, '2021-10-07', '041325670872028', 'ini laporan saya', '_ngopiyukk_20201009_1.png', 'selesai'),
(16, '2021-10-07', '041325670872028', 'ini pengaduan ke 2`', '_ngopiyukk_20201030_1.png', 'selesai'),
(17, '2021-10-07', '041325670872028', 'ini pengaduan 3', '_ngopiyukk_1614069768809664.jpg', 'selesai'),
(18, '2021-10-07', '1523733829373', 'ini pengaduan pertama', '_ngopiyukk_20201030_1.png', 'selesai'),
(19, '2021-10-07', '1523733829373', 'ini pengaduan kedua', '', 'selesai'),
(20, '2021-10-07', '041325670872028', 'ini pengaduan saya', '_ngopiyukk_20201009_1.png', 'proses'),
(21, '2021-10-07', '041325670872028', 'ini pengaduan saya lagi', '_ngopiyukk_20201030_1.png', '0'),
(22, '2021-10-08', '041325670872028', 'ini laporan dari saya\r\n', '_ngopiyukk_161145682378339.jpg', 'proses'),
(23, '2021-10-08', '041325670872028', 'ini adalah pengaduan saya', '7f0dc239-6f47-4406-a13c-e08539829dcc.jpg', '0'),
(24, '2021-10-08', '041325670872028', 'ini pengaduan saya terakhir', '_ngopiyukk_1618925284992922.jpg', NULL),
(25, '2021-10-08', '041325670872028', 'ini pengaduan saya yaa', '3bd2f18f-1d15-40b1-8038-947fcebf2383.jpg', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(35) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `level` enum('admin','petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `telp`, `level`) VALUES
(1, 'winarno', 'win', '123', '081477978823', 'admin'),
(2, 'winarno2', 'win2', '1232', '0888', 'petugas'),
(9, 'admin', 'admin', 'admin', '0283734321232', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_pengaduan` int(11) DEFAULT NULL,
  `tgl_tanggapan` date DEFAULT NULL,
  `tanggapan` text DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`) VALUES
(1, NULL, '2021-10-08', 'sdad', 1),
(2, 21, '2021-10-08', 'ini tanggapan pertama', 1),
(3, 21, '2021-10-08', 'ini tanggapan pertama\r\n', 1),
(4, 21, '2021-10-08', 'ini tanggpan ke 3', 1),
(5, 21, '2021-10-08', 'ini tanggapan admin', 9),
(6, 20, '2021-10-08', 'ini tanggpan ku\r\n', 1),
(7, 20, '2021-10-08', 'kjnjnjn', 1),
(8, 20, '2021-10-08', 'tanggpiyaa', 1),
(9, 22, '2021-10-08', 'nn', 1),
(10, 25, '2021-10-08', 'ini tanggpan', 1),
(11, 25, '2021-10-08', 'maaf aduan anda non valid', 1),
(12, 20, '2021-10-19', 'wes tak tanggapi\r\n', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `nama_petugas` (`nama_petugas`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `masyarakat` (`nik`);

--
-- Constraints for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`),
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
