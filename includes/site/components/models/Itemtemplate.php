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

class ItemTemplate_Model_Component extends Model_Db_Component
{
	public $m_model = 'ItemTemplate';
	public $m_table = 'item_template';
	public $m_dbType = 'world';
	public $m_fields = array(
		'entry' => 'Id',
		'class' => array('type' => 'integer'),
		'subclass' => array('type' => 'integer'),
		'unk0' => array('type' => 'integer'),
		'name' => array('type' => 'string'),
		'displayid' => array('type' => 'integer'),
		'Quality' => array('type' => 'integer'),
		'Flags' => array('type' => 'integer'),
		'FlagsExtra' => array('type' => 'integer'),
		'BuyCount' => array('type' => 'integer'),
		'BuyPrice' => array('type' => 'integer'),
		'SellPrice' => array('type' => 'integer'),
		'InventoryType' => array('type' => 'integer'),
		'AllowableClass' => array('type' => 'integer'),
		'AllowableRace' => array('type' => 'integer'),
		'ItemLevel' => array('type' => 'integer'),
		'RequiredLevel' => array('type' => 'integer'),
		'RequiredSkill' => array('type' => 'integer'),
		'RequiredSkillRank' => array('type' => 'integer'),
		'requiredspell' => array('type' => 'integer'),
		'requiredhonorrank' => array('type' => 'integer'),
		'RequiredCityRank' => array('type' => 'integer'),
		'RequiredReputationFaction' => array('type' => 'integer'),
		'RequiredReputationRank' => array('type' => 'integer'),
		'maxcount' => array('type' => 'integer'),
		'stackable' => array('type' => 'integer'),
		'ContainerSlots' => array('type' => 'integer'),
		'StatsCount' => array('type' => 'integer'),
		'stat_type1' => array('type' => 'integer'),
		'stat_value1' => array('type' => 'integer'),
		'stat_type2' => array('type' => 'integer'),
		'stat_value2' => array('type' => 'integer'),
		'stat_type3' => array('type' => 'integer'),
		'stat_value3' => array('type' => 'integer'),
		'stat_type4' => array('type' => 'integer'),
		'stat_value4' => array('type' => 'integer'),
		'stat_type5' => array('type' => 'integer'),
		'stat_value5' => array('type' => 'integer'),
		'stat_type6' => array('type' => 'integer'),
		'stat_value6' => array('type' => 'integer'),
		'stat_type7' => array('type' => 'integer'),
		'stat_value7' => array('type' => 'integer'),
		'stat_type8' => array('type' => 'integer'),
		'stat_value8' => array('type' => 'integer'),
		'stat_type9' => array('type' => 'integer'),
		'stat_value9' => array('type' => 'integer'),
		'stat_type10' => array('type' => 'integer'),
		'stat_value10' => array('type' => 'integer'),
		'ScalingStatDistribution' => array('type' => 'integer'),
		'ScalingStatValue' => array('type' => 'integer'),
		'dmg_min1' => array('type' => 'integer'),
		'dmg_max1' => array('type' => 'integer'),
		'dmg_type1' => array('type' => 'integer'),
		'dmg_min2' => array('type' => 'integer'),
		'dmg_max2' => array('type' => 'integer'),
		'dmg_type2' => array('type' => 'integer'),
		'armor' => array('type' => 'integer'),
		'holy_res' => array('type' => 'integer'),
		'fire_res' => array('type' => 'integer'),
		'nature_res' => array('type' => 'integer'),
		'frost_res' => array('type' => 'integer'),
		'shadow_res' => array('type' => 'integer'),
		'arcane_res' => array('type' => 'integer'),
		'delay' => array('type' => 'integer'),
		'ammo_type' => array('type' => 'integer'),
		'RangedModRange' => array('type' => 'integer'),
		'spellid_1' => array('type' => 'integer'),
		'spelltrigger_1' => array('type' => 'integer'),
		'spellcharges_1' => array('type' => 'integer'),
		'spellppmRate_1' => array('type' => 'integer'),
		'spellcooldown_1' => array('type' => 'integer'),
		'spellcategory_1' => array('type' => 'integer'),
		'spellcategorycooldown_1' => array('type' => 'integer'),
		'spellid_2' => array('type' => 'integer'),
		'spelltrigger_2' => array('type' => 'integer'),
		'spellcharges_2' => array('type' => 'integer'),
		'spellppmRate_2' => array('type' => 'integer'),
		'spellcooldown_2' => array('type' => 'integer'),
		'spellcategory_2' => array('type' => 'integer'),
		'spellcategorycooldown_2' => array('type' => 'integer'),
		'spellid_3' => array('type' => 'integer'),
		'spelltrigger_3' => array('type' => 'integer'),
		'spellcharges_3' => array('type' => 'integer'),
		'spellppmRate_3' => array('type' => 'integer'),
		'spellcooldown_3' => array('type' => 'integer'),
		'spellcategory_3' => array('type' => 'integer'),
		'spellcategorycooldown_3' => array('type' => 'integer'),
		'spellid_4' => array('type' => 'integer'),
		'spelltrigger_4' => array('type' => 'integer'),
		'spellcharges_4' => array('type' => 'integer'),
		'spellppmRate_4' => array('type' => 'integer'),
		'spellcooldown_4' => array('type' => 'integer'),
		'spellcategory_4' => array('type' => 'integer'),
		'spellcategorycooldown_4' => array('type' => 'integer'),
		'spellid_5' => array('type' => 'integer'),
		'spelltrigger_5' => array('type' => 'integer'),
		'spellcharges_5' => array('type' => 'integer'),
		'spellppmRate_5' => array('type' => 'integer'),
		'spellcooldown_5' => array('type' => 'integer'),
		'spellcategory_5' => array('type' => 'integer'),
		'spellcategorycooldown_5' => array('type' => 'integer'),
		'bonding' => array('type' => 'integer'),
		'description' => array('type' => 'string'),
		'PageText' => array('type' => 'integer'),
		'LanguageID' => array('type' => 'integer'),
		'PageMaterial' => array('type' => 'integer'),
		'startquest' => array('type' => 'integer'),
		'lockid' => array('type' => 'integer'),
		'Material' => array('type' => 'integer'),
		'sheath' => array('type' => 'integer'),
		'RandomProperty' => array('type' => 'integer'),
		'RandomSuffix' => array('type' => 'integer'),
		'block' => array('type' => 'integer'),
		'itemset' => array('type' => 'integer'),
		'MaxDurability' => array('type' => 'integer'),
		'area' => array('type' => 'integer'),
		'Map' => array('type' => 'integer'),
		'BagFamily' => array('type' => 'integer'),
		'TotemCategory' => array('type' => 'integer'),
		'socketColor_1' => array('type' => 'integer'),
		'socketContent_1' => array('type' => 'integer'),
		'socketColor_2' => array('type' => 'integer'),
		'socketContent_2' => array('type' => 'integer'),
		'socketColor_3' => array('type' => 'integer'),
		'socketContent_3' => array('type' => 'integer'),
		'socketBonus' => array('type' => 'integer'),
		'GemProperties' => array('type' => 'integer'),
		'RequiredDisenchantSkill' => array('type' => 'integer'),
		'ArmorDamageModifier' => array('type' => 'integer'),
		'Duration' => array('type' => 'integer'),
		'ItemLimitCategory' => array('type' => 'integer'),
		'HolidayId' => array('type' => 'integer'),
		'ScriptName' => array('type' => 'string'),
		'DisenchantID' => array('type' => 'integer'),
		'FoodType' => array('type' => 'integer'),
		'minMoneyLoot' => array('type' => 'integer'),
		'maxMoneyLoot' => array('type' => 'integer'),
		'WDBVerified' => array('type' => 'integer'),
	);
}
?>