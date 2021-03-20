-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2021 at 02:04 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengawasan_dana_desa`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_program`
-- (See below for the actual view)
--
CREATE TABLE `detail_program` (
`id_detail_program` int(11)
,`detail_program` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `gambar`
-- (See below for the actual view)
--
CREATE TABLE `gambar` (
`nama_bidang` varchar(255)
,`id_gambar` int(11)
,`nama_gambar` varchar(255)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `media`
-- (See below for the actual view)
--
CREATE TABLE `media` (
`id_gambar` int(11)
,`id_bidang` int(11)
,`nama_bidang` varchar(255)
,`nama_gambar` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pengguna`
-- (See below for the actual view)
--
CREATE TABLE `pengguna` (
`id_pengguna` char(255)
,`id_role` int(11)
,`nama` varchar(128)
,`nik` varchar(16)
,`image` varchar(128)
,`password` varchar(256)
,`role` varchar(128)
,`is_active` int(1)
,`date_created` int(11)
,`registration_ids` varchar(256)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `programs`
-- (See below for the actual view)
--
CREATE TABLE `programs` (
`id` int(11)
,`id_bidang` int(11)
,`id_sub_bidang` int(11)
,`nama_program` varchar(255)
,`nama_bidang` varchar(255)
,`sub_bidang` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `realisasi`
-- (See below for the actual view)
--
CREATE TABLE `realisasi` (
`id_realisasi` varchar(255)
,`realisasi` varchar(255)
,`id_parent` int(11)
,`parent` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `saran`
-- (See below for the actual view)
--
CREATE TABLE `saran` (
`id_saran` int(11)
,`id` int(11)
,`nama` varchar(128)
,`role` varchar(128)
,`image` varchar(128)
,`saran` text
,`status` enum('0','1')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sub_pembiayaans`
-- (See below for the actual view)
--
CREATE TABLE `sub_pembiayaans` (
`id_sub_pembiayaan` varchar(255)
,`id_pembiayaan` int(11)
,`sub_pembiayaan` varchar(255)
,`nama_pembiayaan` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sub_programs`
-- (See below for the actual view)
--
CREATE TABLE `sub_programs` (
`id_sub_program` varchar(255)
,`id` int(11)
,`sub_program` varchar(255)
,`nama_program` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `t_anggaran`
--

CREATE TABLE `t_anggaran` (
  `id_anggaran` int(11) NOT NULL,
  `id_bidang` int(11) DEFAULT '0',
  `id_pembiayaan` int(11) NOT NULL,
  `id_pendapatan` int(11) DEFAULT '0',
  `id_program` int(11) DEFAULT '0',
  `id_realisasi` varchar(255) NOT NULL DEFAULT 'SPM0',
  `id_realisasi_pertahun` varchar(255) NOT NULL DEFAULT 'SPM0',
  `id_tahun` int(11) NOT NULL,
  `id_bulan` int(11) NOT NULL DEFAULT '0',
  `anggaran_semula` bigint(20) NOT NULL,
  `anggaran_menjadi` bigint(20) NOT NULL DEFAULT '0',
  `serapan` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_anggaran`
--

INSERT INTO `t_anggaran` (`id_anggaran`, `id_bidang`, `id_pembiayaan`, `id_pendapatan`, `id_program`, `id_realisasi`, `id_realisasi_pertahun`, `id_tahun`, `id_bulan`, `anggaran_semula`, `anggaran_menjadi`, `serapan`) VALUES
(27, 0, 0, 2, 0, 'SPM0', 'SPM0', 1, 0, 306038000, 306038000, 0),
(28, 0, 0, 11, 0, 'SPM0', 'SPM0', 1, 0, 1132094, 1883583, 0),
(32, 0, 0, 1, 0, 'SPM0', 'SPM0', 1, 0, 777059000, 777059000, 0),
(37, 0, 0, 10, 0, 'SPM0', 'SPM0', 1, 0, 0, 3895250, 0),
(82, 0, 4, 0, 0, 'SPM0', 'SPM0', 1, 0, 7608750, 0, 0),
(83, 0, 5, 0, 0, 'SPM0', 'SPM0', 1, 0, 52347000, 0, 0),
(84, 46, 0, 0, 0, 'SPM0', 'SPM0', 1, 0, 310357094, 0, 0),
(85, 60, 0, 0, 0, 'SPM0', 'SPM0', 1, 0, 682437750, 0, 0),
(86, 48, 0, 0, 0, 'SPM0', 'SPM0', 1, 0, 0, 0, 0),
(87, 53, 0, 0, 0, 'SPM0', 'SPM0', 1, 0, 46696000, 0, 0),
(89, 0, 0, 0, 37, 'SPM0', 'SPM0', 1, 0, 36600000, 36600000, 0),
(142, 0, 0, 0, 26, 'SPM0', 'SPM0', 1, 0, 7200000, 31200000, 0),
(156, 0, 0, 0, 0, 'SPM0', 'SPM0', 1, 0, 2000000, 0, 0),
(191, 0, 0, 0, 0, 'SPM0', 'SPR70', 1, 0, 7200000, 0, 0),
(192, 0, 0, 0, 0, 'SPM0', 'SPR71', 1, 0, 24000000, 0, 0),
(194, 0, 0, 0, 0, 'SPR70', 'SPM0', 1, 1, 600000, 0, 500000),
(195, 0, 0, 0, 0, 'SPR70', 'SPM0', 1, 2, 600000, 0, 0),
(196, 0, 0, 0, 0, 'SPR70', 'SPM0', 1, 3, 600000, 0, 0),
(197, 0, 0, 0, 0, 'SPR70', 'SPM0', 1, 4, 600000, 0, 0),
(198, 0, 0, 0, 0, 'SPR71', 'SPM0', 1, 1, 21312121, 0, 0),
(199, 0, 0, 0, 0, 'SPM0', 'SPR37', 1, 0, 15000000, 0, 0),
(200, 0, 0, 0, 0, 'SPR30', 'SPM0', 1, 1, 15000000, 0, 0),
(201, 0, 0, 0, 0, 'SPR37', 'SPM0', 1, 1, 15000000, 0, 0),
(202, 0, 0, 0, 0, 'SPM0', 'SPR70', 2, 0, 13131414, 0, 0),
(203, 0, 0, 0, 49, 'SPM0', 'SPM0', 1, 0, 35000000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_bidang`
--

CREATE TABLE `t_bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bidang`
--

INSERT INTO `t_bidang` (`id_bidang`, `nama_bidang`) VALUES
(46, 'Pemerintahan Desa'),
(48, 'Pembinaan Masyarakat Desa'),
(53, 'Pemberdayaan Masyarakat Desa'),
(60, 'Pembangunan Desa');

-- --------------------------------------------------------

--
-- Table structure for table `t_bulan`
--

CREATE TABLE `t_bulan` (
  `id_bulan` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_bulan`
--

INSERT INTO `t_bulan` (`id_bulan`, `bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `t_gambar`
--

CREATE TABLE `t_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_gambar`
--

INSERT INTO `t_gambar` (`id_gambar`, `id_bidang`, `nama_gambar`, `created_at`) VALUES
(1, 60, '1563835830-p544b9aba1dd125bf4a65e6941b2046532.jpg', '2020-04-04 06:59:48'),
(2, 60, 'kualitas-pembangunan-di-desa-harus-dijaga2.jpeg', '2020-04-04 06:59:48'),
(3, 60, 'pembangunan-desa2.jpg', '2020-04-04 06:59:48'),
(4, 60, 'pembangunan-di-desa-sukapura-libatkan-masyarakat-sekitar2.jpeg', '2020-04-04 06:59:48'),
(5, 48, '1555288976_whatsapp-image-2019-04-14-at-18_50_091.jpeg', '2020-04-04 07:00:19'),
(6, 48, 'PicsArt_03-06-01_37_14-660x3301.jpg', '2020-04-04 07:00:19'),
(7, 48, 'unnamed2.jpg', '2020-04-04 07:00:19'),
(8, 53, '5-bbs2.jpg', '2020-04-04 08:05:46'),
(9, 53, '2014-10-02-09_13_453.jpg', '2020-04-04 08:05:46'),
(10, 53, 'unnamed_(1)3.jpg', '2020-04-04 08:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `t_kode_rek`
--

CREATE TABLE `t_kode_rek` (
  `id_rek` int(11) NOT NULL,
  `kode_rek` int(11) NOT NULL,
  `nama_akun` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_kode_rek`
--

INSERT INTO `t_kode_rek` (`id_rek`, `kode_rek`, `nama_akun`) VALUES
(4, 4, 'Pendapatan'),
(5, 5, 'Belanja'),
(6, 6, 'Pembiayaan'),
(7, 1, 'Aset'),
(8, 2, 'Kewajiban'),
(9, 3, 'Ekuitas');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembiayaan`
--

CREATE TABLE `t_pembiayaan` (
  `id_pembiayaan` int(11) NOT NULL,
  `nama_pembiayaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pembiayaan`
--

INSERT INTO `t_pembiayaan` (`id_pembiayaan`, `nama_pembiayaan`) VALUES
(4, 'Penerimaan Pembiayaan'),
(5, 'Pengeluaran Pembiayaan');

-- --------------------------------------------------------

--
-- Table structure for table `t_pemdes`
--

CREATE TABLE `t_pemdes` (
  `id_pemdes` int(11) NOT NULL,
  `nama_pemdes` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pemdes`
--

INSERT INTO `t_pemdes` (`id_pemdes`, `nama_pemdes`, `jabatan`, `foto`) VALUES
(5, 'Hasni Ismail', 'Sekretaris', 'facebook-user-icon-191.jpg'),
(6, 'Aprilia Gani', 'KAUR Umum dan TU ', 'facebook-user-icon-192.jpg'),
(7, 'Ismi Regista Gani', 'KAUR Keuangan', 'facebook-user-icon-193.jpg'),
(8, 'Ilham Gani', 'KASI Pemerintahan', 'facebook-user-icon-194.jpg'),
(9, 'Jhon Doe', 'Kepala Desa', 'facebook-user-icon-195.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `t_pengguna`
--

CREATE TABLE `t_pengguna` (
  `id` char(255) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `registration_ids` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pengguna`
--

INSERT INTO `t_pengguna` (`id`, `nama`, `nik`, `image`, `password`, `role_id`, `is_active`, `date_created`, `registration_ids`) VALUES
('020635a4-b2c4-11ea-9758-4cedfb0f8db2', 'Bendahara', '7504022708990007', 'facebook-user-icon-19.jpg', '7bd3829d7310ab6982c1ebe64e356a25', 8, 1, 1592636534, 'NULL'),
('79424cc0-6101-11ea-8f73-4cedfb0f8db2', 'Arif', '7504022708990001', 'Foto1.jpg', '157d730943c30d21ece2d55c538dfcaa', 1, 1, 1583646954, 'NULL'),
('87236091-b2c2-11ea-9758-4cedfb0f8db2', 'Pak Camat', '7504022708990003', 'default.png', '7bd3829d7310ab6982c1ebe64e356a25', 4, 1, 1592635898, 'NULL'),
('aa98dc58-b2c2-11ea-9758-4cedfb0f8db2', 'Anggota APIP', '7504022708990004', 'default.png', '7bd3829d7310ab6982c1ebe64e356a25', 5, 1, 1592635958, 'NULL'),
('b43315de-b2c2-11ea-9758-4cedfb0f8db2', 'Anggota BPK', '7504022708990005', 'default.png', '7bd3829d7310ab6982c1ebe64e356a25', 6, 1, 1592635974, 'NULL'),
('ba5f154f-b2c6-11ea-9758-4cedfb0f8db2', 'Arif Dauhi', '7504022708990008', 'default.png', '7bd3829d7310ab6982c1ebe64e356a25', 9, 1, 1592637702, 'NULL'),
('bf57e2ea-b2c2-11ea-9758-4cedfb0f8db2', 'Anggota KPK', '7504022708990006', 'default.png', '7bd3829d7310ab6982c1ebe64e356a25', 7, 1, 1592635992, 'NULL'),
('d79fc6c8-a7d7-11ea-88b4-00ffff818b6c', 'Jhon Doe', '7504022708990002', 'default.png', '5f4dcc3b5aa765d61d8327deb882cf99', 2, 1, 1591435607, 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `t_program`
--

CREATE TABLE `t_program` (
  `id` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `id_sub_bidang` int(11) NOT NULL,
  `nama_program` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_program`
--

INSERT INTO `t_program` (`id`, `id_bidang`, `id_sub_bidang`, `nama_program`) VALUES
(26, 60, 1, 'Penyelenggaraan PAUD/TK/TPA/TPQ/Madrasah NonFormal'),
(27, 60, 2, 'Penyelenggaraan Pos Kesehatan Desa/Polindes Milik Desa'),
(28, 60, 2, 'Penyelenggaraan Posyandu ( Mkn Tambahan, Kls Bumil, Lansia )'),
(29, 60, 3, 'Pemeliharaan Gedung/Prasarana Balai Desa/Balai Kemasyarakatan'),
(30, 60, 3, 'Pembangunan Rehabilitasi/Peningkatan Balai Desa/Balai Kemasyarakatan'),
(31, 60, 4, 'Dukungan Pelaksanaan Program Pembangunan/Rehab Rumah Tidak Layak'),
(32, 60, 5, 'Pembuatan dan Pengelolaan Jaringan/Instalasi Komunikasi dan Informasi'),
(33, 53, 6, 'Peningkatan Produksi Peternakan ( Alat Produksi/Pengelolaan/Kandang )'),
(34, 53, 7, 'Peningkatan Kapasitas Kepala Desa'),
(35, 53, 8, 'Pengembangan Saran Prasarana Usaha Mikro, Kecil dan Menengah'),
(37, 46, 9, 'Penyediaan Penghasilan Tetap dan Tunjangan Kepala Desa'),
(38, 46, 9, 'Penyediaan Penghasilan Tetap dan Tunjangan Perangkat Desa'),
(39, 46, 9, 'Penyediaan Operasional Pemerintah Desa'),
(40, 46, 9, 'Penyediaan Tunjangan BPD'),
(41, 46, 9, 'Penyediaan Operasional BPD'),
(42, 46, 9, 'Penyediaan Operasional LPM'),
(44, 46, 9, 'Penyediaan Operasional PKK'),
(45, 46, 10, 'Penyusunan, Pendataan, dan Pemutakhiran Profil Desa'),
(46, 46, 11, 'Penyelenggaraan Musyawarah Perencanaan Desa/Pembahasan APBDesa'),
(47, 46, 11, 'Penyelenggaraan Musyawarah Desa Lainnya'),
(48, 46, 11, 'Penyusunan Dokumen Perencanaan Desa'),
(49, 46, 11, 'Penyusunan Dokumen Keuangan Desa');

-- --------------------------------------------------------

--
-- Table structure for table `t_role`
--

CREATE TABLE `t_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_role`
--

INSERT INTO `t_role` (`id`, `role`) VALUES
(1, 'Operator Desa'),
(2, 'BPD'),
(3, 'Warga'),
(4, 'Camat'),
(5, 'APIP'),
(6, 'BPK'),
(7, 'KPK'),
(8, 'Bendahara'),
(9, 'Kepala Desa');

-- --------------------------------------------------------

--
-- Table structure for table `t_saran`
--

CREATE TABLE `t_saran` (
  `id_saran` int(11) NOT NULL,
  `id_pengguna` char(255) NOT NULL,
  `saran` text NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_saran`
--

INSERT INTO `t_saran` (`id_saran`, `id_pengguna`, `saran`, `status`) VALUES
(1, '79424cc0-6101-11ea-8f73-4cedfb0f8db2', 'Bagus Bagus Bagus Bagus Bagus', '1'),
(2, 'd79fc6c8-a7d7-11ea-88b4-00ffff818b6c', 'Tingkatkan', '1'),
(3, '79424cc0-6101-11ea-8f73-4cedfb0f8db2', 'sddfhgjhhhjhjhjjh', '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_sub_bidang`
--

CREATE TABLE `t_sub_bidang` (
  `id_sub_bidang` int(11) NOT NULL,
  `sub_bidang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_sub_bidang`
--

INSERT INTO `t_sub_bidang` (`id_sub_bidang`, `sub_bidang`) VALUES
(1, 'Pendidikan'),
(2, 'Kesehatan'),
(3, 'Pekerjaan Umum dan Penataan Ruang'),
(4, 'Kawasan Pemukiman'),
(5, 'Perhubungan, Komunikasi dan Informatika'),
(6, 'Pertanian dan Peternakan'),
(7, 'Peningkatan Kapasitas Aparatur Desa'),
(8, 'Koperasi, Usaha Mikro Kecil dan Menengah ( UMKM )'),
(9, 'Penyelenggaraan Belanja Siltap, Tunjangan dan Operasional Pemerintah Desa'),
(10, 'Pengelolaan Administrasi Kependudukan, Pencatatan Sipil, Statistik  dan Kearsipan'),
(11, 'Penyelenggaraan Tata Praja Pemerintahan, Perencanaan, Keuangan dan Pelaporan');

-- --------------------------------------------------------

--
-- Table structure for table `t_sub_pembiayaan`
--

CREATE TABLE `t_sub_pembiayaan` (
  `id_sub_pembiayaan` varchar(255) NOT NULL,
  `id_pembiayaan` int(11) NOT NULL,
  `sub_pembiayaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_sub_pembiayaan`
--

INSERT INTO `t_sub_pembiayaan` (`id_sub_pembiayaan`, `id_pembiayaan`, `sub_pembiayaan`) VALUES
('SPM1', 4, 'SILPA Tahun Sebelumnya'),
('SPM2', 5, 'Penyertaan Modal Desa'),
('SPM3', 4, 'Contoh Pembiayaan');

-- --------------------------------------------------------

--
-- Table structure for table `t_sub_program`
--

CREATE TABLE `t_sub_program` (
  `id_sub_program` varchar(255) NOT NULL,
  `id_program` int(11) NOT NULL,
  `sub_program` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_sub_program`
--

INSERT INTO `t_sub_program` (`id_sub_program`, `id_program`, `sub_program`) VALUES
('SPR1', 37, 'Penghasilan Tetap Kepala Desa'),
('SPR10', 45, 'Belanja Alat Tulis Kantor dan Benda Pos'),
('SPR11', 45, 'Belanja Barang Cetak dan Penggandaan'),
('SPR12', 39, 'Belanja Jasa Honorarium Petugas'),
('SPR13', 45, 'Belanja Jasa Honorarium Tim Pelaksana Kegiatan'),
('SPR14', 46, 'Belanja Alat Tulis Kantor dan Benda Pos'),
('SPR15', 46, 'Belanja Barang Cetak dan Penggandaan'),
('SPR16', 38, 'Penghasilan Tetap Perangkat Desa'),
('SPR17', 46, 'Belanja Barang Konsumsi (Makan/Minum)'),
('SPR18', 46, 'Belanja Bendera/Umbul-umbul/Spanduk'),
('SPR19', 46, 'Belanja Bendera/Umbul-umbul/Spanduk'),
('SPR2', 42, 'Belanja Alat Tulis Kantor dan Benda Pos'),
('SPR20', 46, 'Belanja Jasa Sewa Peralatan/Perlengkapan'),
('SPR21', 47, 'Belanja Alat Tulis Kantor dan Benda Pos'),
('SPR22', 47, 'Belanja Barang Cetak dan Penggandaan'),
('SPR23', 39, 'Belanja Jasa Langganan Listrik'),
('SPR24', 47, 'Belanja Barang Konsumsi (Makan/Minum)'),
('SPR25', 47, 'Belanja Bendera/Umbul-umbul/Spanduk'),
('SPR26', 47, 'Belanja Jasa Sewa Peralatan/Perlengkapan'),
('SPR27', 48, 'Belanja Alat Tulis Kantor dan Benda Pos'),
('SPR28', 38, 'Tunjangan Perangkat Desa'),
('SPR29', 48, 'Belanja Barang Cetak dan Penggandaan'),
('SPR3', 42, 'Belanja Barang Cetak dan Penggandaan'),
('SPR30', 48, 'Belanja Barang Konsumsi (Makan/Minum)'),
('SPR31', 48, 'Belanja Bendera/Umbul-umbul/Spanduk'),
('SPR32', 48, 'Belanja Jasa Honorarium Tim Pelaksana Kegiatan'),
('SPR33', 48, 'Belanja Jasa Sewa Peralatan/Perlengkapan'),
('SPR34', 39, 'Belanja Jasa Langganan Majalah/Surat Kabar'),
('SPR35', 49, 'Belanja Alat Tulis Kantor dan Benda Pos'),
('SPR36', 49, 'Belanja Barang Cetak dan Penggandaan'),
('SPR37', 49, 'Belanja Barang Konsumsi (Makan/Minum)'),
('SPR38', 49, 'Belanja Bendera/Umbul-umbul/Spanduk'),
('SPR39', 49, 'Belanja Jasa Sewa Peralatan/Perlengkapan'),
('SPR4', 37, 'Tunjangan Kepala Desa'),
('SPR40', 38, 'Penghasilan Tambahan Perangkat Desa'),
('SPR45', 39, 'Belanja Jasa Transaksi Keuangan (Admin Bank dll)'),
('SPR46', 27, 'Belanja Jasa Honorarium Petugas'),
('SPR47', 28, 'Belanja Bahan Perlengkapan untuk Diserahkan Kepada Masyarakat'),
('SPR48', 29, 'Belanja Pemeliharaan Bangunan'),
('SPR49', 30, 'Belanja Modal Gedung, Bangunan, Taman - Honor Pelaksana Kegiatan'),
('SPR5', 42, 'Belanja Barang Konsumsi (Makan/Minum)'),
('SPR50', 30, 'Belanja Modal Gedung, Bangunan, Taman - Upah Tenaga Kerja'),
('SPR51', 30, 'Belanja Modal Gedung, Bangunan, Taman - Bahan Baku/Material'),
('SPR52', 39, 'Belanja Alat Tulis Kantor dan Benda Pos'),
('SPR53', 31, 'Belanja Modal Gedung, Bangunan, Taman - Honor Pelaksana Kegiatan'),
('SPR54', 31, 'Belanja Modal Gedung, Bangunan, Taman - Upah Tenaga Kerja'),
('SPR55', 31, 'Belanja Modal Gedung, Bangunan, Taman - Bahan Baku/Material'),
('SPR56', 39, 'Belanja Pemeliharaan Kendaraan Bermotor'),
('SPR57', 32, 'Belanja Pemeliharaan Jaringan dan Instalasi (Listrik, telepon, internet)'),
('SPR58', 33, 'Belanja Modal Gedung, Bangunan, Taman - Upah Tenaga Kerja'),
('SPR59', 33, 'Belanja Modal Gedung, Bangunan, Taman - Bahan Baku/Material'),
('SPR6', 42, 'Belanja Pakaian Dinas/Seragam/Atribut'),
('SPR60', 34, 'Belanja Perjalanan Dinas'),
('SPR61', 34, 'Belanja Khusus Pelatihan / Peningkatan Kapasitas Aparatur Desa'),
('SPR62', 35, 'Belanja Bahan Perlengkapan untuk Diserahkan Kepada Masyarakat'),
('SPR63', 39, 'Belanja Barang Cetak dan Penggandaan'),
('SPR64', 39, 'Belanja Barang Konsumsi (Makan/Minum)'),
('SPR65', 39, 'Belanja Jasa Honorarium Pembantu Tugas Umum Desa/Operator'),
('SPR66', 40, 'Tunjangan Kedudukan BPD'),
('SPR67', 41, 'Belanja Alat Tulis Kantor dan Benda Pos'),
('SPR68', 41, 'Belanja Barang Konsumsi (Makan/Minum)'),
('SPR69', 26, 'Belanja Barang Cetak dan Penggandaan'),
('SPR7', 44, 'Belanja Alat Tulis Kantor dan Benda Pos'),
('SPR70', 26, 'Belanja Jasa Honorarium Tim Pelaksana Kegiatan'),
('SPR71', 26, 'Belanja Tenaga Ahli/Profesi/Konsultan/Narasumber'),
('SPR72', 26, 'Belanja Khusus Pendidikan dan Perpustakaan'),
('SPR8', 44, 'Belanja Pakaian Dinas/Seragam/Atribut'),
('SPR9', 44, 'Belanja Bahan Perlengkapan untuk Diserahkan Kepada Masyarakat');

-- --------------------------------------------------------

--
-- Table structure for table `t_sumber_pendapatan`
--

CREATE TABLE `t_sumber_pendapatan` (
  `id_pendapatan` int(11) NOT NULL,
  `sumber_pendapatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_sumber_pendapatan`
--

INSERT INTO `t_sumber_pendapatan` (`id_pendapatan`, `sumber_pendapatan`) VALUES
(1, 'Dana Desa'),
(2, 'Alokasi Dana Desa'),
(10, 'Pajak dan Retribusi'),
(11, 'Bunga Bank');

-- --------------------------------------------------------

--
-- Table structure for table `t_tahun_anggaran`
--

CREATE TABLE `t_tahun_anggaran` (
  `id_tahun` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_tahun_anggaran`
--

INSERT INTO `t_tahun_anggaran` (`id_tahun`, `tahun`) VALUES
(1, 2019),
(2, 2020),
(3, 2021);

-- --------------------------------------------------------

--
-- Structure for view `detail_program`
--
DROP TABLE IF EXISTS `detail_program`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_program`  AS  select `t_pembiayaan`.`id_pembiayaan` AS `id_detail_program`,`t_pembiayaan`.`nama_pembiayaan` AS `detail_program` from `t_pembiayaan` union select `t_program`.`id` AS `id_detail_program`,`t_program`.`nama_program` AS `detail_program` from `t_program` ;

-- --------------------------------------------------------

--
-- Structure for view `gambar`
--
DROP TABLE IF EXISTS `gambar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `gambar`  AS  select `t_bidang`.`nama_bidang` AS `nama_bidang`,`t_gambar`.`id_gambar` AS `id_gambar`,`t_gambar`.`nama_gambar` AS `nama_gambar`,`t_gambar`.`created_at` AS `created_at` from (`t_gambar` left join `t_bidang` on((`t_bidang`.`id_bidang` = `t_gambar`.`id_bidang`))) ;

-- --------------------------------------------------------

--
-- Structure for view `media`
--
DROP TABLE IF EXISTS `media`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `media`  AS  select `t_gambar`.`id_gambar` AS `id_gambar`,`t_bidang`.`id_bidang` AS `id_bidang`,`t_bidang`.`nama_bidang` AS `nama_bidang`,`t_gambar`.`nama_gambar` AS `nama_gambar` from (`t_gambar` left join `t_bidang` on((`t_gambar`.`id_bidang` = `t_bidang`.`id_bidang`))) where 1 ;

-- --------------------------------------------------------

--
-- Structure for view `pengguna`
--
DROP TABLE IF EXISTS `pengguna`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pengguna`  AS  select `t_pengguna`.`id` AS `id_pengguna`,`t_role`.`id` AS `id_role`,`t_pengguna`.`nama` AS `nama`,`t_pengguna`.`nik` AS `nik`,`t_pengguna`.`image` AS `image`,`t_pengguna`.`password` AS `password`,`t_role`.`role` AS `role`,`t_pengguna`.`is_active` AS `is_active`,`t_pengguna`.`date_created` AS `date_created`,`t_pengguna`.`registration_ids` AS `registration_ids` from (`t_pengguna` left join `t_role` on((`t_pengguna`.`role_id` = `t_role`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `programs`
--
DROP TABLE IF EXISTS `programs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `programs`  AS  select `t_program`.`id` AS `id`,`t_bidang`.`id_bidang` AS `id_bidang`,`t_sub_bidang`.`id_sub_bidang` AS `id_sub_bidang`,`t_program`.`nama_program` AS `nama_program`,`t_bidang`.`nama_bidang` AS `nama_bidang`,`t_sub_bidang`.`sub_bidang` AS `sub_bidang` from ((`t_program` left join `t_bidang` on((`t_program`.`id_bidang` = `t_bidang`.`id_bidang`))) left join `t_sub_bidang` on((`t_program`.`id_sub_bidang` = `t_sub_bidang`.`id_sub_bidang`))) ;

-- --------------------------------------------------------

--
-- Structure for view `realisasi`
--
DROP TABLE IF EXISTS `realisasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `realisasi`  AS  select `t_sub_pembiayaan`.`id_sub_pembiayaan` AS `id_realisasi`,`t_sub_pembiayaan`.`sub_pembiayaan` AS `realisasi`,`t_pembiayaan`.`id_pembiayaan` AS `id_parent`,`t_pembiayaan`.`nama_pembiayaan` AS `parent` from (`t_sub_pembiayaan` left join `t_pembiayaan` on((`t_sub_pembiayaan`.`id_pembiayaan` = `t_pembiayaan`.`id_pembiayaan`))) union select `t_sub_program`.`id_sub_program` AS `id_realisasi`,`t_sub_program`.`sub_program` AS `realisasi`,`t_program`.`id` AS `id_parent`,`t_program`.`nama_program` AS `parent` from (`t_sub_program` left join `t_program` on((`t_sub_program`.`id_program` = `t_program`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `saran`
--
DROP TABLE IF EXISTS `saran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `saran`  AS  select `t_saran`.`id_saran` AS `id_saran`,`t_role`.`id` AS `id`,`t_pengguna`.`nama` AS `nama`,`t_role`.`role` AS `role`,`t_pengguna`.`image` AS `image`,`t_saran`.`saran` AS `saran`,`t_saran`.`status` AS `status` from ((`t_saran` left join `t_pengguna` on((`t_saran`.`id_pengguna` = `t_pengguna`.`id`))) left join `t_role` on((`t_pengguna`.`role_id` = `t_role`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `sub_pembiayaans`
--
DROP TABLE IF EXISTS `sub_pembiayaans`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sub_pembiayaans`  AS  select `t_sub_pembiayaan`.`id_sub_pembiayaan` AS `id_sub_pembiayaan`,`t_pembiayaan`.`id_pembiayaan` AS `id_pembiayaan`,`t_sub_pembiayaan`.`sub_pembiayaan` AS `sub_pembiayaan`,`t_pembiayaan`.`nama_pembiayaan` AS `nama_pembiayaan` from (`t_sub_pembiayaan` left join `t_pembiayaan` on((`t_sub_pembiayaan`.`id_pembiayaan` = `t_pembiayaan`.`id_pembiayaan`))) ;

-- --------------------------------------------------------

--
-- Structure for view `sub_programs`
--
DROP TABLE IF EXISTS `sub_programs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sub_programs`  AS  select `t_sub_program`.`id_sub_program` AS `id_sub_program`,`t_program`.`id` AS `id`,`t_sub_program`.`sub_program` AS `sub_program`,`t_program`.`nama_program` AS `nama_program` from (`t_sub_program` left join `t_program` on((`t_sub_program`.`id_program` = `t_program`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_anggaran`
--
ALTER TABLE `t_anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indexes for table `t_bidang`
--
ALTER TABLE `t_bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `t_bulan`
--
ALTER TABLE `t_bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `t_gambar`
--
ALTER TABLE `t_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `t_kode_rek`
--
ALTER TABLE `t_kode_rek`
  ADD PRIMARY KEY (`id_rek`);

--
-- Indexes for table `t_pembiayaan`
--
ALTER TABLE `t_pembiayaan`
  ADD PRIMARY KEY (`id_pembiayaan`);

--
-- Indexes for table `t_pemdes`
--
ALTER TABLE `t_pemdes`
  ADD PRIMARY KEY (`id_pemdes`);

--
-- Indexes for table `t_pengguna`
--
ALTER TABLE `t_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_program`
--
ALTER TABLE `t_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_saran`
--
ALTER TABLE `t_saran`
  ADD PRIMARY KEY (`id_saran`);

--
-- Indexes for table `t_sub_bidang`
--
ALTER TABLE `t_sub_bidang`
  ADD PRIMARY KEY (`id_sub_bidang`);

--
-- Indexes for table `t_sub_pembiayaan`
--
ALTER TABLE `t_sub_pembiayaan`
  ADD PRIMARY KEY (`id_sub_pembiayaan`);

--
-- Indexes for table `t_sub_program`
--
ALTER TABLE `t_sub_program`
  ADD PRIMARY KEY (`id_sub_program`);

--
-- Indexes for table `t_sumber_pendapatan`
--
ALTER TABLE `t_sumber_pendapatan`
  ADD PRIMARY KEY (`id_pendapatan`);

--
-- Indexes for table `t_tahun_anggaran`
--
ALTER TABLE `t_tahun_anggaran`
  ADD PRIMARY KEY (`id_tahun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_anggaran`
--
ALTER TABLE `t_anggaran`
  MODIFY `id_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `t_bidang`
--
ALTER TABLE `t_bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `t_bulan`
--
ALTER TABLE `t_bulan`
  MODIFY `id_bulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_gambar`
--
ALTER TABLE `t_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_kode_rek`
--
ALTER TABLE `t_kode_rek`
  MODIFY `id_rek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_pembiayaan`
--
ALTER TABLE `t_pembiayaan`
  MODIFY `id_pembiayaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_pemdes`
--
ALTER TABLE `t_pemdes`
  MODIFY `id_pemdes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_program`
--
ALTER TABLE `t_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_saran`
--
ALTER TABLE `t_saran`
  MODIFY `id_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_sub_bidang`
--
ALTER TABLE `t_sub_bidang`
  MODIFY `id_sub_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_sumber_pendapatan`
--
ALTER TABLE `t_sumber_pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_tahun_anggaran`
--
ALTER TABLE `t_tahun_anggaran`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
