<div class="profile-section-header">
	<div class="activity-subscribe"></div>
	<h3 class="category "><?php echo $l->getString('template_character_feed'); ?></h3>
</div>

<div class="profile-section">
	<ul class="activity-feed activity-feed-wide">
	<?php
	$feeds = $character->getFeeds();
	if ($feeds) : 
		$classes = array(TYPE_ACHIEVEMENT_FEED => 'ach', TYPE_BOSS_FEED => 'bosskill', TYPE_ITEM_FEED => '');
		$icons_server = $this->c('Config')->getValue('site.icons_server');
		$i = 0;
		foreach($feeds as &$f) : if (!isset($f['info'])) continue; if ($i >= 50) break; ?>
		<li class="<?php echo $classes[$feeds[$i]['type']]; ?>">
			<dl>
				<dd>
					<?php
					switch ($f['type']) : case TYPE_ACHIEVEMENT_FEED:
					?>
					<?php $link = '<a href="achievement#' . $f['info']['categoryId'] . ':a' . $f['data'] . '" data-achievement="' . $f['data'] . '">' . $f['info']['name'] . '</a>'; ?>
					<a href="achievement#<?php echo $f['info']['categoryId']; ?>:a<?php echo $f['data']; ?>" data-achievement="<?php echo $f['data']; ?>">
                    <span  class="icon-frame frame-18" style='background-image: url("<?php echo $icons_server; ?>/18/<?php echo $f['info']['iconname']; ?>.jpg");'></span></a>
                    <?php if ($f['info']['categoryId'] == ACHIEVEMENTS_CATEGORY_FEATS) echo $l->format('template_feed_fos', $link); else echo $l->format('template_feed_achievement', $link, $f['info']['points']); ?>

					<?php break; case TYPE_ITEM_FEED: ?>
					<?php $link = '<a href="' . $this->getWowUrl('item/' . $f['data']) . '" class="color-q' . $f['info']['Quality'] . '" data-item="">' . $f['info']['name'] . '</a>'; ?>
					<a href="<?php echo $this->getWowUrl('item/' . $f['data']); ?>" class="color-q<?php echo $f['info']['Quality']; ?>" data-item=""> 
                    <span  class="icon-frame frame-18" style='background-image: url("<?php echo $icons_server; ?>/18/<?php echo $f['info']['icon']; ?>.jpg");'></span></a>
                    <?php echo $l->format('template_feed_obtained_item', $link); ?>

					<?php break; case TYPE_BOSS_FEED: //if (!$f['info']) continue; ?>
					<span class="icon"></span><?php echo $f['info']['name']; ?>: <?php echo $f['counter'] > 0 ? $f['counter'] : 1; ?>
					<?php break; endswitch; ?>
				</dd>
				<dt><?php echo $f['date_str']; ?></dt>
			</dl>
		</li>
		<?php ++$i; endforeach; ?>
	<?php endif; ?>
	</ul>

<div class="activity-note"><?php echo $l->getString('template_character_feed_most_recent_events'); ?></div>
</div>

</div>

<span class="clear"><!-- --></span>
<script type="text/javascript">
//<![CDATA[
$(function() {
	Profile.url = '<?php echo $character->getUrl(); ?>/feed';
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