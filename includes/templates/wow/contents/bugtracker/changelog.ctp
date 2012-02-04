<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<span style="padding:20px;float:left"><h1>ServerWoW BugTracker</h1><span style="color:#00ff00;">Selecciona la Categoria</span></span>

<div class="filter-details">

<span class="clear"><!-- --></span>
</div>
</div>
</div>

<div style="min-height:900px;">
	<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
		<center>
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-5286168753620257";
				/* ServerWoW.com (Bugtracker 728&#42;90) */
				google_ad_slot = "5141927827";
				google_ad_width = 728;
				google_ad_height = 90;
				//-->
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
		</center>
		<?php
		$isBt = $this->c('AccountManager')->isAllowedToBugtracker();
		if ($isBt) : ?>
		<a href="<?php echo $this->getWowUrl('bugtracker/changelog/add'); ?>" class="ui-button button2"><span><span>Add revision to changelog</span></span></a>
		<?php endif; ?>
		<div class="item-results" id="item-results">
			<div class="table full-width">
				<table>
					<thead>
						<tr>
							<th><span class="sort-tab">Rev ID</span></th>
							<th><span class="sort-tab">Fix ID</span></th>
							<th><span class="sort-tab">Commiter</span></th>
							<th><span class="sort-tab">Description</span></th>
							<th><span class="sort-tab">Date</span></th>
							<?php if ($isBt) : ?><th><span class="sort-tab">Operations</span></th><?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<?php
						$items = $bt->getChangelogItems();
						if ($items) :
							$toggleStyle = 2;
							foreach ($items as $item) :
						?>
						<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
							<td><?php echo $item['revid']; ?></td>
							<td><?php echo $item['fixid']; ?></td>
							<td><?php echo $item['commiter']; ?></td>
							<td><?php echo striptslashes($item['description']); ?></td>
							<td><?php echo date('d/m/Y', $item['post_date']); ?></td>
							<?php if ($isBt) : ?><td><a href="/wow/bugtracker/changelog/<?php echo $item['id'];?>/delete">Delete</a> | <a href="/wow/bugtracker/changelog/<?php echo $item['id'];?>/edit">Edit</a></td><?php endif; ?>
						</tr>
						<?php ++$toggleStyle; endforeach; else : ?>
						<tr class="row1">
							<td colspan="<?php echo $isBt ? '6' : '5'; ?>" class="align-center">No se ha encontrado ningun resultado</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	<span class="clear"><!-- --></span><br />
			<ul class="ui-pagination">
				<?php echo $pagination; ?>
			</ul>
	<span class="clear"><!-- --></span>
	<br>
<center><script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Bugtracker 728&#42;90) */
google_ad_slot = "5141927827";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center>
	</div>

	<div style="float:left;width:230px;position:relative;">
		<?php echo $this->region('bt_menu'); ?>
	</div>
</div>
	</div>
	</div>
