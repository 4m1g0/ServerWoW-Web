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

class Management_Account_Controller_Component extends Controller_Component
{
	protected function setTemplates()
	{
		$this->m_templates = array(
			(TEMPLATES_DIR . 'wow' . DS . 'elements' . DS . 'ajax.ctp'),
			(TEMPLATES_DIR . 'elements' . DS . 'account' . DS . 'layout.ctp'),
		);

		return $this;
	}

	public function build($core)
	{
		if (strtolower($this->core->getUrlAction(2)) == 'wow' && strtolower($this->core->getUrlAction(3)) == 'dashboard.html')
			$this->buildBlock('dashboard');
		elseif (strtolower($this->core->getUrlAction(2)) == 'settings' && strtolower($this->core->getUrlAction(3)) == 'change-password.html')
		{
			$this->c('AccountManager')->changePassword();
			$this->buildBlock('changePassword');
		}
		elseif (strtolower($this->core->getUrlAction(2)) == 'settings' && strtolower($this->core->getUrlAction(3)) == 'forums.html')
		{
			$this->c('AccountManager')->updateForumsSettings();
			$this->buildBlock('forumsSettings');
		}
		elseif (strtolower($core->getUrlAction(2)) == 'payments')
		{
			$action = $core->getUrlAction(3);
			switch ($action)
			{
				default:
					$this->c('Paypal')->generateOrderId();
					if (isset($_POST['amount']) && $_POST['confirmed'] == 1)
					{
						$this->c('Paypal')->initPayPal(intval($_POST['amount']), floatval($_POST['price']));
					}
					$this->buildBlock('paypal_def');
					break;
			}
		}
		else
			$this->buildBlock('lobby');

		$this->buildBlocks(array('service', 'footer'));
		return $this;
	}

	protected function block_paypal_def()
	{
		return $this->block()
			->setTemplate('payments_form', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_changePassword()
	{
		return $this->block()
			->setTemplate('password', 'account' . DS . 'contents')
			->setVar('account', $this->c('AccountManager'))
			->setRegion('pagecontent');
	}

	protected function block_forumsSettings()
	{
		return $this->block()
			->setTemplate('forums_settings', 'account' . DS . 'contents')
			->setVar('account', $this->c('AccountManager'))
			->setRegion('pagecontent');
	}

	protected function block_service()
	{
		return $this->block()
			->setTemplate('service', 'wow' . DS . 'elements')
			->setRegion('service');
	}

	protected function block_footer()
	{
		return $this->block()
			->setTemplate('footer', 'account' . DS . 'blocks')
			->setRegion('footer');
	}

	protected function block_lobby()
	{
		return $this->block()
			->setTemplate('lobby', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_dashboard()
	{
		return $this->block()
			->setTemplate('dashboard', 'account' . DS . 'contents')
			->setVar('account', $this->c('AccountManager'))
			->setRegion('pagecontent');
	}
}
?>