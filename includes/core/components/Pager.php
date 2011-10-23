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

		$pages_count = ceil($data['totalCount'] / $data['limit']);

		$prev = $page > 1 ? $page - 1 : 1;
		$next = $page < $pages_count ?  $page + 1 : $pages_count;

		$pager = array(
			'source' => $data,
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

	/**
	 * phpBB2 code 
	 **/
	public function generatePagination($base_url, $num_items, $per_page, $start_item, $url_opt = '', $add_prevnext_text = TRUE)
	{
		if ($url_opt == '')
			$base_url = $base_url . '?page=';
		else
			$base_url = $base_url . '?' . $url_opt . 'page=';

		$begin_end = 3;
		$from_middle = 1;
	
		$total_pages = ceil($num_items/$per_page);
	
		if ($total_pages == 1)
			return '';
	
		$on_page = floor($start_item / $per_page) + 1;
	
		$page_string = '';
		if ($total_pages > ((2*($begin_end + $from_middle)) + 2))
		{
			$init_page_max = ( $total_pages > $begin_end ) ? $begin_end : $total_pages;
			for ($i = 1; $i < $init_page_max + 1; $i++)
			{
				$page_string .= ( $i == $on_page -1) ? '<li class="current"><a href="' . ($base_url . $i ) . '">' . $i . '</a></li>' : '<li><a href="' . ($base_url . $i . '">' . $i . '</a></li>');
				/*if ($i <  $init_page_max)
					$page_string .= ", ";*/
			}
			if ($total_pages > $begin_end)
			{
				if ($on_page > 1  && $on_page < $total_pages)
				{
					$page_string .= ( $on_page > ($begin_end + $from_middle + 1) ) ? ' ... ' : ', ';
	
					$init_page_min = ( $on_page > ($begin_end + $from_middle) ) ? $on_page : ($begin_end + $from_middle + 1);
	
					$init_page_max = ( $on_page < $total_pages - ($begin_end + $from_middle) ) ? $on_page : $total_pages - ($begin_end + $from_middle);
	
					for ($i = $init_page_min - $from_middle; $i < $init_page_max + ($from_middle + 1); $i++)
					{
						$page_string .= ($i == $on_page - 1) ? '<li class="current"><a href="' . ($base_url . $i ) . '">' . $i . '</a></li>' : '<li><a href="' . ($base_url . $i ) . '">' . $i . '</a></li>';
						if ($i <  $init_page_max + $from_middle)
							$page_string .= ', ';
					}
	
					$page_string .= ( $on_page < $total_pages - ($begin_end + $from_middle) ) ? ' ... ' : ', ';
				}
				else
					$page_string .= '<li class="expander">…</li>';
	
				for ($i = $total_pages - ($begin_end - 1); $i < $total_pages + 1; $i++)
				{
					$page_string .= ($i == $on_page - 1) ? '<li class="current"><a href="' . ($base_url . $i ) . '">' . $i . '</a></li>'  : '<li><a href="' . ($base_url . $i ) . '">' . $i . '</a></li>';
					/*if ($i < $total_pages)
						$page_string .= ', '; */
				}
			}
		}
		else
		{
			for ($i = 1; $i < $total_pages + 1; $i++)
			{
				$page_string .= ($i == $on_page - 1) ? '<li class="current"><a href="' . ($base_url . $i ) . '">' . $i . '</a></li>' : '<li><a href="' . ($base_url . $i ) . '">' . $i . '</a></li>';
				/*if ($i < $total_pages)
					$page_string .= ', '; */
			}
		}
	
		if ($add_prevnext_text)
		{
			if ($on_page > 2)
				$page_string = '<li class="cap-item"><a href="' . ($base_url . ($on_page - 2) ) . '">' . $this->c('Locale')->getString('template_item_table_prev') . '</a></li>' . $page_string;
	
			if ($on_page <= $total_pages)
				$page_string .= '<li class="cap-item"><a href="' . ($base_url . $on_page ) . '">' . $this->c('Locale')->getString('template_item_table_next') . '</a></li>';
	
		}
	
		return $page_string;
	}
}
?>