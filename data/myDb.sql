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
  `session_id` varchar(30) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `Products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` VALUES (76,'3',1,8),(115,'rh2r47op2gqo1hkci16jkdqlcv',4,1),(122,'rh2r47op2gqo1hkci16jkdqlcv',2,4),(123,'rh2r47op2gqo1hkci16jkdqlcv',5,2);

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
  `username` varchar(64) DEFAULT NULL,
  `pass` varchar(60) DEFAULT NULL,
  `info` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES (1,'Vanya','Pupkin',NULL),(2,'Petya','Vasin',NULL),(3,'1','1',NULL),(4,'test','$2y$10$8VFEg/NwRL18pfhljcQLYuJDZISnxog9siSw6Y2AFxk142XF.yxXm',NULL);
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-19 11:09:32
