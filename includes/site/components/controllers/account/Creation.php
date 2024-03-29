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

class Creation_Account_Controller_Component extends Controller_Component
{
	protected function setTemplates()
	{
		$this->m_templates = array(
			(TEMPLATES_DIR . 'wow' . DS . 'elements' . DS . 'ajax.ctp'),
			(TEMPLATES_DIR . 'elements' . DS . 'signup' . DS . 'layout.ctp'),
		);

		return $this;
	}

	public function build($core)
	{
		if (isset($_POST['username']))
		{
			$username = addslashes($_POST['username']);
			$password = addslashes($_POST['password']);
			$confirm  = addslashes($_POST['passwordConfirmation']);
			$email	  = addslashes($_POST['emailAddress']);

			$result = $this->c('AccountManager')->createAccount($username, $password, $confirm, $email);

			if ($result)
			{
				$_POST['accountName'] = $username;
				$this->c('AccountManager')->performLogin();
				$this->core->redirectUrl();
			}
		}

		return $this;
	}
}