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

class SmartScripts_Model_Component extends Model_Db_Component
{
	public $m_model = 'SmartScripts';
	public $m_table = 'smart_scripts';
	public $m_dbType = 'world';
	public $m_fields = array(
		'entryorguid' => array('type' => 'integer'),
		'source_type' => array('type' => 'integer'),
		'id' => 'Id',
		'link' => array('type' => 'integer'),
		'event_type' => array('type' => 'integer'),
		'event_phase_mask' => array('type' => 'integer'),
		'event_chance' => array('type' => 'integer'),
		'event_flags' => array('type' => 'integer'),
		'event_param1' => array('type' => 'integer'),
		'event_param2' => array('type' => 'integer'),
		'event_param3' => array('type' => 'integer'),
		'event_param4' => array('type' => 'integer'),
		'action_type' => array('type' => 'integer'),
		'action_param1' => array('type' => 'integer'),
		'action_param2' => array('type' => 'integer'),
		'action_param3' => array('type' => 'integer'),
		'action_param4' => array('type' => 'integer'),
		'action_param5' => array('type' => 'integer'),
		'action_param6' => array('type' => 'integer'),
		'target_type' => array('type' => 'integer'),
		'target_param1' => array('type' => 'integer'),
		'target_param2' => array('type' => 'integer'),
		'target_param3' => array('type' => 'integer'),
		'target_x' => array('type' => 'integer'),
		'target_y' => array('type' => 'integer'),
		'target_z' => array('type' => 'integer'),
		'target_o' => array('type' => 'integer'),
		'comment' => array('type' => 'string'),
	);
}
?>