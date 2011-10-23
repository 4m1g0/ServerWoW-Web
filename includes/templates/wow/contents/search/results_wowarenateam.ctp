<?php
echo $this->region('pagination');
$bg = $this->c('Config')->getValue('site.battlegroup');
?>
<div class="view-table">
	<div class="table ">
		<table>
				<thead>
					<tr>
						<th class=" first-child">
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_teamname'); ?></span>
		</a>
						</th>
						<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_teamtype'); ?></span>
		</a>
						</th>
							<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_realm'); ?></span>
		</a>
							</th>
							<th>

		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_battlegroup'); ?></span>
		</a>
							</th>
							<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_faction'); ?></span>
		</a>
							</th>
							<th class=" last-child">
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_teamrank'); ?></span>
		</a>
							</th>
					</tr>
				</thead>
			<tbody>

			<?php
			$teams = $search->getResults('wowarenateam');
			if ($teams) :
				$toggleStyle = 2;
				$count = 1;
				$offset = $this->getPage(false) * 20;
				$iter = 20;
				foreach ($teams as $r) :
				foreach ($r as &$a) :
					++$iter;
					if ($iter < $offset)
						continue;
					if ($count == 20)
						break;
			?>
			<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
				<td>
					<a href="<?php echo $a['url']; ?>">
						<strong><?php echo $a['name']; ?></strong>
					</a>
				</td>
				<td class="align-center"><?php echo $l->format('template_team_type_format', $a['type'], $a['type']); ?></td>
				<td><?php echo $a['realmName']; ?></td>
				<td><?php echo $bg; ?></td>
				<td class="align-center">




		<span class="icon-frame frame-14 " data-tooltip="<?php echo $l->getString('faction_' . $a['faction_text']); ?>">
			<img src="http://eu.media.blizzard.com/wow/icons/18/faction_<?php echo $a['faction'] == FACTION_ALLIANCE ? '0' : '1'; ?>.jpg" alt="" width="14" height="14" />
		</span>
				</td>
				<td class="align-center"><?php echo $a['rank']; ?></td>
			</tr>
			<?php ++$toggleStyle; ++$count; endforeach; endforeach; endif;?>

			</tbody>
		</table>
	</div>
		</div>
<?php echo $this->region('pagination'); ?>