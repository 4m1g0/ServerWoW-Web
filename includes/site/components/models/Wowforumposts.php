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

class WowForumPosts_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowForumPosts';
	public $m_table = 'wow_forum_posts';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'post_id' => 'Id',
		'thread_id' => array('type' => 'integer'),
		'cat_id' => array('type' => 'integer'),
		'account_id' => array('type' => 'integer'),
		'character_guid' => array('type' => 'integer'),
		'character_realm' => array('type' => 'integer'),
		'blizzpost' => array('type' => 'integer'),
		'blizz_name' => array('type' => 'string'),
		'message' => array('type' => 'string'),
		'post_date' => array('type' => 'integer'),
		'author_ip' => array('type' => 'string'),
		'post_num' => array('type' => 'integer'),
		'edit_date' => array('type' => 'integer'),
		'post_editor' => array('type' => 'string'),
		'deleted' => array('type' => 'integer'),
		'deleted_by' => array('type' => 'string'),
	);
}
?>