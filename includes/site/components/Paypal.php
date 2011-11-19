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

class Paypal_Component extends Component
{
	private $m_orderId = 0;
	private $m_amount = 0;
	private $m_points = 0;

	public function triggerPayment()
	{
		$amount = intval($_POST['amount']);
		$item_number = $_POST['item_number'];

		$edt = $this->c('Editing')
			->clearValues()
			->setModel('StoreSession')
			->setType('insert');

		$edt->session_id = $item_number;
		$edt->amount = $amount;
		$edt->date_time = time();
		$edt->used = 0;

		$edt->save()->clearValues();

		$this->c('Session')->setSession('clear_order_id', true);

		return $this;
	}

	public function initPayPal($amount, $price)
	{
		$this->generateOrderId();

		$this->m_amount = $amount;

		return $this;
	}

	public function generateOrderId()
	{
		if ($this->c('Session')->getSession('clear_order_id'))
		{
			$this->c('Session')->setSession('order_id', null)->setSession('clear_order_id', false);
		}

		if ($this->c('Session')->getSession('order_id') != null)
			$this->m_orderId = $this->c('Session')->getSession('order_id');
		else
			$this->m_orderId = sha1(strtolower($this->c('AccountManager')->user('username')) . ':' . $this->c('AccountManager')->user('id') . ':' . time());

		$this->c('Session')->setSession('order_id', $this->m_orderId);

		return $this;
	}

	public function getOrderId()
	{
		return $this->c('Session')->getSession('order_id');
	}

	/**
	 * Builds PayPal.com form data
	 *
	 * @param bool $sandbox = false
	 * @return array
	 */
	public function buildPayPalFormData($sandbox = true)
	{
		return array(
			'pp_business' => PAYPAL_EMAIL,
			'pp_cmd' => '_xclick',
			'pp_item_name' => PP_DESCRIPTION,
			'pp_item_number' => $this->m_orderId,
			'pp_amount' => $this->m_amount,
			'pp_return' => $this->core->getApplicationUrl('account/management/payments/success'),
			'pp_cancel_return' => $this->core->getApplicationUrl('account/management/payments/cancelled'),
			'pp_notify_url' => $this->core->getApplicationUrl('paypal/transaction?_paypal=true&notify=true'),
			'pp_currency_code' => CURRENCY_CODE,
			'pp_no_shipping' => 1,
			'pp_custom' => $this->c('AccountManager')->user('id'),
			'pp_rm' => 2, // use POST redirection method!
		);
	}

	public function getGatewayUrl($sb = false)
	{
		return $sb ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
	}

	public function verifyPayment($sandbox = false)
	{
		if (!$_POST)
			return $this->c('Log')->writeError('%s : this action can not be performed at this moment', __METHOD__);

		$post_fields = '';

		foreach ($_POST as $key => $value)
			$post_fields .= urlencode(stripslashes($key)) . '=' . urlencode(stripslashes($value)) . '&';

		$post_fields .= 'cmd=_notify-validate';
		
		$curl = curl_init('https://www.' . ($sandbox ? 'sandbox.' : '') . 'paypal.com/cgi-bin/webscr');
        curl_setopt ($curl, CURLOPT_HEADER, 0);
        curl_setopt ($curl, CURLOPT_POST, 1);
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec ($curl);
        curl_close ($curl);

		if ($response != 'VERIFIED')
		{
			$this->handleFailedPayment();
			return array('errno' => 1, 'error' => 'Unable to verify payment status!', 'time' => time());
		}

		if (strtolower($_POST['receiver_email']) != strtolower(PAYPAL_EMAIL))
		{
			$this->handleFailedPayment();
			return array('errno' => 2, 'error' => 'Wrong receiver email!', 'time' => time());
		}

		if ($_POST['txn_type'] != 'web_accept')
		{
			$this->handleFailedPayment();
			return array('errno' => 2, 'error' => 'Invalid transaction type!', 'time' => time());
		}

		$this->handleSuccessedPayment();

		return array('errno' => 0, 'error' => 'none');
	}

	private function handleSuccessedPayment()
	{
		$this->loadPointsAmount();

		$points_amount = $this->m_points;

		$account_points = $this->c('QueryResult', 'Db')
			->model('AccountPoints')
			->fieldCondition('account_id', ' = ' . intval($_POST['custom']))
			->loadItem();

		$edt = $this->c('Editing');

		if ($account_points)
		{
			$points_amount += $account_points['amount'];

			$edt->clearValues()
				->setModel('AccountPoints')
				->setType('update')
				->setId(intval($_POST['custom']));
			$edt->amount = $points_amount;

			$edt->save()->clearValues();
		}
		else
		{
			$edt->clearValues()
				->setModel('AccountPoints')
				->setType('insert');

			$edt->account_id = intval($_POST['custom']);
			$edt->amount = $points_amount;
			$edt->save()->clearValues();
		}

		$edt->clearValues()
			->setModel('PaypalHistory')
			->setType('insert');

		$edt->txn_id = $_POST['txn_id'];
		$edt->payment_date = $_POST['payment_date'];
		$edt->verify_sign = $_POST['verify_sign'];
		$edt->payer_email = $_POST['payer_email'];
		$edt->receiver_email = $_POST['receiver_email'];
		$edt->payer_id = $_POST['payer_id'];
		$edt->receiver_id = $_POST['receiver_id'];
		$edt->item_number = $_POST['item_number'];

		$edt->save()->clearValues();

		$this->c('Db')->realm()->query("UPDATE store_session SET used = 1 WHERE session_id = '%s'", $_POST['item_number']);

		return $this;
	}

	private function handleFailedPayment()
	{
		return $this;
	}

	private function loadPointsAmount()
	{
		if (!isset($_POST['item_number']) || !$_POST['item_number'])
			return false;

		$amount = $this->c('QueryResult', 'Db')
			->model('StoreSession')
			->fieldCondition('session_id', ' = \'' . $_POST['item_number'] . '\'')
			->fieldCondition('used', ' = 0')
			->loadItem();

		if (!$amount)
		{
			$this->m_points = 0;

			return false;
		}

		$this->m_points = $amount['amount'];

		return true;
	}
}