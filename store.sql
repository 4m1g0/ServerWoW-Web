-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Окт 27 2011 г., 15:49
-- Версия сервера: 5.1.40
-- Версия PHP: 5.3.3
-- 
-- БД: `wow_cs`
-- 

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_store_cart`
-- 

DROP TABLE IF EXISTS `wow_store_cart`;
CREATE TABLE `wow_store_cart` (
  `id` int(11) NOT NULL,
  `last_save` int(11) NOT NULL,
  `items` text NOT NULL,
  `xstoken` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Дамп данных таблицы `wow_store_cart`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_store_categories`
-- 

DROP TABLE IF EXISTS `wow_store_categories`;
CREATE TABLE `wow_store_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '-1',
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `visibleTo` int(11) DEFAULT '0',
  `items_count` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Дамп данных таблицы `wow_store_categories`
-- 

INSERT INTO `wow_store_categories` VALUES (1, -1, 'Items', 'Browse and buy WoW Items!', 0, NULL);
INSERT INTO `wow_store_categories` VALUES (2, -1, 'Mounts', 'Browse and buy WoW mounts!', 0, NULL);
INSERT INTO `wow_store_categories` VALUES (3, 1, 'Armor Sets', NULL, 0, 0);
INSERT INTO `wow_store_categories` VALUES (4, 1, 'Weapons', NULL, 0, 0);
INSERT INTO `wow_store_categories` VALUES (5, 3, 'PvE Tier 10', NULL, 0, 0);
INSERT INTO `wow_store_categories` VALUES (6, 3, 'PvP Tier 8', NULL, 0, 0);
INSERT INTO `wow_store_categories` VALUES (7, 5, 'Priest (Shadow) 277', 'PvE Tier 10 SPriest Itemset (iLvl 277)', 0, 0);
INSERT INTO `wow_store_categories` VALUES (8, 7, 'Hands', NULL, 0, 0);
INSERT INTO `wow_store_categories` VALUES (9, 6, 'Paladin (Retri) 277', 'PvP Tier 8 RPala Itemset (iLvl 277)', 0, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_store_items`
-- 

DROP TABLE IF EXISTS `wow_store_items`;
CREATE TABLE `wow_store_items` (
  `item_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `in_store` smallint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Дамп данных таблицы `wow_store_items`
-- 

INSERT INTO `wow_store_items` VALUES (51256, 8, '', '', 'pve tier10 shadowpriest priest spriest caster', 500, 1);
INSERT INTO `wow_store_items` VALUES (51260, 8, '', '', 'pve tier10 holypriest disciplinepriest priest hpriest dpriest healer', 0, 1);
        