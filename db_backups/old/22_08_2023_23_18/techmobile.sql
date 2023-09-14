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
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `faqs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (2,1,'¿Se puede realizar una compra?','En estos momentos, la opción de compra se encuentra no disponible debido a que es una web-proyecto.','2023-08-27 16:26:22'),(3,1,'¿Llegarán más modelos de teléfono a la tienda?','Dependiendo de si nos quedamos sin las existencias actuales se evaluará la opción de añadir nuevos productos a la tienda.','2023-08-27 16:26:44'),(4,1,'¿Los gastos de envío están incluídos?','Sí, tal y como pone explícitamente debajo de los precios de cada producto.','2023-08-27 16:27:16'),(5,1,'¿Cuánto tiempo tardará en llegarme el pedido?','Los envíos oscilan entre 7-15 días, quitando los días no laborales.','2023-08-27 16:27:41'),(6,1,'¿Cómo me aseguro de que mi pedido llegará?','Cuando realizas una compra se te indicará paso por paso cómo hacer un seguimiento a tu pedido para que no lo pierdas de vista en ningún momento.','2023-08-27 16:28:11'),(7,1,'¿Qué es esta web?','Para abreviar, esta web ofrece productos de segunda mano renovados, es decir, sin ningún defecto o daño, y se ofrecen a un precio más asequible y económico.','2023-08-27 16:28:49'),(8,1,'¿Se pueden hacer devoluciones?','Para poder hacer una devolución deberás aportar información que verifique tu compra e indicar el motivo de la devolución.','2023-08-27 16:29:15'),(9,1,'¿En qué condiciones se puede vender un teléfono?','Realmente mientras se pueda encender y operar con él, podemos aceptar tu producto. Aunque siempre hay excepciones y dado el caso informaremos al usuario devolviendole su producto sin coste alguno.','2023-08-27 16:30:59'),(10,1,'¿Cuándo me llegaría el dinero tras enviar mi producto?','En el mismo momento en que el dispositivo haya sido comprobado y aceptado, se te informará de ello y el pago debería llegar entre 5-10 minutos desde el aviso.','2023-08-27 16:31:20'),(11,1,'¿Puedo vender una tablet?','No es posible vender ni comprar ningún dispositivo que no sea un smartphone en esta web.','2023-08-27 16:31:41'),(12,1,'¿Se puede devolver el producto independientemente del motivo?','¡Sí! El motivo siempre lo pedimos porque nos interesa saber tu opinión, pero esto es opcional. En tanto evaluémos el producto devuelto para asegurar que ha tenido un uso adecuado del mismo, te lo haremos saber y se te ingresará la devolución.','2023-08-27 16:32:24'),(13,1,'¿Hacéis pedidos fuera de España?','No, por el momento no disponemos la capacidad de hacer envíos fuera de España.','2023-08-27 16:33:02'),(14,1,'¿Dispondremos de rebajas en eventos señalados del año?','¡Claro! Habrá rebajas tanto en Halloween, Navidades y Black Friday.','2023-08-27 16:33:28');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `opinion_answers`
--

DROP TABLE IF EXISTS `opinion_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `opinion_answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `opinion_id` int NOT NULL,
  `user_id` int NOT NULL,
  `quote` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`opinion_id`,`user_id`),
  KEY `opinion_id` (`opinion_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `opinion_answers_ibfk_1` FOREIGN KEY (`opinion_id`) REFERENCES `opinions` (`id`),
  CONSTRAINT `opinion_answers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinion_answers`
--

LOCK TABLES `opinion_answers` WRITE;
/*!40000 ALTER TABLE `opinion_answers` DISABLE KEYS */;
INSERT INTO `opinion_answers` VALUES (1,1,1,'Muy bien','2023-08-27 20:41:46'),(2,1,1,'Muy bien','2023-08-27 20:41:49');
/*!40000 ALTER TABLE `opinion_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opinions`
--

DROP TABLE IF EXISTS `opinions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `opinions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `smartphone_id` int NOT NULL,
  `rating_id` int NOT NULL,
  `quote` varchar(255) NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `advantages` varchar(255) DEFAULT NULL,
  `disadvantages` varchar(255) DEFAULT NULL,
  `recommended` smallint DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `verified` smallint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `smartphone_id` (`smartphone_id`),
  CONSTRAINT `opinions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `opinions_ibfk_2` FOREIGN KEY (`smartphone_id`) REFERENCES `smartphones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinions`
--

LOCK TABLES `opinions` WRITE;
/*!40000 ALTER TABLE `opinions` DISABLE KEYS */;
INSERT INTO `opinions` VALUES (1,1,1,1,'Esta bien',NULL,NULL,NULL,NULL,'2023-08-27 20:35:58',NULL);
/*!40000 ALTER TABLE `opinions` ENABLE KEYS */;
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
INSERT INTO `smartphones` VALUES (1,'IPHONE 6S','Apple iPhone 6S – Libre','Apple - iPhone 6S – 2015',1,89.99,'El iPhone 6s es un teléfono inteligente de gama alta diseñado por Apple Inc., con procesador de dos núcleos a 1.85 GHz, 2 GB de memoria RAM y pantalla de 4,7 pulgadas. Es parte de la serie iPhone y fue anunciado el 9 de septiembre de 2015.',4.25,13.81,6.7,0.69,129,'Retina HD 750 x 1334','A8 64 bits','12MP 1080p HD 60fps','iOS 9','16,32,64,128','spacegrey,gold,silver,rosegold','iphone6s','6S',3,365),(2,'IPHONE 11','128GB - Negro - Libre','Apple - iPhone 11 128 GB – Color Negro',1,489.99,'La medida exacta de todo. Un nuevo sistema de cámara dual que abarca un campo de visión más amplio. El chip más rápido que haya tenido un smart­phone. Una batería que dura todo el día, para que hagas más y cargues menos. Y el vídeo de mayor calidad en un smart­phone, que hará que tus recuerdos sean aún más inolvidables. El iPhone 11 llega pisando fuerte.',4.5,15.09,7.57,0.83,194,'Liquid Retina HD 1792 x 828','Chip A13 Bionic 2,66GHz','12MP 4K 60fps','iOS 15','64,128,256','black,white,green,purple,red,yellow','iphone11','11',3,6112),(45,'IPHONE 7','Apple iPhone 7 – Libre','Apple - iPhone 7 – 2016',1,199.99,'El iPhone 7 NegroMate es el móvil más elegante quepresenta Apple de cara a mantener su gama de smartphone en la cumbre otro añomás. En su presentación, compartida con el iPhone7 Plus, estos móviles libres vuelven a sorprender a propios y extraños conlas ya típicas pero inesperadas e innovadoras ideas de la compañía de lamanzana mordida, sin duda este nuevo dispositivo sigue siendo la vanguardiadel mundo móvil.',4.5,13,6,0,138,' LCD Retina HD','Chip A10 Fusion','12MP 4K 60fps','iOS 10','32,128,256','black,gold,silver,rosegold,red','iphone 7','7',3,623);
/*!40000 ALTER TABLE `smartphones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useful_opinions`
--

DROP TABLE IF EXISTS `useful_opinions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `useful_opinions` (
  `opinion_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`opinion_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `useful_opinions_ibfk_1` FOREIGN KEY (`opinion_id`) REFERENCES `opinions` (`id`),
  CONSTRAINT `useful_opinions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useful_opinions`
--

LOCK TABLES `useful_opinions` WRITE;
/*!40000 ALTER TABLE `useful_opinions` DISABLE KEYS */;
INSERT INTO `useful_opinions` VALUES (1,1,'2023-08-27 20:37:02'),(1,2,'2023-08-27 20:37:06');
/*!40000 ALTER TABLE `useful_opinions` ENABLE KEYS */;
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
  `active` tinyint DEFAULT '1' COMMENT 'Cuando un usuario no es deseado o por razones similares se podrá desactivar indicando 0 como valor.',
  `gravatar` varchar(300) NOT NULL DEFAULT './images/users/default.jpg' COMMENT 'URL relativa de la imagen.',
  `cart` varchar(500) DEFAULT NULL COMMENT 'Atributo con muchos cambios pues se actualiza por cada producto añadido o removido. Se añade un array en forma de JSON.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'egalan','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec','admin@admin.com','Eneko','Galan','2003-05-13','M','Hello','Spain','Donostia','111111111','techmobile.com','admin','admin',20014,'admin','admin','Avenida Barcelona','16 3B','Guipúzcoa','2023-07-09 13:14:47',1,'./images/users/1.png','{\"1\":[{\"product_id\":\"2\",\"name\":\"IPHONE 11\",\"amount\":5,\"price\":489.99,\"image\":\"http://localhost/TechMobileProject/productos/apple/img/producto/11/black/1.png\"}]}'),(2,0,'enegalan','d3047c8db322845de46011d0b63610290772b5ec1303e1520b11a64c698551cfbb220868da75e072a3f6722afa3e1c32acf3c4137a111223aca1fc5ab68396cb','enekogalanelorza@gmail.com','Eneko','Galan','2003-05-13','M','This is a default text.','España','Donostia','669924091','demo.com','egalan','egalan',20014,'egalan','egalan','Avenida Barcelona','16 3ºB','Guipúzcoa','2023-08-17 16:35:25',1,'./images/users/1.png','{\"2\":[{\"product_id\":\"2\",\"name\":\"IPHONE 11\",\"amount\":1,\"price\":489.99,\"image\":\"http://localhost/TechMobileProject/productos/apple/img/producto/11/black/1.png\"}]}'),(3,0,'pepeadeeley','974f3036f39834082e23f4d70f1feba9d4805b3ee2cedb50b6f1f49f72dd83616c2155f9ff6e08a1cefbf9e6ba2f4aaa45233c8c066a65e002924abfa51590c4','pepe@gmail.com','Pepe','Adeeley','1997-11-12',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-22 23:12:02',1,'./images/users/default.jpg',NULL),(4,0,'pepeadeeley','974f3036f39834082e23f4d70f1feba9d4805b3ee2cedb50b6f1f49f72dd83616c2155f9ff6e08a1cefbf9e6ba2f4aaa45233c8c066a65e002924abfa51590c4','pepe@gmail.com','Pepe','Adeeley','1899-11-11',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 19:57:42',1,'./images/users/default.jpg',NULL),(5,0,'aaa','d6f644b19812e97b5d871658d6d3400ecd4787faeb9b8990c1e7608288664be77257104a58d033bcf1a0e0945ff06468ebe53e2dff36e248424c7273117dac09','aaa@aaa.com','AAA','AAA','1997-04-12',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 20:00:09',1,'./images/users/default.jpg',NULL),(6,0,'bbb','5edc1c6a4390075a3ca27f4d4161c46b374b1c3b2d63f846db6fff0c513203c3ac3b14a24a6f09d8bf21407a4842113b5d9aa359d266299c3d6cf9e92db66dbe','bbb@bbb.com','bbb','bbb','1970-11-11',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 20:01:26',1,'./images/users/default.jpg',NULL),(7,0,'bbb','5edc1c6a4390075a3ca27f4d4161c46b374b1c3b2d63f846db6fff0c513203c3ac3b14a24a6f09d8bf21407a4842113b5d9aa359d266299c3d6cf9e92db66dbe','bbb@bbb.com','bbb','bbb','1970-11-11',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 20:01:27',1,'./images/users/default.jpg',NULL),(8,0,'ccc','2b83283b8caf7e952ad6b0443a87cd9ee263bc32c4d78c5b678ac03556175059679b4b8513b021b16a27f6d2a35484703129129f35b6cdfe418ef6473b1f8f23','ccc@ccc.com','ccc','ccc','2001-02-12',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-23 20:04:11',1,'./images/users/default.jpg',NULL);
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

-- Dump completed on 2023-08-28 23:18:26
