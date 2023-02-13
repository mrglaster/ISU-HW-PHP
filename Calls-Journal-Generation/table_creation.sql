CREATE DATABASE calls_table;
USE calls_table;
CREATE TABLE IF NOT EXISTS `calls` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone_init` varchar(45) DEFAULT NULL,
  `phone_receiver` varchar(45) DEFAULT NULL,
  `duration` varchar(45) DEFAULT NULL,
  `date` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
);