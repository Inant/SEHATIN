-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2018 at 02:14 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `id_pasien`, `waktu`, `status`, `id_poli`, `keluhan`) VALUES
(22, 5, '2018-11-17 21:30:31', 'Mengantri', 1, 'Deg degan'),
(23, 5, '2018-11-18 12:01:51', 'Mengantri', 2, 'Gusi Bengkak'),
(24, 4, '2018-11-22 07:21:06', 'Diperiksa', 1, 'Gak ada apa apa'),
(25, 5, '2018-11-22 16:03:46', 'Mengantri', 1, 'Banyak mengeluh'),
(26, 7, '2018-11-27 16:46:42', 'Diperiksa', 1, 'Selalu ngeluh karena tugas'),
(27, 8, '2018-11-27 18:32:42', 'Diperiksa', 1, 'Pusing, panas'),
(28, 8, '2018-11-29 08:00:28', 'Diperiksa', 1, 'Selalu Ngeluh'),
(29, 3, '2018-11-29 08:21:34', 'Diperiksa', 1, 'Ga ada keluhan'),
(30, 5, '2018-11-30 00:31:09', 'Diperiksa', 1, 'Panas 2 hari'),
(31, 9, '2018-11-30 14:21:27', 'Diperiksa', 1, 'Pusing, meriang, flu'),
(32, 9, '2018-12-01 14:28:09', 'Diperiksa', 1, 'Panas'),
(33, 7, '2018-12-01 14:38:45', 'Diperiksa', 1, 'Selalu ngeluh'),
(34, 10, '2018-12-01 14:47:01', 'Diperiksa', 1, 'Kecapekan'),
(35, 9, '2018-12-02 06:16:12', 'Diperiksa', 1, 'Selalu ngeluh');

-- --------------------------------------------------------

--
-- Table structure for table `detail_resep`
--

CREATE TABLE IF NOT EXISTS `detail_resep` (
`id_detail` int(11) NOT NULL,
  `id_resep` int(7) NOT NULL,
  `id_obat` int(7) NOT NULL,
  `dosis_a` tinyint(1) NOT NULL,
  `dosis_b` tinyint(1) NOT NULL,
  `jml` tinyint(3) NOT NULL
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nm_dokter`, `gender`, `alamat`, `no_hp`, `no_ijin_praktek`, `id_poli`) VALUES
(11, 'dr. Strange', 'Laki-laki', 'Cataluna', '0852587411478', 'SIP.KP.01.01.I.1.01.0872', 1),
(12, 'dr. Rose', 'Perempuan', 'London, UK', '089987799987', 'SIP.KP.01.01.I.1.01.0875', 2);

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
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
`id_login` tinyint(3) NOT NULL,
  `id_user` tinyint(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('Admin','Apoteker','Resepsionis','Kasir','Dokter') NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `id_user`, `username`, `password`, `level`, `status`) VALUES
(1, 15, 'jakfar', '16a4c4e9b7c54d1d4f726f58ad30c53b', 'Admin', 'Aktif'),
(2, 11, 'strange', '73a6fcb016535503154cecf09b787015', 'Dokter', 'Aktif'),
(4, 19, 'elsa', '783833680e6da5cf6cd7481a44d8fa4c', 'Resepsionis', 'Aktif'),
(5, 12, 'rose', 'fcdc7b4207660a1372d0cd5491ad856e', 'Dokter', 'Aktif'),
(6, 20, 'meta', 'e9a23cbc455158951716b440c3d165e0', 'Apoteker', 'Aktif');

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
  `kategori` enum('Umum','Karyawan','Keluarga Karyawan','Mahasiswa') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `no_identitas`, `nama`, `tmpt_lahir`, `tgl_lahir`, `gender`, `alamat`, `no_hp`, `pendidikan`, `status_perkawinan`, `kategori`) VALUES
(3, 'E41170241', 'Inant Kharisma', 'Banyuwangi', '1999-04-05', 'Laki-laki', 'Jl Mastrip 7, Kos Putra', '082359382266', 'SMA', 'Belum Kawin', 'Mahasiswa'),
(4, 'E41170241', 'Aan Hermawan', 'Banyuwangi', '1998-01-28', 'Laki-laki', 'Jl Kalimantan 10', '082359385041', 'SMA', 'Belum Kawin', 'Mahasiswa'),
(5, 'E41171254', 'Anwar', 'Kediri', '1999-02-04', 'Laki-laki', 'Jl Kaliurang', '085254123365', 'SMA', 'Belum Kawin', 'Mahasiswa'),
(6, '4561233699874561', 'Wati', 'Situbondo', '1979-08-09', 'Perempuan', 'California, US', '085256365214', 'S1', 'Kawin', 'Keluarga Karyawan'),
(7, 'E41170234', 'Amrul', 'Bondowoso', '1998-06-17', 'Laki-laki', 'Jl. Mastrip 7', '081325458745', 'SMA', 'Belum Kawin', 'Mahasiswa'),
(8, '3371025812880001', 'Sunarti', 'Jember', '1995-06-14', 'Perempuan', 'Jl Kaliurang', '085236658789', 'SMA', 'Kawin', 'Umum'),
(9, '3371025812880002', 'Bahrain', 'Mojokerto', '1975-06-21', 'Laki-laki', 'Jl Kaliurang', '085231254412', 'SMA', 'Kawin', 'Umum'),
(10, 'E41171203', 'Kevin', 'Situbondo', '1999-02-10', 'Laki-laki', 'Jl Mastrip 7', '085236658777', 'SMA', 'Belum Kawin', 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE IF NOT EXISTS `pelayanan` (
`id_pelayanan` tinyint(3) NOT NULL,
  `pelayanan` varchar(50) NOT NULL,
  `harga_umum` int(7) NOT NULL,
  `harga_karyawan` int(7) NOT NULL,
  `harga_kel_karyawan` int(7) NOT NULL,
  `harga_mahasiswa` int(7) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `pelayanan`, `harga_umum`, `harga_karyawan`, `harga_kel_karyawan`, `harga_mahasiswa`, `status`) VALUES
(1, 'Loket Rawat Jalan', 7000, 0, 0, 0, 'Aktif'),
(2, 'Pemeriksaan', 20000, 0, 0, 0, 'Aktif'),
(3, 'Jahitan', 20000, 10000, 15000, 0, 'Aktif'),
(4, 'Pasang Oksigen', 25000, 15000, 15000, 0, 'Aktif'),
(5, 'Cek Tensi Darah', 5000, 0, 0, 0, 'Aktif'),
(6, 'vcvcv', 0, 0, 0, 0, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE IF NOT EXISTS `pemeriksaan` (
`id_pemeriksaan` int(7) NOT NULL,
  `id_antrian` int(11) NOT NULL,
  `id_dokter` tinyint(3) NOT NULL,
  `pemeriksaan_fisik` text NOT NULL,
  `tensi` varchar(10) NOT NULL,
  `suhu` tinyint(2) NOT NULL,
  `diagnosa` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id_pemeriksaan`, `id_antrian`, `id_dokter`, `pemeriksaan_fisik`, `tensi`, `suhu`, `diagnosa`) VALUES
(1, 26, 11, 'Periksa', '110 / 11', 35, 'Kecapekan'),
(2, 26, 11, 'Periksa', '110 / 11', 35, 'Kecapekan'),
(3, 26, 11, 'periksa', '110 / 11', 35, 'Lelah'),
(4, 26, 11, 'periksa', '110 110', 35, 'Diagnosadsf'),
(5, 27, 11, 'Pemeriksaan Fisikads', '120 / 95', 33, 'Flu ringan'),
(6, 27, 11, 'Pemeriksaan Fisikads', '120 / 95', 33, 'Flu ringan'),
(7, 27, 11, 'Pemeriksaan Fisikads', '120 / 95', 33, 'Flu ringan'),
(8, 29, 11, 'Pemeriksaan Fisik ya', '110 / 90', 34, 'Gak papa'),
(9, 30, 11, 'Check up', '120 / 100', 37, 'Demam tinggi'),
(10, 31, 11, 'Check Up', '110 / 80', 34, 'Flu disertai panas'),
(11, 32, 11, 'Pemeriksaan FisikAS', '120 / 110', 36, 'Demam'),
(12, 33, 11, 'Check Up', '110 / 90', 34, 'Kecapekan'),
(13, 34, 11, 'Check Up', '100 / 80', 34, 'Kecapekan'),
(14, 35, 11, 'Check Up', '110 / 80', 35, 'Kecapekan');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `gender`, `alamat`, `no_hp`) VALUES
(15, 'Jakfar Shodiq', 'Laki-laki', 'Jl. Kauman, Bondowoso', '083836541214'),
(19, 'Elsa Manora', 'Perempuan', 'Jl Mastrip Timur', '085258888785'),
(20, 'Meta Gadiecha', 'Perempuan', 'Jl. Mastrip Timur', '085825587478');

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
-- Table structure for table `resep`
--

CREATE TABLE IF NOT EXISTS `resep` (
`id_resep` int(11) NOT NULL,
  `id_pemeriksaan` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE IF NOT EXISTS `tindakan` (
`id_tindakan` int(7) NOT NULL,
  `id_pemeriksaan` int(7) NOT NULL,
  `id_pelayanan` tinyint(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`id_tindakan`, `id_pemeriksaan`, `id_pelayanan`) VALUES
(1, 3, 4),
(2, 4, 2),
(3, 6, 2),
(4, 7, 2),
(5, 8, 1),
(6, 9, 2),
(7, 10, 2),
(8, 11, 2),
(9, 12, 2),
(10, 13, 2),
(11, 14, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
 ADD PRIMARY KEY (`id_antrian`), ADD KEY `id_pasien` (`id_pasien`,`id_poli`), ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `detail_resep`
--
ALTER TABLE `detail_resep`
 ADD PRIMARY KEY (`id_detail`), ADD KEY `id_resep` (`id_resep`,`id_obat`);

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
 ADD PRIMARY KEY (`id_pasien`), ADD KEY `id_kategori_pasien` (`kategori`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
 ADD PRIMARY KEY (`id_pelayanan`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
 ADD PRIMARY KEY (`id_pemeriksaan`), ADD KEY `id_antrian` (`id_antrian`), ADD KEY `id_dokter` (`id_dokter`);

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
-- Indexes for table `resep`
--
ALTER TABLE `resep`
 ADD PRIMARY KEY (`id_resep`), ADD KEY `no_rm` (`id_pemeriksaan`);

--
-- Indexes for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
 ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
 ADD PRIMARY KEY (`id_tindakan`), ADD KEY `no_rm` (`id_pemeriksaan`,`id_pelayanan`), ADD KEY `id_pelayanan` (`id_pelayanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `detail_resep`
--
ALTER TABLE `detail_resep`
MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
MODIFY `id_dokter` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
MODIFY `id_kategori` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
MODIFY `id_login` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
MODIFY `id_obat` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
MODIFY `id_pelayanan` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
MODIFY `id_pemeriksaan` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
MODIFY `id_petugas` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
MODIFY `id_poli` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
MODIFY `id_satuan` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
MODIFY `id_tindakan` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
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
-- Constraints for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`id_antrian`) REFERENCES `antrian` (`id_antrian`),
ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`);

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `pemeriksaan` (`id_pemeriksaan`);

--
-- Constraints for table `tindakan`
--
ALTER TABLE `tindakan`
ADD CONSTRAINT `tindakan_ibfk_1` FOREIGN KEY (`id_pelayanan`) REFERENCES `pelayanan` (`id_pelayanan`),
ADD CONSTRAINT `tindakan_ibfk_2` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `pemeriksaan` (`id_pemeriksaan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
