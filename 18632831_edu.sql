-- phpMyAdmin SQL Dump
-- version home.pl
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 31, 2016 at 04:18 PM
-- Server version: 5.5.44-37.3-log
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `18632831_edu`
--

-- --------------------------------------------------------

--
-- Table structure for table `carer`
--

CREATE TABLE IF NOT EXISTS `carer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `carer_username` varchar(45) CHARACTER SET latin2 NOT NULL,
  `carer_password` varchar(45) CHARACTER SET latin2 NOT NULL,
  `carer_full_name` varchar(100) CHARACTER SET latin2 NOT NULL,
  `carer_online_test` bigint(30) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `phone_number` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `carer`
--

INSERT INTO `carer` (`ID`, `carer_username`, `carer_password`, `carer_full_name`, `carer_online_test`, `image`, `phone_number`) VALUES
(8, 'hswie@hswie.com', '394623d3491514d47f1279a4d0ef0068741e3017', 'Hubert Świecioch', 1454189436, 'http://serwer1552055.home.pl/EduCare/images/carersImages/hubert.jpg', '694951892'),
(9, 'domi@domi.com', '3d127af6c24e8da28663c85ee7b15156dbed50ee', 'Dominika', 1450208834, 'http://serwer1552055.home.pl/EduCare/images/carersImages/dominika.jpg', '697963782'),
(30, 'test@test.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Adam Kowalik', 1447020591, 'http://serwer1552055.home.pl/EduCare/images/carersImages/121d5667-b451-49cd-a2bc-40d76a9ddc1b', '694951892'),
(36, 'opiekun@opiekun.pl', '6f6a8b95a4b74228cd6c816673254c46a49a71e8', 'Zygmunt Krakowski', 1450383105, 'http://serwer1552055.home.pl/EduCare/images/carersImages/a5d33f70-6712-4015-b673-bfcd24032519', '694951892'),
(37, 'testowy@testowy.pl', '6f6a8b95a4b74228cd6c816673254c46a49a71e8', 'Krystian Pawłowski', 1453135168, 'http://serwer1552055.home.pl/EduCare/images/carersImages/35efb178-afa2-4678-bf7f-c35bebc1514a-562566074.jpg', '694951892');

-- --------------------------------------------------------

--
-- Table structure for table `carer_message`
--

CREATE TABLE IF NOT EXISTS `carer_message` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(250) CHARACTER SET latin2 NOT NULL,
  `send_date` varchar(45) CHARACTER SET latin2 NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `sender_ID` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin2 NOT NULL,
  `target_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_carer_message_carer` (`target_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `carer_message`
--

INSERT INTO `carer_message` (`ID`, `content`, `send_date`, `is_read`, `sender_ID`, `title`, `target_ID`) VALUES
(1, 'Witam', '1448208827', 1, 9, 'Powitanie', 8),
(4, 'Witam, co u ciebie ?', '1449336690', 1, 8, 'Cześć', 9),
(5, 'Co tam u ciebie Hubert?', '1449336758', 1, 9, 'Pytanie', 8),
(9, 'Dzisiaj spotkanie zarządu', '1453129869', 1, 37, 'Informacja', 8),
(10, 'Wiadomość powitalna', '1453128487', 1, 8, 'Pilne', 37);

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `family_username` varchar(45) CHARACTER SET latin2 NOT NULL,
  `family_password` varchar(45) CHARACTER SET latin2 NOT NULL,
  `family_full_name` varchar(45) CHARACTER SET latin2 NOT NULL,
  `resident_ID` int(11) NOT NULL,
  `phone_number` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_family_resident_idx` (`resident_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`ID`, `family_username`, `family_password`, `family_full_name`, `resident_ID`, `phone_number`) VALUES
(3, 'family@family.com', 'ec5fc916f5e002027e902b68f13d7c2053445539', 'family2', 2, '666 666 668'),
(4, 'family@family.com', 'ec5fc916f5e002027e902b68f13d7c2053445539', 'family3', 1, '666 666 667'),
(7, 'family@family.com', 'ec5fc916f5e002027e902b68f13d7c2053445539', 'family6', 1, '666 666 667'),
(11, 'testowa@rodzina.pl', '6f6a8b95a4b74228cd6c816673254c46a49a71e8', 'Rodzina Testowa', 1, '123 456 789');

-- --------------------------------------------------------

--
-- Table structure for table `prescribed_medicines`
--

CREATE TABLE IF NOT EXISTS `prescribed_medicines` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET latin2 DEFAULT NULL,
  `dose` varchar(45) CHARACTER SET latin2 NOT NULL,
  `resident_ID` int(11) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `carer_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_prescribed_medicines_resident1_idx` (`resident_ID`),
  KEY `fk_prescribed_medicines_carer1_idx` (`carer_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `prescribed_medicines`
--

INSERT INTO `prescribed_medicines` (`ID`, `name`, `dose`, `resident_ID`, `start_date`, `end_date`, `carer_ID`) VALUES
(2, 'Apap', '5 tabletek', 1, '1449181235', '1449440435', 8),
(33, 'Ibuprom', '5 razy dziennie po 2 tabletki', 1, '1451301690', '1451560890', 8),
(34, 'Amlozek', 'dwie tabletki', 4, '1452168186', '1454241786', 37),
(35, 'Aspiryna', '2 pigułki', 1, '1454340308', '1456759508', 8);

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE IF NOT EXISTS `resident` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) CHARACTER SET latin2 NOT NULL,
  `last_name` varchar(45) CHARACTER SET latin2 NOT NULL,
  `date_of_adoption` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `birth_date` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`ID`, `first_name`, `last_name`, `date_of_adoption`, `birth_date`, `address`, `city`, `image`) VALUES
(1, 'Marian', 'Leszcz', '2014-07-25', '1956-09-13', 'Rejtana 11', 'Koszalin', 'http://serwer1552055.home.pl/EduCare/images/residentsImages/marian.jpg'),
(2, 'Henryk', 'Wegorz', '2015-06-18', '1969-07-12', 'Rejtana 13', 'Slupsk', 'http://serwer1552055.home.pl/EduCare/images/residentsImages/henryk.jpg'),
(4, 'Remigiusz', 'Bak', '2015-06-18', '1969-07-12', 'Rejtana 13', 'Slupsk', 'http://serwer1552055.home.pl/EduCare/images/residentsImages/4.jpg'),
(5, 'Janusz', 'Nowak', '2015-06-18', '1969-07-12', 'Rejtana 13', 'Slupsk', 'http://serwer1552055.home.pl/EduCare/images/residentsImages/5.jpg'),
(6, 'Hilga', 'Burak', '2015-06-18', '1969-07-12', 'Rejtana 13', 'Slupsk', 'http://serwer1552055.home.pl/EduCare/images/residentsImages/6.jpg'),
(7, 'Waclaw', 'Korzen', '2015-06-18', '1969-07-12', 'Rejtana 13', 'Slupsk', 'http://serwer1552055.home.pl/EduCare/images/residentsImages/7.jpg'),
(8, 'Jacek', 'Placek', '2015-06-18', '1969-07-12', 'Rejtana 13', 'Slupsk', 'http://serwer1552055.home.pl/EduCare/images/residentsImages/8.png'),
(9, 'Helena', 'But', '2015-06-18', '1969-07-12', 'Rejtana 13', 'Slupsk', 'http://serwer1552055.home.pl/EduCare/images/residentsImages/3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) CHARACTER SET latin2 NOT NULL,
  `date` varchar(45) CHARACTER SET latin2 NOT NULL,
  `resident_ID` int(11) NOT NULL,
  `carer_ID` int(11) NOT NULL,
  `header` varchar(255) CHARACTER SET latin2 NOT NULL,
  `is_done` varchar(1) CHARACTER SET latin2 DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `fk_task_resident1_idx` (`resident_ID`),
  KEY `fk_task_carer1_idx` (`carer_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`ID`, `description`, `date`, `resident_ID`, `carer_ID`, `header`, `is_done`) VALUES
(28, 'dokladnie', '1453394099', 1, 8, 'umyc pacjenta', '0'),
(29, 'do kosza', '1454171759', 2, 8, 'wyrzucic smieci', '0'),
(30, 'na blysk', '1455208622', 1, 37, 'wyczyscic pokoj', '0'),
(31, 'Kolor zielony', '1452964772', 1, 8, 'Wymiana poscieli', '0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carer_message`
--
ALTER TABLE `carer_message`
  ADD CONSTRAINT `fk_carermessage` FOREIGN KEY (`target_ID`) REFERENCES `carer` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kjh` FOREIGN KEY (`target_ID`) REFERENCES `carer` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `fk_family_resident` FOREIGN KEY (`resident_ID`) REFERENCES `resident` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prescribed_medicines`
--
ALTER TABLE `prescribed_medicines`
  ADD CONSTRAINT `fk_prescribed_medicines_carer1` FOREIGN KEY (`carer_ID`) REFERENCES `carer` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prescribed_medicines_resident1` FOREIGN KEY (`resident_ID`) REFERENCES `resident` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_task_carer` FOREIGN KEY (`carer_ID`) REFERENCES `carer` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_resident` FOREIGN KEY (`resident_ID`) REFERENCES `resident` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
