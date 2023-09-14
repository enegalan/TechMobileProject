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
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  CONSTRAINT `smartphones_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smartphones`
--

LOCK TABLES `smartphones` WRITE;
/*!40000 ALTER TABLE `smartphones` DISABLE KEYS */;
INSERT INTO `smartphones` VALUES (1,'IPHONE 6S','32GB - Gris espacial - Libre','Apple - iPhone 6S 32 GB – Color gris espacial',1,92.99,'El iPhone 6s es un teléfono inteligente de gama alta diseñado por Apple Inc., con procesador de dos núcleos a 1.85 GHz, 2 GB de memoria RAM y pantalla de 4,7 pulgadas. Es parte de la serie iPhone y fue anunciado el 9 de septiembre de 2015.',4.25,13.81,6.7,0.69,129,'Retina HD 750 x 1334','A8 64 bits','12MP 1080p HD 60fps','iOS 9','16,32,64,128','grey,gold,rosegold,silver','iphone6s','6S',5),(2,'IPHONE 11','128GB - Negro - Libre','Apple - iPhone 11 128 GB – Color Negro',1,489.99,'La medida exacta de todo. Un nuevo sistema de cámara dual que abarca un campo de visión más amplio. El chip más rápido que haya tenido un smart­phone. Una batería que dura todo el día, para que hagas más y cargues menos. Y el vídeo de mayor calidad en un smart­phone, que hará que tus recuerdos sean aún más inolvidables. El iPhone 11 llega pisando fuerte.',4.75,15.09,7.57,0.83,194,'Liquid Retina HD 1792 x 828','Chip A13 Bionic 2,66GHz','12MP 4K 60fps','iOS 15','64,128,256','black,green,purple,red,white,yellow','iphone11','11',5);
/*!40000 ALTER TABLE `smartphones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-05  3:57:19
