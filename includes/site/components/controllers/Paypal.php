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

class Paypal_Controller_Component extends Controller_Component
{
	public function build($core)
	{
		$this->ajaxPage();
		define('AJAX_PAGE', true);

		$action = $core->getUrlAction(1);

		switch (strtolower($action))
		{
			case 'transaction':
				if (!isset($_GET['_paypal']) || !isset($_GET['notify']))
					$this->setErrorPage();
				else
				{
					if (isset($_POST['txn_id']))
					{
						$this->c('Paypal')->verifyPayment();
					}
					else
						$this->c('Log')->writeError('%s : txn_id not found!', __METHOD__);
				}
				break;
			case 'json':
				if (isset($_POST['_pp']))
					$this->c('Paypal')->triggerPayment();
				break;
		}

		return $this;
	}
}
?>