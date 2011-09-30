<div class="related-content" id="related-vendors">
	<div class="filters inline">
		<div class="keyword">
			<span class="view"></span>
			<span class="reset" style="display: none"></span>
			<input id="filter-name-vendors" type="text" class="input filter-name" data-filter="row" maxlength="25" title="<?php echo $l->getString('template_guild_roster_filter'); ?>" value="<?php echo $l->getString('template_guild_roster_filter'); ?>" />
		</div>
	<span class="clear"><!-- --></span>
	</div>

		<div class="data-options-top">

	<div class="table-options data-options ">
		<?php echo $l->format('template_guild_roster_results_count', 1, (sizeof($tab['contents']) > 50 ? 50 : sizeof($tab['contents'])), sizeof($tab['contents'])); ?>

	<span class="clear"><!-- --></span>
	</div>
		</div>


	<div class="table full-width">
		<table>
				<thead>
					<tr>
							<th>
										<a href="javascript:;" class="sort-link">
		<span class="arrow"><?php echo $l->getString('template_item_tab_header_name'); ?></span>
	</a>

							</th>
							<th class="align-center">
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow"><?php echo $l->getString('template_item_tab_header_level'); ?></span>
	</a>

							</th>
							<th>
										<a href="javascript:;" class="sort-link">
		<span class="arrow"><?php echo $l->getString('template_item_tab_header_zone'); ?></span>
	</a>

							</th>
					</tr>
				</thead>
			<tbody>
			<?php
			$toggleStyle = 2;
			foreach ($tab['contents'] as $cont) : ?>
				<tr class="row<?php echo (($toggleStyle % 2) ? '2' : '1'); ?>">
					<td>
		<strong><?php echo $cont['name']; ?></strong>

		<em><?php if ($cont['subname'] != null) echo $cont['subname']; ?></em>
					</td>
					<td class="align-center" data-raw="<?php echo $cont['maxlevel']; ?>">
							<?php echo $cont['maxlevel']; ?>

							<?php if ($cont['rank'] == 3) echo '<em>(' . $l->getString('template_boss_boss_rank') . ')</em>'; ?>
							<?php if ($cont['rank'] == 2) echo '<em>(' . $l->getString('template_boss_elite_rank') . ')</em>'; ?>
					</td>
					<td data-raw="<?php echo $cont['zone_info']['name']; ?>">
					<?php
					if ($cont['zone_info']) :
						if ($cont['zone_info']['zone_key']) :
					?>
		<a href="<?php echo $this->getWowUrl('zone/' . $cont['zone_info']['zone_key'] . '/'); ?>" data-zone="<?php echo $cont['zone_info']['area']; ?>">
			<?php echo $cont['zone_info']['name']; ?>
		</a>						
		<?php else : ?>
		<?php echo $cont['zone_info']['name']; ?>
		<?php endif; endif;?>
							<?php if (isset($cont['isHeroic']) && $cont['isHeroic'] && $cont['zone_info']['flags'] & INSTANCE_FLAG_HEROIC) echo '(' . $l->getString('template_item_heroic') . ')'; ?>
					</td>
				</tr>
				<?php ++$toggleStyle; endforeach; ?>

		<tr class="no-results">
			<td colspan="5" class="align-center">
				<?php echo $l->getString('template_item_tab_content_no_results'); ?>
			</td>
		</tr>
			</tbody>
		</table>
	</div>
		<div class="data-options-bottom">
	<div class="table-options data-options ">
		<?php echo $l->format('template_guild_roster_results_count', 1, (sizeof($tab['contents']) > 50 ? 50 : sizeof($tab['contents'])), sizeof($tab['contents'])); ?>

	<span class="clear"><!-- --></span>
	</div>
		</div>

        <script type="text/javascript">
        //<![CDATA[
		Wiki.related['vendors'] = new WikiRelated('vendors', {
			paging: true,
			totalResults: <?php echo sizeof($tab['contents']); ?>,
			results: 50,
			column: 0
		});
        //]]>
        </script>
</div>

