-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `zcu_demo`;
CREATE DATABASE `zcu_demo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `zcu_demo`;

DROP TABLE IF EXISTS `ledger`;
CREATE TABLE `ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payer_id` int(11) DEFAULT NULL COMMENT 'Payer',
  `payee_id` int(11) NOT NULL COMMENT 'Payee',
  `amount` int(11) NOT NULL COMMENT 'Amount',
  `desc` text NOT NULL COMMENT 'Description',
  PRIMARY KEY (`id`),
  KEY `payer_id` (`payer_id`),
  KEY `payee_id` (`payee_id`),
  CONSTRAINT `ledger_ibfk_1` FOREIGN KEY (`payer_id`) REFERENCES `users` (`id`),
  CONSTRAINT `ledger_ibfk_2` FOREIGN KEY (`payee_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COMMENT='Ledger';

INSERT INTO `ledger` (`id`, `payer_id`, `payee_id`, `amount`, `desc`) VALUES
(1,	NULL,	1,	100,	'Initial credit'),
(2,	NULL,	2,	100,	'Initial credit'),
(3,	NULL,	3,	100,	'Initial credit'),
(4,	NULL,	4,	100,	'Initial credit'),
(5,	NULL,	5,	100,	'Initial credit'),
(6,	NULL,	6,	100,	'Initial credit'),
(7,	NULL,	7,	100,	'Initial credit'),
(8,	NULL,	8,	100,	'Initial credit'),
(9,	NULL,	9,	100,	'Initial credit'),
(10,	NULL,	10,	100,	'Initial credit'),
(11,	2,	3,	10,	'I see\"!\' \'You might just as.'),
(12,	3,	10,	7,	'An enormous puppy was.'),
(13,	8,	10,	2,	'So she stood looking at it.'),
(14,	4,	9,	9,	'He looked at her rather.'),
(15,	8,	9,	4,	'Alice could see it pop down.'),
(16,	2,	5,	3,	'Hatter, with an M, such as.'),
(17,	3,	4,	8,	'I\'ve got to grow here,\' said.'),
(18,	8,	10,	10,	'Queen had never had fits, my.'),
(19,	2,	9,	2,	'Shakespeare, in the.'),
(20,	1,	8,	8,	'King say in a twinkling!.'),
(21,	3,	5,	7,	'Alice. \'Now we shall get on.'),
(22,	3,	7,	5,	'I\'ve finished.\' So they had.'),
(23,	1,	9,	10,	'Alice. \'But you\'re so easily.'),
(24,	3,	5,	6,	'I must be removed,\' said the.'),
(25,	3,	4,	4,	'I\'ll manage better this.'),
(26,	3,	6,	4,	'The first thing I\'ve got.'),
(27,	6,	10,	3,	'Alice. \'Only a thimble,\'.'),
(28,	3,	8,	8,	'Alice remarked. \'Right, as.'),
(29,	6,	9,	5,	'And the Eaglet bent down its.'),
(30,	1,	5,	3,	'As there seemed to have it.'),
(31,	2,	8,	4,	'The Hatter was the first.'),
(32,	7,	8,	2,	'On various pretexts they all.'),
(33,	5,	10,	9,	'Though they were gardeners.'),
(34,	1,	4,	6,	'It means much the most.'),
(35,	2,	4,	8,	'I suppose Dinah\'ll be.'),
(36,	8,	10,	2,	'I was going to remark.'),
(37,	4,	9,	9,	'And she thought it over.'),
(38,	6,	7,	10,	'ME.\' \'You!\' said the.'),
(39,	2,	8,	8,	'Alice in a hurry: a large.'),
(40,	1,	3,	7,	'Alice, in a sort of thing.'),
(41,	4,	6,	4,	'Pigeon in a low, weak voice..'),
(42,	6,	9,	4,	'Queen shrieked out. \'Behead.'),
(43,	6,	10,	5,	'Five! Always lay the blame.'),
(44,	3,	5,	4,	'But at any rate, there\'s no.'),
(45,	2,	9,	8,	'Cat again, sitting on the.'),
(46,	6,	9,	3,	'White Rabbit blew three.'),
(47,	2,	3,	10,	'Alice thought this must ever.'),
(48,	7,	10,	7,	'Queen,\' and she set to work.'),
(49,	3,	7,	5,	'I will prosecute YOU.--Come.'),
(50,	5,	9,	7,	'Duchess, \'and that\'s the.'),
(51,	7,	9,	4,	'Dormouse sulkily remarked.'),
(52,	3,	8,	2,	'Dinah at you!\' There was.'),
(53,	2,	4,	4,	'Dormouse,\' the Queen had.'),
(54,	8,	9,	3,	'At last the Gryphon at the.'),
(55,	5,	10,	5,	'There was a different person.'),
(56,	2,	5,	8,	'King said to the Mock Turtle.'),
(57,	8,	9,	10,	'Rabbit coming to look for.'),
(58,	5,	7,	5,	'Northumbria, declared for.'),
(59,	3,	8,	7,	'Alice. \'I wonder how many.'),
(60,	1,	8,	10,	'Queen had ordered. They very.'),
(61,	7,	9,	1,	'A secret, kept from all the.'),
(62,	2,	6,	4,	'I think?\' \'I had NOT!\' cried.'),
(63,	6,	8,	7,	'I think that very few things.'),
(64,	7,	8,	7,	'I\'LL soon make you grow.'),
(65,	2,	6,	3,	'Queen. \'I never thought.'),
(66,	2,	3,	3,	'King, with an air of great.'),
(67,	1,	2,	8,	'Mock Turtle sang this, very.'),
(68,	1,	7,	4,	'Alice called out in a low.'),
(69,	3,	6,	8,	'Paris is the reason and all.'),
(70,	4,	10,	4,	'Knave. The Knave did so, and.'),
(71,	5,	9,	8,	'Alice noticed, had powdered.'),
(72,	2,	7,	6,	'Ann, what ARE you talking.'),
(73,	1,	3,	8,	'Caterpillar. \'I\'m afraid.'),
(74,	3,	7,	9,	'Turtle.\' These words were.'),
(75,	4,	7,	3,	'Mock Turtle had just upset.'),
(76,	2,	10,	2,	'She felt very lonely and.'),
(77,	7,	10,	4,	'Alice began to cry again.'),
(78,	6,	8,	1,	'However, this bottle was a.'),
(79,	1,	2,	2,	'Alice was just possible it.'),
(80,	2,	5,	9,	'King; \'and don\'t be.'),
(81,	5,	7,	9,	'Alice, and looking at the.'),
(82,	1,	3,	2,	'AT ALL. Soup does very well.'),
(83,	1,	4,	2,	'The chief difficulty Alice.'),
(84,	3,	10,	6,	'First, she dreamed of little.'),
(85,	6,	8,	7,	'I think.\' And she went on.'),
(86,	2,	10,	5,	'I\'ll set Dinah at you!\'.'),
(87,	3,	5,	7,	'Dodo solemnly, rising to its.'),
(88,	6,	9,	5,	'HER ONE, THEY GAVE HIM.'),
(89,	7,	10,	4,	'March Hare said to herself..'),
(90,	2,	8,	1,	'Alice ventured to say. \'What.'),
(91,	4,	8,	7,	'So she tucked her arm.'),
(92,	7,	8,	2,	'THE VOICE OF THE SLUGGARD,\"\'.'),
(93,	8,	10,	8,	'Queen said to one of them.'),
(94,	6,	10,	4,	'Majesty,\' he began, \'for.'),
(95,	4,	9,	1,	'Duchess, as she did not.'),
(96,	5,	9,	10,	'King in a very little!.'),
(97,	2,	10,	9,	'Mary Ann, and be turned out.'),
(98,	4,	6,	5,	'Will you, won\'t you, won\'t.'),
(99,	2,	3,	10,	'Alice, \'but I must go and.'),
(100,	6,	8,	3,	'DOTH THE LITTLE BUSY BEE,\".'),
(101,	4,	8,	5,	'Alice thought to herself in.'),
(102,	4,	6,	5,	'King said, for about the.'),
(103,	2,	10,	7,	'Hatter, it woke up again as.'),
(104,	3,	6,	2,	'Alice had learnt several.'),
(105,	4,	5,	9,	'Caterpillar. \'Well, I\'ve.'),
(106,	1,	10,	2,	'But the snail replied \"Too.'),
(107,	1,	9,	7,	'Alice doubtfully: \'it.'),
(108,	2,	9,	2,	'THIS witness.\' \'Well, if I.'),
(109,	1,	3,	3,	'As for pulling me out of a.'),
(110,	6,	7,	8,	'Hatter: and in THAT.');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'Name',
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `password` varchar(255) NOT NULL COMMENT 'Password hash',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Users';

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1,	'Antonin Neumann',	'antonin.neumann@intraworlds.com',	'$2y$10$cH3CZC9BEFB8WwbUvcvpV.I.3CUtVIsJhObIMBIdPZeF3vTqpyusq'),
(2,	'Ondrej Esler',	'ondrej.esler@example.com',	'$2y$10$xnoE07TClLrWOkFWi.k0dOHpJLIzG7zJgE.JCJi03.mMiOFKkGqIG'),
(3,	'Dr. Adolphus Larson I',	'gulgowski.nikita@huels.com',	'$2y$10$WQcjJcbZc3GaJe7W2AsGBuK0C16pa9238GJSdUag/cJ5WWS1wViha'),
(4,	'Ethel Lueilwitz',	'balistreri.naomie@jones.biz',	'$2y$10$AglaWCpqSYSk5QK9PaAqvupijJmGiwW8qm3zrA.nS4mBjTBy7LxmO'),
(5,	'Prof. Willis Ritchie PhD',	'willis.ritchie@example.com',	'$2y$10$wNSiVP8Cp8mC2BZJGz7cPO.JGR9uKI7RCzkUujPd.xuYRjStFXSzi'),
(6,	'Sandrine Reilly',	'mya.walsh@terry.org',	'$2y$10$8RGTfP8t5kdkUlsT9RXab..jq0Vg/uZCXmsp7CCaeCRVaSsyDCTAa'),
(7,	'Emerson Kautzer',	'glenda65@crooks.com',	'$2y$10$si2FE5vjh2vnoq92VHQyuehLGUBL1GNb24sT0HX4pvGhunTCTaTK2'),
(8,	'Dr. Saul Lehner',	'eschinner@mccullough.org',	'$2y$10$vBxMT7Wp2q9j/8x2xQ7BBeRlt4wRBzqq5gNv1aD6LLGamLdAb8On.'),
(9,	'Domenica Marks',	'brigitte.deckow@lang.net',	'$2y$10$XR4neuqQtl8Jli3W7piG7uFHt9c4/Xp/qvuo3I6/c.6arpqrSemjm'),
(10,	'Kaitlyn Little',	'wisoky.terrence@torp.com',	'$2y$10$fxL4t8uNsRTItz2E99N.Le04PnFD.Jdmw7WorFLaJjpwJL4vIQFRm');

-- 2017-11-24 08:13:57
