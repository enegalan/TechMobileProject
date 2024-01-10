-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: techmobile
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.04.1

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
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `faqs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Dumping data for table `faqs`

/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (2,9,'¿Se puede realizar una compra?','En estos momentos, la opción de compra se encuentra no disponible debido a que es una web-proyecto.','2023-08-27 16:26:22');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;


--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--


/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (1,'apple'),(2,'huawei'),(3,'nokia'),(4,'oppo'),(5,'samsung'),(6,'xiaomi');
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;


--
-- Table structure for table `opinion_answers`
--

DROP TABLE IF EXISTS `opinion_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `opinion_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opinion_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quote` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `opinion_id` (`opinion_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `opinion_answers_ibfk_1` FOREIGN KEY (`opinion_id`) REFERENCES `opinions` (`id`),
  CONSTRAINT `opinion_answers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinion_answers`
--


/*!40000 ALTER TABLE `opinion_answers` DISABLE KEYS */;
INSERT INTO `opinion_answers` VALUES (1,1,1,'Muy bien','2023-08-27 20:41:46'),(2,1,1,'Muy bien','2023-08-27 20:41:49'),(3,1,3,'Hola muy buenas que placa base recomiendas para este procesador lo necestio para producción musical gracias un saludo','2023-09-10 21:40:57'),(5,31,9,'@egalan gracias por tu aportación','2024-01-03 14:17:16'),(6,31,9,'@egalan  hehhehehehehe','2024-01-03 23:46:48'),(7,31,9,'@egalan muy wena','2024-01-03 23:47:04'),(8,31,9,'@egalan msmsmsmsm','2024-01-04 00:07:38'),(9,31,9,'@egalan tetstest','2024-01-04 00:59:15'),(10,31,9,'@egalan zzzzzzzzz','2024-01-04 00:59:34');/*!40000 ALTER TABLE `opinion_answers` ENABLE KEYS */;


--
-- Table structure for table `opinion_media`
--

DROP TABLE IF EXISTS `opinion_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `opinion_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opinion_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `opinion_id` (`opinion_id`),
  CONSTRAINT `opinion_media_ibfk_1` FOREIGN KEY (`opinion_id`) REFERENCES `opinions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinion_media`
--


INSERT INTO `opinion_media` VALUES (86,31,'images/opinions/31/dd5ed8253d2d2b02da4904a8075e33aed9dc23e7.png','2024-01-02 23:00:00','0000-00-00 00:00:00'),(87,31,'images/opinions/31/a6643c5409eb94150f617e70ecf557ed1f46974f.png','2024-01-02 23:00:00','0000-00-00 00:00:00');

--
-- Table structure for table `opinions`
--

DROP TABLE IF EXISTS `opinions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opinions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `smartphone_id` int(11) NOT NULL,
  `quote` varchar(500) DEFAULT NULL,
  `media` varchar(255) DEFAULT NULL,
  `advantages` varchar(255) DEFAULT NULL,
  `disadvantages` varchar(255) DEFAULT NULL,
  `recommended` smallint(6) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `verified` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `smartphone_id` (`smartphone_id`),
  CONSTRAINT `opinions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `opinions_ibfk_2` FOREIGN KEY (`smartphone_id`) REFERENCES `smartphones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinions`
--

/*!40000 ALTER TABLE `opinions` DISABLE KEYS */;
INSERT INTO `opinions` VALUES (31,9,1,'ZZZZZZZZZZZZZ','4','','',1,'2024-01-03 01:20:55',NULL);
/*!40000 ALTER TABLE `opinions` ENABLE KEYS */;

--
-- Table structure for table `smartphones`
--

DROP TABLE IF EXISTS `smartphones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smartphones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle1` varchar(255) NOT NULL,
  `subtitle2` varchar(255) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `price` float DEFAULT 0,
  `description` varchar(500) DEFAULT NULL,
  `height` float DEFAULT 0,
  `width` float DEFAULT 0,
  `thick` float DEFAULT 0,
  `weight` float DEFAULT 0,
  `display` varchar(255) NOT NULL,
  `chip` varchar(255) NOT NULL,
  `camera` varchar(255) DEFAULT NULL,
  `os` varchar(255) NOT NULL,
  `storage` varchar(255) NOT NULL,
  `colors` varchar(255) DEFAULT 'black',
  `thumbnail_name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `image_count` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `rating` double DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  CONSTRAINT `smartphones_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smartphones`
--

/*!40000 ALTER TABLE `smartphones` DISABLE KEYS */;
INSERT INTO `smartphones` VALUES (1,'IPHONE 6S','Apple iPhone 6S – Libre','Apple - iPhone 6S – 2015',1,89.99,'El iPhone 6s es un teléfono inteligente de gama alta diseñado por Apple Inc., con procesador de dos núcleos a 1.85 GHz, 2 GB de memoria RAM y pantalla de 4,7 pulgadas. Es parte de la serie iPhone y fue anunciado el 9 de septiembre de 2015.',13.81,6.7,0.69,129,'Retina HD 750 x 1334','A8 64 bits','12MP 1080p HD 60fps','iOS 9','16,32,64,128','spacegrey,gold,silver,rosegold','iphone6s','6S',3,365,3.5),(2,'IPHONE 11','128GB - Negro - Libre','Apple - iPhone 11 128 GB – Color Negro',1,489.99,'La medida exacta de todo. Un nuevo sistema de cámara dual que abarca un campo de visión más amplio. El chip más rápido que haya tenido un smart­phone. Una batería que dura todo el día, para que hagas más y cargues menos. Y el vídeo de mayor calidad en un smart­phone, que hará que tus recuerdos sean aún más inolvidables. El iPhone 11 llega pisando fuerte.',15.09,7.57,0.83,194,'Liquid Retina HD 1792 x 828','Chip A13 Bionic 2,66GHz','12MP 4K 60fps','iOS 15','64,128,256','black,white,green,purple,red,yellow','iphone11','11',3,6112,0),(3,'IPHONE 7','Apple iPhone 7 – Libre','Apple - iPhone 7 – 2016',1,199.99,'El iPhone 7 NegroMate es el móvil más elegante quepresenta Apple de cara a mantener su gama de smartphone en la cumbre otro añomás. En su presentación, compartida con el iPhone7 Plus, estos móviles libres vuelven a sorprender a propios y extraños conlas ya típicas pero inesperadas e innovadoras ideas de la compañía de lamanzana mordida, sin duda este nuevo dispositivo sigue siendo la vanguardiadel mundo móvil.',13,6,0,138,' LCD Retina HD','Chip A10 Fusion','12MP 4K 60fps','iOS 10','32,128,256','black,gold,silver,rosegold,red','iphone 7','7',3,623,0),(50,'iPhone 12','Apple iPhone 12 – Libre','Apple - iPhone 12 – 2020',1,399.99,'Más allá de la velocidad. Tecnología 5G. Chip A14 Bionic, el más veloz en un smartphone. Pantalla OLED de borde a borde. Ceramic Shield, cuatro veces más resistente a las caídas. Modo Noche en cada una de las cámaras. Y dos tamaños: ideal y perfecto. Sí, el iPhone 12 lo tiene todo.',14.67,7.15,0.74,164,'Super Retina XDR 6,1\" OLED','A14 Bionic','12MP 4K 60fps','iOS 14','64,128,256','black,white,green,purple,red,blue','iphone 12','12',4,12300,0);
/*!40000 ALTER TABLE `smartphones` ENABLE KEYS */;


--
-- Table structure for table `useful_opinions`
--

DROP TABLE IF EXISTS `useful_opinions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useful_opinions` (
  `opinion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`opinion_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `useful_opinions_ibfk_1` FOREIGN KEY (`opinion_id`) REFERENCES `opinions` (`id`),
  CONSTRAINT `useful_opinions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useful_opinions`
--

/*!40000 ALTER TABLE `useful_opinions` DISABLE KEYS */;
INSERT INTO `useful_opinions` VALUES (1,1,'2023-08-27 20:37:02'),(1,2,'2023-08-27 20:37:06'),(1,3,'2023-09-10 21:38:48'),(31,9,'2024-01-04 00:59:08');
/*!40000 ALTER TABLE `useful_opinions` ENABLE KEYS */;

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(300) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(300) NOT NULL,
  `zip` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `default` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` VALUES (1,1,'Eneko','Galan Elorza','Avenida de Barcelona 16','3ºB','Donostia','Guipúzcoa',20014,'Spain','699924091',1),(2,1,'Eneko','Galan','Alcibar','Etorbidea','Azkoitia','GIPUZKOA',20720,'España','669924091',0),(3,1,'Eneko','Galan','Alcibar','Etorbidea','Azkoitia','GIPUZKOA',20720,'España','669924091',0),(4,1,'Eneko','Galan','Alcibar','Etorbidea','Azkoitia','GIPUZKOA',20720,'España','669924091',0),(5,1,'Eneko','Galan','Alcibar','Etorbidea','Azkoitia','GIPUZKOA',20720,'España','669924091',0),(6,1,'Eneko','Galan','Avenida Barcelona','16 3ºB','Donostia','Guipúzcoa',20014,'España','669924091',0),(8,9,'Eneko','Galan','Avenida Barcelona 16 ','3ºB','Donostia','Guipúzcoa',20014,'España','669924091',1),(9,9,'Eneko','Galan','Avenida Barcelona 16 ','3ºB','Donostia','Guipúzcoa',20014,'España','669924091',0),(11,9,'Eneko','Galan','Avenida Barcelona 16 ','3ºB','Donostia','Guipúzcoa',20014,'España','669924091',0),(12,9,'Eneko','Galan','Avenida Barcelona 16 ','3ºB','Donostia','Guipúzcoa',20014,'España','669924091',0),(13,9,'Eneko','Galan','Avenida Barcelona 16 ','3ºB','Donostia','Guipúzcoa',20014,'España','669924091',0);


--
-- Table structure for table `user_cards`
--

DROP TABLE IF EXISTS `user_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('visa','paypal','mastercard') NOT NULL,
  `number` varchar(255) NOT NULL,
  `cvv` int(11) NOT NULL,
  `due_year` year(4) NOT NULL,
  `due_month` enum('01','02','03','04','05','06','07','08','09','10','11','12') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_cards`
--

/*!40000 ALTER TABLE `user_cards` DISABLE KEYS */;
INSERT INTO `user_cards` VALUES (2,1,'Card 2','mastercard','1234 5678 1234 2245',222,2028,'09'),(4,1,'Card 2','visa','4562 1235 6431 2331',152,2031,'09'),(5,9,'','paypal','9002 3521 3',123,2038,'08');
/*!40000 ALTER TABLE `user_cards` ENABLE KEYS */;

--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
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
  `zip` int(11) DEFAULT NULL,
  `instagram` varchar(300) DEFAULT NULL,
  `github` varchar(300) DEFAULT NULL,
  `address1` varchar(300) DEFAULT NULL,
  `address2` varchar(300) DEFAULT NULL,
  `province` varchar(300) DEFAULT NULL,
  `joining_date` timestamp NULL DEFAULT current_timestamp(),
  `active` tinyint(4) DEFAULT 1 COMMENT 'Cuando un usuario no es deseado o por razones similares se podrá desactivar indicando 0 como valor.',
  `gravatar` varchar(300) NOT NULL DEFAULT './images/users/default.jpg' COMMENT 'URL relativa de la imagen.',
  `cart` varchar(500) DEFAULT NULL COMMENT 'Atributo con muchos cambios pues se actualiza por cada producto añadido o removido. Se añade un array en forma de JSON.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'egalan','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec','admin@admin.com','Eneko','Galan','2003-05-13','M','Hello','Spain','Donostia','111111111','techmobile.com','admin','admin',20014,'admin','admin','Avenida Barcelona','16 3B','Guipúzcoa','2023-07-09 13:14:47',0,'./images/users/1.png','{\"1\":[{\"product_id\":\"2\",\"name\":\"IPHONE 11\",\"amount\":5,\"price\":489.99,\"image\":\"http://localhost/TechMobileProject/productos/apple/img/producto/11/black/1.png\"}]}'),(2,0,'enegalan','d3047c8db322845de46011d0b63610290772b5ec1303e1520b11a64c698551cfbb220868da75e072a3f6722afa3e1c32acf3c4137a111223aca1fc5ab68396cb','enekogalanelorza@gmail.com','Eneko','Galan','2003-05-13','M','This is a default text.','España','Donostia','669924091','demo.com','egalan','egalan',20014,'egalan','egalan','Avenida Barcelona','16 3ºB','Guipúzcoa','2023-08-17 16:35:25',1,'./images/users/1.png','{\"2\":[{\"product_id\":\"2\",\"name\":\"IPHONE 11\",\"amount\":1,\"price\":489.99,\"image\":\"http://localhost/TechMobileProject/productos/apple/img/producto/11/black/1.png\"}]}'),(3,0,'pepeadeeley','974f3036f39834082e23f4d70f1feba9d4805b3ee2cedb50b6f1f49f72dd83616c2155f9ff6e08a1cefbf9e6ba2f4aaa45233c8c066a65e002924abfa51590c4','pepe@gmail.com','Pepe','Adeeley','1997-11-12',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-22 23:12:02',1,'./images/users/default.jpg',NULL),(4,0,'pepeadeeley','974f3036f39834082e23f4d70f1feba9d4805b3ee2cedb50b6f1f49f72dd83616c2155f9ff6e08a1cefbf9e6ba2f4aaa45233c8c066a65e002924abfa51590c4','pepe@gmail.com','Pepe','Adeeley','1899-11-11',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 19:57:42',1,'./images/users/default.jpg',NULL),(5,0,'aaa','d6f644b19812e97b5d871658d6d3400ecd4787faeb9b8990c1e7608288664be77257104a58d033bcf1a0e0945ff06468ebe53e2dff36e248424c7273117dac09','aaa@aaa.com','AAA','AAA','1997-04-12',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 20:00:09',1,'./images/users/default.jpg',NULL),(6,0,'bbb','5edc1c6a4390075a3ca27f4d4161c46b374b1c3b2d63f846db6fff0c513203c3ac3b14a24a6f09d8bf21407a4842113b5d9aa359d266299c3d6cf9e92db66dbe','bbb@bbb.com','bbb','bbb','1970-11-11',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 20:01:26',1,'./images/users/default.jpg',NULL),(7,0,'bbb','5edc1c6a4390075a3ca27f4d4161c46b374b1c3b2d63f846db6fff0c513203c3ac3b14a24a6f09d8bf21407a4842113b5d9aa359d266299c3d6cf9e92db66dbe','bbb@bbb.com','bbb','bbb','1970-11-11',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 20:01:27',1,'./images/users/default.jpg',NULL),(8,0,'ccc','2b83283b8caf7e952ad6b0443a87cd9ee263bc32c4d78c5b678ac03556175059679b4b8513b021b16a27f6d2a35484703129129f35b6cdfe418ef6473b1f8f23','ccc@ccc.com','ccc','ccc','2001-02-12',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 20:04:11',1,'./images/users/default.jpg',NULL),(9,1,'egalan','e75e23b2acbd43baedee7ab5a3a37784131f507d738525d1bf48f3bfcf6388ceee1b35db03b0944ff4f8c9ca244a5afbfeb11c356cd01e620b40c7fc4ecac4d3','enekogalanelorza@gmail.com','Eneko','Galan','2003-05-13',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-30 02:13:28',1,'./images/users/default.jpg','{\"9\":[{\"product_id\":\"50\",\"name\":\"iPhone 12\",\"amount\":1,\"price\":399.99,\"image\":\"http://localhost/TechMobileProject/productos/apple/img/producto/12/blue/1.png\"}]}');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-10 19:04:01