-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: caadi
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `tipo_alumno` char(1) NOT NULL,
  `foto` varchar(36) NOT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `fk_alumno_persona_idx` (`id_persona`),
  CONSTRAINT `fk_alumno_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=206308 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES (1,1,'1',''),(204001,204001,'1',''),(204002,204002,'1',''),(206302,206302,'1',''),(206303,206303,'1',''),(206304,206304,'1',''),(206305,206305,'1',''),(206306,206306,'1',''),(206307,206307,'1','');
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_club`
--

DROP TABLE IF EXISTS `alumno_club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno_club` (
  `id_alumno` int(11) NOT NULL,
  `id_club` int(11) NOT NULL,
  `asistencia` tinyint(4) DEFAULT NULL,
  `calificacion` tinyint(4) DEFAULT NULL,
  `respuesta1` tinyint(4) DEFAULT NULL,
  `respuesta2` tinyint(4) DEFAULT NULL,
  `respuesta3` tinyint(4) DEFAULT NULL,
  `respuesta3_escrita` varchar(255) DEFAULT NULL,
  `respuesta4` varchar(15) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `pdf` varchar(36) DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_alumno`,`id_club`),
  KEY `fk_alumno_has_club_club1_idx` (`id_club`),
  KEY `fk_alumno_has_club_alumno1_idx` (`id_alumno`),
  CONSTRAINT `fk_alumno_has_club_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `fk_alumno_has_club_club1` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_club`
--

LOCK TABLES `alumno_club` WRITE;
/*!40000 ALTER TABLE `alumno_club` DISABLE KEYS */;
INSERT INTO `alumno_club` VALUES (206302,1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(206302,2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(206302,4,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(206302,6,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(206302,8,2,4,0,0,2,'hablar más','Juego','más tiempo',NULL,1),(206302,10,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `alumno_club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_hoja_trabajo`
--

DROP TABLE IF EXISTS `alumno_hoja_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno_hoja_trabajo` (
  `id_alumno_hoja_trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(11) NOT NULL,
  `id_hoja_trabajo` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `calificacion` tinyint(4) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_alumno_hoja_trabajo`),
  KEY `fk_alumno_hoja_trabajo_alumno1_idx` (`id_alumno`),
  KEY `fk_alumno_hoja_trabajo_hoja_trabajo1_idx` (`id_hoja_trabajo`),
  KEY `fk_alumno_hoja_trabajo_periodo1_idx` (`id_periodo`),
  CONSTRAINT `fk_alumno_hoja_trabajo_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `fk_alumno_hoja_trabajo_hoja_trabajo1` FOREIGN KEY (`id_hoja_trabajo`) REFERENCES `hoja_trabajo` (`id_hoja_trabajo`),
  CONSTRAINT `fk_alumno_hoja_trabajo_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_hoja_trabajo`
--

LOCK TABLES `alumno_hoja_trabajo` WRITE;
/*!40000 ALTER TABLE `alumno_hoja_trabajo` DISABLE KEYS */;
INSERT INTO `alumno_hoja_trabajo` VALUES (1,206302,1,1,1,'2019-10-15',3),(2,206302,2,1,1,'2019-11-07',1),(3,206302,3,1,1,'2019-11-06',3),(4,206302,3,1,NULL,NULL,3),(5,206302,3,1,NULL,'2019-11-07',1),(6,206302,1,1,NULL,'2019-11-07',1),(7,206302,3,1,NULL,'2019-11-07',1),(8,206302,1,1,NULL,'2019-11-07',1),(11,206302,1,1,NULL,NULL,0);
/*!40000 ALTER TABLE `alumno_hoja_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_hoja_trabajo_pregunta`
--

DROP TABLE IF EXISTS `alumno_hoja_trabajo_pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno_hoja_trabajo_pregunta` (
  `id_alumno_hoja_trabajo` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `id_respuesta` int(11) DEFAULT NULL,
  `respuesta` varchar(255) DEFAULT NULL,
  `correcta` tinyint(4) NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_alumno_hoja_trabajo`,`id_pregunta`),
  KEY `fk_alumno_hoja_trabajo_has_pregunta_pregunta1_idx` (`id_pregunta`),
  KEY `fk_alumno_hoja_trabajo_has_pregunta_alumno_hoja_trabajo1_idx` (`id_alumno_hoja_trabajo`),
  KEY `fk_alumno_hoja_trabajo_pregunta_respuesta1_idx` (`id_respuesta`),
  CONSTRAINT `fk_alumno_hoja_trabajo_has_pregunta_alumno_hoja_trabajo1` FOREIGN KEY (`id_alumno_hoja_trabajo`) REFERENCES `alumno_hoja_trabajo` (`id_alumno_hoja_trabajo`),
  CONSTRAINT `fk_alumno_hoja_trabajo_has_pregunta_pregunta1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`),
  CONSTRAINT `fk_alumno_hoja_trabajo_pregunta_respuesta1` FOREIGN KEY (`id_respuesta`) REFERENCES `respuesta` (`id_respuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_hoja_trabajo_pregunta`
--

LOCK TABLES `alumno_hoja_trabajo_pregunta` WRITE;
/*!40000 ALTER TABLE `alumno_hoja_trabajo_pregunta` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno_hoja_trabajo_pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_periodo`
--

DROP TABLE IF EXISTS `alumno_periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumno_periodo` (
  `id_alumno` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  PRIMARY KEY (`id_alumno`,`id_periodo`),
  KEY `fk_alumno_has_periodo_periodo1_idx` (`id_periodo`),
  KEY `fk_alumno_has_periodo_alumno1_idx` (`id_alumno`),
  CONSTRAINT `fk_alumno_has_periodo_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `fk_alumno_has_periodo_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_periodo`
--

LOCK TABLES `alumno_periodo` WRITE;
/*!40000 ALTER TABLE `alumno_periodo` DISABLE KEYS */;
INSERT INTO `alumno_periodo` VALUES (206302,1);
/*!40000 ALTER TABLE `alumno_periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asesor`
--

DROP TABLE IF EXISTS `asesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asesor` (
  `id_asesor` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  PRIMARY KEY (`id_asesor`),
  KEY `fk_asesor_persona1_idx` (`id_persona`),
  CONSTRAINT `fk_asesor_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesor`
--

LOCK TABLES `asesor` WRITE;
/*!40000 ALTER TABLE `asesor` DISABLE KEYS */;
INSERT INTO `asesor` VALUES (1,5);
/*!40000 ALTER TABLE `asesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asesor_idioma`
--

DROP TABLE IF EXISTS `asesor_idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asesor_idioma` (
  `id_asesor` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  PRIMARY KEY (`id_asesor`,`id_idioma`),
  KEY `fk_asesor_has_idioma_idioma1_idx` (`id_idioma`),
  KEY `fk_asesor_has_idioma_asesor1_idx` (`id_asesor`),
  CONSTRAINT `fk_asesor_has_idioma_asesor1` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`),
  CONSTRAINT `fk_asesor_has_idioma_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id_idioma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesor_idioma`
--

LOCK TABLES `asesor_idioma` WRITE;
/*!40000 ALTER TABLE `asesor_idioma` DISABLE KEYS */;
/*!40000 ALTER TABLE `asesor_idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asesoria`
--

DROP TABLE IF EXISTS `asesoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asesoria` (
  `id_asesoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_asesor` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `dia` varchar(15) DEFAULT NULL,
  `horario` char(11) NOT NULL,
  PRIMARY KEY (`id_asesoria`),
  KEY `fk_asesoria_asesor1_idx` (`id_asesor`),
  KEY `fk_asesoria_idioma1_idx` (`id_idioma`),
  CONSTRAINT `fk_asesoria_asesor1` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`),
  CONSTRAINT `fk_asesoria_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id_idioma`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesoria`
--

LOCK TABLES `asesoria` WRITE;
/*!40000 ALTER TABLE `asesoria` DISABLE KEYS */;
INSERT INTO `asesoria` VALUES (1,1,3,'Lunes','15:00:00'),(2,1,3,'Martes','15:00:00'),(3,1,3,'Miércoles','15:00:00'),(4,1,3,'Jueves','15:00:00'),(5,1,3,'Jueves','16:00:00'),(6,1,3,'Viernes','18:00:00'),(7,1,4,'Sábado','18:00:00');
/*!40000 ALTER TABLE `asesoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `club` (
  `id_club` int(11) NOT NULL AUTO_INCREMENT,
  `id_asesor` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horario` time DEFAULT NULL,
  `cupo` tinyint(1) unsigned NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_club`),
  KEY `fk_club_asesor1_idx` (`id_asesor`),
  KEY `fk_club_curso1_idx` (`id_nivel`),
  KEY `fk_club_periodo1_idx` (`id_periodo`),
  CONSTRAINT `fk_club_asesor1` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`),
  CONSTRAINT `fk_club_curso1` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`),
  CONSTRAINT `fk_club_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club`
--

LOCK TABLES `club` WRITE;
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
INSERT INTO `club` VALUES (1,1,10,'2019-10-25','13:00:00',10,1,0),(2,1,10,'2019-10-25','13:00:00',10,1,0),(3,1,10,'2019-11-10','13:00:00',10,1,0),(4,1,10,'2019-10-25','14:00:00',10,1,0),(5,1,10,'2019-11-10','14:00:00',10,1,0),(6,1,10,'2019-10-29','19:00:00',10,1,0),(7,1,10,'2019-11-10','19:00:00',10,1,0),(8,1,10,'2019-10-29','23:00:00',10,1,0),(9,1,10,'2019-11-10','24:00:00',9,1,0),(10,1,3,'2019-11-10','15:00:00',10,1,0);
/*!40000 ALTER TABLE `club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `id_profesor` int(11) DEFAULT NULL,
  `id_nivel` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `cupo` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `fk_curso_profesor_curso1_idx` (`id_nivel`),
  KEY `fk_curso_profesor_profesor1_idx` (`id_profesor`),
  KEY `fk_curso_profesor_periodo1_idx` (`id_periodo`),
  CONSTRAINT `fk_curso_profesor_curso1` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`),
  CONSTRAINT `fk_curso_profesor_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`),
  CONSTRAINT `fk_curso_profesor_profesor1` FOREIGN KEY (`id_profesor`) REFERENCES `profesor` (`id_profesor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES (1,1,9,1,'Inglés 1-2',10),(2,1,10,1,'Inglés 3-4',10),(3,1,11,1,'Inglés 5-6',10),(4,1,12,1,'Inglés 7-8',10),(5,1,3,1,'Alemán 5-6',10),(6,1,10,2,'Inglés 3-4',10),(7,1,10,2,'Prueba 3-4',10);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso_alumno`
--

DROP TABLE IF EXISTS `curso_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso_alumno` (
  `id_curso` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_porcentaje_medio` int(11) DEFAULT NULL,
  `id_porcentaje_final` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_curso`,`id_alumno`),
  KEY `fk_curso_profesor_has_alumno_alumno1_idx` (`id_alumno`),
  KEY `fk_curso_profesor_has_alumno_curso_profesor1_idx` (`id_curso`),
  KEY `fk_curso_alumno_porcentajes1_idx` (`id_porcentaje_medio`),
  KEY `fk_curso_alumno_porcentajes2_idx` (`id_porcentaje_final`),
  CONSTRAINT `fk_curso_alumno_porcentajes1` FOREIGN KEY (`id_porcentaje_medio`) REFERENCES `porcentaje` (`id_porcentaje`),
  CONSTRAINT `fk_curso_alumno_porcentajes2` FOREIGN KEY (`id_porcentaje_final`) REFERENCES `porcentaje` (`id_porcentaje`),
  CONSTRAINT `fk_curso_profesor_has_alumno_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `fk_curso_profesor_has_alumno_curso_profesor1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_alumno`
--

LOCK TABLES `curso_alumno` WRITE;
/*!40000 ALTER TABLE `curso_alumno` DISABLE KEYS */;
INSERT INTO `curso_alumno` VALUES (1,204001,NULL,NULL),(1,204002,NULL,NULL),(2,206302,NULL,NULL),(2,206303,NULL,NULL),(3,206304,NULL,NULL),(3,206305,NULL,NULL),(4,206306,NULL,NULL),(4,206307,NULL,NULL),(5,206302,NULL,NULL),(7,206302,NULL,NULL);
/*!40000 ALTER TABLE `curso_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hoja_trabajo`
--

DROP TABLE IF EXISTS `hoja_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hoja_trabajo` (
  `id_hoja_trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(100) NOT NULL,
  `area` varchar(15) NOT NULL,
  `adaptado` varchar(40) NOT NULL,
  `unidad` tinyint(1) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `tipo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_hoja_trabajo`),
  KEY `fk_hoja_trabajo_curso1_idx` (`id_nivel`),
  CONSTRAINT `fk_hoja_trabajo_curso1` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hoja_trabajo`
--

LOCK TABLES `hoja_trabajo` WRITE;
/*!40000 ALTER TABLE `hoja_trabajo` DISABLE KEYS */;
INSERT INTO `hoja_trabajo` VALUES (1,'MY LIFE','GRAMMAR','PERSONAL BEST A1',1,10,0),(2,'PEOPLE AND THINGS','GRAMMAR','PERSONAL BEST A1',2,10,0),(3,'HELLO','VOCABULARY','PERSONAL BEST A1',3,10,1);
/*!40000 ALTER TABLE `hoja_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idioma`
--

DROP TABLE IF EXISTS `idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `idioma` (
  `id_idioma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL,
  PRIMARY KEY (`id_idioma`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idioma`
--

LOCK TABLES `idioma` WRITE;
/*!40000 ALTER TABLE `idioma` DISABLE KEYS */;
INSERT INTO `idioma` VALUES (1,'Español'),(2,'Francés'),(3,'Inglés'),(4,'Italiano'),(5,'Alemán'),(6,'Portugués'),(7,'Japonés'),(8,'Ruso');
/*!40000 ALTER TABLE `idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idioma_alumno`
--

DROP TABLE IF EXISTS `idioma_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `idioma_alumno` (
  `id_idioma` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  PRIMARY KEY (`id_idioma`,`id_alumno`),
  KEY `fk_idioma_has_alumno_alumno1_idx` (`id_alumno`),
  KEY `fk_idioma_has_alumno_idioma1_idx` (`id_idioma`),
  KEY `fk_idioma_alumno_periodo1_idx` (`id_periodo`),
  CONSTRAINT `fk_idioma_alumno_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`),
  CONSTRAINT `fk_idioma_has_alumno_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `fk_idioma_has_alumno_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id_idioma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idioma_alumno`
--

LOCK TABLES `idioma_alumno` WRITE;
/*!40000 ALTER TABLE `idioma_alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `idioma_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel`
--

DROP TABLE IF EXISTS `nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nivel` (
  `id_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` char(3) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  PRIMARY KEY (`id_nivel`),
  KEY `fk_curso_idioma1_idx` (`id_idioma`),
  CONSTRAINT `fk_curso_idioma1` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id_idioma`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel`
--

LOCK TABLES `nivel` WRITE;
/*!40000 ALTER TABLE `nivel` DISABLE KEYS */;
INSERT INTO `nivel` VALUES (1,'1-2',5),(2,'3-4',5),(3,'5-6',5),(4,'7-8',5),(5,'7-8',2),(6,'5-6',2),(7,'3-4',2),(8,'1-2',2),(9,'1-2',3),(10,'3-4',3),(11,'5-6',3),(12,'7-8',3),(13,'7-8',4),(14,'5-6',4),(15,'3-4',4),(16,'1-2',4),(17,'1-2',7),(18,'3-4',7),(19,'5-6',7),(20,'7-8',7),(21,'7-8',1),(22,'5-6',1),(23,'3-4',1),(24,'1-2',1),(25,'1-2',6),(26,'3-4',6),(27,'5-6',6),(28,'7-8',6),(29,'7-8',8),(30,'5-6',8),(31,'3-4',8),(32,'1-2',8);
/*!40000 ALTER TABLE `nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL AUTO_INCREMENT,
  `periodo` char(2) NOT NULL,
  `anio` char(4) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,'02','2019','2019-08-22','2019-12-13',1),(2,'01','2019','2019-01-28','2019-07-05',0);
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido_paterno` varchar(45) NOT NULL,
  `apellido_materno` varchar(45) DEFAULT NULL,
  `nombre_usuario` varchar(15) NOT NULL,
  `contrasena` char(56) NOT NULL,
  `tipo_persona` tinyint(4) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=206308 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'Jesus Alonso','Castro','Lopez','Alonso','12345',0,NULL),(2,'Admin','Admin','Admin','Admin','admin',1,NULL),(3,'CARLOS','profesor','profesor','Profesor','12345',2,NULL),(5,'Jessica','asesor','asesor','asesor','123',3,NULL),(204001,'Eduardo','Valdez','Rodriguez','Lalo','1234',0,NULL),(204002,'Jose','Valdez','Rodriguez','Lalo','1234',0,NULL),(206302,'Alondra','Uribarrien','Nevares','Alondra','1234',0,'4111440958'),(206303,'Alejandra','Uribarrien','Nevares','Uribarrien','1234',0,NULL),(206304,'Laura','Flores','Martinez','Martinez','1234',0,NULL),(206305,'Cecilia','Flores','Martinez','Martinez','1234',0,NULL),(206306,'Liliana','Gasca','Martinez','Martinez','1234',0,NULL),(206307,'Lulu','Gasca','Martinez','Martinez','1234',0,NULL);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal` (
  `id_personal` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  PRIMARY KEY (`id_personal`),
  KEY `fk_personal_persona1_idx` (`id_persona`),
  CONSTRAINT `fk_personal_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT INTO `personal` VALUES (1,2);
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `porcentaje`
--

DROP TABLE IF EXISTS `porcentaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `porcentaje` (
  `id_porcentaje` int(11) NOT NULL AUTO_INCREMENT,
  `club` float DEFAULT NULL,
  `hojas_de_trabajo` float DEFAULT NULL,
  `tiempo` time DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id_porcentaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `porcentaje`
--

LOCK TABLES `porcentaje` WRITE;
/*!40000 ALTER TABLE `porcentaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `porcentaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL AUTO_INCREMENT,
  `enunciado` varchar(255) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `id_hoja_trabajo` int(11) NOT NULL,
  PRIMARY KEY (`id_pregunta`),
  KEY `fk_pregunta_hoja_trabajo1_idx` (`id_hoja_trabajo`),
  CONSTRAINT `fk_pregunta_hoja_trabajo1` FOREIGN KEY (`id_hoja_trabajo`) REFERENCES `hoja_trabajo` (`id_hoja_trabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=1201 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` VALUES (1,'My sister is ____________.',1,1),(2,'________ is your e-mail?',1,1),(3,'85= ________',1,1),(4,'Marcus is __________.',1,1),(5,'Lucy ____ French.',1,1),(6,'The homework´s not easy, it´s ____________.',1,1),(7,'_______ they from Australia?',1,1),(8,'Fernando is an engineer from ____________.',1,1),(9,'\"Is she a teacher?\" \"Yes, ____________.\"',1,1),(10,'I´m _______ a doctor.',1,1),(11,'____________ do you say \"libro\" in English?',1,1),(12,'Hello, I ____________ Dani.',1,1),(13,'Twenty-two=____________',1,1),(14,'Poly and Sheldon ______ students.',1,1),(15,'How old _____ Harry?',1,1),(16,'My grandfather is ________ - he´s seventy.',1,1),(17,'My shoes are ___________.',1,1),(18,'\"Is pizza from Italy?\" \"Yes, ____________ is.\"',1,1),(19,'She´s an _____________.',1,1),(20,'Camila is a math ___________.',1,1),(21,'Mexico´s most famous food is __________.',1,2),(22,'I am Deborah. This is _______ husband Will.',1,2),(23,'Are ________ yoru glasses?',1,2),(24,'I have two _________ - two daughters.',1,2),(25,'My ____________ are from France.',1,2),(26,'That´s my _________ car.',1,2),(27,'We are sisters. ____________ last name is Williams.',1,2),(28,'Red + white = ____________.',1,2),(29,'The object you use to write is called: __________.',1,2),(30,'___________ are not my books.',1,2),(31,'That´s my teacher. _________ name is Charlie.',1,2),(32,'This school ________.',1,2),(33,'Black + white = ____________.',1,2),(34,'My _________ cellphone is old.',1,2),(35,'Rick, what is __________ last name?',1,2),(36,'It´s a __________.',1,2),(37,'You use this object to write things on.',1,2),(38,'Are these your ____________?',1,2),(39,'Green = yellow + ___________',1,2),(40,'My mother´s father is my _________.',1,2);
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesor` (
  `id_profesor` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  PRIMARY KEY (`id_profesor`),
  KEY `fk_profesor_persona1_idx` (`id_persona`),
  CONSTRAINT `fk_profesor_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` VALUES (1,3);
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `entrada` time NOT NULL,
  `salida` time DEFAULT NULL,
  `id_periodo` int(11) NOT NULL,
  PRIMARY KEY (`id_registro`),
  KEY `fk_registro_alumno1_idx` (`id_alumno`),
  KEY `fk_registro_periodo1_idx` (`id_periodo`),
  CONSTRAINT `fk_registro_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  CONSTRAINT `fk_registro_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro`
--

LOCK TABLES `registro` WRITE;
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
INSERT INTO `registro` VALUES (1,206302,'2019-10-23','12:00:00','15:00:00',1),(2,206302,'2019-10-23','16:00:00','17:00:00',1),(3,206302,'2019-10-24','07:00:00','08:00:00',1),(4,206302,'2019-10-24','09:30:00','10:20:00',1);
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `respuesta` (
  `id_respuesta` int(11) NOT NULL,
  `enunciado` varchar(45) NOT NULL,
  `correcta` tinyint(4) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  PRIMARY KEY (`id_respuesta`),
  KEY `fk_respuesta_pregunta1_idx` (`id_pregunta`),
  CONSTRAINT `fk_respuesta_pregunta1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuesta`
--

LOCK TABLES `respuesta` WRITE;
/*!40000 ALTER TABLE `respuesta` DISABLE KEYS */;
INSERT INTO `respuesta` VALUES (1,'Mexico',0,1),(2,'London',0,1),(3,'Mexican',1,1),(4,'What',1,2),(5,'What\'s',0,2),(6,'Whats',0,2),(7,'Eighty-five',1,3),(8,'Eighteen-five',0,3),(9,'Eighty',0,3),(10,'Germany',0,4),(11,'Brazil',0,4),(12,'German',1,4),(13,'were',0,5),(14,'are',0,5),(15,'is',1,5),(16,'happy',0,6),(17,'complicated',1,6),(18,'pretty',0,6),(19,'Was',0,7),(20,'Is',0,7),(21,'Are',1,7),(22,'Texas',1,8),(23,'Mexican',0,8),(24,'Canadian',0,8),(25,'I am',0,9),(26,'she is',1,9),(27,'she are',0,9),(28,'no',0,10),(29,'don´t',0,10),(30,'not',1,10),(31,'How',1,11),(32,'Who',0,11),(33,'Can',0,11),(34,'´re',0,12),(35,'´s',0,12),(36,'´m',1,12),(37,'12',0,13),(38,'20',0,13),(39,'22',1,13),(40,'be',0,14),(41,'am',0,14),(42,'are',1,14),(43,'24',0,15),(44,'is',1,15),(45,'are',0,15),(46,'old',1,16),(47,'new',0,16),(48,'young',0,16),(49,'dirty',1,17),(50,'easy',0,17),(51,'young',0,17),(52,'he',0,18),(53,'it',1,18),(54,'she',0,18),(55,'doctor',0,19),(56,'actress',1,19),(57,'mom',0,19),(58,'host',0,20),(59,'driver',0,20),(60,'teacher',1,20),(61,'tacos',1,21),(62,'pizza',0,21),(63,'sushi',0,21),(64,'my',1,22),(65,'our',0,22),(66,'his',0,22),(67,'this',0,23),(68,'these',1,23),(69,'that',0,23),(70,'parents',0,24),(71,'sisters',0,24),(72,'children',1,24),(73,'parents',0,25),(74,'father',0,25),(75,'parents',1,25),(76,'sister',0,26),(77,'sister´s',1,26),(78,'sisters',0,26),(79,'Our',1,27),(80,'We',0,27),(81,'Their',0,27),(82,'Blue',0,28),(83,'Pink',1,28),(84,'Browm',0,28),(85,'watch',0,29),(86,'wallet',0,29),(87,'pencil',1,29),(88,'This',0,30),(89,'These',1,30),(90,'That',0,30),(91,'His',1,31),(92,'Him',0,31),(93,'Her',0,31),(94,'big',0,32),(95,'big is',0,32),(96,'is big',1,32),(97,'gray',1,33),(98,'brown',0,33),(99,'black',0,33),(100,'brother',0,34),(101,'brother´s',1,34),(102,'brothers',0,34),(103,'it',0,35),(104,'your',1,35),(105,'his',0,35),(106,'black purse',1,36),(107,'purse big',0,36),(108,'purse black',0,36),(109,'notebook',1,37),(110,'table',0,37),(111,'wallet',0,37),(112,'pencil',0,38),(113,'purse',0,38),(114,'keys',1,38),(115,'gold',0,39),(116,'blue',1,39),(117,'red',0,39),(118,'grandparents',0,40),(119,'grandfather',1,40),(120,'grandmother',0,40);
/*!40000 ALTER TABLE `respuesta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-08 17:49:04
