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

class Zone_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_zone = '';
	protected $m_boss = '';
	protected $m_zoneData = array();

	protected function checkInfo()
	{
		$this->m_zone = $this->core->getUrlAction(2);
		$this->m_boss = $this->core->getUrlAction(3);

		if (!preg_match('/saA-zZ/i', $this->m_zone) && $this->m_boss == 'tooltip')
		{
			$this->ajaxPage();
		}

		return $this;
	}

	protected function setBreadcrumb()
	{
		$this->m_breadcrumb = array(
			array(
				'link' => '/',
				'caption' => 'World of Warcraft'
			),
			array(
				'link' => 'game/',
				'locale_index' => 'template_menu_game'
			),
			array(
				'link' => 'zone/',
				'locale_index' => 'template_game_dungeons_and_raids'
			)
		);

		return $this->buildBreadcrumb();
	}

	public function build($core)
	{
		$core->setVar('body_class', 'zone-index expansion-3');

		$this->checkInfo();

		$this->m_zoneData = $this->c('GameWoW')->initGame('zone')->getGameData();

		$this->setBreadcrumb();

		if ($this->m_isAjax)
			$this->buildBlock('tooltip');
		else
			$this->buildBlock('main');

		return $this;
	}

	protected function block_main()
	{
		return $this->block()
			->setTemplate('index', 'wow' . DS . 'contents' . DS . 'zone')
			->setRegion('pagecontent');
	}

	protected function block_tooltip()
	{
		return $this->block()
			->setRegion('wow_ajax')
			->setVar('zone', $this->m_zoneData)
			->setTemplate('tooltip', 'wow' . DS . 'contents' . DS . 'zone');
	}
}
?>