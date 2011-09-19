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

class Gameobject_Model_Component extends Model_Db_Component
{
	public $m_model = 'Gameobject';
	public $m_table = 'gameobject';
	public $m_dbType = 'world';
	public $m_fields = array(
		'guid' => array('type' => 'integer'),
		'id' => 'Id',
		'map' => array('type' => 'integer'),
		'spawnMask' => array('type' => 'integer'),
		'phaseMask' => array('type' => 'integer'),
		'position_x' => array('type' => 'integer'),
		'position_y' => array('type' => 'integer'),
		'position_z' => array('type' => 'integer'),
		'orientation' => array('type' => 'integer'),
		'rotation0' => array('type' => 'integer'),
		'rotation1' => array('type' => 'integer'),
		'rotation2' => array('type' => 'integer'),
		'rotation3' => array('type' => 'integer'),
		'spawntimesecs' => array('type' => 'integer'),
		'animprogress' => array('type' => 'integer'),
		'state' => array('type' => 'integer'),
	);
}
?>