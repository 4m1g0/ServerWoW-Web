<?php echo $this->region('pagination'); ?>
<div class="view-table">

	<div class="table ">
		<table>
				<thead>
					<tr>
						<th class=" first-child">
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_charname'); ?>
</span>
		</a>
							</th>


							<th>





		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_realm'); ?>
</span>
		</a>
							</th>
							<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_battlegroup'); ?>
</span>
		</a>
							</th>


							<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_faction'); ?>
</span>
		</a>
							</th>
					</tr>
				</thead>
			<tbody>

			<?php
			$guilds = $search->getResults('wowguild');
			if ($guilds) :
				$toggleStyle = 2;
				$count = 1;
				$offset = $this->getPage(false) * 20;
				$iter = 20;
				$bg = $this->c('Config')->getValue('site.battlegroup');
				foreach ($guilds as $r) :
				foreach ($r as &$g) :
					++$iter;
					if ($iter < $offset)
						continue;
					if ($count == 20)
						break;
			?>
			<tr class="row1">
				<td>
					<a href="<?php echo $g['url']; ?>">
						<strong><?php echo $g['name']; ?></strong>
					</a>
				</td>
				<td><?php echo $g['realmName']; ?></td>
				<td><?php echo $bg; ?></td>
				<td class="align-center">

		<span class="icon-frame frame-14 " data-tooltip="<?php echo $l->getString('faction_' . $g['faction_text']); ?>">
			<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/faction_<?php echo $g['faction_text'] == 'alliance' ? '0' : '1'; ?>.jpg" alt="" width="14" height="14" />
		</span>
				</td>
			</tr>
			<?php ++$toggleStyle; ++$count; endforeach; endforeach; endif; ?>

			</tbody>
		</table>
	</div>
		</div>
	<?php echo $this->region('pagination'); ?>