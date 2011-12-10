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

class GameWoW_Component extends Component
{
	protected $m_gameType = 'index';
	protected $m_handler = null;
	protected $m_gameData = array();
	protected $m_gameBreadcrumbData = array();

	public function initGame($type)
	{
		if (!$type)
			return $this;

		$this->m_gameType = $type;

		return $this->runGame();
	}

	protected function runGame()
	{
		if (!$this->m_gameType)
			return $this;

		switch ($this->m_gameType)
		{
			case 'class':
				$this->buildClass();
				break;
			case 'race':
				$this->buildRace();
				break;
			case 'zone':
				$this->buildZone();
				break;
			case 'faction':
				$this->m_gameData = $this->m_gameType;
				$this->m_gameBreadcrumbData = array(
					array(
						'link' => 'game/faction/',
						'locale_index' => 'Facciones'
					)
				);
				break;
			case 'lore':
				break;
			case 'profession':
				break;
			case 'tool':
				break;
			case 'index':
				break;
			case 'guide':
				$this->m_gameData = $this->m_gameType;
				$this->m_gameBreadcrumbData = array(
					array(
						'link' => 'game/guide/',
						'locale_index' => 'Guía para principiantes'
					)
				);
				break;
			default:
				break;	
		}

		return $this;
	}

	public function getGameData()
	{
		return $this->m_gameData;
	}

	public function getGameBreadcrumbData()
	{
		return $this->m_gameBreadcrumbData;
	}

	protected function buildRace()
	{
		$raceKey = $this->core->getUrlAction(3);

		$this->m_gameBreadcrumbData = array(
			array(
				'link' => 'game/race/',
				'locale_index' => 'template_game_race_title'
			)
		);

		$raceData = array();

		if ($raceKey)
		{
			$raceData = $this->c('QueryResult', 'Db')
				->model('WowRaces')
				->setItemId($this->c('Wow')->getRaceIdByKey($raceKey))
				->loadItem();

			if ($raceData)
			{
				$raceData['name'] = $this->c('Locale')->getString('character_race_' . $raceData['id']);
				$raceData['faction'] = $this->c('Wow')->getFactionId($raceData['id']) == FACTION_ALLIANCE ? 'alliance' : 'horde';
				$raceData['faction_title'] = $this->c('Locale')->getString('faction_' . $raceData['faction']);

				if ($raceData['expansion'] > EXPANSION_CLASSIC)
				{
					$raceData['req_exp'] = $raceData['expansion'] == EXPANSION_WRATH ? 'wrath' : $raceData['expansion'] == EXPANSION_BC ? 'bc' : 'cataclysm';
					$raceData['req_exp_str'] = $this->c('Locale')->getString('template_zone_expansion_required') . ' ' . $this->c('Locale')->getString('template_expansion_' . $raceData['expansion']);
				}

				if ($raceData['id'] == RACE_HUMAN)
				{
					$raceData['prev-race'] = $this->c('Locale')->getString('character_race_' . RACE_WORGEN);
					$raceData['prev-race-lnk'] = $this->c('Wow')->getRaceKeyByID(RACE_WORGEN);
				}
				else if ($raceData['id'] == RACE_WORGEN)
				{
					$raceData['prev-race'] = $this->c('Locale')->getString('character_race_' . RACE_DRAENEI);
					$raceData['prev-race-lnk'] = $this->c('Wow')->getRaceKeyByID(RACE_DRAENEI);
					$raceData['next-race'] = $this->c('Locale')->getString('character_race_' . RACE_HUMAN);
					$raceData['next-race-lnk'] = $this->c('Wow')->getRaceKeyByID(RACE_HUMAN);
				}
				else if ($raceData['id'] == RACE_DRAENEI)
				{
					$raceData['next-race'] = $this->c('Locale')->getString('character_race_' . RACE_WORGEN);
					$raceData['next-race-lnk'] = $this->c('Wow')->getRaceKeyByID(RACE_WORGEN);
				}
			
				if (!isset($raceData['next-race']))
				{
					$raceData['next-race'] = $this->c('Locale')->getString('character_race_' . ($raceData['id'] + 1));
					$raceData['next-race-lnk'] = $this->c('Wow')->getRaceKeyByID($raceData['id'] + 1);
				}

				if (!isset($raceData['prev-race']))
				{
					$raceData['prev-race'] = $this->c('Locale')->getString('character_race_' . ($raceData['id'] - 1));
					$raceData['prev-race-lnk'] = $this->c('Wow')->getRaceKeyByID($raceData['id'] - 1);
				}

				$class_masks = array(
					'CLASS_MASK_WARRIOR', 'CLASS_MASK_PALADIN', 'CLASS_MASK_HUNTER', 'CLASS_MASK_ROGUE', 'CLASS_MASK_PRIEST', 'CLASS_MASK_DK', 'CLASS_MASK_SHAMAN', 'CLASS_MASK_MAGE', 'CLASS_MASK_WARLOCK', 'CLASS_MASK_DRUID'
				);

				$raceData['classes'] = array();

				foreach ($class_masks as $mask)
				{
					if ($raceData['classes_flag'] & constant($mask))
					{
						$class_key = strtolower(substr($mask, 11));
						$class_id = $this->c('Wow')->getClassIDByKey($class_key);

						if ($class_id == 0)
							continue;

						// Correct class key
						$class_key = $this->c('Wow')->getClassKeyByID($class_id);

						$raceData['classes'][] = array(
							'key' => $class_key,
							'id' => $class_id,
							'name' => $this->c('Locale')->getString('character_class_' . $class_id)
						);
					}
				}

				// Abilities
				$raceData['abilities'] = $this->c('QueryResult', 'Db')
					->model('WowRaceAbilities')
					->fieldCondition('race', ' = ' . $raceData['id'])
					->loadItems();

				$raceData['page'] = 'race-' . $raceData['key'];
				$raceData['page_title'] = $raceData['name'];

				$this->m_gameBreadcrumbData[] = array(
					'link' => 'game/race/' . $raceData['key'],
					'locale_index' => 'character_race_' . $raceData['id']
				);
			}
		}
		else
		{
			$raceData['races'] = $this->c('QueryResult', 'Db')
				->model('WowRaces')
				->keyIndex('id')
				->loadItems();

			$races = array('alliance' => array(), 'horde' => array());

			if ($raceData['races'])
			{
				foreach ($raceData['races'] as &$race)
				{
					$race['short_info'] = $this->c('Locale')->getString('template_game_race_' . $race['key'] . '_info');
					if ($race['expansion'] > EXPANSION_CLASSIC)
					{
						$race['req_exp'] = $race['expansion'] == EXPANSION_WRATH ? 'wrath' : $race['expansion'] == EXPANSION_BC ? 'bc' : 'cataclysm';
						$race['req_exp_str'] = $this->c('Locale')->getString('template_zone_expansion_required') . ' ' . $this->c('Locale')->getString('template_expansion_' . $race['expansion']);
					}

					$race['name'] = $this->c('Locale')->getString('character_race_' . $race['id']);

					if ($this->c('Wow')->getFactionId($race['id']) == FACTION_ALLIANCE)
						$races['alliance'][] = $race;
					else
						$races['horde'][] = $race;
				}
			}

			$raceData['races'] = $races;

			unset($races);

			$raceData['page'] = 'game-race-index';
			$raceData['page_title'] = $this->c('Locale')->getString('template_game_race_title');
		}

		$this->m_gameData = $raceData;

		unset($raceData);

		return $this;
	}

	protected function buildClass()
	{
		$classKey = $this->core->getUrlAction(3);

		$this->m_gameBreadcrumbData = array(
			array(
				'link' => 'game/class/',
				'locale_index' => 'template_game_class_title'
			)
		);

		if ($classKey)
		{
			$classData = $this->c('QueryResult', 'Db')
				->model('WowClasses')
				->setItemId($this->c('Wow')->getClassIdByKey($classKey))
				->loadItem();

			if ($classData)
			{
				$classData['page'] = 'class-' . $classKey;
				$classData['class'] = $this->c('Locale')->getString('character_class_' . $classData['id']);
				$classData['roles'] = $this->getClassRolesInfo($classData['roles_flag']);

				// Next/prev class
				if ($classData['id'] == CLASS_WARRIOR)
				{
					$classData['prev-class'] = $this->c('Locale')->getString('character_class_' . CLASS_DRUID);
					$classData['prev-class-lnk'] = $this->c('Classes', 'Data')->getClassKey(CLASS_DRUID);
				}
				elseif ($classData['id'] == CLASS_DRUID)
				{
					$classData['next-class'] = $this->c('Locale')->getString('character_class_' . CLASS_WARRIOR);
					$classData['next-class-lnk'] = $this->c('Classes', 'Data')->getClassKey(CLASS_WARRIOR);
					$classData['prev-class'] = $this->c('Locale')->getString('character_class_' . CLASS_WARLOCK);
					$classData['prev-class-lnk'] = $this->c('Classes', 'Data')->getClassKey(CLASS_WARLOCK);
				}
				elseif ($classData['id'] == CLASS_WARLOCK)
				{
					$classData['next-class'] = $this->c('Locale')->getString('character_class_' . CLASS_DRUID);
					$classData['next-class-lnk'] = $this->c('Classes', 'Data')->getClassKey(CLASS_DRUID);
				}

				if (!isset($classData['next-class']))
				{
					$classData['next-class'] = $this->c('Locale')->getString('character_class_' . ($classData['id'] + 1));
					$classData['next-class-lnk'] = $this->c('Classes', 'Data')->getClassKey(($classData['id'] + 1));
				}

				if (!isset($classData['prev-class']))
				{
					$classData['prev-class'] = $this->c('Locale')->getString('character_class_' . ($classData['id'] - 1));
					$classData['prev-class-lnk'] = $this->c('Classes', 'Data')->getClassKey(($classData['id'] - 1));
				}

				// Armor
				$armor_masks = array(
					'ITEM_SUBCLASS_MASK_CLOTH', 'ITEM_SUBCLASS_MASK_LEATHER', 'ITEM_SUBCLASS_MASK_MAIL', 'ITEM_SUBCLASS_MASK_PLATE', 'ITEM_SUBCLASS_MASK_SHIELD' 
				);
				// Weapons
				$weapon_masks = array(
					'ITEM_SUBCLASS_MASK_AXE', 'ITEM_SUBCLASS_MASK_AXE2', 'ITEM_SUBCLASS_MASK_BOW', 'ITEM_SUBCLASS_MASK_GUN', 'ITEM_SUBCLASS_MASK_MACE', 'ITEM_SUBCLASS_MASK_MACE2', 'ITEM_SUBCLASS_MASK_POLEARM', 'ITEM_SUBCLASS_MASK_SWORD', 'ITEM_SUBCLASS_MASK_SWORD2', 'ITEM_SUBCLASS_MASK_STAFF', 'ITEM_SUBCLASS_MASK_FIST', 'ITEM_SUBCLASS_MASK_DAGGER', 'ITEM_SUBCLASS_MASK_THROWN', 'ITEM_SUBCLASS_MASK_CROSSBOW', 'ITEM_SUBCLASS_MASK_WAND'
				);
				// Powers
				$power_masks = array(
					'POWER_MASK_MANA', 'POWER_MASK_RAGE', 'POWER_MASK_FOCUS', 'POWER_MASK_ENERGY', 'POWER_MASK_RUNIC_POWER'
				);

				$this->parseMasks($classData, $armor_masks, 'armors_flag', 'armor_info', 19, 'armor')
					 ->parseMasks($classData, $weapon_masks, 'weapons_flag', 'weapons_info', 19, 'weapon')
					 ->parseMasks($classData, $power_masks, 'powers_flag', 'powers_info', 11, 'power');

				// Talents
				$classData['talents_info'] = $this->c('QueryResult', 'Db')
					->model('WowTalentIcons')
					->fieldCondition('class', ' = ' . $classData['id'])
					->loadItems();

				// Abilities
				$classData['abilities_info'] = $this->c('QueryResult', 'Db')
					->model('WowClassAbilities')
					->fieldCondition('class', ' = ' . $classData['id'])
					->loadItems();

				// Races
				$classData['races_info'] = array();
				$race_masks = array(
					'RACE_MASK_DRAENEI', 'RACE_MASK_DWARF', 'RACE_MASK_GNOME', 'RACE_MASK_HUMAN', 'RACE_MASK_NIGHTELF', 'RACE_MASK_WORGEN',
					'RACE_MASK_BLOODELF', 'RACE_MASK_GOBLIN', 'RACE_MASK_ORC', 'RACE_MASK_TAUREN', 'RACE_MASK_TROLL', 'RACE_MASK_UNDEAD'
				);

				foreach($race_masks as $mask)
				{
					if ($classData['races_flag'] & constant($mask))
					{
						$race_key = strtolower(substr($mask, 10));
						$race_id = $this->c('Wow')->GetRaceIDByKey($race_key);
						// Correct race key
						$race_key = $this->c('Wow')->getRaceKeyById($race_id);

						if ($race_id == 0)
							continue;

						$classData['races_info'][] = array(
							'id' => $race_id,
							'key' => $race_key,
							'icon' => 'http://eu.media.blizzard.com/wow/icons/36/race_' . $race_key . '_female.jpg',
							'title' => $this->c('Locale')->getString('character_race_' . $race_id),
							'faction' => $this->c('Wow')->getFactionId($race_id) == FACTION_ALLIANCE ? 'alliance' : 'horde',
							'faction_title' => $this->c('Locale')->getString('faction_' . ($this->c('Wow')->getFactionId($race_id) == FACTION_ALLIANCE ? 'alliance' : 'horde'))
						);
					}
				}

				// Expansion
				if ($classData['expansion'] > EXPANSION_CLASSIC)
				{
					$classData['req_exp'] = $classData['expansion'] == EXPANSION_BC ? 'bc' : $classData['expansion'] == EXPANSION_WRATH ? 'wrath' : 'cata';
					$classData['req_exp_str'] = $this->c('Locale')->getString('template_zone_expansion_required') . ' ' . $this->c('Locale')->getString('template_expansion_' . $classData['expansion']);
				}

				$classData['page_title'] = $classData['class'];

				$this->m_gameBreadcrumbData[] = array(
					'link' => 'game/class/' . $classKey . '/',
					'locale_index' => 'character_class_' . $classData['id']
				);
			}
		}
		else
		{
			$classData['classes'] = $this->c('QueryResult', 'Db')
				->model('WowClasses')
				->keyIndex('id')
				->loadItems();

			$classData['page'] = 'game-classes-index';
			$classData['page_title'] = $this->c('Locale')->getString('template_game_class_title');

			if ($classData['classes'])
			{
				foreach ($classData['classes'] as &$class)
				{
					$class['roles'] = $this->getClassRolesInfo($class['roles_flag']);
					$class['short_info'] = $this->c('Locale')->getString('template_game_class_' . $class['key'] . '_info');

					if ($class['expansion'] > EXPANSION_CLASSIC)
					{
						$class['req_exp'] = $class['expansion'] == EXPANSION_BC ? 'bc' : $class['expansion'] == EXPANSION_WRATH ? 'wrath' : 'cata';
						$class['req_exp_str'] = $this->c('Locale')->getString('template_zone_expansion_required') . ' ' . $this->c('Locale')->getString('template_expansion_' . $class['expansion']);
					}
				}
			}
		}

		$this->m_gameData = $classData;

		unset($classData);

		return $this;
	}

	protected function getClassRolesInfo($roles_flag)
	{
		$role_info = '';
		$roles_masks = array('ROLE_MASK_TANK', 'ROLE_MASK_HEALER', 'ROLE_MASK_MELEE', 'ROLE_MASK_RANGED', 'ROLE_MASK_CASTER');

		foreach ($roles_masks as $mask)
		{
			if ($roles_flag & constant($mask))
			{
				$role = strtolower(substr($mask, 10));

				if (!$role)
					continue;

				$role_info .= $this->c('Locale')->getString('template_class_role_' . $role);
				$roles_flag -= constant($mask);

				if ($roles_flag > 0)
					$role_info .= ', ';
			}
		}

		return $role_info;
	}

	protected function parseMasks(&$src, $masks, $flag_idx, $info_idx, $mask_offset, $locale_idx)
	{
		if (!$masks)
			return $this;

		$src[$info_idx] = '';

		foreach ($masks as $mask)
		{
			if ($src[$flag_idx] & constant($mask))
			{
				$value = strtolower(substr($mask, $mask_offset));

				if (!$value)
					continue;

				$src[$info_idx] .= $this->c('Locale')->getString($locale_idx . '_' . $value);
				$src[$flag_idx] -= constant($mask);

				if ($src[$flag_idx] > 0)
					$src[$info_idx] .= ', ';
			}
		}

		return $this;
	}

	protected function buildZone()
	{
		$zone = $this->core->getUrlAction(2);
		$boss = $this->core->getUrlAction(3);

		if (!preg_match('/saA-zZ/i', $zone) && $boss == 'tooltip')
			return $this->handleTooltip((int) $zone);
		
		return $this;
	}

	protected function handleTooltip($zoneId)
	{
		$this->m_gameData = $this->c('QueryResult', 'Db')
			->model('WowInstances')
			->addModel('WowAreas')
			->join('left', 'WowAreas', 'WowInstances', 'location', 'id')
			->setAlias('WowAreas', 'name_' . $this->c('Locale')->GetLocale(), 'zoneName')
			->setAlias('WowAreas', 'flags', 'zoneFlags')
			->fieldCondition('wow_instances.zone_id', ' = ' . $zoneId)
			->loadItem();

		return $this;
	}

	public function getFaction($key)
	{
		if (!$key)
			return false;

		$q = $this->c('QueryResult', 'Db')
			->model('WowFactions');
		$id = intval($key);
		if (is_integer($key) || $id > 0)
			$q->fieldCondition('id', ' = ' . $key);
		else
			$q->fieldCondition('key', ' = \'' . $key . '\'');

		$faction = $q->loadItem();

		if (!$faction)
			return false;

		$faction['creatures'] = $this->c('QueryResult', 'Db')
			->model('WowFactionNpcs')
			->fieldCondition('faction_id', ' = ' . $faction['id'])
			->loadItems();

		return $faction;
	}

	public function getFactionTab(&$faction, $tab)
	{
		if (!$faction || !isset($faction['id'])|| !$faction['id'])
			return false;

		$contents = array();

		switch ($tab)
		{
			case 'rewards':
				$rewards_ids = $this->c('QueryResult', 'Db')
					->model('ItemTemplate')
					->fields(array('ItemTemplate' => array('entry')))
					->fieldCondition('RequiredReputationFaction', ' = ' . $faction['id'])
					->keyIndex('entry')
					->loadItems();
				if (!$rewards_ids)
					return false;

				$contents = $this->c('Item')->getItemsInfo($rewards_ids);

				if (!$contents)
					return false;
				break;
			case 'quests':
				$quests_ids = $this->c('QueryResult', 'Db')
					->model('QuestTemplate')
					->fields(array('QuestTemplate' => array('entry')))
					->fieldCondition('RewRepFaction1', ' = ' . $faction['id'], 'OR')
					->fieldCondition('RewRepFaction2', ' = ' . $faction['id'], 'OR')
					->fieldCondition('RewRepFaction3', ' = ' . $faction['id'], 'OR')
					->fieldCondition('RewRepFaction4', ' = ' . $faction['id'], 'OR')
					->loadItems();

				if (!$quests_ids)
					return false;

				$quests = $this->c('Quest')->getQuestsInfo($quests_ids);

				if (!$quests)
					return false;

				$contents = array(
					'daily' => 0,
					'normal' => 0,
					'quests' => array()
				);

				foreach ($quests as $q)
				{
					if ($q['QuestFlags'] & 4096)
						$contents['daily']++;
					else
						$contents['normal']++;
				}

				$contents['quests'] = $quests;
				unset($quests);

				break;
			case 'npcs':
				$factions_ids = $this->c('QueryResult', 'Db')
					->model('WowFactionTemplate')
					->fields(array('WowFactionTemplate' => array('factiontemplateID')))
					->keyIndex('factiontemplateID')
					->fieldCondition('factionID', ' = ' . $faction['id'])
					->loadItems();

				if (!$factions_ids)
					return false;

				$contents = $this->c('QueryResult', 'Db')
					->model('CreatureTemplate')
					->addModel('LocalesCreature')
					->join('left', 'LocalesCreature', 'CreatureTemplate', 'entry', 'entry')
					->fieldCondition('faction_A', array_keys($factions_ids))
					->keyIndex('entry')
					->loadItems();

				if (!$contents)
					return false;

				break;
			case 'achievements':
				$achievements_ids = $this->c('QueryResult', 'Db')
					->model('WowAchievementCriteria')
					->fields(array('WowAchievementCriteria' => array('referredAchievement')))
					->keyIndex('referredAchievement')
					->fieldCondition('requiredType', ' = 46')
					->fieldCondition('data', ' = ' . $faction['id'])
					->loadItems();

				if (!$achievements_ids)
					return false;

				$contents = $this->c('QueryResult', 'Db')
					->model('WowAchievement')
					->addModel('WowAchievementCategory')
					->join('left', 'WowAchievementCategory', 'WowAchievement', 'categoryId', 'id')
					->fieldCondition('wow_achievement.id', array_keys($achievements_ids))
					->setAlias('WowAchievementCategory', 'name_es', 'catTitle')
					->setAlias('WowAchievementCategory', 'id', 'catId')
					->loadItems();

				if (!$contents)
					return false;

				break;
		}

		return $contents;
	}

	public function getFactionTabs(&$faction, &$allowed)
	{
		$allowed = false;
		if (!$faction || !isset($faction['id']))
			return false;

		$tabs = array(
			'rewards' => 0,
			'quests' => 0,
			'npcs' => 0,
			'achievements' => 0
		);

		// Rewards (items)
		$rewards_ids = $this->c('QueryResult', 'Db')
			->model('ItemTemplate')
			->fields(array('ItemTemplate' => array('entry')))
			->fieldCondition('RequiredReputationFaction', ' = ' . $faction['id'])
			->keyIndex('entry')
			->loadItems();

		if ($rewards_ids)
		{
			$tabs['rewards'] = sizeof($rewards_ids);
			$allowed = true;
		}

		unset($rewards_ids);

		// NPCs
		$factions_ids = $this->c('QueryResult', 'Db')
			->model('WowFactionTemplate')
			->fields(array('WowFactionTemplate' => array('factiontemplateID')))
			->keyIndex('factiontemplateID')
			->fieldCondition('factionID', ' = ' . $faction['id'])
			->loadItems();

		if ($factions_ids)
		{
			$npcs_ids = $this->c('QueryResult', 'Db')
				->model('CreatureTemplate')
				->fields(array('CreatureTemplate' => array('entry')))
				->fieldCondition('faction_A', array_keys($factions_ids))
				->keyIndex('entry')
				->loadItems();

			if ($npcs_ids)
			{
				$tabs['npcs'] = sizeof($npcs_ids);
				$allowed = true;
			}

			unset($npcs_ids);
		}

		// Quest
		$quests_ids = $this->c('QueryResult', 'Db')
			->model('QuestTemplate')
			->fields(array('QuestTemplate' => array('entry')))
			->fieldCondition('RewRepFaction1', ' = ' . $faction['id'], 'OR')
			->fieldCondition('RewRepFaction2', ' = ' . $faction['id'], 'OR')
			->fieldCondition('RewRepFaction3', ' = ' . $faction['id'], 'OR')
			->fieldCondition('RewRepFaction4', ' = ' . $faction['id'], 'OR')
			->loadItems();

		if ($quests_ids)
		{
			$tabs['quests'] = sizeof($quests_ids);
			$allowed = true;
		}

		unset($quests_ids);

		// Achievements
		$achievements_ids = $this->c('QueryResult', 'Db')
			->model('WowAchievementCriteria')
			->fields(array('WowAchievementCriteria' => array('referredAchievement')))
			->keyIndex('referredAchievement')
			->fieldCondition('requiredType', ' = 46')
			->fieldCondition('data', ' = ' . $faction['id'])
			->loadItems();

		if ($achievements_ids)
		{
			$tabs['achievements'] = sizeof($achievements_ids);
			$allowed = true;
		}

		unset($achievements_ids);

		return $tabs;
	}

	public function getProfession($key)
	{
		if (!$key)
			return false;

		$profession = array(
			'related' => array(),
			'bonuses' => array(),
			'info' => array()
		);

		$profession['info'] = $this->c('QueryResult', 'Db')
			->model('WowProfessionData')
			->fieldCondition('key', ' = \'' . $key . '\'')
			->loadItem();

		if (!$profession['info'])
			return false;

		$profession['related'] = $this->c('QueryResult', 'Db')
			->model('WowProfessionRelated')
			->fieldCondition('profession_id', ' = ' . $profession['info']['id'])
			->loadItems();

		$profession['bonuses'] = $this->c('QueryResult', 'Db')
			->model('WowProfessionBonuses')
			->fieldCondition('profession_id', ' = ' . $profession['info']['id'])
			->loadItems();

		return $profession;
	}
}
?>