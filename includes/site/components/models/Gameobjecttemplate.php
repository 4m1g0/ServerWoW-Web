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

class GameobjectTemplate_Model_Component extends Model_Db_Component
{
	public $m_model = 'GameobjectTemplate';
	public $m_table = 'gameobject_template';
	public $m_dbType = 'world';
	public $m_fields = array(
		'entry' => 'Id',
		'type' => array('type' => 'integer'),
		'displayId' => array('type' => 'integer'),
		'name' => array('type' => 'string'),
		'IconName' => array('type' => 'string'),
		'castBarCaption' => array('type' => 'string'),
		'unk1' => array('type' => 'string'),
		'faction' => array('type' => 'integer'),
		'flags' => array('type' => 'integer'),
		'size' => array('type' => 'integer'),
		'questItem1' => array('type' => 'integer'),
		'questItem2' => array('type' => 'integer'),
		'questItem3' => array('type' => 'integer'),
		'questItem4' => array('type' => 'integer'),
		'questItem5' => array('type' => 'integer'),
		'questItem6' => array('type' => 'integer'),
		'data0' => array('type' => 'integer'),
		'data1' => array('type' => 'integer'),
		'data2' => array('type' => 'integer'),
		'data3' => array('type' => 'integer'),
		'data4' => array('type' => 'integer'),
		'data5' => array('type' => 'integer'),
		'data6' => array('type' => 'integer'),
		'data7' => array('type' => 'integer'),
		'data8' => array('type' => 'integer'),
		'data9' => array('type' => 'integer'),
		'data10' => array('type' => 'integer'),
		'data11' => array('type' => 'integer'),
		'data12' => array('type' => 'integer'),
		'data13' => array('type' => 'integer'),
		'data14' => array('type' => 'integer'),
		'data15' => array('type' => 'integer'),
		'data16' => array('type' => 'integer'),
		'data17' => array('type' => 'integer'),
		'data18' => array('type' => 'integer'),
		'data19' => array('type' => 'integer'),
		'data20' => array('type' => 'integer'),
		'data21' => array('type' => 'integer'),
		'data22' => array('type' => 'integer'),
		'data23' => array('type' => 'integer'),
		'AIName' => array('type' => 'integer'),
		'ScriptName' => array('type' => 'string'),
		'WDBVerified' => array('type' => 'integer'),
	);
}
?>