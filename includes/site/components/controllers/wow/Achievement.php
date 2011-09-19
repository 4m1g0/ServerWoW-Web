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

class Achievement_WoW_Controller_Component extends Groupwow_Controller_Component
{
	public function build($core)
	{
		if (strtolower($core->getUrlAction(3)) == 'tooltip')
		{
			$this->m_isAjax = true;
			define('AJAX_PAGE', true);

			if ($core->getUrlAction(2) > 0)
				$this->buildBlock('tooltip');
		}
		else
		{
			$this->setErrorPage();
			$this->c('Error_WoW', 'Controller');
		}

		return $this;
	}

	protected function unit_tooltip()
	{
		return $this->unit('Item')
			->setModel('WowAchievement')
			->fieldCondition('id', '= ' . ((int) $this->core->getUrlAction(2)));
	}

	protected function block_tooltip()
	{
		return $this->block('Item')
			->setRegion('wow_ajax')
			->setMainUnit('tooltip')
			->setTemplate('tooltip', 'wow' . DS . 'contents' . DS . 'achievement');
	}
}
?>