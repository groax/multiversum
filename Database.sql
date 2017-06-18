-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: webshop
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sections_id` int(11) NOT NULL,
  `UUID` varchar(200) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `body` text,
  `footer` varchar(45) DEFAULT NULL,
  `quantum` int(11) DEFAULT '0',
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`sections_id`),
  KEY `fk_table1_sections1_idx` (`sections_id`),
  CONSTRAINT `fk_table1_sections1` FOREIGN KEY (`sections_id`) REFERENCES `sections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,1,'b8ca6b9f-686d-4b6c-9118-5e084637c4ff','erRift','Voor en achterkant bevat sensoren zodat er 360 graden positionele tracking is;\nExterne IR camera tracking sensor (met een bereik van 3,5m bij 1,5m). Dit kan later uitgebreid worden met meerdere sensoren;\nGeintegreerde over je oren audio headset met 3D positionele geluidsweergave;\nGeintegreerde hoge kwaliteit microfoon;\nIPD (afstand tussen je ogen) kan worden geconfigureerd met een schuif en klik mechanisme. Range is 58mm tot 72mm;\nConnecties: HDMI+USB3.0 (lengte +/- 4 meter), USB 3.0 (Sensor), USB 2.0 (XBOX Wireless receiver).',NULL,10,599.95,'https://tweakers.net/pricewatch/480327/oculus-rift.html','https://ic.tweakimg.net/ext/i/2000898912.png',1,'2017-06-18 20:33:50'),(2,1,'d0dfc4fa-c4d1-4460-b845-2ec71d580678','Oculus Rift','Geschikt voor PC',NULL,10,600.00,'https://tweakers.net/pricewatch/480327/oculus-rift.html','https://ic.tweakimg.net/ext/i/2000898912.png',1,'2017-05-23 18:59:06'),(3,1,'4d35100c-b615-406d-a754-d5017db70c6e','Oculus Rift','Geschikt voor PC',NULL,10,600.00,'https://tweakers.net/pricewatch/480327/oculus-rift.html','https://ic.tweakimg.net/ext/i/2000898912.png',1,'2017-05-23 18:59:06'),(4,1,'9858e2de-cc70-4b8c-a313-86dfd90d6b3d','Oculus Rift','Geschikt voor PC',NULL,10,600.00,'https://tweakers.net/pricewatch/480327/oculus-rift.html','https://ic.tweakimg.net/ext/i/2000898912.png',1,'2017-05-23 18:59:06'),(5,1,'d4bf0135-eb01-4945-9abc-d4af4f185cc7','Oculus Rift','Geschikt voor PC',NULL,10,600.00,'https://tweakers.net/pricewatch/480327/oculus-rift.html','https://ic.tweakimg.net/ext/i/2000898912.png',1,'2017-05-23 18:59:06'),(6,1,'8705e2e3-bfea-408e-9396-6bc32ae94e16','Oculus Rift','Geschikt voor PC',NULL,10,600.00,'https://tweakers.net/pricewatch/480327/oculus-rift.html','https://ic.tweakimg.net/ext/i/2000898912.png',1,'2017-05-23 18:59:06');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles_has_img`
--

DROP TABLE IF EXISTS `articles_has_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles_has_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articles_id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`articles_id`,`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_has_img`
--

LOCK TABLES `articles_has_img` WRITE;
/*!40000 ALTER TABLE `articles_has_img` DISABLE KEYS */;
INSERT INTO `articles_has_img` VALUES (1,1,1),(2,1,2),(3,1,3);
/*!40000 ALTER TABLE `articles_has_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articlesdetails`
--

DROP TABLE IF EXISTS `articlesdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articlesdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articles_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL,
  `resolutie_id` int(11) NOT NULL,
  `display` int(11) DEFAULT '0',
  `hertz` int(3) DEFAULT NULL,
  `functions` varchar(255) DEFAULT NULL,
  `connections` varchar(255) DEFAULT NULL,
  `purview` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`,`articles_id`,`platform_id`,`resolutie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articlesdetails`
--

LOCK TABLES `articlesdetails` WRITE;
/*!40000 ALTER TABLE `articlesdetails` DISABLE KEYS */;
INSERT INTO `articlesdetails` VALUES (1,1,1,1,1,90,'Accelerometer, Gyroscoop, Koptelefoon, Magnetometer','HDMI, USB 2.0, 3x USB 3.0',110);
/*!40000 ALTER TABLE `articlesdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pages_id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `body` text,
  `footer` varchar(45) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT '6',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`pages_id`),
  KEY `fk_content_pages_idx` (`pages_id`),
  CONSTRAINT `fk_content_pages` FOREIGN KEY (`pages_id`) REFERENCES `pages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,1,'Lorem','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','test',NULL,12,'2017-05-29 11:25:28');
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `img`
--

DROP TABLE IF EXISTS `img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `img`
--

LOCK TABLES `img` WRITE;
/*!40000 ALTER TABLE `img` DISABLE KEYS */;
INSERT INTO `img` VALUES (1,'https://ic.tweakimg.net/ext/i/imagenormal/2000898911.jpeg','2017-06-17 12:47:36'),(2,'https://ic.tweakimg.net/ext/i/imagenormal/2000898911.jpeg','2017-06-16 14:41:24'),(3,'https://ic.tweakimg.net/ext/i/2001020793.png','2017-06-16 14:41:24');
/*!40000 ALTER TABLE `img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail`
--

DROP TABLE IF EXISTS `mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(355) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `onderwerp` varchar(255) DEFAULT NULL,
  `bericht` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail`
--

LOCK TABLES `mail` WRITE;
/*!40000 ALTER TABLE `mail` DISABLE KEYS */;
INSERT INTO `mail` VALUES (1,'Rick Holtman','mail@mail.com','test','lorem','2017-06-18 10:14:42');
/*!40000 ALTER TABLE `mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(45) NOT NULL,
  `pagetag` varchar(45) NOT NULL,
  `pageshow` int(11) NOT NULL DEFAULT '1',
  `controller` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'home','home',0,'HomeController','2017-06-16 12:13:07'),(2,'order','order',1,'HomeController','2017-06-16 12:13:07'),(3,'add product','add',1,'HomeController','2017-06-16 12:13:07'),(4,'details','details',0,'DetailsController','2017-06-16 12:13:31');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages_has_sections`
--

DROP TABLE IF EXISTS `pages_has_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages_has_sections` (
  `pages_id` int(11) NOT NULL,
  `sections_id` int(11) NOT NULL,
  PRIMARY KEY (`pages_id`,`sections_id`),
  KEY `fk_pages_has_sections_sections1_idx` (`sections_id`),
  KEY `fk_pages_has_sections_pages1_idx` (`pages_id`),
  CONSTRAINT `fk_pages_has_sections_pages1` FOREIGN KEY (`pages_id`) REFERENCES `pages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pages_has_sections_sections1` FOREIGN KEY (`sections_id`) REFERENCES `sections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages_has_sections`
--

LOCK TABLES `pages_has_sections` WRITE;
/*!40000 ALTER TABLE `pages_has_sections` DISABLE KEYS */;
INSERT INTO `pages_has_sections` VALUES (1,1);
/*!40000 ALTER TABLE `pages_has_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platform`
--

DROP TABLE IF EXISTS `platform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `platform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `platform` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `platform_UNIQUE` (`platform`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platform`
--

LOCK TABLES `platform` WRITE;
/*!40000 ALTER TABLE `platform` DISABLE KEYS */;
INSERT INTO `platform` VALUES (1,'pc');
/*!40000 ALTER TABLE `platform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,NULL,'mince'),(2,NULL,'rumb steak'),(3,NULL,'t-bone steak'),(4,NULL,'whole chickens'),(5,NULL,'bacon'),(6,NULL,'chicken thigh'),(7,NULL,'chicken breast'),(18,NULL,'lamb shoulder'),(19,NULL,'fish'),(20,NULL,'prawns (big)'),(21,NULL,'prawns (small)'),(22,NULL,'mussells'),(23,NULL,'salmon'),(24,NULL,'pulled pork'),(25,NULL,'orange'),(26,NULL,'strawberry'),(27,NULL,'raspberry'),(28,NULL,'blueberry'),(29,NULL,'blackberry'),(30,NULL,'peaches'),(31,NULL,'parsley'),(32,NULL,'avocado'),(33,NULL,'mushrooms'),(34,NULL,'chilli'),(35,NULL,'red cabbage'),(36,NULL,'green cabbage'),(37,NULL,'spring onion'),(38,NULL,'red onion'),(39,NULL,'brown onion'),(40,NULL,'cucumber'),(41,NULL,'cherry tomatoes'),(42,NULL,'tomatoes'),(43,NULL,'mung beans'),(44,NULL,'paprika'),(45,NULL,'green apple'),(46,NULL,'red apple'),(47,NULL,'lettuce'),(48,NULL,'sweet potatoes'),(49,NULL,'pumpkin'),(50,NULL,'carrots (small)'),(51,NULL,'carrots (big)'),(52,NULL,'potatoes (big)'),(53,NULL,'potatoes (small)'),(54,NULL,'asparagus (small)'),(55,NULL,'asparagus (big)'),(56,NULL,'white asparagus'),(57,NULL,'green asparagus'),(58,NULL,'beetroot'),(59,NULL,'mint'),(60,NULL,'coriander'),(61,NULL,'watercress'),(62,NULL,'thyme'),(63,NULL,'rosemary'),(64,NULL,'courgette'),(65,NULL,'lemon'),(66,NULL,'lime');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resolutie`
--

DROP TABLE IF EXISTS `resolutie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resolutie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resolutie` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resolutie_UNIQUE` (`resolutie`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resolutie`
--

LOCK TABLES `resolutie` WRITE;
/*!40000 ALTER TABLE `resolutie` DISABLE KEYS */;
INSERT INTO `resolutie` VALUES (1,'2160x1200');
/*!40000 ALTER TABLE `resolutie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `body` text,
  `footer` varchar(45) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'VR-brillen','1','1',NULL,NULL,1,'2017-05-15 11:16:32');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping`
--

DROP TABLE IF EXISTS `shopping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articles_id` int(11) NOT NULL,
  `quantum` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`articles_id`),
  KEY `fk_shopping_articles1_idx` (`articles_id`),
  CONSTRAINT `fk_shopping_articles1` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping`
--

LOCK TABLES `shopping` WRITE;
/*!40000 ALTER TABLE `shopping` DISABLE KEYS */;
/*!40000 ALTER TABLE `shopping` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-19  1:14:02
