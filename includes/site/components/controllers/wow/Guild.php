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
	protected $m_menuIndex = 'game';

	protected function checkInfo()
	{
		$this->m_realmName = $this->core->getUrlAction(2);
		$this->m_guildName = $this->core->getUrlAction(3);
		$this->m_action = $this->core->getUrlAction(4);

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

		if (!$this->c('Guild')->initGuild($this->m_guildName, $this->m_realmName)->isGuild())
		{
			$this->setErrorPage()
				->c('Error_Wow', 'Controller');

			return $this;
		}

		$this->m_pageTitle = $this->c('Guild')->getName() . ' @ ' . $this->c('Guild')->getRealmName();

		$this->buildBlocks(array('profile'));
		$this->buildBreadcrumb();

		return $this;
	}

	protected function block_profile()
	{
		return $this->block()
			->setVar('guild', $this->c('Guild'))
			->setTemplate('profile', 'wow' . DS . 'contents' . DS . 'guild')
			->setRegion('pagecontent');
	}
}
?>