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

class Admin_Controller_Component extends Controller_Component
{
	protected $m_action = '';

	protected function checkInfo()
	{
		if (!$this->c('AccountManager')->isLoggedIn())
			return false;
		elseif (!$this->c('AccountManager')->isAdmin())
			return false;

		$this->m_action = strtolower($this->core->getUrlAction(1));

		return true;
	}

	public function build($core)
	{
		if (!$this->checkInfo())
		{
			$this->setErrorPage();
			$this->c('Default', 'Controller');
			return $this;
		}

		if (!$this->m_action)
			$this->buildBlock('main');
		else
			$this->buildBlock($this->m_action);

		return $this;
	}

	protected function block_main()
	{
		return $this->block()
			->setTemplate('main', 'admin' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_news()
	{
		return $this->block()
			->setTemplate('news', 'admin' . DS . 'contents')
			->setRegion('pagecontent');
	}
}
?>