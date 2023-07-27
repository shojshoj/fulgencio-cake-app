-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fulcake_db
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.38-MariaDB

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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `image_path` varchar(512) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Post 1 Title','Lorem ipsum dolor sit amet. Et modi nihil sit incidunt blanditiis et aperiam culpa et doloribus sapiente est voluptatem voluptas est natus soluta. Sit minus dignissimos in nemo dolorum eos quia expedita est debitis molestiae qui tenetur molestias et fugiat maxime aut aliquid ullam. Non unde ipsum id nemo fuga ex molestias illo. Vel aliquid impedit hic dolorem minima id iste exercitationem qui soluta aliquam.','',0,1,'2023-07-24 00:00:00','2023-07-24 00:00:00'),(2,'Post 2 Title','Lorem ipsum dolor sit amet. Et modi nihil sit incidunt blanditiis et aperiam culpa et doloribus sapiente est voluptatem voluptas est natus soluta. Sit minus dignissimos in nemo dolorum eos quia expedita est debitis molestiae qui tenetur molestias et fugiat maxime aut aliquid ullam. Non unde ipsum id nemo fuga ex molestias illo. Vel aliquid impedit hic dolorem minima id iste exercitationem qui soluta aliquam.','',0,2,'2023-07-24 00:00:00','2023-07-24 00:00:00'),(3,'Post 3 Title','Lorem ipsum dolor sit amet. Et modi nihil sit incidunt blanditiis et aperiam culpa et doloribus sapiente est voluptatem voluptas est natus soluta. Sit minus dignissimos in nemo dolorum eos quia expedita est debitis molestiae qui tenetur molestias et fugiat maxime aut aliquid ullam. Non unde ipsum id nemo fuga ex molestias illo. Vel aliquid impedit hic dolorem minima id iste exercitationem qui soluta aliquam.','',0,3,'2023-07-24 00:00:00','2023-07-24 00:00:00'),(4,'Post 4 Title','Lorem ipsum dolor sit amet. Et modi nihil sit incidunt blanditiis et aperiam culpa et doloribus sapiente est voluptatem voluptas est natus soluta. Sit minus dignissimos in nemo dolorum eos quia expedita est debitis molestiae qui tenetur molestias et fugiat maxime aut aliquid ullam. Non unde ipsum id nemo fuga ex molestias illo. Vel aliquid impedit hic dolorem minima id iste exercitationem qui soluta aliquam.','',0,1,'2023-07-24 00:00:00','2023-07-24 00:00:00');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfos`
--

DROP TABLE IF EXISTS `userinfos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `address_line_1` varchar(64) NOT NULL,
  `address_line_2` varchar(64) NOT NULL,
  `image_path` varchar(512) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfos`
--

LOCK TABLES `userinfos` WRITE;
/*!40000 ALTER TABLE `userinfos` DISABLE KEYS */;
INSERT INTO `userinfos` VALUES (1,'Joshua','Fulgencio','851 Leyte St.','Sampaloc, Manila','',1,'2023-07-24 00:00:00','2023-07-24 00:00:00'),(2,'Jonathan','Joestar','888 Skrt St.','Giga, Manila','',2,'2023-07-24 00:00:00','2023-07-24 00:00:00'),(3,'Joseph','Joestar','999 Brt St.','Giga, Chad','',3,'2023-07-24 00:00:00','2023-07-24 00:00:00');
/*!40000 ALTER TABLE `userinfos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user_josh','b372e00b478d193a3220e917a112dc917846e20b',1,'2023-07-24 00:00:00','2023-07-24 00:00:00'),(2,'user_two','test123',0,'2023-07-24 00:00:00','2023-07-24 00:00:00'),(3,'user_three','test123',0,'2023-07-24 00:00:00','2023-07-24 00:00:00'),(4,'test_user123','73cbc7285c134db3477de2d323b7b30a8363a4f2',0,'2023-07-25 04:38:03','2023-07-25 04:38:03'),(5,'new_user','73cbc7285c134db3477de2d323b7b30a8363a4f2',0,'2023-07-25 06:34:11','2023-07-25 06:34:11'),(6,'user_josh1234','73cbc7285c134db3477de2d323b7b30a8363a4f2',0,'2023-07-27 04:42:41','2023-07-27 04:42:41'),(7,'user_josh12345','388c1c2612dfe7716f07e167002040d80391852f',0,'2023-07-27 04:42:58','2023-07-27 04:42:58'),(8,'user_josh4556','73cbc7285c134db3477de2d323b7b30a8363a4f2',0,'2023-07-27 04:49:00','2023-07-27 04:49:00'),(9,'user_josh9999','05201a2de2bfbaf10a7b0cf37c1688d4cef5044a',0,'2023-07-27 04:59:47','2023-07-27 04:59:47');
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

-- Dump completed on 2023-07-27 15:34:40
