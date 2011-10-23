<?php if (!isset($guild) || !$guild) return; ?>	
	<div id="profile-wrapper" class="profile-wrapper profile-wrapper-<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>">

		<div class="profile-sidebar-anchor">
			<div class="profile-sidebar-outer">
				<div class="profile-sidebar-inner">
					<div class="profile-sidebar-contents">

		<div class="profile-info-anchor profile-guild-info-anchor">
			<div class="guild-tabard">

		<canvas id="guild-tabard" width="240" height="240">
			<div class="guild-tabard-default " ></div>
		</canvas>
        <script type="text/javascript">
        //<![CDATA[
			$(document).ready(function() {
				var tabard = new GuildTabard('guild-tabard', {
					'ring': '<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>',
					'bg': [ 0, 45 ],
					'border': [ 0, 14 ],
					'emblem': [ 6, 14 ]
				});
			});
        //]]>
        </script>
			</div>

			<div class="profile-info profile-guild-info">
				<div class="name"><a href="<?php echo $guild->getUrl(); ?>"><?php echo $guild->getName(); ?></a></div>
				<div class="under-name">
					<?php echo $l->extraFormat('template_guild_info_fmt', array(
						'level' => $guild->getLevel(),
						'faction' => $l->getString(($guild->getFaction() == FACTION_ALLIANCE ? 'faction_alliance' : 'faction_horde')),
						'realm' => $guild->getRealmName(),
						'bg' => $this->c('Config')->getValue('site.battlegroup')
					)); ?>
					<span class="members"><?php echo $l->format('template_guild_members_count', $guild->getMembersCount()); ?></span>
				</div>

				<div class="achievements"><a href="<?php echo $guild->getUrl(); ?>">0</a></div>
			</div>
		</div>

	<?php echo $this->region('profileMenu'); ?>

					</div>
				</div>
			</div>
		</div>
		
		<div class="profile-contents">

		<div class="summary">

			<div class="profile-section">

				<div class="summary-right">


	<div class="summary-simple-list summary-perks">
	<h3 class="category "><?php echo $l->getString('template_guild_menu_perks'); ?>
</h3>
	
		<div class="profile-box-simple">

		<ul>


						<li class="locked">

							<a href="<?php echo $guild->appendUrl('/perk#p1'); ?>">

								<span class="icon-wrapper">




		<span  class="icon-frame frame-36 " style='background-image: url("<?php echo $this->c('Config')->getValue('site.icons_server'); ?>/36/achievement_guildperk_fasttrack.jpg");'>
		</span>
									<span class="symbol"></span>
								</span>
								<div class="text">
									<strong>Вперед и вверх! (Уровень 1)</strong>
									<span class="desc" title="Количество опыта, получаемого за убийства монстров и выполнение заданий, увеличено на 5%.">Количество опыта, получаемого за убийства монстров и выполнение заданий, ув…</span>
								</div>

								<span class="type">Уровень 2</span>
	<span class="clear"><!-- --></span>

							</a>
						</li>
			</ul>
			<div class="profile-linktomore">
					<a href="<?php echo $guild->appendUrl('/perk'); ?>" rel="np"><?php echo $l->getString('template_guild_perks_all_perks'); ?></a>
				</div>

				<span class="clear"><!-- --></span>
		</div>
	</div>


	<div class="summary-weekly-contributors">
	<h3 class="category "><?php echo $l->getString('template_guild_top_contributors'); ?>
</h3>

		<div class="profile-box-simple">

		<?php echo $l->getString('template_guild_no_contributors'); ?>
				
		</div>
	</div>
				</div>

				<div class="summary-left">

	<div class="summary-activity">
	<h3 class="category "><?php echo $l->getString('template_guild_news_sidebar'); ?>
</h3>
	
		<div class="profile-box-simple">
		<?php
		$activity = $guild->getActivity();
		if ($activity) : ?>
			<ul class="activity-feed">
				<?php
	$feed = $guild->getActivity();
	if ($feed) :
		$first = true;
		$icons_server = $this->c('Config')->getValue('site.icons_server');
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
	<?php $first = false; endforeach; endif; ?>
	
			</ul>
			<div class="profile-linktomore">
				<a href="<?php echo $guild->appendUrl('/news'); ?>" rel="np"><?php echo $l->getString('template_guild_feed_all_feeds'); ?></a>
			</div>
			<span class="clear"><!-- --></span>
	<?php else : echo $l->getString('template_guild_feed_no_news'); endif; ?>
		</div>
	</div>
				</div>

	<span class="clear"><!-- --></span>
			</div>
		</div>

		</div>

	<span class="clear"><!-- --></span>
	</div>

        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			Profile.url = '<?php echo $guild->getUrl(); ?>/summary';
		});

			<?php echo $l->getString('template_guild_js_strings'); ?>
        //]]>
        </script>