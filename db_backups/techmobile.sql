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
