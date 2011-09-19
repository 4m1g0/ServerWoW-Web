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

class LocalesNpcText_Model_Component extends Model_Db_Component
{
	public $m_model = 'LocalesNpcText';
	public $m_table = 'locales_npc_text';
	public $m_dbType = 'world';
	public $m_fields = array(
		'entry' => 'Id',
		'Text0_0' => 'DbLocale',
		'Text0_1' => 'DbLocale',
		'Text1_0' => 'DbLocale',
		'Text1_1' => 'DbLocale',
		'Text2_0' => 'DbLocale',
		'Text2_1' => 'DbLocale',
		'Text3_0' => 'DbLocale',
		'Text3_1' => 'DbLocale',
		'Text4_0' => 'DbLocale',
		'Text4_1' => 'DbLocale',
		'Text5_0' => 'DbLocale',
		'Text5_1' => 'DbLocale',
		'Text6_0' => 'DbLocale',
		'Text6_1' => 'DbLocale',
		'Text7_0' => 'DbLocale',
		'Text7_1' => 'DbLocale',
	);
}
?>