<div class="profile-section-header">
	<ul class="profile-tabs">
			<li>
				<a href="achievement" rel="np">
					<span class="r"><span class="m">
						<?php echo $l->getString('template_profile_achievement'); ?>
					</span></span>
				</a>
			</li>
			<li class="tab-active">
				<a href="statistic" rel="np">
					<span class="r"><span class="m">
						<?php echo $l->getString('template_profile_statistic'); ?>
					</span></span>
				</a>
			</li>
	</ul>
		</div>
		<div class="profile-section">
			<div class="search-container" id="search-container">
				<div class="keyword">
					<span class="view"></span>
					<span class="reset" style="display: none"></span>
					<input alt="<?php echo $l->getString('template_character_statistic_sort'); ?>" id="statistic-search" class="input" onkeyup="StatisticHandler.doSearch(this.value)" value="<?php echo $l->getString('template_character_statistic_sort'); ?>" type="text" name="search-term" autocomplete="off" />
				</div>
				
	<span class="clear"><!-- --></span>
			</div>

	<ul>
	<li id="cat-summary" class="table" style="display: none">
		<a name="ssummary"></a>
	<h4><?php echo $l->getString('template_character_statistic_update'); ?></h4>
				<?php
				$odd = 2;
				foreach ($achievements as &$ach) : ?>
					<dl<?php if ($odd % 2) echo ' class="odd"'; ?>>
						<dt><?php echo $ach['name'] ?></dt>
						<dd><?php echo $ach['quantity']; ?></dd>
					</dl>
				<?php ++$odd; endforeach; ?>
	</li>
	</ul>

	<span id="search-error" class="table">
		Search Error
	</span>
	
	<div id="statistic-list" class="statistic-list"></div>
		</div>
<script type="text/javascript">
//<![CDATA[
$(function() {
	Profile.url = '<?php echo $character->getUrl(); ?>/statistic';
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
	DynamicMenu.init({ "section": "statistic" });
	StatisticHandler.init();
})
//]]>
</script>
