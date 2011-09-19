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

class Item_WoW_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_entry = 0;
	protected $m_browseOptions = array();
	protected $m_isTooltip = false;
	protected $m_menuIndex = 'game';

	public function build($core)
	{
		$this->checkInfo();

		if ($this->m_entry > 0)
			$this->m_pageTitle = $this->c('Item')->initItem($this->m_entry, $this->m_isTooltip)->item('name');
		else
			$this->m_pageTitle = $this->c('Item')->initItems($this->m_browseOptions)->itemPageTitle();

		$this->buildBreadcrumb();

		if ($this->m_entry > 0)
		{
			$this->buildBlock('tooltip');

			if ($this->m_isTooltip)
				$this->m_isAjax = true;
			else
				$this->buildBlock('info');
		}
		else
		{
			$core->setVar('body_class', 'item-index');
			$this->buildBlocks(array('pager', 'list'));
		}

		return $this;
	}

	protected function block_pager()
	{
		return $this->block()
			->setVar('pager', $this->c('Pager')->getPager(array('totalCount' => $this->c('Item')->getItemsCount(), 'limit' => $this->c('Item')->getDisplayLimit())))
			->setVar('pagerOptions', $this->m_browseOptions)
			->setRegion('pager')
			->setTemplate('pager', 'wow' . DS . 'blocks');
	}

	protected function block_list()
	{
		return $this->block()
			->setRegion('pagecontent')
			->setVar('items', $this->c('Item')->getItems())
			->setTemplate('list', 'wow' . DS . 'contents' . DS . 'item');
	}

	protected function setBreadcrumb()
	{
		$this->m_breadcrumb = array(
			array(
				'link' => '',
				'caption' => 'World of Warcraft'
			),
			array(
				'link' => 'game/',
				'locale_index' => 'template_menu_game'
			),
			array(
				'link' => 'item/',
				'locale_index' => 'template_menu_items'
			),
		);

		$item = $this->c('Item');

		if ($item->isCorrect())
		{
			$this->m_breadcrumb = array_merge($this->m_breadcrumb, 
				array(
					array(
						'link' => 'item/?classId=' . $item->item('class'),
						'caption' => $item->getClassInfo('class_name')
					),
					array(
						'link' => 'item/?classId=' . $item->item('class') . '&subClassId=' . $item->item('subclass'),
						'caption' => $item->getClassInfo('subclass_name')
					)
				)
			);
			if (in_array($item->item('class'), array(ITEM_CLASS_ARMOR, ITEM_CLASS_WEAPON)))
			{
				$this->m_breadcrumb = array_merge($this->m_breadcrumb, array(
					array(
						'link' => 'item/?classId=' . $item->item('class') . '&subClassId=' . $item->item('subclass') . '&invType=' . $item->item('InventoryType'),
						'locale_index' => 'template_item_invtype_' . $item->item('InventoryType')
					)
				));
			}
			$this->m_breadcrumb = array_merge($this->m_breadcrumb, array(
				array(
					'link' => 'item/' . $item->item('entry'),
					'caption' => $item->item('name')
				)
			));
		}
		else
		{
			if (isset($_GET['classId']))
			{
				$this->m_breadcrumb[] = array(
					'link' => 'item/?classId=' . ((int) $_GET['classId']),
					'caption' => $item->getItemsClassInfo('class_name')
				);
			}

			if (isset($_GET['subClassId']))
			{
				$this->m_breadcrumb[] = array(
					'link' => 'item/?classId=' . ((int) $_GET['classId']) . '&amp;subClassId=' . ((int) $_GET['subClassId']),
					'caption' => $item->getItemsClassInfo('subclass_name')
				);
			}

			if (isset($_GET['invType']))
			{
				$this->m_breadcrumb[] = array(
					'link' => $this->m_breadcrumb[sizeof($this->m_breadcrumb) - 1]['link'] . '&amp;invType=' . ((int) $_GET['invType']),
					'caption' => $this->c('Locale')->getString('template_item_invtype_' . ((int) $_GET['invType']))
				);
			}
		}

		unset($item);

		return $this;
	}

	protected function checkInfo()
	{
		$this->m_entry = (int) $this->core->getUrlAction(2);

		$this->m_isTooltip = (strtolower($this->core->getUrlAction(3)) == 'tooltip');

		$get_params = array(
			'classId', 'subClassId', 'invType', 'page'
		);

		foreach ($get_params as &$p)
			if (isset($_GET[$p]))
				$this->m_browseOptions[$p] = $_GET[$p];

		return true;
	}

	protected function block_info()
	{
		return $this->block()
			->setVar('item', $this->c('Item'))
			->setRegion('pagecontent')
			->setTemplate('info', 'wow' . DS . 'contents' . DS . 'item');
	}

	protected function block_tooltip()
	{
		return $this->block()
			->setVar('tooltip', $this->c('Item')->getTooltip())
			->setRegion('wow_ajax')
			->setTemplate('tooltip', 'wow' . DS . 'contents' . DS . 'item');
	}
}
?>