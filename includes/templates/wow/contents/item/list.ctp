<div id="wiki" class="wiki directory wiki-item">
	<div class="title">
		<h2><?php echo $l->getString('template_menu_items'); ?></h2>
	</div>
	<div class="item-results" id="item-results">
	<?php echo $this->region('pager'); ?>
	<div class="table full-width">
				<table>
					<thead>
						<tr>
							<th><span class="sort-tab"><?php echo $l->getString('template_item_table_name'); ?></span></th>
							<th><span class="sort-tab"><?php echo $l->getString('template_item_table_level'); ?></span></th>
							<th><span class="sort-tab"><?php echo $l->getString('template_item_table_required_level'); ?></span></th>
							<th><span class="sort-tab"><?php echo $l->getString('template_item_table_source'); ?></span></th>
							<th><span class="sort-tab"><?php echo $l->getString('template_item_table_type'); ?></span></th>
						</tr>
					</thead>
					<tbody>
					<?php
					if ($items) :
					$row = 2;
					$icons_server = $this->c('Config')->getValue('site.icons_server');
					foreach ($items as &$item) :
					?>
						<tr class="row<?php if ($row % 2) echo '1'; else echo '2'; ?>">
							<td data-raw="<?php echo (7 - $item['Quality']) . ' ' . $item['name']; ?>">
								<a href="<?php echo $this->getWowUrl('item/' . $item['entry']); ?>" class="item-link color-q<?php echo $item['Quality']; ?>">
									<span  class="icon-frame frame-18 " style='background-image: url("<?php echo $icons_server; ?>/18/<?php echo $item['icon']; ?>.jpg");'> </span>
									<strong><?php echo $item['name']; ?></strong>
									<?php
									if ($item['Flags'] & ITEM_FLAGS_HEROIC) echo '<span class="icon-heroic-skull"></span>';
									if ($item['FlagsExtra'] & ITEM_FLAGS2_ALLIANCE_ONLY) echo '<span class="icon-faction-0"></span>';
									elseif ($item['FlagsExtra'] & ITEM_FLAGS2_HORDE_ONLY) echo '<span class="icon-faction-1"></span>';
									?>
								</a>
							</td>
							<td class="align-center">
								<?php echo $item['ItemLevel']; ?>
							</td>
							<td class="align-center" data-raw="<?php echo $item['RequiredLevel']; ?>">
								<?php echo $item['RequiredLevel']; ?>
							</td>
							<td> </td>
							<td><!-- TODO: type here --></td>
						</tr>

					<?php ++$row; endforeach; endif; ?>
					</tbody>
				</table>
			</div>

	<?php echo $this->region('pager'); ?>
	<span class="clear"><!-- --></span>
	</div>
</div>