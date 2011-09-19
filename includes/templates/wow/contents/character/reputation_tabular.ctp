<div class="reputation reputation-tabular" id="reputation">
	<div class="profile-section-header">
		<h3 class="category "><?php echo $l->getString('template_profile_reputation'); ?></h3>
	</div>

	<div class="profile-section">
		<div class="profile-filters">
			<div class="tabs">
				<a href="<?php echo $character->getUrl(); ?>/reputation/">
					<?php echo $l->getString('template_reputation_simple'); ?>
				</a>
				<a href="<?php echo $character->getUrl(); ?>/reputation/tabular"  class="tab-active">
					<?php echo $l->getString('template_reputation_tabular'); ?>
				</a>
			</div>
		</div>
		<div class="table">
			<table id="sortable">
			<thead>
				<tr>
					<th><a href="#" class="sort-link"><span class="arrow"><?php echo $l->getString('template_reputation_table_name'); ?></span></a></th>
					<th colspan="2"><a href="#" class="sort-link numeric"><span class="arrow"><?php echo $l->getString('template_reputation_table_standing'); ?></span></a></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$reputation = $character->getReputation();
			if ($reputation) :
				$toggleStyle = 2;
				foreach ($reputation as &$rep) :
					foreach ($rep as &$cat) :
						if (isset($cat['id'])) :
			?>
				<tr class="row<?php echo ($toggleStyle % 2) ? '2' : '1'; ?>">
					<td><span class="faction-name"><a href="<?php echo $this->getWowUrl('faction/' . $cat['key']); ?>" data-faction="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></a></span></td>
					<td class="rank-<?php echo $cat['type']; ?>" data-raw="<?php echo $cat['type']; ?>">
						<div class="faction-standing">
							<div class="faction-bar">
								<div class="faction-score"><?php echo $cat['adjusted'] . '/' . $cat['cap']; ?></div>
								<div class="faction-fill<?php if ($cat['percent'] > 99) echo ' fill-full'; ?>" style="width: <?php echo $cat['percent']; ?>%;"></div>
							</div>
						</div>
					</td>
					<td class="rank-<?php echo $cat['type']; ?>" data-raw="<?php echo $cat['type']; ?>">
						<a href="javascript:;" data-fansite="faction|<?php echo $cat['id'] . '|' . $cat['name']; ?>" class="fansite-link float-right"> </a>
						<span class="faction-level"><?php echo $l->getString('reputation_rank_' . $cat['type']); ?></span>
					</td>
				</tr>
			<?php ++$toggleStyle; elseif (isset($cat[0])) :
				foreach ($cat as &$f) :
			?>
				<tr class="row<?php echo ($toggleStyle % 2) ? '2' : '1'; ?>">
					<td><span class="faction-name"><a href="<?php echo $this->getWowUrl('faction/' . $f['key']); ?>" data-faction="<?php echo $f['id']; ?>"><?php echo $f['name']; ?></a></span></td>
					<td class="rank-<?php echo $f['type']; ?>" data-raw="<?php echo $f['type']; ?>">
						<div class="faction-standing">
							<div class="faction-bar">
								<div class="faction-score"><?php echo $f['adjusted'] . '/' . $f['cap']; ?></div>
								<div class="faction-fill<?php if ($f['percent'] > 99) echo ' fill-full'; ?>" style="width: <?php echo $f['percent']; ?>%;"></div>
							</div>
						</div>
					</td>
					<td class="rank-<?php echo $f['type']; ?>" data-raw="<?php echo $f['type']; ?>">
						<a href="javascript:;" data-fansite="faction|<?php echo $f['id'] . '|' . $f['name']; ?>" class="fansite-link float-right"> </a>
						<span class="faction-level"><?php echo $l->getString('reputation_rank_' . $f['type']); ?></span>
					</td>
				</tr>
			<?php ++$toggleStyle; endforeach; endif; endforeach; endforeach; endif; ?>
			</tbody>
		</table>
	</div>

	<script type="text/javascript">
	//<![CDATA[
	$(function() {
		Reputation.table = new Table('#sortable', { column: 0 });
		Reputation.table.config.articles = ['a','an','the'];
	});
	//]]>
	</script>
	</div>
	</div>
</div>
<span class="clear"><!-- --></span>
<script type="text/javascript">
//<![CDATA[
$(function() {
	Profile.url = '<?php echo $character->getUrl(); ?>/reputation';
});

var MsgProfile = {
	tooltip: {
		feature: {
			notYetAvailable: "<?php echo $l->getString('template_feature_not_available'); ?>"
		},
		vault: {
			character: "<?php echo $l->getString('template_vault_auth_required'); ?>",
			guild: "<?php echo $l->getString('template_vault_guild'); ?>"
		}
	}
};
//]]>
</script>