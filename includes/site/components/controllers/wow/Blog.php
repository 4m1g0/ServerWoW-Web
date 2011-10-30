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

class Blog_WoW_Controller_Component extends Groupwow_Controller_Component
{
	protected function buildBreadcrumb()
	{
		$unit_data = $this->unit_item()->findData()->getData();
		if (!$unit_data)
			return $this;

		$this->m_breadcrumb = array(
			array(
				'link' => '',
				'caption' => 'World of Warcraft'
			),
			array(
				'link' => 'blog/' . $unit_data['id'],
				'caption' => $unit_data['title']
			)
		);

		$this->buildBlock('breadcrumb');
		return $this;
	}

	public function build($core)
	{
		$this->buildBreadcrumb()->buildBlocks(array('featured', 'item'));

		return $this;
	}

	protected function block_featured()
	{
		return $this->block('List')
			->setMainUnit('news')
			->setRegion('featured')
			->setTemplate('featured', 'wow' . DS . 'blocks');
	}

	protected function unit_news()
	{
		return $this->unit('List')
			->setModel('WowNews')
			->order(array('WowNews' => array('postdate')), 'DESC')
			->limit(10);
	}

	protected function unit_item()
	{
		return $this->unit('Item')
			->setModel('WowNews')
			->fieldCondition('id', ' = ' . ((int) $this->core->getUrlAction(2)));
	}

	protected function block_item()
	{
		return $this->block('Item')
			->setMainUnit('item')
			->setTemplate('blog', 'wow' . DS . 'contents')
			->setRegion('pagecontent');
	}
}
?>