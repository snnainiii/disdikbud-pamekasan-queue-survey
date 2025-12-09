-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 09:48 AM
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
-- Database: `antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `no_antrian` varchar(255) NOT NULL,
  `status` enum('belum','dipanggil','dipanggil ulang','selesai') NOT NULL DEFAULT 'belum',
  `id_bidang` int(11) NOT NULL,
  `id_pelayanan` int(11) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `id_loket` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `id_user`, `tanggal`, `no_antrian`, `status`, `id_bidang`, `id_pelayanan`, `update_date`, `id_loket`) VALUES
(467, 101, '2024-04-13', 'C001', 'selesai', 8, 12, NULL, NULL),
(468, 102, '2024-04-23', 'C001', 'selesai', 5, 19, '2024-04-23 19:38:21', 12),
(469, 103, '2024-04-23', 'B001', 'selesai', 5, 9, '2024-04-23 19:53:03', 11),
(470, 104, '2024-04-23', 'A001', 'selesai', 5, 2, '2024-04-23 19:53:04', 10),
(471, 105, '2024-04-26', 'C001', 'belum', 2, 14, NULL, NULL),
(472, 106, '2024-04-26', 'A001', 'selesai', 10, 24, '2024-04-26 13:58:08', 26),
(473, 106, '2024-04-26', 'A002', 'selesai', 10, 24, '2024-04-26 13:59:40', 26),
(474, 106, '2024-04-26', 'A003', 'dipanggil', 10, 24, '2024-04-26 14:00:45', 26),
(475, 106, '2024-04-26', 'A004', 'belum', 10, 24, NULL, NULL),
(476, 107, '2024-04-30', 'A001', 'dipanggil ulang', 5, 2, '2024-04-30 02:12:06', 10),
(477, 107, '2024-04-30', 'A002', 'dipanggil', 5, 2, '2024-04-30 02:11:59', 12),
(478, 107, '2024-04-30', 'A003', 'belum', 5, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `nama_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `id_profil`, `nama_bidang`) VALUES
(1, 1, 'superadmin'),
(2, 1, 'SUB BAG UMUM DAN KEPEGAWAIAN'),
(3, 1, 'SUB BAG PERENCANAAN DAN EVALUASI'),
(4, 1, 'SUB BAG KEUANGAN DAN ASET'),
(5, 1, 'BIDANG PEMBINAAN SEKOLAH DASAR'),
(6, 1, 'BIDANG PEMBINAAN SEKOLAH MENENGAN PERTAMA'),
(7, 1, 'BIDANG PEMBINAAN PENDIDIKAN ANAK USIA DINI DAN NONFORMAL'),
(8, 1, 'BIDANG PENILAIAN KETENAGAAN KEPENDIDIKAN'),
(9, 1, 'BIDANG KEBUDAYAAN'),
(10, 1, 'CABANG DINAS');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `pw`, `id_profil`, `id_bidang`) VALUES
(1, 'superadmin', 'superadmin', 1, 1),
(2, 'subbag_umum_kepegawaian', 'umum123', 1, 2),
(3, 'subbag_perencanaan_evaluasi', 'perencanaan123', 1, 3),
(4, 'subbag_keuangan_aset', 'keuangan123', 1, 4),
(5, 'bid_pembinaan_sd', 'sd123', 1, 5),
(6, 'bidang_pembinaan_smp', 'smp123', 1, 6),
(7, 'bidang_pembinaan_paud_dni', 'pauddni123', 1, 7),
(8, 'bidang_tendik', 'tendik123', 1, 8),
(9, 'bidang_kebudayaan', 'budaya123', 1, 9),
(10, 'cabang_dinas', 'capdis123', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `loket`
--

CREATE TABLE `loket` (
  `id_loket` int(11) NOT NULL,
  `nama_loket` varchar(255) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `status` enum('kosong','terisi') NOT NULL DEFAULT 'kosong',
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loket`
--

INSERT INTO `loket` (`id_loket`, `nama_loket`, `id_bidang`, `status`, `create_date`, `update_date`) VALUES
(1, '1', 2, 'kosong', '2024-03-17 12:26:48', NULL),
(2, '2', 2, 'kosong', '2024-03-17 12:26:48', NULL),
(3, '3', 2, 'kosong', '2024-03-17 12:26:48', '2024-04-01 12:26:27'),
(4, '4', 2, 'kosong', '2024-03-17 12:26:48', NULL),
(5, '5', 2, 'kosong', '2024-03-17 12:26:48', NULL),
(6, '1', 3, 'kosong', '2024-03-17 12:28:44', NULL),
(7, '1', 4, 'kosong', '2024-03-17 12:29:00', NULL),
(8, '2', 4, 'kosong', '2024-03-17 12:29:00', NULL),
(9, '1', 5, 'kosong', '2024-03-17 12:30:20', '2024-04-13 07:37:14'),
(10, '2', 5, 'terisi', '2024-03-17 12:30:20', '2024-04-30 02:11:43'),
(11, '3', 5, 'kosong', '2024-03-17 12:30:20', '2024-04-23 19:53:03'),
(12, '4', 5, 'terisi', '2024-03-17 12:30:20', '2024-04-30 02:11:59'),
(13, '1', 6, 'kosong', '2024-03-17 12:33:46', NULL),
(14, '2', 6, 'kosong', '2024-03-17 12:33:46', NULL),
(15, '3', 6, 'kosong', '2024-03-17 12:33:46', NULL),
(16, '4', 6, 'kosong', '2024-03-17 12:33:46', NULL),
(17, '1', 7, 'kosong', '2024-03-17 12:37:55', NULL),
(18, '2', 7, 'kosong', '2024-03-17 12:37:55', NULL),
(19, '1', 8, 'kosong', '2024-03-17 12:42:49', '2024-04-13 12:23:03'),
(20, '2', 8, 'kosong', '2024-03-17 12:42:49', '2024-04-13 12:22:56'),
(21, '3', 8, 'kosong', '2024-03-17 12:42:49', '2024-04-13 12:22:57'),
(22, '4', 8, 'kosong', '2024-03-17 12:42:49', '2024-04-13 12:22:59'),
(23, '5', 8, 'kosong', '2024-03-17 12:42:49', '2024-04-13 12:22:58'),
(24, '6', 8, 'kosong', '2024-03-17 12:42:49', '2024-04-13 12:23:00'),
(25, '1', 9, 'kosong', '2024-03-17 12:47:28', NULL),
(26, '1', 10, 'terisi', '2024-04-26 08:55:44', '2024-04-26 14:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id_pelayanan` int(11) NOT NULL,
  `nama_pelayanan` varchar(255) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `kode_antrian` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `nama_pelayanan`, `id_bidang`, `kode_antrian`) VALUES
(1, 'Pemberian Tunjangan Profesi Guru', 8, 'A'),
(2, 'Penerbitan SK Pengganti Ijazah /STTB/SKHU Jenjang SD', 5, 'A'),
(3, 'Penerbitan SK Pengganti Ijazah /STTB/SKHU Jenjang SMP', 6, 'A'),
(4, 'Surat Keluar', 2, 'A'),
(5, 'Surat Masuk', 2, 'B'),
(6, 'Data Pokok Pendidikan (DAPOPDIK)', 3, 'A'),
(7, 'Pengurusan KARSI/KARSU/KARPEG', 8, 'B'),
(8, 'Izin Pendirian Sekolah PUAD Dan Nonformal swasta', 7, 'A'),
(9, 'Izin Pendirian Sekolah Dasar Swasta', 5, 'B'),
(10, 'Izin Pendirian Sekolah menengah Pertama Swasta', 6, 'B'),
(11, 'Rekomendasi Pentas Seni', 9, 'A'),
(12, 'Pengajuan NUPTK Guru PAUD, TJ, SD DAN SMP PNS Dan Non PNS', 8, 'C'),
(13, 'Usulan Cuti PNS', 8, 'D'),
(14, 'Legalisir Ijazah', 2, 'C'),
(15, 'Usul Pensiun Jabatan Fungsional Guru', 8, 'E'),
(16, 'Usul Kenaikan Pangkat Jabatan Fungsional Guru', 8, 'F'),
(17, 'Usul Kenaikan Gaji Berkala Jabatan Fungsional Guru', 4, 'A'),
(18, 'Penerbitan SK Perubahan Rekening BOS', 7, 'B'),
(19, 'Penerbitan SK Perubahan Rekening BOS Jenjang SD', 5, 'C'),
(20, 'Penerbitan SK Perubahan Rekening BOS Jenjang SMP', 6, 'C'),
(21, 'Pemberian Kompensasi Kepada Pengguna Jasa Layanan', 2, 'D'),
(22, 'Pengaduan Pelayanan Publik', 2, 'E'),
(23, 'Pemberkasan Tunjangan Profesi Guru', 4, 'B'),
(24, 'Pelayanan BOS SMA', 10, 'A'),
(25, 'Mutasi Siswa Dasar', 5, 'D'),
(26, 'Mutasi Siswa Menengah Pertama ', 6, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(11) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `nama_instansi`, `alamat`) VALUES
(1, 'DISDIKBUD KAB. PAMEKASAN', 'Jl. Dirgahayu, Tengah, Nyalabu Laok, Kec. Pamekasan, Kabupaten Pamekasan, Jawa Timur 69317');

-- --------------------------------------------------------

--
-- Table structure for table `survei`
--

CREATE TABLE `survei` (
  `id_survei` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `tgl_survei` date NOT NULL,
  `survei_interaksi` varchar(20) NOT NULL,
  `survei_cepat` varchar(20) NOT NULL,
  `survei_tepat` varchar(20) NOT NULL,
  `survei_masalah` varchar(20) NOT NULL,
  `survei_kesalahan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survei`
--

INSERT INTO `survei` (`id_survei`, `id_bidang`, `tgl_survei`, `survei_interaksi`, `survei_cepat`, `survei_tepat`, `survei_masalah`, `survei_kesalahan`) VALUES
(16, 8, '2023-01-09', 'Sangat Puas', 'Sangat Puas', 'Sangat Puas', 'Sangat Puas', 'Sangat Puas'),
(17, 8, '2024-01-22', 'Puas', 'Tidak Puas', 'Puas', 'Sangat Tidak Puas', 'Puas'),
(22, 8, '2024-01-29', 'Netral', 'Netral', 'Tidak Puas', 'Netral', 'Tidak Puas'),
(23, 8, '2024-01-29', 'Netral', 'Netral', 'Sangat Puas', 'Netral', 'Netral'),
(24, 8, '2024-01-29', 'Puas', 'Netral', 'Netral', 'Netral', 'Netral'),
(32, 8, '2024-02-05', 'Netral', 'Netral', 'Netral', 'Netral', 'Netral'),
(33, 8, '2024-02-05', 'Tidak Puas', 'Netral', 'Netral', 'Netral', 'Netral'),
(34, 3, '2024-03-06', 'Netral', 'Tidak Puas', 'Tidak Puas', 'Tidak Puas', 'Tidak Puas'),
(35, 8, '2024-03-06', 'Netral', 'Netral', 'Tidak Puas', 'Tidak Puas', 'Netral'),
(81, 8, '2024-04-06', 'Sangat Puas', 'Sangat Puas', 'Sangat Puas', 'Sangat Puas', 'Sangat Puas'),
(82, 8, '2024-04-06', 'Puas', 'Puas', 'Puas', 'Puas', 'Puas'),
(83, 8, '2024-04-06', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas', 'Netral'),
(84, 8, '2024-04-06', 'Sangat Puas', 'Puas', 'Tidak Puas', 'Sangat Tidak Puas', 'Netral'),
(86, 5, '2024-04-23', 'Netral', 'Netral', 'Puas', 'Sangat Puas', 'Sangat Puas'),
(87, 5, '2024-04-23', 'Sangat Tidak Puas', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas'),
(88, 5, '2024-04-23', 'Sangat Puas', 'Puas', 'Netral', 'Tidak Puas', 'Sangat Tidak Puas'),
(89, 5, '2024-04-23', 'Tidak Puas', 'Netral', 'Sangat Puas', 'Puas', 'Netral'),
(90, 10, '2024-04-26', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas', 'Puas'),
(91, 5, '2024-04-29', 'Sangat Tidak Puas', 'Tidak Puas', 'Netral', 'Puas', 'Sangat Puas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nik` char(16) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `id_pelayanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat`, `nik`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `id_pelayanan`) VALUES
(52, 'Siti Nur Aini', 'BOJONEGORO', '123456789098765', 'Bojonegoro', '2002-02-08', 'Perempuan', 15),
(53, 'Aini', 'Surabaya', '0000000000000000', 'BJN', '2010-02-12', 'Perempuan', 7),
(54, 'Ainda Putri', 'Lamongan', '11111111111', 'Pamekasan', '2012-12-12', 'Perempuan', 7),
(55, 'aini', 'df', '12', 'gfd', '2000-11-11', 'Perempuan', 8),
(56, 'dgd', 'bjn', '24', 'df', '2000-11-11', 'Perempuan', 5),
(57, 'ghhg', 'Lamongan', '5676666666666666', 'Bojonegoro', '2024-02-27', 'Perempuan', 6),
(58, 'Siti Nur Aini', 'BOJONEGORO', '1234567890987654', 'Bojonegoro', '2024-03-06', 'Perempuan', 2),
(59, 'Aini', 'bjnn', '123456778', 'Bojonegoro', '2024-03-14', 'Perempuan', 2),
(60, 'Zalza', 'bjnn', '123456789', 'Bojonegoro', '2024-03-06', 'Perempuan', 2),
(61, 'Zalza', 'Bojonegoro2', '123456788', 'dfsd', '2024-03-06', 'Laki-laki', 2),
(62, 'Ainda Putri', 'Bojonegoro2', '123456788', 'dfsd', '2024-03-06', 'Perempuan', 2),
(63, 'Hesti', 'Surabaya', '1234567890', 'Bojonegoro', '2024-02-26', 'Perempuan', 2),
(64, 'Hesti', 'Surabaya', '1234567890', 'Bojonegoro', '2024-02-26', 'Perempuan', 13),
(65, 'Hesti', 'Lamongan', '1234567890', 'Bojonegoro', '2024-03-05', 'Perempuan', 13),
(66, '666666', '6666666666666666', '6666666666666666', '666666666666', '0000-00-00', 'Perempuan', 13),
(67, 'Siti Nur Aini', 'Pamekasan', '88', 'Bojonegoro', '2024-03-17', 'Perempuan', 1),
(68, 'Siti Nur Aini', 'Pamekasan', '12345', 'Bojonegoro', '2024-03-17', 'Perempuan', 4),
(69, 'Aini', 's', '1', 'f', '2024-03-17', 'Laki-laki', 5),
(70, 'Aini', 'd', '1', 'bjn', '2024-03-05', 'Laki-laki', 5),
(71, 'Aini', 'Pamekasan', '7', 'Bojonegoro', '2024-03-11', 'Perempuan', 5),
(72, 'Siti Nur Aini', 'h', '3', 'h', '2024-03-12', 'Perempuan', 5),
(73, 'Siti Nur Aini', 'BOJONEGORO', '3', 'f', '2024-03-18', 'Perempuan', 12),
(74, 'Siti Nur Aini', 'd', '2', 'd', '2024-03-18', 'Perempuan', 26),
(75, 'f', 'd', '3', 'f', '2024-03-18', 'Perempuan', 14),
(76, 'hd', 'd', '23', 'd', '2024-03-18', 'Perempuan', 5),
(77, 'fjk', 'fe', '23', 'id', '2024-03-19', 'Laki-laki', 6),
(78, 'fjk', 'fe', '23', 'id', '2024-03-19', 'Laki-laki', 14),
(79, 'aini', 'fe', '23', 'iddsgf', '2024-03-19', 'Laki-laki', 14),
(80, 'kdf', 'bjn', '54521', 'fjg', '2024-03-20', 'Perempuan', 11),
(81, 'kdf', 'bjn', '54521', 'fjg', '2024-03-20', 'Perempuan', 12),
(82, 'aini ainda', 'jl. menuju surga', '945734', 'bjn', '2024-03-20', 'Perempuan', 2),
(83, 'AINI', 'JL SEJAHTERA', '459', 'DK', '2024-03-22', 'Laki-laki', 11),
(84, 'andre', 'df', '232', 'hg', '2024-03-22', 'Perempuan', 18),
(85, 'Siti Nur Aini', 'Lamongan', '1234567899', 'Bojonegoro', '2024-03-22', 'Perempuan', 3),
(86, 'flkg', 'bjn', '38', 'fgk', '2024-03-24', 'Perempuan', 2),
(87, 'flkg', 'bjn', '38', 'fgk', '2024-03-24', 'Perempuan', 9),
(88, 'glks', 'Bojonegoro', '18932', 'Bojonegoro', '2024-03-30', 'Perempuan', 19),
(89, 'sgkl', 'r', '4985', 'g', '2024-03-30', 'Laki-laki', 19),
(90, 'gl', 'bjn', '452', 'dk', '2024-03-31', 'Perempuan', 25),
(91, 'Siti Nur Aini', 'Pamekasan', '1234567890123456', 'Bojonegoro', '2002-08-23', 'Perempuan', 1),
(92, 'Siti Nur Aini', 'Pamekasan', '1234567890123456', 'Bojonegoro', '2002-08-23', 'Perempuan', 7),
(93, 'Siti Nur Aini', 'Pamekasan', '1234567890123456', 'Bojonegoro', '2002-08-23', 'Perempuan', 12),
(94, 'Siti Nur Aini', 'Pamekasan', '1234567890123456', 'Bojonegoro', '2002-08-23', 'Perempuan', 13),
(95, 'Siti Nur Aini', 'Pamekasan', '1234567890123456', 'Bojonegoro', '2002-08-23', 'Perempuan', 15),
(96, 'Siti Nur Aini', 'Pamekasan', '1234567890123456', 'Bojonegoro', '2002-08-23', 'Perempuan', 16),
(97, 'Siti Nur Aini', 'Pamekasan', '1234567890123456', 'Bojonegoro', '2002-08-23', 'Perempuan', 7),
(98, 'Ainda Putri', 'Surabaya', '4597', 'Bojonegoro', '2024-04-06', 'Perempuan', 12),
(99, 'Siti Nur Aini', 'Pamekasan', '0527', 'Bojonegoro', '2024-04-13', 'Perempuan', 12),
(100, 'Zalza', 'Bojonegoro2', '23', 'd', '2024-04-13', 'Laki-laki', 12),
(101, 'Siti Nur Aini', 'Bojonegoro2', '324', 'Bojonegoro', '2024-04-13', 'Perempuan', 12),
(102, 'Maufiroh', 'jl. merpati No. 5', '123456789023456', 'Pamekasan', '2003-03-10', 'Perempuan', 19),
(103, 'Siti Nur Aini', 'Pamekasan', '12336677882', 'Pamekasan', '2002-08-23', 'Perempuan', 9),
(104, 'Diandra', 'Jl. Untung Suropati', '098754', 'Pamekasan', '2000-11-29', 'Perempuan', 2),
(105, 'aini', 'JL SEJAHTERA', '123456678', 'pamekasan', '2024-04-26', 'Perempuan', 14),
(106, 'aini', 'JL SEJAHTERA', '123456678', 'pamekasan', '2024-04-26', 'Perempuan', 24),
(107, 'Siti Nur Aini', 'Pamekasan', '1234567', 'Bojonegoro', '2004-01-12', 'Perempuan', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_loket`
-- (See below for the actual view)
--
CREATE TABLE `v_loket` (
`id_loket` int(11)
,`nama_loket` varchar(255)
,`nama_bidang` varchar(100)
,`status` enum('kosong','terisi')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pelayanan_bidang`
-- (See below for the actual view)
--
CREATE TABLE `v_pelayanan_bidang` (
`id_pelayanan` int(11)
,`nama_pelayanan` varchar(255)
,`nama_bidang` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_survei`
-- (See below for the actual view)
--
CREATE TABLE `v_survei` (
`id_survei` int(11)
,`tgl_survei` date
,`survei_interaksi` varchar(20)
,`survei_cepat` varchar(20)
,`survei_tepat` varchar(20)
,`survei_masalah` varchar(20)
,`survei_kesalahan` varchar(20)
,`nama_bidang` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_totalloket`
-- (See below for the actual view)
--
CREATE TABLE `v_totalloket` (
`id_bidang` int(11)
,`jumlah_loket` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `v_loket`
--
DROP TABLE IF EXISTS `v_loket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_loket`  AS SELECT `loket`.`id_loket` AS `id_loket`, `loket`.`nama_loket` AS `nama_loket`, `bidang`.`nama_bidang` AS `nama_bidang`, `loket`.`status` AS `status` FROM (`loket` join `bidang` on(`loket`.`id_bidang` = `bidang`.`id_bidang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pelayanan_bidang`
--
DROP TABLE IF EXISTS `v_pelayanan_bidang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pelayanan_bidang`  AS SELECT `pelayanan`.`id_pelayanan` AS `id_pelayanan`, `pelayanan`.`nama_pelayanan` AS `nama_pelayanan`, `bidang`.`nama_bidang` AS `nama_bidang` FROM (`pelayanan` join `bidang` on(`pelayanan`.`id_bidang` = `bidang`.`id_bidang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_survei`
--
DROP TABLE IF EXISTS `v_survei`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_survei`  AS SELECT `survei`.`id_survei` AS `id_survei`, `survei`.`tgl_survei` AS `tgl_survei`, `survei`.`survei_interaksi` AS `survei_interaksi`, `survei`.`survei_cepat` AS `survei_cepat`, `survei`.`survei_tepat` AS `survei_tepat`, `survei`.`survei_masalah` AS `survei_masalah`, `survei`.`survei_kesalahan` AS `survei_kesalahan`, `bidang`.`nama_bidang` AS `nama_bidang` FROM (`survei` join `bidang` on(`survei`.`id_bidang` = `bidang`.`id_bidang`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_totalloket`
--
DROP TABLE IF EXISTS `v_totalloket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_totalloket`  AS SELECT `loket`.`id_bidang` AS `id_bidang`, count(`loket`.`nama_loket`) AS `jumlah_loket` FROM `loket` GROUP BY `loket`.`id_bidang` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_bidang` (`id_bidang`),
  ADD KEY `id_pelayanan` (`id_pelayanan`,`id_loket`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`),
  ADD KEY `id_profil` (`id_profil`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `id_bidang` (`id_bidang`),
  ADD KEY `id_profil` (`id_profil`),
  ADD KEY `id_pelayanan` (`id_bidang`);

--
-- Indexes for table `loket`
--
ALTER TABLE `loket`
  ADD PRIMARY KEY (`id_loket`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id_pelayanan`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `survei`
--
ALTER TABLE `survei`
  ADD PRIMARY KEY (`id_survei`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_pelayanan` (`id_pelayanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=479;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `loket`
--
ALTER TABLE `loket`
  MODIFY `id_loket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id_pelayanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survei`
--
ALTER TABLE `survei`
  MODIFY `id_survei` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `bidang`
--
ALTER TABLE `bidang`
  ADD CONSTRAINT `bidang_ibfk_1` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id_profil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`id_profil`) REFERENCES `profil` (`id_profil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `loket`
--
ALTER TABLE `loket`
  ADD CONSTRAINT `loket_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`);

--
-- Constraints for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD CONSTRAINT `pelayanan_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_pelayanan`) REFERENCES `pelayanan` (`id_pelayanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
