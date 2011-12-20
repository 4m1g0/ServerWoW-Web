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

class Store_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_catId = 0;
	protected $m_itemId = 0;
	protected $m_isApiRq = false;
	protected $m_apiMethod = '';
	protected $m_isCart = false;
	protected $m_menuIndex = 'services';
	protected $m_isBuyout = false;

	public function checkInfo()
	{
		if ($this->core->getUrlAction(2) == 'api' && $this->core->getUrlAction(3) != null)
		{
			$this->m_isApiRq = true;
			$this->m_apiMethod = strtolower($this->core->getUrlAction(3));
			return true;
		}
		elseif ($this->core->getUrlAction(2) == 'cart')
		{
			$this->m_isCart = true;
			if ($this->core->getUrlAction(3) == 'buyout')
				$this->m_isBuyout = true;

			return true;
		}

		if ($this->core->getUrlAction(3) > 0)
			$this->m_itemId = (int) $this->core->getUrlAction(3);
		if ($this->core->getUrlAction(2) > 0)
			$this->m_catId = (int) $this->core->getUrlAction(2);

		return true;
	}

	protected function setBreadcrumb()
	{
		if ($this->m_isCart)
		{
			$this->m_breadcrumb = array(
				array(
					'link' => '',
					'caption' => 'ServerWoW'
				),
				array(
					'link' => 'store/',
					'caption' => 'Tienda & Servicios'
				),
				array(
					'link' => 'store/cart',
					'caption' => 'Carro de Compras'
				)
			);

			if ($this->m_isBuyout)
				$this->m_breadcrumb[] = array(
					'link' => 'store/cart/buyout',
					'caption' => 'Compra'
				);
		}
		else
			$this->m_breadcrumb = $this->c('Store')->getBreadcrumbInfo();

		return $this;
	}

	public function build($core)
	{
		if (!$this->c('AccountManager')->isLoggedIn())
		{
			$core->redirectApp('/login/');
			return $this;
		}
		$this->checkInfo();

		if ($this->m_isApiRq && $this->m_apiMethod && isset($_POST['store']))
		{
			$this->c('Store')->initApi($this->m_apiMethod);
			$this->ajaxPage();
			define('AJAX_PAGE', true);
			$this->buildBlock('api');
			return $this;
		}

		$this->c('Store')->initStore($this->m_catId, $this->m_itemId);

		if ($core->getUrlAction(2) == 'api2' && $core->getUrlAction(3) == 'buyoutall')
		{
			$this->ajaxPage();
			define('AJAX_PAGE', true);
			$this->c('Store')->buyout();
			echo json_encode($this->c('Store')->getErrorMessages());

			return $this;
		}

		$this->buildBreadcrumb(); // fuck yeah

		if ($this->m_isCart)
		{
			if ($this->m_isBuyout)
				$this->buildBlock('buyout');
			else
				$this->buildBlock('cart');
		}
		elseif (!$this->m_itemId)
			$this->buildBlock('main');
		else
			$this->buildBlocks(array('item'));

		return $this;
	}

	protected function block_api()
	{
		return $this->block()
			->setTemplate('api', 'wow' . DS . 'contents' . DS . 'store')
			->setRegion('wow_ajax')
			->setVar('store', $this->c('Store'));
	}

	protected function block_cart()
	{
		return $this->block()
			->setTemplate('cart', 'wow' . DS . 'contents' . DS . 'store')
			->setRegion('pagecontent')
			->setVar('store', $this->c('Store'));
	}

	protected function block_main()
	{
		return $this->block()
			->setTemplate('main', 'wow' . DS . 'contents' . DS . 'store')
			->setVar('store', $this->c('Store'))
			->setVar('items', $this->c('Store')->getItemsInCategory())
			->setVar('pagination', $this->c('Pager')->generatePagination(
				'/' . $this->core->getRawUrl(),
				$this->c('Store')->getCategoryItemsCount(),
				15,
				$this->c('Forum')->getPage(false) * 15
				)
			)
			->setRegion('pagecontent');
	}

	protected function block_item()
	{
		return $this->block()
			->setTemplate('item', 'wow' . DS . 'contents' . DS . 'store')
			->setVar('store', $this->c('Store'))
			->setRegion('pagecontent');
	}

	protected function block_buyout()
	{
		return $this->block()
			->setTemplate('buyout', 'wow' . DS . 'contents' . DS . 'store')
			->setVar('store', $this->c('Store'))
			->setRegion('pagecontent');
	}
}
?>