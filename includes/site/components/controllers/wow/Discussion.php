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

class Discussion_Wow_Controller_Component extends Groupwow_Controller_Component
{
	public function build($core)
	{
		if (!$this->c('AccountManager')->isLoggedIn())
		{
			$core->redirectUrl('');
			return $this;
		}

		$this->ajaxPage(true);

		$blog_id = intval($core->getUrlAction(2));

		if ($blog_id > 0)
		{
			if ($core->getUrlAction(3) == 'api')
			{
				if ($this->c('Wow')->runBlogApi($blog_id))
					echo 'ok';
				else
					echo 'nok';
			}
			elseif (isset($_POST['detail']))
				$this->c('Wow')->addBlogComment($blog_id, $_POST['detail']);
			else
				$core->redirectUrl('');
		}
		else
			$core->redirectUrl('');

		return $this;
	}
}
?>