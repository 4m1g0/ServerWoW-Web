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

class CharacterProfile_Component extends Component
{
	protected $m_isBuilding = false;
	protected $m_isProfile = false;
	protected $m_loadingFlags = 0;
	protected $m_isCorrect = false;
	protected $m_serverType = null;
	protected $m_character = array();
	protected $m_info = array();
	protected $m_talents = array();
	protected $m_data = array();
	protected $m_guild = array();
	protected $m_inventory = array();
	protected $m_feeds = array();
	protected $m_skills = array();
	protected $m_spells = array();
	protected $m_achProgress = array();
	protected $m_url = '';
	protected $m_stats = array();
	protected $m_role = 0;
	protected $rating = array();
	protected $info_stats = array();
	protected $m_equipmentCache = array();
	protected $m_auditInfo = array();
	protected $m_mounts = array();
	protected $m_mountsCount = array();
	protected $m_reputation = array();
	protected $m_factions = array();
	protected $m_arenaTeams = array();
	protected $m_pvpInfo = array();

	public function isCorrect()
	{
		return $this->m_isCorrect;
	}

	public function IsManaUser()
	{
		return $this->getPowerType() == POWER_MANA;
	}

	public function getProfileType()
	{
		return isset($this->m_info['profileType']) ? $this->m_info['profileType'] : 'simple';
	}

	protected function nameToStandart(&$name)
	{
		$name = mb_convert_case(str_replace(array('"', "'", '\\', '/'), null, $name), MB_CASE_TITLE, 'UTF-8');

		return $this;
	}

	public function getProfilePage()
	{
		switch ($this->core->getUrlAction(4))
		{
			case 'simple':
			case 'advanced':
				return 'profile_home';
			default:
				return 'profile_' . strtolower($this->core->getUrlAction(4));
		}
	}

	public function getProfileMenuItems()
	{
		return array(
			array(
				'link' => '',
				'index' => 'template_profile_summary',
				'page' => 'profile_home',
			),/*
			array(
				'link' => 'talent',
				'index' => 'template_profile_talent',
				'page' => 'profile_talent',
			),
			array(
				'link' => $this->getWowUrl('vault/character/auction/' . $this->getFactionName() . '/'),
				'external' => true,
				'index' => 'template_profile_lots',
				'locked' => !$this->c('AccountManager')->isAccountCharacter($this->getRealmId(), $this->getGuid()),
				'page' => 'profile_lots',
				'extraClass' => 'has-submenu vault',
			),
			array(
				'link' => $this->getWowUrl('vault/character/event'),
				'external' => true,
				'index' => 'template_profile_events',
				'locked' => !$this->c('AccountManager')->isAccountCharacter($this->getRealmId(), $this->getGuid()),
				'page' => 'profile_events',
				'extraClass' => 'vault',
			),*/
			array(
				'link' => 'achievement',
				'index' => 'template_profile_achievement',
				'page' => 'profile_achievement',
				'extraClass' => 'has-submenu',
			),
			array(
				'link' => 'companion',
				'index' => 'template_profile_companions_mounts',
				'page' => 'profile_mounts',
			),/*
			array(
				'link' => 'profession',
				'index' => 'template_profile_profession',
				'page' => 'profile_profession',
				'extraClass' => 'has-submenu',
			),*/
			array(
				'link' => 'reputation',
				'index' => 'template_profile_reputation',
				'page' => 'profile_reputation',
			),
			array(
				'link' => 'pvp',
				'caption' => 'PvP',
				'page' => 'profile_pvp',
			),
			array(
				'link' => 'feed',
				'index' => 'template_profile_feed',
				'page' => 'profile_feed',
			),/*
			array(
				'link' => $this->getWowUrl('vault/character/friend'),
				'index' => 'template_profile_friends',
				'locked' => !$this->c('AccountManager')->isAccountCharacter($this->getRealmId(), $this->getGuid()),
				'page' => 'profile_friends',
				'external' => true,
				'extraClass' => 'vault',
			),*/
			array(
				'link' => $this->getGuildInfo('guildid') > 0 ? $this->getWowUrl('guild/' . $this->getRealmName() . '/' . $this->getGuildName() . '?character=' . urldecode($this->getName())) : '',
				'external' => true,
				'index' => 'template_profile_guild',
				'available' => $this->getGuildInfo('guildid') > 0 ? true : false,
				'page' => 'profile_guild',
				'extraClass' => 'has-submenu',
			)
		);
	}

	public function setLoadingFlag($flag)
	{
		$this->m_loadingFlags |= $flag;

		return $this;
	}

	public function getLoadingFlags()
	{
		return $this->m_loadingFlags;
	}

	public function getGuid()
	{
		return $this->getField('guid');
	}

	public function getName()
	{
		return $this->getField('name');
	}

	public function getClass()
	{
		return $this->getField('class');
	}

	public function getRace()
	{
		return $this->getField('race');
	}

	public function getLevel()
	{
		return $this->getField('level');
	}

	public function getGender()
	{
		return $this->getField('gender');
	}

	public function getRaceName()
	{
		if (!$this->getField('raceName'))
			$this->setField('raceName', $this->c('Locale')->getString('character_race_' . $this->getRace(), $this->getGender()));

		return $this->getField('raceName');
	}

	public function getClassName()
	{
		if (!$this->getField('className'))
			$this->setField('className', $this->c('Locale')->getString('character_class_' . $this->getClass(), $this->getGender()));

		return $this->getField('className');
	}

	public function getClassKey()
	{
		if (!$this->getField('classKey'))
			$this->setField('classKey', $this->c('Wow')->getClassKeyById($this->getClass()));

		return $this->getField('classKey');
	}

	public function getRaceKey()
	{
		if (!$this->getField('raceKey'))
			$this->setField('raceKey', $this->c('Wow')->getRaceKeyById($this->getRace()));

		return $this->getField('raceKey');
	}

	public function getFactionId()
	{
		if (!$this->getField('factionId'))
			$this->setField('factionId', $this->c('Wow')->getFactionID($this->getRace()));

		return $this->getField('factionId');
	}

	public function getFactionName()
	{
		if (!$this->getField('factionName'))
			$this->setField('factionName', $this->getFactionId() == FACTION_ALLIANCE ? 'alliance' : 'horde');

		return $this->getField('factionName');
	}

	public function getRealmName()
	{
		return $this->getField('realmName');
	}

	public function getRealmId()
	{
		return $this->getField('realmId');
	}

	public function getUrl()
	{
		if (!$this->m_url)
			$this->m_url = $this->getWowUrl('character/' . $this->getRealmName() . '/' . $this->getName());

		return $this->m_url;
	}

	public function getGuildName()
	{
		return $this->getGuildInfo('name');
	}

	public function getGuildUrl()
	{
		return $this->getWowUrl('guild/' . $this->getRealmName() . '/' . $this->getGuildInfo('name'));
	}

	public function getGuildInfo($info)
	{
		return isset($this->m_guild[$info]) ? $this->m_guild[$info] : null;
	}

	public function getInventory()
	{
		return $this->m_inventory;
	}

	public function getItem($slot)
	{
		return isset($this->m_inventory[$slot]) ? $this->m_inventory[$slot] : false;
	}

	public function getItemById($entry)
	{
		foreach ($this->m_inventory as &$item)
			if ($item['entry'] == $entry)
				return $item;

		return false;
	}

	public function getItemSlotInfo($slot, $info)
	{
		if (!isset($this->m_inventory[$slot]))
			return false;

		return isset($this->m_inventory[$slot][$info]) ? $this->m_inventory[$slot][$info] : false;
	}

	public function getActiveSpec()
	{
		if (!isset($this->m_character['talentPoints']) || !$this->m_character['talentPoints'])
			return false;

		foreach ($this->m_character['talentPoints'] as &$p)
			if ($p['active'])
				return $p;
		
		return $this->m_character['talentPoints'][0];
	}

	public function getFeeds()
	{
		return $this->m_feeds;
	}

	public function getPowerType()
	{
		return $this->getField('powerTypeID');
	}

	public function getItemEnchant($slot)
	{
		if($slot >= EQUIPMENT_SLOT_END) {
			$this->c('Log')->writeError('%s : wrong item slot ID: %d', __METHOD__, $slot);
			return false;
		}
		switch($slot) {
			case EQUIPMENT_SLOT_HEAD:
				return $this->m_equipmentCache[1];
			case EQUIPMENT_SLOT_NECK:
				return $this->m_equipmentCache[3];
			case EQUIPMENT_SLOT_SHOULDERS:
				return $this->m_equipmentCache[5];
			case EQUIPMENT_SLOT_BODY:
				return $this->m_equipmentCache[7];
			case EQUIPMENT_SLOT_CHEST:
				return $this->m_equipmentCache[9];
			case EQUIPMENT_SLOT_WRISTS:
				return $this->m_equipmentCache[17];
			case EQUIPMENT_SLOT_LEGS:
				return $this->m_equipmentCache[13];
			case EQUIPMENT_SLOT_FEET:
				return $this->m_equipmentCache[15];
			case EQUIPMENT_SLOT_WAIST:
				return $this->m_equipmentCache[11];
			case EQUIPMENT_SLOT_HANDS:
				return $this->m_equipmentCache[19];
			case EQUIPMENT_SLOT_FINGER1:
				return $this->m_equipmentCache[21];
			case EQUIPMENT_SLOT_FINGER2:
				return $this->m_equipmentCache[23];
			case EQUIPMENT_SLOT_TRINKET1:
				return $this->m_equipmentCache[25];
			case EQUIPMENT_SLOT_TRINKET2:
				return $this->m_equipmentCache[27];
			case EQUIPMENT_SLOT_BACK:
				return $this->m_equipmentCache[29];
			case EQUIPMENT_SLOT_MAINHAND:
				return $this->m_equipmentCache[31];
			case EQUIPMENT_SLOT_OFFHAND:
				return $this->m_equipmentCache[33];
			case EQUIPMENT_SLOT_RANGED:
				return $this->m_equipmentCache[35];
			case EQUIPMENT_SLOT_TABARD:
				return $this->m_equipmentCache[37];
			default:
				return 0;
		}
	}

	public function getItemId($slot)
	{
		return isset($this->m_equipmentCache[$slot]) ? $this->m_equipmentCache[$slot] : 0;
	}

	public function getProfessions()
	{
		return $this->m_skills['professions'];
	}

	public function getDataField($index)
	{
		return isset($this->m_data['data'][$index]) ? $this->m_data['data'][$index] : 0;
	}

	/**
	 * Sets realm name/realm id
	 * @access protected
	 * @param string $realmName
	 * @return CharacterProfile_Component
	 */
	protected function setRealmData($realmName)
	{
		$realmId = $this->c('Wow')->getRealmIDByName($realmName);

		$this->setField('realmName', $this->c('Config')->getValue('realms.' . $realmId . '.name'))
			->setField('realmId', $realmId);

		return $this;
	}

	/**
	 * Builds character profile
	 * @access public
	 * @param string $realmName
	 * @param string $name
	 * @param string $type = 'simple'
	 * @return CharacterProfile_Component
	 */
	public function buildCharacter($realmName, $name, $type = 'simple')
	{
		if ($this->m_isBuilding)
		{
			$this->c('Log')->writeError('%s : unable to build profile: another action is in progress.', __METHOD__);
			return $this;
		}
		elseif ($this->m_isProfile)
		{
			$this->c('Log')->writeError('%s : unable to build profile: profile was already built.', __METHOD__);
			return $this;
		}

		$this->m_isProfile = true;
		$this->m_isBuilding = true;

		if ($type == 'advanced')
			$this->buildAdvancedProfile($realmName, $name);
		else
			$this->buildSimpleProfile($realmName, $name);

		$this->setRealmData($realmName)
			->m_isBuilding = false;

		return $this;
	}

	/**
	 * Builds some character action
	 * @param string $realmName
	 * @param string $name
	 * @param string $action
	 * @return CharacterProfile_Component
	 */
	public function buildCharacterAction($realmName, $name, $action)
	{
		$action = strtolower($action);

		$this->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_DATA)
			->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_ITEMS)
			->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_RAID_INFO)
			->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_TALENTS);

		if (!in_array($action, array('mount', 'companion')))
			$this->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_SPELLS);

		if ($action != 'feed')
			$this->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_FEEDS);

		$this->loadCharacterFields($name);

		switch ($action)
		{
			case 'achievement':
			case 'statistic':
				$this->c('Achievement')->initAchievements($this->getGuid(), $action);
				break;
			case 'companion':
			case 'mount':
				$this->loadMounts($action);
				break;
			case 'reputation':
				$this->loadReputation();
				break;
			case 'pvp':
				$this->loadPvp();
				break;
		}

		$this->setRealmData($realmName);

		return $this;
	}

	protected function loadCharacterFields($name)
	{
		$this->nameToStandart($name);

		$this->m_character = $this->c('QueryResult', 'Db')
			->model('Characters')
			->fieldCondition('name', ('= \'' . $name . '\''), 'AND', true)
			->loadItem();

		if (!$this->m_character)
		{
			$this->c('Character_WoW', 'Controller')->setErrorPage();
			$this->c('Error_WoW', 'Controller');
			return $this;
		}

		if (!($this->m_loadingFlags & CHARACTER_LOADING_FLAG_SKIP_TALENTS))
		{
			$this->m_talents = $this->c('QueryResult', 'Db')
				->model('Charactertalent')
				->setItemId($this->getGuid())
				->loadItems();
		}

		if (!($this->m_loadingFlags & CHARACTER_LOADING_FLAG_SKIP_DATA))
		{
			$this->m_data = $this->c('QueryResult', 'Db')
				->model('ArmoryCharacterStats')
				->setItemId($this->getGuid())
				->loadItem();
		}

		if (!($this->m_loadingFlags & CHARACTER_LOADING_FLAG_SKIP_GUILD))
		{
			$this->m_guild = $this->c('QueryResult', 'Db')
				->model('Guildmember')
				->addModel('Guild')
				->join('left', 'Guild', 'Guildmember', 'guildid', 'guildid')
				->setItemId($this->getGuid())
				->loadItem();
		}

		if (!($this->m_loadingFlags & CHARACTER_LOADING_FLAG_SKIP_ITEMS))
		{
			$this->m_inventory = $this->c('QueryResult', 'Db')
				->model('CharacterInventory')
				->addModel('ItemInstance')
				->join('left', 'ItemInstance', 'CharacterInventory', 'item', 'guid')
				->setItemId($this->getGuid())
				->fieldCondition('character_inventory.slot', ' < ' . INV_MAX)
				->fieldCondition('character_inventory.bag', ' = 0')
				->keyIndex($this->m_serverType == SERVER_MANGOS ? 'item_template' : 'itemEntry')
				->loadItems();

			$this->m_skills = $this->c('QueryResult', 'Db')
				->model('Characterskills')
				->setItemId($this->getGuid())
				->loadItems();
	
			$this->m_spells = $this->c('QueryResult', 'Db')
				->model('CharacterSpell')
				->setItemId($this->getGuid())
				->keyIndex('spell')
				->loadItems();
		}

		if (!($this->m_loadingFlags & CHARACTER_LOADING_FLAG_SKIP_FEEDS))
		{
			$this->m_feeds = $this->c('QueryResult', 'Db')
				->model('CharacterFeedLog')
				->setItemId($this->getGuid())
				->limit(50)
				->order(array('CharacterFeedLog' => array('date')), 'DESC')
				->loadItems();
		}

		if (!($this->m_loadingFlags & CHARACTER_LOADING_FLAG_SKIP_ACHIEVEMENTS) && $this->m_isProfile)
			$this->c('Achievement')->loadSimple($this->getGuid());

		if (!($this->m_loadingFlags & CHARACTER_LOADING_FLAG_SKIP_RAID_INFO))
		{
			$this->m_achProgress = $this->c('QueryResult', 'Db')
				->model('CharacterAchievementProgress')
				->keyIndex('criteria')
				->setItemId($this->getGuid())
				->loadItems();
		}

		if (!($this->m_loadingFlags & CHARACTER_LOADING_FLAG_SKIP_SPELLS))
		{
			$this->m_spells = $this->c('QueryResult', 'Db')
				->model('CharacterSpell')
				->keyIndex('spell')
				->fieldCondition('active', ' = 1')
				->fieldCondition('disabled', ' = 0')
				->loadItems();
		}

		return $this->buildData();
	}

	public function getTitle()
	{
		return $this->getName() . ' @ ' . $this->getRealmName();
	}

	protected function initCharacter($realmName)
	{
		// Find and set active realm ID
		if (!$this->c('Wow')->setActiveRealm($realmName))
		{
			$this->c('Character_WoW', 'Controller')->setErrorPage();
			$this->c('Error_WoW', 'Controller');
			return $this;
		}

		$this->m_serverType = constant($this->c('Wow')->getActiveRealmType());

		return $this;
	}

	protected function buildData()
	{
		$this->handleCharacterTitle()
			->setPowerType()
			->convertDataFields()
			->handleInventory()
			->setField('lastUpdate', isset($this->m_data['save_date']) ? $this->m_data['save_date'] : 0)
			->handleFeeds()
			->handleTalents()
			->setField('powerValue', $this->GetPowerValue())
			->setRole()
			->handleSkills()
			->handleRaidProgress()
			->performAudit();

		$this->m_isCorrect = true;

		if ($this->m_isProfile)
			$this->CalculateStats();

		return $this;
	}

	protected function convertDataFields()
	{
		if (isset($this->m_data['data']) && is_string($this->m_data['data']))
			$this->m_data['data'] = explode(' ', $this->m_data['data']);

		if (is_string($this->m_character['equipmentCache']))
			$this->m_equipmentCache = explode(' ', $this->m_character['equipmentCache']);

		return $this;
	}

	protected function buildSimpleProfile($realmName, $name)
	{
		$this->m_info['profileType'] = 'simple';

		$this->initCharacter($realmName)
			->loadCharacterFields($name);

		$this->m_isCorrect = true;

		return $this;
	}

	protected function buildAdvancedProfile($realmName, $name)
	{
		$this->m_info['profileType'] = 'advanced';

		$this->initCharacter($realmName)
			->loadCharacterFields($name);

		$this->m_isCorrect = true;
		return $this;
	}

	protected function setPowerType()
	{
		switch ($this->getClass())
		{
			case CLASS_WARRIOR:
				$this->setField('powerTypeID', POWER_RAGE);
				break;
			case CLASS_ROGUE:
				$this->setField('powerTypeID', POWER_ENERGY);
				break;
			case CLASS_DK:
				$this->setField('powerTypeID', POWER_RUNIC_POWER);
				break;
			default:
				$this->setField('powerTypeID', POWER_MANA);
				break;
		}

		return $this;
	}

	protected function setRole()
	{
		$activeSpec = $this->getField('activeSpecId');
		switch ($this->getClass())
		{
			case CLASS_ROGUE:
				$this->m_role = ROLE_MELEE;
				break;
			case CLASS_HUNTER:
				$this->m_role = ROLE_RANGED;
				break;
			case CLASS_MAGE:
			case CLASS_WARLOCK:
				$this->m_role = ROLE_CASTER;
				break;
			case CLASS_SHAMAN:
			case CLASS_DRUID:
				if ($activeSpec == 0)
					$this->m_role = ROLE_CASTER;
				elseif ($activeSpec == 1)
					$this->m_role = ROLE_MELEE;
				else
					$this->m_role = ROLE_HEALER;
				break;
			case CLASS_PRIEST:
				if ($activeSpec == 2)
					$this->m_role = ROLE_CASTER;
				else
					$this->m_role = ROLE_HEALER;
				break;
			case CLASS_PALADIN:
				if ($activeSpec == 0)
					$this->m_role = ROLE_HEALER;
				elseif ($activeSpec == 1)
					$this->m_role = ROLE_TANK;
				else
					$this->m_role = ROLE_MELEE;
				break;
			case CLASS_WARRIOR:
				if ($activeSpec == 2)
					$this->m_role = ROLE_TANK;
				else
					$this->m_role = ROLE_MELEE;
				break;
			case CLASS_DK:
				if ($activeSpec == 0)
					$this->m_role = ROLE_TANK;
				else
					$this->m_role = ROLE_MELEE;
				break;
		}

		return $this;
	}

	public function getField($index)
	{
		return isset($this->m_character[$index]) ? $this->m_character[$index] : false;
	}

	protected function setField($index, $data)
	{
		$this->m_character[$index] = $data;

		return $this;
	}

	protected function handleFeeds()
	{
		if (!$this->m_feeds)
			return $this;
		
		$periods = array($this->c('Locale')->getString('template_feed_sec'), $this->c('Locale')->getString('template_feed_min'), $this->c('Locale')->getString('template_feed_hour'));
        $today = date('d.m.Y');
        $lengths = array(60, 60, 24);

		// Get achievement/item ids
		$feed_ids = array(
			'achievements' => array(),
			'items' => array(),
			'npcs' => array(),
		);

		$detected_npcs = array();

		foreach ($this->m_feeds as $key => &$feed)
		{
			if ($feed['type'] == TYPE_ACHIEVEMENT_FEED)
				$feed_ids['achievements'][] = $feed['data'];
			elseif ($feed['type'] == TYPE_ITEM_FEED)
				$feed_ids['items'][] = $feed['data'];
			elseif ($feed['type'] == TYPE_BOSS_FEED)
			{
				$feed_ids['npcs'][] = $feed['data'];
				$detected_npcs[$feed['data']] = $key;
			}
		}

		// Pre-load feed info
		$feed_data = array('achievements' => array(), 'items' => array(), 'bosses' => array());
		$locale = $this->c('Locale')->getLocale();
		$localeId = $this->c('Locale')->getLocaleId();

		if ($feed_ids['achievements'])
		{
			$feed_data['achievements'] = $this->c('QueryResult', 'Db')
				->model('WowAchievement')
				->fields(array('WowAchievement' => array('id', 'name_' . $locale, 'description_' . $locale, 'iconname', 'categoryId', 'points')))
				->keyIndex('id')
				->fieldCondition('id', $feed_ids['achievements'])
				->loadItems();
		}

		if ($feed_ids['items'])
		{
			$feed_data['items'] = $this->c('QueryResult', 'Db')
				->model('ItemTemplate')
				->keyIndex('entry')
				->fieldCondition('item_template.entry', $feed_ids['items']);
			if ($localeId != LOCALE_EN)
				$feed_data['items']->addModel('LocalesItem')
					->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry')
					->fields(array('ItemTemplate' => array('entry', 'displayid', 'Quality', 'name'), 'LocalesItem' => array('name_loc' . $localeId)));
				
				$feed_data['items'] = $feed_data['items']->loadItems();

			$icons = array();

			if ($feed_data['items'])
				foreach ($feed_data['items'] as &$item)
					$icons[] = $item['displayid'];
			
			if ($icons)
				$feed_data['icons'] = $this->c('QueryResult', 'Db')
					->model('WowIcons')
					->fieldCondition('displayid', $icons)
					->keyIndex('displayid')
					->loadItems();

			unset($icons);
		}

		if ($feed_ids['npcs'])
		{
			$npcs = $this->c('QueryResult', 'Db')
				->model('CreatureTemplate')
				->fields(array('CreatureTemplate' => array('entry', 'difficulty_entry_1', 'difficulty_entry_2', 'difficulty_entry_3')))
				->fieldCondition('entry', $feed_ids['npcs'], 'OR')
				->fieldCondition('difficulty_entry_1', $feed_ids['npcs'], 'OR')
				->fieldCondition('difficulty_entry_2', $feed_ids['npcs'], 'OR')
				->fieldCondition('difficulty_entry_3', $feed_ids['npcs'], 'OR')
				->keyIndex('entry')
				->loadItems();

			if ($npcs)
			{
				$entries = array();
				$difficulty_entries = array();
				foreach ($npcs as $npc)
				{
					$entries[] = $npc['entry'];
					for ($i = 1; $i < 4; ++$i)
					{
						$entries[] = $npc['difficulty_entry_' . $i];
						$difficulty_entries[$npc['difficulty_entry_' . $i]] = $npc['entry'];
					}
				}

				if ($entries)
				{
					$feed_data['bosses'] = $this->c('QueryResult', 'Db')
						->model('WowAchievement')
						->addModel('WowAchievementCriteria')
						->join('left', 'WowAchievementCriteria', 'WowAchievement', 'id', 'referredAchievement')
						->fields(array('WowAchievement' => array('name_' . $locale), 'WowAchievementCriteria' => array('referredAchievement', 'data')))
						->fieldCondition('wow_achievement_criteria.data', $entries)
						->fieldCondition('wow_achievement.flags', ' = 1')
						->keyIndex('data')
						->loadItems();
				}
			}
		}

		foreach ($this->m_feeds as &$feed)
		{
			$date_string = date('d.m.Y', $feed['date']);
            if($date_string == $today)
			{
                $diff = time() - $feed['date'];

                for ($i = 0; $diff >= $lengths[$i]; $i++)
                    $diff /= $lengths[$i];

                $diff = round($diff);
                $date_string = $diff . ' ' . $periods[$i] . ' ' . $this->c('Locale')->getString('template_feed_ago');
            }
  
			switch($feed['type'])
			{
				case TYPE_ACHIEVEMENT_FEED:
					// Rewrite achievement date
					$feed['date'] = $this->c('Achievement')->getAchievementDate($feed['data']);
					$feed['date_str'] = $date_string;
					$feed['info'] = isset($feed_data['achievements'][$feed['data']]) ? $feed_data['achievements'][$feed['data']] : false;
					break;
				case TYPE_BOSS_FEED:
					$feed['date_str'] = $date_string;
					if (isset($feed_data['bosses'][$feed['data']]))
					{
						$feed['info'] = $feed_data['bosses'][$feed['data']];
						$feed['counter'] = $this->getBossKillsCount($feed['data']);
					}
					elseif (isset($difficulty_entries) && $difficulty_entries && isset($difficulty_entries[$feed['data']]) && isset($feed_data['bosses'][$difficulty_entries[$feed['data']]]))
					{
						$feed['info'] = $feed_data['bosses'][$difficulty_entries[$feed['data']]];
						$feed['counter'] = $this->getBossKillsCount($feed['data']);
					}
					else
						unset($feed);
					break;
				case TYPE_ITEM_FEED:
					$feed['date_str'] = $date_string;
					if (isset($feed_data['items'][$feed['data']]))
					{
						$feed['info'] = $feed_data['items'][$feed['data']];
						$feed['info']['icon'] = isset($feed_data['icons'][$feed['info']['displayid']]) ? $feed_data['icons'][$feed['info']['displayid']]['icon'] : null;
					}
					else
						$feed['info'] = array();
					break;
				default:
					$this->c('Log')->writeError('%s : unknown feed type: %d (GUID: %d), ignore.', __METHOD__, $feed['type'], $this->getGuid());
					unset($feed);
					break;
			}
		}

		unset($feed_data, $detected_npcs, $entries, $feed_ids, $npcs);

		return $this;
	}

	protected function getBossKillsCount($entry)
	{
		$count = 0;
		foreach ($this->m_feeds as &$feed)
		{
			if ($feed['type'] == TYPE_BOSS_FEED && $feed['data'] == $entry)
				++$count;
		}
		return $count;
	}

	protected function handleInventory()
	{
		if (!$this->m_inventory)
			return $this;

		$entries = array_keys($this->m_inventory);
		$query = $this->c('QueryResult', 'Db')
			->model('ItemTemplate')
			->fieldCondition('entry', array_keys($this->m_inventory))
			->keyIndex('entry');
		if ($this->getProfileType() == 'advanced' && $this->c('Locale')->GetLocaleID() != LOCALE_EN)
		{
			$query->addModel('LocalesItem')
				->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry');
		}
		$items_info = $query->loadItems();
		unset($query);

		$displayid = array();
		$itemsets = array();
		foreach ($items_info as &$item)
		{
			$displayid[] = $item['displayid'];
			if ($item['itemset'] > 0 && !in_array($item['itemset'], $itemsets))
				$itemsets[] = $item['itemset'];
		}

		$item_icons = $this->c('QueryResult', 'Db')
			->model('WowIcons')
			->fieldCondition('displayid', $displayid)
			->keyIndex('displayid')
			->loadItems();

		if ($itemsets && sizeof($itemsets) > 0)
		{
			$itemsets_original = $this->c('QueryResult', 'Db')
				->model('WowItemsetdata')
				->fieldCondition('original', $itemsets)
				->keyIndex('id')
				->loadItems();

			$itemset_modified = $this->c('QueryResult', 'Db')
				->model('WowItemsetinfo')
				->fieldCondition('id', $itemsets)
				->keyIndex('id')
				->loadItems();
		}

		$tmp = array();
		$total_iLvl = 0;
		$maxLvl = 0;
		$minLvl = 500;
		$ilvl_counter = 0;
		$enchants = array();
		$gems = array();
		$gem_items = array();
		$template_idx = $this->m_serverType == SERVER_MANGOS ? 'item_template' : 'itemEntry';
		foreach ($this->m_inventory as &$item)
		{
			if (isset($item['data']))
				$item['data_field'] = explode(' ', $item['data']);

			if (isset($item_icons[$items_info[$item[$template_idx]]['displayid']]))
				$items_info[$item[$template_idx]]['icon'] = $item_icons[$items_info[$item[$template_idx]]['displayid']]['icon'];

			$item = array_merge($item, $items_info[$item[$template_idx]]);

			if (in_array($item['slot'], array(INV_BELT, INV_SHIRT, INV_RANGED_RELIC, INV_TABARD, INV_TRINKET_1, INV_TRINKET_2, INV_NECK, INV_OFF_HAND, INV_RING_1, INV_RING_2, INV_NECK)))
				$item['can_ench'] = false;
			else
				$item['can_ench'] = true;

			$item['socketsCount'] = 0;

			for ($i = 1; $i < 4; ++$i)
				if ($item['socketColor_' . $i] > 0)
					++$item['socketsCount'];

			if (!in_array($item['slot'], array(EQUIPMENT_SLOT_BODY, EQUIPMENT_SLOT_TABARD)) && $item['ItemLevel'] > 0)
			{
				$total_iLvl += $item['ItemLevel'];

				if ($item['ItemLevel'] < $minLvl)
					$minLvl = $item['ItemLevel'];

				if ($item['ItemLevel'] > $maxLvl)
					$maxLvl = $item['ItemLevel'];

				++$ilvl_counter;
			}

			if (isset($itemsets_original) && $itemsets_original && $item['itemset'] > 0)
			{
				foreach ($itemsets_original as &$itemset)
				{
					for ($j = 1; $j < 6; ++$j)
					{
						if (!isset($itemset['item' . $j]))
							continue;

						if ($itemset['item' . $j] == $item['entry'])
						{
							$item['itemset_info'] = $itemset;
							break;
						}
					}
					if (isset($item['itemset_info']))
						break;
				}
			}

			if (!isset($item['itemset_info']) && $item['itemset'] > 0 && isset($itemset_modified) && $itemset_modified && isset($itemset_modified[$item['itemset']]))
				$item['itemset_info'] = $itemset_modified[$item['itemset']];

			$this->handleItem($item, $enchants, $gems);
			$tmp[$item['slot']] = $item;
		}

		$this->m_inventory = $tmp;

		if ($ilvl_counter > 0)
		{
			$this->setField('avgILvlEquipped', round(($maxLvl + $minLvl) / 2));
			$this->setField('avgILvl', round($total_iLvl / $ilvl_counter));
		}

		if (($enchants || $gems) && $this->getProfileType() == 'advanced')
		{
			$enchantments = $this->c('QueryResult', 'Db')
				->model('WowEnchantment')
				->keyIndex('id')
				->fieldCondition('id', array_merge($enchants, $gems))
				->loadItems();

			if ($enchantments)
			{
				if ($gems)
				{
					foreach ($gems as $g_id)
					{
						if ($g_id == 0)
							continue;

						if (isset($enchantments[$g_id]) && isset($enchantments[$g_id]['gem']) && $enchantments[$g_id]['gem'] > 0)
						{
							$gem_items[] = $enchantments[$g_id]['gem'];
						}
					}
					if ($gem_items)
					{
						$query = $this->c('QueryResult', 'Db')
							->model('ItemTemplate')
							->fieldCondition('item_template.entry', $gem_items);

						if ($this->c('Locale')->GetLocaleID() != LOCALE_EN)
							$query->addModel('LocalesItem')->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry')->fields(array('ItemTemplate' => array('entry', 'name', 'Quality'), 'LocalesItem' => array('name_loc' . $this->c('Locale')->GetLocaleID())));
						else
							$query->fields(array('ItemTemplate' => array('entry', 'name', 'Quality')));

						$gem_items = $query->keyIndex('entry')->loadItems();
					}
				}
				$spells = $this->c('QueryResult', 'Db')
					->model('WowSpellenchantment')
					->fieldCondition('Value', $enchants)
					->keyIndex('Value')
					->loadItems();

				if ($spells)
				{
					$spell_ench_ids = array();
					foreach ($spells as &$spell)
						$spell_ench_ids[] = $spell['id'];

					if ($spell_ench_ids)
						$ench_items = $this->c('QueryResult')
							->model('ItemTemplate')
							->addModel('LocalesItem')
							->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry')
							->fields(array('ItemTemplate' => array('entry', 'Quality', 'name', 'spellid_1', 'spellid_2', 'spellid_3'), 'LocalesItem' => array('name_loc' . $this->c('Locale')->GetLocaleID())))
							->fieldCondition('item_template.spellid_1', $spell_ench_ids, 'OR')
							->fieldCondition('item_template.spellid_2', $spell_ench_ids, 'OR')
							->fieldCondition('item_template.spellid_3', $spell_ench_ids, 'OR')
							->keyIndex('entry')
							->loadItems();
				}

				$ench_spells = array();
				foreach ($enchantments as &$ench_tmp)
				{
					for ($i = 1; $i < 4; ++$i)
					{
						if ($ench_tmp['type_' . $i] == ITEM_ENCHANTMENT_TYPE_EQUIP_SPELL && $ench_tmp['spellid_' . $i] > 0)
							$ench_spells[] = $ench_tmp['spellid_' . $i];
					}
				}

				if ($ench_spells)
				{
					$ench_spells = $this->c('QueryResult', 'Db')
						->model('WowSpell')
						->fields(array('WowSpell' => array('id', 'Effect_1', 'EffectDieSides_1', 'EffectBasePoints_1', 'EffectMiscValue_1', 'EffectApplyAuraName_1')))
						->fieldCondition('id', $ench_spells)
						->keyIndex('id')
						->loadItems();
				}

				foreach ($this->m_inventory as &$item)
				{
					if (isset($item['enchant']) && $item['enchant'])
					{
						if (isset($enchantments[$item['enchant']]))
						{
							if (isset($spells) && $spells && isset($spells[$item['enchant']]))
							{
								$spellid = $spells[$item['enchant']]['id'];
								if (isset($ench_items) && $ench_items)
								{
									foreach ($ench_items as $ench_item)
									{
										for ($i = 1; $i < 4; ++$i)
										{
											if (isset($ench_spells[$enchantments[$item['enchant']]['spellid_' . $i]]))
													$enchantments[$item['enchant']]['ench_spellid_' . $i] = $ench_spells[$enchantments[$item['enchant']]['spellid_' . $i]];

											if ($ench_item['spellid_' . $i] == $spellid)
											{
												if (strpos($ench_item['name'], '-') !== false)
													$ench_item['name'] = substr($ench_item['name'], strpos($ench_item['name'], '-')+1);

												$enchantments[$item['enchant']]['item'] = $ench_item;
												break;
											}
										}
										if (isset($enchantments[$item['enchant']]['item']))
											break;
									}
								}
							}
							$item['enchant'] = $enchantments[$item['enchant']];
						}
					}

					if (isset($item['gems']) && $item['gems'])
					{
						$gem_spells = array();
						foreach ($item['gems'] as $gem_idx => &$gem)
						{
							if (isset($enchantments[$gem]))
							{
								$gem = $enchantments[$gem];
								if ($gem_items && isset($gem_items[$gem['gem']]))
									$gem['item'] = $gem_items[$gem['gem']];
							}

							for ($i = 1; $i < 4; ++$i)
								if ($gem['type_' . $i] == ITEM_ENCHANTMENT_TYPE_EQUIP_SPELL && $gem['spellid_' . $i] > 0)
									$gem_spells[$gem['spellid_' . $i]] = array($gem_idx, $i);
						}

						if ($gem_spells)
						{
							$g_spells = $this->c('QueryResult', 'Db')
								->model('WowSpell')
								->fields(array('WowSpell' => array('id', 'Effect_1', 'EffectDieSides_1', 'EffectBasePoints_1', 'EffectMiscValue_1', 'EffectApplyAuraName_1')))
								->fieldCondition('id', array_keys($gem_spells))
								->keyIndex('id')
								->loadItems();

							if ($g_spells)
							{
								foreach ($gem_spells as $spellid => $gem_slot_info)
								{
									if (!isset($g_spells[$spellid]))
										continue;

									$item['gems'][$gem_slot_info[0]]['ench_spellid_' . $gem_slot_info[1]] = $g_spells[$spellid];
								}
							}
							unset($g_spells);
						}
						unset($gem_spells);
					}
				}
			}
		}

		unset($ench_spells, $ench_items, $items_info, $tmp, $item_icons, $displayid, $itemset_modified, $itemsets_original, $itemsets, $gems, $enchantments, $enchants, $entries);

		return $this;
	}

	protected function handleItem(&$item, &$enchants, &$gems)
	{
		if (!$item || !isset($item['slot']))
			return $this;

		if ($this->m_serverType == SERVER_MANGOS && isset($item['data_field']))
		{
			if ($item['data_field'][ITEM_FIELD_ENCHANTMENT_3_2-1] > 0 || $item['data_field'][ITEM_FIELD_ENCHANTMENT_4_2-1] > 0 || $item['data_field'][ITEM_FIELD_ENCHANTMENT_5_2-1] > 0)
				$item['gems'] = array(
					$item['data_field'][ITEM_FIELD_ENCHANTMENT_3_2-1],
					$item['data_field'][ITEM_FIELD_ENCHANTMENT_4_2-1],
					$item['data_field'][ITEM_FIELD_ENCHANTMENT_5_2-1],
				);

			$item['durability'] = array(
				'current' => $item['data_field'][ITEM_FIELD_DURABILITY],
				'max' => $item['data_field'][ITEM_FIELD_MAXDURABILITY]
			);
		}
		elseif ($this->m_serverType == SERVER_TRINITY && isset($item['enchantments']))
		{
			$tmp = explode(' ', $item['enchantments']);
			if ($tmp)
			{
				if ($tmp[6] > 0 || $tmp[9] > 0 || $tmp[12] > 0)
				{
					$item['gems'] = array(
						$tmp[6],
						$tmp[9],
						$tmp[12],
					);
				}
			}

			if (isset($item['durability']))
				$item['durability'] = array(
					'current' => $item['durability'],
					//'max' => $item['maxdurability']
				);

			unset($tmp);
		}

		$item['enchant'] = $this->getItemEnchant($item['slot']);
		$enchants[$item['slot']] = $item['enchant'];

		$item['data_item'] = 'i=' . $item['entry'];
		
		if ($item['enchant'] > 0)
			$item['data_item'] .= '&amp;e=' . $item['enchant'];

		if (isset($item['gems']) && $item['gems'])
		{
			$i = 0;
			foreach ($item['gems'] as &$gem)
			{
				if ($gem > 0)
				{
					$item['data_item'] .= '&amp;g' . $i . '=' . $gem;
					$gems[] = $gem;
				}
				else
					unset($gem);

				++$i;
			}
		}

		$item['data_item'] .= '&amp;s=' . $item['guid'] . '&amp;r=' . $this->getField('realmId') . '&amp;cd=' . (isset($item['durability']) ? $item['durability']['current'] : 0) . '&amp;pl=' . $this->getLevel() . '&amp;t=true';

		// Itemset?
		$pieces = '';
		if ($item['itemset'] > 0 && isset($item['itemset_info']) && $item['itemset_info'])
		{
			for ($i = 1; $i < 18; ++$i)
			{
				if (!isset($item['itemset_info']['item' . $i]))
					break;

				if (isset($this->m_inventory[$item['itemset_info']['item' . $i]]))
					$pieces .= $item['itemset_info']['item' . $i] . ',';
			}
		}

		if ($pieces)
			$item['data_item'] .= '&amp;set=' . substr($pieces, 0, strlen($pieces)-1);
		
		return $this;
	}

	protected function handleCharacterTitle()
	{
		if (!$this->getField('chosenTitle'))
			return $this;

		$title = $this->c('QueryResult', 'Db')
			->model('Wowtitles')
			->setItemId($this->getField('chosenTitle'))
			->loadItem();
		if (!$title)
		{
			$this->c('Log')->writeError('%s : character %s (GUID: %d, realm: %s) has unknown chosenTitle value (%d)!', __METHOD__, $this->getName(), $this->getGuid(), $this->getRealmName(), $this->getField('chosenTitle'));
			return $this;
		}

		switch ($this->getGender())
		{
			case GENDER_FEMALE:
				$this->setField('title', $title['title_F']);
				break;
			default:
				$this->setField('title', $title['title_M']);
				break;
		}

		unset($title);

		return $this;
	}

	protected function getTalentTab($tab_count = -1)
	{
		$talentTabId = array(
            CLASS_WARRIOR => array(161, 164, 163),
            CLASS_PALADIN => array(382, 383, 381),
            CLASS_HUNTER  => array(361, 363, 362),
            CLASS_ROGUE   => array(182, 181, 183),
            CLASS_PRIEST  => array(201, 202, 203),
            CLASS_DK      => array(398, 399, 400),
            CLASS_SHAMAN  => array(261, 263, 262),
            CLASS_MAGE    => array( 81,  41,  61),
            CLASS_WARLOCK => array(302, 303, 301),
            CLASS_DRUID   => array(283, 281, 282)
        );

       	if (!isset($talentTabId[$this->getClass()]))
       		return false;

		$tab_class = $talentTabId[$this->getClass()];

		if ($tab_count >= 0)
		{
			$values = array_values($tab_class);
			unset($tab_class);
			return $values[$tab_count];
		}

		return $tab_class;
	}

	protected function handleTalents()
	{
		if (!$this->m_talents)
			return $this;

		$tab_class = $this->getTalentTab();
		if (!$tab_class)
			return $this;

		$talents = array();
		$builds = array(0 => '', 1 => '');
		$points = array();
		for ($i = 0; $i < 2; ++$i)
		{
			$points[$i] = array();
			foreach ($tab_class as &$tab)
				$points[$i][$tab] = 0;
		}

		$tabs = $this->c('QueryResult', 'Db')
			->model('WowTalents')
			->fieldCondition('TalentTab', $tab_class)
			->order(
				array(
					'WowTalents' => array('TalentTab', 'Row', 'Col')
				)
			)
			->loadItems();

		if (!$tabs)
			return $this;

		switch($this->m_serverType)
		{
			case SERVER_MANGOS:
				foreach ($this->m_talents as $tal)
					$talents[$tal['spec']][$tal['talent_id']] = $tal;

				$this->m_talents = $talents;
				break;
			case SERVER_TRINITY:
				foreach ($this->m_talents as $tal)
				{
					$tal_id = 0;
					$rank = 0;

					foreach ($tabs as $_tab)
					{
						for ($i = 1; $i < 6; ++$i)
						{
							if ($_tab['Rank_' . $i] == $tal['spell'])
							{
								$tal_id = $_tab['TalentID'];
								$rank = $i;
							}
						}
					}
					if ($tal_id > 0 && $rank > 0)
					{
						$tal['current_rank'] = $rank - 1;
						$tal['talent_id'] = $tal_id;
						$talents[$tal['spec']][$tal_id] = $tal;
					}
				}
				$this->m_talents = $talents;
				break;
			default:
				return $this;
		}

		foreach ($tabs as $ttab)
		{
			for ($i = 0; $i < 2; ++$i)
				if (isset($this->m_talents[$i][$ttab['TalentID']]))
				{
					$builds[$i] .= $this->m_talents[$i][$ttab['TalentID']]['current_rank'] + 1;
					if (!isset($points[$i][$ttab['TalentTab']]))
						$points[$i][$ttab['TalentTab']] = 0;
					$points[$i][$ttab['TalentTab']] += $this->m_talents[$i][$ttab['TalentID']]['current_rank'] + 1;
				}
				else
					$builds[$i] .= '0';
		}

		$specs_data = $this->c('QueryResult')
			->model('WowTalentIcons')
			->fieldCondition('class', ' = ' . $this->getClass())
			->keyIndex('spec')
			->loadItems();

		$specs_data[3] = array('name' => $this->c('Locale')->getString('template_no_talents'), 'icon' => 'inv_misc_questionmark');

		for ($i = 0; $i < 2; ++$i)
		{
			$tmp = array();
			for ($j = 0; $j < 3; ++$j)
				$tmp[$j] = $points[$i][$tab_class[$j]];

			$points[$i] = array(
				'treeOne' => $tmp[0],
				'treeTwo' => $tmp[1],
				'treeThree' => $tmp[2],
				'active' => false,
				'type' => $i == 0 ? 'primary' : 'secondary'
			);
			if ($points[$i]['treeOne'] == 0 && $points[$i]['treeTwo'] == 0 && $points[$i]['treeThree'] == 0)
				$index = 3;
			else if ($points[$i]['treeOne'] > $points[$i]['treeTwo'] && $points[$i]['treeOne'] > $points[$i]['treeThree'])
				$index = 0;
			elseif ($points[$i]['treeTwo'] > $points[$i]['treeOne'] && $points[$i]['treeTwo'] > $points[$i]['treeThree'])
				$index = 1;
			else if ($points[$i]['treeThree'] > $points[$i]['treeOne'] && $points[$i]['treeThree'] > $points[$i]['treeTwo'])
				$index = 2;
			else
				$index = 3;

			$points[$i]['icon'] = $specs_data[$index]['icon'];
			$points[$i]['name'] = $specs_data[$index]['name'];
			$points[$i]['roles'] = array();

			if ($index < 3 && $index >= 0)
			{
				if ($specs_data[$index]['dps'])
					$points[$i]['roles'][] = 'dps';
				if ($specs_data[$index]['healer'])
					$points[$i]['roles'][] = 'healer';
				if ($specs_data[$index]['tank'])
					$points[$i]['roles'][] = 'tank';
			}
			
			if ($this->getField('activeSpec') == $i)
			{
				$points[$i]['active'] = true;
				$this->setField('activeSpecName', $points[$i]['name'])
					->setField('activeSpecId', $index);
			}
		}

		$this->setField('talentPoints', $points)
			->setField('talentBuilds', $builds)
			->setField('talentsOk', true);

		unset($tab_class, $tabs, $talents, $points, $builds, $specs_data);

		return $this;
	}

	protected function handleSkills()
	{
		if (!$this->m_skills)
			return $this;

		$skills_professions = array(
            SKILL_BLACKSMITHING,
            SKILL_LEATHERWORKING,
            SKILL_ALCHEMY,
            SKILL_HERBALISM,
            SKILL_MINING,
            SKILL_TAILORING,
            SKILL_ENGINERING,
            SKILL_ENCHANTING,
            SKILL_SKINNING,
            SKILL_JEWELCRAFTING,
            SKILL_INSCRIPTION
        );

		$professions = $this->c('QueryResult', 'Db')
			->model('WowProfessions')
			->keyIndex('id')
			->loadItems();

		$profs = array();
		$others = array();

		foreach ($this->m_skills as $skill)
		{
			if (in_array($skill['skill'], $skills_professions))
			{
				$skill = array_merge($skill, $professions[$skill['skill']]);
				$profs[] = $skill;
			}
			else
				$others[] = $skill;
		}

		$this->m_skills = array(
			'professions' => $profs,
			'others' => $others
		);
		unset($professions, $others, $profs, $skills_professions, $skill);

		return $this;
	}

	/************************
		  Stats system
	************************/
	
	public function GetCharacterStrength() {
		if(!isset($this->m_stats['base_stats']['strength'])) {
			$this->CalculateCharacterStrength(true);
		}
		return $this->m_stats['base_stats']['strength'];
	}
	
	public function GetCharacterAgility() {
		if(!isset($this->m_stats['base_stats']['agility'])) {
			$this->CalculateCharacterAgility(true);
		}
		return $this->m_stats['base_stats']['agility'];
	}
	
	public function GetCharacterStamina() {
		if(!isset($this->m_stats['base_stats']['stamina'])) {
			$this->CalculateCharacterStamina(true);
		}
		return $this->m_stats['base_stats']['stamina'];
	}
	
	public function GetCharacterIntellect() {
		if(!isset($this->m_stats['base_stats']['intellect'])) {
			$this->CalculateCharacterIntellect(true);
		}
		return $this->m_stats['base_stats']['intellect'];
	}
	
	public function GetCharacterSpirit() {
		if(!isset($this->m_stats['base_stats']['spirit'])) {
			$this->CalculateCharacterSpirit(true);
		}
		return $this->m_stats['base_stats']['spirit'];
	}
	
	private function SetRating() {
		if(!$this->rating) {
			$this->rating = $this->c('Wow')->getRating($this->getLevel());
		}
		return true;
	}
	
	public function GetHealth() {
		return $this->getField('health');
	}
	
	public function GetPowerValue()
	{
		switch($this->getClass())
		{
			case CLASS_ROGUE:
			case CLASS_DK:
				return $this->CalculateMaxEnergy();
			case CLASS_WARRIOR:
				return 100;
			default:
				return $this->getDataField(UNIT_FIELD_POWER1 + $this->GetPowerType());
		}
	}
	
	private function GetStat($stat) {
		return $this->getDataField(UNIT_FIELD_STAT0 + $stat);
	}
	
	private function GetPosStat($stat) {
		return $this->getDataField(UNIT_FIELD_POSSTAT0 + $stat);
	}
	
	private function GetNegStat($stat) {
		return $this->getDataField(UNIT_FIELD_NEGSTAT0 + $stat);
	}
	
	public function CalculateStats($recalculate = true) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		$this->CalculateBaseStats($recalculate);
		$this->CalculateMeleeStats($recalculate);
		$this->CalculateRangedStats($recalculate);
		$this->CalculateSpellStats($recalculate);
		$this->CalculateDefenseStats($recalculate);
		$this->CalculateResistanceStats($recalculate);
		return true;
	}
	
	private function UpdateStatsInfo($stat_type, $value) {
		$this->info_stats[$stat_type] = $value;
		return true;
	}
	
	private function GetStatsInfo($stat_type) {
		return isset($this->info_stats[$stat_type]) ? $this->info_stats[$stat_type] : false;
	}

	private function hasTalent($talent_id, $active_spec = false)
	{
		if ($active_spec && isset($this->m_talents[$this->getField('activeSpec')][$talent_id]))
			return true;
		elseif (!$active_spec && (isset($this->m_talents[0][$talent_id]) || isset($this->m_talents[1][$talent_id])))
			return true;
		else
			return false;
	}

	private function hasGlyph($glyph_id, $active_spec = false)
	{
		$glyphs = $this->c('QueryResult', 'Db')
			->model('CharacterGlyphs')
			->setItemId($this->getGuid())
			->loadItems();

		if (!$glyphs)
			return false;

		foreach ($glyphs as &$glyph)
		{
			if ($this->m_serverType == SERVER_TRINITY)
			{
				for ($i = 1; $i < 7; ++$i)
				{
					if (isset($glyph['glyph' . $i]) && $glyph['glyph' . $i] == $glyph_id)
					{
						if ($active_spec && $glyph['spec'] == $this->getActiveSpec())
							return true;
						elseif (!$active_spec)
							return true;
						else
							return false;
					}
				}
			}
			else
			{
				if ($glyph['glyph'] == $glyph_id)
				{
					if ($active_spec && $glyph['spec'] == $this->getActiveSpec())
						return true;
					elseif (!$active_spec)
						return true;
					else
						return false;
				}
			}
		}

		unset($glyphs);
		return false;
	}
	
	/**
	 * Max energy value calculator. Used for Rogues and DKs only.
	 **/
	private function CalculateMaxEnergy()
	{
		if (!in_array($this->getClass(), array(CLASS_ROGUE, CLASS_DK)))
			return 0;

		$maxPower = 100;
		switch($this->getClass())
		{
			case CLASS_ROGUE:
				// Check for 14983 spell (Vigor) in current talent spec
				$tRank = $this->HasTalent(382, true);

				if ($tRank)
					$maxPower = 110;

				// Also, check for Glyph of Vigor (id 408)
				if ($this->HasGlyph(408, true) >= 0)
					$maxPower = 120;

				break;
			case CLASS_DK:
				// Check for 50147, 49455 spells (Runic power mastery) in current talent spec
				$tRank = $this->HasTalent(2020, true);

				if ($tRank === 0)
					$maxPower = 115; // Runic power mastery (Rank 1)
				elseif ($tRank == 1)
					$maxPower = 130; // Runic power mastery (Rank 2)

				break;
		}

		return $maxPower;
	}
	
	/* Base stats */
	
	private function CalculateBaseStats($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return $this;
		}
		$this->SetRating(); // Load rating definitions for class.
		$this->UpdateStatsInfo('base_stats', false);
		$this->CalculateCharacterStrength($recalculate);
		$this->CalculateCharacterAgility($recalculate);
		$this->CalculateCharacterStamina($recalculate);
		$this->CalculateCharacterIntellect($recalculate);
		$this->CalculateCharacterSpirit($recalculate);
		$this->CalculateCharacterMastery($recalculate);
		$this->UpdateStatsInfo('base_stats', true);
		return $this;
	}
	
	private function CalculateCharacterStrength($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['base_stats']['strength']) && !$recalculate) {
			return true;
		}
		$this->m_stats['base_stats']['strength'] = array(
			'effective' => $this->GetStat(STAT_STRENGTH),
			'attack'	=> $this->c('Wow')->GetAttackPowerForStat(STAT_STRENGTH, $this->GetStat(STAT_STRENGTH), $this->getClass()),
			'base'	  => $this->GetStat(STAT_STRENGTH) - $this->c('Wow')->GetFloatValue($this->GetPosStat(STAT_STRENGTH), 0) - $this->c('Wow')->GetFloatValue($this->GetNegStat(STAT_STRENGTH), 0),
			'block'	 => (in_array($this->getClass(), array(CLASS_WARRIOR, CLASS_PALADIN, CLASS_SHAMAN))) ? max(0, $this->GetStat(STAT_STRENGTH) * BLOCK_PER_STRENGTH - 10) : -1
		);
		return true;
	}
	
	private function CalculateCharacterAgility($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['base_stats']['agility']) && !$recalculate) {
			return true;
		}
		$this->m_stats['base_stats']['agility'] = array(
			'armor'		  => $this->GetStat(STAT_AGILITY) * ARMOR_PER_AGILITY,
			'attack'		 => $this->c('Wow')->GetAttackPowerForStat(STAT_AGILITY, $this->GetStat(STAT_AGILITY), $this->getClass()),
			'base'		   => $this->GetStat(STAT_AGILITY) - $this->c('Wow')->GetFloatValue($this->GetPosStat(STAT_AGILITY), 0) - $this->c('Wow')->GetFloatValue($this->GetNegStat(STAT_AGILITY), 0),
			'hitCritPercent' => floor($this->c('Wow')->GetCritChanceFromAgility($this->rating, $this->getClass(), $this->GetStat(STAT_AGILITY))),
			'effective'	  => $this->GetStat(STAT_AGILITY)
		);
		return true;
	}
	
	private function CalculateCharacterStamina($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['base_stats']['stamina']) && !$recalculate) {
			return true;
		}
		$this->m_stats['base_stats']['stamina'] = array(
			'base'	  => $this->GetStat(STAT_STAMINA) - $this->c('Wow')->GetFloatValue($this->GetPosStat(STAT_STAMINA), 0) - $this->c('Wow')->GetFloatValue($this->GetNegStat(STAT_STAMINA), 0),
			'effective' => $this->GetStat(STAT_STAMINA)
		);
		$this->m_stats['base_stats']['stamina']['health'] = $this->m_stats['base_stats']['stamina']['base'] + (($this->GetStat(STAT_STAMINA) - min(20, $this->GetStat(STAT_STAMINA))) * HEALTH_PER_STAMINA);
		$this->m_stats['base_stats']['stamina']['petBonus'] = $this->c('Wow')->ComputePetBonus(STAT_STAMINA, $this->GetStat(STAT_STAMINA), $this->getClass());
		return true;
	}
	
	private function CalculateCharacterIntellect($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['base_stats']['intellect']) && !$recalculate) {
			return true;
		}
		$base_intellect = min(20, $this->GetStat(STAT_INTELLECT));
		$more_intellect = $this->GetStat(STAT_INTELLECT) - $base_intellect;
		$this->m_stats['base_stats']['intellect'] = array(
			'base'		   => $this->GetStat(STAT_INTELLECT) - $this->c('Wow')->GetFloatValue($this->GetPosStat(STAT_INTELLECT), 0) - $this->c('Wow')->GetFloatValue($this->GetNegStat(STAT_INTELLECT), 0),
			'hitCritPercent' => $this->IsManaUser() ? round($this->c('Wow')->GetSpellCritChanceFromIntellect($this->rating, $this->getClass(), $this->GetStat(STAT_INTELLECT)), 2) : -1,
			'effective'	  => $this->GetStat(STAT_INTELLECT),
			'mana'		   => $this->IsManaUser() ? ($base_intellect + $more_intellect * MANA_PER_INTELLECT) : -1,
			'petBonus'	   => $this->c('Wow')->ComputePetBonus(STAT_INTELLECT, $this->GetStat(STAT_INTELLECT), $this->getClass())
		);
		return true;
	}
	
	private function CalculateCharacterSpirit($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['base_stats']['spirit']) && !$recalculate) {
			return true;
		}
		$baseRatio = array(0, 0.625, 0.2631, 0.2, 0.3571, 0.1923, 0.625, 0.1724, 0.1212, 0.1282, 1, 0.1389);
		$base_spirit = min(50, $this->GetStat(STAT_SPIRIT));
		$more_spirit = $this->GetStat(STAT_SPIRIT) - $base_spirit;
		$healthRegen = floor($base_spirit * $baseRatio[$this->getClass()] + $more_spirit * $this->c('Wow')->GetHRCoefficient($this->rating, $this->getClass()));
		$manaRegen = $this->IsManaUser() ? floor(sqrt($this->GetStat(STAT_INTELLECT) * $this->GetStat(STAT_SPIRIT) * $this->c('Wow')->GetMRCoefficient($this->rating, $this->getClass())) * 5) : -1;
		$this->m_stats['base_stats']['spirit'] = array(
			'base'		=> $this->GetStat(STAT_SPIRIT) - $this->c('Wow')->GetFloatValue($this->GetPosStat(STAT_SPIRIT), 0) - $this->c('Wow')->GetFloatValue($this->GetNegStat(STAT_SPIRIT), 0),
			'effective'   => $this->GetStat(STAT_SPIRIT),
			'healthRegen' => $healthRegen,
			'manaRegen'   => $manaRegen
		);
		return true;
	}
	
	private function CalculateCharacterMastery($recalculate = false) {
		$this->m_stats['base_stats']['mastery'] = array(
			'base'	  => 0,
			'effective' => 0.0,
		);
		return true;
	}
	
	/* Melee stats */
	
	private function CalculateMeleeStats($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return $this;
		}
		$this->SetRating(); // Load rating definitions for class.
		$this->UpdateStatsInfo('melee_stats', false);
		$this->CalculateMeleeDamage($recalculate);
		$this->CalculateMeleeAttackPower($recalculate);
		$this->CalculateMeleeHasteRating($recalculate);
		$this->CalculateMeleeHitRating($recalculate);
		$this->CalculateMeleeCritRating($recalculate);
		$this->CalculateMeleeExpertiseRating($recalculate);
		$this->UpdateStatsInfo('melee_stats', true);
		return $this;
	}
	
	public function GetMeleeStats() {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(!$this->GetStatsInfo('melee_stats')) {
			$this->CalculateMeleeStats(true);
		}
		return $this->m_stats['melee'];
	}
	
	private function CalculateMeleeDamage($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['melee']['damage']) && !$recalculate) {
			return true;
		}
		$min = $this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_MINDAMAGE), 0);
		$max = $this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_MAXDAMAGE), 0);
		$haste = round($this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_BASEATTACKTIME), 2) / 1000, 2);
		if($haste < 0.1) {
			$haste = 0.1;
		}
		$damage = ($min + $max) * 0.5;
		$dps = round((max($damage, 1) / $haste), 1);
		$this->m_stats['melee']['damage'] = array(
			'min' => $min,
			'max' => $max,
			'dps' => $dps,
			'haste' => $haste
		);
		return true;
	}
	
	private function CalculateMeleeAttackPower($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['melee']['attack_power']) && !$recalculate) {
			return true;
		}
		$multipler = $this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_ATTACK_POWER_MULTIPLIER), 8);
		if($multipler < 0) {
			$multipler = 0;
		}
		else {
			$multipler += 1;
		}
		$base = $this->getDataField(UNIT_FIELD_ATTACK_POWER) * $multipler;
		$effective = $base + ($this->getDataField(UNIT_FIELD_ATTACK_POWER_MODS) * $multipler);
		$this->m_stats['melee']['attack_power'] = array(
			'base' => $base,
			'effective' => $effective,
			'increasedDps' => floor(max($effective, 0) / 14)
		);
		return true;
	}
	
	private function CalculateMeleeHasteRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['melee']['haste_rating']) && !$recalculate) {
			return true;
		}
		$this->m_stats['melee']['haste_rating'] = array(
			'value' => round($this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_BASEATTACKTIME), 2) / 1000, 2),
			'hasteRating' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 17),
			'hastePercent' => round($this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 17) / $this->c('Wow')->GetRatingCoefficient($this->rating, 19), 2)
		);
		return true;
	}
	
	private function CalculateMeleeHitRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['melee']['hit_rating']) && !$recalculate) {
			return true;
		}
		$this->m_stats['melee']['hit_rating'] = array(
			'value' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 5),
			'increasedHitPercent' => floor($this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 5) / $this->c('Wow')->GetRatingCoefficient($this->rating, 6))
		);
		return true;
	}
	
	private function CalculateMeleeCritRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['melee']['crit_rating']) && !$recalculate) {
			return true;
		}
		$this->m_stats['melee']['crit_rating'] = array(
			'value' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 8),
			'percent' => $this->c('Wow')->GetFloatValue($this->getDataField(PLAYER_CRIT_PERCENTAGE), 2),
			'plusPercent' => floor($this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 8) / $this->c('Wow')->GetRatingCoefficient($this->rating, 9))
		);
		return true;
	}
	
	private function CalculateMeleeExpertiseRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['melee']['expertise_rating']) && !$recalculate) {
			return true;
		}
		$this->m_stats['melee']['expertise_rating'] = array(
			'value' => $this->getDataField(PLAYER_EXPERTISE),
			'percent' => $this->getDataField(PLAYER_EXPERTISE) * 0.25,
		);
	}
	
	/* Ranged stats */
	
	private function CalculateRangedStats($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return $this;
		}
		$this->SetRating();
		$this->UpdateStatsInfo('ranged_stats', false);
		$this->CalculateRangedCritRating($recalculate);
		$this->CalculateRangedHitRating($recalculate);
		$this->CalculateRangedHasteRating($recalculate);
		$this->CalculateRangedAttackPower($recalculate);
		$this->CalculateRangedDamage($recalculate);
		$this->UpdateStatsInfo('ranged_stats', true);
		return $this;
	}
	
	public function GetRangedStats() {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(!$this->GetStatsInfo('ranged_stats')) {
			$this->CalculateRangedStats(true);
		}
		return $this->m_stats['ranged'];
	}
	
	private function CalculateRangedDamage($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['ranged']['damage']) && !$recalculate) {
			return true;
		}
		$rangedSkillID = $this->c('Wow')->GetSkillIDFromItemID($this->getDataField(PLAYER_VISIBLE_ITEM_18_ENTRYID));
		if($rangedSkillID == SKILL_UNARMED) {
			$this->m_stats['ranged']['damage'] = array(
				'min' => 0,
				'max' => 0,
				'haste' => 0,
				'dps' => 0
			);
			return true;
		}
		$min = $this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_MINRANGEDDAMAGE), 0);
		$max = $this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_MAXRANGEDDAMAGE), 0);
		$haste = round($this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_RANGEDATTACKTIME), 2) / 100, 2);
		$dps = ($min + $max) * 0.5;
		if($haste < 0.1) {
			$haste = 0.1;
		}
		$dps = round((max($dps, 1) / $haste));
		$this->m_stats['ranged']['damage'] = array(
			'min' => $min,
			'max' => $max,
			'haste' => $haste,
			'dps' => $dps
		);
		return true;
	}
	
	private function CalculateRangedAttackPower($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['ranged']['attack_power']) && !$recalculate) {
			return true;
		}
		$multipler = $this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_RANGED_ATTACK_POWER_MULTIPLIER), 8);
		if($multipler < 0) {
			$multipler = 0;
		}
		else {
			$multipler += 1;
		}
		$effective = $this->getDataField(UNIT_FIELD_RANGED_ATTACK_POWER) * $multipler;
		$buff = $this->getDataField(UNIT_FIELD_RANGED_ATTACK_POWER_MODS) * $multipler;
		$multiple = $this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_RANGED_ATTACK_POWER_MULTIPLIER), 2);
		$posBuff = 0;
		$negBuff = 0;
		if($buff > 0) {
			$posBuff = $buff;
		}
		elseif($buff < 0) {
			$negBuff = $buff;
		}
		$stat = $effective + $buff;
		$this->m_stats['ranged']['attack_power'] = array(
			'base' => floor($effective),
			'effective' => floor($stat),
			'increasedDps' => floor(max($stat, 0) / 14),
			'petAttack' => floor($this->c('Wow')->ComputePetBonus(0, $stat, $this->getClass())),
			'petSpell' => floor($this->c('Wow')->ComputePetBonus(1, $stat, $this->getClass()))
		);
		return true;
	}
	
	private function CalculateRangedHasteRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['ranged']['haste_rating']) && !$recalculate) {
			return true;
		}
		$rangedSkillID = $this->c('Wow')->GetSkillIDFromItemID($this->getDataField(PLAYER_VISIBLE_ITEM_18_ENTRYID));
		if($rangedSkillID == SKILL_UNARMED) {
			$this->m_stats['ranged']['haste_rating'] = array(
				'value' => 0,
				'hasteRating' => 0,
				'hastePercent' => 0
			);
			return true;
		}
		$this->m_stats['ranged']['haste_rating'] = array(
			'value' => round($this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_RANGEDATTACKTIME), 2) / 1000, 2),
			'hasteRating' => round($this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 18)),
			'hastePercent' => round((round($this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 18))) / $this->c('Wow')->GetRatingCoefficient($this->rating, 19), 2)
		);
		return true;
	}
	
	private function CalculateRangedHitRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['melee']['hit_rating'])) {
			// Melee hit & ranged hit are equal.
			return true;
		}
		$this->CalculateMeleeHitRating($recalculate);
		return true;
	}
	
	private function CalculateRangedCritRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['melee']['crit_rating'])) {
			// Melee crit & ranged crit are equal.
			return true;
		}
		$this->CalculateMeleeCritRating($recalculate);
		return true;
	}
	
	/* Spell stats */
	
	private function CalculateSpellStats($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return $this;
		}
		$this->SetRating();
		$this->UpdateStatsInfo('spell_stats', false);
		$this->CalculateSpellPower($recalculate);
		$this->CalculateSpellHasteRating($recalculate);
		$this->CalculateSpellHitRating($recalculate);
		$this->CalculateSpellCritRating($recalculate);
		$this->CalculateManaRegeneration($recalculate);
		$this->UpdateStatsInfo('spell_stats', true);
		return $this;
	}
	
	public function GetSpellStats() {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(!$this->GetStatsInfo('spell_stats')) {
			$this->CalculateSpellStats(true);
		}
		return $this->m_stats['spell'];
	}
	
	private function CalculateSpellPower($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['spell']['power']) && !$recalculate) {
			return true;
		}
		$this->m_stats['spell']['power'] = array(
			'value' => $this->getDataField(PLAYER_FIELD_MOD_HEALING_DONE_POS)
		);
		return true;
	}
	
	private function CalculateSpellHasteRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['spell']['haste_rating']) && !$recalculate) {
			return true;
		}
		$this->m_stats['spell']['haste_rating'] = array(
			'hasteRating' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 19),
			'hastePercent' => round(($this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 19)) / $this->c('Wow')->GetRatingCoefficient($this->rating, 20), 2)
		);
		return true;
	}
	
	private function CalculateSpellHitRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['spell']['hit_rating']) && !$recalculate) {
			return true;
		}
		$this->m_stats['spell']['hit_rating'] = array(
			'value' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 7),
			'increasedHitPercent' => floor(($this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 7)) / $this->c('Wow')->GetRatingCoefficient($this->rating, 8)),
			'penetration' => $this->getDataField(PLAYER_FIELD_MOD_TARGET_RESISTANCE)
		);
		return true;
	}
	
	private function CalculateSpellCritRating($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['spell']['crit_rating']) && !$recalculate) {
			return true;
		}
		$this->m_stats['spell']['crit_rating'] = array(
			'rating' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 10),
			'spell_crit_pct' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 10) / $this->c('Wow')->GetRatingCoefficient($this->rating, 11),
			'value' => $this->c('Wow')->GetFloatValue($this->getDataField(PLAYER_SPELL_CRIT_PERCENTAGE1 + 1), 2)
		);
		return true;
	}
	
	private function CalculateManaRegeneration($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['spell']['mana_regen']) && !$recalculate) {
			return true;
		}
		$notCasting = $this->getDataField(UNIT_FIELD_POWER_REGEN_FLAT_MODIFIER);
		$casting = $this->getDataField(UNIT_FIELD_POWER_REGEN_INTERRUPTED_FLAT_MODIFIER);
		$this->m_stats['spell']['mana_regen'] = array(
			'notCasting' => floor($this->c('Wow')->GetFloatValue($notCasting, 2) * 5),
			'casting' => round($this->c('Wow')->GetFloatValue($casting, 2) * 5, 2)
		);
		return true;
	}
	
	/* Defense Stats */
	
	private function CalculateDefenseStats($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return $this;
		}
		$this->SetRating();
		$this->UpdateStatsInfo('defense_stats', false);
		$this->CalculateArmor($recalculate);
		$this->CalculateDodge($recalculate);
		$this->CalculateParry($recalculate);
		$this->CalculateBlock($recalculate);
		$this->CalculateResilience($recalculate);
		$this->UpdateStatsInfo('defense_stats', true);
		return $this;
	}
	
	public function GetDefenseStats() {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(!$this->GetStatsInfo('defense_stats')) {
			$this->CalculateDefenseStats(true);
		}
		return $this->m_stats['defense'];
	}
	
	private function CalculateArmor($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['defense']['armor']) && !$recalculate) {
			return true;
		}
		$effective = $this->getDataField(UNIT_FIELD_RESISTANCES);
		$bonus_armor = $this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_RESISTANCEBUFFMODSPOSITIVE), 0);
		$negative_armor = $this->c('Wow')->GetFloatValue($this->getDataField(UNIT_FIELD_RESISTANCEBUFFMODSNEGATIVE), 0);
		$base = $effective - $bonus_armor - $negative_armor;
		$levelModifier = 0;
		if($this->GetLevel() > 59) {
			$levelModifier = $this->GetLevel() + (4.5 * ($this->GetLevel() - 59));
		}
		$reductionPercent = 0.1 * $effective / (8.5 * $levelModifier + 40);
		$reductionPercent = round($reductionPercent / (1 + $reductionPercent) * 100, 2);
		if($reductionPercent > 75) {
			$reductionPercent = 75;
		}
		if($reductionPercent < 0) {
			$reductionPercent = 0;
		}
		$this->m_stats['defense']['armor'] = array(
			'base' => $base,
			'effective' => $effective,
			'reductionPercent' => $reductionPercent
		);
		return true;
	}
	
	private function CalculateDodge($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['defense']['dodge']) && !$recalculate) {
			return true;
		}
		$this->m_stats['defense']['dodge'] = array(
			'percent' => $this->c('Wow')->GetFloatValue($this->getDataField(PLAYER_DODGE_PERCENTAGE), 2),
			'rating' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 2),
			'increasePercent' => floor($this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 2) / $this->c('Wow')->GetRatingCoefficient($this->rating, 3))
		);
		return true;
	}
	
	private function CalculateParry($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['defense']['parry']) && !$recalculate) {
			return true;
		}
		$this->m_stats['defense']['parry'] = array(
			'percent' => $this->c('Wow')->GetFloatValue($this->getDataField(PLAYER_PARRY_PERCENTAGE), 2),
			'rating' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 3),
			'increasePercent' => floor($this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 3) / $this->c('Wow')->GetRatingCoefficient($this->rating, 4))
		);
	}
	
	private function CalculateBlock($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['defense']['block']) && !$recalculate) {
			return true;
		}
		$this->m_stats['defense']['block'] = array(
			'percent' => $this->c('Wow')->GetFloatValue($this->getDataField(PLAYER_BLOCK_PERCENTAGE), 2),
			'rating' => $this->getDataField(PLAYER_SHIELD_BLOCK),
			'increasePercent' => $this->getDataField(PLAYER_FIELD_COMBAT_RATING_1 + 4)
		);
	}
	
	private function CalculateResilience($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['defense']['resilience']) && !$recalculate) {
			return true;
		}
		$melee = $this->getDataField(PLAYER_FIELD_CRIT_TAKEN_MELEE_RATING);
		$ranged = $this->getDataField(PLAYER_FIELD_CRIT_TAKEN_RANGED_RATING);
		$spell = $this->getDataField(PLAYER_FIELD_CRIT_TAKEN_SPELL_RATING);
		$value = min($melee, $ranged, $spell);
		$damagePercent = $melee / $this->c('Wow')->GetRatingCoefficient($this->rating, 15);
		$hitPercent = $spell / $this->c('Wow')->GetRatingCoefficient($this->rating, 17);
		$this->m_stats['defense']['resilience'] = array(
			'value' => $value,
			'hitPercent' => $hitPercent,
			'damagePercent' => $damagePercent
		);
		return true;
	}
	
	/* Resistance stats */
	
	private function CalculateResistanceStats($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		$this->SetRating();
		$this->UpdateStatsInfo('resistance_stats', false);
		$this->CalculateResistances($recalculate);
		$this->UpdateStatsInfo('resistance_stats', true);
		return true;
	}
	
	public function GetResistanceStats() {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(!$this->GetStatsInfo('resistance_stats')) {
			$this->CalculateResistanceStats(true);
		}
		return $this->m_stats['resistance'];
	}
	
	private function CalculateResistances($recalculate = false) {
		if(!$this->isCorrect()) {
			$this->c('Log')->writeError('%s : character was not found.', __METHOD__);
			return false;
		}
		if(isset($this->m_stats['resistance']['resistance']) && !$recalculate) {
			return true;
		}
		$this->m_stats['resistance']['resistance'] = array(
			'fire' => $this->getDataField(UNIT_FIELD_RESISTANCES + SPELL_SCHOOL_FIRE),
			'nature' => $this->getDataField(UNIT_FIELD_RESISTANCES + SPELL_SCHOOL_NATURE),
			'frost' => $this->getDataField(UNIT_FIELD_RESISTANCES + SPELL_SCHOOL_NATURE),
			'shadow' => $this->getDataField(UNIT_FIELD_RESISTANCES + SPELL_SCHOOL_SHADOW),
			'arcane' => $this->getDataField(UNIT_FIELD_RESISTANCES + SPELL_SCHOOL_ARCANE)
		);
		return true;
	}
	
	public function GetRole()
	{
		if(!$this->m_role)
			$this->setRole();

		return $this->m_role;
	}
	
	public function GetAppropriateStatsForClassAndSpec() {
		$stats_data = array();
		switch($this->GetRole()) {
			case ROLE_TANK:
				$stats_data = array(
					'main' => array(
						array(
							'type' => 'stat_stamina',
							'name' => 'stamina',
							'stat' => $this->m_stats['base_stats']['stamina']['effective']
						),
						array(
							'type' => 'stat_strength',
							'name' => 'strength',
							'stat' => $this->m_stats['base_stats']['strength']['effective']
						),
						array(
							'type' => 'stat_mastery',
							'name' => 'mastery',
							'stat' => $this->m_stats['base_stats']['mastery']['effective']
						)
					),
					'advanced' => array(
						array(
							'type' => 'stat_armor',
							'name' => 'armor',
							'stat' => $this->m_stats['defense']['armor']['effective']
						),
						array(
							'type' => 'stat_dodge',
							'name' => 'dodge',
							'stat' => $this->m_stats['defense']['dodge']['percent'] . '%'
						),
						array(
							'type' => 'stat_parry',
							'name' => 'parry',
							'stat' => $this->m_stats['defense']['parry']['percent'] . '%'
						),
						array(
							'type' => 'stat_block',
							'name' => 'block',
							'stat' => $this->m_stats['defense']['block']['percent'] . '%'
						),
						array(
							'type' => 'stat_expertise',
							'name' => 'expertise',
							'stat' => $this->m_stats['melee']['expertise_rating']['value']
						)
					)
				);
				break;
			case ROLE_CASTER:
				$stats_data = array(
					'main' => array(
						array(
							'type' => 'stat_intellect',
							'name' => 'intellect',
							'stat' => $this->m_stats['base_stats']['intellect']['effective']
						),
						array(
							'type' => 'stat_stamina',
							'name' => 'stamina',
							'stat' => $this->m_stats['base_stats']['stamina']['effective']
						),
						array(
							'type' => 'stat_mastery',
							'name' => 'mastery',
							'stat' => $this->m_stats['base_stats']['mastery']['effective']
						)
					),
					'advanced' => array(
						array(
							'type' => 'stat_spell_power',
							'name' => 'spellpower',
							'stat' => $this->m_stats['spell']['power']['value']
						),
						array(
							'type' => 'stat_spell_haste',
							'name' => 'spellhaste',
							'stat' => $this->m_stats['spell']['haste_rating']['hastePercent'] . '%'
						),
						array(
							'type' => 'stat_hit',
							'name' => 'spellhit',
							'stat' => '+' . $this->m_stats['spell']['hit_rating']['increasedHitPercent'] . '%'
						),
						array(
							'type' => 'stat_crit',
							'name' => 'spellcrit',
							'stat' => $this->m_stats['spell']['crit_rating']['value'] . '%'
						)
					)
				);
				break;
			case ROLE_HEALER:
				$stats_data = array(
					'main' => array(
						array(
							'type' => 'stat_intellect',
							'name' => 'intellect',
							'stat' => $this->m_stats['base_stats']['intellect']['effective']
						),
						array(
							'type' => 'stat_spirit',
							'name' => 'spirit',
							'stat' => $this->m_stats['base_stats']['spirit']['effective']
						),
						array(
							'type' => 'stat_stamina',
							'name' => 'stamina',
							'stat' => $this->m_stats['base_stats']['stamina']['effective']
						),
						array(
							'type' => 'stat_mastery',
							'name' => 'mastery',
							'stat' => $this->m_stats['base_stats']['mastery']['effective']
						)
					),
					'advanced' => array(
						array(
							'type' => 'stat_spell_power',
							'name' => 'spellpower',
							'stat' => $this->m_stats['spell']['power']['value']
						),
						array(
							'type' => 'stat_mana_regen',
							'name' => 'manaregen',
							'stat' => $this->m_stats['spell']['mana_regen']['notCasting']
						),
						array(
							'type' => 'stat_spell_haste',
							'name' => 'spellhaste',
							'stat' => $this->m_stats['spell']['haste_rating']['hastePercent'] . '%'
						),
						array(
							'type' => 'stat_crit',
							'name' => 'spellcrit',
							'stat' => $this->m_stats['spell']['crit_rating']['value'] . '%'
						)
					)
				);
				break;
			case ROLE_MELEE:
				$stats_data = array(
					'main' => array(
						array(
							'type' => !in_array($this->getClass(), array(CLASS_ROGUE, CLASS_SHAMAN, CLASS_DRUID)) ? 'stat_strength' : 'stat_agility',
							'name' => !in_array($this->getClass(), array(CLASS_ROGUE, CLASS_SHAMAN, CLASS_DRUID)) ? 'strength' : 'agility',
							'stat' => !in_array($this->getClass(), array(CLASS_ROGUE, CLASS_SHAMAN, CLASS_DRUID)) ? $this->m_stats['base_stats']['strength']['effective'] : $this->m_stats['base_stats']['agility']['effective']
						),
						array(
							'type' => 'stat_stamina',
							'name' => 'stamina',
							'stat' => $this->m_stats['base_stats']['stamina']['effective']
						),
						array(
							'type' => 'stat_mastery',
							'name' => 'mastery',
							'stat' => $this->m_stats['base_stats']['mastery']['effective']
						)
					),
					'advanced' => array(
						array(
							'type' => 'stat_attack_power',
							'name' => 'meleeattackpower',
							'stat' => $this->m_stats['melee']['attack_power']['effective']
						),
						array(
							'type' => 'stat_expertise',
							'name' => 'expertise',
							'stat' => $this->m_stats['melee']['expertise_rating']['value']
						),
						array(
							'type' => 'stat_haste',
							'name' => 'meleespeed',
							'stat' => $this->m_stats['melee']['haste_rating']['value']
						),
						array(
							'type' => 'stat_hit',
							'name' => 'meleehit',
							'stat' => $this->m_stats['melee']['hit_rating']['increasedHitPercent'] . '%'
						),
						array(
							'type' => 'stat_crit',
							'name' => 'meleecrit',
							'stat' => $this->m_stats['melee']['crit_rating']['percent'] . '%'
						)
					)
				);
				break;
			case ROLE_RANGED:
				$stats_data = array(
					'main' => array(
						array(
							'type' => 'stat_agility',
							'name' => 'agility',
							'stat' => $this->m_stats['base_stats']['agility']['effective']
						),
						array(
							'type' => 'stat_stamina',
							'name' => 'stamina',
							'stat' => $this->m_stats['base_stats']['stamina']['effective']
						),
						array(
							'type' => 'stat_mastery',
							'name' => 'mastery',
							'stat' => $this->m_stats['base_stats']['mastery']['effective']
						)
					),
					'advanced' => array(
						array(
							'type' => 'stat_attack_power',
							'name' => 'rangedattackpower',
							'stat' => $this->m_stats['ranged']['attack_power']['effective']
						),
						array(
							'type' => 'stat_haste',
							'name' => 'rangedspeed',
							'stat' => $this->m_stats['ranged']['haste_rating']['value']
						),
						array(
							'type' => 'stat_hit',
							'name' => 'rangedhit',
							'stat' => $this->m_stats['melee']['hit_rating']['increasedHitPercent'] . '%'
						),
						array(
							'type' => 'stat_crit',
							'name' => 'rangedcrit',
							'stat' => $this->m_stats['melee']['crit_rating']['percent'] . '%'
						)
					)
				);
				break;
		}
		return $stats_data;
	}

	protected function handleRaidProgress()
	{
		if (!$this->m_achProgress)
			return $this;

		//dump($this->m_achProgress);

		return $this;
	}

	protected function performAudit()
	{
		if ($this->getProfileType() != 'advanced')
			return $this;

		$empty_glyphs = 6;
		
		$glyphs = $this->c('QueryResult', 'Db')
			->model('CharacterGlyphs')
			->fieldCondition('guid', ' = ' . $this->getGuid())
			->fieldCondition('spec', ' = ' . $this->getField('activeSpec'))
			->loadItems();

		if ($glyphs)
		{
			if ($this->m_serverType == SERVER_MANGOS)
			{
				foreach ($glyphs as &$glyph)
					if ($glyph['slot'] < 6 && $glyph['slot'] >= 0)
						--$empty_glyphs;
			}
			elseif ($this->m_serverType == SERVER_TRINITY)
			{
				foreach ($glyphs as &$glyph)
				{
					for ($i = 1; $i < 7; ++$i)
						if ($glyph['glyph' . $i] > 0)
							--$empty_glyphs;
				}
			}
		}

		unset($glyphs);

		$this->updateAudit(AUDIT_TYPE_EMPTY_GLYPH_SLOT, $empty_glyphs)
			->updateAudit(AUDIT_TYPE_UNSPENT_TALENT_POINTS, $this->getFreeTalentPoints());

		if ($this->m_inventory)
		{
			foreach ($this->m_inventory as &$item)
			{
				if (!$item)
					continue;

				$this->updateAudit(AUDIT_TYPE_STAT_BONUS, $this->findItemBonuses($item));
				if (!in_array($item['slot'], array(INV_MAIN_HAND, INV_OFF_HAND, INV_BELT, INV_SHIRT, INV_RANGED_RELIC, INV_TABARD, INV_TRINKET_1, INV_TRINKET_2, INV_NECK, INV_OFF_HAND, INV_RING_1, INV_RING_2, INV_NECK)) && !$this->isOptimalArmorForClass($item))
					$this->updateAudit(AUDIT_TYPE_NONOPTIMAL_ARMOR, array($item['slot'], $item['entry']));

				if ((!isset($item['enchant']) || !isset($item['enchant']['id']) || $item['enchant']['id'] == 0) && !in_array($item['slot'], array(INV_BELT, INV_SHIRT, INV_RANGED_RELIC, INV_TABARD, INV_TRINKET_1, INV_TRINKET_2, INV_NECK, INV_OFF_HAND, INV_RING_1, INV_RING_2, INV_NECK)))
					$this->updateAudit(AUDIT_TYPE_UNENCHANTED_ITEM, array($item['slot'], $item['entry']));

				if ($item['slot'] == INV_BELT && $item['data_field'][ITEM_FIELD_ENCHANTMENT_7_1] == 0)
				{
					$q = $this->c('QueryResult', 'Db')->model('ItemTemplate');

					if ($this->c('Locale')->GetLocaleID() != LOCALE_EN)
						$q->addModel('LocalesItem')->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry')->fields(array('ItemTemplate' => array('entry', 'name'), 'LocalesItem' => array('name_loc' . $this->c('Locale')->GetLocaleID())));
					else
						$q->fields(array('ItemTemplate' => array('entry', 'name')));

					$buckle = $q->fieldCondition('item_template.entry', ' = ' . BELT_BUCKLE_ID)->loadItem();
					$this->updateAudit(AUDIT_TYPE_MISSING_BELT_BUCKLE, $buckle['name']);
				}

				$sockets_count = 0;
				if (isset($item['gems']))
					$sockets_count = sizeof($item['gems']);

				if (isset($item['data_field'][ITEM_FIELD_ENCHANTMENT_7_1]) && $item['data_field'][ITEM_FIELD_ENCHANTMENT_7_1] > 0)
					++$sockets_count;

				for ($i = 1; $i < 4; ++$i)
				{
					if (!isset($item['gems'][$i-1]))
					{
						if ($i <= $sockets_count)
							$this->updateAudit(AUDIT_TYPE_EMPTY_SOCKET, array($item['entry'], $item['slot']));
					}
					else
						$this->updateAudit(AUDIT_TYPE_USED_GEMS, $item['gems'][$i-1]);
				}
			}
		}
		return $this;
	}

	public function getAudit()
	{
		return $this->m_auditInfo;
	}

	public function isAuditPassed()
	{
		$passed = true;

		if ($this->m_auditInfo[AUDIT_TYPE_EMPTY_GLYPH_SLOT] > 0)
			$passed = false;

		if ($this->m_auditInfo[AUDIT_TYPE_UNSPENT_TALENT_POINTS] > 0)
			$passed = false;

		if (isset($this->m_auditInfo[AUDIT_TYPE_MISSING_BELT_BUCKLE]))
			$passed = false;

		if (isset($this->m_auditInfo[AUDIT_TYPE_UNUSED_PROFESSION_PERK], $this->m_auditInfo[AUDIT_TYPE_UNUSED_PROFESSION_PERK][0]))
			$passed = false;

		if (isset($this->m_auditInfo[AUDIT_TYPE_NONOPTIMAL_ARMOR], $this->m_auditInfo[AUDIT_TYPE_NONOPTIMAL_ARMOR][0]))
			$passed = false;

		if (isset($this->m_auditInfo[AUDIT_TYPE_UNENCHANTED_ITEM], $this->m_auditInfo[AUDIT_TYPE_UNENCHANTED_ITEM][0]))
			$passed = false;

		if (isset($this->m_auditInfo[AUDIT_TYPE_EMPTY_SOCKET], $this->m_auditInfo[AUDIT_TYPE_EMPTY_SOCKET][0]))
			$passed = false;

		return $passed;
	}

	protected function isOptimalArmorForClass(&$item)
	{
		if (!$item)
			return false;

		if (!in_array($item['class'], array(ITEM_CLASS_ARMOR)))
			return false;

		if (in_array($item['InventoryType'], array(INVTYPE_CLOAK, INVTYPE_BODY, INVTYPE_RELIC, INVTYPE_TABARD)))
			return true; // Skip

		switch($item['subclass'])
		{
			case ITEM_SUBCLASS_ARMOR_CLOTH:
				return in_array($this->getClass(), array(CLASS_PRIEST, CLASS_MAGE, CLASS_WARLOCK));
			case ITEM_SUBCLASS_ARMOR_LEATHER:
				return in_array($this->getClass(), array(CLASS_ROGUE, CLASS_DRUID));
			case ITEM_SUBCLASS_ARMOR_MAIL:
				return in_array($this->getClass(), array(CLASS_HUNTER, CLASS_SHAMAN));
			case ITEM_SUBCLASS_ARMOR_PLATE:
				return in_array($this->getClass(), array(CLASS_WARRIOR, CLASS_PALADIN, CLASS_DK));
			default:
				return false;
		}

		return false;
	}

	protected function findItemBonuses(&$item)
	{
		if (!$item)
			return false;

		$bonuses_info = array();
		$allowed_ench_types = array(
			ITEM_MOD_MANA,
			ITEM_MOD_HEALTH,
			ITEM_MOD_AGILITY,
			ITEM_MOD_STRENGTH,
			ITEM_MOD_INTELLECT,
			ITEM_MOD_SPIRIT,
			ITEM_MOD_STAMINA,
			ITEM_MOD_DEFENSE_SKILL_RATING,
			ITEM_MOD_DODGE_RATING,
			ITEM_MOD_PARRY_RATING,
			ITEM_MOD_BLOCK_RATING,
			ITEM_MOD_HIT_MELEE_RATING,
			ITEM_MOD_HIT_RANGED_RATING,
			ITEM_MOD_HIT_SPELL_RATING,
			ITEM_MOD_CRIT_MELEE_RATING,
			ITEM_MOD_CRIT_RANGED_RATING,
			ITEM_MOD_CRIT_SPELL_RATING,
			ITEM_MOD_HIT_TAKEN_MELEE_RATING,
			ITEM_MOD_HIT_TAKEN_RANGED_RATING,
			ITEM_MOD_HIT_TAKEN_SPELL_RATING,
			ITEM_MOD_CRIT_TAKEN_MELEE_RATING,
			ITEM_MOD_CRIT_TAKEN_RANGED_RATING,
			ITEM_MOD_CRIT_TAKEN_SPELL_RATING,
			ITEM_MOD_HASTE_MELEE_RATING,
			ITEM_MOD_HASTE_RANGED_RATING,
			ITEM_MOD_HASTE_SPELL_RATING,
			ITEM_MOD_HIT_RATING,
			ITEM_MOD_CRIT_RATING,
			ITEM_MOD_HIT_TAKEN_RATING,
			ITEM_MOD_CRIT_TAKEN_RATING,
			ITEM_MOD_RESILIENCE_RATING,
			ITEM_MOD_HASTE_RATING,
			ITEM_MOD_EXPERTISE_RATING,
			ITEM_MOD_ATTACK_POWER,
			ITEM_MOD_RANGED_ATTACK_POWER,
			ITEM_MOD_FERAL_ATTACK_POWER,
			ITEM_MOD_SPELL_HEALING_DONE,
			ITEM_MOD_SPELL_DAMAGE_DONE,
			ITEM_MOD_MANA_REGENERATION,
			ITEM_MOD_ARMOR_PENETRATION_RATING,
			ITEM_MOD_SPELL_POWER,
			ITEM_MOD_HEALTH_REGEN,
			ITEM_MOD_SPELL_PENETRATION,
			ITEM_MOD_BLOCK_VALUE
		);

		if (isset($item['gems']) && isset($item['enchant']))
			$enchants_data = array_merge($item['gems'], array($item['enchant']));
		elseif (isset($item['gems']))
			$enchants_data = $item['gems'];
		elseif (isset($item['enchant']))
			$enchants_data = array($item['enchant']);
		else
			return false;

		if (!$enchants_data)
			return false;

		foreach($enchants_data as $ench_info)
		{
			for ($i = 1; $i < 4; ++$i)
			{
				if ($ench_info['type_' . $i] == 0)
					continue;

				$type = $ench_info['type_' . $i];
				switch($type)
				{
					case ITEM_ENCHANTMENT_TYPE_STAT: // 5
						if (!in_array($ench_info['spellid_' . $i], $allowed_ench_types))
							continue;

						if ($ench_info['amount_' . $i] == 0)
							continue;

						if (!isset($bonuses_info[$ench_info['spellid_' . $i]]))
							$bonuses_info[$ench_info['spellid_' . $i]] = 0;

						$bonuses_info[$ench_info['spellid_' . $i]] += $ench_info['amount_' . $i];
						break;
					case ITEM_ENCHANTMENT_TYPE_EQUIP_SPELL: // 3
						$spell_data = isset($ench_info['ench_spellid_' . $i]) ? $ench_info['ench_spellid_' . $i] : null;

						if(!$spell_data)
							continue;

						if ($spell_data['Effect_1'] != 6/*SPELL_EFFECT_APPLY_AURA*/)
							continue; // SPELL_EFFECT_APPLY_AURA only ATM

						if ($spell_data['EffectApplyAuraName_1'] != 29/*SPELL_AURA_MOD_STAT*/)
							continue; // SPELL_AURA_MOD_STAT only ATM (Do we need some more? I hope no...)

						if ($spell_data['EffectDieSides_1'] == 0 && $spell_data['EffectBasePoints_1'] == 0)
							continue;

						$val = $spell_data['EffectDieSides_1'] + $spell_data['EffectBasePoints_1'];

						if ($val <= 0)
							continue; // But can we have negative value?

						$stat_type = $spell_data['EffectMiscValue_1'];
						switch($stat_type)
						{
							case -1:
								// All stats
								$stats_array = array(
									ITEM_MOD_STRENGTH,
									ITEM_MOD_AGILITY,
									ITEM_MOD_STAMINA,
									ITEM_MOD_INTELLECT,
									ITEM_MOD_SPIRIT
								);
								foreach ($stats_array as $s_mod)
								{
									if (!isset($bonuses_info[$s_mod]))
										$bonuses_info[$s_mod] = $val;
									else
										$bonuses_info[$s_mod] += $val;
								}
								break;
							case STAT_STRENGTH:
								if (!isset($bonuses_info[ITEM_MOD_STRENGTH]))
									$bonuses_info[ITEM_MOD_STRENGTH] = $val;
								else
									$bonuses_info[ITEM_MOD_STRENGTH] += $val;
								break;
							case STAT_AGILITY:
								if (!isset($bonuses_info[ITEM_MOD_AGILITY]))
									$bonuses_info[ITEM_MOD_AGILITY] = $val;
								else
									$bonuses_info[ITEM_MOD_AGILITY] += $val;
								break;
							case STAT_STAMINA:
								if (!isset($bonuses_info[ITEM_MOD_STAMINA]))
									$bonuses_info[ITEM_MOD_STAMINA] = $val;
								else
									$bonuses_info[ITEM_MOD_STAMINA] += $val;
								break;
							case STAT_INTELLECT:
								if (!isset($bonuses_info[ITEM_MOD_INTELLECT]))
									$bonuses_info[ITEM_MOD_INTELLECT] = $val;
								else
									$bonuses_info[ITEM_MOD_INTELLECT] += $val;
								break;
							case STAT_SPIRIT:
								if (!isset($bonuses_info[ITEM_MOD_SPIRIT])) 
									$bonuses_info[ITEM_MOD_SPIRIT] = $val;
								else
									$bonuses_info[ITEM_MOD_SPIRIT] += $val;
								break;
							default:
								continue;
						}
						break;
				}
			}
		}
		return $bonuses_info;
	}

	protected function getFreeTalentPoints()
	{
		$talents = $this->getField('talentPoints');
		if (!$talents)
			return MAX_TALENT_POINTS;

		$active_spec = $this->getField('activeSpec');
		if (!isset($talents[$active_spec]))
			return MAX_TALENT_POINTS;

		$spent_points = 0;
		$trees = array('One', 'Two', 'Three');
		foreach ($trees as $tree)
			$spent_points += $talents[$active_spec]['tree' . $tree];

		return $this->getTalentPointsForLevel() - $spent_points;
	}

	protected function getTalentPointsForLevel()
	{
		$base_level = $this->getClass() == CLASS_DK ? 55 : 9;
		if ($base_level == 55 && $this->getLevel() >= 60)
			$base_level = 9; // DK's quest chain talent points rewards

		$base_talent = $this->getLevel() <= $base_level ? 0 : $this->getLevel() - $base_level;
		return $base_talent <= MAX_TALENT_POINTS ? $base_talent : MAX_TALENT_POINTS;
	}

	protected function updateAudit($type, $value)
	{
		if ($type <= AUDIT_TYPE_NONE || $type >= MAX_AUDIT_TYPE)
			return $this;

		if (!isset($this->m_auditInfo[$type]))
			$this->m_auditInfo[$type] = array();

		switch ($type)
		{
			case AUDIT_TYPE_EMPTY_GLYPH_SLOT:
			case AUDIT_TYPE_UNSPENT_TALENT_POINTS:
			case AUDIT_TYPE_MISSING_BELT_BUCKLE:
				$this->m_auditInfo[$type] = $value;
				break;
			case AUDIT_TYPE_UNUSED_PROFESSION_PERK:
			case AUDIT_TYPE_NONOPTIMAL_ARMOR:
			case AUDIT_TYPE_UNENCHANTED_ITEM:
				$this->m_auditInfo[$type][] = $value;
				break;
			case AUDIT_TYPE_EMPTY_SOCKET:
				if (!isset($this->m_auditInfo[$type][$value[0]]))
					$this->m_auditInfo[$type][$value[0]] = array(
						'count' => 0,
						'slot' => $value[1]
					);

				++$this->m_auditInfo[$type][$value[0]]['count'];
				break;
			case AUDIT_TYPE_STAT_BONUS:
				if (!$value || !is_array($value))
					return $this;

				foreach ($value as $ench_type => $ench_val)
				{
					if (!isset($this->m_auditInfo[$type][$ench_type]))
						$this->m_auditInfo[$type][$ench_type] = 0;

					$this->m_auditInfo[$type][$ench_type] += $ench_val;
				}
				break;
			case AUDIT_TYPE_USED_GEMS:
				if (!isset($this->m_auditInfo[$type][$value['id']]))
				{
					$this->m_auditInfo[$type][$value['id']] = array();
					$value['counter'] = 0;
					$this->m_auditInfo[$type][$value['id']] = $value;
				}
				// Fatal error: Cannot use assign-op operators with overloaded objects nor string offsets
				$this->m_auditInfo[$type][$value['id']]['counter'] = $this->m_auditInfo[$type][$value['id']]['counter'] + 1;

				$matches = array();
				if(preg_match_all('/\+(.+?) /i', $this->m_auditInfo[$type][$value['id']]['text'], $matches))
				{
					$count = sizeof($matches[1]);
					for($i = 0; $i < $count; ++$i)
					{
						if($matches[1][$i] > 0)
						{
							$this->m_auditInfo[$type][$value['id']]['default_values_' . $i] = trim($matches[0][$i]);
							$this->m_auditInfo[$type][$value['id']]['overall_bonus_' . $i] = $matches[1][$i] * $this->m_auditInfo[$type][$value['id']]['counter'];
						}
					}
				}
				break;
		}

		return $this;
	}

	protected function loadMounts($type)
	{
		
		$q = $this->c('QueryResult', 'Db')
			->model('WowMounts');

		if ($type == 'mount')
			$q->fieldCondition('type', ' = 1');
		elseif ($type == 'companion')
			$q->fieldCondition('type', ' = 2');
		else
		{
			$this->c('Log')->writeError('%s : unknown action: %s', __METHO__, $type);
			return $this;
		}

		$this->m_mounts = $q->order(array('WowMounts' => array('quality', 'name_' . $this->c('Locale')->GetLocale())), 'DESC')->loadItems();

		if (!$this->m_mounts)
			return $this;

		$this->m_mountsCount = array('collected' => 0, 'not_collected' => 0);

		foreach ($this->m_mounts as &$mount)
		{
			switch($mount['sourceType'])
			{
				case SOURCE_TYPE_QUEST:
					$type = 'quest';
					break;
				case SOURCE_TYPE_DROP:
					$type = 'drop';
					break;
				case SOURCE_TYPE_PROFESSION:
					$type = 'prof';
					break;
				case SOURCE_TYPE_ACHIEVEMENT:
					$type = 'achv';
					break;
				case SOURCE_TYPE_FACTION:
					$type = 'faction';
					break;
				case SOURCE_TYPE_EVENT:
					$type = 'event';
					break;
				case SOURCE_TYPE_PROMOTION:
					$type = 'promo';
					break;
				case SOURCE_TYPE_PET_STORE:
					$type = 'store';
					break;
				case SOURCE_TYPE_CARD_GAME:
					$type = 'tgc';
					break;
				case SOURCE_TYPE_TRAINER:
				case SOURCE_TYPE_OTHER:
					$type = 'other';
					break;
				case SOURCE_TYPE_VENDOR:
					$type = 'vendor';
					break;
			}

			if ($type == -1)
				continue;

			$mount['source_type'] = $type;
			$mount['add_style'] = $type;

			if ($mount['type'] == 1)
			{
				if ($mount['mount_type'] == 1)
					$mount['add_style'] .= ' ground';
				elseif ($mount['mount_type'] == 2)
					$mount['add_style'] .= ' flying';
				elseif ($mount['mount_type'] == 3)
					$mount['add_style'] .= ' aquatic';
			}

			if (in_array($mount['spell'], $this->m_spells))
			{
				++$this->m_mountsCount['collected'];
				$mount['add_style'] .= ' collected';
			}
			else
			{
				++$this->m_mountsCount['not_collected'];
				$mount['add_style'] .= ' not-collected';
			}
		}

		return $this;
	}

	public function getMounts()
	{
		return array('counters' => $this->m_mountsCount, 'mounts' => $this->m_mounts);
	}

	protected function loadReputation()
	{
		$reputation = $this->c('QueryResult', 'Db')
			->model('CharacterReputation')
			->setItemId($this->getGuid())
			->fieldCondition('flags', ' & ' . FACTION_FLAG_VISIBLE)
			->keyIndex('faction')
			->loadItems();

		$this->m_factions = $this->c('QueryResult', 'Db')
			->model('WowFaction')
			->keyIndex('id')
			->loadItems();

		if (!$this->m_factions)
			return $this;

		// Default categories
        $categories = array(
            // World of Warcraft (Classic)
            1118 => array(
                // Horde
                67 => array(
                    'order' => 1,
                    'side'  => FACTION_HORDE
                ),
                // Horde Forces
                892 => array(
                    'order' => 2,
                    'side'  => FACTION_HORDE
                ),
                // Alliance
                469 => array(
                    'order' => 1,
                    'side'  => FACTION_ALLIANCE
                ),
                // Alliance Forces
                891 => array(
                    'order' => 2,
                    'side'  => FACTION_ALLIANCE
                ),
                // Steamwheedle Cartel
                169 => array(
                    'order' => 3,
                    'side'  => -1
                )
            ),
            // The Burning Crusade
            980 => array(
                // Shattrath
                936 => array(
                    'order' => 1,
                    'side'  => -1
                )
            ),
            // Wrath of the Lich King
            1097 => array(
                // Sholazar Basin
                1117 => array(
                    'order' => 1,
                    'side'  => -1
                ),
                // Horde Expedition
                1052 => array(
                    'order' => 2,
                    'side'  => FACTION_HORDE
                ),
                // Alliance Vanguard
                1037 => array(
                    'order' => 2,
                    'side'  => FACTION_ALLIANCE
                ),
            ),
            // Other
            0 => array(
                // Wintersaber trainers
                589 => array(
                    'order' => 1,
                    'side'  => FACTION_ALLIANCE
                ),
                // Syndicat
                70 => array(
                    'order' => 2,
                    'side'  => -1
                )
            )
        );

		$storage = array();
		foreach ($this->m_factions as $faction)
		{
			if (!isset($reputation[$faction['id']]))
				continue;

			// Standing & adjusted values
			$standing = min(42999, $reputation[$faction['id']]['standing']);
			$type = REP_EXALTED;
			$rep_cap = 999;
			$rep_adjusted = $standing - 42000;
			if ($standing < REPUTATION_VALUE_HATED)
			{
				$type = REP_HATED;
				$rep_cap = 36000;
				$rep_adjusted = $standing + 42000;
			}
			elseif ($standing < REPUTATION_VALUE_HOSTILE)
			{
				$type = REP_HOSTILE;
				$rep_cap = 3000;
				$rep_adjusted = $standing + 6000;
			}
			elseif ($standing < REPUTATION_VALUE_UNFRIENDLY)
			{
				$type = REP_UNFRIENDLY;
				$rep_cap = 3000;
				$rep_adjusted = $standing + 3000;
			}
			elseif ($standing < REPUTATION_VALUE_NEUTRAL)
			{
				$type = REP_NEUTRAL;
				$rep_cap = 3000;
				$rep_adjusted = $standing;
			}
			elseif ($standing < REPUTATION_VALUE_FRIENDLY)
			{
				$type = REP_FRIENDLY;
				$rep_cap = 6000;
				$rep_adjusted = $standing - 3000;
			}
			elseif ($standing < REPUTATION_VALUE_HONORED)
			{
				$type = REP_HONORED;
				$rep_cap = 12000;
				$rep_adjusted = $standing - 9000;
			}
			elseif ($standing < REPUTATION_VALUE_REVERED)
			{
				$type = REP_REVERED;
				$rep_cap = 21000;
				$rep_adjusted = $standing - 21000;
			}
			$faction['standing'] = $reputation[$faction['id']]['standing'];
			$faction['type'] = $type;
			$faction['cap'] = $rep_cap;
			$faction['adjusted'] = $rep_adjusted;
			$faction['percent'] = $this->c('Wow')->GetPercent($rep_cap, $rep_adjusted);
			if (isset($categories[$faction['category']]))
			{
				if (!isset($storage[$faction['category']]))
					$storage[$faction['category']] = array();

				$storage[$faction['category']][] = $faction;
			}
			else
			{
				foreach ($categories as $catId => $subcat)
				{
					if (isset($categories[$catId][$faction['category']]))
					{
						if (!isset($categories[$catId][$faction['category']]))
							$categories[$catId][$faction['category']] = array();

						$storage[$catId][$faction['category']][] = $faction;
					}
				}
			}
		}

		$this->m_reputation = $storage;

		unset($reputation, $faction, $factions, $standing, $storage, $categories);

		return $this;
	}

	public function getReputation()
	{
		return $this->m_reputation;
	}

	public function getReputationFactionName($id)
	{
		return isset($this->m_factions[$id]) ? $this->m_factions[$id]['name'] : '';
	}

	protected function loadPvp()
	{
		$this->m_pvpInfo = $this->c('QueryResult', 'Db')
			->model('ArenaTeamMember')
			->addModel('ArenaTeam')
			->join('left', 'ArenaTeam', 'ArenaTeamMember', 'arenaTeamId', 'arenaTeamId')
			->fieldCondition('arena_team_member.guid', ' = ' . $this->getGuid())
			->keyIndex('arenaTeamId')
			->setAlias('ArenaTeamMember', 'weekGames', 'charWeekGames')
			->setAlias('ArenaTeamMember', 'weekWins', 'charWeekWins')
			->setAlias('ArenaTeamMember', 'seasonGames', 'charSeasonGames')
			->setAlias('ArenaTeamMember', 'seasonWins', 'charSeasonWins')
			->loadItems();

		if (!$this->m_pvpInfo)
			return $this;

		$teamIds = array_keys($this->m_pvpInfo);

		// Load members
		$members = $this->c('QueryResult', 'Db')
			->model('ArenaTeamMember')
			->addModel('Characters')
			->join('left', 'Characters', 'ArenaTeamMember', 'guid', 'guid')
			->fieldCondition('arena_team_member.arenaTeamId', $teamIds)
			->fields(array(
				'ArenaTeamMember' => array('arenaTeamId', 'weekGames', 'weekWins', 'seasonGames', 'seasonWins', 'personalRating'),
				'Characters' => array('guid', 'name', 'class', 'race', 'level', 'gender')
			))
			->loadItems();

		if (!$members)
			return $this; // No members - no profits

		$maxRating = array('rating' => 0, 'type' => 0);
		foreach ($this->m_pvpInfo as $team)
		{
			$team['members'] = array();
			foreach ($members as &$m)
				if ($m['arenaTeamId'] == $team['arenaTeamId'])
					$team['members'][] = $m;

			$this->m_arenaTeams[$team['type']] = $team;

			if ($team['personalRating'] > $maxRating['rating'])
				$maxRating = array('rating' => $team['personalRating'], 'type' => $team['type']);
		}

		$this->m_arenaTeams = array(
			'maxRating' => $maxRating,
			'teams' => $this->m_arenaTeams
		);

		unset($teamIds, $members, $maxRating);

		return $this;
	}

	public function getTeams()
	{
		return $this->m_arenaTeams;
	}
}
?>