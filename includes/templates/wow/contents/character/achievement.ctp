<div class="profile-section-header">
			<div class="achievement-points-anchor">
				<div class="achievement-points">
					<?php echo $achievement->getPoints(); ?>
		</div>
			</div>

	<ul class="profile-tabs">
			<li class="tab-active">
				<a href="achievement" rel="np">
					<span class="r"><span class="m">
						<?php echo $l->getString('template_profile_achievement'); ?>
					</span></span>
				</a>
			</li>
			<li>
				<a href="statistic" rel="np">
					<span class="r"><span class="m">
						<?php echo $l->getString('template_profile_statistic'); ?>
					</span></span>
				</a>
			</li>
	</ul>
		</div>

		<div class="profile-section">
			<div class="search-container keyword" id="search-container" style="display: none;">
				<span class="view"></span>
				<span class="reset" style="display: none"></span>
				<input type="text" id="achievement-search" alt="<?php echo $l->getString('template_achievements_search'); ?>" value="<?php echo $l->getString('template_achievements_search'); ?>" onkeyup="AchievementsHandler.doSearch(this.value)" class="input" autocomplete="off"  />
			</div>

 

	<div id="cat-summary" class="container" style="display: none;">
		<h3 class="category"><?php echo $l->getString('template_achievements_progress'); ?></h3>

		<div class="achievements-total">

			<div class="profile-box-full">

				<div class="achievements-total-completed">
					<div class="desc">
						<?php echo $l->getString('template_achievements_total_completed'); ?>
					</div>
	    
	
	<?php $progress = $achievement->getProgressInfo(); ?>

	<div class="profile-progress border-4" onmouseover="Tooltip.show(this, &#39;<?php if (isset($progress[0])) echo $progress[0]['pointsCompleted'] . ' / ' . $progress[0]['points'] . ' ' . $l->getString('template_achievement_points'); ?>&#39;, { location: &#39;middleRight&#39; });">
		<div class="bar border-4 hover" style="width: <?php if(isset($progress[0])) echo $progress[0]['percent']; else echo '0'; ?>%"></div>
			<div class="bar-contents">
				<strong>
					<?php if(isset($progress[0])) echo $progress[0]['completed'] . ' / ' . $progress[0]['count'] . ' (' . (int) $progress[0]['percent'] . '%)'; ?>
				</strong>
			</div>
		</div>
	</div>

	<div class="achievements-categories-total">

			<?php
			if ($progress) : 
			foreach ($progress as $cat_id => &$cat) :
				if ($cat_id == 0) continue;
			?>
			<div class="entry">
				<div class="entry-inner<?php if (isset($cat['extraClass'])) echo ' ' . $cat['extraClass']; ?>">
					<strong class="desc"><?php echo $cat['title']; ?></strong>
					<div class="active-category" onclick="window.location.hash = 'achievement#<?php echo $cat_id;?>'; dm.openEntry(false)">
						<div class="profile-progress border-4<?php if ($cat_id == ACHIEVEMENTS_CATEGORY_FEATS) echo ' completed'; ?>"<?php if ($cat_id != ACHIEVEMENTS_CATEGORY_FEATS) : ?> onmouseover="Tooltip.show(this, &#39;<?php echo $cat['pointsCompleted'] . ' / ' . $cat['points'] . ' ' . $l->getString('template_achievement_points'); ?>&#39;, { location: &#39;middleRight&#39; });"<?php endif; ?>>
							<div class="bar border-4 hover" style="width: <?php echo $cat_id == ACHIEVEMENTS_CATEGORY_FEATS ? '1' : $cat['percent']; ?>%"></div>
							<div class="bar-contents">
								<?php echo $cat_id == ACHIEVEMENTS_CATEGORY_FEATS ? $cat['completed'] : $cat['completed'] . ' / ' . $cat['count'] . ' (' . (int) $cat['percent'] . '%)'; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php endforeach; endif; ?>
			<span class="clear"><!-- --></span>
		</div>
	</div>
</div>

	<h3 class="category"><?php echo $l->getString('template_achievements_latest_achievements'); ?></h3>
	<div class="achievements-recent profile-box-full">
	<?php
	$recent = $achievement->getRecentAchievements();
	if ($recent) : ?>
		<ul>
		<?php
		$icons_server = $this->c('Config')->getValue('site.icons_server');
		foreach ($recent as &$ach) : ?>

				<li>
					<a href="achievement#<?php echo $ach['categoryId']; ?>:a<?php echo $ach['id']; ?>" onclick="window.location.hash = '<?php echo $ach['categoryId']; ?>:a<?php echo $ach['id']; ?>'; dm.openEntry(false)" class="clear-after">
						<span class="float-right">
							<?php if ($ach['categoryId'] != ACHIEVEMENTS_CATEGORY_FEATS) : ?><span class="points"><?php echo $ach['points']; ?></span><?php endif; ?>
							<span class="date"><?php echo date('d/m/Y', $ach['date']); ?></span>
						</span>
						<span class="icon">
						<span  class="icon-frame frame-18 " style='background-image: url("<?php echo $icons_server; ?>/18/<?php echo $ach['iconname']; ?>.jpg");'> </span>
						</span>
						<span class="info">
							<strong class="title"><?php echo $ach['name']; ?></strong>
							<span class="description"><?php echo $ach['description']; ?></span>
						</span>
					</a>
				</li>
		<?php endforeach; ?>
	<?php endif; ?>

		</ul>
	</div>
</div>

	<div id="achievement-list" class="achievements-list"> </div>
</div>
<script type="text/javascript">
//<![CDATA[
$(function() {
	Profile.url = '<?php echo $character->getUrl(); ?>/achievement';
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
<script type="text/javascript">
//<![CDATA[
$(document).ready(function () {
	DynamicMenu.init({ "section": "achievement" });
	AchievementsHandler.init();
})
//]]>
</script>