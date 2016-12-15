CREATE DATABASE IF NOT EXISTS `authentification`;
USE `authentification`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=ucs2;

INSERT INTO `users` VALUES (1,'Damien'),(2,'Antoine'),(3,'Catherine');