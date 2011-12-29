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

class Media_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_menuIndex = 'media';
	protected $m_action = '';
	protected $m_itemInfo = '';

	public function checkInfo()
	{
		if ($this->core->getUrlAction(2) != '')
			$this->m_action = strtolower($this->core->getUrlAction(2));

		if (isset($_GET['view']))
			$this->m_itemInfo = $_GET['view'];

		return true;
	}

	protected function setBreadcrumb()
	{
		$this->m_breadcrumb = array(
			array(
				'link' => '',
				'caption' => 'ServerWoW'
			),
			array(
				'link' => 'media/',
				'locale_index' => 'template_menu_media'
			)
		);
		if ($this->m_action == 'videos')
			$this->m_breadcrumb[] = array('link' => 'media/videos', 'caption' => 'Videos');
		if ($this->m_action == 'screenshots')
			$this->m_breadcrumb[] = array('link' => 'media/screenshots', 'caption' => 'Capturas de pantalla');

		return $this;
	}

	public function build($core)
	{
		$this->checkInfo();
		$this->buildBreadcrumb();

		if (isset($_FILES['ss']))
			$this->c('Media')->submitScreenshot();

		$this->c('Media')->initMedia($this->m_action, $this->m_itemInfo);

		switch ($this->m_action)
		{
			case 'videos':
			case 'screenshots':
				if ($this->m_itemInfo)
					$this->buildBlock($this->m_action . '_item');
				else
					$this->buildBlock($this->m_action);
				break;
			case 'thumbnail-page':
			case 'api':
			case 'meta-data':
				$this->ajaxPage();
				define('AJAX_PAGE', true);
				
				$this->buildBlock(str_replace('-', '', $this->m_action));
				break;
			case 'comments':
				exit; // [PH]
				break;
			default:
				$this->buildBlock('index');
				break;
		}
		
		return $this;
	}

	protected function block_api()
	{
		return $this->block()
			->setTemplate('api', 'wow' . DS . 'contents' . DS . 'media')
			->setRegion('wow_ajax')
			->setVar('media', $this->c('Media')->initApi());
	}

	protected function block_thumbnailPage()
	{
		return $this->block()
			->setTemplate('thumbnail-page', 'wow' . DS . 'contents' . DS . 'media')
			->setVar('media', $this->c('Media'))
			->setRegion('wow_ajax');
	}

	protected function block_videos()
	{
		return $this->block()
			->setTemplate('video-list', 'wow' . DS . 'contents' . DS . 'media')
			->setVar('media', $this->c('Media'))
			->setVar('pagination', $this->c('Pager')->generatePagination(
				'/' . $this->core->getRawUrl(),
				$this->c('Media')->getTotalCount(),
				15,
				$this->c('Forum')->getPage(false) * 15
				)
			)
			->setRegion('pagecontent');
	}

	protected function block_videos_item()
	{
		return $this->block()
			->setTemplate('video-item', 'wow' . DS . 'contents' . DS . 'media')
			->setVar('media', $this->c('Media'))
			->setRegion('pagecontent');
	}

	protected function block_screenshots()
	{
		return $this->block()
			->setTemplate('screenshots-list', 'wow' . DS . 'contents' . DS . 'media')
			->setVar('media', $this->c('Media'))
			->setVar('pagination', $this->c('Pager')->generatePagination(
				'/' . $this->core->getRawUrl(),
				$this->c('Media')->getTotalCount(),
				15,
				$this->c('Forum')->getPage(false) * 15
				)
			)
			->setRegion('pagecontent');
	}

	protected function block_screenshots_item()
	{
		return $this->block()
			->setTemplate('screenshots-item', 'wow' . DS . 'contents' . DS . 'media')
			->setVar('media', $this->c('Media'))
			->setRegion('pagecontent');
	}

	protected function block_index()
	{
		return $this->block()
			->setTemplate('media', 'wow' . DS . 'contents')
			->setVar('media', $this->c('Media'))
			->setRegion('pagecontent');
	}

	protected function block_metaData()
	{
		return $this->block()
			->setTemplate('meta-data-ss', 'wow'.  DS . 'contents' . DS . 'media')
			->setVar('item', $this->c('Media')->getMetaDataItem())
			->setRegion('wow_ajax');
	}
}
?>