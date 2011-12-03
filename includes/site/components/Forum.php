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
	// Limits
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
	protected $m_rawPostMessages = array();

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

	public function getTopicData()
	{
		return $this->m_topicData;
	}

	public function getBlizzPostsInTopic()
	{
		if (!$this->m_topicData)
			return false;

		if (is_array($this->m_topicData['blizz_posts']))
			return $this->m_topicData['blizz_posts'];

		$d = explode(' ', $this->m_topicData['blizz_posts']);

		$s = array();
		foreach ($d as $p)
		{
			if ($p)
				$s[] = array('anchor' => $p, 'page' => $this->getPageForAnchor($p));
		}

		$this->m_topicData['blizz_posts'] = $s;

		return $this->m_topicData['blizz_posts'];
	}

	public function getPageForAnchor($anch)
	{
		$page = 1;

		if ($anch > self::POSTS_PER_PAGE)
			$page = ceil($anch / self::POSTS_PER_PAGE);

		return $page;
	}

	public function getTopicId()
	{
		return $this->m_topicId;
	}

	public function getCategoryRootId()
	{
		return isset($this->m_categoryData['root']['cat_id']) ? $this->m_categoryData['root']['cat_id'] : 0;
	}

	public function getCategoryRootTitle()
	{
		return isset($this->m_categoryData['root']['title']) ? $this->m_categoryData['root']['title'] : '';
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

	public function getTopicPosts($rawMessages = false)
	{
		if (!$rawMessages)
			return $this->m_topicPosts;

		$posts = array();
		foreach ($this->m_topicPosts as $post)
		{
			if (isset($this->m_rawPostMessages[$post['post_id']]))
				$post['message'] = $this->m_rawPostMessages[$post['post_id']];

			$posts[] = $post;
		}

		unset($post);

		return $posts;
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

		if ($this->m_categoryData['parent_cat'] > 0)
		{
			$this->m_categoryData['root'] = $this->c('QueryResult', 'Db')
				->model('WowForumCategory')
				->fieldCondition('cat_id', ' = ' . $this->m_categoryData['parent_cat'])
				->loadItem();
		}

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
			->addModel('WowAccounts')
			->join('left', 'WowForumPosts', 'WowForumThreads', 'thread_id', 'thread_id')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_guid', 'guid')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_realm', 'realmId')
			->join('left', 'WowAccounts', 'WowForumPosts', 'account_id', 'id')
			->fieldCondition('wow_forum_threads.cat_id', ' = ' . $this->m_categoryId)
			->fieldCondition('wow_forum_posts.post_num', ' = 1')
			->limit(($this->getDisplayLimit('topics') * $this->getPage()), $this->getPage(true))
			->order(array('WowForumThreads' => array('last_update')), 'DESC')
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

		$data = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->fields(array('WowForumPosts' => array('thread_id', 'post_id', 'post_num', 'blizz_name')))
			->runFunction('COUNT', 'post_id', 'postsCount')
			->runFunction('MAX', 'post_num', 'maxPost')
			->group('WowForumPosts', 'thread_id')
			->keyIndex('thread_id')
			->loadItems();

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

		$this->m_forumCounters['posts'] = $this->m_topicData['posts'];

		$this->m_topicPosts = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->addModel('WowAccounts')
			->addModel('WowUserCharacters')
			->addModel('WowBlizztrackerPosts')
			->addModel('WowUserSettings')
			->addModel('WowUserGroups')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_guid', 'guid')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_realm', 'realmId')
			->join('left', 'WowBlizztrackerPosts', 'WowForumPosts', 'post_id', 'tracker_post_id')
			->join('left', 'WowUserSettings', 'WowForumPosts', 'account_id', 'account')
			->join('left', 'WowAccounts', 'WowForumPosts', 'account_id', 'id')
			->join('left', 'WowUserGroups', 'WowAccounts', 'group_id', 'group_id')
			->fieldCondition('wow_forum_posts.thread_id', ' = ' . $this->m_topicId)
			->setAlias('WowUserSettings', 'forums_signature', 'signature')
			->limit(self::POSTS_PER_PAGE, (self::POSTS_PER_PAGE * $this->getPage(true)))
			->loadItems();

		return $this;
	}

	public function getPage($asOffset = false)
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

		$rawMessages = array();

		$topics = array();
		$used = array();

		foreach ($this->m_topicPosts as $p)
		{
			if (in_array($p['post_id'], $used))
				continue;
			else
			{
				$topics[] = $p;
				$used[$p['post_id']] = $p['post_id'];
			}
		}

		$this->m_topicPosts = $topics;

		foreach ($this->m_topicPosts as &$post)
		{
			$rawMessages[$post['post_id']] = $post['message'];
			$this->handleBbCodes($post['message']);

			if (isset($post['signature']))
				$this->handleSignature($post['signature']);
		}

		$this->m_rawPostMessages = $rawMessages;

		return $this;
	}

	protected function handleSignature(&$sig)
	{
		if (!$sig)
			return $this;

		$sig = str_replace(array('<', '>'), array('&lt;', '&gt;'), $sig);
		$sig = preg_replace('/\[url\=(.+?)\](.+?)\[\/url\]/six', '<a href="$1" target="_blank">$2</a>', $sig);
		$sig = preg_replace('/\[img](.+?)\[\/img\]/six', '<img src="$1" />', $sig);

		return $this;
	}

	public function handleBbCodes(&$inpStr)
	{
		if (!$inpStr || !is_string($inpStr))
			return $this;

		$bbcodes = array(
			'[b]', '[/b]', '[u]', '[/u]', '[i]', '[/i]', "\n", "\r",
			'[ul]', '[/ul]', '[li]', '[/li]', '[code]', '[/code]', /*'<', '>',*/ '[quote]', '[/quote]'
		);

		$htmltags = array(
			'<strong>', '</strong>', '<span class="underline">', '</span>', '<em>', '</em>', '<br/>', '',
			'<ul>', '</ul>', '<li>', '</li>', '<code>', '</code>', /*'&gt;', '&lt;',*/ '<blockquote>', '</blockquote>'
		);

		$inpStr = str_replace(array('<', '>'), array('&lt;', '&gt;'), $inpStr);

		$inpStr = str_replace($bbcodes, $htmltags, $inpStr);
		// Handle [item] tag
		$matches = array();
		if (preg_match_all('/\[item\=(.+?)\/]/x', $inpStr, $matches))
		{
			$items = array();
			$item_matches = array();
			foreach ($matches[1] as $i => $item_id)
			{
				$item_id = intval(str_replace('"', '', $item_id));
				$items[] = $item_id;
				$item_matches[$item_id] = $i;
			}

			if ($items)
			{
				$items_data = $this->c('Item')->getItemsInfo($items, true);
				if ($items_data)
				{
					$icons_server = $this->c('Config')->getValue('site.icons_server');
					foreach ($items_data as &$item)
					{
						if (isset($item_matches[$item['entry']]) && isset($matches[0][$item_matches[$item['entry']]]))
						{
							// Replace [item] bbcodes text to html
							$inpStr = str_replace($matches[0][$item_matches[$item['entry']]], '<a href="' . $this->getWowUrl('item/' . $item['entry']) . '" class="bml-link-item color-q' . $item['Quality'] . '"><span class="icon-frame frame-10"><img height="10" width="10" src="' . $icons_server . '/18/' . $item['icon'] . '.jpg" alt=""/></span>' . $item['name'] . '</a>', $inpStr);
						}
					}
				}
			}
		}

		$matches = array();
		// Handle [quote=""] tag
		if (preg_match_all('/\[quote\=\"(.+?)\"]/x', $inpStr, $matches))
		{
			$posts = array();
			foreach ($matches[1] as $postId)
				$posts[] = $postId;

			$posts_data = $this->getPostData($posts);
			$d = array();
			if ($posts_data)
			{
				$replaceText = '';
				foreach ($posts_data as &$post)
				{
					$replaceText = '<blockquote data-quote="' . $post['post_id'] . '" class="quote-';
					$name = $post['name'];

					if ($post['blizzpost'])
					{
						$replaceText .= 'blizzard';
						if ($post['blizz_name'])
							$name = $post['blizz_name'];
					}
					elseif ($post['group_mask'] & ADMIN_GROUP_MVP)
						$replaceText .= 'mvp';
					elseif ($post['group_mask'] & ADMIN_GROUP_EXTRA_FORUM_COLOR)
						$replaceText .= $post['group_style'];
					else
						$replaceText .= 'public';

					$replaceText .= '"><div><span class="bml-quote-date">' . date('d/m/Y H:i', $post['post_date']) . '</span>';
					
					$page = (ceil($post['post_num'] / self::POSTS_PER_PAGE));
					$replaceText .= $this->c('Locale')->getString('template_forum_post_quote') . ' <a href="' . $post['thread_id'] . ($page > 0 ? '?page=' . $page : '') . '#' . $post['post_num'] . '">' . $name . '</a></div>';
					$d[] = array(
						'replaceId' => $post['post_id'],
						'replaceText' => $replaceText
					);
				}

				if ($d)
					foreach ($d as $t)
						$inpStr = str_replace('[quote="' . $t['replaceId'] . '"]', $t['replaceText'], $inpStr);
			}
		}

		// Handle [img] and [url] tags

		$inpStr = preg_replace('/\[url\=(.+?)\](.+?)\[\/url\]/six', '<a href="$1" target="_blank">$2</a>', $inpStr);
		$inpStr = preg_replace('/\[img](.+?)\[\/img\]/six', '<img src="$1" />', $inpStr);

		return $this;
	}

	public function getPostData($post_id)
	{
		$q = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->addModel('WowUserCharacters')
			->addModel('WowAccounts')
			->addModel('WowUserGroups')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_guid', 'guid')
			->join('left', 'WowUserCharacters', 'WowForumPosts', 'character_realm', 'realmId')
			->join('left', 'WowAccounts', 'WowUserCharacters', 'account', 'game_id')
			->join('left', 'WowUserGroups', 'WowAccounts', 'group_id', 'group_id');
		if (is_array($post_id))
			return $q->fieldCondition('wow_forum_posts.post_id', $post_id)->keyIndex('post_id')->loadItems();
		else
			return $q->fieldCondition('wow_forum_posts.post_id', ' = ' . $post_id)->loadItem();
	}

	public function createTopic($categoryId, $topicData)
	{
		if (!$this->c('AccountManager')->isLoggedIn())
		{
			$this->c('Log')->writeDebug('%s : anonymous user tried to create thread in category #%d', __METHOD__, $categoryId);
			return $this->core->redirectUrl('account-status');
		}

		if (!$categoryId || !$topicData)
			return $this;

		if (!$this->c('AccountManager')->isAllowedToForums())
			return $this->core->redirectUrl('account-status');

		$rq_fields = array('xstoken' => 'notNull', 'sessionPersist' => 'forum.topic.form', 'detail' => 'notNull', 'subject' => 'notNull');

		foreach ($rq_fields as $field => $value)
			if (!isset($topicData[$field]) || ($value == 'notNull' && !$topicData[$field]) || ($value != 'notNull' && $topicData[$field] != $value))
				return $this;

		$flag_fields = array('blizzard' => THREAD_FLAG_BLIZZARD, 'pinned' => THREAD_FLAG_PINNED, 'closed' => THREAD_FLAG_CLOSED, 'featured' => THREAD_FLAG_FEATURED);
		$flags = 0;
		$isGm = $this->c('AccountManager')->isAllowedToModerate();
		$blizzName = $this->c('AccountManager')->getForumsName();
		if ($isGm)
		{
			$flags = THREAD_FLAG_BLIZZ_ANSWERED;
			foreach ($flag_fields as $flag => $value)
				if (isset($_POST[$flag]))
					$flags |= $value;

			if (isset($_POST['blizz_name']) && $_POST['blizz_name'])
				$blizzName = $_POST['blizz_name'];
		}

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowForumThreads')
			->setType('insert');

		// Create topic
		$create_time = time();

		$edt->cat_id = $categoryId;
		$edt->account_id = $this->c('AccountManager')->user('id');
		$edt->character_guid = $this->c('AccountManager')->charInfo('guid');
		$edt->character_realm = $this->c('AccountManager')->charInfo('realmId');
		$edt->title = $topicData['subject'];
		$edt->views = 0;
		$edt->posts = 0;
		$edt->flags = $flags;
		$edt->last_update = $create_time;
		$edt->last_poster = $isGm ? $this->c('AccountManager')->getForumsName() : $this->c('AccountManager')->charInfo('name');
		$edt->last_poster_type = $isGm ? 1 : 0;
		$edt->last_poster_anchor = 1;
		if ($isGm)
		{
			$edt->blizz_posts = '1 ';
		}
		$topicId = $edt->save()->getInsertId();

		$edt->clearValues();

		$edt->setModel('WowForumPosts')
			->setType('insert');

		$edt->thread_id = $topicId;
		$edt->cat_id = $categoryId;
		$edt->account_id = $this->c('AccountManager')->user('id');
		$edt->character_guid = $this->c('AccountManager')->charInfo('guid');
		$edt->character_realm = $this->c('AccountManager')->charInfo('realmId');
		$edt->blizzpost = $this->c('AccountManager')->isAllowedToModerate() ? 1 : 0;
		$edt->blizz_name = $blizzName;
		$edt->message = $topicData['detail'];
		$edt->post_date = $create_time;
		$edt->author_ip = $_SERVER['REMOTE_ADDR'];
		$edt->post_num = 1;
		$edt->edit_date = 0;
		$edt->deleted = 0;

		$edt->save()->clearValues();
		unset($edt);

		$this->core->redirectUrl('forum/topic/' . $topicId . '#1');

		return $this;
	}

	public function createPost($topicId, $postData)
	{
		if (!$this->c('AccountManager')->isLoggedIn())
		{
			$this->c('Log')->writeDebug('%s : anonymous user tried to create post in thread #%d', __METHOD__, $topicId);
			return $this->core->redirectUrl('account-status');
		}

		if (!$topicId || !$postData)
		{
			$this->c('Log')->writeDebug('%s : user %d (%s) tried to write in topic #%d but there\'s no topicId or postData provided', __METHOD__, $this->c('AccountManager')->user('id'), $this->c('AccountManager')->user('username'), $topicId);
			return $this;
		}

		if (!$this->c('AccountManager')->isAllowedToForums())
		{
			$this->c('Log')->writeDebug('%s : user %d (%s) tried to write in topic #%d without permission to perform this action', __METHOD__, $this->c('AccountManager')->user('id'), $this->c('AccountManager')->user('username'), $topicId);
			return $this->core->redirectUrl('account-status');
		}

		$rq_fields = array('xstoken' => 'notNull', 'sessionPersist' => 'forum.topic.post', 'detail' => 'notNull');

		foreach ($rq_fields as $field => $value)
			if (!isset($postData[$field]) || ($value == 'notNull' && !$postData[$field]) || ($value != 'notNull' && $postData[$field] != $value))
				return $this;

		$lastPost = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->fieldCondition('thread_id', ' = ' . $topicId)
			->order(array('WowForumPosts' => array('post_num')), 'DESC')
			->loadItem();

		if (!$lastPost)
			return $this;

		$char = $this->c('AccountManager')->getActiveCharacter();

		if (!$char)
		{
			$this->c('Log')->writeDebug('%s : user %d (%s) tried to write in topic #%d without any character on account', __METHOD__, $this->c('AccountManager')->user('id'), $this->c('AccountManager')->user('username'), $topicId);
			return $this;
		}

		$topic_data = $this->c('QueryResult', 'Db')
			->model('WowForumThreads')
			->fields(array('WowForumThreads' => array('flags')))
			->setItemId($topicId)
			->loadItem();

		if ($topic_data['flags'] & THREAD_FLAG_CLOSED && !$this->c('AccountManager')->isAllowedToModerate())
		{
			$this->c('Log')->writeDebug('%s : user %d (%s) tried to write into closed theme (%d) without moderate rights', __METHOD__, $this->c('AccountManager')->user('id'), $this->c('AccountManager')->user('username'), $topicId);
			return $this;
		}

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowForumPosts')
			->setType('insert');

		$isGm = $this->c('AccountManager')->isAllowedToModerate();

		$isBluePost = false;

		if (isset($_POST['bluepost']) && $_POST['bluepost'] == 1 && $isGm)
			$isBluePost = true;

		$edt->thread_id = $topicId;
		$edt->cat_id = $lastPost['cat_id'];
		$edt->account_id = $this->c('AccountManager')->user('id');
		$edt->character_guid = $char['guid'];
		$edt->character_realm = $char['realmId'];
		$edt->blizzpost = $isBluePost ? 1 : 0;
		$edt->blizz_name = $isBluePost ? $this->c('AccountManager')->getForumsName() : '';
		$edt->message = $postData['detail'];
		$edt->post_date = time();
		$edt->author_ip = $_SERVER['REMOTE_ADDR'];
		$edt->post_num = $lastPost['post_num'] + 1;
		$edt->edit_date = 0;
		$edt->deleted = 0;

		$post_id = $edt->save()->getInsertId();
		$edt->clearValues();

		// Set thread's last update time
		$edt->clearValues()
			->setModel('WowForumThreads')
			->setType('update')
			->setId($lastPost['thread_id'])
			->load();
		$edt->posts = $edt->posts + 1;
		$edt->last_update = time();
		$edt->last_poster = $isGm ? $this->c('AccountManager')->getForumsName() : $this->c('AccountManager')->charInfo('name');
		$edt->last_poster_type = $isGm ? 1 : 0;
		$edt->last_poster_anchor = $lastPost['post_num'] + 1;

		if ($isBluePost)
		{
			if (!($edt->flags & THREAD_FLAG_BLIZZ_ANSWERED))
				$edt->flags |= THREAD_FLAG_BLIZZ_ANSWERED;
			$edt->blizz_posts = $edt->blizz_posts . ' ' . ($lastPost['post_num'] + 1);
		}

		$edt->save()->clearValues();

		unset($edt);

		return $this;
	}

	public function editTopic()
	{
		$isGm = $this->c('AccountManager')->isAllowedToModerate();
		$threadId = (int) $this->core->getUrlAction(3);

		if (!$isGm || !$threadId)
			return $this->core->redirectUrl();

		if (!$this->c('AccountManager')->isAllowedToForums())
			return $this->core->redirectUrl('account-status');

		$catId = 0;

		if (isset($_POST['cat_id']) && $_POST['cat_id'] > 0)
			$catId = (int) $_POST['cat_id'];


		$flag_fields = array('blizzard' => THREAD_FLAG_BLIZZARD, 'pinned' => THREAD_FLAG_PINNED, 'closed' => THREAD_FLAG_CLOSED, 'featured' => THREAD_FLAG_FEATURED);
		$flags = 0;
		$blizzName = $this->c('AccountManager')->getForumsName();
		$flags = THREAD_FLAG_BLIZZ_ANSWERED;

		foreach ($flag_fields as $flag => $value)
			if (isset($_POST[$flag]))
				$flags |= $value;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowForumThreads')
			->setType('update')
			->setId($threadId)
			->load();

		$edt->flags = $flags;

		if ($catId > 0)
			$edt->cat_id = $catId;

		$edt->save()->clearValues();

		return $this->core->redirectUrl('forum/topic/' . $threadId);
	}

	public function editPost($postId, $postData)
	{
		if (!$postId || !$postData)
			return $this;

		if (!$this->c('AccountManager')->isAllowedToForums())
			return $this->core->redirectUrl('account-status');

		$rq_fields = array('xstoken' => 'notNull', 'sessionPersist' => 'forum.topic.post.edit', 'detail' => 'notNull');

		foreach ($rq_fields as $field => $value)
			if (!isset($postData[$field]) || ($value == 'notNull' && !$postData[$field]) || ($value != 'notNull' && $postData[$field] != $value))
				return $this;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowForumPosts')
			->setType('update')
			->setId($postId)
			->load();

		$thId = $edt->thread_id;

		$edt->message = $postData['detail'];
		if ($this->c('AccountManager')->isAllowedToModerate())
			$edt->post_editor = $this->c('AccountManager')->getForumsName();
		else
			$edt->post_editor = $this->c('AccountManager')->charInfo('name');

		$edt->edit_date = time();
		$edt->save()->clearValues();
		unset($edt);

		$this->core->redirectUrl('forum/topic/' . $thId);

		return $this;
	}

	public function deletePost($postId)
	{
		if (!$this->c('AccountManager')->isLoggedIn())
			return array();

		$post = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->addModel('WowForumThreads')
			->join('left', 'WowForumThreads', 'WowForumPosts', 'thread_id', 'thread_id')
			->fieldCondition('wow_forum_posts.post_id', ' = ' . $postId)
			->loadItem();

		if (!$post || ($post['account_id'] != $this->c('AccountManager')->user('id') && !($this->c('AccountManager')->isAllowedToModerate())))
			return array();

		$data = array(
			'forumId' => (int) $post['cat_id'],
			'status' => 'postDeleted',
			'topicId' => (int) $post['thread_id'],
			'postId' => (int) $postId,
			'anchor' => (int) $post['post_num'],
			'page' => 1
		);

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowForumPosts')
			->setType('update')
			->setId($postId)
			->load();

		$edt->deleted = 1;
		if ($edt->post_num == 1)
		{
			// Deleting first post causes deleting whole thread.
			$edt->save()->clearValues();
			$this->deleteTopic($post['thread_id']);
		}
		else
			$edt->save()->clearValues();

		// Remove from blizztracker
		$this->c('Editing')
			->clearValues()
			->setModel('WowBlizztrackerPosts')
			->setId($postId)
			->delete()
			->clearValues();

		return $data;
	}

	public function deleteTopic($topicId)
	{
		if (!$this->c('AccountManager')->isAllowedToModerate() || !$topicId)
		{
			$this->c('Log')->writeDebug('%s : unable to delete thread %d (gm: %d)!', __METHOD__, $topicId, $this->c('AccountManager')->user('gmlevel'));
			return false;
		}

		$this->c('Editing')
			->clearValues()
			->setModel('WowForumThreads')
			->setId($topicId)
			->delete()
			->clearValues();

		$this->c('Db')->wow()->query("UPDATE `wow_forum_posts` SET `deleted` = 1 WHERE `thread_id` = %d", $topicId);
		
		return true;
	}

	public function togglePinnedTopic($topicId)
	{
		if (!$topicId)
			return $this;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowForumThreads')
			->setType('update')
			->setId($topicId)
			->load();

		if ($edt->flags & THREAD_FLAG_PINNED)
			$edt->flags = $edt->flags - THREAD_FLAG_PINNED;
		else
			$edt->flags |= THREAD_FLAG_PINNED;

		$edt->save()->clearValues();

		$this->core->redirectUrl('forum/topic/' . $topicId);

		return $this;
	}

	public function toggleClosedTopic($topicId)
	{
		if (!$topicId)
			return $this;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowForumThreads')
			->setType('update')
			->setId($topicId)
			->load();

		if ($edt->flags & THREAD_FLAG_CLOSED)
			$edt->flags = $edt->flags - THREAD_FLAG_CLOSED;
		else
			$edt->flags |= THREAD_FLAG_CLOSED;

		$edt->save()->clearValues();

		$this->core->redirectUrl('forum/topic/' . $topicId);

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

	public function getSidebarData()
	{
		$topics = $this->c('QueryResult', 'Db')
			->model('WowForumThreads')
			->fields(array('WowForumThreads' => array('thread_id', 'title', 'cat_id', 'posts', 'last_update')))
			->order(array('WowForumThreads' => array('posts')), 'desc')
			->limit(10)
			->keyIndex('thread_id')
			->loadItems();

		if (!$topics)
			return false;

		$cats = array();
		foreach ($topics as $t)
			$cats[] = $t['cat_id'];

		$categories = $this->c('QueryResult', 'Db')
			->model('WowForumCategory')
			->fieldCondition('cat_id', $cats)
			->loadItems();

		if ($categories)
		{
			foreach ($categories as $cat)
			{
				foreach ($topics as &$topic)
				{
					if ($topic['cat_id'] == $cat['cat_id'])
						$topic['catTitle'] = $cat['title'];
				}
			}
		}

		return $topics;
	}

	public function getCategoriesToMove()
	{
		return $this->c('QueryResult', 'Db')
			->model('WowForumCategory')
			->fields(array('WowForumCategory' => array('cat_id', 'title_' . $this->c('Locale')->GetLocale())))
			->fieldCondition('parent_cat', ' > 0')
			->loadItems();
	}

	public function getBlizztrackerPreviewMessages($full = false)
	{
		// Limit is 15
		$offset = 0;

		if ($full && isset($_GET['page']))
			$offset = ((int) $_GET['page']) - 1;

		$posts = $this->c('QueryResult', 'Db')
			->model('WowBlizztrackerPosts')
			->addModel('WowForumPosts')
			->addModel('WowForumThreads')
			->addModel('WowForumCategory')
			->join('left', 'WowForumPosts', 'WowBlizztrackerPosts', 'tracker_post_id', 'post_id')
			->join('left', 'WowForumThreads', 'WowForumPosts', 'thread_id', 'thread_id')
			->join('left', 'WowForumCategory', 'WowForumThreads', 'cat_id', 'cat_id')
			->fieldCondition('wow_forum_posts.blizzpost', ' = 1', 'AND')
			->fieldCondition('wow_forum_posts.deleted', ' = 0', 'AND')
			->order(array('WowForumPosts' => array('post_date')), 'desc')
			->limit(15, $offset)
			->setAlias('WowForumCategory', 'title_' . $this->c('Locale')->GetLocale(), 'catTitle')
			->loadItems();

		if (!$posts)
			return false;

		if ($full)
		{
			$posts_count = $this->c('QueryResult', 'Db')
				->model('WowBlizztrackerPosts')
				->runFunction('COUNT', 'tracker_post_id')
				->loadItem();

			$posts_count = $posts_count['tracker_post_id'];
		}

		$posts_data = array();
		$idx = 0;
		$count = 0;

		$maxLength = $full ? 401 : 115;
		foreach ($posts as &$p)
		{
			$p['page'] = $this->getPageForAnchor($p['post_num']);

			$this->handleBbCodes($p['message']);
			$p['message'] = strip_tags($p['message']);

			if (mb_strlen($p['message']) > $maxLength)
				$p['message'] = mb_substr($p['message'], 0, $maxLength) . '…';

			if (!$full)
			{
				if ($count > 2)
				{
					++$idx;
					$count = 0;
				}
	
				++$count;

				$posts_data[$idx][] = $p;
			}
		}

		if ($full)
			return array('posts' => $posts, 'count' => $posts_count);

		return $posts_data;
	}

	public function addPostToTracker($post_id)
	{
		if (!$this->c('AccountManager')->isAllowedToModerate())
			return $this->core->redirectUrl('forum/');

		$post = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->fields(array('WowForumPosts' => array('blizzpost', 'thread_id')))
			->setItemId($post_id)
			->loadItem();

		if (!$post)
			return $this->core->redirectUrl('forum/');

		if ($post['blizzpost'] == 0)
			return $this->core->redirectUrl('forum/topic/' . $post['thread_id']);

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowBlizztrackerPosts')
			->setType('insert');

		$edt->tracker_post_id = $post_id;
		$edt->save()->clearValues();

		return $this->core->redirectUrl('forum/topic/' . $post['thread_id']);
	}

	public function removePostFromTracker($post_id)
	{
		if (!$this->c('AccountManager')->isAllowedToModerate())
			return $this->core->redirectUrl('forum/');

		$this->c('Editing')
			->clearValues()
			->setModel('WowBlizztrackerPosts')
			->setId($post_id)
			->delete()
			->clearValues();

		$post = $this->c('QueryResult', 'Db')
			->model('WowForumPosts')
			->fields(array('WowForumPosts' => array('thread_id')))
			->setItemId($post_id)
			->loadItem();

		if (!$post)
			return $this->core->redirectUrl('forum/');

		return $this->core->redirectUrl('forum/topic/' . $post['thread_id']);
	}

	public function getBan()
	{
		if (!$this->c('AccountManager')->isAllowedToModerate())
			return $this->core->redirectUrl('forum/');

		$account_id = intval($this->core->getUrlAction(3));

		if (!$account_id)
			return $this->core->redirectUrl('forum/');

		$user = $this->c('QueryResult', 'Db')
			->model('Account')
			->setItemId($account_id)
			->loadItem();

		if (!$user)
			return $this->core->redirectUrl('forum/');

		$admin = $this->c('QueryResult', 'Db')
			->model('WowAccounts')
			->setItemId($account_id)
			->loadItem();

		if ($admin)
			return $this->core->redirectUrl('forum/');

		return $user;
	}

	public function addBan()
	{
		if (!$this->c('AccountManager')->isAllowedToModerate() || !isset($_POST['ban']))
			return $this->core->redirectUrl('forum/');

		$account_id = intval($this->core->getUrlAction(3));

		if (!$account_id)
			return $this->core->redirectUrl('forum/');

		$str = $_POST['ban']['day'] . '.' . $_POST['ban']['month'] . '.' . $_POST['ban']['year'] . ' ' . date('H:i:s');

		$stamp = strtotime($str);

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('AccountBanned')
			->setType('insert');

		$edt->id = $account_id;
		$edt->bandate = time();
		$edt->unbandate = $stamp;
		$edt->bannedby = $this->c('AccountManager')->user('id');
		$edt->banreason = $_POST['ban']['reason'];
		$edt->active = 1;
		$edt->save()->clearValues();

		if (isset($_POST['ban']['posts']))
			$this->c('Db')->wow()->query("UPDATE wow_forum_posts SET deleted = 1 WHERE account_id = %d", $account_id);

		return $this->core->redirectUrl('forum/');
	}
}
?>