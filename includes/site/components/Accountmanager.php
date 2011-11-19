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

class AccountManager_Component extends Component
{
	protected $m_cookieData = '';
	protected $m_user = null;
	protected $m_loginError = 0;
	protected $m_sessionInfo = '';
	protected $m_characters = array();
	protected $m_activeChar = array();
	protected $m_lastErrorIdx = '';
	protected $m_success = false;
	protected $m_adminData = array();

	public function initialize()
	{
		if (isset($_GET['logout']))
			return $this->performLogout();

		if ($this->m_user || $this->isLoggedIn())
			return $this;

		$this->m_cookieData = $this->c('Cookie')->read('wowuser');

		if (!$this->m_cookieData)
			return $this;

		return $this->restoreFromCookie();
	}

	public function isLoggedIn()
	{
		return $this->m_user != null;
	}

	public function getCharacters()
	{
		return $this->m_characters;
	}

	public function getActiveCharacter()
	{
		return $this->m_activeChar;
	}

	public function charInfo($type)
	{
		return isset($this->m_activeChar[$type]) ? $this->m_activeChar[$type] : '';
	}

	protected function loadCharacters()
	{
		if (!$this->isLoggedIn())
			return $this;

		$isPrimary = false;
		$needSave = false;

		// Check cached
		$characters = $this->c('QueryResult', 'Db')
			->model('WowUserCharacters')
			->fieldCondition('account', ' = ' . $this->user('id'))
			->order(array('WowUserCharacters' => array('index')), 'ASC')
			->loadItems();

		$count_realm_characters = $this->c('QueryResult', 'Db')
			->model('Realmcharacters')
			->fields(array('Realmcharacters' => array('numchars')))
			->fieldCondition('acctid', ' = ' . $this->user('id'))
			->runFunction('SUM', 'numchars')
			->loadItem();

		if ($count_realm_characters['numchars'] != sizeof($characters))
			$needSave = true;
		else
		{
			$save_date = $this->c('QueryResult', 'Db')
				->model('WowUsers')
				->fieldCondition('id', ' = ' . $this->user('id'))
				->loadItem();

			if (!$save_date)
				$needSave = true;
			elseif ($save_date['chars_save'] < time())
				$needSave = true; // Rebuild cache
		}

		if ($needSave)
			$characters = $this->loadFromWorld(); // Reload characters from world

		if (!$characters)
			return $this;

		if (!$needSave)
		{
			$idxToDelete = -1;
			foreach ($characters as $idx => $char)
			{
				$char['class_text'] = $this->c('Locale')->getString('character_class_' . $char['class']);
				$char['race_text'] = $this->c('Locale')->getString('character_race_' . $char['race']);

				if ($char['isActive'] == 1)
				{
					$this->m_activeChar = $char;
					$idxToDelete = $idx;
				}
			}

			if ($idxToDelete >= 0)
				unset($this->m_characters[$idxToDelete]);

			sort($this->m_characters);

			$this->m_characters = $characters;

			unset($characters, $count_realm_characters);

			return $this;
		}

		$new_chars = array();
		$acc_id = $this->user('id');
		$idx = 0;
		$idxToDelete = -1;

		foreach($characters as $realmId => $realmchars)
		{
			foreach ($realmchars as $char)
			{
				$rName = $this->c('Config')->getValue('realms.' . $realmId . '.name');
				$new_chars[$idx] = array(
					'bn_id' => 0,
					'account' => $acc_id,
					'index' => $idx,
					'guid' => $char['guid'],
					'name' => $char['name'],
					'class' => $char['class'],
					'class_key' => $this->c('Wow')->getClassKeyById($char['class']),
					'class_text' => $this->c('Locale')->getString('character_class_' . $char['class']),
					'race' => $char['race'],
					'race_key' => $this->c('Wow')->getRaceKeyById($char['race']),
					'race_text' => $this->c('Locale')->getString('character_race_' . $char['race']),
					'gender' => $char['gender'],
					'level' => $char['level'],
					'realmId' => $realmId,
					'realmName' => $rName,
					'isActive' => $idx == 0 ? 1 : 0,
					'faction' => $this->c('Wow')->getFactionID($char['race']),
					'faction_text' => $this->c('Wow')->getFactionID($char['race']) == FACTION_ALLIANCE ? 'alliance' : 'horde',
					'guildId' => $char['guildid'],
					'guildName' => $char['guildName'],
					'guildUrl' => $this->getWowUrl('guild/' . $rName . '/' . $char['guildName']),
					'url' => $this->getWowUrl('character/' . $rName . '/' . $char['name'])
				);

				if ($idx == 0)
				{
					$this->m_activeChar = $new_chars[$idx];
					$idxToDelete = $idx;
				}

				++$idx;
			}
		}

		$this->m_characters = $new_chars;


		// Save to DB

		$this->c('Db')->wow()->query('DELETE FROM wow_user_characters WHERE account = %d', $acc_id);

		$fields = '';
		$keys = array_keys($new_chars[$idx-1]);
		$size = sizeof($keys);
		$cur = 1;
		foreach ($keys as $k)
		{
			$fields .= '`' . $k . '`';
			if ($cur < $size)
				$fields .= ', ';
			++$cur;
		}
		unset($new_chars, $characters, $count_realm_characters);

		$sql_query = 'INSERT INTO wow_user_characters (' . $fields . ') VALUES ';
		$count = count($this->m_characters);

		$fields_count = count($this->m_characters[0]);
		$current = 1;

		foreach ($this->m_characters as &$char)
		{
			$sql_query .= '(';
			$field_current = 1;
			
			foreach ($char as $key => $value)
			{
				$sql_query .= '\'' . addslashes($value) . '\'';
				if ($field_current < $fields_count)
					$sql_query .= ', ';
				++$field_current;
			}

			$sql_query .= ')';

			if ($current < $count)
				$sql_query .= ', ';
			else
				$sql_query .= ';';

			++$current;
		}

		$this->c('Db')->wow()->query($sql_query);
		$this->c('Db')->wow()->query("REPLACE INTO `wow_users` (id, chars_save) VALUES (%d, %d)", $acc_id, (time() + IN_DAYS));

		if ($idxToDelete >= 0)
			unset($this->m_characters[$idxToDelete]);

		sort($this->m_characters);

		return $this;
	}

	protected function loadFromWorld()
	{
		if (!$this->isLoggedIn())
			return false;

		$db_cfg = $this->c('Config')->getValue('realms');

		if (!$db_cfg)
			return false;

		$characters = array();
		foreach ($db_cfg as $realmId => $realm)
		{
			$this->c('Db')->switchTo('characters', $realm['id']);
			$realm_characters = $this->c('QueryResult', 'Db')
				->model('Characters')
				->addModel('GuildMember')
				->addModel('Guild')
				->join('left', 'GuildMember', 'Characters', 'guid', 'guid')
				->join('left', 'Guild', 'GuildMember', 'guildid', 'guildid')
				->fields(
					array(
						'Characters' => array('guid', 'account', 'name', 'class', 'race', 'gender', 'level'),
						'GuildMember' => array('guildid'),
						'Guild' => array('name'),
					)
				)
				->setAlias('Guild', 'name', 'guildName')
				->fieldCondition('characters.account', ' = ' . $this->user('id'))
				->keyIndex('guid')
				->loadItems();

			if ($realm_characters)
				$characters[$realmId] = $realm_characters;
		}

		return $characters;
	}

	private function restoreFromCookie()
	{
		if (!$this->m_cookieData || $this->m_user || $this->isLoggedIn())
			return $this;

		$user = json_decode(base64_decode($this->m_cookieData));

		if (!$user)
			throw new WoWLogin_Exception_Component('User cookie data is broken!');

		$checker = $this->c('QueryResult', 'Db')
			->model('Account')
			->setItemId($user->id)
			->loadItem();

		if (!$checker)
			return $this;

		if (strtolower($checker['username']) != strtolower($user->username))
			return $this;

		if (strtolower($checker['sha_pass_hash']) != strtolower($user->sha_pass_hash))
			return $this;

		if (!isset($checker['gmlevel']))
			$checker['gmlevel'] = -1;

		$checker['banned'] = $this->loadBanInfo($checker['id']);

		/// WOW STORE
		$amount = $this->c('QueryResult', 'Db')
			->model('AccountPoints')
			->fieldCondition('account_id', ' = ' . $checker['id'])
			->loadItem();
		if ($amount)
			$checker['amount'] = $amount['amount'];
		else
			$checker['amount'] = 0;

		$user = (object) $checker;

		if ($user->gmlevel == -1)
		{
			$gmlevel = $this->c('QueryResult', 'Db')
				->model('AccountAccess')
				->fieldCondition('id', ' = ' . $user->id)
				->loadItems();

			if (!$gmlevel)
				$user->gmlevel = 0;
			else
			{
				$max = 0;
				foreach ($gmlevel as &$level)
					if ($level['gmlevel'] > $max)
						$max = $level['gmlevel'];

				$user->gmlevel = $max;
			}
		}

		return $this->saveUser($user)->loadCharacters();
	}

	private function loadBanInfo($id)
	{
		// Check if user is banned (account bans only, do not check IP bans)
		$ban = $this->c('QueryResult')
			->model('AccountBanned')
			->fieldCondition('id', ' = ' . $id, 'AND')
			->fieldCondition('unbandate', ' > ' . time(), 'AND')
			->fieldCondition('active', ' = 1')
			->loadItem();

		if ($ban)
			return true;

		return false;
	}

	private function saveUser($user)
	{
		if (!$user)
			return $this;

		$cookie_data = array(
			'id' => $user->id,
			'sha_pass_hash' => $user->sha_pass_hash,
			'username' => $user->username
		);

		$this->m_cookieData = base64_encode(json_encode($cookie_data));
		$this->c('Cookie')->write('wowuser', $this->m_cookieData);

		$this->m_user = $user;
		$this->m_sessionInfo = 'EU-' . $user->id . '-' . sha1($user->sha_pass_hash); // Ticket ID

		$this->c('Session')->setSession('isLoggedIn', true);

		if ($user->gmlevel >= 1)
		{
			// Check user in admins table
			$admin = $this->c('QueryResult')
				->model('WowAccounts')
				->fieldCondition('game_id', ' = ' . $this->m_user->id, 'AND')
				->fieldCondition('active', ' = 1')
				->loadItem();

			$this->c('Session')->setSession('isAdmin', ($admin ? true : false));
			$this->m_adminData = $admin;
		}

		// Set XSTOKEN if empty
		if (!$this->c('Cookie')->read('xstoken'))
			$this->c('Cookie')->write('xstoken', $this->generateXsToken());

		return $this;
	}

	protected function generateXsToken()
	{
		if (!$this->isLoggedIn())
			return '';

		return mt_rand();
	}

	public function user($field)
	{
		if (isset($this->m_user->{$field}))
			return $this->m_user->{$field};

		return false;
	}

	public function admin($field)
	{
		if (!$this->isAdmin())
			return false;

		if (isset($this->m_adminData[$field]))
			return $this->m_adminData[$field];

		return false;
	}

	protected function performLogout()
	{
		$this->c('Session')->setSession('isLoggedIn', false)->setSession('isAdmin', false);

		$this->c('Cookie')->write('wowuser');

		$this->destroyUser();

		$this->core->redirectUrl('');

		return $this;
	}

	protected function destroyUser()
	{
		$this->m_cookieData = '';
		$this->m_user = null;
		$this->m_loginError = 0;
		$this->m_sessionInfo = '';
		$this->m_characters = array();
		$this->m_activeChar = array();
		$this->m_lastErrorIdx = '';
		$this->m_success = false;
		$this->m_adminData = array();

		return $this;
	}

	public function performLogin()
	{
		$this->m_loginError = 0;

		if (!isset($_POST['accountName']))
		{
			$this->m_loginError |= ERROR_EMPTY_USERNAME;
			return false;
		}

		if (!isset($_POST['password']))
		{
			$this->m_loginError |= ERROR_EMPTY_PASSWORD;
			return false;
		}

		$username = $_POST['accountName'];
		$password = $_POST['password'];

		if (!$username || !$password)
		{
			$this->m_loginError |= ERROR_WRONG_USERNAME_OR_PASSWORD;
			return false;
		}

		$user = $this->c('QueryResult', 'Db')
			->model('Account')
			->fieldCondition('username', ' = \'' . $username . '\'')
			->fieldCondition('sha_pass_hash', ' = \'' . $this->sha($username, $password) . '\'')
			->loadItem();

		if (!$user)
		{
			$this->m_loginError |= ERROR_WRONG_USERNAME_OR_PASSWORD;
			return false;
		}

		if (!isset($user['gmlevel']))
			$user['gmlevel'] = -1;

		$user['banned'] = $this->loadBanInfo($user['id']);

		/// WOW STORE
		$amount = $this->c('QueryResult', 'Db')
			->model('AccountPoints')
			->fieldCondition('account_id', ' = ' . $user['id'])
			->loadItem();
		if ($amount)
			$user['amount'] = $amount['amount'];
		else
			$user['amount'] = 0;

		$user = (object) $user;

		if ($user->gmlevel == -1)
		{
			$gmlevel = $this->c('QueryResult', 'Db')
				->model('AccountAccess')
				->fieldCondition('id', ' = ' . $user->id)
				->loadItems();

			if (!$gmlevel)
				$user->gmlevel = 0;
			else
			{
				$max = 0;
				foreach ($gmlevel as &$level)
					if ($level['gmlevel'] > $max)
						$max = $level['gmlevel'];

				$user->gmlevel = $max;
			}
		}

		$this->saveUser($user)->m_loginError = ERROR_NONE;

		return true;
	}

	public function getSessionInfo()
	{
		return $this->m_sessionInfo;
	}

	protected function sha($username, $password)
	{
		return sha1(strtoupper($username) . ':' . strtoupper($password));
	}

	public function getErrorCode()
	{
		return $this->m_loginError;
	}

	public function isAccountCharacter($realmId, $guid)
	{
		if ($this->m_activeChar && ($this->m_activeChar['guid'] == $guid && $this->m_activeChar['realmId'] == $realmId))
			return true;

		if (!$this->m_characters)
			return false;

		// Check other characters
		foreach ($this->m_characters as &$char)
		{
			if ($char && ($char['guid'] == $guid && $char['realmId'] == $realmId))
				return true;
		}

		return false;
	}

	public function isMyRealm($realm)
	{
		if (!$this->isLoggedIn())
			return false;

		if (is_string($realm))
			$realm = $this->c('Wow')->getRealmIDByName($realm);

		if (!$realm)
			return false;

		if ($this->m_activeChar && $this->m_activeChar['realmId'] == $realm)
			return true;

		if (!$this->m_characters)
			return false;

		foreach ($this->m_characters as &$char)
			if ($char && $char['realmId'] == $realm)
				return true;

		return false;
	}

	public function isHaveAnyCharacters()
	{
		if (!$this->isLoggedIn())
			return false;

		if ($this->m_characters || $this->m_activeChar)
			return true;

		return false;
	}

	public function isBanned()
	{
		return $this->m_user->banned;
	}

	public function isAllowedToForums()
	{
		if (!$this->isLoggedIn() || !$this->isHaveAnyCharacters() || $this->isBanned())
			return false;

		return true;
	}

	public function isAllowedToModerate()
	{
		if (!$this->isAdmin() || !$this->isAllowedToForums())
			return false;

		return true;
	}

	public function getForumsName()
	{
		if (!$this->isAdmin())
			return false;

		$name = $this->admin('forums_name');

		if ($name)
			return $name;

		return $this->user('username');
	}

	public function isAdmin()
	{
		return $this->isLoggedIn() && is_array($this->m_adminData);
	}

	public function createAccount($user, $pass, $confirm, $email)
	{
		if ((!$user || !$pass || !$confirm || !$email) || $pass != $confirm || strlen($user) < 2 | strlen($pass) < 6)
			return false;

		$sha = sha1(strtoupper($user). ':' . strtoupper($pass));

		$check = $this->c('QueryResult', 'Db')
			->model('Account')
			->fieldCondition('username', ' = \'' . $user . '\'')
			->loadItem();

		if ($check)
			return false;

		$this->c('Db')->realm()->query("INSERT INTO account (username,sha_pass_hash,expansion,email) VALUES ('%s', '%s', 2, '%s')", $user, $sha, $email);

		return true;
	}

	public function showNotify()
	{
		return $this->m_lastErrorIdx != null;
	}

	public function lastMessageIndex()
	{
		return $this->m_lastErrorIdx;
	}

	public function getNotifyType()
	{
		return 0; // dead code?
	}

	public function success()
	{
		return $this->m_success;
	}

	public function changePassword()
	{
		if (!$this->isLoggedIn())
			return $this->core->redirectApp(); // to root

		$p = $_POST;

		if (!isset($p['oldPassword']) || !isset($p['newPassword']) || !isset($p['newPasswordVerify']))
			return false;

		$sha = sha1(strtoupper($this->user('username')) . ':' . strtoupper($p['oldPassword']));
		if ($this->user('sha_pass_hash') != $sha)
		{
			$this->m_lastErrorIdx = 'template_account_change_pass_error_pass';
			$this->m_success = false;
		}
		elseif ($p['newPassword'] != $p['newPasswordVerify'])
		{
			$this->m_lastErrorIdx = 'template_account_change_pass_error_mismatch';
			$this->m_success = false;
		}
		else
		{
			$edt = $this->c('Editing')
				->clearValues()
				->setModel('Account')
				->setId($this->user('id'))
				->setType('update');

			$edt->sha_pass_hash = sha1(strtoupper($this->user('username')) . ':' . strtoupper($p['newPassword']));
			 // set session fields to null
			$edt->v = '';
			$edt->s = '';
			$edt->save()->clearValues();
			// Update user object to prevent login autoreject (auto-logout)
			$this->m_user->sha_pass_hash = sha1(strtoupper($this->user('username')) . ':' . strtoupper($p['newPassword']));
			$this->saveUser($this->m_user);
			$this->m_success = true;
		}
	}

	public function changeBonus($amount, $type = -1)
	{
		if ($amount < 0)
			return false;

		if ($type == 1)
			$this->m_user->amount += $amount;
		elseif ($type == -1)
		{
			if ($this->m_user->amount < $amount)
				return false;

			$this->m_user->amount -= $amount;
		}
		elseif ($type == 0)
			$this->m_user->amount = $type;

		return true;
	}
}
?>