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

class ItemInstance_Model_Component extends Model_Db_Component
{
	public $m_model = 'ItemInstance';
	public $m_table = 'item_instance';
	public $m_dbType = 'characters';
	public $m_fields = array(
		'guid' => 'Id',
		'itemEntry' => array('type' => 'integer'),
		'owner_guid' => array('type' => 'integer'),
		'creatorGuid' => array('type' => 'integer'),
		'giftCreatorGuid' => array('type' => 'integer'),
		'count' => array('type' => 'integer'),
		'duration' => array('type' => 'integer'),
		'charges' => array('type' => 'string'),
		'flags' => array('type' => 'integer'),
		'enchantments' => array('type' => 'string'),
		'randomPropertyId' => array('type' => 'integer'),
		'durability' => array('type' => 'integer'),
		'playedTime' => array('type' => 'integer'),
		'text' => array('type' => 'string'),
	);
}
?>