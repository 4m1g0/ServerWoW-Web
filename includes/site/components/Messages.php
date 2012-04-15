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

class Messages_Component extends Component
{
	private $m_userMessages = array();
	private $m_systemName = 'Server Administration';
	private $m_errorIdx = '';
	private $m_stateFlag = false;
	private $m_unreadCount = 0;
	private $m_messages = array('sent' => array(), 'received' => array());

	public function initialize()
	{
		return $this->loadMessages();
	}

	public function loadMessages()
	{
		if (!$this->c('AccountManager')->isLoggedIn())
			return $this;

		$this->m_userMessages = $this->c('QueryResult', 'Db')
			->model('WowPrivateMessages')
			->fieldCondition('sender_id', ' = ' . $this->c('AccountManager')->user('id'), 'OR')
			->fieldCondition('receiver_id', ' = ' . $this->c('AccountManager')->user('id'), 'OR')
			->order(array('WowPrivateMessages' => array('send_date')), 'DESC')
			->keyIndex('msg_id')
			->loadItems();

		if (!$this->m_userMessages)
			return $this;

		return $this->handleMessages();
	}

	private function handleMessages()
	{
		if (!$this->m_userMessages)
			return $this;

		$chars = array();
		$guids = array();

		foreach ($this->m_userMessages as $msg)
		{
			if (!isset($guids[$msg['sender_realmId']]))
				$guids[$msg['sender_realmId']] = array();

			if (!isset($guids[$msg['receiver_realmId']]))
				$guids[$msg['sender_realmId']] = array();

			if (!in_array($msg['sender_guid'], $guids[$msg['sender_realmId']]))
				$guids[$msg['sender_realmId']][] = $msg['sender_guid'];

			if (!in_array($msg['receiver_guid'], $guids[$msg['receiver_realmId']]))
				$guids[$msg['receiver_realmId']][] = $msg['receiver_guid'];
		}

		$tmp = array();

		foreach ($guids as $realmId => $char_guids)
		{
			$chars[$realmId] = array();
			$this->c('Db')->switchTo('characters', $realmId);
			if ($this->c('Db')->isDatabaseAvailable('characters', $realmId))
			{
				$tmp = $this->c('QueryResult', 'Db')
					->model('Characters')
					->fields(array('Characters' => array('guid', 'name')))
					->fieldCondition('guid', $char_guids)
					->loadItems()
					->keyIndex('guid');

				if ($tmp)
					$chars[$realmId] = $tmp;
			}
		}

		foreach ($this->m_userMessages as &$msg)
		{
			// Sender
			$msg['sender_name'] = 'Unknown';

			if ($msg['flags'] & PM_FLAG_SYSTEM_MESSAGE)
				$msg['sender_name'] = $this->m_systemName;
			elseif (isset($chars[$msg['sender_realmId']][$msg['sender_guid']]))
				$msg['sender_name'] = $chars[$msg['sender_realmId']][$msg['sender_guid']]['name'] . ' @ ' . $this->c('Config')->getValue('realms.' . $realmId . '.name');

			// Receiver
			$msg['receiver_name'] = 'Unknown';

			if (isset($chars[$msg['receiver_realmId']][$msg['receiver_guid']]))
				$msg['receiver_name'] = $chars[$msg['receiver_realmId']][$msg['receiver_guid']]['name'] . ' @ ' . $this->c('Config')->getValue('realms.' . $realmId . '.name');

			if ($msg['read'] == 0 && $msg['receiver_id'] == $this->c('AccountManager')->user('id'))
				$this->m_unreadCount++;

			// bbcodes
			$msg['text'] = preg_replace('/\[url\=(.+?)\](.+?)\[\/url\]/six', '<a href="$1" target="_blank">$2</a>', $msg['text']);
			$msg['text'] = preg_replace('/\[img](.+?)\[\/img\]/six', '<img src="$1" />', $msg['text']);

			if ($msg['sender_id'] == $this->c('AccountManager')->user('id'))
				$this->m_messages['sent'][] = $msg;
			elseif ($msg['receiver_id'] == $this->c('AccountManager')->user('id'))
				$this->m_messages['received'][] = $msg;
		}

		return $this;
	}

	public function sendMessage($type, $receiver_realmNameOrId, $receiver_guidOrName, $subject, $text = '', $systemData = array(), $sender_realmNameOrId = 0, $sender_guidOrName = 0)
	{
		if (!$this->c('AccountManager')->isLoggedIn())
			return $this;

		if ($sender_realm == 0 && $sender_guid == 0 && !$this->c('AccountManager')->isAllowedToSendMsg())
			return $this;

		if ($sender_realm == 0)
			$sender_realm = $this->c('AccountManager')->user('realmId');

		if ($sender_guid == 0)
			$sender_guid = $this->c('AccountManager')->user('guid');

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowPrivateMessages')
			->setType('insert');

		$flags = 0;

		if ($type != PM_TYPE_MESSAGE)
		{
			$flags |= PM_FLAG_SYSTEM_MESSAGE;
			$edt->sender_id = -1;
			$edt->title = $this->c('Locale')->getString('template_privatemessage_subject_system_' . $type);
			$edt->text = $this->c('Locale')->extraFormat('template_privatemessage_text_system_' . $type, $systemData);
		}
		else
			$edt->sender_id = $this->c('AccountManager')->user('id');

		if (is_integer($receiver_realmNameOrId))
			$edt->receiver_realmId = $receiver_realmNameOrId;
		if (is_integer(receiver_guidOrName))
			$edt->receiver_guid = $receiver_guidOrName;

		$edt->sender_guid = $this->c('AccountManager')->charInfo('guid');
		$edt->sender_realmId = $this->c('AccountManager')->charInfo('realmId');
		$edt->read = 0;
		$edt->send_date = time();

		if (is_string($receiver_realmNameOrId) || is_string($receiver_guidOrName))
		{
			$realmId = 0;

			foreach ($this->c('Config')->getValue('realms') as $id => $info)
				if ($info['name'] == $receiver_realmNameOrId)
					$realmId = $id;

			if (!$realmId)
			{
				$this->m_errorIdx = 'template_new_msg_err9';
				return $this;
			}

			$this->c('Db')->switchTo('characters', $realmId);

			if ($this->c('Db')->isDatabaseAvailable('characters', $realmId))
			{
				$char = $this->c('QueryResult', 'Db')
					->model('Characters')
					->fields(array('Characters' => array('guid', 'name', 'account')))
					->fieldCondition('name', ' = \'' . $receiver_guidOrName)
					->loadItem();

				if (!$char)
					return $this;

				$edt->receiver_realmId = $realmId;
				$edt->receiver_guid = $char['guid'];
				$edt->receiver_id = $char['account'];
			}
			else
			{
				$this->m_errorIdx = 'template_new_msg_err10';

				return $this;
			}
		}

		$edt->flags = $flags;

		$edt->save()->clearValues();

		$this->m_stateFlag = true;

		return $this;
	}

	public function isMessageSent()
	{
		return $this->m_stateFlag;
	}

	public function getErrorIndex()
	{
		return $this->m_errorIdx;
	}

	public function getUnreadMessagesCount()
	{
		return $this->m_unreadCount;
	}

	public function getMessages($sent = false)
	{
		return $this->m_messages[$sent ? 'sent' : 'received'];
	}

	public function getMessage($id)
	{
		return isset($this->m_userMessages[$id]) ? $this->m_userMessages[$id] : array();
	}

	public function markMessage($id, $asRead = true)
	{
		if (!isset($this->m_userMessages[$id]))
			return $this;

		if ($id == -1)
		{
			// All
			foreach ($this->m_messages['received'] as &$msg)
				$msg['read'] = $asRead ? 1 : 0;

			$this->c('Db')->wow()->query("UPDATE `wow_private_messages` SET `read` = %d WHERE `received_id` = %d", $asRead ? 1 : 0, $this->c('AccountManager')->user('id'));

		}
		else
		{
			$this->m_userMessages[$id]['read'] = $asRead ? 1 : 0;

			if (isset($this->m_messages['received'][$id]))
			{
				$this->m_messages['received'][$id]['read'] = $asRead ? 1 : 0;

				$this->c('Db')->wow()->query("UPDATE `wow_private_messages` SET `read` = %d WHERE `msg_id` = %d", $asRead ? 1 : 0, $this->m_messages['received'][$id]['msg_id']);
			}
		}

		return $this;
	}
}