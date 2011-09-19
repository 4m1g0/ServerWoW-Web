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

class SpellDbc_Model_Component extends Model_Db_Component
{
	public $m_model = 'SpellDbc';
	public $m_table = 'spell_dbc';
	public $m_dbType = 'world';
	public $m_fields = array(
		'Id' => array('type' => 'integer'),
		'Dispel' => array('type' => 'integer'),
		'Mechanic' => array('type' => 'integer'),
		'Attributes' => array('type' => 'integer'),
		'AttributesEx' => array('type' => 'integer'),
		'AttributesEx2' => array('type' => 'integer'),
		'AttributesEx3' => array('type' => 'integer'),
		'AttributesEx4' => array('type' => 'integer'),
		'AttributesEx5' => array('type' => 'integer'),
		'Stances' => array('type' => 'integer'),
		'StancesNot' => array('type' => 'integer'),
		'Targets' => array('type' => 'integer'),
		'CastingTimeIndex' => array('type' => 'integer'),
		'AuraInterruptFlags' => array('type' => 'integer'),
		'ProcFlags' => array('type' => 'integer'),
		'ProcChance' => array('type' => 'integer'),
		'ProcCharges' => array('type' => 'integer'),
		'MaxLevel' => array('type' => 'integer'),
		'BaseLevel' => array('type' => 'integer'),
		'SpellLevel' => array('type' => 'integer'),
		'DurationIndex' => array('type' => 'integer'),
		'RangeIndex' => array('type' => 'integer'),
		'StackAmount' => array('type' => 'integer'),
		'EquippedItemClass' => array('type' => 'integer'),
		'EquippedItemSubClassMask' => array('type' => 'integer'),
		'EquippedItemInventoryTypeMask' => array('type' => 'integer'),
		'Effect1' => array('type' => 'integer'),
		'Effect2' => array('type' => 'integer'),
		'Effect3' => array('type' => 'integer'),
		'EffectDieSides1' => array('type' => 'integer'),
		'EffectDieSides2' => array('type' => 'integer'),
		'EffectDieSides3' => array('type' => 'integer'),
		'EffectRealPointsPerLevel1' => array('type' => 'integer'),
		'EffectRealPointsPerLevel2' => array('type' => 'integer'),
		'EffectRealPointsPerLevel3' => array('type' => 'integer'),
		'EffectBasePoints1' => array('type' => 'integer'),
		'EffectBasePoints2' => array('type' => 'integer'),
		'EffectBasePoints3' => array('type' => 'integer'),
		'EffectMechanic1' => array('type' => 'integer'),
		'EffectMechanic2' => array('type' => 'integer'),
		'EffectMechanic3' => array('type' => 'integer'),
		'EffectImplicitTargetA1' => array('type' => 'integer'),
		'EffectImplicitTargetA2' => array('type' => 'integer'),
		'EffectImplicitTargetA3' => array('type' => 'integer'),
		'EffectImplicitTargetB1' => array('type' => 'integer'),
		'EffectImplicitTargetB2' => array('type' => 'integer'),
		'EffectImplicitTargetB3' => array('type' => 'integer'),
		'EffectRadiusIndex1' => array('type' => 'integer'),
		'EffectRadiusIndex2' => array('type' => 'integer'),
		'EffectRadiusIndex3' => array('type' => 'integer'),
		'EffectApplyAuraName1' => array('type' => 'integer'),
		'EffectApplyAuraName2' => array('type' => 'integer'),
		'EffectApplyAuraName3' => array('type' => 'integer'),
		'EffectAmplitude1' => array('type' => 'integer'),
		'EffectAmplitude2' => array('type' => 'integer'),
		'EffectAmplitude3' => array('type' => 'integer'),
		'EffectMultipleValue1' => array('type' => 'integer'),
		'EffectMultipleValue2' => array('type' => 'integer'),
		'EffectMultipleValue3' => array('type' => 'integer'),
		'EffectMiscValue1' => array('type' => 'integer'),
		'EffectMiscValue2' => array('type' => 'integer'),
		'EffectMiscValue3' => array('type' => 'integer'),
		'EffectMiscValueB1' => array('type' => 'integer'),
		'EffectMiscValueB2' => array('type' => 'integer'),
		'EffectMiscValueB3' => array('type' => 'integer'),
		'EffectTriggerSpell1' => array('type' => 'integer'),
		'EffectTriggerSpell2' => array('type' => 'integer'),
		'EffectTriggerSpell3' => array('type' => 'integer'),
		'EffectSpellClassMaskA1' => array('type' => 'integer'),
		'EffectSpellClassMaskA2' => array('type' => 'integer'),
		'EffectSpellClassMaskA3' => array('type' => 'integer'),
		'EffectSpellClassMaskB1' => array('type' => 'integer'),
		'EffectSpellClassMaskB2' => array('type' => 'integer'),
		'EffectSpellClassMaskB3' => array('type' => 'integer'),
		'EffectSpellClassMaskC1' => array('type' => 'integer'),
		'EffectSpellClassMaskC2' => array('type' => 'integer'),
		'EffectSpellClassMaskC3' => array('type' => 'integer'),
		'MaxTargetLevel' => array('type' => 'integer'),
		'SpellFamilyName' => array('type' => 'integer'),
		'SpellFamilyFlags1' => array('type' => 'integer'),
		'SpellFamilyFlags2' => array('type' => 'integer'),
		'SpellFamilyFlags3' => array('type' => 'integer'),
		'MaxAffectedTargets' => array('type' => 'integer'),
		'DmgClass' => array('type' => 'integer'),
		'PreventionType' => array('type' => 'integer'),
		'DmgMultiplier1' => array('type' => 'integer'),
		'DmgMultiplier2' => array('type' => 'integer'),
		'DmgMultiplier3' => array('type' => 'integer'),
		'AreaGroupId' => array('type' => 'integer'),
		'SchoolMask' => array('type' => 'integer'),
		'Comment' => array('type' => 'string'),
	);
}
?>