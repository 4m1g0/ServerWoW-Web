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

class ReputationSpilloverTemplate_Model_Component extends Model_Db_Component
{
	public $m_model = 'ReputationSpilloverTemplate';
	public $m_table = 'reputation_spillover_template';
	public $m_dbType = 'world';
	public $m_fields = array(
		'faction' => array('type' => 'integer'),
		'faction1' => array('type' => 'integer'),
		'rate_1' => array('type' => 'integer'),
		'rank_1' => array('type' => 'integer'),
		'faction2' => array('type' => 'integer'),
		'rate_2' => array('type' => 'integer'),
		'rank_2' => array('type' => 'integer'),
		'faction3' => array('type' => 'integer'),
		'rate_3' => array('type' => 'integer'),
		'rank_3' => array('type' => 'integer'),
		'faction4' => array('type' => 'integer'),
		'rate_4' => array('type' => 'integer'),
		'rank_4' => array('type' => 'integer'),
	);
}
?>