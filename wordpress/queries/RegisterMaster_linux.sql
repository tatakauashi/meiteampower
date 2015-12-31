-- MySQL dump 10.13  Distrib 5.6.20, for Linux (x86_64)
--
-- Host: localhost    Database: db_wordpress
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `Member`
--

DROP TABLE IF EXISTS `Member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Member` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(200) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `regist_time` datetime NOT NULL,
  `delete_time` datetime DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Member`
--

LOCK TABLES `Member` WRITE;
/*!40000 ALTER TABLE `Member` DISABLE KEYS */;
INSERT INTO `Member` (`member_id`, `member_name`, `sort_order`, `regist_time`, `delete_time`) VALUES (1,'東李苑',101,'2015-12-22 21:51:03',NULL),(2,'犬塚あさな',102,'2015-12-22 21:51:03',NULL),(3,'大矢真那',103,'2015-12-22 21:51:03',NULL),(4,'北川綾巴',104,'2015-12-22 21:51:03',NULL),(5,'後藤理沙子',105,'2015-12-22 21:51:03',NULL),(6,'杉山愛佳',106,'2015-12-22 21:51:03',NULL),(7,'竹内舞',107,'2015-12-22 21:51:03',NULL),(8,'都築里佳',108,'2015-12-22 21:51:03',NULL),(9,'野口由芽',109,'2015-12-22 21:51:03',NULL),(10,'野島樺乃',110,'2015-12-22 21:51:03',NULL),(11,'二村春香',111,'2015-12-22 21:51:03',NULL),(12,'松井珠理奈',112,'2015-12-22 21:51:03',NULL),(13,'松本慈子',113,'2015-12-22 21:51:03',NULL),(14,'宮澤佐江',114,'2015-12-22 21:51:03',NULL),(15,'宮前杏実',115,'2015-12-22 21:51:03',NULL),(16,'矢方美紀',116,'2015-12-22 21:51:03',NULL),(17,'山内鈴蘭',117,'2015-12-22 21:51:03',NULL),(18,'山田樹奈',118,'2015-12-22 21:51:03',NULL),(19,'青木詩織',201,'2015-12-22 21:51:03',NULL),(20,'荒井優希',202,'2015-12-22 21:51:03',NULL),(21,'石田安奈',203,'2015-12-22 21:51:03',NULL),(22,'内山命',204,'2015-12-22 21:51:03',NULL),(23,'江籠裕奈',205,'2015-12-22 21:51:03',NULL),(24,'大場美奈',206,'2015-12-22 21:51:03',NULL),(25,'小畑優奈',207,'2015-12-22 21:51:03',NULL),(26,'北野瑠華',208,'2015-12-22 21:51:03',NULL),(27,'白井琴望',209,'2015-12-22 21:51:03',NULL),(28,'惣田紗莉渚',210,'2015-12-22 21:51:03',NULL),(29,'高木由麻奈',211,'2015-12-22 21:51:03',NULL),(30,'髙塚夏生',212,'2015-12-22 21:51:03',NULL),(31,'高柳明音',213,'2015-12-22 21:51:03',NULL),(32,'竹内彩姫',214,'2015-12-22 21:51:03',NULL),(33,'日高優月',215,'2015-12-22 21:51:03',NULL),(34,'古畑奈和',216,'2015-12-22 21:51:03',NULL),(35,'松村香織',217,'2015-12-22 21:51:03',NULL),(36,'山下ゆかり',218,'2015-12-22 21:51:03',NULL),(37,'磯原杏華',301,'2015-12-22 21:51:03',NULL),(38,'井田玲音名',302,'2015-12-22 21:51:03',NULL),(39,'市野成美',303,'2015-12-22 21:51:03',NULL),(40,'梅本まどか',304,'2015-12-22 21:51:03',NULL),(41,'加藤るみ',305,'2015-12-22 21:51:03',NULL),(42,'鎌田菜月',306,'2015-12-22 21:51:03',NULL),(43,'木本花音',307,'2015-12-22 21:51:03',NULL),(44,'熊崎晴香',308,'2015-12-22 21:51:03',NULL),(45,'小石公美子',309,'2015-12-22 21:51:03',NULL),(46,'後藤楽々',310,'2015-12-22 21:51:03',NULL),(47,'斉藤真木子',311,'2015-12-22 21:51:03',NULL),(48,'酒井萌衣',312,'2015-12-22 21:51:03',NULL),(49,'佐藤すみれ',313,'2015-12-22 21:51:03',NULL),(50,'柴田阿弥',314,'2015-12-22 21:51:03',NULL),(51,'菅原茉椰',315,'2015-12-22 21:51:03',NULL),(52,'須田亜香里',316,'2015-12-22 21:51:03',NULL),(53,'髙寺沙菜',317,'2015-12-22 21:51:03',NULL),(54,'谷真理佳',318,'2015-12-22 21:51:03',NULL),(55,'福士奈央',319,'2015-12-22 21:51:03',NULL),(56,'相川暖花',401,'2015-12-22 21:51:03',NULL),(57,'浅井裕華',402,'2015-12-22 21:51:03',NULL),(58,'太田彩夏',403,'2015-12-22 21:51:03',NULL),(59,'片岡成美',404,'2015-12-22 21:51:03',NULL),(60,'川崎成美',405,'2015-12-22 21:51:03',NULL),(61,'末永桜花',406,'2015-12-22 21:51:03',NULL),(62,'髙畑結希',407,'2015-12-22 21:51:03',NULL),(63,'町音葉',408,'2015-12-22 21:51:03',NULL),(64,'村井純奈',409,'2015-12-22 21:51:03',NULL),(65,'和田愛菜',410,'2015-12-22 21:51:03',NULL),(66,'一色嶺奈',411,'2015-12-22 21:51:03',NULL),(67,'上村亜柚香',412,'2015-12-22 21:51:03',NULL),(68,'水野愛理',413,'2015-12-22 21:51:03',NULL);
/*!40000 ALTER TABLE `Member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Program`
--

DROP TABLE IF EXISTS `Program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Program` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(200) NOT NULL,
  `regist_time` datetime NOT NULL,
  `delete_time` datetime DEFAULT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Program`
--

LOCK TABLES `Program` WRITE;
/*!40000 ALTER TABLE `Program` DISABLE KEYS */;
INSERT INTO `Program` (`program_id`, `program_name`, `regist_time`, `delete_time`) VALUES (1,'PARTYが始まるよ','2015-12-22 21:51:02',NULL),(2,'手をつなぎながら','2015-12-22 21:51:02',NULL),(3,'会いたかった','2015-12-22 21:51:02',NULL),(4,'制服の芽','2015-12-22 21:51:02',NULL),(5,'パジャマドライブ','2015-12-22 21:51:02',NULL),(6,'ラムネの飲み方','2015-12-22 21:51:02',NULL),(7,'逆上がり','2015-12-22 21:51:02',NULL),(8,'RESET','2015-12-22 21:51:02',NULL),(9,'シアターの女神','2015-12-22 21:51:02',NULL),(10,'僕の太陽','2015-12-22 21:51:02',NULL);
/*!40000 ALTER TABLE `Program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Team`
--

DROP TABLE IF EXISTS `Team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(200) NOT NULL,
  `regist_time` datetime NOT NULL,
  `delete_time` datetime DEFAULT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Team`
--

LOCK TABLES `Team` WRITE;
/*!40000 ALTER TABLE `Team` DISABLE KEYS */;
INSERT INTO `Team` (`team_id`, `team_name`, `regist_time`, `delete_time`) VALUES (1,'TeamS','2015-12-22 21:51:02',NULL),(2,'TeamKⅡ','2015-12-22 21:51:02',NULL),(3,'TeamE','2015-12-22 21:51:02',NULL),(4,'Team研究生','2015-12-22 21:51:02',NULL);
/*!40000 ALTER TABLE `Team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Event`
--

DROP TABLE IF EXISTS `Event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Event` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `regist_time` datetime NOT NULL,
  `delete_time` datetime DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Event`
--

LOCK TABLES `Event` WRITE;
/*!40000 ALTER TABLE `Event` DISABLE KEYS */;
INSERT INTO `Event` (`event_id`, `event_name`, `regist_time`, `delete_time`) VALUES (1,'生誕祭','2015-12-22 21:51:04',NULL),(2,'劇場最終公演','2015-12-22 21:51:04',NULL);
/*!40000 ALTER TABLE `Event` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-23 21:06:30
