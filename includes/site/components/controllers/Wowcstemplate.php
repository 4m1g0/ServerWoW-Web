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

class Wowcstemplate_Controller_Component extends Controller_Component
{
	protected $m_adminData = array(
		'gmlevel' => 0,
		'showBox' => false
	);

	protected function wowTemplater()
	{
		if ($this->c('AccountManager')->user('gmlevel') >= 1)
		{
			$this->m_adminData = array(
				'gmlevel' => $this->c('AccountManager')->user('gmlevel'),
				'showBox' => true
			);
			$this->core->setVar('isAdmin', true);

			$this->buildBlock('adminBox');
		}
		else
			$this->core->setVar('isAdmin', false);

		return $this;
	}

	protected function block_adminBox()
	{
		return $this->block()
			->setVar('admin', $this->m_adminData)
			->setTemplate('adminbox', 'wow' . DS . 'blocks')
			->setRegion('adminBox');
	}
}
?>