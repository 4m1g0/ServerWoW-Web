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

class WowRandompropertypoints_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowRandompropertypoints';
	public $m_table = 'wow_randompropertypoints';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'itemlevel' => array('type' => 'integer'),
		'epic_0' => array('type' => 'integer'),
		'epic_1' => array('type' => 'integer'),
		'epic_2' => array('type' => 'integer'),
		'epic_3' => array('type' => 'integer'),
		'epic_4' => array('type' => 'integer'),
		'rare_0' => array('type' => 'integer'),
		'rare_1' => array('type' => 'integer'),
		'rare_2' => array('type' => 'integer'),
		'rare_3' => array('type' => 'integer'),
		'rare_4' => array('type' => 'integer'),
		'uncommon_0' => array('type' => 'integer'),
		'uncommon_1' => array('type' => 'integer'),
		'uncommon_2' => array('type' => 'integer'),
		'uncommon_3' => array('type' => 'integer'),
		'uncommon_4' => array('type' => 'integer'),
	);
}
?>