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

class Loginfrag_Login_Controller_Component extends Grouplogin_Controller_Component
{
	public function build($core)
	{
		$this->m_isAjax = true;
		define('AJAX_PAGE', true);

		if (isset($_POST['app']))
			$this->c('AccountManager')->performLogin();

		$this->buildBlock('frag');

		return $this;
	}

	protected function block_frag()
	{
		return $this->block()
			->setTemplate(($this->c('AccountManager')->isLoggedIn() ? 'sessioninfo' : 'frag'), 'login')
			->setVar('loginError', $this->c('AccountManager')->getErrorCode())
			->setVar('loginTicket', $this->c('AccountManager')->getSessionInfo())
			->setRegion('pagecontent');
	}
}
?>