CREATE DATABASE  IF NOT EXISTS `market` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `market`;
-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: market
-- ------------------------------------------------------
-- Server version	5.7.44

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
-- Table structure for table `adminusers`
--

DROP TABLE IF EXISTS `adminusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adminusers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `KeyA` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '金鑰A',
  `KeyB` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '金鑰B',
  `Account` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '帳號',
  `Password` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密碼',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='後台管理者表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminusers`
--

LOCK TABLES `adminusers` WRITE;
/*!40000 ALTER TABLE `adminusers` DISABLE KEYS */;
INSERT INTO `adminusers` VALUES (4,'bc13dd5d621f55021d3a5035daf0d15977348855dafe877fbedcb44099fca46b','8364fd46f444d0404708b1f2ca19143daf916b069da7d4400c4b6bfc4542ce49649230b265feef78ac61d957c6ffe8515479adcef439087d80afb18b01fb7f1e','test','$2y$10$fK4TBtMEU4GNrkJz8jCJUOKdzDrmaK3UIv9nT9yN6fhSeVNz8GNsS','2025-07-03 07:10:47');
/*!40000 ALTER TABLE `adminusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authkey`
--

DROP TABLE IF EXISTS `authkey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `authkey` (
  `KeyId` int(11) NOT NULL AUTO_INCREMENT COMMENT '金鑰編號',
  `UserId` int(11) DEFAULT NULL COMMENT '會員編號',
  `KeyValueA` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '金鑰A',
  `KeyValueB` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '金鑰B',
  PRIMARY KEY (`KeyId`),
  KEY `KeyValueA` (`KeyValueA`),
  KEY `KeyValueB` (`KeyValueB`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authkey`
--

LOCK TABLES `authkey` WRITE;
/*!40000 ALTER TABLE `authkey` DISABLE KEYS */;
INSERT INTO `authkey` VALUES (5,11,'bc8292b1dc2309ae18e4d4045e9fbbbdfe73613b671f3ebec05e323ca167cf48','aff5a33401b345c9723301eef13caea363428204defda6f934dd080a8682d9122b764c4738a22f30a06256079536ca248d85d07d54133f7bb3b638f814008c32'),(6,12,'87c7511ffaf6969cdd9003f28cb97b5d42d8e6741f94ea714a2794b5376970d6','1557274477c682b80b65b6e898edf2597bb4289bb48503190b4f6b4f082a91fde511b9131d763d70d08ed9307c086ddad18372cc3ca496c9d79f770572f70726'),(7,13,'eef63ea331c8d9dc5a1d1a58418a4506548b693efc3e3f6ad172a52f8e3905cf','8a4de6a8beb0c413578c1525e5a0caedbceb03cf229b21ca58ef89d32fdd043e2fbbe4ac0387d1b3d348909b3dc293c14fe0ea44fb2bc0e46e0bc59982ed4c12'),(8,14,'8325b0af06cdf756161336eab4826ae8','32036a50072ef316c4e46c2ec8fd265c0eae92613f3c641f13bac74af07fbf3d'),(12,18,'8458fd46d8f410e44a88616a45c8d027e1f43df928f2fdab4a4a0564b9a0171a','8cd5b506b67ed4c6d19c35b8b739dcd3b793123745ed4c5ac0b2d719c9d9c44e7b25426a0760c594ff8a76ce71017c367de389a9328775eced4014cf422945c5'),(11,17,'3a53cad63ed92055064474d3e91027ee','77e5d6607d7b78a72b6d393dbe819ab27dfecdb732070c3c89c4f546f9c7a479'),(9,15,'da242d08384199af55819a729f5c9544','f9e26dc670c31de75a77654e08eed7316eb8899bbfdb170c904e1a1c10808fd0'),(13,19,'d71040b37a9d63f658e7390fcaad9fa2ca25f7ecc4fce6e4b5fb474fb9d425b1','0d96bdedff37ee073a1201e245a15dc16bacb06c785b14a6a783cd63eb564f052bee05b796c3f54eab5e81cf669c12d8a62596af765bbae24bb853f20914c936'),(10,16,'0098d113019cb5fd4313555af6d5a234','27b5f604911fc4d9f97af4549aafd361371a73a78b7800fa5a1bd07206b21e25'),(15,21,'411ba2fb43476b9779659dc9b9195058','da7dd732ce2c0ca89fbd6a01b4a47e724d70c42b2903bed010548a095bbd8486'),(26,32,'54c6a91a7c674def4e1ba4f7d51c2eab50b4e906c279267b34d0248e8ab3fe69','cc890048f577df13189292d254fd14d744d52b06500c17ae5210faf094a69804c8f6486b515b881cf9a2f04963027a95f4a1ab5c8f4b5f7b3a67ab6c59cadbea'),(14,20,'2087fd0a628173d5fbb3027244e7a916','9094d3ca737b2f372bf5e621df87bbdbeb85ca9750ff7a4e10476de0d00efe2d'),(25,31,'d865e80c608341da33f3a3f3983bd816','383e6bfbff2f94474bc6526e194f9db510ef6a4bf324777b57610a12f5b14c68'),(16,22,'0c93628d5c9388e6e24f2973991ebb1e','7ee73649363431186a9d0ab7e0c83246bd6bd6106f850ceb436dc9115b4c3c22'),(24,30,'b0bd4411a9f5487824dd573040e3a702eddd312c68cd5220deb3fdba2415d5b0','52d8ef3bf4684e4d537fd093d9ddd24fc02303f52fdf0ecbb6c76d773719c4aa1cc2464856c8bf3be9a227019859a91a53a24d5bed98643cf4ee17dbeb591e8a'),(17,23,'24c49372f0fb652f071464d6aff30ce510a31016f556e5ef018291bb91781255','f71d77acf5499e7c8f7c0db9bc62d1665f32ff4608e12ffb49b895bd98b7527947148c9c41251f0e1f50efb4b2933a4ab34f28d0808ae4cdeff91b72798d2005'),(18,24,'df6ebc4d400efcb6049684a71994b4e4','e353de0405d5899b3c79d2faf6d454d84c4a7dfef1459edf113bb4b8cdc35ec5'),(33,39,'6a9cc42344085ebe0f7ee630c066b317c6c7cad2e764bb18aaa5d13e07248820','6a9cc42344085ebe0f7ee630c066b317c6c7cad2e764bb18aaa5d13e07248820'),(19,25,'8ddb66b7aadf69707ba9cb5397ee9300','c3cec440aefba934a8e8e8702e77812570cff83476e7eb2d511271e8fee17426'),(20,26,'40c57ce743a22f7f058fbd6e7f5b027f','30addf15e26cced483a6a219759b4f422d4c3a83c7d3475d7fbcffcff33c24b6'),(21,27,'5d1ab026d51c84d7297781db476f495b','1f6e18bf8202671c4213aac6336628740b3b5098aa19a2135e16d018bf444f14'),(28,34,'6a9cc42344085ebe0f7ee630c066b317c6c7cad2e764bb18aaa5d13e07248820','6a9cc42344085ebe0f7ee630c066b317c6c7cad2e764bb18aaa5d13e07248820'),(22,28,'d8f9a39264e60df4fc9ecde8472771f1','2c124e77950bc7145dba860c3f75fde978b9bf92f3b23c011b8db35659d32216'),(29,35,'633d14b3611d5713d6864a943d091e548e3d9b8788c4d4a7af9fada6633433a1','01965337848c5fef1c34d4a4a0f98abfe353cc2753ae7a59ddc9e19425527f6e7afae19794eb54d092e4ca4a5a8e24c5c82c5c6922250b8eea4b62624255556a'),(23,29,'61c96e07679dcb9eb94a9cecdce13d9b','92b15917e95d8b7d19498a5dc847e044e2fb0f5070733090f5fbb31bc42e6017'),(30,36,'725948911bc14f2dda2b8a63ca29b71c259541305d5e320e4febf035f2e33aa1','35f33df48e079282104d8edc3ebfe233585e215eb66c2d82aee8be1daada5702157bda53797e09e1f8ab8fd1cf49339da4dc76d91cc59645e90d40a95353eef3'),(27,33,'21f78b364d3964831f88a3e709f8297e','1399c692cb96166ed7083d1cdfcb2a3e2d55034781cf7b5272633e53d9be1d81'),(31,37,'296f025e07f2a73cd569083968be05f3658bba42bacd1d3ea125d971dec13488','7f6aa24fe7b5d5975b6b7fa4016019634c8edba06f9324ab900733e76b3858c2f0aecacaa11f72fcb4534bc6cbf5c578ff1f5a49f310e3612f739ec9408a79eb'),(32,38,'ab5196ba0ac518bfc8b3b2ddf4e7c14bd0c5dd58aa47c39e564b6abfc1cfbaa2','1f528fe5dc2f64a936dea5e25cbcd8242f0e28426c1e9ae078da7147e4ab6359bd9c196cfe3598f049d04ea2ae312f67527fc816c28ac43db41b582ae1e8e9df'),(34,40,'3dbdc13e0f6c78322f8b85dba3cbef5e','3c6f52cfe8122f042152a1302170fcc380d72ac0a62026f6912dd00e5c47dbfc'),(35,41,'c1eb964302eef1f52f18e8bcd00998e7','c0452c152dab0e3fea3ba5c956ae972c50f24a7dbaccd42119eaadaae85b3f95'),(36,42,'968748f00b3cbf75c651c308bfcf5b15a42a8a84dad4555672ec4e07f6c1d6fa','673d46530c640697c90c30de89cf0b46c683fc35e93ae3717e72d1a41d02bdd2e9fa2f64a7b91bd0f16ed5fd9da69ca6ac535dde51548a00dbf6efca14f87c01');
/*!40000 ALTER TABLE `authkey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `discounts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '優惠券編號',
  `UserId` int(11) DEFAULT NULL COMMENT '使用者編號',
  `DiscountValue` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '優惠券的值',
  `DiscountType` int(11) DEFAULT NULL COMMENT '0:免運，1:折扣',
  `DiscountCoin` int(11) DEFAULT NULL COMMENT '折扣%數或運費金額',
  `StartDate` date DEFAULT NULL COMMENT '開始日期',
  `EndDate` date DEFAULT NULL COMMENT '結束日期',
  `IssuedMonth` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Useful` int(11) NOT NULL DEFAULT '0' COMMENT '是否使用',
  PRIMARY KEY (`Id`),
  KEY `UserId` (`UserId`,`DiscountValue`)
) ENGINE=InnoDB AUTO_INCREMENT=1516 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1348,11,'GFS4696023',0,49,'2025-06-11','2025-06-30','2025-06',0),(1349,11,'GFS2365562',0,49,'2025-06-11','2025-06-30','2025-06',0),(1350,11,'GFS5739739',0,49,'2025-06-11','2025-06-30','2025-06',0),(1351,11,'GPF2602012',1,90,'2025-06-11','2025-06-30','2025-06',0),(1352,11,'GPF3790842',1,80,'2025-06-11','2025-06-30','2025-06',0),(1353,11,'GPF1148177',1,70,'2025-06-11','2025-06-30','2025-06',0),(1354,12,'GFS2368358',0,49,'2025-06-11','2025-06-30','2025-06',0),(1355,12,'GFS7397260',0,49,'2025-06-11','2025-06-30','2025-06',0),(1356,12,'GFS1881228',0,49,'2025-06-11','2025-06-30','2025-06',0),(1357,12,'GPF4214361',1,90,'2025-06-11','2025-06-30','2025-06',0),(1358,12,'GPF5428123',1,80,'2025-06-11','2025-06-30','2025-06',0),(1359,12,'GPF4497532',1,70,'2025-06-11','2025-06-30','2025-06',0),(1360,13,'GFS5203291',0,49,'2025-06-11','2025-06-30','2025-06',0),(1361,13,'GFS2523859',0,49,'2025-06-11','2025-06-30','2025-06',0),(1362,13,'GFS5009423',0,49,'2025-06-11','2025-06-30','2025-06',0),(1363,13,'GPF7475539',1,90,'2025-06-11','2025-06-30','2025-06',0),(1364,13,'GPF3349425',1,80,'2025-06-11','2025-06-30','2025-06',0),(1365,13,'GPF2320511',1,70,'2025-06-11','2025-06-30','2025-06',0),(1366,14,'GFS9554281',0,49,'2025-06-11','2025-06-30','2025-06',0),(1367,14,'GFS3809871',0,49,'2025-06-11','2025-06-30','2025-06',0),(1368,14,'GFS7386513',0,49,'2025-06-11','2025-06-30','2025-06',0),(1369,14,'GPF6502954',1,90,'2025-06-11','2025-06-30','2025-06',0),(1370,14,'GPF9355230',1,80,'2025-06-11','2025-06-30','2025-06',0),(1371,14,'GPF8267289',1,70,'2025-06-11','2025-06-30','2025-06',0),(1372,15,'GFS3270755',0,49,'2025-06-11','2025-06-30','2025-06',0),(1373,15,'GFS8551911',0,49,'2025-06-11','2025-06-30','2025-06',0),(1374,15,'GFS4947289',0,49,'2025-06-11','2025-06-30','2025-06',0),(1375,15,'GPF7080712',1,90,'2025-06-11','2025-06-30','2025-06',0),(1376,15,'GPF1561694',1,80,'2025-06-11','2025-06-30','2025-06',0),(1377,15,'GPF3566334',1,70,'2025-06-11','2025-06-30','2025-06',0),(1378,16,'GFS3146591',0,49,'2025-06-11','2025-06-30','2025-06',0),(1379,16,'GFS4033952',0,49,'2025-06-11','2025-06-30','2025-06',0),(1380,16,'GFS9729988',0,49,'2025-06-11','2025-06-30','2025-06',0),(1381,16,'GPF8548086',1,90,'2025-06-11','2025-06-30','2025-06',0),(1382,16,'GPF3550467',1,80,'2025-06-11','2025-06-30','2025-06',0),(1383,16,'GPF9108076',1,70,'2025-06-11','2025-06-30','2025-06',0),(1384,17,'GFS6888980',0,49,'2025-06-11','2025-06-30','2025-06',0),(1385,17,'GFS6120673',0,49,'2025-06-11','2025-06-30','2025-06',0),(1386,17,'GFS8936426',0,49,'2025-06-11','2025-06-30','2025-06',0),(1387,17,'GPF7320113',1,90,'2025-06-11','2025-06-30','2025-06',0),(1388,17,'GPF8791286',1,80,'2025-06-11','2025-06-30','2025-06',0),(1389,17,'GPF2996092',1,70,'2025-06-11','2025-06-30','2025-06',0),(1390,18,'GFS5606604',0,49,'2025-06-11','2025-06-30','2025-06',0),(1391,18,'GFS9044745',0,49,'2025-06-11','2025-06-30','2025-06',0),(1392,18,'GFS9403912',0,49,'2025-06-11','2025-06-30','2025-06',0),(1393,18,'GPF9885328',1,90,'2025-06-11','2025-06-30','2025-06',0),(1394,18,'GPF2214904',1,80,'2025-06-11','2025-06-30','2025-06',0),(1395,18,'GPF7418535',1,70,'2025-06-11','2025-06-30','2025-06',0),(1396,19,'GFS2447967',0,49,'2025-06-11','2025-06-30','2025-06',0),(1397,19,'GFS6984227',0,49,'2025-06-11','2025-06-30','2025-06',0),(1398,19,'GFS8577238',0,49,'2025-06-11','2025-06-30','2025-06',0),(1399,19,'GPF2933510',1,90,'2025-06-11','2025-06-30','2025-06',0),(1400,19,'GPF5935837',1,80,'2025-06-11','2025-06-30','2025-06',0),(1401,19,'GPF1878657',1,70,'2025-06-11','2025-06-30','2025-06',0),(1402,20,'GFS8585773',0,49,'2025-06-11','2025-06-30','2025-06',0),(1403,20,'GFS9292894',0,49,'2025-06-11','2025-06-30','2025-06',0),(1404,20,'GFS1707152',0,49,'2025-06-11','2025-06-30','2025-06',0),(1405,20,'GPF6657080',1,90,'2025-06-11','2025-06-30','2025-06',0),(1406,20,'GPF9163946',1,80,'2025-06-11','2025-06-30','2025-06',0),(1407,20,'GPF6848490',1,70,'2025-06-11','2025-06-30','2025-06',0),(1408,21,'GFS5750614',0,49,'2025-06-11','2025-06-30','2025-06',0),(1409,21,'GFS7207601',0,49,'2025-06-11','2025-06-30','2025-06',0),(1410,21,'GFS8786162',0,49,'2025-06-11','2025-06-30','2025-06',0),(1411,21,'GPF3308007',1,90,'2025-06-11','2025-06-30','2025-06',0),(1412,21,'GPF7181551',1,80,'2025-06-11','2025-06-30','2025-06',0),(1413,21,'GPF6983733',1,70,'2025-06-11','2025-06-30','2025-06',0),(1414,22,'GFS3374014',0,49,'2025-06-11','2025-06-30','2025-06',0),(1415,22,'GFS3918874',0,49,'2025-06-11','2025-06-30','2025-06',0),(1416,22,'GFS8472325',0,49,'2025-06-11','2025-06-30','2025-06',0),(1417,22,'GPF2605006',1,90,'2025-06-11','2025-06-30','2025-06',0),(1418,22,'GPF4608056',1,80,'2025-06-11','2025-06-30','2025-06',0),(1419,22,'GPF5225261',1,70,'2025-06-11','2025-06-30','2025-06',0),(1420,23,'GFS2302140',0,49,'2025-06-11','2025-06-30','2025-06',0),(1421,23,'GFS3834918',0,49,'2025-06-11','2025-06-30','2025-06',0),(1422,23,'GFS2268170',0,49,'2025-06-11','2025-06-30','2025-06',0),(1423,23,'GPF7836096',1,90,'2025-06-11','2025-06-30','2025-06',0),(1424,23,'GPF4375972',1,80,'2025-06-11','2025-06-30','2025-06',0),(1425,23,'GPF6371573',1,70,'2025-06-11','2025-06-30','2025-06',0),(1426,24,'GFS8729948',0,49,'2025-06-11','2025-06-30','2025-06',0),(1427,24,'GFS5535023',0,49,'2025-06-11','2025-06-30','2025-06',0),(1428,24,'GFS9485274',0,49,'2025-06-11','2025-06-30','2025-06',0),(1429,24,'GPF2821299',1,90,'2025-06-11','2025-06-30','2025-06',0),(1430,24,'GPF2650673',1,80,'2025-06-11','2025-06-30','2025-06',0),(1431,24,'GPF3789471',1,70,'2025-06-11','2025-06-30','2025-06',0),(1432,25,'GFS9995335',0,49,'2025-06-11','2025-06-30','2025-06',0),(1433,25,'GFS1608264',0,49,'2025-06-11','2025-06-30','2025-06',0),(1434,25,'GFS4055315',0,49,'2025-06-11','2025-06-30','2025-06',0),(1435,25,'GPF5451785',1,90,'2025-06-11','2025-06-30','2025-06',0),(1436,25,'GPF5092978',1,80,'2025-06-11','2025-06-30','2025-06',0),(1437,25,'GPF8109539',1,70,'2025-06-11','2025-06-30','2025-06',0),(1438,26,'GFS6268759',0,49,'2025-06-11','2025-06-30','2025-06',0),(1439,26,'GFS6015180',0,49,'2025-06-11','2025-06-30','2025-06',0),(1440,26,'GFS1269624',0,49,'2025-06-11','2025-06-30','2025-06',0),(1441,26,'GPF5302582',1,90,'2025-06-11','2025-06-30','2025-06',0),(1442,26,'GPF3704037',1,80,'2025-06-11','2025-06-30','2025-06',0),(1443,26,'GPF1612440',1,70,'2025-06-11','2025-06-30','2025-06',0),(1444,28,'GFS4950089',0,49,'2025-06-11','2025-06-30','2025-06',0),(1445,28,'GFS9913125',0,49,'2025-06-11','2025-06-30','2025-06',0),(1446,28,'GFS6715359',0,49,'2025-06-11','2025-06-30','2025-06',0),(1447,28,'GPF2837423',1,90,'2025-06-11','2025-06-30','2025-06',0),(1448,28,'GPF2041038',1,80,'2025-06-11','2025-06-30','2025-06',0),(1449,28,'GPF9692920',1,70,'2025-06-11','2025-06-30','2025-06',0),(1450,29,'GFS5341488',0,49,'2025-06-11','2025-06-30','2025-06',0),(1451,29,'GFS5628680',0,49,'2025-06-11','2025-06-30','2025-06',0),(1452,29,'GFS2118937',0,49,'2025-06-11','2025-06-30','2025-06',0),(1453,29,'GPF1708646',1,90,'2025-06-11','2025-06-30','2025-06',0),(1454,29,'GPF1186422',1,80,'2025-06-11','2025-06-30','2025-06',0),(1455,29,'GPF8806170',1,70,'2025-06-11','2025-06-30','2025-06',0),(1456,30,'GFS3471586',0,49,'2025-06-11','2025-06-30','2025-06',0),(1457,30,'GFS7939420',0,49,'2025-06-11','2025-06-30','2025-06',0),(1458,30,'GFS1282343',0,49,'2025-06-11','2025-06-30','2025-06',0),(1459,30,'GPF8593455',1,90,'2025-06-11','2025-06-30','2025-06',0),(1460,30,'GPF2120248',1,80,'2025-06-11','2025-06-30','2025-06',0),(1461,30,'GPF1820876',1,70,'2025-06-11','2025-06-30','2025-06',0),(1462,31,'GFS1743635',0,49,'2025-06-11','2025-06-30','2025-06',0),(1463,31,'GFS2255548',0,49,'2025-06-11','2025-06-30','2025-06',0),(1464,31,'GFS5046835',0,49,'2025-06-11','2025-06-30','2025-06',0),(1465,31,'GPF8467532',1,90,'2025-06-11','2025-06-30','2025-06',0),(1466,31,'GPF8197158',1,80,'2025-06-11','2025-06-30','2025-06',0),(1467,31,'GPF5583194',1,70,'2025-06-11','2025-06-30','2025-06',0),(1468,32,'GFS2324495',0,49,'2025-06-11','2025-06-30','2025-06',0),(1469,32,'GFS2872893',0,49,'2025-06-11','2025-06-30','2025-06',0),(1470,32,'GFS6390983',0,49,'2025-06-11','2025-06-30','2025-06',0),(1471,32,'GPF4336235',1,90,'2025-06-11','2025-06-30','2025-06',0),(1472,32,'GPF1508228',1,80,'2025-06-11','2025-06-30','2025-06',0),(1473,32,'GPF2532434',1,70,'2025-06-11','2025-06-30','2025-06',0),(1474,33,'GFS7137489',0,49,'2025-06-11','2025-06-30','2025-06',0),(1475,33,'GFS9090141',0,49,'2025-06-11','2025-06-30','2025-06',0),(1476,33,'GFS5038239',0,49,'2025-06-11','2025-06-30','2025-06',0),(1477,33,'GPF5920775',1,90,'2025-06-11','2025-06-30','2025-06',0),(1478,33,'GPF4489159',1,80,'2025-06-11','2025-06-30','2025-06',0),(1479,33,'GPF3683471',1,70,'2025-06-11','2025-06-30','2025-06',0),(1480,35,'GFS3949877',0,49,'2025-06-11','2025-06-30','2025-06',0),(1481,35,'GFS7698972',0,49,'2025-06-11','2025-06-30','2025-06',0),(1482,35,'GFS7645232',0,49,'2025-06-11','2025-06-30','2025-06',0),(1483,35,'GPF5129245',1,90,'2025-06-11','2025-06-30','2025-06',0),(1484,35,'GPF1710527',1,80,'2025-06-11','2025-06-30','2025-06',0),(1485,35,'GPF1164903',1,70,'2025-06-11','2025-06-30','2025-06',0),(1486,36,'GFS8692932',0,49,'2025-06-11','2025-06-30','2025-06',0),(1487,36,'GFS2969954',0,49,'2025-06-11','2025-06-30','2025-06',0),(1488,36,'GFS5770973',0,49,'2025-06-11','2025-06-30','2025-06',0),(1489,36,'GPF9945006',1,90,'2025-06-11','2025-06-30','2025-06',0),(1490,36,'GPF4412109',1,80,'2025-06-11','2025-06-30','2025-06',0),(1491,36,'GPF9225530',1,70,'2025-06-11','2025-06-30','2025-06',0),(1492,37,'GFS4891323',0,49,'2025-06-11','2025-06-30','2025-06',0),(1493,37,'GFS4780026',0,49,'2025-06-11','2025-06-30','2025-06',0),(1494,37,'GFS8226160',0,49,'2025-06-11','2025-06-30','2025-06',0),(1495,37,'GPF7790726',1,90,'2025-06-11','2025-06-30','2025-06',0),(1496,37,'GPF4275148',1,80,'2025-06-11','2025-06-30','2025-06',0),(1497,37,'GPF6003565',1,70,'2025-06-11','2025-06-30','2025-06',0),(1498,38,'GFS7192379',0,49,'2025-06-11','2025-06-30','2025-06',0),(1499,38,'GFS7951202',0,49,'2025-06-11','2025-06-30','2025-06',0),(1500,38,'GFS8178874',0,49,'2025-06-11','2025-06-30','2025-06',0),(1501,38,'GPF7040764',1,90,'2025-06-11','2025-06-30','2025-06',0),(1502,38,'GPF9667199',1,80,'2025-06-11','2025-06-30','2025-06',0),(1503,38,'GPF8213706',1,70,'2025-06-11','2025-06-30','2025-06',0),(1504,40,'GFS2066932',0,49,'2025-06-11','2025-06-30','2025-06',0),(1505,40,'GFS2693542',0,49,'2025-06-11','2025-06-30','2025-06',0),(1506,40,'GFS6266915',0,49,'2025-06-11','2025-06-30','2025-06',0),(1507,40,'GPF4253951',1,90,'2025-06-11','2025-06-30','2025-06',0),(1508,40,'GPF1469009',1,80,'2025-06-11','2025-06-30','2025-06',0),(1509,40,'GPF2583195',1,70,'2025-06-11','2025-06-30','2025-06',0),(1510,41,'GFS7508946',0,49,'2025-06-11','2025-06-30','2025-06',0),(1511,41,'GFS1795146',0,49,'2025-06-11','2025-06-30','2025-06',0),(1512,41,'GFS3448893',0,49,'2025-06-11','2025-06-30','2025-06',0),(1513,41,'GPF1859030',1,90,'2025-06-11','2025-06-30','2025-06',0),(1514,41,'GPF6948471',1,80,'2025-06-11','2025-06-30','2025-06',0),(1515,41,'GPF1165266',1,70,'2025-06-11','2025-06-30','2025-06',0);
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'測試事件執行成功','2025-04-11 11:30:49'),(2,'測試事件執行成功','2025-04-11 11:31:28'),(3,'測試事件執行成功','2025-04-11 11:31:38'),(4,'測試事件執行成功','2025-04-11 11:31:48'),(5,'測試事件執行成功','2025-04-11 11:31:58'),(6,'測試事件執行成功','2025-04-11 11:32:08'),(7,'測試事件執行成功','2025-04-11 11:32:18'),(8,'測試事件執行成功','2025-04-11 11:32:28'),(9,'測試事件執行成功','2025-04-11 11:32:38'),(10,'測試事件執行成功','2025-04-11 11:32:48'),(11,'測試事件執行成功','2025-04-11 11:32:58'),(12,'測試事件執行成功','2025-04-11 11:33:08'),(13,'測試事件執行成功','2025-04-11 11:33:18'),(14,'測試事件執行成功','2025-04-11 11:33:28'),(15,'測試事件執行成功','2025-04-11 11:33:38'),(16,'測試事件執行成功','2025-04-11 11:33:48'),(17,'測試事件執行成功','2025-04-11 11:33:58'),(18,'測試事件執行成功','2025-04-11 11:34:08'),(19,'測試事件執行成功','2025-04-11 11:34:18'),(20,'測試事件執行成功','2025-04-11 11:34:28'),(21,'測試事件執行成功','2025-04-11 11:34:38'),(22,'測試事件執行成功','2025-04-11 11:34:48'),(23,'測試事件執行成功','2025-04-11 11:34:58'),(24,'測試事件執行成功','2025-04-11 11:35:08'),(25,'測試事件執行成功','2025-04-11 11:35:18'),(26,'測試事件執行成功','2025-04-11 11:35:28'),(27,'測試事件執行成功','2025-04-11 11:35:38'),(28,'測試事件執行成功','2025-04-11 11:35:48'),(29,'測試事件執行成功','2025-04-11 11:35:58'),(30,'測試事件執行成功','2025-04-11 11:36:08'),(31,'測試事件執行成功','2025-04-11 11:36:18'),(32,'測試事件執行成功','2025-04-11 11:36:28'),(33,'測試事件執行成功','2025-04-11 11:36:38'),(34,'測試事件執行成功','2025-04-11 11:36:48'),(35,'測試事件執行成功','2025-04-11 11:36:58'),(36,'測試事件執行成功','2025-04-11 11:37:08'),(37,'測試事件執行成功','2025-04-11 11:37:18'),(38,'測試事件執行成功','2025-04-11 11:37:28'),(39,'測試事件執行成功','2025-04-11 11:37:38'),(40,'測試事件執行成功','2025-04-11 11:37:48'),(41,'測試事件執行成功','2025-04-11 11:37:58'),(42,'測試事件執行成功','2025-04-11 11:38:08'),(43,'測試事件執行成功','2025-04-11 11:38:18'),(44,'測試事件執行成功','2025-04-11 11:38:28'),(45,'測試事件執行成功','2025-04-11 11:38:38'),(46,'測試事件執行成功','2025-04-11 11:38:48'),(47,'測試事件執行成功','2025-04-11 11:38:59'),(48,'測試事件執行成功','2025-04-11 11:39:08'),(49,'測試事件執行成功','2025-04-11 11:39:18'),(50,'測試事件執行成功','2025-04-11 11:39:28'),(51,'測試事件執行成功','2025-04-11 11:39:38'),(52,'測試事件執行成功','2025-04-11 11:39:48'),(53,'測試事件執行成功','2025-04-11 11:39:58'),(54,'測試事件執行成功','2025-04-11 11:40:08'),(55,'測試事件執行成功','2025-04-11 11:40:18'),(56,'測試事件執行成功','2025-04-11 11:40:28'),(57,'測試事件執行成功','2025-04-11 11:40:38'),(58,'測試事件執行成功','2025-04-11 11:40:48'),(59,'測試事件執行成功','2025-04-11 11:40:58'),(60,'測試事件執行成功','2025-04-11 11:41:08'),(61,'測試事件執行成功','2025-04-11 11:41:18'),(62,'測試事件執行成功','2025-04-11 11:41:28'),(63,'測試事件執行成功','2025-04-11 11:41:38'),(64,'測試事件執行成功','2025-04-11 11:41:48'),(65,'測試事件執行成功','2025-04-11 11:41:58'),(66,'測試事件執行成功','2025-04-11 11:42:08'),(67,'測試事件執行成功','2025-04-11 11:42:18'),(68,'測試事件執行成功','2025-04-11 11:42:28'),(69,'測試事件執行成功','2025-04-11 11:42:38'),(70,'測試事件執行成功','2025-04-11 11:42:48'),(71,'測試事件執行成功','2025-04-11 11:42:58'),(72,'測試事件執行成功','2025-04-11 11:43:08'),(73,'測試事件執行成功','2025-04-11 11:43:18'),(74,'測試事件執行成功','2025-04-11 11:43:28'),(75,'測試事件執行成功','2025-04-11 11:43:38'),(76,'測試事件執行成功','2025-04-11 11:43:48'),(77,'測試事件執行成功','2025-04-11 11:43:58'),(78,'測試事件執行成功','2025-04-11 11:44:08'),(79,'測試事件執行成功','2025-04-11 11:44:18'),(80,'測試事件執行成功','2025-04-11 11:44:28'),(81,'測試事件執行成功','2025-04-11 11:44:38'),(82,'測試事件執行成功','2025-04-11 11:44:48'),(83,'測試事件執行成功','2025-04-11 11:44:58'),(84,'測試事件執行成功','2025-04-11 11:45:08'),(85,'測試事件執行成功','2025-04-11 11:45:18'),(86,'測試事件執行成功','2025-04-11 11:45:28'),(87,'測試事件執行成功','2025-04-11 11:45:38'),(88,'測試事件執行成功','2025-04-11 11:45:48'),(89,'測試事件執行成功','2025-04-11 11:45:58'),(90,'測試事件執行成功','2025-04-11 11:46:08');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單編號',
  `UserId` int(11) DEFAULT NULL COMMENT '使用者編號',
  `Name` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收件人姓名',
  `Tel` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收件人電話',
  `Other` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '備註',
  `Address` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '寄送地址',
  `HowSend` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '寄送方式',
  `PayStatus` int(11) NOT NULL DEFAULT '0' COMMENT '付款狀態 0:未付款，1:已付款',
  `DiscountType` int(11) NOT NULL DEFAULT '1' COMMENT '優惠券型態 0:商品優惠，1:運費優惠',
  `DiscountCoin` int(11) DEFAULT NULL COMMENT '優惠券ˋ打折金額',
  `Total` int(11) DEFAULT NULL COMMENT '總金額',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='訂單表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (39,11,'陳佳胤','0966606580','我要全部','雲林縣二崙鄉124F','ATM-轉帳宅配到家',1,0,0,5195,'2025-05-02 05:13:56'),(41,11,'陳佳胤','0966606580','無','苗栗縣西湖鄉金獅村2鄰金獅26-2號','711-貨到付款',0,0,0,150,'2025-05-07 14:04:33'),(42,11,'陳佳胤','0966606580','無','基隆市七堵區大德路103號','711-貨到付款',0,1,0,2698,'2025-05-12 08:30:06'),(43,11,'陳佳胤','0966606580','新增測試','臺中市太平區657號','ATM-轉帳宅配到家',1,1,0,2748,'2025-05-13 06:05:15'),(44,11,'陳佳胤','0966606580','無','基隆市七堵區大德路103號','711-貨到付款',0,1,2385,2698,'2025-05-23 05:43:55');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordersproduct`
--

DROP TABLE IF EXISTS `ordersproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordersproduct` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單商品編號',
  `OrdersId` int(11) DEFAULT NULL COMMENT '訂單編號',
  `ProductPhoto` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ProductName` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品名稱',
  `ProductColor` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品顏色，色票',
  `ProductSize` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品尺寸',
  `ProductCoin` int(11) DEFAULT NULL COMMENT '商品價格',
  `Count` int(11) DEFAULT NULL COMMENT '購買數量',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='訂單商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordersproduct`
--

LOCK TABLES `ordersproduct` WRITE;
/*!40000 ALTER TABLE `ordersproduct` DISABLE KEYS */;
INSERT INTO `ordersproduct` VALUES (42,39,'20250318155419_image 1.png','春季棉質T恤','#FFFFFF','L',500,6),(43,39,'20250320094303_Woolen_socks1.jpg','秋季毛線襪','#808080','S',199,5),(44,39,'20250320101536_Lightweight_running_shoes1.jpg','夏季輕盈跑鞋','#0000FF','40',1200,1),(45,41,'20250320101508_Breathable_socks1.jpg','春季透氣襪','#D1B2A1','S',150,1),(46,42,'20250320101508_Breathable_socks1.jpg','春季透氣襪','#FF6F61','M',150,1),(47,42,'20250320094334_Windproof_jacket1.jpg','冬季防風外套','#000000','M',2499,1),(48,43,'20250320094454_Warm_snow _boots1.jpg','冬季保暖雪靴','#000000','41',1799,1),(49,43,'20250320101601_Slim_jeans2.jpg','經典修身牛仔褲','#191970','34',900,1),(50,44,'20250320094334_Windproof_jacket1.jpg','冬季防風外套','#FF0000','L',2499,1),(51,44,'20250320101508_Breathable_socks1.jpg','春季透氣襪','#D1B2A1','S',150,1);
/*!40000 ALTER TABLE `ordersproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderstatus`
--

DROP TABLE IF EXISTS `orderstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderstatus` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `OrdersId` int(11) NOT NULL COMMENT '訂單ID',
  `OrdersStatus` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '訂單狀態 0:未出貨，1:運送中，2:已抵達，-1:已取消',
  `CreateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderstatus`
--

LOCK TABLES `orderstatus` WRITE;
/*!40000 ALTER TABLE `orderstatus` DISABLE KEYS */;
INSERT INTO `orderstatus` VALUES (1,41,'0','2025-05-07 14:04:33'),(2,42,'0','2025-05-12 08:30:06'),(3,43,'0','2025-05-13 06:05:15'),(4,39,'0','2025-05-13 06:05:15'),(12,39,'1','2025-05-13 09:58:10'),(13,41,'-1','2025-05-13 09:58:22'),(14,42,'-1','2025-05-13 10:26:25'),(15,43,'1','2025-05-16 05:55:18'),(22,39,'2','2025-05-23 05:11:59'),(23,43,'2','2025-05-23 05:11:59'),(25,44,'0','2025-05-23 05:43:55'),(26,44,'1','2025-06-17 05:47:03');
/*!40000 ALTER TABLE `orderstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品編號',
  `SeriesId` int(11) DEFAULT NULL COMMENT '系列編號',
  `TypeId` int(11) DEFAULT NULL COMMENT '種類編號',
  `ProductName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品名稱',
  `Introduction` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品介紹',
  `Price` int(11) DEFAULT NULL COMMENT '價格',
  `Quantity` int(11) DEFAULT NULL COMMENT '數量',
  `Status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Y:上架,N:下架',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,50,'春季棉質T恤','這款棉質T恤選用高品質純棉材質，透氣柔軟，適合春天穿著。經典圓領設計，簡約百搭，不論是單穿還是內搭都能輕鬆駕馭。',500,10,'Y','2025-03-14 05:49:53'),(85,1,51,'春季運動鞋','輕量化運動鞋，適合春季戶外活動，舒適透氣。',1299,20,'Y','2025-03-20 01:23:00'),(86,2,49,'夏季牛仔短褲','夏季新款牛仔短褲，時尚百搭，透氣舒適。',899,15,'Y','2025-03-20 01:23:00'),(87,3,7,'秋季毛線襪','加厚羊毛材質，適合秋冬穿著，保暖舒適。',199,50,'','2025-03-20 01:23:00'),(88,4,9,'冬季防風外套','防風防水設計，適合冬季戶外運動與通勤穿著。',2499,10,'Y','2025-03-20 01:23:00'),(89,4,10,'冬季保暖雪靴','高筒防水雪靴，保暖透氣，適合冬季旅遊穿著。',1799,12,'Y','2025-03-20 01:23:00'),(90,5,12,'經典純棉襪','100% 純棉，透氣柔軟，適合日常穿著。',129,80,'Y','2025-03-20 01:23:00'),(91,5,13,'經典皮革鞋','高品質真皮材質，經典時尚設計，耐穿舒適。',2299,8,'','2025-03-20 01:23:00'),(92,4,8,'冬季毛呢帽','厚實毛呢材質，保暖且時尚，適合冬季穿搭。',699,30,'Y','2025-03-20 01:23:00'),(93,2,4,'夏季短袖襯衫','透氣輕薄的襯衫設計，適合夏季穿著。',1099,25,'Y','2025-03-20 01:23:00'),(94,3,6,'秋季修身長褲','合身剪裁，彈性舒適，適合秋季休閒穿搭。',1299,18,'','2025-03-20 01:23:00'),(95,1,53,'春季透氣襪','這款春季透氣襪採用高品質棉料，透氣舒適，適合日常穿著。',150,50,'Y','2025-03-20 01:54:44'),(96,2,5,'夏季輕盈跑鞋','專為夏季設計的輕盈跑鞋，透氣網布，減震舒適，適合運動愛好者。',1200,30,'Y','2025-03-20 01:54:44'),(97,5,11,'經典修身牛仔褲','這款經典修身牛仔褲採用高彈性材質，修身版型，適合日常穿搭。',900,20,'','2025-03-20 01:54:44');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productcolor`
--

DROP TABLE IF EXISTS `productcolor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productcolor` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品顏色編號',
  `ProductId` int(11) DEFAULT NULL COMMENT '商品編號',
  `Color` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商品顏色',
  `ColorSample` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '色票',
  PRIMARY KEY (`Id`),
  KEY `ProductId` (`ProductId`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品顏色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productcolor`
--

LOCK TABLES `productcolor` WRITE;
/*!40000 ALTER TABLE `productcolor` DISABLE KEYS */;
INSERT INTO `productcolor` VALUES (1,1,'黑色','#000000'),(2,1,'白色','#FFFFFF'),(3,1,'紅色','#FF0000'),(75,85,'黑色','#000000'),(76,85,'白色','#FFFFFF'),(77,85,'藍色','#0000FF'),(78,86,'淺藍色','#87CEFA'),(79,86,'深藍色','#00008B'),(80,87,'灰色','#808080'),(81,87,'深藍色','#191970'),(82,88,'紅色','#FF0000'),(83,88,'黑色','#000000'),(84,88,'酒紅色','#800020'),(85,89,'棕色','#8B4513'),(86,89,'黑色','#000000'),(87,89,'卡其色','#C3B091'),(88,90,'白色','#FFFFFF'),(89,91,'棕色','#A52A2A'),(90,91,'黑色','#000000'),(91,92,'駝色','#D2B48C'),(92,93,'粉紅色','#FFC0CB'),(93,93,'白色','#FFFFFF'),(94,94,'深藍色','#191970'),(95,94,'黑色','#000000'),(96,95,'白色','#FFFFFF'),(97,95,'黑色','#000000'),(98,96,'藍色','#0000FF'),(99,96,'紅色','#FF0000'),(100,97,'深藍色','#191970'),(101,97,'灰色','#808080'),(109,95,'灰色','#333333'),(110,95,'奶茶色','#D1B2A1'),(111,95,'特調珊瑚','#FF6F61');
/*!40000 ALTER TABLE `productcolor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productphoto`
--

DROP TABLE IF EXISTS `productphoto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productphoto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '照片編號',
  `ProductId` int(11) NOT NULL,
  `photoPath` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '照片路徑',
  PRIMARY KEY (`Id`),
  KEY `ProductId` (`ProductId`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品照片表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productphoto`
--

LOCK TABLES `productphoto` WRITE;
/*!40000 ALTER TABLE `productphoto` DISABLE KEYS */;
INSERT INTO `productphoto` VALUES (7,1,'20250318155419_image 1.png'),(26,74,'20250318210910_AEN003400.jpg'),(27,74,'20250319084359_image 1.png'),(38,85,'20250320094208_shoes1.jpg'),(39,85,'20250320094208_shoes2.jpg'),(40,85,'20250320094208_shoes3.jpg'),(41,86,'20250320094239_Denim_shorts1.jpg'),(42,86,'20250320094239_Denim_shorts2.jpg'),(43,86,'20250320094239_Denim_shorts3.jpg'),(44,87,'20250320094303_Woolen_socks1.jpg'),(45,87,'20250320094303_Woolen_socks2.jpg'),(46,87,'20250320094303_Woolen_socks3.jpg'),(47,88,'20250320094334_Windproof_jacket1.jpg'),(48,88,'20250320094334_Windproof_jacket2.jpg'),(49,88,'20250320094334_Windproof_jacket3.jpg'),(50,89,'20250320094454_Warm_snow _boots1.jpg'),(51,89,'20250320094454_Warm_snow_boots2.jpg'),(52,89,'20250320094454_Warm_snow_boots3.jpg'),(53,90,'20250320094520_Cotton_socks1.jpg'),(54,90,'20250320094520_Cotton_socks2.jpg'),(55,90,'20250320094520_Cotton_socks3.jpg'),(56,91,'20250320094542_Leather_shoes1.jpg'),(57,91,'20250320094542_Leather_shoes2.jpg'),(58,91,'20250320094542_Leather_shoes3.jpg'),(59,92,'20250320094611_Woolen_hat1.jpg'),(60,92,'20250320094611_Woolen_hat2.jpg'),(61,92,'20250320094611_Woolen_hat3.jpg'),(62,93,'20250320094631_Short_sleeved_shirt1.jpg'),(63,93,'20250320094631_Short_sleeved_shirt2.jpg'),(64,93,'20250320094631_Short_sleeved_shirt3.jpg'),(65,94,'20250320094650_Slim_fit_trousers1.jpg'),(66,94,'20250320094650_Slim_fit_trousers2.jpg'),(67,94,'20250320094650_Slim_fit_trousers3.jpg'),(68,95,'20250320101508_Breathable_socks1.jpg'),(69,95,'20250320101508_Breathable_socks2.jpg'),(70,95,'20250320101508_Breathable_socks3.jpg'),(71,96,'20250320101536_Lightweight_running_shoes1.jpg'),(72,96,'20250320101536_Lightweight_running_shoes2.jpg'),(73,96,'20250320101536_Lightweight_running_shoes3.jpg'),(75,97,'20250320101601_Slim_jeans2.jpg'),(76,97,'20250320101601_Slim_jeans3.jpg'),(82,95,'20250402093908_sam-moghadam-Y0lUBKt-AZI-unsplash.jpg'),(83,95,'20250402093908_the-happy-toe-C4iUTOasx8U-unsplash.jpg'),(86,1,'20250418075216_300_15.jpg');
/*!40000 ALTER TABLE `productphoto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productsize`
--

DROP TABLE IF EXISTS `productsize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productsize` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '尺寸編號',
  `ProductColorId` int(11) DEFAULT NULL COMMENT '商品顏色編號',
  `Size` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '尺寸名稱',
  PRIMARY KEY (`Id`),
  KEY `ProductColorId` (`ProductColorId`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品尺寸表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productsize`
--

LOCK TABLES `productsize` WRITE;
/*!40000 ALTER TABLE `productsize` DISABLE KEYS */;
INSERT INTO `productsize` VALUES (1,1,'S'),(2,1,'M'),(3,2,'L'),(4,3,'XL'),(33,75,'38'),(34,75,'39'),(35,75,'40'),(36,76,'M'),(37,76,'L'),(38,77,'L'),(39,77,'XL'),(40,78,'S'),(41,78,'M'),(42,78,'L'),(43,79,'42'),(44,79,'43'),(45,80,'S'),(46,81,'38'),(47,81,'40'),(48,82,'L'),(49,83,'M'),(50,83,'XL'),(51,84,'L'),(52,84,'XL'),(53,85,'S'),(54,85,'M'),(55,86,'40'),(56,86,'41'),(57,86,'42'),(58,87,'M'),(59,87,'L'),(60,87,'XL'),(61,88,'38'),(62,88,'39'),(63,89,'M'),(64,89,'L'),(65,90,'XL'),(66,91,'S'),(67,91,'M'),(68,91,'L'),(69,92,'40'),(70,92,'41'),(71,96,'M'),(72,96,'L'),(73,97,'S'),(76,99,'42'),(77,100,'32'),(78,100,'34'),(79,101,'36'),(81,103,'12'),(82,104,'8'),(87,109,'S'),(88,109,'M'),(89,109,'L'),(90,109,'XL'),(91,109,'XXL'),(92,110,'S'),(93,111,'M'),(94,98,'40');
/*!40000 ALTER TABLE `productsize` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producttype`
--

DROP TABLE IF EXISTS `producttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producttype` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '種類編號',
  `SeriesId` int(11) DEFAULT NULL COMMENT '系列編號',
  `TypeName` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '帽,衣,褲,襪,鞋',
  PRIMARY KEY (`Id`),
  KEY `SeriesId` (`SeriesId`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品種類表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producttype`
--

LOCK TABLES `producttype` WRITE;
/*!40000 ALTER TABLE `producttype` DISABLE KEYS */;
INSERT INTO `producttype` VALUES (4,2,'衣服'),(5,2,'鞋類'),(6,3,'下身'),(7,3,'襪子'),(8,4,'帽子'),(9,4,'衣服'),(10,4,'鞋類'),(11,5,'下身'),(12,5,'襪子'),(13,5,'鞋類'),(49,2,'下身'),(50,1,'衣服'),(51,1,'鞋類'),(53,1,'襪子');
/*!40000 ALTER TABLE `producttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `series` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '系列名稱',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品系列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` VALUES (1,'春季系列','2025-03-10 06:31:07'),(2,'夏季系列','2025-03-10 06:31:07'),(3,'秋季系列','2025-03-10 06:31:07'),(4,'冬季系列','2025-03-10 06:31:07'),(5,'經典系列','2025-03-10 06:31:07');
/*!40000 ALTER TABLE `series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopcart`
--

DROP TABLE IF EXISTS `shopcart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shopcart` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '購物編號',
  `UserId` int(11) DEFAULT NULL COMMENT '使用者編號',
  `ProductId` int(11) DEFAULT NULL COMMENT '商品編號',
  `ColorId` int(11) DEFAULT NULL COMMENT '顏色編號',
  `SizeId` int(11) DEFAULT NULL COMMENT '尺寸編號',
  `Count` int(11) DEFAULT NULL COMMENT '數量',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopcart`
--

LOCK TABLES `shopcart` WRITE;
/*!40000 ALTER TABLE `shopcart` DISABLE KEYS */;
INSERT INTO `shopcart` VALUES (48,11,97,100,77,1);
/*!40000 ALTER TABLE `shopcart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT COMMENT '會員編號',
  `UserName` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '會員姓名',
  `Phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電話(帳號)',
  `Password` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密碼',
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '信箱',
  `Date` date DEFAULT NULL COMMENT '生日',
  `Address` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '居住地址',
  `UserLeavel` int(11) DEFAULT '1' COMMENT '會員等級',
  `UserEXP` int(11) DEFAULT '0' COMMENT '會員等級經驗',
  `CreateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='會員表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'陳佳胤','0966606580','$2y$10$57.YXsCQSQWe4BX7bSztDOusChlHtrmyOpCI/W82/Qifb.NWfblnK','chap39672@gmail.com','2002-08-26','臺中市北區育祥街32號4F',1,0,'2025-03-25 06:47:20'),(12,'嗚嗚嗚','0975933044','$2y$10$RZTF3mItb2BFK6A3O3sc4.XcOVTDHLqNs5C0dLJY1L0c7rKZD4Q0q','555555ee@gmail.com','2025-04-02','南海島南沙群島qwewqe',1,0,'2025-04-01 05:20:07'),(13,'陳依依','0911666777','$2y$10$k0DAWycloSHR2txM8plJMe25ST7XnjpBzfp6etaZybBcRo.cz8FrC','mailmail@gmail.com','2023-10-30','臺中市東勢區sflk;ak',1,0,'2025-04-01 05:55:09'),(14,'一二三','0988888888','$2y$10$ZWCQeAIWntXwWWWWkDS2j.LtokGDIlk0W7DmtL93b7BsRHqjcaZO2','123123@gmail.com','2025-04-01','臺中市南屯區123123',1,0,'2025-04-01 05:56:16'),(15,'張竣傑','0923897897','$2y$10$oiYbZjOGfcpikWXt3JnTieMp.DcQTmMAXu6ZhxRrNCSfSVeCoRJ.W','jjboy0220@gmail.com','1991-02-20','臺中市太平區1321346545646',1,0,'2025-04-01 05:56:24'),(16,'一一一','0900123456','$2y$10$Rmvxp7EmAq5F5DRWUv/Mle8lTUAJUJIvpckWcDMoYPWDUTL50PvMm','ccc@gmail.com','2025-02-04','臺中市西屯區ccc',1,0,'2025-04-01 05:56:40'),(17,'卡皮八','0933511199','$2y$10$/tOk5dt1EyeXwl3zCRuIL.hMUegYHTTSDoCbx66HRjUd3F9fXqtT.','test@gmail.com','2025-01-01','臺中市西屯區工業一路100號',1,0,'2025-04-01 05:56:40'),(18,'王小名','0912214578','$2y$10$3LpKMT.HHKcaf44/kydyLeFV.r7Re7mMclRqbcIVQEOgtmKxG34yG','sss1123@gmail.com','2001-10-18','臺中市東勢區窩不知道街20號',1,0,'2025-04-01 05:56:45'),(19,'阿伊屋','0921321131','$2y$10$pwVX31rR3CZSlg4CApbSVeSj0k4871abjHuQCPJXnvtxMkIIMe53O','00200320@gmail.com','2025-04-28','南投縣中寮鄉230320',1,0,'2025-04-01 05:56:52'),(20,'錦錦錦','0998765432','$2y$10$XiTVqzHKpfC89TcZGfiNIuznWb.WXs3F.s.deg2FTKALhgTmeQWNm','gin@gmail.com','2025-04-01','臺中市西屯區123',1,0,'2025-04-01 05:56:58'),(21,'沉沉沉','0980566666','$2y$10$6h4ZmbmmxWXArKo7KxOlW.O6nG7VOYK7Qx4RL9LA0AGq2ZM1YVLQ6','xx@gmail.com','2025-04-09','臺南市麻豆區xx',1,0,'2025-04-01 05:57:07'),(22,'李達夫','0910123456','$2y$10$X2DWCrSNuZD.7H5BrP2/g.mcJLzjnwgeXcj6csN3Qk/k3hYensvyy','test01@gmail.com','2000-01-04','高雄市阿蓮區工業區一號',1,0,'2025-04-01 05:57:12'),(23,'卡洛斯','0909123456','$2y$10$FqyRrG1/wvss/VqtZftg1Oj1d5uLWlrogHV3M7hGCFeT1SiW1ArHK','sssssss@gmail.com','1990-05-20','高雄市阿蓮區sssss',1,0,'2025-04-01 05:57:18'),(24,'阿阿阿','0912155423','$2y$10$CeHJmzjD3EJoXFZ0b2qF7ujd4ufx.hOTEVDBCZDNBGTuhzeAQLcmq','AAAAAAAAA@gmail.com','2024-09-11','彰化縣大村鄉CDZDFDSSFSFSD',1,0,'2025-04-01 05:57:20'),(25,'呂士軒','0978240111','$2y$10$3eY/a3asuKIlYbkARR3bOOoY2auTuQEmI78C7dp1cLte1ePDEqRxm','abbaab@gmail.com','1989-06-04','臺中市大安區台灣大道787號',1,0,'2025-04-01 05:57:20'),(26,'陳二二','0955566675','$2y$10$NK7t5a3bewjaT6hvALyBcenGuRa4jjthtr1WhEyjXoDlJybUH2GPK','KMAIL@gmail.com','2024-11-30','臺中市霧峰區KKKKSSSS',1,0,'2025-04-01 05:57:22'),(28,'诶诶诶','0912345678','$2y$10$SOtYQdpsdbNJ0d9z/6ryDOgu2x4BpDmgCh9FqG560IUGHeSBHZWaS','lobobo@gmail.com','2025-04-16','苗栗縣銅鑼鄉12345678',1,0,'2025-04-01 05:57:32'),(29,'張黑黑','0997546213','$2y$10$Of1khQFRhUJBcYjZB6TEi.L.0.WE9WlyQpnoMwMMEvsEVDoKx21cm','black003@gmail.com','2002-02-18','嘉義縣民雄鄉下水道3段',1,0,'2025-04-01 05:57:32'),(30,'陳陳陳','0988888888','$2y$10$7BfmNi78trIwj38r4P8.4e/jeFnGgntvrbFC04NUOLmh7hN5aGkdC','111@gmail.com','1987-02-01','臺中市大肚區沙田路二段',1,0,'2025-04-01 05:57:46'),(31,'王你好','0946134615','$2y$10$r2DfqL9cUULKbF/y8BrXEuSffipy2DZN3lv294tmzblPmhymdbzKC','dsdfsf@gmail.com','2025-04-25','臺中市石岡區sdfsd',1,0,'2025-04-01 05:57:47'),(32,'哈密瓜','0925489256','$2y$10$GutxisQUpDrl2/r2LsLTSOIGmjk7hw3WJ1aT3drHhZbKezGWFGCv.','123123123@gmail.com','2025-04-24','雲林縣四湖鄉我站在雲林裡',1,0,'2025-04-01 05:58:13'),(33,'阿巫醫','0915975346','$2y$10$olG9iBjS7nPFDe/lsx4Xou8FT1qvkZhSjDUuL4gILqYHGQdgSmCje','21313@gmail.com','2025-04-21','嘉義縣大林鎮asdasd',1,0,'2025-04-01 05:58:17'),(41,'我午我','0911111111','$2y$10$UJIYULtWek4YrRun.qcq9.pg/vQkGeQjc497yMgJyFJgKCsAWF5qW','a@gmail.com','2000-01-01','臺南市關廟區11',1,0,'2025-04-02 06:58:53'),(35,'辦桌喔','0922734567','$2y$10$alkRg8wvXjYWEf2FaudfLeaIkGCAQhsWOgBfcWe8//Kaq4Qc.I4gm','aaaaaa@gmail.com','2025-04-11','高雄市東沙群島aaaaaaa',1,0,'2025-04-01 05:59:08'),(36,'讚讚讚','0910123456','$2y$10$BQsb5Hk1B454l8jdx2ESpOUPh2ot/1.aa0H4EWgceBVVy/4/wkej2','tcnr27@gmail.com','2025-04-01','臺中市西屯區職訓局',1,0,'2025-04-01 05:59:31'),(37,'一二三','0988888888','$2y$10$YBinJZa6.TQEoKdgILJZXeUvfCF14LUs/YoW5hp792NJUDcGuPXW6','1@gmail.com','2025-04-01','南投縣南投市123',1,0,'2025-04-01 05:59:41'),(38,'陳陳陳','0988888888','$2y$10$oTBHlz8CfJ6nZbRLqzvb1O9LUSiVPMEpCjU6SRh6xgrK1jZv.4oMu','123@gmail.com','1987-02-01','臺中市大肚區沙田路二段',1,0,'2025-04-01 05:59:48'),(40,'李阿布','0911111111','$2y$10$6HM7z0uAS2cqzEWKH9Sq0.j4F9kk0GEjfIN/2x7gF/XHDIuPjjtEu','Q123@gmail.com','2025-04-02','嘉義市西區123',1,0,'2025-04-02 06:57:31');
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

-- Dump completed on 2025-07-03 15:12:07
