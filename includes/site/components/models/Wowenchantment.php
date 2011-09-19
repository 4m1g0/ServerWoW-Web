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

class WowEnchantment_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowEnchantment';
	public $m_table = 'wow_enchantment';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'id' => 'Id',
		'text' => 'Locale',
		'gem' => array('type' => 'integer'),
		'type_1' => array('type' => 'integer'),
		'type_2' => array('type' => 'integer'),
		'type_3' => array('type' => 'integer'),
		'spellid_1' => array('type' => 'integer'),
		'spellid_2' => array('type' => 'integer'),
		'spellid_3' => array('type' => 'integer'),
		'amount_1' => array('type' => 'integer'),
		'amount_2' => array('type' => 'integer'),
		'amount_3' => array('type' => 'integer'),
		'condition' => array('type' => 'integer'),
		'aura_id' => array('type' => 'integer'),
		'slot' => array('type' => 'integer'),
		'gemicon' => array('type' => 'string'),
		'gemcolor' => array('type' => 'integer'),
	);
}
?>