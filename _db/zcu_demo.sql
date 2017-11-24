
-- DATABASE

CREATE DATABASE `security_demo` COLLATE 'utf8_general_ci';

-- TABLES

CREATE TABLE `user` (
  `user_id`  int          NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  `email`    varchar(512) NOT NULL
);

CREATE TABLE `transaction` (
  `transaction_id` int  NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `amount`         int  NOT NULL,
  `hash`           text NOT NULL,
  `comment`        text NULL
);


-- DATA

INSERT INTO `user` (`user_id`, `username`, `password`, `email`) VALUES
(0,	'antonin.neumann',	'e10adc3949ba59abbe56e057f20f883e',	'antonin.neumann@intraworlds.com'),
(0,	'ondrej.esler',	'5f4dcc3b5aa765d61d8327deb882cf99',	'ondrej.esler@intraworlds.com');
