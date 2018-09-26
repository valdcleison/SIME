-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: db_sime
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.34-MariaDB

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
-- Table structure for table `aluno`
--

DROP TABLE IF EXISTS `aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aluno` (
  `idaluno` int(11) NOT NULL AUTO_INCREMENT,
  `numeromatricula` varchar(45) NOT NULL,
  `endereco_idendereco` int(11) NOT NULL,
  `contato_idcontato` int(11) NOT NULL,
  `pessoa_idpessoa` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idaluno`),
  KEY `fk_aluno_endereco1_idx` (`endereco_idendereco`),
  KEY `fk_aluno_contato1_idx` (`contato_idcontato`),
  KEY `fk_aluno_pessoa1_idx` (`pessoa_idpessoa`),
  KEY `fk_aluno_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_aluno_contato1` FOREIGN KEY (`contato_idcontato`) REFERENCES `contato` (`idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aluno_endereco1` FOREIGN KEY (`endereco_idendereco`) REFERENCES `endereco` (`idendereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aluno_pessoa1` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aluno_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aluno`
--

LOCK TABLES `aluno` WRITE;
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anoletivo`
--

DROP TABLE IF EXISTS `anoletivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anoletivo` (
  `idanoletivo` int(11) NOT NULL AUTO_INCREMENT,
  `anoletivo` int(11) NOT NULL,
  `dtinicio` date NOT NULL,
  PRIMARY KEY (`idanoletivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anoletivo`
--

LOCK TABLES `anoletivo` WRITE;
/*!40000 ALTER TABLE `anoletivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `anoletivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contato`
--

DROP TABLE IF EXISTS `contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contato` (
  `idcontato` int(11) NOT NULL AUTO_INCREMENT,
  `telefone` varchar(13) DEFAULT NULL,
  `celular` varchar(13) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`idcontato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contato`
--

LOCK TABLES `contato` WRITE;
/*!40000 ALTER TABLE `contato` DISABLE KEYS */;
/*!40000 ALTER TABLE `contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `idendereco` int(11) NOT NULL AUTO_INCREMENT,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `cep` varchar(45) NOT NULL,
  PRIMARY KEY (`idendereco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escola`
--

DROP TABLE IF EXISTS `escola`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `escola` (
  `idescola` int(11) NOT NULL AUTO_INCREMENT,
  `nomeescola` varchar(100) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `nomegestor` varchar(75) DEFAULT NULL,
  `contato_idcontato` int(11) NOT NULL,
  `anoletivo_idanoletivo` int(11) NOT NULL,
  `endereco_idendereco` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idescola`,`contato_idcontato`),
  KEY `fk_escola_contato1_idx` (`contato_idcontato`),
  KEY `fk_escola_anoletivo1_idx` (`anoletivo_idanoletivo`),
  KEY `fk_escola_endereco1_idx` (`endereco_idendereco`),
  KEY `usuario_idusuaio_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_escola_anoletivo1` FOREIGN KEY (`anoletivo_idanoletivo`) REFERENCES `anoletivo` (`idanoletivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_escola_contato1` FOREIGN KEY (`contato_idcontato`) REFERENCES `contato` (`idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_escola_endereco1` FOREIGN KEY (`endereco_idendereco`) REFERENCES `endereco` (`idendereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_idusuaio` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escola`
--

LOCK TABLES `escola` WRITE;
/*!40000 ALTER TABLE `escola` DISABLE KEYS */;
/*!40000 ALTER TABLE `escola` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequencia`
--

DROP TABLE IF EXISTS `frequencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frequencia` (
  `idfrequencia` int(11) NOT NULL AUTO_INCREMENT,
  `qtalunospresentes` int(11) NOT NULL,
  `qtalunosausentes` int(11) DEFAULT NULL,
  `dtfrequencia` date NOT NULL,
  `hrinicio` datetime DEFAULT NULL,
  `hrtermino` datetime DEFAULT NULL,
  `escola_idescola` int(11) NOT NULL,
  `escola_gestor_idgestor` int(11) NOT NULL,
  `escola_contato_idcontato` int(11) NOT NULL,
  PRIMARY KEY (`idfrequencia`),
  KEY `fk_frequencia_escola1_idx` (`escola_idescola`,`escola_gestor_idgestor`,`escola_contato_idcontato`),
  KEY `fk_frequencia_escola1` (`escola_idescola`,`escola_contato_idcontato`),
  CONSTRAINT `fk_frequencia_escola1` FOREIGN KEY (`escola_idescola`, `escola_contato_idcontato`) REFERENCES `escola` (`idescola`, `contato_idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequencia`
--

LOCK TABLES `frequencia` WRITE;
/*!40000 ALTER TABLE `frequencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `frequencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequenciaaluno`
--

DROP TABLE IF EXISTS `frequenciaaluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frequenciaaluno` (
  `idfrequenciaaluno` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `hrentrada` datetime NOT NULL,
  `hrsaida` datetime NOT NULL,
  `matricula_idmatricula` int(11) NOT NULL,
  `ocorrencia_idocorrencia` int(11) NOT NULL,
  `frequenciaocorrecia_idfrequenciaocorrecia` int(11) NOT NULL,
  `frequencia_idfrequencia` int(11) NOT NULL,
  PRIMARY KEY (`idfrequenciaaluno`),
  KEY `fk_frequenciaaluno_matricula1_idx` (`matricula_idmatricula`),
  KEY `fk_frequenciaaluno_ocorrencia1_idx` (`ocorrencia_idocorrencia`),
  KEY `fk_frequenciaaluno_frequenciaocorrecia1_idx` (`frequenciaocorrecia_idfrequenciaocorrecia`),
  KEY `fk_frequenciaaluno_frequencia1_idx` (`frequencia_idfrequencia`),
  CONSTRAINT `fk_frequenciaaluno_frequencia1` FOREIGN KEY (`frequencia_idfrequencia`) REFERENCES `frequencia` (`idfrequencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequenciaaluno_frequenciaocorrecia1` FOREIGN KEY (`frequenciaocorrecia_idfrequenciaocorrecia`) REFERENCES `frequenciaocorrecia` (`idfrequenciaocorrecia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequenciaaluno_matricula1` FOREIGN KEY (`matricula_idmatricula`) REFERENCES `matricula` (`idmatricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_frequenciaaluno_ocorrencia1` FOREIGN KEY (`ocorrencia_idocorrencia`) REFERENCES `ocorrencia` (`idocorrencia`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequenciaaluno`
--

LOCK TABLES `frequenciaaluno` WRITE;
/*!40000 ALTER TABLE `frequenciaaluno` DISABLE KEYS */;
/*!40000 ALTER TABLE `frequenciaaluno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequenciaocorrecia`
--

DROP TABLE IF EXISTS `frequenciaocorrecia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frequenciaocorrecia` (
  `idfrequenciaocorrecia` int(11) NOT NULL,
  `frequenciaocorrecia` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idfrequenciaocorrecia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequenciaocorrecia`
--

LOCK TABLES `frequenciaocorrecia` WRITE;
/*!40000 ALTER TABLE `frequenciaocorrecia` DISABLE KEYS */;
/*!40000 ALTER TABLE `frequenciaocorrecia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matricula`
--

DROP TABLE IF EXISTS `matricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL AUTO_INCREMENT,
  `aluno_idaluno` int(11) NOT NULL,
  `anoletivo_idanoletivo` int(11) NOT NULL,
  PRIMARY KEY (`idmatricula`,`anoletivo_idanoletivo`),
  KEY `fk_matricula_aluno1_idx` (`aluno_idaluno`),
  KEY `fk_matricula_anoletivo1_idx` (`anoletivo_idanoletivo`),
  CONSTRAINT `fk_matricula_aluno1` FOREIGN KEY (`aluno_idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_matricula_anoletivo1` FOREIGN KEY (`anoletivo_idanoletivo`) REFERENCES `anoletivo` (`idanoletivo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula`
--

LOCK TABLES `matricula` WRITE;
/*!40000 ALTER TABLE `matricula` DISABLE KEYS */;
/*!40000 ALTER TABLE `matricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocorrencia`
--

DROP TABLE IF EXISTS `ocorrencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocorrencia` (
  `idocorrencia` int(11) NOT NULL AUTO_INCREMENT,
  `ocorrencia` text,
  PRIMARY KEY (`idocorrencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencia`
--

LOCK TABLES `ocorrencia` WRITE;
/*!40000 ALTER TABLE `ocorrencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocorrencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoa` (
  `idpessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nomepessoa` varchar(150) NOT NULL,
  `cpfpessoa` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`idpessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'valdcleison','11958005410'),(4,'jpessoa','jpessoa'),(5,'da','da'),(6,'a','a'),(7,'David Gomes','123321654'),(8,'jbr','jbr'),(9,'jj','jj'),(10,'ed','ed'),(11,'nkjnk','nkjnk'),(12,'bjhb','bjhb'),(13,'dasdad','dasdad'),(14,'sadad','sadad'),(24,'Junior Alexandre','12345678912');
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsavel`
--

DROP TABLE IF EXISTS `responsavel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsavel` (
  `idresponsavel` int(11) NOT NULL AUTO_INCREMENT,
  `contato_idcontato` int(11) NOT NULL,
  `endereco_idendereco` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idresponsavel`),
  KEY `endereco_idendereco_idx` (`endereco_idendereco`),
  KEY `contato_idcontato_idx` (`contato_idcontato`),
  KEY `usuario_idusuario_idx` (`usuario_idusuario`),
  CONSTRAINT `contato_idcontato` FOREIGN KEY (`contato_idcontato`) REFERENCES `contato` (`idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `endereco_idendereco` FOREIGN KEY (`endereco_idendereco`) REFERENCES `endereco` (`idendereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_idusuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsavel`
--

LOCK TABLES `responsavel` WRITE;
/*!40000 ALTER TABLE `responsavel` DISABLE KEYS */;
/*!40000 ALTER TABLE `responsavel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretario`
--

DROP TABLE IF EXISTS `secretario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretario` (
  `idsecretario` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(45) DEFAULT NULL,
  `pessoa_idpessoa` int(11) NOT NULL,
  `contato_idcontato` int(11) NOT NULL,
  `endereco_idendereco` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `escola_idescola` int(11) NOT NULL,
  PRIMARY KEY (`idsecretario`,`pessoa_idpessoa`),
  KEY `fk_secretario_pessoa1_idx` (`pessoa_idpessoa`),
  KEY `fk_secretario_contato1_idx` (`contato_idcontato`),
  KEY `fk_secretario_endereco1_idx` (`endereco_idendereco`),
  KEY `fk_secretario_usuario1_idx` (`usuario_idusuario`),
  KEY `fk_secretario_escola1_idx` (`escola_idescola`),
  CONSTRAINT `fk_secretario_contato1` FOREIGN KEY (`contato_idcontato`) REFERENCES `contato` (`idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_secretario_endereco1` FOREIGN KEY (`endereco_idendereco`) REFERENCES `endereco` (`idendereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_secretario_escola1` FOREIGN KEY (`escola_idescola`) REFERENCES `escola` (`idescola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_secretario_pessoa1` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_secretario_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretario`
--

LOCK TABLES `secretario` WRITE;
/*!40000 ALTER TABLE `secretario` DISABLE KEYS */;
/*!40000 ALTER TABLE `secretario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitacoes`
--

DROP TABLE IF EXISTS `solicitacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitacoes` (
  `idsolicitacoes` int(11) NOT NULL AUTO_INCREMENT,
  `dtsolicitacoes` date NOT NULL,
  `escola_idescola` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`idsolicitacoes`),
  KEY `fk_solicitacoes_escola_idx` (`escola_idescola`),
  CONSTRAINT `fk_solicitacoes_escola` FOREIGN KEY (`escola_idescola`) REFERENCES `escola` (`idescola`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitacoes`
--

LOCK TABLES `solicitacoes` WRITE;
/*!40000 ALTER TABLE `solicitacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `emailpessoa` varchar(30) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `niveladmin` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idpessoa_idx` (`idpessoa`),
  CONSTRAINT `idpessoa` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'valdcleisonvaldeci@gmail.com','admin','$2y$12$0UbavQYybGYyOkpwKLfFQeTh2BNlQZSTT2XBlFnV85goNQM6UuWCK',2,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuariorecuperarsenha`
--

DROP TABLE IF EXISTS `usuariorecuperarsenha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuariorecuperarsenha` (
  `idusuariorecuperarsenha` int(11) NOT NULL AUTO_INCREMENT,
  `dtrecuperacao` datetime DEFAULT NULL,
  `iprecuperacao` varchar(45) NOT NULL,
  `dtregistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idusuariorecuperarsenha`),
  KEY `fk_usuariorecuperarsenha_usuario1_idx` (`usuario_idusuario`),
  CONSTRAINT `fk_usuariorecuperarsenha_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuariorecuperarsenha`
--

LOCK TABLES `usuariorecuperarsenha` WRITE;
/*!40000 ALTER TABLE `usuariorecuperarsenha` DISABLE KEYS */;
INSERT INTO `usuariorecuperarsenha` VALUES (30,'2018-09-23 13:01:29','127.0.0.1','2018-09-23 15:29:16',1),(31,NULL,'127.0.0.1','2018-09-25 13:31:13',1),(32,'2018-09-25 12:24:28','127.0.0.1','2018-09-25 14:56:50',1),(33,NULL,'127.0.0.1','2018-09-25 15:43:21',1),(34,'0000-00-00 00:00:00','127.0.0.1','2018-09-25 15:46:24',1);
/*!40000 ALTER TABLE `usuariorecuperarsenha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_sime'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_userspasswordsrecoveries_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_userspasswordsrecoveries_create`(
pidusuario INT,
pipusuario VARCHAR(45)
)
BEGIN
	
	INSERT INTO usuariorecuperarsenha (usuario_idusuario, iprecuperacao)
    VALUES(pidusuario, pipusuario);
    
    SELECT * FROM usuariorecuperarsenha
    WHERE idusuariorecuperarsenha = LAST_INSERT_ID();
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_users_create` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_create`(
pnomepessoa varchar(100),
pcpfpessoa varchar(14),
pemailpessoa varchar(60),
pusuario varchar(60),
psenha varchar (150)
)
BEGIN
	
    DECLARE vidpessoa INT;
    
    INSERT INTO pessoa (nomepessoa, cpfpessoa) VALUES (pnomepessoa, pcpfpessoa);
    
    SET vidpessoa = LAST_INSERT_ID();
    
    INSERT INTO usuario (emailpessoa, usuario, senha, niveladmin, idpessoa) VALUES (pemailpessoa, pusuario, psenha, '2', vidpessoa);
    
    SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.niveladmin = 2 ORDER BY b.nomepessoa;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_delete` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_delete`(
piduser INT

)
BEGIN
	DECLARE vidpessoa INT;
    
    SELECT idpessoa INTO vidpessoa
    FROM usuario
    WHERE idusuario = piduser;

	DELETE FROM usuario WHERE idusuario = piduser;
	DELETE FROM pessoa WHERE idpessoa = vidpessoa;
    
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_user_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_update`(
piduser INT,
pnomepessoa varchar(100),
pcpfpessoa varchar(14),
pemailpessoa varchar(150),
pusuario varchar(60)
)
BEGIN
	DECLARE vidpessoa INT;

	SELECT idpessoa INTO vidpessoa
	FROM usuario
	WHERE idusuario = piduser;

	UPDATE pessoa
	SET nomepessoa = pnomepessoa,
	cpfpessoa  = pcpfpessoa
	WHERE idpessoa = vidpessoa;

	UPDATE usuario
	SET emailpessoa = pemailpessoa,
	usuario = pusuario 
	WHERE idusuario = piduser;
	
	SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.idusuario = piduser;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-26 14:06:02
