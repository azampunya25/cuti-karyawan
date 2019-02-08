-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2017 at 03:42 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `id4490598_radio_stars`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id_admin` int(9) NOT NULL,
  `nama` varchar(75) DEFAULT NULL,
  `nm_login` varchar(75) DEFAULT NULL,
  `pass_login` varchar(75) DEFAULT NULL,
  `level` varchar(75) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `nm_login`, `pass_login`, `level`) VALUES
(1, 'Super Admin', 'adminstars', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
`id_berita` int(11) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `isi` text NOT NULL,
  `tgl` datetime NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `isi`, `tgl`, `foto`) VALUES
(1, 'test', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', '2016-12-01 00:00:00', 'hny-image_02.jpg'),
(2, 'berita', '<p>radio</p>\r\n', '2016-12-07 00:00:00', 'vFL-a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE IF NOT EXISTS `galeri` (
`id` int(11) NOT NULL,
  `foto` text NOT NULL,
  `nama_foto` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `foto`, `nama_foto`) VALUES
(3, 'images/gallery/fBH-image_02_b.jpg', 'dsfdsfsdf'),
(6, 'images/gallery/3q1-image_05_b.jpg', 'fdgfdgd');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
`id` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `pukul` varchar(20) NOT NULL,
  `cover` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `hari`, `nama`, `pukul`, `cover`) VALUES
(1, 'Senin', 'rohani satu', '07.00', 'images/jadwal/j3E-2.jpg'),
(2, 'Selasa', 'good dayak', '07.00', 'images/jadwal/CfP-6.JPG'),
(3, 'Senin', 'berita katambung', '09.30', 'images/jadwal/w7b-4.jpg'),
(4, 'Rabu', 'berita', '07.00', 'images/jadwal/dDw-a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
`id_pesan` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `isi` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `nama`, `email`, `isi`, `waktu`) VALUES
(2, 'test', 'sdasasdas@asdas', 'asdasd', '2016-11-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `radio`
--

CREATE TABLE IF NOT EXISTS `radio` (
`id_radio` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `konten` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radio`
--

INSERT INTO `radio` (`id_radio`, `nama`, `konten`) VALUES
(1, 'sejarah', '<div><img alt="" src="afa;hhs;" /></div>\r\n\r\n<div><img alt="" src="/userfiles/images/a1.jpg" style="width: 200px; height: 150px;" /></div>\r\n\r\n<p>PT Radio STAR resmi berdiri pada tanggal 15 Juni 2004 di jalan Gurame, Palangka Raya. Saat ini Radio STAR 91.6 FM mengusung tagline Smart n Gaulnya Palangka Raya, dengan membidik segmen semua umur. Sebagai trendsetter brand Radio STAR 91.6 FM berusaha untuk memberikan Smart Influence bagi pendengar dalam setiap penyampaian gaya dan bahasa yang menjadi trend di kalangan anak muda, serta format musik dan kerohanian yang dapat dinikmati untuk semua kalangan. Format Musik CHR (Contemporary Hits Radio) merupakan musik yang disajikan untuk Star Lovers. Total Solution for Campaign media selalu menjadi acuan. Guna mewujudkan hal tersebut tidak hanya media on air tetapi off air activity. Melalui Departemen Off Air, STAR FM, Smart n Gaulnya Palangkaraya dapat menyelenggarakan acara baik lokal maupun nasional dari launching, sampling, gathering, party dan acara promosi lainnya.</p>\r\n'),
(2, 'visi', '<p><img alt="" src="/userfiles/images/Tulips.jpg" style="width: 200px; height: 150px;" /></p>\r\n\r\n<ol style="list-style-type:upper-alpha;">\r\n	<li value="374981">&nbsp;</li>\r\n</ol>\r\n\r\n<p style="margin-left:24.1pt;">Visi radio STAR menjadi radio yang menyuarakan &ldquo;Kebenaran&rdquo; sesuai dengan perintah amanat Agung <em>Matius 28:19-20</em> dan untuk membawa para pendengarnya mengenal dan menjalani kekudusan yang menuju jalan keselamatan yang Tuhan Yesus Kristus sudah sediakan, dan mempersiapkan gereja Tuhan menjadi mempelai-Nya untuk menyambut kedatangan sang mempelai surga (sebutan untuk Yesus Kristus), dengan berdasarkan pada dasar-dasar Firman Tuhan yang Alkitabiah.</p>\r\n\r\n<p style="margin-left:21.3pt;">Misi radio STAR bagi seluruh pendengarnya yang setia adalah:</p>\r\n\r\n<p style="margin-left:21.3pt;">Melayani para pendengar setia dengan penyajian informasi rohani yang Alkitabiah, bisa dipercaya serta didukung oleh kajian yang akurat, mendalam dan benar, seputar masalah-masalah kerohanian umat gereja, bangsa dan negara.</p>\r\n\r\n<p style="margin-left:21.3pt;">Menuntun kepada arah berpikir yang benar, mengemukakan pendapat dan bertindak di dalam etika moral yang benar sesuai karakter Yesus Kristus.</p>\r\n\r\n<p style="margin-left:21.3pt;">Menyediakan wadah untuk berkreasi dalam melayani pekerjaan Tuhan lewat program-program acara seperti: hiburan rohani, alunan musik rohani dan khotbah rohani, bagi seluruh para pendengar setia dari segala usia.</p>\r\n\r\n<p style="margin-left:21.3pt;">Mendorong semangat berbagi kasih di dalam interaksi antar sesama pendengar setia Radio STAR.</p>\r\n'),
(3, 'cara', '<ol>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n	<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus.&nbsp;</li>\r\n</ol>\r\n'),
(4, 'kontak', '<p><span style="font-size:16px;"><span style="font-family:Comic Sans MS,cursive;">pin bbm : 23sdfh3</span></span></p>\r\n\r\n<p style="text-align: justify;"><span style="font-size:16px;"><span style="font-family:Comic Sans MS,cursive;">HP: 0394803840</span></span></p>\r\n\r\n<p><span style="font-size:16px;"><span style="font-family:Comic Sans MS,cursive;">djshfkjdsh</span></span></p>\r\n\r\n<p><span style="font-size:16px;"><span style="font-family:Comic Sans MS,cursive;">djfhskjdhfks</span></span></p>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
 ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
 ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `radio`
--
ALTER TABLE `radio`
 ADD PRIMARY KEY (`id_radio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id_admin` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `radio`
--
ALTER TABLE `radio`
MODIFY `id_radio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
