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

class Pager_Component extends Component
{
	protected $m_pagerData = array();

	public function getPager($data)
	{
		if (!isset($data['totalCount']) || !isset($data['limit']) || !$data['totalCount'] || !$data['limit'])
			return false;

		if (isset($_GET['page']) && $_GET['page'] > 0)
			$page = (int) $_GET['page'];
		else
			$page = 1;

		$pages_count = round($data['totalCount'] / $data['limit']);

		$prev = $page > 1 ? $page - 1 : 1;
		$next = $page < $pages_count ?  $page + 1 : $pages_count;

		$pager = array(
			'pagesCount' => $pages_count,
			'allowPrev' => $page > 1 ? true : false,
			'allowNext' => $page < $pages_count ? true : false,
			'prev' => $prev,
			'next' => $next,
			'current' => $page,
			'break_left' => true,
			'break_right' => true,
			'result_start' => $data['limit'] * ($page - 1) + 1,
			'result_end' => ($data['limit'] * ($page - 1)) + $data['limit'],
			'result_total' => $data['totalCount'],
			'pages' => array('left' => array(), 'right' => array())
		);

		if ($pager['result_start'] < 1)
			$pager['result_start'] = 1;

		if ($pager['result_end'] > $data['totalCount'])
			$pager['result_end'] = $data['totalCount'];
		

		if ($page < 5)
		{
			for ($i = 1; $i < 8; ++$i)
				if ($i <= $pages_count)
					$pager['pages']['left'][] = $i;
		}
		else
		{
			$left_limit = $page - 3;
			$right_limit = $page + 3;

			for ($i = 3; $i >= 1; --$i)
			{
				if ($page - $i < 1)
					continue;

				$pager['pages']['left'][] = $page - $i;
			}

			for ($i = 1; $i <= 3; ++$i)
			{
				if ($page + $i > $pages_count)
					continue;

				$pager['pages']['right'][] = $page + $i;
			}
		}

		if (isset($pager['pages']['left']) && isset($pager['pages']['left'][0]) && $pager['pages']['left'][0] <= 2)
			$pager['break_left'] = false;

		if ($pager['current'] == $pager['pagesCount'] || (isset($pager['pages']['right']) && $pager['pages']['right'] && min($pager['pages']['right']) + 4 >= $pages_count) || $pages_count <= 7)
			$pager['break_right'] = false;

		return $pager;
	}
}
?>