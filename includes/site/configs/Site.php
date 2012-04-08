<?php

/**
 * Copyright (C) 2009-2011 Shadez <https://github.com/Shadez>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 **/

$SiteConfig = array (
  'cache' => 
  array (
    'memcached' => 
    array (
      'enabled' => '0',
      'configs' => 
      array (
        'server' => '127.0.0.1',
        'port' => '11211',
      ),
      'ttl' => '3600',
    ),
  ),
  'site' => 
  array (
    'path' => '',
    'creation_youtube_id' => 'DSRrrR4z_ks',
    'locale_indexes' => 
    array (
      0 => '0',
      1 => '1',
    ),
    'log' => 
    array (
      'enabled' => '1',
  	  'debug' => '0',
      'filename' => 'S:\\home\\wowcs\\www\\webroot\\_debug\\tmp.dbg',
      'level' => '3',
	  'lag_report' => '0',
    ),
    'locale' => 
    array (
      'default' => 'es',
    ),
    'title' => 'World of Warcraft',
    'description' => 'Server WoW : El mejor Server de World of Warcraft privado blizzlike Version Cataclysm 4.0.6a y Wrath of The lich king 3.3.5a, Juega Gratis WoW',
    'keywords' => 'wow, juegos, multijugador masivo, world of warcraft, blizzlike, cataclysm, wotlk, server, privado, foros',
    'battlegroup' => 'Massive Online',
    'icons_server' => 'http://eu.battle.net/wow-assets/static/images/icons',
    'media_server' => 'http://eu.media.blizzard.com',
    'render_server' => 'http://eu.media.blizzard.com',
  ),
  'misc' => 
  array (
    'admin_email' => 'admin@wowcs',
  ),
  'session' => 
  array (
    'identifier' => 'wow_id',
    'user' => 
    array (
      'storage' => 'wow_session',
    ),
    'magic_string' => 'SESSION_CONVERT',
  ),
  'realms' => 
  array (
    1 => 
    array (
      'id' => '1',
      'name' => 'Armory Realm',
      'type' => 'SERVER_TRINITY',
      'db_id' => 1,
    ),
  ),
  'database' => 
  array (
    'realm' => 
    array (
      'host' => 'localhost',
      'user' => 'root',
      'password' => '',
      'db_name' => 'trinity_auth',
      'charset' => 'UTF8',
      'driver' => 'mysqli',
      'prefix' => '',
    ),
    'characters' => 
    array (
      1 => 
      array (
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'db_name' => 'trinity_characters',
        'charset' => 'UTF8',
        'driver' => 'mysqli',
        'prefix' => '',
      ),
    ),
    'world' => 
    array (
      1 => 
      array (
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'db_name' => 'trinity_world',
        'charset' => 'UTF8',
        'driver' => 'mysqli',
        'prefix' => '',
      ),
    ),
    'wow' => 
    array (
      'host' => 'localhost',
      'user' => 'root',
      'password' => '',
      'db_name' => 'wow_cs',
      'charset' => 'UTF8',
      'driver' => 'mysqli',
      'prefix' => 'wow',
    ),
  ),
);