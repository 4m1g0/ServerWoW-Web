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

class Store_Component extends Component
{
	protected $m_storeSession = array();
	protected $m_categories = array();
	protected $m_items = array();
	protected $m_categoryId = 0;
	protected $m_category = array();
	protected $m_itemId = 0;
	protected $m_item = array();
	protected $m_cart = array();
	protected $m_bcData = array();
	protected $m_rawCategories = array();
	protected $m_rawBc = array();
	protected $m_allowedAPIMethods = array(
		'add2cart', 'removefromcart', 'buyoutall', 'buyoutitem'
	);
	protected $m_apiMethod = '';
	protected $m_apiData = array();
	protected $m_apiMethodResult = array();
	protected $m_menuItems = array();

	public function initStore($catId, $itemId)
	{
		if ($itemId > 0)
			$this->loadItem($itemId, $catId)->handleItem();
		elseif ($catId > 0)
			$this->loadCategory($catId)->handleCategory();

		$this->m_categoryId = $catId;
		$this->m_itemId = $itemId;
		$this->loadStore()->handleStore()->initCart();

		return $this;
	}

	public function initApi($method)
	{
		if (!in_array($method, $this->m_allowedAPIMethods))
			return $this;

		$this->m_apiMethod = $method;
		$data = explode('&', $_POST['store']);

		if (!isset($data[1]))
			return $this;

		$this->m_apiData = array();
		foreach ($data as $d)
		{
			$t = explode('=', $d);
			if (isset($t[1]))
				$this->m_apiData[trim($t[0])] = trim($t[1]);
		}

		return $this->handleApiMethod();
	}

	protected function handleApiMethod()
	{
		if (!$this->m_apiMethod || !$this->m_apiData)
			return $this;

		if (!isset($this->m_apiData['seed']))
			return $this;
		elseif ($this->m_apiData['seed'] != $this->c('Cookie')->read('xstoken'))
			return $this;

		$result = false;
		$xstoken = $this->m_apiData['seed'];
		$rData = array();
		switch ($this->m_apiMethod)
		{
			case 'add2cart':
				$result = $this->addToCart($this->m_apiData['item'], $this->m_apiData['category'], $this->m_apiData['quantity']);
				if ($result)
					$rData = array('err' => 'none', 'success' => true, 'method' => 'add2cart', 'id' => $this->m_apiData['item']);
				break;
			case 'removefromcart':
				$result = $this->removeFromCart($this->m_apiData['item']);
				if ($result)
					$rData = array('err' => 'none', 'success' => true, 'method' => 'removefromcart', 'id' => $this->m_apiData['item']);
			default:
				$result = false;
				if ($result)
					$rData = array('err' => 'unknown_method', 'success' => false);
				break;
		}

		$rData['time'] = time();
		$rData['xstoken'] = $xstoken;

		$this->m_apiMethodResult = $rData;

		return $this;
	}

	public function getApiMethodResult()
	{
		return $this->m_apiMethodResult;
	}

	protected function loadItem($itemId, $catId)
	{
		if (!$itemId)
			return $this;

		$this->m_item = array('store' => array(), 'template' => array());

		$this->m_item['store'] = $this->c('QueryResult', 'Db')
			->model('WowStoreItems')
			->setItemId(intval($itemId))
			->loadItem();

		if (!$this->m_item['store'])
			return $this;

		if ($this->m_item['store']['service_type'] == 0)
		{
			$this->m_item['template'] = $this->c('Item')->getItemsInfo($itemId);

			if (!$this->m_item['template'])
				return $this;
		}
		else
		{
			foreach ($GLOBALS['_STORE_SERVICES'] as $srv)
				if ($srv[0] == $this->m_item['store']['service_type'])
					$this->m_item['service'] = array('id' => $srv[0], 'name' => $srv[1]);
		}

		return $this;
	}

	protected function handleItem()
	{
		return $this;
	}

	protected function loadCategory($catId)
	{
		$this->m_category = $this->c('QueryResult', 'Db')
			->model('WowStoreCategories')
			->setItemId($catId)
			->loadItem();

		$items = $this->c('QueryResult', 'Db')
			->model('WowStoreItems')
			->fieldCondition('cat_id', ' = ' . $catId)
			->keyIndex('item_id')
			->loadItems();

		if (!$items)
			return $this;

		$ids = array_keys($items);
		$data = $this->c('Item')->getItemsInfo($ids, true);

		if (!$data)
			return $this;

		$this->m_items[$this->m_category['cat_id']] = array();

		foreach ($data as $i)
			$this->m_items[$this->m_category['cat_id']][$i['entry']] = array(
				'info' => $i,
				'store' => $items[$i['entry']]
			);

		return $this;
	}

	protected function handleCategory()
	{
		return $this;
	}

	protected function loadStore()
	{
		$this->m_categories = $this->c('QueryResult', 'Db')
			->model('WowStoreCategories')
			->keyIndex('cat_id')
			->loadItems();

		return $this;
	}

	protected function handleStore()
	{
		if (!$this->m_categories)
			return $this;

		$tree = array();

		// Save raw
		$this->m_rawCategories = $this->m_categories;

		$m = &$this->m_categories;
		$exclude = array();
		foreach ($this->m_categories as $c)
		{
			if (!$this->m_categoryId && $c['parent_id'] == -1)
				$this->m_menuItems[] = $c;
			elseif ($this->m_categoryId > 0 && $c['parent_id'] == $this->m_categoryId)
				$this->m_menuItems[] = $c;

			$tree[$c['cat_id']] = array('info' => $c, 'child' => array());
			if ($c['parent_id'] > 0 && !in_array($c['parent_id'], $tree[$c['cat_id']]))
			{
				$tree[$c['cat_id']]['parent'][$c['parent_id']] = $c['parent_id'];
				$pid = $c['parent_id'];
				$cid = $c['cat_id'];
				if (isset($tree[$pid]) && !isset($tree[$pid]['child'][$cid]))
				{
					$tree[$pid]['child'][$cid] = array('info' => $c, 'child' => array());
					$exclude[] = $cid;
				}
			}
		}

		foreach ($m as $c)
		{
			$cid = $c['cat_id'];
			$pid = $c['parent_id'];

			if ($pid <= 0)
				continue;

			// Count how much Ps in these variables' names :D

			$ppid = $m[$pid]['parent_id'];
			if ($ppid > 0)
			{
				$pppid = $m[$ppid]['parent_id'];
				if ($pppid > 0)
				{
					$ppppid = $m[$pppid]['parent_id'];
					if ($ppppid > 0)
					{
						$tree[$ppppid]['child'][$pppid]['child'][$ppid]['child'][$pid]['child'][$cid] = array('info' => $c, 'child' => array());
						$exclude[] = $cid;
					}
					else
					{
						$tree[$pppid]['child'][$ppid]['child'][$pid]['child'][$cid] = array('info' => $c, 'child' => array());
						$exclude[] = $cid;
					}
				}
				elseif (isset($tree[$ppid]))
				{
					$tree[$ppid]['child'][$pid]['child'][$cid] = array('info' => $c, 'child' => array());
					$exclude[] = $cid;
				}
			}
		}

		foreach ($exclude as $ex)
			if (isset($tree[$ex]))
				unset($tree[$ex]);

		$this->m_categories = $tree;

		$this->postHandleCategories();

		$this->m_bcData = array();

		$this->getBreadcrumbInfo();

		return $this;
	}

	protected function postHandleCategories()
	{
		return $this;
	}

	public function getCategories()
	{
		return $this->m_categories;
	}

	public function getMenuItems()
	{
		return $this->m_menuItems;
	}

	public function getBreadcrumbInfo()
	{
		if ($this->m_bcData)
			return $this->m_bcData;

		$this->m_bcData = array();

		// Generate path
		$this->findBc($this->m_categoryId);

		// Reverse
		$this->m_bcData = array_reverse($this->m_bcData);

		// Add last idx
		$this->m_bcData[] = $this->m_categoryId;

		// Generate BC
		$bc = array();
		$bc[] = array('link' => '', 'caption' => 'World of Warcraft');
		$bc[] = array('link' => 'store/', 'caption' => 'Store');

		foreach ($this->m_bcData as $catId)
		{
			if (!isset($this->m_rawCategories[$catId]))
				continue;

			$bc[] = array(
				'link' => 'store/' . $catId,
				'caption' => $this->m_rawCategories[$catId]['title']
			);
		}

		if ($this->m_item)
		{
			if ($this->m_item['store']['service_type'] == 0)
			{
				if ($this->m_itemId > 0 && $this->m_item['template'])
					$bc[] = array(
						'link' => 'store/' . $this->m_item['store']['cat_id'] . '/' . $this->m_item['template']['entry'],
						'caption' => $this->m_item['template']['name']
					);
			}
			elseif ($this->m_item['store']['service_type'] > 0)
			{
				$service_caption = '';

				foreach ($GLOBALS['_STORE_SERVICES'] as $serv)
					if ($serv[0] == $this->m_item['store']['service_type'])
						$service_caption = $serv[1];

				$bc[] = array(
					'link' => 'store/' . $this->m_item['store']['cat_id'] . '/' . $this->m_item['store']['item_id'],
					'caption' => $service_caption ? $service_caption : 'Unknown'
				);
			}
		}

		$this->m_rawBc = $this->m_bcData;
		$this->m_bcData = $bc;

		unset($bc);

		return $this->m_bcData;
	}

	protected function appendBC(&$entry)
	{
		$this->m_bcData[] = (int) $entry;

		return $this;
	}

	protected function findBC($catId)
	{
		if (!isset($this->m_rawCategories[$catId]))
			return false;

		if ($this->m_rawCategories[$catId]['parent_id'] > 0)
			return $this->appendBc($this->m_rawCategories[$catId]['parent_id'])->findBc($this->m_rawCategories[$catId]['parent_id']);

		return $this;
	}

	public function getItem()
	{
		return $this->m_item;
	}

	public function getItems()
	{
		return $this->m_items;
	}

	public function getCategoryId()
	{
		return $this->m_categoryId;
	}

	protected function initCart()
	{
		$this->m_cart = array();

		$cart_sess = $this->c('Session')->getSession('wowstoreitems');

		if (!$cart_sess)
			return $this;

		if (strpos($cart_sess, ' ') === false)
			return $this;

		$items = explode(' ', $cart_sess);

		$ids = array();
		$quant = array();
		foreach ($items as &$i)
		{
			$i = str_replace(' ', '', $i);
			$iq = explode(':', $i);
			if (isset($iq[1]))
			{
				$ids[] = $iq[0];
				$quant[$iq[0]] = $iq[1];
			}
		}

		unset($items[sizeof($items) - 1]); // Remove empty key

		$store_items = $this->c('QueryResult', 'Db')
			->model('WowStoreItems')
			->addModel('WowStoreCategories')
			->join('left', 'WowStoreCategories', 'WowStoreItems', 'cat_id', 'cat_id')
			->fieldCondition('wow_store_items.item_id', array_values($ids))
			->setAlias('WowStoreCategories', 'title', 'catTitle')
			->keyIndex('item_id')
			->loadItems();

		if (!$store_items)
			return $this;

		foreach ($store_items as &$it)
			$it['quantity'] = $quant[$it['item_id']];

		$this->m_cart = $store_items;

		return $this;
	}

	public function getCart()
	{
		return $this->m_cart;
	}

	public function getCartItems()
	{
		$ids = array();
		$services = array();

		foreach ($this->m_cart as $id => $item)
		{
			if ($item['service_type'] == 0)
				$ids[] = $id;
			else
				$services[$item['item_id']] = $item['service_type'];
		}

		if (!$ids && !$services)
			return false;

		$cart_items = array();

		if ($ids)
		{
			$items = $this->c('Item')->getItemsInfo($ids, true);

			if (!$items)
				return false;

			foreach ($items as &$i)
				$i['storeInfo'] = $this->m_cart[$i['entry']];

			$cart_items = array_merge($cart_items, $items);
		}

		if ($services)
		{
			$srv = array();
			foreach ($services as $sId => $s)
			{
				foreach ($GLOBALS['_STORE_SERVICES'] as $serv)
				{
					if ($serv[0] == $s)
						$srv[$sId] = array('id' => $serv[0], 'name' => $serv[1], 'storeInfo' => $this->m_cart[$sId]);
				}
			}

			$cart_items = array_merge($cart_items, $srv);
		}

		return $cart_items;
	}

	public function getTotalPrice()
	{
		if (!$this->m_cart)
			return 0;

		$price = 0;
		foreach ($this->m_cart as $i)
			$price += ($i['price'] * $i['quantity']);

		return $price;
	}

	public function getItemsInCategory()
	{
		$q= $this->c('QueryResult', 'Db')
			->model('WowStoreItems')
			->addModel('WowStoreCategories')
			->join('left', 'WowStoreCategories', 'WowStoreItems', 'cat_id', 'cat_id');

		if ($this->m_categoryId > 0)
		{
			$cat_ids = array();
			$this->getBreadcrumbInfo();
			$cid = $this->m_categoryId;
			$found = false;
			while ($cid > 0)
			{
				$found = false;
				foreach ($this->m_rawCategories as $c)
					if ($c['parent_id'] == $cid)
					{
						$cat_ids[] = $c['cat_id'];
						$cid = $c['cat_id'];
						$found = true;
					}
				if (!$found)
					break;
			}
			$cond = $cat_ids ? $cat_ids : ' = ' . $this->m_categoryId;

			$q->fieldCondition('wow_store_items.cat_id', $cond);
		}

		$ids = $q->limit(20, 20 * $this->getPage(true))
			->keyIndex('item_id')
			->setAlias('WowStoreCategories', 'title', 'catTitle')
			->loadItems();

		if (!$ids)
			return false;

		$item_ids = array();
		$services = array();

		foreach ($ids as $item)
		{
			if ($item['service_type'] == 0)
				$item_ids[$item['item_id']] = $item['item_id'];
			elseif ($item['service_type'] > 0)
			{
				foreach ($GLOBALS['_STORE_SERVICES'] as $srv)
				{
					if ($srv[0] == $item['service_type'])
						$services[$item['item_id']] = array('id' => $srv[0], 'name' => $srv[1], 'storeInfo' => $item);
				}
			}
		}

		$store_items = array();

		if ($item_ids)
		{
			$items = $this->c('Item')->getItemsInfo($item_ids);

			if ($items)
			{
				foreach ($items as &$it)
					$it['storeInfo'] = $ids[$it['entry']];

				$store_items = array_merge($store_items, $items);
			}
		}

		if ($services)
			$store_items = array_merge($store_items, $services);

		return $store_items;
	}

	public function isCorrect()
	{
		if (isset($this->m_apiData['seed']) && $this->m_apiData['seed'] == $this->c('Cookie')->read('xstoken'))
			return true;

		return false;
	}

	public function addToCart($itemId, $catId, $quantity = 1)
	{
		if (!$this->isCorrect())
			return false;

		$this->c('Session')->setSession('wowstoreitems', $this->c('Session')->getSession('wowstoreitems') . $itemId . ':' . $quantity . ' ');

		$this->initCart();

		return $this;
	}

	public function removeFromCart($itemId)
	{
		if (!$this->isCorrect())
			return false;

		$items = explode(' ', $this->c('Session')->getSession('wowstoreitems'));

		$new = '';

		if (is_array($items))
		{
			foreach ($items as $i)
			{
				if (!preg_match('/' . $itemId . '\:/', trim($i)))
					$new .= $i . ' ';
			}

			$this->c('Session')->setSession('wowstoreitems', $new);
		}

		return $this;
	}

	public function dropCart()
	{
		if (!$this->isCorrect())
			return false;

		$this->c('Session')->setSession('wowstoreitems', '');

		return true;
	}

	public function isItemInCart($item)
	{
		return preg_match('/' . $item . '\:/', $this->c('Session')->getSession('wowstoreitems'));
	}

	public function performBuyout()
	{
		if (!$this->isCorrect())
			return false;

		$performed = array();

		foreach ($this->m_cart as $item)
		{
			if ($this->c('AccountManager')->changeBonus($item['price'], -1))
			{
				if ($item['service_type'] > 0)
					$this->performCharacterOperation($item['service_type'], intval($_POST['guid']), intval($_POST['realmId']), $_POST['service_data']);
				else
					$this->sendItemMail($item['item_id'], $item['quantity'], intval($_POST['guid']), intval($_POST['realmId']));

				$performed[] = $item;
			}
			else
				break;
		}

		return $this->setBuyoutResult($performed);
	}

	protected function setBuyoutResult()
	{
		if (!$this->isCorrect())
			return $this;

		return $this;
	}

	protected function sendItemMail($itemId, $quantity, $guid, $realmId)
	{
		$this->c('Db')->switchTo('characters', $realmId);

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('MailExternal')
			->setType('insert');

		$edt->acct = $this->c('AccountManager')->user('id');
		$edt->receiver = $guid;
		$edt->subject = 'World of Warcraft Store';
		$edt->message = '$N,$B this mail contains the item you bought.$B$BThank you for using our online store!';
		$edt->item = $itemId;
		$edt->item_count = $quanitity;
		$edt->date = time(); //

		$edt->save()->clearValues();

		return $this;
	}

	protected function performCharacterOperation($operation_type, $guid, $realmId, $data = null)
	{
		if (!$this->c('AccountManager')->isLoggedIn())
			return $this;

		$this->c('Db')->switchTo('characters', $realmId);

		$op_result = false;

		switch ($operation_type)
		{
			case SERVICE_CUSTOMIZE_CHARACTER:
				$this->c('Db')->characters()->query("UPDATE characters SET at_login = at_login | 0x08 WHERE guid = %d", $guid);
				break;
			case SERVICE_CHANGE_FACTION:
				$this->c('Db')->characters()->query("UPDATE characters SET at_login = at_login | 0x40 WHERE guid = %d", $guid);
				break;
			case SERVICE_CHANGE_RACE:
				$this->c('Db')->characters()->query("UPDATE characters SET at_login = at_login | 0x80 WHERE guid = %d", $guid);
				break;
			case SERVICE_CHANGE_PASSWORD:
				if ((!isset($data['newpassword']) || !$data['newpassword']))
					return $this;

				$this->c('Db')->realm()->query("UPDATE account SET sha_pass_hash = '%s' WHERE id = %d", sha1(strtoupper($this->c('AccountManager')->user('username')) . ':' . strtoupper($data['newpassword'])), $this->c('AccountManager')->user('id'));
				break;
			case SERVICE_CHARACTER_ACCOUNT_TRANSFER:
				if (!isset($data['newaccount']) || !$data['newaccount'] || $data['newaccount'] == $this->c('AccountManager')->user('id'))
					return $this;

				$this->c('Db')->characters()->query("UPDATE characters SET account = %d WHERE account = %d AND guid = %d LIMIT 1", $data['newaccount'], $this->c('AccountManager')->user('id'), $guid);
				break;
			case SERVICE_RENAME_CHARACTER:
				$this->c('Db')->characters()->query("UPDATE characters SET at_login = at_login | 0x01 WHERE guid = %d", $guid);
				break;
			default:
				return $this;
		}

		$op_result = true;

		return $this;
	}
}
?>