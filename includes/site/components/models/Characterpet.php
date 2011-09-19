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

class CharacterPet_Model_Component extends Model_Db_Component
{
	public $m_model = 'CharacterPet';
	public $m_table = 'character_pet';
	public $m_dbType = 'characters';
	public $m_fields = array(
		'id' => 'Id',
		'entry' => array('type' => 'integer'),
		'owner' => array('type' => 'integer'),
		'modelid' => array('type' => 'integer'),
		'CreatedBySpell' => array('type' => 'integer'),
		'PetType' => array('type' => 'integer'),
		'level' => array('type' => 'integer'),
		'exp' => array('type' => 'integer'),
		'Reactstate' => array('type' => 'integer'),
		'name' => array('type' => 'string'),
		'renamed' => array('type' => 'integer'),
		'slot' => array('type' => 'integer'),
		'curhealth' => array('type' => 'integer'),
		'curmana' => array('type' => 'integer'),
		'curhappiness' => array('type' => 'integer'),
		'savetime' => array('type' => 'integer'),
		'abdata' => array('type' => 'string'),
	);
}
?>