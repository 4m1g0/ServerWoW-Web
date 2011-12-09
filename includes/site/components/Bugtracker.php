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

class Bugtracker_Component extends Component
{
	protected $m_currentType = '';
	protected $m_items = array();
	protected $m_bugId = 0;
	protected $m_item = array();
	protected $m_isCategory = true;
	protected $m_isApi = false;
	protected $m_apiResponse = array('type' => 'unknown', 'error' => 'Unknown type', 'errno' => 1);

	public function isCorrect()
	{
		return ($this->m_items) || ($this->m_item);
	}

	public function isCategory()
	{
		return $this->m_isCategory;
	}

	public function initialize()
	{
		if ($this->core->getUrlAction(2) == 'bug')
		{
			$this->m_bugId = intval($this->core->getUrlAction(3));
			$this->m_isCategory = false;
		}
		elseif ($this->core->getUrlAction(2) == 'api')
			$this->m_isApi = true;
		else
			$this->m_currentType = $this->core->getUrlAction(2);

		if (!$this->m_isApi)
		{
			if ($this->isCategory())
				$this->loadItems();
			else
				$this->loadItem();
		}
		else
			$this->initApi();

		return $this;
	}

	protected function initApi()
	{
		if (!$this->m_isApi)
			return $this;

		if (!isset($_GET['type']))
			return $this;

		if (!isset($_GET['xstoken']))
			return $this;

		if (!isset($_GET['id']))
			return $this;

		if (!$this->c('AccountManager')->isLoggedIn())
			return $this;

		if ($_GET['xstoken'] != $this->c('Cookie')->read('xstoken'))
			return $this;

		$this->loadItem($_GET['id']);

		if (!$this->m_item && $_GET['type'] != 'find')
		{
			$this->m_apiResponse['errno'] = 2;
			$this->m_apiResponse['error'] = 'Bug Report was not found!';
			$this->m_apiResponse['type'] = $_GET['type'];

			return $this;
		}

		switch ($_GET['type'])
		{
			case 'delete':
			case 'response':
			case 'deleteComment':
				return $this->runAdminApiAction($_GET['type']);
			default:
				return $this->runApiAction($_GET['type']);
		}

		return $this;
	}

	protected function runApiAction($action)
	{
		if ($this->m_item)
		{
			if (!$this->c('AccountManager')->isAccountCharacter($this->m_item['realmId'], $this->m_item['guid']) && !$this->c('AccountManager')->isAllowedToBugtracker())
			{
				$this->m_apiResponse['errno'] = 3;
				$this->m_apiResponse['error'] = 'You are not allowed to perform any action under this bug report!';
				$this->m_apiResponse['type'] = $_GET['type'];

				return $this;
			}
		}
		else
		{
			if ($_GET['type'] != 'find')
				return $this;
		}

		$edt = null;
		if ($this->m_item)
		{
			$edt = $this->c('Editing')
				->clearValues()
				->setModel('WowBugtrackerItems')
				->setType('update')
				->setId($this->m_item['id']);
		}
		switch ($action)
		{
			case 'edit':
				$opened = intval($_POST['status']);
				$priority = intval($_POST['priority']);
				$desc = $_POST['desc'];

				$edited = array();

				$edt->closed = $opened;
				$edt->priority = $priority;

				$statusColors = array(0 => array('#ffff00', 'Abierto', 0), 1 => array('#00ff00', 'Cerrado', 1));
				$priorityColors = array(1 => array('#00ff00', 'Baja', 1), 2 => array('#ffff00', 'Media', 2), 3 => array('#ff0000', 'Alta', 3));
				$edited['status'] = $statusColors[$opened];
				$edited['bugpriority'] = $priorityColors[$priority];

				$edt->description = $desc;
				$edited['bugdescription'] = $desc;

				$edt->save()->clearValues();
				$this->m_apiResponse = array(
					'errno' => 0,
					'type' => $_GET['type'],
					'error' => 'none',
					'success' => true,
					'editedFields' => $edited
				);
				break;
			case 'solve':
				$edited = array('status' => array());
				if ($_POST['solved'] == 0)
				{
					$edt->status = '0';
					$edited['status'] = array('#ff0000', 'No');
				}
				else if ($_POST['solved'] == 1)
				{
					$edt->status = 1;
					$edited['status'] = array('#00ff00', 'Si');
				}
				else // $_POST['solved'] == 2
				{
				    $edt->status = 2;
					$edited['status'] = array('#cccccc', 'Desestimado');
				}
				$edt->save()->clearValues();
				
				$this->m_apiResponse = array(
					'errno' => 0,
					'type' => $action,
					'error' => 'none',
					'success' => true,
					'editedFields' => $edited
				);
				break;
			case 'close':
				$edited = array('closed' => array());
				if ($_POST['closed'] == 0)
				{
					$edt->closed = '0';
					$edited['closed'] = array('#ffff00', 'Abierto');
				}
				else
				{
					$edt->closed = 1;
					$edited['closed'] = array('#00ff00', 'Cerrado');
				}
				$edt->save()->clearValues();
				
				$this->m_apiResponse = array(
					'errno' => 0,
					'type' => $action,
					'error' => 'none',
					'success' => true,
					'editedFields' => $edited
				);
				break;
			case 'find':
				$this->m_apiResponse = array(
					'errno' => 0,
					'type' => $action,
					'error' => 'none',
					'success' => true,
					'found' => false
				);

				$id = intval($_POST['id']);
				$type = intval($_POST['type']);

				if (!$id || !$type)
					return $this;

				$item = $this->c('QueryResult', 'Db')
					->model('WowBugtrackerItems')
					->fields(array('WowBugtrackerItems' => array('id')))
					->fieldCondition('type', ' = ' . $type)
					->fieldCondition('item_id', ' = ' . $id)
					->loadItem();
				if ($item)
				{
					$this->m_apiResponse['found'] = true;
					$this->m_apiResponse['id'] = $item['id'];
					$this->m_apiResponse['url'] = $this->getWowUrl('bugtracker/bug/' . $item['id']);
				}
				break;
		}

		return $this;
	}

	protected function runAdminApiAction($action)
	{
		if (!$this->c('AccountManager')->isAllowedToBugtracker() && ($action == 'deleteComment' && !$this->c('AccountManager')->isAllowedToModerate()))
		{
			$this->m_apiResponse['errno'] = 4;
			$this->m_apiResponse['error'] = 'You are not allowed to perform current action under this bug report!';
			$this->m_apiResponse['type'] = $_GET['type'];

			return $this;
		}

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowBugtrackerItems')
			->setType('update')
			->setId($this->m_item['id']);

		switch ($action)
		{
			case 'deleteComment':
				$del = $this->c('Editing')
					->clearValues()
					->setModel('WowBugtrackerComments')
					->setId(intval($_POST['comment_id']))
					->setType('delete')
					->delete()
					->clearValues();
				
				$this->m_apiResponse = array(
					'errno' => 0,
					'type' => $action,
					'error' => 'none',
					'success' => true,
				);
				break;
			case 'response':
				$edt->admin_response = $_POST['message'];
				$edt->admin_id = $this->c('AccountManager')->user('id');
				$edt->response_date = time();
				$edt->save()->clearValues();
				$this->m_apiResponse = array(
					'errno' => 0,
					'type' => $action,
					'error' => 'none',
					'success' => true,
					'editedFields' => array('response' => $_POST['message'], 'date' => date('d/m/Y', time()), 'admin' => $this->c('AccountManager')->settings('forums_username', 'forums'))
				);
				break;
			case 'delete':
				$edt->delete();
				$this->m_apiResponse = array(
					'errno' => 0,
					'type' => $action,
					'error' => 'none',
					'success' => true,
					'editedFields' => array('delete' => true)
				);
				break;
		}
		return $this;
	}

	public function getApiResponse()
	{
		return $this->m_apiResponse;
	}

	protected function loadItems()
	{
		if (!$this->m_currentType)
			$this->loadDefaults();
		else
			$this->loadCategory();

		$this->handleItems();

		return $this;
	}

	protected function applyFilters(&$q)
	{
		$filters = array('priority', 'status', 'closed');

		$type = 'AND';

		if (isset($_GET['searchType']))
			$type = $_GET['searchType'] == '0' ? 'AND' : 'OR';

		foreach ($filters as $f)
		{
			if (!isset($_GET[$f]))
				continue;

			if ($_GET[$f] == '-1')
				continue;
			elseif ($_GET[$f] == '0' && !in_array($f, array('closed', 'status')))
				continue;

			$q->fieldCondition('wow_bugtracker_items.' . $f, ' = ' . intval($_GET[$f]), $type);
		}

		return $this;
	}

	protected function loadDefaults()
	{
		$q = $this->c('QueryResult', 'Db');

		$q->model('WowBugtrackerItems')
			->addModel('WowUserCharacters')
			->join('left', 'WowUserCharacters', 'WowBugtrackerItems', 'account_id', 'account')
			->join('left', 'WowUserCharacters', 'WowBugtrackerItems', 'character_realm', 'realmId')
			->join('left', 'WowUserCharacters', 'WowBugtrackerItems', 'character_guid', 'guid')
			->setAlias('WowUserCharacters', 'id', 'charId');

		$this->applyFilters($q);

		$this->m_items = $q
			->order(array('WowBugtrackerItems' => array('Priority', 'post_date')), 'DESC')
			->loadItems();

		return $this;
	}

	protected function loadCategory()
	{
		$q = $this->c('QueryResult', 'Db');

		$q->model('WowBugtrackerItems')
			->addModel('WowUserCharacters')
			->join('left', 'WowUserCharacters', 'WowBugtrackerItems', 'account_id', 'account')
			->join('left', 'WowUserCharacters', 'WowBugtrackerItems', 'character_realm', 'realmId')
			->join('left', 'WowUserCharacters', 'WowBugtrackerItems', 'character_guid', 'guid')
			->setAlias('WowUserCharacters', 'id', 'charId');

		$this->applyFilters($q);

		$this->m_items = $q
			->order(array('WowBugtrackerItems' => array('Priority', 'post_date')), 'DESC')
			->fieldCondition('wow_bugtracker_items.type', ' = ' . $this->getCategoryId())
			->loadItems();

		return $this;
	}

	protected function loadItem($id = 0)
	{
		if ($id == 0)
			$id = $this->m_bugId;

		if (!$id)
			return $this;

		$this->m_item = $this->c('QueryResult', 'Db')
			->model('WowBugtrackerItems')
			->addModel('WowUserCharacters')
			->join('left', 'WowUserCharacters', 'WowBugtrackerItems', 'account_id', 'account')
			->join('left', 'WowUserCharacters', 'WowBugtrackerItems', 'character_realm', 'realmId')
			->join('left', 'WowUserCharacters', 'WowBugtrackerItems', 'character_guid', 'guid')
			->setAlias('WowUserCharacters', 'id', 'charId')
			->fieldCondition('wow_bugtracker_items.id', ' = ' . $id)
			->loadItem();

		if (!$this->m_item)
			return $this;

		$this->m_item['comments'] = $this->c('QueryResult', 'Db')
			->model('WowBugtrackerComments')
			->addModel('WowUserCharacters')
			->join('left', 'WowUserCharacters', 'WowBugtrackerComments', 'account_id', 'account')
			->join('left', 'WowUserCharacters', 'WowBugtrackerComments', 'character_guid', 'guid')
			->join('left', 'WowUserCharacters', 'WowBugtrackerComments', 'character_realm', 'realmId')
			->fieldCondition('wow_bugtracker_comments.report_id', ' = ' . $this->m_item['id'])
			->setAlias('WowBugtrackerComments', 'id', 'comment_id')
			->order(array('WowBugtrackerComments' => array('post_date')), 'DESC')
			->loadItems();

		$this->handleItem($this->m_item);

		$wow_type = '';

		switch ($this->m_item['type'])
		{
			case BT_ITEM:
				$this->m_item['info'] = $this->c('Item')->getItemsInfo($this->m_item['item_id']);
				break;
			case BT_QUEST:
				$wow_type = 'QuestTemplate';
				break;
			case BT_OBJECT:
				$wow_type = 'GameobjectTemplate';
				break;
			case BT_NPC:
				$wow_type = 'CreatureTemplate';
				break;
			case BT_ZONE:
				$wow_type = 'WowAreas';
				break;
			case BT_SPELL:
				$wow_type = 'WowSpell';
				break;
		}

		if ($wow_type != null)
			$this->m_item['info'] = $this->c('Wow')->getWowInfo($wow_type, $this->m_item['item_id']);

		return $this;
	}

	public function addComment()
	{
		if (!$this->c('AccountManager')->isLoggedIn() || !isset($_POST['comment']['text']))
			return $this;

		$text = str_replace(array('<', '>'), array('&lt;', '&gt;'), $_POST['comment']['text']);

		if (!$text)
			return $this;

		$char = $this->c('AccountManager')->getActiveCharacter();

		if (!$char)
			return $this;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowBugtrackerComments')
			->setType('insert');

		$edt->report_id = intval($this->core->getUrlAction(3));
		$edt->account_id = $char['account'];
		$edt->character_guid = $char['guid'];
		$edt->character_realm = $char['realmId'];
		$edt->post_date = time();
		$edt->comment = $text;

		if ($this->c('AccountManager')->isAdmin())
			$edt->blizzard = 1;
		elseif ($this->c('AccountManager')->isAllowedToModerate())
			$edt->mvp = 1;

		$edt->save()->clearValues();

		return $this->core->redirectApp('/' . $this->core->getAppUrl());
	}

	public function getCategoryId()
	{
		switch ($this->m_currentType)
		{
			case 'web':
				return BT_WEB;
			case 'items':
				return BT_ITEM;
			case 'quests':
				return BT_QUEST;
			case 'spells':
				return BT_SPELL;
			case 'objects':
				return BT_OBJECT;
			case 'npcs':
				return BT_NPC;
			case 'zones':
				return BT_ZONE;
			case 'store':
				return BT_STORE;
			case 'others':
				return BT_OTHER;
			default:
				return BT_DEFAULT;
		}
	}

	public function getCategoryName($id = -1)
	{
		if ($id <= 0)
			$id = $this->getCategoryId();

		return $this->c('Locale')->getString('template_bt_section_' . $this->getCategoryAddress($id) . '_item');
	}

	public function getCategoryAddress($id = -1)
	{
		if ($id <= 0)
			$id = $this->getCategoryId();

		switch ($id)
		{
			case BT_WEB:
				return 'web';
			case BT_ITEM:
				return 'items';
			case BT_QUEST:
				return 'quests';
			case BT_SPELL:
				return 'spells';
			case BT_OBJECT:
				return 'objects';
			case BT_NPC:
				return 'npcs';
			case BT_ZONE:
				return 'zones';
			case BT_STORE:
				return 'store';
			case BT_OTHER:
				return 'others';
			case BT_DEFAULT:
				return 'Default';
		}
	}

	public function item($field)
	{
		return isset($this->m_item[$field]) ? $this->m_item[$field] : false;
	}

	protected function handleItems()
	{
		if (!$this->m_items)
			return $this;

		$cat = array();

		foreach ($this->m_items as $item)
		{
			if ($this->getCategoryId() > 0)
				if ($item['type'] != $this->getCategoryId())
					continue;

			$this->handleItem($item);
			$cat[] = $item;
		}

		$this->m_items = $cat;

		return $this;
	}

	protected function handleItem(&$item)
	{
		if (!$item)
			return $this;

		if (!in_array($item['type'], array(BT_OTHER, BT_DEFAULT, BT_WEB, BT_STORE)))
			$item['title'] = $this->getCategoryName($item['type']) . ' #' . $item['item_id'];
		elseif (!$item['title'])
			$item['title'] = $this->getCategoryName($item['type']) . ' #' . $item['id'];

		$item['categoryName'] = $this->getCategoryName($item['type']);
		$item['type_str'] = $this->getCategoryAddress($item['type']);
		$item['admin_name'] = '';

		if ($item['admin_id'] > 0)
		{
			$adm = $this->c('QueryResult', 'Db')
				->model('WowAccounts')
				->setItemId($item['admin_id'])
				->loadItem();

			if ($adm)
				$item['admin_name'] = $adm['forums_name'];
		}

		switch ($item['priority'])
		{
			case 2:
				$item['prColor'] = '#ffff00';
				$item['prName'] = 'Media';
				break;
			case 3:
				$item['prColor'] = '#ff0000';
				$item['prName'] = 'Alta';
				break;
			case 1:
			default:
				$item['prColor'] = '#00ff00';
				$item['prName'] = 'Baja';
				break;
		}

		if (isset($item['comments']) && $item['comments'])
		{
			foreach ($item['comments'] as &$comment)
			{
				$comment['date'] = date('d/m/Y H:i', $comment['post_date']);
				$comment['url'] = $this->getWowUrl('character/' . $comment['realmName'] . '/' . $comment['name']);
				$comment['comment'] = str_replace(array('<', '>'), array('&lt;', '&gt;'), $comment['comment']);
				$comment['comment'] = str_replace(array('[code]', '[/code]'), array('<code style="border-color:#48230b;background:#21130b;color:#fae5cf;display:block;white-space:pre;overflow:auto;border:1px solid black;max-height:1000px;margin:5px 0;padding:10px;-webkit-border-radius:5px; border-radius:5px;font-family:monospace;">', '</code>'), $comment['comment']);

				$comment['comment'] = preg_replace('/\[url\=(.+?)\](.+?)\[\/url\]/six', '<a href="$1" target="_blank">$2</a>', $comment['comment']);
				$comment['comment'] = preg_replace('/\[img](.+?)\[\/img\]/six', '<img src="$1" />', $comment['comment']);
			}
		}

		return $this;
	}

	public function getCurrent()
	{
		return $this->m_currentType;
	}

	public function getItems()
	{
		return $this->m_items;
	}

	public function getItem()
	{
		return $this->m_item;
	}

	public function createReport()
	{
		if (!$this->c('AccountManager')->isLoggedIn())
			return $this;

		$fields = array('type', 'priority', 'desc');

		if (isset($_POST['type']))
		{
			if (!in_array($_POST['type'], array(BT_WEB, BT_OTHER, BT_DEFAULT, BT_STORE)))
				$fields[] = 'item';
		}
		else
			return $this;

		foreach ($fields as $f)
		{
			if (!isset($_POST[$f]) || !$_POST[$f])
				return $this;
		}

		if ($_POST['type'] != $this->getCategoryId())
			return $this;

		if (!in_array($_POST['type'], array(BT_WEB, BT_OTHER, BT_DEFAULT, BT_STORE)))
		{
			$item = $this->c('QueryResult', 'Db')
				->model('WowBugtrackerItems')
				->fieldCondition('type', ' = ' . $this->getCategoryId())
				->fieldCondition('item_id', ' = ' . intval($_POST['item']))
				->loadItem();

			if ($item)
			{
				$this->core->redirectUrl('bugtracker/bug/' . $item['id']);

				return $this;
			}
		}

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowBugtrackerItems')
			->setType('insert');

		$edt->type = $this->getCategoryId();
		$edt->item_id = isset($_POST['item']) ? intval($_POST['item']) : rand();
		$edt->account_id = $this->c('AccountManager')->user('id');
		$edt->character_realm = $this->c('AccountManager')->charInfo('realmId');
		$edt->character_guid = $this->c('AccountManager')->charInfo('guid');
		$edt->post_date = time();
		$edt->status = '0';
		$edt->priority = max(min(1, intval($_POST['priority'])), intval($_POST['priority']));
		$edt->description = $_POST['desc'];
		$edt->closed = '0';
		$edt->admin_response = '';
		$edt->response_date = '0';
		$edt->close_date = '0';

		if (isset($_POST['title']) && $_POST['title'])
			$edt->title = $_POST['title'];

		$id = $edt->save()->getInsertId();

		if ($id)
		{
			$edt->clearValues();
			$this->core->redirectUrl('bugtracker/bug/' . $id);

			return $this;
		}

		$edt->clearValues();

		unset($edt);

		return $this;
	}
}
?>
