CREATE DATABASE Webtop_DB;

use Webtop_DB;
CREATE TABLE IF NOT EXISTS `users` (
 `id` int NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `create_datetime` datetime NOT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `Machines` (
 `id` int NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `CPU` varchar(50) NOT NULL,
 `RAM` varchar(50) NOT NULL,
 `port` varchar(50) NOT NULL,
 `create_datetime` datetime NOT NULL,
 PRIMARY KEY (`id`)
);

INSERT into `Machines` (username, RAM, CPU, port, create_datetime) VALUES ('Admin', 2, 2, 3000, date())
                     