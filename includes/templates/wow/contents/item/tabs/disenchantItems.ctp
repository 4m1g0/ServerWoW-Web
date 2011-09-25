<div class="related-content" id="related-disenchantItems">
	<div class="filters inline">
		<div class="keyword">
			<span class="view"></span>
			<span class="reset" style="display: none"></span>
			<input id="filter-name-disenchantItems" type="text" class="input filter-name" data-filter="row" maxlength="25" title="Фильтр" value="Фильтр" />
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
							<th class="align-center">
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow"><?php echo $l->getString('template_item_tab_header_count'); ?></span>
	</a>

							</th>
							<th>
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow"><?php echo $l->getString('template_item_tab_header_droprate'); ?></span>
	</a>

							</th>
					</tr>
				</thead>
			<tbody>
				<?php
				$toggleStyle = 2;
				$icons_server = $this->c('Config')->getValue('site.icons_server');
				foreach ($tab['contents'] as $cont) :
				?>
				<tr class="row<?php echo ($toggleStyle % 2) ? '1' : '2'; ?>">
					<td data-raw="<?php echo (1 - $cont['Quality']) . ' ' . $cont['name']; ?>">
						<a href="<?php echo $this->getWowUrl('item/' . $cont['entry']); ?>" class="item-link color-q<?php echo $cont['Quality']; ?>">




		<span  class="icon-frame frame-18 " style='background-image: url("<?php echo $icons_server; ?>/18/<?php echo $cont['icon']; ?>.jpg");'>
		</span>
							<strong><?php echo $cont['name']; ?></strong>
						</a>
					</td>
					<td class="align-center" data-raw="<?php echo $cont['ItemLevel']; ?>">
							<?php echo $cont['ItemLevel']; ?>
					</td>
					<td class="align-center" data-raw="<?php echo $cont['dismaxcount']; ?>">
						<?php echo $cont['dismaxcount']; ?>
					</td>
					<td data-raw="<?php if (isset($cont['dropInfo'])) echo $cont['dropInfo']['rate']; ?>">
					<?php if (isset($cont['dropInfo'])) echo $l->getString('template_item_drop_rate_' . $cont['dropInfo']['rate']); ?>
					</td>
				</tr>
				<?php ++$toggleStyle; endforeach; ?>

		<tr class="no-results">
			<td colspan="4" class="align-center">
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
		Wiki.related['disenchantItems'] = new WikiRelated('disenchantItems', {
			paging: true,
			totalResults: <?php echo sizeof($tab['contents']); ?>,
			results: 50,
			column: 0
		});
        //]]>
        </script>
</div>

