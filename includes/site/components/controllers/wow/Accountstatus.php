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

class Accountstatus_Wow_Controller_Component extends Groupwow_Controller_Component
{
	protected $m_customErrorMsg = '';

	protected function setBreadcrumb()
	{
		$this->m_breadcrumb = array(
			array(
				'link' => '',
				'caption' => 'World of Warcraft'
			)
		);
		
		return $this;
	}

	public function build($core)
	{
		if (!$this->c('AccountManager')->isHaveAnyCharacters())
			$this->m_customErrorMsg = 'template_account_error_no_characters';
		if ($ban_info = $this->c('AccountManager')->isBanned())
		{
			$this->m_customErrorMsg = $this->c('Locale')->format('template_account_status_info_banned',
				($ban_info['bandate'] == $ban_info['unbandate'] ? 'permamently' : 'from ' . date('d.m.Y H:i', $ban_info['bandate']) . ' till ' . date('d.m.Y H:i', $ban_info['unbandate'])),
				($ban_info['bannedby'] && $ban_info['username'] ? $ban_info['username'] : '&lt;unknown user&gt;'),
				($ban_info['banreason'] ? $ban_info['banreason'] : 'unknown')
			);
		}

		$this->buildBlock('status');
		$this->buildBreadcrumb();

		return $this;
	}

	protected function block_status()
	{
		return $this->block()
			->setVar('errorMsg', $this->m_customErrorMsg)
			->setTemplate('status', 'wow' . DS . 'contents' . DS . 'account-status')
			->setRegion('pagecontent');
	}
}
?>