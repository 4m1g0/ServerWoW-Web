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

class Editconfig_Component extends Component
{
	public function updateConfigs()
	{
		if (!isset($_POST['cfg']))
			return $this;

		$cfg = array();
		$cfg['site'] = $_POST['site'];
		$cfg['site']['locale_indexes'] = explode(',', $cfg['site']['locale_indexes']);
		$cfg['misc'] = $_POST['misc'];
		$cfg['session'] = $_POST['session'];
		$cfg['realms'] = $_POST['realms'];
		$cfg['database'] = $_POST['database'];

		$cfg_file = SITE_CONFIGS_DIR . 'Site.dat';

		file_put_contents($cfg_file, serialize($cfg));
		$this->core->redirectApp('/editconfig');
	}
}
?>