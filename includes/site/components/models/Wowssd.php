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

class WowSsd_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowSsd';
	public $m_table = 'wow_ssd';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'entry' => array('type' => 'integer'),
		'StatMod_0' => array('type' => 'integer'),
		'StatMod_1' => array('type' => 'integer'),
		'StatMod_2' => array('type' => 'integer'),
		'StatMod_3' => array('type' => 'integer'),
		'StatMod_4' => array('type' => 'integer'),
		'StatMod_5' => array('type' => 'integer'),
		'StatMod_6' => array('type' => 'integer'),
		'StatMod_7' => array('type' => 'integer'),
		'StatMod_8' => array('type' => 'integer'),
		'StatMod_9' => array('type' => 'integer'),
		'Modifier_0' => array('type' => 'integer'),
		'Modifier_1' => array('type' => 'integer'),
		'Modifier_2' => array('type' => 'integer'),
		'Modifier_3' => array('type' => 'integer'),
		'Modifier_4' => array('type' => 'integer'),
		'Modifier_5' => array('type' => 'integer'),
		'Modifier_6' => array('type' => 'integer'),
		'Modifier_7' => array('type' => 'integer'),
		'Modifier_8' => array('type' => 'integer'),
		'Modifier_9' => array('type' => 'integer'),
		'MaxLevel' => array('type' => 'integer'),
	);
}
?>