-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Jan 2016 pada 18.07
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory_ikang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblmhistorybarang`
--

CREATE TABLE IF NOT EXISTS `tblmhistorybarang` (
`History_ID` int(15) NOT NULL,
  `Barang_ID` int(6) NOT NULL,
  `Suplier_ID` int(6) DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(100) NOT NULL,
  `Last_Modiefied` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(100) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblmkategori`
--

CREATE TABLE IF NOT EXISTS `tblmkategori` (
`Kategori_ID` int(4) NOT NULL,
  `Kategori_Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Last_Modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `tblmkategori`
--

INSERT INTO `tblmkategori` (`Kategori_ID`, `Kategori_Name`, `Created`, `Created_By`, `Last_Modified`, `Last_Modified_By`) VALUES
(1, 'Semen', '2015-04-07 13:42:46', 'admin', '0000-00-00 00:00:00', 'admin'),
(2, 'Besi-Edit', '2015-04-08 04:14:27', 'ikang', '2015-04-14 05:44:33', 'ikang'),
(17, 'Pasir-edit', '2015-04-08 08:47:16', 'ikang', '2015-04-09 09:15:51', 'ikang'),
(18, 'New-Kategori', '2015-04-20 08:47:04', 'ikang', '2015-04-20 03:47:04', 'ikang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblmmerk`
--

CREATE TABLE IF NOT EXISTS `tblmmerk` (
`Merk_ID` int(4) NOT NULL,
  `Merk_Name` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Last_Modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `tblmmerk`
--

INSERT INTO `tblmmerk` (`Merk_ID`, `Merk_Name`, `Created`, `Created_By`, `Last_Modified`, `Last_Modified_By`) VALUES
(1, 'Merk-01', '2015-04-09 07:35:10', 'admin', '0000-00-00 00:00:00', 'admin'),
(2, 'Merk-02', '2015-04-09 07:36:32', 'ikang', '2015-04-09 02:36:32', 'ikang'),
(4, 'Merk-03', '2015-04-09 16:01:14', 'ikang', '2015-04-09 11:01:14', 'ikang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblmmodel`
--

CREATE TABLE IF NOT EXISTS `tblmmodel` (
`Model_ID` int(5) NOT NULL,
  `Model_Name` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Last_Modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `tblmmodel`
--

INSERT INTO `tblmmodel` (`Model_ID`, `Model_Name`, `Created`, `Created_By`, `Last_Modified`, `Last_Modified_By`) VALUES
(1, 'Model - XXXXXXXXXXX', '2015-04-09 07:59:20', 'ikang', '2015-04-20 09:29:06', 'ikang'),
(2, 'AX-001', '2015-04-20 08:47:57', 'ikang', '2015-04-20 03:47:57', 'ikang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblmsatuan`
--

CREATE TABLE IF NOT EXISTS `tblmsatuan` (
`Satuan_ID` int(3) NOT NULL,
  `Satuan_Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Last_Modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tblmsatuan`
--

INSERT INTO `tblmsatuan` (`Satuan_ID`, `Satuan_Name`, `Created`, `Created_By`, `Last_Modified`, `Last_Modified_By`) VALUES
(5, 'Ton', '2015-04-09 08:10:41', 'ikang', '2015-04-09 03:10:41', 'ikang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblmsubkategori`
--

CREATE TABLE IF NOT EXISTS `tblmsubkategori` (
`SubKategori_ID` int(5) NOT NULL,
  `SubKategori_Name` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Last_Modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `tblmsubkategori`
--

INSERT INTO `tblmsubkategori` (`SubKategori_ID`, `SubKategori_Name`, `Created`, `Created_By`, `Last_Modified`, `Last_Modified_By`) VALUES
(1, 'Test01', '2015-04-09 04:57:38', 'admin', '0000-00-00 00:00:00', 'admin'),
(10, 'bb', '2015-04-09 06:35:42', 'ikang', '2015-04-09 01:35:42', 'ikang'),
(11, 'cc-edit', '2015-04-09 06:38:13', 'ikang', '2015-04-09 11:14:01', 'ikang'),
(12, 'dd', '2015-04-09 06:41:24', 'ikang', '2015-04-09 01:41:24', 'ikang'),
(14, 'ee', '2015-04-09 16:14:14', 'ikang', '2015-04-09 11:14:14', 'ikang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbltbarang`
--

CREATE TABLE IF NOT EXISTS `tbltbarang` (
`Barang_ID` int(6) NOT NULL,
  `Barang_Name` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `Kode_Barang` varchar(15) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `Kategori_ID` int(4) DEFAULT NULL,
  `SubKategori_ID` int(5) DEFAULT NULL,
  `Merk_ID` int(4) DEFAULT NULL,
  `Model_ID` int(5) DEFAULT NULL,
  `Satuan_ID` int(3) DEFAULT NULL,
  `ukuran` varchar(100) DEFAULT NULL,
  `Qty` decimal(10,0) DEFAULT NULL,
  `Limit` decimal(10,0) NOT NULL,
  `Harga_Beli` decimal(10,0) DEFAULT NULL,
  `Harga_Jual` decimal(10,0) DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Last_Modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `tbltbarang`
--

INSERT INTO `tbltbarang` (`Barang_ID`, `Barang_Name`, `Kode_Barang`, `Kategori_ID`, `SubKategori_ID`, `Merk_ID`, `Model_ID`, `Satuan_ID`, `ukuran`, `Qty`, `Limit`, `Harga_Beli`, `Harga_Jual`, `Created`, `Created_By`, `Last_Modified`, `Last_Modified_By`) VALUES
(1, 'Test-001', 'QQ-0001', 2, 10, 4, 1, 5, NULL, '50', '0', '60000', '90000', '2015-04-10 16:52:10', 'ikang', '2015-04-10 11:52:10', 'ikang'),
(7, 'Test-002', 'QXZ', 17, 12, 4, 1, 5, NULL, '5', '1', '10000', '100000', '2015-04-13 14:07:26', 'ikang', '2015-04-13 09:07:26', 'ikang'),
(9, 'Test - 02 - EDIT', 'QXZ EDIT', 2, 12, 4, 1, 5, NULL, '10', '3', '150000', '20000', '2015-04-13 14:10:14', 'ikang', '2015-04-14 01:44:38', 'ikang'),
(10, 'asdasd', 'ABCD-Edit1', 1, 12, 1, 1, 5, NULL, '5', '2', '1000', '20000', '2015-04-14 06:52:46', 'ikang', '2015-04-14 06:46:14', 'ikang'),
(12, 'Besi rusak', 'H0000', 1, 11, 2, 1, 5, NULL, '60', '10', '1000', '2000', '2015-04-14 14:44:11', 'ikang', '2015-04-14 09:44:11', 'ikang'),
(19, 'Besi tua', 'FR-001', 2, 11, 2, 1, 5, NULL, '50', '10', '100000000', '2000000', '2015-04-14 15:27:16', 'ikang', '2015-04-14 11:12:49', 'ikang'),
(20, 'Barang 1', 'Q0001', 17, 12, 2, 2, 5, NULL, '5', '1', '50000', '100000', '2015-04-30 09:33:29', 'ikang', '2015-04-30 04:33:29', 'ikang'),
(21, 'Barang2', 'Q0002', 17, 11, 4, 1, 5, NULL, '5', '1', '10000', '20000', '2015-04-30 09:34:17', 'ikang', '2015-04-30 04:34:17', 'ikang'),
(22, 'Barang3', 'Q0003', 17, 12, 1, 1, 5, NULL, '6', '1', '30000', '40000', '2015-04-30 09:34:51', 'ikang', '2015-04-30 04:34:51', 'ikang'),
(23, 'Barang4', 'Q0004', 17, 12, 2, 2, 5, NULL, '2', '3', '80000', '100000', '2015-04-30 09:35:22', 'ikang', '2015-04-30 04:35:22', 'ikang'),
(24, 'Barang5', 'Q0005', 17, 12, 2, 2, 5, NULL, '-1', '2', '100000', '150000', '2015-04-30 09:36:00', 'ikang', '2015-04-30 04:36:00', 'ikang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbltpenjualan`
--

CREATE TABLE IF NOT EXISTS `tbltpenjualan` (
`Penjualan_ID` int(11) NOT NULL,
  `Kode_Bon` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Tgl_Penjualan` date NOT NULL,
  `Tgl_Lunas` date DEFAULT NULL,
  `Tgl_Jatuh_Tempo` date DEFAULT NULL,
  `Nama_Pembeli` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Discount` bigint(20) DEFAULT '0',
  `Harga_Total` bigint(20) NOT NULL,
  `Harga_Hutang` bigint(20) DEFAULT '0',
  `Status` int(11) NOT NULL COMMENT 'CASH(1), LUNAS(2), HUTANG(3)',
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Created_By` varchar(50) NOT NULL,
  `Last_Modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tbltpenjualan`
--

INSERT INTO `tbltpenjualan` (`Penjualan_ID`, `Kode_Bon`, `Tgl_Penjualan`, `Tgl_Lunas`, `Tgl_Jatuh_Tempo`, `Nama_Pembeli`, `Discount`, `Harga_Total`, `Harga_Hutang`, `Status`, `Created`, `Created_By`, `Last_Modified`, `Last_Modified_By`) VALUES
(4, 'asdad', '0000-00-00', NULL, NULL, 'asdsad', 0, 0, 0, 1, '2015-07-09 12:58:15', 'ikang', '2015-06-19 12:08:33', 'ikang'),
(6, 'Qqwe123', '2016-01-20', NULL, '0000-00-00', 'Aslela', 30000, 470000, 0, 1, '2016-01-23 06:47:16', 'ikang', '2016-01-19 06:52:42', 'ikang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbltpenjualandetail`
--

CREATE TABLE IF NOT EXISTS `tbltpenjualandetail` (
`Penjualan_Detail_ID` int(11) NOT NULL,
  `Penjualan_ID` int(11) NOT NULL,
  `Barang_ID` int(6) NOT NULL,
  `Harga_Jual_Normal` decimal(10,0) NOT NULL,
  `Harga_Jual` decimal(10,0) NOT NULL,
  `Qty` decimal(10,0) NOT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1 clear, 2 cancel',
  `alasan` text,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Created_By` varchar(50) NOT NULL,
  `Last_Modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `tbltpenjualandetail`
--

INSERT INTO `tbltpenjualandetail` (`Penjualan_Detail_ID`, `Penjualan_ID`, `Barang_ID`, `Harga_Jual_Normal`, `Harga_Jual`, `Qty`, `status`, `alasan`, `Created`, `Created_By`, `Last_Modified`, `Last_Modified_By`) VALUES
(5, 4, 21, '20000', '50000', '3', 1, NULL, '2015-06-19 17:08:33', 'ikang', '2015-06-19 12:08:33', 'ikang'),
(6, 6, 24, '150000', '150000', '2', 1, NULL, '2016-01-19 06:52:42', 'ikang', '2016-01-19 06:52:42', 'ikang'),
(7, 6, 23, '100000', '100000', '2', 1, NULL, '2016-01-19 06:52:42', 'ikang', '2016-01-19 06:52:42', 'ikang'),
(8, 6, 24, '150000', '150000', '2', 1, NULL, '2016-01-19 06:52:42', 'ikang', '2016-01-19 06:52:42', 'ikang'),
(9, 6, 23, '100000', '100000', '2', 1, NULL, '2016-01-19 06:52:42', 'ikang', '2016-01-19 06:52:42', 'ikang'),
(10, 6, 24, '150000', '150000', '2', 1, NULL, '2016-01-19 06:52:42', 'ikang', '2016-01-19 06:52:42', 'ikang'),
(11, 6, 23, '100000', '100000', '2', 1, NULL, '2016-01-19 06:52:42', 'ikang', '2016-01-19 06:52:42', 'ikang'),
(12, 6, 24, '150000', '150000', '2', 1, NULL, '2016-01-19 06:52:42', 'ikang', '2016-01-19 06:52:42', 'ikang'),
(13, 6, 23, '100000', '100000', '2', 1, NULL, '2016-01-19 06:52:42', 'ikang', '2016-01-19 06:52:42', 'ikang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
`User_ID` int(3) NOT NULL,
  `User_Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Password` varchar(150) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Role` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Last_Modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Modified_By` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbluser`
--

INSERT INTO `tbluser` (`User_ID`, `User_Name`, `Password`, `Role`, `Created`, `Created_By`, `Last_Modified`, `Last_Modified_By`) VALUES
(1, 'ikang', '21232f297a57a5a743894a0e4a801fc3', 'Super Admin', '2015-04-07 06:17:10', 'vicky', '0000-00-00 00:00:00', 'vicky');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblmhistorybarang`
--
ALTER TABLE `tblmhistorybarang`
 ADD PRIMARY KEY (`History_ID`);

--
-- Indexes for table `tblmkategori`
--
ALTER TABLE `tblmkategori`
 ADD PRIMARY KEY (`Kategori_ID`);

--
-- Indexes for table `tblmmerk`
--
ALTER TABLE `tblmmerk`
 ADD PRIMARY KEY (`Merk_ID`);

--
-- Indexes for table `tblmmodel`
--
ALTER TABLE `tblmmodel`
 ADD PRIMARY KEY (`Model_ID`);

--
-- Indexes for table `tblmsatuan`
--
ALTER TABLE `tblmsatuan`
 ADD PRIMARY KEY (`Satuan_ID`);

--
-- Indexes for table `tblmsubkategori`
--
ALTER TABLE `tblmsubkategori`
 ADD PRIMARY KEY (`SubKategori_ID`);

--
-- Indexes for table `tbltbarang`
--
ALTER TABLE `tbltbarang`
 ADD PRIMARY KEY (`Barang_ID`), ADD UNIQUE KEY `Kode_Barang` (`Kode_Barang`), ADD KEY `kategori` (`Kategori_ID`), ADD KEY `subkategori` (`SubKategori_ID`), ADD KEY `merk` (`Merk_ID`), ADD KEY `satuan` (`Satuan_ID`), ADD KEY `model` (`Model_ID`);

--
-- Indexes for table `tbltpenjualan`
--
ALTER TABLE `tbltpenjualan`
 ADD PRIMARY KEY (`Penjualan_ID`);

--
-- Indexes for table `tbltpenjualandetail`
--
ALTER TABLE `tbltpenjualandetail`
 ADD PRIMARY KEY (`Penjualan_Detail_ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
 ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblmhistorybarang`
--
ALTER TABLE `tblmhistorybarang`
MODIFY `History_ID` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmkategori`
--
ALTER TABLE `tblmkategori`
MODIFY `Kategori_ID` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tblmmerk`
--
ALTER TABLE `tblmmerk`
MODIFY `Merk_ID` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblmmodel`
--
ALTER TABLE `tblmmodel`
MODIFY `Model_ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblmsatuan`
--
ALTER TABLE `tblmsatuan`
MODIFY `Satuan_ID` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblmsubkategori`
--
ALTER TABLE `tblmsubkategori`
MODIFY `SubKategori_ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbltbarang`
--
ALTER TABLE `tbltbarang`
MODIFY `Barang_ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbltpenjualan`
--
ALTER TABLE `tbltpenjualan`
MODIFY `Penjualan_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbltpenjualandetail`
--
ALTER TABLE `tbltpenjualandetail`
MODIFY `Penjualan_Detail_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
MODIFY `User_ID` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbltbarang`
--
ALTER TABLE `tbltbarang`
ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`Kategori_ID`) REFERENCES `tblmkategori` (`Kategori_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_merk` FOREIGN KEY (`Merk_ID`) REFERENCES `tblmmerk` (`Merk_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_model` FOREIGN KEY (`Model_ID`) REFERENCES `tblmmodel` (`Model_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_satuan` FOREIGN KEY (`Satuan_ID`) REFERENCES `tblmsatuan` (`Satuan_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_subkategori` FOREIGN KEY (`SubKategori_ID`) REFERENCES `tblmsubkategori` (`SubKategori_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
