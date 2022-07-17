-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2019 at 07:00 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiket_bioskop`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id_film` char(10) NOT NULL,
  `id_user` char(10) DEFAULT NULL,
  `id_jns` char(10) DEFAULT NULL,
  `judul_film` varchar(50) DEFAULT NULL,
  `durasi` time DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `gambar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id_film`, `id_user`, `id_jns`, `judul_film`, `durasi`, `deskripsi`, `gambar`) VALUES
('FLM001', 'USR003', 'GEN009', 'Avengers: Endgame', '02:29:00', 'Avengers: Endgame adalah film superhero Amerika 2019 yang didasarkan pada Marvel Comics tim superhero the Avengers, diproduksi oleh Marvel Studios dan didistribusikan oleh Walt Disney Studios Motion Pictures. Ini adalah sekuel The Avengers 2012, film 2015 Avengers: Age of Ultron dan film 2018 Avengers: Infinity War, dan film kedua puluh dua di Marvel Cinematic Universe (MCU). Film ini disutradarai oleh Anthony dan Joe Russo, yang ditulis oleh Christopher Markus dan Stephen McFeely, dan menampilkan pemeran ansambel termasuk Robert Downey Jr, Chris Evans, Mark Ruffalo, Chris Hemsworth, Scarlett Johansson, Jeremy Renner, Don Cheadle, Don Cheadle, Paul Rudd, Brie Larson, Karen Gillan, Danai Gurira, Benedict Wong, Jon Favreau, Bradley Cooper, Gwyneth Paltrow, dan Josh Brolin. Dalam film itu, anggota Avengers yang masih hidup dan sekutu mereka berusaha untuk membalikkan kerusakan yang disebabkan oleh Thanos dalam Infinity War.', '1575avengers-endgame.jpg'),
('FLM002', 'USR003', 'GEN021', 'Spider-Man: Far From Home', '02:08:00', 'Spider-Man: Far From Home adalah sebuah film pahlawan super Amerika Serikat yang berdasarkan pada karakter Marvel Comics Spider-Man, hasil kerjasama produksi dari Columbia Pictures dan Marvel Studios, dan didistribusikan oleh Sony Pictures Releasing. Film tersebut ditujukan untuk dijadikan sekuel dari Spider-Man: Homecoming (2017) dan film kedua puluh tiga dalam Marvel Cinematic Universe. Film ini disutradarai oleh Jon Watts, ditulis oleh Chris McKenna dan Erik Sommers, dan dibintangi Tom Holland sebagai Peter Parker / Spider-Man, bersama Samuel L. Jackson, Zendaya, Cobie Smulders, Jon Favreau, Smoove JB, Smoove, Jacob Batalon, Martin Starr, Marisa Tomei, dan Jake Gyllenhaal. Dalam Spider-Man: Far From Home, Parker direkrut oleh Nick Fury dan Mysterio untuk menghadapi ancaman dari dimensi lain saat ia sedang dalam perjalanan sekolah ke Eropa.', '1575Spider.jpg'),
('FLM003', 'USR003', 'GEN012', 'Warkop DKI Reborn: Jangkrik Boss! Part 2', '01:17:00', 'Warkop DKI Reborn: Jangkrik Boss! Part 2 adalah sebuah film komedi Indonesia 2017 yang disutradarai oleh Anggy Umbara.[1] Film tersebut merupakan adaptasi dari film-film Warkop DKI dan sequel dari film Warkop DKI Reborn: Jangkrik Boss! Part 1 yang dirilis tahun 2016.', '1575warkop dki.jpg'),
('FLM004', 'USR003', 'GEN019', 'Ayat-ayat Cinta', '01:25:00', 'Ayat-Ayat Cinta adalah sebuah film Indonesia karya Hanung Bramantyo yang dibintangi oleh Fedi Nuril, Rianti Cartwright, Carissa Putri, Zaskia Adya Mecca, dan Melanie Putria. Film ini merupakan film religi hasil adaptasi dari sebuah novel best seller karya Habiburrahman El Shirazy berjudul Ayat Ayat Cinta, dan tayang perdana pada 28 Februari 2008. Walaupun kisah dalam film dan novel Ayat-Ayat Cinta berlatarkan kehidupan di Kairo, Mesir, tetapi proses pengambilan gambar tidak dilakukan di kota itu', '1575Ayat_cinta.jpg'),
('FLM005', 'USR003', 'GEN011', 'How to Train Dragon', '01:59:00', 'Ketika Hiccup menemukan Toothless bukan satu-satunya Night Fury, ia harus mencari \"Dunia Tersembunyi\", Utopia Naga rahasia sebelum seorang tiran sewaan bernama Grimmel menemukannya terlebih dahulu.', '1575how_todragon.jpg'),
('FLM006', 'USR003', 'GEN009', 'Iron Man', '02:20:00', 'Iron Man adalah sebuah film yang berdasarkan tokoh Marvel Comics, Iron Man. Film ini adalah film pertama di Marvel Cinematic Universe. Film ini disutradarai oleh Jon Favreau dan dibintangi Robert Downey Jr., Gwyneth Paltrow, Terrence Howard, dan Jeff Bridges. Film ini dirilis pada 2 Mei 2008 di Amerika Serikat.', '1575Ironmanposter.jpg');

--
-- Triggers `film`
--
DELIMITER $$
CREATE TRIGGER `hapus_pada_jadwal` BEFORE DELETE ON `film` FOR EACH ROW DELETE FROM jadwal WHERE id_film=OLD.id_film
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `finish`
--

CREATE TABLE `finish` (
  `id_success` char(20) NOT NULL,
  `id_user` char(20) NOT NULL,
  `id_pesan` char(20) NOT NULL,
  `id_jadwal` char(20) NOT NULL,
  `id_kursi` char(20) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `qrcode_text` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finish`
--

INSERT INTO `finish` (`id_success`, `id_user`, `id_pesan`, `id_jadwal`, `id_kursi`, `tanggal`, `total_harga`, `qrcode_text`, `status`) VALUES
('SCC001', 'USR015', '519803174', 'JDW001', 'KRS001', '2019-12-08', 35000, '519803174581', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` char(10) NOT NULL,
  `id_studio` char(10) DEFAULT NULL,
  `id_film` char(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_studio`, `id_film`, `tanggal`, `jam_mulai`, `jam_selesai`) VALUES
('JDW001', 'STD001', 'FLM001', '2019-12-08', '23:00:00', '00:22:00'),
('JDW002', 'STD002', 'FLM001', '2019-12-09', '07:30:00', '09:22:00'),
('JDW003', 'STD001', 'FLM002', '2019-12-09', '09:20:00', '12:38:00'),
('JDW004', 'STD003', 'FLM006', '2019-12-10', '09:00:00', '12:30:00'),
('JDW005', 'STD003', 'FLM005', '2019-12-13', '15:01:00', '17:17:00'),
('JDW006', 'STD004', 'FLM004', '2019-12-13', '15:23:00', '17:23:00'),
('JDW007', 'STD001', 'FLM004', '2019-12-09', '16:17:00', '18:20:00'),
('JDW008', 'STD002', 'FLM005', '2019-12-09', '16:17:00', '18:17:00'),
('JDW009', 'STD003', 'FLM002', '2019-12-08', '23:05:00', '00:30:00'),
('JDW010', 'STD001', 'FLM002', '2019-12-09', '07:08:00', '08:09:00');

--
-- Triggers `jadwal`
--
DELIMITER $$
CREATE TRIGGER `hapus_pada_finish` BEFORE DELETE ON `jadwal` FOR EACH ROW DELETE FROM finish WHERE id_jadwal=OLD.id_jadwal
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_tiket` BEFORE DELETE ON `jadwal` FOR EACH ROW DELETE FROM tiket WHERE id_jadwal=OLD.id_jadwal
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_film`
--

CREATE TABLE `jenis_film` (
  `id_jns` char(10) NOT NULL,
  `jns_film` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_film`
--

INSERT INTO `jenis_film` (`id_jns`, `jns_film`) VALUES
('GEN009', 'Action'),
('GEN010', 'Adventure'),
('GEN011', 'Animation'),
('GEN012', 'Comedy'),
('GEN013', 'Crime'),
('GEN014', 'Drama'),
('GEN015', 'Fantasy'),
('GEN016', 'Family'),
('GEN017', 'Horror'),
('GEN018', 'Mystery'),
('GEN019', 'Romance'),
('GEN020', 'Thriller'),
('GEN021', 'Sci-Fi');

--
-- Triggers `jenis_film`
--
DELIMITER $$
CREATE TRIGGER `hapus_pada_film` BEFORE DELETE ON `jenis_film` FOR EACH ROW DELETE FROM film WHERE id_jns=OLD.id_jns
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kursi`
--

CREATE TABLE `kursi` (
  `id_kursi` char(10) NOT NULL,
  `id_studio` char(10) DEFAULT NULL,
  `nama_kursi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kursi`
--

INSERT INTO `kursi` (`id_kursi`, `id_studio`, `nama_kursi`) VALUES
('KRS001', 'STD001', 'A1'),
('KRS002', 'STD001', 'A2'),
('KRS003', 'STD001', 'A3'),
('KRS004', 'STD001', 'A4'),
('KRS005', 'STD001', 'A5'),
('KRS006', 'STD001', 'A6'),
('KRS007', 'STD001', 'A7'),
('KRS008', 'STD001', 'A8'),
('KRS009', 'STD001', 'A9'),
('KRS010', 'STD001', 'A10'),
('KRS011', 'STD001', 'A11'),
('KRS012', 'STD001', 'A12'),
('KRS013', 'STD001', 'B1'),
('KRS014', 'STD001', 'B2'),
('KRS015', 'STD001', 'B3'),
('KRS016', 'STD001', 'B4'),
('KRS017', 'STD001', 'B5'),
('KRS018', 'STD001', 'B6'),
('KRS019', 'STD001', 'B7'),
('KRS020', 'STD001', 'B8'),
('KRS021', 'STD001', 'B9'),
('KRS022', 'STD001', 'B10'),
('KRS023', 'STD002', 'A1'),
('KRS024', 'STD002', 'A2'),
('KRS025', 'STD002', 'A3'),
('KRS026', 'STD002', 'A4'),
('KRS027', 'STD002', 'A5'),
('KRS028', 'STD002', 'A6'),
('KRS029', 'STD002', 'A7'),
('KRS030', 'STD002', 'A8'),
('KRS031', 'STD002', 'B1'),
('KRS032', 'STD002', 'B2'),
('KRS033', 'STD002', 'B3'),
('KRS034', 'STD002', 'B4'),
('KRS035', 'STD003', 'A1'),
('KRS036', 'STD003', 'A2'),
('KRS037', 'STD003', 'A3'),
('KRS038', 'STD003', 'A4'),
('KRS039', 'STD003', 'A5'),
('KRS040', 'STD003', 'A6'),
('KRS041', 'STD003', 'A7'),
('KRS042', 'STD003', 'A8'),
('KRS043', 'STD003', 'A9'),
('KRS044', 'STD003', 'A10'),
('KRS045', 'STD003', 'B1'),
('KRS046', 'STD003', 'B2'),
('KRS047', 'STD003', 'B3'),
('KRS048', 'STD003', 'B4'),
('KRS049', 'STD003', 'B5'),
('KRS050', 'STD003', 'B6'),
('KRS051', 'STD004', 'A1'),
('KRS052', 'STD004', 'A2'),
('KRS053', 'STD004', 'A3'),
('KRS054', 'STD004', 'A4'),
('KRS055', 'STD004', 'B1'),
('KRS056', 'STD004', 'B2'),
('KRS057', 'STD004', 'B3'),
('KRS058', 'STD004', 'B4');

--
-- Triggers `kursi`
--
DELIMITER $$
CREATE TRIGGER `hapus_kursi_pada_finish` BEFORE DELETE ON `kursi` FOR EACH ROW DELETE FROM finish WHERE id_kursi=OLD.id_kursi
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_kursi_pada_kursi_order` BEFORE DELETE ON `kursi` FOR EACH ROW DELETE FROM kursi_order WHERE id_kursi=OLD.id_kursi
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_pada_temp_kursi` BEFORE DELETE ON `kursi` FOR EACH ROW DELETE FROM temp_kursi WHERE id_kursi=OLD.id_kursi
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kursi_order`
--

CREATE TABLE `kursi_order` (
  `id_pesan` char(20) NOT NULL,
  `id_tiket` char(20) NOT NULL,
  `id_kursi` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kursi_order`
--

INSERT INTO `kursi_order` (`id_pesan`, `id_tiket`, `id_kursi`) VALUES
('519803174', 'TKT001', 'KRS001');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` char(10) NOT NULL,
  `id_user` char(10) DEFAULT NULL,
  `tgl_pesan` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `payment_type` varchar(30) NOT NULL,
  `pdf_url` varchar(100) NOT NULL,
  `status` enum('success','failure','cencel','pending') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_user`, `tgl_pesan`, `total`, `payment_type`, `pdf_url`, `status`) VALUES
('519803174', 'USR015', '2019-12-08 22:41:49', 35000, 'bank_transfer', 'https://app.sandbox.midtrans.com/snap/v1/transactions/a1d59aa6-9fbb-45c9-b147-8f0d5806b80d/pdf', 'success');

--
-- Triggers `pesan`
--
DELIMITER $$
CREATE TRIGGER `hapus_di_finisih` BEFORE DELETE ON `pesan` FOR EACH ROW DELETE FROM finish WHERE id_pesan=OLD.id_pesan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_di_kursi_order` BEFORE DELETE ON `pesan` FOR EACH ROW DELETE FROM kursi_order WHERE id_pesan=OLD.id_pesan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_di_tiket_order` BEFORE DELETE ON `pesan` FOR EACH ROW DELETE FROM tiket_order WHERE id_pesan=OLD.id_pesan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `id_studio` char(10) NOT NULL,
  `nama_studio` varchar(20) DEFAULT NULL,
  `jenis` enum('vip','premium') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id_studio`, `nama_studio`, `jenis`) VALUES
('STD001', 'studio 01', 'premium'),
('STD002', 'studio 02', 'vip'),
('STD003', 'studio 03', 'premium'),
('STD004', 'studio 04', 'vip');

--
-- Triggers `studio`
--
DELIMITER $$
CREATE TRIGGER `hapus_jadwal` BEFORE DELETE ON `studio` FOR EACH ROW DELETE FROM jadwal WHERE id_studio=OLD.id_studio
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_kursi` BEFORE DELETE ON `studio` FOR EACH ROW DELETE FROM kursi WHERE id_studio=OLD.id_studio
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `temp_kursi`
--

CREATE TABLE `temp_kursi` (
  `id_pemesanan` char(20) NOT NULL,
  `id_kursi` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_kursi`
--

INSERT INTO `temp_kursi` (`id_pemesanan`, `id_kursi`) VALUES
('TMP002', 'KRS002'),
('TMP002', 'KRS003'),
('TMP002', 'KRS004');

-- --------------------------------------------------------

--
-- Table structure for table `temp_pesan`
--

CREATE TABLE `temp_pesan` (
  `id_pemesanan` char(15) NOT NULL,
  `id_user` char(10) DEFAULT NULL,
  `id_tiket` char(10) DEFAULT NULL,
  `tgl_pesan` date DEFAULT NULL,
  `banyak` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_pesan`
--

INSERT INTO `temp_pesan` (`id_pemesanan`, `id_user`, `id_tiket`, `tgl_pesan`, `banyak`, `total`) VALUES
('TMP002', 'USR014', 'TKT001', '2019-12-08', 3, 105000);

--
-- Triggers `temp_pesan`
--
DELIMITER $$
CREATE TRIGGER `hapus_temp_kursi` BEFORE DELETE ON `temp_pesan` FOR EACH ROW DELETE FROM temp_kursi WHERE id_pemesanan=OLD.id_pemesanan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` char(10) NOT NULL,
  `id_jadwal` char(10) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_jadwal`, `harga`, `stock`) VALUES
('TKT001', 'JDW001', 35000, 21),
('TKT002', 'JDW002', 40000, 12),
('TKT003', 'JDW003', 35000, 22),
('TKT004', 'JDW004', 35000, 16),
('TKT005', 'JDW005', 35000, 16),
('TKT006', 'JDW006', 40000, 8),
('TKT007', 'JDW007', 35000, 22),
('TKT008', 'JDW010', 20000, 22);

--
-- Triggers `tiket`
--
DELIMITER $$
CREATE TRIGGER `hapus_kursi_order` BEFORE DELETE ON `tiket` FOR EACH ROW DELETE FROM kursi_order WHERE id_tiket=OLD.id_tiket
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_temp_pemesanan` BEFORE DELETE ON `tiket` FOR EACH ROW DELETE FROM temp_pesan WHERE id_tiket=OLD.id_tiket
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_tiket_order` BEFORE DELETE ON `tiket` FOR EACH ROW DELETE FROM tiket_order WHERE id_tiket=OLD.id_tiket
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tiket_order`
--

CREATE TABLE `tiket_order` (
  `id_pesan` char(10) DEFAULT NULL,
  `id_tiket` char(10) DEFAULT NULL,
  `banyak` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket_order`
--

INSERT INTO `tiket_order` (`id_pesan`, `id_tiket`, `banyak`, `total`) VALUES
('519803174', 'TKT001', 1, 35000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(10) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `hak_akses` enum('admin','penjualan','petugas','customer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `jenis_kelamin`, `password`, `hak_akses`) VALUES
('USR001', 'faisol', 'faisolkaztelo69@gmail.com', 'L', 'admin', 'admin'),
('USR002', 'Ach Faisol S. Arifin', 'faisolkaztelo69@gmail.com', 'L', 'belajar', 'customer'),
('USR003', 'Wahyu Zainur', 'wahyu.zainurputra@gmail.com', 'L', '128', 'admin'),
('USR004', 'Mareta Kurnia S', 'maretakurnia@gmail.com', 'P', 'cans', 'penjualan'),
('USR005', 'Rike Ayu', 'rikeayua@gmail.com', 'P', 'jual', 'penjualan'),
('USR007', 'imamgl', 'imam@gmail.com', 'L', 'petugas', 'petugas'),
('USR008', 'andro', 'android@gmail.com', 'L', 'asdf', 'petugas'),
('USR010', 'Rio Erfian Danuri', 'erfianrio30@gmail.com', 'L', 'rioerfian80', 'customer'),
('USR011', 'reta', 'maretakurniasari@gmail.com', 'P', 'retacans', 'customer'),
('USR014', 'idris', 'idrisramadianz07@gmail.com', 'L', 'gemini07', 'customer'),
('USR015', 'Wahyu Zainur', 'wahyu@gmail.com', 'L', 'customer', 'customer');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `hapus_di_film` BEFORE DELETE ON `user` FOR EACH ROW DELETE FROM film WHERE id_user=OLD.id_user
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_di_pesan` BEFORE DELETE ON `user` FOR EACH ROW DELETE FROM pesan WHERE id_user=OLD.id_user
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_id_finish` BEFORE DELETE ON `user` FOR EACH ROW DELETE FROM finish WHERE id_user=OLD.id_user
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapus_pada_temp_pemesanan` BEFORE DELETE ON `user` FOR EACH ROW DELETE FROM temp_pesan WHERE id_user=OLD.id_user
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`),
  ADD KEY `mengentry_fk` (`id_user`),
  ADD KEY `bergenre_fk` (`id_jns`);

--
-- Indexes for table `finish`
--
ALTER TABLE `finish`
  ADD PRIMARY KEY (`id_success`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pesan` (`id_pesan`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_kursi` (`id_kursi`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `dijadwalkan_fk` (`id_film`),
  ADD KEY `mempunyai_fk` (`id_studio`);

--
-- Indexes for table `jenis_film`
--
ALTER TABLE `jenis_film`
  ADD PRIMARY KEY (`id_jns`);

--
-- Indexes for table `kursi`
--
ALTER TABLE `kursi`
  ADD PRIMARY KEY (`id_kursi`),
  ADD KEY `memiliki_fk` (`id_studio`);

--
-- Indexes for table `kursi_order`
--
ALTER TABLE `kursi_order`
  ADD KEY `id_pesan` (`id_pesan`),
  ADD KEY `id_tiket` (`id_tiket`),
  ADD KEY `id_kursi` (`id_kursi`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `membooking_fk` (`id_user`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id_studio`);

--
-- Indexes for table `temp_kursi`
--
ALTER TABLE `temp_kursi`
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_kursi` (`id_kursi`);

--
-- Indexes for table `temp_pesan`
--
ALTER TABLE `temp_pesan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `memesan_fk` (`id_user`),
  ADD KEY `dibooking_fk` (`id_tiket`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `menyediakan_fk` (`id_jadwal`);

--
-- Indexes for table `tiket_order`
--
ALTER TABLE `tiket_order`
  ADD KEY `fix_booking_fk` (`id_tiket`),
  ADD KEY `pesanan_fk` (`id_pesan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `film_ibfk_2` FOREIGN KEY (`id_jns`) REFERENCES `jenis_film` (`id_jns`);

--
-- Constraints for table `finish`
--
ALTER TABLE `finish`
  ADD CONSTRAINT `finish_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `finish_ibfk_2` FOREIGN KEY (`id_pesan`) REFERENCES `pesan` (`id_pesan`),
  ADD CONSTRAINT `finish_ibfk_3` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`),
  ADD CONSTRAINT `finish_ibfk_4` FOREIGN KEY (`id_kursi`) REFERENCES `kursi` (`id_kursi`);

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`);

--
-- Constraints for table `kursi`
--
ALTER TABLE `kursi`
  ADD CONSTRAINT `kursi_ibfk_1` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`);

--
-- Constraints for table `kursi_order`
--
ALTER TABLE `kursi_order`
  ADD CONSTRAINT `kursi_order_ibfk_1` FOREIGN KEY (`id_kursi`) REFERENCES `kursi` (`id_kursi`),
  ADD CONSTRAINT `kursi_order_ibfk_2` FOREIGN KEY (`id_pesan`) REFERENCES `pesan` (`id_pesan`),
  ADD CONSTRAINT `kursi_order_ibfk_3` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id_tiket`);

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `temp_kursi`
--
ALTER TABLE `temp_kursi`
  ADD CONSTRAINT `temp_kursi_ibfk_1` FOREIGN KEY (`id_kursi`) REFERENCES `kursi` (`id_kursi`),
  ADD CONSTRAINT `temp_kursi_ibfk_2` FOREIGN KEY (`id_pemesanan`) REFERENCES `temp_pesan` (`id_pemesanan`);

--
-- Constraints for table `temp_pesan`
--
ALTER TABLE `temp_pesan`
  ADD CONSTRAINT `temp_pesan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `temp_pesan_ibfk_2` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id_tiket`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`);

--
-- Constraints for table `tiket_order`
--
ALTER TABLE `tiket_order`
  ADD CONSTRAINT `tiket_order_ibfk_1` FOREIGN KEY (`id_pesan`) REFERENCES `pesan` (`id_pesan`),
  ADD CONSTRAINT `tiket_order_ibfk_2` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id_tiket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
