-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20261028.3710262a6b
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2026 at 03:13 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utspemrograman2`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--
CREATE TABLE `pendaftaran` (
  `id` int NOT NULL,
  `tgl_input` date DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jk` varchar(20) DEFAULT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `pekerjaan_ortu` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `mat` float DEFAULT NULL,
  `bing` float DEFAULT NULL,
  `umum` float DEFAULT NULL,
  `rata` float DEFAULT NULL,
  `tempat_tes` varchar(50) DEFAULT NULL,
  `keterangan` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `tgl_input`, `kode`, `nama`, `jk`, `asal_sekolah`, `pekerjaan_ortu`, `tempat_lahir`, `tgl_lahir`, `mat`, `bing`, `umum`, `rata`, `tempat_tes`, `keterangan`) VALUES
(4, '2026-10-30', 'A2', 'Prabowo', 'Laki-Laki', 'Bogor', 'Presiden', 'Solo', '1945-08-12', 78, 74, 75, 75.6667, 'Gedung A', 'Lulus'),
(5, '2006-09-12', 'V3', 'deni', 'Laki-Laki', 'Solo', 'presiden', 'Solo', '1296-09-12', 64, 80, 90, 78, 'Viktor', 'Lulus'),
(6, '2026-09-12', 'A3', 'Joko', 'Laki-Laki', 'Tangerang', 'Presiden', 'tangerang', '1987-09-12', 90, 89, 87, 88.6667, 'Gedung A', 'Lulus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
