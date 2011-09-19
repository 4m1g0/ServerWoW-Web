<?php
if (!$pager) return;
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
?>
<div class="table-options data-options ">
	<div class="option">
		<ul class="ui-pagination">
		<?php if ($pager['allowPrev']) : ?>
		<li class="cap-item">
			<a href="?page=<?php echo $pager['prev'] . $url_str; ?>">Пред.</a>
		</li>
		<?php endif; ?>
		<li<?php if ($pager['current'] == 1) { echo ' class="current"'; $current = true; } ?>>
			<a href="?page=1<?php echo $url_str; ?>">1</a>
		</li>
		<?php if ($pager['break_left']) : ?>
			<li class="expander">…</li>
		<?php endif; ?>
		<?php
		if (isset($pager['pages']['left']) && $pager['pages']['left']) :
			foreach ($pager['pages']['left'] as $page) : if ($page == 1) continue;
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
		foreach ($pager['pages']['right'] as $page) : if ($page == $pager['pagesCount']) continue;
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
				<a href="?page=<?php echo $pager['next'] . $url_str; ?>">Далее</a>
			</li>
		<?php endif; ?>
		</ul>
	</div>
	Результаты <strong class="results-start"><?php echo $pager['result_start']; ?></strong>–<strong class="results-end"><?php echo $pager['result_end']; ?></strong> из <strong class="results-total"><?php echo $pager['result_total']; ?></strong>
	<span class="clear"><!-- --></span>
</div>
