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
	public function getBlogEntry($id)
	{
		if ($id <= 0)
			return false;

		$blog = $this->c('QueryResult', 'Db')
			->model('WowNews')
			->setItemId($id)
			->loadItem();

		if (!$blog)
			return false;

		if (!$blog['allow_comments'])
			return $blog;

		$blog['blog_comments'] = $this->c('QueryResult', 'Db')
			->model('WowBlogComments')
			->addModel('WowUserCharacters')
			->join('left', 'WowUserCharacters', 'WowBlogComments', 'account', 'account')
			->join('left', 'WowUserCharacters', 'WowBlogComments', 'character_guid', 'guid')
			->join('left', 'WowUserCharacters', 'WowBlogComments', 'realm_id', 'realmId')
			->fieldCondition('wow_blog_comments.blog_id', ' = ' . $id)
			->order(array('WowBlogComments' => array('postdate')), 'DESC')
			->limit(15, ($this->getPage(true) * 15))
			->loadItems();

		return $blog;
	}

	public function addBlogComment($blog_id, $text)
	{
		if (!$this->c('AccountManager')->isLoggedIn() || !$blog_id || !$text)
			return $this->core->redirectUrl('');
			
		if ($this->c('AccountManager')->loadBanInfo($this->c('AccountManager')->user('id')))
		{
			$this->c('Log')->writeDebug('%s : user %s tried to add a comment, but user is banned', __METHOD__, $this->c('AccountManager')->user('id'));
			return $this->core->redirectUrl('account-status');
		}

		$char = $this->c('AccountManager')->getActiveCharacter();

		if (!$char)
			return $this->core->redirectUrl('');

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowBlogComments')
			->setType('insert');

		$text = str_replace(array('<', '>'), array('&lt;', '&gt;'), $text);

		$edt->blog_id = $blog_id;
		$edt->account = $this->c('AccountManager')->user('id');
		$edt->character_guid = $char['guid'];
		$edt->realm_id = $char['realmId'];
		$edt->postdate = time();
		$edt->comment_text = $text;

		if ($this->c('AccountManager')->isAdmin())
			$edt->blizzard = 1;
		elseif ($this->c('AccountManager')->isAllowedToModerate())
			$edt->mvp = 1;			

		$id = $edt->save()->getInsertId();

		// Update comments count
		$edt->clearValues()
			->setModel('WowNews')
			->setId($blog_id)
			->setType('update')
			->load();

		$edt->comments_count = $edt->comments_count + 1;

		$edt->save()->clearValues();

		$this->c('Session')->setSession('postTimeCountdown', time() + 60);

		return $this->core->redirectUrl('blog/' . $blog_id . '#page-comments');
	}

	public function checkBlogPagination()
	{
		$page = $this->getPage();

		$max = 10 * $page;

		$count = $this->c('QueryResult', 'Db')
			->model('WowNews')
			->fields(array('WowNews' => array('id')))
			->runFunction('COUNT', 'id')
			->loadItem();

		if ($count['id'] > $max)
			$this->core->setDataVar('nextPage', $page + 1);
		else
			$this->core->setDataVar('nextPage', 0);
	}

	public function getBlogNews()
	{
		return $this->c('QueryResult', 'Db')
			->model('WowNews')
			->limit(10, ($this->getPage(true) * 10))
			->order(array('WowNews' => array('postdate')), 'DESC')
			->loadItems();
	}

	public function getBlogCommentsCount($blog_id)
	{
		$d = $this->c('QueryResult', 'Db')
			->model('WowBlogComments')
			->fieldCondition('blog_id', ' = ' . intval($blog_id))
			->loadItems();

		return sizeof($d);
	}

	public function runBlogApi($blog_id)
	{
		if (!isset($_GET['method']))
			return false;

		$method = $_GET['method'];

		$edt = $this->c('Editing')->clearValues();

		switch ($method)
		{
			case 'deleteComment':
				if (!$this->c('AccountManager')->isAllowedToModerate() || !isset($_POST['comment_id']) || !intval($_POST['comment_id']))
					return false;

				$comment = intval($_POST['comment_id']);

				$edt->setModel('WowBlogComments')
					->setId($comment)
					->setType('delete')
					->delete()
					->clearValues()
					->setModel('WowNews')
					->setId($blog_id)
					->setType('update')
					->load();

				$edt->comments_count = max(($edt->comments_count - 1), 0);

				$edt->save()->clearValues();
				break;
		}

		return true;
	}

	public function setActiveRealm($realmName)
	{
		$rId = $this->getRealmIDByName($realmName);

		if ($rId == 0)
			return false;

		$this->c('Config')->setValue('tmp.db_characters.active', $rId);
		$this->c('Config')->setValue('tmp.db_world.active', $rId);

		$this->c('Db')->switchTo('characters', $rId);
		$this->c('Db')->switchTo('world', $rId);

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

	public function getRacesInFaction($faction)
	{
		if (!in_array($faction, array(FACTION_ALLIANCE, FACTION_HORDE)))
			return false;

		$races = array();
		$ids = array();

		if ($faction == FACTION_ALLIANCE)
			$ids = array(RACE_HUMAN, RACE_DWARF, RACE_NIGHTELF, RACE_GNOME, RACE_DRAENEI);
		else
			$ids = array(RACE_ORC, RACE_UNDEAD, RACE_TAUREN, RACE_TROLL, RACE_BLOODELF);

		foreach ($ids as $id)
			$races[$id] = array('id' => $id, 'name' => $this->c('Locale')->getString('character_race_' . $id));

		return $races;
	}

	public function getRealmsStatus()
	{
		$realms = $this->c('QueryResult', 'Db')
			->model('Realmlist')
			->loadItems();

		if (!$realms)
			return false;

		$errNo = 0;
		$errStr = '';
		foreach ($realms as &$r)
		{
			$r['status'] = @fsockopen($r['address'], $r['port'], $errNo, $errStr, 1) ? 'up' : 'down';
			switch ($r['icon'])
			{
                case 1:
                    $r['type'] = 'PvP';
                    break;
                case 6:
                    $r['type'] = $this->c('Locale')->getString('template_realm_status_type_roleplay');
                    break;
                case 8:
                    $r['type'] =$this->c('Locale')->getString('template_realm_status_type_rppvp');
                    break;
                case 0:
                case 4:
				default:
                    $r['type'] = 'PvE';
                    break;
			}
			switch ($r['timezone'])
			{
				default:
                    $r['language'] = 'Development Realm';
                    break;
                case 8:
                    $r['language'] = $this->c('Locale')->getString('template_locale_en');
                    break;
                case 9:
                    $r['language'] = $this->c('Locale')->getString('template_locale_de');
                    break;
                case 10:
                    $r['language'] = $this->c('Locale')->getString('template_locale_fr');
                    break;
                case 11:
                    $r['language'] = $this->c('Locale')->getString('template_locale_es');
                    break;
                case 12:
                    $r['language'] = $this->c('Locale')->getString('template_locale_ru');
                    break;
			}
			
			$query = $this->c('Db')->realm()->selectRow("SELECT uptime, players FROM uptime WHERE realmid='%s' ORDER BY `starttime` DESC LIMIT 0, 1", $r['id']);
			
			$time = $query['uptime'];
		    $day = floor($time / 86400);
		    $time %= 86400;
		    $hour = floor($time / 3600);
		    $time %= 3600;
		    $min = floor($time / 60);
		    $time %= 60;
		    $seccond = $time;

			$r['uptime'] = 'Minutos:' . $min . ' Horas:' . $hour . ' Dias:' . $day;
			
			switch ($r['id'])
			{			
				case 1:
						if ($r['status'])
						{
							if ($query['players'] < 100)
								$r['population'] = '<font color="green">BAJA</font>';
							else
								$r['population'] = $query['players'] + 500;
						}
						else
							$r['population'] = '<font color="grey">OFF</font>';
					break;
				case 2:
						if ($r['status'])
						{
							if ($query['players'] < 100)
								$r['population'] = '<font color="green">BAJA</font>';
							else
								$r['population'] = $query['players'] + 500;
						}
						else
							$r['population'] = '<font color="grey">OFF</font>';
					break;
				case 3:
						if ($r['status'])
						{
							if ($query['players'] < 100)
								$r['population'] = '<font color="green">BAJA</font>';
							else
								$r['population'] = $query['players'] + 500;
						}
						else
							$r['population'] = '<font color="grey">OFF</font>';
					break;
				case 4:
						if ($r['status'])
						{
							if ($query['players'] < 100)
								$r['population'] = '<font color="green">BAJA</font>';
							else
								$r['population'] = $query['players'];
						}
						else
							$r['population'] = '<font color="grey">OFF</font>';
					break;
				default:
						$r['population'] = '<font color="grey">OFF</font>';
			}
		}
		return $realms;
	}

	public function getWowInfo($model, $item)
	{
		$isDbLocale = true;
		$localeModel = '';

		switch ($model)
		{
			case 'QuestTemplate':
				$localeModel = 'LocalesQuest';
				break;
			case 'ItemTemplate':
				$localeModel = 'LocalesItem';
				break;
			case 'GameobjectTemplate':
				$localeModel = 'LocalesGameobject';
				break;
			case 'CreatureTemplate':
				$localeModel = 'LocalesCreature';
				break;
			case 'WowSpell':
			case 'WowAreas':
				$isDbLocale = false;
				break;
			default:
				return false;
		}

		$useLocale = $this->c('Locale')->getLocaleID() != LOCALE_EN;

		$q = $this->c('QueryResult')
			->model($model)
			->setItemId($item);

		if ($isDbLocale && $useLocale && $localeModel)
			$q->addModel($localeModel)->join('left', $localeModel, $model, 'entry', 'entry');

		return $q->loadItem();
	}
}
?>