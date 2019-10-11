# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.27)
# Database: demo2
# Generation Time: 2019-10-11 00:26:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ija_image
# ------------------------------------------------------------

CREATE TABLE `ija_image` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL,
  `batch` varchar(4) NOT NULL,
  `batch_num` varchar(4) NOT NULL,
  `original` text NOT NULL,
  `big` text NOT NULL,
  `medium` text NOT NULL,
  `small` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `publish_state` varchar(10) NOT NULL,
  `publish_state_reason` varchar(60) DEFAULT NULL,
  `category` varchar(10) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `photographer` bigint(20) DEFAULT NULL,
  `photo_date` varchar(20) NOT NULL,
  `photo_preview` varchar(200) NOT NULL,
  `photo_negative_number` varchar(50) NOT NULL,
  `copyright` bigint(20) DEFAULT NULL,
  `remarks` varchar(50) NOT NULL,
  `nli_picname` varchar(50) DEFAULT NULL,
  `description` longtext NOT NULL,
  `addenda` text NOT NULL,
  `visual_regions` text NOT NULL,
  `export_state` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `set_id` (`item_id`),
  KEY `item_id` (`item_id`),
  KEY `photographer` (`photographer`),
  KEY `copyright` (`copyright`),
  CONSTRAINT `ija_image_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `ija_item` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `ija_image_ibfk_2` FOREIGN KEY (`photographer`) REFERENCES `ija_photographer` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `ija_image_ibfk_3` FOREIGN KEY (`copyright`) REFERENCES `ija_copyright` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table ija_item
# ------------------------------------------------------------

CREATE TABLE `ija_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id`,
  `name` text,
  `publish_state` int(2) NOT NULL,
  `publish_state_reason` varchar(60) DEFAULT NULL,
  `category` varchar(10) NOT NULL,
  `ntl` text NOT NULL,
  `ntl_localname` varchar(250) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `description` longtext NOT NULL,
  `short_description` text,
  `addenda` text NOT NULL,
  `artifact_at_risk` int(11) NOT NULL,
  `parental_status` varchar(200) NOT NULL DEFAULT '0',
  `geo_lat` float(10,6) DEFAULT NULL,
  `geo_lng` float(10,6) DEFAULT NULL,
  `geo_options` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `copyright` (`copyright`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
