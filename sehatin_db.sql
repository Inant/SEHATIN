-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2018 at 03:37 PM
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
-- Table structure for table `antrian`
--

CREATE TABLE IF NOT EXISTS `antrian` (
`id_antrian` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `id_poli` tinyint(3) NOT NULL,
  `keluhan` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `id_pasien`, `waktu`, `status`, `id_poli`, `keluhan`) VALUES
(22, 5, '2018-11-17 21:30:31', 'Mengantri', 1, 'Deg degan');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_pelayanan`
--

CREATE TABLE IF NOT EXISTS `biaya_pelayanan` (
`id_biaya` tinyint(3) NOT NULL,
  `id_pelayanan` tinyint(3) NOT NULL,
  `id_kategori_pasien` tinyint(1) NOT NULL,
  `biaya` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `no_ijin_praktek` varchar(50) NOT NULL,
  `id_poli` tinyint(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nm_dokter`, `gender`, `alamat`, `no_hp`, `no_ijin_praktek`, `id_poli`) VALUES
(11, 'dr. Strange', 'Laki-laki', 'Cataluna', '0852587411478', 'SIP.KP.01.01.I.1.01.0872', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_obat`
--

CREATE TABLE IF NOT EXISTS `kategori_obat` (
`id_kategori` tinyint(3) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kategori_obat`
--

INSERT INTO `kategori_obat` (`id_kategori`, `kategori`, `status`) VALUES
(1, 'Sirup', 'Aktif'),
(2, 'Tablet', 'Aktif'),
(3, 'Obat Luar', 'Aktif'),
(4, 'Alat Kesehatan', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pasien`
--

CREATE TABLE IF NOT EXISTS `kategori_pasien` (
`id_kategori_pasien` tinyint(1) NOT NULL,
  `kategori_pasien` enum('Umum','Karyawan','Keluarga Karyawan','Mahasiswa') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kategori_pasien`
--

INSERT INTO `kategori_pasien` (`id_kategori_pasien`, `kategori_pasien`) VALUES
(1, 'Umum'),
(2, 'Karyawan'),
(3, 'Keluarga Karyawan'),
(4, 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
`id_login` tinyint(3) NOT NULL,
  `id_user` tinyint(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('Admin','Apoteker','Resepsionis','Kasir','Dokter') NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `id_user`, `username`, `password`, `level`, `status`) VALUES
(1, 15, 'jakfar', '16a4c4e9b7c54d1d4f726f58ad30c53b', 'Admin', 'Aktif'),
(2, 11, 'strange', '73a6fcb016535503154cecf09b787015', 'Dokter', 'Aktif'),
(4, 19, 'elsa', '783833680e6da5cf6cd7481a44d8fa4c', 'Resepsionis', 'Aktif');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nm_obat`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`, `tgl_kadaluarsa`, `id_petugas`) VALUES
(1, 'Milanta', 1, 1, 5000, 7000, 20, '2019-09-19', 11),
(2, 'Bodrex', 2, 1, 5000, 7000, 6, '2018-11-17', 11),
(3, 'Antangin', 4, 2, 1000, 2000, 50, '2019-04-11', 11),
(4, 'Hemaviton', 2, 2, 5000, 6500, 40, '2019-04-11', 11),
(5, 'Sangobion', 4, 2, 6000, 8000, 30, '2019-06-14', 11),
(6, 'Komix', 3, 1, 2000, 3000, 55, '2019-09-20', 11);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE IF NOT EXISTS `pasien` (
`id_pasien` int(11) NOT NULL,
  `no_identitas` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `pendidikan` varchar(5) NOT NULL,
  `status_perkawinan` enum('Belum Kawin','Kawin') NOT NULL,
  `id_kategori_pasien` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `no_identitas`, `nama`, `tmpt_lahir`, `tgl_lahir`, `gender`, `alamat`, `no_hp`, `pendidikan`, `status_perkawinan`, `id_kategori_pasien`) VALUES
(3, 'E41170241', 'Inant Kharisma', 'Banyuwangi', '1999-04-05', 'Laki-laki', 'Jl Mastrip 7, Kos Putra', '082359382266', 'SMA', 'Belum Kawin', 4),
(4, 'E41170241', 'Aan Hermawan', 'Banyuwangi', '1998-01-28', 'Laki-laki', 'Jl Kalimantan 10', '082359385041', 'SMA', 'Belum Kawin', 4),
(5, 'E41171254', 'Anwar', 'Kediri', '1999-02-04', 'Laki-laki', 'Jl Kaliurang', '085254123365', 'SMA', 'Belum Kawin', 4),
(6, '4561233699874561', 'Wati', 'Situbondo', '1979-08-09', 'Perempuan', 'California, US', '085256365214', 'S1', 'Kawin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE IF NOT EXISTS `pelayanan` (
`id_pelayanan` tinyint(3) NOT NULL,
  `pelayanan` varchar(50) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
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
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `gender`, `alamat`, `no_hp`) VALUES
(15, 'Jakfar Shodiq', 'Laki-laki', 'Jl. Kauman, Bondowoso', '083836541214'),
(19, 'Elsa Manora', 'Perempuan', 'Jl Mastrip Timur', '085258888785');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE IF NOT EXISTS `poli` (
`id_poli` tinyint(3) NOT NULL,
  `poli` varchar(30) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id_poli`, `poli`, `status`) VALUES
(1, 'Umum', 'Aktif'),
(2, 'Gigi', 'Aktif'),
(5, 'KIA', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_obat`
--

CREATE TABLE IF NOT EXISTS `satuan_obat` (
`id_satuan` tinyint(3) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `satuan_obat`
--

INSERT INTO `satuan_obat` (`id_satuan`, `satuan`, `status`) VALUES
(1, 'Tablet', 'Aktif'),
(2, 'Botol', 'Non Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
 ADD PRIMARY KEY (`id_antrian`), ADD KEY `id_pasien` (`id_pasien`,`id_poli`), ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `biaya_pelayanan`
--
ALTER TABLE `biaya_pelayanan`
 ADD PRIMARY KEY (`id_biaya`), ADD KEY `id_pelayanan` (`id_pelayanan`,`id_kategori_pasien`), ADD KEY `id_kategori_pasien` (`id_kategori_pasien`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
 ADD PRIMARY KEY (`id_dokter`), ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_pasien`
--
ALTER TABLE `kategori_pasien`
 ADD PRIMARY KEY (`id_kategori_pasien`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`id_login`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
 ADD PRIMARY KEY (`id_obat`), ADD KEY `id_kategori` (`id_kategori`,`id_satuan`,`id_petugas`), ADD KEY `id_satuan` (`id_satuan`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
 ADD PRIMARY KEY (`id_pasien`), ADD KEY `id_kategori_pasien` (`id_kategori_pasien`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
 ADD PRIMARY KEY (`id_pelayanan`);

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
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `biaya_pelayanan`
--
ALTER TABLE `biaya_pelayanan`
MODIFY `id_biaya` tinyint(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
MODIFY `id_dokter` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
MODIFY `id_kategori` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kategori_pasien`
--
ALTER TABLE `kategori_pasien`
MODIFY `id_kategori_pasien` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
MODIFY `id_login` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
MODIFY `id_obat` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
MODIFY `id_pelayanan` tinyint(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
MODIFY `id_petugas` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
MODIFY `id_poli` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
MODIFY `id_satuan` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id_poli`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `antrian_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `biaya_pelayanan`
--
ALTER TABLE `biaya_pelayanan`
ADD CONSTRAINT `biaya_pelayanan_ibfk_1` FOREIGN KEY (`id_pelayanan`) REFERENCES `pelayanan` (`id_pelayanan`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `biaya_pelayanan_ibfk_2` FOREIGN KEY (`id_kategori_pasien`) REFERENCES `kategori_pasien` (`id_kategori_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id_poli`);

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_obat` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `obat_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `satuan_obat` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`id_kategori_pasien`) REFERENCES `kategori_pasien` (`id_kategori_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
