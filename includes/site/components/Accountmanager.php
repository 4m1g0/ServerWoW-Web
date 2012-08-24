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
	protected $m_userSettings = array();

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

		$rids = array();
		$realms = $this->c('Config')->getValue('realms');

		if ($realms)
		{
			foreach ($realms as $r)
				$rids[] = $r['db_id'];
		}

		$save_date = $this->c('QueryResult', 'Db')
			->model('WowUsers')
			->fieldCondition('id', ' = ' . $this->user('id'))
			->loadItem();

		if (!$save_date)
		{
			$needSave = true;
		}
		elseif ($save_date['chars_save'] < time())
		{
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

		// Update NickName for Chat
		//$isActive = $this->c('Db')->wow()->selectRow("SELECT `id`, `guid`, `name`, `account`, `realmName`, `isActive` FROM `wow_user_characters` WHERE `account` = '%d' AND isActive = '1'", $acc_id);
		
		switch($this->charInfo('realmName'))
		{
			case "King of Kingdoms":
				$realm_Active = "KoK";
				break;
			case "Lord of Crusaders":
				$realm_Active = "LoC";
				break;
			case "Chaos World":
				$realm_Active = "CW";
				break;
			case "Ragnaros":
				$realm_Active = "Rag";
				break;
		}
				
		$this->c('Db')->wow()->query("UPDATE `wow_users_accounts` SET `nickname` = '%s' WHERE `account_id` = '%d'", $this->charInfo('name').'@'.$realm_Active, $acc_id);

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
			if (!$realm || !isset($realm['id']))
				continue;

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

	public function loadBanInfo($id)
	{
		// Check if user is banned (account bans only, do not check IP bans)
		$ban = $this->c('QueryResult', 'Db')
			->model('AccountBanned')
			->addModel('Account')
			->join('left', 'Account', 'AccountBanned', 'bannedby', 'id')
			->fields(array(
					'AccountBanned' => array('id', 'bandate', 'unbandate', 'bannedby', 'banreason', 'active'),
					'Account' => array('username')
				)
			)
			->fieldCondition('id', ' = ' . $id, 'AND')
			->fieldCondition('active', ' = 1')
			->loadItem();
			
		if ($ban)
			return $ban;

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
		$this->m_sessionInfo = 'ES-' . $user->id . '-' . sha1($user->sha_pass_hash); // Ticket ID

		$this->c('Session')->setSession('isLoggedIn', true);

		// Check user in admins table
		$admin = $this->c('QueryResult')
			->model('WowAccounts')
			->addModel('WowUserGroups')
			->join('left', 'WowUserGroups', 'WowAccounts', 'group_id', 'group_id')
			->fieldCondition('game_id', ' = ' . $this->m_user->id)
			->loadItem();

		if ($admin)
		{
			$this->c('Session')->setSession('isAdmin', ($admin ? true : false));
			$this->m_adminData = $admin;
			$this->m_userSettings['forums']['forums_username'] = $admin['forums_name'];
		}

		$user_settings = $this->c('QueryResult', 'Db')
			->model('WowUserSettings')
			->fieldCondition('account', ' = ' . $user->id)
			->loadItem();

		if ($user_settings)
			$this->m_userSettings['forums']['forums_signature'] = $user_settings['forums_signature'];

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

	public function settings($name, $type)
	{
		if (!$type || !$name || !isset($this->m_userSettings[$type]) || !isset($this->m_userSettings[$type][$name]))
			return false;

		return $this->m_userSettings[$type][$name];
	}

	public function admin($field)
	{
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

	public function updateLoginError()
	{
		$count = $this->c('Session')->getSession('failedlogins');
		if (!$count)
			$count = 1;
		else
			$count ++;

		$this->c('Session')->setSession('failedlogins', $count);

		return $this;
	}

	public function getLoginErrorsCount()
	{
		return $this->c('Session')->getSession('failedlogins');
	}

	public function performLogin()
	{
		$this->m_loginError = 0;

		if (!isset($_POST['accountName']))
		{
			$this->m_loginError |= ERROR_EMPTY_USERNAME;
			$this->updateLoginError();
			return false;
		}

		if (!isset($_POST['password']))
		{
			$this->m_loginError |= ERROR_EMPTY_PASSWORD;
			$this->updateLoginError();
			return false;
		}

		$username = strip_tags(stripslashes($_POST['accountName']));
		$password = strip_tags(stripslashes($_POST['password']));

		if (!$username || !$password)
		{
			$this->m_loginError |= ERROR_WRONG_USERNAME_OR_PASSWORD;
			$this->updateLoginError();
			return false;
		}

		if (isset($_POST['recaptcha_challenge_field']))
		{
			require_once(SITE_CLASSES_DIR . 'recaptchalib.php');
			$privatekey = "6LcZjsoSAAAAAHcliYKVqU5DI4naoEmsvc0UYA80";
			$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			if (!$resp->is_valid)
			{
				$this->m_loginError |= ERROR_RECAPTCHA_FAILED;
				$this->updateLoginError();
				return false;
			}
		}

		$user = $this->c('QueryResult', 'Db')
			->model('Account')
			->fieldCondition('username', ' = \'' . $username . '\'', 'AND')
			->fieldCondition('sha_pass_hash', ' = \'' . sha1(strtoupper($username). ':' . strtoupper($password)) . '\'')
			->loadItem();
			
		if (!$user)
		{
			$this->m_loginError |= ERROR_WRONG_USERNAME_OR_PASSWORD;
			$this->updateLoginError();
			return false;
		}

		if (!isset($user['gmlevel']))
			$user['gmlevel'] = -1;

		$user['banned'] = $this->loadBanInfo($user['id']);

		// This check is not needed
		/*if ($user['banned'])
		{
			$this->m_loginError |= ERROR_WRONG_USERNAME_OR_PASSWORD;
			$this->updateLoginError();
			return false;
		}*/

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

		$this->c('Session')->setSession('failedlogins', 0);

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
		if (isset($this->m_user->banned))
			return $this->m_user->banned;
		else
			return false;
	}

	public function isAllowedToForums()
	{
		if (!$this->isLoggedIn() || !$this->isHaveAnyCharacters() || $this->isBanned())
			return false;
			
		if ($this->m_activeChar['level'] < 9)
			return false;

		return true;
	}
	
	public function isAllowedToGeneral()
	{
		if (!$this->isLoggedIn() || !$this->isHaveAnyCharacters() || $this->isBanned())
			return false;
			
		if ($this->m_activeChar['level'] < 9)
			return false;

		return true;
	}

	public function isAllowedToModerate()
	{
		if (!$this->isAllowedToForums() || !($this->admin('group_mask') & ADMIN_GROUP_MODERATE_FORUMS))
			return false;

		return true;
	}

	public function isAllowedToBugtracker()
	{
		if (!($this->admin('group_mask') & ADMIN_GROUP_BUGTRACKER_ACCESS))
			return false;

		return true;
	}

	public function getForumsName()
	{
		$name = $this->settings('forums_username', 'forums');

		if ($name)
			return $name;

		return $this->user('username');
	}

	public function isAdmin()
	{
		return $this->isLoggedIn() && is_array($this->m_adminData) && ($this->admin('group_mask') & ADMIN_GROUP_ADMIN_PANEL);
	}

	public function createAccount($user, $pass, $confirm, $email)
	{
		if ((!$user || !$pass || !$confirm || !$email) || $pass != $confirm || strlen($user) < 2 | strlen($pass) < 6)
			return false;
			
		$user = strip_tags(stripslashes($user));
		$email = strip_tags(stripslashes($email));
		$pass = strip_tags(stripslashes($pass));
		$ip = $_SERVER["REMOTE_ADDR"];
		
		
		if ($user == $pass)
		{
			$this->m_loginError |= ERROR_USER_SAME_PASS;
			return false;
		}
		
		// Check For VALID Domain
		$check_email1 = explode('@',$email);
		$check_email2 = explode('.',$check_email1[1]);
		
		$available_domains = array('/hotmail/i','/yahoo/i','/gmail/i','/live/i');
		foreach ($available_domains as $available_domain)
		{  
			while (preg_match($available_domain, $check_email2[0]))
			{
				$can_continue = true;
				break;
			}
		}
		
		if (isset($can_continue) != true)
		{
			$this->m_loginError |= ERROR_DOMAIN_NOT_VALID;
			return false;
		}

		require_once(SITE_CLASSES_DIR . 'recaptchalib.php');

		$privatekey = "6LcZjsoSAAAAAHcliYKVqU5DI4naoEmsvc0UYA80";

		$challenge_field = isset($_POST['recaptcha_challenge_field']) ? $_POST['recaptcha_challenge_field'] : '';
		$response_field = isset($_POST['recaptcha_response_field']) ? $_POST['recaptcha_response_field'] : '';

		$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $challenge_field, $response_field);

		if (!$resp->is_valid)
		{
			$this->m_loginError |= ERROR_RECAPTCHA_FAILED;
			return false;
		}

		$sha = sha1(strtoupper($user). ':' . strtoupper($pass));

		$check_user = $this->c('QueryResult', 'Db')
			->model('Account')
			->fieldCondition('username', ' = \'' . $user . '\'')
			->loadItem();

		if ($check_user)
		{
			$this->m_loginError |= ERROR_USERNAME_TAKEN;
			return false;
		}

		$check_email = $this->c('QueryResult', 'Db')
			->model('Account')
			->fieldCondition('email', ' = \'' . $email . '\'')
			->loadItem();

		if ($check_email)
		{
			$this->m_loginError |= ERROR_EMAIL_TAKEN;
			return false;
		}
		
		$check_ip = $this->c('QueryResult', 'Db')
			->model('IpBanned')
			->fieldCondition('ip', ' = \'' . $ip . '\'')
			->loadItem();

		if ($check_ip)
		{
			$this->m_loginError |= ERROR_IP_BANNED;
			return false;
		}
		
		$max_id = $this->c('Db')->wow()->selectRow("SELECT max(id) + 1 AS max FROM wow_users_accounts");
		
		if ($max_id['max'] != 0)
		{
			if ($this->c('Db')->wow()->query("INSERT INTO wow_users_accounts (id,account_id,username,nickname) VALUES ('%d', '%d', '%s', '%s')", $max_id['max'], $max_id['max'], $user, $user))
			{
				$this->c('Db')->realm()->setModel($this->c('Account', 'Model'));
				if ($this->c('Db')->realm()->query("INSERT INTO account (id,username,sha_pass_hash,expansion,email) VALUES ('%d', '%s', '%s', 2, '%s')", $max_id['max'], $user, $sha, $email))
				{
					$title = "Cuenta en ServerWoW.com";
					$subject = ''.$user.', Cuenta Creada';
					$from = "registro@serverwow.com";
					$to = $email;
					$host = $_SERVER['HTTP_HOST'];

					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=utf-8\r\n";
					$headers .= "X-Mailer: PHP's mail() Function\r\n";
					$headers .= "From: $from\r\n";
	
					$message = "
					<html>
<head>
  <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
  <title>Creacion de Cuenta</title>
</head>
<body>
  <div>
    <table style='width: 650px;' border='0' cellpadding='0' cellspacing='0'>
      <tbody>
        <tr>
          <td colspan='4'>
            <div align='center'><span style='color: #999999; font-family: Arial, Helvetica, sans-serif; font-size: xx-small;'>Para asegurar la recepción de los e-mails de ServerWoW, agrega <strong><a href='mailto:e-correo@serverwow.com' target='_blank'>e-correo@serverwow.com</a></strong> a tu libreta de direcciones.</span></div></td>
        </tr>
      </tbody>
    </table>
    <table style='width: 613px;' border='0' cellpadding='0' cellspacing='0'>
      <tbody>
        <tr>
          <td bgcolor='#000000' width='613'>
            <table style='width: 613px;' border='0' cellpadding='0' cellspacing='0'>
              <tbody>
                <tr>
                  <td colspan='55' height='437' valign='top' width='613'><a href='' target='_blank'><span style='padding: 0px;'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/header-new16-esmx.jpg' alt=' ' border='0' height='443' width='613' /></span></a></td>
                </tr>
                <tr>
                  <td bgcolor='#010000' height='100%' valign='top' width='2'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='2' /></td>
                  <td bgcolor='#6e757b' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#544d47' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#000201' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#4b4a46' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#272d2d' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#9a958f' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#110705' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#190804' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0b0e15' height='100%' valign='top' width='42'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='42' /></td>
                  <td bgcolor='#190904' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#140805' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#090302' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#110903' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#2f0e01' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#230901' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0f0800' height='100%' valign='top' width='7'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='7' /></td>
                  <td bgcolor='#1d0a00' height='100%' valign='top' width='4'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='4' /></td>
                  <td bgcolor='#060501' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#efdba3' valign='top' width='467'>
                    <table border='0' cellpadding='0' cellspacing='0'>
                      <tbody>
                        <tr>
                          <td width='15'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='15' /></td>
                          <td>
                            <table bgcolor='#efdba3' border='0' cellpadding='5' cellspacing='0'>
                              <tbody>
                                <tr>
                                  <td style='padding: 0px 0px 16px;' colspan='3' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Hola $user, </p></td>
                                </tr>
                                <tr>
                                  <td style='padding: 0px 0px 16px;' colspan='3' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Queremos informarte que tu cuenta en $host se ha creado satisfactoriamente!</p></td>
                                </tr>
                                <tr>
                                  <td valign='top'></td>
                                  <td style='padding: 0px 10px 12px 3px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Cuenta:</p></td>
                                  <td style='padding: 0px 0px 12px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>$user</p></td>
                                </tr>
                                <tr>
                                  <td valign='top'></td>
                                  <td style='padding: 0px 10px 12px 3px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Password:</p></td>
                                  <td style='padding: 0px 0px 12px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>$pass</p></td>
                                </tr>
                                <tr>
                                  <td valign='top'></td>
                                  <td style='padding: 0px 10px 12px 3px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Email:</p></td>
                                  <td style='padding: 0px 0px 12px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>$email</p></td>
                                </tr>
                                <tr>
                                  <td valign='top'></td>
                                  <td style='padding: 0px 10px 12px 3px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Realmlist:</p></td>
                                  <td style='padding: 0px 0px 12px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>set realmlist logon.$host</p></td>
                                </tr>
                                <tr>
                                  <td style='padding: 0px;' colspan='3' valign='top'>
                                    <div>
                                      <p>&nbsp;</p>
                                      <p>&nbsp;</p></div></td>
                                </tr>
                                <tr>
                                  <td style='padding: 0px 0px 16px;' colspan='3' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Además, te invitamos a que visites los links mas importantes de $host, para que te ubiques e identifiques los posibles sitios de ayuda e interes.</p></td>
                                </tr>
                                <tr>
                                  <td valign='top'></td>
                                  <td style='padding: 0px 10px 12px 3px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Administracion de cuenta:</p></td>
                                  <td style='padding: 0px 0px 12px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'><a href='http://$host/account/management/' target='_blank'>http://$host/account/management/</a></p></td>
                                </tr>
                                <tr>
                                  <td valign='top'></td>
                                  <td style='padding: 0px 10px 12px 3px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Foros:</p></td>
                                  <td style='padding: 0px 0px 12px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'><a href='http://$host/wow/forum/' target='_blank'>http://$host/wow/forum/</a></p></td>
                                </tr>
                                <tr>
                                  <td valign='top'></td>
                                  <td style='padding: 0px 10px 12px 3px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Como Jugar Gratis:</p></td>
                                  <td style='padding: 0px 0px 12px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'><a href='http://juego.$host/jugar-gratis-world-of-warcraft.html' target='_blank'>http://juego.$host/jugar-gratis-world-of-warcraft.html</a></p></td>
                                </tr>
                                <tr>
                                  <td valign='top'></td>
                                  <td style='padding: 0px 10px 12px 3px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Descargas:</p></td>
                                  <td style='padding: 0px 0px 12px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'><a href='http://descargas.$host/world-of-warcraft/' target='_blank'>http://descargas.$host/world-of-warcraft/</a></p></td>
                                </tr>
                                <tr>
                                  <td valign='top'></td>
                                  <td style='padding: 0px 10px 12px 3px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>FAQ (Preguntas Frecuentes):</p></td>
                                  <td style='padding: 0px 0px 12px;' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'><a href='http://faq.$host/' target='_blank'>http://faq.$host/</a></p></td>
                                </tr>
                                <tr>
                                  <td style='padding: 0px 0px 16px;' colspan='3' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>&nbsp;</p>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>&nbsp;</p>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'>Todo el equipo de <a href='http://$host' target='_blank'>http://$host</a>, Te desea lo mejor, esperamos te diviertas siendo parte de esta gran familia. </p></td>
                                </tr>
                                <tr>
                                  <td style='padding: 0px 0px 20px;' colspan='3' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'><br />
                                      <br />
                                      <span style='font-weight: bold; '>Nache</span><br />
                                      <span style='font-weight: bold; '>Director General.</span><br />
                                      <span style='font-weight: bold; '><a href='https://twitter.com/#!/n4ch3' target='_blank'>https://twitter.com/#!/n4ch3</a></span><br />
                                      <br />
                                      <span style='font-weight: bold; '>Server WoW Realms<br />
                                        2008-2012<br />
                                        <a href='https://twitter.com/#!/ServerWoW' target='_blank'>https://twitter.com/#!/ServerWoW</a></span></p></td>
                                </tr>
                                <tr>
                                  <td style='padding: 0px;' colspan='3' valign='top'>
                                    <p style='color: #620d06; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 16px; font-family: Calibri,Trebuchet MS,arial,helvetica,sans-serif;'><span style='font-weight: bold; '>Siguenos!!<br />
                                        <a href='https://www.facebook.com/ServerWoW' target='_blank'>https://www.facebook.com/ServerWoW</a></span></p></td>
                                </tr>
                              </tbody>
                            </table></td>
                          <td width='15'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='15' /></td>
                        </tr>
                      </tbody>
                    </table></td>
                  <td bgcolor='#170b00' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#180d00' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0f0500' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#140901' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#241705' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#1d0f01' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#1d0a00' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#211001' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#241504' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#1a0e01' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0f0700' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0f0800' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0c0500' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#090200' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0c0500' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0a0500' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0c0200' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#180100' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#260c00' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0e0600' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0a0402' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#140b06' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#1c0702' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0b0e15' height='100%' valign='top' width='41'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='41' /></td>
                  <td bgcolor='#0b0e15' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0b0e15' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#0b0e15' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#140703' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#979692' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#2c2c2a' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#4a4a48' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#000100' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#514d4e' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#6e7774' height='100%' valign='top' width='1'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='1' /></td>
                  <td bgcolor='#000002' height='100%' valign='top' width='2'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/pixel.gif' alt='' border='0' height='1' width='2' /></td>
                </tr>
                <tr>
                  <td colspan='55' bgcolor='#020912' height='264' valign='top' width='613'><a href='http://serverwow.com/' target='_blank'><img style='display: block;' src='http://e-correo.serverwow.com/data_files/img/create_account/footer-new09.jpg' alt='' border='0' height='303' width='613' /></a></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr>
          <td bgcolor='#000000' width='613'>
            <table style='width: 613px;' bgcolor='#000000' border='0' cellpadding='0' cellspacing='10'>
              <tbody>
                <tr>
                  <td>
                    <div align='center'><a target='_blank' href='http://www.youtube.com/user/ServerW0W'><img src='http://e-correo.serverwow.com/data_files/img/custom/youtube.png' alt='Síguenos en YouTube' width='37' height='37' border='0' align='absmiddle' title='Síguenos en YouTube' /></a></div></td>
                  <td>
                    <div align='center'><a target='_blank' href='https://twitter.com/#!/n4ch3/lcv'><img border='0' src='http://e-correo.serverwow.com/data_files/img/custom/twitter.png' width='37' height='37' title='Síguenos en Twitter' alt='Síguenos en Twitter' /></a></div></td>
                  <td>
                    <div align='center'><a target='_blank' href='http://www.facebook.com/ServerWoW'><img border='0' src='http://e-correo.serverwow.com/data_files/img/custom/facebook.png' width='37' height='37' title='Siguenos en Facebook' alt='Siguenos en Facebook' /></a></div></td>
                  <td>
                    <div align='center'><a target='_blank' href='https://plus.google.com/117818722165936859038'><img border='0' src='http://e-correo.serverwow.com/data_files/img/custom/delicious.png' width='37' height='37' title='Síguenos en Google Plus' alt='Síguenos en Google Plus' /></a></div></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr>
          <td bgcolor='#000000' width='613'>
            <table style='width: 613px;' bgcolor='#000000' border='0' cellpadding='0' cellspacing='20'>
              <tbody>
                <tr>
                  <td style='padding: 0in;' valign='top'><span style='font-family: Arial; font-size: xx-small; '><span style='font-size: 7pt; font-family: Arial; '>
                        <div><span style='color: rgb(153, 153, 153);'>Si NO puedes ingresar a la Página Web (serverwow.com), intenta descargando la siguiente utilidad, haz clic </span><a href='http://www.mediafire.com/?2xo75ocwy95p8uc' target='_blank' style='color: rgb(135, 206, 250);'>aquí</a><span style='color: rgb(153, 153, 153);'> y sigue las instrucciones dentro de la descarga.</span></div>
                        <div style='color: rgb(153, 153, 153); '><br />
                          </div>
                        <div>
                          <p><span style='color: rgb(153, 153, 153);'>Si deseas leer nuestra política de privacidad </span><a href='http://privacy.serverwow.com' target='_blank' style='color: rgb(135, 206, 250);'>http://privacy.serverwow.com<br />
                              <br />
                              </a></p></div>
                        <div style='color: rgb(153, 153, 153); '>2012 ServerWoW. Todos los derechos reservados. Todas las demás marcas son propiedad de sus respectivos dueños.</div></span></span></td>
                  <td style='padding: 0px 0in 0in;' valign='top'><span style='font-family: Arial; font-size: xx-small; '>
                      <div style='color: rgb(153, 153, 153); '>Soporte Técnico</div>
                      <div><a href='http://serverwow.com/wow/bugtracker/' target='_blank' style='color: rgb(135, 206, 250);'>/wow/bugtracker/</a></div>
                      <div style='color: rgb(153, 153, 153); '><br />
                        </div>
                      <div style='color: rgb(153, 153, 153); '>Guía para Jugar</div>
                      <div><a href='http://juego.serverwow.com/jugar-gratis-world-of-warcraft.html' target='_blank' style='color: rgb(135, 206, 250);'>/jugar-gratis-world-of-warcraft.html</a></div>
                      <div style='color: rgb(153, 153, 153); '><br />
                        </div>
                      <div style='color: rgb(153, 153, 153); '>FAQ</div>
                      <div><a href='http://faq.serverwow.com' target='_blank' style='color: rgb(135, 206, 250);'>http://faq.serverwow.com</a></div></span></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table><br />
    </div>
</body>
</html>";

					@mail("$to", "$subject", "$message", "$headers");
					
					return true;
				}
			}
		}
		
		$this->m_loginError |= "No se ha podido crear tu cuenta, prueba de nuevo";
		return false;
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

		$sha = sha1(strtoupper(stripslashes($this->user('username'))) . ':' . strtoupper(stripslashes($p['oldPassword'])));
		
		if ($this->user('sha_pass_hash') != $sha)
		{
			$this->m_lastErrorIdx = 'template_account_change_pass_error_pass';
			$this->m_success = false;
		}
		elseif (stripslashes($p['newPassword']) != stripslashes($p['newPasswordVerify']))
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

			$edt->sha_pass_hash = sha1(strtoupper(stripslashes($this->user('username'))) . ':' . strtoupper(stripslashes($p['newPassword'])));
			 // set session fields to null
			$edt->v = '';
			$edt->s = '';
			$edt->save()->clearValues();
			// Update user object to prevent login autoreject (auto-logout)
			$this->m_user->sha_pass_hash = sha1(strtoupper(stripslashes($this->user('username'))) . ':' . strtoupper(stripslashes($p['newPassword'])));
			$this->saveUser($this->m_user);
			$this->m_success = true;
		}
	}

	public function changeGameVersion()
	{
		if (!$this->isLoggedIn())
			return false;
			
		if (isset($_POST['expansion']) || $_POST['expansion'])
		{
		    $expansion = intval($_POST['expansion']);
			
		    if ($expansion <=4 && $expansion >=0)
		    {
				$edt = $this->c('Editing')
					->clearValues()
					->setModel('Account')
					->setType('update')
					->setId($this->user('id'))
					->load();

					$edt->expansion = $expansion;
					$edt->save()->clearValues();
					
					return true;
			}
		}
		else
			return false;
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
			$this->m_user->amount = $amount;

		$this->c('Db')->realm()->query("UPDATE account_points SET amount = %d WHERE account_id = %d", $this->m_user->amount, $this->user('id'));

		return true;
	}

	public function updateForumsSettings()
	{
		if (!isset($_POST['csrftoken']))
			return $this;

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('WowUserSettings');

		if (!$this->m_userSettings || !isset($this->m_userSettings['forums']) || !$this->m_userSettings['forums'])
		{
			// New
			$this->m_userSettings['forums'] = array();
			$edt->setType('insert')->account = $this->user('id');
		}
		else
			$edt->setType('update')->setId($this->user('id'));

		if ($this->isAllowedToModerate() && isset($_POST['forums_username']) && $_POST['forums_username'])
			$this->m_userSettings['forums']['forums_username'] = $_POST['forums_username'];

		if (isset($_POST['forums_signature']) && $_POST['forums_signature'])
		{
			$_POST['forums_signature'] = str_replace(array('<', '>'), array('&lt;', '&gt;'), $_POST['forums_signature']);

			$lines = explode(NL, $_POST['forums_signature']);

			if (mb_strlen($_POST['forums_signature'], 'UTF-8') <= 255 && sizeof($lines) <= 3)
				$this->m_userSettings['forums']['forums_signature'] = $_POST['forums_signature']; // 3 or lesser lines, 255 or lesser symbols
		}

		if (isset($this->m_userSettings['forums']['forums_signature']) && $this->m_userSettings['forums']['forums_signature'])
			$edt->forums_signature = $this->m_userSettings['forums']['forums_signature'];

		$edt->save()->clearValues();

		if ($this->isAllowedToModerate() && isset($this->m_userSettings['forums']['forums_username']) && $this->m_userSettings['forums']['forums_username'])
		{
			$edt->setModel('WowAccounts')->setType('update')->setId($this->user('id'));
			$edt->forums_name = $this->m_userSettings['forums']['forums_username'];
			$edt->save()->clearValues();
		}

		return $this->core->redirectApp('account/management');
	}

	public function sendPasswordEmail()
	{
		if (!isset($_POST['recaptcha_challenge_field']) or !isset($_POST['user']) or !isset($_POST['email']))
			return $this;
		
		$user = strip_tags(stripslashes($_POST['user']));
		$email = strip_tags(stripslashes($_POST['email']));
		$captcha = $_POST['recaptcha_response_field'];

		if (!$user && !$email && !$captcha)
			return $this->core->setDataVar('errors', (2 | 4));
		elseif (!$email)
			return $this->core->setDataVar('errors', 2);
		elseif (!$captcha)
			return $this->core->setDataVar('errors', 4);

		require_once(SITE_CLASSES_DIR . 'recaptchalib.php');
		$privatekey = "6LcZjsoSAAAAAHcliYKVqU5DI4naoEmsvc0UYA80";
		$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

		if (!$resp->is_valid)
			return $this->core->setDataVar('errors', 4);

		$user = $this->c('QueryResult', 'Db')
			->model('Account')
			->fieldCondition('username', ' = \'' . $user . '\'', 'AND')
			->fieldCondition('email', ' = \'' . $email . '\'')
			->loadItem();

		if (!$user)
			return $this->core->setDataVar('errors', 2);

		if ($this->sendRecoveryEmail($user['id'], $user['username'], $user['email']))
			return $this->core->setDataVar('errors', 0)->setDataVar('success', true)->setDataVar('failed', false);
		else
			return $this->core->setDataVar('errors', 0)->setDataVar('failed', true)->setDataVar('success', false);
	}

	protected function sendRecoveryEmail($id, $username, $email)
	{
		if (!$email)
			return false;

		$password = substr(md5(rand()),0,12);
		$sha_password = sha1(strtoupper($username).':'.strtoupper($password));
		
		$body = wordwrap($this->c('Locale')->extraFormat('template_password_recovery_email_body',
			array(
				'username' => $username,
				'password' => $password,
				'url' => $this->getCoreUrl('account/management/settings/change-password.html')
			)
		));

		$title = $this->c('Locale')->getString('template_password_recovery_email_title');

		$send_email = $this->c('Config')->getValue('misc.admin_email');

		$headers = 'MIME-Version: 1.0' . "\r\n" .
		'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
		'From: ' . $send_email . "\n\r" .
		'Reply-To: ' . $send_email . "\n\r" .
		'X-Mailer: PHP/' . phpversion();

		if (mail($email, $title, $body, $headers))
		{
			$edt = $this->c('Editing')
				->clearValues()
				->setModel('Account')
				->setType('update')
				->setId($id);

			$edt->v = '';
			$edt->s = '';
			$edt->sha_pass_hash = $sha_password;

			$edt->save()->clearValues();

			return true;
		}

		return false;
	}

	public function unstuckCharacter()
	{
		if (!isset($_POST['characters']) || !$_POST['characters'])
			return false;

		foreach ($_POST['characters'] as $realmId => $chars)
		{
			$rId = $this->c('Config')->getValue('realms.' . $realmId . '.id');

			if ($rId != $realmId)
				continue; // Wrong realm

			$this->c('Db')->switchTo('characters', $rId);

			$online_chars = $this->c('QueryResult', 'Db')
				->model('Characters')
				->fields(array('Characters' => array('guid', 'online')))
				->fieldCondition('online', ' = 1')
				->fieldCondition('guid', array_keys($chars))
				->keyIndex('guid')
				->loadItems();

			foreach ($chars as $guid => $ridGuid)
			{
				if (!$this->isAccountCharacter($realmId, $guid))
					continue; // Wrong character
				elseif (isset($online_chars[$guid]))
					continue; // Char is online

				$this->c('Db')->characters()->query("DELETE FROM character_aura WHERE guid = %d", $guid);
				$this->c('Db')->characters()->query("INSERT INTO `character_aura` (`guid`, `caster_guid`, `item_guid`, `spell`, `effect_mask`, `recalculate_mask`, `stackcount`, `amount0`, `amount1`, `amount2`, `base_amount0`, `base_amount1`, `base_amount2`, `maxduration`, `remaintime`, `remaincharges`) values ('%d','%d','0','15007','7','7','1','-75','-75','0','-76','-76','-1','600000','600000','0')", $guid, $guid);
				$this->c('Db')->characters()->query("UPDATE `characters`, `character_homebind` SET `characters`.`position_x`=`character_homebind`.`posX`, `characters`.`position_y`=`character_homebind`.`posY`, `characters`.`position_z`=`character_homebind`.`posZ`, `characters`.`map`=`character_homebind`.`mapId` WHERE `characters`.`guid`=%d AND `characters`.`guid`=`character_homebind`.`guid`", $guid);
			}
		}

		return true;
	}

	public function isCharacterOnline($realmId, $guid)
	{
		$this->c('Db')->switchTo('characters', $realmId);

		if (!$this->c('Db')->isDatabaseAvailable('characters', $realmId))
			return false;

		$this->c('Db')->characters()->setModel($this->c('Characters', 'Model'));
		return $this->c('Db')->characters()->selectCell("SELECT online FROM characters WHERE guid = %d", $guid);
	}

	public function getUnreadMessagesCount()
	{
		$this->c('Db')->wow()->setModel($this->c('WowPrivateMessages', 'Model'));
		return $this->c('Db')->wow()->selectCell("SELECT COUNT(*) FROM wow_private_messages WHERE receiver_id = %d AND `read` = 0", $this->user('id'));
	}

	public function sendMessage()
	{
		if (!$this->isAllowedToSendMsg())
			return false;

		if (!isset($_POST['csrftoken']))
			return false;

		$fields = array('receiver' => 1, 'title' => 2, 'messagebody' => 3, 'realmId' => 4);

		foreach ($fields as $f => $v)
		{
			if (!isset($_POST[$f]) || !$_POST[$f])
			{
				$this->m_lastErrorIdx = 'template_new_msg_err' . $v;
				$this->m_success = false;
				return false;
			}
		}

		$realmId = intval($_POST['realmId']);
		if ($realmId != $this->c('Config')->getValue('realms.' . $realmId . '.id'))
		{
			$this->m_lastErrorIdx = 'template_new_msg_err9';
			$this->m_success = false;
			return false;
		}

		// try to find character guid and account ID
		$this->c('Db')->switchTo('characters', $realmId);
		if (!$this->c('Db')->isDatabaseAvailable('characters', $realmId))
		{
			// realm's characters DB is not available
			$this->m_lastErrorIdx = 'template_new_msg_err10';
			$this->m_success = false;
			return false;
		}

		$rcv_name = addslashes($_POST['receiver']);
		$char = $this->c('QueryResult', 'Db')
			->model('Characters')
			->fields(array('Characters' => array('guid', 'name', 'account')))
			->fieldCondition('name', ' = \'' . $rcv_name . '\'', true)
			->loadItem();

		if (!$char)
		{
			// realm's characters DB is not available
			$this->m_lastErrorIdx = 'template_new_msg_err7';
			$this->m_success = false;
			return false;
		}

		if ($char['account'] == $this->user('id'))
		{
			$this->m_lastErrorIdx = 'template_new_msg_err6';
			$this->m_success = false;
			return false;
		}

		$title = addslashes($_POST['title']);
		$msg = addslashes($_POST['messagebody']);
		$msg = str_replace(array("\n", "\n\r"), '<br />', $msg);

		// by default, everybody can receive messages
		if ($this->isAllowedToReceiveMsg())
		{
			$edt = $this->c('Editing')
				->clearValues()
				->setModel('WowPrivateMessages')
				->setType('insert');

			$edt->sender_id = $this->user('id');
			$edt->receiver_id = $char['account'];
			$edt->send_date = time();
			$edt->title = $title;
			$edt->text = $msg;
			$edt->read = '0';
			$edt->sender_guid = $this->charInfo('guid');
			$edt->sender_realmId = $this->charInfo('realmId');
			$edt->receiver_guid = $char['guid'];
			$edt->receiver_realmId = $realmId;

			$edt->save()->clearValues();

			unset($edt);

			return true;
		}
		else
		{
			$this->m_lastErrorIdx = 'template_new_msg_err5';
			$this->m_success = false;
			return false;			
		}			
	}

	public function isAllowedToReceiveMsg()
	{
		if (!$this->isLoggedIn())
			return false;

		return !($this->admin('group_mask') & ADMIN_GROUP_RCV_MSG);
	}
	
	public function isAllowedToSendMsg()
	{
		if (!$this->isLoggedIn())
			return false;

		return ($this->admin('group_mask') & ADMIN_GROUP_SEND_MSG);
	}

	public function getPrivateMessages($sent = false)
	{
		$msgs = $this->c('QueryResult', 'Db')
			->model('WowPrivateMessages')
			->fieldCondition('wow_private_messages.' . ($sent ? 'sender_id' : 'receiver_id'), ' = ' . $this->user('id'))
			->limit(15, ($this->getPage(true) * 15))
			->order(array('WowPrivateMessages' => array('send_date')), 'DESC')
			->loadItems();

		if (!$msgs)
			return false;

		$types = array('sender', 'receiver');
		foreach ($msgs as &$msg)
		{
			foreach ($types as $type)
			{
				$this->c('Db')->switchTo('characters', $msg[$type . '_realmId']);
				if (!$this->c('Db')->isDatabaseAvailable('characters', $msg[$type . '_realmId']))
				{
					$msg[$type] = 'Unknown';
					continue;
				}

				$char = $this->c('QueryResult', 'Db')
					->model('Characters')
					->fields(array('Characters' => array('guid', 'name')))
					->fieldCondition('guid', ' = ' . intval($msg[$type . '_guid']))
					->loadItem();

				if (!$char)
				{
					$msg[$type] = 'Unknown';
					continue;
				}
				$msg[$type] = $char['name'] . ' @ ' . $this->c('Config')->getValue('realms.' . $msg[$type . '_realmId'] . '.name');
			}
		}

		return $msgs;
	}

	public function getPrivateMessage()
	{
		$id = intval($this->core->getUrlAction(3));

		if (!$id)
			return $this->core->redirectApp('/account/management/inbox');

		$msg = $this->c('QueryResult', 'Db')
			->model('WowPrivateMessages')
			->fieldCondition('wow_private_messages.msg_id', ' = ' . $id)
			->loadItem();

		if (!$msg)
			return $this->core->redirectApp('/account/management/inbox');

		if ($msg['sender_id'] != $this->user('id') && $msg['receiver_id'] != $this->user('id'))
			return $this->core->redirectApp('/account/management/inbox');

		// Try to find sender character
		$this->c('Db')->switchTo('characters', $msg['sender_realmId']);
		$char_sender = $this->c('QueryResult', 'Db')
			->model('Characters')
			->fields(array('Characters' => array('guid', 'name')))
			->fieldCondition('guid', ' = ' . intval($msg['sender_guid']))
			->loadItem();

		// Try to find receiver character
		$this->c('Db')->switchTo('characters', $msg['receiver_realmId']);
		$char_receiver = $this->c('QueryResult', 'Db')
			->model('Characters')
			->fields(array('Characters' => array('guid', 'name')))
			->fieldCondition('guid', ' = ' . intval($msg['receiver_guid']))
			->loadItem();

		if (!$char_receiver || !$char_sender)
			return $this->core->redirectApp('/account/management/inbox');

		$msg['sender'] = $char_sender['name'] . ' @ ' . $this->c('Config')->getValue('realms.' . $msg['sender_realmId'] . '.name');
		$msg['receiver'] = $char_receiver['name'] . ' @ ' . $this->c('Config')->getValue('realms.' . $msg['receiver_realmId'] . '.name');

		if ($msg['read'] == 0 && $msg['receiver_id'] == $this->user('id'))
			$this->c('Db')->wow()->query("UPDATE wow_private_messages SET `read` = 1 WHERE msg_id = %d", $msg['msg_id']);

		// bbcodes
		$msg['text'] = preg_replace('/\[url\=(.+?)\](.+?)\[\/url\]/six', '<a href="$1" target="_blank">$2</a>', $msg['text']);
		$msg['text'] = preg_replace('/\[img](.+?)\[\/img\]/six', '<img src="$1" />', $msg['text']);

		return $msg;
	}

	public function get_Realip()
	{
    	if ($_SERVER)
		{
			if ($_SERVER["HTTP_X_FORWARDED_FOR"])
			{
				$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			}
			elseif ($_SERVER["HTTP_CLIENT_IP"])
			{
				$realip = $_SERVER["HTTP_CLIENT_IP"];
       		}
	   		else
	   		{  
				$realip = $_SERVER["REMOTE_ADDR"];
       		}
		}
		else
		{
			if (getenv( 'HTTP_X_FORWARDED_FOR'))
			{
				$realip = getenv('HTTP_X_FORWARDED_FOR');
        	}
			elseif (getenv('HTTP_CLIENT_IP'))
			{  
				$realip = getenv('HTTP_CLIENT_IP');
			}
			else
			{
				$realip = getenv('REMOTE_ADDR');
			}
	    }

    	return $realip;
	}	
}
?>
