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

class WowItemTabCreatedBy_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowItemTabCreatedBy';
	public $m_table = 'wow_item_tab_created_by';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'itemID' => array('type' => 'integer'),
		'spellID' => array('type' => 'integer'),
		'spellname' => 'Locale',
		'spell_desc' => 'Locale',
		'reagent_1' => array('type' => 'integer'),
		'reagent_2' => array('type' => 'integer'),
		'reagent_3' => array('type' => 'integer'),
		'reagent_4' => array('type' => 'integer'),
		'reagent_5' => array('type' => 'integer'),
		'reagent_6' => array('type' => 'integer'),
		'reagent_7' => array('type' => 'integer'),
		'reagent_8' => array('type' => 'integer'),
		'reagent_count_1' => array('type' => 'integer'),
		'reagent_count_2' => array('type' => 'integer'),
		'reagent_count_3' => array('type' => 'integer'),
		'reagent_count_4' => array('type' => 'integer'),
		'reagent_count_5' => array('type' => 'integer'),
		'reagent_count_6' => array('type' => 'integer'),
		'reagent_count_7' => array('type' => 'integer'),
		'reagent_count_8' => array('type' => 'integer'),
	);
}
?>