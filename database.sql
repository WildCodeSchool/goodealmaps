-- Active: 1666095597503@@localhost@3306@goodealmap
/*
SQLyog Ultimate v9.50 
MySQL - 5.5.5-10.4.12-MariaDB : Database - goodealmap
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`goodealmap` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

/*Table structure for table `announcement` */

CREATE TABLE `announcement` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `regionID` int(3) NOT NULL,
  `title` char(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorID` int(7) NOT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `dateStart` date ,
  `dateEnd` date ,
  `image` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `regionID` (`regionID`),
  KEY `authorID` (`authorID`),
  CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`regionID`) REFERENCES `region` (`id`),
  CONSTRAINT `announcement_ibfk_2` FOREIGN KEY (`authorID`) REFERENCES `author` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `announcement` */

/*Table structure for table `author` */

CREATE TABLE `author` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `email` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `author` */

/*Table structure for table `region` */

CREATE TABLE `region` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `regionName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `region` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;