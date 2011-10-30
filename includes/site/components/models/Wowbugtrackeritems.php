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

class WowBugtrackerItems_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowBugtrackerItems';
	public $m_table = 'wow_bugtracker_items';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'id' => 'Id',
		'type' => array('type' => 'integer'),
		'item_id' => array('type' => 'integer'),
		'account_id' => array('type' => 'integer'),
		'character_realm' => array('type' => 'integer'),
		'character_guid' => array('type' => 'integer'),
		'post_date' => array('type' => 'integer'),
		'status' => array('type' => 'integer'),
		'priority' => array('type' => 'integer'),
		'description' => array('type' => 'string'),
		'closed' => array('type' => 'integer'),
		'admin_response' => array('type' => 'string'),
		'response_date' => array('type' => 'integer'),
		'close_date' => array('type' => 'integer'),
	);
}
?>