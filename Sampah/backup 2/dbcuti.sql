-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 27. Desember 2012 jam 22:53
-- Versi Server: 5.0.51
-- Versi PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cuti`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari_libur`
--

CREATE TABLE IF NOT EXISTS `hari_libur` (
  `id_hari_libur` int(3) NOT NULL auto_increment,
  `tanggal` date NOT NULL default '0000-00-00',
  `keterangan` text character set latin1 collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_hari_libur`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `hari_libur`
--

INSERT INTO `hari_libur` (`id_hari_libur`, `tanggal`, `keterangan`) VALUES
(1, '2012-03-23', 'Hari Raya Nyepi'),
(2, '2012-01-23', 'Tahun Baru Imlek'),
(3, '2012-04-06', 'Wafat Isa Al-masih'),
(4, '2012-05-17', 'Kenaikan Isa Al-masih'),
(5, '2012-08-17', 'Hari Proklamasi Kemerdekaan RI'),
(6, '2012-08-20', 'Hari Raya Idul Fitri'),
(7, '2012-10-26', 'Hari Raya Idul Adha'),
(8, '2012-11-15', 'Tahun Baru Islam'),
(9, '2012-12-25', 'Hari Natal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hubungi`
--

CREATE TABLE IF NOT EXISTS `hubungi` (
  `id_hubungi` int(5) NOT NULL auto_increment,
  `nama` varchar(50) collate latin1_general_ci NOT NULL,
  `email` varchar(100) collate latin1_general_ci NOT NULL,
  `subjek` varchar(100) collate latin1_general_ci NOT NULL,
  `pesan` text collate latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY  (`id_hubungi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `hubungi`
--

INSERT INTO `hubungi` (`id_hubungi`, `nama`, `email`, `subjek`, `pesan`, `tanggal`) VALUES
(1, 'Ariawan', 'ariawan@gmail.com', 'Mohon Informasi', 'Mohon informasi mengenai buku yang diterbitkan oleh Lokomedia.', '2008-02-10'),
(2, '', '', '', '', '2012-01-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(4) NOT NULL auto_increment,
  `kd_jabatan` varchar(6) character set latin1 collate latin1_general_ci NOT NULL,
  `nm_jabatan` varchar(100) character set latin1 collate latin1_general_ci NOT NULL,
  `keterangan` text character set latin1 collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_jabatan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `kd_jabatan`, `nm_jabatan`, `keterangan`) VALUES
(1, 'Bas4', 'Junior Analyst', 'Junior Analyst'),
(3, 'Spec4', 'Specifik Analyst', 'Specifik Analyst'),
(4, 'Sist2', 'Sistem Analyst', 'Sistem Analyst'),
(5, 'Bas2', 'Basic2', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_cuti`
--

CREATE TABLE IF NOT EXISTS `jenis_cuti` (
  `id_jenis_cuti` int(4) NOT NULL auto_increment,
  `kd_jcuti` varchar(4) collate latin1_general_ci NOT NULL,
  `nama_jcuti` varchar(60) collate latin1_general_ci NOT NULL,
  `lama_jcuti` int(3) NOT NULL default '0',
  `keterangan` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_jenis_cuti`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `jenis_cuti`
--

INSERT INTO `jenis_cuti` (`id_jenis_cuti`, `kd_jcuti`, `nama_jcuti`, `lama_jcuti`, `keterangan`) VALUES
(1, 'CThn', 'Cuti Tahunan', 12, 'Cuti Tahunan selama 12 hari kerja.'),
(5, 'CBsr', 'Cuti Besar', 90, 'Diberikan untuk karyawan yang telah bekerja selama 6 tahun. Lama cuti 900 hari kalender (3 bulan).'),
(6, 'CLhr', 'Cuti Bersalin', 90, 'Diberikan untuk karyawan yang sedang / akan / telah melahirkan. Lama cuti 900 hari kalender (3 bulan).'),
(7, 'CSkt', 'Cuti Sakit', 0, 'Cuti Sakit'),
(8, 'CAls', 'Cuti Alasan Penting', 0, 'Cuti Karena Alasan Penting'),
(9, 'CDll', 'Cuti Keterangan Lain', 0, 'Cuti Karena Keterangan Lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` int(4) NOT NULL auto_increment,
  `nik` varchar(8) character set latin1 collate latin1_general_ci NOT NULL,
  `nama` varchar(60) character set latin1 collate latin1_general_ci NOT NULL,
  `kd_jabatan` varchar(8) character set latin1 collate latin1_general_ci NOT NULL,
  `kelamin` enum('P','W') character set latin1 collate latin1_general_ci NOT NULL default 'P',
  `status_kawin` enum('TK','K') character set latin1 collate latin1_general_ci NOT NULL default 'TK',
  `pendidikan` enum('SD','SMP','SMA','D1','D3','S1','S2','S3') character set latin1 collate latin1_general_ci NOT NULL default 'SD',
  `alamat_tinggal` varchar(200) character set latin1 collate latin1_general_ci NOT NULL,
  `alamat_asal` varchar(200) character set latin1 collate latin1_general_ci NOT NULL,
  `tgl_masuk` date NOT NULL default '0000-00-00',
  `status_upah` enum('harian','mingguan','bulanan') character set latin1 collate latin1_general_ci NOT NULL default 'harian',
  `status_karyawan` enum('aktif','tidak aktif','cuti') character set latin1 collate latin1_general_ci NOT NULL default 'aktif',
  `nik_atasan` varchar(8) NOT NULL,
  PRIMARY KEY  (`id_karyawan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama`, `kd_jabatan`, `kelamin`, `status_kawin`, `pendidikan`, `alamat_tinggal`, `alamat_asal`, `tgl_masuk`, `status_upah`, `status_karyawan`, `nik_atasan`) VALUES
(1, '8408027A', 'Jatmika', 'Bas4', 'P', 'K', 'D3', 'Jl. SM. Raja no8, Medan', 'P. Siantar', '2008-08-01', 'bulanan', 'cuti', '5980068A'),
(2, '8408026A', 'Smart', 'Bas4', 'P', 'K', 'S1', 'Jl. Medan', 'Medan', '2008-08-01', 'bulanan', 'cuti', '8418068A'),
(4, '8506058Z', 'Polanx', 'Bas4', 'P', 'TK', 'D3', 'Jl. Mustafa Medanx', 'Jl. Kamboja Semarangx', '2012-03-05', 'mingguan', 'tidak aktif', ''),
(5, '8418068A', 'Dhani', 'Spec4', 'W', 'K', 'S1', 'Jl. SM Raja, Medan', 'Jl. DI Panjaitan, Tarutung', '2011-11-01', 'bulanan', 'aktif', ''),
(6, '5980068A', 'Hairullah Sani', 'Spec4', 'P', 'K', 'SMA', 'Jl. Karya Wisata Medan', 'Jl. Karya Wisata Medan', '1980-10-10', 'bulanan', 'aktif', '6994088A'),
(7, '8408025A', 'Budi', 'Bas4', 'P', 'TK', 'D3', 'Jl. Perjuangan', 'Jl. Perjuangan', '2010-05-12', 'bulanan', 'aktif', '5980068A'),
(8, '8206632Z', 'Rosmawaty', 'Spec4', 'W', 'K', 'S1', 'Medan', 'Medan', '2008-08-19', 'bulanan', 'cuti', '5980068A'),
(9, '8710697Z', 'Dedy Bram', 'Bas2', 'P', 'K', 'D3', 'Binjai', 'Binjai', '2011-02-15', 'bulanan', 'cuti', '5980068A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL auto_increment,
  `nama_modul` varchar(50) collate latin1_general_ci NOT NULL,
  `link` varchar(100) collate latin1_general_ci NOT NULL,
  `static_content` text collate latin1_general_ci NOT NULL,
  `gambar` varchar(100) collate latin1_general_ci NOT NULL,
  `publish` enum('Y','N') collate latin1_general_ci NOT NULL,
  `status` enum('atasan','karyawan','admin') collate latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') collate latin1_general_ci NOT NULL,
  `urutan` int(5) NOT NULL,
  PRIMARY KEY  (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=37 ;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`) VALUES
(2, 'Manajemen User', '?module=user', '', '', 'Y', 'admin', 'Y', 1),
(29, 'Jenis Cuti', '?module=jenis_cuti', '', '', 'Y', 'admin', 'Y', 5),
(28, 'Karyawan', '?module=karyawan', '', '', 'Y', 'admin', 'Y', 4),
(10, 'Manajemen Modul', '?module=modul', '', '', 'Y', 'admin', 'Y', 2),
(30, 'Permohonan Cuti', '?module=permohonan_cuti', '', '', 'N', 'karyawan', 'Y', 7),
(31, 'Hari Libur', '?module=hari_libur', '', '', 'Y', 'admin', 'Y', 11),
(32, 'Riwayat Cuti', '?module=riwayat_cuti', '', '', 'N', 'karyawan', 'Y', 8),
(33, 'Riwayat Cuti All', '?module=riwayat_cuti_all', '', '', 'Y', 'admin', 'Y', 9),
(34, 'Persetujuan Cuti', '?module=persetujuan_cuti', '', '', 'N', 'atasan', 'Y', 10),
(36, 'Periode Cuti', '?module=periode_cuti', '', '', 'Y', 'admin', 'Y', 6),
(25, 'Hubungi Kami', '?module=hubungi', '', '', 'Y', 'karyawan', 'N', 12),
(27, 'Jabatan', '?module=jabatan', '', '', 'Y', 'admin', 'Y', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode_cuti`
--

CREATE TABLE IF NOT EXISTS `periode_cuti` (
  `id_periode_cuti` int(4) NOT NULL auto_increment,
  `nik` varchar(8) collate latin1_general_ci NOT NULL,
  `kd_jcuti` varchar(4) collate latin1_general_ci NOT NULL,
  `tahun` varchar(4) collate latin1_general_ci NOT NULL,
  `awalcuti` date NOT NULL default '0000-00-00',
  `akhircuti` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_periode_cuti`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `periode_cuti`
--

INSERT INTO `periode_cuti` (`id_periode_cuti`, `nik`, `kd_jcuti`, `tahun`, `awalcuti`, `akhircuti`) VALUES
(8, '8408027A', 'CThn', '2013', '2012-08-01', '2013-07-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan_cuti`
--

CREATE TABLE IF NOT EXISTS `permohonan_cuti` (
  `id_pcuti` int(4) NOT NULL auto_increment,
  `nik` varchar(8) collate latin1_general_ci NOT NULL,
  `tahun` varchar(4) collate latin1_general_ci NOT NULL,
  `kd_jcuti` varchar(4) collate latin1_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL default '0000-00-00',
  `tgl_akhir` date NOT NULL default '0000-00-00',
  `lama_cuti` int(4) NOT NULL default '0',
  `sisa_cuti` int(4) NOT NULL default '12',
  `alasan` text collate latin1_general_ci NOT NULL,
  `status_pengajuan` enum('belum','tidak','setuju') collate latin1_general_ci NOT NULL default 'belum',
  PRIMARY KEY  (`id_pcuti`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `permohonan_cuti`
--

INSERT INTO `permohonan_cuti` (`id_pcuti`, `nik`, `tahun`, `kd_jcuti`, `tgl_mulai`, `tgl_akhir`, `lama_cuti`, `sisa_cuti`, `alasan`, `status_pengajuan`) VALUES
(2, '8408027A', '2012', 'CThn', '2012-03-27', '2012-03-29', 3, 8, 'tes', 'belum'),
(4, '8408027A', '2012', 'CBsr', '2012-08-07', '2012-08-21', 9, 81, 'tes', 'belum'),
(13, '8408027A', '2012', 'CBsr', '2012-03-20', '2012-03-28', 6, 75, 'jhuy', 'belum'),
(15, '8408027A', '2012', 'CBsr', '2012-04-10', '2012-04-12', 3, 72, 'tesss', 'belum'),
(17, '8408027A', '2012', 'CBsr', '2012-04-10', '2012-04-11', 2, 70, 'ggg', 'belum'),
(18, '8408027A', '2012', 'CBsr', '2012-04-09', '2012-04-09', 1, 69, 'fh', 'belum'),
(23, '8408027A', '2012', 'CBsr', '2012-04-10', '2012-04-18', 7, 62, 'asd', 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(4) NOT NULL auto_increment,
  `nik` varchar(8) collate latin1_general_ci NOT NULL,
  `password` varchar(100) collate latin1_general_ci NOT NULL,
  `level` enum('atasan','karyawan','admin') collate latin1_general_ci NOT NULL default 'atasan',
  PRIMARY KEY  (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nik`, `password`, `level`) VALUES
(1, '8408027A', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, '8408026A', '202cb962ac59075b964b07152d234b70', 'karyawan'),
(12, '5980068A', '202cb962ac59075b964b07152d234b70', 'atasan'),
(11, '8418068A', '81dc9bdb52d04dc20036dbd8313ed055', 'atasan'),
(13, '8408025A', '202cb962ac59075b964b07152d234b70', 'karyawan'),
(14, '8206632Z', '202cb962ac59075b964b07152d234b70', 'karyawan'),
(15, '8710697Z', '202cb962ac59075b964b07152d234b70', 'karyawan');
