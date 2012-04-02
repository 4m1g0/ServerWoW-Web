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

$data = $core->c('QueryResult', 'Db')
	->model('WowRaidProgress')
	->keyIndex('entry1')
	->loadItems();
$core->c('Config')->setValue('tmp.db_world.active', 1);
$npcs = $core->c('QueryResult', 'Db')
	->model('CreatureTemplate')
	->keyIndex('entry')
	->fieldCondition('creature_template.entry', array_keys($data))
	->loadItems();
foreach ($npcs as $npc)
{
	$str = 'UPDATE wow_raid_progress SET name_' . $core->c('Locale')->GetLocale() . ' = \'' . str_replace('\'', '\'\'', $npc['name']) . '\'';
	/*for ($i = 1; $i < 3; ++$i)
		if ($npc['difficulty_entry_' . $i] > 0)
			$str .= ', entry' . ($i + 1) . ' = ' . $npc['difficulty_entry_' . $i];*/
	$str .= ' WHERE entry1=' . $npc['entry'] .' LIMIT 1;<br />';
	echo $str;
}
?>