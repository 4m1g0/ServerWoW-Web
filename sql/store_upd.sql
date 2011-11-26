-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 13 2011 г., 23:19
-- Версия сервера: 5.1.40
-- Версия PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `wow_cs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `wow_store_items`
--

CREATE TABLE IF NOT EXISTS `wow_store_items` (
  `item_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `in_store` smallint(1) NOT NULL DEFAULT '1',
  `service_type` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wow_store_items`
--

INSERT INTO `wow_store_items` (`item_id`, `cat_id`, `title`, `description`, `tags`, `price`, `in_store`, `service_type`) VALUES
(32458, 8, '', '', '', 650, 1, 0),
(999000, 9, '', '', '', 5, 1, 1),
(999001, 9, '', '', '', 5, 1, 2),
(999002, 9, '', '', '', 5, 1, 3),
(999003, 9, '', '', '', 5, 1, 4);