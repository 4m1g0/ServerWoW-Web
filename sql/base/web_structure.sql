-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-04-2012 a las 09:37:01
-- Versión del servidor: 5.1.61
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `s3rv3rww_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL DEFAULT '0',
  `read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `direction` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`),
  KEY `direction` (`direction`),
  KEY `read` (`read`),
  KEY `sent` (`sent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1640 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_announcements`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `announcement` text NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `to` int(10) NOT NULL,
  `integer` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `time` (`time`),
  KEY `to_id` (`to`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_apehistory`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_apehistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `channel` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `channel` (`channel`),
  KEY `sent` (`sent`),
  KEY `channel_sent` (`channel`,`sent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_block`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_block` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fromid` int(10) unsigned NOT NULL,
  `toid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`),
  KEY `fromid_toid` (`fromid`,`toid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_chatroommessages`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 03-04-2012 a las 04:47:45
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_chatroommessages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `chatroomid` (`chatroomid`),
  KEY `sent` (`sent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26986 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_chatrooms`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 03-04-2012 a las 04:47:45
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_chatrooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  `createdby` int(10) unsigned NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `vidsession` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lastactivity` (`lastactivity`),
  KEY `createdby` (`createdby`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_chatrooms_users`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 03-04-2012 a las 05:36:59
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_chatrooms_users` (
  `userid` int(10) unsigned NOT NULL,
  `chatroomid` int(10) unsigned NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`userid`,`chatroomid`) USING BTREE,
  KEY `chatroomid` (`chatroomid`),
  KEY `lastactivity` (`lastactivity`),
  KEY `userid` (`userid`),
  KEY `userid_chatroomid` (`chatroomid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_guests`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_guests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `lastactivity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lastactivity` (`lastactivity`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10000050 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_messages_old`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_messages_old` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `sent` int(10) unsigned NOT NULL DEFAULT '0',
  `read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `direction` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`),
  KEY `direction` (`direction`),
  KEY `read` (`read`),
  KEY `sent` (`sent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_status`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 03-04-2012 a las 05:36:30
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_status` (
  `userid` int(10) unsigned NOT NULL,
  `message` text,
  `status` enum('available','away','busy','invisible','offline') DEFAULT NULL,
  `typingto` int(10) unsigned DEFAULT NULL,
  `typingtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `typingto` (`typingto`),
  KEY `typingtime` (`typingtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cometchat_videochatsessions`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `cometchat_videochatsessions` (
  `username` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `timestamp` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`username`),
  KEY `username` (`username`),
  KEY `identity` (`identity`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contents`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `locale` varchar(4) NOT NULL,
  `editInfo` text NOT NULL,
  `access` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_accounts`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 01-04-2012 a las 18:33:21
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_accounts` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `access_level` int(11) NOT NULL,
  `forums_name` varchar(64) NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `game_id` (`game_id`),
  KEY `id_2` (`id`),
  KEY `game_id_2` (`game_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_achievement`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_achievement` (
  `id` int(11) NOT NULL,
  `factionFlag` int(11) NOT NULL,
  `parentAchievement` int(11) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  `description_de` text,
  `description_en` text,
  `description_es` text,
  `description_fr` text,
  `description_ru` text,
  `categoryId` smallint(6) NOT NULL,
  `points` smallint(2) NOT NULL,
  `OrderInCategory` smallint(6) NOT NULL,
  `flags` mediumint(9) NOT NULL,
  `iconID` int(11) NOT NULL,
  `iconname` varchar(150) NOT NULL,
  `titleReward_de` text,
  `titleReward_en` text,
  `titleReward_es` text,
  `titleReward_fr` text,
  `titleReward_ru` text,
  `dungeonDifficulty` smallint(1) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Achievements table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_achievement_category`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_achievement_category` (
  `id` int(11) NOT NULL,
  `parentCategory` int(11) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`parentCategory`),
  KEY `id_2` (`id`,`parentCategory`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Achievement category table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_achievement_criteria`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_achievement_criteria` (
  `id` int(11) NOT NULL,
  `referredAchievement` int(11) NOT NULL,
  `requiredType` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `additional_type_1` int(11) NOT NULL,
  `additional_value_1` int(11) NOT NULL,
  `additional_type_2` int(11) NOT NULL,
  `additional_value_2` int(11) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_fr` text,
  `name_ru` text,
  `name_es` text NOT NULL,
  `completionFlag` int(11) NOT NULL,
  `groupFlag` int(11) NOT NULL,
  `unk1` int(11) NOT NULL,
  `timeLimit` int(11) NOT NULL,
  `showOrder` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`referredAchievement`),
  KEY `id_2` (`id`,`referredAchievement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Achievement criterias table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_areas`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_areas` (
  `id` int(11) NOT NULL DEFAULT '0',
  `mapID` int(11) NOT NULL DEFAULT '0',
  `zoneID` int(11) NOT NULL DEFAULT '0',
  `exploreFlag` int(11) NOT NULL DEFAULT '0',
  `flags` int(11) NOT NULL DEFAULT '0',
  `m_SoundProviderPref` int(11) NOT NULL DEFAULT '0',
  `m_SoundProviderPrefUnderwater` int(11) NOT NULL DEFAULT '0',
  `m_AmbienceID` int(11) NOT NULL DEFAULT '0',
  `m_ZoneMusic` int(11) NOT NULL DEFAULT '0',
  `m_IntroSound` int(11) NOT NULL DEFAULT '0',
  `area_level` int(11) NOT NULL DEFAULT '0',
  `name_en` text NOT NULL,
  `name_fr` text NOT NULL,
  `name_de` text NOT NULL,
  `name_es` text NOT NULL,
  `name_ru` text NOT NULL,
  `stringFlags` int(11) NOT NULL DEFAULT '0',
  `team` int(11) NOT NULL DEFAULT '0',
  `liquidTypeID_1` int(11) NOT NULL DEFAULT '0',
  `liquidTypeID_2` int(11) NOT NULL DEFAULT '0',
  `liquidTypeID_3` int(11) NOT NULL DEFAULT '0',
  `liquidTypeID_4` int(11) NOT NULL DEFAULT '0',
  `minElevation` int(11) NOT NULL DEFAULT '0',
  `ambientMultiplier` int(11) NOT NULL DEFAULT '0',
  `lightID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`mapID`,`zoneID`),
  KEY `id_2` (`id`,`mapID`,`zoneID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Export of AreaTable.dbc';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_blizztracker_posts`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_blizztracker_posts` (
  `tracker_post_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tracker_post_id`),
  KEY `tracker_post_id` (`tracker_post_id`),
  KEY `tracker_post_id_2` (`tracker_post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_blog_comments`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 02-04-2012 a las 15:15:42
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  `character_guid` int(11) DEFAULT NULL,
  `realm_id` int(11) NOT NULL,
  `postdate` int(11) DEFAULT NULL,
  `comment_text` text CHARACTER SET utf8,
  `answer_to` int(11) NOT NULL,
  `blizzard` smallint(1) NOT NULL,
  `mvp` smallint(1) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_id` (`comment_id`,`blog_id`),
  KEY `comment_id_2` (`comment_id`,`blog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=752 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_bosses_abilities`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_bosses_abilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boss_id` int(11) NOT NULL,
  `name_de` text,
  `name_en` text NOT NULL,
  `name_es` text NOT NULL,
  `name_fr` text NOT NULL,
  `name_ru` text NOT NULL,
  `description_de` text NOT NULL,
  `description_en` text NOT NULL,
  `description_es` text NOT NULL,
  `description_fr` text NOT NULL,
  `description_ru` text NOT NULL,
  `icon` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`boss_id`),
  KEY `id_2` (`id`,`boss_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_bugtracker_comments`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 03-04-2012 a las 03:34:23
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_bugtracker_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `character_guid` int(11) NOT NULL,
  `character_realm` int(11) NOT NULL,
  `post_date` int(11) NOT NULL,
  `comment` text NOT NULL,
  `blizzard` smallint(1) NOT NULL,
  `mvp` smallint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `report_id` (`report_id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=775 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_bugtracker_items`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 03-04-2012 a las 05:16:16
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_bugtracker_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `account_id` int(11) NOT NULL,
  `character_realm` int(11) NOT NULL,
  `character_guid` int(11) NOT NULL,
  `post_date` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `description` text NOT NULL,
  `closed` int(11) NOT NULL,
  `admin_response` text NOT NULL,
  `admin_id` int(11) NOT NULL,
  `response_date` int(11) NOT NULL,
  `close_date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `id` (`id`),
  KEY `type_2` (`type`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1065 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_carousel`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_position` int(11) NOT NULL,
  `image` text NOT NULL,
  `title_de` text NOT NULL,
  `title_en` text NOT NULL,
  `title_es` text NOT NULL,
  `title_fr` text NOT NULL,
  `title_ru` text NOT NULL,
  `desc_de` text NOT NULL,
  `desc_en` text NOT NULL,
  `desc_es` text NOT NULL,
  `desc_fr` text NOT NULL,
  `desc_ru` text NOT NULL,
  `url` text NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_changelog`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 03-04-2012 a las 04:11:15
--

CREATE TABLE IF NOT EXISTS `wow_changelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `revid` varchar(255) NOT NULL,
  `fixid` varchar(255) NOT NULL,
  `commiter` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `post_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_classes`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_classes` (
  `id` int(11) NOT NULL,
  `key` varchar(20) NOT NULL,
  `story_en` text NOT NULL,
  `story_ru` text NOT NULL,
  `story_es` text NOT NULL,
  `info_en` text NOT NULL,
  `info_ru` text NOT NULL,
  `info_es` text NOT NULL,
  `desc_en` text NOT NULL,
  `desc_ru` text NOT NULL,
  `desc_es` text NOT NULL,
  `talents_en` text NOT NULL,
  `talents_ru` text NOT NULL,
  `talents_es` text NOT NULL,
  `races_flag` int(11) NOT NULL,
  `roles_flag` int(11) NOT NULL,
  `powers_flag` int(11) NOT NULL,
  `armors_flag` int(11) NOT NULL,
  `weapons_flag` int(11) NOT NULL,
  `expansion` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `key_2` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_class_abilities`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_class_abilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` int(11) NOT NULL,
  `title_de` text NOT NULL,
  `title_en` text NOT NULL,
  `title_es` text NOT NULL,
  `title_fr` text NOT NULL,
  `title_ru` text NOT NULL,
  `text_de` text NOT NULL,
  `text_en` text NOT NULL,
  `text_es` text NOT NULL,
  `text_fr` text NOT NULL,
  `text_ru` text NOT NULL,
  `icon` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class` (`class`),
  KEY `class_2` (`class`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_db_version`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_db_version` (
  `version` int(11) NOT NULL DEFAULT '0',
  `prev_name` varchar(255) NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='DB version controller';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_enchantment`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_enchantment` (
  `id` int(11) NOT NULL,
  `text_de` text NOT NULL,
  `text_en` text NOT NULL,
  `text_es` text NOT NULL,
  `text_fr` text NOT NULL,
  `text_ru` text NOT NULL,
  `gem` int(11) NOT NULL,
  `type_1` smallint(6) NOT NULL,
  `type_2` smallint(6) NOT NULL,
  `type_3` smallint(6) NOT NULL,
  `spellid_1` int(11) NOT NULL,
  `spellid_2` int(11) NOT NULL,
  `spellid_3` int(11) NOT NULL,
  `amount_1` int(11) NOT NULL,
  `amount_2` int(11) NOT NULL,
  `amount_3` int(11) NOT NULL,
  `condition` int(11) NOT NULL,
  `aura_id` int(11) NOT NULL,
  `slot` int(11) NOT NULL,
  `gemicon` text NOT NULL,
  `gemcolor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Enchantments table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_extended_cost`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_extended_cost` (
  `id` int(11) NOT NULL,
  `honorPoints` int(11) DEFAULT NULL,
  `arenaPoints` int(11) DEFAULT NULL,
  `item1` int(11) NOT NULL,
  `item2` int(11) NOT NULL,
  `item3` int(11) NOT NULL,
  `item4` int(11) NOT NULL,
  `item5` int(11) NOT NULL,
  `item1count` int(11) NOT NULL,
  `item2count` int(11) NOT NULL,
  `item3count` int(11) NOT NULL,
  `item4count` int(11) NOT NULL,
  `item5count` int(11) NOT NULL,
  `personalRating` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_faction`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_faction` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  `description_de` text,
  `description_en` text,
  `description_es` text,
  `description_fr` text,
  `description_ru` text,
  `friendlyTo` smallint(1) NOT NULL,
  `hasRewards` smallint(1) NOT NULL,
  `key` varchar(100) NOT NULL,
  `expansion` smallint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_factions`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_factions` (
  `key` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `intro_es` text NOT NULL,
  `desc_es` text NOT NULL,
  `faction` int(11) NOT NULL,
  `leader_es` text NOT NULL,
  `intendant_es` text NOT NULL,
  `location_es` text NOT NULL,
  `leader_id` int(11) NOT NULL,
  `intendant_id` int(11) NOT NULL,
  `expansion` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_faction_npcs`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_faction_npcs` (
  `faction_id` int(11) NOT NULL,
  `npc_id` int(11) NOT NULL,
  `npc_key` varchar(255) NOT NULL,
  `npc_name` text NOT NULL,
  PRIMARY KEY (`faction_id`,`npc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_faction_template`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_faction_template` (
  `factiontemplateID` smallint(4) unsigned NOT NULL,
  `factionID` smallint(4) NOT NULL,
  `A` smallint(1) NOT NULL COMMENT 'Aliance: -1 - hostile, 1 - friendly, 0 - neutral',
  `H` smallint(1) NOT NULL COMMENT 'Horde: -1 - hostile, 1 - friendly, 0 - neutral',
  PRIMARY KEY (`factiontemplateID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_forum_category`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 28-03-2012 a las 15:50:27
-- Última revisión: 28-03-2012 a las 15:50:27
--

CREATE TABLE IF NOT EXISTS `wow_forum_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `header` smallint(1) NOT NULL DEFAULT '0',
  `parent_cat` int(11) NOT NULL DEFAULT '-1',
  `short` smallint(1) DEFAULT '0',
  `realm_cat` smallint(1) NOT NULL DEFAULT '0',
  `gmlevel` int(11) NOT NULL DEFAULT '0',
  `banned_flag` int(11) NOT NULL,
  `title_de` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_es` varchar(255) NOT NULL,
  `title_fr` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `desc_de` varchar(255) NOT NULL,
  `desc_en` varchar(255) NOT NULL,
  `desc_es` varchar(255) NOT NULL,
  `desc_fr` varchar(255) NOT NULL,
  `desc_ru` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`),
  KEY `wfcat` (`cat_id`),
  KEY `parent_cat` (`parent_cat`),
  KEY `parent_cat_2` (`parent_cat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1002 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_forum_posts`
--
-- Creación: 28-03-2012 a las 15:50:27
-- Última actualización: 03-04-2012 a las 05:33:04
-- Última revisión: 28-03-2012 a las 15:50:28
--

CREATE TABLE IF NOT EXISTS `wow_forum_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `character_guid` int(11) NOT NULL,
  `character_realm` int(11) NOT NULL,
  `blizzpost` smallint(1) NOT NULL DEFAULT '0',
  `blizz_name` varchar(12) NOT NULL,
  `message` text NOT NULL,
  `post_date` int(11) DEFAULT NULL,
  `author_ip` varchar(15) NOT NULL,
  `post_num` int(11) NOT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `post_editor` varchar(255) NOT NULL,
  `deleted` int(11) DEFAULT NULL,
  `deleted_by` varchar(255) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `wfp` (`thread_id`),
  KEY `post_id` (`post_id`),
  KEY `account_id` (`account_id`,`character_guid`,`character_realm`),
  KEY `post_id_2` (`post_id`),
  KEY `account_id_2` (`account_id`,`character_guid`,`character_realm`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30201 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_forum_threads`
--
-- Creación: 28-03-2012 a las 15:50:28
-- Última actualización: 03-04-2012 a las 05:36:15
-- Última revisión: 28-03-2012 a las 15:50:28
--

CREATE TABLE IF NOT EXISTS `wow_forum_threads` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `character_guid` int(11) NOT NULL,
  `character_realm` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `posts` int(11) NOT NULL,
  `flags` int(11) NOT NULL,
  `last_update` int(11) NOT NULL,
  `last_poster` text NOT NULL,
  `last_poster_anchor` int(11) NOT NULL,
  `last_poster_type` int(11) NOT NULL,
  `blizz_posts` longtext NOT NULL,
  PRIMARY KEY (`thread_id`),
  KEY `wft` (`cat_id`),
  KEY `thread_id` (`thread_id`,`account_id`,`character_guid`,`character_realm`),
  KEY `thread_id_2` (`thread_id`,`account_id`,`character_guid`,`character_realm`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8578 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_forum_threads_reads`
--
-- Creación: 28-03-2012 a las 15:50:28
-- Última actualización: 28-03-2012 a las 15:50:28
--

CREATE TABLE IF NOT EXISTS `wow_forum_threads_reads` (
  `thread_id` int(11) NOT NULL,
  `bn_id` int(11) NOT NULL,
  `read_date` datetime NOT NULL,
  `page` int(11) NOT NULL,
  `last_post_id` int(11) NOT NULL,
  UNIQUE KEY `thread_id` (`thread_id`,`bn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_gemproperties`
--
-- Creación: 28-03-2012 a las 15:50:28
-- Última actualización: 28-03-2012 a las 15:50:28
-- Última revisión: 28-03-2012 a las 15:50:28
--

CREATE TABLE IF NOT EXISTS `wow_gemproperties` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `spellitemenchantement` int(10) unsigned DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_id` (`id`),
  KEY `idx_ench` (`spellitemenchantement`),
  KEY `id` (`id`,`spellitemenchantement`),
  KEY `id_2` (`id`,`spellitemenchantement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_glyphproperties`
--
-- Creación: 28-03-2012 a las 15:50:28
-- Última actualización: 28-03-2012 a las 15:50:28
-- Última revisión: 28-03-2012 a las 15:50:28
--

CREATE TABLE IF NOT EXISTS `wow_glyphproperties` (
  `id` int(11) NOT NULL,
  `spell` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ru` varchar(255) DEFAULT NULL,
  `name_es` text NOT NULL,
  `description_en` text,
  `description_ru` text,
  `description_es` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `type_2` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_guild_perks`
--
-- Creación: 28-03-2012 a las 15:50:28
-- Última actualización: 28-03-2012 a las 15:50:28
--

CREATE TABLE IF NOT EXISTS `wow_guild_perks` (
  `id` int(11) NOT NULL,
  `level` smallint(6) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `spell_id` int(11) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  `desc_de` text,
  `desc_en` text,
  `desc_es` text,
  `desc_fr` text,
  `desc_ru` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_hack_reports`
--
-- Creación: 28-03-2012 a las 15:50:28
-- Última actualización: 28-03-2012 a las 15:50:28
-- Última revisión: 28-03-2012 a las 15:50:28
--

CREATE TABLE IF NOT EXISTS `wow_hack_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) unsigned NOT NULL,
  `user_ip` varchar(32) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tmp_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `date` int(11) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Reporte de Hacks' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_icons`
--
-- Creación: 28-03-2012 a las 15:50:28
-- Última actualización: 28-03-2012 a las 15:50:29
-- Última revisión: 28-03-2012 a las 15:50:29
--

CREATE TABLE IF NOT EXISTS `wow_icons` (
  `displayid` int(11) NOT NULL,
  `icon` text NOT NULL,
  PRIMARY KEY (`displayid`),
  KEY `displayid` (`displayid`),
  KEY `displayid_2` (`displayid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_instances`
--
-- Creación: 28-03-2012 a las 15:50:29
-- Última actualización: 28-03-2012 a las 15:50:29
--

CREATE TABLE IF NOT EXISTS `wow_instances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) NOT NULL,
  `zone_key` varchar(30) NOT NULL,
  `name_de` text NOT NULL,
  `name_en` text NOT NULL,
  `name_es` text NOT NULL,
  `name_fr` text NOT NULL,
  `name_ru` text NOT NULL,
  `intro_de` text NOT NULL,
  `intro_en` text NOT NULL,
  `intro_es` text NOT NULL,
  `intro_fr` text NOT NULL,
  `intro_ru` text NOT NULL,
  `desc_de` text NOT NULL,
  `desc_en` text NOT NULL,
  `desc_es` text NOT NULL,
  `desc_fr` text NOT NULL,
  `desc_ru` text NOT NULL,
  `minLevel` int(11) NOT NULL,
  `maxLevel` int(11) NOT NULL,
  `minLevelExtra` int(11) DEFAULT NULL,
  `maxLevelExtra` int(11) DEFAULT NULL,
  `flags` int(11) DEFAULT NULL,
  `expansion` smallint(1) NOT NULL,
  `itemLevel` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `patch` varchar(5) NOT NULL,
  `dungeonGroup` mediumint(9) NOT NULL,
  `floor_levels_count` smallint(6) NOT NULL,
  `floor_levels_de` text NOT NULL,
  `floor_levels_en` text NOT NULL,
  `floor_levels_es` text NOT NULL,
  `floor_levels_fr` text NOT NULL,
  `floor_levels_ru` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=87 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_instances_groups`
--
-- Creación: 28-03-2012 a las 15:50:29
-- Última actualización: 28-03-2012 a las 15:50:29
--

CREATE TABLE IF NOT EXISTS `wow_instances_groups` (
  `group_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name_de` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL,
  `name_es` varchar(50) DEFAULT NULL,
  `name_fr` varchar(50) DEFAULT NULL,
  `name_ru` varchar(50) DEFAULT NULL,
  `expansion` smallint(1) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_instance_bosses`
--
-- Creación: 28-03-2012 a las 15:50:29
-- Última actualización: 28-03-2012 a las 15:50:29
--

CREATE TABLE IF NOT EXISTS `wow_instance_bosses` (
  `boss_id` int(11) NOT NULL,
  `instance_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `bossName_de` text,
  `bossName_en` text,
  `bossName_es` text,
  `bossName_fr` text,
  `bossName_ru` text,
  `subname_de` text NOT NULL,
  `subname_en` text NOT NULL,
  `subname_es` text NOT NULL,
  `subname_fr` text NOT NULL,
  `subname_ru` text NOT NULL,
  `description_de` text NOT NULL,
  `description_en` text NOT NULL,
  `description_es` text NOT NULL,
  `description_fr` text NOT NULL,
  `description_ru` text NOT NULL,
  `level` int(11) NOT NULL,
  `flags` int(11) NOT NULL,
  `health_n` int(11) NOT NULL,
  `health_h` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `additionalEntries` varchar(255) NOT NULL,
  PRIMARY KEY (`boss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_instance_data`
--
-- Creación: 28-03-2012 a las 15:50:29
-- Última actualización: 28-03-2012 a las 15:50:29
--

CREATE TABLE IF NOT EXISTS `wow_instance_data` (
  `id` int(11) NOT NULL,
  `instance_id` int(11) NOT NULL,
  `name_ru` text,
  `name_en` text,
  `name_de` text,
  `name_fr` text,
  `name_es` text,
  `name_id` int(11) NOT NULL,
  `lootid_1` int(11) DEFAULT NULL,
  `loot_1_type` varchar(1) NOT NULL,
  `lootid_2` int(11) DEFAULT NULL,
  `loot_2_type` varchar(1) NOT NULL,
  `lootid_3` int(11) DEFAULT NULL,
  `loot_3_type` varchar(1) NOT NULL,
  `lootid_4` int(11) DEFAULT NULL,
  `loot_4_type` varchar(1) NOT NULL,
  `key` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `idExtra` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_itemdisplayinfo`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_itemdisplayinfo` (
  `displayid` int(11) NOT NULL,
  `modelName_1` text NOT NULL,
  `modelName_2` text NOT NULL,
  `modelTexture_1` text NOT NULL,
  `modelTexture_2` text NOT NULL,
  `texture_1` text NOT NULL,
  `texture_2` text NOT NULL,
  `visual_1` text NOT NULL,
  `visual_2` text NOT NULL,
  `visual_3` text NOT NULL,
  `visual_4` text NOT NULL,
  `visual_5` text NOT NULL,
  `visual_6` text NOT NULL,
  `visual_7` text NOT NULL,
  `visual_8` text NOT NULL,
  PRIMARY KEY (`displayid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_itemsetdata`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
-- Última revisión: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_itemsetdata` (
  `id` int(11) NOT NULL,
  `original` int(11) NOT NULL,
  `item1` int(11) NOT NULL,
  `item2` int(11) NOT NULL,
  `item3` int(11) NOT NULL,
  `item4` int(11) NOT NULL,
  `item5` int(11) NOT NULL,
  `faction` smallint(1) DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `original` (`original`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Custom itemset data (T9, T10 pieces)';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_itemsetinfo`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
-- Última revisión: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_itemsetinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  `item1` int(11) NOT NULL,
  `item2` int(11) NOT NULL,
  `item3` int(11) NOT NULL,
  `item4` int(11) NOT NULL,
  `item5` int(11) NOT NULL,
  `item6` int(11) NOT NULL,
  `item7` int(11) NOT NULL,
  `item8` int(11) NOT NULL,
  `item9` int(11) NOT NULL,
  `item10` int(11) NOT NULL,
  `item11` int(11) NOT NULL,
  `item12` int(11) NOT NULL,
  `item13` int(11) NOT NULL,
  `item14` int(11) NOT NULL,
  `item15` int(11) NOT NULL,
  `item16` int(11) NOT NULL,
  `item17` int(11) NOT NULL,
  `bonus1` int(11) NOT NULL,
  `bonus2` int(11) NOT NULL,
  `bonus3` int(11) NOT NULL,
  `bonus4` int(11) NOT NULL,
  `bonus5` int(11) NOT NULL,
  `bonus6` int(11) NOT NULL,
  `bonus7` int(11) NOT NULL,
  `bonus8` int(11) NOT NULL,
  `threshold1` smallint(6) NOT NULL,
  `threshold2` smallint(6) NOT NULL,
  `threshold3` smallint(6) NOT NULL,
  `threshold4` smallint(6) NOT NULL,
  `threshold5` smallint(6) NOT NULL,
  `threshold6` smallint(6) NOT NULL,
  `threshold7` smallint(6) NOT NULL,
  `threshold8` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item1` (`item1`),
  KEY `item2` (`item2`),
  KEY `item3` (`item3`),
  KEY `item4` (`item4`),
  KEY `item5` (`item5`),
  KEY `item6` (`item6`),
  KEY `item7` (`item7`),
  KEY `item8` (`item8`),
  KEY `item9` (`item9`),
  KEY `item10` (`item10`),
  KEY `item11` (`item11`),
  KEY `item12` (`item12`),
  KEY `item13` (`item13`),
  KEY `item14` (`item14`),
  KEY `item15` (`item15`),
  KEY `item16` (`item16`),
  KEY `item17` (`item17`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=902 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_itemsubclass`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
-- Última revisión: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_itemsubclass` (
  `class` smallint(1) NOT NULL DEFAULT '0',
  `class_name_de` text,
  `class_name_en` text,
  `class_name_es` text,
  `class_name_fr` text,
  `class_name_ru` text,
  `subclass` smallint(1) NOT NULL DEFAULT '0',
  `subclass_name_de` text,
  `subclass_name_en` text,
  `subclass_name_es` text,
  `subclass_name_fr` text,
  `subclass_name_ru` text,
  `key` varchar(150) NOT NULL,
  KEY `class` (`class`),
  KEY `subclass` (`subclass`),
  KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_equivalents`
--
-- Creación: 28-03-2012 a las 15:50:29
-- Última actualización: 28-03-2012 a las 15:50:29
-- Última revisión: 28-03-2012 a las 15:50:29
--

CREATE TABLE IF NOT EXISTS `wow_item_equivalents` (
  `item_horde` int(11) NOT NULL,
  `item_alliance` int(11) NOT NULL,
  PRIMARY KEY (`item_horde`),
  KEY `item_horde` (`item_horde`,`item_alliance`),
  KEY `item_horde_2` (`item_horde`,`item_alliance`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_sources`
--
-- Creación: 28-03-2012 a las 15:50:29
-- Última actualización: 28-03-2012 a las 15:50:29
-- Última revisión: 28-03-2012 a las 15:50:29
--

CREATE TABLE IF NOT EXISTS `wow_item_sources` (
  `item` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `source_entry` int(11) NOT NULL,
  KEY `item` (`item`),
  KEY `source` (`source`),
  KEY `source_entry` (`source_entry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_sources_old`
--
-- Creación: 28-03-2012 a las 15:50:29
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_item_sources_old` (
  `item` int(11) NOT NULL,
  `source` varchar(150) NOT NULL,
  `areaKey` text,
  `areaUrl` text NOT NULL,
  `isHeroic` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_subclass`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
-- Última revisión: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_item_subclass` (
  `class` smallint(1) NOT NULL DEFAULT '0',
  `class_name_de` text NOT NULL,
  `class_name_en` text NOT NULL,
  `class_name_es` text NOT NULL,
  `class_name_fr` text NOT NULL,
  `class_name_ru` text NOT NULL,
  `subclass` smallint(1) NOT NULL DEFAULT '0',
  `subclass_name_de` text NOT NULL,
  `subclass_name_en` text NOT NULL,
  `subclass_name_es` text NOT NULL,
  `subclass_name_fr` text NOT NULL,
  `subclass_name_ru` text NOT NULL,
  `key` varchar(150) NOT NULL,
  KEY `class` (`class`),
  KEY `subclass` (`subclass`),
  KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_tab_contained_in`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_item_tab_contained_in` (
  `itemID` int(20) NOT NULL,
  `goID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `location` int(20) NOT NULL,
  `drop_rate` int(5) NOT NULL,
  PRIMARY KEY (`itemID`,`goID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_tab_created_by`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_item_tab_created_by` (
  `itemID` int(20) NOT NULL,
  `spellID` int(20) NOT NULL,
  `spellname_de` varchar(255) NOT NULL,
  `spellname_en` varchar(255) NOT NULL,
  `spellname_es` varchar(255) NOT NULL,
  `spellname_fr` varchar(255) NOT NULL,
  `spellname_ru` varchar(255) NOT NULL,
  `spell_desc_de` text NOT NULL,
  `spell_desc_en` text NOT NULL,
  `spell_desc_es` text NOT NULL,
  `spell_desc_fr` text NOT NULL,
  `spell_desc_ru` text NOT NULL,
  `reagent_1` int(11) NOT NULL,
  `reagent_2` int(11) NOT NULL,
  `reagent_3` int(11) NOT NULL,
  `reagent_4` int(11) NOT NULL,
  `reagent_5` int(11) NOT NULL,
  `reagent_6` int(11) NOT NULL,
  `reagent_7` int(11) NOT NULL,
  `reagent_8` int(11) NOT NULL,
  `reagent_count_1` int(11) NOT NULL,
  `reagent_count_2` int(11) NOT NULL,
  `reagent_count_3` int(11) NOT NULL,
  `reagent_count_4` int(11) NOT NULL,
  `reagent_count_5` int(11) NOT NULL,
  `reagent_count_6` int(11) NOT NULL,
  `reagent_count_7` int(11) NOT NULL,
  `reagent_count_8` int(11) NOT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_tab_disenchants_into`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_item_tab_disenchants_into` (
  `itemID` int(20) NOT NULL,
  `item2ID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `level` int(3) NOT NULL,
  `drop_count` varchar(55) NOT NULL,
  `drop_rate` int(5) NOT NULL,
  PRIMARY KEY (`itemID`,`item2ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_tab_dropped_from`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_item_tab_dropped_from` (
  `itemID` int(20) NOT NULL,
  `npcID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `type` int(5) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  `drop_rate` int(5) NOT NULL,
  PRIMARY KEY (`itemID`,`npcID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_tab_reagent_for`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_item_tab_reagent_for` (
  `itemID` int(20) NOT NULL,
  `spellID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `sell_price` int(10) NOT NULL,
  PRIMARY KEY (`itemID`,`spellID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_item_tab_sold_by`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_item_tab_sold_by` (
  `itemID` int(20) NOT NULL,
  `npcID` int(20) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_es` varchar(255) NOT NULL,
  `level` int(3) NOT NULL,
  `location` int(20) NOT NULL,
  PRIMARY KEY (`itemID`,`npcID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_lag_reports`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_lag_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ip` varchar(16) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `timers` text NOT NULL,
  `date_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_main_menu`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_main_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `page_index` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `href` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `title_de` text NOT NULL,
  `title_en` text NOT NULL,
  `title_es` text NOT NULL,
  `title_fr` text NOT NULL,
  `title_ru` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_maps`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_maps` (
  `id` int(11) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_media_screenshots`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 31-03-2012 a las 17:28:19
--

CREATE TABLE IF NOT EXISTS `wow_media_screenshots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `post_date` int(11) NOT NULL,
  `approved` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_media_videos`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_media_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(64) NOT NULL,
  `post_date` int(11) NOT NULL,
  `youtube` varchar(30) NOT NULL,
  `approved` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sender_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_mounts`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_mounts` (
  `spell` int(11) NOT NULL,
  `type` smallint(1) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ru` varchar(255) NOT NULL,
  `name_es` text NOT NULL,
  `mount_type` smallint(6) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `quality` smallint(1) NOT NULL,
  `npc_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sourceType` int(11) DEFAULT NULL,
  `source_en` text,
  `source_ru` text NOT NULL,
  `source_es` text NOT NULL,
  PRIMARY KEY (`spell`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_news`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 02-04-2012 a las 15:15:42
--

CREATE TABLE IF NOT EXISTS `wow_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `header_image` text NOT NULL,
  `title_de` text NOT NULL,
  `title_en` text NOT NULL,
  `title_es` text NOT NULL,
  `title_fr` text NOT NULL,
  `title_ru` text NOT NULL,
  `desc_de` text NOT NULL,
  `desc_en` text NOT NULL,
  `desc_es` text NOT NULL,
  `desc_fr` text NOT NULL,
  `desc_ru` text NOT NULL,
  `text_de` text NOT NULL,
  `text_en` text NOT NULL,
  `text_es` text NOT NULL,
  `text_fr` text NOT NULL,
  `text_ru` text NOT NULL,
  `author` text NOT NULL,
  `postdate` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `community` smallint(1) NOT NULL DEFAULT '0',
  `comments_count` int(11) NOT NULL,
  `allow_comments` smallint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_petcalc`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_petcalc` (
  `id` smallint(6) NOT NULL,
  `catId` smallint(6) NOT NULL DEFAULT '0',
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  `icon` text NOT NULL,
  `key` text NOT NULL,
  PRIMARY KEY (`catId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_private_messages`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 03-04-2012 a las 01:19:59
-- Última revisión: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_private_messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `send_date` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `read` smallint(1) NOT NULL,
  `sender_guid` int(11) NOT NULL,
  `sender_realmId` int(11) NOT NULL,
  `receiver_guid` int(11) NOT NULL,
  `receiver_realmId` int(11) NOT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `sender_id` (`sender_id`,`receiver_id`,`send_date`),
  KEY `read` (`read`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=559 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_professions`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_professions` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  `icon` varchar(50) NOT NULL,
  `key` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_profession_bonuses`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_profession_bonuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profession_id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `name_es` text NOT NULL,
  `desc_es` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_profession_data`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_profession_data` (
  `key` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `name_es` text NOT NULL,
  `intro_es` text NOT NULL,
  `desc_es` text NOT NULL,
  `howto_es` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_profession_related`
--
-- Creación: 28-03-2012 a las 15:50:30
-- Última actualización: 28-03-2012 a las 15:50:30
--

CREATE TABLE IF NOT EXISTS `wow_profession_related` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profession_id` int(11) NOT NULL,
  `prof_key` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `prof_name_es` text NOT NULL,
  `prof_desc_es` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_races`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_races` (
  `id` int(11) NOT NULL,
  `key` varchar(20) NOT NULL,
  `story_en` text NOT NULL,
  `story_ru` text NOT NULL,
  `story_es` text NOT NULL,
  `info_en` text NOT NULL,
  `info_ru` text NOT NULL,
  `info_es` text NOT NULL,
  `location_en` text NOT NULL,
  `location_ru` text NOT NULL,
  `location_es` text NOT NULL,
  `location_info_en` text NOT NULL,
  `location_info_ru` text NOT NULL,
  `location_info_es` text NOT NULL,
  `homecity_en` text NOT NULL,
  `homecity_ru` text NOT NULL,
  `homecity_es` text NOT NULL,
  `homecity_info_en` text NOT NULL,
  `homecity_info_ru` text NOT NULL,
  `homecity_info_es` text NOT NULL,
  `mount_en` text NOT NULL,
  `mount_ru` text NOT NULL,
  `mount_es` text NOT NULL,
  `mount_info_en` text NOT NULL,
  `mount_info_ru` text NOT NULL,
  `mount_info_es` text NOT NULL,
  `leader_en` text NOT NULL,
  `leader_ru` text NOT NULL,
  `leader_es` text NOT NULL,
  `leader_info_en` text NOT NULL,
  `leader_info_ru` text NOT NULL,
  `leader_info_es` text NOT NULL,
  `classes_flag` int(11) DEFAULT NULL,
  `expansion` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_race_abilities`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_race_abilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `race` int(11) DEFAULT NULL,
  `title_en` text NOT NULL,
  `title_ru` text NOT NULL,
  `title_es` text NOT NULL,
  `text_en` text NOT NULL,
  `text_ru` text NOT NULL,
  `text_es` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_raid_progress`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_raid_progress` (
  `ach_id` int(11) NOT NULL,
  `name_de` text NOT NULL,
  `name_en` text NOT NULL,
  `name_es` text NOT NULL,
  `name_fr` text NOT NULL,
  `name_ru` text NOT NULL,
  `entry1` int(11) NOT NULL,
  `entry2` int(11) NOT NULL,
  `entry3` int(11) NOT NULL,
  `entry4` int(11) NOT NULL,
  `difficulty` smallint(1) NOT NULL,
  `is_heroic` smallint(1) NOT NULL,
  `dungeon_key` varchar(5) NOT NULL,
  PRIMARY KEY (`ach_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_randomproperties`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_randomproperties` (
  `id` int(11) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_fr` text,
  `name_es` text,
  `name_ru` text,
  `ench_1` int(11) NOT NULL,
  `ench_2` int(11) NOT NULL,
  `ench_3` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_randompropertypoints`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_randompropertypoints` (
  `itemlevel` int(11) NOT NULL,
  `epic_0` int(11) NOT NULL,
  `epic_1` int(11) NOT NULL,
  `epic_2` int(11) NOT NULL,
  `epic_3` int(11) NOT NULL,
  `epic_4` int(11) NOT NULL,
  `rare_0` int(11) NOT NULL,
  `rare_1` int(11) NOT NULL,
  `rare_2` int(11) NOT NULL,
  `rare_3` int(11) NOT NULL,
  `rare_4` int(11) NOT NULL,
  `uncommon_0` int(11) NOT NULL,
  `uncommon_1` int(11) NOT NULL,
  `uncommon_2` int(11) NOT NULL,
  `uncommon_3` int(11) NOT NULL,
  `uncommon_4` int(11) NOT NULL,
  PRIMARY KEY (`itemlevel`),
  UNIQUE KEY `idx_id` (`itemlevel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_randomsuffix`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_randomsuffix` (
  `id` int(11) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  `ench_1` int(11) NOT NULL,
  `ench_2` int(11) NOT NULL,
  `ench_3` int(11) NOT NULL,
  `ench_4` int(11) NOT NULL,
  `ench_5` int(11) NOT NULL,
  `pref_1` int(11) DEFAULT NULL,
  `pref_2` int(11) DEFAULT NULL,
  `pref_3` int(11) DEFAULT NULL,
  `pref_4` int(11) DEFAULT NULL,
  `pref_5` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_rating`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_rating` (
  `level` int(11) NOT NULL DEFAULT '0',
  `MC_Warrior` float NOT NULL DEFAULT '0',
  `MC_Paladin` float NOT NULL DEFAULT '0',
  `MC_Hunter` float NOT NULL DEFAULT '0',
  `MC_Rogue` float NOT NULL DEFAULT '0',
  `MC_Priest` float NOT NULL DEFAULT '0',
  `MC_DeathKnight` float NOT NULL DEFAULT '0',
  `MC_Shaman` float NOT NULL DEFAULT '0',
  `MC_Mage` float NOT NULL DEFAULT '0',
  `MC_Warlock` float NOT NULL DEFAULT '0',
  `MC_10` float NOT NULL DEFAULT '0',
  `MC_Druid` float NOT NULL DEFAULT '0',
  `SC_Warrior` float NOT NULL DEFAULT '0',
  `SC_Paladin` float NOT NULL DEFAULT '0',
  `SC_Hunter` float NOT NULL DEFAULT '0',
  `SC_Rogue` float NOT NULL DEFAULT '0',
  `SC_Priest` float NOT NULL DEFAULT '0',
  `SC_DeathKnight` float NOT NULL DEFAULT '0',
  `SC_Shaman` float NOT NULL DEFAULT '0',
  `SC_Mage` float NOT NULL DEFAULT '0',
  `SC_Warlock` float NOT NULL DEFAULT '0',
  `SC_10` float NOT NULL DEFAULT '0',
  `SC_Druid` float NOT NULL DEFAULT '0',
  `HR_Warrior` float NOT NULL DEFAULT '0',
  `HR_Paladin` float NOT NULL DEFAULT '0',
  `HR_Hunter` float NOT NULL DEFAULT '0',
  `HR_Rogue` float NOT NULL DEFAULT '0',
  `HR_Priest` float NOT NULL DEFAULT '0',
  `HR_DeathKnight` float NOT NULL DEFAULT '0',
  `HR_Shaman` float NOT NULL DEFAULT '0',
  `HR_Mage` float NOT NULL DEFAULT '0',
  `HR_Warlock` float NOT NULL DEFAULT '0',
  `HR_10` float NOT NULL DEFAULT '0',
  `HR_Druid` float NOT NULL DEFAULT '0',
  `MR_Warrior` float NOT NULL DEFAULT '0',
  `MR_Paladin` float NOT NULL DEFAULT '0',
  `MR_Hunter` float NOT NULL DEFAULT '0',
  `MR_Rogue` float NOT NULL DEFAULT '0',
  `MR_Priest` float NOT NULL DEFAULT '0',
  `MR_DeathKnight` float NOT NULL DEFAULT '0',
  `MR_Shaman` float NOT NULL DEFAULT '0',
  `MR_Mage` float NOT NULL DEFAULT '0',
  `MR_Warlock` float NOT NULL DEFAULT '0',
  `MR_10` float NOT NULL DEFAULT '0',
  `MR_Druid` float NOT NULL DEFAULT '0',
  `CR_WEAPON_SKILL` float NOT NULL DEFAULT '0',
  `CR_DEFENSE_SKILL` float NOT NULL DEFAULT '0',
  `CR_DODGE` float NOT NULL DEFAULT '0',
  `CR_PARRY` float NOT NULL DEFAULT '0',
  `CR_BLOCK` float NOT NULL DEFAULT '0',
  `CR_HIT_MELEE` float NOT NULL DEFAULT '0',
  `CR_HIT_RANGED` float NOT NULL DEFAULT '0',
  `CR_HIT_SPELL` float NOT NULL DEFAULT '0',
  `CR_CRIT_MELEE` float NOT NULL DEFAULT '0',
  `CR_CRIT_RANGED` float NOT NULL DEFAULT '0',
  `CR_CRIT_SPELL` float NOT NULL DEFAULT '0',
  `CR_HIT_TAKEN_MELEE` float NOT NULL DEFAULT '0',
  `CR_HIT_TAKEN_RANGED` float NOT NULL DEFAULT '0',
  `CR_HIT_TAKEN_SPELL` float NOT NULL DEFAULT '0',
  `CR_CRIT_TAKEN_MELEE` float NOT NULL DEFAULT '0',
  `CR_CRIT_TAKEN_RANGED` float NOT NULL DEFAULT '0',
  `CR_CRIT_TAKEN_SPELL` float NOT NULL DEFAULT '0',
  `CR_HASTE_MELEE` float NOT NULL DEFAULT '0',
  `CR_HASTE_RANGED` float NOT NULL DEFAULT '0',
  `CR_HASTE_SPELL` float NOT NULL DEFAULT '0',
  `CR_WEAPON_SKILL_MAINHAND` float NOT NULL DEFAULT '0',
  `CR_WEAPON_SKILL_OFFHAND` float NOT NULL DEFAULT '0',
  `CR_WEAPON_SKILL_RANGED` float NOT NULL DEFAULT '0',
  `CR_EXPERTISE` float NOT NULL,
  `CR_ARMOR_PENETRATION` float NOT NULL,
  PRIMARY KEY (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_skills`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_skills` (
  `id` int(11) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  `description_de` text,
  `description_en` text,
  `description_es` text,
  `description_fr` text,
  `description_ru` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_skill_line_ability`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:31
--

CREATE TABLE IF NOT EXISTS `wow_skill_line_ability` (
  `id` int(11) NOT NULL DEFAULT '0',
  `skillId` int(11) NOT NULL DEFAULT '0',
  `spellId` int(11) NOT NULL DEFAULT '0',
  `racemask` int(11) NOT NULL DEFAULT '0',
  `classmask` int(11) NOT NULL DEFAULT '0',
  `racemaskNot` int(11) NOT NULL DEFAULT '0',
  `classmaskNot` int(11) NOT NULL DEFAULT '0',
  `req_skill_value` int(11) NOT NULL DEFAULT '0',
  `forward_spellid` int(11) NOT NULL DEFAULT '0',
  `learnOnGetSkill` int(11) NOT NULL DEFAULT '0',
  `max_value` int(11) NOT NULL DEFAULT '0',
  `min_value` int(11) NOT NULL DEFAULT '0',
  `characterPoints_1` int(11) NOT NULL DEFAULT '0',
  `characterPoints_2` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Export of SkillLineAbility.dbc';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_spell`
--
-- Creación: 28-03-2012 a las 15:50:31
-- Última actualización: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_spell` (
  `id` bigint(20) NOT NULL DEFAULT '0',
  `Category` bigint(20) NOT NULL COMMENT 'Category',
  `Dispel` bigint(20) NOT NULL COMMENT 'Dispel',
  `Mechanic` bigint(20) NOT NULL COMMENT 'Mechanic',
  `Attributes` bigint(20) NOT NULL COMMENT 'Attributes',
  `AttributesEx` bigint(20) NOT NULL COMMENT 'AttributesEx',
  `AttributesEx2` bigint(20) NOT NULL COMMENT 'AttributesEx2',
  `AttributesEx3` bigint(20) NOT NULL COMMENT 'AttributesEx3',
  `AttributesEx4` bigint(20) NOT NULL COMMENT 'AttributesEx4',
  `AttributesEx5` bigint(20) NOT NULL COMMENT 'AttributesEx5',
  `AttributesEx6` bigint(20) NOT NULL COMMENT 'AttributesEx6',
  `unk_320_1` bigint(20) NOT NULL COMMENT 'unk_320_1',
  `Stances` bigint(20) NOT NULL COMMENT 'Stances',
  `unk_320_2` bigint(20) NOT NULL COMMENT 'unk_320_2',
  `StancesNot` bigint(20) NOT NULL COMMENT 'StancesNot',
  `unk_320_3` bigint(20) NOT NULL COMMENT 'unk_320_3',
  `Targets` bigint(20) NOT NULL COMMENT 'Targets',
  `TargetCreatureType` bigint(20) NOT NULL COMMENT 'TargetCreatureType',
  `RequiresSpellFocus` bigint(20) NOT NULL COMMENT 'RequiresSpellFocus',
  `FacingCasterFlags` bigint(20) NOT NULL COMMENT 'FacingCasterFlags',
  `CasterAuraState` bigint(20) NOT NULL COMMENT 'CasterAuraState',
  `TargetAuraState` bigint(20) NOT NULL COMMENT 'TargetAuraState',
  `CasterAuraStateNot` bigint(20) NOT NULL COMMENT 'CasterAuraStateNot',
  `TargetAuraStateNot` bigint(20) NOT NULL COMMENT 'TargetAuraStateNot',
  `casterAuraSpell` bigint(20) NOT NULL COMMENT 'casterAuraSpell',
  `targetAuraSpell` bigint(20) NOT NULL COMMENT 'targetAuraSpell',
  `excludeCasterAuraSpell` bigint(20) NOT NULL COMMENT 'excludeCasterAuraSpell',
  `excludeTargetAuraSpell` bigint(20) NOT NULL COMMENT 'excludeTargetAuraSpell',
  `CastingTimeIndex` bigint(20) NOT NULL COMMENT 'CastingTimeIndex',
  `RecoveryTime` bigint(20) NOT NULL COMMENT 'RecoveryTime',
  `CategoryRecoveryTime` bigint(20) NOT NULL COMMENT 'CategoryRecoveryTime',
  `InterruptFlags` bigint(20) NOT NULL COMMENT 'InterruptFlags',
  `AuraInterruptFlags` bigint(20) NOT NULL COMMENT 'AuraInterruptFlags',
  `ChannelInterruptFlags` bigint(20) NOT NULL COMMENT 'ChannelInterruptFlags',
  `procFlags` bigint(20) NOT NULL COMMENT 'procFlags',
  `procChance` bigint(20) NOT NULL COMMENT 'procChance',
  `procCharges` bigint(20) NOT NULL COMMENT 'procCharges',
  `maxLevel` bigint(20) NOT NULL COMMENT 'maxLevel',
  `baseLevel` bigint(20) NOT NULL COMMENT 'baseLevel',
  `spellLevel` bigint(20) NOT NULL COMMENT 'spellLevel',
  `DurationIndex` bigint(20) NOT NULL COMMENT 'DurationIndex',
  `powerType` bigint(20) NOT NULL COMMENT 'powerType',
  `manaCost` bigint(20) NOT NULL COMMENT 'manaCost',
  `manaCostPerlevel` bigint(20) NOT NULL COMMENT 'manaCostPerlevel',
  `manaPerSecond` bigint(20) NOT NULL COMMENT 'manaPerSecond',
  `manaPerSecondPerLevel` bigint(20) NOT NULL COMMENT 'manaPerSecondPerLevel',
  `rangeIndex` bigint(20) NOT NULL COMMENT 'rangeIndex',
  `speed` bigint(20) NOT NULL COMMENT 'speed',
  `modalNextSpell` bigint(20) NOT NULL COMMENT 'modalNextSpell',
  `StackAmount` bigint(20) NOT NULL COMMENT 'StackAmount',
  `Totem_1` bigint(20) NOT NULL COMMENT 'Totem_1',
  `Totem_2` bigint(20) NOT NULL COMMENT 'Totem_2',
  `Reagent_1` bigint(20) NOT NULL COMMENT 'Reagent_1',
  `Reagent_2` bigint(20) NOT NULL COMMENT 'Reagent_2',
  `Reagent_3` bigint(20) NOT NULL COMMENT 'Reagent_3',
  `Reagent_4` bigint(20) NOT NULL COMMENT 'Reagent_4',
  `Reagent_5` bigint(20) NOT NULL COMMENT 'Reagent_5',
  `Reagent_6` bigint(20) NOT NULL COMMENT 'Reagent_6',
  `Reagent_7` bigint(20) NOT NULL COMMENT 'Reagent_7',
  `Reagent_8` bigint(20) NOT NULL COMMENT 'Reagent_8',
  `ReagentCount_1` bigint(20) NOT NULL COMMENT 'ReagentCount_1',
  `ReagentCount_2` bigint(20) NOT NULL COMMENT 'ReagentCount_2',
  `ReagentCount_3` bigint(20) NOT NULL COMMENT 'ReagentCount_3',
  `ReagentCount_4` bigint(20) NOT NULL COMMENT 'ReagentCount_4',
  `ReagentCount_5` bigint(20) NOT NULL COMMENT 'ReagentCount_5',
  `ReagentCount_6` bigint(20) NOT NULL COMMENT 'ReagentCount_6',
  `ReagentCount_7` bigint(20) NOT NULL COMMENT 'ReagentCount_7',
  `ReagentCount_8` bigint(20) NOT NULL COMMENT 'ReagentCount_8',
  `EquippedItemClass` bigint(20) NOT NULL COMMENT 'EquippedItemClass',
  `EquippedItemSubClassMask` bigint(20) NOT NULL COMMENT 'EquippedItemSubClassMask',
  `EquippedItemInventoryTypeMask` bigint(20) NOT NULL COMMENT 'EquippedItemInventoryTypeMask',
  `Effect_1` bigint(20) NOT NULL COMMENT 'Effect_1',
  `Effect_2` bigint(20) NOT NULL COMMENT 'Effect_2',
  `Effect_3` bigint(20) NOT NULL COMMENT 'Effect_3',
  `EffectDieSides_1` bigint(20) NOT NULL COMMENT 'EffectDieSides_1',
  `EffectDieSides_2` bigint(20) NOT NULL COMMENT 'EffectDieSides_2',
  `EffectDieSides_3` bigint(20) NOT NULL COMMENT 'EffectDieSides_3',
  `EffectBaseDice_1` bigint(20) NOT NULL,
  `EffectBaseDice_2` bigint(20) NOT NULL,
  `EffectBaseDice_3` bigint(20) NOT NULL,
  `EffectRealPointsPerLevel_1` bigint(20) NOT NULL COMMENT 'EffectRealPointsPerLevel_1',
  `EffectRealPointsPerLevel_2` bigint(20) NOT NULL COMMENT 'EffectRealPointsPerLevel_2',
  `EffectRealPointsPerLevel_3` bigint(20) NOT NULL COMMENT 'EffectRealPointsPerLevel_3',
  `EffectBasePoints_1` bigint(20) NOT NULL COMMENT 'EffectBasePoints_1',
  `EffectBasePoints_2` bigint(20) NOT NULL COMMENT 'EffectBasePoints_2',
  `EffectBasePoints_3` bigint(20) NOT NULL COMMENT 'EffectBasePoints_3',
  `EffectMechanic_1` bigint(20) NOT NULL COMMENT 'EffectMechanic_1',
  `EffectMechanic_2` bigint(20) NOT NULL COMMENT 'EffectMechanic_2',
  `EffectMechanic_3` bigint(20) NOT NULL COMMENT 'EffectMechanic_3',
  `EffectImplicitTargetA_1` bigint(20) NOT NULL COMMENT 'EffectImplicitTargetA_1',
  `EffectImplicitTargetA_2` bigint(20) NOT NULL COMMENT 'EffectImplicitTargetA_2',
  `EffectImplicitTargetA_3` bigint(20) NOT NULL COMMENT 'EffectImplicitTargetA_3',
  `EffectImplicitTargetB_1` bigint(20) NOT NULL COMMENT 'EffectImplicitTargetB_1',
  `EffectImplicitTargetB_2` bigint(20) NOT NULL COMMENT 'EffectImplicitTargetB_2',
  `EffectImplicitTargetB_3` bigint(20) NOT NULL COMMENT 'EffectImplicitTargetB_3',
  `EffectRadiusIndex_1` bigint(20) NOT NULL COMMENT 'EffectRadiusIndex_1',
  `EffectRadiusIndex_2` bigint(20) NOT NULL COMMENT 'EffectRadiusIndex_2',
  `EffectRadiusIndex_3` bigint(20) NOT NULL COMMENT 'EffectRadiusIndex_3',
  `EffectApplyAuraName_1` bigint(20) NOT NULL COMMENT 'EffectApplyAuraName_1',
  `EffectApplyAuraName_2` bigint(20) NOT NULL COMMENT 'EffectApplyAuraName_2',
  `EffectApplyAuraName_3` bigint(20) NOT NULL COMMENT 'EffectApplyAuraName_3',
  `EffectAmplitude_1` bigint(20) NOT NULL COMMENT 'EffectAmplitude_1',
  `EffectAmplitude_2` bigint(20) NOT NULL COMMENT 'EffectAmplitude_2',
  `EffectAmplitude_3` bigint(20) NOT NULL COMMENT 'EffectAmplitude_3',
  `EffectMultipleValue_1` bigint(20) NOT NULL COMMENT 'EffectMultipleValue_1',
  `EffectMultipleValue_2` bigint(20) NOT NULL COMMENT 'EffectMultipleValue_2',
  `EffectMultipleValue_3` bigint(20) NOT NULL COMMENT 'EffectMultipleValue_3',
  `EffectChainTarget_1` bigint(20) NOT NULL COMMENT 'EffectChainTarget_1',
  `EffectChainTarget_2` bigint(20) NOT NULL COMMENT 'EffectChainTarget_2',
  `EffectChainTarget_3` bigint(20) NOT NULL COMMENT 'EffectChainTarget_3',
  `EffectItemType_1` bigint(20) NOT NULL COMMENT 'EffectItemType_1',
  `EffectItemType_2` bigint(20) NOT NULL COMMENT 'EffectItemType_2',
  `EffectItemType_3` bigint(20) NOT NULL COMMENT 'EffectItemType_3',
  `EffectMiscValue_1` bigint(20) NOT NULL COMMENT 'EffectMiscValue_1',
  `EffectMiscValue_2` bigint(20) NOT NULL COMMENT 'EffectMiscValue_2',
  `EffectMiscValue_3` bigint(20) NOT NULL COMMENT 'EffectMiscValue_3',
  `EffectMiscValueB_1` bigint(20) NOT NULL COMMENT 'EffectMiscValueB_1',
  `EffectMiscValueB_2` bigint(20) NOT NULL COMMENT 'EffectMiscValueB_2',
  `EffectMiscValueB_3` bigint(20) NOT NULL COMMENT 'EffectMiscValueB_3',
  `EffectTriggerSpell_1` bigint(20) NOT NULL COMMENT 'EffectTriggerSpell_1',
  `EffectTriggerSpell_2` bigint(20) NOT NULL COMMENT 'EffectTriggerSpell_2',
  `EffectTriggerSpell_3` bigint(20) NOT NULL COMMENT 'EffectTriggerSpell_3',
  `EffectPointsPerComboPoint_1` bigint(20) NOT NULL COMMENT 'EffectPointsPerComboPoint_1',
  `EffectPointsPerComboPoint_2` bigint(20) NOT NULL COMMENT 'EffectPointsPerComboPoint_2',
  `EffectPointsPerComboPoint_3` bigint(20) NOT NULL COMMENT 'EffectPointsPerComboPoint_3',
  `EffectSpellClassMaskA_1` bigint(20) NOT NULL COMMENT 'EffectSpellClassMaskA_1',
  `EffectSpellClassMaskA_2` bigint(20) NOT NULL COMMENT 'EffectSpellClassMaskA_2',
  `EffectSpellClassMaskA_3` bigint(20) NOT NULL COMMENT 'EffectSpellClassMaskA_3',
  `EffectSpellClassMaskB_1` bigint(20) NOT NULL COMMENT 'EffectSpellClassMaskB_1',
  `EffectSpellClassMaskB_2` bigint(20) NOT NULL COMMENT 'EffectSpellClassMaskB_2',
  `EffectSpellClassMaskB_3` bigint(20) NOT NULL COMMENT 'EffectSpellClassMaskB_3',
  `EffectSpellClassMaskC_1` bigint(20) NOT NULL COMMENT 'EffectSpellClassMaskC_1',
  `EffectSpellClassMaskC_2` bigint(20) NOT NULL COMMENT 'EffectSpellClassMaskC_2',
  `EffectSpellClassMaskC_3` bigint(20) NOT NULL COMMENT 'EffectSpellClassMaskC_3',
  `SpellVisual_1` bigint(20) NOT NULL COMMENT 'SpellVisual_1',
  `SpellVisual_2` bigint(20) NOT NULL COMMENT 'SpellVisual_2',
  `SpellIconID` bigint(20) NOT NULL COMMENT 'SpellIconID',
  `activeIconID` bigint(20) NOT NULL COMMENT 'activeIconID',
  `spellPriority` bigint(20) NOT NULL COMMENT 'spellPriority',
  `SpellName_en` text,
  `SpellName_2` text NOT NULL COMMENT 'SpellName_2',
  `SpellName_fr` text,
  `SpellName_de` text,
  `SpellName_5` text NOT NULL COMMENT 'SpellName_5',
  `SpellName_6` text NOT NULL COMMENT 'SpellName_6',
  `SpellName_es` text,
  `SpellName_8` text NOT NULL COMMENT 'SpellName_8',
  `SpellName_ru` text,
  `SpellName_10` text NOT NULL COMMENT 'SpellName_10',
  `SpellName_11` text NOT NULL COMMENT 'SpellName_11',
  `SpellName_12` text NOT NULL COMMENT 'SpellName_12',
  `SpellName_13` text NOT NULL COMMENT 'SpellName_13',
  `SpellName_14` text NOT NULL COMMENT 'SpellName_14',
  `SpellName_15` text NOT NULL COMMENT 'SpellName_15',
  `SpellName_16` text NOT NULL COMMENT 'SpellName_16',
  `SpellNameFlag` bigint(20) NOT NULL COMMENT 'SpellNameFlag',
  `Rank_en` text,
  `Rank_2` text NOT NULL COMMENT 'Rank_2',
  `Rank_fr` text,
  `Rank_de` text,
  `Rank_5` text NOT NULL COMMENT 'Rank_5',
  `Rank_6` text NOT NULL COMMENT 'Rank_6',
  `Rank_es` text,
  `Rank_8` text NOT NULL COMMENT 'Rank_8',
  `Rank_ru` text,
  `Rank_10` text NOT NULL COMMENT 'Rank_10',
  `Rank_11` text NOT NULL COMMENT 'Rank_11',
  `Rank_12` text NOT NULL COMMENT 'Rank_12',
  `Rank_13` text NOT NULL COMMENT 'Rank_13',
  `Rank_14` text NOT NULL COMMENT 'Rank_14',
  `Rank_15` text NOT NULL COMMENT 'Rank_15',
  `Rank_16` text NOT NULL COMMENT 'Rank_16',
  `RankFlags` bigint(20) NOT NULL COMMENT 'RankFlags',
  `Description_en` text,
  `Description_2` text NOT NULL COMMENT 'Description_2',
  `Description_fr` text,
  `Description_de` text,
  `Description_5` text NOT NULL COMMENT 'Description_5',
  `Description_6` text NOT NULL COMMENT 'Description_6',
  `Description_es` text,
  `Description_8` text NOT NULL COMMENT 'Description_8',
  `Description_ru` text,
  `Description_10` text NOT NULL COMMENT 'Description_10',
  `Description_11` text NOT NULL COMMENT 'Description_11',
  `Description_12` text NOT NULL COMMENT 'Description_12',
  `Description_13` text NOT NULL COMMENT 'Description_13',
  `Description_14` text NOT NULL COMMENT 'Description_14',
  `Description_15` text NOT NULL COMMENT 'Description_15',
  `Description_16` text NOT NULL COMMENT 'Description_16',
  `DescriptionFlags` bigint(20) NOT NULL COMMENT 'DescriptionFlags',
  `ToolTip_en` text,
  `ToolTip_2` text NOT NULL COMMENT 'ToolTip_2',
  `Tooltip_fr` text,
  `Tooltip_de` text,
  `ToolTip_5` text NOT NULL COMMENT 'ToolTip_5',
  `ToolTip_6` text NOT NULL COMMENT 'ToolTip_6',
  `Tooltip_es` text,
  `ToolTip_8` text NOT NULL COMMENT 'ToolTip_8',
  `Tooltip_ru` text,
  `ToolTip_10` text NOT NULL COMMENT 'ToolTip_10',
  `ToolTip_11` text NOT NULL COMMENT 'ToolTip_11',
  `ToolTip_12` text NOT NULL COMMENT 'ToolTip_12',
  `ToolTip_13` text NOT NULL COMMENT 'ToolTip_13',
  `ToolTip_14` text NOT NULL COMMENT 'ToolTip_14',
  `ToolTip_15` text NOT NULL COMMENT 'ToolTip_15',
  `ToolTip_16` text NOT NULL COMMENT 'ToolTip_16',
  `ToolTipFlags` bigint(20) NOT NULL COMMENT 'ToolTipFlags',
  `ManaCostPercentage` bigint(20) NOT NULL COMMENT 'ManaCostPercentage',
  `StartRecoveryCategory` bigint(20) NOT NULL COMMENT 'StartRecoveryCategory',
  `StartRecoveryTime` bigint(20) NOT NULL COMMENT 'StartRecoveryTime',
  `MaxTargetLevel` bigint(20) NOT NULL COMMENT 'MaxTargetLevel',
  `SpellFamilyName` bigint(20) NOT NULL COMMENT 'SpellFamilyName',
  `SpellFamilyFlags` bigint(20) NOT NULL COMMENT 'SpellFamilyFlags',
  `SpellFamilyFlags2` bigint(20) NOT NULL COMMENT 'SpellFamilyFlags2',
  `MaxAffectedTargets` bigint(20) NOT NULL COMMENT 'MaxAffectedTargets',
  `DmgClass` bigint(20) NOT NULL COMMENT 'DmgClass',
  `PreventionType` bigint(20) NOT NULL COMMENT 'PreventionType',
  `StanceBarOrder` bigint(20) NOT NULL COMMENT 'StanceBarOrder',
  `DmgMultiplier_1` bigint(20) NOT NULL COMMENT 'DmgMultiplier_1',
  `DmgMultiplier_2` bigint(20) NOT NULL COMMENT 'DmgMultiplier_2',
  `DmgMultiplier_3` bigint(20) NOT NULL COMMENT 'DmgMultiplier_3',
  `MinFactionId` bigint(20) NOT NULL COMMENT 'MinFactionId',
  `MinReputation` bigint(20) NOT NULL COMMENT 'MinReputation',
  `RequiredAuraVision` bigint(20) NOT NULL COMMENT 'RequiredAuraVision',
  `TotemCategory_1` bigint(20) NOT NULL COMMENT 'TotemCategory_1',
  `TotemCategory_2` bigint(20) NOT NULL COMMENT 'TotemCategory_2',
  `AreaGroupId` bigint(20) NOT NULL COMMENT 'AreaGroupId',
  `SchoolMask` bigint(20) NOT NULL COMMENT 'SchoolMask',
  `runeCostID` bigint(20) NOT NULL COMMENT 'runeCostID',
  `spellMissileID` bigint(20) NOT NULL COMMENT 'spellMissileID',
  `PowerDisplayId` bigint(20) NOT NULL COMMENT 'PowerDisplayId',
  `unk_320_4_1` bigint(20) NOT NULL COMMENT 'unk_320_4_1',
  `unk_320_4_2` bigint(20) NOT NULL COMMENT 'unk_320_4_2',
  `unk_320_4_3` bigint(20) NOT NULL COMMENT 'unk_320_4_3',
  `spellDescriptionVariableID` bigint(20) NOT NULL COMMENT 'spellDescriptionVariableID',
  `SpellDifficultyId` bigint(20) NOT NULL COMMENT 'SpellDifficultyId',
  `f_234` bigint(20) NOT NULL COMMENT 'f_234',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_spellenchantment`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_spellenchantment` (
  `id` int(11) NOT NULL,
  `Value` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_spell_duration`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_spell_duration` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `duration_1` int(11) DEFAULT NULL,
  `duration_2` int(11) DEFAULT NULL,
  `duration_3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_spell_icon`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_spell_icon` (
  `id` int(11) NOT NULL DEFAULT '0',
  `icon` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='export of spellicon.dbc';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_ssd`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_ssd` (
  `entry` int(11) NOT NULL,
  `StatMod_0` int(11) DEFAULT NULL,
  `StatMod_1` int(11) DEFAULT NULL,
  `StatMod_2` int(11) DEFAULT NULL,
  `StatMod_3` int(11) DEFAULT NULL,
  `StatMod_4` int(11) DEFAULT NULL,
  `StatMod_5` int(11) DEFAULT NULL,
  `StatMod_6` int(11) DEFAULT NULL,
  `StatMod_7` int(11) DEFAULT NULL,
  `StatMod_8` int(11) DEFAULT NULL,
  `StatMod_9` int(11) DEFAULT NULL,
  `Modifier_0` int(11) DEFAULT NULL,
  `Modifier_1` int(11) DEFAULT NULL,
  `Modifier_2` int(11) DEFAULT NULL,
  `Modifier_3` int(11) DEFAULT NULL,
  `Modifier_4` int(11) DEFAULT NULL,
  `Modifier_5` int(11) DEFAULT NULL,
  `Modifier_6` int(11) DEFAULT NULL,
  `Modifier_7` int(11) DEFAULT NULL,
  `Modifier_8` int(11) DEFAULT NULL,
  `Modifier_9` int(11) DEFAULT NULL,
  `MaxLevel` int(11) NOT NULL,
  PRIMARY KEY (`entry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ScalingStatDistribution.dbc';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_ssv`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_ssv` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `ssdMultiplier_0` int(11) NOT NULL,
  `ssdMultiplier_1` int(11) NOT NULL,
  `ssdMultiplier_2` int(11) NOT NULL,
  `ssdMultiplier_3` int(11) NOT NULL,
  `armorMod_0` int(11) NOT NULL,
  `armorMod_1` int(11) NOT NULL,
  `armorMod_2` int(11) NOT NULL,
  `armorMod_3` int(11) NOT NULL,
  `dpsMod_0` int(11) NOT NULL,
  `dpsMod_1` int(11) NOT NULL,
  `dpsMod_2` int(11) NOT NULL,
  `dpsMod_3` int(11) NOT NULL,
  `dpsMod_4` int(11) NOT NULL,
  `dpsMod_5` int(11) NOT NULL,
  `spellBonus` int(11) NOT NULL,
  `ssdMultiplier2` int(11) NOT NULL,
  `ssdMultiplier3` int(11) NOT NULL,
  `unk` int(11) NOT NULL,
  `armorMod2_0` int(11) NOT NULL,
  `armorMod2_1` int(11) NOT NULL,
  `armorMod2_2` int(11) NOT NULL,
  `armorMod2_3` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ScalingStatValues.dbc';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_store_cart`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_store_cart` (
  `id` int(11) NOT NULL,
  `last_save` int(11) NOT NULL,
  `items` text NOT NULL,
  `xstoken` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_store_categories`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
-- Última revisión: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_store_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '-1',
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `visibleTo` int(11) DEFAULT '0',
  `items_count` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`cat_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_store_items`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
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
  `itemset_pieces` text NOT NULL,
  `discount` int(11) NOT NULL,
  `gold_amount` int(11) NOT NULL,
  `prof_skill_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_talents`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
-- Última revisión: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_talents` (
  `TalentID` int(11) NOT NULL,
  `TalentTab` int(11) NOT NULL,
  `Row` int(11) DEFAULT NULL,
  `Col` int(11) DEFAULT NULL,
  `Rank_1` int(11) DEFAULT NULL,
  `Rank_2` int(11) DEFAULT NULL,
  `Rank_3` int(11) DEFAULT NULL,
  `Rank_4` int(11) DEFAULT NULL,
  `Rank_5` int(11) DEFAULT NULL,
  PRIMARY KEY (`TalentID`),
  UNIQUE KEY `idx_id` (`TalentID`),
  KEY `idx_tab` (`TalentTab`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_talent_icons`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_talent_icons` (
  `class` int(11) NOT NULL,
  `spec` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `name_de` text,
  `name_en` text,
  `name_es` text,
  `name_fr` text,
  `name_ru` text,
  `dps` int(1) NOT NULL DEFAULT '0',
  `tank` int(1) NOT NULL DEFAULT '0',
  `healer` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`class`,`spec`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_titles`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 28-03-2012 a las 15:50:37
--

CREATE TABLE IF NOT EXISTS `wow_titles` (
  `id` int(11) NOT NULL,
  `title_M_de` text NOT NULL,
  `title_M_en` text NOT NULL,
  `title_M_es` text NOT NULL,
  `title_M_fr` text NOT NULL,
  `title_M_ru` text NOT NULL,
  `title_F_de` text NOT NULL,
  `title_F_en` text NOT NULL,
  `title_F_es` text NOT NULL,
  `title_F_fr` text NOT NULL,
  `title_F_ru` text NOT NULL,
  `place` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_users`
--
-- Creación: 28-03-2012 a las 15:50:42
-- Última actualización: 03-04-2012 a las 05:36:43
--

CREATE TABLE IF NOT EXISTS `wow_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chars_save` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=739060 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_users_accounts`
--
-- Creación: 28-03-2012 a las 15:50:43
-- Última actualización: 03-04-2012 a las 05:37:00
-- Última revisión: 28-03-2012 a las 15:50:44
--

CREATE TABLE IF NOT EXISTS `wow_users_accounts` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '''''',
  `nickname` varchar(32) NOT NULL,
  `lastactivity` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`account_id`),
  KEY `nickname` (`nickname`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_user_characters`
--
-- Creación: 28-03-2012 a las 15:50:37
-- Última actualización: 03-04-2012 a las 05:36:43
-- Última revisión: 28-03-2012 a las 15:50:42
--

CREATE TABLE IF NOT EXISTS `wow_user_characters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bn_id` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  `index` int(11) DEFAULT '1',
  `guid` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `class` smallint(6) NOT NULL,
  `class_text` varchar(50) NOT NULL,
  `class_key` varchar(30) NOT NULL,
  `race` smallint(6) NOT NULL,
  `race_text` varchar(50) NOT NULL,
  `race_key` varchar(30) NOT NULL,
  `gender` smallint(6) NOT NULL,
  `level` int(11) NOT NULL,
  `realmId` int(11) NOT NULL DEFAULT '0',
  `realmName` varchar(255) NOT NULL,
  `isActive` int(11) DEFAULT NULL,
  `faction` smallint(1) NOT NULL,
  `faction_text` varchar(15) NOT NULL,
  `guildId` int(11) NOT NULL,
  `guildName` varchar(50) NOT NULL,
  `guildUrl` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`account`,`guid`,`realmId`),
  KEY `account` (`account`),
  KEY `guid` (`guid`),
  KEY `realmId` (`realmId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=8462066 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_user_friends`
--
-- Creación: 28-03-2012 a las 15:50:42
-- Última actualización: 03-04-2012 a las 01:19:59
-- Última revisión: 28-03-2012 a las 15:50:42
--

CREATE TABLE IF NOT EXISTS `wow_user_friends` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_acc` int(11) NOT NULL,
  `user_guid` int(10) NOT NULL,
  `user_realm` int(3) NOT NULL,
  `friend_acc` int(11) NOT NULL,
  `friend_guid` int(10) NOT NULL,
  `friend_realm` int(3) NOT NULL,
  `mutual_act` varchar(22) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_acc` (`user_acc`,`friend_acc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=565 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_user_groups`
--
-- Creación: 28-03-2012 a las 15:50:42
-- Última actualización: 28-03-2012 a las 15:50:42
--

CREATE TABLE IF NOT EXISTS `wow_user_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_title` varchar(32) NOT NULL,
  `group_mask` int(11) NOT NULL,
  `group_style` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_user_settings`
--
-- Creación: 28-03-2012 a las 15:50:42
-- Última actualización: 02-04-2012 a las 21:16:20
--

CREATE TABLE IF NOT EXISTS `wow_user_settings` (
  `account` int(11) NOT NULL,
  `forums_signature` text,
  PRIMARY KEY (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wow_zones`
--
-- Creación: 28-03-2012 a las 15:50:44
-- Última actualización: 28-03-2012 a las 15:50:44
-- Última revisión: 28-03-2012 a las 15:50:44
--

CREATE TABLE IF NOT EXISTS `wow_zones` (
  `id` int(11) NOT NULL DEFAULT '0',
  `map` int(11) NOT NULL DEFAULT '0',
  `area` int(11) NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `y_min` float NOT NULL DEFAULT '0',
  `y_max` float NOT NULL DEFAULT '0',
  `x_min` float NOT NULL DEFAULT '0',
  `x_max` float NOT NULL DEFAULT '0',
  `virtualMapID` int(11) NOT NULL DEFAULT '0',
  `dungeonMapID` int(11) NOT NULL DEFAULT '0',
  `someMapID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `map` (`map`,`area`,`y_min`,`y_max`,`x_min`,`x_max`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Export of WorldMapArea.dbc';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
