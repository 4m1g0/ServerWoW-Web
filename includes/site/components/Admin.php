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

class Admin_Component extends Component
{
	public function getNotifications()
	{
		
	}

	public function getNews()
	{
		return $this->c('QueryResult', 'Db')
			->model('WowNews')
			->loadItems();
	}

	public function getNewsItem()
	{
		$id = (int) $this->core->getUrlAction(3);

		if (!$id)
			return false;

		$item = $this->c('QueryResult', 'Db')
			->model('WowNews')
			->addModel('WowCarousel')
			->join('left', 'WowCarousel', 'WowNews', 'id', 'id')
			->fieldCondition('wow_news.id', ' = ' . $id)
			->setAlias('WowCarousel', 'image', 'carousel_image')
			->setAlias('WowCarousel', 'title_' . $this->c('Locale')->getLocale(), 'carouselTitle')
			->setAlias('WowCarousel', 'desc_' . $this->c('Locale')->getLocale(), 'carouselDesc')
			->loadItem();

		return $item;
	}

	public function editNews($id)
	{
		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowNews')
			->setType('update')
			->setId($id);

		$news = array('title', 'image', 'image_header', 'tags');

		foreach ($news as $f)
			if (isset($_POST['news'][$f]))
				$edt->{$f} = $_POST['news'][$f];

		if (isset($_POST['editor1']))
			$edt->text_es = $_POST['editor1'];

		if (isset($_POST['news']['desc']))
			$edt->desc_es = $_POST['news']['desc'];

		if (isset($_POST['news']['community']))
			$edt->community = '1';
		else
			$edt->community = '0';

		$edt->save()->clearValues();

		if (isset($_POST['carousel']))
		{
			$edt->setModel('WowCarousel')
			->setType('update')
			->setId($id);

			if (isset($_POST['carousel']['text']))
				$edt->desc_es = $_POST['carousel']['text'];

			if (isset($_POST['carousel']['active']))
				$edt->active = '1';
			else
				$edt->active = '0';

			$edt->save()->clearValues();
		}

		$this->core->redirectApp('/admin/news/');

		return true;
	}

	public function deleteNewsItem($id)
	{
		$this->c('Editing')->clearValues()->setModel('WowNews')->setType('delete')->setId($id)->delete()->save()->clearValues();

		return $this->core->redirectApp('/admin/news/');
	}

	public function saveSiteConfigs()
	{
		if (!isset($_POST['site']))
			return false;

		$site = $_POST['site'];
		$this->c('Config')->setValue('site.path', $site['path']);

		$d = explode(',', $site['locale_indexes']);

		foreach ($d as &$i)
			$i =trim($i);

		$this->c('Config')->setValue('site.locale_indexes', $d);

		$this->c('Config')->setValue('site.log', $site['log']);

		$this->c('Config')->setValue('misc', $_POST['misc']);

		$this->c('Config')->setValue('session', $_POST['session']);

		$this->c('Config')->updateConfigFile();

		$this->core->redirectApp('/admin/configs');

		return true;
	}

	public function deleteRealm($id)
	{
		$realms = $this->c('Config')->getValue('realms');

		if (!$realms)
			return false;

		$new = array();

		foreach ($realms as $rid => $r)
			if ($rid != $id)
				$new[$rid] = $r;

		$this->c('Config')->setValue('realms', $new);

		///
		$chars = $this->c('Config')->getValue('database.characters');

		if (!$chars)
			return false;

		$new = array();
		foreach ($chars as $rid => $r)
			if ($rid != $id)
				$new[$rid] = $r;

		$this->c('Config')->setValue('database.characters', $new);

		///
		$world = $this->c('Config')->getValue('database.characters');

		if (!$world)
			return false;

		$new = array();
		foreach ($world as $rid => $r)
			if ($rid != $id)
				$new[$rid] = $r;

		$this->c('Config')->setValue('database.world', $new);

		$this->c('Config')->updateConfigFile();

		$this->core->redirectApp('/admin/configs/realms');

		return true;
	}

	public function saveRealmsConfigs()
	{
		if (!isset($_POST['realm']))
			return false;

		$r = $_POST['realm'];
		$realmId = sizeof($this->c('Config')->getValue('realms'))+1;
		if (!isset($_POST['realm']['isNew']))
		{
			$realm = $this->c('Config')->getValue('realms.' . $r['id']);

			if (!$realm)
				return false;

			$char = $this->c('Config')->getValue('database.characters.' . $r['id']);
			$world = $this->c('Config')->getValue('database.world.' . $r['id']);

			if (!$char || !$world)
				return false;

			$realmId = $r['id'];
		}

		foreach ($r as $k => $v)
			if ($k != 'isNew')
				$this->c('Config')->setValue('realms.' . $realmId . '.' . $k, $v);

		if (isset($_POST['mysql']['character']))
			foreach ($_POST['mysql']['character'] as $k => $v)
				$this->c('Config')->setValue('database.characters.' . $realmId . '.' . $k, $v);

		if (isset($_POST['mysql']['world']))
			foreach ($_POST['mysql']['world'] as $k => $v)
				$this->c('Config')->setValue('database.world.' . $realmId . '.' . $k, $v);

		return $this->c('Config')->updateConfigFile();
	}

	public function saveMySQLConfigs()
	{
		$types = array('realm', 'wow');

		foreach ($types as $type)
		{
			if (!isset($_POST['mysql'][$type]))
				continue;

			foreach ($_POST['mysql'][$type] as $key => $value)
				$this->c('Config')->setValue('database.' . $type . '.' . $key, $value);
		}

		$this->c('Config')->updateConfigFile();

		return $this;
	}

	public function deleteAllNews()
	{
		$this->c('Database')->wow()->query("DELETE FROM wow_news");
		$this->c('Database')->wow()->query("DELETE FROM wow_carousel");

		$this->core->redirectApp('/admin/');
	}

	public function addNews()
	{
		$fields = array('news' => array('title', 'desc'));
		foreach ($fields as $type => $d)
		{
			foreach ($d as $f)
				if (!isset($_POST[$type][$f]) || !$_POST[$type][$f])
					return false;
		}
		// Check files
		if (!isset($_FILES['news']))
			return false;

		// Ok, move file.
		$f = $_FILES['news'];
		move_uploaded_file($f['tmp_name']['image'], WEBROOT_DIR . 'cms' . DS . 'blog_thumbnail' . DS . $f['name']['image']);
		move_uploaded_file($f['tmp_name']['header_image'], WEBROOT_DIR . 'cms' . DS . 'carousel_header' . DS . $f['name']['header_image']);
		copy(WEBROOT_DIR . 'cms' . DS . 'carousel_header' . DS . $f['name']['header_image'], WEBROOT_DIR . 'cms' . DS . 'blog_header' . DS . $f['name']['header_image']);

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowNews')
			->setType('insert');

		$edt->image = $f['name']['image'];
		$edt->header_image = $f['name']['header_image'];
		$edt->title_es = $_POST['news']['title'];
		$edt->desc_es = $_POST['news']['desc'];
		$edt->text_es = $_POST['editor1'];
		$edt->author = $this->c('AccountManager')->getForumsName();
		$edt->postdate = time();
		$edt->tags = isset($_POST['news']['tags']) ? $_POST['news']['tags'] : '';
		$edt->community = (isset($_POST['news']['community']) && $_POST['news']['community'] == 1) ? 1 : 0;

		$id = $edt->save()->getInsertId();

		$edt->clearValues()->setModel('WowCarousel')->setType('insert');
		$edt->id = $id;
		$edt->image = $f['name']['header_image'];
		$edt->title_es = $_POST['news']['title'];
		$edt->desc_es = $_POST['carousel']['text'];
		$edt->url = '/wow/blog/' . $id . '#blog';
		$edt->active = (isset($_POST['carousel']['active']) && $_POST['carousel']['active'] == 1) ? 1 : 0;
		$edt->save()->clearValues();

		$this->core->redirectApp('/admin/news');

		return true;
	}

	public function getForumCategories()
	{
		return $this->c('QueryResult', 'Db')
			->model('WowForumCategory')
			->loadItems();
	}

	public function deleteForumCat()
	{
		$id = (int) $this->core->getUrlAction(3);

		$this->c('Editing')->clearValues()->setModel('WowForumCategory')->setType('delete')->setId($id)->delete()->save()->clearValues();

		$this->core->redirectApp('/admin/forums/');
	}

	public function getEditableCategory()
	{
		$id = (int) $this->core->getUrlAction(3);

		return $this->c('QueryResult', 'Db')
			->model('WowForumCategory')
			->fieldCondition('cat_id', ' = ' . $id)
			->loadItem();
	}

	public function editForumCat()
	{
		if (!isset($_POST['cat']))
			return false;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowForumCategory')
			->setType('update')
			->setId($_POST['cat']['id']);

		foreach ($_POST['cat'] as $k => $v)
			if ($k != 'id' && $k != 'isNew')
				$edt->{$k} = $v;

		if (!isset($_POST['cat']['short']))
			$edt->short = '0';
		else
			$edt->short = '1';

		if (!isset($_POST['cat']['header']))
			$edt->header = '0';
		else
			$edt->header = '1';

		$edt->save()->clearValues();

		$this->core->redirectApp('/admin/forums/');
	}

	public function addForumCat()
	{
		if (!isset($_POST['cat']))
			return false;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowForumCategory')
			->setType('insert');

		foreach ($_POST['cat'] as $k => $v)
			if (!in_array($k, array('id', 'isNew', 'title', 'desc')))
				$edt->{$k} = $v;

		$edt->title_es = $_POST['cat']['title'];
		$edt->desc_es = $_POST['cat']['desc'];

		if (!isset($_POST['cat']['short']))
			$edt->short = '0';
		else
			$edt->short = '1';

		if (!isset($_POST['cat']['header']))
			$edt->header = '0';
		else
			$edt->header = '1';

		$edt->save()->clearValues();

		$this->core->redirectApp('/admin/forums/');
	}

	public function getAdminUsers()
	{
		$users = $this->c('QueryResult', 'Db')
			->model('WowAccounts')
			->keyIndex('game_id')
			->loadItems();

		if (!$users)
			return false;

		$games = $this->c('QueryResult', 'Db')
			->model('Account')
			->fieldCondition('id', array_keys($users))
			->keyIndex('id')
			->loadItems();

		if (!$games)
			return false;

		foreach ($games as $g)
			if (isset($users[$g['id']]))
				$users[$g['id']]['name'] = $g['username'];

		return $users;
	}

	public function getEditableUser()
	{
		return $this->c('QueryResult', 'Db')
			->model('WowAccounts')
			->setItemId(intval($this->core->getUrlAction(3)))
			->loadItem();
	}

	public function editUser()
	{
		if (!isset($_POST['user']))
			return false;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowAccounts')
			->setType('update')
			->setId(intval($this->core->getUrlAction(3)));

		$edt->forums_name = $_POST['user']['forums_name'];

		$edt->save()->clearValues();

		$this->core->redirectApp('/admin/users/');

		return true;
	}

	public function deleteUser()
	{
		$id = (int) $this->core->getUrlAction(3);

		$this->c('Editing')->clearValues()->setModel('WowAccounts')->setType('delete')->setId($id)->delete()->save()->clearValues();

		$this->core->redirectApp('/admin/users/');
	}

	public function addUser()
	{
		if (!isset($_POST['user']))
			return false;

		$user = $this->c('QueryResult', 'Db')
			->model('Account')
			->fieldCondition('username', ' = \'' . addslashes($_POST['user']['username']) . '\'')
			->loadItem();

		if (!$user)
			return false;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowAccounts')
			->setType('insert');

		$edt->id = $user['id'];
		$edt->game_id = $user['id'];
		$edt->forums_name = $_POST['user']['forums_name'];

		$edt->save()->clearValues();

		$this->core->redirectApp('/admin/users/');

		return true;
	}
}
?>