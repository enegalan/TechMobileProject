-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: techmobile
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manufacturers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (1,'apple'),(2,'huawei'),(3,'nokia'),(4,'oppo'),(5,'samsung'),(6,'xiaomi');
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ratings` (
  `smartphone_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`smartphone_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`smartphone_id`) REFERENCES `smartphones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (2,1,4.5),(45,1,4.5);
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smartphones`
--

DROP TABLE IF EXISTS `smartphones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `smartphones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle1` varchar(255) NOT NULL,
  `subtitle2` varchar(255) NOT NULL,
  `manufacturer_id` int NOT NULL,
  `price` float DEFAULT '0',
  `description` varchar(500) DEFAULT NULL,
  `rating` float DEFAULT '0',
  `height` float DEFAULT '0',
  `width` float DEFAULT '0',
  `thick` float DEFAULT '0',
  `weight` float DEFAULT '0',
  `display` varchar(255) NOT NULL,
  `chip` varchar(255) NOT NULL,
  `camera` varchar(255) DEFAULT NULL,
  `os` varchar(255) NOT NULL,
  `storage` varchar(255) NOT NULL,
  `colors` varchar(255) DEFAULT 'black',
  `thumbnail_name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `image_count` int NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  CONSTRAINT `smartphones_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smartphones`
--

LOCK TABLES `smartphones` WRITE;
/*!40000 ALTER TABLE `smartphones` DISABLE KEYS */;
INSERT INTO `smartphones` VALUES (1,'IPHONE 6S','Apple iPhone 6S – Libre','Apple - iPhone 6S – 2015',1,89.99,'El iPhone 6s es un teléfono inteligente de gama alta diseñado por Apple Inc., con procesador de dos núcleos a 1.85 GHz, 2 GB de memoria RAM y pantalla de 4,7 pulgadas. Es parte de la serie iPhone y fue anunciado el 9 de septiembre de 2015.',4.25,13.81,6.7,0.69,129,'Retina HD 750 x 1334','A8 64 bits','12MP 1080p HD 60fps','iOS 9','16,32,64,128','grey,gold,silver,rosegold','iphone6s','6S',5,365),(2,'IPHONE 11','128GB - Negro - Libre','Apple - iPhone 11 128 GB – Color Negro',1,489.99,'La medida exacta de todo. Un nuevo sistema de cámara dual que abarca un campo de visión más amplio. El chip más rápido que haya tenido un smart­phone. Una batería que dura todo el día, para que hagas más y cargues menos. Y el vídeo de mayor calidad en un smart­phone, que hará que tus recuerdos sean aún más inolvidables. El iPhone 11 llega pisando fuerte.',4.5,15.09,7.57,0.83,194,'Liquid Retina HD 1792 x 828','Chip A13 Bionic 2,66GHz','12MP 4K 60fps','iOS 15','64,128,256','black,white,green,purple,red,yellow','iphone11','11',3,6112),(45,'IPHONE 7','Apple iPhone 7 – Libre','Apple - iPhone 7 – 2016',1,199.99,'El iPhone 7 NegroMate es el móvil más elegante quepresenta Apple de cara a mantener su gama de smartphone en la cumbre otro añomás. En su presentación, compartida con el iPhone7 Plus, estos móviles libres vuelven a sorprender a propios y extraños conlas ya típicas pero inesperadas e innovadoras ideas de la compañía de lamanzana mordida, sin duda este nuevo dispositivo sigue siendo la vanguardiadel mundo móvil.',4.5,13,6,0,138,' LCD Retina HD','Chip A10 Fusion','12MP 4K 60fps','iOS 10','32,128,256','black,gold,silver,rosegold,red','iphone 7','7',3,623);
/*!40000 ALTER TABLE `smartphones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(300) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(300) NOT NULL,
  `zip` int NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `default` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
INSERT INTO `user_addresses` VALUES (1,1,'Eneko','Galan Elorza','Avenida de Barcelona 16','3ºB','Donostia','Guipúzcoa',20014,'Spain','699924091',1),(2,1,'Eneko','Galan','Alcibar','Etorbidea','Azkoitia','GIPUZKOA',20720,'España','669924091',0),(3,1,'Eneko','Galan','Alcibar','Etorbidea','Azkoitia','GIPUZKOA',20720,'España','669924091',0),(4,1,'Eneko','Galan','Alcibar','Etorbidea','Azkoitia','GIPUZKOA',20720,'España','669924091',0),(5,1,'Eneko','Galan','Alcibar','Etorbidea','Azkoitia','GIPUZKOA',20720,'España','669924091',0),(6,1,'Eneko','Galan','Avenida Barcelona','16 3ºB','Donostia','Guipúzcoa',20014,'España','669924091',0);
/*!40000 ALTER TABLE `user_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_cards`
--

DROP TABLE IF EXISTS `user_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_cards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('visa','paypal','mastercard') NOT NULL,
  `number` varchar(255) NOT NULL,
  `cvv` int NOT NULL,
  `due_year` year NOT NULL,
  `due_month` enum('01','02','03','04','05','06','07','08','09','10','11','12') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_cards`
--

LOCK TABLES `user_cards` WRITE;
/*!40000 ALTER TABLE `user_cards` DISABLE KEYS */;
INSERT INTO `user_cards` VALUES (2,1,'Card 2','mastercard','1234 5678 1234 2245',222,2028,'09'),(4,1,'Card 2','visa','4562 1235 6431 2331',152,2031,'09');
/*!40000 ALTER TABLE `user_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` enum('M','W') DEFAULT NULL,
  `about` varchar(500) DEFAULT '',
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` varchar(300) DEFAULT NULL,
  `facebook` varchar(300) DEFAULT NULL,
  `twitter` varchar(300) DEFAULT NULL,
  `zip` int DEFAULT NULL,
  `instagram` varchar(300) DEFAULT NULL,
  `github` varchar(300) DEFAULT NULL,
  `address1` varchar(300) DEFAULT NULL,
  `address2` varchar(300) DEFAULT NULL,
  `province` varchar(300) DEFAULT NULL,
  `joining_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint DEFAULT '1',
  `gravatar` varchar(300) NOT NULL DEFAULT './images/users/default.jpg',
  `cart` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'egalan','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec','admin@admin.com','Eneko','Galan','2003-05-13','M','Hello','Spain','Donostia','111111111','techmobile.com','admin','admin',20014,'admin','admin','Avenida Barcelona','16 3B','Guipúzcoa','2023-07-09 13:14:47',1,'./images/users/1.png','{\"1\":[]}'),(2,0,'enegalan','d3047c8db322845de46011d0b63610290772b5ec1303e1520b11a64c698551cfbb220868da75e072a3f6722afa3e1c32acf3c4137a111223aca1fc5ab68396cb','enekogalanelorza@gmail.com','Eneko','Galan','2003-05-13','M','This is a default text.','España','Donostia','669924091','demo.com','egalan','egalan',20014,'egalan','egalan','Avenida Barcelona','16 3ºB','Guipúzcoa','2023-08-17 16:35:25',1,'./images/users/1.png','{\"2\":[{\"product_id\":\"2\",\"name\":\"IPHONE 11\",\"amount\":1,\"price\":489.99,\"image\":\"http://localhost/TechMobileProject/productos/apple/img/producto/11/black/1.png\"}]}');
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

-- Dump completed on 2023-08-22 22:07:02
