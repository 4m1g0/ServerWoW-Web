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

	protected $m_serverType = -1;
	protected $m_leader = array();

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

		$this->setField('realmName', $realm);

		// Guild members
		$this->m_members = $this->c('QueryResult', 'Db')
			->model('GuildMember')
			->addModel('Characters')
			->join('left', 'Characters', 'GuildMember', 'guid', 'guid')
			->fieldCondition('guild_member.guildid', ' = ' . $this->guild('guildid'))
			->keyIndex('guid')
			->loadItem();

		// Activity
		$this->loadActivity();

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
			->keyIndex('guid')
			->loadItems();

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

	protected function calculateGuildLevel()
	{
		if (!$this->isGuild())
			return $this;

		$level = 1;
		$stamp = $this->guild('createdate');

		while ($stamp > 0)
		{
			$stamp -= (1 * IN_MONTHS);
			++$level;
		}

		return $this->setField('level', $level);
	}

	protected function handleActivity()
	{
		if (!$this->m_activity)
			return $this;

		return $this;
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

	public function getMembersCount()
	{
		return sizeof($this->m_members);
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
}
?>