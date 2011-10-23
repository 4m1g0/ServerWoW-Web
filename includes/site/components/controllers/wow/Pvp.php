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

class Pvp_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_menuIndex = 'game';
	protected $m_pageTitle = 'PvP';
	protected $m_ladderType = 0;

	protected function checkInfo()
	{
		switch ($this->core->getUrlAction(4))
		{
			case '2v2':
			case '3v3':
			case '5v5':
				$type = substr($this->core->getUrlAction(4), 0, 1);
				$this->m_pageTitle = $this->c('Locale')->format('template_pvp_ladder_format', $type, $type);
				$this->m_ladderType = (int) $type;
				break;
		}

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
				'link' => 'game/',
				'locale_index' => 'template_menu_game'
			),
			array(
				'link' => 'pvp/arena',
				'caption' => 'PvP'
			)
		);

		if (in_array($this->m_ladderType, array(2, 3, 5)))
			$this->m_breadcrumb[] = array(
				'link' => 'pvp/arena/' . $this->c('Config')->getValue('site.battlegroup') . '/' . $this->m_ladderType . 'v' . $this->m_ladderType,
				'caption' => $this->c('Locale')->format('template_pvp_ladder_format', $this->m_ladderType, $this->m_ladderType)
			);
	}

	public function build($core)
	{
		$this->checkInfo();

		$this->c('Pvp')->buildLadder($this->m_ladderType);

		if (!in_array($this->m_ladderType, array(2, 3, 5)))
			$this->buildBlock('main');
		else
			$this->buildBlocks(array('pagination', 'ratings'));

		$this->buildBreadcrumb();

		return $this;
	}

	protected function block_main()
	{
		return $this->block()
			->setTemplate('main', 'wow' . DS . 'contents' . DS . 'pvp')
			->setVar('pvp', $this->c('Pvp'))
			->setRegion('pagecontent');
	}

	protected function block_ratings()
	{
		return $this->block()
			->setTemplate('ratings', 'wow' . DS . 'contents' . DS . 'pvp')
			->setVar('pvp', $this->c('Pvp'))
			->setRegion('pagecontent');
	}

	protected function block_pagination()
	{
		$opt = '';
		$fields = array('team', 'realm', 'faction', 'minRating', 'maxRating');
		foreach ($fields as $f)
			if (isset($_GET[$f]))
				$opt .= $f . '=' . $_GET[$f] . '&amp;';

		return $this->block()
			->setTemplate('pagination', 'wow' . DS . 'blocks')
			->setRegion('pagination')
			->setVar('pagination', $this->c('Pager')->generatePagination(
					'/' . $this->core->getRawUrl(),
					$this->c('Pvp')->getTotalTeamsCount(),
					$this->c('Pvp')->getViewLimits(),
					$this->c('Pvp')->getPage(false) * $this->c('Pvp')->getViewLimits(),
					$opt
				)
			)
			->setVar('pager', $this->c('Pvp')->getPagerInfo());
	}
}
?>