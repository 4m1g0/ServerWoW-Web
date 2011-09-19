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

class CreatureAiScripts_Model_Component extends Model_Db_Component
{
	public $m_model = 'CreatureAiScripts';
	public $m_table = 'creature_ai_scripts';
	public $m_dbType = 'world';
	public $m_fields = array(
		'id' => 'Id',
		'creature_id' => array('type' => 'integer'),
		'event_type' => array('type' => 'integer'),
		'event_inverse_phase_mask' => array('type' => 'integer'),
		'event_chance' => array('type' => 'integer'),
		'event_flags' => array('type' => 'integer'),
		'event_param1' => array('type' => 'integer'),
		'event_param2' => array('type' => 'integer'),
		'event_param3' => array('type' => 'integer'),
		'event_param4' => array('type' => 'integer'),
		'action1_type' => array('type' => 'integer'),
		'action1_param1' => array('type' => 'integer'),
		'action1_param2' => array('type' => 'integer'),
		'action1_param3' => array('type' => 'integer'),
		'action2_type' => array('type' => 'integer'),
		'action2_param1' => array('type' => 'integer'),
		'action2_param2' => array('type' => 'integer'),
		'action2_param3' => array('type' => 'integer'),
		'action3_type' => array('type' => 'integer'),
		'action3_param1' => array('type' => 'integer'),
		'action3_param2' => array('type' => 'integer'),
		'action3_param3' => array('type' => 'integer'),
		'comment' => array('type' => 'string'),
	);
}
?>