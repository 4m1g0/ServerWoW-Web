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

class Wow_Controller_Component extends Controller_Component
{
	protected $m_skipBuild = true;
	protected $m_allowedControllers = array(
		'home', 'character', 'guild', 'game', 'item', 'sidebar', 'community', 'media', 'forum', 'services',
		'blog', 'data', 'spell', 'achievement', 'zone', 'faction', 'account-status', 'search', 'pvp', 'arena', 'pref'
	);

	public function build($core)
	{
		if (!$core->getUrlAction(1))
			$action = 'Home';
		else
			$action = ucfirst(strtolower($core->getUrlAction(1)));

		if (!in_array(strtolower($action), $this->m_allowedControllers))
			$com = 'Error_WoW';
		else
			$com = $action . '_WoW';

		$this->c($com, 'Controller');

		return $this;
	}
}
?>