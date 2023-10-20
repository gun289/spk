-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2020 pada 12.47
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkold`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `kodematkul` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nim` varchar(50) NOT NULL,
  `pertemuan` int(11) NOT NULL,
  `ket` varchar(4) NOT NULL,
  `status` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT 'administrator',
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'admin',
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `level`, `alamat`, `no_telp`, `email`, `blokir`, `id_session`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'admin', 'Indonesia', '0852', 'admin@gmail.com', 'N', 'akoin2ribmv4cnvmshun5sj8r1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(5) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `id_kelas`, `nama`) VALUES
(1, '71', 'VII-A'),
(2, '81', 'VIII-A'),
(3, '91', 'IX-A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('pengajar','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Type` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`, `Type`) VALUES
(2, 'Manajemen Admin', '?module=admin', '', '', 'N', 'admin', 'N', 2, '', ''),
(37, 'Data Siswa', '?module=siswa', '', 'gedungku.jpg', 'Y', 'admin', 'Y', 1, 'profil-kami.html', ''),
(81, 'Pembobotan Kriteria', '?module=matapelajaran', '', '', 'N', 'admin', 'Y', 5, '', ''),
(78, 'Data Kriteria', '?module=matapelajaran&act=himpunankriteria', '', '', 'Y', 'admin', 'Y', 11, '', ''),
(41, 'Data Kelas', ' ?module=kelas', '', '', 'Y', 'admin', 'Y', 4, 'semua-agenda.html', ''),
(68, 'Laporan Hasil Analisa ', '?module=matapelajaran&act=analisa', '', '', 'Y', 'admin', 'Y', 9, '', 'Report'),
(79, 'Data Klasifikasi', '?module=matapelajaran&act=klasifikasi', '', '', 'Y', 'admin', 'Y', 12, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajar`
--

CREATE TABLE `pengajar` (
  `id_pengajar` int(9) NOT NULL,
  `kodedosen` char(12) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alias_d` varchar(50) NOT NULL,
  `username_login` varchar(100) NOT NULL,
  `password_login` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'pengajar',
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `jabatan` varchar(200) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  `honor` int(11) DEFAULT NULL,
  `npwp` varchar(100) DEFAULT NULL,
  `kewajiban` int(11) DEFAULT NULL,
  `bidang` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `registrasi_siswa`
--

CREATE TABLE `registrasi_siswa` (
  `id_registrasi` int(9) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(50) NOT NULL,
  `password_login` varchar(50) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `th_masuk` varchar(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `id_session_soal` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'siswa'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(9) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(50) NOT NULL,
  `password_login` varchar(50) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `th_masuk` varchar(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `id_session_soal` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'siswa'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nim`, `nama_lengkap`, `username_login`, `password_login`, `id_kelas`, `jabatan`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `nama_ayah`, `nama_ibu`, `th_masuk`, `email`, `no_telp`, `foto`, `blokir`, `id_session`, `id_session_soal`, `level`) VALUES
(1, '001', 'Andinda  Amelia Putri', 'amel', 'e5796cb0dc9d20918634e9b70b2c0fdd', '91', '', 'Penajam', 'Pettung', '2009-09-16', 'P', 'Islam', '', '', '2015', '', '0864', '', 'N', '001', '001', 'siswa'),
(2, '002', 'Aditya Ari Anggara', 'ari', 'f0ba8f9f389484af6f1a6ccc62a645d0', '91', '', 'Penajam', 'Petung', '2008-11-15', 'L', 'Islam', '', '', '2018', '', '0987', '', 'N', '002', '002', 'siswa'),
(3, '003', 'Adriyansyah', 'Adriyansyah', '0e0fe02a84b0e27164223a070d2776e4', '91', '', 'Penajam', 'Petung', '2011-06-22', 'L', 'Islam', '', '', '2016', '', '087', '', 'N', '003', '003', 'siswa'),
(4, '004', 'Agip Pratam', 'Agip Pratam', '32762226793f117735e959c1e9f01be6', '91', '', 'Penajam', 'Petung', '2012-10-22', 'L', '0', '', '', '2015', '', '0987', '', 'N', '004', '004', 'siswa'),
(5, '005', 'Aldi', 'Aldi', '745e83237cf6b17ebfb89d4619e5f35a', '91', '', 'Penajam', 'Petung', '2010-09-15', 'L', 'Islam', '', '', '2016', '', '0864', '', 'N', '005', '005', 'siswa'),
(6, '006', 'Alvin Saputra', 'Alvin Saputra', '3ea4f43c5b718169c11d22914deee060', '91', '', 'Penajam', 'Petung', '2013-10-14', 'L', 'Islam', '', '', '2016', '', '0821', '', 'N', '006', '006', 'siswa'),
(7, '007', 'Andika Saputra', 'Andika Saputra', '25f9ee99b84e797196beba074fe681c6', '91', '', 'Penajam', 'Petung', '2014-04-14', 'L', 'Islam', '', '', '2016', '', '0821', '', 'N', '007', '007', 'siswa'),
(8, '008', 'Aqilah Aulia Nisyah', 'Aqilah Aulia Nisyah', '81b5f8c1882851f4bf899e6c47a3d330', '91', '', 'Penajam', 'Petung', '2014-08-19', 'L', 'Islam', '', '', '2016', '', '1234', '', 'N', '008', '008', 'siswa'),
(9, '009', 'Dede Ardian', 'Dede Ardian', 'a9fd19f6e0bf0b01e6664a6acb520aad', '91', '', 'Penajam', 'Petung', '2018-09-15', 'L', 'Islam', '', '', '2016', '', '0821', '', 'N', '009', '009', 'siswa'),
(10, '010', 'Ferdi Muhammat Sait', 'Ferdi Muhammat Sait', '5485cfb5f9242e227a95dd8f7c9b50f0', '91', '', 'Penajam', 'Petung', '2001-11-17', 'L', 'Islam', '', '', '2016', '', '0821', '', 'N', '010', '010', 'siswa'),
(11, '011', 'Fitriyani', 'Fitriyani', '0f854cde5946c54378890fa474359402', '91', '', 'Penajam', 'Petung', '0000-00-00', 'P', 'Islam', '', '', '2016', '', '0821', '', 'N', '011', '011', 'siswa'),
(12, '012', 'Kharina Feby Lestari', 'Kharina Feby Lestari', '7605d272d0741e8372e6cb683c134de9', '91', '', 'Penajam', 'Petung', '2005-09-25', 'P', 'Islam', '', '', '2016', '', '76543456787', '', 'N', '012', '012', 'siswa'),
(13, '013', 'Khoirul Rahmat Hidayat', 'Khoirul Rahmat Hidayat', 'd81dc00ffb39bdeb1155d9fccb280df1', '91', '', 'Penajam', 'Petung', '2007-05-22', 'L', 'Islam', '', '', '2016', '', '0823456789', '', 'N', '013', '013', 'siswa'),
(14, '014', 'M.Indra Saputra', 'M.Indra Saputra', 'e0ede7510ab12d2dac697e15604cecd7', '91', '', 'Penajam', 'Petung', '2009-06-22', 'L', 'Islam', '', '', '2016', '', '0821', '', 'N', '014', '014', 'siswa'),
(15, '015', 'Mardiana', 'Mardiana', '8d41c411238d1bebfbab090063812a63', '91', '', 'Mardiana', 'Petung', '2008-04-15', 'L', 'Islam', '', '', '2016', '', '0987', '', 'N', '015', '015', 'siswa'),
(16, '016', 'Muhammad Ardiansyah', 'Muhammad Ardiansyah', '2519dabb9068a8ff20a4f135e64f33fa', '91', '', 'Penajam', 'Petung', '2009-10-12', 'L', 'Islam', '', '', '2016', '', '086', '', 'N', '016', '016', 'siswa'),
(17, '017', 'Muhammad Ariffianto', 'Muhammad Ariffianto', '6a61871d3fb8f985cde89cf7e562c44a', '91', '', 'Makassar', 'Petung', '2009-09-28', 'L', 'Islam', '', '', '2016', '', '0864', '', 'N', '017', '017', 'siswa'),
(18, '018', 'Muhammad Imron', 'Muhammad Imron', 'fb198d8d2e2e3151552fdbd92404b76e', '91', '', 'Penajam', 'Petung', '2010-08-27', 'L', 'Islam', '', '', '2016', '', '1234', '', 'N', '018', '018', 'siswa'),
(19, '019', 'Muhammad Putra Aldian', 'Muhammad Putra Aldian', '73887d9141e1f126f750385a9e79100d', '91', '', 'Waru', 'Petung', '2004-04-17', 'L', 'Islam', '', '', '2016', '', '0987', '', 'N', '019', '019', 'siswa'),
(20, '020', 'Muhammad Ramadhan Purba', 'Muhammad Ramadhan Purba', '0e4e3a8567fcd7f4a4b115ebde0c0fba', '91', '', 'Api Api', 'Waru', '2006-08-22', 'L', 'Islam', '', '', '2016', '', '0821', '', 'N', '020', '020', 'siswa'),
(21, '021', 'Muhammad Randi Ihwan', 'Muhammad Randi Ihwan', 'a2de246eb35a1db2155d7195d155336c', '91', '', 'Babulu', 'Makassar', '2005-11-15', 'L', 'Islam', '', '', '2016', '', '76543456787', '', 'N', '021', '021', 'siswa'),
(22, '022', 'Muhammad Rifai', 'Muhammad Rifai', '41598cc83872b934e1f702937ec85c21', '91', '', 'Penajam', 'Penajam', '2008-05-20', 'L', 'Islam', '', '', '2016', '', '0987', '', 'N', '022', '022', 'siswa'),
(23, '023', 'Muqtaridatul Hikmah', 'Muqtaridatul Hikmah', 'e88fec52c5050e8620a74b9c21e9777e', '91', '', 'Penajam', 'Petung', '2006-11-01', 'L', 'Islam', '', '', '2016', '', '0823456789', '', 'N', '023', '023', 'siswa'),
(24, '024', 'Nuraini Saniahsa', 'Nuraini Saniahsa', '4cc4cc53bca6521666596ce04b16b0fd', '91', '', 'Penajam', 'Penajam', '2007-08-08', '', 'Islam', '', '', '2016', '', '0864', '', 'N', '024', '024', 'siswa'),
(25, '025', 'Nurfaida', 'Nurfaida', '446099f25adae3ff66cfda03ef6b3b0a', '91', '', 'Penajam', 'Petung', '2002-10-25', 'P', 'Islam', '', '', '2016', '', '0864', '', 'N', '025', '025', 'siswa'),
(26, '026', 'Putri Wandari', 'Putri Wandari', '530b5cc495d041089c07ee56e17e4ba8', '91', '', 'Penajam', 'Petung', '2003-03-11', 'P', 'Islam', '', '', '2016', '', '1234', '', 'N', '026', '026', 'siswa'),
(27, '027', 'Rafi Akbar', 'Rafi Akbar', 'c31aa39568c63f1fab690725f421150c', '91', '', 'Penajam', 'Sotek', '2007-07-14', 'L', 'Islam', '', '', '2016', '', '0823456789', '', 'N', '027', '027', 'siswa'),
(28, '028', 'Rahmat Hidayat', 'Rahmat Hidayat', '7c1deea900fae17d371ee60643969f4c', '91', '', 'Penajam', 'Balikpapan', '2008-04-11', 'L', 'Islam', '', '', '2016', '', '1234', '', 'N', '028', '028', 'siswa'),
(29, '029', 'Restiyan Wahyudi', 'Restiyan Wahyudi', '6fc4d9d07fbe1a3d4114cf6e6b9d794b', '91', '', 'Penajam', 'Makassar', '2005-03-09', 'P', 'Islam', '', '', '2016', '', '0987', '', 'N', '029', '029', 'siswa'),
(30, '030', 'Rika', 'Rika', '4959fba5af95611fa88e2b7c6622e486', '91', '', 'Penajam', 'Penajam', '2007-10-10', 'P', 'Islam', '', '', '2016', '', '1234', '', 'N', '030', '030', 'siswa'),
(31, '031', 'Riki Saputra', 'Riki Saputra', '230a657dc843d9e16332026060f20149', '91', '', 'Penajam', 'Makassar', '2009-06-22', 'L', 'Islam', '', '', '2016', '', '0823456789', '', 'N', '031', '031', 'siswa'),
(32, '032', 'Riska Riyanti', 'Riska Riyanti', '37298e4840ff6fd3dcbd7c4dea62b086', '91', '', 'Penajam', 'Penajam', '2006-04-12', 'P', 'Islam', '', '', '2016', '', '0987', '', 'N', '032', '032', 'siswa'),
(33, '033', 'Riska Septiani', 'Riska Septiani', 'a654bfba289aa685d741fc8f818bb797', '91', '', 'Penajam', 'Petung', '2007-04-13', 'P', 'Islam', '', '', '2016', '', '0823456789', '', 'N', '033', '033', 'siswa'),
(34, '034', 'Riski Septiani', 'Riski Septiani', 'efa65bc16b7f07bfd865146a60f5c422', '91', '', 'Penajam', 'Makassar', '2007-03-14', 'L', 'Islam', '', '', '2016', '', '0864', '', 'N', '034', '034', 'siswa'),
(35, '035', 'Tri Anjasmara', 'Tri Anjasmara', '55ca60c812c99e65b7c747714837166c', '91', '', 'Penajam', 'Samarinda', '2005-10-13', 'L', 'Islam', '', '', '2016', '', '0864', '', 'N', '035', '035', 'siswa'),
(36, '036', 'Achmad  Firdaus', 'Achmad  Firdaus', '4e7d81c07673a2ed3bda8aa928d16020', '81', '', 'Penajam', 'Penajam', '2008-08-15', 'L', 'Islam', '', '', '2018', '', '0823456789', '', 'N', '036', '036', 'siswa'),
(37, '037', 'Emilia', 'Emilia', '63dac7596153ef4da82e037963713a54', '81', '', 'Penajam', 'Penajam', '2006-12-29', 'P', 'Islam', '', '', '2018', '', '76543456787', '', 'N', '037', '037', 'siswa'),
(38, '038', 'Fajar Gustiawan', 'Fajar Gustiawan', '9eb144337bf4971212af17b3eaf77ae8', '81', '', 'Penajam', 'Penajam', '2002-04-09', 'L', 'Islam', '', '', '2018', '', '1234', '', 'N', '038', '038', 'siswa'),
(39, '039', 'Fhiky Setiawan', 'Fhiky Setiawan', '65ea4f52c04bc3ebea491e9278985cce', '81', '', 'Penajam', 'Petung', '2003-09-20', 'L', 'Islam', '', '', '2018', '', '76543456787', '', 'N', '039', '039', 'siswa'),
(40, '040', 'Adit Yudistira', 'Adit Yudistira', '224de45c8b71803453f4083e54da3ea0', '81', '', 'Penajam', 'Makassar', '2003-04-16', 'L', 'Islam', '', '', '2018', '', '0987', '', 'N', '040', '040', 'siswa'),
(41, '041', 'Harianto', 'Harianto', '9d9951eecd51b58a10677907de7ea78e', '81', '', 'Penajam', 'Makassar', '2007-04-22', 'L', 'Islam', '', '', '2018', '', '0823456789', '', 'N', '041', '041', 'siswa'),
(42, '042', 'Hengki', 'Hengki', 'bbe67d7ad588017579f82fbcfb1a0a12', '81', '', 'Penajam', 'Makassar', '2007-04-19', 'L', 'Islam', '', '', '2018', '', '1234', '', 'N', '042', '042', 'siswa'),
(43, '043', 'Linda', 'Linda', '96c11895e7dc02ef601772a3f77587ac', '81', '', 'Penajam', 'Makassar', '2004-09-22', 'P', 'Islam', '', '', '2018', '', '1234', '', 'N', '043', '043', 'siswa'),
(44, '044', 'Ahmad Fauzi', 'Ahmad Fauzi', '7a43d8e604d330c21261e06336ed0a60', '81', '', 'Penajam', 'Makassar', '2005-04-11', 'L', 'Islam', '', '', '2018', '', '0864', '', 'N', '044', '044', 'siswa'),
(45, '045', 'Melda Ananda', 'Melda Ananda', 'b59a9513826c60b5b06b6bd9ede771ae', '81', '', 'Penajam', 'Makassar', '2004-04-09', 'P', 'Islam', '', '', '2018', '', '0823456789', '', 'N', '045', '045', 'siswa'),
(46, '046', 'Mifta Apriani', 'Mifta Apriani', 'e2e9743f1ec1cc363f7ca9615102efe9', '81', '', 'Penajam', 'Penajam', '2006-05-14', 'P', 'Islam', '', '', '2018', '', '0821', '', 'N', '046', '046', 'siswa'),
(47, '047', 'Muhammad Almadani', 'Muhammad Almadani', '26da90760c42d83d580be6dffe0866ea', '81', '', 'Penajam', 'Makassar', '2005-04-01', 'L', 'Islam', '', '', '2018', '', '0821', '', 'N', '047', '047', 'siswa'),
(48, '048', 'Muhammad Andika', 'Muhammad Andika', 'd6e31f741be6eb9e66849289d3ccf7b1', '81', '', 'Penajam', 'Petung', '2004-12-06', 'L', 'Islam', '', '', '2018', '', '0823456789', '', 'N', '048', '048', 'siswa'),
(49, '049', 'Muhammad Irsyad Maiwa', 'Muhammad Irsyad Maiwa', 'a6fbb2131e12428a5eba3d8b6c5dae20', '81', '', 'Penajam', 'Pettung', '2007-05-07', 'L', 'Islam', '', '', '2018', '', '1234', '', 'N', '049', '049', 'siswa'),
(50, '050', 'Muhammad Maulana', 'Muhammad Maulana', 'bab18c31bc8976e3e153d7c65ad0363e', '81', '', 'Penajam', 'Makassar', '2004-04-12', 'L', 'Islam', '', '', '2018', '', '1234', '', 'N', '050', '050', 'siswa'),
(51, '051', 'Munir', 'Munir', '67726598b0e4dcc02ee1360adfe364f6', '81', '', 'Penajam', 'Petung', '2012-04-17', 'L', 'Islam', '', '', '2018', '', '0987', '', 'N', '051', '051', 'siswa'),
(52, '052', 'Neni Rahayu Puji Lestari', 'Neni Rahayu Puji Lestari', '7b3059ffeb20d6ad64c9098505c78e09', '81', '', 'Penajam', 'Petung', '2004-03-07', 'P', 'Islam', '', '', '2018', '', '0987', '', 'N', '052', '052', 'siswa'),
(53, '053', 'Noval Wahyu Kurniawan', 'Noval Wahyu Kurniawan', 'b14abd380e3e08b4bec22aa0740a3f9e', '81', '', 'Penajam', 'Petung', '2004-03-17', 'L', 'Islam', '', '', '2018', '', '0987', '', 'N', '053', '053', 'siswa'),
(54, '054', 'Nurwahyuni', 'Nurwahyuni', 'ecc333b89832456e13e201e32b688698', '81', '', 'Penajam', 'Petung', '2004-04-16', 'P', 'Islam', '', '', '2018', '', '0821', '', 'N', '054', '054', 'siswa'),
(55, '055', 'Salwa Aprilia Sahab', 'Salwa Aprilia Sahab', '0ed838aca74f6da96a61d57a2fccaa4e', '81', '', 'Penajam', 'Petung', '2005-11-22', 'P', 'Islam', '', '', '2018', '', '0823456789', '', 'N', '055', '055', 'siswa'),
(56, '056', 'Sri Selvi Mulia wati', 'Sri Selvi Mulia wati', 'de0472eda42b985627d1df2073cb56de', '81', '', 'Penajam', 'Petung', '2004-07-15', 'P', 'Islam', '', '', '2018', '', '0987', '', 'N', '056', '056', 'siswa'),
(57, '057', 'Surya Ananda Karya', 'Surya Ananda Karya', 'f3fd4959ed12301850a60c00ce6865f7', '81', '', 'Penajam', 'Petung', '2004-04-10', 'L', 'Islam', '', '', '2018', '', '0821', '', 'N', '057', '057', 'siswa'),
(58, '058', 'Shifa Kamila Putri', 'Shifa Kamila Putri', 'b48d758b355a421c97ccb646d3c4821b', '81', '', 'Penajam', 'Petung', '2003-06-14', 'P', 'Islam', '', '', '2018', '', '0823456789', '', 'N', '058', '058', 'siswa'),
(59, '059', 'Veby Nurul Sakinah', 'Veby Nurul Sakinah', '3aaea6d72e58bace3f9cb632e32db7ef', '81', '', 'Penajam', 'Petung', '2006-06-22', 'P', 'Islam', '', '', '2018', '', '0821', '', 'N', '059', '059', 'siswa'),
(60, '060', 'Angga Alsyamsyah', 'Angga Alsyamsyah', '362df552d4043e9299a65ea01a14a181', '91', '', 'Penajam', 'Petung', '2016-05-13', 'L', 'Islam', '', '', '2018', '', '1234', '', 'N', '060', '060', 'siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_himpunankriteria`
--

CREATE TABLE `tbl_himpunankriteria` (
  `id_hk` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `keterangan` varchar(15) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_himpunankriteria`
--

INSERT INTO `tbl_himpunankriteria` (`id_hk`, `id_kriteria`, `nama`, `keterangan`, `nilai`) VALUES
(1, 1, '<50', 'Sangat Rendah', 1),
(2, 1, '>50-60', 'Rendah', 2),
(3, 1, '>60-70', 'Sedang', 3),
(4, 1, '>70-85', 'Tinggi', 4),
(5, 1, '>85-100', 'SangatTinggi', 5),
(6, 2, '10%-20%', 'Sangat Rendah', 1),
(7, 2, '30%-40%', 'Rendah', 2),
(8, 2, '50%-60%', 'Sedang', 3),
(9, 2, '70%-80%', 'Tinggi', 4),
(10, 2, '90%-100%', 'Sangat Tinggi', 5),
(11, 3, 'X <=Rp 1.000.000', 'Sangat Rendah', 1),
(12, 3, 'Rp  Rp 1.000.000 <X<=Rp', 'Rendah', 2),
(13, 3, 'Rp 1.500.000 <X<=Rp', 'Sedang', 3),
(14, 3, 'Rp 2.500.000 <X <=Rp', 'Tinggi', 4),
(15, 3, 'X>=Rp 3.500.000', 'Sangat Tinggi', 5),
(16, 4, '1 Anak', 'Sangat Rendah', 1),
(17, 4, '2 Anak', 'Rendah', 2),
(18, 4, '3 Anak', 'Sedang', 3),
(19, 4, '4 Anak', 'Tinggi', 4),
(20, 4, '> 4 Anak', 'Sangat Tinggi', 5),
(21, 5, '1-6', 'Sangat Rendah', 1),
(22, 5, '7-12', 'Rendah', 2),
(23, 5, '13-18', 'Sedang', 3),
(24, 5, '19-24', 'Tinggi', 4),
(25, 5, '25-30', 'Sangat Tinggi', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_klasifikasi`
--

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_hk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_klasifikasi`
--

INSERT INTO `tbl_klasifikasi` (`id_klasifikasi`, `id_siswa`, `id_hk`) VALUES
(1, 1, 5),
(2, 1, 10),
(3, 1, 14),
(4, 1, 17),
(5, 1, 24),
(6, 2, 4),
(7, 2, 9),
(8, 2, 14),
(9, 2, 17),
(10, 2, 23),
(11, 3, 5),
(12, 3, 10),
(13, 3, 13),
(14, 3, 18),
(15, 3, 24),
(16, 4, 4),
(17, 4, 10),
(18, 4, 14),
(19, 4, 16),
(20, 4, 24),
(21, 5, 3),
(22, 5, 9),
(23, 5, 13),
(24, 5, 17),
(25, 5, 25),
(26, 6, 4),
(27, 6, 10),
(28, 6, 13),
(29, 6, 16),
(30, 6, 25),
(31, 7, 3),
(32, 7, 10),
(33, 7, 13),
(34, 7, 19),
(35, 7, 25),
(36, 60, 4),
(37, 60, 10),
(38, 60, 13),
(39, 60, 17),
(40, 60, 25),
(41, 8, 4),
(42, 8, 9),
(43, 8, 13),
(44, 8, 16),
(45, 8, 24),
(46, 9, 4),
(47, 9, 8),
(48, 9, 14),
(49, 9, 19),
(50, 9, 25),
(51, 10, 4),
(52, 10, 9),
(53, 10, 15),
(54, 10, 17),
(55, 10, 25),
(56, 11, 3),
(57, 11, 10),
(58, 11, 14),
(59, 11, 18),
(60, 11, 24),
(61, 12, 4),
(62, 12, 10),
(63, 12, 15),
(64, 12, 16),
(65, 12, 25),
(66, 13, 3),
(67, 13, 9),
(68, 13, 15),
(69, 13, 19),
(70, 13, 24),
(71, 14, 5),
(72, 14, 10),
(73, 14, 13),
(74, 14, 20),
(75, 14, 25),
(76, 15, 4),
(77, 15, 10),
(78, 15, 14),
(79, 15, 19),
(80, 15, 24),
(81, 16, 4),
(82, 16, 10),
(83, 16, 13),
(84, 16, 20),
(85, 16, 24),
(86, 17, 4),
(87, 17, 10),
(88, 17, 14),
(89, 17, 19),
(90, 17, 25),
(91, 18, 5),
(92, 18, 10),
(93, 18, 13),
(94, 18, 18),
(95, 18, 24),
(96, 19, 4),
(97, 19, 10),
(98, 19, 13),
(99, 19, 19),
(100, 19, 24),
(101, 20, 4),
(102, 20, 10),
(103, 20, 13),
(104, 20, 18),
(105, 20, 25),
(106, 21, 4),
(107, 21, 10),
(108, 21, 14),
(109, 21, 20),
(110, 21, 24),
(111, 22, 3),
(112, 22, 9),
(113, 22, 14),
(114, 22, 17),
(115, 22, 25),
(116, 23, 4),
(117, 23, 10),
(118, 23, 13),
(119, 23, 16),
(120, 23, 23),
(121, 24, 3),
(122, 24, 10),
(123, 24, 15),
(124, 24, 17),
(125, 24, 23),
(126, 25, 4),
(127, 25, 9),
(128, 25, 13),
(129, 25, 18),
(130, 25, 24),
(131, 26, 4),
(132, 26, 10),
(133, 26, 14),
(134, 26, 18),
(135, 26, 24),
(136, 27, 4),
(137, 27, 8),
(138, 27, 13),
(139, 27, 17),
(140, 27, 23),
(141, 28, 4),
(142, 28, 10),
(143, 28, 14),
(144, 28, 16),
(145, 28, 23),
(146, 29, 4),
(147, 29, 9),
(148, 29, 15),
(149, 29, 20),
(150, 29, 24),
(151, 30, 5),
(152, 30, 10),
(153, 30, 14),
(154, 30, 19),
(155, 30, 23),
(156, 31, 5),
(157, 31, 10),
(158, 31, 13),
(159, 31, 18),
(160, 31, 24),
(161, 32, 4),
(162, 32, 10),
(163, 32, 14),
(164, 32, 19),
(165, 32, 24),
(166, 33, 4),
(167, 33, 10),
(168, 33, 13),
(169, 33, 18),
(170, 33, 23),
(171, 34, 4),
(172, 34, 10),
(173, 34, 14),
(174, 34, 20),
(175, 34, 24),
(176, 35, 4),
(177, 35, 10),
(178, 35, 14),
(179, 35, 18),
(180, 35, 24),
(181, 36, 4),
(182, 36, 9),
(183, 36, 14),
(184, 36, 16),
(185, 36, 25),
(186, 37, 4),
(187, 37, 9),
(188, 37, 13),
(189, 37, 18),
(190, 37, 25),
(191, 38, 4),
(192, 38, 8),
(193, 38, 13),
(194, 38, 17),
(195, 38, 24),
(196, 39, 5),
(197, 39, 9),
(198, 39, 12),
(199, 39, 17),
(200, 39, 23),
(201, 40, 4),
(202, 40, 8),
(203, 40, 14),
(204, 40, 17),
(205, 40, 24),
(206, 41, 4),
(207, 41, 9),
(208, 41, 15),
(209, 41, 16),
(210, 41, 25),
(211, 42, 4),
(212, 42, 9),
(213, 42, 15),
(214, 42, 17),
(215, 42, 23),
(216, 43, 5),
(217, 43, 8),
(218, 43, 14),
(219, 43, 18),
(220, 43, 25),
(221, 44, 4),
(222, 44, 8),
(223, 44, 13),
(224, 44, 19),
(225, 44, 23),
(226, 45, 3),
(227, 45, 10),
(228, 45, 13),
(229, 45, 19),
(230, 45, 25),
(231, 46, 4),
(232, 46, 8),
(233, 46, 14),
(234, 46, 17),
(235, 46, 24),
(236, 47, 4),
(237, 47, 9),
(238, 47, 13),
(239, 47, 18),
(240, 47, 23),
(241, 48, 4),
(242, 48, 9),
(243, 48, 13),
(244, 48, 17),
(245, 48, 25),
(246, 49, 4),
(247, 49, 10),
(248, 49, 14),
(249, 49, 18),
(250, 49, 24),
(251, 50, 3),
(252, 50, 9),
(253, 50, 13),
(254, 50, 18),
(255, 50, 25),
(256, 51, 4),
(257, 51, 9),
(258, 51, 13),
(259, 51, 19),
(260, 51, 24),
(261, 52, 4),
(262, 52, 10),
(263, 52, 15),
(264, 52, 20),
(265, 52, 25),
(266, 53, 5),
(267, 53, 8),
(268, 53, 13),
(269, 53, 16),
(270, 53, 25),
(271, 54, 4),
(272, 54, 9),
(273, 54, 13),
(274, 54, 16),
(275, 54, 24),
(276, 55, 5),
(277, 55, 8),
(278, 55, 14),
(279, 55, 17),
(280, 55, 25),
(281, 56, 5),
(282, 56, 9),
(283, 56, 13),
(284, 56, 16),
(285, 56, 25),
(286, 57, 3),
(287, 57, 10),
(288, 57, 13),
(289, 57, 17),
(290, 57, 24),
(291, 58, 4),
(292, 58, 9),
(293, 58, 14),
(294, 58, 19),
(295, 58, 25),
(296, 59, 4),
(297, 59, 9),
(298, 59, 13),
(299, 59, 18),
(300, 59, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id` int(5) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `type_kriteria` varchar(100) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id`, `kriteria`, `type_kriteria`, `bobot`) VALUES
(1, 'Nilai Rata-rata Raport Terakhir', 'Benefit', 30),
(2, 'Absensi Kehadiran', 'Benefit', 20),
(3, 'Penghasilan Orang tua', 'Cost', 25),
(4, 'Jumlah Tanggungan Orangtua', 'Benefit', 15),
(5, 'Aktif dalam Ekstrakurikuler', 'Benefit', 10);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_analisa`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_analisa` (
`id_klasifikasi` int(11)
,`id_siswa` int(11)
,`nama_lengkap` varchar(100)
,`id_hk` int(11)
,`id_kriteria` int(11)
,`kriteria` varchar(50)
,`nama` varchar(60)
,`keterangan` varchar(15)
,`nilai` int(11)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_analisa`
--
DROP TABLE IF EXISTS `v_analisa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_analisa`  AS  select `tbl_klasifikasi`.`id_klasifikasi` AS `id_klasifikasi`,`tbl_klasifikasi`.`id_siswa` AS `id_siswa`,`siswa`.`nama_lengkap` AS `nama_lengkap`,`tbl_klasifikasi`.`id_hk` AS `id_hk`,`tbl_himpunankriteria`.`id_kriteria` AS `id_kriteria`,`tbl_kriteria`.`kriteria` AS `kriteria`,`tbl_himpunankriteria`.`nama` AS `nama`,`tbl_himpunankriteria`.`keterangan` AS `keterangan`,`tbl_himpunankriteria`.`nilai` AS `nilai` from (((`tbl_himpunankriteria` join `tbl_kriteria` on((`tbl_himpunankriteria`.`id_kriteria` = `tbl_kriteria`.`id`))) join `tbl_klasifikasi` on((`tbl_klasifikasi`.`id_hk` = `tbl_himpunankriteria`.`id_hk`))) join `siswa` on((`tbl_klasifikasi`.`id_siswa` = `siswa`.`id_siswa`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kodematkul` (`kodematkul`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indeks untuk tabel `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`id_pengajar`);

--
-- Indeks untuk tabel `registrasi_siswa`
--
ALTER TABLE `registrasi_siswa`
  ADD PRIMARY KEY (`id_registrasi`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tbl_himpunankriteria`
--
ALTER TABLE `tbl_himpunankriteria`
  ADD PRIMARY KEY (`id_hk`);

--
-- Indeks untuk tabel `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indeks untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `id_pengajar` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `registrasi_siswa`
--
ALTER TABLE `registrasi_siswa`
  MODIFY `id_registrasi` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `tbl_himpunankriteria`
--
ALTER TABLE `tbl_himpunankriteria`
  MODIFY `id_hk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_klasifikasi`
--
ALTER TABLE `tbl_klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
