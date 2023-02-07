-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 07:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_swalayan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` int(100) NOT NULL,
  `stok` int(100) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `gambar`) VALUES
('1', '1', 1, 11, ''),
('BRG001', 'bakso pentol', 10000, 55, '1674282137_illust_55325876_20211218_025542.jpg'),
('BRG002', 'sangat capek', 20000, 433, '2068771449_images.jpg'),
('BRG003', 'gak tau apa ', 34500, 220, '1132619322_download (4).jpg'),
('BRG004', 'sendal legendz', 5000, 400, '1470581097_download (3).jpg'),
('BRG005', 'apa aja ', 45000, 101, '749266320_download (1).jpg'),
('BRG006', 'tali sepatu aja ', 87500, 211, '18969968_download (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(10) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `jenis_kelamin`, `alamat`, `no_hp`) VALUES
('PEL001', 'test', 'Laki-laki', 'dimana ajazaa', '999902'),
('PEL003', 'tetstst', 'Laki-laki', 'hzcasi', '4953495`'),
('PEL004', 'ontalah', 'Perempuan', 'nasasa', '1221');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(10) NOT NULL,
  `id_pelanggan` varchar(10) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `id_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `tanggal`, `id_barang`, `jumlah`, `total`, `id_user`) VALUES
('INV001', 'PEL001', '2023-02-07 00:55:00', '', 1, 20000, 'USR005'),
('INV002', 'PEL001', '2023-02-07 01:03:00', 'bakso pent', 3, 30000, 'USR005');

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `update_stok` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN 
UPDATE barang SET stok = stok - new. jumlah WHERE id_barang=new.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `jenis_kelamin`, `username`, `password`, `no_hp`) VALUES
('USR001', 'Admin', 'Laki-laki', 'Admin', 'Admin', '0220'),
('USR002', 'User Aja', 'Perempuan', 'User', 'User', '0812'),
('USR003', 'siapa aja', '1', 'test', 'text', '62'),
('USR004', 'teeee', '2', 'tetete', 'uuuq', '999'),
('USR005', 'test', 'Perempuan', 'test', 'test', '898'),
('USR006', 'hfhfhh', '1', 'hshshh', 'hwkwhkw', '999'),
('USR007', 'kskaskask', '1', 'kabkabsab ', 'hashasvha', '7171771'),
('USR008', 'abjajabsjajsbjsc', '2', 'jbx  sidaidhi', 'lnaxz  ssoa', '888282'),
('USR009', 'nama', 'Perempuan', 'nama', 'nama', '22211'),
('USR010', 'conasak', 'Perempuan', 'assdfsdf', '123456', '39994341');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`,`id_barang`,`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
