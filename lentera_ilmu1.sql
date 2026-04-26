-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2026 at 12:52 PM
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
-- Database: `lentera_ilmu1`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `id_penerbit` int(11) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tersedia` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `cover` varchar(255) NOT NULL,
  `file_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `isbn`, `judul`, `id_kategori`, `id_penulis`, `id_penerbit`, `tahun_terbit`, `jumlah`, `tersedia`, `deskripsi`, `cover`, `file_pdf`) VALUES
(1, '978-602-03-1239-4', 'bumi', 2, 1, 1, '2014', 7, 10, 'Novel ini mengisahkan tentang Raib, seorang remaja perempuan 15 tahun yang memiliki kemampuan istimewa untuk menghilang. Petualangan dimulai ketika Raib terjebak dalam konflik dunia paralel, khususnya klan Bulan. Bersama dua sahabatnya, Seli (keturunan Klan Matahari) dan Ali (keturunan klan Bumi yang jenius), mereka berpetualang dan melawan makhluk jahat yang mengancam dunia, salah satunya Tamus.', '1777140279_ab3e0ff030e334523acb.jpg', 'bacabumi.pdf'),
(7, ' 978-623-7131-63-2', 'Kursus Mandiri Python', 3, 3, 2, '2022', 9, 10, 'Buku ini dirancang sebagai panduan belajar mandiri untuk menguasai bahasa Python dari tingkat dasar hingga tahap yang lebih lanjut. Pembahasan dibagi menjadi 5 tahap untuk memudahkan pemahaman. Materi mencakup konsep dasar pemrograman Python, sintaksis, struktur kontrol, tipe data, serta pemrograman berorientasi objek (OOP). Buku ini juga membahas penggunaan pustaka standar, pembuatan database menggunakan SQL/MySQL, dan pembuatan antarmuka pengguna (GUI) dengan PyQt', '1777140347_82bfb58364796cfcd452.jpg', 'phyton.pdf'),
(8, '978-602-220-433-6', 'azzamine', 2, 4, 3, '2022', 10, 10, ' Novel ini berkisah tentang perjalanan cinta antara Raden Azzam Al-Baihaqi, seorang mahasiswa religius yang sopan, dan Haura Jasmine, seorang gadis yang memiliki sifat kurang sopan. Cerita bermula dari kisah perjodohan di antara keduanya, di mana Azzam berusaha memenangkan hati Jasmine dengan kelembutan dan religiusitasnya. ', '1776747373_c65677b28118dfea3a74.jpg', ''),
(9, '9786239607487', 'Hafalan Shalat Delisa', 2, 1, 4, '2021', 8, 10, 'Novel ini mengisahkan tentang Delisa, gadis kecil berusia 6 tahun yang ceria, tinggal di Lhok-Nga, Aceh. Delisa sedang belajar menghafal bacaan shalat untuk ujian praktek di sekolahnya. Saat tsunami menerjang Aceh pada tahun 2004, Delisa terpisah dari ibu dan kakak-kakaknya, serta harus merelakan kakinya diamputasi. Novel ini menyentuh hati, menceritakan tentang keikhlasan, keteguhan, dan perjuangan seorang anak dalam menghadapi musibah besar.', '1776753918_33a8430be67995d315f6.jpg', 'delisa.pdf'),
(10, '978-602-8689-72-4', 'Korupsi dalam Hukum Pidana Islam', 4, 5, 5, '2014', 10, 10, 'Buku ini membahas penanggulangan tindak pidana korupsi melalui analisis hukum pidana Islam. Dijelaskan bahwa korupsi adalah kejahatan serius yang merugikan rakyat, sehingga pelakunya layak mendapat hukuman berat. Selain hukuman duniawi, buku ini menekankan sanksi ukhrawi bagi para koruptor akibat perbuatan curang dan memakan harta haram, serta menjadi peringatan untuk segera bertaubat.', '1777135030_47d1c5929ae389568eff.jpg', '1776802095_183e674e5357e4c9a989.pdf'),
(11, '978-1546304401 ', '46 Resep Variasi Nasi Goreng', 6, 8, 8, '2013', 6, 10, 'Buku ini berisi 46 variasi resep nasi goreng yang disusun untuk mempermudah mencari menu nasi goreng yang cocok dengan lidah keluarga, guna menghindari rasa bosan terhadap menu yang itu-itu saja. Buku ini mencakup resep-resep dengan bahan halal, sejarah dan pengenalan nasi goreng, serta sering digunakan sebagai dasar untuk berkreasi membuat variasi baru. Edisi ini merupakan edisi kedua (perbaikan dari terbitan 2009) yang menyediakan panduan praktis untuk memasak nasi goreng yang tidak membosankan. ', '1776829329_8016de4d1a7ac7ac7ea0.jpg', 'nasgor.pdf'),
(12, '9786020639536 ', 'Nebula', 2, 1, 9, '2020', 0, 10, 'Nebula adalah buku ke-9 dari serial dunia paralel yang merupakan lanjutan langsung dari novel Selena. Novel ini mengisahkan masa muda Selena, Mata, dan Tazk yang belajar di Akademi Bayangan Tingkat Tinggi (ABTT). Cerita fokus pada petualangan tiga sahabat ini dalam merencanakan perjalanan ke klan Nebula yang berujung pada ujian persahabatan, egoisme, pengkhianatan, serta rahasia tentang orang tua Raib.', '1776837370_e963119afbeeba8b53c9.jpg', 'Nebula.pdf'),
(13, '9786020639512 ', 'Selena', 2, 1, 9, '2020', 0, 10, 'Novel ini merupakan buku ke-8 dalam serial petualangan dunia paralel (seri Bumi) yang berfokus pada kisah masa lalu Miss Selena, seorang guru matematika. Cerita mengikuti kehidupan Selena, seorang gadis yatim piatu di Klan Bulan yang memiliki bakat istimewa sebagai pengintai. Ia berusaha mengejar cita-citanya untuk masuk Akademi Bayangan Tingkat Tinggi dan menghadapi petualangan yang diuji dengan rasa suka, egoisme, dan pengkhianatan.', '1776838094_c19e7fc43e54c243eca3.jpg', 'selena.pdf'),
(14, '978-602-9193-67-1', 'Sejarah Dunia yang Disembunyikan', 7, 9, 10, '2022', 0, 10, 'Buku ini adalah terjemahan dari The Secret History of the World. Jonathan Black menawarkan narasi alternatif mengenai sejarah manusia selama 3.000 tahun lebih. Buku ini membahas peristiwa-peristiwa dunia dari sudut pandang tradisi esoterik, mitologi Yunani, Mesir Kuno, cerita rakyat Yahudi, hingga kisah-kisah di balik Freemason. Isinya menantang sejarah konvensional yang dianggap ditulis oleh para pemenang, serta mengungkap rahasia yang mungkin sengaja disembunyikan dari publik.', '1776838463_16d91f4fe9a01540b0a5.jpg', 'sejarah.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `buku_rak`
--

CREATE TABLE `buku_rak` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_rak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku_rak`
--

INSERT INTO `buku_rak` (`id`, `id_buku`, `id_rak`) VALUES
(9, 6, 4),
(27, 11, 13),
(28, 12, 1),
(33, 13, 9),
(38, 16, 15),
(46, 8, 17),
(49, 9, 3),
(50, 10, 7),
(51, 14, 8),
(54, 1, 16),
(55, 7, 11);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `id_pengembalian` int(11) NOT NULL,
  `total_denda` int(11) DEFAULT 0,
  `hari_terlambat` int(11) DEFAULT 0,
  `status_bayar` enum('belum','lunas') DEFAULT 'belum',
  `metode_bayar` enum('cash','dana','qris') DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_detail`, `id_peminjaman`, `id_buku`, `jumlah`) VALUES
(22, 0, 8, 1),
(23, 0, 7, 1),
(28, 0, 9, 1),
(37, 0, 10, 1),
(38, 0, 12, 1),
(40, 0, 13, 1),
(45, 0, 11, 1),
(46, 0, 1, 1),
(47, 0, 14, 1),
(71, 104, 11, 1),
(72, 105, 12, 1),
(73, 106, 11, 1),
(74, 107, 9, 1),
(75, 108, 11, 1),
(76, 109, 9, 1),
(77, 110, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'hadits'),
(2, 'novel'),
(3, 'Pemrograman'),
(4, 'hukum\r\n'),
(5, 'cerpen'),
(6, 'resep'),
(7, 'sejarah');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_petugas` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('dipinjam','dikembalikan','menunggu') NOT NULL,
  `jumlah_perpanjang` int(11) DEFAULT 0,
  `status_perpanjang` enum('tidak','menunggu','disetujui','ditolak') DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_anggota`, `id_petugas`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `jumlah_perpanjang`, `status_perpanjang`) VALUES
(106, 6, 1, '2026-04-26', '2026-05-02', 'dikembalikan', 0, 'tidak'),
(107, 6, 1, '2026-04-26', '2026-05-02', 'menunggu', 0, 'tidak'),
(108, 6, 1, '2026-04-26', '2026-05-02', 'menunggu', 0, 'tidak'),
(110, NULL, 1, '2026-04-26', '2026-05-02', 'dipinjam', 0, 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`) VALUES
(1, 'pustaka al kautsar', 'Jl. Cipinang Muara Raya No.63, RT.14/RW.3, Cipinang Muara, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13420'),
(2, 'Informatika', 'bandung'),
(3, 'Bukune', 'yogyakarta'),
(4, 'Sabak Grip', 'jakarta'),
(5, 'Amzah (Bumi Aksara Group)', 'jakarta'),
(6, ' Deepublish', 'bantul'),
(7, 'Cloud Books ', 'jakarta'),
(8, 'Pustaka Hanan', 'medan'),
(9, 'PT Gramedia Pustaka Utama ', 'Gedung Gramedia Pustaka Utama, Jl. Palmerah Barat 29-37, Jakarta 10270 '),
(10, 'PT Pustaka Alvabet', 'jakarta'),
(12, 'bintang pustaka', 'jakarta\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `status` enum('dipinjam','menunggu','dikembalikan') NOT NULL,
  `denda` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_peminjaman`, `tanggal_dikembalikan`, `status`, `denda`) VALUES
(73, 0, '2026-04-26', '', 0),
(76, 101, '2026-04-26', '', 0),
(77, 102, '2026-04-26', '', 0),
(78, 103, '2026-04-26', '', 0),
(79, 104, '2026-04-26', '', 0),
(80, 105, NULL, '', 0),
(81, 106, '2026-04-26', '', 0),
(82, 107, NULL, '', 0),
(83, 108, NULL, '', 0),
(85, 110, NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL,
  `nama_penulis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`) VALUES
(1, 'tere liye'),
(2, 'Syaikh Abdullah bin Hamoud Al Furaih \r\n'),
(3, 'Budi Raharjo'),
(4, 'Sophie Aulia'),
(5, 'M. Nurul Irfan'),
(6, 'S.S. Dewi Anggraeni'),
(7, 'Visya Nabila'),
(8, 'Tim Pustaka Hanan'),
(9, 'Jonathan Black'),
(11, 'A. Fuadi'),
(12, 'Andrea Hirata');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jabatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `id_user`, `jabatan`) VALUES
(1, 2, 'sirkulasi');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id_rak`, `nama_rak`, `lokasi`) VALUES
(1, 'A1', 'lantai 1'),
(2, 'A2', 'lantai 2'),
(3, 'B1', 'lantai 2'),
(4, 'B2', 'lantai 2'),
(5, 'C1', 'lantai 1'),
(6, 'C2', 'lantai 1'),
(7, 'D1', 'lantai 2'),
(8, 'D2', 'lantai 2'),
(9, 'A3', 'lantai 1'),
(10, 'A4', 'lantai 1'),
(11, 'E1', 'lantai 3'),
(12, 'B3', 'lantai 2'),
(13, 'B4', 'lantai 2'),
(14, 'C3', 'lantai 2'),
(15, 'C4', 'lantai 2'),
(16, 'D3', 'lantai 3'),
(17, 'D4', 'lantai 3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `role`, `foto`, `status`, `created_at`) VALUES
(1, 'iis sadiyah', 'iis.sadiyah7@smk.belajar.id', 'iisadmin', '$2y$10$C0ROOpUfNOyQXWRKOQlZDOSJu9YlS/ShOk4ZDv9CdEjLr4AddrM0G', 'admin', '1776742804_5aed2a82596c7e813bbe.jpg', 'aktif', '2026-04-20 19:27:55'),
(2, 'siti kartika', 'tika7@smk.belajar.id', 'tika', '$2y$10$zPXYLfgY5dFn8/NpTWRWT.HAf087gh9HnDIX1Yao.71IDba2rEXMK', 'petugas', '1776796013_668a0ecc8c06ad0e7c3a.jpg', 'aktif', '2026-04-20 19:27:55'),
(3, 'insaniar', 'insaniar@smk.belajar.id', 'ican', '$2y$10$T0bsFJ6.UBkb7UUVsPRE7evuFLfL5JxQswvM1RHIRrxjl2BVIyUOS', 'anggota', '1776796061_f111db71bc76c76db93a.jpg', 'aktif', '2026-04-20 19:28:31'),
(4, 'hasanatuzzulfa', 'hasanatuzzulfa.35@smk.belajar.id', 'izul', '$2y$10$etPR2bDScoZcKer3ymH/8ew3hi0/rXkcMbIZf.EGOJ.7igy2RlsZ6', 'anggota', '1776870328_3c3e3a7db038eb4e7314.jpg', 'aktif', '2026-04-21 01:48:10'),
(5, 'Imey Siti', 'imey.siti07@smk.belajar.id', 'meyy', '$2y$10$JwmZ241CfPKXNcqZBtqod.Jkph25BuJCmjZYdONwOAN5EgKsuoim2', 'anggota', '1776738327_d6b7dd68f28f1b4d24ad.png', 'aktif', '2026-04-21 02:25:27'),
(6, 'siti humairoh', 'siti.humairoh54@smk.belajar.id', 'umaa', '$2y$10$s8aGwYDlpTHm1EZ08PP/V.0DDNLGKSDx719Eb1eW6yXIMTBY7jCgq', 'anggota', '1776795505_c12cb529ee77700a6f22.webp', 'aktif', '2026-04-21 02:26:07'),
(7, 'IcaImuttt', 'IcaImut@gmail.com', 'IcaImut', '$2y$10$gNRJu8CGI4P807b24uxfyu2nKcTRmDuPq4WddrxcZ/OmZ0f3s36VW', 'anggota', '1776742826_72aa1b24196f125d19c6.jpg', 'aktif', '2026-04-21 03:19:05'),
(8, 'iis sadiyah', 'iis.sadiyah7@smk.belajar.id', 'iis', '$2y$10$9GR.Fzu7Cvt9LX4Dcz6LjepZw.p3JK1/KaxIadvcvad9RXDwfGsBS', 'admin', '1776796709_9223a361d6b62435c1d4.png', 'aktif', '2026-04-21 18:36:42'),
(9, 'neneng niar', 'nenengniar@gmail.com', 'neneng', '$2y$10$2u7as14ya.CzUmbYPzHRwupZAJS2R1MvogkxhX0CndtvO1m.qZc6q', 'anggota', '1776841422_11a848ed864c97d8f2a9.jpg', 'aktif', '2026-04-22 07:03:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `buku_rak`
--
ALTER TABLE `buku_rak`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_buku` (`id_buku`),
  ADD UNIQUE KEY `id_rak` (`id_rak`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`),
  ADD KEY `id_pengembalian` (`id_pengembalian`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD UNIQUE KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `buku_rak`
--
ALTER TABLE `buku_rak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
