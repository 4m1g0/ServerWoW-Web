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

class Guild_Component extends Component
{
	protected $m_guild = array();
	protected $m_members = array();
	protected $m_activity = array();

	const MEMBERS_PER_PAGE = 100;
	protected $m_serverType = -1;
	protected $m_guildMembersCount = 0;
	protected $m_leader = array();
	protected $m_action = 'guild_summary';
	protected $m_guildCharacter = '';
	protected $m_roster = array(); // Sorted roster
	protected $m_guildRanks = array();
	protected $m_subAction = '';
	protected $m_professions = array();

	public function initGuild($guildName, $guildRealm)
	{
		return $this
			->loadGuild($guildName, $guildRealm)
			->handleGuild();
	}

	public function isGuild()
	{
		return $this->m_guild ? true : false;
	}

	protected function triggerGuildError()
	{
		$this->c('Guild_WoW', 'Controller')
			->setErrorPage()
			->c('Error_WoW', 'Controller');

		return $this;
	}

	public function setGuildAction($action)
	{
		$this->m_action = $action;

		return $this;
	}

	public function setGuildSubAction($subAction)
	{
		$this->m_subAction = $subAction;

		return $this;
	}

	public function initGuildAction($guildName, $guildRealm, $action, $subAction = '')
	{	
		return $this
			->setGuildAction($action)
			->setGuildSubAction($subAction)
			->loadGuild($guildName, $guildRealm)
			->handleAction();
	}

	public function getGuildPage()
	{
		return $this->m_action;
	}

	public function getSubAction()
	{
		return $this->m_subAction;
	}

	public function getProfileMenuItems()
	{
		return array(
			array(
				'link' => '',
				'index' => 'template_guild_menu_summary',
				'page' => 'guild_summary',
			),
			array(
				'link' => 'roster',
				'index' => 'template_guild_menu_roster',
				'page' => 'guild_roster',
			),
			array(
				'link' => 'news',
				'index' => 'template_guild_menu_news',
				'page' => 'guild_news',
			),/*
			array(
				'link' => 'events',
				'index' => 'template_guild_menu_events',
				'locked' => !$this->isActiveCharacterIsInGuild(),
				'page' => 'guild_events',
				'extraClass' => 'vault',
			),
			array(
				'link' => 'achievement',
				'index' => 'template_guild_menu_achievements',
				'page' => 'guild_achievement',
				'extraClass' => 'has-submenu',
			),
			array(
				'link' => 'perk',
				'index' => 'template_guild_menu_perks',
				'page' => 'guild_perk',
			),
			array(
				'link' => 'rewards',
				'index' => 'template_guild_menu_rewards',
				'page' => 'guild_rewards',
				'locked' => !$this->isActiveCharacterIsInGuild(),
				'extraClass' => 'vault',
			)*/
		);
	}

	private function prepareGuild($realm)
	{
		if (!$this->c('Wow')->setActiveRealm($realm))
		{
			$this->triggerGuildError();
			return false;
		}

		$this->m_serverType = constant($this->c('Wow')->getActiveRealmType());

		return true;
	}

	protected function loadGuild($name, $realm)
	{
		if (!$this->prepareGuild($realm))
			return $this;

		// Guild info
		$this->m_guild = $this->c('QueryResult', 'Db')
			->model('Guild')
			->fieldCondition('name', ' = \'' . addslashes($name) . '\'')
			->loadItem();

		if (!$this->guild('guildid'))
			return $this;

		// Set some fields
		$this->setField('realmName', $realm)
			->setField('realmId', $this->c('Wow')->getRealmIdByName($realm));

		// Load members
		$this->loadMembers();

		// Find all ranks
		foreach ($this->m_members as &$m)
			if (!in_array($m['rank'], $this->m_guildRanks))
				$this->m_guildRanks[] = $m['rank'];

		sort($this->m_guildRanks);

		if (!$this->getGuildPage() || $this->getGuildPage() == 'guild_news')
			$this->loadActivity()->handleActivity(); // Activity

		return $this;
	}

	protected function loadMembers()
	{
		$this->m_members = $this->c('QueryResult', 'Db') // Guild members
			->model('GuildMember')
			->addModel('Characters')
			->join('left', 'Characters', 'GuildMember', 'guid', 'guid')
			->fieldCondition('guild_member.guildid', ' = ' . $this->guild('guildid'))
			->keyIndex('guid')
			->loadItems();

		$this->m_guildMembersCount = sizeof($this->m_members);

		return $this;
	}

	protected function loadActivity($full = false)
	{
		// 25, 50
		if (!$this->isGuild())
			return $this;

		$this->m_activity = $this->c('QueryResult', 'Db')
			->model('CharacterFeedLog')
			->fieldCondition('guid', $this->getGuids())
			->fieldCondition('type', array(TYPE_ITEM_FEED, TYPE_ACHIEVEMENT_FEED))
			->loadItems();

		return $this;
	}

	protected function handleActivity()
	{
		if (!$this->m_activity)
			return $this;

		$items = array();
		$achievements = array();

		// Get ids
		foreach ($this->m_activity as $act)
		{
			switch ($act['type'])
			{
				case TYPE_ACHIEVEMENT_FEED:
					$achievements[] = $act['data'];
					break;
				case TYPE_ITEM_FEED:
					$items[] = $act['data'];
					break;
			}
		}

		if ($items)
			$items = $this->c('Item')->getItemsInfo($items, true);

		if ($achievements)
			$achievements = $this->c('Achievement')->getAchievementsInfo($achievements, true);

		// Handle feeds
		foreach ($this->m_activity as &$feed)
		{
			$feed['display'] = true;
			switch ($feed['type'])
			{
				case TYPE_ITEM_FEED:
					if (!isset($items[$feed['data']]))
					{
						$feed['display'] = false;
						continue;
					}

					$feed['itemData'] = $items[$feed['data']];
					break;
				case TYPE_ACHIEVEMENT_FEED:
					if (!isset($achievements[$feed['data']]))
					{
						$feed['display'] = false;
						continue;
					}

					$feed['achData'] = $achievements[$feed['data']];
					break;
				default:
					$feed['display'] = false;
					break;
			}

			if ($feed['display'])
				$feed['char'] = $this->findMemberByGuid($feed['guid']);
		}

		return $this;
	}

	protected function getGuids()
	{
		if (isset($this->m_guild['guids']))
			return $this->m_guild['guids'];

		$this->m_guild['guids'] = array_keys($this->m_members);

		return $this->m_guild['guids'];
	}

	protected function handleGuild()
	{
		if (!$this->isGuild())
			return $this;

		// Find guild leader
		$this->findLeader();

		if (!$this->m_guild)
			return $this->triggerGuildError();

		$this->setField('faction', $this->c('Wow')->getFactionID($this->leader('race')));
		$this->calculateGuildLevel();

		return $this;
	}

	protected function handleAction()
	{
		$this->handleGuild();

		switch ($this->m_action)
		{
			case 'guild_roster':
				if ($this->getSubAction() == 'professions')
					$this->prepareProfessionsRoster();
				else
					$this->prepareRoster();
				break;
		}
	}

	protected function calculateGuildLevel()
	{
		if (!$this->isGuild())
			return $this;

		$level = 1;
		$stamp = time() - $this->guild('createdate');

		while ($stamp > 0)
		{
			$stamp -= (1 * IN_MONTHS);
			++$level;
		}

		return $this->setField('level', $level);
	}

	protected function setField($field, $val)
	{
		$this->m_guild[$field] = $val;

		return $this;
	}

	protected function findLeader()
	{
		if (!$this->m_members)
			return $this;

		foreach ($this->m_members as &$char)
		{
			if ($char['rank'] == GUILD_RANK_GMASTER)
			{
				$this->m_leader = $char;
				break;
			}
		}

		return $this;
	}

	/** PUBLIC **/

	public function guild($field)
	{
		return isset($this->m_guild[$field]) ? $this->m_guild[$field] : false;
	}

	public function getLeader()
	{
		return $this->m_leader;
	}

	public function leader($field)
	{
		return isset($this->m_leader[$field]) ? $this->m_leader[$field] : false;
	}

	public function getActivity()
	{
		return $this->m_activity;
	}

	public function getName()
	{
		return $this->guild('name');
	}

	public function getRealmName()
	{
		return $this->guild('realmName');
	}

	public function getRealmId()
	{
		return $this->guild('realmId');
	}

	public function getMembersCount()
	{
		return $this->m_guildMembersCount;
	}

	public function getEmblem()
	{
		return array();
	}

	public function getLevel()
	{
		return $this->guild('level');
	}

	public function getFaction()
	{
		return $this->guild('faction');
	}

	public function getUrl($breadcrumb = false)
	{
		if ($breadcrumb)
			return 'guild/' . $this->getRealmName() . '/' . $this->getName();
		else
			return $this->getWowUrl('guild/' . $this->getRealmName() . '/' . $this->getName());
	}

	public function appendUrl($add = '')
	{
		$url = $this->getUrl();
		if ($add[0] == '/')
			$url .= $add;
		else
			$url .= '/' . $add;

		if ($this->getCharBackName())
			$url .= (strpos($url, '?') ? '&amp;' : '?') . 'character=' . $this->getCharBackName();

		return $url;
	}

	protected function findMemberByField($field, $value, $multiply = false)
	{
		if (!$this->m_members)
			return false;

		if ($multiply)
			$members = array();

		foreach ($this->m_members as &$member)
		{
			if ($member[$field] == $value)
			{
				if (!$multiply)
					return $member;
				else
					$members[] = $member;
			}
		}

		return false;
	}

	public function findMemberByGuid($guid)
	{
		return $this->findMemberByField('guid', $guid, false);
	}
	
	public function findMemberByName($name)
	{
		return $this->findMemberByField('name', $name, false);
	}

	public function isActiveCharacterIsInGuild()
	{
		if ($this->c('AccountManager')->charInfo('realmId') != $this->getRealmId())
			return false;

		if ($this->findMemberByGuid($this->c('AccountManager')->charInfo('guid')))
			return true;

		return false;
	}

	public function getCharBackName()
	{
		if (!isset($_GET['character']))
			return '';
		else if ($this->m_guildCharacter)
			return $this->m_guildCharacter;

		$this->m_guildCharacter = mb_convert_case(urldecode($_GET['character']), MB_CASE_TITLE, 'UTF-8');

		return $this->m_guildCharacter;
	}

	protected function prepareRoster()
	{
		if (!$this->isGuild())
			return $this;

		$get_fields = array('view', 'sort', 'dir', 'name', 'minLvl', 'maxLvl', 'race', 'class', 'rank');

		$sort_fields = array();

		foreach ($get_fields as $field)
		{
			if (isset($_GET[$field]))
			{
				switch ($field)
				{
					case 'name':
						$sort_fields[$field] = addslashes($_GET[$field]);
						break;
					case 'race':
					case 'class':
					case 'rank':
						$sort_fields[$field] = (int) $_GET[$field];
						break;
					case 'minLvl':
					case 'maxLvl':
						if (!isset($sort_fields['level']))
							$sort_fields['level'] = array('min' => 1, 'max' => MAX_PLAYER_LEVEL);

						$sort_fields['level'][substr($field, 0, 3)] = (int) $_GET[$field];
						break;
				}
			}
		}

		return $this->sortMembers($sort_fields);
	}

	protected function sortMembers($f)
	{
		if (!$f || !$this->m_members)
		{
			$this->m_roster = $this->m_members; // Default roster
			return $this;
		}

		$roster = array();

		foreach ($this->m_members as $member)
		{
			$addToRoster = true; // Using "AND"

			if (isset($f['name']) && $f['name'] && strpos($member['name'], $f['name']) === false)
				$addToRoster = false;

			if (isset($f['race']) && $f['race'] >= RACE_HUMAN && $member['race'] != $f['race'])
				$addToRoster = false;

			if (isset($f['class']) && $f['class'] >= CLASS_WARRIOR && $member['class'] != $f['class'])
				$addToRoster = false;

			if (isset($f['rank']) && $f['rank'] >= 0 && $member['rank'] != $f['rank'])
				$addToRoster = false;

			if (isset($f['level']) && $f['level'] > 0 && ((isset($f['level']['min']) && $member['level'] < $f['level']['min']) || (isset($f['level']['max']) && $member['level'] > $f['level']['max'])))
				$addToRoster = false;

			if ($addToRoster)
				$roster[$member['guid']] = $member;
		}

		$this->m_roster = $roster;

		return $this;
	}

	public function getRoster($raw = false)
	{
		if ($raw)
			return $this->m_roster;

		if (isset($_GET['page']))
			$page = $_GET['page']-1;
		else
			$page = 0;

		$iterations = $page * $this->getRosterLimit();

		$roster = array();
		$current = 0;
		$count = 0;
		foreach ($this->m_roster as $rost)
		{
			if ($current < $iterations)
			{
				++$current;
				continue;
			}

			if ($count >= $this->getRosterLimit())
				break;

			$roster[$rost['guid']] = $rost;
			++$count;
		}

		return $roster;
	}

	public function getRosterLimit()
	{
		return self::MEMBERS_PER_PAGE;
	}

	public function getRosterSize()
	{
		return sizeof($this->m_roster);
	}

	public function getPagerInfo()
	{
		if (isset($_GET['page']))
			$page = $_GET['page'];
		else
			$page = 1;

		$pager = array(
			'result_start' => $page * $this->getRosterLimit(),
			'result_end' => ($page * ($this->getRosterLimit() * 2)),
			'result_total' => $this->getRosterSize()
		);

		return $pager;
	}

	public function getGuildRanks()
	{
		return $this->m_guildRanks;
	}

	protected function prepareProfessionsRoster()
	{
		$professions = $this->c('QueryResult')
			->model('WowProfessions')
			->keyIndex('id')
			->loadItems();

		if (!$professions)
			return $this;

		$this->m_professions = $professions;

		$roster = array();

		$skills = $this->c('QueryResult')
			->model('CharacterSkills')
			->fieldCondition('guid', $this->getGuids())
			->fieldCondition('skill', array_keys($professions))
			->keyIndex('skill')
			->loadItems();

		if (!$skills)
			return $this;

		foreach ($skills as $skill)
		{
			$idx = $skill['skill'];

			if (!isset($roster[$idx]))
				$roster[$idx] = array('info' => $professions[$idx], 'members' => array());

			if (isset($this->m_members[$skill['guid']]))
			{
				$cidx = $skill['guid'];
				$m = $this->m_members[$cidx];
				$m['profSkill'] = $skill;
				$roster[$idx]['members'][$cidx] = $m;
				unset($m);
			}
		}

		$this->m_roster = $roster;

		unset($roster, $professions, $skills, $skill);

		return $this;
	}

	public function getProfessions()
	{
		return $this->m_professions;
	}
}
?>