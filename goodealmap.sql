A
1

2
2





Search Wild4Ever





Wild4Ever










Unread mentions
_2022_09_lille_php_goodealmap


_2022_09_lille_php_goodealmap




6

Loading history...


[Lille-POEC-PHP] Franck Depoorter
  12:24 PM
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


[Lille-POEC-PHP] paul vinchent
  5:07 PM
@Benjamin Beugnet
 Tu peux regarder la branch footer aussi stp ?
:+1:
1


1 reply
17 hours agoView thread


[Lille / PHP-POEC] Benjamin Beugnet
  5:14 PM
Qui sont les nouveaux PO / SM ?


[Lille / PHP-POEC] Benjamin Beugnet
  9:46 AM
Je relance ma demande @here pourriez vous me donner le nom des nouveaux PO / SM


Natalia Nedbailo Lille / PHP-POEC
  9:54 AM
PO Axel
SM Natalia


[Lille / PHP-POEC] Benjamin Beugnet
  9:57 AM
すごい !!


[Lille-POEC-PHP] Franck Depoorter
  10:22 AM
dump-goodealmap-202210261021.sql
 
-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: goodealmap
-- ------------------------------------------------------
-- Server version	8.0.31
​
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
​
--
-- Table structure for table `announcement`
--
​
DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regionID` int NOT NULL,
  `title` char(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorID` int NOT NULL,
  `category` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `dateStart` date DEFAULT NULL,
  `dateEnd` date DEFAULT NULL,
  `image` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `regionID` (`regionID`),
  KEY `authorID` (`authorID`),
  CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`regionID`) REFERENCES `region` (`id`),
  CONSTRAINT `announcement_ibfk_2` FOREIGN KEY (`authorID`) REFERENCES `author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
​
--
-- Dumping data for table `announcement`
--
​
LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
INSERT INTO `announcement` VALUES (1,10,'Braderie de LIlle','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged','1 Place de Lille',1,'evenements','2022-10-25','2023-09-02','2023-09-03','braderieDeLille.jpg','Lille',59000),(2,11,'La Popote en Cocott','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged','35 Rue de Vaucelles',2,'restaurations','2022-10-25','2022-11-01','2022-11-01','popote.jpg','Pont-L\'Evêque',14130),(3,8,'The People','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged','28 Boulevard de Reuilly',3,'hebergements','2022-10-25','2022-12-25','2022-12-27','hotel.jpg','Paris',75012);
/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;
UNLOCK TABLES;
​
--
-- Table structure for table `author`
--
​
DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
​
--
-- Dumping data for table `author`
--
​
LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'test@gmail.com','franck','Depoorter'),(2,'downeyJr@gmail.com','robert','Downey Jr'),(3,'sangoku@gmail.com','goku','san');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;
​
--
-- Table structure for table `region`
--
​
DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `region` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regionName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
​
--
-- Dumping data for table `region`
--
​
LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (1,'Grand Est'),(2,'Nouvelle Aquitaine'),(3,'Auvergne Rhône Alpes'),(4,'Bourgogne Franche Comté'),(5,'Bretagne'),(6,'Centre Val de Loire'),(7,'Corse'),(8,'Île de France'),(9,'Occitanie'),(10,'Hauts de France'),(11,'Normandie'),(12,'Pays de la Loire'),(13,'Provence Alpes Côte  d\'Azur');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;
​
--
-- Dumping routines for database 'goodealmap'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
​
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
​
-- Dump completed on 2022-10-26 10:21:56
Collapse



















Message _2022_09_lille_php_goodealmap








Shift + Enter to add a new line
