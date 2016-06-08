/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.13-MariaDB : Database - baster_perpustakaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`baster_perpustakaan` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `baster_perpustakaan`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(70) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `id_wilayah_admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `FK_wilayah_admin` (`id_wilayah_admin`),
  CONSTRAINT `FK_wilayah_admin` FOREIGN KEY (`id_wilayah_admin`) REFERENCES `wilayah` (`id_wilayah`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

LOCK TABLES `admin` WRITE;

insert  into `admin`(`id_admin`,`nama_admin`,`username`,`password`,`id_wilayah_admin`) values (1,'I Wayan Puguh Sudarma','reroet','628a98554d657ca8aa0577b07d56b602',1),(3,'Gung wah','gungwah','628a98554d657ca8aa0577b07d56b602',2),(4,'I Wayan Puguh Sudarma Reroet','puguh','6f3792a964f0e3a5f06a35dfe609716c',1),(6,'test123','test','098f6bcd4621d373cade4e832627b4f6',1);

UNLOCK TABLES;

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `id_wilayah_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(120) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_gabung` date DEFAULT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `FK_anggota_wilayah` (`id_wilayah_anggota`),
  CONSTRAINT `FK_anggota_wilayah` FOREIGN KEY (`id_wilayah_anggota`) REFERENCES `wilayah` (`id_wilayah`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `anggota` */

LOCK TABLES `anggota` WRITE;

insert  into `anggota`(`id_anggota`,`id_wilayah_anggota`,`nama_anggota`,`jenis_kelamin`,`alamat`,`no_telp`,`tempat_lahir`,`tanggal_lahir`,`tanggal_gabung`) values (1,1,'Nengah John','L','Jalan Kebo Iwa','081234567890','Denpasar','1995-02-02','2015-02-02'),(2,1,'gungwah','L','jln.raya sesetan','0361228275','denpasar','2016-05-10','2016-05-10'),(3,2,'yogik','P','jln.raya suputan ','0361256070','tabanan ','2016-05-10','2016-05-10'),(4,4,'cuscus','P','jln.cinta','0361588823','munti','2016-05-10','2016-05-10'),(5,5,'Putu','P','jln. Hayam Wuruk','085654321378','Negara','2016-05-10','2016-05-10'),(6,3,'Kadek','L','jln. bukit jimbaran','0987654321','bangli','2016-05-10','2016-05-10'),(7,3,'surya','L','jln.bedugul','081228645885','badung','2016-05-10','2016-05-10'),(8,3,'Made','L','jln. pantai saba','0876542318','singaraja','2016-05-10','2016-05-10'),(9,4,'Ketut','P','jln. goa gong','02987168298','klungkung','2016-05-10','2016-05-10'),(10,5,'agung','P','jln. kenyeri','0987654521','denpasar','2016-05-10','2016-05-10');

UNLOCK TABLES;

/*Table structure for table `buku` */

DROP TABLE IF EXISTS `buku`;

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori_buku` smallint(6) DEFAULT NULL,
  `id_penerbit_buku` smallint(6) DEFAULT NULL,
  `id_penulis_buku` smallint(6) DEFAULT NULL,
  `id_wilayah_buku` int(11) DEFAULT NULL,
  `judul_buku` varchar(150) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL,
  `jumlah_buku` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_buku`),
  KEY `FK_kategori_buku` (`id_kategori_buku`),
  KEY `FK_penerbit_buku` (`id_penerbit_buku`),
  KEY `FK_penulis_buku` (`id_penulis_buku`),
  KEY `FK_buku_wilayah` (`id_wilayah_buku`),
  CONSTRAINT `FK_buku_wilayah` FOREIGN KEY (`id_wilayah_buku`) REFERENCES `wilayah` (`id_wilayah`) ON UPDATE CASCADE,
  CONSTRAINT `FK_kategori_buku` FOREIGN KEY (`id_kategori_buku`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE,
  CONSTRAINT `FK_penerbit_buku` FOREIGN KEY (`id_penerbit_buku`) REFERENCES `penerbit` (`id_penerbit`) ON UPDATE CASCADE,
  CONSTRAINT `FK_penulis_buku` FOREIGN KEY (`id_penulis_buku`) REFERENCES `penulis` (`id_penulis`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `buku` */

LOCK TABLES `buku` WRITE;

insert  into `buku`(`id_buku`,`id_kategori_buku`,`id_penerbit_buku`,`id_penulis_buku`,`id_wilayah_buku`,`judul_buku`,`isbn`,`tanggal_terbit`,`jumlah_buku`) values (1,2,3,1,3,'RPAL','98W-9WE','2016-05-10',130),(2,2,3,1,3,'RPUL','98W-9FE','2016-05-10',382),(3,4,1,2,4,'ADSI','98W-93FE','2016-05-10',489),(4,2,3,1,4,'FDISK','98W-93FR','2016-05-10',379),(5,5,2,1,1,'Kupluk Master','98W-93FW','2016-05-10',444),(6,4,2,1,1,'GIS','09E9-WYE8','2016-05-10',389),(7,2,3,1,2,'Menjadi Reroet','98W-WF5','2016-05-10',666);

UNLOCK TABLES;

/*Table structure for table `detail_transaksi` */

DROP TABLE IF EXISTS `detail_transaksi`;

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_master_transaksi` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah_buku` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail_transaksi`),
  KEY `FK_detail_transaksi` (`id_master_transaksi`),
  KEY `FK_transaksi_buku` (`id_buku`),
  CONSTRAINT `FK_detail_transaksi` FOREIGN KEY (`id_master_transaksi`) REFERENCES `master_transaksi` (`id_master_transaksi`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transaksi_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `detail_transaksi` */

LOCK TABLES `detail_transaksi` WRITE;

insert  into `detail_transaksi`(`id_detail_transaksi`,`id_master_transaksi`,`id_buku`,`jumlah_buku`) values (1,1,6,10),(3,1,2,11),(4,2,1,37),(5,4,3,23),(6,6,3,12),(7,6,5,12),(8,7,1,19),(9,7,3,179),(10,8,4,1),(11,9,7,1);

UNLOCK TABLES;

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

LOCK TABLES `kategori` WRITE;

insert  into `kategori`(`id_kategori`,`nama_kategori`) values (1,'IPA'),(2,'Komputer'),(3,'Kedokteran'),(4,'Ilmu Hitam'),(5,'Ilmu Sihir'),(6,'tesrt');

UNLOCK TABLES;

/*Table structure for table `master_transaksi` */

DROP TABLE IF EXISTS `master_transaksi`;

CREATE TABLE `master_transaksi` (
  `id_master_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `tgl_harus_kembali` datetime DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_master_transaksi`),
  KEY `FK_master_transaksi` (`id_anggota`),
  KEY `FK_wilayah` (`id_wilayah`),
  CONSTRAINT `FK_master_transaksi` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON UPDATE CASCADE,
  CONSTRAINT `FK_wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `master_transaksi` */

LOCK TABLES `master_transaksi` WRITE;

insert  into `master_transaksi`(`id_master_transaksi`,`id_anggota`,`id_wilayah`,`tgl_pinjam`,`tgl_harus_kembali`,`tgl_kembali`,`denda`,`status`) values (1,2,1,'2016-05-10 17:08:27','2016-05-21 00:50:36','2016-05-21 01:17:39',NULL,1),(2,7,1,'2016-05-10 17:09:04','2016-05-21 00:51:00','2016-05-24 00:06:07',3000,1),(4,8,4,'2016-05-10 17:09:33','2016-05-21 00:51:06','2016-05-24 00:05:54',3000,1),(6,4,2,'2016-05-23 16:39:12','2016-05-28 16:39:12','2016-05-24 00:06:17',0,1),(7,1,1,'2016-05-24 00:08:57','2016-05-29 00:08:57','2016-06-08 16:00:23',10000,1),(8,1,1,'2016-06-08 15:36:20','2016-06-13 15:36:20',NULL,NULL,0),(9,6,5,'2016-06-08 15:36:35','2016-06-13 15:36:35',NULL,NULL,0);

UNLOCK TABLES;

/*Table structure for table `penerbit` */

DROP TABLE IF EXISTS `penerbit`;

CREATE TABLE `penerbit` (
  `id_penerbit` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(100) DEFAULT NULL,
  `alamat_penerbit` varchar(100) DEFAULT NULL,
  `telp_penerbit` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `penerbit` */

LOCK TABLES `penerbit` WRITE;

insert  into `penerbit`(`id_penerbit`,`nama_penerbit`,`alamat_penerbit`,`telp_penerbit`) values (1,'Kiai','Jln. Rusak','085888763'),(2,'Reroet','Jln. Lurus','085888372'),(3,'Kupluk','Jln. Belok','094379734');

UNLOCK TABLES;

/*Table structure for table `penulis` */

DROP TABLE IF EXISTS `penulis`;

CREATE TABLE `penulis` (
  `id_penulis` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(100) DEFAULT NULL,
  `alamat_penulis` varchar(100) DEFAULT NULL,
  `telp_penulis` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id_penulis`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `penulis` */

LOCK TABLES `penulis` WRITE;

insert  into `penulis`(`id_penulis`,`nama_penulis`,`alamat_penulis`,`telp_penulis`) values (1,'Gungwah','Jalan Pulau Kawe','03618443322'),(2,'Surya Hadikusuma','Jalan Bedugul','03612267344'),(3,'Puguh Sudarma','Jalan Gunung Agung','03617455832'),(4,'Edo','Jalan Layang Layang','03612223847'),(5,'Hariyogi','Jalan Gunung Patas','03612238753');

UNLOCK TABLES;

/*Table structure for table `wilayah` */

DROP TABLE IF EXISTS `wilayah`;

CREATE TABLE `wilayah` (
  `id_wilayah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_wilayah` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_wilayah`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `wilayah` */

LOCK TABLES `wilayah` WRITE;

insert  into `wilayah`(`id_wilayah`,`nama_wilayah`) values (1,'denpasar'),(2,'tabanan'),(3,'negara'),(4,'badung'),(5,'singaraja');

UNLOCK TABLES;

/*Table structure for table `administrator` */

DROP TABLE IF EXISTS `administrator`;

/*!50001 DROP VIEW IF EXISTS `administrator` */;
/*!50001 DROP TABLE IF EXISTS `administrator` */;

/*!50001 CREATE TABLE  `administrator`(
 `id` int(11) ,
 `nama` varchar(70) ,
 `username` varchar(20) ,
 `password` varchar(32) ,
 `wilayah` varchar(100) 
)*/;

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

/*!50001 DROP VIEW IF EXISTS `book` */;
/*!50001 DROP TABLE IF EXISTS `book` */;

/*!50001 CREATE TABLE  `book`(
 `id` int(11) ,
 `judul` varchar(150) ,
 `jumlah` int(11) ,
 `isbn` varchar(50) ,
 `tanggal` date ,
 `penulis` varchar(100) ,
 `penerbit` varchar(100) ,
 `lokasi` varchar(100) ,
 `kategori` varchar(100) 
)*/;

/*Table structure for table `daftar_buku_pinjam` */

DROP TABLE IF EXISTS `daftar_buku_pinjam`;

/*!50001 DROP VIEW IF EXISTS `daftar_buku_pinjam` */;
/*!50001 DROP TABLE IF EXISTS `daftar_buku_pinjam` */;

/*!50001 CREATE TABLE  `daftar_buku_pinjam`(
 `id_buku` int(11) ,
 `judul_buku` varchar(150) ,
 `penerbit_buku` varchar(100) ,
 `penulis_buku` varchar(100) ,
 `sisa_buku` decimal(33,0) 
)*/;

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

/*!50001 DROP VIEW IF EXISTS `member` */;
/*!50001 DROP TABLE IF EXISTS `member` */;

/*!50001 CREATE TABLE  `member`(
 `id` int(11) ,
 `nama` varchar(120) ,
 `jk` char(1) ,
 `alamat` varchar(100) ,
 `telp` varchar(13) ,
 `tempat` varchar(20) ,
 `tanggallahir` date ,
 `tanggalgabung` date ,
 `wilayah` varchar(100) 
)*/;

/*Table structure for table `sisa_buku` */

DROP TABLE IF EXISTS `sisa_buku`;

/*!50001 DROP VIEW IF EXISTS `sisa_buku` */;
/*!50001 DROP TABLE IF EXISTS `sisa_buku` */;

/*!50001 CREATE TABLE  `sisa_buku`(
 `id_buku` int(11) ,
 `jml_buku` decimal(32,0) 
)*/;

/*Table structure for table `transaksi_pinjam` */

DROP TABLE IF EXISTS `transaksi_pinjam`;

/*!50001 DROP VIEW IF EXISTS `transaksi_pinjam` */;
/*!50001 DROP TABLE IF EXISTS `transaksi_pinjam` */;

/*!50001 CREATE TABLE  `transaksi_pinjam`(
 `id_transaksi` int(11) ,
 `id_anggota` int(11) ,
 `nama_anggota` varchar(120) ,
 `wilayah` varchar(100) ,
 `tgl_pinjam` datetime ,
 `tgl_harus_kembali` datetime ,
 `tgl_kembali` datetime ,
 `denda` int(11) ,
 `status` tinyint(1) 
)*/;

/*Table structure for table `transaksi_pinjam_detail` */

DROP TABLE IF EXISTS `transaksi_pinjam_detail`;

/*!50001 DROP VIEW IF EXISTS `transaksi_pinjam_detail` */;
/*!50001 DROP TABLE IF EXISTS `transaksi_pinjam_detail` */;

/*!50001 CREATE TABLE  `transaksi_pinjam_detail`(
 `id_detail_transaksi` int(11) ,
 `id_master_transaksi` int(11) ,
 `id_buku` int(11) ,
 `judul_buku` varchar(150) ,
 `jumlah_buku` int(11) 
)*/;

/*View structure for view administrator */

/*!50001 DROP TABLE IF EXISTS `administrator` */;
/*!50001 DROP VIEW IF EXISTS `administrator` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `administrator` AS (select `a`.`id_admin` AS `id`,`a`.`nama_admin` AS `nama`,`a`.`username` AS `username`,`a`.`password` AS `password`,`w`.`nama_wilayah` AS `wilayah` from (`admin` `a` left join `wilayah` `w` on((`a`.`id_wilayah_admin` = `w`.`id_wilayah`))) order by `a`.`id_admin`) */;

/*View structure for view book */

/*!50001 DROP TABLE IF EXISTS `book` */;
/*!50001 DROP VIEW IF EXISTS `book` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `book` AS select `buku`.`id_buku` AS `id`,`buku`.`judul_buku` AS `judul`,`buku`.`jumlah_buku` AS `jumlah`,`buku`.`isbn` AS `isbn`,`buku`.`tanggal_terbit` AS `tanggal`,`penulis`.`nama_penulis` AS `penulis`,`penerbit`.`nama_penerbit` AS `penerbit`,`wilayah`.`nama_wilayah` AS `lokasi`,`kategori`.`nama_kategori` AS `kategori` from ((((`kategori` join `buku`) join `wilayah`) join `penerbit`) join `penulis`) where ((`buku`.`id_kategori_buku` = `kategori`.`id_kategori`) and (`buku`.`id_penerbit_buku` = `penerbit`.`id_penerbit`) and (`buku`.`id_penulis_buku` = `penulis`.`id_penulis`) and (`buku`.`id_wilayah_buku` = `wilayah`.`id_wilayah`)) */;

/*View structure for view daftar_buku_pinjam */

/*!50001 DROP TABLE IF EXISTS `daftar_buku_pinjam` */;
/*!50001 DROP VIEW IF EXISTS `daftar_buku_pinjam` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_buku_pinjam` AS (select `b`.`id_buku` AS `id_buku`,`b`.`judul_buku` AS `judul_buku`,`p`.`nama_penerbit` AS `penerbit_buku`,`s`.`nama_penulis` AS `penulis_buku`,(`b`.`jumlah_buku` - ifnull(`t`.`jml_buku`,0)) AS `sisa_buku` from (((`buku` `b` left join `sisa_buku` `t` on((`b`.`id_buku` = `t`.`id_buku`))) left join `penerbit` `p` on((`b`.`id_penerbit_buku` = `p`.`id_penerbit`))) left join `penulis` `s` on((`b`.`id_penulis_buku` = `s`.`id_penulis`)))) */;

/*View structure for view member */

/*!50001 DROP TABLE IF EXISTS `member` */;
/*!50001 DROP VIEW IF EXISTS `member` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `member` AS select `anggota`.`id_anggota` AS `id`,`anggota`.`nama_anggota` AS `nama`,`anggota`.`jenis_kelamin` AS `jk`,`anggota`.`alamat` AS `alamat`,`anggota`.`no_telp` AS `telp`,`anggota`.`tempat_lahir` AS `tempat`,`anggota`.`tanggal_lahir` AS `tanggallahir`,`anggota`.`tanggal_gabung` AS `tanggalgabung`,`wilayah`.`nama_wilayah` AS `wilayah` from (`anggota` join `wilayah`) where (`anggota`.`id_wilayah_anggota` = `wilayah`.`id_wilayah`) */;

/*View structure for view sisa_buku */

/*!50001 DROP TABLE IF EXISTS `sisa_buku` */;
/*!50001 DROP VIEW IF EXISTS `sisa_buku` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sisa_buku` AS (select `detail_transaksi`.`id_buku` AS `id_buku`,sum(`detail_transaksi`.`jumlah_buku`) AS `jml_buku` from (`detail_transaksi` left join `master_transaksi` on((`detail_transaksi`.`id_master_transaksi` = `master_transaksi`.`id_master_transaksi`))) where (`master_transaksi`.`status` = 0) group by `detail_transaksi`.`id_buku`) */;

/*View structure for view transaksi_pinjam */

/*!50001 DROP TABLE IF EXISTS `transaksi_pinjam` */;
/*!50001 DROP VIEW IF EXISTS `transaksi_pinjam` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_pinjam` AS (select `t`.`id_master_transaksi` AS `id_transaksi`,`t`.`id_anggota` AS `id_anggota`,`a`.`nama_anggota` AS `nama_anggota`,`w`.`nama_wilayah` AS `wilayah`,`t`.`tgl_pinjam` AS `tgl_pinjam`,`t`.`tgl_harus_kembali` AS `tgl_harus_kembali`,`t`.`tgl_kembali` AS `tgl_kembali`,`t`.`denda` AS `denda`,`t`.`status` AS `status` from ((`master_transaksi` `t` left join `anggota` `a` on((`t`.`id_anggota` = `a`.`id_anggota`))) left join `wilayah` `w` on((`t`.`id_wilayah` = `w`.`id_wilayah`))) order by `t`.`id_master_transaksi`) */;

/*View structure for view transaksi_pinjam_detail */

/*!50001 DROP TABLE IF EXISTS `transaksi_pinjam_detail` */;
/*!50001 DROP VIEW IF EXISTS `transaksi_pinjam_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaksi_pinjam_detail` AS (select `t`.`id_detail_transaksi` AS `id_detail_transaksi`,`t`.`id_master_transaksi` AS `id_master_transaksi`,`b`.`id_buku` AS `id_buku`,`b`.`judul_buku` AS `judul_buku`,`t`.`jumlah_buku` AS `jumlah_buku` from (`detail_transaksi` `t` left join `buku` `b` on((`t`.`id_buku` = `b`.`id_buku`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
