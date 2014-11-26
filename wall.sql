-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Versie:              8.3.0.4857
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Databasestructuur van wall wordt geschreven
CREATE DATABASE IF NOT EXISTS `wall` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wall`;


-- Structuur van  tabel wall.comment wordt geschreven
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1500) NOT NULL,
  `datum` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_gebruiker` (`gebruiker_id`),
  KEY `FK_comment_post` (`post_id`),
  CONSTRAINT `FK_comment_gebruiker` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`),
  CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wall.comment: ~26 rows (ongeveer)
DELETE FROM `comment`;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`id`, `content`, `datum`, `status`, `post_id`, `gebruiker_id`, `parent_id`) VALUES
	(6, 'tea is a wonderful beverage, because of the anti-oxidants it has in the herbs plus it is hot which is perfect on a rainy day.', 1415124568, '1', 2, 19, 0),
	(10, 'espresso, or energy drinks', 1415124568, '1', 2, 20, 0),
	(16, 'Pink lemonade or kool aid, depends if I have time to go to the store. If I do not have time I usually go to Starbucks (especially with Halloween, pumpkin late! FTW).\r\n\r\nOh I almost forgot I also like those iced fruit smoothies from Mc Donalds. I really enjoy the mango with pineapple but... that is more for the summer. In the winter I prefer a warm cinnamon donut with a cup of hot coffee. Oh I almost forgot I also like those iced fruit smoothies from Mc Donalds. I really enjoy the mango with pineapple but... that is more for the summer. In the winter I prefer a warm cinnamon donut with a cup of hot coffee.\r\n', 1415124568, '1', 2, 23, 0),
	(18, 'Well, since it is Tuesday you have to wait 3 more days.', 1415124568, '1', 5, 20, 0),
	(28, 'To be honest, I really dispise the cold...:brrr: Everything is death and everyone is always so dull (minus the cheerful holidays.) If I really had to go outside... I would always make myself some thick homemade chocolate milk with loads of churros covered in sugar and cinnamon.', 1415124568, '1', 2, 24, 0),
	(48, 'To do list: Delete post & comment, Hide comment & edit on right positions and work on each position, Like/dislike ratio, Change the delete button.', 1415316589, '1', 23, 25, 0),
	(49, 'It is already Friday here, aiyah.', 1415316589, '1', 5, 25, 0),
	(56, '@captain-obvious, it is friday right now. So enjoy your new waifu and games.', 1415383972, '1', 5, 18, 0),
	(59, 'To do list: comment & edit on right positions and work on each position, Like/dislike ratio', 1415401914, '1', 23, 18, 0),
	(60, 'To do list: Like/dislike ratio, show posts & comments from user on their profile, user/comment/post management (admin)', 1415410624, '1', 23, 20, 0),
	(61, 'When it is really cold I prefer a cup of hot, dark coffee from a local coffercorner. When I drink hot coffee on a snowy/rainy day I feel so comfortable and relaxed, even though tea also does the job. Actually... I think aslong as the beverage is hot I will be oke and it depends on my mood.', 1415410730, '1', 2, 26, 0),
	(65, 'pirates ;*', 1415431315, '1', 26, 18, 0),
	(66, 'obviously pirates, also 2003 called they want their question back.', 1415431611, '1', 26, 19, 0),
	(68, 'I choose ninjas.\r\n\r\n@bloodyetiquette, dont be so rude. Everyone can put their asks on this website. If you dislike this idea please press the big X on the top-right of your browser.', 1415457392, '1', 26, 25, 0),
	(69, 'to-do list: like/dislike function & smileys.', 1415610480, '1', 28, 28, 0),
	(75, ':thnx:', 1415845423, '1', 51, 24, 0),
	(76, 'niet vergeten dat de like overal hetzelfde weer moet geven bij elk account~! ;)', 1415846952, '1', 52, 23, 0),
	(77, 'What about the Ajax infinite scroll?', 1415847026, '1', 52, 20, 0),
	(78, 'Â¡hacer no se olvidÃ³! De comment like/dislike functie, liked en disliked gelijk alle comments van diezelfde post! Dan weet je het, no? ', 1415847270, '1', 52, 24, 0),
	(79, 'Correction post edit en post comment doen het beide niet...', 1415847359, '1', 52, 19, 0),
	(82, '@captain-obvious, het is sort of opgelost nu nog een manier zin te vinden zodat hij de post niet dubbel post ;) </br>\r\n@razuri-the-sleepless, I am thinking about ignoring that one.\r\n@canciondulcedeespana and @bloodyettiquetti, both problems are solved! :D', 1415914469, '1', 52, 28, 0),
	(83, 'of what?! :D', 1416816470, '1', 55, 24, 0),
	(96, 'don\'t give up, live is meant to learn you things.', 1416818134, '1', 54, 26, 0),
	(97, 'oh bollocks.', 1416818244, '1', 51, 19, 0),
	(98, 'STUDIEFINANCERING!!!! :banana:', 1416828243, '1', 55, 46, 0),
	(99, ':brrr:', 1416828267, '1', 53, 46, 0);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


-- Structuur van  tabel wall.gebruiker wordt geschreven
CREATE TABLE IF NOT EXISTS `gebruiker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nicknaam` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `passwoord` varchar(50) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT '0',
  `groep_id` int(11) NOT NULL DEFAULT '0',
  `persoon_id` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_gebruiker_groep` (`groep_id`),
  KEY `FK_gebruiker_persoon` (`persoon_id`),
  CONSTRAINT `FK_gebruiker_groep` FOREIGN KEY (`groep_id`) REFERENCES `groep` (`id`),
  CONSTRAINT `FK_gebruiker_persoon` FOREIGN KEY (`persoon_id`) REFERENCES `persoon` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wall.gebruiker: ~10 rows (ongeveer)
DELETE FROM `gebruiker`;
/*!40000 ALTER TABLE `gebruiker` DISABLE KEYS */;
INSERT INTO `gebruiker` (`id`, `nicknaam`, `email`, `passwoord`, `status`, `groep_id`, `persoon_id`, `post_id`) VALUES
	(18, 'tomayasan', 'charlene.brion@gmail.com', '202cb962ac59075b964b07152d234b70', '1', 1, 15, 2),
	(19, 'bloodyetiquette', 'a.kirkland@ukmail.co.uk', '81dc9bdb52d04dc20036dbd8313ed055', '1', 2, 16, 0),
	(20, 'razuri-the-sleepless', 'rome_calling@live.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', 2, 17, 0),
	(23, 'captain-obvious', 'a.f.jones@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1', 2, 24, 0),
	(24, 'canciondulcedeespana ', 'a.fernandezcarriedo@live.com', '202cb962ac59075b964b07152d234b70', '1', 2, 25, 0),
	(25, 'joyfulsong', 'wusheng-hongse@live.com', '202cb962ac59075b964b07152d234b70', '1', 2, 26, 0),
	(26, 'oslusiadas', 'j.h.carriedo@gmail.com', '202cb962ac59075b964b07152d234b70', '1', 2, 27, 0),
	(28, 'brutal78', 't.vermeer@gmail.nl', '202cb962ac59075b964b07152d234b70', '1', 2, 29, 0),
	(46, 'caipirinhaboi', 'nt_brasil@live.com', '202cb962ac59075b964b07152d234b70', '1', 2, 47, 0),
	(47, 'kay', 'kay@live.com', '202cb962ac59075b964b07152d234b70', '1', 2, 48, 0);
/*!40000 ALTER TABLE `gebruiker` ENABLE KEYS */;


-- Structuur van  tabel wall.groep wordt geschreven
CREATE TABLE IF NOT EXISTS `groep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wall.groep: ~2 rows (ongeveer)
DELETE FROM `groep`;
/*!40000 ALTER TABLE `groep` DISABLE KEYS */;
INSERT INTO `groep` (`id`, `type`) VALUES
	(1, 'admin'),
	(2, 'user');
/*!40000 ALTER TABLE `groep` ENABLE KEYS */;


-- Structuur van  tabel wall.liketable wordt geschreven
CREATE TABLE IF NOT EXISTS `liketable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gebruiker_id` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `type_id` varchar(15) NOT NULL,
  `datum` int(150) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_like_gebruiker` (`gebruiker_id`),
  CONSTRAINT `FK_like_gebruiker` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wall.liketable: ~23 rows (ongeveer)
DELETE FROM `liketable`;
/*!40000 ALTER TABLE `liketable` DISABLE KEYS */;
INSERT INTO `liketable` (`id`, `gebruiker_id`, `type`, `type_id`, `datum`, `value`) VALUES
	(114, 28, 'comment', '75', 1415914850, 1),
	(115, 18, 'post', '27', 1415914883, 1),
	(117, 28, 'post', '51', 1415914915, 1),
	(122, 19, 'post', '52', 1415956291, 1),
	(124, 18, 'comment', '76', 1415957478, 1),
	(126, 28, 'comment', '28', 1415957684, 1),
	(127, 28, 'comment', '76', 1415959146, 1),
	(128, 18, 'comment', '79', 1416228504, 1),
	(129, 18, 'comment', '68', 1416560106, 1),
	(130, 18, 'comment', '75', 1416560109, 1),
	(131, 24, 'post', '55', 1416816459, 1),
	(132, 26, 'post', '55', 1416818112, 1),
	(133, 26, 'comment', '96', 1416818137, 1),
	(134, 25, 'comment', '96', 1416818176, 1),
	(135, 19, 'comment', '96', 1416818220, 1),
	(136, 18, 'comment', '65', 1416827710, 1),
	(137, 18, 'comment', '69', 1416827720, 1),
	(139, 46, 'post', '53', 1416828261, 1),
	(141, 26, 'comment', '83', 1416837196, 1),
	(142, 18, 'post', '55', 1416838240, 1),
	(143, 18, 'comment', '96', 1416838276, 1),
	(144, 18, 'comment', '83', 1416839694, 1),
	(145, 18, 'comment', '99', 1416839848, 1);
/*!40000 ALTER TABLE `liketable` ENABLE KEYS */;


-- Structuur van  tabel wall.persoon wordt geschreven
CREATE TABLE IF NOT EXISTS `persoon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(50) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `geboortedatum` varchar(50) NOT NULL,
  `geslacht` varchar(50) NOT NULL,
  `adres` varchar(50) NOT NULL,
  `postcode` varchar(50) NOT NULL,
  `woonplaats` varchar(50) NOT NULL,
  `telefoon` text NOT NULL,
  `mobiel` text NOT NULL,
  `avatar` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wall.persoon: ~11 rows (ongeveer)
DELETE FROM `persoon`;
/*!40000 ALTER TABLE `persoon` DISABLE KEYS */;
INSERT INTO `persoon` (`id`, `voornaam`, `achternaam`, `geboortedatum`, `geslacht`, `adres`, `postcode`, `woonplaats`, `telefoon`, `mobiel`, `avatar`) VALUES
	(15, 'charlÃ¨ne', 'brion', '12/18/1993', 'female', 'sperwerstraat 8', '3312tm', 'dordrecht', '0786350086', '0631004985', 'css/media/12415892.jpg'),
	(16, 'arthur', 'kirkland', '04/23/1993', 'male', 'thornhaugh street 17', 'wc1h 0xg', 'london', '02076372388', '07700900168', 'http://static.tumblr.com/za4u9o3/4Lmnen485/icon_63.bmp'),
	(17, 'romano', 'vargas', '03/17/1991', 'male', 'calle do mori  89', '30156', 'venezia', '39066864604  ', '3898310085', 'http://static.tumblr.com/za4u9o3/kKRnen49x/icon_38.bmp'),
	(24, 'alfred', 'jones', '07/04/1993', 'male', 'cherry street 695', '44143', 'jacksonville, FL', '9047212288', '13475551234', 'http://ic.pics.livejournal.com/attice/50729155/78415/original.png'),
	(25, 'antonio', 'carriedo', '02/12/1988', 'male', 'alfonso XII 18', '28014', 'madrid', '34915221920', '34609753403', 'http://static.tumblr.com/za4u9o3/eTxneyh3v/spain.png'),
	(26, 'wÃ¡ng', 'yÃ o', '04/26/1990', 'other', 'an jia lou lu', '100600', 'bejing', '1057306209', '2126011582', 'http://img.photobucket.com/albums/v390/Stormyseas/Livejournal%203/01s0211-lee_tzungtze--joyfulsong.png'),
	(27, 'joÃ£o', 'carriedo', '06/25/1991', 'male', 'avenida da liberdade 100-3', '1269-121', 'lisboa', '351216034197', '1912365478', 'http://i577.photobucket.com/albums/ss211/MusicalPantiesIcons/Stock%2009/MusicalPanties-Stock0000546.jpg'),
	(29, 'willem', 'vermeer', '04/27/1990', 'male', 'stuart makkersstraat 26', '4388 gc', 'oost-souburg', '0115947258', '0654896574', 'http://static.tumblr.com/za4u9o3/APyneyhvd/icon_15.bmp'),
	(41, 'martin', 'hernandez', '06', 'male', 'lol', 'll', '212', '1212', '1212', 'http://l-stat.livejournal.net/img/userpics/userpic-anonymous.png?v=15821'),
	(47, 'luciano', 'da silva', '09/07/1993', 'male', 'avenida atlatica 1702', 'cep 22021 001', 'rio de janeiro', '55210890086', '0654896574', 'http://33.media.tumblr.com/2d199305fd25d9553778c96e76055f86/tumblr_n9axdb5TSN1qi3b2yo1_400.jpg'),
	(48, 'kees', 'piet', '10/08/2014', 'male', 'lol', '3311', 'Dordrecht', '0632545', '0545454', 'http://l-stat.livejournal.net/img/userpics/userpic-anonymous.png?v=15821');
/*!40000 ALTER TABLE `persoon` ENABLE KEYS */;


-- Structuur van  tabel wall.post wordt geschreven
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1500) NOT NULL,
  `datum` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `gebruiker_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_gebruiker` (`gebruiker_id`),
  CONSTRAINT `gebruiker_id` FOREIGN KEY (`gebruiker_id`) REFERENCES `gebruiker` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wall.post: ~13 rows (ongeveer)
DELETE FROM `post`;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `content`, `datum`, `status`, `gebruiker_id`) VALUES
	(2, 'What is your favorite beverage with the days being so dull and grey. Mine is hot tea with honey since it makes me feel so cosy.', 1415124568, '1', 18),
	(5, 'You guys have NO idea on how bad I want it to be FRIDAY! I\'m so tired, so busy with school and working 2 jobs. All I want is some quality time with my new waifu! \r\nYes guys, you read that right. My new gaming system has finally arrived! WOOHOO!\r\n\r\nSo what is in store for all of you this weekend?', 1415124578, '1', 23),
	(23, 'To finish; Delete comment, Hide comment & edit on right positions and work on each position, Like/dislike ratio, Change the delete button position.', 1415303986, '1', 19),
	(26, 'pirates or ninjas?', 1415411496, '1', 20),
	(27, 'To do list: Like/dislike ratio, user/comment/post management (admin)', 1415491844, '1', 25),
	(28, 'to-do list; like/dislike function, security, smileys\r\n', 1415557454, '1', 28),
	(51, 'just testing some emoticons! :duck:', 1415844529, '1', 18),
	(52, 'Bijna alle functies erin verwerkt :duck:<br><br> \r\n\r\n<b>Nog te doen:</b> comment op comment mogelijk maken<br> <b>Opgelost:</b> post/comment edit, image uploaden & like/unlike functie<br><b>Navragen:</b> Ajax infinite scroll<br>', 1415845509, '1', 26),
	(53, ':handkiss:', 1415970135, '1', 25),
	(54, 'kunnen we nu al naar huis? want ik heb totaal geen zin meer.', 1416564154, '1', 18),
	(55, 'today is the day!', 1416816447, '1', 19),
	(56, 'oh my', 1416816926, '0', 24),
	(57, 'lol', 1416817164, '0', 24);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
