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

class LfgDungeonRewards_Model_Component extends Model_Db_Component
{
	public $m_model = 'LfgDungeonRewards';
	public $m_table = 'lfg_dungeon_rewards';
	public $m_dbType = 'world';
	public $m_fields = array(
		'dungeonId' => array('type' => 'integer'),
		'maxLevel' => array('type' => 'integer'),
		'firstQuestId' => array('type' => 'integer'),
		'firstMoneyVar' => array('type' => 'integer'),
		'firstXPVar' => array('type' => 'integer'),
		'otherQuestId' => array('type' => 'integer'),
		'otherMoneyVar' => array('type' => 'integer'),
		'otherXPVar' => array('type' => 'integer'),
	);
}
?>