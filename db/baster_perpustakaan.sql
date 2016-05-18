/*
SQLyog Ultimate v8.61 
MySQL - 5.5.5-10.1.10-MariaDB-log : Database - baster_perpustakaan
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
  CONSTRAINT `FK_wilayah_admin` FOREIGN KEY (`id_wilayah_admin`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`nama_admin`,`username`,`password`,`id_wilayah_admin`) values (1,'Puguh Sudarma','reroet','628a98554d657ca8aa0577b07d56b602',1);

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `id_wilayah` int(11) NOT NULL,
  `nama_anggota` varchar(120) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_gabung` datetime DEFAULT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `FK_anggota_wilayah` (`id_wilayah`),
  CONSTRAINT `FK_anggota_wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `anggota` */

insert  into `anggota`(`id_anggota`,`id_wilayah`,`nama_anggota`,`jenis_kelamin`,`alamat`,`no_telp`,`tempat_lahir`,`tanggal_lahir`,`tanggal_gabung`) values (1,1,'Nengah John','L','Jalan Kebo Iwa','081234567890','Denpasar','1995-02-02','2015-02-02 00:00:00'),(2,1,'gungwah','L','jln.raya sesetan','0361228275','denpasar','2016-05-10','2016-05-10 16:57:27'),(3,2,'yogik','P','jln.raya suputan ','0361256070','tabanan ','2016-05-10','2016-05-10 16:59:19'),(4,4,'cuscus','P','jln.cinta','0361588823','munti','2016-05-10','2016-05-10 17:03:28'),(5,5,'Putu','P','jln. Hayam Wuruk','085654321378','Negara','2016-05-10','2016-05-10 17:04:06'),(6,3,'Kadek','L','jln. bukit jimbaran','0987654321','bangli','2016-05-10','2016-05-10 17:05:09'),(7,3,'surya','L','jln.bedugul','081228645885','badung','2016-05-10','2016-05-10 17:07:09'),(8,3,'Made','L','jln. pantai saba','0876542318','singaraja','2016-05-10','2016-05-10 17:06:06'),(9,4,'Ketut','P','jln. goa gong','02987168298','klungkung','2016-05-10','2016-05-10 17:06:46'),(10,5,'agung','P','jln. kenyeri','0987654521','denpasar','2016-05-10','2016-05-10 17:08:23');

/*Table structure for table `buku` */

DROP TABLE IF EXISTS `buku`;

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` smallint(6) DEFAULT NULL,
  `id_penerbit` smallint(6) DEFAULT NULL,
  `id_penulis` smallint(6) DEFAULT NULL,
  `id_wilayah` int(11) DEFAULT NULL,
  `judul_buku` varchar(150) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `tanggal_terbit` datetime DEFAULT NULL,
  `jumlah_buku` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_buku`),
  KEY `FK_kategori_buku` (`id_kategori`),
  KEY `FK_penerbit_buku` (`id_penerbit`),
  KEY `FK_penulis_buku` (`id_penulis`),
  KEY `FK_buku_wilayah` (`id_wilayah`),
  CONSTRAINT `FK_buku_wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_kategori_buku` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_penerbit_buku` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_penulis_buku` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `buku` */

insert  into `buku`(`id_buku`,`id_kategori`,`id_penerbit`,`id_penulis`,`id_wilayah`,`judul_buku`,`isbn`,`tanggal_terbit`,`jumlah_buku`) values (1,2,3,1,3,'RPAL','98W-9WE','2016-05-10 17:06:07',130),(2,2,3,1,3,'RPUL','98W-9FE','2016-05-10 17:06:33',382),(3,4,1,2,4,'ADSI','98W-93FE','2016-05-10 17:08:41',489),(4,2,3,1,4,'FDISK','98W-93FR','2016-05-10 17:09:50',379),(5,5,2,1,1,'Kupluk Master','98W-93FW','2016-05-10 17:11:23',444),(6,4,2,1,1,'GIS','09E9-WYE8','2016-05-10 17:10:17',389),(7,2,3,1,2,'Menjadi Reroet','98W-WF5','2016-05-10 17:22:37',666);

/*Table structure for table `detail_transaksi` */

DROP TABLE IF EXISTS `detail_transaksi`;

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_master_transaksi` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah_buku` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_detail_transaksi`),
  KEY `FK_detail_transaksi` (`id_master_transaksi`),
  KEY `FK_transaksi_buku` (`id_buku`),
  CONSTRAINT `FK_detail_transaksi` FOREIGN KEY (`id_master_transaksi`) REFERENCES `master_transaksi` (`id_master_transaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_transaksi_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `detail_transaksi` */

insert  into `detail_transaksi`(`id_detail_transaksi`,`id_master_transaksi`,`id_buku`,`jumlah_buku`,`status`) values (1,1,6,10,0),(2,3,2,22,0),(3,1,2,11,0),(4,2,1,2,0),(5,4,3,1,0);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kategori`,`nama_kategori`) values (1,'IPA'),(2,'Komputer'),(3,'Kedokteran'),(4,'Ilmu Hitam'),(5,'Ilmu Sihir');

/*Table structure for table `master_transaksi` */

DROP TABLE IF EXISTS `master_transaksi`;

CREATE TABLE `master_transaksi` (
  `id_master_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_master_transaksi`),
  KEY `FK_master_transaksi` (`id_anggota`),
  KEY `FK_wilayah` (`id_wilayah`),
  CONSTRAINT `FK_master_transaksi` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `master_transaksi` */

insert  into `master_transaksi`(`id_master_transaksi`,`id_anggota`,`id_wilayah`,`tgl_pinjam`,`tgl_kembali`,`denda`) values (1,2,1,'2016-05-10 17:08:27',NULL,NULL),(2,7,1,'2016-05-10 17:09:04',NULL,NULL),(3,9,2,'2016-05-10 17:09:20',NULL,NULL),(4,8,4,'2016-05-10 17:09:33',NULL,NULL),(5,5,1,'2016-05-10 17:09:51',NULL,NULL);

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

insert  into `penerbit`(`id_penerbit`,`nama_penerbit`,`alamat_penerbit`,`telp_penerbit`) values (1,'Kiai','Jln. Rusak','085888763'),(2,'Reroet','Jln. Lurus','085888372'),(3,'Kupluk','Jln. Belok','094379734');

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

insert  into `penulis`(`id_penulis`,`nama_penulis`,`alamat_penulis`,`telp_penulis`) values (1,'Gungwah','Jalan Pulau Kawe','03618443322'),(2,'Surya Hadikusuma','Jalan Bedugul','03612267344'),(3,'Puguh Sudarma','Jalan Gunung Agung','03617455832'),(4,'Edo','Jalan Layang Layang','03612223847'),(5,'Hariyogi','Jalan Gunung Patas','03612238753');

/*Table structure for table `wilayah` */

DROP TABLE IF EXISTS `wilayah`;

CREATE TABLE `wilayah` (
  `id_wilayah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_wilayah` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_wilayah`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `wilayah` */

insert  into `wilayah`(`id_wilayah`,`nama_wilayah`) values (1,'denpasar'),(2,'tabanan'),(3,'negara'),(4,'badung'),(5,'singaraja');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
