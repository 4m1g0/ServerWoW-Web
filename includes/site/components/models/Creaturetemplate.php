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

class CreatureTemplate_Model_Component extends Model_Db_Component
{
	public $m_model = 'CreatureTemplate';
	public $m_table = 'creature_template';
	public $m_dbType = 'world';
	public $m_fields = array(
		'entry' => 'Id',
		'difficulty_entry_1' => array('type' => 'integer'),
		'difficulty_entry_2' => array('type' => 'integer'),
		'difficulty_entry_3' => array('type' => 'integer'),
		'KillCredit1' => array('type' => 'integer'),
		'KillCredit2' => array('type' => 'integer'),
		'modelid1' => array('type' => 'integer'),
		'modelid2' => array('type' => 'integer'),
		'modelid3' => array('type' => 'integer'),
		'modelid4' => array('type' => 'integer'),
		'name' => array('type' => 'integer'),
		'subname' => array('type' => 'integer'),
		'IconName' => array('type' => 'integer'),
		'gossip_menu_id' => array('type' => 'integer'),
		'minlevel' => array('type' => 'integer'),
		'maxlevel' => array('type' => 'integer'),
		'exp' => array('type' => 'integer'),
		'faction_A' => array('type' => 'integer'),
		'faction_H' => array('type' => 'integer'),
		'npcflag' => array('type' => 'integer'),
		'speed_walk' => array('type' => 'integer'),
		'speed_run' => array('type' => 'integer'),
		'scale' => array('type' => 'integer'),
		'rank' => array('type' => 'integer'),
		'mindmg' => array('type' => 'integer'),
		'maxdmg' => array('type' => 'integer'),
		'dmgschool' => array('type' => 'integer'),
		'attackpower' => array('type' => 'integer'),
		'dmg_multiplier' => array('type' => 'integer'),
		'baseattacktime' => array('type' => 'integer'),
		'rangeattacktime' => array('type' => 'integer'),
		'unit_class' => array('type' => 'integer'),
		'unit_flags' => array('type' => 'integer'),
		'dynamicflags' => array('type' => 'integer'),
		'family' => array('type' => 'integer'),
		'trainer_type' => array('type' => 'integer'),
		'trainer_spell' => array('type' => 'integer'),
		'trainer_class' => array('type' => 'integer'),
		'trainer_race' => array('type' => 'integer'),
		'minrangedmg' => array('type' => 'integer'),
		'maxrangedmg' => array('type' => 'integer'),
		'rangedattackpower' => array('type' => 'integer'),
		'type' => array('type' => 'integer'),
		'type_flags' => array('type' => 'integer'),
		'lootid' => array('type' => 'integer'),
		'pickpocketloot' => array('type' => 'integer'),
		'skinloot' => array('type' => 'integer'),
		'resistance1' => array('type' => 'integer'),
		'resistance2' => array('type' => 'integer'),
		'resistance3' => array('type' => 'integer'),
		'resistance4' => array('type' => 'integer'),
		'resistance5' => array('type' => 'integer'),
		'resistance6' => array('type' => 'integer'),
		'spell1' => array('type' => 'integer'),
		'spell2' => array('type' => 'integer'),
		'spell3' => array('type' => 'integer'),
		'spell4' => array('type' => 'integer'),
		'spell5' => array('type' => 'integer'),
		'spell6' => array('type' => 'integer'),
		'spell7' => array('type' => 'integer'),
		'spell8' => array('type' => 'integer'),
		'PetSpellDataId' => array('type' => 'integer'),
		'VehicleId' => array('type' => 'integer'),
		'mingold' => array('type' => 'integer'),
		'maxgold' => array('type' => 'integer'),
		'AIName' => array('type' => 'integer'),
		'MovementType' => array('type' => 'integer'),
		'InhabitType' => array('type' => 'integer'),
		'Health_mod' => array('type' => 'integer'),
		'Mana_mod' => array('type' => 'integer'),
		'Armor_mod' => array('type' => 'integer'),
		'RacialLeader' => array('type' => 'integer'),
		'questItem1' => array('type' => 'integer'),
		'questItem2' => array('type' => 'integer'),
		'questItem3' => array('type' => 'integer'),
		'questItem4' => array('type' => 'integer'),
		'questItem5' => array('type' => 'integer'),
		'questItem6' => array('type' => 'integer'),
		'movementId' => array('type' => 'integer'),
		'RegenHealth' => array('type' => 'integer'),
		'equipment_id' => array('type' => 'integer'),
		'mechanic_immune_mask' => array('type' => 'integer'),
		'flags_extra' => array('type' => 'integer'),
		'ScriptName' => array('type' => 'integer'),
		'WDBVerified' => array('type' => 'integer'),
	);
}
?>