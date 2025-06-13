-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: cakephp_db
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

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
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations` VALUES (7,15,2,'クァwせdrftgyふじk','2025-06-11 04:52:41','2025-06-11 04:52:41'),(8,14,2,'クァwせdrftgyhじゅいこlp','2025-06-11 04:52:55','2025-06-11 04:52:55'),(9,15,2,'あqwせdrftgyふじこlp','2025-06-11 04:53:05','2025-06-11 04:53:05'),(10,16,2,'okinawa','2025-06-11 04:56:56','2025-06-11 04:56:56'),(13,12,2,'砂川昇吾','2025-06-11 05:20:14','2025-06-11 05:20:14'),(37,16,2,'Rising Up','2025-06-12 04:09:40','2025-06-12 04:09:40'),(40,15,2,'砂川昇吾','2025-06-12 08:21:16','2025-06-12 08:21:16'),(42,37,6,'Creating','2025-06-13 02:39:12','2025-06-13 02:39:12');
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,5,1,'test','2025-06-10 09:53:57','2025-06-12 11:28:06'),(2,5,2,'My name is shogo sunagawa.','2025-06-10 09:54:14','2025-06-12 11:28:15'),(3,5,0,'aiueo','2025-06-10 09:54:32','2025-06-10 09:54:32'),(4,5,0,'日本橋','2025-06-10 09:56:14','2025-06-10 09:56:14'),(5,5,0,'ああ','2025-06-10 10:15:58','2025-06-10 10:15:58'),(9,5,0,'あ','2025-06-10 10:16:21','2025-06-10 10:16:21'),(10,5,0,'い','2025-06-10 10:16:25','2025-06-10 10:16:25'),(11,5,0,'う','2025-06-10 10:16:29','2025-06-10 10:16:29'),(12,5,0,'え','2025-06-10 10:16:33','2025-06-10 10:16:33'),(13,5,0,'お','2025-06-10 10:16:37','2025-06-10 10:16:37'),(14,2,0,'aiueo','2025-06-10 10:25:37','2025-06-10 10:25:37'),(15,2,0,'お','2025-06-10 10:29:37','2025-06-10 10:29:37'),(16,2,0,'testing','2025-06-10 11:15:44','2025-06-10 11:15:44'),(23,2,2,'test','2025-06-12 08:23:24','2025-06-12 08:23:24'),(29,6,2,'To: sunagawa\ntest','2025-06-12 10:08:22','2025-06-12 10:08:22'),(30,6,2,'To: sunagawa\ntest','2025-06-12 10:08:29','2025-06-12 10:08:29'),(37,6,5,'To: testing\naaa','2025-06-13 02:38:51','2025-06-13 02:38:51'),(38,6,2,'To: sunagawa\ntest','2025-06-13 03:17:10','2025-06-13 03:17:10'),(40,9,2,'To: sunagawa\ntest','2025-06-13 04:36:01','2025-06-13 04:36:01'),(41,9,5,'To: testing\ntest','2025-06-13 04:36:25','2025-06-13 04:36:25');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_items`
--

DROP TABLE IF EXISTS `test_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_items` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_items`
--

LOCK TABLES `test_items` WRITE;
/*!40000 ALTER TABLE `test_items` DISABLE KEYS */;
INSERT INTO `test_items` VALUES (1,'テストデータ1','2025-06-09 13:33:51','2025-06-09 13:33:51'),(2,'テストデータ2','2025-06-09 13:33:51','2025-06-09 13:33:51');
/*!40000 ALTER TABLE `test_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `hobby` varchar(500) DEFAULT NULL,
  `logindate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'','test@example.com','test','0000-00-00','Male','','2025-06-10 05:40:26'),(2,'uploads/1749706857_1749538699_lauph.jpg','sunagawa','sunagawa@example.com','aaa','1989-08-06','Male','趣味は映画鑑賞、読書、スポーツ（特にキックボクシング）、そして楽器演奏（ギター）です。映画はジャンルを問わず幅広く観ており、特に人間ドラマやサスペンスに惹かれます。読書は主にノンフィクションやビジネス書を好み、知識を深めるのが楽しみです。キックボクシングは健康維持とストレス解消に最適で、週に数回のトレーニングを欠かしません。ギターは独学で、好きな曲を弾き語りする時間が心の癒やしです。これらの趣味を通じて得たインスピレーションを日々の仕事や人間関係にも活かすよう心がけています。今後も新たな趣味や知識に積極的に挑戦し、自分自身の幅を広げていきたいと考えています。','2025-06-12 09:05:41'),(3,NULL,'aaa','aaa@example.com','aaa','0000-00-00','Male','','2025-06-10 06:50:43'),(4,NULL,'bbb','bbb@example.com','bbb','0000-00-00','Male','','2025-06-10 06:54:00'),(5,'uploads/1749538708_lauph.jpeg','testing','testing@test.com','test','2025-06-04','Male','test','2025-06-10 07:52:49'),(6,'uploads/1749705577_lauph.jpg','philip','philip@example.com','aaa','2025-06-22','Male','aiueo','2025-06-13 05:58:25'),(7,NULL,'aaaaa','s.sunagawa1989@gmail.com','test',NULL,'Male',NULL,'2025-06-12 11:35:58'),(9,'uploads/1749780570_lauph.jpg','okinawa','okinawa@example.com','aaa','1989-08-19','Female','test','2025-06-13 04:08:38');
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

-- Dump completed on 2025-06-13 13:49:26
