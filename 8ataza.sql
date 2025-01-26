-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: froga
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `gidariak`
--

DROP TABLE IF EXISTS `gidariak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gidariak` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Postua` int DEFAULT NULL,
  `Dortsala` int NOT NULL,
  `Izena` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gidariak`
--

LOCK TABLES `gidariak` WRITE;
/*!40000 ALTER TABLE `gidariak` DISABLE KEYS */;
INSERT INTO `gidariak` VALUES (1,1,12,'Viñales'),(2,2,20,'Quartararo'),(3,3,26,'Pedrosa'),(4,4,30,'Lekuona'),(5,5,41,'A. Espargaró'),(6,6,73,'A. Marquez'),(7,8,93,'M. Marquez'),(8,7,46,'Rossi'),(9,9,27,'Stoner'),(10,10,99,'Lorenzo');
/*!40000 ALTER TABLE `gidariak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `herriak`
--

DROP TABLE IF EXISTS `herriak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `herriak` (
  `idHerriak` int NOT NULL AUTO_INCREMENT,
  `izena` varchar(45) DEFAULT NULL,
  `herrialdeKodea` int DEFAULT NULL,
  PRIMARY KEY (`idHerriak`),
  KEY `kodeaHerrialdea_idx` (`herrialdeKodea`),
  CONSTRAINT `kodeaHerrialdea` FOREIGN KEY (`herrialdeKodea`) REFERENCES `herrialdeak` (`idHerrialdeak`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `herriak`
--

LOCK TABLES `herriak` WRITE;
/*!40000 ALTER TABLE `herriak` DISABLE KEYS */;
INSERT INTO `herriak` VALUES (1,'San Sebastián',1),(2,'Astigarraga',1),(3,'Lasarte-Oria',1),(4,'Pasaia',1),(5,'Hernani',1),(6,'Eibar',2),(7,'Elgoibar',2),(8,'Soraluze',2),(9,'Mendaro',2),(10,'Deba',2),(11,'Zarautz',3),(12,'Getaria',3),(13,'Zumaia',3),(14,'Orio',3),(15,'Aia',3),(16,'Tolosa',4),(17,'Villabona',4),(18,'Ormaiztegi',4),(19,'Asteasu',4),(20,'Legazpi',4),(21,'Deba',5),(22,'Mutriku',5),(23,'Mendexa',5),(24,'Zaldibia',5),(25,'Ondarroa',5),(26,'Beasain',6),(27,'Ordizia',6),(28,'Segura',6),(29,'Lazkao',6),(30,'Amezketa',6),(31,'Andoain',7),(32,'Urnieta',7),(33,'Lasarte-Oria',7),(34,'Pasaia',7),(35,'Lezo',7),(36,'Hendaia',8),(37,'Biriatou',8),(38,'Ciboure',8),(39,'Saint-Jean-de-Luz',8),(40,'Socoa',8);
/*!40000 ALTER TABLE `herriak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `herrialdeak`
--

DROP TABLE IF EXISTS `herrialdeak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `herrialdeak` (
  `idHerrialdeak` int NOT NULL AUTO_INCREMENT,
  `izena` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idHerrialdeak`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `herrialdeak`
--

LOCK TABLES `herrialdeak` WRITE;
/*!40000 ALTER TABLE `herrialdeak` DISABLE KEYS */;
INSERT INTO `herrialdeak` VALUES (1,'Donostialdea'),(2,'Debabarrena'),(3,'Urola Costa'),(4,'Tolosaldea'),(5,'Bajo Deba'),(6,'Goierri'),(7,'Ribera Alta'),(8,'Baixa Navarra');
/*!40000 ALTER TABLE `herrialdeak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-26 14:05:00
