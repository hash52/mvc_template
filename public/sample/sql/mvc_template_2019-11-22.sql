# ************************************************************
# Sequel Pro SQL dump
# バージョン 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 127.0.0.1 (MySQL 5.6.35)
# データベース: mvc_template
# 作成時刻: 2019-11-22 07:07:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

# データベースのダンプ mvc_template
# ------------------------------------------------------------

DROP DATABASE IF EXISTS `mvc_template`;
CREATE DATABASE `mvc_template`;

# テーブルのダンプ hoge
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hoge`;

CREATE TABLE `hoge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `hoge` WRITE;
/*!40000 ALTER TABLE `hoge` DISABLE KEYS */;

INSERT INTO `hoge` (`id`, `text`)
VALUES
	(1,'hogehoge'),
	(2,'hogehoge'),
	(3,'hogehoge'),
	(4,'hogehoge'),
	(5,'hogehoge'),
	(6,'hogehoge'),
	(7,'hogehoge'),
	(8,'hogeeeeeee');

/*!40000 ALTER TABLE `hoge` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
