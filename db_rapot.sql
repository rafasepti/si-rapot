-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2024 at 07:02 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rapot`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_nilai`
--

CREATE TABLE `detail_nilai` (
  `id` bigint UNSIGNED NOT NULL,
  `id_nilai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mapel` int NOT NULL,
  `nilai_rl` float NOT NULL,
  `nilai_tp` float NOT NULL,
  `nilai_as` float NOT NULL,
  `nilai_akhir` float NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `k_izin` int NOT NULL DEFAULT '0',
  `k_sakit` int NOT NULL DEFAULT '0',
  `k_tanpa_ket` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ekskul`
--

CREATE TABLE `ekskul` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` int NOT NULL,
  `nama_ekskul` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekskul`
--

INSERT INTO `ekskul` (`id`, `id_guru`, `nama_ekskul`, `created_at`, `updated_at`) VALUES
(1, 11, 'Bulu Tangkis', NULL, NULL),
(2, 22, 'Sepak Bola', NULL, NULL),
(3, 21, 'Basket', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_guru` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nuptk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mapel` int DEFAULT NULL,
  `walikelas` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak',
  `nama_guru` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_guru` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `kode_guru`, `nuptk`, `id_mapel`, `walikelas`, `nama_guru`, `email`, `password`, `jabatan`, `alamat_guru`, `no_telp`, `created_at`, `updated_at`) VALUES
(9, 'G000001', '00000000001', NULL, 'Tidak', 'Admin 1', 'admin@gmail.com', '$2y$12$wyWIPtANceLFBZoS3eI3r.WNW.6f40fAMii47b7h.WLajCWKH2ET.', 'Admin', 'Cimahi', '089654768746', NULL, NULL),
(10, 'G000002', '00000000002', NULL, 'Tidak', 'Admin 2', 'admin2@gmail.com', '$2y$12$Wh5//KHfBNRRoWOysGHGjucZdALq1umoZyM2GHkPAV9epWM5QJY5G', 'Admin', 'Cimahi', '089654768746', NULL, NULL),
(11, 'G000003', '101827534525', NULL, 'Ya', 'Asni Wati', 'asniw@gmail.com', '$2y$12$SaxoLqVuVifJr8gVmt7Fs.tjfXXlT917VB476DEJ5Nx8oexZ2ljJ.', 'Guru', 'Cimahi', '089654768746', NULL, NULL),
(12, 'G000004', '101929288373', NULL, 'Ya', 'Ita Syani', 'ita@gmail.com', '$2y$12$XHk2Py3zESiHXs7eMWPtZOJyIybRhhX5A9M/JsK2OEev6NHH0jSee', 'Guru', 'Cimahi', '085654768746', NULL, NULL),
(13, 'G000005', '10198263562', NULL, 'Ya', 'Zikri Azzuri', 'zikri@gmail.com', '$2y$12$Wh5//KHfBNRRoWOysGHGjucZdALq1umoZyM2GHkPAV9epWM5QJY5G', 'Guru', 'Cimahi', '089654768746', NULL, NULL),
(14, 'G000006', '111092728255', NULL, 'Tidak', 'Rizkii Fadillah', 'kepsek@gmail.com', '$2y$12$ikf.zTe5CF8U7GnXVK88ROFafpOLBvBR8c6nqJoORbYQn8.Zzu9oi', 'Kepala Sekolah', 'Cimahii', '089654768735', NULL, NULL),
(19, 'G000007', '0273788299282', NULL, 'Tidak', 'Yusuf', 'yusuf@gmail.com', '$2y$12$Wh5//KHfBNRRoWOysGHGjucZdALq1umoZyM2GHkPAV9epWM5QJY5G', 'Guru', 'Jayapura', '089654768746', NULL, NULL),
(20, 'G000008', '272999202082', NULL, 'Tidak', 'Meliana', 'meli@gmail.com', '$2y$12$Wh5//KHfBNRRoWOysGHGjucZdALq1umoZyM2GHkPAV9epWM5QJY5G', 'Guru', 'Cimahi', '089654768746', NULL, NULL),
(21, 'G000009', '91872662782', NULL, 'Tidak', 'Fitri', 'fitri@gmail.com', '$2y$12$Wh5//KHfBNRRoWOysGHGjucZdALq1umoZyM2GHkPAV9epWM5QJY5G', 'Guru', 'Jayapura', '089654768746', NULL, NULL),
(22, 'G000010', '81900182892', NULL, 'Tidak', 'Deris', 'deris@gmail.com', '$2y$12$Wh5//KHfBNRRoWOysGHGjucZdALq1umoZyM2GHkPAV9epWM5QJY5G', 'Guru', 'Cimahi', '089654768746', NULL, NULL),
(23, 'G000011', '077996578646', NULL, 'Tidak', 'Rhenni', 'rhenni@gmail.com', '$2y$12$IsZz4Rn9T9QH3aroXbCi2./7ZkS3dPvj8UmVPIdrOYxVt5c9Vpxpm', 'Guru', 'Cimahi', '089654768746', NULL, NULL),
(24, 'G000012', '37330038743883', NULL, 'Ya', 'Senia', 'senia@gmail.com', '$2y$12$QZZ7iuDrC1HzsMix/eyfuur2HHKrjcme9rHibWc9S1NmOvFhvIRQC', 'Guru', 'Cimahi', '089654768746', NULL, NULL),
(25, 'G000013', '739477758484', NULL, 'Ya', 'Dendi', 'dendi@gmail.com', '$2y$12$pSF7VbyJxxva2G4oFXlbI.gKfPTrVmXah.J9ATLl/vCWo9TWK2FWS', 'Guru', 'Cimahi', '08123456789', NULL, NULL),
(34, 'G000014', '0366453627836', NULL, 'Tidak', 'Heriana', 'heri@gmail.com', '$2y$12$jgUUIwSrfUeDqGQodU7c3.vYvw9CLYAdMXXaJArbEgVl0MkdMiXKi', 'Guru', 'CImahi', '089654768746', NULL, NULL),
(35, 'G000015', '000643567765', NULL, 'Tidak', 'Syania', 'syania@gmail.com', '$2y$12$Xp1ghOh2EQwSIuGxp79sce/qhSZf8Aqbr533X7RbosDKQNblVYjV.', 'Guru', 'Cimahi', '089654768746', NULL, NULL),
(37, 'G000016', '033493939744', NULL, 'Tidak', 'Rafa Septiani', 'rafa@gmail.com', '$2y$12$wyWIPtANceLFBZoS3eI3r.WNW.6f40fAMii47b7h.WLajCWKH2ET.', 'Guru', 'Cimahi', '089654768746', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_gm` int NOT NULL,
  `id_kelas` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru_kelas`
--

INSERT INTO `guru_kelas` (`id`, `id_gm`, `id_kelas`, `created_at`, `updated_at`) VALUES
(1, 11, 4, '2024-03-19 06:33:08', '2024-03-19 06:33:08'),
(2, 12, 4, '2024-03-19 06:33:08', '2024-03-19 06:33:08'),
(3, 13, 4, '2024-03-19 06:33:08', '2024-03-19 06:33:08'),
(4, 14, 4, '2024-03-19 06:33:08', '2024-03-19 06:33:08'),
(13, 11, 5, '2024-03-20 01:14:14', '2024-03-20 01:14:14'),
(14, 12, 5, '2024-03-20 01:14:14', '2024-03-20 01:14:14'),
(15, 13, 5, '2024-03-20 01:14:14', '2024-03-20 01:14:14'),
(16, 14, 5, '2024-03-20 01:14:14', '2024-03-20 01:14:14'),
(17, 11, 7, '2024-03-20 01:26:04', '2024-03-20 01:26:04'),
(18, 12, 7, '2024-03-20 01:26:04', '2024-03-20 01:26:04'),
(19, 13, 7, '2024-03-20 01:26:04', '2024-03-20 01:26:04'),
(20, 14, 7, '2024-03-20 01:26:04', '2024-03-20 01:26:04'),
(29, 23, 10, '2024-03-25 20:26:50', '2024-03-25 20:26:50'),
(30, 12, 10, '2024-03-25 20:26:50', '2024-03-25 20:26:50'),
(31, 13, 10, '2024-03-25 20:26:50', '2024-03-25 20:26:50'),
(32, 15, 10, '2024-03-25 20:26:50', '2024-03-25 20:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `guru_mapel`
--

CREATE TABLE `guru_mapel` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mapel` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru_mapel`
--

INSERT INTO `guru_mapel` (`id`, `id_guru`, `id_mapel`, `created_at`, `updated_at`) VALUES
(11, 'G000009', 2, '2024-03-19 02:50:35', '2024-03-19 02:50:35'),
(12, 'G000008', 7, '2024-03-19 02:57:15', '2024-03-19 02:57:15'),
(13, 'G000007', 8, '2024-03-19 02:58:01', '2024-03-19 02:58:01'),
(14, 'G000010', 13, '2024-03-19 05:57:04', '2024-03-19 05:57:04'),
(15, 'G000011', 13, '2024-03-19 19:29:28', '2024-03-19 19:29:28'),
(23, 'G000014', 2, '2024-03-25 20:26:16', '2024-03-25 20:26:16'),
(24, 'G000015', 13, '2024-03-25 22:44:48', '2024-03-25 22:44:48'),
(27, 'G000016', 7, '2024-03-26 23:57:21', '2024-03-26 23:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_walikelas` int NOT NULL,
  `kelas` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `id_walikelas`, `kelas`, `tingkat`, `created_at`, `updated_at`) VALUES
(4, 11, 'A', 1, NULL, NULL),
(5, 12, 'B', 1, NULL, NULL),
(7, 13, 'C', 1, NULL, NULL),
(10, 24, 'A', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_mapel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` int NOT NULL,
  `kkm` int NOT NULL,
  `ruang_lingkup` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan_pembelajaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `nama_mapel`, `kategori`, `kkm`, `ruang_lingkup`, `tujuan_pembelajaran`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Indonesia', 1, 75, 'Pengucapan dan Fonologi: Pembelajaran pengucapan yang benar dari konsonan, vokal, dan suku kata dalam Bahasa Indonesia, serta penekanan kata dan intonasi dalam kalimat.', 'Pemahaman Budaya: Pembelajaran Bahasa Indonesia juga bertujuan untuk memperkenalkan dan memahamkan pembelajar tentang budaya Indonesia yang kaya dan beragam. Ini mencakup pemahaman tentang tradisi, adat istiadat, nilai-nilai, dan norma-norma sosial yang tercermin dalam bahasa dan kehidupan sehari-hari masyarakat Indonesia.', NULL, NULL),
(2, 'Bahasa Daerah', 2, 75, 'Mengenalkan abjad atau alfabet yang digunakan dalam bahasa daerah, serta pengenalan bunyi-bunyi dasar yang terdapat dalam bahasa tersebut.', 'Membantu siswa memahami bahasa daerah mereka sendiri dengan lebih baik dan mengapresiasi kekayaan budaya dan warisan bahasa daerah.', NULL, NULL),
(3, 'Matematika', 1, 70, 'Menghitung, Mengurang, Mengkali, Membagi angka', 'Menghitung, Mengurang, Mengkali, Membagi angka', NULL, NULL),
(7, 'Agama', 2, 70, 'Konsep dasar tentang Islam, keyakinan, dan praktek dasar seperti keimanan kepada Allah, Muhammad sebagai nabi terakhir, dan pentingnya shalat.\r\n\r\nBudaya dan Nilai-nilai: Pendidikan nilai-nilai moral dalam Islam seperti kejujuran, kasih sayang, kerendahan hati, dan saling menghormati.', 'Salah satu tujuan utama pengajaran agama Islam adalah membantu siswa memperkuat keimanan dan ketaatan mereka kepada Allah SWT. Ini mencakup pemahaman tentang konsep-konsep dasar dalam Islam seperti iman kepada Allah, Rasul-Nya, kitab-kitab-Nya, malaikat-malaikat-Nya, hari kiamat, dan takdir.', NULL, NULL),
(8, 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 2, 70, 'Melatih keterampilan dasar seperti berlari, melompat, melempar, menangkap, dan berjalan dengan keseimbangan.', 'Tujuan utama adalah untuk membantu siswa mengembangkan keterampilan motorik kasar yang diperlukan untuk berpartisipasi dalam berbagai aktivitas fisik.', NULL, NULL),
(9, 'Pendidikan Kewarganegaraan', 1, 72, 'Memahami nilai-nilai dasar Pancasila sebagai dasar negara Indonesia, yang meliputi Ketuhanan Yang Maha Esa, Kemanusiaan yang Adil dan Beradab, Persatuan Indonesia, Kerakyatan yang Dipimpin oleh Hikmah Kebijaksanaan dalam Permusyawaratan/Perwakilan, dan Keadilan Sosial bagi Seluruh Rakyat Indonesia.', 'membantu siswa memahami dan menginternalisasi nilai-nilai Pancasila dan kekayaan budaya Indonesia sebagai bagian dari identitas dan karakter sebagai warga negara Indonesia.', NULL, NULL),
(10, 'Ilmu Pengetahuan Alam', 1, 72, '-', '-', NULL, NULL),
(11, 'Ilmu Pengetahuan Sosial', 1, 72, '-', '-', NULL, NULL),
(12, 'Seni Budaya dan Keterampilan', 1, 72, '-', '-', NULL, NULL),
(13, 'Bahasa Inggris', 2, 70, '-', '-', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_12_075204_create_siswas_table', 1),
(6, '2024_03_12_080339_create_walis_table', 1),
(7, '2024_03_12_080728_create_kelas_table', 1),
(8, '2024_03_12_082013_create_mapels_table', 1),
(9, '2024_03_12_082331_create_gurus_table', 1),
(10, '2024_03_12_090434_create_nilais_table', 1),
(11, '2024_03_12_091021_detail_nilai', 1),
(12, '2024_03_17_014817_create_tahun_ajarans_table', 2),
(13, '2024_03_18_024305_create_guru_mapels_table', 3),
(14, '2024_03_19_010454_create_guru_kelas_table', 4),
(15, '2024_03_24_070800_create_ekskuls_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_nilai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_siswa` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_ekskul` int DEFAULT NULL,
  `semester` int NOT NULL,
  `id_thn_ajaran` int NOT NULL,
  `kehadiran_izin` int DEFAULT NULL,
  `kehadiran_sakit` int DEFAULT NULL,
  `kehadiran_tanpa_ket` int DEFAULT NULL,
  `tgl_penilaian` date DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `nilai_eks` int DEFAULT NULL,
  `ket_eks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `naik_kelas` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `kode_siswa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` bigint UNSIGNED NOT NULL,
  `nisn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int NOT NULL,
  `id_ekskul` int NOT NULL,
  `nama_siswa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan_sebelum` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_siswa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thn_angkatan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`kode_siswa`, `id`, `nisn`, `id_kelas`, `id_ekskul`, `nama_siswa`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `pendidikan_sebelum`, `alamat_siswa`, `thn_angkatan`, `created_at`, `updated_at`) VALUES
('S000001', 34, '001427829735', 4, 1, 'Intan Permata', 'Bandung', '2012-07-20', 'Perempuan', 'Islam', 'TK', 'Cimahi', 2020, NULL, NULL),
('S000002', 35, '00152882663', 4, 2, 'Bagas Satria', 'Bogor', '2017-03-20', 'Laki-Laki', 'Kristen Katolik', 'TK', 'Cimahi', 2020, NULL, NULL),
('S000003', 36, '0012345678', 5, 2, 'Ahmad', 'Jakarta', '2005-01-10', 'Laki-Laki', 'Kristen Protestan', 'TK', 'Cimahi', 2018, NULL, NULL),
('S000004', 37, '0012345682', 5, 1, 'Eka', 'Medan', '2005-04-25', 'Perempuan', 'Kristen Katolik', 'Paud', 'Cimahi', 2018, NULL, NULL),
('S000005', 39, '004286366363', 4, 1, 'Rafa', 'Bandung', '2001-08-21', 'Perempuan', 'Islam', 'TK', 'Cimahi', 2020, NULL, NULL),
('S000006', 40, '00738464848847', 5, 3, 'Putri', 'Bogor', '2014-07-20', 'Perempuan', 'Islam', 'TK', 'Cimahi', 2020, NULL, NULL),
('S000007', 42, '0014983847398', 7, 1, 'Ita', 'Bandung', '2017-07-21', 'Perempuan', 'Kristen Katolik', 'TK', 'Cimahi', 2022, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_tahun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak',
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `nama_tahun`, `aktif`, `mulai`, `selesai`, `created_at`, `updated_at`) VALUES
(3, '2022/2023', 'tidak', '2022-07-19', '2023-07-19', NULL, NULL),
(4, '2023/2024', 'Ya', '2023-04-20', '2024-04-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hak_akses` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_guru` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wali`
--

CREATE TABLE `wali` (
  `id` bigint UNSIGNED NOT NULL,
  `id_siswa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_wali` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_wali` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_wali` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sebagai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wali`
--

INSERT INTO `wali` (`id`, `id_siswa`, `nama_wali`, `pekerjaan_wali`, `alamat_wali`, `no_telp`, `sebagai`, `created_at`, `updated_at`) VALUES
(6, 'S000001', 'Arya Sunan', 'PNS', 'Cimahi', '089654768746', 'Ayah', NULL, NULL),
(7, 'S000002', 'Desti', 'PNS', 'Cimahi', '08123456789', 'Ibu', NULL, NULL),
(8, 'S000003', 'Dian', 'Pegawai Negeri Non-PNS', 'Cimahi', '08123456789', 'Ibu', NULL, NULL),
(9, 'S000004', 'Ahmad', 'PNS', 'Bandung', '08123456789', 'Ayah', NULL, NULL),
(11, 'S000005', 'Desti', 'IRT', 'Ciamhi', '08123456789', 'Ibu', NULL, NULL),
(12, 'S000006', 'Arya Sunan', 'PNS', 'Bandung Barat', '08123456789', 'Wali', NULL, NULL),
(14, 'S000007', 'Arya Sunan', 'PNS', 'Cimahi', '089654768746', 'Wali', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nilai` (`id_nilai`,`id_mapel`);

--
-- Indexes for table `ekskul`
--
ALTER TABLE `ekskul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_guru` (`kode_guru`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`,`id_mapel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_walikelas` (`id_walikelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_nilai` (`kode_nilai`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_thn_ajaran` (`id_thn_ajaran`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_ekskul` (`id_ekskul`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_siswa` (`kode_siswa`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_ekskul` (`id_ekskul`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indexes for table `wali`
--
ALTER TABLE `wali`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `ekskul`
--
ALTER TABLE `ekskul`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wali`
--
ALTER TABLE `wali`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
