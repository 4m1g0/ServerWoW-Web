<?php
if (!$pager || $pager['pagesCount'] == 0) return;
$current = false;
$skipLast = false;
$url_str = '';
if ($pagerOptions)
{
	foreach ($pagerOptions as $opt => $val)
	{
		if ($opt != 'page')
			$url_str .= '&amp;' . $opt . '=' . $val;
	}
}
if (!isset($onlyPaging))
	$onlyPaging = false;

if (!$onlyPaging) :
?>
<div class="table-options data-options ">
	<div class="option">

<?php endif; ?>
		<ul class="ui-pagination">
		<?php if ($pager['allowPrev']) : ?>
		<li class="cap-item">
			<a href="?page=<?php echo $pager['prev'] . $url_str; ?>"><?php echo $l->getString('template_item_table_prev'); ?></a>
		</li>
		<?php endif; ?>
		<li<?php
		if ($pager['current'] == 1)
		{
			echo ' class="current"';
			$current = true;
		}
		?>>
			<a href="?page=1<?php echo $url_str; ?>">1</a>
		</li>
		<?php if ($pager['break_left']) : ?>
			<li class="expander">…</li>
		<?php endif; ?>
		<?php
		if (isset($pager['pages']['left']) && $pager['pages']['left']) :
			foreach ($pager['pages']['left'] as $page) : if ($page == 1) continue; if ($page == $pager['pagesCount']) $skipLast = true;
		?>
		<li<?php if ($page == $pager['current']) {echo ' class="current"'; $current = true;} ?>>
			<a href="?page=<?php echo $page . $url_str; ?>"><?php echo $page; ?></a>
		</li>
		<?php endforeach; endif; ?>
		<?php if (isset($pager['pages']['left']) && isset($pager['pages']['right']) && !$current) : ?>
		<?php if ($pager['current'] == $pager['pagesCount']) $skipLast = true; ?>
		<li class="current">
			<a href="?page=<?php echo $pager['current'] . $url_str; ?>"><?php echo $pager['current']; ?></a>
		</li>
		<?php endif; ?>
		<?php
		if (isset($pager['pages']['right']) && $pager['pages']['right']) :
		foreach ($pager['pages']['right'] as $page) : if ($page == $pager['pagesCount']) : $skipLast = true; continue; endif;
		?>
		<li<?php if ($page == $pager['current']) {echo ' class="current"'; $current = true;} ?>>
			<a href="?page=<?php echo $page . $url_str; ?>"><?php echo $page; ?></a>
		</li>
		<?php endforeach; endif; ?>
		<?php if ($pager['break_right']) : ?>
			<li class="expander">…</li>
		<?php endif; if (!$skipLast) : ?>
			<li>
				<a href="?page=<?php echo $pager['pagesCount'] . $url_str; ?>"><?php echo $pager['pagesCount']; ?></a>
			</li>
		<?php endif; if ($pager['allowNext']) : ?>
			<li class="cap-item">
				<a href="?page=<?php echo $pager['next'] . $url_str; ?>"><?php echo $l->getString('template_item_table_next'); ?></a>
			</li>
		<?php endif; ?>
		</ul>
<?php if (!$onlyPaging) : ?>
	</div>
	<?php echo $l->format('template_guild_roster_results_count', $pager['result_start'], $pager['result_end'], $pager['result_total']); ?>
	<span class="clear"><!-- --></span>
</div>
<?php endif; ?>
