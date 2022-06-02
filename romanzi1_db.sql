-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2022 at 03:02 PM
-- Server version: 10.3.34-MariaDB-log-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `romanzi1_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `hak_akses` varchar(200) NOT NULL,
  `nama_admin` varchar(200) DEFAULT NULL,
  `nip_pegawai` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `hak_akses`, `nama_admin`, `nip_pegawai`) VALUES
(1, 'surat_tugas', 'Surat Tugas', '198702092010121002,199008122019011001,199912292022011007,90860319020997,198402022009112001'),
(2, 'kepegawaian', 'Kepegawaian', '198702092010121002,199502232022022002,198402022009112001'),
(3, 'perbaikan', 'Perbaikan', '197812242002121002,198402022009112001'),
(4, 'ruang_rapat', 'Ruang Rapat', NULL),
(5, 'kendi', 'Kendaraan Dinas', NULL),
(7, 'perka', 'Peralatan Kantor', NULL),
(8, 'sekretariat', 'Sekretariat', NULL),
(9, 'efiles', 'E-Files', '198702092010121002,199502232022022002'),
(10, 'pengadaan', 'Pengadaan', '198710112010121001,198402022009112001');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_pengadaan`
--

CREATE TABLE `bahan_pengadaan` (
  `id` int(255) NOT NULL,
  `nbahan` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nip_petugas` varchar(255) NOT NULL,
  `seri_pengadaan` varchar(255) NOT NULL,
  `penerimaan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `verifikasi_selesai` varchar(255) DEFAULT NULL,
  `waktu_diterima` varchar(255) DEFAULT NULL,
  `waktu_selesai` varchar(255) DEFAULT NULL,
  `hasil` varchar(255) NOT NULL,
  `waktu_hasil` varchar(255) NOT NULL,
  `deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan_pengadaan`
--

INSERT INTO `bahan_pengadaan` (`id`, `nbahan`, `jumlah`, `keterangan`, `nip_petugas`, `seri_pengadaan`, `penerimaan`, `catatan`, `verifikasi_selesai`, `waktu_diterima`, `waktu_selesai`, `hasil`, `waktu_hasil`, `deadline`) VALUES
(14, 'Label  Arsip untuk Folder , Box Arsip', '10', 'Label Kecil untuk Kuping Folder Label Besar untuk Boks Arsip Inaktif, dan juga sebagai indeks /judul Folder dan penomoran Folder dan Identitas Box Arsip inaktif', '196907211990031004', '621O-D96F-088L-ZJ90-6VF8 ', '', '', NULL, NULL, NULL, '', '', '2022-06-03'),
(15, 'Tikar', '2 Unit', 'Rusak', '198710112010121001', '9ZLM-OW28-A37H-OBRW-52UT ', 'Tugas diterima', 'selesai', 'Pengadaan selesai', '2022-05-30 09:47', '2022-05-30 09:52', 'Hasil diterima', '2022-05-30 09:52', '2022-06-10'),
(16, 'Komputer', '5 Unit', 'Kekurangan ', '198710112010121001', '9ZLM-OW28-A37H-OBRW-52UT ', 'Tugas diterima', 'selesai', 'Pengadaan selesai', '2022-05-30 09:47', '2022-05-30 09:52', 'Hasil diterima', '2022-05-30 09:52', '2022-06-10'),
(17, 'Bulpoint', '3', 'Kehabisan', '198710112010121001', '2C73-41O8-6DBB-625F-078Y ', 'Tugas diterima', 'selesai', 'Pengadaan selesai', '2022-05-30 09:48', '2022-05-30 09:51', 'Hasil diterima', '2022-05-30 09:53', '2022-06-03'),
(18, 'Tissu', '8 Pieces', 'Habis', '198710112010121001', '2C73-41O8-6DBB-625F-078Y ', 'Tugas diterima', 'selesai', 'Pengadaan selesai', '2022-05-30 09:51', '2022-05-30 09:51', 'Hasil diterima', '2022-05-30 09:53', '2022-06-03'),
(19, 'Lap Microfiber', '10 pcs', 'Untuk membersihkan ruangan', '', '84T8-74BH-SB72-Z9Z5-8VBX ', '', '', NULL, NULL, NULL, '', '', NULL),
(20, 'Kantong Sampah', '1 pak', 'Untuk tong sampah paket 3', '', '84T8-74BH-SB72-Z9Z5-8VBX ', '', '', NULL, NULL, NULL, '', '', NULL),
(22, 'Gunting tanaman', '2 pcs', 'Untuk merapikan tanaman', '', '84T8-74BH-SB72-Z9Z5-8VBX ', '', '', NULL, NULL, NULL, '', '', NULL),
(23, 'Ban gerobak', '1 pc', 'Untuk gerobak kebersihan', '', '84T8-74BH-SB72-Z9Z5-8VBX ', '', '', NULL, NULL, NULL, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang_perbaikan`
--

CREATE TABLE `barang_perbaikan` (
  `id` int(255) NOT NULL,
  `nbarang` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nip_petugas` varchar(255) NOT NULL,
  `seri_perbaikan` varchar(255) NOT NULL,
  `penerimaan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `verifikasi_selesai` varchar(255) NOT NULL,
  `waktu_diterima` varchar(255) DEFAULT NULL,
  `waktu_selesai` varchar(255) DEFAULT NULL,
  `hasil` varchar(255) DEFAULT NULL,
  `waktu_hasil` varchar(255) NOT NULL,
  `deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_perbaikan`
--

INSERT INTO `barang_perbaikan` (`id`, `nbarang`, `jumlah`, `keterangan`, `nip_petugas`, `seri_perbaikan`, `penerimaan`, `catatan`, `verifikasi_selesai`, `waktu_diterima`, `waktu_selesai`, `hasil`, `waktu_hasil`, `deadline`) VALUES
(10, 'Toilet pria', '1', 'saluran pembuangan air tidak ada', '197312242002121005', '54EG-341Q-9GKW-08T0-4DV9 ', 'Tugas diterima', 'Segera', 'Perbaikan selesai', '2022-05-24 09:44', '2022-05-25 10:28', 'Hasil diterima', '2022-05-30 09:41', '2022-06-10'),
(11, 'kran urinoir', '1', 'air keluar terus', '197312242002121005', '54EG-341Q-9GKW-08T0-4DV9 ', 'Tugas diterima', 'Segera', 'Perbaikan selesai', '2022-05-24 09:44', '2022-05-25 10:28', 'Hasil diterima', '2022-05-30 09:41', '2022-06-10'),
(12, 'wastafel', '1', 'wastafel di toilet wanita, dudukannya lapuk', '197312242002121005', '54EG-341Q-9GKW-08T0-4DV9 ', 'Tugas diterima', 'Segera', 'Perbaikan selesai', '2022-05-24 09:44', '2022-05-25 10:28', 'Hasil diterima', '2022-05-30 09:41', '2022-06-10'),
(13, 'batu alam', '1', 'batu alam pada toilet wanita banyak yang lepas', '197312242002121005', '54EG-341Q-9GKW-08T0-4DV9 ', 'Tugas diterima', 'Segera', 'Perbaikan selesai', '2022-05-24 09:44', '2022-05-25 10:29', 'Hasil diterima', '2022-05-30 09:41', '2022-06-10'),
(14, 'kloset', '1', 'perlu perbaikan', '197312242002121005', '54EG-341Q-9GKW-08T0-4DV9 ', 'Tugas diterima', '', '', '2022-05-24 09:44', NULL, 'Hasil diterima', '2022-05-30 09:41', '2022-06-10'),
(15, 'AC', '1', 'AC ruang PJT mati', '196701261996031001', 'DPXQ-KA99-6RD4-F9Y1-J3S2 ', 'Tugas diterima', 'telah diperbaiki', 'Perbaikan selesai', '2022-05-30 09:44', '2022-05-30 09:44', NULL, '', '2022-05-31'),
(16, 'Oven', '1', 'Alat menyala, tapi tidak bisa memanaskan', '197107072002121002', 'S7I3-1RWG-1SXF-80N3-K7E5 ', '', '', '', NULL, NULL, NULL, '', '2022-05-27'),
(17, 'Kran Air Bocor', '1', 'Laboratorium Aneka Komoditi', '197812242002121002', 'CX5A-5A3W-JMXI-IO09-6I52 ', 'Tugas diterima', 'segera ditindaklanjuti', 'Perbaikan selesai', '2022-05-30 09:41', '2022-05-30 09:42', 'Hasil diterima', '2022-05-30 09:42', '2022-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `gratifikasi`
--

CREATE TABLE `gratifikasi` (
  `id` int(11) NOT NULL,
  `pelapor` varchar(200) NOT NULL,
  `jenis_penerimaan` int(11) NOT NULL,
  `uraian` text DEFAULT NULL,
  `taksiran` bigint(20) DEFAULT NULL,
  `jenis_peristiwa` int(11) NOT NULL,
  `tempat_penerimaan` varchar(200) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `penerima` varchar(200) DEFAULT NULL,
  `pemberi` varchar(200) DEFAULT NULL,
  `pekerjaan` varchar(200) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `hubungan` varchar(200) DEFAULT NULL,
  `alasan_pemberian` text DEFAULT NULL,
  `kronologi_penerimaan` text DEFAULT NULL,
  `tindakan` text DEFAULT NULL,
  `is_tindak` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gratifikasi`
--

INSERT INTO `gratifikasi` (`id`, `pelapor`, `jenis_penerimaan`, `uraian`, `taksiran`, `jenis_peristiwa`, `tempat_penerimaan`, `tanggal`, `penerima`, `pemberi`, `pekerjaan`, `jabatan`, `alamat`, `telepon`, `email`, `hubungan`, `alasan_pemberian`, `kronologi_penerimaan`, `tindakan`, `is_tindak`) VALUES
(1, '198402022009112001', 2, 'Paket suvenir dan produk perusahaan', 200000, 1, 'Banjarbaru', '2022-05-28', 'Farida Hasanah', 'PT. Awan Sejahtera', 'Marketing', '.', 'Lianganggang Banjarbaru', '08155559999', 'awansejahtera@gmail.com', 'rekan kerja', 'promosi produk', 'ketika peninjauan lokasi ', 'dapat diterima oleh yang bersangkutan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ijin_keluar`
--

CREATE TABLE `ijin_keluar` (
  `id` int(11) NOT NULL,
  `pemohon` varchar(200) NOT NULL,
  `keperluan` text DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `jam_kembali` time DEFAULT NULL,
  `tanggal_ijin` date DEFAULT NULL,
  `pejabat_validasi` varchar(200) DEFAULT NULL,
  `validasi` enum('Diterima','Ditolak') DEFAULT NULL,
  `alasan_ditolak` text DEFAULT NULL,
  `waktu_validasi` varchar(200) DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ijin_keluar`
--

INSERT INTO `ijin_keluar` (`id`, `pemohon`, `keperluan`, `jam_keluar`, `jam_kembali`, `tanggal_ijin`, `pejabat_validasi`, `validasi`, `alasan_ditolak`, `waktu_validasi`, `tanggal_dibuat`) VALUES
(1, '198702092010121002', 'Pembayaran SPP di Bank BPD Kalsel', '13:30:00', '14:30:00', '2022-05-24', '198402022009112001', 'Diterima', NULL, '2022-05-24, 13:10', '2022-05-24'),
(2, '198402022009112001', 'Pembukaan rekening baru', '14:34:00', '15:34:00', '2022-05-24', '198008042003121007', 'Diterima', NULL, '2022-05-25, 10:57', '2022-05-24'),
(3, '198008042003121007', 'rapat', '09:00:00', '14:00:00', '2022-05-22', '198402022009112001', 'Diterima', NULL, '2022-05-24, 14:38', '2022-05-24'),
(4, '199008122019011001', 'Ke Bank untuk pengurusan mbanking', '10:00:00', '11:00:00', '2022-05-25', '198402022009112001', 'Diterima', NULL, '2022-05-25, 10:10', '2022-05-25'),
(5, '198702092010121002', 'Pembayaran SPP di Bank BPD Kalsel (Sebelumnya Sistem Error)', '01:30:00', '02:30:00', '2022-05-27', '198402022009112001', 'Diterima', NULL, '2022-05-27, 12:43', '2022-05-27'),
(6, '198702092010121002', 'Mengantar kado temannya anak & surat pertanggungjawaban rohaniwan ', '08:00:00', '08:30:00', '2022-05-30', '198402022009112001', 'Diterima', NULL, '2022-05-30, 09:32', '2022-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `ijin_lembur`
--

CREATE TABLE `ijin_lembur` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `pemohon` text NOT NULL,
  `penginput` varchar(200) NOT NULL,
  `keperluan` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_berakhir` time DEFAULT NULL,
  `lama_tugas` varchar(100) DEFAULT NULL,
  `tanggal_ijin` date DEFAULT NULL,
  `pejabat_validasi` varchar(200) NOT NULL,
  `validasi_atasan_langsung` varchar(200) DEFAULT NULL,
  `waktu_validasi_atasan_langsung` varchar(255) DEFAULT NULL,
  `validasi_kepala_balai` varchar(200) DEFAULT NULL,
  `waktu_validasi_kepala_balai` varchar(255) DEFAULT NULL,
  `diterbitkan` tinyint(1) DEFAULT 0,
  `alasan_ditolak` text DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `tanggal_surat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ijin_lembur`
--

INSERT INTO `ijin_lembur` (`id`, `nomor_surat`, `pemohon`, `penginput`, `keperluan`, `keterangan`, `jam_mulai`, `jam_berakhir`, `lama_tugas`, `tanggal_ijin`, `pejabat_validasi`, `validasi_atasan_langsung`, `waktu_validasi_atasan_langsung`, `validasi_kepala_balai`, `waktu_validasi_kepala_balai`, `diterbitkan`, `alasan_ditolak`, `tanggal_dibuat`, `tanggal_surat`) VALUES
(9, '999/BSKJI/BSPJI-BANJARBARU/KP/V/2022', '198402022009112001', '198402022009112001', 'Persiapan zi wbbm', '-', '17:00:00', '22:15:00', '5 Jam 15 Menit ', '2022-05-24', '198008042003121007', 'Diterima', '2022-05-24, 14:37', 'Diterima', '2022-05-24, 14:37', 1, '', '2022-05-24', '24 Mei 2022'),
(10, '999/BSKJI/BSPJI-BANJARBARU/KP/V/2022', '198702092010121002', '198702092010121002', 'Pengarsipan Dokumen Kepegawaian', '-', '16:00:00', '18:00:00', '2 Jam ', '2022-05-24', '198402022009112001', 'Diterima', '2022-05-25, 08:38', 'Diterima', '2022-05-25, 09:50', 1, '', '2022-05-24', '24 Mei 2022'),
(11, NULL, '198403282009101002', '198403282009101002', 'Mengetik Daftar isi Berkas arsip Inaktif Usul Musnah  yg belum dibuat berupa jenis arsip ;LHU  Unit Pengolah ; PJT Kurun Waktu ; Tahun 2016', '', '09:00:00', '13:00:00', NULL, '2022-05-26', '198402022009112001', 'Diterima', '2022-05-25, 10:07', 'Diterima', '2022-05-25, 14:15', 0, '', '2022-05-25', NULL),
(12, NULL, '198403282009101002', '198403282009101002', 'Melanjutkan pengetikan / pengisisan Daftar isi Berkas arsip Inaktif Usul Musnah yg belum dibuat berupa jenis arsip ;LHU Unit Pengolah ; PJT Kurun Waktu ; Tahun 2016', 'Untuk melengkapi daftar arsip usul musnah yang belumt dibuat dari tahun 2015,2016, 2017, 2018 berupa jenis arsip : LHU dari unit unit pengolah :yang sudah diajukan ke biro umum', '08:00:00', '12:00:00', NULL, '2022-05-28', '198402022009112001', 'Diterima', '2022-05-28, 10:17', 'Diterima', '2022-05-29, 14:14', 0, '', '2022-05-28', NULL),
(13, NULL, '198008042003121007,198402022009112001,198702092010121002,199502232022022002', '198402022009112001', 'Pembahasan peta jabatan TA 2022', 'lembur dari rumah masing-masing, dan rapat melalui zoom', '13:00:00', '15:00:00', NULL, '2022-05-28', '198008042003121007', 'Diterima', '2022-05-29, 14:14', 'Diterima', '2022-05-29, 14:14', 0, '', '2022-05-28', NULL),
(14, NULL, '198402022009112001,199612292020121003', '199612292020121003', 'Penyusunan RAB TA 2023', 'di kantor', '10:00:00', '14:00:00', NULL, '2022-05-29', '198402022009112001', 'Diterima', '2022-05-29, 14:16', 'Diterima', '2022-05-29, 14:17', 0, '', '2022-05-29', NULL),
(15, NULL, '199502232022022002', '199502232022022002', 'Penginputan data pelatihan pegawai pada SaPK', '.', '09:00:00', '13:00:00', NULL, '2022-06-01', '198402022009112001', NULL, NULL, NULL, NULL, 0, NULL, '2022-05-30', NULL),
(16, NULL, '199502232022022002', '199502232022022002', 'Penginputan data pelatihan pegawai pada SaPK', '.', '09:00:00', '13:00:00', NULL, '2022-06-01', '198402022009112001', 'Diterima', '2022-05-30, 13:58', NULL, NULL, 0, '', '2022-05-30', NULL),
(17, NULL, '199502232022022002', '199502232022022002', 'Penginputan data pelatihan pegawai pada SaPK', '.', '09:00:00', '13:00:00', NULL, '2022-06-01', '198402022009112001', 'Diterima', '2022-05-30, 13:58', NULL, NULL, 0, '', '2022-05-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `hak_akses` varchar(255) NOT NULL,
  `nip_pegawai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `hak_akses`, `nip_pegawai`) VALUES
(1, 'Kepala Balai', 'kepala_balai', '198008042003121007'),
(2, 'Kasubag Tata Usaha', 'kasubag_tu', '198402022009112001'),
(3, 'Pejabat Pembuat Komitmen', 'ppk', '198402022009112001,199008122019011001'),
(4, 'Pejabat Pengadaan', 'pengadaan', '198710112010121001'),
(5, 'Koordinator', 'koordinator', '198203252005022001,198210072006042020,198905302015021004,197709022005022002');

-- --------------------------------------------------------

--
-- Table structure for table `log_user`
--

CREATE TABLE `log_user` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `nip_user` varchar(255) DEFAULT NULL,
  `waktu_login` datetime DEFAULT NULL,
  `waktu_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_user`
--

INSERT INTO `log_user` (`id`, `nama_user`, `nip_user`, `waktu_login`, `waktu_logout`) VALUES
(4, 'Administrator', '99999999', '2022-05-21 10:35:57', '2022-05-21 10:36:07'),
(5, 'Administrator', '99999999', '2022-05-21 16:30:25', '2022-05-21 16:30:40'),
(6, 'Administrator', '99999999', '2022-05-21 18:27:47', '2022-05-21 18:30:31'),
(7, 'Muhamad Ridwan', '198702092010121002', '2022-05-21 18:30:44', '2022-05-21 18:31:12'),
(8, NULL, NULL, NULL, '2022-05-22 07:25:37'),
(9, 'Administrator', '99999999', '2022-05-22 07:25:42', '2022-05-22 09:13:53'),
(10, NULL, NULL, NULL, '2022-05-22 16:05:30'),
(11, 'Administrator', '99999999', '2022-05-22 16:10:41', '2022-05-22 16:16:03'),
(12, 'Administrator', '99999999', '2022-05-24 08:47:43', '2022-05-24 08:50:19'),
(13, 'Farida Hasanah', '198402022009112001', '2022-05-24 08:50:31', '2022-05-24 09:06:12'),
(14, 'Administrator', '99999999', '2022-05-24 09:06:19', '2022-05-24 09:06:56'),
(15, 'Afandy Bayu Nurcahyo', '199404152018011002', '2022-05-24 09:07:02', '2022-05-24 09:10:19'),
(16, 'Administrator', '99999999', '2022-05-24 09:10:26', '2022-05-24 09:10:44'),
(17, 'Chatimatun Nisa', '198210072006042020', '2022-05-24 09:10:47', '2022-05-24 09:11:26'),
(18, 'Administrator', '99999999', '2022-05-24 09:11:32', '2022-05-24 09:11:48'),
(19, 'Muhammad Khairul Dzakirin', '199008122019011001', '2022-05-24 09:11:52', '2022-05-24 09:12:21'),
(20, 'Administrator', '99999999', '2022-05-24 09:12:28', '2022-05-24 09:12:43'),
(21, 'Budi Setiawan', '198008042003121007', '2022-05-24 09:12:46', '2022-05-24 09:13:02'),
(22, 'Administrator', '99999999', '2022-05-24 09:13:09', '2022-05-24 09:13:25'),
(23, 'Aria Khadafie', '90860319020997', '2022-05-24 09:13:28', '2022-05-24 09:17:32'),
(24, 'Administrator', '99999999', '2022-05-24 09:17:38', '2022-05-24 09:30:43'),
(25, NULL, NULL, NULL, '2022-05-24 09:30:45'),
(26, 'M. Isa Anshari', '197812242002121002', '2022-05-24 09:30:48', '2022-05-24 09:33:16'),
(27, 'Administrator', '99999999', '2022-05-24 09:33:25', '2022-05-24 09:33:58'),
(28, 'Anhar Firdaus', '197602202002121006', '2022-05-24 09:34:01', '2022-05-24 09:34:48'),
(29, 'Administrator', '99999999', '2022-05-24 09:34:56', '2022-05-24 09:35:15'),
(30, 'Evy Setiawati', '198203252005022001', '2022-05-24 09:35:18', '2022-05-24 09:35:37'),
(31, NULL, NULL, NULL, '2022-05-24 09:35:38'),
(32, 'Farida Hasanah', '198402022009112001', '2022-05-24 09:35:54', '2022-05-24 09:36:27'),
(33, 'Administrator', '99999999', '2022-05-24 09:36:38', '2022-05-24 09:36:57'),
(34, 'Budi Setiawan', '198008042003121007', '2022-05-24 09:37:01', '2022-05-24 09:37:42'),
(35, 'Farida Hasanah', '198402022009112001', '2022-05-24 09:37:55', '2022-05-24 09:38:46'),
(36, 'Administrator', '99999999', '2022-05-24 09:38:52', '2022-05-24 09:39:10'),
(37, 'M. Isa Anshari', '197812242002121002', '2022-05-24 09:39:13', '2022-05-24 09:43:38'),
(38, 'Administrator', '99999999', '2022-05-24 09:43:43', '2022-05-24 09:43:56'),
(39, 'Mangatas Siregar', '197312242002121005', '2022-05-24 09:43:59', '2022-05-24 09:45:01'),
(40, 'Administrator', '99999999', '2022-05-25 09:07:17', '2022-05-25 09:12:39'),
(41, 'Muhamad Ridwan', '198702092010121002', '2022-05-25 09:18:29', '2022-05-25 09:45:29'),
(42, 'Farida Hasanah', '198402022009112001', '2022-05-25 09:20:02', '2022-05-25 09:51:06'),
(43, 'Andi Gunadi', '196907211990031004', '2022-05-25 09:40:31', '2022-05-25 09:52:27'),
(44, 'Budi Setiawan', '198008042003121007', '2022-05-25 09:45:45', '2022-05-25 09:52:27'),
(45, 'Muhamad Ridwan', '198702092010121002', '2022-05-25 09:52:40', '2022-05-25 09:52:48'),
(46, 'Administrator', '99999999', '2022-05-25 09:18:20', '2022-05-25 09:53:13'),
(47, 'Diky Subhanuddin', '198710112010121001', '2022-05-25 09:53:18', '2022-05-25 09:53:45'),
(48, 'Administrator', '99999999', '2022-05-25 09:53:50', '2022-05-25 09:54:08'),
(49, 'M. Isa Anshari', '197812242002121002', '2022-05-25 09:54:12', '2022-05-25 09:54:37'),
(50, 'Administrator', '99999999', '2022-05-25 09:51:15', '2022-05-25 09:54:54'),
(51, 'Administrator', '99999999', '2022-05-25 09:54:47', '2022-05-25 09:59:49'),
(52, 'Budi Setiawan', '198008042003121007', '2022-05-25 09:53:07', '2022-05-25 10:00:03'),
(53, 'Muhamad Ridwan', '198702092010121002', '2022-05-25 10:00:18', '2022-05-25 10:01:31'),
(54, 'Muhamad Ridwan', '198702092010121002', '2022-05-25 09:59:58', '2022-05-25 10:01:47'),
(55, 'Administrator', '99999999', '2022-05-25 10:01:36', '2022-05-25 10:02:53'),
(56, 'Wahid Adhi Suryawan', '199210182018011002', '2022-05-25 09:45:10', '2022-05-25 10:03:20'),
(57, NULL, NULL, NULL, '2022-05-25 10:03:23'),
(58, 'Budi Setiawan', '198008042003121007', '2022-05-25 10:03:08', '2022-05-25 10:05:20'),
(59, 'Siti Faridah', '197209221996032001', '2022-05-25 09:17:15', '2022-05-25 10:11:32'),
(60, 'Diky Subhanuddin', '198710112010121001', '2022-05-25 09:46:28', '2022-05-25 10:12:46'),
(61, 'Farida Hasanah', '198402022009112001', '2022-05-25 09:55:05', '2022-05-25 10:13:07'),
(62, 'Administrator', '99999999', '2022-05-25 10:06:33', '2022-05-25 10:14:19'),
(63, 'Diky Subhanuddin', '198710112010121001', '2022-05-25 10:13:24', '2022-05-25 10:14:53'),
(64, 'M. Isa Anshari', '197812242002121002', '2022-05-25 10:04:06', '2022-05-25 10:18:53'),
(65, 'Diky Subhanuddin', '198710112010121001', '2022-05-25 10:16:15', '2022-05-25 10:20:28'),
(66, 'Devan Surya Adrian', '199912292022011007', '2022-05-25 09:49:12', '2022-05-25 10:20:30'),
(67, 'Administrator', '99999999', '2022-05-25 10:20:36', '2022-05-25 10:21:50'),
(68, 'Administrator', '99999999', '2022-05-25 10:21:57', '2022-05-25 10:22:09'),
(69, 'Muhamad Ridwan', '198702092010121002', '2022-05-25 10:22:11', '2022-05-25 10:25:03'),
(70, 'M. Isa Anshari', '197812242002121002', '2022-05-25 10:25:06', '2022-05-25 10:26:03'),
(71, 'Administrator', '99999999', '2022-05-25 10:26:09', '2022-05-25 10:26:42'),
(72, 'M. Isa Anshari', '197812242002121002', '2022-05-25 10:26:45', '2022-05-25 10:27:02'),
(73, 'Farida Hasanah', '198402022009112001', '2022-05-25 10:22:07', '2022-05-25 10:27:07'),
(74, 'Diky Subhanuddin', '198710112010121001', '2022-05-25 10:21:54', '2022-05-25 10:27:32'),
(75, 'Administrator', '99999999', '2022-05-25 10:27:36', '2022-05-25 10:27:52'),
(76, 'Administrator', '99999999', '2022-05-25 10:28:28', '2022-05-25 10:29:38'),
(77, 'Mangatas Siregar', '197312242002121005', '2022-05-25 10:27:58', '2022-05-25 10:36:09'),
(78, 'Administrator', '99999999', '2022-05-25 10:38:49', '2022-05-25 10:39:12'),
(79, 'Diky Subhanuddin', '198710112010121001', '2022-05-25 10:29:58', '2022-05-25 10:44:02'),
(80, 'Muhamad Ridwan', '198702092010121002', '2022-05-25 10:05:33', '2022-05-25 10:53:51'),
(81, 'Diky Subhanuddin', '198710112010121001', '2022-05-25 10:54:30', '2022-05-25 10:55:07'),
(82, 'Budi Setiawan', '198008042003121007', '2022-05-25 10:55:40', '2022-05-25 10:57:28'),
(83, NULL, NULL, NULL, '2022-05-25 11:05:13'),
(84, 'Administrator', '99999999', '2022-05-25 11:22:43', '2022-05-25 11:23:07'),
(85, 'Administrator', '99999999', '2022-05-25 11:23:53', '2022-05-25 11:27:10'),
(86, 'Farida Hasanah', '198402022009112001', '2022-05-25 11:27:18', '2022-05-25 11:30:27'),
(87, 'Administrator', '99999999', '2022-05-25 11:30:39', '2022-05-25 11:31:50'),
(88, 'Budi Setiawan', '198008042003121007', '2022-05-25 11:31:58', '2022-05-25 11:33:02'),
(89, 'Administrator', '99999999', '2022-05-25 11:33:13', '2022-05-25 11:33:48'),
(90, 'Diky Subhanuddin', '198710112010121001', '2022-05-25 11:33:55', '2022-05-25 11:34:17'),
(91, 'Administrator', '99999999', '2022-05-25 11:34:24', '2022-05-25 11:34:57'),
(92, 'Farida Hasanah', '198402022009112001', '2022-05-25 11:35:06', '2022-05-25 11:36:18'),
(93, 'Administrator', '99999999', '2022-05-25 11:36:34', '2022-05-25 11:36:56'),
(94, NULL, NULL, NULL, '2022-05-25 11:53:42'),
(95, 'Administrator', '99999999', '2022-05-25 11:53:47', '2022-05-25 11:53:59'),
(96, 'Budi Setiawan', '198008042003121007', '2022-05-25 14:14:56', '2022-05-25 14:18:10'),
(97, 'Budi Setiawan', '198008042003121007', '2022-05-25 14:20:03', '2022-05-25 14:38:04'),
(98, 'Muntashir Rakhman', '198403282009101002', '2022-05-26 11:03:17', '2022-05-26 11:04:24'),
(99, 'Budi Setiawan', '198008042003121007', '2022-05-27 21:51:38', '2022-05-27 21:54:18'),
(100, 'Muntashir Rakhman', '198403282009101002', '2022-05-28 07:51:23', '2022-05-28 08:03:27'),
(101, 'Muntashir Rakhman', '198403282009101002', '2022-05-28 10:39:20', '2022-05-28 10:39:55'),
(102, 'Muntashir Rakhman', '198403282009101002', '2022-05-29 05:16:45', '2022-05-29 05:17:14'),
(103, 'Administrator', '99999999', '2022-05-29 10:26:46', '2022-05-29 10:27:23'),
(104, 'M. Isa Anshari', '197812242002121002', '2022-05-29 10:27:25', '2022-05-29 10:27:43'),
(105, 'Administrator', '99999999', '2022-05-29 12:40:28', '2022-05-29 12:56:48'),
(106, 'Muntashir Rakhman', '198403282009101002', '2022-05-29 12:56:54', '2022-05-29 12:57:03'),
(107, 'Muntashir Rakhman', '198403282009101002', '2022-05-29 13:07:01', '2022-05-29 13:07:36'),
(108, 'Administrator', '99999999', '2022-05-29 14:13:34', '2022-05-29 14:13:58'),
(109, 'Budi Setiawan', '198008042003121007', '2022-05-29 14:14:01', '2022-05-29 14:14:50'),
(110, 'Farida Hasanah', '198402022009112001', '2022-05-29 14:15:09', '2022-05-29 14:15:30'),
(111, 'Muhammad Khalish Hafizh', '199612292020121003', '2022-05-29 14:15:33', '2022-05-29 14:16:26'),
(112, 'Farida Hasanah', '198402022009112001', '2022-05-29 14:16:33', '2022-05-29 14:17:03'),
(113, 'Farida Hasanah', '198402022009112001', '2022-05-29 14:17:12', '2022-05-29 14:17:26'),
(114, 'Budi Setiawan', '198008042003121007', '2022-05-29 14:17:29', '2022-05-29 14:20:15'),
(115, 'Muntashir Rakhman', '198403282009101002', '2022-05-30 07:49:00', '2022-05-30 07:49:23'),
(116, 'Farida Hasanah', '198402022009112001', '2022-05-30 09:32:33', '2022-05-30 09:40:44'),
(117, 'M. Isa Anshari', '197812242002121002', '2022-05-30 09:40:48', '2022-05-30 09:42:39'),
(118, 'Farida Hasanah', '198402022009112001', '2022-05-30 09:42:46', '2022-05-30 09:44:01'),
(119, 'Yanuarianto', '196701261996031001', '2022-05-30 09:44:04', '2022-05-30 09:44:36'),
(120, 'Farida Hasanah', '198402022009112001', '2022-05-30 09:44:44', '2022-05-30 09:45:18'),
(121, 'Diky Subhanuddin', '198710112010121001', '2022-05-30 09:45:22', '2022-05-30 09:52:38'),
(122, 'Aslan Prayudi', '197604122002121008', '2022-05-30 11:27:38', '2022-05-30 11:31:24'),
(123, 'Administrator', '99999999', '2022-05-30 13:56:40', '2022-05-30 13:57:07'),
(124, NULL, NULL, NULL, '2022-05-30 13:57:07'),
(125, 'Mega Rahmadani', '199502232022022002', '2022-05-30 13:57:11', '2022-05-30 13:58:18'),
(126, 'Farida Hasanah', '198402022009112001', '2022-05-30 13:58:26', '2022-05-30 13:59:01'),
(127, 'Farida Hasanah', '198402022009112001', '2022-05-30 15:56:10', '2022-05-30 15:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `m_formulir`
--

CREATE TABLE `m_formulir` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_formulir`
--

INSERT INTO `m_formulir` (`id`, `nama`, `kode`) VALUES
(1, 'SPJPT', 'FM 8.2.5 - SPI'),
(2, 'SPK', 'FM 8.2.6 - SPK'),
(3, 'LHU', 'FM 8.6.1 - LHU'),
(4, 'PPR', 'FM. 4.6.00.06');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_pelanggaran`
--

CREATE TABLE `m_jenis_pelanggaran` (
  `id` int(11) NOT NULL,
  `pelanggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_jenis_pelanggaran`
--

INSERT INTO `m_jenis_pelanggaran` (`id`, `pelanggaran`) VALUES
(1, 'Pelanggaran Terhadap Peraturan'),
(2, 'Pelanggaran Wewenang dan Jabatan'),
(3, 'Pelanggaran yang dapat merugikan unit Kerja');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_penerimaan`
--

CREATE TABLE `m_jenis_penerimaan` (
  `id` int(11) NOT NULL,
  `jenis_penerimaan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_jenis_penerimaan`
--

INSERT INTO `m_jenis_penerimaan` (`id`, `jenis_penerimaan`) VALUES
(1, 'Uang'),
(2, 'Barang'),
(5, 'Komisi');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_peristiwa`
--

CREATE TABLE `m_jenis_peristiwa` (
  `id` int(11) NOT NULL,
  `jenis_peristiwa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_jenis_peristiwa`
--

INSERT INTO `m_jenis_peristiwa` (`id`, `jenis_peristiwa`) VALUES
(1, 'Terkait pernikahan/keagamaan/acara adat'),
(2, 'Mutasi/promosi/pisah sambut'),
(44, 'Kunjungan kerja/Mengikuti kegiatan Pelatihan, Seminar dan sebagainya');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id` int(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `user` varchar(99) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `jam` varchar(255) NOT NULL,
  `nip_pemohon` varchar(99) DEFAULT NULL,
  `nip_atasan` varchar(99) DEFAULT NULL,
  `nip_penanggung` varchar(99) DEFAULT NULL,
  `nip_petugas_pengadaan` varchar(255) DEFAULT NULL,
  `validasi1` varchar(200) DEFAULT NULL,
  `alasan1` varchar(99) DEFAULT NULL,
  `waktu_validasi1` varchar(255) DEFAULT NULL,
  `validasi2` varchar(200) DEFAULT NULL,
  `alasan2` varchar(200) DEFAULT NULL,
  `waktu_validasi2` varchar(200) DEFAULT NULL,
  `validasi3` varchar(200) DEFAULT NULL,
  `alasan3` varchar(200) DEFAULT NULL,
  `waktu_validasi3` varchar(200) DEFAULT NULL,
  `disposisi` varchar(99) DEFAULT NULL,
  `alasan_dispo` varchar(99) DEFAULT NULL,
  `waktu_disposisi` varchar(255) DEFAULT NULL,
  `penugasan` varchar(255) DEFAULT NULL,
  `waktu_penugasan` varchar(255) DEFAULT NULL,
  `waktu_diterima` varchar(255) DEFAULT NULL,
  `verifikasi_selesai` varchar(255) DEFAULT NULL,
  `waktu_selesai` varchar(255) DEFAULT NULL,
  `hasil` varchar(255) DEFAULT NULL,
  `waktu_hasil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`id`, `serial_number`, `user`, `keterangan`, `tanggal`, `jam`, `nip_pemohon`, `nip_atasan`, `nip_penanggung`, `nip_petugas_pengadaan`, `validasi1`, `alasan1`, `waktu_validasi1`, `validasi2`, `alasan2`, `waktu_validasi2`, `validasi3`, `alasan3`, `waktu_validasi3`, `disposisi`, `alasan_dispo`, `waktu_disposisi`, `penugasan`, `waktu_penugasan`, `waktu_diterima`, `verifikasi_selesai`, `waktu_selesai`, `hasil`, `waktu_hasil`) VALUES
(23, '621O-D96F-088L-ZJ90-6VF8 ', '198403282009101002', '1,Label  Arsip untuk Folder , Box Arsip,10,Label Kecil untuk Kuping Folder Label Besar untuk Boks Arsip Inaktif, dan juga sebagai indeks /judul Folder dan penomoran Folder dan Identitas Box Arsip inaktif.', '2022-05-25', '10:03', '198403282009101002', '198402022009112001', '198710112010121001', '196907211990031004', 'Mohon dibantu', '', '2022-05-25 14:30', NULL, '', '2022-05-25 14:30', NULL, '', '2022-05-25 14:32', 'Mohon dbantu', '', '2022-05-25 14:34', 'mohon dibantu', '2022-05-30 09:46', NULL, NULL, NULL, NULL, NULL),
(24, '9ZLM-OW28-A37H-OBRW-52UT ', '99999999', '1,Tikar,2 Unit,Rusak.2,Komputer,5 Unit,Kekurangan .', '2022-05-25', '11:25', '198402022009112001', '198402022009112001', '198710112010121001', '198710112010121001,198710112010121001', 'Lanjutkan permohonan', '', '2022-05-25 11:29', NULL, '', '2022-05-25 11:29', NULL, '', '2022-05-25 11:32', 'lanjutkan pengadaan', '', '2022-05-25 11:35', 'mohon dibantu', '2022-05-30 09:46', '2022-05-30 09:47', 'Pengadaan selesai', '2022-05-30 09:52', 'Hasil diterima', '2022-05-30 09:53'),
(25, '2C73-41O8-6DBB-625F-078Y ', '198402022009112001', '1,Bulpoint,3,Kehabisan.2,Tissu,8 Pieces,Habis.', '2022-05-25', '11:28', '198402022009112001', '198402022009112001', '198710112010121001', '198710112010121001,198710112010121001', 'Mohon dibantu', '', '2022-05-25 14:30', NULL, '', '2022-05-25 14:30', NULL, '', '2022-05-25 14:33', 'Mohon dibantu', '', '2022-05-25 14:35', 'segera', '2022-05-30 09:47', '2022-05-30 09:51', 'Pengadaan selesai', '2022-05-30 09:51', 'Hasil diterima', '2022-05-30 09:53'),
(26, 'U138-NA43-2Y4N-YT4Z-09HF ', '198008042003121007', '', '2022-05-25', '14:28', '198008042003121007', '198402022009112001', '198710112010121001', NULL, 'Mohon dbantu', '', '2022-05-25 14:30', NULL, '', '2022-05-25 14:30', NULL, '', '2022-05-25 14:32', '.', '', '2022-05-28 14:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '33C5-U6Q7-IQ7R-OI11-D778 ', '198008042003121007', '', '2022-05-25', '14:33', '198008042003121007', '198008042003121007', NULL, NULL, 'ok', '', '2022-05-25 14:33', NULL, '', '2022-05-25 14:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '6071-3474-YWQ5-568Q-18L9 ', '198008042003121007', '', '2022-05-25', '14:37', '198402022009112001', '198008042003121007', NULL, NULL, 'sip', '', '2022-05-25 14:37', NULL, '', '2022-05-28 14:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '84T8-74BH-SB72-Z9Z5-8VBX ', '197604122002121008', '1,Lap Microfiber,10 pcs,Untuk membersihkan ruangan.2,Kantong Sampah,1 pak,Untuk tong sampah paket 3.3,Gunting tanaman,2 pcs,Untuk merapikan tanaman.4,Ban gerobak,1 pc,Untuk gerobak kebersihan.', '2022-05-30', '11:30', '197604122002121008', '198402022009112001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan`
--

CREATE TABLE `perbaikan` (
  `id` int(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `user` varchar(99) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `jam` varchar(255) NOT NULL,
  `nip_pemohon` varchar(99) DEFAULT NULL,
  `nip_atasan` varchar(99) DEFAULT NULL,
  `nip_penanggung` varchar(99) DEFAULT NULL,
  `nip_petugas_perbaikan` varchar(255) DEFAULT NULL,
  `alasan1` varchar(99) DEFAULT NULL,
  `waktu_validasi1` varchar(255) DEFAULT NULL,
  `validasi2` varchar(99) DEFAULT NULL,
  `alasan2` varchar(99) DEFAULT NULL,
  `waktu_validasi2` varchar(255) DEFAULT NULL,
  `disposisi` varchar(99) DEFAULT NULL,
  `alasan_dispo` varchar(99) DEFAULT NULL,
  `waktu_disposisi` varchar(255) DEFAULT NULL,
  `penugasan` varchar(255) DEFAULT NULL,
  `waktu_penugasan` varchar(255) DEFAULT NULL,
  `waktu_diterima` varchar(255) DEFAULT NULL,
  `verifikasi_selesai` varchar(255) DEFAULT NULL,
  `waktu_selesai` varchar(255) DEFAULT NULL,
  `hasil` varchar(255) DEFAULT NULL,
  `waktu_hasil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perbaikan`
--

INSERT INTO `perbaikan` (`id`, `serial_number`, `user`, `keterangan`, `tanggal`, `jam`, `nip_pemohon`, `nip_atasan`, `nip_penanggung`, `nip_petugas_perbaikan`, `alasan1`, `waktu_validasi1`, `validasi2`, `alasan2`, `waktu_validasi2`, `disposisi`, `alasan_dispo`, `waktu_disposisi`, `penugasan`, `waktu_penugasan`, `waktu_diterima`, `verifikasi_selesai`, `waktu_selesai`, `hasil`, `waktu_hasil`) VALUES
(25, '54EG-341Q-9GKW-08T0-4DV9 ', '197812242002121002', '1,Toilet pria,1,saluran pembuangan air tidak ada.2,kran urinoir,1,air keluar terus.3,wastafel,1,wastafel di toilet wanita, dudukannya lapuk.4,batu alam,1,batu alam pada toilet wanita banyak yang lepas.5,kloset,1,perlu perbaikan.', '2022-05-24', '09:33', '197812242002121002', '198402022009112001', '197812242002121002', '197312242002121005,197312242002121005,197312242002121005,197312242002121005,197312242002121005', '', '2022-05-24 09:36', 'perbaikan segera', '', '2022-05-24 09:37', 'Mohon dibantu perbaikannya', NULL, '2022-05-24 09:38', 'tolong dibantu perbaikannya diluar jam kerja', '2022-05-24 09:42', '2022-05-24 09:44', 'Perbaikan selesai', '2022-05-25 10:29', 'Perbaikan selesai', '2022-05-30 09:41'),
(26, 'DPXQ-KA99-6RD4-F9Y1-J3S2 ', '197602202002121006', '1,AC,1,AC ruang PJT mati.', '2022-05-24', '09:34', '197602202002121006', '198203252005022001', '197812242002121002', '196701261996031001', '', '2022-05-24 09:35', 'mohon dibantu', '', '2022-05-24 09:37', 'Mohon dibantu perbaikannya', NULL, '2022-05-24 09:38', 'mohon dibantu jika perlu dapat hubungi rekanan', '2022-05-24 09:43', '2022-05-30 09:44', 'Perbaikan selesai', '2022-05-30 09:44', NULL, NULL),
(27, 'S7I3-1RWG-1SXF-80N3-K7E5 ', '199210182018011002', '1,Oven,1,Alat menyala, tapi tidak bisa memanaskan.', '2022-05-25', '10:02', '199210182018011002', '198402022009112001', '197812242002121002', '197107072002121002', '', '2022-05-25 10:02', NULL, '', '2022-05-25 10:03', 'mohon dibantu', NULL, '2022-05-25 10:04', 'Tolong barang, jasa, dan kwitansi dilampirkan', '2022-05-25 10:13', NULL, NULL, NULL, NULL, NULL),
(28, 'CX5A-5A3W-JMXI-IO09-6I52 ', '197812242002121002', '1,Kran Air Bocor,1,Laboratorium Aneka Komoditi.', '2022-05-25', '10:07', '197812242002121002', '198402022009112001', '197812242002121002', '197812242002121002', '', '2022-05-25 10:22', 'lanjutkan', '', '2022-05-25 14:17', 'disegerakan perbaikan', '', '2022-05-29 12:58', 'segera', '2022-05-30 09:41', '2022-05-30 09:41', 'Perbaikan selesai', '2022-05-30 09:42', 'Perbaikan selesai', '2022-05-30 09:42');

-- --------------------------------------------------------

--
-- Table structure for table `surat_tugas`
--

CREATE TABLE `surat_tugas` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(200) DEFAULT NULL,
  `pemohon` varchar(200) NOT NULL,
  `tanggal_permohonan` date NOT NULL,
  `pengusul` varchar(200) DEFAULT NULL,
  `nip_ditugaskan` varchar(100) DEFAULT NULL,
  `tujuan_tugas` varchar(255) DEFAULT NULL,
  `keperluan_tugas` text DEFAULT NULL,
  `tanggal_berangkat` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `lama_tugas` varchar(100) DEFAULT NULL,
  `instansi_dituju` varchar(100) DEFAULT NULL,
  `is_biaya` tinyint(1) DEFAULT 0,
  `anggaran` varchar(255) DEFAULT NULL,
  `pengikut` text DEFAULT NULL,
  `dasar_surat` varchar(255) DEFAULT NULL,
  `detail_perjalanan` text DEFAULT NULL,
  `nip_ppk` varchar(100) DEFAULT NULL,
  `alasan_ditolak` text DEFAULT NULL,
  `validasi_atasan_langsung` varchar(255) DEFAULT NULL,
  `waktu_validasi_atasan_langsung` varchar(255) DEFAULT NULL,
  `validasi_ppk` varchar(255) DEFAULT NULL,
  `waktu_validasi_ppk` varchar(255) DEFAULT NULL,
  `validasi_kepala_balai` varchar(255) DEFAULT NULL,
  `waktu_validasi_kepala_balai` varchar(255) DEFAULT NULL,
  `disahkan` tinyint(1) NOT NULL DEFAULT 0,
  `file_st` varchar(255) DEFAULT NULL,
  `file_spd` varchar(255) DEFAULT NULL,
  `file_spd2` varchar(255) DEFAULT NULL,
  `file_spd3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_tugas`
--

INSERT INTO `surat_tugas` (`id`, `nomor_surat`, `pemohon`, `tanggal_permohonan`, `pengusul`, `nip_ditugaskan`, `tujuan_tugas`, `keperluan_tugas`, `tanggal_berangkat`, `tanggal_kembali`, `lama_tugas`, `instansi_dituju`, `is_biaya`, `anggaran`, `pengikut`, `dasar_surat`, `detail_perjalanan`, `nip_ppk`, `alasan_ditolak`, `validasi_atasan_langsung`, `waktu_validasi_atasan_langsung`, `validasi_ppk`, `waktu_validasi_ppk`, `validasi_kepala_balai`, `waktu_validasi_kepala_balai`, `disahkan`, `file_st`, `file_spd`, `file_spd2`, `file_spd3`) VALUES
(31, '82-SPD/BSKJI/BSPJI-BANJARBARU/KU/V/2022', '199404152018011002', '2022-05-24', '198210072006042020', '199404152018011002', 'Ds. Butong, Muara Teweh, Kalteng', 'Sampling Udara Ambient 24 jam, Emisi Sumber Tidak Bergerak, Air Sungai, Biota Air, dan Tanah', '2022-05-23', '2022-05-27', '5 Hari', 'PT. Fontana Resources Indonesia', 1, 'SPD Pengujian', '197110171993031003,199510242022021003,90950519020993', '2268_052022.pdf', '19 titik sampling', '199008122019011001', '', 'Disetujui', '2022-05-24 09:11', 'Disetujui', '2022-05-24 09:12', 'Disetujui', '2022-05-24 09:12', 1, 'https___intranet.kemenperin.go.id_sppd_admin_surat_tugas_cetak.pdf', 'https___intranet.kemenperin.go.id_sppd_admin_blangko2.pdf', NULL, NULL),
(32, '999/BSKJI/BSPJI-BANJARBARU/KU/V/2022', '199505282022022001', '2022-05-24', '198905302015021004', '198905302015021004', 'Banjarmasin', 'Menghadiri undangan bootcamp dari Yayasan Hasnur Center (Wetland Box)', '2022-05-28', '2022-05-28', '1 Hari', 'IBT Wetland Box', 1, 'TI', '199502232022022002,199505282022022001', 'document (1).pdf', 'hadir sebagai observer', '199008122019011001', '', 'Disetujui', '2022-05-24 15:20', 'Disetujui', '2022-05-24 15:23', 'Disetujui', '2022-05-25 09:53', 1, 'KOP SURAT BSPJI Bjb (2022) paling baru.pdf', 'KOP SURAT BARISTAND (2022).pdf', NULL, NULL),
(33, NULL, '199912292022011007', '2022-05-25', '198402022009112001', '199912292022011007', 'Yogyakarta', 'Jalan-jalan', '2022-05-26', '2022-05-28', '3 Hari', 'Rumah', 1, 'dipa balai ', '199909022022011001', 'KOP SURAT BSPJI Bjb (2022) paling baru.pdf', 'Uji coba', '198402022009112001', '', 'Disetujui', '2022-05-25 09:55', 'Disetujui', '2022-05-25 09:55', 'Disetujui', '2022-05-25 14:20', 0, NULL, NULL, NULL, NULL),
(34, NULL, '199612292020121003', '2022-05-30', '198402022009112001', '198402022009112001', 'Surabaya, Jawa Timur', 'Mengikuti Rapat Evaluasi Pelaksanaan Anggaran, Laporan Keuangan dan BMN, dan Program di Satuan Kerja di Lingkungan Kementerian Perindustrian', '2022-06-02', '2022-06-03', '2 Hari', 'BDI Surabaya', 1, NULL, '199612292020121003,199008122019011001', '214628383215752586-B 202 SJ IND 3 KU V 2022 Undangan Surabaya.pdf', '-', '198402022009112001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbahan`
--

CREATE TABLE `tbahan` (
  `id` int(255) NOT NULL,
  `nbahan` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `seri_pengadaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbarang`
--

CREATE TABLE `tbarang` (
  `id` int(255) NOT NULL,
  `nbarang` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `seri_perbaikan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nip` varchar(225) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `golongan` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `tgl_lahir` varchar(255) DEFAULT NULL,
  `jenis_kel` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `pangkat` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `no_telp` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'PEGAWAI',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nip`, `nama`, `golongan`, `jabatan`, `tgl_lahir`, `jenis_kel`, `pangkat`, `pendidikan`, `username`, `password`, `no_telp`, `email`, `role`, `created_at`) VALUES
(1, '99999999', 'Administrator', '3', NULL, NULL, NULL, NULL, NULL, 'admin', '$2y$10$PL.ZKHW1jDPufj1yKhxc6OXKIHseo/4b0LEs8PuNtiSch/AxJ2Mpa', NULL, NULL, 'ADMIN', '2022-03-04'),
(26, '198008042003121007', 'Budi Setiawan', 'IV/a', 'Kepala BSPJI Banjarbaru', '4 Agustus 1980', 'Laki-Laki', 'Pembina', 'S2', '198008042003121007', '$2y$10$mR6PzpMW27gW4Z2/x9Qja.k5BsLHrViZlhYT1sB.9TCfq46Tq5uFO', '0811309243', 'budi-s@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(27, '198402022009112001', 'Farida Hasanah', 'III/c', 'Kepala Subbagian Tata Usaha', '02/02/1984', 'Perempuan', 'Penata  ', 'S2', '198402022009112001', '$2y$10$DX6tIc8IrasruVGZxmYJHeQD9NP8v6sS.YHLeYcp3R0f8LuHN0OIK', '081253956222', 'farida@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(28, '196907211990031004', 'Andi Gunadi', 'III/c', 'Arsiparis Mahir', '21/07/1969', 'Laki-Laki', 'Penata  ', 'SLTA', '196907211990031004', '$2y$10$cb6MHK4kMm9sysbGeDWeh.0Rv8z7X0rf8QjUbMMaKKEeGT1LaKnk.', '081345319712', 'andigunadi@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(29, '197209221996032001', 'Siti Faridah', 'III/c', 'Pranata Keuangan APBN Penyelia', '22/09/1972', 'Perempuan', 'Penata ', 'D3', '197209221996032001', '$2y$10$w/STxXRleZyC7modVxg/9uoBnE9tA3eyvpYZxppYMay5cDmTLXmT2', '08125044416', 'siti.faridah@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(30, '197312242002121005', 'Mangatas Siregar', 'III/d', 'Analis Data dan Informasi', '24/12/1973', 'Laki-Laki', 'Penata Tk. I', 'S1', '197312242002121005', '$2y$10$3un3MKbYUVHcaH5Ij8m3i.4UF4EC9.17mYkUkbf1HQ9rei.vnhvPS', '081251059105', 'msiregar@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(31, '197610102002122002', 'Endang Gembirawati', 'III/c', 'Pranata Keuangan APBN Penyelia', '10/10/1976', 'Perempuan', 'Penata  ', 'D3', '197610102002122002', '$2y$10$PARMVEX2/1u8Gy2hdxlbSOlBw4P9hUhZijZ7ppzzAAUh0Jxc/E76K', '081251305222', 'endang-g@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(32, '197812242002121002', 'M. Isa Anshari', 'III/a', 'Pengelola BMN', '24/12/1978', 'Laki-Laki', 'Penata Muda', 'SLTA', '197812242002121002', '$2y$10$7NleHTKNnnwcgO6tuT5Sw.AAkO/omQrtIu5xmu93mS5nXvhnO03R6', '085386111819', 'isa.an@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(33, '198403282009101002', 'Muntashir Rakhman', 'III/b', 'Arsiparis Ahli Pertama', '28/03/1984', 'Laki-Laki', 'Penata Muda Tk. I', 'S2', '198403282009101002', '$2y$10$11Hx7TFB2j/X/przT2s9ouVXsGi.9FJB3OwfUT9G7qCC8SdW7L3ke', '085249996209', 'muntashirrakhman@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(34, '198702092010121002', 'Muhamad Ridwan', 'III/a', 'Pengelola BMN', '09/02/1987', 'Laki-Laki', 'Penata Muda', 'D3', '198702092010121002', '$2y$10$kJTXMjOpZ0P7Z3ZjndvQLewrYFf5eqWOUQ84pS74BJyNFKHwHay8W', '085387635604', 'ridwan@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(35, '198803012014022001', 'Fika Kurniawati', 'III/b', 'Analis Data dan Informasi', '01/03/1988', 'Perempuan', 'Penata Muda Tk. I', 'S1', '198803012014022001', '$2y$10$niD3nWxzn2kLvUk8P3eyDe/wLqwUGfljnyec6x7iHKrcdanh3LYS6', '081346808866', 'fika_k@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(36, '199612292020121003', 'Muhammad Khalish Hafizh', 'III/a', 'Analis Rencana Program dan Kegiatan', '29/12/1996', 'Laki-Laki', 'Penata Muda', 'S1', '199612292020121003', '$2y$10$I/FMvSWBpBPWGwVOYwJwZOwPa4gX8oTi5pI/yA.DnOL6RDT0jI.Ju', '085959668185', 'khalish@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(37, '199008122019011001', 'Muhammad Khairul Dzakirin', 'III/a', 'Penata Laporan Keuangan', '12/08/1990', 'Laki-Laki', 'Penata Muda', 'S1', '199008122019011001', '$2y$10$Ooz6VjXNWb9ypCK5WpfiXeR5Rez8x9yzJLSm2qubKMyO3KGM16/Pu', '081333184986', 'khairul-dzakirin@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(38, '199210182018011002', 'Wahid Adhi Suryawan', 'II/c', 'Penata Laksana Barang Terampil', '18/10/1992', 'Laki-Laki', 'Pengatur', 'D3', '199210182018011002', '$2y$10$74vYwg6vVbbvIREmV6j.VeN/jmZ12u/9RdhPDia6d7Y/1dQiVOJ3.', '083819921582', 'adhisuryawan@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(39, '199502232022022002', 'Mega Rahmadani', 'III/a', 'Analis Pengembangan Kompetensi', '23/02/1995', 'Perempuan', 'Penata Muda', 'S1', '199502232022022002', '$2y$10$dhqII2WGa4DrKDNgRCwVZ.nmexkMEbLKuKu31qSY/pzNwKWkHVu3.', '082141721933', 'megarhma@gmail.com', 'PEGAWAI', '2022-05-21'),
(40, '199902082019121001', 'Taufik Riyadi', 'II/a', 'Pengadministrasi Keuangan', '08/02/1999', 'Laki-Laki', 'Pengatur Muda', 'D1', '199902082019121001', '$2y$10$MU9VJ.xoVK3dY79QnGGZv.mHmIC1rK0mRaUcSE5qW3NnBBqAhhSse', '083898276849', 'taufikriyadi@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(41, '199907312022012001', 'Aurel Widya Ningsih', 'II/c', 'Pranata Keuangan APBN Terampil', '31/07/1999', 'Perempuan', 'Pengatur', 'D3', '199907312022012001', '$2y$10$x1L2mwo4MtFW7qZ0DxGTJuIMG7ui8xngiW5H5UHqjP4PV1V7ug/P.', '081347986681', 'aurelwn@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(42, '199909022022011001', 'Muhammad Very Ferdiansa', 'II/c', 'Pranata Keuangan APBN Terampil', '02/09/1999', 'Perempuan', 'Pengatur', 'D3', '199909022022011001', '$2y$10$/BWlPy/6dMMEoIFMnLdt5OUtp8NYXuqbHZFZZZBQJAsuCABuRcIWi', '089637629758', 'mveryfedriansa@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(43, '199912292022011007', 'Devan Surya Adrian', 'II/c', 'Pengadministrasi Keuangan', '29/12/1999', 'Laki-Laki', 'Pengatur', 'D3', '199912292022011007', '$2y$10$6VUzV9Zw0u0qOnwlZ493wOrelHykimtskso2ffMzh7pTw0YdsZTqu', '081328296454', 'devansa@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(44, '198905302015021004', 'Hamlan Ihsan', 'III/b', 'Peneliti Ahli Pertama', '30/05/1989', 'Laki-Laki', 'Penata Muda Tk. I', 'S1', '198905302015021004', '$2y$10$EGK2A9lFtPb4rkJWBlHQeeHWhIO5fW1YwL.IQ9Bt3g7zCKiXppxWG', '082155614646', 'hamlanihsan@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(45, '196310051985021001', 'Miyono', 'IV/a', 'Perekayasa Ahli Madya', '05/10/1963', 'Laki-Laki', 'Pembina', 'S1', '196310051985021001', '$2y$10$CrqGttg5M2jDI3SG8kA08OdSzN1geX4qMSzw9HVzmhwEtfq..rEge', '081351826601', 'miyono@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(46, '196308151985031004', 'Saibatul Hamdi', 'III/d', 'Perekayasa Ahli Madya', '15/08/1963', 'Laki-Laki', 'Penata Tk. I', 'S2', '196308151985031004', '$2y$10$1B08UhkWKu5C/YXxZ5/9iODnMrfV0tqWdPQaL4qlAGQkEEmjmM6CG', '087704430385', 'saibatulhamdi@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(47, '197107072002121002', 'Budi Tri Cahyana', 'III/c', 'Perekayasa Ahli Muda', '07/07/1971', 'Laki-Laki', 'Penata', 'S1', '197107072002121002', '$2y$10$Ivbg3nPdSbkzosJ/M9jBE.XkP.TGJemsBbkMyAH4Uvxf2SGmDw6mm', '085248623210', 'budi3cahyana@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(48, '197409092003122003', 'Nazarni Rahmi', 'III/d', 'Peneliti Ahli Muda', '09/09/1974', 'Perempuan', 'Penata Tk. I', 'S3', '197409092003122003', '$2y$10$376FVAcvlwdn4ox4MpyMBOq.xz1y3i9VdYiag4zQeI.FLLLYxI4tW', '08152137489', 'n.rahmi@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(49, '198203252005022001', 'Evy Setiawati', 'III/d', 'Peneliti Ahli Muda', '25/03/1982', 'Perempuan', 'Penata Tk. I', 'S3', '198203252005022001', '$2y$10$fa9Ryg9xpaci0dtvsrhkHe7c42CoE3JE3leaBa7IQMjvtVwkH/8Ye', '081933770550', 'e-stiawati@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(50, '198112032006042004', 'Desi Mustika Amaliyah', 'III/c', 'Peneliti Ahli Muda', '03/12/1981', 'Perempuan', 'Penata', 'S2', '198112032006042004', '$2y$10$XUlu7Xi9QR6au9GLwEiMIuyuNa1rLV1jC9ZQqApLLkyStTjzW6K2e', '081332403090', 'desi-m@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(51, '198512222009012006', 'Nurhidayati', 'III/c', 'Peneliti Ahli Muda', '22/12/1985', 'Perempuan', 'Penata', 'S2', '198512222009012006', '$2y$10$1TF6ppHUQtlA4HN/VJZc5OTfMJwUCMoQAVOnGa46Qyn.ks.j134X6', '081321773430', 'titi-n@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(52, '198611302014021001', 'Rais Salim', 'III/b', 'Peneliti Ahli Pertama', '30/11/1986', 'Laki-Laki', 'Penata Muda Tk. I', 'S1', '198611302014021001', '$2y$10$twid8CQwjMjRLCYBo4z5eOi4RP.IrhuOr9laIxBq5c5VEfMY3oEvK', '085251733281', 'raissalim@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(53, '199003192014021001', 'I Dewa Gede Putra Prabawa', 'III/b', 'Peneliti Ahli Pertama', '19/03/1990', 'Laki-Laki', 'Penata Muda Tk. I', 'S1', '199003192014021001', '$2y$10$xuJpKRepAuYKnIWJAUtToOXx7LwFW4MdXU6UXI3M7uyf7sUPkkewi', '082254993919', 'dewaprabawa@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(54, '199005252015022001', 'Nadra Khairiah', 'III/b', 'Peneliti Ahli Pertama', '25/05/1990', 'Perempuan', 'Penata Muda Tk. I', 'S1', '199005252015022001', '$2y$10$VQm/IeAnirDlm0ESXj8jneuPIDSpaNdQ1ytADjwRDT1wPXxbuu8BG', '082170076616', 'nadrakhairiah@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(55, '199006302018011001', 'Mohammad Listianto Raharjo', 'III/a', 'Peneliti Ahli Pertama', '30/06/1990', 'Laki-Laki', 'Penata Muda', 'S1', '199006302018011001', '$2y$10$J5c8IW8ZBs3W5uYBdZUrNOaKdc2frROidKLShNDD397d22VxwltpO', '085730159291', 'listianto@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(56, '199505282022022001', 'Khairul Fauziah Hanisa', 'III/a', 'Perekayasa Ahli Pertama', '28/05/1995', 'Perempuan', 'Penata Muda', 'S1', '199505282022022001', '$2y$10$nG6u/N1oD2wIV8Dw/bT9f.ogpRjOLjo/jPQac7L7rqb2.6qUJ44SC', '085157811852', 'kf.hanisa@gmail.com', 'PEGAWAI', '2022-05-21'),
(57, '199310112022021001', 'Muhammad Kendar Oktansyah', 'III/a', 'Perekayasa Ahli Pertama', '11/10/1993', 'Laki-Laki', 'Penata Muda', 'S1', '199310112022021001', '$2y$10$CEPFsGHp2/b0fu.mOPBFN.wYmDg0N92qY5Nvj8Vmtf3YVoZiRZLbe', '085751045960', 'oktansyahkendar@gmail.com', 'PEGAWAI', '2022-05-21'),
(58, '197709022005022002', 'Dewi Susilawati', 'III/c', 'Asesor Manajemen Mutu Industri Ahli Muda', '02/09/1977', 'Perempuan', 'Penata', 'S1', '197709022005022002', '$2y$10$3vQFedmfgemJbXlJsQ9mNun8AhNbcqo/rsY76pTweBTLxWzb/ImP.', '085249539239', 'dewi-s@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(59, '197811112005022001', 'Sri Hidayati', 'III/b', 'Penguji Mutu Barang Ahli Pertama', '11/11/1978', 'Perempuan', 'Penata Muda Tk. I', 'S1', '197811112005022001', '$2y$10$onNhOURKdA.007z5y9LeAOodWj6e9hcf03Jd2MzbZKWd/EceICX16', '082250324682', 'srihidayati@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(60, '196406271984032002', 'Endang Sriningsih', 'III/d', 'Teknisi Litkayasa Penyelia', '27/06/1964', 'Perempuan', 'Penata Tk. I', 'SLTA', '196406271984032002', '$2y$10$OAUEHKHy./fHyyL0igtkTuBLfHOCMayV4c9lK8.XedpRG.SdV3Zse', '082153585054', 'endang.sriningsih@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(61, '198507142009012002', 'Fitri Yuliati', 'III/b', 'Penguji Mutu Barang Ahli Pertama', '14/07/1985', 'Perempuan', 'Penata Muda Tk. I', 'S1', '198507142009012002', '$2y$10$divblWoAnGsVRzxkEeNyb.qk7yYEd8W9rGSzSu9c4eUxz9Nz18EE6', '081323063579', 'fitri-y@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(62, '198909142014022001', 'Nurmilatina', 'III/b', 'Teknisi Litkayasa Mahir', '14/09/1989', 'Perempuan', 'Penata Muda Tk. I', 'S1', '198909142014022001', '$2y$10$AHBzfDehEpWQErPiKZD5OulIlb3ZL6krF66w./nf4Tr//y7ldW3dK', '085349745018', 'nurmilatina@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(63, '198604132018011001', 'Muses Aprilus', 'III/a', 'Penguji Mutu Barang Ahli Pertama', '13/04/1986', 'Laki-Laki', 'Penata Muda', 'S1', '198604132018011001', '$2y$10$U1KFT0OjOH.gPPBTZpDrgOkI54f3EyrSypV3eSfzS60quEC6R9kWa', '085252792878', 'muses@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(64, '199511122019011002', 'Ridla Nor Hadi', 'III/a', 'Asesor Manajemen Mutu Industri Ahli Pertama', '12/11/1995', 'Laki-Laki', 'Penata Muda', 'S1', '199511122019011002', '$2y$10$jq.f4qzZ8bMb0IaH3BHPE.ochrPivj8DTHvv8q5NzPhW24hDAvB4K', '081253340079', 'ridlanorhadi@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(65, '199604212020122003', 'Kartika Inderiani', 'III/a', 'Penguji Mutu Barang Ahli Pertama', '21/04/1996', 'Perempuan', 'Penata Muda', 'S1', '199604212020122003', '$2y$10$KRh3ROxlcpSsOZuxeOf2HuD5vm/NjUdOlSnqeG1c52BD14scjiyGG', '082211399599', 'kartikainderiani@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(66, '199708282022021002', 'Galang Rohidi', 'II/c', 'Penguji Mutu Barang Terampil', '28/08/1997', 'Laki-Laki', 'Pengatur', 'D3', '199708282022021002', '$2y$10$mTv794DA1vOBFURG3MLcceHQ60l1jImoGDuma7xFvL7S2ZpZWxUUS', '081293656210', 'galangrohidi1@gmail.com', 'PEGAWAI', '2022-05-21'),
(67, '199801152022021001', 'Hanif Ilham Ramadhan Fatriansyah', 'III/a', 'Asesor Manajemen Mutu Industri Ahli Pertama', '15/01/1998', 'Laki-Laki', 'Penata Muda', 'S1', '199801152022021001', '$2y$10$id/h2TY3v/DdyHmqJhqOKuMPSQC2kJT.vv7gbLve2p9.t.TllGZnW', '081273050738', 'Hanifilham15@gmail.com', 'PEGAWAI', '2022-05-21'),
(68, '199602172022022001', 'Happy Rizky Cindyawati', 'II/c', 'Penguji Mutu Barang Terampil', '17/02/1996', 'Perempuan', 'Pengatur', 'D3', '199602172022022001', '$2y$10$ym0hSoFUeokpuSOc31R3CeE5uJwx0wNFimQEFZMGlHeb/08QvWfre', '085772340340', 'Happyrizky02@gmail.com', 'PEGAWAI', '2022-05-21'),
(69, '197907172005022001', 'Rufida', 'III/a', 'Penguji Mutu Barang Terampil', '17/07/1979', 'Perempuan', 'Penata Muda', 'D3', '197907172005022001', '$2y$10$J6tVJF03rutAwatsMTfoj.Z8SYTYnQN6ZLDGzP6VdYfLugnlRmU7C', '081348201453', 'rufida@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(70, '198210072006042020', 'Chatimatun Nisa', 'III/b', 'Penguji Mutu Barang Ahli Pertama', '07/10/1982', 'Perempuan', 'Penata Muda Tk. I', 'S1', '198210072006042020', '$2y$10$29SzkRmqNTPqwhywxZCQJekVGC79oGiPCMsgIgOzablxTdlxhK5TS', '081349672370', 'chatimatunnisa@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(71, '197010011994032002', 'Retno Utami Purbaningtyas', 'III/d', 'Pengendali Dampak Lingkungan Ahli Muda', '01/10/1970', 'Perempuan', 'Penata Tk. I', 'S1', '197010011994032002', '$2y$10$vKINs4OAIgrdb.r1ctSt0e5I1UB50Oidj6vB3wA6M6.bgz0NfXZYO', '082245412998', 'retnoutami@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(72, '197310271994032002', 'Santy Diah Suryani', 'III/c', 'Pengendali Dampak Lingkungan Ahli Muda', '10/27/1973', 'Perempuan', 'Penata', 'S1', '197310271994032002', '$2y$10$LAuJKj9Z0vf4kQzMTcjV2Ony7JdqC4VioTXGxMOzjqWsDFCXUOnhm', '081348616162', 'santydiahsuryani@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(73, '197405141994032001', 'Rosnaeni', 'III/c', 'Pengendali Dampak Lingkungan Ahli Muda', '14/05/1974', 'Perempuan', 'Penata  ', 'S1', '197405141994032001', '$2y$10$WQ.L2hVYNFJJE0WqoH76j.j/RbJ22HvyRW5HX86ycUxmxXkL/Z9h.', '08115128294', 'rosnaeni@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(74, '197911162005021006', 'Panji Saputra', 'III/c', 'Pengendali Dampak Lingkungan Ahli Muda', '16/11/1979', 'Laki-Laki', 'Penata', 'S1', '197911162005021006', '$2y$10$ZFf9shYsn8L4tXqFtWHCBuZll2ARjP08gnXKuwcJvPSs1vpbgWdb2', '085248256755', 'panji-s@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(75, '198006212006042003', 'Rinne Nintasari', 'III/b', 'Penguji Mutu Barang Ahli Pertama', '21/06/1980', 'Perempuan', 'Penata Muda Tk. I', 'S1', '198006212006042003', '$2y$10$HBCSsKWs2AzE8/v5.fB2fuIEqfE9s73FfnAUK8U1cVI/bQ5GLILj2', '081251962444', 'rinneninta@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(76, '197110171993031003', 'Nurdin', 'III/b', 'Penguji Mutu Barang Ahli Pertama', '17/10/1971', 'Laki-Laki', 'Penata Muda Tk. I', 'S1', '197110171993031003', '$2y$10$yJ5AxhFzeoPdQYvwzvqmp..fTgDhKN19oWzad9LhfNlcwjq7QlCNG', '085250322201', 'nurdin@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(77, '198410022008031002', 'Handrian Syahputra Siregar', 'III/a', 'Penguji Mutu Barang Terampil', '02/10/1984', 'Laki-Laki', 'Penata Muda', 'D3', '198410022008031002', '$2y$10$QrLxgiXTEn4aWabwnFO9RuCPLnMEXNS/iWleqmPSD5wePPysbhTuK', '081370371110', 'handrian@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(78, '198710112010121001', 'Diky Subhanuddin', 'III/a', 'Penguji Mutu Barang Ahli Pertama', '11/10/1987', 'Laki-Laki', 'Penata Muda', 'S1', '198710112010121001', '$2y$10$nJOi08z1uSkPYNqqZyLYM.leIAdt40m1akxKqD9veaZ2Zz5pwY6yi', '085393295255', 'diky@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(79, '199404152018011002', 'Afandy Bayu Nurcahyo', 'III/a', 'Penguji Mutu Barang Ahli Pertama', '15/04/1994', 'Laki-Laki', 'Penata Muda', 'S1', '199404152018011002', '$2y$10$UKuzAWzPB0jQNk6eGqO91ONKDGuHJXqs63rZXDiS3wuR0MkgPobmm', '085655006959', 'afandybayu@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(80, '199304202019011001', 'Noor Irawan', 'III/a', 'Teknisi Litkayasa Terampil', '20/04/1993', 'Laki-Laki', 'Penata Muda', 'D3', '199304202019011001', '$2y$10$qxQc5L/1i4dC1ubEJGdNAuoYXDdRKQUU52KCTFr5KPz/BtwkaaXm6', '085212565634', 'nrirawan@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(81, '199605292020121005', 'Mochamad Fathi Rizqullah', 'III/a', 'Penguji Mutu Barang Ahli Pertama', '29/05/1996', 'Laki-Laki', 'Penata Muda', 'S1', '199605292020121005', '$2y$10$HryF/uMpcvDTo3y6CKqdc.8CbTSvjIM6QIHctbiXext371pzSF61a', '082227551950', 'fathi-fr@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(82, '199804152022021002', 'M. Aswar Zulhi', 'II/c', 'Penguji Mutu Barang Terampil', '15/04/1998', 'Laki-Laki', 'Pengatur', 'D3', '199804152022021002', '$2y$10$4nnAp0ZK2uToALII3d4fI.I/dddjJl3ppXbrrgo1/lvcT0r77gF62', '081341972747', 'Aswarzulhi@gmail.com', 'PEGAWAI', '2022-05-21'),
(83, '199212232022022001', 'Hariaty Tandi Sobon', 'II/c', 'Penguji Mutu Barang Terampil', '23/12/1992', 'Perempuan', 'Pengatur', 'D3', '199212232022022001', '$2y$10$2shxmJAM41lEbW23DsB4k.Z/7ryravKTai741v9Sv.WILkdOKpqvq', '082344643372', 'hariatytandisobon@ymail.com', 'PEGAWAI', '2022-05-21'),
(84, '199510242022021003', 'Hafiz Atma Sasmita', 'II/c', 'Penguji Mutu Barang Terampil', '24/10/1995', 'Laki-Laki', 'Pengatur', 'D3', '199510242022021003', '$2y$10$tzzaECpPgt6LeHxU2TjktOH5ItL614cliY4A5TsdD0MnflJEZS.X2', '082140000097', 'Hafizatmasasmita@gmail.com', 'PEGAWAI', '2022-05-21'),
(85, '199809202022021001', 'Yanga Perwira', 'III/a', 'Analis Standardisasi Industri', '20/09/1998', 'Laki-Laki', 'Penata Muda', 'S1', '199809202022021001', '$2y$10$BXrsUHsDcj.h6u2wwc1O3e50XXST8hXZ1hUBtXoOnCLjzQM.3dbJO', '089519761085', 'yangaperwira8@gmail.com', 'PEGAWAI', '2022-05-21'),
(86, '197604122002121008', 'Aslan Prayudi', 'III/d', 'Analis Pengelolaan Keuangan APBN Ahli Muda', '12/04/1976', 'Laki-Laki', 'Penata Tk. I', 'S1', '197604122002121008', '$2y$10$g43x8KzIc.ovRzOAsIlwXuFLiMRDBxVH68.ndvhrpsaMRr/v78Et2', '081251305111', 'a-prayudi@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(87, '196701261996031001', 'Yanuarianto', 'III/d', 'Pemelihara Sarana dan Prasarana', '26/01/1967', 'Laki-Laki', 'Penata Tk. I', 'S1', '196701261996031001', '$2y$10$KjCpNY.5Ktog7h9/9qoTQeYPnoUmoq1/y2IzvrddFi1vEsW0MRzNy', '081348597989', 'yanuariantoir@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(88, '198009282006041004', 'Dwi Harsono', 'III/b', 'Peneliti Ahli Pertama', '28/09/1980', 'Laki-Laki', 'Penata Muda Tk. I', 'S1', '198009282006041004', '$2y$10$8sbdDdjS.BAQS4KekJqg.O1TG9oO6ZciqLFlYj/wjyV4L3.7y1pqe', '081349430423', 'dwi-h@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(89, '198602202018012001', 'Faiza Elisa Hasfianti', 'III/b', 'Peneliti Ahli Pertama', '20/02/1986', 'Perempuan', 'Penata Muda Tk. I', 'S1', '198602202018012001', '$2y$10$29v9akPDM4TIAtpuemmksO1HwkBxF0BsReAF2TPcUtdtM1xrcmjcK', '082148204734', 'faizaelisa@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(90, '198204202005021001', 'Muhammad Sobirin', 'III/c', 'Pengelola Pemasaran', '20/04/1982', 'Laki-Laki', 'Penata', 'D3', '198204202005021001', '$2y$10$L/trSjh0I4B2aZlhz6a1jefdr5qnavAN797g.n5th6lcMI5T7dQVS', '0811503016', 'sobirin-em@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(91, '198908142018011002', 'Vembi Danang Nuryuono', 'II/c', 'Pengelola Pemasaran', '14/08/1989', 'Laki-Laki', 'Pengatur', 'D3', '198908142018011002', '$2y$10$RcFfRe/AFSOUfYI/Y8PhQ.PWREIciz09Tifqx9Jo7EuNAFS32VDeO', '081316413261', 'vembidn@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(92, '197602202002121006', 'Anhar Firdaus', 'III/c', 'Pengadministrasi Contoh Uji', '20/02/1976', 'Laki-Laki', 'Penata', 'S1', '197602202002121006', '$2y$10$KZBR3jg/af9NRcdBTTwQNuH456so99pwNV6wvoQXYcBbB9e/x9gE.', '08115002076', 'anhar@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(93, '199503052022021001', 'Abdul Qodir', 'III/a', 'Analis Kerjasama Industri', '05/03/1995', 'Laki-Laki', 'Penata Muda', 'S1', '199503052022021001', '$2y$10$pba5bFhdsroo7lSG/RUdUOyVrW9tk5XUIIClJjKC09UgHlF0Rh6SS', '082330535367', 'abdul.qodir5395@gmail.com', 'PEGAWAI', '2022-05-21'),
(94, '199905262022022001', 'Jojor Kakanda Purba', 'III/a', 'Analis Kerjasama Industri', '26/05/1999', 'Perempuan', 'Penata Muda', 'S1', '199905262022022001', '$2y$10$bNxLzMZGbcE9iJ0iANGVre.RebGFcSC0HdkTdus2/BTU5fWfHWESq', '082332845998', 'jojorkakandapurba@gmail.com', 'PEGAWAI', '2022-05-21'),
(95, '196708072008111001', 'Abdul Hair', 'II/d', 'Pengadministrasi Contoh Uji', '07/08/1967', 'Laki-Laki', 'Pengatur Tk. I', 'SLTA', '196708072008111001', '$2y$10$UxAKeGRQZQjOnzni8zXmS.j79NzxqkiNvtK3t8IBW3g2vikMQBNJi', '082154670451', 'abdulhair@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(96, '196907262008111001', 'Bakat', 'II/b', 'Pramu Bakti', '26/07/1969', 'Laki-Laki', 'Pengatur Muda Tk. I', 'SLTA', '196907262008111001', '$2y$10$5KME64NYSOSm2yygw5WCo.Q1QBJw3esGGWgpmuO1jna38wjF1OIla', '081351306227', 'bakat@kemenperin.go.id', 'PEGAWAI', '2022-05-21'),
(97, '90781211010067', 'Mahmud Al Ansari', '-', 'Driver/Pelaksana Pemeliharaan Kendaraan Dinas', '05/12/1978', 'Laki-Laki', '-', 'S1', '90781211010067', '$2y$10$L4BUYXRMYdGS1mZTXUHnceea.d0/g8Im9j21G1t8CyzKt/m8Y6UJS', '082148802676', 'mahmud.bbm77@gmail.com', 'PEGAWAI', '2022-05-21'),
(98, '90930319020998', 'Dhea Nur Sindy', '-', 'Keuangan Penerimaan', '30 Maret 1993', 'Perempuan', '-', 'S1', '90930319020998', '$2y$10$5oP9RhR4nq8apMIkmN/EJet9vgy8PYJQ202i/krFLQgDOk.YssQUq', '085751602997', 'dheanursindy93@gmail.com', 'PEGAWAI', '2022-05-22'),
(99, '90860319020997', 'Aria Khadafie', '-', 'Keuangan Pengeluaran', '25 Maret 1986', 'Laki-Laki', '-', 'S1', '90860319020997', '$2y$10$XRKAEsME6DY.zFMAAtQNjOWpOb46LBpe925XC0mV5fwdFsRgNsCGW', '085933638140', 'akhadafie4@gmail.com', 'PEGAWAI', '2022-05-22'),
(100, '90770315010744', 'Renny Windriyantie', '-', 'Kesekretariatan Pimpinan', '27 Maret 1977', 'Perempuan', '-', 'SMA', '90770315010744', '$2y$10$bJzLWiH0pbhXme0zVvd4ZOGJq9PwW4hRLaFihoh.D7iierJ94EQza', '085233382659', 'renny.windriyantie@gmail.com', 'PEGAWAI', '2022-05-22'),
(101, '90950519020993', 'Muhammad Rihardi Fiqli', '-', 'Analis Laboratorium', '23 Mei 1995', 'Laki-Laki', '-', 'D3', '90950519020993', '$2y$10$2attnPKxlzJ/tgeiujea3.Qs0.IANu.KI4sm2vT5/K8w9MTh/nyZy', '085787199169', 'Fiqly23@gmail.com', 'PEGAWAI', '2022-05-22'),
(102, '90961219020992', 'Neneng Rizkiah', '-', 'Analis Laboratorium', '21 Desember 1996', 'Perempuan', '-', 'D3', '90961219020992', '$2y$10$Q.PRxg3GfeOIdDDw5MAp6.ELvvRDjMJAGc1k60PsHjjenFzs9AWHC', '085821866263', 'nenengrizkiah40@gmail.com', 'PEGAWAI', '2022-05-22'),
(103, '90960815020278', 'Anisa Risdamayanti', '-', 'Laboran', '1 Agustus 1996', 'Perempuan', '-', 'SMA', '90960815020278', '$2y$10$vKnZ7yjKAKX3qWlBcpL9ou6B8ePSoT4P6A..Djp5N.XfT/SbXblsm', '089646373192', 'anisarisda@gmail.com', 'PEGAWAI', '2022-05-22'),
(104, '90951218030999', 'Achmad Ryansyah Yudi', '-', 'Laboran', '5 Desember 1995', 'Laki-Laki', '-', 'SMA', '90951218030999', '$2y$10$uiYvPiBzsiQ/QU9rU2XEe.HF7jmgaz9hPaUvzwfngzgr7q70wzibK', '081345420150', 'achmadryansyahyudi@gmail.com', 'PEGAWAI', '2022-05-22'),
(105, '90920415020276', 'Ariesta Pristia Anggari', '-', 'Front Office', '15 April 1992', 'Perempuan', '-', 'S1', '90920415020276', '$2y$10$.ccpxST4TMv0xaT0BSvqzep7RaI5o/zEtRV9HnxQu4N62JiRv4kuO', '08971474495', 'apanggari@gmail.com', 'PEGAWAI', '2022-05-22'),
(106, '90960518030991', 'Ahmad Riduwan', '-', 'Front Office', '17 Mei 1996', 'Laki-Laki', '-', 'SMA', '90960518030991', '$2y$10$sYRwphVccf2Q/NWBoT/PQeex81ld/FHkxQY1Ts0bRB5u3Lh9Eh/J6', '08977241420', 'ahmdrid96@gmail.com', 'PEGAWAI', '2022-05-22'),
(107, '094000001', 'Supriyadi', '-', 'Security', '10 Desember 1975', 'Laki-Laki', '-', 'SMA', '094000001', '$2y$10$Jw.isrl.W331RJmy59UhveeCmBXgh5Cc.0q0dbT/3Hqdh5z3RvKEu', '085249378182', 'supriadibrsbb@gmail.com', 'PEGAWAI', '2022-05-22'),
(108, '094000003', 'Hendi Eka Pratama Atmaja', '-', 'Security', '14 November 1981', 'Laki-Laki', '-', 'SMA', '094000003', '$2y$10$fzid/hJ9qCxVz/WnRqTgEO3e5jtH1qZKWZNJ8psu7cbcUvDSTPCD2', '085828327081', 'hendipratama818@gmail.com', 'PEGAWAI', '2022-05-22'),
(109, '094000006', 'Eru Cakra', '-', 'Security', '6 Juli 1990', 'Laki-Laki', '-', 'SMA', '094000006', '$2y$10$u9tJcvqiR6UBJbso/eiCK.We5bQiwyXipeRmDkq5tg9MocX.8OTsy', '087749561764', 'aburumaisha7690@gmail.com', 'PEGAWAI', '2022-05-22'),
(110, '094000004', 'Hasan Basri', '-', 'Security', '3 Juni 1994', 'Laki-Laki', '-', 'SMA', '094000004', '$2y$10$8ZkHKI3oED6QPcpRRWR7c.LQQlLRmMi8sWXW2xaTrqNUTAxAyXXSO', '083159536388', 'hb603477@gmail.com', 'PEGAWAI', '2022-05-22'),
(111, '094000005', 'Hakim Noprianto', '-', 'Security', '23 November 1985', 'Laki-Laki', '-', 'SMA', '094000005', '$2y$10$nk2n6TJX5qE3Osp7V5p6oukT/XjdPPiRPxyZREAe/xcK23qBEsdY2', '081255224663', 'hakiem.n8@gmail.com', 'PEGAWAI', '2022-05-22'),
(112, '093000003', 'Nanik Suryani', '-', 'Cleaning Service', '10 Juni 1978', 'Perempuan', '-', 'SMA', '093000003', '$2y$10$4/PIpKcVQ5sp48zOHUa1huWHB5aBBk8z2yLj1QpH2swelBa4NSmWm', '083155861031', 'naniksryn13@gmail.com', 'PEGAWAI', '2022-05-22'),
(113, '093000016', 'Lea Sandra', '-', 'Cleaning Service', '11 September 1995', 'Laki-Laki', '-', 'SMA', '093000016', '$2y$10$MQsFh2s.EXs8W1d5KNOgEey.wz.YmoQy44k3Z9HZQyrE4wgyCj9ru', '085849372841', 'leasandra24@gmail.com', 'PEGAWAI', '2022-05-22'),
(114, '093000018', 'Achmad Arief Setiawan', '-', 'Cleaning Service', '11 Juni 2002', 'Laki-Laki', '-', 'SMA', '093000018', '$2y$10$fFQEdgWe9a4.oQoXGvik8eBWBAIXZY7eTbxxIDSQDJWqnefvIKSAC', '085754126014', 'ariefozom@gmail.com', 'PEGAWAI', '2022-05-22'),
(115, '093000017', 'Muhammad Hamzah Al Muluk', '-', 'Cleaning Service', '12 September 2000', 'Laki-Laki', '-', 'SMA', '093000017', '$2y$10$1.ij.0VmQYmeW4sKibhaauBnFmM0BJ1hPxDA.e7xGA8qWdzQ4r9c6', '0895700898359', 'mhamzahalmlk@gmail.com', 'PEGAWAI', '2022-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `whistleblowing`
--

CREATE TABLE `whistleblowing` (
  `id` int(11) NOT NULL,
  `pelapor` varchar(200) NOT NULL,
  `nama_pelaporan` varchar(200) NOT NULL,
  `instansi` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `judul_laporan` varchar(100) NOT NULL,
  `uraian_laporan` text NOT NULL,
  `data_dukung` varchar(255) NOT NULL,
  `pelanggaran` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `whistleblowing`
--

INSERT INTO `whistleblowing` (`id`, `pelapor`, `nama_pelaporan`, `instansi`, `alamat`, `email`, `telepon`, `judul_laporan`, `uraian_laporan`, `data_dukung`, `pelanggaran`, `tanggal`) VALUES
(14, '198402022009112001', 'Farida Hasanah (091099640) ', 'Baristand Industri Banjarbaru', 'Jl Panglima Batur Barat No.2\r\nBanjar Baru Utara', 'farida_hasanah@ymail.com', '081253956222', 'Laporan dugaan pelanggaran terhadap peraturan', 'pegawai atas nama XXX melakukan kerjasama dengan pihak rekanan dan berjanji akan membantu hasil uji laboratorium sesuai dengan batas SPM', 'Rekap Peta Jabatan_Biro Hukum.pdf', 'Pelanggaran Terhadap Peraturann', '2022-05-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahan_pengadaan`
--
ALTER TABLE `bahan_pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_perbaikan`
--
ALTER TABLE `barang_perbaikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gratifikasi`
--
ALTER TABLE `gratifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_penerimaan` (`jenis_penerimaan`),
  ADD KEY `jenis_peristiwa` (`jenis_peristiwa`),
  ADD KEY `pelapor` (`pelapor`);

--
-- Indexes for table `ijin_keluar`
--
ALTER TABLE `ijin_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemohon` (`pemohon`),
  ADD KEY `pejabat_validasi` (`pejabat_validasi`);

--
-- Indexes for table `ijin_lembur`
--
ALTER TABLE `ijin_lembur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_formulir`
--
ALTER TABLE `m_formulir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jenis_pelanggaran`
--
ALTER TABLE `m_jenis_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jenis_penerimaan`
--
ALTER TABLE `m_jenis_penerimaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jenis_peristiwa`
--
ALTER TABLE `m_jenis_peristiwa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip_pemohon` (`nip_pemohon`),
  ADD KEY `nip_atasan` (`nip_atasan`),
  ADD KEY `nip_penanggung` (`nip_penanggung`),
  ADD KEY `nip_penanggung_2` (`nip_penanggung`);

--
-- Indexes for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip_ditugaskan` (`nip_ditugaskan`),
  ADD KEY `pemohon` (`pemohon`),
  ADD KEY `pengusul` (`pengusul`);

--
-- Indexes for table `tbahan`
--
ALTER TABLE `tbahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbarang`
--
ALTER TABLE `tbarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `whistleblowing`
--
ALTER TABLE `whistleblowing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelapor` (`pelapor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gratifikasi`
--
ALTER TABLE `gratifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ijin_keluar`
--
ALTER TABLE `ijin_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ijin_lembur`
--
ALTER TABLE `ijin_lembur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `m_formulir`
--
ALTER TABLE `m_formulir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_jenis_pelanggaran`
--
ALTER TABLE `m_jenis_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `m_jenis_penerimaan`
--
ALTER TABLE `m_jenis_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `m_jenis_peristiwa`
--
ALTER TABLE `m_jenis_peristiwa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbahan`
--
ALTER TABLE `tbahan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbarang`
--
ALTER TABLE `tbarang`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `whistleblowing`
--
ALTER TABLE `whistleblowing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gratifikasi`
--
ALTER TABLE `gratifikasi`
  ADD CONSTRAINT `gratifikasi_ibfk_1` FOREIGN KEY (`jenis_peristiwa`) REFERENCES `m_jenis_peristiwa` (`id`),
  ADD CONSTRAINT `gratifikasi_ibfk_2` FOREIGN KEY (`jenis_penerimaan`) REFERENCES `m_jenis_penerimaan` (`id`),
  ADD CONSTRAINT `gratifikasi_ibfk_3` FOREIGN KEY (`pelapor`) REFERENCES `users` (`nip`) ON UPDATE CASCADE;

--
-- Constraints for table `ijin_keluar`
--
ALTER TABLE `ijin_keluar`
  ADD CONSTRAINT `ijin_keluar_ibfk_1` FOREIGN KEY (`pemohon`) REFERENCES `users` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ijin_keluar_ibfk_2` FOREIGN KEY (`pejabat_validasi`) REFERENCES `users` (`nip`) ON UPDATE CASCADE;

--
-- Constraints for table `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD CONSTRAINT `perbaikan_ibfk_1` FOREIGN KEY (`nip_pemohon`) REFERENCES `users` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `perbaikan_ibfk_2` FOREIGN KEY (`nip_atasan`) REFERENCES `users` (`nip`) ON UPDATE CASCADE;

--
-- Constraints for table `surat_tugas`
--
ALTER TABLE `surat_tugas`
  ADD CONSTRAINT `surat_tugas_ibfk_1` FOREIGN KEY (`pemohon`) REFERENCES `users` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_tugas_ibfk_2` FOREIGN KEY (`nip_ditugaskan`) REFERENCES `users` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `surat_tugas_ibfk_3` FOREIGN KEY (`pengusul`) REFERENCES `users` (`nip`) ON UPDATE CASCADE;

--
-- Constraints for table `whistleblowing`
--
ALTER TABLE `whistleblowing`
  ADD CONSTRAINT `whistleblowing_ibfk_1` FOREIGN KEY (`pelapor`) REFERENCES `users` (`nip`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
