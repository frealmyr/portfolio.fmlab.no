-- MySQL dump 10.16  Distrib 10.3.9-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: portfolio
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS portfolio;
USE portfolio;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text COLLATE utf8_bin NOT NULL,
  `original` text COLLATE utf8_bin,
  `uploaded` datetime DEFAULT NULL,
  `description` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `photo_exif`
--

DROP TABLE IF EXISTS `photo_exif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo_exif` (
  `id` int(11) NOT NULL,
  `make` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `model` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `lens` varchar(35) COLLATE utf8_bin DEFAULT NULL,
  `exposureprog` int(11) DEFAULT NULL,
  `fnumber` float DEFAULT NULL,
  `exposuretime` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `iso` int(11) DEFAULT NULL,
  `focallenght` float DEFAULT NULL,
  `meteringmode` int(11) DEFAULT NULL,
  `datetimeoriginal` timestamp(6) NULL DEFAULT NULL,
  `datetimeedited` datetime(6) DEFAULT NULL,
  `resolution` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `brightness` float DEFAULT NULL,
  `exposurebias` float DEFAULT NULL,
  `exposuremode` int(11) DEFAULT NULL,
  `lightsource` int(11) DEFAULT NULL,
  `software` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `altitude` float DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `photo_tags`
--

DROP TABLE IF EXISTS `photo_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo_tags` (
  `photo_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  KEY `photo_tags_index` (`photo_id`,`tag_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='One row links a tag to a photo. One photo can have multiple lines with different tags.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8_bin NOT NULL,
  `category` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_index` (`name`,`category`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Contains tags that can be linked to a photo.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `type_exposuremode`
--

DROP TABLE IF EXISTS `type_exposuremode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_exposuremode` (
  `id` int(11) NOT NULL,
  `name` varchar(7) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `type_exposureprogram`
--

DROP TABLE IF EXISTS `type_exposureprogram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_exposureprogram` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `type_lightsource`
--

DROP TABLE IF EXISTS `type_lightsource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_lightsource` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `type_meteringmode`
--

DROP TABLE IF EXISTS `type_meteringmode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_meteringmode` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'portfolio'
--
