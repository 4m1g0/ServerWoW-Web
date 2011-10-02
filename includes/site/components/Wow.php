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

class Wow_Component extends Component
{
	public function setActiveRealm($realmName)
	{
		$rId = $this->getRealmIDByName($realmName);

		if ($rId == 0)
			return false;

		$this->c('Config')->setValue('tmp.db_characters.active', $rId);
		$this->c('Config')->setValue('tmp.db_world.active', $rId);

		return true;
	}

	public function getActiveRealmType()
	{
		return $this->c('Config')->getValue('realms.' . $this->getActiveRealmID() . '.type');
	}

	public function getActiveRealmID()
	{
		return $this->c('Config')->getValue('tmp.db_characters.active');
	}

	public function isRealm($realm)
	{
		if (is_integer($realm))
		{
			if ($this->c('Config')->getValue('realms.' . $realm . '.name') != null)
				return true;
		}
		if ($this->getRealmIDByName($realm) > 0)
			return true;

		return false;
	}

	public function findRealm($realmName)
	{
		$rId = $this->getRealmIDByName($realmName);
		if ($rId == 0)
			return false;

		return $this->c('Config')->getValue('realms.' . $rId);
	}

	public function getRealmIDByName($realmName)
	{
		$realms = $this->c('Config')->getValue('realms');
		foreach ($realms as $realm)
			if (strtolower($realm['name']) == strtolower($realmName))
				return $realm['id'];

		return 0;
	}

	public function getClassIdByKey($key)
	{
		return $this->c('Classes', 'Data')->getClassID($key);
	}
	
	public function getClassKeyById($id)
	{
		return $this->c('Classes', 'Data')->getClassKey($id);
	}
	
	public function getRaceIDByKey($key)
	{
		return $this->c('Races', 'Data')->getRaceID($key);
	}
	
	public function getRaceKeyById($id)
	{
		return $this->c('Races', 'Data')->getRaceKey($id);
	}

	public function getFactionID($raceID)
	{
		$horde_races    = array(RACE_ORC,     RACE_TROLL, RACE_TAUREN, RACE_UNDEAD, RACE_BLOODELF, RACE_GOBLIN);
		$alliance_races = array(RACE_DRAENEI, RACE_DWARF, RACE_GNOME,  RACE_HUMAN,  RACE_NIGHTELF, RACE_WORGEN);
		
		if (in_array($raceID, $horde_races))
			return FACTION_HORDE;
		elseif (in_array($raceID, $alliance_races))
			return FACTION_ALLIANCE;
		else
		{
			$this->c('Log')->writeError('%s : unknown race ID %d!', __METHOD__, $raceID);
			return -1;
		}
	}

	/**
     * Returns percent value.
     * @category Utils class
     * @access   public
     * @param    int $max
     * @param    int $min
     * @return   int
     **/
	public function GetPercent($max, $min)
	{
		$percent = $max / 100;
		if ($percent == 0)
			return 0;

		$progressPercent = $min / $percent;

		if ($progressPercent > 100) 
			$progressPercent = 100;

		return $progressPercent;	
	}

	public function getRating($level)
	{
		return $this->c('QueryResult', 'Db')
			->model('WowRating')
			->fieldCondition('level', ' = ' . $level)
			->loadItem();
	}

	public function ComputePetBonus($stat, $value, $unitClass)
	{
		if(!in_array($unitClass, array(CLASS_HUNTER, CLASS_WARLOCK)))
			return -1;
		$hunter_pet_bonus = array(0.22, 0.1287, 0.3, 0.4, 0.35, 0.0, 0.0, 0.0);
		$warlock_pet_bonus = array(0.0, 0.0, 0.3, 0.4, 0.35, 0.15, 0.57, 0.3);
		switch($unitClass) {
			case CLASS_WARLOCK:
				if (isset($warlock_pet_bonus[$stat]))
					return ($value * $warlock_pet_bonus[$stat] > 0) ? $value * $warlock_pet_bonus[$stat] : -1;
				else
					return -1;
				break;
			case CLASS_HUNTER:
				if (isset($hunter_pet_bonus[$stat]))
					return ($value * $hunter_pet_bonus[$stat] > 0) ? $value * $hunter_pet_bonus[$stat] : -1;
				else
					return -1;
				break;
		}
		return -1;
	}
	
	/**
	 * Returns float value.
	 * @category Utils class
	 * @access   public
	 * @param	int $value
	 * @param	int $num
	 * @return   float
	 **/
	public function GetFloatValue($value, $num)
	{
		$txt = unpack('f', pack('L', $value));
		return round($txt[1], $num);
	}
	
	/**
	 * Returns rating coefficient for rating $id.
	 * @category Utils class
	 * @access   public
	 * @param	array $rating
	 * @param	int $id
	 * @return   int
	 **/
	public function GetRatingCoefficient($rating, $id)
	{
		if (!is_array($rating))
			return 1; // Do not return 0 because it will cause division by zero error.

		$ratingkey = array_keys($rating);
		if (!isset($ratingkey[44 + $id]) || !isset($rating[$ratingkey[44 + $id]]))
			return 1;

		$c = $rating[$ratingkey[44 + $id]];
		if ($c == 0)
			$c = 1;

		return $c;
	}

	/**
	 * Calculates attack power for different classes by stat mods
	 * @category Utils class
	 * @access   public
	 * @param	int $statIndex
	 * @param	float $effectiveStat
	 * @param	int $class
	 * @return   float
	 **/
	public function GetAttackPowerForStat($statIndex, $effectiveStat, $class) {
		$ap = 0;
		if ($statIndex == STAT_STRENGTH)
		{
			switch($class) {
				case CLASS_WARRIOR:
				case CLASS_PALADIN:
				case CLASS_DK:
				case CLASS_DRUID:
					$baseStr = min($effectiveStat, 20);
					$moreStr = $effectiveStat-$baseStr;
					$ap = $baseStr + 2 * $moreStr;
					break;
				default:
					$ap = $effectiveStat - 10;
					break;
			}
		}
		elseif ($statIndex == STAT_AGILITY)
		{
			switch ($class)
			{
				case CLASS_SHAMAN:
				case CLASS_ROGUE:
				case CLASS_HUNTER:
					$ap = $effectiveStat - 10;
					break;
			}
		}
		if ($ap < 0)
			$ap = 0;

		return $ap;
	}
	
	/**
	 * Calculates crit chance from agility stat.
	 * @category Utils class
	 * @access   public
	 * @param	array $rating
	 * @param	int $class
	 * @param	float $agility
	 * @return   float
	 **/
	public function GetCritChanceFromAgility($rating, $class, $agility)
	{
		if (!is_array($rating))
			return 1;

		$base = array(3.1891, 3.2685, -1.532, -0.295, 3.1765, 3.1890, 2.922, 3.454, 2.6222, 20, 7.4755);
		$ratingkey = array_keys($rating);
		if (isset($ratingkey[$class]) && isset($rating[$ratingkey[$class]]) && isset($base[$class - 1]))
			return $base[$class - 1] + $agility * $rating[$ratingkey[$class]] * 100;
	}
	
	/**
	 * Calculates spell crit chance from intellect stat.
	 * @category Utils class
	 * @access   public
	 * @param	array $rating
	 * @param	int $class
	 * @param	float $intellect
	 * @return   float
	 **/
	public function GetSpellCritChanceFromIntellect(&$rating, $class, $intellect)
	{
		if (!is_array($rating))
			return 1;

		$base = array(0, 3.3355, 3.602, 0, 1.2375, 0, 2.201, 0.9075, 1.7, 20, 1.8515);
		$ratingkey = array_keys($rating);

		if (isset($base[$class - 1]) && isset($ratingkey[11 + $class]) && isset($rating[$ratingkey[11 + $class]]))
			return $base[$class - 1] + $intellect * $rating[$ratingkey[11 + $class]] * 100;
	}
	
	/**
	 * Calculates health regeneration coefficient.
	 * @category Utils class
	 * @access   public
	 * @param	array $rating
	 * @param	int $class
	 * @return   float
	 **/
	public function GetHRCoefficient(&$rating, $class)
	{
		if (!is_array($rating))
			return 1;

		$ratingkey = array_keys($rating);
		if (!isset($ratingkey[22 + $class]) || !isset($rating[$ratingkey[22 + $class]]))
			return 1;

		$c = $rating[$ratingkey[22 + $class]];
		if ($c == 0)
			$c = 1;

		return $c;
	}
	
	/**
	 * Calculates mana regenerating coefficient
	 * @category Utils class
	 * @access   public
	 * @param	array $rating
	 * @param	int $class
	 * @return   float
	 **/
	public function GetMRCoefficient(&$rating, $class)
	{
		if (!is_array($rating))
			return 1;

		$ratingkey = array_keys($rating);
		if (!isset($ratingkey[33 + $class]) || !isset ($rating[$ratingkey[33 + $class]]))
			return 1;

		$c = $rating[$ratingkey[33 + $class]];
			$c = 1;

		return $c;
	}
	
	/**
	 * Returns Skill ID that required for Item $id
	 * @category Utils class
	 * @access   public
	 * @param	int $id
	 * @return   int
	 **/
	public function GetSkillIDFromItemID($id)
	{
		if (!$id)
			return SKILL_UNARMED;

		$item = $this->c('QueryResult', 'Db')
			->model('ItemTemplate')
			->fields(array('ItemTemplate' => array('class', 'subclass')))
			->setItemId($id)
			->loadItem();

		if (!$item)
			return SKILL_UNARMED;

		if ($item['class'] != ITEM_CLASS_WEAPON)
			return SKILL_UNARMED;

		switch($item['subclass']) {
			case  0: return SKILL_AXES;
			case  1: return SKILL_TWO_HANDED_AXE;
			case  2: return SKILL_BOWS;
			case  3: return SKILL_GUNS;
			case  4: return SKILL_MACES;
			case  5: return SKILL_TWO_HANDED_MACES;
			case  6: return SKILL_POLEARMS;
			case  7: return SKILL_SWORDS;
			case  8: return SKILL_TWO_HANDED_SWORDS;
			case 10: return SKILL_STAVES;
			case 13: return SKILL_FIST_WEAPONS;
			case 15: return SKILL_DAGGERS;
			case 16: return SKILL_THROWN;
			case 18: return SKILL_CROSSBOWS;
			case 19: return SKILL_WANDS;
		}

		return SKILL_UNARMED;
	}
	
	/**
	 * Returns skill info for skill $id
	 * @category Utils class
	 * @access   public
	 * @param	int $id
	 * @param	array $char_data
	 * @return   array
	 **/
	public function GetSkillInfo($id, $char_data)
	{
		$skillInfo = array(0, 0 , 0, 0, 0, 0);
		for ($i = 0; $i < 128; $i++)
		{
			if (($char_data[PLAYER_SKILL_INFO_1_1 + ($i * 3)] & 0x0000FFFF) == $id)
			{
				$data0 = $char_data[PLAYER_SKILL_INFO_1_1 + ($i * 3)];
				$data1 = $char_data[PLAYER_SKILL_INFO_1_1 + ($i * 3) + 1];
				$data2 = $char_data[PLAYER_SKILL_INFO_1_1 + ($i * 3) + 2];
				$skillInfo[0] = $data0&0x0000FFFF; // skill id
				$skillInfo[1] = $data0>>16;		// skill flag
				$skillInfo[2] = $data1&0x0000FFFF; // skill
				$skillInfo[3] = $data1>>16;		// max skill
				$skillInfo[4] = $data2&0x0000FFFF; // pos buff
				$skillInfo[5] = $data2>>16;		// neg buff
				break;
			}
		}

		return $skillInfo;
	}

	public function GetMoneyFormat($amount)
	{
		$money_format['gold'] = floor($amount/(100*100));
		$amount = $amount-$money_format['gold']*100*100;
		$money_format['silver'] = floor($amount/100);
		$amount = $amount-$money_format['silver']*100;
		$money_format['copper'] = floor($amount);

		return $money_format;
	}

	public function getOptimalArmorTypeForClassAndLevel($class, $level)
	{
		switch ($class)
		{
			case CLASS_PRIEST:
			case CLASS_MAGE:
			case CLASS_WARLOCK:
				return ITEM_SUBCLASS_ARMOR_CLOTH;
			case CLASS_SHAMAN:
			case CLASS_HUNTER:
				return $level >= 40 ? ITEM_SUBCLASS_ARMOR_MAIL : ITEM_SUBCLASS_ARMOR_LEATHER;
			case CLASS_ROGUE:
			case CLASS_DRUID:
				return ITEM_SUBCLASS_ARMOR_LEATHER;
			case CLASS_DK:
				return ITEM_SUBCLASS_ARMOR_PLATE;
			case CLASS_WARRIOR:
			case CLASS_PALADIN:
				return $level >= 40 ? ITEM_SUBCLASS_ARMOR_PLATE : ITEM_SUBCLASS_ARMOR_MAIL;
			default:
				return ITEM_SUBCLASS_ARMOR_CLOTH;
		}
	}
}
?>