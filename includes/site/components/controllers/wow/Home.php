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

class Home_WoW_Controller_Component extends Groupwow_Controller_Component
{
	public function build($core)
	{
		$this->c('Wow')->checkBlogPagination();

		$this->buildBlocks(array('carousel', 'featured', 'news', 'main'));
		return $this;
	}

	protected function pageTitle()
	{
		return $this;
	}

	protected function registerClientFiles()
	{
		$this->m_js['home_content'] = array(
			array(
				'file' => '/wow/static/local-common/js/slideshow.js',
				'version' => 27
			),
			array(
				'file' => '/wow/static/local-common/js/third-party/swfobject.js',
				'version' => 27
			)
		);

		return $this;
	}

	protected function unit_carousel()
	{
		return $this->unit('List')
			->setModel('WowCarousel')
			->order(array('WowCarousel' => array('slide_position')))
			->fieldCondition('wow_carousel.active', '= 1');
	}

	protected function unit_news()
	{
		return $this->unit('List')
			->setModel('WowNews')
			->order(array('WowNews' => array('postdate')), 'DESC')
			->limit(10);
	}

	protected function block_main()
	{
		return $this->block('List')
			->setVar('items', $this->c('Wow')->getBlogNews())
			->setRegion('pagecontent')
			->setTemplate('home', 'wow' . DS . 'contents');
	}

	protected function block_carousel()
	{
		return $this->block('List')
			->setMainUnit('carousel')
			->setRegion('carousel')
			->setTemplate('carousel', 'wow' . DS . 'blocks');
	}

	protected function block_featured()
	{
		return $this->block('List')
			->setMainUnit('news')
			->setRegion('featured')
			->setTemplate('featured', 'wow' . DS . 'blocks');
	}

	protected function block_news()
	{
		return $this->block('List')
			->setVar('items', $this->c('Wow')->getBlogNews())
			->setRegion('news')
			->setTemplate('news', 'wow' . DS . 'blocks');
	}
}
?>