-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Фев 20 2007 г., 22:44
-- Версия сервера: 5.0.18
-- Версия PHP: 5.2.0
-- 
-- БД: `tyres`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `disk_models`
-- 

CREATE TABLE `disk_models` (
  `id` int(11) NOT NULL auto_increment,
  `model` varchar(255) default NULL,
  `manufacturer` int(11) NOT NULL,
  `material` enum('solid','forged','pressed') NOT NULL default 'solid',
  `image` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `model` (`model`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Дамп данных таблицы `disk_models`
-- 

INSERT INTO `disk_models` VALUES (1, 'HGFT7', 1, 'solid', '');
INSERT INTO `disk_models` VALUES (3, 'ABCDX', 1, 'forged', '10icq.png');

-- --------------------------------------------------------

-- 
-- Структура таблицы `disks`
-- 

CREATE TABLE `disks` (
  `id` int(11) NOT NULL auto_increment,
  `model` int(11) NOT NULL,
  `width` float NOT NULL,
  `radius` tinyint(4) NOT NULL,
  `holes` tinyint(4) NOT NULL,
  `distance` smallint(6) NOT NULL,
  `e` smallint(6) NOT NULL,
  `diameter` float NOT NULL,
  `price` float NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `model` (`model`,`width`,`radius`,`holes`,`distance`,`e`,`diameter`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='List of disks';

-- 
-- Дамп данных таблицы `disks`
-- 

INSERT INTO `disks` VALUES (4, 3, 2, 3, 2, 2, 2, 2, 2);
INSERT INTO `disks` VALUES (3, 1, 1, 22, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `manufacturers`
-- 

CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='Manufacturers of disks and tyres';

-- 
-- Дамп данных таблицы `manufacturers`
-- 

INSERT INTO `manufacturers` VALUES (1, 'Bridgestone', 'dsrukytduktul');
INSERT INTO `manufacturers` VALUES (2, 'tuktuk', '2');

-- --------------------------------------------------------

-- 
-- Структура таблицы `tyre_models`
-- 

CREATE TABLE `tyre_models` (
  `id` int(11) NOT NULL auto_increment,
  `model` varchar(255) default NULL,
  `manufacturer` int(11) NOT NULL,
  `description` text,
  `season` enum('summer','winter','spiked') NOT NULL default 'summer',
  `image` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `model` (`model`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Дамп данных таблицы `tyre_models`
-- 

INSERT INTO `tyre_models` VALUES (2, 'MBVH1', 1, 'wel;jrhgjln wejrhgkewhg kljwelrhghewr gljhwerljhgj', 'summer', 'avatar.gif');
INSERT INTO `tyre_models` VALUES (4, 'dhk', 1, 'tuktuk', 'spiked', '1.gif');
INSERT INTO `tyre_models` VALUES (5, '345', 1, '&lt;b&gt;ПРЕВЕД!!!!!!&lt;/b&gt;', 'winter', '403.jpg');

-- --------------------------------------------------------

-- 
-- Структура таблицы `tyres`
-- 

CREATE TABLE `tyres` (
  `id` int(11) NOT NULL auto_increment,
  `model` int(11) NOT NULL,
  `width` smallint(6) NOT NULL,
  `height` smallint(6) NOT NULL,
  `radius` tinyint(4) NOT NULL,
  `load` smallint(6) NOT NULL,
  `speed` char(1) NOT NULL,
  `price` float NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `model` (`model`,`width`,`height`,`radius`,`load`,`speed`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 COMMENT='List of tyres';

-- 
-- Дамп данных таблицы `tyres`
-- 

INSERT INTO `tyres` VALUES (9, 2, 165, 24, 15, 356, 'T', 3);
INSERT INTO `tyres` VALUES (2, 2, 168, 24, 15, 356, 'E', 13450);
INSERT INTO `tyres` VALUES (3, 2, 178, 19, 20, 134, 'J', 1345.87);
INSERT INTO `tyres` VALUES (4, 2, 166, 24, 15, 356, 'T', 1);
INSERT INTO `tyres` VALUES (10, 2, 167, 24, 15, 356, 'T', 8);
INSERT INTO `tyres` VALUES (11, 2, 168, 24, 15, 356, 'T', 1);
INSERT INTO `tyres` VALUES (12, 2, 256, 24, 15, 356, 'T', 4);
INSERT INTO `tyres` VALUES (13, 2, 356, 24, 15, 356, 'T', 5);
INSERT INTO `tyres` VALUES (14, 2, 365, 24, 15, 356, 'T', 6);
INSERT INTO `tyres` VALUES (15, 2, 568, 24, 15, 356, 'E', 7);
INSERT INTO `tyres` VALUES (16, 2, 56, 24, 15, 356, 'T', 9);
INSERT INTO `tyres` VALUES (17, 2, 46, 24, 15, 5, 'T', 10);
INSERT INTO `tyres` VALUES (18, 2, 3, 3, 56, 356, 'T', 11);
INSERT INTO `tyres` VALUES (19, 2, 5, 3, 3, 356, 'T', 12);
INSERT INTO `tyres` VALUES (20, 2, 6, 24, 56, 6, 'T', 13);
INSERT INTO `tyres` VALUES (21, 2, 3, 56, 15, 356, 'T', 14);
INSERT INTO `tyres` VALUES (22, 2, 67, 24, 15, 356, 'T', 8);
INSERT INTO `tyres` VALUES (23, 4, 34, 34, 56, 345, '3', 456);
INSERT INTO `tyres` VALUES (24, 4, 90, 90, 90, 90, '9', 90);
        