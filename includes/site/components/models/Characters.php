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

class Characters_Model_Component extends Model_Db_Component
{
	public $m_model = 'Characters';
	public $m_table = 'characters';
	public $m_dbType = 'characters';
	public $m_fields = array(
		'guid' => 'Id',
		'account' => array('type' => 'integer'),
		'name' => array('type' => 'string'),
		'race' => array('type' => 'integer'),
		'class' => array('type' => 'integer'),
		'gender' => array('type' => 'integer'),
		'level' => array('type' => 'integer'),
		'xp' => array('type' => 'integer'),
		'money' => array('type' => 'integer'),
		'playerBytes' => array('type' => 'integer'),
		'playerBytes2' => array('type' => 'integer'),
		'playerFlags' => array('type' => 'integer'),
		'position_x' => array('type' => 'integer'),
		'position_y' => array('type' => 'integer'),
		'position_z' => array('type' => 'integer'),
		'map' => array('type' => 'integer'),
		'instance_id' => array('type' => 'integer'),
		'instance_mode_mask' => array('type' => 'integer'),
		'orientation' => array('type' => 'integer'),
		'taximask' => array('type' => 'string'),
		'online' => array('type' => 'integer'),
		'cinematic' => array('type' => 'integer'),
		'totaltime' => array('type' => 'integer'),
		'leveltime' => array('type' => 'integer'),
		'logout_time' => array('type' => 'integer'),
		'is_logout_resting' => array('type' => 'integer'),
		'rest_bonus' => array('type' => 'integer'),
		'resettalents_cost' => array('type' => 'integer'),
		'resettalents_time' => array('type' => 'integer'),
		'trans_x' => array('type' => 'integer'),
		'trans_y' => array('type' => 'integer'),
		'trans_z' => array('type' => 'integer'),
		'trans_o' => array('type' => 'integer'),
		'transguid' => array('type' => 'integer'),
		'extra_flags' => array('type' => 'integer'),
		'stable_slots' => array('type' => 'integer'),
		'at_login' => array('type' => 'integer'),
		'zone' => array('type' => 'integer'),
		'death_expire_time' => array('type' => 'integer'),
		'taxi_path' => array('type' => 'string'),
		'arenaPoints' => array('type' => 'integer'),
		'totalHonorPoints' => array('type' => 'integer'),
		'todayHonorPoints' => array('type' => 'integer'),
		'yesterdayHonorPoints' => array('type' => 'integer'),
		'totalKills' => array('type' => 'integer'),
		'todayKills' => array('type' => 'integer'),
		'yesterdayKills' => array('type' => 'integer'),
		'chosenTitle' => array('type' => 'integer'),
		'knownCurrencies' => array('type' => 'integer'),
		'watchedFaction' => array('type' => 'integer'),
		'drunk' => array('type' => 'integer'),
		'health' => array('type' => 'integer'),
		'power1' => array('type' => 'integer'),
		'power2' => array('type' => 'integer'),
		'power3' => array('type' => 'integer'),
		'power4' => array('type' => 'integer'),
		'power5' => array('type' => 'integer'),
		'power6' => array('type' => 'integer'),
		'power7' => array('type' => 'integer'),
		'latency' => array('type' => 'integer'),
		'speccount' => array('type' => 'integer'),
		'activespec' => array('type' => 'integer'),
		'exploredZones' => array('type' => 'string'),
		'equipmentCache' => array('type' => 'string'),
		'ammoId' => array('type' => 'integer'),
		'knownTitles' => array('type' => 'string'),
		'actionBars' => array('type' => 'integer'),
		'grantableLevels' => array('type' => 'integer'),
		'deleteInfos_Account' => array('type' => 'integer'),
		'deleteInfos_Name' => array('type' => 'string'),
		'deleteDate' => array('type' => 'integer'),
	);
}
?>