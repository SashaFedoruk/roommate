SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `house` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `city_id` varchar(64) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  `num_rooms` int(11) DEFAULT NULL,
  `n_floor` int(11) DEFAULT NULL,
  `area` float DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `desc` varchar(712) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `image` text NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `type_id` (`type_id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `house_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `house_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT NULL,
  `for_id` int(11) NOT NULL,
  `message` varchar(750) NOT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from_id` (`from_id`),
  KEY `whom_id` (`for_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

CREATE TABLE IF NOT EXISTS `questionaire_of_roommate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `city_id` varchar(64) DEFAULT NULL,
  `city_name` varchar(64) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `nationality` varchar(64) DEFAULT NULL,
  `cigarette_addiction` varchar(10) DEFAULT NULL,
  `alcohol_addiction` varchar(10) DEFAULT NULL,
  `availability_of_house` varchar(10) DEFAULT NULL,
  `price_of_house_min` int(11) DEFAULT NULL,
  `price_of_house_max` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `type_id` (`type_id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `auth_key` varchar(256) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `city_id` varchar(64) DEFAULT NULL,
  `city_name` varchar(64) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `other_contacts` varchar(128) DEFAULT NULL,
  `availability_of_house` tinyint(1) DEFAULT NULL,
  `house_id` int(11) DEFAULT NULL,
  `nationality` varchar(64) DEFAULT NULL,
  `ideology` varchar(64) DEFAULT NULL,
  `cigarette_addiction` varchar(10) DEFAULT NULL,
  `alcohol_addiction` varchar(10) DEFAULT NULL,
  `desc` varchar(712) DEFAULT NULL,
  `image` varchar(256) NOT NULL,
  `search_in` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `house_id` (`house_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


ALTER TABLE `house`
  ADD CONSTRAINT `house_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `house_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `house_type` (`id`),
  ADD CONSTRAINT `house_ibfk_3` FOREIGN KEY (`state_id`) REFERENCES `house_state` (`id`);

ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`for_id`) REFERENCES `user` (`id`);

ALTER TABLE `questionaire_of_roommate`
  ADD CONSTRAINT `questionaire_of_roommate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `questionaire_of_roommate_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `house_type` (`id`),
  ADD CONSTRAINT `questionaire_of_roommate_ibfk_3` FOREIGN KEY (`state_id`) REFERENCES `house_state` (`id`);

ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_info_ibfk_2` FOREIGN KEY (`house_id`) REFERENCES `house` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
