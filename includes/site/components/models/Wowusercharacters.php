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

class WowUserCharacters_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowUserCharacters';
	public $m_table = 'wow_user_characters';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'id' => 'Id',
		'bn_id' => array('type' => 'integer'),
		'account' => array('type' => 'integer'),
		'index' => array('type' => 'integer'),
		'guid' => array('type' => 'integer'),
		'name' => array('type' => 'string'),
		'class' => array('type' => 'integer'),
		'class_text' => array('type' => 'string'),
		'class_key' => array('type' => 'string'),
		'race' => array('type' => 'integer'),
		'race_text' => array('type' => 'string'),
		'race_key' => array('type' => 'string'),
		'gender' => array('type' => 'integer'),
		'level' => array('type' => 'integer'),
		'realmId' => array('type' => 'integer'),
		'realmName' => array('type' => 'string'),
		'isActive' => array('type' => 'integer'),
		'faction' => array('type' => 'integer'),
		'faction_text' => array('type' => 'string'),
		'guildId' => array('type' => 'integer'),
		'guildName' => array('type' => 'string'),
		'guildUrl' => array('type' => 'string'),
		'url' => array('type' => 'string'),
	);
}
?>