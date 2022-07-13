-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: velo-moto
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `idbrands` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idbrands`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Shimano'),(2,'Sunrace'),(3,'ATOM'),(4,'Cube Aim'),(5,'Haro Beasley'),(6,'Merida Big'),(7,'Irbis'),(8,'Minsk'),(9,'Racer'),(10,'Bajaj');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `idclients` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `fam` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idclients`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motoes`
--

DROP TABLE IF EXISTS `motoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `motoes` (
  `id` int NOT NULL,
  `id_motobrand` varchar(45) DEFAULT NULL,
  `motoname` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `motoimg` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motoes`
--

LOCK TABLES `motoes` WRITE;
/*!40000 ALTER TABLE `motoes` DISABLE KEYS */;
INSERT INTO `motoes` VALUES (451654,'9','Panther RC300-GY8X','148700','img/m-3.png'),(452315,'8','X250','129900','img/m-1.png'),(532165,'7','TTR 250 R','124900','img/m-2.png'),(648947,'9','SKYWAY 300','155950','img/m-6.png'),(689419,'8','SCR 250','210000','img/m-7.png'),(874546,'10','Pulsar 180','205000','img/m-4.png'),(884623,'9','RC50 ALPHA','743500','img/m-5.png');
/*!40000 ALTER TABLE `motoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veloes`
--

DROP TABLE IF EXISTS `veloes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veloes` (
  `id` int NOT NULL,
  `id_velobrand` int DEFAULT NULL,
  `veloname` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `razmer` varchar(45) DEFAULT NULL,
  `veloimg` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `velobrand_idx` (`id_velobrand`),
  CONSTRAINT `velobrands` FOREIGN KEY (`id_velobrand`) REFERENCES `brands` (`idbrands`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veloes`
--

LOCK TABLES `veloes` WRITE;
/*!40000 ALTER TABLE `veloes` DISABLE KEYS */;
INSERT INTO `veloes` VALUES (123516,1,'Stels Navigator','21500','26','img/v-1.png'),(565165,3,'Focus MD','32600','32','img/v-7.png'),(565196,6,'Seven 15','23499','27','img/v-6.png'),(652651,4,'Race 29','19700','24','img/v-3.png'),(653651,5,'Jak-7','16999','26','img/v-4.png'),(654965,6,'Seven 13','22750','27','img/v-2.png'),(949646,1,'Luna 2','29999','24','img/v-8.png'),(964522,2,'Nine 200','25699','26','img/v-5.png');
/*!40000 ALTER TABLE `veloes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'velo-moto'
--

--
-- Dumping routines for database 'velo-moto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-21 16:51:03
