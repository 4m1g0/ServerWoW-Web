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

class Layout_Component extends Component
{
	private $m_css = array();
	private $m_js = array();
	protected $m_pageTitle = '';
	protected $m_menuTitle = '';
	protected $m_pageDescription = '';
	protected $m_menuDescription = '';
	protected $m_pageKeywords = '';
	protected $m_menuKeywords = '';

	public function setMenuTitle($title)
	{
		$this->m_menuTitle = $title;
		return $this;
	}

	public function setPageTitle($title)
	{
		$this->m_pageTitle = $title;
		return $this;
	}

	public function setMenuDescription($title)
	{
		$this->m_menuDescription = $title;
		return $this;
	}
	
	public function setPageDescription($title)
	{
		$this->m_pageDescription = $title;
		return $this;
	}

	public function setMenuKeywords($title)
	{
		$this->m_menuKeywords = $title;
		return $this;
	}
	
	public function setPageKeywords($title)
	{
		$this->m_pageKeywords = $title;
		return $this;
	}

	public function getPageTitle()
	{
		$title = array();

		if ($this->m_pageTitle)
			$title[] = $this->m_pageTitle;

		if ($this->m_menuTitle)
			$title[] = $this->m_menuTitle;

		if (!$title)
			return $this->c('Config')->getValue('site.title');
		else
		{
			$title[] = $this->c('Config')->getValue('site.title');
			return implode(' - ', $title);
		}
	}
	
	public function getPageDescription()
	{
		$title = array();

		if ($this->m_pageDescription)
			$title[] = $this->m_pageDescription;

		if ($this->m_menuDescription)
			$title[] = $this->m_menuDescription;

		if (!$title)
			return $this->c('Config')->getValue('site.description');
		else
		{
			$title[] = $this->c('Config')->getValue('site.description');
			return implode(' - ', $title);
		}
	}

	public function getPageKeywords()
	{
		$title = array();

		if ($this->m_pageKeywords)
			$title[] = $this->m_pageKeywords;

		if ($this->m_menuKeywords)
			$title[] = $this->m_menuKeywords;

		if (!$title)
			return $this->c('Config')->getValue('site.keywords');
		else
		{
			$title[] = $this->c('Config')->getValue('site.keywords');
			return implode(' - ', $title);
		}
	}

	public function initialize()
	{
		$ClientCSS = array();
		$ClientJS = array();

		include(SITE_DIR . 'layouts' . DS . 'ClientCss.php');
		include(SITE_DIR . 'layouts' . DS . 'ClientJs.php');

		$this->m_css = $ClientCSS;
		$this->m_js = $ClientJS;

		unset($ClientCSS, $ClientJS);

		return $this;
	}

	protected function checkCondition(&$files, &$aHolder)
	{
		if (!$files)
			return false;

		$aHolder = array();

		foreach ($files as $region => $holder)
		{
			if (!isset($aHolder[$region]))
				$aHolder[$region] = array();

			foreach ($holder as $file)
			{
				//if (!isset($file['condition'])) //TODO: add conditions support
					$aHolder[$region][] = $file;
			}
		}

		return $this;
	}

	public function getControllerCss($controller)
	{
		if (!isset($this->m_css[$controller]))
			return null;

		$css = $this->m_css[$controller];

		$sendTo = array();

		$this->checkCondition($css, $sendTo);

		unset($css);

		return $sendTo;
	}

	public function getControllerJs($controller)
	{
		if (!isset($this->m_js[$controller]))
			return null;

		$js = $this->m_js[$controller];

		$sendTo = array();

		$this->checkCondition($js, $sendTo);

		unset($js);

		return $sendTo;
	}
}
?>