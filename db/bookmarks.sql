-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране:  април 2009 в 01:09
-- Версия на сървъра: 5.1.30
-- Версия на PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `bookmarks`
--

-- --------------------------------------------------------

--
-- Структура на таблица `b_categories`
--

CREATE TABLE IF NOT EXISTS `b_categories` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(255) DEFAULT NULL,
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Дъмп (схема) на данните в таблицата `b_categories`
--

INSERT INTO `b_categories` (`catid`, `catname`) VALUES
(1, 'tutorials'),
(2, 'personals'),
(3, 'Êíèãè');

-- --------------------------------------------------------

--
-- Структура на таблица `b_sites`
--

CREATE TABLE IF NOT EXISTS `b_sites` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `b_url` varchar(255) DEFAULT NULL,
  `b_title` varchar(255) DEFAULT NULL,
  `b_desc` varchar(255) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  KEY `bid` (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Дъмп (схема) на данните в таблицата `b_sites`
--

INSERT INTO `b_sites` (`bid`, `b_url`, `b_title`, `b_desc`, `catid`, `userid`) VALUES
(1, 'http://abv.bg', 'ABV', 'abv-to', 2, 1),
(2, 'http://mihail.gnetbg.net', 'razpisnika na misho', 'bloga na misho', 2, 1),
(3, 'http://iliyan.gnetbg.net', 'Iliyan blog', 'bloga na iliyan', 1, 1),
(4, 'http://ssi-bg.com', 'firmen sait', 'saita na firmata', 1, 1),
(5, 'http://www.actionscript.org/resources/articles/139/1/Vote-system-flash-phpmySQL/Page1.html', 'flash vote system', 'flash-php-mysql vote system', 1, NULL),
(6, 'http://scribd.com', 'Ïîðòàë çà êíèãè', 'ïîðòàë çà êíèãè', 3, NULL),
(7, 'test', 'test', 'test', 1, NULL);

-- --------------------------------------------------------

--
-- Структура на таблица `b_ugroups`
--

CREATE TABLE IF NOT EXISTS `b_ugroups` (
  `ug_id` int(11) NOT NULL AUTO_INCREMENT,
  `ug_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ug_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Дъмп (схема) на данните в таблицата `b_ugroups`
--


-- --------------------------------------------------------

--
-- Структура на таблица `b_users`
--

CREATE TABLE IF NOT EXISTS `b_users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `u_nick` varchar(11) DEFAULT NULL,
  `u_names` varchar(30) DEFAULT NULL,
  `u_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Дъмп (схема) на данните в таблицата `b_users`
--

INSERT INTO `b_users` (`userid`, `u_nick`, `u_names`, `u_password`) VALUES
(1, 'misho', 'ÐœÐ¸Ñ…Ð°Ð¸Ð» Ð“Ð°Ð±ÐµÑ€Ð¾Ð²', 'b92aabdd662b588246d090d59fbc6220'),
(2, 'iliyan', 'Ð˜Ð»Ð¸ÑÐ½ Ð‘ÐµÑ‚Ð¾Ð²ÑÐºÐ¸', '81dc9bdb52d04dc20036dbd8313ed055');
