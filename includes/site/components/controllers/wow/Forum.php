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

class Forum_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_menuIndex = 'forums';
	protected $m_categoryId = 0;
	protected $m_topicId = 0;
	protected $m_pagerLimits = 0;
	protected $m_postPreview = array();
	protected $m_postData = array();
	protected $m_isEditing = false;
	protected $m_isThreadEditing = false;
	protected $m_isBlizztracker = false;
	protected $m_btPosts = array();

	protected function checkInfo()
	{
		$this->m_categoryId = $this->core->getUrlAction(2);
		$this->m_topicId = $this->core->getUrlAction(3);

		if (is_string($this->m_categoryId) && strtolower($this->m_categoryId) == 'topic' && $this->m_topicId > 0)
			$this->m_categoryId = 0;

		if (isset($_POST['xstoken']) && isset($_POST['sessionPersist']) && isset($_POST['detail']) && $this->c('AccountManager')->isLoggedIn())
		{
			switch (strtolower($_POST['sessionPersist']))
			{
				case 'forum.topic.post':
					$this->c('Forum')->createPost($this->m_topicId, array('xstoken' => $_POST['xstoken'], 'sessionPersist' => $_POST['sessionPersist'], 'detail' => $_POST['detail']));
					break;
				case 'forum.topic.post.edit':
					$this->c('Forum')->editPost((int)$this->core->getUrlAction(4), array('xstoken' => $_POST['xstoken'], 'sessionPersist' => $_POST['sessionPersist'], 'detail' => $_POST['detail']));
					break;
				case 'forum.topic.form':
					$this->c('Forum')->createTopic((int)$this->core->getUrlAction(2), array('xstoken' => $_POST['xstoken'], 'sessionPersist' => $_POST['sessionPersist'], 'detail' => $_POST['detail'], 'subject' => $_POST['subject']));
					break;
			}
		}

		return $this;
	}

	protected function setBreadcrumb()
	{
		if ($this->m_isBlizztracker)
		{
			$this->m_breadcrumb = array(
				array(
					'link' => '',
					'caption' => 'World of Warcraft'
				),
				array(
					'link' => 'forum/',
					'locale_index' => 'template_menu_forums'
				),
				array(
					'link' => 'forum/blizztracker',
					'locale_index' => 'template_blizztracker_title'
				)
			);

			return $this;
		}

		switch ($this->c('Forum')->getType())
		{
			case FORUM_TYPE_TOPIC:
				$this->m_breadcrumb = array(
					array(
						'link' => '',
						'caption' => 'World of Warcraft'
					),
					array(
						'link' => 'forum/',
						'locale_index' => 'template_menu_forums'
					),
					array(
						'link' => 'forum/#forum' . $this->c('Forum')->getTopicRootCategoryId(),
						'caption' => $this->c('Forum')->getTopicRootCategoryTitle()
					),
					array(
						'link' => 'forum/' . $this->c('Forum')->getTopicCategoryId(),
						'caption' => $this->c('Forum')->getTopicCategoryTitle()
					),
					array(
						'link' => 'forum/topic/' . $this->c('Forum')->getTopicId(),
						'caption' => $this->c('Forum')->getTopicTitle()
					)
				);
				break;
			case FORUM_TYPE_CATEGORY:
				$this->m_breadcrumb = array(
					array(
						'link' => '',
						'caption' => 'World of Warcraft'
					),
					array(
						'link' => 'forum/',
						'locale_index' => 'template_menu_forums'
					),
					array(
						'link' => 'forum/#forum' . $this->c('Forum')->getCategoryRootId(),
						'caption' => $this->c('Forum')->getCategoryRootTitle()
					),
					array(
						'link' => 'forum/' . $this->c('Forum')->getCategoryId(),
						'caption' => $this->c('Forum')->getCategoryTitle()
					)
				);
				break;
		}

		return $this;
	}

	public function build($core)
	{
		$allowDefaultBuild = true;

		$this->checkInfo();

		if (strtolower($core->getUrlAction(2)) == 'topic')
		{
			switch (strtolower($core->getUrlAction(3)))
			{
				case 'post':
					if (strtolower($core->getUrlAction(4)) == 'preview')
					{
						$post_msg = $_POST['post'];
						$this->c('Forum')->handleBbCodes($post_msg);
						$post = array('detail' => $post_msg);
						$this->ajaxPage();
						define('AJAX_PAGE', true);
						$this->m_postPreview = $post;
						$this->buildBlock('preview');
						$allowDefaultBuild = false;
					}
					elseif (is_numeric($core->getUrlAction(4)))
					{
						$post_id = (int) $core->getUrlAction(4);
						$allowDefaultBuild = true;
						switch (strtolower($core->getUrlAction(5)))
						{
							case 'edit':
								$this->m_postData = $this->c('Forum')->getPostData($post_id);
								$this->m_isEditing = true;
								$this->buildBlocks(array('charactersList', 'post'));
								break;
							case 'delete':
								$this->ajaxPage();
								define('AJAX_PAGE', true);
								$this->buildBlock('delete');
								break;
							case 'frag':
								$this->ajaxPage();
								define('AJAX_PAGE', true);
								$this->m_postData = $this->c('Forum')->getPostData($post_id);
								$this->buildBlock('frag');
								break;
							case 'track':
								$this->c('Forum')->addPostToTracker($post_id);
								break;
							case 'untrack':
								$this->c('Forum')->removePostFromTracker($post_id);
								break;
							default:
								$allowDefaultBuild = true;
								break;
						}
					}
					break;
			}
		}
		elseif (strtolower($core->getUrlAction(2)) == 'blizztracker')
		{
			$allowDefaultBuild = false;
			$this->m_isBlizztracker = true;
			$posts = $this->c('Forum')->getBlizztrackerPreviewMessages(true);
			$this->m_pagerLimits = $posts['count'];
			$this->m_btPosts = $posts['posts'];
			$this->buildBlocks(array('tracker', 'pagination_bt'));
			$this->buildBreadcrumb();
		}
		elseif (strtolower($core->getUrlAction(3)) == 'topic' && $this->c('AccountManager')->isAllowedToForums())
		{
			$category_id = (int) $core->getUrlAction(2);
			$this->m_isEditing = false;
			$this->buildBlocks(array('charactersList', 'post'));
			$allowDefaultBuild = false;
		}
		elseif (strtolower($core->getUrlAction(2)) == 'ban' && $core->getUrlAction(3) > 0 && $this->c('AccountManager')->isAllowedToModerate())
		{
			if (isset($_POST['ban']))
				$this->c('Forum')->addBan();

			$account_id = intval($core->getUrlAction(3));
			$this->buildBlock('ban');
			$allowDefaultBuild = false;
		}

		if ($allowDefaultBuild)
		{
			$this->c('Forum')
				->initForums($this->m_categoryId, $this->m_topicId);

			switch ($this->c('Forum')->getType())
			{
				case FORUM_TYPE_CATEGORY:
					$this->m_pagerLimits = $this->c('Forum')->getTopicsInCategoryCount();
					$this->buildBlock('category');
					$this->m_pageTitle = $this->c('Forum')->getCategoryTitle();
					break;
				case FORUM_TYPE_TOPIC:
					$this->m_pagerLimits = $this->c('Forum')->getPostsInTopicCount();
					$useDefault = false;
					if ($this->c('AccountManager')->user('gmlevel') > 0)
					{
						switch ($core->getUrlAction(4))
						{
							case 'edit':
								if (isset($_POST['xstoken']))
									$this->c('Forum')->editTopic();
								else
								{
									$this->m_isThreadEditing = true;
									$this->buildBlocks(array('pagination', 'charactersList', 'post'));
								}
								break;
							case 'lock':
							case 'unlock':
								$this->c('Forum')->toggleClosedTopic($this->m_topicId);
								break;
							case 'sticky':
							case 'unsticky':
								$this->c('Forum')->togglePinnedTopic($this->m_topicId);
								break;
							default:
								$this->buildBlocks(array('pagination', 'charactersList', 'topic'));
								break;
						}
					}
					else
						$this->buildBlocks(array('pagination', 'charactersList', 'topic'));
					$this->m_pageTitle = $this->c('Forum')->getTopicTitle();
					break;
				case FORUM_TYPE_INDEX:
				default:
					$this->buildBlock('main');
					break;
			}
			$this->buildBreadcrumb();
		}

		return $this;
	}

	protected function block_ban()
	{
		return $this->block()
			->setTemplate('ban', 'wow' . DS . 'contents' . DS . 'forum')
			->setRegion('pagecontent');
	}

	protected function block_pagination_bt()
	{
		return $this->block()
			->setVar('pagination', $this->c('Pager')->generatePagination(
				'/' . $this->core->getRawUrl(),
				$this->m_pagerLimits,
				15,
				$this->c('Forum')->getPage(false) * 15
				)
			)
			->setVar('onlyPagination', true)
			->setTemplate('pagination', 'wow' . DS . 'blocks')
			->setRegion('pagination');
	}

	protected function block_tracker()
	{
		return $this->block()
			->setVar('posts', $this->m_btPosts)
			->setTemplate('blizztracker', 'wow' . DS . 'contents' . DS . 'forum')
			->setRegion('pagecontent');
	}

	protected function block_post()
	{
		$block = $this->block()
			->setTemplate('editpost', 'wow' . DS . 'contents' . DS . 'forum')
			->setRegion('pagecontent')
			->setVar('post', $this->m_postData)
			->setVar('editing', $this->m_isEditing)
			->setVar('topicEditing', $this->m_isThreadEditing);

		if ($this->m_isThreadEditing)
		{
			$block->setVar('categories', $this->c('Forum')->getCategoriesToMove())
				->setVar('topic', $this->c('Forum')->getTopicData());

			$posts = $this->c('Forum')->getTopicPosts(true);
			if ($posts)
				$block->setVar('post', $posts[0]);

			unset($posts);
		}

		return $block;
	}

	protected function block_preview()
	{
		return $this->block()
			->setVar('post', $this->m_postPreview)
			->setTemplate('preview', 'wow' . DS . 'contents' . DS . 'forum')
			->setRegion('wow_ajax');
	}

	protected function block_main()
	{
		return $this->block()
			->setVar('forum', $this->c('Forum'))
			->setTemplate('forum-index', 'wow' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_category()
	{
		return $this->block()
			->setVar('forum', $this->c('Forum'))
			->setVar('pagination', $this->c('Pager')->generatePagination(
				'/' . $this->core->getRawUrl(),
				$this->m_pagerLimits,
				$this->c('Forum')->getDisplayLimit(
					'topics'
				),
				$this->c('Forum')->getPage(false) * ($this->c('Forum')->getDisplayLimit(
					'topics'
				))
				)
			)
			->setTemplate('category', 'wow' . DS . 'contents' . DS . 'forum')
			->setRegion('pagecontent');
	}

	protected function block_topic()
	{
		return $this->block()
			->setVar('forum', $this->c('Forum'))
			->setTemplate('topic', 'wow' . DS . 'contents' . DS . 'forum')
			->setRegion('pagecontent');
	}

	protected function block_pager()
	{
		return $this->block()
			->setVar('pager', $this->c('Pager')->getPager(array('totalCount' => $this->m_pagerLimits, 'limit' => $this->c('Forum')->getDisplayLimit(($this->c('Forum')->getType() == FORUM_TYPE_CATEGORY ? 'topics' : 'posts')))))
			->setVar('onlyPaging', true)
			->setVar('pagerOptions', false)
			->setRegion('pager')
			->setTemplate('pager', 'wow' . DS . 'blocks');
	}

	protected function block_pagination()
	{
		return $this->block()
			->setVar('pagination', $this->c('Pager')->generatePagination(
				'/' . $this->core->getRawUrl(),
				$this->m_pagerLimits,
				$this->c('Forum')->getDisplayLimit(
					($this->c('Forum')->getType() == FORUM_TYPE_CATEGORY ? 'topics' : 'posts')
				),
				$this->c('Forum')->getPage(false) * ($this->c('Forum')->getDisplayLimit(
					($this->c('Forum')->getType() == FORUM_TYPE_CATEGORY ? 'topics' : 'posts')
				))
				)
			)
			->setVar('onlyPagination', true)
			->setTemplate('pagination', 'wow' . DS . 'blocks')
			->setRegion('pagination');
	}

	protected function block_frag()
	{
		return $this->block()
			->setVar('post', $this->m_postData)
			->setTemplate('frag', 'wow' . DS . 'contents' . DS . 'forum')
			->setRegion('wow_ajax');
	}

	protected function block_delete()
	{
		return $this->block()
			->setVar('post', $this->c('Forum')->deletePost(((int) $this->core->getUrlAction(4))))
			->setTemplate('delete', 'wow' . DS . 'contents' . DS . 'forum')
			->setRegion('wow_ajax');
	}
}
?>