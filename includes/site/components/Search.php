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

class Search_Component extends Component
{
	protected $m_query = '';
	protected $m_searchType = '';
	protected $m_searchResults = array();
	protected $m_counters = array();

	public function isSearchAllowed()
	{
		return ($this->m_query && $this->m_searchType);
	}

	public function setQuery($query)
	{
		if (mb_strlen($query) < 2)
			return $this;

		$this->m_query = $query;

		return $this;
	}

	public function setSearchType($type = 'summary')
	{
		$types = array('summary', 'wowarenateam', 'article', 'wowcharacter', 'post', 'static', 'wowguild', 'wowitem');

		if (!in_array($type, $types))
			$type = 'summary';

		$this->m_searchType = $type;

		return $this;
	}

	protected function resetSearch()
	{
		return $this->clearResults()->dropCounters();
	}

	protected function clearResults()
	{
		$this->m_searchResults = array();

		return $this;
	}

	protected function dropCounters()
	{
		$this->m_counters = array();

		return $this;
	}

	public function getQuery($escaped = false)
	{
		return !$escaped ? $this->m_query : addslashes($this->m_query);
	}

	public function getSearchType()
	{
		return $this->m_searchType;
	}

	public function getCounters($type = '')
	{
		if (!$type)
			return $this->m_counters;

		return isset($this->m_counters[$type]) ? $this->m_counters[$type] : false;
	}

	public function getResults($type = '')
	{
		if (!$type)
			return $this->m_searchResults;

		return isset($this->m_searchResults[$type]) ? $this->m_searchResults[$type] : false;
	}

	public function performSearch()
	{
		if (!$this->getQuery())
			return $this->resetSearch();


		$this->resetSearch();

		if ($this->getSearchType() == 'summary')
		{
			$this->findCharacters()
				->findGuilds()
				->findArenaTeams()
				->findItems()
				->findArticles()
				->findForumPosts()
				->findContents();
		}
		else
		{
			switch ($this->getSearchType())
			{
				case 'wowcharacter':
					$this->findCharacters(false, -1, 0);
					break;
				case 'wowguild':
					$this->findGuilds(false, -1, 0);
					break;
				case 'wowarenateam':
					$this->findArenaTeams(false, -1, 0);
					break;
				case 'wowitem':
					$this->findItems(false, -1, 0);
					break;
				case 'artcle':
					$this->findArticles(false, -1, 0);
					break;
				case 'post':
					$this->findForumPosts(false, -1, 0);
					break;
				case 'static':
					$this->findContents(false, -1, 0);
					break;
				default:
					return $this;
			}
		}

		return $this;
	}

	protected function quickSwitch($realmId)
	{
		if (!$realmId)
			return false;

		$this->c('Db')->switchTo('characters', $realmId);

		if (!$this->c('Db')->isDatabaseAvailable('characters', $realmId))
		{
			$this->c('Log')->writeError('%s : realm %d is not available for search (database is not ready)', __METHOD__, $realmId);
			return false;
		}

		return true;
	}

	protected function setResults($type, $results, $size)
	{
		$types = array('wowarenateam', 'article', 'wowcharacter', 'post', 'static', 'wowguild', 'wowitem');

		if (!$type || !in_array($type, $types) || !$results || !$size)
			return $this; // Do not add empty results

		$this->m_searchResults[$type] = $results;
		$this->m_counters[$type] = $size;

		return $this;
	}

	/**
	 * Performs characters search
	 * If $counters == true, only results count will be returned
	 * $limit is search results limitation. Set to -1 to unlimited results
	 * If $mode == 1, summary search will be performed, else - normal search will be performed
	 *
	 * @param bool $counters = false
	 * @param int $limit = 3
	 * @param $mode = 1
	 * @return Search_Component
	 **/
	protected function findCharacters($counters = false, $limit = 3, $mode = 1)
	{
		$type = 'wowcharacter';

		$results = array();

		$realms = $this->c('Config')->getValue('realms');

		if (!$realms)
			return $this;

		$current = array();
		$size = 0;

		foreach ($realms as $realm)
		{
			if (!$realm)
				continue;

			if (!$this->quickSwitch($realm['id']))
				continue;

			$q = $this->c('QueryResult', 'Db')
				->model('Characters')
				->addModel('Guild')
				->addModel('GuildMember')
				->join('left', 'GuildMember', 'Characters', 'guid', 'guid')
				->join('left', 'Guild', 'GuildMember', 'guildid', 'guildid')
				->fields(array(
					'Characters' => array('guid', 'name', 'class', 'race', 'gender', 'level'),
					'Guild' => array('guildid', 'name')
				))
				->setAlias('Guild', 'name', 'guildName')
				->fieldCondition('name', ' = \'' . $this->getQuery(true) . '\'');

			$current = $q->loadItems();

			if ($current)
			{
				foreach ($current as &$c)
				{
					$c['realmName'] = $realm['name'];
					$c['realmId'] = $realm['id'];
					$c['url'] = $this->getWowUrl('character/' . $realm['name'] . '/' . $c['name'] . '/');
					$c['class_text'] = $this->c('Locale')->getString('character_class_' . $c['class'], $c['gender']);
					$c['race_text'] = $this->c('Locale')->getString('character_race_' . $c['race'], $c['gender']);
					if ($c['guildid'] > 0)
						$c['guildUrl'] = $this->getWowUrl('guild/' . $realm['name'] . '/' . $c['guildName']);
				}

				$size += sizeof($current);

				$results[$realm['id']] = $current;
			}

			unset($q);
		}

		return $this->setResults($type, $results, $size);
	}

	/**
	 * Performs guilds search
	 * If $counters == true, only results count will be returned
	 * $limit is search results limitation. Set to -1 to unlimited results
	 * If $mode == 1, summary search will be performed, else - normal search will be performed
	 *
	 * @param bool $counters = false
	 * @param int $limit = 3
	 * @param $mode = 1
	 * @return Search_Component
	 **/
	protected function findGuilds($counters = false, $limit = 3, $mode = 1)
	{
		$type = 'wowguild';

		$results = array();

		$realms = $this->c('Config')->getValue('realms');

		if (!$realms)
			return $this;

		$current = array();
		$size = 0;

		foreach ($realms as $realm)
		{
			if (!$realm)
				continue;

			if (!$this->quickSwitch($realm['id']))
				continue;

			$current = $this->c('QueryResult', 'Db')
				->model('Guild')
				->addModel('Characters')
				->join('left', 'Characters', 'Guild', 'leaderguid', 'guid')
				->fields(array('Guild' => array('guildid', 'name'), 'Characters' => array('guid', 'race')))
				->fieldCondition('guild.name', ' LIKE \'%%' . $this->getQuery(true) . '%%\'')
				->loadItems();

			if ($current)
			{
				foreach ($current as &$c)
				{
					$c['realmName'] = $realm['name'];
					$c['realmId'] = $realm['id'];
					$c['url'] = $this->getWowUrl('guild/' . $realm['name'] . '/' . $c['name'] . '/');
					$c['faction_text'] = $this->c('Wow')->getFactionId($c['race']) == FACTION_ALLIANCE ? 'alliance' : 'horde';
				}

				$size += sizeof($current);

				$results[$realm['id']] = $current;
			}

			unset($q);
		}

		return $this->setResults($type, $results, $size);
	}

	/**
	 * Performs arena teams search
	 * If $counters == true, only results count will be returned
	 * $limit is search results limitation. Set to -1 to unlimited results
	 * If $mode == 1, summary search will be performed, else - normal search will be performed
	 *
	 * @param bool $counters = false
	 * @param int $limit = 3
	 * @param $mode = 1
	 * @return Search_Component
	 **/
	protected function findArenaTeams($counters = false, $limit = 3, $mode = 1)
	{
		$type = 'wowarenateam';

		$results = array();

		$realms = $this->c('Config')->getValue('realms');

		if (!$realms)
			return $this;

		$current = array();
		$size = 0;

		foreach ($realms as $realm)
		{
			if (!$realm)
				continue;

			if (!$this->quickSwitch($realm['id']))
				continue;

			$current = $this->c('QueryResult', 'Db')
				->model('ArenaTeam')
				->addModel('Characters')
				->join('left', 'Characters', 'ArenaTeam', 'captainGuid', 'guid')
				->fieldCondition('arena_team.name', ' LIKE \'%%' . $this->getQuery(true) . '%%\'')
				->setAlias('Characters', 'name', 'charName')
				->loadItems();

			if ($current)
			{
				foreach ($current as &$c)
				{
					$c['realmName'] = $realm['name'];
					$c['realmId'] = $realm['id'];
					$c['type_text'] = $c['type'] . 'v' . $c['type'];
					$c['url'] = $this->getWowUrl('arena/' . $realm['name'] . '/' . $c['type_text'] . '/' . $c['name'] . '/');
					$c['faction'] = $this->c('Wow')->getFactionId($c['race']);
					$c['faction_text'] = $c['faction'] == FACTION_ALLIANCE ? 'alliance' : 'horde';
				}

				$size += sizeof($current);

				$results[$realm['id']] = $current;
			}

			unset($q);
		}

		return $this->setResults($type, $results, $size);
	}

	/**
	 * Performs items search
	 * If $counters == true, only results count will be returned
	 * $limit is search results limitation. Set to -1 to unlimited results
	 * If $mode == 1, summary search will be performed, else - normal search will be performed
	 *
	 * @param bool $counters = false
	 * @param int $limit = 3
	 * @param $mode = 1
	 * @return Search_Component
	 **/
	protected function findItems($counters = false, $limit = 3, $mode = 1)
	{
		$type = 'wowitem';

		$results = array();

		$size = 0;

		$q = $this->c('QueryResult', 'Db');
		if ($this->c('Locale')->getLocaleID() != LOCALE_EN)
			$q->model('LocalesItem')
				->fieldCondition('name_loc' . $this->c('Locale')->getLocaleID(), ' LIKE \'%%' . $this->getQuery(true) . '%%\'', 'OR')
				->fields(array('LocalesItem' => array('entry')));
		else
			$q->model('ItemTemplate')
				->fieldCondition('name', ' LIKE \'%%' . $this->getQuery() . '%%\'')
				->fields(array('ItemTemplate' => array('entry')));

		$entries = $q->keyIndex('entry')
			->loadItems();

		if ($entries)
		{
			$fields = array('ItemTemplate' => array('entry', 'name', 'Quality', 'ItemLevel', 'displayid', 'RequiredLevel'), 'LocalesItem' => array('name_loc' . $this->c('Locale')->getLocaleID()));
			$results = $this->c('Item')->getItemsInfo($entries, false, $fields);
		}

		$size = sizeof($results);

		return $this->setResults($type, $results, $size);
	}

	/**
	 * Performs blog articles (news) search
	 * If $counters == true, only results count will be returned
	 * $limit is search results limitation. Set to -1 to unlimited results
	 * If $mode == 1, summary search will be performed, else - normal search will be performed
	 *
	 * @param bool $counters = false
	 * @param int $limit = 3
	 * @param $mode = 1
	 * @return Search_Component
	 **/
	protected function findArticles($counters = false, $limit = 3, $mode = 1)
	{
		$type = 'article';

		$results = $this->c('QueryResult', 'Db')
			->model('WowNews')
			->fieldCondition('title_' . $this->c('Locale')->getLocale(), ' LIKE \'%%' . $this->getQuery(true) . '%%\'')
			->loadItems();

		foreach ($results as &$b)
		{
			$b['url'] = $this->getWowUrl('blog/' . $b['id']);
			$b['image_small'] = $b['image'];
			$b['comments_count'] = 0;

			if (mb_strlen($b['title']) > 25)
				$b['title'] = mb_substr($b['title'], 0, 25) . '...';
		}

		$size = sizeof($results);

		return $this->setResults($type, $results, $size);
	}

	/**
	 * Performs forum posts search
	 * If $counters == true, only results count will be returned
	 * $limit is search results limitation. Set to -1 to unlimited results
	 * If $mode == 1, summary search will be performed, else - normal search will be performed
	 *
	 * @param bool $counters = false
	 * @param int $limit = 5
	 * @param $mode = 1
	 * @return Search_Component
	 **/
	protected function findForumPosts($counters = false, $limit = 5, $mode = 1)
	{
		$type = 'post';

		$results = array();

		$size = 0;

		$results = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->addModel('WowForumThreads')
			->addModel('WowForumCategory')
			->addModel('WowUserCharacters')
			->join('left', 'WowForumThreads', 'WowForumPosts', 'thread_id', 'thread_id')
			->join('left', 'WowForumCategory', 'WowForumThreads', 'cat_id', 'cat_id')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_guid', 'guid')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'account_id', 'account')
			->fields(array(
				'WowForumPosts' => array('message', 'post_date'),
				'WowForumThreads' => array('thread_id', 'title'),
				'WowForumCategory' => array('cat_id', 'title_' . $this->c('Locale')->getLocale()),
				'WowUserCharacters' => array('name', 'realmName')
			))
			->fieldCondition('wow_forum_posts.message', ' LIKE \'%%' . $this->getQuery(true) . '%%\'')
			->setAlias('WowForumCategory', 'title_' . $this->c('Locale')->getLocale(), 'cat_title')
			->setAlias('WowUserCharacters', 'name', 'author_name')
			->setAlias('WowUserCharacters', 'realmName', 'author_realm')
			->setAlias('WowForumPosts', 'message', 'post_preview')
			->loadItems();

		if (!$results)
			return $this;

		foreach ($results as &$p)
		{
			$p['url'] = $this->getWowUrl('forum/topic/' . $p['thread_id']);
			$p['cat_url'] = $this->getWowUrl('forum/' . $p['cat_id']);

			if (mb_strlen($p['post_preview']) > 200)
				$p['post_preview'] = mb_substr($p['post_preview'], 0, 201) . '...';

			$replies = $this->c('QueryResult', 'Db')
				->model('WowForumPosts')
				->fields(array('WowForumPosts' => array('post_id')))
				->runFunction('COUNT', 'post_id')
				->fieldCondition('thread_id', ' = ' . $p['thread_id'])
				->loadItem();

			if ($replies)
				$p['replies'] = $replies['post_id'];
			else
				$p['replies'] = 0;

			$p['post_date'] = date('d/m/Y', $p['post_date']);
		}

		$size = sizeof($results);

		return $this->setResults($type, $results, $size);
	}

	/**
	 * Performs static contents search
	 * If $counters == true, only results count will be returned
	 * $limit is search results limitation. Set to -1 to unlimited results
	 * If $mode == 1, summary search will be performed, else - normal search will be performed
	 *
	 * @param bool $counters = false
	 * @param int $limit = 3
	 * @param $mode = 1
	 * @return Search_Component
	 **/
	protected function findContents($counters = false, $limit = 3, $mode = 1)
	{
		$type = 'static';
		return $this;
	}

	/**
	 * Performs user's posts search
	 * If $counters == true, only results count will be returned
	 * $limit is search results limitation. Set to -1 to unlimited results
	 * If $mode == 1, summary search will be performed, else - normal search will be performed
	 *
	 * @param bool $counters = false
	 * @param int $limit = 5
	 * @param $mode = 1
	 * @return Search_Component
	 **/
	protected function findUserPosts($counters = false, $limit = 5, $mode = 1)
	{
		if (!isset($_GET['a']))
			return $this;

		$type = 'post';

		$results = array();

		$size = 0;

		$char = explode('@', $this->getQuery());
		if (!$char || !isset($char[1]))
			return $this;

		$name = trim(urldecode($char[0]));
		$realm = trim(urldecode($char[1]));

		$data = $this->c('QueryResult', 'Db')
			->model('WowUserCharacters')
			->fields(array('WowUserCharacters' => array('account', 'guid')))
			->fieldCondition('name', ' = \'' . addslashes($name) . '\'', 'AND')
			->fieldCondition('realmName', ' = \'' . addslashes($realm) . '\'', 'AND')
			->loadItem();

		if (!$data)
			return $this;

		$results = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->addModel('WowForumThreads')
			->addModel('WowForumCategory')
			->join('left', 'WowForumThreads', 'WowForumPosts', 'thread_id', 'thread_id')
			->join('left', 'WowForumCategory', 'WowForumThreads', 'cat_id', 'cat_id')
			->fields(array(
				'WowForumPosts' => array('message', 'post_date'),
				'WowForumThreads' => array('thread_id', 'title'),
				'WowForumCategory' => array('cat_id', 'title_' . $this->c('Locale')->getLocale()),
			))
			->fieldCondition('wow_forum_posts.account_id', ' = ' . $data['account'])
			->fieldCondition('wow_forum_posts.character_guid', ' = ' . $data['guid'])
			->setAlias('WowForumCategory', 'title_' . $this->c('Locale')->getLocale(), 'cat_title')
			->setAlias('WowForumPosts', 'message', 'post_preview')
			->loadItems();

		if (!$results)
			return $this;

		foreach ($results as &$p)
		{
			$p['url'] = $this->getWowUrl('forum/topic/' . $p['thread_id']);
			$p['cat_url'] = $this->getWowUrl('forum/' . $p['cat_id']);

			if (mb_strlen($p['post_preview']) > 200)
				$p['post_preview'] = mb_substr($p['post_preview'], 0, 201) . '...';

			$replies = $this->c('QueryResult', 'Db')
				->model('WowForumPosts')
				->fields(array('WowForumPosts' => array('post_id')))
				->runFunction('COUNT', 'post_id')
				->fieldCondition('thread_id', ' = ' . $p['thread_id'])
				->loadItem();

			if ($replies)
				$p['replies'] = $replies['post_id'];
			else
				$p['replies'] = 0;

			$p['post_date'] = date('d/m/Y', $p['post_date']);
			$p['author_name'] = $name;
			$p['author_realm'] = $realm;
		}

		return $this->setResults($type, $results, $size);
	}

	public function isAnyResults()
	{
		return $this->m_searchResults && $this->m_query && $this->m_counters;
	}

	public function issetResultsFor($type)
	{
		return isset($this->m_searchResults[$type]);
	}

	public function getDisplayLimits()
	{
		$count = $this->getCounters($this->getSearchType());
		return array(
			'result_start' => (($this->getPage(true) * 20) + 1),
			'result_end' => min(((($this->getPage(true) * 20)) + 20), $count),
			'result_total' => $count
		);
	}
}
?>