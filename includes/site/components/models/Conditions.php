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

class Conditions_Model_Component extends Model_Db_Component
{
	public $m_model = 'Conditions';
	public $m_table = 'conditions';
	public $m_dbType = 'world';
	public $m_fields = array(
		'SourceTypeOrReferenceId' => array('type' => 'integer'),
		'SourceGroup' => array('type' => 'integer'),
		'SourceEntry' => array('type' => 'integer'),
		'ElseGroup' => array('type' => 'integer'),
		'ConditionTypeOrReference' => array('type' => 'integer'),
		'ConditionValue1' => array('type' => 'integer'),
		'ConditionValue2' => array('type' => 'integer'),
		'ConditionValue3' => array('type' => 'integer'),
		'ErrorTextId' => array('type' => 'integer'),
		'ScriptName' => array('type' => 'integer'),
		'Comment' => array('type' => 'string'),
	);
}
?>