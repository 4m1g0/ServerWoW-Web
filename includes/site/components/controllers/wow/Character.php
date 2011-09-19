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

class Character_WoW_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_realm	= '';
	protected $m_name	= '';
	protected $m_action = '';
	protected $m_menuIndex = 'game';

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
				'link' => 'character/' . $this->c('CharacterProfile')->getRealmName() . '/' . $this->c('CharacterProfile')->getName(),
				'caption' => $this->c('CharacterProfile')->getName() . ' @ ' . $this->c('CharacterProfile')->getRealmName()
			)
		);

		if ($this->m_action && !in_array($this->m_action, array('simple', 'advanced')))
			$this->m_breadcrumb[] = array(
				'link' => $this->m_breadcrumb[2]['link'] . '/' . $this->m_action,
				'locale_index' => 'template_profile_' . $this->m_action
			);

		return $this;
	}

	protected function checkInfo()
	{
		$this->m_realm = $this->core->getUrlAction(2);
		$this->m_name = $this->core->getUrlAction(3);
		$this->m_action = $this->core->getUrlAction(4);

		if ($this->m_realm && $this->m_name)
		{
			if (!$this->m_action)
			{
				$action = $this->c('Cookie')->read('wow_profile');
				if (!in_array($action, array('simple', 'advanced')))
				{
					$action = 'simple';
					$this->c('Cookie')->write('wow_profile', $action);
				}
				$url = $this->core->getRawUrl();
				$url = $url . (substr($url, strlen($url)-1) == '/' ? '' : '/') . $action;
				$this->core->redirectUrl('character/' . $this->m_realm . '/' . $this->m_name . '/' . $action);
			}
			elseif (in_array($this->m_action, array('simple', 'advanced')))
				$this->c('Cookie')->write('wow.profile', $this->m_action);
		}
		else
			return false;

		return true;
	}

	public function build($core)
	{
		if (!$this->checkInfo())
		{
			$this->setErrorPage()->c('Error_WoW', 'Controller');
			return $this;
		}

		switch($this->m_action)
		{
			case 'simple':
			case 'advanced':
				$this->c('CharacterProfile')->buildCharacter($this->m_realm, $this->m_name, $this->m_action);
				break;
			case 'tooltip':
				$this->c('CharacterProfile')
					->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_ITEMS)
					->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_FEEDS)
					->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_ITEMS)
					->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_DATA)
					->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_GUILD)
					->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_RAID_INFO)
						->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_SPELLS)
					->buildCharacter($this->m_realm, $this->m_name, $this->m_action);
				define('AJAX_PAGE', true);
				$this->m_isAjax = true;
				$this->buildBlock('tooltip');
				return $this;
			case 'achievement':
			case 'statistic':
				$category = false;

				if ($this->core->getUrlAction(5))
				{
					$this->c('CharacterProfile')
						->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_ITEMS)
						->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_FEEDS)
						->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_ITEMS)
						->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_DATA)
						->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_GUILD)
						->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_RAID_INFO)
						->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_TALENTS)
						->setLoadingFlag(CHARACTER_LOADING_FLAG_SKIP_SPELLS)
						->buildCharacterAction($this->m_realm, $this->m_name, $this->m_action);
					$this->c('Achievement')->setCategory($this->core->getUrlAction(5));
				}
				else
					$this->c('CharacterProfile')->buildCharacterAction($this->m_realm, $this->m_name, $this->m_action);
				break;
			case 'companion':
			case 'mount':
			case 'reputation':
			case 'feed':
				$this->c('CharacterProfile')->buildCharacterAction($this->m_realm, $this->m_name, $this->m_action);
				break;
		}

		$this->buildBreadcrumb();

		if ($this->c('CharacterProfile')->isCorrect())
		{
			$this->m_pageTitle = $this->c('CharacterProfile')->getTitle();
			$this->core->setVar('character', $this->c('CharacterProfile'));

			switch ($this->m_action)
			{
				case 'advanced':
				case 'simple':
					if ($this->m_action == 'advanced')
						$this->buildBlock('audit');
					$this->buildBlocks(array('activity', 'stats', 'statsBottom'/*, NYI 'raids'*/, 'profile'));
					$this->buildBlock('profileMenu');
					break;
				case 'achievement':
				case 'statistic':
					if ($this->core->getUrlAction(5))
					{
						$this->m_isAjax = true;
						$this->buildBlock($this->m_action . '_category');
						return $this;
					}
					$this->buildBlocks(array($this->m_action . 'Menu', $this->m_action));
					break;
				case 'companion':
				case 'mount':
					$this->buildBlocks(array('profileMenu', 'companion'));
					break;
				case 'reputation':
				case 'feed':
					$this->buildBlocks(array('profileMenu', $this->m_action));
				default:
					$this->buildBlock('profileMenu');
					break;
			}
			
			$this->buildBlock('main');
		}

		return $this;
	}

	/* BLOCKS SECTION */

	protected function block_main()
	{
		return $this->block()
			->setTemplate('character', 'wow' . DS . 'contents')
			->setRegion('pagecontent')
			->setVar('character', $this->c('CharacterProfile'));
	}

	protected function block_profileMenu()
	{
		return $this->block()
			->setVar('character', $this->c('CharacterProfile'))
			->setVar('profilePage', $this->c('Characterprofile')->getProfilePage())
			->setTemplate('profile-menu', 'wow' . DS . 'blocks' . DS . 'character')
			->setRegion('profile_menu');
	}

	protected function block_tooltip()
	{
		return $this->block('')
			->setVar('character', $this->c('CharacterProfile'))
			->setRegion('wow_ajax')
			->setTemplate('tooltip', 'wow' . DS . 'contents' . DS . 'character');
	}

	protected function block_profile()
	{
		return $this->block()
			->setVar('character', $this->c('CharacterProfile'))
			->setTemplate('profile', 'wow' . DS . 'contents' . DS . 'character')
			->setRegion('profileContents');
	}

	protected function block_activity()
	{
		return $this->block()
			->setRegion('recentActivity')
			->setVar('feeds', $this->c('CharacterProfile')->getFeeds())
			->setVar('url', $this->c('CharacterProfile')->getUrl())
			->setTemplate('recent-activity', 'wow' . DS . 'blocks' . DS . 'character');
	}

	protected function block_stats()
	{
		return $this->block()
			->setRegion('profileStats')
			->setVar('character', $this->c('CharacterProfile'))
			->setTemplate('profile-stats', 'wow' . DS . 'blocks' . DS . 'character');
	}

	protected function block_statsBottom()
	{
		return $this->block()
			->setRegion('statsBottom')
			->setVar('character', $this->c('CharacterProfile'))
			->setTemplate('profile-bottom-stats', 'wow' . DS . 'blocks' . DS . 'character');
	}

	protected function block_raids()
	{
		return $this->block()
			->setRegion('raidProgress')
			->setVar('character', $this->c('CharacterProfile'))
			->setTemplate('raid-progress', 'wow' . DS . 'blocks' . DS . 'character');
	}

	protected function block_audit()
	{
		return $this->block()
			->setVar('character', $this->c('CharacterProfile'))
			->setRegion('audit')
			->setTemplate('audit', 'wow' . DS . 'blocks' . DS . 'character');
	}

	protected function block_achievementMenu()
	{
		return $this->block()
			->setVar('characterUrl', $this->c('CharacterProfile')->getUrl())
			->setVar('menuData', $this->c('Achievement')->buildProfileMenu())
			->setRegion('profile_menu')
			->setTemplate('menu', 'wow' . DS . 'blocks' . DS . 'character' . DS . 'achievement');
	}

	protected function block_achievement()
	{
		return $this->block()
			->setVar('character', $this->c('CharacterProfile'))
			->setVar('achievement', $this->c('Achievement'))
			->setRegion('profileContents')
			->setTemplate('achievement', 'wow' . DS . 'contents' . DS . 'character');
	}

	protected function unit_achievement_category()
	{
		return $this->unit('Item')
			->setModel('WowAchievementCategory')
			->fieldCondition('id', ' = ' . ((int) $this->core->getUrlAction(5)));
	}

	protected function block_achievement_category()
	{
		return $this->block('Item')
			->setMainUnit('achievement_category')
			->setVar('achievements', $this->c('Achievement')->getCategory($this->core->getUrlAction(5)))
			->setRegion('wow_ajax')
			->setTemplate('category', 'wow' . DS . 'blocks' . DS . 'character' . DS . 'achievement');
	}
// statistic

	protected function block_statisticMenu()
	{
		return $this->block()
			->setVar('characterUrl', $this->c('CharacterProfile')->getUrl())
			->setVar('menuData', $this->c('Achievement')->buildProfileMenu(true))
			->setRegion('profile_menu')
			->setTemplate('menu', 'wow' . DS . 'blocks' . DS . 'character' . DS . 'statistic');
	}

	protected function block_statistic()
	{
		return $this->block()
			->setVar('character', $this->c('CharacterProfile'))
			->setVar('achievements', $this->c('Achievement')->getStatisticSummary())
			->setRegion('profileContents')
			->setTemplate('statistic', 'wow' . DS . 'contents' . DS . 'character');
	}

	protected function unit_statistic_category()
	{
		return $this->unit('Item')
			->setModel('WowAchievementCategory')
			->fieldCondition('id', ' = ' . ((int) $this->core->getUrlAction(5)));
	}

	protected function block_statistic_category()
	{
		return $this->block('Item')
			->setMainUnit('statistic_category')
			->setVar('achievements', $this->c('Achievement')->getStatisticCategory($this->core->getUrlAction(5)))
			->setRegion('wow_ajax')
			->setTemplate('category', 'wow' . DS . 'blocks' . DS . 'character' . DS . 'statistic');
	}

	protected function block_companion()
	{
		return $this->block()
			->setVar('character', $this->c('CharacterProfile'))
			->setTemplate('companion', 'wow' . DS . 'contents' . DS . 'character')
			->setRegion('profileContents');
	}

	protected function block_reputation()
	{
		return $this->block()
			->setVar('character', $this->c('CharacterProfile'))
			->setTemplate(($this->core->getUrlAction(5) == 'tabular' ? 'reputation_tabular' : 'reputation'), 'wow' . DS . 'contents' . DS . 'character')
			->setRegion('profileContents');
	}

	protected function block_feed()
	{
		return $this->block()
			->setVar('character', $this->c('CharacterProfile'))
			->setTemplate('feed', 'wow' . DS . 'contents' . DS . 'character')
			->setRegion('profileContents');
	}
}
?>