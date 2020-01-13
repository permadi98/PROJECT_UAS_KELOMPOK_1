-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Jan 2020 pada 14.12
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toko_buku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(5) NOT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `noisbn` varchar(30) DEFAULT NULL,
  `penulis` varchar(30) DEFAULT NULL,
  `penerbit` varchar(30) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `harga_pokok` double DEFAULT NULL,
  `ppn` varchar(15) DEFAULT NULL,
  `diskon` varchar(15) DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `noisbn`, `penulis`, `penerbit`, `tahun`, `stok`, `harga_pokok`, `ppn`, `diskon`, `harga_jual`, `cover`) VALUES
(1, 'Sang Pemimpi', '979-3062-92-4', 'Andrea Hirata', 'Bentang Pustaka', '2006', 9, 57000, '2%', '0%', 58140, '../img/220px-Sang_Pemimpi_sampul.jpg'),
(2, 'Bumi Manusia', '986-8762-62-3', 'Pramoedya Ananta Toer', 'Hasta Mitra', '1980', 6, 60000, '3%', '5%', 58800, '../img/220px-Bumimanusia_big.gif'),
(3, 'Negeri 5 Menara', '978-979-22-4861', 'Ahmad Faudi', 'Gramedia', '2009', 8, 70000, '3%', '0%', 72100, '../img/220px-Menara_5_Negara.jpg'),
(4, 'Di Bawah Lindungan Kabah', '956-7863-67-6', 'Hamka', 'Balai Pustaka', '1938', 0, 55000, '2%', '5%', 53350, '../img/220px-Di_Bawah_Lindungan_Kabah_cover.jpg'),
(5, 'Laskar Pelangi', '8789798978979', 'Andrea Hirataa', 'Bentang Pustaka', '2005', 16, 57000, '2%', '0%', 58140, '../img/220px-Laskar_pelangi_sampul_2.jpg'),
(6, 'Obyek Wisata Ciburial Cimalaka', '213469809', 'asep', 'erlangga', '2019', 8, 20000, '5%', '', 21000, '../img/Dapino-Flowered-Folder-Folder-flower-black.ico');

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor`
--

CREATE TABLE IF NOT EXISTS `distributor` (
`id_distributor` int(5) NOT NULL,
  `nama_distributor` varchar(30) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `distributor`
--

INSERT INTO `distributor` (`id_distributor`, `nama_distributor`, `alamat`, `telepon`) VALUES
(1, 'PT.Cerdas Makmur', 'Bandung', '089898989898'),
(2, 'CV.Pintar Jaya', 'Jakarta', '087878787879');

-- --------------------------------------------------------

--
-- Stand-in structure for view `harga_jual`
--
CREATE TABLE IF NOT EXISTS `harga_jual` (
`id_buku` int(5)
,`judul` varchar(50)
,`noisbn` varchar(30)
,`penulis` varchar(30)
,`penerbit` varchar(30)
,`tahun` varchar(10)
,`stok` int(5)
,`harga_pokok` double
,`ppn` varchar(15)
,`diskon` varchar(15)
,`harga_jual` double
);
-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE IF NOT EXISTS `kasir` (
`id_kasir` int(5) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `status` enum('Menikah','Belum Menikah') DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `akses` enum('admin','kasir') DEFAULT NULL,
  `gambar` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `nama`, `alamat`, `telepon`, `status`, `username`, `password`, `akses`, `gambar`) VALUES
(1, 'Kasir 1', 'Sumedang', '083838383838', 'Menikah', 'kasir', '54321', 'kasir', '../img/Designbolts-Emoji-Emoji-Happy.ico'),
(2, 'Kelompok 1', 'Sumedang', '089898989898', 'Belum Menikah', 'admin', '12345', 'admin', '../img/Designbolts-Emoji-Emoji-Glad.ico');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasok`
--

CREATE TABLE IF NOT EXISTS `pasok` (
`id_pasok` int(5) NOT NULL,
  `id_distributor` int(5) DEFAULT NULL,
  `id_buku` int(5) DEFAULT NULL,
  `jumlah` int(5) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasok`
--

INSERT INTO `pasok` (`id_pasok`, `id_distributor`, `id_buku`, `jumlah`, `tanggal`) VALUES
(7, 1, 5, 10, '2019-06-15'),
(8, 2, 5, 2, '2019-06-15'),
(9, 1, 5, 10, '2020-01-08'),
(10, 1, 6, 10, '2020-01-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
`id_penjualan` int(5) NOT NULL,
  `id_buku` int(5) DEFAULT NULL,
  `id_kasir` int(5) DEFAULT NULL,
  `jumlah` int(5) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_buku`, `id_kasir`, `jumlah`, `total`, `tanggal`) VALUES
(11, 5, 2, 2, 116280, '2019-06-16'),
(13, 4, 2, 2, 106700, '2019-06-16'),
(16, 5, 2, 1, 58140, '2020-01-08'),
(17, 3, 2, 1, 72100, '2020-01-08'),
(20, 5, 2, 1, 58140, '2020-01-08'),
(21, 4, 2, 1, 53350, '2020-01-08'),
(22, 5, 2, 2, 116280, '2020-01-08'),
(23, 5, 2, 2, 116280, '2020-01-08'),
(24, 4, 2, 1, 53350, '2020-01-08'),
(25, 6, 1, 1, 21000, '2020-01-08'),
(26, 6, 2, 1, 21000, '2020-01-08');

--
-- Trigger `penjualan`
--
DELIMITER //
CREATE TRIGGER `kurang_buku` AFTER INSERT ON `penjualan`
 FOR EACH ROW BEGIN
	update buku set stok=stok-new.jumlah where id_buku=new.id_buku;
    END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur untuk view `harga_jual`
--
DROP TABLE IF EXISTS `harga_jual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `harga_jual` AS (select `buku`.`id_buku` AS `id_buku`,`buku`.`judul` AS `judul`,`buku`.`noisbn` AS `noisbn`,`buku`.`penulis` AS `penulis`,`buku`.`penerbit` AS `penerbit`,`buku`.`tahun` AS `tahun`,`buku`.`stok` AS `stok`,`buku`.`harga_pokok` AS `harga_pokok`,`buku`.`ppn` AS `ppn`,`buku`.`diskon` AS `diskon`,((`buku`.`harga_pokok` + ((`buku`.`harga_pokok` * `buku`.`ppn`) / 100)) - ((`buku`.`harga_pokok` * `buku`.`diskon`) / 100)) AS `harga_jual` from `buku`);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
 ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
 ADD PRIMARY KEY (`id_distributor`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
 ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `pasok`
--
ALTER TABLE `pasok`
 ADD PRIMARY KEY (`id_pasok`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
 ADD PRIMARY KEY (`id_penjualan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
MODIFY `id_distributor` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
MODIFY `id_kasir` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pasok`
--
ALTER TABLE `pasok`
MODIFY `id_pasok` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
MODIFY `id_penjualan` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
