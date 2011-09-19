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

class WowRating_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowRating';
	public $m_table = 'wow_rating';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'level' => array('type' => 'integer'),
		'MC_Warrior' => array('type' => 'integer'),
		'MC_Paladin' => array('type' => 'integer'),
		'MC_Hunter' => array('type' => 'integer'),
		'MC_Rogue' => array('type' => 'integer'),
		'MC_Priest' => array('type' => 'integer'),
		'MC_DeathKnight' => array('type' => 'integer'),
		'MC_Shaman' => array('type' => 'integer'),
		'MC_Mage' => array('type' => 'integer'),
		'MC_Warlock' => array('type' => 'integer'),
		'MC_10' => array('type' => 'integer'),
		'MC_Druid' => array('type' => 'integer'),
		'SC_Warrior' => array('type' => 'integer'),
		'SC_Paladin' => array('type' => 'integer'),
		'SC_Hunter' => array('type' => 'integer'),
		'SC_Rogue' => array('type' => 'integer'),
		'SC_Priest' => array('type' => 'integer'),
		'SC_DeathKnight' => array('type' => 'integer'),
		'SC_Shaman' => array('type' => 'integer'),
		'SC_Mage' => array('type' => 'integer'),
		'SC_Warlock' => array('type' => 'integer'),
		'SC_10' => array('type' => 'integer'),
		'SC_Druid' => array('type' => 'integer'),
		'HR_Warrior' => array('type' => 'integer'),
		'HR_Paladin' => array('type' => 'integer'),
		'HR_Hunter' => array('type' => 'integer'),
		'HR_Rogue' => array('type' => 'integer'),
		'HR_Priest' => array('type' => 'integer'),
		'HR_DeathKnight' => array('type' => 'integer'),
		'HR_Shaman' => array('type' => 'integer'),
		'HR_Mage' => array('type' => 'integer'),
		'HR_Warlock' => array('type' => 'integer'),
		'HR_10' => array('type' => 'integer'),
		'HR_Druid' => array('type' => 'integer'),
		'MR_Warrior' => array('type' => 'integer'),
		'MR_Paladin' => array('type' => 'integer'),
		'MR_Hunter' => array('type' => 'integer'),
		'MR_Rogue' => array('type' => 'integer'),
		'MR_Priest' => array('type' => 'integer'),
		'MR_DeathKnight' => array('type' => 'integer'),
		'MR_Shaman' => array('type' => 'integer'),
		'MR_Mage' => array('type' => 'integer'),
		'MR_Warlock' => array('type' => 'integer'),
		'MR_10' => array('type' => 'integer'),
		'MR_Druid' => array('type' => 'integer'),
		'CR_WEAPON_SKILL' => array('type' => 'integer'),
		'CR_DEFENSE_SKILL' => array('type' => 'integer'),
		'CR_DODGE' => array('type' => 'integer'),
		'CR_PARRY' => array('type' => 'integer'),
		'CR_BLOCK' => array('type' => 'integer'),
		'CR_HIT_MELEE' => array('type' => 'integer'),
		'CR_HIT_RANGED' => array('type' => 'integer'),
		'CR_HIT_SPELL' => array('type' => 'integer'),
		'CR_CRIT_MELEE' => array('type' => 'integer'),
		'CR_CRIT_RANGED' => array('type' => 'integer'),
		'CR_CRIT_SPELL' => array('type' => 'integer'),
		'CR_HIT_TAKEN_MELEE' => array('type' => 'integer'),
		'CR_HIT_TAKEN_RANGED' => array('type' => 'integer'),
		'CR_HIT_TAKEN_SPELL' => array('type' => 'integer'),
		'CR_CRIT_TAKEN_MELEE' => array('type' => 'integer'),
		'CR_CRIT_TAKEN_RANGED' => array('type' => 'integer'),
		'CR_CRIT_TAKEN_SPELL' => array('type' => 'integer'),
		'CR_HASTE_MELEE' => array('type' => 'integer'),
		'CR_HASTE_RANGED' => array('type' => 'integer'),
		'CR_HASTE_SPELL' => array('type' => 'integer'),
		'CR_WEAPON_SKILL_MAINHAND' => array('type' => 'integer'),
		'CR_WEAPON_SKILL_OFFHAND' => array('type' => 'integer'),
		'CR_WEAPON_SKILL_RANGED' => array('type' => 'integer'),
		'CR_EXPERTISE' => array('type' => 'integer'),
		'CR_ARMOR_PENETRATION' => array('type' => 'integer'),
	);
}
?>