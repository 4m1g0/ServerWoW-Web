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

class Pvp_Component extends Component
{
	protected $m_ladderType = 0;
	protected $m_ladderTops = array();
	protected $m_ladder = array();
	const TEAMS_PER_PAGE = 50;
	protected $m_teamsCount = 0;
	protected $m_team = array();
	protected $m_teamInfo = array('realm' => '', 'name' => '', 'type' => 0);
	
	public function buildLadder($type)
	{
		$this->m_ladderType = $type;

		if ($this->getLadderType() == 0)
			return $this->buildTops();

		return $this->loadLadder()
			->handleLadder();
	}

	public function getLadderType()
	{
		return $this->m_ladderType;
	}

	public function getViewLimits()
	{
		return self::TEAMS_PER_PAGE;
	}

	protected function buildTops()
	{
		if ($this->getLadderType() > 0)
			return $this;

		$realms = $this->c('Config')->getValue('realms');

		if (!$realms)
			return $this;

		$teams = array();
		$current = array();

		foreach ($realms as $realm)
		{
			if (!$realm)
				continue;

			$this->c('Db')->switchTo('characters', $realm['id']);
			if (!$this->c('Db')->isDatabaseAvailable('characters', $realm['id']))
				continue;

			$current = $this->c('QueryResult', 'Db')
				->model('ArenaTeam')
				->fieldCondition('rank', ' <= 3')
				->order(array('ArenaTeam' => array('rating')), 'desc')
				->loadItems();

			foreach ($current as $t)
			{
				$t['realmId'] = $realm['id'];
				$t['realmName'] = $realm['name'];
				$t['url'] = $this->getWowUrl('arena/' . $t['realmName'] . '/' . $t['type'] . 'v' . $t['type'] . '/' . $t['name']);
				$teams[] = $t;
			}
		}

		if (!$teams)
			return $this;

		$_teams = array();
		$types = array(2 => 0, 3 => 0, 5 => 0);
		foreach ($teams as $team)
		{
			if ($types[$team['type']] >= 3)
				continue;

			$_teams[$team['type']][] = $team;
			++$types[$team['type']];
		}

		$this->m_ladderTops = $_teams;

		unset($teams, $types, $current, $realms, $_teams);

		return $this;
	}

	public function getLadderTops()
	{
		return $this->m_ladderTops;
	}

	protected function loadLadder()
	{
		$ladder = array();
		$current = array();
		$realms = $this->c('Config')->getValue('realms');
		if (!$realms)
			return $this;

		$useRealm = 0;
		$searchOpt = array();
		if (isset($_GET['team']) && $_GET['team'])
			$searchOpt[] = array('arena_team.name', 'LIKE \'%%' . addslashes($_GET['team']) . '%%\'', 'AND');
		if (isset($_GET['realm']) && $_GET['realm'] > 0)
			$useRealm = intval($_GET['realm']);
		if (isset($_GET['faction']) && $_GET['faction'] >= 0)
			$searchOpt[] = array('characters.race', $this->c('Wow')->getRacesInFaction($_GET['faction']), 'AND');
		if (isset($_GET['minRating']) && $_GET['minRating'] > 0)
			$searchOpt[] = array('arena_team.rating', ' > ' . intval($_GET['minRating']), 'AND');
		if (isset($_GET['maxRating']) && $_GET['maxRating'] > 0)
			$searchOpt[] = array('arena_team.rating', ' < ' . intval($_GET['minRating']), 'AND');

		if ($useRealm > 0)
		{
			$q= $this->c('QueryResult')
				->model('ArenaTeam')
				->addModel('Characters')
				->join('left', 'Characters', 'ArenaTeam', 'captainGuid', 'guid')
				->fields(array('ArenaTeam' => array_keys($this->c('ArenaTeam', 'Model')->m_fields), 'Characters' => array('race')))
				->limit($this->getViewLimits(), $this->getPage(true) * $this->getViewLimits());

			if ($searchOpt)
			{
				foreach ($searchOpt as $opt)
					$q->fieldCondition($opt[0], $opt[1], $opt[2]);
			}
			else
			{
				$q->fieldCondition('arena_team.rank', ' > 0', 'AND')
					->fieldCondition('arena_team.rating', ' > 0', 'AND');
			}

			$ladder = $q->fieldCondition('arena_team.type', ' = ' . $this->getLadderType(), 'AND')
				->order(array('ArenaTeam' => array('rank', 'rating')), 'DESC')
				->loadItems();

			if ($ladder)
			{
				foreach ($ladder as &$l)
					$l['realmName'] = $realms[$useRealm]['name'];
			}
		}
		else
		{
			foreach ($realms as $realm)
			{
				if (!$realm)
					continue;

				$this->c('Db')->switchTo('characters', $realm['id']);

				if (!$this->c('Db')->isDatabaseAvailable('characters', $realm['id']))
					continue;

				$q = $this->c('QueryResult')
					->model('ArenaTeam')
					->addModel('Characters')
					->join('left', 'Characters', 'ArenaTeam', 'captainGuid', 'guid')
					->fields(array('ArenaTeam' => array_keys($this->c('ArenaTeam', 'Model')->m_fields), 'Characters' => array('race')))
					->limit($this->getViewLimits(), $this->getPage(true) * $this->getViewLimits());

				if ($searchOpt)
					foreach ($searchOpt as $opt)
						$q->fieldCondition($opt[0], $opt[1], $opt[2]);
				else
					$q->fieldCondition('arena_team.rank', ' > 0', 'AND')
						->fieldCondition('arena_team.rating', ' > 0', 'AND');

				$current = $q->fieldCondition('arena_team.type', ' = ' . $this->getLadderType(), 'AND')
						->order(array('ArenaTeam' => array('rank', 'rating')), 'DESC')
						->loadItems();

				if ($current)
				{
					foreach ($current as &$t)
						$t['realmName'] = $realm['name'];

					$ladder = array_merge($ladder, $current);
				}
			}

			$this->c('Db')->switchTo('characters', 1);
		}

		if (!$ladder)
			return $this;

		if (sizeof($ladder) > 2000)
			for ($i = 0; $i < 2000; ++$i)
				$this->m_ladder[] = $ladder[$i];
		else
			$this->m_ladder = $ladder;

		return $this;
	}

	protected function handleLadder()
	{
		return $this;
	}

	public function getLadder()
	{
		return $this->m_ladder;
	}

	public function getTotalTeamsCount()
	{
		if ($this->m_teamsCount > 0)
			return $this->m_teamsCount;

		$realms = $this->c('Config')->getValue('realms');
		if (!$realms)
			return $this;

		$useRealm = 0;
		$searchOpt = array();
		if (isset($_GET['team']) && $_GET['team'])
			$searchOpt['name'] = array('arena_team.name', 'LIKE \'%%' . addslashes($_GET['team']) . '%%\'', 'AND');
		if (isset($_GET['realm']) && $_GET['realm'] > 0)
			$useRealm = intval($_GET['realm']);
		if (isset($_GET['faction']) && $_GET['faction'] >= 0)
			$searchOpt['faction'] = array('characters.race', $this->c('Wow')->getRacesInFaction($_GET['faction']), 'AND');
		if (isset($_GET['minRating']) && $_GET['minRating'] > 0)
			$searchOpt['minrating'] = array('arena_team.rating', ' > ' . intval($_GET['minRating']), 'AND');
		if (isset($_GET['maxRating']) && $_GET['maxRating'] > 0)
			$searchOpt['maxrating'] = array('arena_team.rating', ' < ' . intval($_GET['minRating']), 'AND');

		if ($useRealm > 0)
		{
			$this->c('Db')->switchTo('characters', $useRealm);
			if (!$this->c('Db')->isDatabaseAvailable('characters', $useRealm))
				return 0;

			$q = $this->c('QueryResult', 'Db')
				->model('ArenaTeam')
				->runFunction('SUM', 'arenaTeamId')
				->fieldCondition('type', ' = ' . $this->getLadderType(), 'AND');
			
			if ($searchOpt)
				foreach ($searchOpt as $opt)
					$q->fieldCondition($opt[0], $opt[1], $opt[2]);
			else
				$q->fieldCondition('arena_team.rank', ' > 0', 'AND')
					->fieldCondition('arena_team.rating', ' > 0', 'AND');

			if (isset($searchOpt['faction']))
				$q->addModel('Characters')->join('left', 'Character', 'ArenaTeam', 'captainGuid', 'guid')->fields(array('ArenaTeam' => array('arenaTeamId'), 'characters' => array('race')));
			else
				$q->fields(array('ArenaTeam' => array('arenaTeamId')));

			$size = $q->loadItem();
			$this->m_teamsCount = $size['arenaTeamId'];
		}
		else
		{
			foreach ($realms as $realm)
			{
				if (!$realm)
					continue;

				$this->c('Db')->switchTo('characters', $realm['id']);

				if (!$this->c('Db')->isDatabaseAvailable('characters', $realm['id']))
					continue;

				$q = $this->c('QueryResult', 'Db')
					->model('ArenaTeam')
					->fields(array('ArenaTeam' => array('arenaTeamId')))
					->runFunction('SUM', 'arenaTeamId')
					->fieldCondition('type', ' = ' . $this->getLadderType(), 'AND');
				
				if ($searchOpt)
					foreach ($searchOpt as $opt)
						$q->fieldCondition($opt[0], $opt[1], $opt[2]);
				else
					$q->fieldCondition('arena_team.rank', ' > 0', 'AND')
						->fieldCondition('arena_team.rating', ' > 0', 'AND');

				$teams = $q->loadItem();

				if (!$teams)
					continue;

				$this->m_teamsCount += $teams['arenaTeamId'];
			}
		}

		$this->m_teamsCount = min(2000, $this->m_teamsCount);

		return $this->m_teamsCount;
	}

	public function getPagerInfo()
	{
		$pager = array(
			'result_start' => $this->getPage(true) * $this->getViewLimits() + 1,
			'result_end' => ($this->getPage() * ($this->getViewLimits())),
			'result_total' => $this->getTotalTeamsCount()
		);

		return $pager;
	}

	public function buildTeam($realmName, $teamName, $type)
	{
		if (!in_array($type, array(2, 3, 5)))
			return $this;

		// Find and set active realm ID
		if (!$this->c('Wow')->setActiveRealm($realmName))
		{
			$this->c('Arena_WoW', 'Controller')->setErrorPage();
			$this->c('Error_WoW', 'Controller');
			return $this;
		}

		$this->m_teamInfo = array('realm' => $realmName, 'name' => $teamName, 'type' => $type);

		return $this->loadTeam()
			->handleTeam();
	}

	public function team($idx)
	{
		return isset($this->m_team[$idx]) ? $this->m_team[$idx] : false;
	}

	protected function loadTeam()
	{
		if (!$this->m_teamInfo || !isset($this->m_teamInfo['realm'], $this->m_teamInfo['name']))
			return $this;

		$this->m_team = $this->c('QueryResult', 'Db')
			->model('ArenaTeam')
			->fieldCondition('name', ' = \'' . addslashes($this->m_teamInfo['name']) . '\'')
			->loadItem();

		$this->m_team['members'] = $this->c('QueryResult', 'Db')
			->model('ArenaTeamMember')
			->addModel('Characters')
			->join('left', 'Characters', 'ArenaTeamMember', 'guid', 'guid')
			->fieldCondition('arena_team_member.arenaTeamId', ' = ' . $this->team('arenaTeamId'))
			->keyIndex('guid')
			->loadItems();

		return $this;
	}

	protected function handleTeam()
	{
		if (!$this->m_team)
			return $this;

		$this->m_team['realmName'] = $this->m_teamInfo['realm'];
		$this->m_team['format'] = $this->team('type') . 'v' . $this->team('type');
		$this->m_team['url'] = $this->getWowUrl('arena/' . $this->team('realmName') . '/' . $this->team('format') . '/' . $this->team('name'));
		$this->m_team['emblem'] = $this->handleEmblem();
		$this->m_team['faction'] = isset($this->m_team['members'][$this->team('captainGuid')]) ? $this->c('Wow')->getFactionId($this->m_team['members'][$this->team('captainGuid')]['race']) : FACTION_ALLIANCE;
		$this->m_team['faction_text'] = $this->team('faction') == FACTION_ALLIANCE ? 'alliance' : 'horde';
		$this->m_team['bg'] = $this->c('Config')->getValue('site.battlegroup');
		$this->m_team['bg_link'] = $this->getWowUrl('pvp/arena/' . $this->team('bg') . '/' . $this->team('format'));

		if (!$this->m_team['members'])
			return $this;

		foreach ($this->m_team['members'] as &$m)
			$m['url'] = $this->getWowUrl('character/' . $this->team('realmName') . '/' . $m['name'] . '/');

		return $this;
	}

	protected function handleEmblem()
	{
		if (!$this->m_team)
			return false;

		$emblem = array();

		return $emblem;
	}

	public function isTeam()
	{
		return isset($this->m_team['name']);
	}

	public function getTeam()
	{
		return $this->m_team;
	}
}
?>