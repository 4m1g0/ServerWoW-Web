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

	protected function checkInfo()
	{
		$this->m_categoryId = $this->core->getUrlAction(2);
		$this->m_topicId = $this->core->getUrlAction(3);

		if (is_string($this->m_categoryId) && strtolower($this->m_categoryId) == 'topic' && $this->m_topicId > 0)
			$this->m_categoryId = 0;

		return $this;
	}

	public function build()
	{
		$this->checkInfo()
			->c('Forum')
			->initForums($this->m_categoryId, $this->m_topicId);

		switch ($this->c('Forum')->getType())
		{
			case FORUM_TYPE_CATEGORY:
				$this->m_pagerLimits = $this->c('Forum')->getTopicsInCategoryCount();
				$this->buildBlocks(array('pager', 'category'));
				break;
			case FORUM_TYPE_TOPIC:
				$this->m_pagerLimits = $this->c('Forum')->getPostsInTopicCount();
				$this->buildBlocks(array('pager', 'topic'));
				break;
			case FORUM_TYPE_INDEX:
			default:
				$this->buildBlock('main');
				break;
		}

		return $this;
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
}
?>