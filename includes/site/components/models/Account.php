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

class Account_Model_Component extends Model_Db_Component
{
	public $m_model = 'Account';
	public $m_table = 'account';
	public $m_dbType = 'realm';
	public $m_fields = array(
		'id' => 'Id',
		'username' => array('type' => 'string'),
		'sha_pass_hash' => array('type' => 'string'),
		'sessionkey' => array('type' => 'string'),
		'v' => array('type' => 'string'),
		's' => array('type' => 'string'),
		'email' => array('type' => 'string'),
		'joindate' => array('type' => 'integer'),
		'last_ip' => array('type' => 'string'),
		'failed_logins' => array('type' => 'integer'),
		'locked' => array('type' => 'integer'),
		'last_login' => array('type' => 'integer'),
		'online' => array('type' => 'integer'),
		'expansion' => array('type' => 'integer'),
		'mutetime' => array('type' => 'integer'),
		'locale' => array('type' => 'integer'),
		'recruiter' => array('type' => 'integer'),
	);
}
?>