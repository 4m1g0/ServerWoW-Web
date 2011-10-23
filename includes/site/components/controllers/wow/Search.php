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

class Search_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_query = '';
	protected $m_searchType = array('type' => 'summary', 'block' => 'summary');

	protected function checkInfo()
	{
		$types = array(
			'wowarenateam' => 'arenaTeams',
			'article' => 'articles',
			'wowcharacter' => 'characters',
			'post' => 'posts',
			'static' => 'contents',
			'wowguild' => 'guilds',
			'wowitem' => 'items'
		);

		if (isset($_GET['q']))
			$this->m_query = $_GET['q'];

		if (isset($_GET['f']) && isset($types[$_GET['f']]))
			$this->m_searchType = array('type' => $_GET['f'], 'block' => $types[$_GET['f']]);

		return true;
	}

	protected function setBreadcrumb()
	{
		$this->m_breadcrumb = array(
			array(
				'link' => '',
				'caption' => 'World of Warcraft'
			),
			array(
				'link' => 'search',
				'locale_index' => 'template_search'
			)
		);

		return $this;
	}

	public function build($core)
	{
		$this->checkInfo();

		if (!$this->m_query || mb_strlen($this->m_query) < 2)
			$this->buildBlock('empty');
		else
		{
			if ($this->c('Search')
			->setSearchType((isset($this->m_searchType['type']) ? $this->m_searchType['type'] : 'summary'))
			->setQuery($this->m_query)
			->performSearch()
			->isAnyResults())
			{
				$this->buildBlocks(array('pagination', 'results_' . $this->c('Search')->getSearchType(), 'summary'));
			}
			else
				$this->buildBlock('empty');
		}

		$this->buildBreadcrumb();

		return $this;
	}

	protected function block_summary()
	{
		return $this->block()
			->setTemplate('summary', 'wow' . DS . 'contents' . DS . 'search')
			->setVar('search', $this->c('Search'))
			->setRegion('pagecontent');
	}

	protected function block_results_summary()
	{
		return $this->block()
			->setTemplate('results_summary', 'wow' . DS . 'contents' . DS . 'search')
			->setVar('search', $this->c('Search'))
			->setRegion('searchResults');
	}

	protected function block_results_wowitem()
	{
		return $this->block()
			->setTemplate('results_wowitem', 'wow' . DS . 'contents' . DS . 'search')
			->setVar('search', $this->c('Search'))
			->setRegion('searchResults');
	}

	protected function block_results_wowcharacter()
	{
		return $this->block()
			->setTemplate('results_wowcharacter', 'wow' . DS . 'contents' . DS . 'search')
			->setVar('search', $this->c('Search'))
			->setRegion('searchResults');
	}

	protected function block_results_wowarenateam()
	{
		return $this->block()
			->setTemplate('results_wowarenateam', 'wow' . DS . 'contents' . DS . 'search')
			->setVar('search', $this->c('Search'))
			->setRegion('searchResults');
	}

	protected function block_results_post()
	{
		return $this->block()
			->setTemplate('results_post', 'wow' . DS . 'contents' . DS . 'search')
			->setVar('search', $this->c('Search'))
			->setRegion('searchResults');
	}

	protected function block_results_wowguild()
	{
		return $this->block()
			->setTemplate('results_wowguild', 'wow' . DS . 'contents' . DS . 'search')
			->setVar('search', $this->c('Search'))
			->setRegion('searchResults');
	}

	protected function block_pagination()
	{
		return $this->block()
			->setTemplate('pagination', 'wow' . DS . 'blocks')
			->setRegion('pagination')
			->setVar('pagination', $this->c('Pager')->generatePagination(
					'/' . $this->core->getRawUrl(),
					$this->c('Search')->getCounters($this->m_searchType['type']),
					20,
					$this->c('Search')->getPage() * 20,
					'q=' . $this->m_query . '&amp;f=' . $this->m_searchType['type'] . '&amp;'
				)
			)
			->setVar('pager', $this->c('Search')->getDisplayLimits());
	}

	protected function block_empty()
	{
		return $this->block()
			->setTemplate('empty', 'wow' . DS . 'contents' . DS . 'search')
			->setVar('search', $this->c('Search'))
			->setRegion('pagecontent');
	}
}
?>