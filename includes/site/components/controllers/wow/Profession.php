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

class Profession_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_profKey = '';
	protected $m_profData = array();
	protected $m_menuIndex = 'game';

	public function checkInfo()
	{
		if ($this->core->getUrlAction(2))
			$this->m_profKey = strtolower($this->core->getUrlAction(2));

		return true;
	}

	protected function setBreadcrumb()
	{
		$this->m_breadcrumb = array(
			array(
				'link' => '',
				'caption' => 'World of Warcraft',
			),
			array(
				'link' => 'game/',
				'locale_index' => 'template_menu_game',
			),
			array(
				'link' => 'profession/',
				'locale_index' => 'template_guild_roster_professions',
			)
		);

		if ($this->m_profData)
			$this->m_breadcrumb[] = array(
				'link' => 'profession/' . $this->m_profData['info']['key'],
				'caption' => $this->m_profData['info']['name'],
			);
		
		return $this;
	}

	public function build($core)
	{
		$this->checkInfo();

		if ($this->m_profKey)
			$this->m_profData = $this->c('GameWoW')->getProfession($this->m_profKey);

		$this->buildBreadcrumb();

		if (!$this->m_profData)
		{
			$core->setVar('body_class', 'profession-index');
			$this->buildBlock('main');
		}
		else
		{
			$this->m_pageTitle = $this->m_profData['info']['name'];
			$core->setVar('body_class', 'profession-page profession-' . $this->m_profKey);
			$this->buildBlock('profession');
		}

		return $this;
	}

	protected function block_main()
	{
		return $this->block()
			->setTemplate('main', 'wow' . DS . 'contents' . DS . 'game' . DS . 'profession')
			->setRegion('pagecontent');
	}

	protected function block_profession()
	{
		return $this->block()
			->setVar('prof', $this->m_profData)
			->setTemplate('profession', 'wow' . DS . 'contents' . DS . 'game' . DS . 'profession')
			->setRegion('pagecontent');
	}
}