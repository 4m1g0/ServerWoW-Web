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

class Error_WoW_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_breadcrumb = array(
		array(
			'link' => '',
			'caption' => 'World of Warcraft'
		)
	);

	public function build($core)
	{
		header('HTTP/1.0 404 Not Found');
		$this->core->setVar('body_class', 'server-error');
		$this->buildBlock('main');

		return $this;
	}

	protected function block_main()
	{
		return $this->block()
			->setTemplate('error404', 'wow' . DS . 'elements')
			->setRegion('pagecontent');
	}
}
?>