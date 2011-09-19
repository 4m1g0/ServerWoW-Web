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

class Groupwow_Controller_Component extends Wowcstemplate_Controller_Component
{
	protected $m_breadcrumb = array();

	protected function setTemplates()
	{
		$this->m_templates = array(
			(TEMPLATES_DIR . 'wow' . DS . 'elements' . DS . 'ajax.ctp'),
			(TEMPLATES_DIR . 'elements' . DS . 'wow' . DS . 'layout.ctp'),
		);

		return $this;
	}

	protected function setBreadcrumb()
	{
		return $this;
	}

	protected function buildBreadcrumb()
	{
		if (!$this->m_breadcrumb)
			$this->setBreadcrumb();

		if (!$this->m_breadcrumb)
			return $this;

		$this->buildBlock('breadcrumb');

		return $this;
	}

	protected function beforeActions()
	{
		if (!$this->core->getUrlLocale())
		{
			// Redirect
			$actions = $this->core->getActions();
			$locale_index = $this->c('Config')->getValue('site.locale_indexes.0');

			$location = CLIENT_FILES_PATH . '/';
			$size = sizeof($actions);

			for($i = 0; $i < $size; ++$i)
			{
				$location .= $actions['action' . $i] . '/';

				if ($i == $locale_index)
					$location .= $this->c('Locale')->getLocale() . '/';
			}

			header('Location: ' . substr($location, 0, strlen($location)-1));

			exit(0);
		}
		if ($this->core->getUrlAction(1) == 'character' && !in_array($this->core->getUrlAction(4), array('advanced', 'simple')))
			$this->m_clientFilesController = strtolower($this->core->getUrlAction(4));
		elseif ($this->core->getUrlAction(1) == 'game')
			$this->m_clientFilesController = strtolower($this->core->getUrlAction(2));

		$this->wowTemplater();
		return $this;
	}

	protected function beforeBuild()
	{
		if ($this->m_isAjax)
			return $this;

		if ($this->m_breadcrumb)
			$this->buildBlock('breadcrumb');

		$this->buildBlocks(array('menu', 'userCharacters', 'header', 'footer', 'service'));
		return $this;
	}

	protected function block_header()
	{
		return $this->block()
			->setRegion('header')
			->setTemplate('header', 'wow' . DS . 'elements');
	}

	protected function block_footer()
	{
		return $this->block()
			->setRegion('footer')
			->setTemplate('footer', 'wow' . DS . 'elements');
	}

	protected function block_service()
	{
		return $this->block()
			->setRegion('service')
			->setTemplate('service', 'wow' . DS . 'elements');
	}

	protected function block_breadcrumb()
	{
		return $this->block()
			->setRegion('breadcrumb')
			->setVar('breadcrumb', $this->c('Breadcrumb')
				->setBreadcrumbData($this->m_breadcrumb)
				->buildBreadcrumb())
			->setTemplate('breadcrumb', 'elements' . DS . 'wow');
	}

	protected function block_menu()
	{
		return $this->block()
			->setVar('main_menu', $this->c('Menu')->getMenu($this->m_menuIndex))
			->setTemplate('main_menu', 'wow' . DS . 'elements')
			->setRegion('main_menu');
	}

	protected function block_userCharacters()
	{
		return $this->block()
			->setRegion('user_characters')
			->setTemplate('user_characters', 'wow' . DS . 'blocks');
	}
}
?>