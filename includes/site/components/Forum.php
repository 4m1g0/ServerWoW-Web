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

class Forum_Component extends Component
{
	const TOPICS_PER_PAGE = 50;
	const POSTS_PER_PAGE = 20;

	protected $m_topicId = 0;
	protected $m_categoryId = 0;
	protected $m_pager = array();
	protected $m_categoryData = array();
	protected $m_categoryTopics = array();
	protected $m_topicData = array();
	protected $m_topicPosts = array();
	protected $m_postData = array();
	protected $m_blizztrackerData = array();
	protected $m_indexCategories = array();
	protected $m_forumCounters = array();

	public function initForums($categoryId, $topicId)
	{
		$redirect = false;

		// Load category or topic (include redirect if nothing found)

		if (!$categoryId && !$topicId)
			$this->initIndexCategories();
		elseif ($categoryId > 0)
		{
			$this->initCategory($categoryId);
			if (!$this->isCategory())
				$redirect = true;
		}
		elseif ($topicId > 0)
		{
			$this->initTopic($topicId);
			if (!$this->isTopic())
				$redirect = true;
		}

		if ($redirect)
			$this->core->redirectUrl('forum');

		return $this;
	}

	public function getType()
	{
		if ($this->m_categoryId > 0 && $this->m_categoryData)
			return FORUM_TYPE_CATEGORY;
		elseif ($this->m_topicId > 0 && $this->m_topicData)
			return FORUM_TYPE_TOPIC;
		elseif ($this->m_indexCategories)
			return FORUM_TYPE_INDEX;
		else
			return FORUM_TYPE_POSTING;
	}

	public function getCategoryId()
	{
		return $this->m_categoryId;
	}

	public function getCategoryTitle()
	{
		return isset($this->m_categoryData['title']) ? $this->m_categoryData['title'] : '';
	}

	public function getCategoryTopics()
	{
		return $this->m_categoryTopics;
	}

	public function getTopicId()
	{
		return $this->m_topicId;
	}

	public function getTopicRootCategoryId()
	{
		return isset($this->m_topicData['root']['cat_id']) ? $this->m_topicData['root']['cat_id'] : 0;
	}

	public function getTopicRootCategoryTitle()
	{
		return isset($this->m_topicData['root']['title']) ? $this->m_topicData['root']['title'] : '';
	}

	public function getTopicCategoryId()
	{
		return isset($this->m_topicData['cat_id']) ? $this->m_topicData['cat_id'] : 0;
	}

	public function getTopicCategoryTitle()
	{
		return isset($this->m_topicData['categoryTitle']) ? $this->m_topicData['categoryTitle'] : '';
	}

	public function getTopicTitle()
	{
		return isset($this->m_topicData['title']) ? $this->m_topicData['title'] : '';
	}

	public function getTopicPosts()
	{
		return $this->m_topicPosts;
	}

	public function isCategory()
	{
		if (!$this->m_categoryId || !$this->m_categoryData)
			return false;

		return true;
	}

	public function isTopic()
	{
		if (!$this->m_topicId || !$this->m_topicData)
			return false;

		return true;
	}

	protected function initCategory($catId)
	{
		if ($catId <= 0)
			return $this;

		$this->m_categoryId = $catId;

		return $this->loadCategory()->handleCategory();
	}

	protected function initTopic($topicId)
	{
		if ($topicId <= 0)
			return $this;

		$this->m_topicId = $topicId;

		return $this->loadTopic()->handleTopic();
	}

	protected function loadCategory()
	{
		if (($this->m_categoryData && $this->m_categoryTopics) && !$this->m_categoryId)
			return $this;

		$this->m_categoryData = $this->c('QueryResult', 'Db')
			->model('WowForumCategory')
			->fieldCondition('cat_id', ' = ' . $this->m_categoryId)
			->loadItem();

		if (!$this->m_categoryData)
			return $this;

		// Count
		$this->m_forumCounters['topics'] = $this->c('QueryResult', 'Db')
			->model('WowForumThreads')
			->fields(array('WowForumThreads' => array('thread_id')))
			->runFunction('COUNT', 'thread_id')
			->fieldCondition('cat_id', ' = ' . $this->m_categoryId)
			->loadItem();

		$this->m_forumCounters['topics'] = $this->m_forumCounters['topics']['thread_id'];
		
		$this->m_categoryTopics = $this->c('QueryResult', 'Db')
			->model('WowForumThreads')
			->addModel('WowForumPosts')
			->addModel('WowUserCharacters')
			->join('left', 'WowForumPosts', 'WowForumThreads', 'thread_id', 'thread_id')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_guid', 'guid')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_realm', 'realmId')
			->fieldCondition('wow_forum_threads.cat_id', ' = ' . $this->m_categoryId)
			->fieldCondition('wow_forum_posts.post_num', ' = 1')
			->limit(($this->getDisplayLimit('topics') * $this->getPage()), $this->getPage(true))
			->loadItems();

		return $this;
	}

	protected function initIndexCategories()
	{
		return $this->loadIndexCategories()->handleIndexCategories();
	}

	protected function loadIndexCategories()
	{
		if ($this->m_indexCategories)
			return $this;

		$gmLevel = 0;

		if ($this->c('AccountManager')->isLoggedIn())
			$gmLevel = $this->c('AccountManager')->user('gmlevel');

		if (!$gmLevel)
			$gmLevel = 0;

		$this->m_indexCategories = $this->c('QueryResult', 'Db')
			->model('WowForumCategory')
			->fieldCondition('gmlevel', '<= ' . $gmLevel)
			->loadItems();

		return $this;
	}

	protected function handleIndexCategories()
	{
		if (!$this->m_indexCategories)
			return $this;

		$forum_categories = array();

		$realmCat = 0;

		foreach ($this->m_indexCategories as &$cat)
		{
			if ($cat['header'] == 1)
			{
				$forum_categories[$cat['cat_id']] = array(
					'category_info' => $cat,
					'subcategories' => array()
				);
			}
			if ($cat['realm_cat'] == 1)
				$realmCat = $cat['cat_id'];
		}

		foreach ($this->m_indexCategories as &$category)
		{
			if ($category['header'] == 0 && $category['parent_cat'] > 0)
			{
				if (!isset($forum_categories[$category['parent_cat']]))
					continue;

				if ($category['parent_cat'] == $realmCat)
				{
					$category['is_realm'] = $this->c('Wow')->isRealm($category['title']);
					if ($category['is_realm'])
						$category['my_realm'] = $this->c('AccountManager')->isMyRealm($category['title']);
				}
				$forum_categories[$category['parent_cat']]['subcategories'][] = $category;
			}
		}

		$this->m_indexCategories = $forum_categories;

		unset($forum_categories);

		return $this;
	}

	protected function handleCategory()
	{
		if (!$this->m_categoryData || !$this->m_categoryTopics)
			return $this;

		$topics = array(
			'featured' => array(),
			'pinned' => array(),
			'regular' => array()
		);

		foreach ($this->m_categoryTopics as $topic)
		{
			// Replace BB codes to HTML tags
			$this->handleBbCodes($topic['message']);

			$topic['short_content'] = mb_substr($topic['message'], 0, 240, 'UTF-8');

			if (mb_strlen($topic['message'], 'UTF-8') > 240)
				$topic['short_content'] .= '…';

			if ($topic['flags'] & THREAD_FLAG_FEATURED)
				$topics['featured'][$topic['thread_id']] = $topic;
			elseif ($topic['flags'] & THREAD_FLAG_PINNED)
				$topics['pinned'][$topic['thread_id']] = $topic;
			else
				$topics['regular'][$topic['thread_id']] = $topic;
		}

		$this->m_categoryTopics = $topics;

		return $this;
	}

	protected function loadTopic()
	{
		if (($this->m_topicData && $this->m_topicPosts) || !$this->m_topicId)
			return $this;

		// Update topic views
		$edt = $this->c('Editing')
			->setModel('WowForumThreads')
			->setType('update')
			->setId($this->m_topicId)
			->load();

		$edt->views = $edt->views + 1;
		$edt->save()->clearValues();

		$this->m_topicData = $this->c('QueryResult', 'Db')
			->model('WowForumThreads')
			->addModel('WowForumCategory')
			->join('left', 'WowForumCategory', 'WowForumThreads', 'cat_id', 'cat_id')
			->setAlias('WowForumCategory', 'title_' . $this->c('Locale')->GetLocale(), 'categoryTitle')
			->setAlias('WowForumCategory', 'desc_' . $this->c('Locale')->GetLocale(), 'categoryDesc')
			->setAlias('WowForumCategory', 'cat_id', 'categoryId')
			->fieldCondition('wow_forum_threads.thread_id', ' = ' . $this->m_topicId)
			->loadItem();

		if (!$this->m_topicData)
			return $this;

		if ($this->m_topicData['parent_cat'] > 0)
		{
			$this->m_topicData['root'] = $this->c('QueryResult', 'Db')
				->model('WowForumCategory')
				->fieldCondition('cat_id', ' = ' . $this->m_topicData['parent_cat'])
				->loadItem();
		}

		// Count
		$count = $this->c('QueryResult', 'Db')
			->model('WowForumPosts', 'Db')
			->fields(array('WowForumPosts' => array('post_id')))
			->runFunction('COUNT', 'post_id')
			->loadItem();

		$this->m_forumCounters['posts'] = $count['post_id'];

		$this->m_topicPosts = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->addModel('WowUserCharacters')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_guid', 'guid')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_realm', 'realmId')
			->fieldCondition('wow_forum_posts.thread_id', ' = ' . $this->m_topicId)
			->limit(($this->getDisplayLimit('posts') * $this->getPage()), $this->getPage(true))
			->loadItems();

		return $this;
	}

	protected function getPage($asOffset = false)
	{
		if (!isset($_GET['page']))
			return $asOffset ? 0 : 1;

		$page = (int) $_GET['page'];
		$page = $page >= 1 ? $page : 1;

		return $asOffset ? $page - 1 : $page;
	}

	protected function handleTopic()
	{
		if (!$this->m_topicData || !$this->m_topicPosts)
			return $this;

		foreach ($this->m_topicPosts as &$post)
		{
			$this->handleBbCodes($post['message']);
		}

		return $this;
	}

	protected function handleBbCodes(&$inpStr)
	{
		$bbcodes = array(
			'[b]', '[/b]', '[u]', '[/u]', '[i]', '[/i]'
		);

		$htmltags = array(
			'<strong>', '</strong>', '<u>', '</u>', '<i>', '</i>'
		);

		if (strpos($inpStr, '[') !== false && strpos($inpStr, ']') !== false)
			$inpStr = str_replace($bbcodes, $htmltags, $inpStr);

		elseif (strpos($inpStr, '<') !== false && strpos($inpStr, '>') !== false)
			$inpStr = str_replace($htmltags, $bbcodes, $inpStr);

		return $this;
	}

	public function createTopic($categoryId, $topicData)
	{
		return $this;
	}

	public function createPost($topicId, $postData)
	{
		return $this;
	}

	public function editPost($postId)
	{
		return $this;
	}

	public function deletePost($postId)
	{
		return $this;
	}

	public function deleteTopic($topicId)
	{
		return $this;
	}

	public function editTopic($topicId)
	{
		return $this;
	}

	public function togglePinnedTopic($topicId)
	{
		return $this;
	}

	public function setTopicFlags($topicId, $flags)
	{
		return $this;
	}

	public function reportPost($postId, $reason = '')
	{
		return $this;
	}

	public function votePostUp($postId)
	{
		return $this;
	}

	public function votePostDown($postId)
	{
		return $this;
	}

	public function getIndexCategories()
	{
		return $this->m_indexCategories;
	}

	public function getDisplayLimit($type)
	{
		if ($type == 'topics')
			return self::TOPICS_PER_PAGE;
		elseif ($type == 'posts')
			return self::POSTS_PER_PAGE;
		else
			return 0;
	}

	public function getTopicsInCategoryCount()
	{
		return isset($this->m_forumCounters['topics']) ? $this->m_forumCounters['topics'] : 0;
	}

	public function getPostsInTopicCount()
	{
		return isset($this->m_forumCounters['posts']) ? $this->m_forumCounters['posts'] : 0;
	}
}
?>