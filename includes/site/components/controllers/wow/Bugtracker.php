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

class Bugtracker_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_menuIndex = 'game';
	protected $m_isView = false;
	protected $m_bugId = 0;
	protected $m_isApi = false;
	protected $m_isAdding = false;
	protected $m_isChangelog = false;
	protected $m_errChangelog = false;

	public function checkInfo()
	{
		if ($this->core->getUrlAction(2) == 'changelog')
			$this->m_isChangelog = true;

		if ($this->core->getUrlAction(2) == 'bug' && $this->core->getUrlAction(3) > 0)
		{
			$this->m_isView = true;
			$this->m_bugId = intval($this->core->getUrlAction(3));
		}
		elseif ($this->core->getUrlAction(2) == 'api')
			$this->m_isApi = true;
		elseif ($this->core->getUrlAction(3) == 'add' && $this->c('AccountManager')->isLoggedIn())
		{
			if ($this->c('Bugtracker')->getCategoryId() > 0)
				$this->m_isAdding = true;
			elseif ($this->m_isChangelog)
				$this->m_isAdding = true;
		}


		return true;
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
				'link' => 'bugtracker/',
				'caption' => 'Bugtracker'
			)
		);

		if ($this->c('Bugtracker')->isCategory())
		{
			if ($this->c('Bugtracker')->getCategoryId() != BT_DEFAULT)
				$this->m_breadcrumb[] = array(
					'link' => 'bugtracker/' . $this->core->getUrlAction(2),
					'caption' => $this->c('Bugtracker')->getCategoryName() . 's'
				);
			if ($this->m_isAdding && !$this->m_isChangelog)
				$this->m_breadcrumb[] = array(
					'link' => 'bugtracker/' . $this->core->getUrlAction(2) . '/add',
					'caption' => 'Create Report'
				);
			elseif ($this->m_isAdding && $this->m_isChangelog)
				$this->m_breadcrumb[] = array(
					'link' => 'bugtracker/changelog/add',
					'caption' => 'Add Revision to Changelog'
				);
		}
		elseif ($this->c('Bugtracker')->isCorrect())
		{
			$this->m_breadcrumb[] = array(
				'link' => 'bugtracker/' . $this->c('Bugtracker')->item('type_str'),
				'caption' => $this->c('Bugtracker')->item('categoryName') . 's'
			);
			$this->m_breadcrumb[] = array(
				'link' => 'bugtracker/bug/' . $this->c('Bugtracker')->item('id'),
				'caption' => '#' . $this->c('Bugtracker')->item('item_id')
			);
		}

		return $this;
	}

	public function build($core)
	{
		$this->checkInfo();

		$block = '';
		$this->m_errChangelog = false;

		if (!$this->m_isApi)
		{
			$this->buildBreadcrumb();

			if (!$this->m_isView)
			{
				if ($this->m_isAdding)
				{
					if (!$this->m_isChangelog)
					{
						if (isset($_POST['type']))
							$this->c('Bugtracker')->createReport();
						$block = 'add';
					}
					else
					{
						$block = 'changelog_add';

						if (isset($_POST['changelog']))
							$this->m_errChangelog = $this->c('Bugtracker')->addChangelogRevision();
					}
				}
				elseif ($this->m_isChangelog)
				{
					$block = 'changelog';

					$id = (int) $core->getUrlAction(3);
					$act = $core->getUrlAction(4);

					if ($id > 0 && in_array($act, array('delete', 'edit')))
					{
						if ($act == 'delete')
						{
							$this->c('Bugtracker')->deleteChangelogItem($id);

							$this->core->redirectUrl('bugtracker/changelog');

							return $this;
						}
						elseif ($act == 'edit')
						{
							if (isset($_POST['changelog']))
								$this->m_errChangelog = $this->c('Bugtracker')->editChangelogItem();

							$block = 'changelog_edit';
						}
					}
				}
				else
					$block = 'main';
			}
			else
			{
				if ($this->c('Bugtracker')->isCorrect())
				{
					if (isset($_POST['comment']['text']))
						$this->c('Bugtracker')->addComment();

					$block = 'item';
				}
				else
				{
					$this->setErrorPage()->c('Error_Wow', 'Controller');

					return $this;
				}
			}

			$this->buildBlocks(array('btMenu', $block));
		}
		else
		{
			$this->ajaxPage();
			define('AJAX_PAGE', true);
			$this->buildBlock('api');
		}

		return $this;
	}

	protected function block_api()
	{
		return $this->block()
			->setTemplate('api', 'wow' . DS . 'contents' . DS . 'bugtracker')
			->setRegion('wow_ajax')
			->setVar('bt', $this->c('Bugtracker'));
	}

	protected function block_main()
	{
		return $this->block()
			->setTemplate('index', 'wow' . DS . 'contents' . DS . 'bugtracker')
			->setRegion('pagecontent')
			->setVar('pagination', $this->c('Pager')->generatePagination(
				'/' . $this->core->getRawUrl(),
				$this->c('Bugtracker')->getTotalCount(),
				12,
				$this->c('Forum')->getPage(false) * 12
				)
			)
			->setVar('bt', $this->c('Bugtracker'));
	}

	protected function block_changelog()
	{
		return $this->block()
			->setTemplate('changelog', 'wow' . DS . 'contents' . DS . 'bugtracker')
			->setRegion('pagecontent')
			->setVar('pagination', $this->c('Pager')->generatePagination(
				'/' . $this->core->getRawUrl(),
				$this->c('Bugtracker')->getTotalChangelogCount(),
				12,
				$this->c('Forum')->getPage(false) * 12
				)
			)
			->setVar('bt', $this->c('Bugtracker'));
	}

	protected function block_add()
	{
		return $this->block()
			->setTemplate('add', 'wow' . DS . 'contents' . DS . 'bugtracker')
			->setRegion('pagecontent')
			->setVar('bt', $this->c('Bugtracker'));
	}

	protected function block_changelog_add()
	{
		return $this->block()
			->setTemplate('changelog_add', 'wow' . DS . 'contents' . DS . 'bugtracker')
			->setRegion('pagecontent')
			->setVar('error_add', $this->m_errChangelog)
			->setVar('bt', $this->c('Bugtracker'));
	}

	protected function block_changelog_edit()
	{
		return $this->block()
			->setTemplate('changelog_edit', 'wow' . DS . 'contents' . DS . 'bugtracker')
			->setRegion('pagecontent')
			->setVar('error_add', $this->m_errChangelog)
			->setVar('bt', $this->c('Bugtracker'))
			->setVar('item', $this->c('Bugtracker')->getChangelogItem((int) $this->core->getUrlAction(3)));
	}

	protected function block_btMenu()
	{
		return $this->block()
			->setTemplate('menu', 'wow' . DS . 'contents' . DS . 'bugtracker')
			->setRegion('bt_menu')
			->setVar('bt', $this->c('Bugtracker'));
	}

	protected function block_item()
	{
		return $this->block()
			->setTemplate('item', 'wow' . DS . 'contents' . DS . 'bugtracker')
			->setRegion('pagecontent')
			->setVar('bt', $this->c('Bugtracker'));
	}
}
?>