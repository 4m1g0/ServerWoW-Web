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

class Game_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_menuIndex = 'game';
	protected $m_gameType = 'index';
	protected $m_clientFilesController = '';
	protected $m_pages = array('race', 'class', 'zone', 'faction', 'lore', 'profession', 'tool', 'guide');
	protected $m_gameData = array();

	protected function checkInfo()
	{
		$this->m_gameType = $this->core->getUrlAction(2);

		if (!$this->m_gameType)
			$this->m_gameType = 'index';
		else
			$this->m_clientFilesController = $this->m_gameType;

		return true;
	}

	protected function setBreadcrumb()
	{
		$gameBreadCrumb = $this->c('GameWoW')->getGameBreadcrumbData();

		$this->m_breadcrumb = array(
			array(
				'link' => '',
				'caption' => 'ServerWoW'
			),
			array(
				'link' => 'game/',
				'locale_index' => 'template_menu_game'
			)
		);

		if ($gameBreadCrumb)
			$this->m_breadcrumb = array_merge($this->m_breadcrumb, $gameBreadCrumb);

		return $this->buildBreadcrumb();
	}

	public function build($core)
	{
		$this->checkInfo();

		$this->m_gameData = $this->c('GameWoW')->initGame($this->m_gameType)->getGameData();

		$this->setBreadcrumb();

		if (!$this->m_gameData && $this->m_gameType != 'index')
		{
			$this->setErrorPage()->c('Error_WoW', 'Controller');
			return $this;
		}

		if ($this->m_gameType != 'index')
		{
			$core->setVar('body_class', $this->m_gameData['page']);
			$this->m_pageTitle = $this->m_gameData['page_title'];
		}

		if (!in_array($this->m_gameType, $this->m_pages))
			$this->buildBlock('game');
		else
			$this->buildBlock($this->m_gameType);

		return $this;
	}

	protected function block_game()
	{
		$this->core->setVar('body_class', 'game-index');
		return $this->block()
			->setTemplate('game', 'wow' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_guide()
	{
		$type = 'game-guide-what-is-wow';
		$template = 'main';
		$css = 'what-is-wow';
		switch ($this->core->getUrlAction(3))
		{
			case 'getting-started':
			case 'how-to-play':
			case 'playing-together':
			case 'late-game':
				$type = 'game-guide-' . $this->core->getUrlAction(3);
				$template = $this->core->getUrlAction(3);
				$css = $this->core->getUrlAction(3);
				break;
		}
		$this->core->setVar('body_class', 'game-guide-section ' . $type);
		return $this->block()
			->setVar('css', $css)
			->setTemplate($template, 'wow' . DS . 'contents' . DS . 'game' . DS . 'guide')
			->setRegion('pagecontent');
	}

	protected function block_class()
	{
		if ($this->m_gameData['page'] == 'game-classes-index')
			$template = 'index';
		else
			$template = 'class';
		
		return $this->block()
			->setRegion('pagecontent')
			->setTemplate($template, 'wow' . DS . 'contents' . DS . 'game' . DS . 'classes')
			->setVar('gameData', $this->m_gameData);
	}

	protected function block_faction()
	{
		$this->core->setVar('body_class', 'faction-index expansion-3');
		return $this->block()
			->setRegion('pagecontent')
			->setTemplate('faction', 'wow' . DS . 'contents' . DS . 'game' . DS . 'faction');
	}

	protected function block_race()
	{
		if ($this->m_gameData['page'] == 'game-race-index')
			$template = 'index';
		else
			$template = 'race';

		return $this->block()
			->setRegion('pagecontent')
			->setTemplate($template, 'wow' . DS . 'contents' . DS . 'game' . DS . 'races')
			->setVar('gameData', $this->m_gameData);
	}
}
?>