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
			<span class="arrow"><?php echo $l->getString('template_search_table_level'); ?>
</span>
		</a>
							</th>
							<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_race'); ?>
</span>
		</a>
							</th>
							<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_class'); ?>
</span>
		</a>
							</th>
							<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_faction'); ?>
</span>
		</a>
							</th>
							<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_guild'); ?>
</span>
		</a>
							</th>
							<th>
		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_realm'); ?>
</span>
		</a>
							</th>
							<th class=" last-child">

		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_search_table_battlegroup'); ?>
</span>
		</a>
							</th>
					</tr>
				</thead>
			<tbody>
			
			<?php
			$characters = $search->getResults('wowcharacter');
			if ($characters) :
				$toggleStyle = 2;
				$count = 1;
				$offset = $this->getPage(false) * 20;
				$iter = 20;
				$bg = $this->c('Config')->getValue('site.battlegroup');
				foreach ($characters as $r) :
				foreach ($r as &$c) :
					++$iter;
					if ($iter < $offset)
						continue;
					if ($count == 20)
						break;
			?>
			<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
				<td>
					<a href="<?php echo $c['url']; ?>" class="item-link color-c<?php echo $c['class']; ?>">
						<span class="icon-frame frame-18">
							<img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/2d/avatar/<?php echo $c['race'] . '-' . $c['gender']; ?>.jpg" alt="" width="18" height="18" />
						</span>
						<strong><?php echo $c['name']; ?></strong>
					</a>
				</td>
				<td class="align-center">
					<?php echo $c['level']; ?>
				</td>
				<td class="align-center">
		<span class="icon-frame frame-14 " data-tooltip="<?php echo $c['race_text']; ?>">
			<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/race_<?php echo $c['race'] . '_' . $c['gender']; ?>.jpg" alt="" width="14" height="14" />
		</span>
				</td>
				<td class="align-center">
		<span class="icon-frame frame-14 " data-tooltip="<?php echo $c['class_text']; ?>">
			<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/class_<?php echo $c['class']; ?>.jpg" alt="" width="14" height="14" />
		</span>
				</td>
				<td class="align-center">
		<span class="icon-frame frame-14 " data-tooltip="<?php echo $l->getString('faction_' . ($this->c('Wow')->getFactionId($c['race']) == FACTION_ALLIANCE ? 'alliance' : 'horde')); ?>">
			<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/faction_<?php echo $this->c('Wow')->getFactionId($c['race']) == FACTION_ALLIANCE ? 0 : 1; ?>.jpg" alt="" width="14" height="14" />
		</span>
				</td>
				<td>
					<?php if ($c['guildid'] > 0) echo '<a href="' . $c['guildUrl'] . '" class="sublink">' . $c['guildName'] . '</a>'; ?>
				</td>
				<td><?php echo $c['realmName']; ?></td>
				<td><?php echo $bg; ?></td>
			</tr>
			<?php ++$toggleStyle; ++$count; endforeach; endforeach; endif; ?>

			</tbody>
		</table>
	</div>
		</div>
<?php echo $this->region('pagination'); ?>