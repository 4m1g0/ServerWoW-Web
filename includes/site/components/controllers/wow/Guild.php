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

class Guild_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_guildName = '';
	protected $m_realmName = '';
	protected $m_action = '';
	protected $m_subAction = '';
	protected $m_menuIndex = 'game';
	protected $m_allowedActions = array(
		'roster' => 'guild_roster',
		'news' => 'guild_news',
		'events' => 'guild_events',
		'achievement' => 'guild_achievement',
		'perk' => 'guild_perk',
		'rewards' => 'guild_rewards'
	);
	protected $m_allowedSubActions = array(
		'professions' => array('prev' => 'roster', 'page' => 'guild_professions')
	);

	protected function checkInfo()
	{
		$this->m_realmName = $this->core->getUrlAction(2);
		$this->m_guildName = $this->core->getUrlAction(3);
		$this->m_action = $this->core->getUrlAction(4);
		$this->m_subAction = $this->core->getUrlAction(5);

		if (!isset($this->m_allowedActions[$this->m_action]))
			$this->m_action = '';

		if ($this->m_subAction && (!$this->m_action || !isset($this->m_allowedSubActions[$this->m_subAction]) || $this->m_allowedSubActions[$this->m_subAction]['prev'] != $this->m_action))
			$this->m_subAction = '';

		if (!$this->m_realmName || !$this->m_guildName)
			return false;

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
				'link' => $this->c('Guild')->getUrl(true),
				'caption' => $this->c('Guild')->getName() . ' @ ' . $this->c('Guild')->getRealmName()
			)
		);

		// Action & subaction (optional)

		if ($this->m_action)
			$this->m_breadcrumb[] = array(
				'link' => $this->m_action,
				'locale_index' => 'template_guild_menu_' . $this->m_action
			);

		if ($this->m_subAction)
			$this->m_breadcrumb[] = array(
				'link' => $this->m_subAction,
				'locale_index' => 'template_guild_menu_' . $this->m_subAction
			);

		return $this;
	}

	public function build($core)
	{
		if (!$this->checkInfo())
		{
			$this->setErrorPage()
				->c('Error_Wow', 'Controller');

			return $this;
		}

		if (!$this->m_action)
			$this->c('Guild')->initGuild($this->m_guildName, $this->m_realmName);
		else
			$this->c('Guild')->initGuildAction($this->m_guildName, $this->m_realmName, $this->m_allowedActions[$this->m_action], $this->m_subAction);

		if (!$this->c('Guild')->isGuild())
		{
			$this->setErrorPage()
				->c('Error_Wow', 'Controller');

			return $this;
		}

		$this->m_pageTitle = $this->c('Guild')->getName() . ' @ ' . $this->c('Guild')->getRealmName();

		if (!$this->m_action)
			$this->buildBlocks(array('profileMenu', 'rosterPagination', 'profile'));
		else
		{
			if (!$this->m_subAction)
				$this->buildBlocks(array('profileMenu', $this->m_action));
			else
				$this->buildBlocks(array('profileMenu', $this->m_subAction));
		}

		$this->buildBreadcrumb();

		return $this;
	}

	protected function block_rosterPagination()
	{
		return $this->block()
			->setTemplate('pagination', 'wow' . DS . 'blocks')
			->setRegion('pagination')
			->setVar('pagination', $this->c('Pager')->generatePagination(
					'/' . $this->core->getRawUrl(),
					$this->c('Guild')->getRosterSize(),
					$this->c('Guild')->getRosterLimit(),
					$this->c('Forum')->getPage(false) * $this->c('Guild')->getRosterLimit()
				)
			)
			->setVar('pager', $this->c('Guild')->getPagerInfo());
	}

	protected function block_roster()
	{
		return $this->block()
			->setTemplate('roster', 'wow' . DS . 'contents' . DS . 'guild')
			->setVar('guild', $this->c('Guild'))
			->setRegion('pagecontent');
	}

	protected function block_profile()
	{
		return $this->block()
			->setVar('guild', $this->c('Guild'))
			->setTemplate('profile', 'wow' . DS . 'contents' . DS . 'guild')
			->setRegion('pagecontent');
	}

	protected function block_profileMenu()
	{
		return $this->block()
			->setVar('guild', $this->c('Guild'))
			->setTemplate('profile-menu', 'wow' . DS . 'blocks' . DS . 'guild')
			->setRegion('profileMenu');
	}

	protected function block_professions()
	{
		return $this->block()
			->setTemplate('professions', 'wow' . DS . 'contents' . DS . 'guild')
			->setRegion('pagecontent')
			->setVar('guild', $this->c('Guild'));
	}

	protected function block_news()
	{
		return $this->block()
			->setTemplate('news', 'wow' . DS . 'contents' . DS . 'guild')
			->setRegion('pagecontent')
			->setVar('guild', $this->c('Guild'));
	}
}
?>