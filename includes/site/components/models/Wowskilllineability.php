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

class WowSkillLineAbility_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowSkillLineAbility';
	public $m_table = 'wow_skill_line_ability';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'id' => 'Id',
		'skillId' => array('type' => 'integer'),
		'spellId' => array('type' => 'integer'),
		'racemask' => array('type' => 'integer'),
		'classmask' => array('type' => 'integer'),
		'racemaskNot' => array('type' => 'integer'),
		'classmaskNot' => array('type' => 'integer'),
		'req_skill_value' => array('type' => 'integer'),
		'forward_spellid' => array('type' => 'integer'),
		'learnOnGetSkill' => array('type' => 'integer'),
		'max_value' => array('type' => 'integer'),
		'min_value' => array('type' => 'integer'),
		'characterPoints_1' => array('type' => 'integer'),
		'characterPoints_2' => array('type' => 'integer'),
	);
}
?>