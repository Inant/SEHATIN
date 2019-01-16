-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2019 at 12:58 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sehatin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `id_poli` tinyint(3) NOT NULL,
  `keluhan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `id_pasien`, `waktu`, `status`, `id_poli`, `keluhan`) VALUES
(1, 4, '2019-01-03 11:46:24', 'Selesai', 1, 'Pusing'),
(2, 7, '2019-01-03 11:47:56', 'Selesai', 2, 'Gusi bengkak'),
(3, 6, '2019-01-03 11:48:30', 'Selesai', 5, 'Imunisasi'),
(4, 11, '2019-01-13 06:59:00', 'Selesai', 1, 'Panas 2 hari'),
(5, 8, '2019-01-13 07:05:40', 'Selesai', 1, 'Batuk'),
(6, 11, '2019-01-13 22:17:58', 'Selesai', 1, 'panas 2 hari'),
(7, 11, '2019-01-14 11:26:42', 'Selesai', 1, 'panas'),
(8, 13, '2019-01-16 16:47:56', 'Selesai', 1, 'Pilek');

-- --------------------------------------------------------

--
-- Table structure for table `detail_resep`
--

CREATE TABLE `detail_resep` (
  `id_detail` int(11) NOT NULL,
  `id_resep` int(7) NOT NULL,
  `id_obat` int(7) NOT NULL,
  `dosis1` tinyint(1) NOT NULL,
  `dosis2` tinyint(1) NOT NULL,
  `jml` tinyint(3) NOT NULL,
  `subtotal` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_resep`
--

INSERT INTO `detail_resep` (`id_detail`, `id_resep`, `id_obat`, `dosis1`, `dosis2`, `jml`, `subtotal`) VALUES
(1, 1, 2, 2, 1, 2, 0),
(2, 2, 10, 3, 1, 2, 0),
(3, 2, 3, 2, 1, 3, 0),
(4, 3, 6, 3, 1, 2, 0),
(5, 4, 12, 2, 1, 2, 11000),
(6, 4, 13, 2, 1, 2, 18000),
(7, 5, 13, 2, 1, 1, 9000),
(8, 5, 12, 2, 1, 1, 5500),
(9, 6, 8, 2, 1, 2, 10000),
(10, 6, 2, 3, 1, 2, 18000),
(11, 7, 2, 2, 1, 1, 9000),
(12, 7, 6, 2, 1, 1, 13500),
(13, 8, 14, 2, 1, 2, 0),
(14, 8, 11, 3, 1, 2, 0),
(15, 8, 8, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `id_diagnosa` tinyint(3) NOT NULL,
  `diagnosa` varchar(30) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`id_diagnosa`, `diagnosa`, `status`) VALUES
(1, 'Demam', 'Aktif'),
(2, 'Flu Ringan', 'Aktif'),
(3, 'Flu Berat', 'Aktif'),
(5, 'Hipertermi', 'Aktif'),
(6, 'Infeksi', 'Aktif'),
(7, 'Neusea', 'Aktif'),
(8, 'Diare', 'Aktif'),
(9, 'Gigi berlubang', 'Aktif'),
(10, 'Gingivitis', 'Aktif'),
(11, 'Glositis', 'Aktif'),
(12, 'Gigi Hipersensitif', 'Aktif'),
(13, 'Batuk', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` tinyint(3) NOT NULL,
  `nm_dokter` varchar(50) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `no_ijin_praktek` varchar(50) NOT NULL,
  `id_poli` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nm_dokter`, `gender`, `alamat`, `no_hp`, `no_ijin_praktek`, `id_poli`) VALUES
(11, 'dr. Strange', 'Laki-laki', 'Cataluna', '0852587411478', 'SIP.KP.01.01.I.1.01.0872', 1),
(12, 'dr. Rose', 'Perempuan', 'London, UK', '089987799987', 'SIP.KP.01.01.I.1.01.0875', 2),
(13, 'dr. The Doctor', 'Laki-laki', 'Tavulia, Italia', '085258888785', 'SIP.KP.01.01.I.1.01.0871', 2),
(14, 'dr. Sapii', 'Laki-laki', 'Jl Kaliurang', '0852587411477', 'SIP.KP.01.01.I.1.01.0899', 1),
(15, 'dr. Sandra', 'Perempuan', 'Jember', '0852587411476', 'SIP.KP.01.01.I.1.01.0874', 1),
(16, 'dr. Master', 'Laki-laki', 'Barcelona, Spain', '0852587411477', 'SIP.KP.01.01.I.1.01.0875', 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_obat`
--

CREATE TABLE `kategori_obat` (
  `id_kategori` tinyint(3) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_obat`
--

INSERT INTO `kategori_obat` (`id_kategori`, `kategori`, `status`) VALUES
(1, 'Sirup', 'Aktif'),
(2, 'Tablet', 'Aktif'),
(3, 'Obat Luar', 'Aktif'),
(4, 'Alat Kesehatan', 'Non Aktif'),
(5, 'Salep', 'Aktif'),
(6, 'Kapsul', 'Aktif'),
(7, 'Obat Tetes', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` tinyint(3) NOT NULL,
  `id_user` tinyint(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('Admin','Apoteker','Resepsionis','Kasir','Dokter') NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `id_user`, `username`, `password`, `level`, `status`) VALUES
(1, 15, 'jakfar', '16a4c4e9b7c54d1d4f726f58ad30c53b', 'Admin', 'Aktif'),
(2, 11, 'strange', '73a6fcb016535503154cecf09b787015', 'Dokter', 'Aktif'),
(4, 19, 'elsa', '783833680e6da5cf6cd7481a44d8fa4c', 'Resepsionis', 'Aktif'),
(5, 12, 'rose', 'fcdc7b4207660a1372d0cd5491ad856e', 'Dokter', 'Aktif'),
(6, 20, 'meta', 'e9a23cbc455158951716b440c3d165e0', 'Apoteker', 'Aktif'),
(7, 13, 'doctor', 'f9f16d97c90d8c6f2cab37bb6d1f1992', 'Dokter', 'Aktif'),
(8, 14, 'sapii', '69594d8d985d25651dbccf36802d151e', 'Dokter', 'Non Aktif'),
(9, 21, 'fachri', '481600ee22793ea5a8024be139b7c2d6', 'Kasir', 'Aktif'),
(10, 15, 'sandra', 'f40a37048732da05928c3d374549c832', 'Dokter', 'Aktif'),
(11, 16, 'master', 'eb0a191797624dd3a48fa681d3061212', 'Dokter', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(7) NOT NULL,
  `nm_obat` varchar(50) NOT NULL,
  `id_kategori` tinyint(3) NOT NULL,
  `id_satuan` tinyint(3) NOT NULL,
  `harga_beli` int(7) NOT NULL,
  `harga_jual` int(7) NOT NULL,
  `stok` smallint(5) NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  `id_petugas` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nm_obat`, `id_kategori`, `id_satuan`, `harga_beli`, `harga_jual`, `stok`, `tgl_kadaluarsa`, `id_petugas`) VALUES
(1, 'Acyclovir', 5, 3, 3000, 4000, 23, '2019-09-19', 11),
(2, 'Abdelyn', 7, 3, 7000, 9000, 9, '2020-06-16', 11),
(3, 'A-D Plex Oral Drops', 7, 3, 8000, 10000, 27, '2019-04-11', 11),
(4, 'Acelaxon', 5, 3, 12500, 14500, 15, '2020-06-16', 11),
(5, 'Sangobion', 4, 2, 6000, 8000, 3, '2018-12-18', 11),
(6, 'Acatal', 2, 1, 12000, 13500, 4, '2019-09-20', 11),
(7, 'Bioplacenton', 5, 3, 15500, 17500, 7, '2023-02-07', 20),
(8, 'Acetaminophen', 2, 1, 4000, 5000, 17, '2020-06-16', 20),
(9, 'Benacol', 1, 2, 10000, 12000, 15, '2021-06-10', 20),
(10, 'Betason', 2, 1, 10000, 11500, 28, '2021-07-15', 20),
(11, 'Garamycin', 3, 3, 35000, 37000, 10, '2023-12-19', 20),
(12, 'Amoxicilin', 1, 2, 4000, 5500, 11, '2021-05-02', 20),
(13, 'Palmicol', 1, 2, 8000, 9000, 10, '2023-08-18', 20),
(14, 'Ulcucsan', 6, 4, 45000, 47000, 18, '2024-02-06', 20);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `no_identitas`, `nama`, `tmpt_lahir`, `tgl_lahir`, `gender`, `alamat`, `no_hp`, `pendidikan`, `status_perkawinan`, `kategori`) VALUES
(3, 'E41170241', 'Inant Kharisma', 'Banyuwangi', '1999-04-05', 'Laki-laki', 'Jl Mastrip 7, Kos Putra', '082359382266', 'SMA', 'Belum Kawin', 'Mahasiswa'),
(4, 'E41170241', 'Aan Hermawan', 'Banyuwangi', '1998-01-28', 'Laki-laki', 'Jl Kalimantan 10', '082359385041', 'SMA', 'Belum Kawin', 'Mahasiswa'),
(5, 'E41171254', 'Anwar', 'Kediri', '1999-02-04', 'Laki-laki', 'Jl Kaliurang', '085254123365', 'SMA', 'Belum Kawin', 'Keluarga Karyawan'),
(6, '4561233699874561', 'Wati', 'Situbondo', '1979-08-09', 'Perempuan', 'California, US', '085256365214', 'S1', 'Kawin', 'Keluarga Karyawan'),
(7, 'E41170234', 'Amrul', 'Bondowoso', '1998-06-17', 'Laki-laki', 'Jl. Mastrip 7', '081325458745', 'SMA', 'Belum Kawin', 'Mahasiswa'),
(8, '3371025812880001', 'Sunarti', 'Jember', '1995-06-14', 'Perempuan', 'Jl Kaliurang', '085236658789', 'SMA', 'Kawin', 'Umum'),
(9, '3371025812880002', 'Bahrain', 'Mojokerto', '1975-06-21', 'Laki-laki', 'Jl Kaliurang', '085231254412', 'SMA', 'Kawin', 'Umum'),
(10, 'E41171203', 'Kevin', 'Situbondo', '1999-02-10', 'Laki-laki', 'Jl Mastrip 7', '085236658777', 'SMA', 'Belum Kawin', 'Mahasiswa'),
(11, '3371025812880009', 'Fandi Eko', 'Surabaya', '1985-05-03', 'Laki-laki', 'Jl Kaliurang', '085235888766', 'SMA', 'Kawin', 'Umum'),
(12, '3371025812880011', 'Firmansyah', 'Lamongan', '1985-06-12', 'Laki-laki', 'Perumahan Taman Kampus', '085235888765', 'S1', 'Kawin', 'Umum'),
(13, 'E31174231', 'Mario Balotelli', 'Balikpapan', '1999-09-08', 'Laki-laki', 'Jl. Kalimantan 10', '085236658788', 'SMA', 'Belum Kawin', 'Mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id_pelayanan` tinyint(3) NOT NULL,
  `pelayanan` varchar(50) NOT NULL,
  `harga_umum` int(7) NOT NULL,
  `harga_karyawan` int(7) NOT NULL,
  `harga_kel_karyawan` int(7) NOT NULL,
  `harga_mahasiswa` int(7) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `pelayanan`, `harga_umum`, `harga_karyawan`, `harga_kel_karyawan`, `harga_mahasiswa`, `status`) VALUES
(1, 'Loket Rawat Jalan', 7000, 0, 0, 0, 'Aktif'),
(2, 'Pemeriksaan dokter', 20000, 0, 10000, 0, 'Aktif'),
(3, 'Jahitan', 20000, 10000, 15000, 5000, 'Aktif'),
(4, 'Pasang Oksigen', 25000, 15000, 15000, 0, 'Aktif'),
(5, 'Cek Tensi Darah', 5000, 0, 0, 0, 'Aktif'),
(6, 'Cabut gigi susu', 20000, 0, 15000, 0, 'Aktif'),
(7, 'Cabut gigi tetap', 20000, 10000, 15000, 5000, 'Aktif'),
(8, 'Angkat drainage', 25000, 15000, 20000, 15000, 'Aktif'),
(9, 'Angkat Jahitan', 25000, 15000, 20000, 15000, 'Aktif'),
(10, 'Ganti verban', 25000, 15000, 20000, 15000, 'Aktif'),
(11, 'Observasi > 1jam', 25000, 15000, 20000, 15000, 'Aktif'),
(12, 'Irigasi Telinga', 25000, 15000, 20000, 15000, 'Aktif'),
(13, 'Rawat luka kecil (<5cm)', 25000, 15000, 20000, 15000, 'Aktif'),
(14, 'Buka kateter', 25000, 15000, 20000, 15000, 'Aktif'),
(15, 'Injeksi Intravena/Intramuskuler/Intrakutan', 30000, 20000, 25000, 17500, 'Aktif'),
(16, 'Injeksi keloid', 35000, 25000, 30000, 20000, 'Aktif'),
(17, 'Pasang Infus (IV karakter)', 35000, 25000, 30000, 20000, 'Aktif'),
(18, 'Imunisasi', 35000, 25000, 30000, 20000, 'Aktif'),
(19, 'Ambil darah vena', 35000, 25000, 30000, 20000, 'Aktif'),
(20, 'Rectal toucher', 35000, 25000, 30000, 20000, 'Aktif'),
(21, 'Balutan tensocrep/perban elastis', 35000, 25000, 30000, 20000, 'Aktif'),
(22, 'Pasang spalk', 35000, 25000, 30000, 20000, 'Aktif'),
(23, 'Tindik telinga', 35000, 25000, 30000, 20000, 'Aktif'),
(24, 'Tambal gigi', 80000, 75000, 75000, 70000, 'Aktif'),
(25, 'Pembersihan karang gigi', 50000, 40000, 45000, 40000, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(7) NOT NULL,
  `id_antrian` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `grand_total` int(7) NOT NULL,
  `total_bayar` int(7) NOT NULL,
  `kembalian` int(7) NOT NULL,
  `id_user` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_antrian`, `waktu`, `grand_total`, `total_bayar`, `kembalian`, `id_user`) VALUES
(1, 1, '2019-01-03 13:13:10', 0, 0, 0, 21),
(2, 2, '2019-01-03 13:13:40', 5000, 10000, 5000, 21),
(3, 3, '2019-01-03 13:14:07', 10000, 20000, 10000, 21),
(4, 4, '2019-01-13 07:01:01', 56000, 56000, 0, 21),
(5, 5, '2019-01-13 07:07:27', 41500, 42000, 500, 21),
(6, 6, '2019-01-13 22:27:13', 55000, 60000, 5000, 21),
(7, 7, '2019-01-14 11:31:53', 49500, 50000, 500, 21),
(8, 8, '2019-01-16 16:57:14', 0, 0, 0, 21);

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id_pemeriksaan` int(7) NOT NULL,
  `id_antrian` int(11) NOT NULL,
  `id_dokter` tinyint(3) NOT NULL,
  `pemeriksaan_fisik` text NOT NULL,
  `tensi` varchar(10) NOT NULL,
  `suhu` tinyint(2) NOT NULL,
  `id_diagnosa` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id_pemeriksaan`, `id_antrian`, `id_dokter`, `pemeriksaan_fisik`, `tensi`, `suhu`, `id_diagnosa`) VALUES
(1, 1, 11, 'Check Up', '110 / 90', 35, 1),
(2, 2, 12, 'Periksa gusi', '110 / 90', 35, 10),
(3, 3, 16, 'Imunisasi', '110 / 90', 35, 7),
(4, 4, 11, 'Check Up', '110 / 90', 37, 1),
(5, 5, 11, 'Check', '110 / 90', 35, 2),
(6, 6, 11, 'Chek Up', '110 / 90', 37, 1),
(7, 7, 11, 'cek up', '110 / 90', 37, 1),
(8, 8, 11, 'Chek Up', '110 / 90', 36, 2);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` tinyint(3) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `gender`, `alamat`, `no_hp`) VALUES
(15, 'Jakfar Shodiq', 'Laki-laki', 'Jl. Kauman, Bondowoso', '083836541215'),
(19, 'Elsa Manora', 'Perempuan', 'Jl Mastrip Timur', '085258888785'),
(20, 'Meta Gadiecha', 'Perempuan', 'Jl. Mastrip Timur', '085825587478'),
(21, 'fachri', 'Laki-laki', 'Jl Batu Raden', '089987799988');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id_poli` tinyint(3) NOT NULL,
  `poli` varchar(30) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `id_pemeriksaan` int(7) NOT NULL,
  `tanggal` datetime NOT NULL,
  `harga_resep` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id_resep`, `id_pemeriksaan`, `tanggal`, `harga_resep`) VALUES
(1, 1, '2019-01-03 12:27:40', 0),
(2, 2, '2019-01-03 12:35:23', 0),
(3, 3, '2019-01-03 13:07:25', 0),
(4, 4, '2019-01-13 07:00:01', 29000),
(5, 5, '2019-01-13 07:06:32', 14500),
(6, 6, '2019-01-13 22:24:23', 28000),
(7, 7, '2019-01-14 11:28:51', 22500),
(8, 8, '2019-01-16 16:54:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `satuan_obat`
--

CREATE TABLE `satuan_obat` (
  `id_satuan` tinyint(3) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan_obat`
--

INSERT INTO `satuan_obat` (`id_satuan`, `satuan`, `status`) VALUES
(1, 'Tablet', 'Aktif'),
(2, 'Botol', 'Aktif'),
(3, 'pcs', 'Aktif'),
(4, 'Strip', 'Aktif'),
(5, 'Pack', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `id_tindakan` int(7) NOT NULL,
  `id_pemeriksaan` int(7) NOT NULL,
  `id_pelayanan` tinyint(3) NOT NULL,
  `subtotal` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`id_tindakan`, `id_pemeriksaan`, `id_pelayanan`, `subtotal`) VALUES
(59, 1, 1, 0),
(60, 1, 2, 0),
(61, 2, 1, 0),
(62, 2, 7, 5000),
(63, 3, 1, 0),
(64, 3, 2, 10000),
(65, 4, 1, 7000),
(66, 4, 2, 20000),
(67, 5, 1, 7000),
(68, 5, 2, 20000),
(69, 6, 1, 7000),
(70, 6, 2, 20000),
(71, 7, 1, 7000),
(72, 7, 2, 20000),
(73, 8, 1, 0),
(74, 8, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_pasien` (`id_pasien`,`id_poli`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_resep` (`id_resep`,`id_obat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`id_diagnosa`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_kategori` (`id_kategori`,`id_satuan`,`id_petugas`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `id_kategori_pasien` (`kategori`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id_pelayanan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_antrian` (`id_antrian`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`),
  ADD KEY `id_antrian` (`id_antrian`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_diagnosa` (`id_diagnosa`);

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
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `no_rm` (`id_pemeriksaan`);

--
-- Indexes for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id_tindakan`),
  ADD KEY `no_rm` (`id_pemeriksaan`,`id_pelayanan`),
  ADD KEY `id_pelayanan` (`id_pelayanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_resep`
--
ALTER TABLE `detail_resep`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `diagnosa`
--
ALTER TABLE `diagnosa`
  MODIFY `id_diagnosa` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  MODIFY `id_kategori` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id_pelayanan` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id_pemeriksaan` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id_poli` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `satuan_obat`
--
ALTER TABLE `satuan_obat`
  MODIFY `id_satuan` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id_tindakan` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

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
-- Constraints for table `detail_resep`
--
ALTER TABLE `detail_resep`
  ADD CONSTRAINT `detail_resep_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`);

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
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_antrian`) REFERENCES `antrian` (`id_antrian`);

--
-- Constraints for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`id_antrian`) REFERENCES `antrian` (`id_antrian`),
  ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`),
  ADD CONSTRAINT `pemeriksaan_ibfk_3` FOREIGN KEY (`id_diagnosa`) REFERENCES `diagnosa` (`id_diagnosa`);

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`id_pemeriksaan`) REFERENCES `pemeriksaan` (`id_pemeriksaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
