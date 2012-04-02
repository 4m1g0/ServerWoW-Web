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
  'site' => 
  array (
    'creation_youtube_id' => 'DSRrrR4z_ks',
    'path' => '',
    'locale_indexes' => 
    array (
      0 => '0',
      1 => '1',
    ),
    'log' => 
    array (
      'enabled' => '1',
      'filename' => 'Y:\home\wowcs\www\webroot\_debug\tmp.dbg',
      'level' => '3',
    ),
    'title' => 'World of Warcraft',
    'battlegroup' => 'Massive Online',
    'icons_server' => 'http://eu.battle.net/wow-assets/static/images/icons',
    'locale' => 
    array (
      'default' => 'es',
    ),
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
	  'db_id' => 1
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