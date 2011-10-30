DROP TABLE IF EXISTS `wow_accounts`;
CREATE TABLE `wow_accounts` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `access_level` int(11) NOT NULL,
  `forums_name` varchar(64) NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Дамп данных таблицы `wow_accounts`
-- 

INSERT INTO `wow_accounts` VALUES (1, 1, 3, 'Shadez', 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_blizztracker_posts`
-- 

DROP TABLE IF EXISTS `wow_blizztracker_posts`;
CREATE TABLE `wow_blizztracker_posts` (
  `tracker_post_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tracker_post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Дамп данных таблицы `wow_blizztracker_posts`
-- 

INSERT INTO `wow_blizztracker_posts` VALUES (1);
INSERT INTO `wow_blizztracker_posts` VALUES (2);
INSERT INTO `wow_blizztracker_posts` VALUES (4);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_bugtracker_items`
-- 

DROP TABLE IF EXISTS `wow_bugtracker_items`;
CREATE TABLE `wow_bugtracker_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `character_realm` int(11) NOT NULL,
  `character_guid` int(11) NOT NULL,
  `post_date` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `description` text NOT NULL,
  `closed` int(11) NOT NULL,
  `admin_response` text NOT NULL,
  `response_date` int(11) NOT NULL,
  `close_date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `wow_bugtracker_items`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_carousel`
-- 

DROP TABLE IF EXISTS `wow_carousel`;
CREATE TABLE `wow_carousel` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Дамп данных таблицы `wow_carousel`
-- 

INSERT INTO `wow_carousel` VALUES (1, 0, 'W9048KIM4MX51303929925283.jpg', '', '4.2 Preview: The Regrowth and Molten Front Daily Quest Hubs', '', '', 'Обзор 4.2: новые локации «Молодой лес» и «Огненная передовая»', '', 'Are you prepared to taste the flames?', '', '', 'Ну что, готовы позажигать?', '/wow/blog/1#blog', 1);
INSERT INTO `wow_carousel` VALUES (2, 1, 'IIXEL03QS75B1304086669604.jpg', '', 'BlizzCast 16 on World of Warcraft Patch 4.2', '', '', 'BlizzCast 16: об обновлении World of Warcraft 4.2 ', '', 'The first-ever video BlizzCast!', '', '', 'Теперь в видеоформате!', '/wow/blog/4#blog', 1);
INSERT INTO `wow_carousel` VALUES (3, 2, 'CLGYC19CZ6901304017526407.jpg', '', '4.2 Preview - A Legendary Engagement ', '', '', 'Обновление 4.2 – легендарное противостояние', '', 'Ever since the death of the Dragon Aspect Malygos, the blue dragonflight has struggled with appointing a new leader...', '', '', 'Драконам нужна ваша помощь!', '/wow/blog/3#blog', 1);
INSERT INTO `wow_carousel` VALUES (4, 3, 'BSDWO1QBW1UM1302166897784.jpg', '', 'Dungeon Finder: Call to Arms', '', '', 'Обновление 4.1: поиск подземелий и «Призыв к оружию»', '', '4.1 Preview -- Dungeon Finder: Call to Arms', '', '', 'Обновление 4.1: поиск подземелий и «Призыв к оружию»', '/wow/blog/2#blog', 1);
INSERT INTO `wow_carousel` VALUES (9, 0, '14B6TPQVSGYC1319725749279.jpg', '', '', 'Inscr?bete en el Pase Anual de World of Warcraft y hazte con Diablo III gratis', '', '', '', '', 'asdsaasasdas', '', '', '/wow/blog/9#blog', 1);
INSERT INTO `wow_carousel` VALUES (8, 0, 'P9FC3E4NQCZS1319203684760.jpg', '', '', 'Blizzard Insider, выпуск 42 – Знакомьтесь: пандарен-монах', '', '', '', '', 'Знакомьтесь: пандарен-монах', '', '', '', 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_forum_category`
-- 

DROP TABLE IF EXISTS `wow_forum_category`;
CREATE TABLE `wow_forum_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `header` smallint(1) NOT NULL DEFAULT '0',
  `parent_cat` int(11) NOT NULL DEFAULT '-1',
  `short` smallint(1) DEFAULT '0',
  `realm_cat` smallint(1) NOT NULL DEFAULT '0',
  `gmlevel` int(11) NOT NULL DEFAULT '0',
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
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

-- 
-- Дамп данных таблицы `wow_forum_category`
-- 

INSERT INTO `wow_forum_category` VALUES (1, 1, -1, 0, 0, 0, 'Support', 'Support', 'Asistencia', 'Assistance', 'Поддержка', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (2, 1, -1, 0, 0, 0, 'Community', 'Community', 'Comunidad', 'Communaut&#233;', 'Сообщество', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (3, 1, -1, 0, 0, 0, 'Gameplay', 'Gameplay', 'Experiencia de juego', 'Exp&#233;rience de jeu', 'Игровой процесс', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (4, 1, -1, 0, 0, 0, 'PvP - Spieler gegen Spieler', 'Player versus Player', 'JcJ', 'Joueur contre Joueur', 'Бои между игроками (PvP)', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (5, 1, -1, 0, 0, 0, 'Klassenrollen', 'Class Roles', 'Funci&#243;n de clases', 'Fonctions des classes', 'Классовые роли', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (6, 1, -1, 1, 0, 0, 'Klassen', 'Classes', 'Clases', 'Classes', 'Классы', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (7, 0, 1, 1, 0, 0, '', 'Customer Support', 'Customer Support', '', 'Служба поддержки', '', 'Blizzard Support Agent moderated forum to discuss and inquire about in-game and account related issues.', 'Blizzard Support Agent moderated forum to discuss and inquire about in-game and account related issues.', '', 'Форум, модерируемый представителями служб поддержки Blizzard, предназначенный для вопросов и обсуждения проблем, связанных с игрой или учетными записями.', 'gmsupport.gif');
INSERT INTO `wow_forum_category` VALUES (8, 0, 1, 0, 0, 0, 'Technical Support', '', 'Techsupport', '', 'Техническая поддержка', '', 'For technical issues including problems installing or patching World of Warcraft, connecting to the realms or crashing during game play.', 'For technical issues including problems installing or patching World of Warcraft, connecting to the realms or crashing during game play.', '', 'Помощь в устранении технических проблем с установкой и обновлением World of Warcraft, соединением с игровыми мирами и зависанием игры.', 'techsupport.gif');
INSERT INTO `wow_forum_category` VALUES (9, 0, 1, 0, 0, 0, '', 'Service Status', 'Service Status', '', 'Состояние игровых миров', '', 'Collection of important messages regarding the status of services, such as issues relating to realms.', 'Collection of important messages regarding the status of services, such as issues relating to realms.', '', 'Собрание важных сообщений о статусе игровых миров.', 'blizzard.gif');
INSERT INTO `wow_forum_category` VALUES (10, 0, 2, 0, 0, 0, '', 'Recruitment', 'Recruitment', '', 'Поиск игроков', '', 'Meeting place for those seeking a guild, new members, Arena teammates and leveling partners.', 'Meeting place for those seeking a guild, new members, Arena teammates and leveling partners.', '', 'Место встречи одиноких душ: здесь вы найдете гильдию, подберете напарников для Арены и «прокачки» персонажей.', 'recruitment.gif');
INSERT INTO `wow_forum_category` VALUES (11, 0, 2, 0, 0, 0, '', 'Raid and Guild Leadership', 'Raid and Guild Leadership', '', 'Главы гильдий и лидеры рейдов', '', 'A place for new or experienced raid or guild leaders to share tips, discuss challenges and encourage positive leadership development.', 'A place for new or experienced raid or guild leaders to share tips, discuss challenges and encourage positive leadership development.', '', 'Поделитесь своими советами и узнайте все самое захватывающее о буднях глав гильдий и лидеров рейдов.', 'leadership.gif');
INSERT INTO `wow_forum_category` VALUES (12, 0, 2, 0, 0, 0, '', 'Events and Fan Creations', 'Events and Fan Creations', '', 'Жизнь сообщества', '', 'Share the amazing creativity of the World of Warcraft community.', 'Share the amazing creativity of the World of Warcraft community.', '', 'Поделитесь своим творчеством с другими игроками или вместе организуйте незабываемое мероприятие.', 'events.gif');
INSERT INTO `wow_forum_category` VALUES (13, 0, 2, 0, 0, 0, '', 'BlizzCon', 'BlizzCon', '', 'BlizzCon', '', 'The place to share travel tips, past experiences, expectations, and everything else concerning BlizzCon.', 'The place to share travel tips, past experiences, expectations, and everything else concerning BlizzCon.', '', 'Поделитесь советами для путешествующих, прошлым опытом, ожиданиями и всем остальным, что касается BlizzCon.', 'blizzcon.gif');
INSERT INTO `wow_forum_category` VALUES (14, 0, 3, 0, 0, 0, '', 'Newcomers', 'Newcomers', '', 'Помощь новичкам', '', 'Beginners of all levels, meet experienced and helpful players. First stop for those key hints and tips.', 'Beginners of all levels, meet experienced and helpful players. First stop for those key hints and tips.', '', 'Чувствуете себя новичком? Не беда! Здесь вам подскажут выход из ситуации.', 'newcomers.gif');
INSERT INTO `wow_forum_category` VALUES (15, 0, 3, 0, 0, 0, '', 'Quests', 'Quests', '', 'Задания', '', 'Interesting or tricky quests, or just which quests to do when.', 'Interesting or tricky quests, or just which quests to do when.', '', 'Застряли в ходе выполнения? Или просто хотите поделиться интересными заданиями? Тогда вам сюда.', 'quests.gif');
INSERT INTO `wow_forum_category` VALUES (16, 0, 3, 0, 0, 0, '', 'Professions', 'Professions', '', 'Профессии', '', 'Crafters of every trade, share your wisdom and experience.', 'Crafters of every trade, share your wisdom and experience.', '', 'Раскройте секреты мастеров различных ремесел, а также поделитесь информацией о самых «рыбных» местах.', 'professions.gif');
INSERT INTO `wow_forum_category` VALUES (17, 0, 3, 0, 0, 0, '', 'Achievements', 'Achievements', '', 'Достижения', '', 'There is an achievement for almost everything. Some want them all, some just want the really tough ones.', 'There is an achievement for almost everything. Some want them all, some just want the really tough ones.', '', 'Одни пытаются добиться всего и сразу, а другие усердно работают над получением самых сложных достижений.', 'achievements.gif');
INSERT INTO `wow_forum_category` VALUES (18, 0, 3, 0, 0, 0, '', 'Role-Playing', 'Role-Playing', '', 'Ролевая игра', '', 'The gathering place for both role-playing and talking about role-playing.', 'The gathering place for both role-playing and talking about role-playing.', '', 'Посидите в таверне с орками и эльфийками, а также обсудите все аспекты ролевой игры с единомышленниками.', 'roleplay.gif');
INSERT INTO `wow_forum_category` VALUES (19, 0, 3, 0, 0, 0, '', 'Story', 'Story', '', 'История', '', 'Uncover and discuss the Warcraft Universe and storylines of Azeroth.', 'Uncover and discuss the Warcraft Universe and storylines of Azeroth.', '', 'Узнайте все об истории Азерота и вселенной Warcraft.', 'lore.gif');
INSERT INTO `wow_forum_category` VALUES (20, 0, 3, 0, 0, 0, '', 'Raids and Dungeons', 'Raids and Dungeons', '', 'Рейды и подземелья', '', 'Whether you are 5, 10 or 25, this is your hall of discussion.', 'Whether you are 5, 10 or 25, this is your hall of discussion.', '', 'Пять вас, десять или двадцать пять – значения не имеет. Этот раздел создан специально для вас!', 'dungeons.gif');
INSERT INTO `wow_forum_category` VALUES (21, 0, 3, 0, 0, 0, '', 'General', 'General', '', 'Общие темы', '', 'Can&#39;t find a dedicated forum for your gameplay topic? The melting pot of General at your service.', 'Can&#39;t find a dedicated forum for your gameplay topic? The melting pot of General at your service.', '', 'Не можете найти подходящий раздел для обсуждения игры? Добро пожаловать в общий котел! ', 'general.gif');
INSERT INTO `wow_forum_category` VALUES (22, 0, 3, 0, 0, 0, '', 'Interface and Macros', 'Interface and Macros', '', 'Интерфейс и макросы', '', 'Custom interface and helpful macros, always worth checking out.', 'Custom interface and helpful macros, always worth checking out.', '', 'Пытаетесь настроить макросы и изменить пользовательский интерфейс? Загляните сюда.', 'ui.gif');
INSERT INTO `wow_forum_category` VALUES (23, 0, 4, 0, 0, 0, '', 'Arena and Rated Battlegrounds', 'Arena and Rated Battlegrounds', '', 'Арена и рейтинговые поля боя ', '', 'Do you compete in Arenas or Rated Battlegrounds? Share tactics, thoughts and experiences with your peers here.', 'Do you compete in Arenas or Rated Battlegrounds? Share tactics, thoughts and experiences with your peers here.', '', 'Любите соревнования и сражения на максимуме возможностей? Тогда вам сюда. Здесь обсуждаются бои на Аренах и рейтинговых полях боя.', 'arenas.gif');
INSERT INTO `wow_forum_category` VALUES (24, 0, 4, 0, 0, 0, '', 'Battlegrounds and World PvP', 'Battlegrounds and World PvP', '', 'PvP на полях боя и за их пределами', '', 'Find or share advice, tips, and thoughts about Battlegrounds and World PvP.', 'Find or share advice, tips, and thoughts about Battlegrounds and World PvP.', '', 'Вы новичок в PvP? Любите ходить на поля боя ради развлечения или сражаться за их пределами? Тогда вы непременно найдете единомышленников в этом разделе.', 'pvp.gif');
INSERT INTO `wow_forum_category` VALUES (25, 0, 5, 0, 0, 0, '', 'Damage Dealing', 'Damage Dealing', '', 'Нанесение урона', '', 'Whether by steel or magic, damage - lots of it - is your art of perfection.', 'Whether by steel or magic, damage - lots of it - is your art of perfection.', '', 'Будь то магия или клинок, большой урон – ваш способ доказать свое превосходство.', 'role_dd.gif');
INSERT INTO `wow_forum_category` VALUES (26, 0, 5, 0, 0, 0, '', 'Healing', 'Healing', '', 'Лечение', '', 'Keeping your allies alive, sometimes seemingly against their intentions.', 'Keeping your allies alive, sometimes seemingly against their intentions.', '', 'Здесь вы узнаете, как сохранить жизнь вашим союзникам, даже если они всячески сопротивляются.', 'role_heal.gif');
INSERT INTO `wow_forum_category` VALUES (27, 0, 5, 0, 0, 0, '', 'Tanking', 'Tanking', '', 'Танкование', '', 'Blocking the path of your enemy, shielding your companions from certain death.', 'Blocking the path of your enemy, shielding your companions from certain death.', '', 'Враг не пройдет, а щит прикроет спины стремительно отступающих героев!', 'role_tank.gif');
INSERT INTO `wow_forum_category` VALUES (28, 0, 6, 0, 0, 0, '', 'Warrior', 'Warrior', '', 'Воин', '', '', '', '', '', 'class_1.gif');
INSERT INTO `wow_forum_category` VALUES (29, 0, 6, 0, 0, 0, '', 'Paladin', 'Paladin', '', 'Паладин', '', '', '', '', '', 'class_2.gif');
INSERT INTO `wow_forum_category` VALUES (30, 0, 6, 0, 0, 0, '', 'Druid', 'Druid', '', 'Друид', '', '', '', '', '', 'class_11.gif');
INSERT INTO `wow_forum_category` VALUES (31, 0, 6, 0, 0, 0, '', 'Rogue', 'Rogue', '', 'Разбойник', '', '', '', '', '', 'class_4.gif');
INSERT INTO `wow_forum_category` VALUES (32, 0, 6, 0, 0, 0, '', 'Priest', 'Priest', '', 'Жрец', '', '', '', '', '', 'class_5.gif');
INSERT INTO `wow_forum_category` VALUES (33, 0, 6, 0, 0, 0, '', 'Death Knight', 'Death Knight', '', 'Рыцарь Смерти', '', '', '', '', '', 'class_6.gif');
INSERT INTO `wow_forum_category` VALUES (34, 0, 6, 0, 0, 0, '', 'Mage', 'Mage', '', 'Маг', '', '', '', '', '', 'class_8.gif');
INSERT INTO `wow_forum_category` VALUES (35, 0, 6, 0, 0, 0, '', 'Warlock', 'Warlock', '', 'Чернокнижник', '', '', '', '', '', 'class_9.gif');
INSERT INTO `wow_forum_category` VALUES (36, 0, 6, 0, 0, 0, '', 'Hunter', 'Hunter', '', 'Охотник', '', '', '', '', '', 'class_3.gif');
INSERT INTO `wow_forum_category` VALUES (37, 0, 6, 0, 0, 0, '', 'Shaman', 'Shaman', '', 'Шаман', '', '', '', '', '', 'class_7.gif');
INSERT INTO `wow_forum_category` VALUES (38, 1, -1, 1, 1, 0, '', 'Realm Forums', 'Realm Forums', '', 'Игровые миры', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (39, 0, 38, 1, 0, 0, '', 'Armory Realm', 'Armory Realm', '', 'Armory Realm', '', '', '', '', '', '');
INSERT INTO `wow_forum_category` VALUES (40, 0, 38, 1, 0, 0, '', 'Armory Realm 2', 'Armory Realm 2', '', 'Armory Realm 2', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_forum_posts`
-- 

DROP TABLE IF EXISTS `wow_forum_posts`;
CREATE TABLE `wow_forum_posts` (
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
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Дамп данных таблицы `wow_forum_posts`
-- 

INSERT INTO `wow_forum_posts` VALUES (1, 1, 7, 1, 2, 1, 1, 'phpmyadmin', 'This is test topic.', 1319372262, '127.0.0.1', 1, 0, '', 0);
INSERT INTO `wow_forum_posts` VALUES (2, 1, 7, 1, 2, 1, 0, '', 'Message as user', 1319372675, '127.0.0.1', 2, 0, '', 0);
INSERT INTO `wow_forum_posts` VALUES (3, 1, 7, 1, 1, 1, 0, '', 'Another one', 1319372791, '127.0.0.1', 3, 0, '', 1);
INSERT INTO `wow_forum_posts` VALUES (4, 1, 7, 1, 1, 1, 1, 'phpmyadmin', 'as blizz', 1319372832, '127.0.0.1', 4, 0, '', 0);
INSERT INTO `wow_forum_posts` VALUES (5, 1, 7, 1, 1, 1, 1, 'phpmyadmin', 'blizz2', 1319372839, '127.0.0.1', 5, 0, '', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_forum_threads`
-- 

DROP TABLE IF EXISTS `wow_forum_threads`;
CREATE TABLE `wow_forum_threads` (
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
  PRIMARY KEY (`thread_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `wow_forum_threads`
-- 

INSERT INTO `wow_forum_threads` VALUES (1, 7, 1, 2, 1, 'Test Topic', 27, 4, 36, 1319372839, 'phpmyadmin', 5, 1, '1  4 5');

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_main_menu`
-- 

DROP TABLE IF EXISTS `wow_main_menu`;
CREATE TABLE `wow_main_menu` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `wow_main_menu`
-- 

INSERT INTO `wow_main_menu` VALUES (1, 'menu-home', 'index', 'home', '/', 'wow', 'Hauptseite', 'Home', 'Inicio', 'Accueil', 'Главная');
INSERT INTO `wow_main_menu` VALUES (2, 'menu-game', 'game', 'game', '/game/', 'wow', 'Spiel', 'Game', 'Juego', 'Jeu', 'Игра');
INSERT INTO `wow_main_menu` VALUES (3, 'menu-community', 'community', 'community', '/community/', 'wow', 'Community', 'Community', 'Comunidad', 'Communaut&#233;', 'Сообщество');
INSERT INTO `wow_main_menu` VALUES (4, 'menu-media', 'media', 'media', '/media/', 'wow', 'Media', 'Media', 'Medios', 'M&#233;dias', 'Материалы');
INSERT INTO `wow_main_menu` VALUES (5, 'menu-forums', 'forums', 'forums', '/forum/', 'wow', 'Foren', 'Forums', 'Foros', 'Forums', 'Форумы');
INSERT INTO `wow_main_menu` VALUES (6, 'menu-services', 'services', 'services', '/store/', 'wow', 'Onlineshop', 'Store', 'Tienda', 'Boutique', 'Магазин');

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_media_screenshots`
-- 

DROP TABLE IF EXISTS `wow_media_screenshots`;
CREATE TABLE `wow_media_screenshots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `post_date` int(11) NOT NULL,
  `approved` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `wow_media_screenshots`
-- 

INSERT INTO `wow_media_screenshots` VALUES (1, '1.jpg', 1319976041, 1, 1);
INSERT INTO `wow_media_screenshots` VALUES (2, '2.jpg', 1319916041, 1, 1);
INSERT INTO `wow_media_screenshots` VALUES (3, '3.jpg', 1319976041, 1, 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_media_videos`
-- 

DROP TABLE IF EXISTS `wow_media_videos`;
CREATE TABLE `wow_media_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(64) NOT NULL,
  `post_date` int(11) NOT NULL,
  `youtube` varchar(30) NOT NULL,
  `approved` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sender_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `wow_media_videos`
-- 

INSERT INTO `wow_media_videos` VALUES (1, 'blizzard-2011', 1319960967, 'rQKtBqdjKIs', 1, 'Blizzard 2011 Year in Review', 0);
INSERT INTO `wow_media_videos` VALUES (2, 'blizzcon-2011-promo', 1319961567, '-ebeCWVEoW4', 1, 'BlizzCon 2011 Promo', 0);
INSERT INTO `wow_media_videos` VALUES (3, 'blizz-celebrates-wwd', 1319961967, 'Xt5KlcLEwLw', 1, 'Blizzard Celebrates World Wish Day', 0);
INSERT INTO `wow_media_videos` VALUES (6, 'wowmop-dungeon-preview', 1319971798, 'SBQAnNwuqp0', 1, 'WoWMOP dungeon preview', 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_news`
-- 

DROP TABLE IF EXISTS `wow_news`;
CREATE TABLE `wow_news` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Дамп данных таблицы `wow_news`
-- 

INSERT INTO `wow_news` VALUES (1, 'O5XFUQR5TAK41303929883528.jpg', 'I2K1W76GAA7I1303929902385.jpg', '', 'Patch 4.2 Preview: The Firelands', '', '', 'Обзор обновления 4.2 – Огненные просторы', '', '<i>For ages, the Elemental Plane served its purpose as a secure realm to imprison Azeroth''s primordial spirits... until the Cataclysm ruptured its boundaries. Without warning, Ragnaros''s armies surged toward Mount Hyjal, intent on burning the World Tree of Nordrassil to the ground. In the ensuing conflict, many brave heroes gave their lives to protect Hyjal from destruction. By their noble sacrifices, the impossible was achieved: the Guardians of Hyjal pushed Ragnaros''s minions back into the Firelands.</i>', '', '', 'Обитель стихий столетиями служила надежной тюрьмой, где томились первобытные духи Азерота…. Однако глобальный Катаклизм высвободил их из заточения. Армия Рагнароса вероломно устремилась к горе Хиджал с целью сжечь Нордрассил, Древо Мира. Многие герои отдали свои жизни, защищая Хиджал от разрушения. Благодаря их самоотверженности Стражам Хиджала удалось сделать практически невозможное – вытеснить приспешников Рагнароса назад в Огненные Просторы.', '', '<p><em>For ages, the Elemental Plane served its purpose as a secure realm to imprison Azeroth''s primordial spirits... until the Cataclysm ruptured its boundaries. Without warning, Ragnaros''s armies surged toward Mount Hyjal, intent on burning the World Tree of Nordrassil to the ground. In the ensuing conflict, many brave heroes gave their lives to protect Hyjal from destruction. By their noble sacrifices, the impossible was achieved: the Guardians of Hyjal pushed Ragnaros''s minions back into the Firelands.</em></p>\r\n	<p><em>Now, the battle to protect Hyjal rages in Ragnaros''s smoldering realm. As territory is gained and Azeroth''s champions edge closer to the Firelands'' inner sanctums, a monumental task lies ahead. Entrenched around Ragnaros''s lair </em><em>-- Sulfuron Keep </em><em>-- are his most trusted guardians, including the turncoat Druids of the Flame and their mysterious leader. Yet Hyjal''s defenders cannot afford to shy away from any of these dangers. Should Ragnaros prevail against the incursion and succeed in destroying Nordrassil, Azeroth will suffer a blow from which it might never recover.</em></p>\r\n	<p>World of Warcraft patch 4.2 will offer hardy adventurers an opportunity to turn the tide in the Firelands, a huge outdoor raid of the highest difficulty, with 10-person and 25-person normal and Heroic modes. It will be a scorching opportunity to delve into this Elemental Plane, where six unique bosses stand between you and the reinvigorated Ragnaros. The great fire lord''s chamber is shielded by:</p>\r\n	<p style="margin-left: 40px"><strong>Beth''tilac </strong></p>\r\n	<p style="margin-left: 40px">Her fiery webs reach far overhead, daring her adversaries to simultaneously face their fears of both spiders and heights. Only by taking hold of her webs and climbing into her domain yourself will you find a way to thwart her evil designs.</p>\r\n	<center>\r\n		<img alt="" src="http://eu.media4.battle.net/cms/gallery/2QP1HK0RUB5G1303984567680.jpg" style="border-bottom: 2px solid; border-left: 2px solid; width: 500px; height: 313px; border-top: 2px solid; border-right: 2px solid" /></center>\r\n	<p style="margin-left: 40px"><strong>Lord Rhyolith</strong></p>\r\n	<p style="margin-left: 40px">Heroes face a difficult challenge: attack this massive magma giant''s bulk while forcing him to move against his will among volcanic eruptions that ultimately spell his doom... or yours.</p>\r\n	<p style="margin-left: 40px"><strong>Alysrazor</strong></p>\r\n	<p style="margin-left: 40px">Are you ready to fly the fiery skies? Catch her singed feathers and use them to soar above the inferno, or perish at the whim of this swift firehawk.</p>\r\n	<center>\r\n		<img alt="" src="http://eu.media4.battle.net/cms/gallery/PDP8SCATQZU91303984528023.jpg" style="border-bottom: 2px solid; border-left: 2px solid; width: 500px; height: 313px; border-top: 2px solid; border-right: 2px solid" /></center>\r\n	<center>\r\n		<p style="text-align: left; margin-left: 40px"><strong>Shannox</strong></p>\r\n	</center>\r\n	<p style="margin-left: 40px">The ferocious flamewakers of this Elemental Plane are terrifying enough, but Shannox has brought companions to his side in defense of the Firelands. This mighty hunter will require that you find a way to deal with his blazing pets before he burns you to a crisp.</p>\r\n	<center>\r\n		<p><img alt="" src="http://eu.media5.battle.net/cms/gallery/FUF68SOI7DZG1303984579516.jpg" style="border-bottom: 2px solid; border-left: 2px solid; width: 500px; height: 313px; border-top: 2px solid; border-right: 2px solid" /></p>\r\n	</center>\r\n	<p style="margin-left: 40px"><strong>Baleroc The Gatekeeper</strong></p>\r\n	<p style="margin-left: 40px">Baleroc stands before the gate to Sulfuron Keep, amidst a river of combustion that serves as the Sulfuron moat. The bridge to Ragnaros’s blistering chamber can only be crossed by those who find a way to put an end to this towering elemental monstrosity.</p>\r\n	<p style="margin-left: 40px"><strong>Majordomo Staghelm the Flame Archdruid</strong></p>\r\n	<p style="margin-left: 40px">Ragnaros''s latest chief lieutenant stands before the door to his master''s chamber in Sulfuron Keep. Majordomo Staghelm''s treasonous efforts will all come to a head before the very seat of his new master.</p>\r\n	<center>\r\n		<p><img alt="" src="http://eu.media3.battle.net/cms/gallery/3CVGETP011G01303984609225.jpg" style="border-bottom: 2px solid; border-left: 2px solid; width: 500px; height: 313px; border-top: 2px solid; border-right: 2px solid" /></p>\r\n	</center>\r\n	<p>Defeat his guardians and a memorable battle with the enraged Ragnaros awaits you in his chamber. Ragnaros''s normal and Heroic modes offer two completely different encounters for raiders to conquer.</p>\r\n	<p>Because the Firelands raid is outdoors, players will be able to mount and attempt to avoid the highly dangerous groups of enemies milling about. The order in which you engage the first four bosses in the zone will be up to you.</p>\r\n	<center>\r\n		<p><img alt="" src="http://eu.media5.battle.net/cms/gallery/NJV393ZBCEN71303984553422.jpg" style="border-bottom: 2px solid; border-left: 2px solid; width: 275px; height: 172px; margin-left: 10px; border-top: 2px solid; margin-right: 10px; border-right: 2px solid" /><img alt="" src="http://eu.media3.battle.net/cms/gallery/GQWJYONHEXID1303984540601.jpg" style="border-bottom: 2px solid; border-left: 2px solid; width: 275px; height: 172px; margin-left: 5px; border-top: 2px solid; margin-right: 5px; border-right: 2px solid" /></p>\r\n	</center>\r\n	<p>This will also be one stop of many in a quest to build the legendary staff Dragonwrath, Tarecgosa’s Rest. A weapon of unsurpassed quality, Dragonwrath, Tarecgosa’s Rest will not only require a spectacular effort by its owner to construct; it will reward the entire guild with a new and unique non-combat pet upon completion.</p>\r\n	<p>A tantalizing collection of unique rewards await those who brave the heat, and defeat the lords of the Firelands. With a new raid tier of armor and weapons, three new mounts (including the rare and highly sought flaming Anzu), a slew of new personal and guild achievements, an epic storyline, a grand musical score, and seven unique boss encounters, 4.2 and the Firelands raid will burn an indelible mark in World of Warcraft history.</p>\r\n	<p>Are you prepared to taste the flames?</p>\r\n	<center>\r\n		<p><img alt="" src="http://eu.media1.battle.net/cms/gallery/PQT91EZKS3TW1303984591587.jpg" style="border-bottom: 2px solid; border-left: 2px solid; width: 575px; height: 359px; border-top: 2px solid; border-right: 2px solid" /></p>\r\n	</center>\r\n	<p>&#160;</p>', '', '', '<p><em>Обитель стихий столетиями служила надежной тюрьмой, где томились первобытные духи Азерота…. Однако глобальный Катаклизм высвободил их из заточения. Армия Рагнароса вероломно устремилась к горе Хиджал с целью сжечь Нордрассил, Древо Мира. Многие герои отдали свои жизни, защищая Хиджал от разрушения. Благодаря их самоотверженности Стражам Хиджала удалось сделать практически невозможное – вытеснить приспешников Рагнароса назад в Огненные Просторы.</em></p>\r\n	<p><em>Теперь битва за Хиджал переместилась в пылающую обитель Рагнароса. Шаг за шагом герои Азерота приближаются к твердыне Огненных Просторов, и вскоре им предстоит решить главную задачу. На подступах к крепости Сульфурона, где укрывается Рагнарос, героев ждут самые преданные прислужники Повелителя Огня – коварные друиды пламени во главе с их таинственным предводителем. Защитникам Хиджала не избежать схватки с опасным противником. Если Рагнаросу удастся отбить нападение и исполнить свои намерения, уничтожив Нордрассил, Азерот никогда не оправится от полученных ран.</em></p>\r\n	<p>В обновлении 4.2 для World of Warcraft вы сможете повлиять на ход сражения в Огненных Просторах – огромном рейдовом подземелье открытого типа высокого уровня сложности. У вас появится возможность принять участие в рейдах на 10 и 25 игроков в обычном и героическом режимах. На пути к Рагнаросу вас ждут жаркие схватки с шестью боссами, укрывшимися в Обители стихий. Итак, покои Повелителя Огня охраняют следующие противники: &#160;</p>\r\n	<p style="margin-left: 40px;"><strong>Красная вдова Беф''тилак</strong></p>\r\n	<p style="margin-left: 40px;">Ее огненная паутина тянется в самую высь, поэтому тем, кто захочет с ней сразиться, предстоит побороть в себе не только боязнь пауков, но и высоты. Лишь взобравшись по паутине наверх в логово паучихи, вы сможете разрушить ее коварные планы.</p>\r\n	<center>\r\n		<img alt="" src="http://eu.media4.battle.net/cms/gallery/2QP1HK0RUB5G1303984567680.jpg" style="width: 500px; height: 313px; border-width: 2px; border-style: solid;" /></center>\r\n	<p style="margin-left: 40px;"><strong>Повелитель Риолит</strong></p>\r\n	<p style="margin-left: 40px;">Вам предстоит непростой бой: от вас потребуется атаковать магматического великана, выманивая его прямо в потоки извергающейся лавы, которая сулит смерть… Вот только кому: ему или вам?</p>\r\n	<p style="margin-left: 40px;"><strong>Алисразор</strong></p>\r\n	<p style="margin-left: 40px;">Готовы подняться в пылающие небеса? Тогда хватайтесь за опаленные перья огнеястреба и взмывайте с ним над огненной бездной. Держитесь покрепче!</p>\r\n	<center>\r\n		<img alt="" src="http://eu.media4.battle.net/cms/gallery/PDP8SCATQZU91303984528023.jpg" style="width: 500px; height: 313px; border-width: 2px; border-style: solid;" /></center>\r\n	<center>\r\n		<p style="text-align: left; margin-left: 40px;"><strong>Шэннокс</strong></p>\r\n	</center>\r\n	<p style="margin-left: 40px;">Яростные огнеброды, которых можно встретить в Обители стихий, поистине ужасны. Однако Шэннокс привел на защиту Огненных Просторов еще и своих питомцев. Чтобы подобраться к этому могучему охотнику, придется вначале совладать с его пламенеющими псами. Этот босс задаст вам жару!</p>\r\n	<center>\r\n		<p><img alt="" src="http://eu.media5.battle.net/cms/gallery/FUF68SOI7DZG1303984579516.jpg" style="width: 500px; height: 313px; border-width: 2px; border-style: solid;" /></p>\r\n	</center>\r\n	<p style="margin-left: 40px;"><strong>Привратник Бейлрок</strong></p>\r\n	<p style="margin-left: 40px;">Бейлрок охраняет врата крепости Сульфурона. Он стоит в раскаленном потоке лавы, который служит крепостным рвом. По мосту, ведущему в пылающие покои Рагнароса, смогут пройти лишь те, кто найдет способ побороть это огненное чудовище.</p>\r\n	<p style="margin-left: 40px;"><strong>Верховный друид пламени Фэндрал Олений Шлем</strong></p>\r\n	<p style="margin-left: 40px;">Правая рука Рагнароса охраняет вход в покои своего повелителя в крепости Сульфурона. Изменник Фэндрал Олений Шлем попытается сделать все возможное, чтобы преградить путь к трону своего властелина.</p>\r\n	<center>\r\n		<p><img alt="" src="http://eu.media3.battle.net/cms/gallery/3CVGETP011G01303984609225.jpg" style="width: 500px; height: 313px; border-width: 2px; border-style: solid;" /></p>\r\n	</center>\r\n	<p>Устранив стражу, вы сможете сразиться в эпической битве с самим Рагнаросом. Вы также получите возможность одолеть Повелителя Огня в нормальном или героическом режиме, где босс использует абсолютно разные тактики.<br />\r\n	<br />\r\n	Огненные Просторы – рейдовое подземелье открытого типа, поэтому в нем можно использовать средства передвижения, которые могут помочь уйти от отрядов противника, патрулирующих всю территорию. С первыми четырьмя боссами рейда можно сразиться в любом порядке.</p>\r\n	<center>\r\n		<p><img alt="" src="http://eu.media5.battle.net/cms/gallery/NJV393ZBCEN71303984553422.jpg" style="width: 275px; height: 172px; border-width: 2px; border-style: solid; margin-left: 10px; margin-right: 10px;" /><img alt="" src="http://eu.media3.battle.net/cms/gallery/GQWJYONHEXID1303984540601.jpg" style="width: 275px; height: 172px; border-width: 2px; border-style: solid; margin-left: 5px; margin-right: 5px;" /></p>\r\n	</center>\r\n	<p>Выполнив одно из заданий рейда и связанную с ним цепочку заданий, вы сможете получить легендарный посох Гнев Драконов, покой Таресгосы. Чтобы стать обладателем могущественного посоха, от вас потребуется не только проявить упорство, но и поработать сообща со своей гильдией. В награду за это все состоящие в ней персонажи получат уникального спутника.<br />\r\n	<br />\r\n	Тех, кто не боится пламени и готов сразиться с боссами Огненных Просторов, ждет множество уникальных сокровищ. Новая рейдовая экипировка и оружие, три средства передвижения (включая редкого огненного Анзу), а также различные персональные и гильдейские достижения, увлекательная сюжетная линия, неповторимый музыкальный ряд и семь уникальных боссов – все это ждет вас в дополнении 4.2, которое станет очередной яркой вехой в истории World of Warcraft.</p>\r\n	<p>Готовы позажигать? &#160;</p>\r\n	<center>\r\n		<p><img alt="" src="http://eu.media1.battle.net/cms/gallery/PQT91EZKS3TW1303984591587.jpg" style="width: 575px; height: 359px; border-width: 2px; border-style: solid;" /></p>\r\n	</center>\r\n	<p>&#160;</p>', 'Kaivax', 1304224020, 'firelands,         ragnaros,             420          ', 1);
INSERT INTO `wow_news` VALUES (2, 'YWAT87TW7XP91302159241931.jpg', 'E1F52FADHL1U1302159231429.jpg', '', '4.1 Preview -- Dungeon Finder: Call to Arms', '', '', 'Обновление 4.1: поиск подземелий и «Призыв к оружию»', '', 'In patch 4.1 we’ll be introducing a new system to the Dungeon Finder intended to lower queue times, named Call to Arms. This system will automatically detect which class role is currently the least represented in the queue, and offer them additional rewards for entering the Dungeon Finder queue and completing a random level 85 heroic dungeon.', '', '', 'В обновлении 4.1 появится новая функция «Призыв к оружию» для системы поиска подземелий, призванная уменьшить время ожидания входа в подземелье. Она позволит автоматически определять, каких персонажей не хватает для формирования группы. Персонажи 85-го уровня, выполняющие эти роли, будут получать дополнительные награды при прохождении случайных подземелий в героическом режиме.', '', '<p>In patch 4.1 we’ll be introducing a new system to the Dungeon Finder intended to lower queue times, named Call to Arms. This system will automatically detect which class role is currently the least represented in the queue, and offer them additional rewards for entering the Dungeon Finder queue and completing a random level 85 heroic dungeon.</p>\r\n	<p>Any time the Dungeon Finder queue is longer than a few minutes for level 85 heroics the Call to Arms system kicks in and determines which role is the least represented. In the case of tanking being the least represented role, the “Call to Arms: Tanks” icon will display where class roles are chosen in the Dungeon Finder UI, and will also display on the UI when the queue pops and you are selected to enter a dungeon. Regardless of your role, you’ll always be able to see which role currently has a Call to Arms, if any.</p>\r\n	<p>Call to Arms is intended to lower queue times by offering additional rewards for the currently least represented role. To be eligible for the additional rewards you must be selected for the role that is currently in a Call to Arms, queue by yourself (solo queue) for a random level 85 heroic, and complete the dungeon by killing the final boss. Every time you hit these requirements (there is no daily limit) you’ll receive a goodie bag that will contain some gold, a chance at a rare gem, a chance at a flask/potions, a good chance of receiving a non-combat pet (including cross faction pets), and a very rare chance at receiving a mount. The pets offered come from a wide variety of sources, and include ones like the Razzashi Hatchling, Cockatiel, and Tiny Sporebat, but the mounts are those specifically only available through dungeons (not raids), like the <a href="http://eu.battle.net/wow/en/item/32768">Reins of the Raven Lord</a> from Sethekk Halls, <a href="http://eu.battle.net/wow/en/item/35513">Swift White Hawkstrider</a> from Magister’s Terrace, and <a href="http://eu.battle.net/wow/en/item/13335">Deathcharger’s Reins</a> from Stratholme.</p>\r\n	<p>The inclusion of this system is to address the unacceptable queue times currently being experienced by those that queue for the DPS role at max level. The long queue times are, of course, caused by a very simple lack of representation in the Dungeon Finder by tanks, and to some extent healers. We don’t feel the tanking and healing roles have any inherent issues that are causing the representation disparity, but simply that fulfilling them is more responsibility. Understandably players prefer to take on that responsibility in more organized situations than what the Dungeon Finder offers, but maybe we can bribe them a little. While this system gives tanks and healers something extra, the incentive is there so that we can help those in the DPS role get into more dungeons, get better gear, and continue progressing.</p>\r\n	<p>While the gold, gems, flasks, and potions are OK incentives, we knew we needed something more substantial. We had briefly considered Valor Points and epics, but decided that wouldn’t be very fair to the intent of helping DPS players progress, and ultimately wouldn’t keep tanks and healers in the Dungeon Finder system for very long. We settled on pets and dungeon-found mounts as they’re cosmetic/achievement items that players go off mostly go off alone to try to get, so why not change that up and offer them a chance to get some of those elusive pets and mounts in a way that also helps other players? Even if they don''t get a pet or mount, or get one they already have, the gold and other goodies still feel rewarding enough that it won''t feel like a waste of effort.</p>\r\n	<p>We think it’s a pretty solid incentive to get tanks and healers queuing, give max level players another way at the pets and mounts they so desire, and bottom line get queue times down for all those DPS’ers out there. In the case of lower level dungeons, it''s actually not uncommon for DPS to be the least represented role, and so if this new system works out and we''re pleased with the results, we may consider applying this same mechanic to lower level dungeons as well.</p>', '', '', '<p>В обновлении 4.1 появится новая функция «Призыв к оружию» для системы поиска подземелий, призванная уменьшить время ожидания входа в подземелье. Она позволит автоматически определять, каких персонажей не хватает для формирования группы. Персонажи 85-го уровня, выполняющие эти роли, будут получать дополнительные награды при прохождении случайных подземелий в героическом режиме.</p>\r\n	<p>Когда время ожидания входа в подземелье для персонажей 85-го уровня превысит несколько минут, вступит в действие функция «Призыв к оружию», определяющая наименее популярную роль. Если будут нужны «танки», то в интерфейсе системы поиска подземелий появится значок «Призыв к оружию: танки». Такой же значок вы увидите во время приглашения в подземелье, после того как группа будет сформирована. Независимо от вашей функции в группе вы сможете увидеть, какие роли в данный момент поощряются системой «Призыв к оружию» (если таковые имеются).</p>\r\n	<p>Функция «Призыв к оружию» призвана уменьшить время ожидания путем поощрения персонажей, представляющих наименее популярные роли в группе. Для получения награды необходимо, чтобы ваша роль соответствовала указанной в системе «Призыв к оружию». Кроме того, нужно встать в очередь (индивидуально) в случайное подземелье для игроков 85-го уровня в героическом режиме и затем пройти его, убив финального босса. Каждый раз при выполнении указанных условий вы будете получать мешок с сюрпризом (без ограничений по количеству наград в день), в котором вы найдете золото. В нем также может оказаться редкий самоцвет, настой или зелье. Также в мешке с некоторой вероятностью может найтись питомец (включая питомцев, общих для всех фракций) и крайне редко — средство передвижения. Вам могут попасться различные питомцы, например, детеныш раззаши, макао или маленький спороскат. Из мешка можно достать только средства передвижения, встречающиеся в подземельях (но не в рейдах), например, <a href="http://eu.battle.net/wow/ru/item/32768" target="_blank">поводья повелителя воронов</a> из Сетеккских залов, <a href="http://eu.battle.net/wow/ru/item/35513" target="_blank">стремительного белого крылобега</a> с Террасы Магистров или <a href="http://eu.battle.net/wow/ru/item/13335" target="_blank">поводья коня смерти</a> из Стратхольма.</p>\r\n	<p>Данная функция должна уменьшить время, которое бойцы максимального уровня вынуждены проводить в ожидании входа в подземелье. Конечно же, длительное время ожидания связано с тем, что в системе поиска подземелий участвует недостаточно танков и, в какой-то степени, лекарей. Нам не кажется, что это связано с дисбалансом в популярности различных классов. Просто выполнение указанных ролей в группе требует особой ответственности. Именно поэтому игроки предпочитают выполнять эти роли в организованных группах, а не полагаться на систему поиска подземелий. Мы решили поощрить персонажей, которые все же доверяют формирование группы системе. Таким образом, танки и лекари получают определенные бонусы и активнее помогают бойцам чаще проходить подземелье, улучшать экипировку и навыки игры.</p>\r\n	<p>Несмотря на то что золото, самоцветы, настои и зелья — достаточно хорошие стимулы, мы предположили, что этого будет недостаточно. Обсуждалась возможность поощрения персонажей очками доблести и эпической экипировкой, но мы пришли к тому, что это было бы несправедливо по отношению к бойцам и в перспективе не удержало бы танков и лекарей в подземельях. В конце концов, мы остановились на питомцах и средствах передвижения, получаемых в подземельях, так как эти «косметические» награды наиболее популярны среди игроков. Зачастую в подземелья отправляются именно за ними, так почему бы не порадовать игроков этими наградами? Кроме того, так они будут активнее помогать другим персонажам. Даже если им не посчастливится достать из мешка питомца или средство передвижения, золото и прочие награды станут приятным поощрением за прохождение подземелья.</p>\r\n	<p>Нам кажется, что это решение побудит танков и лекарей активнее участвовать в системе поиска подземелий, а также даст возможность персонажам максимального уровня получить питомцев и средства передвижения, о которых они давно мечтали. Параллельно мы поможем и бойцам. В подземельях для персонажей меньшего уровня зачастую складывается прямо противоположная ситуация: не хватает именно DPS. Если новая система хорошо зарекомендует себя на практике, ее можно будет внедрить и в этих подземельях.</p>', 'Bashiok', 1304224020, '', 1);
INSERT INTO `wow_news` VALUES (3, 'ZVAK3LE6GJNU1304016680297.jpg', '6VJEAWL2MN3G1304016720331.jpg', '', 'Patch 4.2 Preview: A Legendary Engagement', '', '', 'Обзор обновления 4.2 – легендарное противостояние', '', 'Ever since the death of the Dragon Aspect Malygos, the blue dragonflight has struggled with appointing a new leader. Its members are now torn between the two likeliest successors: Kalecgos, who champions reconciliation with other races; and Arygos, a scion of Malygos who believes that his kind should withdraw from the world and forge a new path...', '', '', 'После гибели драконьего аспекта Малигоса перед синими драконами встала непростая задача выбрать нового лидера из двух претендентов. Часть драконов поддерживает Калесгоса, который выступает за восстановление дружественных отношений с другими расами; другие же остаются верны Аригосу, потомку Малигоса, который верит, что их род должен искать свой собственный путь за пределами этого мира...', '', '<p><em>Ever since the death of the Dragon Aspect Malygos, the blue dragonflight has struggled with appointing a new leader. Its members are now torn between the two likeliest successors: Kalecgos, who champions reconciliation with other races; and Arygos, a scion of Malygos who believes that his kind should withdraw from the world and forge a new path. To end the constant debates and arguments, the flight has agreed to gather during the Embrace—an extraordinary celestial event in which Azeroth''s two moons come into perfect alignment—in the hopes that a new Aspect will be selected.</em><br />\r\n	<br />\r\n	<em>Yet a recent discovery by the bronze dragon Anachronos bodes ill for this impending ceremony. The timeless dragon has detected sinister magic at work around the Nexus, the blue flight''s frozen lair in Northrend. Along with this find, he has glimpsed a terrifying vision of Azeroth succumbing to flames. The link between this chilling portent and the blue dragons remains unclear, but Anachronos has called upon what some of his kind deem the &#34;short-lived&#34; races to investigate further. If a hero does not rise to the challenge and find the truth, Anachronos''s dire vision of Azeroth''s undoing could become reality.</em><br />\r\n	&#160;</p>\r\n	<center>\r\n		<p><a class="lightbox" href="http://eu.media2.battle.net/cms/gallery/OVVHQGY6WYTJ1303984021458.jpg"><img alt="" src="http://eu.media2.battle.net/cms/gallery/OVVHQGY6WYTJ1303984021458.jpg" style="width: 270px; height: 169px; margin-left: 10px; margin-right: 10px" /></a><em><a class="lightbox" href="http://eu.media3.battle.net/cms/gallery/NOJPCN1K223Z1303984179510.jpg"><img alt="" src="http://eu.media3.battle.net/cms/gallery/NOJPCN1K223Z1303984179510.jpg" style="width: 270px; height: 169px; margin-left: 10px; margin-right: 10px" /></a></em></p>\r\n	</center>\r\n	<p>Patch 4.2 introduces an epic quest that will challenge those daring enough to complete the legendary staff <strong>Dragonwrath, Tarecgosa''s Rest</strong>. The great staff duplicates destructive magics, and also bestows upon its wielder the ability to transform into a member of the Blue Dragonflight. Those who complete the staff won’t be the only ones to receive a reward, though. As this task requires the dedication of an entire guild, upon completion of the staff all guild members will receive a unique non-combat pet to call their own.<br />\r\n	&#160;</p>\r\n	<center>\r\n		<p><a class="lightbox" href="http://eu.media3.battle.net/cms/gallery/1LIRO0M1KWWS1303984799770.jpg"><img alt="" src="http://eu.media3.battle.net/cms/gallery/1LIRO0M1KWWS1303984799770.jpg" style="width: 570px; height: 356px" /></a></p>\r\n		<p><em>Behold the legendary staff Dragonwrath, Tarecgosa''s Rest. Players will need to embark on an epic questline to obtain and upgrade this powerful weapon.</em><br />\r\n		&#160;</p>\r\n	</center>\r\n	<p>Only those who have emerged triumphant against the evils lurking within Blackwing Descent, The Bastion of Twilight, and the Throne of the Four Winds will be eligible to begin the legendary quest.&#160; Bronze Dragonflight emissaries will be sent to the Alliance and Horde capital cities of Stormwind and Orgrimmar to recruit those who are ready to undertake the challenge.<br />\r\n	&#160;</p>\r\n	<center>\r\n		<p><a class="lightbox" href="http://eu.media2.battle.net/cms/gallery/M0NWNSIWF0YQ1303984113602.jpg"><img alt="" src="http://eu.media2.battle.net/cms/gallery/M0NWNSIWF0YQ1303984113602.jpg" style="width: 270px; height: 169px; margin-left: 10px; margin-right: 10px" /></a><a class="lightbox" href="http://eu.media4.battle.net/cms/gallery/7V2IJX8J8REW1303984191041.jpg"><img alt="" src="http://eu.media4.battle.net/cms/gallery/7V2IJX8J8REW1303984191041.jpg" style="width: 270px; height: 169px; margin-left: 10px; margin-right: 10px" /></a></p>\r\n	</center>\r\n	<p>This is not a path to be undertaken lightly. Be warned: the way forward is deadly, the first steps are perilous, and the destination, as yet, unfathomable. The journey will take willing challengers across continents and through time; to meet with ancient beings, to be recognized as one of the most powerful entities on Azeroth; to navigate a lethal web of politics and determine the shape of the future.<br />\r\n	<br />\r\n	While the journey will certainly require progress through the Firelands, where guilds will need to work together to topple the forces of Ragnaros, there are times where those seeking the staff will have to stand alone in order to prove their skill, knowledge, and determination.<br />\r\n	&#160;</p>\r\n	<p>The Bronze Dragonflight is counting on <em>you</em>. The Blue Dragonflight may lose its way without your guidance. Best not keep them waiting.\r\n	</p>', '', '', '<p><i>После гибели драконьего аспекта Малигоса перед синими драконами встала непростая задача выбрать нового лидера из двух претендентов. Часть драконов поддерживает Калесгоса, который выступает за восстановление дружественных отношений с другими расами; другие же остаются верны Аригосу, потомку Малигоса, который верит, что их род должен искать свой собственный путь за пределами этого мира. Чтобы положить конец распрям и спорам и наконец выбрать нового аспекта, синие драконы объявили общий сбор во время Помрачения — небывалого небесного явления, при котором одна луна Азерота полностью закрывает другую.</i></p>\r\n	<p><i>Вместе с тем бронзового дракона Анахроноса посетило пугающее видение о последствиях близящейся церемонии. Он почувствовал средоточие зловещей магии вокруг Нексуса, логова синих драконов в Нордсколе. Одновременно Анахронос увидел, как весь Азерот гибнет в огне. Связь между этим леденящим душу знамением и синими драконами остается неясной, поэтому Анахронос решил обратиться за помощью к «короткоживущим созданиям» (как иногда называют представителей других рас драконы времени). И если не найдется героя, который смог бы раскрыть правду, мрачное предзнаменование может стать реальностью.</i></p>\r\n	<center>\r\n		<p><a class="lightbox" href="http://eu.media2.battle.net/cms/gallery/PT7CVIV03NLR1303984033474.jpg"><img alt="" src="http://eu.media2.battle.net/cms/gallery/OVVHQGY6WYTJ1303984021458.jpg" style="width: 270px; height: 169px; margin-left: 10px; margin-right: 10px;" /></a><em><a class="lightbox" href="http://eu.media1.battle.net/cms/gallery/R3WKSSLR4A1R1303984201851.jpg"><img alt="" src="http://eu.media3.battle.net/cms/gallery/NOJPCN1K223Z1303984179510.jpg" style="width: 270px; height: 169px; margin-left: 10px; margin-right: 10px;" /></a></em></p>\r\n	</center>\r\n	<p>В обновлении 4.2 вас ждет эпическое приключение, пройдя все этапы которого, самые отважные герои смогут воссоздать легендарный посох – Гнев Драконов, покой Таресгосы. Этот посох заключает в себе силу разрушительной магии и наделяет своего владельца способностью превращаться в синего дракона. Впрочем, награды ждут не только тех, кому удастся собрать посох. Так как это задание требует объединенных усилий целой гильдии, то по его завершении все участники получат по уникальному небоевому спутнику.</p>\r\n	<center>\r\n		<p><a class="lightbox" href="http://eu.media3.battle.net/cms/gallery/1LIRO0M1KWWS1303984799770.jpg"><img alt="" src="http://eu.media2.battle.net/cms/gallery/RL31ID7RT1SU1303984127685.jpg" style="width: 570px; height: 356px;" /></a></p>\r\n		<p><em>Легендарный посох Гнев Драконов, покой Таресгосы. Игрокам придется пройти через многое, выполняя специальную цепочку заданий, чтобы получить это грозное оружие.</em><br />\r\n		&#160;</p>\r\n	</center>\r\n	<p>Начать серию легендарных заданий смогут лишь те, кто справился со злом в Твердыне Крыла Тьмы, Сумеречном бастионе и Троне Четырех Ветров. Чтобы найти достойных героев как среди Орды, так и среди Альянса, в Штормград и Оргриммар будут отправлены посланники бронзовых драконов.</p>\r\n	<center>\r\n		<p><a class="lightbox" href="http://eu.media1.battle.net/cms/gallery/ENILAN7JGXA61303984154719.jpg"><img alt="" src="http://eu.media2.battle.net/cms/gallery/M0NWNSIWF0YQ1303984113602.jpg" style="width: 270px; height: 169px; margin-left: 10px; margin-right: 10px;" /></a><a class="lightbox" href="http://eu.media1.battle.net/cms/gallery/FGYB7ZLXN64H1303984168269.jpg"><img alt="" src="http://eu.media4.battle.net/cms/gallery/7V2IJX8J8REW1303984191041.jpg" style="width: 270px; height: 169px; margin-left: 10px; margin-right: 10px;" /></a></p>\r\n	</center>\r\n	<p>Смельчаков ждет серьезное испытание. Этот путь долог, первые же шаги по нему смертельно опасны, а конечная цель пугает своей непостижимостью. Это головокружительное путешествие через пространство и время, в ходе которого бесстрашным героям предстоит встретиться с древними сущностями, доказать свое превосходство над другими силами Азерота, разобраться в паутине политических заговоров и в конце концов определить будущее этого мира.</p>\r\n	<p>Чтобы преуспеть, участники гильдии совместными усилиями должны будут одолеть войска Рагнароса на Огненных Просторах. А тем, кто намерен собрать посох, придется также не раз в одиночку доказывать свое мастерство, мудрость и решимость.</p>\r\n	<p>Бронзовые драконы <i>рассчитывают</i> на вас. Синие драконы могут сбиться с пути без вашей поддержки. Дорога каждая секунда.</p>', 'Daxxarri', 1304224020, '', 1);
INSERT INTO `wow_news` VALUES (9, 'JZSS9773EPFT1319202371086.jpg', '14B6TPQVSGYC1319725749279.jpg', '', '', 'Inscr?bete en el Pase Anual de World of Warcraft y hazte con Diablo III gratis', '', '', '', '', 'Con la sombra de Alamuerte aun surcando Azeroth y los mortales reinos de Santuario afilando sus armas para la guerra contra las fuerzas de Diablo, el Pase Anual de World of Warcraft ha llegado para ofrecer a los jugadores que se inscriban la posibilidad de participar en ambos conflictos apocal?pticos sin causar estragos en el monedero.', '', '', '', '', '<p>\r\n	&nbsp;</p>\r\n<p style="margin-top: 0.5em; margin-right: 0px; margin-bottom: 0.5em; margin-left: 0px; padding-top: 6px; padding-right: 0px; padding-bottom: 6px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; outline-width: 0px; outline-style: initial; outline-color: initial; color: rgb(239, 201, 160); line-height: 24px; background-color: rgb(26, 15, 8); ">\r\n	Con la sombra de Alamuerte aun surcando Azeroth y los mortales reinos de Santuario afilando sus armas para la guerra contra las fuerzas de Diablo, el Pase Anual de World of Warcraft ha llegado para ofrecer a los jugadores que se inscriban la posibilidad de participar en ambos conflictos apocal&iacute;pticos sin causar estragos en el monedero.</p>\r\n<p style="margin-top: 0.5em; margin-right: 0px; margin-bottom: 0.5em; margin-left: 0px; padding-top: 6px; padding-right: 0px; padding-bottom: 6px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; outline-width: 0px; outline-style: initial; outline-color: initial; color: rgb(239, 201, 160); line-height: 24px; background-color: rgb(26, 15, 8); ">\r\n	Durante un tiempo limitado, los jugadores que realicen un acuerdo de 12 meses de suscripci&oacute;n a World of Warcraft mediante el Pase Anual, recibir&aacute;n las siguientes &eacute;picas recompensas:</p>\r\n<ul style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-right: 0px; padding-left: 1em; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; outline-width: 0px; outline-style: initial; outline-color: initial; list-style-type: none; list-style-position: initial; list-style-image: initial; color: rgb(239, 201, 160); line-height: 24px; background-color: rgb(26, 15, 8); ">\r\n	<li style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 1em; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; outline-width: 0px; outline-style: initial; outline-color: initial; list-style-type: disc; list-style-position: initial; list-style-image: initial; ">\r\n		<b>Diablo III gratis:</b>&nbsp;descarga la versi&oacute;n digital del juego a trav&eacute;s de Battle.net, de forma gratuita, cuando lancemos el juego a principios del pr&oacute;ximo a&ntilde;o. Es el juego completo y no una versi&oacute;n de prueba.</li>\r\n	<li style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 1em; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; outline-width: 0px; outline-style: initial; outline-color: initial; list-style-type: disc; list-style-position: initial; list-style-image: initial; ">\r\n		<b>Destrero de Tyrael - Montura voladora para WoW:</b>&nbsp;vuela como el Arc&aacute;ngel de la Justicia con todos tus personajes de una misma cuenta de World of Warcraft. Recibir&aacute;s el Destrero de Tyrael en el correo del juego con el pr&oacute;ximo parche 4.3.</li>\r\n	<li style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 1em; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; outline-width: 0px; outline-style: initial; outline-color: initial; list-style-type: disc; list-style-position: initial; list-style-image: initial; ">\r\n		<b>Acceso beta garantizado:</b>&nbsp;hazte con un hueco de acceso garantizado a la prueba beta de la pr&oacute;xima expansi&oacute;n para World of Warcraft (aun por anunciar).</li>\r\n</ul>\r\n<p style="margin-top: 0.5em; margin-right: 0px; margin-bottom: 0.5em; margin-left: 0px; padding-top: 6px; padding-right: 0px; padding-bottom: 6px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; outline-width: 0px; outline-style: initial; outline-color: initial; color: rgb(239, 201, 160); line-height: 24px; background-color: rgb(26, 15, 8); ">\r\n	Puedes inscribirte en el Pase Anual pagando cuotas mensuales de 12,99 &euro;, o con otro plan de cuotas que tu prefieras. Para poder inscribirte en esta promoci&oacute;n debes ser mayor de 18 a&ntilde;os, tener una tarjeta de cr&eacute;dito v&aacute;lida y haber registrado una versi&oacute;n completa de World of Warcraft antes o durante el 18 de octubre de 2011.</p>\r\n<p style="margin-top: 0.5em; margin-right: 0px; margin-bottom: 0.5em; margin-left: 0px; padding-top: 6px; padding-right: 0px; padding-bottom: 6px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; outline-width: 0px; outline-style: initial; outline-color: initial; color: rgb(239, 201, 160); line-height: 24px; background-color: rgb(26, 15, 8); ">\r\n	Inscr&iacute;bete en el Pase Anual de World of Warcraft&nbsp;<a href="https://eu.battle.net/account/management/wow/promo/d3-signup.html" style="outline-style: none; outline-width: initial; outline-color: initial; text-decoration: none; color: rgb(255, 177, 0); " target="_blank">haciendo clic aqu&iacute;</a>&nbsp;y no dejes de consultar las p&aacute;ginas de comunidad de World of Warcraft y Diablo III para no perderte detalle sobre las fechas de lanzamiento de estas &eacute;picas recompensas.</p>\r\n<p style="margin-top: 0.5em; margin-right: 0px; margin-bottom: 0.5em; margin-left: 0px; padding-top: 6px; padding-right: 0px; padding-bottom: 6px; padding-left: 0px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; outline-width: 0px; outline-style: initial; outline-color: initial; color: rgb(239, 201, 160); line-height: 24px; background-color: rgb(26, 15, 8); ">\r\n	Puedes encontrar m&aacute;s informaci&oacute;n sobre esta promoci&oacute;n, incluyendo requisitos y detalles concretos para los jugadores que quieran hacerse con la versi&oacute;n coleccionista de Diablo III, en el art&iacute;culo de&nbsp;<a href="http://eu.blizzard.com/support/article/D3WoWFAQ" style="outline-style: none; outline-width: initial; outline-color: initial; text-decoration: none; color: rgb(255, 177, 0); " target="_blank">preguntas frecuentes</a>&nbsp;sobre el Pase Anual de World of Warcraft.</p>\r\n', '', '', 'Shadez', 1319988517, 'wow, diablo, mists of pandaria', 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_store_categories`
-- 

DROP TABLE IF EXISTS `wow_store_categories`;
CREATE TABLE `wow_store_categories` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '-1',
  `title` text NOT NULL,
  `desc` text NOT NULL,
  `visibleTo` int(11) NOT NULL,
  `items_count` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Дамп данных таблицы `wow_store_categories`
-- 

INSERT INTO `wow_store_categories` VALUES (1, -1, 'Items', '', 0, 0);
INSERT INTO `wow_store_categories` VALUES (2, -1, 'Mounts', '', 0, 0);
INSERT INTO `wow_store_categories` VALUES (3, 1, 'PvE Tier 10', '', 0, 0);
INSERT INTO `wow_store_categories` VALUES (4, 1, 'PvP Tier 8', '', 0, 0);
INSERT INTO `wow_store_categories` VALUES (5, 3, 'Priest', '', 0, 0);
INSERT INTO `wow_store_categories` VALUES (6, 5, 'SPriest ItemSet (277 iLvl)', '', 0, 0);
INSERT INTO `wow_store_categories` VALUES (7, 6, 'Hands', '', 0, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_store_items`
-- 

DROP TABLE IF EXISTS `wow_store_items`;
CREATE TABLE `wow_store_items` (
  `item_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `in_store` smallint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Дамп данных таблицы `wow_store_items`
-- 

INSERT INTO `wow_store_items` VALUES (51256, 7, '', '', 'priest', 100, 1);
INSERT INTO `wow_store_items` VALUES (51280, 7, '', '', '', 500, 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_user_characters`
-- 

DROP TABLE IF EXISTS `wow_user_characters`;
CREATE TABLE `wow_user_characters` (
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
  PRIMARY KEY (`id`,`account`,`guid`,`realmId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `wow_user_characters`
-- 

INSERT INTO `wow_user_characters` VALUES (5, 0, 1, 0, 1, 'Тонкс', 5, 'Жрец', 'priest', 10, 'Эльф крови', 'blood-elf', 1, 80, 1, 'Armory Realm', 1, 1, 'horde', 1, 'Armory Guild', '/wow/ru/guild/Armory Realm/Armory Guild', '/wow/ru/character/Armory Realm/Тонкс');
INSERT INTO `wow_user_characters` VALUES (6, 0, 1, 1, 2, 'Викодинка', 2, 'Паладин', 'paladin', 10, 'Эльф крови', 'blood-elf', 1, 80, 1, 'Armory Realm', 0, 1, 'horde', 0, '', '/wow/ru/guild/Armory Realm/', '/wow/ru/character/Armory Realm/Викодинка');

-- --------------------------------------------------------

-- 
-- Структура таблицы `wow_users`
-- 

DROP TABLE IF EXISTS `wow_users`;
CREATE TABLE `wow_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chars_save` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `wow_users`
-- 

INSERT INTO `wow_users` VALUES (1, 1320069152);
        