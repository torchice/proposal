-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3309
-- Generation Time: 15 Jun 2020 pada 06.19
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proposal`
--
CREATE DATABASE IF NOT EXISTS `proposal` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proposal`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_proposal`
--

DROP TABLE IF EXISTS `barang_proposal`;
CREATE TABLE `barang_proposal` (
  `kode_barang` int(16) NOT NULL,
  `nomor_proposal` varchar(32) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `spesifikasi` varchar(32) NOT NULL,
  `jumlah` int(16) NOT NULL,
  `perkiraan_biaya_unit` int(16) NOT NULL,
  `total_perkiraan_biaya` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_proposal`
--

INSERT INTO `barang_proposal` (`kode_barang`, `nomor_proposal`, `nama`, `spesifikasi`, `jumlah`, `perkiraan_biaya_unit`, `total_perkiraan_biaya`) VALUES
(24, '001/VI/20/PRO', 'Bawang putih', '50mm x Pjg 1 Meter', 5, 55000, 275000),
(25, '002/VI/20/PRO', 'Andang', '50mm x Pjg 1 Meter', 5, 43000, 215000),
(26, '003/VI/20/PRO', 'cat dinding', 'hehe', 1, 350000, 350000),
(27, '003/VI/20/PRO', 'Andang', 'sssssssssss', 3, 40000, 120000),
(28, '003/VI/20/PRO', 'Nylon Putih', '123', 123, 60000, 7380000),
(29, '003/VI/20/PRO', 'Pembersihan', '50mm x Pjg 1 Meter', 4, 35000, 140000),
(30, '003/VI/20/PRO', 'Nylon Putih', '50mm x Pjg 1 Meter', 123, 65000, 7995000),
(31, '003/VI/20/PRO', 'Bawang putih', '50mm x Pjg 1 Meter', 2, 55000, 110000),
(32, '003/VI/20/PRO', 'Andang', '50mm x Pjg 1 Meter', 3, 40000, 120000),
(33, '003/VI/20/PRO', 'Andang', '50mm x Pjg 1 Meter', 2, 40000, 80000),
(34, '003/VI/20/PRO', 'Nylon Putih', '50mm x Pjg 1 Meter', 3, 50000, 150000),
(35, '003/VI/20/PRO', 'cat dinding', '123', 2, 360000, 720000),
(36, '003/VI/20/PRO', 'cat dinding', '50mm x Pjg 1 Meter', 10, 350000, 3500000),
(37, '003/VI/20/PRO', 'Pembersihan', '12MS', 4, 30000, 120000),
(38, '003/VI/20/PRO', 'Bawang putih', 'hehe', 3, 55000, 165000),
(39, '005/VI/20/PRO', 'cat dinding', '1', 2, 230000, 460000),
(40, '005/VI/20/PRO', 'cat dinding', '2', 2, 350000, 700000),
(41, '005/VI/20/PRO', 'Pembersihan', '3', 3, 100000, 300000),
(42, '005/VI/20/PRO', 'Bawang putih', '4', 4, 100000, 400000),
(43, '005/VI/20/PRO', 'Loro Piana', '5', 5, 300, 1500),
(44, '005/VI/20/PRO', 'Loro Piana', '6', 6, 200, 1200),
(45, '005/VI/20/PRO', 'Abon Sapi', '7', 7, 10000, 70000),
(46, '005/VI/20/PRO', 'Star Dever', '8', 8, 777, 6216),
(47, '005/VI/20/PRO', 'SilverCats', '9', 9, 60000, 540000),
(48, '005/VI/20/PRO', 'cat dinding', '10', 10, 20000, 200000),
(49, '005/VI/20/PRO', 'Cat Plafond', '11', 11, 11000, 121000),
(50, '005/VI/20/PRO', 'Abon Sapi', '12', 12, 50000, 600000),
(51, '005/VI/20/PRO', 'SilverCats', '13', 13, 55000, 715000),
(52, '005/VI/20/PRO', 'Bawang putih', '14', 14, 100000, 1400000),
(53, '005/VI/20/PRO', 'Star Dever', '15', 15, 1000, 15000),
(54, '005/VI/20/PRO', 'Bawang putih', '16', 16, 10000, 160000),
(55, '005/VI/20/PRO', 'Abon Sapi', '17', 17, 10000, 170000),
(56, '005/VI/20/PRO', 'cat dinding', '18', 18, 100000, 1800000),
(57, '005/VI/20/PRO', 'cat dinding', '18', 18, 100000, 1800000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_barang`
--

DROP TABLE IF EXISTS `daftar_barang`;
CREATE TABLE `daftar_barang` (
  `id_barang` int(11) NOT NULL,
  `kategori_barang` varchar(60) NOT NULL,
  `nama_barang` varchar(300) NOT NULL,
  `harga_penetapan` int(15) NOT NULL,
  `status_aktif` varchar(10) NOT NULL,
  `approve` int(1) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_barang`
--

INSERT INTO `daftar_barang` (`id_barang`, `kategori_barang`, `nama_barang`, `harga_penetapan`, `status_aktif`, `approve`, `last_update`) VALUES
(5, 'PRO', 'cat dinding', 360000, 'aktif', 1, '2020-06-06 02:15:29'),
(6, 'PRO', 'Andang', 79000, 'aktif', 1, '2020-06-08 13:46:40'),
(7, 'PRO', 'Pembersihan', 160000, 'aktif', 2, '2020-06-13 12:49:03'),
(11, 'PRO', 'Bawang putih', 200000, 'aktif', 1, '2020-06-13 10:52:21'),
(12, 'PRO', 'Cat Plafond ', 200000, 'aktif', 1, '2020-06-13 10:51:54'),
(13, 'PRO', 'Nylon Putih', 65000, 'aktif', 1, '2020-06-06 07:38:49'),
(14, 'PRO', 'cokicoki', 20000, 'aktif', 1, '2020-06-09 08:11:38'),
(16, 'PRO', 'Loro Piana', 620, 'aktif', 1, '2020-06-08 10:47:49'),
(38, 'PRO', 'Abon Sapi', 66666, 'aktif', 1, '2020-06-08 13:34:01'),
(39, 'PRO', 'Star Dever', 6666, 'aktif', 1, '2020-06-08 13:37:29'),
(40, 'PRO', 'SilverCats', 65000, 'aktif', 1, '2020-06-10 11:12:02'),
(41, 'PRO', 'Biaya Makan', 25000, 'aktif', 0, '2020-06-13 13:02:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `kode_departemen` varchar(30) NOT NULL,
  `nama_departemen` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `department`
--

INSERT INTO `department` (`kode_departemen`, `nama_departemen`) VALUES
('PRO', 'PRODUKSI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_harga`
--

DROP TABLE IF EXISTS `history_harga`;
CREATE TABLE `history_harga` (
  `id_history` int(11) NOT NULL,
  `id_barang` int(30) NOT NULL,
  `status_aktif` varchar(10) NOT NULL,
  `last_update` datetime NOT NULL,
  `harga_penetapan` int(32) NOT NULL,
  `approve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_harga`
--

INSERT INTO `history_harga` (`id_history`, `id_barang`, `status_aktif`, `last_update`, `harga_penetapan`, `approve`) VALUES
(1, 7, 'aktif', '2020-06-08 10:34:55', 666, 0),
(6, 30, 'aktif', '2020-06-08 11:21:16', 88888, 0),
(10, 0, 'aktif', '2020-06-08 11:27:38', 10000, 0),
(11, 0, 'aktif', '2020-06-08 11:28:05', 10000, 0),
(12, 37, 'aktif', '2020-06-08 11:33:57', 890123, 1),
(14, 38, 'aktif', '2020-06-08 12:04:40', 123456, 0),
(15, 38, 'aktif', '2020-06-08 12:05:23', 654321, 0),
(17, 38, 'aktif', '2020-06-08 12:06:21', 98765, 0),
(18, 38, 'aktif', '2020-06-08 12:06:55', 67890, 0),
(19, 38, 'aktif', '2020-06-08 12:10:33', 55555, 0),
(20, 38, 'aktif', '2020-06-08 13:05:49', 4444, 0),
(21, 38, 'aktif', '2020-06-08 13:10:12', 12341234, 0),
(22, 38, 'aktif', '2020-06-08 13:34:01', 66666, 1),
(23, 12, 'aktif', '2020-06-08 13:35:42', 78000, 0),
(24, 11, 'aktif', '2020-06-08 13:36:06', 90000, 0),
(25, 11, 'aktif', '2020-06-08 13:36:48', 100000, 0),
(26, 7, 'aktif', '2020-06-08 13:37:11', 120000, 0),
(27, 39, 'aktif', '2020-06-08 13:37:29', 6666, 0),
(28, 14, 'aktif', '2020-06-08 13:37:56', 800000, 0),
(29, 6, 'aktif', '2020-06-08 13:46:40', 79000, 0),
(30, 14, 'aktif', '2020-06-09 08:11:39', 20000, 0),
(31, 12, 'aktif', '2020-06-10 08:20:06', 66000, 0),
(32, 12, 'aktif', '2020-06-10 08:20:38', 123000, 0),
(33, 12, 'aktif', '2020-06-10 11:00:50', 543000, 0),
(34, 40, 'aktif', '2020-06-10 11:12:02', 65000, 0),
(35, 7, 'aktif', '2020-06-13 09:10:29', 150000, 0),
(36, 12, 'aktif', '2020-06-13 10:52:00', 200000, 0),
(37, 11, 'aktif', '2020-06-13 10:52:21', 200000, 1),
(38, 7, 'aktif', '2020-06-13 12:49:03', 160000, 0),
(39, 41, 'aktif', '2020-06-13 13:02:48', 25000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `info_proposal`
--

DROP TABLE IF EXISTS `info_proposal`;
CREATE TABLE `info_proposal` (
  `kode_proposal` int(255) NOT NULL,
  `pabrik` varchar(36) NOT NULL,
  `tanggal` date NOT NULL,
  `department` varchar(36) NOT NULL,
  `nomor` varchar(36) NOT NULL,
  `jenis` varchar(36) NOT NULL,
  `keperluan` varchar(300) NOT NULL,
  `lokasi` varchar(300) NOT NULL,
  `pertimbangan` varchar(300) NOT NULL,
  `keadaan` varchar(36) NOT NULL,
  `keterangan` varchar(300) NOT NULL,
  `disetujui` varchar(36) NOT NULL,
  `diketahui` varchar(36) NOT NULL,
  `diajukan` varchar(36) NOT NULL,
  `konfirmasi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info_proposal`
--

INSERT INTO `info_proposal` (`kode_proposal`, `pabrik`, `tanggal`, `department`, `nomor`, `jenis`, `keperluan`, `lokasi`, `pertimbangan`, `keadaan`, `keterangan`, `disetujui`, `diketahui`, `diajukan`, `konfirmasi`) VALUES
(47, 'TG - 1; UNIT - 1', '2020-06-05', 'PRO', '001/VI/20/PRO', 'Perbaikan', 'Menjaga kebersihan & kerapian plafond dan dinding', 'TG-1 Unit III', 'Plafond di R.sayur TG III kotor,hitam,sebagian mengelupas,perlu dicat ulang agar tampak bersih dan rapi terutama saat kunjungan tamu.', 'Sudah Dikerjakan', '', '', '', 'andy', 0),
(49, 'TG - 1; UNIT - 1', '2020-06-05', 'PRO', '002/VI/20/PRO', 'Perbaikan', 'Menjaga kebersihan & kerapian plafond dan dinding', 'TG-1 Unit III', 'Plafond di R.sayur TG III kotor,hitam,sebagian mengelupas,perlu dicat ulang agar tampak bersih dan rapi terutama saat kunjungan tamu.', 'Sudah Dikerjakan', '', '', '', 'Andy', 0),
(50, 'TG - 1; UNIT - 1', '2020-06-05', 'PRO', '003/VI/20/PRO', 'Perbaikan', 'asd', 'asd', 'asd', 'Sudah Dikerjakan', '', '', '', 'andy', 0),
(51, 'TG - 1; UNIT - 1', '2020-06-09', 'PRO', '004/VI/20/PRO', 'Pengadaan', 'Menjaga kebersihan & kerapian plafond dan dinding', 'TG-1 Unit III', 'andy', 'Very Urgent', '', '', '', 'manager', 0),
(52, 'TG - 1; UNIT - 1', '2020-06-13', 'PRO', '005/VI/20/PRO', 'Pemakaian', '15', '15', '15', 'Sudah Dikerjakan', '', '', '', 'andy', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `jabatan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `jabatan`) VALUES
('andy', 'andy', 'andy', 'IT'),
('admin', 'admin', 'admin', 'ADMIN'),
('user1', 'user1', 'user1', 'KARYAWAN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_proposal`
--
ALTER TABLE `barang_proposal`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`kode_departemen`);

--
-- Indexes for table `history_harga`
--
ALTER TABLE `history_harga`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `info_proposal`
--
ALTER TABLE `info_proposal`
  ADD PRIMARY KEY (`kode_proposal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_proposal`
--
ALTER TABLE `barang_proposal`
  MODIFY `kode_barang` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `history_harga`
--
ALTER TABLE `history_harga`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `info_proposal`
--
ALTER TABLE `info_proposal`
  MODIFY `kode_proposal` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
