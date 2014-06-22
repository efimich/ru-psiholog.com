-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 22 2014 г., 13:56
-- Версия сервера: 5.0.51
-- Версия PHP: 5.2.6-1+lenny16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ru_psiholog_testdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) default NULL,
  `q_num` varchar(255) default NULL,
  `good` int(11) default '0',
  `bad` int(11) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`,`q_num`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=0 ;
