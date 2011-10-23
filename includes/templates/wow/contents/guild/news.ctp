
	<div id="profile-wrapper" class="profile-wrapper profile-wrapper-<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>">

		<div class="profile-sidebar-anchor">
			<div class="profile-sidebar-outer">
				<div class="profile-sidebar-inner">
					<div class="profile-sidebar-contents">

		<div class="profile-sidebar-tabard">

			<div class="guild-tabard">

		<canvas id="guild-tabard" width="240" height="240">
			<div class="guild-tabard-default tabard-<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>" ></div>
		</canvas>
        <script type="text/javascript">
        //<![CDATA[
			$(document).ready(function() {
				var tabard = new GuildTabard('guild-tabard', {
					'ring': '<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>',
					'bg': [ 0, 5 ],
					'border': [ 2, 16 ],
					'emblem': [ 13, 16 ]
				});
			});
        //]]>
        </script>
				<div class="tabard-overlay"></div>
				<div class="crest"></div>
				<a class="tabard-link" href="<?php echo $guild->getUrl(); ?>"></a>
			</div>

			<div class="profile-sidebar-info">
				<div class="name"><a href="<?php echo $guild->getUrl(); ?>"><?php echo $guild->getName(); ?></a></div>
				<div class="under-name">
					<?php echo $l->extraFormat('template_guild_crest_fmt', array(
						'level' => $guild->getLevel(),
						'faction' => $l->getString(($guild->getFaction() == FACTION_ALLIANCE ? 'faction_alliance' : 'faction_horde'))
					)); ?>
				</div>

				<div class="realm">
					<span id="profile-info-realm" class="tip" data-battlegroup="<?php echo $this->c('Config')->getValue('site.battlegroup'); ?>"><?php echo $guild->getRealmName(); ?></span>
				</div>
			</div>
		</div>
	<?php echo $this->region('profileMenu'); ?>

					</div>
				</div>
			</div>
		</div>
		
		<div class="profile-contents">

	<div class="profile-section-header">
			<h3 class="category "><?php echo $l->getString('template_guild_menu_news'); ?></h3>
	</div>
	
	<div class="profile-section">
		<div class="news-left">

		<?php
	$feed = $guild->getActivity();
	if ($feed) :
		$first = true;
		$icons_server = $this->c('Config')->getValue('site.icons_server');
		?>
			<div id="news-list">
				<ul class="activity-feed activity-feed-wide">



	<?php
		foreach ($feed as $f) :
			if (!$f['display'])
				continue;
			$char_url = $this->getWowUrl('character/' . $guild->getRealmName() . '/' . $f['char']['name'] . '/');
	?>
	<li data-id="<?php echo $f['guid']; ?>" class="<?php if ($f['type'] == TYPE_ITEM_FEED) echo 'item-looted'; elseif ($f['type'] == TYPE_ACHIEVEMENT_FEED) echo 'player-ach'; if ($first) echo ' first'; ?>">
		<dl>
			<dd>
			<?php if ($f['type'] == TYPE_ITEM_FEED) : ?>
			
	<a href="<?php echo $this->getWowUrl('item/' . $f['itemData']['entry']); ?>" class="color-q<?php echo $f['itemData']['Quality']; ?>">



		<span  class="icon-frame frame-18 " style='background-image: url("<?php echo $icons_server; ?>/18/<?php echo $f['itemData']['icon']; ?>.jpg");'>
		</span>
</a>

<?php printf($l->getString('template_guild_feed_obtained_item', $f['char']['gender']),
	$char_url, '<a href="' . $this->getWowUrl('item/' . $f['itemData']['entry']) . '" class="color-q' . $f['itemData']['Quality'] . '">' . $f['itemData']['name'] . '</a>'
); ?>

<?php elseif ($f['type'] == TYPE_ACHIEVEMENT_FEED) : ?>
<a href="<?php echo $char_url . '/achievement#' . $f['achData']['categoryId'] . ':a' . $f['data']; ?>" rel="np" data-achievement="<?php echo $f['data']; ?>">

		<span  class="icon-frame frame-18 " style='background-image: url("<?php echo $icons_server; ?>/18/<?php echo $f['achData']['iconName']; ?>.jpg");'>
		</span>
</a>

	<?php
	if ($f['achData']['categoryId'] != ACHIEVEMENTS_CATEGORY_FEATS)
		printf($l->getString('template_guild_feed_achievement', $f['char']['gender']),
			'<a href="' . $char_url . '">' . $f['char']['name'] . '</a>',
			'<a href="' . $char_url . '/achievement#' . $f['achData']['categoryId'] . ':a' . $f['data'] . '" rel="np" data-achievement="' . $f['data'] . '">' . $f['achData']['name'] . '</a>',
			$f['achData']['points']
		);
	else
		printf($l->getString('template_guild_feed_fos', $f['char']['gender']),
			'<a href="' . $char_url . '">' . $f['char']['name'] . '</a>',
			'<a href="' . $char_url . '/achievement#' . ACHIEVEMENTS_CATEGORY_FEATS . ':a' . $f['data'] . '" rel="np" data-achievement="' . $f['data'] . '">' . $f['achData']['name'] . '</a>'
		);
		?>
	<?php endif; ?>
</dd>
			<dt><?php echo date('d/m/Y H:i', $f['date']); ?></dt>
		</dl>
	</li>
	<?php $first = false; endforeach; ?>
	
				</ul>
			</div>
		</div><?php else : echo $l->getString('template_guild_feed_no_news'); endif; ?>

	</div>
	
		</div>

	<span class="clear"><!-- --></span>
	</div>

        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			Profile.url = '<?php echo $guild->getUrl(); ?>/news';
		});

			<?php echo $l->getString('template_guild_js_strings'); ?>
        //]]>
        </script>