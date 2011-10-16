<?php if (!$pagination) return; if (!isset($onlyPagination)) $onlyPagination = false; ?>
<?php if (!$onlyPagination): ?>
<div class="table-options data-options ">
	<div class="option">
<?php endif; ?>
		<ul class="ui-pagination">
			<?php echo $pagination; ?>
		</ul>
<?php if (!$onlyPagination) : ?>
	</div>
	<?php echo $l->format('template_guild_roster_results_count', $pager['result_start'], $pager['result_end'], $pager['result_total']); ?>
	<span class="clear"><!-- --></span>
</div>
<?php endif; ?>