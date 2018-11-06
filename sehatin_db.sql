-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2018 at 09:31 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sehatin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE IF NOT EXISTS `dokter` (
`id_dokter` tinyint(3) NOT NULL,
  `nm_dokter` varchar(50) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `no_ijin_praktek` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nm_dokter`, `gender`, `alamat`, `no_hp`, `no_ijin_praktek`) VALUES
(1, 'dr. Kusumaa', 'Perempuan', 'Arjasa, Jember', '082321147741', 'SIP.KP.01.01.I.1.01.0870'),
(2, 'dr. Strange', 'Laki-laki', 'California, US', '082258896365', 'SIP.KP.01.01.I.1.01.0871'),
(4, 'dr. The Doctor', 'Laki-laki', 'Tavulia, Itali', '081325456985', 'SIP.KP.01.01.I.1.01.0875'),
(5, 'dr. Peri', 'Perempuan', 'Perum mastrip', '085365565251', 'SIP.KP.01.01.I.1.01.0878');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_obat`
--

CREATE TABLE IF NOT EXISTS `kategori_obat` (
`id_kategori` tinyint(3) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kategori_obat`
--

INSERT INTO `kategori_obat` (`id_kategori`, `kategori`) VALUES
(1, 'Sirup'),
(2, 'Tablet'),
(3, 'Obat Luar'),
(4, 'Alat Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE IF NOT EXISTS `obat` (
`id_obat` int(7) NOT NULL,
  `nm_obat` varchar(50) NOT NULL,
  `id_kategori` tinyint(3) NOT NULL,
  `id_satuan` tinyint(3) NOT NULL,
  `harga_beli` int(7) NOT NULL,
  `harga_jual` int(7) NOT NULL,
  `stok` smallint(5) NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  `id_petugas` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE IF NOT EXISTS `petugas` (
`id_petugas` tinyint(3) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('Resepsionis','Admin','Kasir') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `gender`, `alamat`, `no_hp`, `username`, `password`, `level`) VALUES
(11, 'Jakfar Shodiq', 'Laki-laki', 'Jl. Pb Sudirman, Bondowoso', '0852587411478', 'jakfar', '2649acebc1de2c0c15e30bb4c2a2b3c8', 'Admin'),
(12, 'Yuda Maulana', 'Laki-laki', 'Kajar City, Bondowoso', '081356654458', 'yuda', 'ac9053a8bd7632586c3eb663a6cf15e4', 'Resepsionis'),
(13, 'Gatot Subroto', 'Laki-laki', 'Perum Kaliurang', '085258852258', 'gatot', 'bb474dec2b2526c82e22c987722bbd7e', 'Kasir'),
(14, 'Meta', 'Perempuan', 'Jl Mastrip Timur', '0852587411477', 'meta', 'e9a23cbc455158951716b440c3d165e0', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE IF NOT EXISTS `poli` (
`id_poli` tinyint(3) NOT NULL,
  `poli` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id_poli`, `poli`) VALUES
(1, 'Umum'),
(2, 'Gigi'),
(5, 'Anak - anak');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_obat`
--

CREATE TABLE IF NOT EXISTS `satuan_obat` (
`id_satuan` tinyint(3) NOT NULL,
  `satuan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
 ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
 ADD PRIMARY KEY (`id_obat`), ADD KEY `id_kategori` (`id_kategori`,`id_satuan`,`id_petugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
 ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
 ADD PRIMARY KEY (`id_poli`);

--
-- Indexes for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
 ADD PRIMARY KEY (`id_satuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
MODIFY `id_dokter` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
MODIFY `id_kategori` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
MODIFY `id_obat` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
MODIFY `id_petugas` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
MODIFY `id_poli` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
MODIFY `id_satuan` tinyint(3) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
