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

class CharacterEquipmentsets_Model_Component extends Model_Db_Component
{
	public $m_model = 'CharacterEquipmentsets';
	public $m_table = 'character_equipmentsets';
	public $m_dbType = 'characters';
	public $m_fields = array(
		'guid' => 'Id',
		'setguid' => array('type' => 'integer'),
		'setindex' => array('type' => 'integer'),
		'name' => array('type' => 'string'),
		'iconname' => array('type' => 'string'),
		'item0' => array('type' => 'integer'),
		'item1' => array('type' => 'integer'),
		'item2' => array('type' => 'integer'),
		'item3' => array('type' => 'integer'),
		'item4' => array('type' => 'integer'),
		'item5' => array('type' => 'integer'),
		'item6' => array('type' => 'integer'),
		'item7' => array('type' => 'integer'),
		'item8' => array('type' => 'integer'),
		'item9' => array('type' => 'integer'),
		'item10' => array('type' => 'integer'),
		'item11' => array('type' => 'integer'),
		'item12' => array('type' => 'integer'),
		'item13' => array('type' => 'integer'),
		'item14' => array('type' => 'integer'),
		'item15' => array('type' => 'integer'),
		'item16' => array('type' => 'integer'),
		'item17' => array('type' => 'integer'),
		'item18' => array('type' => 'integer'),
	);
}
?>