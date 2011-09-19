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

class CharacterAura_Model_Component extends Model_Db_Component
{
	public $m_model = 'CharacterAura';
	public $m_table = 'character_aura';
	public $m_dbType = 'characters';
	public $m_fields = array(
		'guid' => 'Id',
		'caster_guid' => array('type' => 'integer'),
		'item_guid' => array('type' => 'integer'),
		'spell' => array('type' => 'integer'),
		'effect_mask' => array('type' => 'integer'),
		'recalculate_mask' => array('type' => 'integer'),
		'stackcount' => array('type' => 'integer'),
		'amount0' => array('type' => 'integer'),
		'amount1' => array('type' => 'integer'),
		'amount2' => array('type' => 'integer'),
		'base_amount0' => array('type' => 'integer'),
		'base_amount1' => array('type' => 'integer'),
		'base_amount2' => array('type' => 'integer'),
		'maxduration' => array('type' => 'integer'),
		'remaintime' => array('type' => 'integer'),
		'remaincharges' => array('type' => 'integer'),
	);
}
?>