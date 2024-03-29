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

define('SKIP_SHUTDOWN', true);
define('BOOT_FILE', dirname(dirname(dirname(__FILE__))) . '/' . 'includes' . '/' . 'boot.php');
include(BOOT_FILE);
$core->c('Locale')->setLocale('en');
$factions = $core->c('QueryResult', 'Db')
	->model('WowFaction')
	->loadItems();
foreach ($factions as &$f)
{
	echo 'UPDATE wow_faction SET `key` = \'' . str_replace(array('--', '\''), null, strtolower(str_replace(array(' ', ',', '-'), '-', $f['name']))) . '\' WHERE id=' . $f['id'] . ';<br/>';
}
?>