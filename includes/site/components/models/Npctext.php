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

class NpcText_Model_Component extends Model_Db_Component
{
	public $m_model = 'NpcText';
	public $m_table = 'npc_text';
	public $m_dbType = 'world';
	public $m_fields = array(
		'ID' => array('type' => 'integer'),
		'text0_0' => array('type' => 'string'),
		'text0_1' => array('type' => 'string'),
		'lang0' => array('type' => 'integer'),
		'prob0' => array('type' => 'integer'),
		'em0_0' => array('type' => 'integer'),
		'em0_1' => array('type' => 'integer'),
		'em0_2' => array('type' => 'integer'),
		'em0_3' => array('type' => 'integer'),
		'em0_4' => array('type' => 'integer'),
		'em0_5' => array('type' => 'integer'),
		'text1_0' => array('type' => 'string'),
		'text1_1' => array('type' => 'string'),
		'lang1' => array('type' => 'integer'),
		'prob1' => array('type' => 'integer'),
		'em1_0' => array('type' => 'integer'),
		'em1_1' => array('type' => 'integer'),
		'em1_2' => array('type' => 'integer'),
		'em1_3' => array('type' => 'integer'),
		'em1_4' => array('type' => 'integer'),
		'em1_5' => array('type' => 'integer'),
		'text2_0' => array('type' => 'string'),
		'text2_1' => array('type' => 'string'),
		'lang2' => array('type' => 'integer'),
		'prob2' => array('type' => 'integer'),
		'em2_0' => array('type' => 'integer'),
		'em2_1' => array('type' => 'integer'),
		'em2_2' => array('type' => 'integer'),
		'em2_3' => array('type' => 'integer'),
		'em2_4' => array('type' => 'integer'),
		'em2_5' => array('type' => 'integer'),
		'text3_0' => array('type' => 'string'),
		'text3_1' => array('type' => 'string'),
		'lang3' => array('type' => 'integer'),
		'prob3' => array('type' => 'integer'),
		'em3_0' => array('type' => 'integer'),
		'em3_1' => array('type' => 'integer'),
		'em3_2' => array('type' => 'integer'),
		'em3_3' => array('type' => 'integer'),
		'em3_4' => array('type' => 'integer'),
		'em3_5' => array('type' => 'integer'),
		'text4_0' => array('type' => 'string'),
		'text4_1' => array('type' => 'string'),
		'lang4' => array('type' => 'integer'),
		'prob4' => array('type' => 'integer'),
		'em4_0' => array('type' => 'integer'),
		'em4_1' => array('type' => 'integer'),
		'em4_2' => array('type' => 'integer'),
		'em4_3' => array('type' => 'integer'),
		'em4_4' => array('type' => 'integer'),
		'em4_5' => array('type' => 'integer'),
		'text5_0' => array('type' => 'string'),
		'text5_1' => array('type' => 'string'),
		'lang5' => array('type' => 'integer'),
		'prob5' => array('type' => 'integer'),
		'em5_0' => array('type' => 'integer'),
		'em5_1' => array('type' => 'integer'),
		'em5_2' => array('type' => 'integer'),
		'em5_3' => array('type' => 'integer'),
		'em5_4' => array('type' => 'integer'),
		'em5_5' => array('type' => 'integer'),
		'text6_0' => array('type' => 'string'),
		'text6_1' => array('type' => 'string'),
		'lang6' => array('type' => 'integer'),
		'prob6' => array('type' => 'integer'),
		'em6_0' => array('type' => 'integer'),
		'em6_1' => array('type' => 'integer'),
		'em6_2' => array('type' => 'integer'),
		'em6_3' => array('type' => 'integer'),
		'em6_4' => array('type' => 'integer'),
		'em6_5' => array('type' => 'integer'),
		'text7_0' => array('type' => 'string'),
		'text7_1' => array('type' => 'string'),
		'lang7' => array('type' => 'integer'),
		'prob7' => array('type' => 'integer'),
		'em7_0' => array('type' => 'integer'),
		'em7_1' => array('type' => 'integer'),
		'em7_2' => array('type' => 'integer'),
		'em7_3' => array('type' => 'integer'),
		'em7_4' => array('type' => 'integer'),
		'em7_5' => array('type' => 'integer'),
		'WDBVerified' => array('type' => 'integer'),
	);
}
?>