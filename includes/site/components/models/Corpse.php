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

class Corpse_Model_Component extends Model_Db_Component
{
	public $m_model = 'Corpse';
	public $m_table = 'corpse';
	public $m_dbType = 'characters';
	public $m_fields = array(
		'corpseGuid' => array('type' => 'integer'),
		'guid' => 'Id',
		'posX' => array('type' => 'integer'),
		'posY' => array('type' => 'integer'),
		'posZ' => array('type' => 'integer'),
		'orientation' => array('type' => 'integer'),
		'mapId' => array('type' => 'integer'),
		'phaseMask' => array('type' => 'integer'),
		'displayId' => array('type' => 'integer'),
		'itemCache' => array('type' => 'string'),
		'bytes1' => array('type' => 'integer'),
		'bytes2' => array('type' => 'integer'),
		'guildId' => array('type' => 'integer'),
		'flags' => array('type' => 'integer'),
		'dynFlags' => array('type' => 'integer'),
		'time' => array('type' => 'integer'),
		'corpseType' => array('type' => 'integer'),
		'instanceId' => array('type' => 'integer'),
	);
}
?>