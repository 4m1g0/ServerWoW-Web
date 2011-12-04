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

class Sidebar_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_sidebarData = array();

	public function build($core)
	{
		$action = $core->getUrlAction(2);
		$error = false;
		switch ($action)
		{
			case 'forums':
				$this->m_sidebarData = $this->c('Forum')->getSidebarData();
				$this->buildBlock('forums');
				break;
			case 'sotd':
				$this->m_sidebarData = $this->c('Media')->getSidebarData();
				$this->buildBlock('sotd');
				break;
			default:
				$this->setErrorPage()->c('Error_Wow', 'Controller');
				$error = true;
				break;
		}

		if (!$error)
		{
			$this->ajaxPage();
			define('AJAX_PAGE', true);
		}

		return $this;
	}

	protected function block_forums()
	{
		return $this->block()
			->setVar('sidebar', $this->m_sidebarData)
			->setTemplate('forums', 'wow' . DS . 'contents' . DS . 'sidebar')
			->setRegion('wow_ajax');
	}

	protected function block_sotd()
	{
		return $this->block()
			->setVar('sidebar', $this->m_sidebarData)
			->setTemplate('sotd', 'wow' . DS . 'contents' . DS . 'sidebar')
			->setRegion('wow_ajax');
	}
}
?>