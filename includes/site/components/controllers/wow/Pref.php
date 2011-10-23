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

class Pref_Wow_Controller_Component extends Groupwow_Controller_Component
{
	public function build($core)
	{
		if (!$this->c('AccountManager')->isLoggedIn())
			return $this->redirectUrl();

		$this->ajaxPage();
		DEFINE('AJAX_PAGE', true);

		if (isset($_POST['index']))
		{
			$idx = (int) $_POST['index'];

			$chars = $this->c('QueryResult', 'Db')
				->model('WowUserCharacters')
				->fields(array('WowUserCharacters' => array('id')))
				->fieldCondition('account', ' = ' . $this->c('AccountManager')->user('id'))
				->keyIndex('id')
				->loadItems();

			if ($chars && isset($chars[$idx]))
			{
				dump($chars);
				$id = $this->c('AccountManager')->user('id');
				$this->c('Db')->wow()->query("UPDATE `wow_user_characters` SET `isActive` = 0 WHERE `account` = %d", $id);
				$this->c('Db')->wow()->query("UPDATE `wow_user_characters` SET `isActive` = 1 WHERE `id` = %d AND `account` = %d", $chars[$idx]['id'], $id);
			}
		}
		return $this;
	}
}
?>