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

class Classes_Data_Component extends Data_Component
{
	protected $m_data = array(
		1 => array(
			'key' => 'warrior'
		),
		2 => array(
			'key' => 'paladin'
		),
		3 => array(
			'key' => 'hunter'
		),
		4 => array(
			'key' => 'rogue'
		),
		5 => array(
			'key' => 'priest'
		),
		6 => array(
			'key' => 'death-knight'
		),
		7 => array(
			'key' => 'shaman'
		),
		8 => array(
			'key' => 'mage'
		),
		9 => array(
			'key' => 'warlock'
		),
		11 => array(
			'key' => 'druid'
		)
	);

	public function getClassKey($id)
	{
		if ($id < CLASS_WARRIOR || $id >= MAX_CLASSES || $id == CLASS_UNK)
			return null;

		return $this->m_data[$id]['key'];
	}

	public function getClassID($key)
	{
		foreach ($this->m_data as $id => &$class)
			if ($class['key'] == $key || str_replace(array('-', '_'), '', $class['key']) == $key)
				return $id;

		return 0;
	}
}
?>