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

class Faction_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_menuIndex = 'game';
	protected $m_faction = array();
	protected $m_isTooltip = false;
	protected $m_isTabAction = false;
	protected $m_tabActions = array('rewards', 'npcs', 'achievements', 'quests');
	protected $m_tabAction = '';
	protected $m_tabsSummary = array();
	protected $m_allowTabs = false;

	public function checkInfo()
	{
		$faction = $this->core->getUrlAction(2);

		if ($faction)
		{
			$this->m_faction = array('key' => $faction);

			if ($this->core->getUrlAction(3) == 'tooltip')
				$this->m_isTooltip = true;
			elseif (in_array($this->core->getUrlAction(3), $this->m_tabActions))
			{
				$this->m_isTabAction = true;
				$this->m_tabAction = strtolower($this->core->getUrlAction(3));
			}
		}

		return true;
	}

	protected function setBreadcrumb()
	{
		if ($this->m_isTabAction || $this->m_isTooltip)
			return $this;

		$this->m_breadcrumb = array(
			array(
				'link' => '',
				'caption' => 'World of Warcraft'
			),
			array(
				'link' => 'game/',
				'locale_index' => 'template_menu_game',
			),
			array(
				'link' => 'faction/',
				'locale_index' => 'template_game_factions',
			)
		);

		if ($this->m_faction)
		{
			$this->m_breadcrumb[] = array(
				'link' => 'faction/' . $this->m_faction['key'],
				'caption' => $this->m_faction['name']
			);
		}

		return $this;
	}

	public function build($core)
	{
		$this->checkInfo();

		if ($this->m_faction && isset($this->m_faction['key']) && $this->m_faction['key'])
			$this->m_faction = $this->c('GameWoW')->getFaction($this->m_faction['key']);
		
		$this->buildBreadcrumb();

		if ($this->m_faction)
		{
			if (!$this->m_isTooltip)
			{
				if (!$this->m_isTabAction)
				{
					$this->m_pageTitle = $this->m_faction['name'];

					$this->m_tabsSummary = $this->c('GameWoW')->getFactionTabs($this->m_faction, $this->m_allowTabs);

					$core->setVar('body_class', 'faction-' . $this->m_faction['key']);
					$this->buildBlock('faction');
				}
				else
				{
					$this->ajaxPage(true);

					$this->m_tabData = $this->c('GameWoW')->getFactionTab($this->m_faction, $core->getUrlAction(3));
					$this->buildBlock('tab');
				}
			}
			else
			{
				$this->ajaxPage(true);
				$this->buildBlock('tooltip');
			}
		}
		else
		{
			$core->setVar('body_class', 'faction-index expansion-3');
			$this->buildBlock('main');
		}

		return $this;
	}

	protected function block_main()
	{
		return $this->block()
			->setTemplate('faction', 'wow' . DS . 'contents' . DS . 'game' . DS . 'faction')
			->setRegion('pagecontent');
	}

	protected function block_faction()
	{
		return $this->block()
			->setVar('faction', $this->m_faction)
			->setVar('tabs', $this->m_tabsSummary)
			->setVar('allowTabs', $this->m_allowTabs)
			->setTemplate('item', 'wow' . DS . 'contents' . DS . 'game' . DS . 'faction')
			->setRegion('pagecontent');
	}

	protected function block_tooltip()
	{
		return $this->block()
			->setVar('faction', $this->m_faction)
			->setTemplate('tooltip', 'wow' . DS . 'contents' . DS . 'game' . DS . 'faction')
			->setRegion('wow_ajax');
	}

	protected function block_tab()
	{
		return $this->block()
			->setVar('faction', $this->m_faction)
			->setVar('tab', $this->m_tabData)
			->setTemplate('tab_' . $this->m_tabAction, 'wow' . DS . 'contents' . DS . 'game' . DS . 'faction')
			->setRegion('wow_ajax');
	}
}