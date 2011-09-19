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

class WowAreas_Model_Component extends Model_Db_Component
{
	public $m_model = 'WowAreas';
	public $m_table = 'wow_areas';
	public $m_dbType = 'wow';
	public $m_fields = array(
		'id' => 'Id',
		'mapID' => array('type' => 'integer'),
		'zoneID' => array('type' => 'integer'),
		'exploreFlag' => array('type' => 'integer'),
		'flags' => array('type' => 'integer'),
		'm_SoundProviderPref' => array('type' => 'integer'),
		'm_SoundProviderPrefUnderwater' => array('type' => 'integer'),
		'm_AmbienceID' => array('type' => 'integer'),
		'm_ZoneMusic' => array('type' => 'integer'),
		'm_IntroSound' => array('type' => 'integer'),
		'area_level' => array('type' => 'integer'),
		'name' => 'Locale',
		'stringFlags' => array('type' => 'integer'),
		'team' => array('type' => 'integer'),
		'liquidTypeID_1' => array('type' => 'integer'),
		'liquidTypeID_2' => array('type' => 'integer'),
		'liquidTypeID_3' => array('type' => 'integer'),
		'liquidTypeID_4' => array('type' => 'integer'),
		'minElevation' => array('type' => 'integer'),
		'ambientMultiplier' => array('type' => 'integer'),
		'lightID' => array('type' => 'integer'),
	);
}
?>