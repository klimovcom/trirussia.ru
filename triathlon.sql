-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: triathlon
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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

--
-- Table structure for table `coach`
--

DROP TABLE IF EXISTS `coach`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vk_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ig_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coach`
--

LOCK TABLES `coach` WRITE;
/*!40000 ALTER TABLE `coach` DISABLE KEYS */;
/*!40000 ALTER TABLE `coach` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_page`
--

DROP TABLE IF EXISTS `content_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_page`
--

LOCK TABLES `content_page` WRITE;
/*!40000 ALTER TABLE `content_page` DISABLE KEYS */;
/*!40000 ALTER TABLE `content_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distance`
--

DROP TABLE IF EXISTS `distance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sport_id` int(11) DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distance`
--

LOCK TABLES `distance` WRITE;
/*!40000 ALTER TABLE `distance` DISABLE KEYS */;
/*!40000 ALTER TABLE `distance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fpm_file`
--

DROP TABLE IF EXISTS `fpm_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fpm_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'File extension',
  `base_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'File base name',
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fpm_file`
--

LOCK TABLES `fpm_file` WRITE;
/*!40000 ALTER TABLE `fpm_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `fpm_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1457235270),('m130524_201442_init',1457239773),('m160306_033443_create_race_table',1457239773),('m160306_033452_create_sport_table',1457239773),('m160306_033538_create_distance_table',1457239773),('m160306_033556_create_organizer_table',1457239773),('m160306_033620_create_coach_table',1457239773),('m160306_033631_create_post_table',1457239773),('m160306_033639_create_content_page_table',1457239773),('m160306_033649_create_product_table',1457239773),('m160306_045536_create_configuration_table',1457241215),('m160306_080017_create_fpm_file_table',1457254706),('m160306_084407_create_race_lang_table',1457254751);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizer`
--

DROP TABLE IF EXISTS `organizer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organizer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_id` int(11) NOT NULL,
  `promo` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizer`
--

LOCK TABLES `organizer` WRITE;
/*!40000 ALTER TABLE `organizer` DISABLE KEYS */;
/*!40000 ALTER TABLE `organizer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `author_id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promo` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promo` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `image_id` int(11) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race`
--

DROP TABLE IF EXISTS `race`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `author_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `finish_date` date DEFAULT NULL,
  `start_time` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organizer_id` int(11) DEFAULT NULL,
  `site` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `main_image_id` int(11) DEFAULT NULL,
  `promo` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `instagram_tag` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_event_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race`
--

LOCK TABLES `race` WRITE;
/*!40000 ALTER TABLE `race` DISABLE KEYS */;
INSERT INTO `race` VALUES (1,'0000-00-00 00:00:00',1,'0000-00-00','0000-00-00','10:50','Russia','Moscow','Hills of glory','Compete 1','compete-1',25,'$',1,'http://www.compete.com',1,'Well well well','well well well','','',1);
/*!40000 ALTER TABLE `race` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_lang`
--

DROP TABLE IF EXISTS `race_lang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `race_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `race_id` int(11) NOT NULL,
  `language` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `promo` text COLLATE utf8_unicode_ci,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `race_lang_ibfk_1` (`race_id`),
  CONSTRAINT `race_lang_ibfk_1` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_lang`
--

LOCK TABLES `race_lang` WRITE;
/*!40000 ALTER TABLE `race_lang` DISABLE KEYS */;
/*!40000 ALTER TABLE `race_lang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport`
--

DROP TABLE IF EXISTS `sport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport`
--

LOCK TABLES `sport` WRITE;
/*!40000 ALTER TABLE `sport` DISABLE KEYS */;
/*!40000 ALTER TABLE `sport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','7CCujOO_GUTJVGLxw8JfKGIKTXQi2Ot1','$2y$13$iSSqlOidZ4LqL1iFgNf/XOXSK2mxCS/wr11a6htoSdaWbJ/L4UmOa','RijHEnpw4p0RSYMNrn-OenXZDS5BEV7h_1457239773','admin@uran.dev',10,1457239773,1457239773),(2,'Lucious.Beahan','sJvj2_w9PUxfwx7cOj8zOtITzUBR6vkQ','$2y$13$CvodND6P6iTJ7Ng7emR5wuOKg/4kQB2OlixdweTO0MwflE1Zdufba','2A_G0sF9BLRTCQSKOZ-vizqfHop75PK3_1457249109','Emilia68@Runolfsson.biz',10,1457249109,1457249109),(3,'Bode.Jacynthe','rB8VrfMH1ZqTsW-JqRmZH9vMfEY1ptU5','$2y$13$WpQqNFG4QEcboof9WwzLNO9GwhGIXt6h455Cvkwk6/ZZGUYsw.2o2','Jh86oBeZuyjq6xh-M4HDo1zMQ57PqY7W_1457249110','tWintheiser@gmail.com',10,1457249110,1457249110),(4,'Brooklyn07','tlAY8xNna25WfJFlzVRJ3quH1cbB6xPS','$2y$13$e0eAkPay69FozGuuaahz0e/GbFdTHjEKZQBn/EuzYsUpJseI5sDl.','ycvnrTSj7CEJGtZhP5Heb9E-TNeiPzkG_1457249110','Schuppe.Jackeline@Hermiston.com',10,1457249110,1457249110),(5,'cZboncak','FONU_X_Z1TnFTL6mjd4QNpWTA5D9n48v','$2y$13$njJ9nsWBKthdNSAPz1iIo.8wkjhVk/d5bkXDyTAC4jbgpdkD2yEw2','PirQZCoZtSMwyGaWL-2osRdYzKkwCh32_1457249111','sBlock@Daugherty.com',10,1457249111,1457249111),(6,'Lauren07','LFyyP6yqK6Y7i35w-RP0HO5r-rXEeVc9','$2y$13$eZGoo7huk3iUN7EACOKKIuv5JkbOKSam4w/A5vM3hfF220TOLvEh.','4VovMGgQzVp24rWEySxI6Pd1S14SYBzL_1457249111','Manuela37@Smith.com',10,1457249111,1457249111),(7,'tTorp','03kWOLYdGKG2WZE7uUoPz3J2ckLblrKl','$2y$13$o6dh1RavvKzwRI/3VTPmjOVBLDtiz6WVn172/Z8W5mD8WvU5wwote','A4XElHnu938OkhpFwi3bktikmdMj5Btu_1457249112','Ima.Schiller@hotmail.com',10,1457249112,1457249112),(8,'Halvorson.Kathryn','v84U5UwHlkwFAdwPfd56wUCJnmUOvujS','$2y$13$S8vtRrGaGD7kKRFer1yYVe9j.KHKt4AORWnjKkgB647NFRQU2nv6K','8fl2e9iVgnOHNY2K1X-fQ9H5zp2VVWqP_1457249112','Legros.Nikki@Stamm.biz',10,1457249112,1457249112),(9,'Clifford.OKeefe','b6AwhaCzWLxGcAhYFMMFYh8SrWnfi5kM','$2y$13$2jYcws03brS6FzFN7SQ1QuLV0AA7IvBDpNKlb2fiKjjSNc9L0DzUC','w0kDOk7Hppddk1NAf1waMMLKJLVu80cD_1457249113','xChamplin@Gutmann.info',10,1457249113,1457249113),(10,'yCasper','OhZaKiRbIuuaGOpsDjgv_BpsHJ0Vb2-T','$2y$13$QOTXAuhjB99/fNQvI.aI4ODzix/9Ocr1I.f6ZG1bkGdkUUBEYftL.','eWTFwLxxuuXzeK9xjuCcQVMDkJmoIppR_1457249113','Lynch.Donnell@Prohaska.com',10,1457249113,1457249113),(11,'wGusikowski','YXl47n-N_Iobo2vU6Ss98qzDBEe1Jhcc','$2y$13$.Q99chY9n/74VhNxH1emG.5XVFZQPesTP9dy46oNpEaQMYwZbbP/m','vJt071T2DnAVTmwdyrzwMtoNKU88duEj_1457249114','Colton.Schumm@hotmail.com',10,1457249114,1457249114),(12,'uBraun','dufv83piiJ5iFGc39PEASmw-8ZiNKwMD','$2y$13$EUOhhK.0a53Ex3hTeN1YTe2bicGSfzOnN1BiSVZYAtJ5jqSutOL.C','p3xjCNqMlaTFCIKFMtGGsidqjPII2WA4_1457249114','Brandyn.Cormier@Kohler.com',10,1457249114,1457249114),(13,'Quentin95','SKfdJKSwf07NfQaWqMyrpiuT1bfO3-3G','$2y$13$YXCqOQOVgsIwc5WHd0RQ0.dfTFS17fCauWTgQ1my1FuNVZEQoVRIK','M_qMKowGgcRDwrAkwi8nEs6ks2CSNtpQ_1457249115','dKirlin@Hayes.com',10,1457249115,1457249115),(14,'Waelchi.Shawn','0oCbf6g3H580HdPzG71l3BF5ie-h4xiv','$2y$13$vpy2AbzZvXtj5MnchTwkyOK0KfMbJM6YGxGEIrVco12dOqXgEQzLG','EC95ucXw0GKycdaw_BR3sdedLTosttw__1457249115','Davis.Tiana@yahoo.com',10,1457249115,1457249115),(15,'Bertram04','sMKvFh0itLxuNvlITHG8iOOwZ59IdHwv','$2y$13$sheMKTRrib5zLpZU02lSJ.cnCiyzpYliHujyCD9F45SMf0x.G.8u2','iCF843ILgdLUo0TMDU5LiqVFaB0gKOSs_1457249116','Malcolm.Schulist@hotmail.com',10,1457249116,1457249116),(16,'zTreutel','R4FgYLjb8UU-GYfKF_zI21ZvzVALw8VG','$2y$13$bV1n9iqpAX30rl26l793LOrNlb1m7hSgbIYnTYhIAsAojt219Vw1e','iXYya8OfsBaYafB0_ydCnHiqxCj6pjNP_1457249116','Shaniya.Hand@hotmail.com',10,1457249116,1457249116),(17,'yEichmann','j3-dUIJAWZzBwgRNyJNFbQG6t7SE1sDp','$2y$13$SQA0yHCo.5VBYkMvV0rOUug1n/gumPY70jERVPs6Pw/RNqLbkLjMK','tazGAMA7hdo6-y5RkKnkWZn643pR4MzY_1457249117','Devonte80@Boyer.info',10,1457249117,1457249117),(18,'Murazik.Sonya','awosMPM88Y-81Fy1lorYe6tDLt_dr70H','$2y$13$alLgJze5qvFGl1QPDstIyORgUORYzxBrCsItri4L0BSIqPRtfqq6C','XNuOPgT5-CWB6JT6svaypU2cHimVUlnv_1457249117','rAbbott@Wintheiser.org',10,1457249117,1457249117),(19,'Aiyana.Koepp','CDxCbiHU8P01ERD8zlUi1a8hRRSpgvXU','$2y$13$jlX3eKuGDNkD708LWXntsOPTBaYXHJLbJQPiZrQp0ieXaXCuihtPe','bD8Af-H_oIaubVIGXWspibeMbvWoMc_T_1457249118','Jovanny07@hotmail.com',10,1457249118,1457249118),(20,'Alene.Satterfield','eEdQbSZ1VK-ac-vJMz5bpzQj0jo7Og9c','$2y$13$fu5OJ65LHYeqorTZRMg6iu5adSArGquDtV.uDLMc7t4nNPoB2U0Wy','ACjUxAAihZGm8mSsMO8YeTel6dpnILMa_1457249118','Isaac.Zieme@McDermott.com',10,1457249118,1457249118),(21,'Cathrine75','uUJQZbj5_1TTN7ZGvIqPURc16J5ZWPiL','$2y$13$WkVfqAtdjBanx0uh8EHoHORLwLOL/jPxLhS7TpteiFsI55QOT8qIW','Job7k6yfZHp-KucW1b3x2-HeDwB0M4tW_1457249119','lGutmann@yahoo.com',10,1457249119,1457249119),(22,'Consuelo.Reilly','U3MNPkeOJdh7FeDoix5xCwDLy6PvPgXa','$2y$13$hSGdOXmn63NRC6QhIw8Nb.6dQ.Qn/u9ugXF5GzEqoxZJWSo/SL0Ia','hIxaPESatTgVLA-b3UccMVX6UDp1UDQH_1457249120','qKeeling@yahoo.com',10,1457249120,1457249120),(23,'Pagac.Hilma','4lfy5CP8I4Qqqr8ux9-zsQnjvZbxgvSm','$2y$13$Hu2tXUvEPGU1sh4Ze6hvLumIpXJBRFY54BzDRun90o0IpgOOPWb16','jdhY4rvq5vdGu8_NdE8ofooilXEJwIXA_1457249120','jBalistreri@yahoo.com',10,1457249120,1457249120),(24,'Pascale.Schmidt','I9aI-O-PPIL5Z8Fsb2N-hyP7zuMa1KME','$2y$13$QNP/UVd6uzpu9euEtrIGk.z2Rawjux3CPtyWI5zMcKktEYSGIKO3S','lKpFOxJpujn87t2Zu-ulUVSxn2013iy4_1457249121','Roberts.Boyd@Bosco.net',10,1457249121,1457249121),(25,'qBahringer','qPcibTcPeFZ43KYgRMDfDxnFEnA952t5','$2y$13$9Mfq5qFQATnId2Ljn1w5suWJbogzZsqXO2BexGID22g.Hz6Fkzw0q','-pKIpiUZDOfUSZVfyyWqznTjgcjKNcLC_1457249121','nLockman@Wiegand.com',10,1457249121,1457249121),(26,'Connelly.Brad','ZdAgzsET-ALp17y7RVmgLVCR0LhGCyj4','$2y$13$UAYgXjg4.fj8.QTcqSVpcOcxNF6v8yifJ4k9MLXof8RXK7KZQB0Wy','NUqxDcO64DjIk1rmzHbwVWjA64Xu2kWf_1457249122','Simone23@gmail.com',10,1457249122,1457249122),(27,'Corine.Ritchie','IzIHnpOwpvV2xfu94fbh0AQe8X3GmSK0','$2y$13$2H1y2oXkORXwCL0Hevo7z.9OzMleig7LVPgn7alfxOK6o9CYRK42G','up1-ui4s1-RwaQHonDdW0uV4k5hzozW4_1457249122','Ardith.Connelly@hotmail.com',10,1457249122,1457249122),(28,'pBashirian','g3emwt6XeyjsCwrzscWGds7pKupQ6lo4','$2y$13$Zy/874IFEfvBJv..WgnWzeX5TbRe8QCuL7E8lRQolJL7iTFMa/xQq','KTWPMpeXP5gwFOwJizHVY7wIHqEpGrTP_1457249123','zLesch@Bode.com',10,1457249123,1457249123),(29,'Mckayla47','ZRbtg4eqxIn-nae2y8Ii0YAqor9b1Hep','$2y$13$2Xw0AX316dxyZQ3Ufayju.3I1OfhsHuQKI5nSnnW/HrGuTW9Lvivm','Mu4v95z6WShYWL35H_uiLZhZuoZtxWww_1457249123','Rosetta12@Barrows.com',10,1457249123,1457249123),(30,'Bernier.Ernestina','PjU3dGCU9rMguE3o5PAabhMujrklufLZ','$2y$13$JaIb1VGhzjxFoOLHLcSEnOLArB4ElYURkcJsMUg3qDAI1SnENYlay','IUbY5sUFeoU_-HA_fSF9A4iZqfGsAuQ7_1457249124','fKautzer@gmail.com',10,1457249124,1457249124),(31,'zConnelly','BOOUghNnPvAtnQV4ulnf3zC0f4CgUxlz','$2y$13$.waLn8NjjIinWRYakwPHkenHBvlIBlexRUblgjgj0qVpHVegBDr3G','NoRCYNdjXiC4Iyoe2xJ87AcGNCktAORg_1457249124','Clark.McCullough@Smitham.com',10,1457249124,1457249124),(32,'Raina.Dietrich','DXFhfnS7Nk0NbN4emkCOrtrjQlfwunII','$2y$13$j7DbcPa0fiMRiVUastETceAeuIHSYYl5tV4avF7Qq7OpGIMI1MHd.','02pPkR3QQ-Syv5Ayp3FB0vzwxXYzUG59_1457249130','iKautzer@yahoo.com',10,1457249130,1457249130),(33,'Caterina66','XUR2gzOXbO_EPBpfh15mBaK880X4wiR3','$2y$13$gVqQh473S1Oe5q7t7v/wVePTHhQgxA22X6kDtIogeZBulZji8fk3y','qeAEUfIfPDUIdTUQMjo-yWQPoWY_z76F_1457249131','yBruen@hotmail.com',10,1457249131,1457249131),(34,'Cyrus.Ledner','5ADNP5LFif4Q061jEj9biAGWf5UF26w0','$2y$13$estq3kBCNjq83pAUmRk.UeKdRo77KiMDI45YyMdju8WtJhRSDIbB6','WEFedo13c2Cemr0DNCAdevz8qeKTCFBc_1457249132','Goldner.Marlene@Bradtke.com',10,1457249132,1457249132),(35,'Floy.Tromp','qveELa-mihz28iax0xyyfGKiBRF2RF-4','$2y$13$DSWhoUfSJq6OiMMZ7X.Jtu77AM2Kqf3kvwECbHwWiI3iQT5JXwJk2','YNm7YC9u2OMGehU4a_u28qsHRqMMZ-Zz_1457249132','lKozey@Stiedemann.com',10,1457249132,1457249132),(36,'Alf.Huels','zIUdT4WV-TetdYTnDSV77rY-fYb1Az_s','$2y$13$JkizNdPyT5Mc.NXHBqeGIekJCA9em.ZIeYrEvSFksfR2BOmsbtyF2','-qOR6AudXRs9Uvi2Rb_drgybvAED0hsW_1457249133','Schaefer.Kali@Kunde.info',10,1457249133,1457249133),(37,'fChamplin','vWCRxM-7yckOYjT7q0Znvo9SV7U3ePK_','$2y$13$5xHrleoO9T3iortm49teEe6m02jjzQd/r85/y/YnTYByb4gItcxIa','YiExeksF20lUYZDVFtAxab3VhxgCWy8v_1457249133','fSmitham@Morar.com',10,1457249133,1457249133),(38,'iVandervort','R1QzuUl2XZ_IfF7gbeHPPauYFzFZgly-','$2y$13$94c0b.pfaLESLdshvDJOL.GMola5o6zF1jFtqVagJIjNPbygJkZ8S','jzqzMJizvyy7YxXvv1r7uB-9HUYAL33-_1457249134','Blick.Reinhold@Nikolaus.org',10,1457249134,1457249134),(39,'gHammes','K0Nr9Itf3eS7dLjF_o2FIUzE6xWD3Z2e','$2y$13$i0GhD/RK33mG8C2zLULCr.5Jr5ZfrH5QKov3kqpBarpL5AbuX4cU.','wgsaZEjLb_EPZm9rqgt1ZnLaMwT_xbWL_1457249134','Selena13@Durgan.biz',10,1457249134,1457249134),(40,'Ritchie.Stanley','xFcGhKcYhMHuTG4ljZHXgjE4C-5qrekl','$2y$13$/Uh.cmh/MSYbdvoCe.aPWeD.4qI5psAbfMO1XQNDQEIVVQSwZVQy6','k4ZozDsQGf36fmvyrKFfLyI6tlGTC37g_1457249135','nPagac@gmail.com',10,1457249135,1457249135),(41,'Gia.Schroeder','2OGNMnEevvmSy-SpiagnqAjB1duXQNkS','$2y$13$wYeB12.YhWT9KGORLVh4D.8gS7fQl4eN3cNrMnL.dkCeeFHsYj80K','VnYtMAR7BzHukMFy2VQd1VIzFKmGvcW1_1457249135','Hermann.Brian@Mills.com',10,1457249135,1457249135),(42,'wLarkin','LtoKfO3FAYVyJlQl2L2Z2FgtERVmcPNm','$2y$13$LinOvhayb9Gx41OpSDgCd.UQMi9nOxL.vV2Rfdi1SeG/b5LfiA6Qu','4MD9QBJPUMFri9JwmLq8AJe62zg_dsSe_1457249136','Schuster.Brady@hotmail.com',10,1457249136,1457249136),(43,'mSatterfield','l_oSWtQMVQpkfLgwp27hIjncTgHIQf5R','$2y$13$P4zoo.jHqmjbh3bHLY3mz.Q7ALVhJjT8MT7gMCaK4vFJOCvWJJLOe','F5l3V5XfEqov_e9fzgImMsuFXVRmitj5_1457249136','Zachery74@hotmail.com',10,1457249136,1457249136),(44,'Candido46','xt2Sp3n4PyUt1Db1ukGZFNs_9JmevBLH','$2y$13$CRYpctJe3ntcXts1ooYUJePOmrIcdxat.8kShKiFNwvKI1P2EABo2','Tursa4HAUq0J-BdZShyRfouuGW009Eix_1457249137','dHane@Gorczany.org',10,1457249137,1457249137),(45,'Laney.Metz','426Olj4krr4orIszONY-575J-jju69VY','$2y$13$Ed8rPdffydk82iiLPYg0husZFaspR.IkU0DMzPlzRHH5TETowzrZO','FhD9n-N4bXRtbriTgMmkoyXz1oO3VnSO_1457249137','Charles.Walsh@yahoo.com',10,1457249137,1457249137),(46,'Olin95','ha5P-ySJtzLNCalbFfhYUddu_CVa957k','$2y$13$3.Pf7h.eRDLGfh.0daLYoenbtWpnBG7iJ6p9kGe5LgunaRkOXDLFu','Cg3tP3LSNFt_riYgBdQ7erryojPB9AQY_1457249138','Purdy.Antonietta@yahoo.com',10,1457249138,1457249138),(47,'cOKeefe','g9NdRfCQXkxie6WswcPX-JXVeqMfDWr3','$2y$13$sIq5KJkVTK.4qM5lnV2h3uM/Nr2YOqYvGrajLc9rYkwtUc/S5NLiy','0wYzLh7g05sheuUHiC2UV3s5wmP8UZTA_1457249138','Giovanny.Lesch@Ritchie.net',10,1457249138,1457249138),(48,'Hodkiewicz.Daphney','Dc8_IPUC5irpx61jxc9AO4D86dTDof75','$2y$13$qb3qT8.wVGOk1p4LmdR3u.UuGl2b8inNQie/OUH3gdTLTB1kBgcTq','K1Lqt0mbFuZnhCK2XCB6yc88zOkngTfK_1457249139','Emilia.Gulgowski@Gerlach.org',10,1457249139,1457249139),(49,'Funk.Rudy','m0Z4avkW6Bjmej1287fqkJk1sYFFIhzF','$2y$13$KsLv4YFkoDLaD3AeIwKRhe4o4mg/TnCd0C4/us7Oc7nvf14OVx5am','Op2rY5KPF2nbu_PU6iqIYFDY-dcLAHnC_1457249139','Elijah.Sanford@hotmail.com',10,1457249139,1457249139),(50,'aFriesen','Hp9KuUDKYWHVwfrQL1k3W8O8Rgi_OcTa','$2y$13$iSuR6rhjdgHnCPoREzSDAeJI7oMFlrM2yffO/0hqnGYhpkL48DgRG','L-V-vMiNFVM5wO1br0tUlrKgQPThuD3G_1457249140','kDenesik@gmail.com',10,1457249140,1457249140),(51,'Aurelie.Huel','x4TcG60JN8m8090G3UxlPbCCSLWGzfkM','$2y$13$cOieZHBvbwcfG4wI5whx0.Jtw6odw6bUlK1FRdtxthnGgBQDOBoGG','gluiqavlnMdSKJ2EuD3RvMZ2vzstCqv1_1457249140','eBartell@yahoo.com',10,1457249140,1457249140),(52,'Stamm.Kennith','75hqr5sS9KyNcoH6y7ne4k6LD6JMbb7k','$2y$13$BUDUhxaa7CjYADUCLP2p/.6c9uGRaZSwrGYP7CS01TYfCWpa6Ida.','KDcL7T4sci3XVR7gEsTuxzOBvYjX0Ifz_1457249141','Michelle.Corwin@hotmail.com',10,1457249141,1457249141),(53,'Stacy86','IVsNGoBRSl62mfCXfGOOw6VmKBmUH9Jo','$2y$13$dw2QnZnFRmBcp0SZKkWBUu942dORaFYthh/ocwMXsWiLQy5Zbq7IC','H6vds5ScSTBa2ZdE4IH_Vz-msJlWKT4l_1457249141','Ladarius.Parker@hotmail.com',10,1457249141,1457249141),(54,'Cummings.Dulce','ACx-1t_sVhA08LPxHamJLA3WQI59F06q','$2y$13$cvav8EYEY2MTTGxtgLJpg.BEdlO3kILvZJN9nEUDs.u0XuYRSxW/e','_wMt_As2UQpK4gnr0hTBFHr1JEX6MPDf_1457249142','Colby.McLaughlin@Hamill.biz',10,1457249142,1457249142),(55,'Spencer.Faustino','-3kzQ1CU7UqCELtfqpANfnoMIql1Jxi2','$2y$13$kBwHUnH14r.6YMn39ddYWuuqHgNOzUDpIRDFKrzHk1/zq5ILi/zrS','ne1SpegNK2g3oQEE0FOuqSda2rj7M0-X_1457249142','Caitlyn16@Rau.com',10,1457249142,1457249142),(56,'Aditya.Beatty','w2-J8nn3xm3a82y0TuRd1cGksbYHLeSx','$2y$13$i2Jn/k7ehtYAxX0LzZQ7Q.xqQLdN/pt3kYHCeiDakaTe3JbyRH9Iy','v9WsGkXvyQctm7G8w4W1Pa8fEhrW_DEz_1457249143','Napoleon24@Okuneva.com',10,1457249143,1457249143),(57,'Jules43','MixicjBbbewovN1hnrW5z3Fare9_cjsl','$2y$13$8US0HSee04WtBqhHxT1fn.jz1f5KTTs5wQaP.KbiPhDsjiBvQ.O2e','lYzFYw5zWR2DhLSuA9BEV_M9idL24j5Z_1457249143','Rosalyn08@Gottlieb.com',10,1457249143,1457249143),(58,'Deontae79','UsdIDGbVmyTfDkcExmEMweiVohPsQr4B','$2y$13$y1ndcqpw5dEpx.I2KxQ10.6ujPJK4VOpWtSEbWQV/81o3yCyXiUr.','Kgk-LF0hOBBS_rqBz2Qr4c1Vm7g_fa5__1457249144','oRath@Lindgren.com',10,1457249144,1457249144),(59,'Ally91','O3RoaFMan-0RSkerCGZi9M4cKZZd54xl','$2y$13$uNr1QUjaI./unO5cS0nyQeGfwyLFv2.SLVK5mVXynwL6DXaZ/7Zjm','ZGDrjdUSrRzHifR2q6KaNVrLiR7fWcHt_1457249144','Lawson.Olson@Weimann.biz',10,1457249144,1457249144),(60,'Quitzon.Mariela','TdEkQOp5pkqzAW6YsvVmTtns88-C1t0f','$2y$13$OtYY1pv4i8RrIp8lSUm/p.9ZLzeGhV6dDFz76dLMc8dTI21mYhx1K','0_5VpYFrGCxnV9-G3Y-t8jPKN83WXR9J_1457249145','Kristian.Shields@hotmail.com',10,1457249145,1457249145),(61,'Bethany.Keebler','4UTUZwGO01KkzOOWyZfcv3H1vhVyCN9o','$2y$13$qWp3swrhQJGVmJLdB5PxzO3cY.UyA/vWBcf7CwiMKiiRqYWEzwV1G','f_lmYru0bReNuCMg0nuuHDc1Y7NmaoTw_1457249145','Waters.Eveline@gmail.com',10,1457249145,1457249145),(62,'Alta.Waters','BXGER1_fptdj4yr4yB289g_uy0Nxwqq1','$2y$13$7B8.ClBWvTYS8eo5zxgQ7uCAFjGlWTZdxapGMpHEW88HI/LNraT1O','fMampg6-QqfnnX8oOtBpp18WC2BBCs9y_1457249163','Guillermo56@Schuppe.com',10,1457249163,1457249163),(63,'Lowe.Maiya','ZGWixZkANSUv7H6aQYnyO_6GS2tjLQKz','$2y$13$jfxOBmpegZ7/MY5ZsEkF/OLb87KCeNNIRV3hXJ7fRoK7aW3kddyyK','W8IklG2WggO8OaoCxsvpzOVvEfaGIBep_1457249164','zRath@yahoo.com',10,1457249164,1457249164),(64,'Vivian.Gislason','AH-mHCno-nbNlGYzfIE0QVbRnfNXIeyz','$2y$13$DxGhRk95admSIK8FeJr.fuK6AbMhaEdyaZVuhwp7MXXrUmDq6dEmC','2rMncciZgjtJE0gIQatg5gB24yDoaTUS_1457249164','Tillman.Tavares@Littel.com',10,1457249164,1457249164),(65,'Dewayne.Leannon','PXVsU9UUXiCA6ccE8F1DjcB-cjvZmHS3','$2y$13$pb6laI3c0mdUJva2wO2DWumw9utCJOW1DBtKJ6Uc1M0E7MWh3zrJO','sRWkBZINVaP4N6cpktTqtDNaPeeHbMM-_1457249165','Kautzer.Rocky@Walker.info',10,1457249165,1457249165),(66,'Goyette.Lucio','F2FPgIAP4PU_1S9OwIu4vZKM1OaCGBQk','$2y$13$xEpVxnaSyhFcdYF8YGjJDO17my9l5ON3PXbLWBvzBa8crnDtFoJ2m','649Xujw9_J4TeMhZ4q_yJmMYFjjGrR4Z_1457249165','dLittle@Zulauf.com',10,1457249165,1457249165),(67,'Deborah.Roberts','eAmJncKhhEy_A5aMhyFq--uF8TQSXPFc','$2y$13$W6zhHstEzzB6Uk/ajxG67OL3ppDHAstWHf5z08V32hLz87kzb6bX2','FfOSLM4N5xXpd1zcEH6tMEkls5q1A6UM_1457249166','Toy.Alan@Brakus.com',10,1457249166,1457249166),(68,'Hubert.Mills','iJd-5_a1PV14j6rYC-AAbubCWoLLBPC3','$2y$13$VRZALt6edoZUB6EGp7EY1eyNwgXtpPBPPjarpx/wykrEkNMVOi7we','WwdAMtyhz2BLPoDZsw26HXog8pX3gUCS_1457249166','Hadley31@Flatley.com',10,1457249166,1457249166),(69,'Emmerich.Bryon','TOjIAETvMdPuddkmyqUfDdzv5SHnUEut','$2y$13$1qG1BZuMfQWDcuez.EwnT.EqoaZ0HGJZmsz2B6f6wyHmFMhnMuJ2u','o2XPY_ytQHwvF5MtCeYKu0gS-awzs5sm_1457249167','Tia.Wuckert@yahoo.com',10,1457249167,1457249167),(70,'Balistreri.Zane','t5YkfdNVosBtfU-sFS-dWwLq7ghvJBTE','$2y$13$yW6Kl09ao5xDNCRJPspzQuVndJQ/GUizUbPb1IivqJjMk27ECZp56','p5_t-GeGdRaUXldBuH24-L62KqNHn16f_1457249167','Dusty81@Waters.com',10,1457249167,1457249167),(71,'Camren49','4ZWkoCsRt8fjefGnAKM6YR3qOr43Em9m','$2y$13$QbrAA9983V/Bz8n.kD0XAeYztpVW6kOTLe5.fxqdJbmItscCPgVce','RA7MlulwgLtB4-s3HtnOLzsW_YlfIu6G_1457249168','Fleta.Kreiger@yahoo.com',10,1457249168,1457249168),(72,'Jakubowski.Mona','z9Uw35pXWlhcbzg6zTC7-EDPoUgW6IWx','$2y$13$0UO1NXXBtW1Xe.e18TVvR.rE4l6rU0LMHRkgrF2KcJ1VvhbANskCS','rpX3-xNlUiIJwa9gYB4-3d7zhhfkzFrW_1457249168','Shania68@Wilkinson.com',10,1457249168,1457249168),(73,'Johns.Claire','NLqLL9oLfIge6SMxscyBPLb4qmRpJqKD','$2y$13$3ZATfCvXGCZdAfl14fSJt.3kLI9XX9LWC4147xwvEPc23RBxKEyZ6','hL4jtiOsL2t1Y4vPs7JbO_Q-43ZSXHAl_1457249169','Maybell27@Feil.biz',10,1457249169,1457249169),(74,'Hamill.Cheyenne','poG5gVieJ_dg6qaC8plxbF6IGzzkx13H','$2y$13$HodFrpLS42404/.O0hy7teck2/Ha.K2Wp03u46pGuBrhmNV0aeKqW','IHC7C1Mo85kP5VBh1H16e5mOs9Kp2kfP_1457249169','Christiansen.Sedrick@yahoo.com',10,1457249169,1457249169),(75,'Yost.Billie','cKOSHOFI-q481rQBqjnZDwVS5sjGKBck','$2y$13$hQ8Qo9oVZ/Mq98V9dJYBAe54EaO6C8bLPulfO5fvPvWzynlBl4IFS','5AX4X69z3Oc9dmyMx1_SVSx7u4xIt5ms_1457249170','Hane.Thad@yahoo.com',10,1457249170,1457249170),(76,'dPacocha','xm-GylMhv4-1SbJi0SRAzVdZPWhI4Mni','$2y$13$lHJr67RNfY.NDTjc0UShOe5lfX/jVUGMHqxMJu4JsjcJc0nm5kSRK','-VHggQcwvrKPLVzWXyMYp34-nNjMqGEd_1457249170','tKlocko@Blanda.org',10,1457249170,1457249170),(77,'Wava.Reilly','468di7SA2dBlS7c65aaEM0LnRdCussVY','$2y$13$Xkbr7vcv2mZz0HgQLaTn9.nNvlyapnPYDRcv929b4Y3Y.wqo9CswG','VUpu-CD98C28OeB84Gct6osi5vLGT5Z2_1457249171','Keyshawn.Wehner@gmail.com',10,1457249171,1457249171),(78,'Larson.Karolann','MwcGxfJ642gf1h3SxphVoKTg4DnMLyfk','$2y$13$QHH2JlCq3kM3qziwd1jEEOymj0hfIrWoXYeOLOZUvl01EtheyyWkq','fOJrz0yGPE8KILE4MVgxHON0fL-YCNh8_1457249171','Lowe.Edison@Cremin.net',10,1457249171,1457249171),(79,'Casandra.Daugherty','081SFq3QX-rGpqVYuSWpNSxCYlBUhv77','$2y$13$urUgTFna9246TfbQhPfBcOLywDPtxzvzAkJvJ44824uoy661gh93y','NKebMFL_n_71g6lj_i3rSI11-WvKcGKu_1457249172','Brekke.Demetrius@gmail.com',10,1457249172,1457249172),(80,'Lucio90','CpzXCeojtYJove7FGULiydn0yzSXc6oC','$2y$13$uiCmv9BQw6iBuZIlRLiaEuBOgBUBfo7E/9UDLpbO0o9XOPVLtH6Sq','7gvsVxBHc0hE1NiEVGN9s0sWawtSw6Wk_1457249172','cHerzog@Renner.com',10,1457249172,1457249172),(81,'Larue55','CPvVxahC_D_fFhjDix2lQnafy_kLQy-N','$2y$13$CK0oBJAcgklt8wwOrUZBoeI1CBI8zdZ3cfPpdNR8v9n9ukwvu0sXO','Z63HOgwQEmUmMQhoD7albcvjJ1_7Vbri_1457249173','Alex.OConner@Heidenreich.net',10,1457249173,1457249173),(82,'Grant.Germaine','apJ13UD9gRC_wH9YldMqGGSagzRDC6tg','$2y$13$6a3rDqyzoLdwpPxHWZ2BEOCWq9dbsyqC.l9/TfgfrfZ94yZkRL01S','IxCvOp4OSuSeQhgme3iaHumcBpBeJJeQ_1457249173','Christina.Kessler@Wyman.com',10,1457249173,1457249173),(83,'Orpha19','Cln7RcJ6eETimDHfxveBJDXxoBWWLtzc','$2y$13$SnabsuKk61TNUNjJNLf/QOkJxSoZnt0jPEbUdDtvERlpSQI8bJ7cK','YcmT3tb69jAgHPsWuhRelDQ73bOVzQJ6_1457249174','Maudie.Emard@Thiel.biz',10,1457249174,1457249174),(84,'Morar.Susie','LBvHsQMrXRmqy4uFudydfRMnOlGVI8ml','$2y$13$YLvkTiCe6Q3atrPhj5m3rOkY2JClvi8ElF1iqeFGWwJsPQbJVAtF.','qlMurvXYdIYPy30wl804GOPzkn-7njWH_1457249174','Kraig.Kuvalis@gmail.com',10,1457249174,1457249174),(85,'Arjun.Connelly','tmJ2f4lzL6zFBTZM1o2BHhABaYmEkWn4','$2y$13$cU9sAQ8pUqoV6LNwetngle2W7c5xondUQIOllZP42I9Su4Jbbi/WC','Os-_979CWA6tq6gyU_VqtqBpd2-JiH74_1457249175','Moen.Franco@hotmail.com',10,1457249175,1457249175),(86,'Rashad33','p7jXIxDWdN_T7Go2HY41TsPW0IaDvHbJ','$2y$13$3BPYnPOyAa3Iblecocun6OP2jbAjpLz.8zSTRbA9OrHcusgBPm4pS','Xpbtty4Hgn40-saeudG7rpKsmoFZYN57_1457249176','Raoul82@yahoo.com',10,1457249176,1457249176),(87,'zFeil','PlzU3AZOIGL_E5HSp4N15kJ4kFOP3cbd','$2y$13$mnl0I5hf8S.HXWLlu7HoouyggaVc6q8OYAWlPq8HPH1ic9VvgibCe','Sm0Uqmn9aem7t4i6kxhEGA3RhcPuMqz7_1457249176','Everett.Koss@West.com',10,1457249176,1457249176),(88,'Russel.Jaleel','c0RyLhOqs8Lqjc7IkuLZO8uQDWS7Tk6u','$2y$13$6unSeIXyovNRqw6cRa5HQObLMmdVZXtU956Y1lmKEJMmpZcDgkZmi','VPmVcDa5mzLxAn1vKrr7Evz_UGjXrRXo_1457249177','Volkman.Bethany@Brakus.net',10,1457249177,1457249177),(89,'Ebert.Brandt','9PwSBqWGuY8FGSQn0biBnQPf72B6j4Jn','$2y$13$95473O91UybSS6ykh/WZzeCISidNfg45MYwDLB/PoJ7CSSZgNmbim','aEF-zEin8CvCPkHHhoKl6DI0hUHYYZBX_1457249177','yJacobi@Champlin.info',10,1457249177,1457249177),(90,'Maureen93','Rjd5AKKem9XF9P1XO-4XV5tLmb-rBL3h','$2y$13$uhz4D0.gmgI.xyuzm9wYeOT2ZSMp7H4i.bt2V1ROAqJUbf0GJmNoW','xatVQNbLWbuEL3oqEdwqj-BBc27JDlO-_1457249178','Aufderhar.Devante@yahoo.com',10,1457249178,1457249178),(91,'uBahringer','0QCHHMX7nHD2-qcXhlubRNFTQcdb7HSz','$2y$13$KFYi5d/A5gYWkZ2EVxIzmuE2UNnVe3on8poKLfWUmS66eTkajG2Eq','SWWhDMaYCE66v84HxCbBQ_wHPf6M2wlK_1457249178','Legros.Oceane@Hermann.com',10,1457249178,1457249178),(92,'Sven16','e2cTrzw9viebNn_HuKgM56yINQ103jx5','$2y$13$eMUJHINdzlrdFtzLHMtk2ejy9csmX8BMXXf9MK0Jhm.YgEI93DGgC','ZFsIaALEBJPi-zUEqKk17KOWJw2W-r6W_1457249179','sRutherford@Cole.com',10,1457249179,1457249179),(93,'Geovany.Lemke','hTZ5bB6fFTAIVb89MxBgNimOvbpQs6Fn','$2y$13$9AcmhDBg91m/tJP/yaQLAudmogBajH5k8e70AL2q73p9AUFIrhoiW','o-NpAVKeffpNoWECW63_ZI4kW3X1FjTR_1457249179','Konopelski.Anabel@OKon.com',10,1457249179,1457249179),(94,'Efren.Shanahan','b8tk9nhHOHM4KXWAazZqENEJFsXad18C','$2y$13$wMWu9qpyuK3vsZC3yLc5DO8N17ytQ7Kl/Zm/d5yI/GS9JTxBzX8.a','B0Uda4fj0REwwMsYm6rKlZljgeWzoHqw_1457249180','Maverick75@yahoo.com',10,1457249180,1457249180),(95,'Alene.Luettgen','H8Co15YrUuiffJoQY4-Tu4t4umOefkR7','$2y$13$XRjE3UUIm5FzaoehogDwUu.bjyH/MH8Fz0n7WGKgODWGymT6cj/a6','WRtldziz3bG3E1__jtkkDRheexOHwWIu_1457249180','Alyson.Schumm@gmail.com',10,1457249180,1457249180),(96,'Darrick16','BFOXI9YEdjEm34D8Zx2vB9xtQJDX7e7U','$2y$13$NV9ED64uwF2L/YAY66bZ0Os0kLB4yqCcflWCma/9sn/XQZv376x1i','q4cZZqO7a9BZhS2xQxLmrj4WFR6I9tWT_1457249181','Kiley.Rosenbaum@gmail.com',10,1457249181,1457249181),(97,'Kellie.Donnelly','TMQ9kSt8RTbmgDp_zWUgjyzEcnrhG1W5','$2y$13$1AKGy2LusKvewI7KTDDeTuB90.jleKvYtEUiRGx6CBtCnStCmnerS','CKn-1AnHJx_X38hBsqckfzlYTAogeu3D_1457249181','Curt.Rogahn@Kutch.biz',10,1457249181,1457249181),(98,'Mara.Wehner','zo1qOwH5Tdl9jybBBEE5VcijJEvIOR6z','$2y$13$KaDXN0.Sm4C3WEEbVMcfvugSlEP6hgKiT8HU/INWWzJfZjMDGhVEC','eCy7-jryww4tTrAFpDZXshh4WuBFcge0_1457249182','Little.Darron@Gutkowski.com',10,1457249182,1457249182),(99,'Reece19','sahB3GUTORn8rCb6PRuy7azgqFo80W5Z','$2y$13$HlIaFWHcWSCdinZP4gLjxucTqS68GYhihD7MNGpCgqcSHPpJ.NC.y','KjCRmKuCplkQMeY8xUuTKK3secpj58_t_1457249182','gStamm@hotmail.com',10,1457249182,1457249182),(100,'hLemke','vviQ0GuScBcBqOZXSssZappubPgq0lA-','$2y$13$p5zTVPFl1Ky37baWG6tv.eNLt4SYTm1ks/PPhaKguuDlPZcvh.bgm','aWKUNaml8GwJCBEJO4Lkso9iF_xPdsj9_1457249183','Celia05@Witting.com',10,1457249183,1457249183),(101,'rDurgan','o1suUSasaFb_8KWy-eH7M8NuvM23GaMK','$2y$13$tSUy/Q4sgmv09mcLJOiSEecjxmm6JrlPjRVa3eP2cLGhE4fTV/1KO','bdy_a31xR6oWy2LA-WVaGWdWap6_lDJR_1457249183','Luna.Ritchie@yahoo.com',10,1457249183,1457249183),(102,'iDuBuque','9k6mbTddQnEznQj7l4Yn20RDFyIS7wUD','$2y$13$rkv4qYIRDFjdxS2TgE8v8.Bs1xVUUfFJ3Z0SIiM0j2pVOqXzPdX8G','TpojnqF7Qu88WjGOlWZSiY_Ij2YyG6vO_1457249184','Verona.Corwin@yahoo.com',10,1457249184,1457249184),(103,'Pollich.Tanner','liU_y3DQkQqpFQwjlroX-_L9P2qIeQkL','$2y$13$UpK88s1XHHJPtzfjgyxogeeIVoEnuFRvmzEvqi1t2134bAOfZdVTu','UrmburItva-qVMP4ttbw6s1JyPPjoi1S_1457249184','eGerhold@gmail.com',10,1457249184,1457249184),(104,'Smitham.Noemie','owL9iDVHQzVRkqGr_opAoR314bXs6AY8','$2y$13$H2b7cw9u2ZzImPJ4IsxjDuESai4VrEAh8NmSmqvlAJIyZGGogEnfG','VJ-LCGjPd3QywvvvO4svgTY3dPgJL7oa_1457249185','Marlen.Smitham@Sipes.biz',10,1457249185,1457249185),(105,'Keaton34','FlK1K-hWQrRRi0onwGy16-JoFEdyl3Lm','$2y$13$.CkQksqZrnaqYhn8QaeRw.leEav9.kM3.rLXhGwHeBSz2/WueA1/S','BUw2dWQFdLQaNTvuekORoHY1j5EI1ai4_1457249185','yDavis@Luettgen.biz',10,1457249185,1457249185),(106,'Bartoletti.Braxton','Ag04ledBOp-2SGcx6MRtDRk_1_1kgNPa','$2y$13$9NU/qpYgF.TeVZ5/pApS7.nGBQJOYOrmZm0UI2.tek/Cc9muVeSpy','CXI0jLsvjgTKX82mX8zjvp33I6dqWFHN_1457249186','dKoelpin@yahoo.com',10,1457249186,1457249186),(107,'Pattie33','dhOZWSdQRm-ooSBTU-luWeCUwgKN2eYu','$2y$13$HhOI/b9u3ddKh5lpoGLxseSyuVG/jiRM3Wx5AHeIV0NMlAfUTp4d2','Rc5xfhfao09P7h7fEHDlyw9OtasPojWl_1457249186','Bruen.Jamal@Nolan.com',10,1457249186,1457249186),(108,'oMorissette','1Gy3GeJUdK76-zr_3KFM7AxQvECXrsEm','$2y$13$beOoO1mnenTYg628u8W/P.cLahGv6jkCs.TGc/pw0BZGw67qc9Kdm','V6Ec-gJ0sW7BUmYZZWSpSrmZwuiJyw_T_1457249187','Yasmeen.Nolan@Legros.net',10,1457249187,1457249187),(109,'Casimer46','osnoqTsts72O8PXUrMRr1wf1xnbNfNAy','$2y$13$rzmReqM3y9wf64Np.LIxuuBKk/UQRziZk7AdikzPCXmV8lhdvTR1a','fz_KerknnqV_O3S75k5BtSiIZi4R0VGC_1457249188','Kenyon.Smith@Ferry.com',10,1457249188,1457249188),(110,'Frida.Legros','CxAgz9Xmxfr-0kHBw5YwK7GtGXWi8kOT','$2y$13$jMFZ2buAxhx2sOLa2Fj6Fead6/iIhkL9nlLzS8C2hY6Hz3DXeWelu','1jW0TTNn2K6JA8VCj1V7dpp3BDH5Vmeg_1457249188','Hammes.Korey@Wolf.net',10,1457249188,1457249188),(111,'nKshlerin','pKa4RbSng1r1POBztdq_h4Gw7Y2qU8OR','$2y$13$Qp8K3Z8LtuP5AXmW0isZ0eELmv905w8lRMIeEK8FweR0KwfratF5y','c_X170RQ7DNWF3LpTEtE0sVFFvpNXeN-_1457249189','Mercedes.Shanahan@hotmail.com',10,1457249189,1457249189),(112,'Gillian.Gerhold','4TsVMMSzMeua4XXs1HC2U8utdR4DEx97','$2y$13$UTLS0hMgp/fjT7X/YVxdfOfC6aMGNyqn24NM0ulpMJwB58UMgFDve','mSTVmMpF3QLcUoKy7y9KPEfutfl42fPe_1457249189','Briana.Eichmann@yahoo.com',10,1457249189,1457249189),(113,'rGislason','Ya7D-T2zkV2YNpLlEBD7TliOFJ9cvH_K','$2y$13$fdblyuSiFItO7qzUXwNzj.q2WXXKwL9CNvvgagLFgXsOFvUlVJhvW','aoZ2ep-v0aAt_lPTJKqR4hMjQpTYcEyD_1457249190','vBauch@Wolff.com',10,1457249190,1457249190),(114,'Carroll.Micah','67SqbYUB1KdeZk1qsWTHTNlzc8Oe4mPH','$2y$13$ZQhrv7r3UxFjDTLISGfF3ud211detdSX43ICWl5vU1miqSxMJKLIa','jK4JxKQgTDQOtBRp7VZsKVSbSEGZUlwY_1457249190','Armstrong.Cristal@gmail.com',10,1457249190,1457249190),(115,'Enid70','u1DIiOoO7QGPBbJOtum4AUPWnLfcDaM5','$2y$13$lLZe/bfZKiLZDYULpeFykO7OgDZCK1X4fm.INAASpkW9TvPJeUSru','HmYGJBVbbdYNsBoMyDPFeu3jRYsWx93F_1457249191','Emilio.Kling@gmail.com',10,1457249191,1457249191),(116,'wRosenbaum','91BfX_CF2z_J6aCmt4zRlmsuVH56Tfp_','$2y$13$NHa2kTb0wi6wEGs6AnsDF.5B/Ait1if4B3H/ihvREzv7BDnk1k4EG','Cj2lJXnHSa5pAM2sGIMN7-dj0sHlwLDK_1457249191','Runte.Shanie@hotmail.com',10,1457249191,1457249191),(117,'yBoyer','zt4vIX1N5xOqKdRhMNLjJ2GYV2bAa4XR','$2y$13$4.cfkuNwTk0kgZp79YY1wuSBucN/IgkeT8iGXkSNce7oUplHG/cT2','C-2nJ0frdcSrNUFIib6DeZmDRjFktGzW_1457249192','Jast.Kayley@McClure.com',10,1457249192,1457249192),(118,'gAufderhar','HOmWXDd-J1RWqxbNQvmoOAnM-y0bya7L','$2y$13$3A5E6oDlJJMf.1uUlIwP7OAqLy9hYy5kOvZyHnrEh7.AuK3iNlEOy','aVQ3pmdFDgvY15sBQoZQqyxGWWVL1rHL_1457249192','Abraham21@gmail.com',10,1457249192,1457249192),(119,'Karianne.Reynolds','ofcL7cy6kEcw5E2xhfWrfrCdt2umAQi4','$2y$13$RDUiGwgyxTbmKrLSWfnA.uA/Kwh8QEbzd2b2N3Z9GahwptUz9W1ve','naqKze6EW0XtHEZMN3mRm7xk80ZSgNxW_1457249192','Janae.Goodwin@hotmail.com',10,1457249192,1457249192),(120,'Anne44','J71rNs93xWi7tpBNZA6FsrJJPiFy6OFY','$2y$13$Kdu9cGaHc34dFwUiRkToEewOmnL0oo74ypLNFVPJjAdGq.FHuaA6m','edks-10v_xXYYSGiRppTXQLj0-7DjIPU_1457249193','Carolyn13@hotmail.com',10,1457249193,1457249193),(121,'Tillman.Brain','gVePEFRP2XxhsqTcH99A2Wfo4FoQzxQO','$2y$13$SE.5h7mTD9JVZIkTWvCT.uwH6bnVzJLw.TgU2gy85.kDfgyRSLFB6','0g56zB3Ab-vhEywVzJ4wBboZSMQp9xrs_1457249194','Devin.Goldner@Bahringer.org',10,1457249194,1457249194);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-06 10:46:34
