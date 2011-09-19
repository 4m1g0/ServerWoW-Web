<div class="reputation reputation-simple" id="reputation">
	<div class="profile-section-header">
		<h3 class="category "><?php echo $l->getString('template_profile_reputation'); ?></h3>
	</div>

	<div class="profile-section">
		<div class="profile-filters">
			<div class="tabs">
				<a href="<?php echo $character->getUrl(); ?>/reputation/"  class="tab-active">
					<?php echo $l->getString('template_reputation_simple'); ?>
				</a>
				<a href="<?php echo $character->getUrl(); ?>/reputation/tabular" >
					<?php echo $l->getString('template_reputation_tabular'); ?>
				</a>
			</div>
		</div>

		<ul class="reputation-list">
		<?php
		$reputation = $character->getReputation();
		if ($reputation) :
			foreach ($reputation as $category_id => &$categories) :
		?>
			<li class="reputation-category">
				<h3 class="category-header"><?php echo $character->getReputationFactionName($category_id); ?></h3>
				<?php if (is_array($categories)) : ?>
				<ul class="reputation-entry">
				<?php foreach ($categories as $subCatId => &$subCat) : ?>
					<?php if (isset($subCat['id'])) : ?>
					<li class="faction-details">
						<div class="rank-<?php echo $subCat['type']; ?>">
							<a href="javascript:;" data-fansite="faction|<?php echo $subCat['id'] . '|' . $subCat['name']; ?>" class="fansite-link float-right"> </a>
							<span class="faction-name"><a href="<?php echo $this->getWowUrl('faction/' . $subCat['key']); ?>" data-faction="<?php echo $subCat['id']; ?>"><?php echo $subCat['name']; ?></a></span>
							<div class="faction-standing">
								<div class="faction-bar">
									<div class="faction-score"><?php echo $subCat['adjusted'] . ' / ' . $subCat['cap']; ?></div>
									<div class="faction-fill<?php if ($subCat['percent'] > 99) echo ' full-fill'; ?>" style="width: <?php echo $subCat['percent']; ?>%;"></div>
								</div>
							</div>
							<div class="faction-level"><?php echo  $l->getString('reputation_rank_' . $subCat['type']); ?></div>
							<span class="clear"><!-- --></span>
						</div>
					</li>
					<?php elseif (isset($subCat[0])) : ?>
					<li class="reputation-subcategory">
						<div class="faction-details faction-subcategory-details ">
							<h4 class="faction-header"><?php echo $character->getReputationFactionName($subCatId); ?></h4>
							<span class="clear"><!-- --></span>
						</div>
						<ul class="factions">
							<?php foreach ($subCat as &$faction) : ?>
							<li class="faction-details">
								<div class="rank-<?php echo $faction['type']; ?>">
									<a href="javascript:;" data-fansite="faction|<?php echo $faction['id'] . '|' . $faction['name']; ?>" class="fansite-link float-right"> </a>
									<span class="faction-name"><a href="<?php echo $this->getWowUrl('faction/' . $faction['key']); ?>" data-faction="<?php echo $faction['id']; ?>"><?php echo $faction['name']; ?></a></span>
									<div class="faction-standing">
										<div class="faction-bar">
											<div class="faction-score"><?php echo $faction['adjusted'] . '/' . $faction['cap']; ?></div>
											<div class="faction-fill<?php if ($faction['percent'] > 99) echo ' full-fill'; ?>" style="width: <?php echo $faction['percent']; ?>%;"></div>
										</div>
									</div>
									<div class="faction-level"><?php echo  $l->getString('reputation_rank_' . $faction['type']); ?></div>
									<span class="clear"><!-- --></span>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</li>
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</li>
			<?php endforeach; endif; ?>
		</ul>
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