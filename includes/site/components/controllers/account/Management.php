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
		elseif (strtolower($this->core->getUrlAction(2)) == 'settings' && strtolower($this->core->getUrlAction(3)) == 'unstuck.html')
		{
			if ($this->c('AccountManager')->unstuckCharacter())
				$this->buildBlock('unstuckSuccess');
			else
				$this->buildBlock('unstuck');
		}
		elseif (strtolower(strtolower($this->core->getUrlAction(3)) == 'gameversion.html'))
		{
			if ($this->c('AccountManager')->changeGameVersion())
				$this->buildBlock('lobby');
			else
				$this->buildBlock('dashboard');
		}
		elseif (strtolower($this->core->getUrlAction(2)) == 'newmessage')
		{
			if ($this->c('AccountManager')->isAllowedToSendMsg())
			{
				if ($this->c('AccountManager')->sendMessage())
					$core->redirectApp('/account/management');

				$this->buildBlock('newmessage');
			}
		}
		elseif (strtolower($this->core->getUrlAction(2)) == 'inbox')
		{
			if ($this->c('AccountManager')->isAllowedToReceiveMsg())
			{
				$id = intval($core->getUrlAction(3));

				if ($id > 0)
					$this->buildBlock('viewmsg');
				else
					$this->buildBlock('inbox');
			}
		}
		elseif (strtolower($this->core->getUrlAction(2)) == 'sent')
		{
			if ($this->c('AccountManager')->isAllowedToSendMsg())
			{
				$id = intval($core->getUrlAction(3));

				if ($id > 0)
					$this->buildBlock('viewmsg');
				else
					$this->buildBlock('outbox');
			}
		}
		elseif (strtolower($this->core->getUrlAction(2)) == 'addfriend')
		{
				$id = $core->getUrlAction(3);
				if ($id)
				{
					if ($this->c('AccountManager')->add2Friend())
					$core->redirectApp('/account/management/');
				}
				
				if ($this->c('AccountManager')->addFriend())
					$core->redirectApp('/account/management/sent');

				$this->buildBlock('addfriend');
		}
		elseif (strtolower($this->core->getUrlAction(2)) == 'blockfriends')
		{
				$id = $core->getUrlAction(3);
				if ($id)
				{
					if ($this->c('AccountManager')->blockFriend())
					$core->redirectApp('/account/management/blockfriends');
				}
				
				//if ($this->c('AccountManager')->blockFriends())
					//$core->redirectApp('/account/management/blockfriends');

				$this->buildBlock('blockfriends');
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
				case 'cancelled':
					$this->buildBlock('paypal_cancel');
					break;
				case 'success':
					if (isset($_POST['txn_id']) && isset($_POST['payment_status']) && strtolower($_POST['payment_status']) == 'completed')
						$this->c('Paypal')->handleSuccessedPayment();
					$this->buildBlock('paypal_success');
					break;
			}
		}
		elseif (strtolower($core->getUrlAction(2)) == 'smspayments')
		{
			$action = $core->getUrlAction(3);
			switch ($action)
			{
				case 'confirm':
					if (!isset($_POST['code']) || !isset($_POST['type']))
						die('post required');
					if ($this->c('Sms')->checkCode($_POST['code'], $_POST['type']))
						die('ok');
					else
						die('failed');
					break;
				case 'success':
					$this->buildBlock('success_sms');
					break;
				case 'failed':
					$this->buildBlock('failed_sms');
					break;
				default:
					$this->buildBlock('sms');
					break;
			}
		}
		elseif (strtolower($core->getUrlAction(2)) == 'otherpayments')
		{
			$this->buildBlock('otherpayments');
		}
		else
			$this->buildBlock('lobby');

		$this->buildBlocks(array('service', 'footer'));

		return $this;
	}

	protected function block_inbox()
	{
		return $this->block()
			->setTemplate('inbox', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_outbox()
	{
		return $this->block()
			->setTemplate('outbox', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_viewmsg()
	{
		return $this->block()
			->setTemplate('viewmsg', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_newmessage()
	{
		return $this->block()
			->setTemplate('writemessage', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_blockfriends()
	{
		return $this->block()
			->setTemplate('blockfriends', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_addfriend()
	{
		return $this->block()
			->setTemplate('addfriend', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_otherpayments()
	{
		return $this->block()
			->setTemplate('otherpayments', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_sms()
	{
		return $this->block()
			->setTemplate('sms', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_success_sms()
	{
		return $this->block()
			->setTemplate('smssuccess', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_failed_sms()
	{
		return $this->block()
			->setTemplate('smsfailed', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_paypal_success()
	{
		return $this->block()
			->setTemplate('paypalsuccess', 'account' . DS . 'contents')
			->setRegion('pagecontent');
	}

	protected function block_paypal_cancel()
	{
		return $this->block()
			->setTemplate('smsfailed', 'account' . DS . 'contents')
			->setRegion('pagecontent');
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

	protected function block_unstuck()
	{
		return $this->block()
			->setTemplate('unstuck', 'account' . DS . 'contents')
			->setVar('account', $this->c('AccountManager'))
			->setRegion('pagecontent');
	}

	protected function block_unstuckSuccess()
	{
		return $this->block()
			->setTemplate('unstucksuccess', 'account' . DS . 'contents')
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