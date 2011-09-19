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

class WowAchievement_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowAchievement';
	public $m_table = 'wow_achievement';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'id' => 'Id',
		'factionFlag' => array('type' => 'integer'),
		'parentAchievement' => array('type' => 'integer'),
		'name' => 'Locale',
		'description' => 'Locale',
		'categoryId' => array('type' => 'integer'),
		'points' => array('type' => 'integer'),
		'OrderInCategory' => array('type' => 'integer'),
		'flags' => array('type' => 'integer'),
		'iconID' => array('type' => 'integer'),
		'iconname' => array('type' => 'string'),
		'titleReward' => 'Locale',
		'dungeonDifficulty' => array('type' => 'integer'),
	);
}
?>