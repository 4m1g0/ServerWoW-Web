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

class Arena_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_menuIndex = 'game';
	protected $m_realmName = '';
	protected $m_teamType = 0;
	protected $m_teamName = '';

	public function checkInfo()
	{
		$this->m_realmName = $this->core->getUrlAction(2);
		$this->m_teamType = ((int) substr($this->core->getUrlAction(3), 0, 1));
		$this->m_teamName = $this->core->getUrlAction(4);

		if (!$this->m_realmName || !in_array($this->m_teamType, array(2, 3, 5)) || !$this->m_teamName)
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
				'link' => 'pvp/',
				'locale_index' => 'PvP'
			),
			array(
				'link' => 'pvp/arena/' . $this->c('Config')->getValue('site.battlegroup') . '/' . $this->m_teamType . 'v' . $this->m_teamType,
				'caption' => $this->c('Locale')->format('template_pvp_ladder_format', $this->m_teamType, $this->m_teamType)
			),
			array(
				'link' => 'pvp/arena/' . $this->m_realmName . '/' . $this->m_teamType . 'v' . $this->m_teamType . '/' . $this->c('Pvp')->team('name'),
				'caption' => $this->c('Pvp')->team('name') . ' @ ' . $this->c('Pvp')->team('realmName')
			)
		);

		return $this;
	}

	public function build($core)
	{
		if (!$this->checkInfo() || !$this->c('Pvp')->buildTeam($this->m_realmName, $this->m_teamName, $this->m_teamType)->isTeam())
		{
			$this->setErrorPage()->c('Error_Wow', 'Controller');
			return $this;
		}

		$this->m_pageTitle = $this->c('Pvp')->team('name') . ' @ ' . $this->c('Pvp')->team('realmName');
		$this->buildBlock('team');

		$this->buildBreadcrumb();

		return $this;
	}

	public function block_team()
	{
		return $this->block()
			->setTemplate('team', 'wow' . DS . 'contents' . DS . 'arena')
			->setVar('team', $this->c('Pvp')->getTeam())
			->setRegion('pagecontent');
	}
}
?>