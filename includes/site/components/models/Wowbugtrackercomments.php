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

class WowBugtrackerComments_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowBugtrackerComments';
	public $m_table = 'wow_bugtracker_comments';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'id' => 'Id',
		'report_id' => array('type' => 'integer'),
		'account_id' => array('type' => 'integer'),
		'character_guid' => array('type' => 'integer'),
		'character_realm' => array('type' => 'integer'),
		'post_date' => array('type' => 'integer'),
		'comment' => array('type' => 'string'),
		'blizzard' => array('type' => 'integer'),
		'mvp' => array('type' => 'integer'),
	);
}
?>