-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: lentera_ilmu1
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
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
  `file_pdf` varchar(255) NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES (1,'978-602-03-1239-4','bumi',2,1,1,2014,7,10,'Novel ini mengisahkan tentang Raib, seorang remaja perempuan 15 tahun yang memiliki kemampuan istimewa untuk menghilang. Petualangan dimulai ketika Raib terjebak dalam konflik dunia paralel, khususnya klan Bulan. Bersama dua sahabatnya, Seli (keturunan Klan Matahari) dan Ali (keturunan klan Bumi yang jenius), mereka berpetualang dan melawan makhluk jahat yang mengancam dunia, salah satunya Tamus.','1777140279_ab3e0ff030e334523acb.jpg','bacabumi.pdf'),(7,' 978-623-7131-63-2','Kursus Mandiri Python',3,3,2,2022,9,10,'Buku ini dirancang sebagai panduan belajar mandiri untuk menguasai bahasa Python dari tingkat dasar hingga tahap yang lebih lanjut. Pembahasan dibagi menjadi 5 tahap untuk memudahkan pemahaman. Materi mencakup konsep dasar pemrograman Python, sintaksis, struktur kontrol, tipe data, serta pemrograman berorientasi objek (OOP). Buku ini juga membahas penggunaan pustaka standar, pembuatan database menggunakan SQL/MySQL, dan pembuatan antarmuka pengguna (GUI) dengan PyQt','1777140347_82bfb58364796cfcd452.jpg','phyton.pdf'),(8,'978-602-220-433-6','azzamine',2,4,3,2022,10,10,' Novel ini berkisah tentang perjalanan cinta antara Raden Azzam Al-Baihaqi, seorang mahasiswa religius yang sopan, dan Haura Jasmine, seorang gadis yang memiliki sifat kurang sopan. Cerita bermula dari kisah perjodohan di antara keduanya, di mana Azzam berusaha memenangkan hati Jasmine dengan kelembutan dan religiusitasnya. ','1776747373_c65677b28118dfea3a74.jpg',''),(9,'9786239607487','Hafalan Shalat Delisa',2,1,4,2021,8,10,'Novel ini mengisahkan tentang Delisa, gadis kecil berusia 6 tahun yang ceria, tinggal di Lhok-Nga, Aceh. Delisa sedang belajar menghafal bacaan shalat untuk ujian praktek di sekolahnya. Saat tsunami menerjang Aceh pada tahun 2004, Delisa terpisah dari ibu dan kakak-kakaknya, serta harus merelakan kakinya diamputasi. Novel ini menyentuh hati, menceritakan tentang keikhlasan, keteguhan, dan perjuangan seorang anak dalam menghadapi musibah besar.','1776753918_33a8430be67995d315f6.jpg','delisa.pdf'),(10,'978-602-8689-72-4','Korupsi dalam Hukum Pidana Islam',4,5,5,2014,10,10,'Buku ini membahas penanggulangan tindak pidana korupsi melalui analisis hukum pidana Islam. Dijelaskan bahwa korupsi adalah kejahatan serius yang merugikan rakyat, sehingga pelakunya layak mendapat hukuman berat. Selain hukuman duniawi, buku ini menekankan sanksi ukhrawi bagi para koruptor akibat perbuatan curang dan memakan harta haram, serta menjadi peringatan untuk segera bertaubat.','1777135030_47d1c5929ae389568eff.jpg','1776802095_183e674e5357e4c9a989.pdf'),(11,'978-1546304401 ','46 Resep Variasi Nasi Goreng',6,8,8,2013,6,10,'Buku ini berisi 46 variasi resep nasi goreng yang disusun untuk mempermudah mencari menu nasi goreng yang cocok dengan lidah keluarga, guna menghindari rasa bosan terhadap menu yang itu-itu saja. Buku ini mencakup resep-resep dengan bahan halal, sejarah dan pengenalan nasi goreng, serta sering digunakan sebagai dasar untuk berkreasi membuat variasi baru. Edisi ini merupakan edisi kedua (perbaikan dari terbitan 2009) yang menyediakan panduan praktis untuk memasak nasi goreng yang tidak membosankan. ','1776829329_8016de4d1a7ac7ac7ea0.jpg','nasgor.pdf'),(12,'9786020639536 ','Nebula',2,1,9,2020,0,10,'Nebula adalah buku ke-9 dari serial dunia paralel yang merupakan lanjutan langsung dari novel Selena. Novel ini mengisahkan masa muda Selena, Mata, dan Tazk yang belajar di Akademi Bayangan Tingkat Tinggi (ABTT). Cerita fokus pada petualangan tiga sahabat ini dalam merencanakan perjalanan ke klan Nebula yang berujung pada ujian persahabatan, egoisme, pengkhianatan, serta rahasia tentang orang tua Raib.','1776837370_e963119afbeeba8b53c9.jpg','Nebula.pdf'),(13,'9786020639512 ','Selena',2,1,9,2020,0,10,'Novel ini merupakan buku ke-8 dalam serial petualangan dunia paralel (seri Bumi) yang berfokus pada kisah masa lalu Miss Selena, seorang guru matematika. Cerita mengikuti kehidupan Selena, seorang gadis yatim piatu di Klan Bulan yang memiliki bakat istimewa sebagai pengintai. Ia berusaha mengejar cita-citanya untuk masuk Akademi Bayangan Tingkat Tinggi dan menghadapi petualangan yang diuji dengan rasa suka, egoisme, dan pengkhianatan.','1776838094_c19e7fc43e54c243eca3.jpg','selena.pdf'),(14,'978-602-9193-67-1','Sejarah Dunia yang Disembunyikan',7,9,10,2022,0,10,'Buku ini adalah terjemahan dari The Secret History of the World. Jonathan Black menawarkan narasi alternatif mengenai sejarah manusia selama 3.000 tahun lebih. Buku ini membahas peristiwa-peristiwa dunia dari sudut pandang tradisi esoterik, mitologi Yunani, Mesir Kuno, cerita rakyat Yahudi, hingga kisah-kisah di balik Freemason. Isinya menantang sejarah konvensional yang dianggap ditulis oleh para pemenang, serta mengungkap rahasia yang mungkin sengaja disembunyikan dari publik.','1776838463_16d91f4fe9a01540b0a5.jpg','sejarah.pdf');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku_rak`
--

DROP TABLE IF EXISTS `buku_rak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku_rak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) NOT NULL,
  `id_rak` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_buku` (`id_buku`),
  UNIQUE KEY `id_rak` (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku_rak`
--

LOCK TABLES `buku_rak` WRITE;
/*!40000 ALTER TABLE `buku_rak` DISABLE KEYS */;
INSERT INTO `buku_rak` VALUES (9,6,4),(27,11,13),(28,12,1),(33,13,9),(38,16,15),(46,8,17),(49,9,3),(50,10,7),(51,14,8),(54,1,16),(55,7,11);
/*!40000 ALTER TABLE `buku_rak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denda`
--

DROP TABLE IF EXISTS `denda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengembalian` int(11) NOT NULL,
  `total_denda` int(11) DEFAULT 0,
  `hari_terlambat` int(11) DEFAULT 0,
  `status_bayar` enum('belum','lunas') DEFAULT 'belum',
  `metode_bayar` enum('cash','dana','qris') DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  PRIMARY KEY (`id_denda`),
  KEY `id_pengembalian` (`id_pengembalian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denda`
--

LOCK TABLES `denda` WRITE;
/*!40000 ALTER TABLE `denda` DISABLE KEYS */;
/*!40000 ALTER TABLE `denda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_peminjaman`
--

DROP TABLE IF EXISTS `detail_peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_peminjaman`
--

LOCK TABLES `detail_peminjaman` WRITE;
/*!40000 ALTER TABLE `detail_peminjaman` DISABLE KEYS */;
INSERT INTO `detail_peminjaman` VALUES (22,0,8,1),(23,0,7,1),(28,0,9,1),(37,0,10,1),(38,0,12,1),(40,0,13,1),(45,0,11,1),(46,0,1,1),(47,0,14,1),(71,104,11,1),(72,105,12,1),(73,106,11,1),(74,107,9,1),(75,108,11,1),(76,109,9,1),(77,110,11,1);
/*!40000 ALTER TABLE `detail_peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'hadits'),(2,'novel'),(3,'Pemrograman'),(4,'hukum\r\n'),(5,'cerpen'),(6,'resep'),(7,'sejarah');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) DEFAULT NULL,
  `id_petugas` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('dipinjam','dikembalikan','menunggu') NOT NULL,
  `jumlah_perpanjang` int(11) DEFAULT 0,
  `status_perpanjang` enum('tidak','menunggu','disetujui','ditolak') DEFAULT 'tidak',
  PRIMARY KEY (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (106,6,1,'2026-04-26','2026-05-02','dikembalikan',0,'tidak'),(107,6,1,'2026-04-26','2026-05-02','menunggu',0,'tidak'),(108,6,1,'2026-04-26','2026-05-02','menunggu',0,'tidak'),(110,NULL,1,'2026-04-26','2026-05-02','dipinjam',0,'tidak');
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penerbit`
--

DROP TABLE IF EXISTS `penerbit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penerbit`
--

LOCK TABLES `penerbit` WRITE;
/*!40000 ALTER TABLE `penerbit` DISABLE KEYS */;
INSERT INTO `penerbit` VALUES (1,'pustaka al kautsar','Jl. Cipinang Muara Raya No.63, RT.14/RW.3, Cipinang Muara, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13420'),(2,'Informatika','bandung'),(3,'Bukune','yogyakarta'),(4,'Sabak Grip','jakarta'),(5,'Amzah (Bumi Aksara Group)','jakarta'),(6,' Deepublish','bantul'),(7,'Cloud Books ','jakarta'),(8,'Pustaka Hanan','medan'),(9,'PT Gramedia Pustaka Utama ','Gedung Gramedia Pustaka Utama, Jl. Palmerah Barat 29-37, Jakarta 10270 '),(10,'PT Pustaka Alvabet','jakarta'),(12,'bintang pustaka','jakarta\r\n');
/*!40000 ALTER TABLE `penerbit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengembalian`
--

DROP TABLE IF EXISTS `pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `status` enum('dipinjam','menunggu','dikembalikan') NOT NULL,
  `denda` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_pengembalian`),
  UNIQUE KEY `id_peminjaman` (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengembalian`
--

LOCK TABLES `pengembalian` WRITE;
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
INSERT INTO `pengembalian` VALUES (73,0,'2026-04-26','',0),(76,101,'2026-04-26','',0),(77,102,'2026-04-26','',0),(78,103,'2026-04-26','',0),(79,104,'2026-04-26','',0),(80,105,NULL,'',0),(81,106,'2026-04-26','',0),(82,107,NULL,'',0),(83,108,NULL,'',0),(85,110,NULL,'',0);
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penulis`
--

DROP TABLE IF EXISTS `penulis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(100) NOT NULL,
  PRIMARY KEY (`id_penulis`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penulis`
--

LOCK TABLES `penulis` WRITE;
/*!40000 ALTER TABLE `penulis` DISABLE KEYS */;
INSERT INTO `penulis` VALUES (1,'tere liye'),(2,'Syaikh Abdullah bin Hamoud Al Furaih \r\n'),(3,'Budi Raharjo'),(4,'Sophie Aulia'),(5,'M. Nurul Irfan'),(6,'S.S. Dewi Anggraeni'),(7,'Visya Nabila'),(8,'Tim Pustaka Hanan'),(9,'Jonathan Black'),(11,'A. Fuadi'),(12,'Andrea Hirata');
/*!40000 ALTER TABLE `penulis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `jabatan` text NOT NULL,
  PRIMARY KEY (`id_petugas`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petugas`
--

LOCK TABLES `petugas` WRITE;
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
INSERT INTO `petugas` VALUES (1,2,'sirkulasi');
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rak`
--

DROP TABLE IF EXISTS `rak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rak`
--

LOCK TABLES `rak` WRITE;
/*!40000 ALTER TABLE `rak` DISABLE KEYS */;
INSERT INTO `rak` VALUES (1,'A1','lantai 1'),(2,'A2','lantai 2'),(3,'B1','lantai 2'),(4,'B2','lantai 2'),(5,'C1','lantai 1'),(6,'C2','lantai 1'),(7,'D1','lantai 2'),(8,'D2','lantai 2'),(9,'A3','lantai 1'),(10,'A4','lantai 1'),(11,'E1','lantai 3'),(12,'B3','lantai 2'),(13,'B4','lantai 2'),(14,'C3','lantai 2'),(15,'C4','lantai 2'),(16,'D3','lantai 3'),(17,'D4','lantai 3');
/*!40000 ALTER TABLE `rak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'iis sadiyah','iis.sadiyah7@smk.belajar.id','iisadmin','$2y$10$C0ROOpUfNOyQXWRKOQlZDOSJu9YlS/ShOk4ZDv9CdEjLr4AddrM0G','admin','1776742804_5aed2a82596c7e813bbe.jpg','aktif','2026-04-20 19:27:55'),(2,'siti kartika','tika7@smk.belajar.id','tika','$2y$10$zPXYLfgY5dFn8/NpTWRWT.HAf087gh9HnDIX1Yao.71IDba2rEXMK','petugas','1776796013_668a0ecc8c06ad0e7c3a.jpg','aktif','2026-04-20 19:27:55'),(3,'insaniar','insaniar@smk.belajar.id','ican','$2y$10$T0bsFJ6.UBkb7UUVsPRE7evuFLfL5JxQswvM1RHIRrxjl2BVIyUOS','anggota','1776796061_f111db71bc76c76db93a.jpg','aktif','2026-04-20 19:28:31'),(4,'hasanatuzzulfa','hasanatuzzulfa.35@smk.belajar.id','izul','$2y$10$etPR2bDScoZcKer3ymH/8ew3hi0/rXkcMbIZf.EGOJ.7igy2RlsZ6','anggota','1776870328_3c3e3a7db038eb4e7314.jpg','aktif','2026-04-21 01:48:10'),(5,'Imey Siti','imey.siti07@smk.belajar.id','meyy','$2y$10$JwmZ241CfPKXNcqZBtqod.Jkph25BuJCmjZYdONwOAN5EgKsuoim2','anggota','1776738327_d6b7dd68f28f1b4d24ad.png','aktif','2026-04-21 02:25:27'),(6,'siti humairoh','siti.humairoh54@smk.belajar.id','umaa','$2y$10$s8aGwYDlpTHm1EZ08PP/V.0DDNLGKSDx719Eb1eW6yXIMTBY7jCgq','anggota','1776795505_c12cb529ee77700a6f22.webp','aktif','2026-04-21 02:26:07'),(7,'IcaImuttt','IcaImut@gmail.com','IcaImut','$2y$10$gNRJu8CGI4P807b24uxfyu2nKcTRmDuPq4WddrxcZ/OmZ0f3s36VW','anggota','1776742826_72aa1b24196f125d19c6.jpg','aktif','2026-04-21 03:19:05'),(8,'iis sadiyah','iis.sadiyah7@smk.belajar.id','iis','$2y$10$9GR.Fzu7Cvt9LX4Dcz6LjepZw.p3JK1/KaxIadvcvad9RXDwfGsBS','admin','1776796709_9223a361d6b62435c1d4.png','aktif','2026-04-21 18:36:42'),(9,'neneng niar','nenengniar@gmail.com','neneng','$2y$10$2u7as14ya.CzUmbYPzHRwupZAJS2R1MvogkxhX0CndtvO1m.qZc6q','anggota','1776841422_11a848ed864c97d8f2a9.jpg','aktif','2026-04-22 07:03:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-26 18:49:06
