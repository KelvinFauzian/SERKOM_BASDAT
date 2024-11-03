-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 11:18 AM
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
-- Database: `perpus_kelvin`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAnggotaByGender` (IN `gender_param` ENUM('L','P'))   BEGIN
SELECT * FROM anggota WHERE jenis_kelamin = gender_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetBukuByPenerbit` (IN `penerbit_param` VARCHAR(40))   BEGIN
SELECT * FROM buku WHERE penerbit = penerbit_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTransaksiByStatus` (IN `status_param` VARCHAR(20))   BEGIN
SELECT * FROM transaksi WHERE status = status_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserByHakAkses` (IN `role_param` VARCHAR(10))   BEGIN
SELECT * FROM user WHERE hak_akses = role_param;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GetAvailableBookCount` (`judul_buku_param` VARCHAR(50)) RETURNS INT(11)  BEGIN
DECLARE book_count INT;
SELECT jml_buku INTO book_count FROM buku WHERE judul_buku = judul_buku_param;
RETURN book_count;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GetGenderByMemberName` (`nama_anggota_param` VARCHAR(50)) RETURNS ENUM('L','P') CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
DECLARE jenis_kelamin_result ENUM('L', 'P');
SELECT jenis_kelamin INTO jenis_kelamin_result FROM anggota WHERE nama_anggota = nama_anggota_param;
RETURN jenis_kelamin_result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GetTransactionStatusByMemberName` (`nama_anggota_param` VARCHAR(50)) RETURNS ENUM('Dipinjam','Dikembalikan') CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
DECLARE status_result ENUM('Dipinjam', 'Dikembalikan');
SELECT status INTO status_result FROM transaksi WHERE nama_anggota = nama_anggota_param;
RETURN status_result;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `GetUserAccess` (`username_param` VARCHAR(50)) RETURNS ENUM('admin','user') CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
DECLARE user_access ENUM('admin', 'user');
SELECT hak_akses INTO user_access FROM user WHERE username = username_param;
RETURN user_access;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` datetime NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `tgl_masuk` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_anggota`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `tgl_masuk`) VALUES
(1, 'Kelvin', 'Purwokerto', '2003-01-02 00:00:00', 'L', 'Jl. Lesanpura No. 10, Purwokerto', '2024-05-30 09:00:00'),
(2, 'Latifah', 'Purwokerto', '2003-03-16 00:00:00', 'P', 'Jl. Kartosuro No. 5, Purwokerto', '2024-11-01 09:15:00'),
(3, 'Dimas', 'Tangerang', '2003-08-22 00:00:00', 'L', 'Jl. Karawaci, Tangerang No. 5', '2024-03-30 10:00:00'),
(4, 'Clarisa', 'Jakarta', '2003-04-25 00:00:00', 'P', 'Jl. Prajurit Sakti No. 5, Jakarta', '2024-03-11 12:00:00');

--
-- Triggers `anggota`
--
DELIMITER $$
CREATE TRIGGER `anggota_before_insert` BEFORE INSERT ON `anggota` FOR EACH ROW BEGIN
IF NEW.tgl_masuk < NEW.tgl_lahir THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Tanggal masuk anggota tidak boleh lebih awal dari tanggal lahir.';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `thn_terbit` datetime NOT NULL,
  `jml_buku` int(40) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `thn_terbit`, `jml_buku`, `tgl_input`) VALUES
(1, 'Belajar MySQL', 'Budi Santoso', 'Gramedia', '2020-01-15 00:00:00', 10, '2024-11-01 12:00:00'),
(2, 'Pemrograman Python', 'Ayu Lestari', 'Erlangga', '2018-06-20 00:00:00', 5, '2024-11-01 12:00:00'),
(3, 'Algoritma dan Pemrograman', 'Dewi Kartika', 'Andi', '2019-09-10 00:00:00', 8, '2024-11-01 12:00:00'),
(4, 'Dasar-dasar Jaringan', 'Rizki Pratama', 'Salemba', '2017-03-25 00:00:00', 12, '2024-11-01 12:00:00'),
(5, 'Pengantar Basis Data', 'Andi Wijaya', 'Informatika', '2021-11-05 00:00:00', 7, '2024-11-01 12:00:00');

--
-- Triggers `buku`
--
DELIMITER $$
CREATE TRIGGER `buku_before_insert` BEFORE INSERT ON `buku` FOR EACH ROW BEGIN
IF NEW.jml_buku < 0 THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Jumlah buku tidak boleh kurang dari 0';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `username`, `nama_anggota`, `judul_buku`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(5, 'kelvin', 'kelvin', 'Belajar MySQL', '2024-11-03 10:00:00', '2024-11-10 10:00:00', 'Dipinjam'),
(6, 'latifah', 'latifah', 'Pemrograman Python', '2024-11-12 11:30:00', '2024-11-14 11:30:00', 'Dipinjam'),
(7, 'dimas', 'dimas', 'Algoritma dan Pemrograman', '2024-11-07 08:15:00', '2024-11-16 08:15:00', 'Dipinjam'),
(8, 'clarisa', 'clarisa', 'Pengantar Basis Data', '2024-11-15 14:45:00', '2024-12-16 14:45:00', 'Dipinjam');

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `transaksi_before_insert` BEFORE INSERT ON `transaksi` FOR EACH ROW BEGIN
IF NEW.tgl_kembali < NEW.tgl_pinjam THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Tanggal kembali tidak boleh lebih awal dari tanggal pinjam.';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hak_akses` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `hak_akses`) VALUES
(1, 'kelvin', 'kelvin123', 'kelvin@gmail.com', 'admin'),
(2, 'latifah', 'latifah', 'latifah@gmail.com', 'user'),
(3, 'dimas', 'dimas123', 'dimas@gmail.com', 'user'),
(4, 'clarisa', 'clarisa123', 'clarisa@gmail.com', 'user'),
(6, 'rocky', 'rocky1', 'rocky@gmail.com', 'user');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `CheckHakAksesBeforeInsert` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
IF NEW.hak_akses NOT IN ('admin', 'user') THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Hak akses yang dimasukkan tidak valid. harus "admin" atau "user".';
END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `idx_nama_anggota` (`nama_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `idx_judul_buku` (`judul_buku`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `FK_Buku_Transaksi` (`judul_buku`),
  ADD KEY `FK_User_Transaksi` (`username`),
  ADD KEY `FK_Anggota_Transaksi` (`nama_anggota`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `idx_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_Anggota_Transaksi` FOREIGN KEY (`nama_anggota`) REFERENCES `anggota` (`nama_anggota`),
  ADD CONSTRAINT `FK_Buku_Transaksi` FOREIGN KEY (`judul_buku`) REFERENCES `buku` (`judul_buku`),
  ADD CONSTRAINT `FK_User_Transaksi` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
