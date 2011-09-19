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

class WowItemTabReagentFor_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowItemTabReagentFor';
	public $m_table = 'wow_item_tab_reagent_for';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'itemID' => array('type' => 'integer'),
		'spellID' => array('type' => 'integer'),
		'name' => 'Locale',
		'sell_price' => array('type' => 'integer'),
	);
}
?>