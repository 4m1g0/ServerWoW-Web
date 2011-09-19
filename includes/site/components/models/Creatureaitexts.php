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

class CreatureAiTexts_Model_Component extends Model_Db_Component
{
	public $m_model = 'CreatureAiTexts';
	public $m_table = 'creature_ai_texts';
	public $m_dbType = 'world';
	public $m_fields = array(
		'entry' => 'Id',
		'content_default' => array('type' => 'string'),
		'content' => 'DbLocale',
		'sound' => array('type' => 'integer'),
		'type' => array('type' => 'integer'),
		'language' => array('type' => 'integer'),
		'emote' => array('type' => 'integer'),
		'comment' => array('type' => 'string'),
	);
}
?>