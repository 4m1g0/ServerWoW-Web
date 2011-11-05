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

class Admin_Controller_Component extends Controller_Component
{
	protected $m_action = 'default';
	protected $m_subaction = array();

	protected function checkInfo()
	{
		if (!$this->c('AccountManager')->isLoggedIn())
			return false;
		elseif (!$this->c('AccountManager')->isAdmin())
			return false;

		if ($this->core->getUrlAction(1) != null)
			$this->m_action = strtolower($this->core->getUrlAction(1));

		for ($i = 2; $i < 5; ++$i)
			if ($this->core->getUrlAction($i) != null)
				$this->m_subaction[$i - 2] = $this->core->getUrlAction($i);

		return true;
	}

	public function build($core)
	{
		if (!$this->checkInfo())
		{
			$this->setErrorPage();
			$this->c('Default', 'Controller');
			return $this;
		}

		switch ($this->m_action)
		{
			case 'news':
				if (isset($this->m_subaction[0]) && $this->m_subaction[0])
				{
					switch ($this->m_subaction[0])
					{
						case 'edit':
							if (isset($this->m_subaction[1]) && $this->m_subaction[1])
							{
								if (isset($_POST['news']))
									$this->c('Admin')->editNews($this->m_subaction[1]);

								$this->buildBlock('newsEdit');
							}
							break;
						case 'delete':
							if ($this->m_subaction[1])
								$this->c('Admin')->deleteNewsItem($this->m_subaction[1]);
							break;
						case 'deleteAll':
							$this->c('Admin')->deleteAllNews();
							break;
						case 'add':
							if (isset($_POST['news']))
								$this->c('Admin')->addNews();
							$this->buildBlock('newsAdd');
							break;
					}
				}
				else
					$this->buildBlock($this->m_action);
				break;
			case 'configs':
				if (isset($this->m_subaction[0]) && $this->m_subaction[0])
				{
					switch ($this->m_subaction[0])
					{
						case 'site':
							if (isset($_POST['site']))
								$this->c('Admin')->saveSiteConfigs();
							$this->buildBlock('siteconfigs');
							break;
						case 'realms':
							if (isset($_POST['realm']))
								$this->c('Admin')->saveRealmsConfigs();
							if (isset($this->m_subaction[1]) && $this->m_subaction[1] == 'edit' && isset($this->m_subaction[2]) && $this->m_subaction[2] > 0)
								$this->buildBlock('editrealm');
							elseif (isset($this->m_subaction[1]) && $this->m_subaction[1] == 'add')
								$this->buildBlock('addrealm');
							elseif (isset($this->m_subaction[1]) && $this->m_subaction[1] == 'delete' && isset($this->m_subaction[2]) && $this->m_subaction[2] > 0)
								$this->c('Admin')->deleteRealm($this->m_subaction[2]);
							else
								$this->buildBlock('realmsconfigs');
							break;
						case 'mysql':
							if (isset($_POST['mysql']))
								$this->c('Admin')->saveMySQLConfigs();
							$this->buildBlock('mysqlconfigs');
							break;
					}
				}
				else
					$this->buildBlock($this->m_action);
				break;
			case 'forums':
				if (isset($this->m_subaction[0]) && $this->m_subaction[0])
				{
					switch ($this->m_subaction[0])
					{
						case 'add':
							if (isset ($_POST['cat']))
								$this->c('Admin')->addForumCat();
							$this->buildBlock('addforumcategory');
							break;
						case 'edit':
							if (isset ($_POST['cat']))
								$this->c('Admin')->editForumCat();
							$this->buildBlock('editforumcategory');
							break;
						case 'delete':
							$this->c('Admin')->deleteForumCat();
							break;
					}
				}
				else
					$this->buildBlock($this->m_action);
				break;
			case 'users':
				if (isset($this->m_subaction[0]) && $this->m_subaction[0])
				{
					switch ($this->m_subaction[0])
					{
						case 'add':
							if (isset ($_POST['user']))
								$this->c('Admin')->addUser();
							$this->buildBlock('adduser');
							break;
						case 'edit':
							if (isset ($_POST['user']))
								$this->c('Admin')->editUser();
							$this->buildBlock('edituser');
							break;
						case 'delete':
							$this->c('Admin')->deleteUser();
							break;
					}
				}
				else
					$this->buildBlock($this->m_action);
				break;
			case 'default':
				$this->buildBlock($this->m_action);
				break;
			case 'store':
				if (isset($this->m_subaction[0]) && $this->m_subaction[0])
				{
					switch ($this->m_subaction[0])
					{
						case 'category':
							if (isset($this->m_subaction[1]) && $this->m_subaction[1])
							{
								if ($this->m_subaction[1] == 'add')
								{
									if (isset($_POST['cat']))
										$this->c('Admin')->addStoreCategory();
									$this->buildBlock('addStoreCategory');
								}
								elseif (intval($this->m_subaction[1]) == $this->m_subaction[1])
								{
									if (isset($this->m_subaction[2]) && $this->m_subaction[2])
									{
										switch ($this->m_subaction[2])
										{
											case 'edit':
												if (isset($_POST['cat']))
													$this->c('Admin')->editStoreCategory();
												$this->buildBlock('editStoreCategory');
												break;
											case 'delete':
												$this->c('Admin')->deleteStoreCategory($this->m_subaction[1]);
												break;
											case 'items':
												if (isset($_POST['cat']))
													$this->c('Admin')->editStoreCategoryItems();
												$this->buildBlock('editStoreCategoryItems');
												break;
										}
									}
								}
							}
							break;
						case 'item':
							if (isset($this->m_subaction[1]) && $this->m_subaction[1])
							{
								if ($this->m_subaction[1] == 'add')
								{
									if (isset($_POST['item']))
										$this->c('Admin')->addStoreItem();
									$this->buildBlock('addStoreItem');
								}
								elseif (intval($this->m_subaction[1]) == $this->m_subaction[1])
								{
									if (isset($this->m_subaction[2]) && $this->m_subaction[2])
									{
										switch ($this->m_subaction[2])
										{
											case 'edit':
												if (isset($_POST['item']))
													$this->c('Admin')->editStoreItem();
												$this->buildBlock('editStoreItem');
												break;
											case 'delete':
												$this->c('Admin')->deleteStoreItem($this->m_subaction[1]);
												break;
										}
									}
								}
							}
							break;
					}
				}
				$this->buildBlock('store');
				break;
		}

		$this->buildBlock('main');

		return $this;
	}

	protected function block_editStoreCategoryItems()
	{
		return $this->block()
			->setTemplate('editstorecatitems', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_addStoreItem()
	{
		return $this->block()
			->setTemplate('addstoreitem', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_editStoreItem()
	{
		return $this->block()
			->setTemplate('editstoreitem', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_store()
	{
		return $this->block()
			->setTemplate('store', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_editStoreCategory()
	{
		return $this->block()
			->setTemplate('editstorecat', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_addStoreCategory()
	{
		return $this->block()
			->setTemplate('addstorecat', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_forums()
	{
		return $this->block()
			->setTemplate('forums', 'admin' . DS . 'contents' . DS)
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_editforumcategory()
	{
		return $this->block()
			->setTemplate('editforumcategory', 'admin' . DS . 'contents' . DS)
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_addforumcategory()
	{
		return $this->block()
			->setTemplate('addforumcategory', 'admin' . DS . 'contents' . DS)
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_siteconfigs()
	{
		return $this->block()
			->setTemplate('siteconfigs', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_users()
	{
		return $this->block()
			->setTemplate('users', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_edituser()
	{
		return $this->block()
			->setTemplate('edituser', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_adduser()
	{
		return $this->block()
			->setTemplate('adduser', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_realmsconfigs()
	{
		return $this->block()
			->setTemplate('realmsconfigs', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_editrealm()
	{
		return $this->block()
			->setTemplate('editrealm', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_addrealm()
	{
		return $this->block()
			->setTemplate('addrealm', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_mysqlconfigs()
	{
		return $this->block()
			->setTemplate('mysqlconfigs', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_newsAdd()
	{
		return $this->block()
			->setTemplate('addnews', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_main()
	{
		return $this->block()
			->setTemplate('main', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('pagecontent');
	}

	protected function block_news()
	{
		return $this->block()
			->setTemplate('news', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_newsEdit()
	{
		return $this->block()
			->setTemplate('editnews', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_default()
	{
		return $this->block()
			->setTemplate('default', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}

	protected function block_configs()
	{
		return $this->block()
			->setTemplate('configs', 'admin' . DS . 'contents')
			->setVar('admin', $this->c('Admin'))
			->setRegion('adminpage');
	}
}
?>