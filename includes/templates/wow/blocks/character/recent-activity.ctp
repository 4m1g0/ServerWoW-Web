<div class="profile-recentactivity">

<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:Character-Centro_Derecha:Abajo', [336, 280], 'div-gpt-ad-1328908404498-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<h3 class="category ">Publicidad</h3>
<div class="profile-box-simple">
<!-- ServerWoW:Character-Centro_Derecha:Abajo -->
<div id='div-gpt-ad-1328908404498-0' style='width:336px; height:280px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328908404498-0'); });
</script>
</div>
</div>

	<h3 class="category "><?php echo $l->getString('template_profile_recent_activity'); ?></h3>
	<div class="profile-box-simple">
	<?php if ($feeds) : 
	$classes = array(TYPE_ACHIEVEMENT_FEED => 'ach', TYPE_BOSS_FEED => 'bosskill', TYPE_ITEM_FEED => '');
	$icons_server = $this->c('Config')->getValue('site.icons_server');
	$i = 0;
	?>
	<ul class="activity-feed">
		<?php foreach($feeds as &$f) : if (!isset($f['info'])) continue; if ($i >= 5) break; ?>
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
	</ul>
	<?php endif; ?>

	<div class="profile-linktomore">
		<a href="<?php echo $url; ?>/feed" rel="np"><?php echo $l->getString('template_profile_more_activity_feed'); ?></a>
	</div>

	<span class="clear"><!-- --></span>
	</div>
</div>