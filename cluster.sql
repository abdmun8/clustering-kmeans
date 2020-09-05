-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for dev0_cluster
DROP DATABASE IF EXISTS `dev0_cluster`;
CREATE DATABASE IF NOT EXISTS `dev0_cluster` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dev0_cluster`;

-- Dumping structure for table dev0_cluster.nilai_kelas
DROP TABLE IF EXISTS `nilai_kelas`;
CREATE TABLE IF NOT EXISTS `nilai_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(50) NOT NULL,
  `mengeja` int(11) DEFAULT '0',
  `penjumlahan` int(11) DEFAULT '0',
  `menulis` int(11) DEFAULT '0',
  `keaktifan` int(11) DEFAULT '0',
  `pengurangan` int(11) DEFAULT '0',
  `mewarnai` int(11) DEFAULT '0',
  `menggambar` int(11) DEFAULT '0',
  `mencocokan_bentuk` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dev0_cluster.nilai_kelas: ~1 rows (approximately)
DELETE FROM `nilai_kelas`;
/*!40000 ALTER TABLE `nilai_kelas` DISABLE KEYS */;
INSERT INTO `nilai_kelas` (`id`, `kelas`, `mengeja`, `penjumlahan`, `menulis`, `keaktifan`, `pengurangan`, `mewarnai`, `menggambar`, `mencocokan_bentuk`) VALUES
	(1, 'A', 75, 65, 70, 80, 75, 80, 75, 80),
	(2, 'B', 90, 85, 80, 85, 85, 90, 85, 85);
/*!40000 ALTER TABLE `nilai_kelas` ENABLE KEYS */;

-- Dumping structure for table dev0_cluster.nilai_siswa
DROP TABLE IF EXISTS `nilai_siswa`;
CREATE TABLE IF NOT EXISTS `nilai_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `mengeja` int(11) DEFAULT '0',
  `penjumlahan` int(11) DEFAULT '0',
  `menulis` int(11) DEFAULT '0',
  `keaktifan` int(11) DEFAULT '0',
  `pengurangan` int(11) DEFAULT '0',
  `mewarnai` int(11) DEFAULT '0',
  `menggambar` int(11) DEFAULT '0',
  `mencocokan_bentuk` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table dev0_cluster.nilai_siswa: ~2 rows (approximately)
DELETE FROM `nilai_siswa`;
/*!40000 ALTER TABLE `nilai_siswa` DISABLE KEYS */;
INSERT INTO `nilai_siswa` (`id`, `id_siswa`, `mengeja`, `penjumlahan`, `menulis`, `keaktifan`, `pengurangan`, `mewarnai`, `menggambar`, `mencocokan_bentuk`) VALUES
	(1, 1, 80, 75, 75, 80, 75, 80, 85, 75),
	(2, 16, 75, 80, 75, 80, 70, 75, 75, 80);
/*!40000 ALTER TABLE `nilai_siswa` ENABLE KEYS */;

-- Dumping structure for table dev0_cluster.siswa
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nisn` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table dev0_cluster.siswa: ~1 rows (approximately)
DELETE FROM `siswa`;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` (`id`, `nisn`, `nama`, `jenis_kelamin`, `umur`, `alamat`) VALUES
	(1, '1234', 'Aditya', 'L', 10, 'Jakarta barat'),
	(16, '1233', 'Adriano H', 'L', 10, 'jakarta');
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;

-- Dumping structure for table dev0_cluster.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dev0_cluster.user: ~0 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `nama`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
