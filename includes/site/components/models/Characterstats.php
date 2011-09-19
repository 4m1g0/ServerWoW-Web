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

class CharacterStats_Model_Component extends Model_Db_Component
{
	public $m_model = 'CharacterStats';
	public $m_table = 'character_stats';
	public $m_dbType = 'characters';
	public $m_fields = array(
		'guid' => 'Id',
		'maxhealth' => array('type' => 'integer'),
		'maxpower1' => array('type' => 'integer'),
		'maxpower2' => array('type' => 'integer'),
		'maxpower3' => array('type' => 'integer'),
		'maxpower4' => array('type' => 'integer'),
		'maxpower5' => array('type' => 'integer'),
		'maxpower6' => array('type' => 'integer'),
		'maxpower7' => array('type' => 'integer'),
		'strength' => array('type' => 'integer'),
		'agility' => array('type' => 'integer'),
		'stamina' => array('type' => 'integer'),
		'intellect' => array('type' => 'integer'),
		'spirit' => array('type' => 'integer'),
		'armor' => array('type' => 'integer'),
		'resHoly' => array('type' => 'integer'),
		'resFire' => array('type' => 'integer'),
		'resNature' => array('type' => 'integer'),
		'resFrost' => array('type' => 'integer'),
		'resShadow' => array('type' => 'integer'),
		'resArcane' => array('type' => 'integer'),
		'blockPct' => array('type' => 'integer'),
		'dodgePct' => array('type' => 'integer'),
		'parryPct' => array('type' => 'integer'),
		'critPct' => array('type' => 'integer'),
		'rangedCritPct' => array('type' => 'integer'),
		'spellCritPct' => array('type' => 'integer'),
		'attackPower' => array('type' => 'integer'),
		'rangedAttackPower' => array('type' => 'integer'),
		'spellPower' => array('type' => 'integer'),
		'resilience' => array('type' => 'integer'),
	);
}
?>