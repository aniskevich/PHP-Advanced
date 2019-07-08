-- MySQL dump 10.13  Distrib 5.7.23, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: PHP
-- ------------------------------------------------------
-- Server version	5.7.23

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
-- Table structure for table `Products`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `category` varchar(64) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `color` varchar(64) DEFAULT NULL,
  `size` varchar(64) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `link` varchar(32) DEFAULT NULL,
  `about` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` VALUES (1,'T-shirt','men','T-Shirts','red','XS',100,'Product4.jpg','T-shirt description                '),(2,'Coat','men','Coats','black','L',150,'Product3.jpg','Coat description                '),(3,'Jacket','men','Jackets','white','XL',200,'Product2.jpg','Jacket description                '),(4,'Coat','men','Coats','black','M',150,'product1.jpg','Coat desc                '),(5,'Jeans','Men','Jeans','Blue','XL',250,'img/product5.jpg','Jeans description'),(6,'Jeans','Women','Jeans','Red','M',250,'product6.jpg','Jeans description'),(7,'Jeans','Women','Jeans','Red','M',250,'product6.jpg','Jeans description'),(8,'Jeans','Women','Jeans','Red','M',250,'product6.jpg','Jeans description'),(9,'Jeans','Women','Jeans','Red','M',250,'product6.jpg','Jeans description'),(16,'Jeans','MEN','Jeans','Red','M',400,'product6.jpg','Jeans description');

--
-- Table structure for table `cart`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(32) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `Products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` VALUES (275,'56olse26tnnvfqnkr5rfvs6nm2',1,5),(276,'56olse26tnnvfqnkr5rfvs6nm2',2,4),(277,'mo3dcrqdveot9cm9r3vbeumqk2',2,8),(278,'foctm750s7lcgn3dksanpi2bdr',1,3),(279,'foctm750s7lcgn3dksanpi2bdr',5,1),(280,'vte3jjjm2r1t031d0156dhscha',3,4),(281,'vte3jjjm2r1t031d0156dhscha',5,2),(282,'pcj43socvc0r7jqgg33hul20hl',1,5),(283,'pcj43socvc0r7jqgg33hul20hl',2,6),(284,'pcj43socvc0r7jqgg33hul20hl',8,3),(285,'vbup645a59alsf8l5u62sf1497',1,4),(286,'vbup645a59alsf8l5u62sf1497',2,4),(287,'vbup645a59alsf8l5u62sf1497',5,4),(288,'vbup645a59alsf8l5u62sf1497',6,1),(289,'jhk6o9cn9p0nhhm8clg79560h3',1,3),(290,'jhk6o9cn9p0nhhm8clg79560h3',2,4);

--
-- Table structure for table `categories`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` VALUES (1,'men'),(2,'women'),(3,'kids');

--
-- Table structure for table `colors`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` VALUES (1,'red'),(2,'green'),(3,'blue'),(4,'white'),(5,'black');

--
-- Table structure for table `gallery`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(32) NOT NULL,
  `views` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` VALUES (51,'1.jpg',5),(52,'2.jpg',4),(54,'3.jpg',6),(55,'4.jpg',1),(56,'5.jpg',1),(57,'7.jpg',0),(58,'8.jpg',1);

--
-- Table structure for table `orders`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(32) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_mail` varchar(60) NOT NULL,
  `payment` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `date` varchar(60) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` VALUES (12,'56olse26tnnvfqnkr5rfvs6nm2',3,'c1apan@mail.ru','cash','fgdfg','Wed, 03 Jul 19 12:57:51 +0000','canceled'),(13,'mo3dcrqdveot9cm9r3vbeumqk2',3,'c1apan@mail.ru','cash','fgdfg','Thu, 04 Jul 19 03:54:18 +0000','created'),(14,'foctm750s7lcgn3dksanpi2bdr',3,'wewe@md.tu','card','sarfsdgsdgsdg','Sun, 07 Jul 19 06:35:42 +0000','payed'),(15,'vte3jjjm2r1t031d0156dhscha',1,'mail@mail.com','cash','v','Sun, 07 Jul 19 06:39:49 +0000','canceled'),(16,'pcj43socvc0r7jqgg33hul20hl',2,'petya@mail.ru','cash','petya house','Mon, 08 Jul 19 12:49:32 +0000','finished'),(17,'cpivpsq54q391itamp040ddcve',NULL,'wewe@md.tu','cash','fgdfg','Mon, 08 Jul 19 13:06:26 +0000','created'),(18,'vbup645a59alsf8l5u62sf1497',NULL,'guest@mail.com','card','test','Mon, 08 Jul 19 13:16:16 +0000','payed'),(19,'jhk6o9cn9p0nhhm8clg79560h3',1,'vanya@mail.com','cash','vanka','Mon, 08 Jul 19 13:30:01 +0000','created');

--
-- Table structure for table `product_types`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` VALUES (1,'T-Shirts'),(2,'Jackets'),(3,'Coats'),(4,'Jeans');

--
-- Table structure for table `reviews`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `text` varchar(256) NOT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` VALUES (1,1,'2019-05-19','test',NULL,NULL),(2,1,'2019-05-19','another test',NULL,NULL),(3,1,'2019-05-19','test 2',NULL,NULL),(4,1,'2019-05-20','Hello world! How are you?',NULL,NULL),(5,1,'2019-05-20','Another testing message',NULL,NULL),(6,1,'2019-05-20','Another testing message 2',NULL,NULL),(7,1,'2019-05-20','Continue testing',NULL,NULL);

--
-- Table structure for table `size`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `size`
--

INSERT INTO `size` VALUES (1,'XS'),(2,'S'),(3,'M'),(4,'L'),(5,'XL');

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `info_UNIQUE` (`info`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES (1,'Vanya','Pupkin',NULL,'admin'),(2,'Petya','Vasin',NULL,'user'),(3,'1','1',NULL,'user'),(4,'test','$2y$10$8VFEg/NwRL18pfhljcQLYuJDZISnxog9siSw6Y2AFxk142XF.yxXm',NULL,'user');
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-08 23:39:38
