<?php if (!isset($gameData) || !$gameData) return; ?>
			<div id="content-subheader">
				<a class="race-parent" href="./"><?php echo $l->getString('template_game_races_title'); ?></a>
	<span class="clear"><!-- --></span>
				<h4><?php echo $gameData['name']; ?></h4>
			</div>	<span class="clear"><!-- --></span>

			<div class="faction-req">
				<span class="group <?php echo $gameData['faction']; ?>"><?php echo $gameData['faction_title']; ?></span>
				<?php if ($gameData['expansion'] > EXPANSION_CLASSIC) :?>
					<span class="req <?php echo $gameData['req_exp']; ?>"><?php echo $gameData['req_exp_str']; ?></span>
				<?php endif; ?>
			</div>
	<span class="clear"><!-- --></span>

	<div class="left-col">
		<div class="story-highlight"><?php echo $gameData['story']; ?></div>
		<div class="story-main"><?php echo $gameData['info']; ?></div>

		<?php if ($gameData['location']) : ?>
		<div class="race-basic start-location" style="background-image:url(<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/start-location.jpg)">
			<h5 class="basic-header"><span class="overview-icon"></span><?php echo $l->getString('template_game_race_location'); ?><span><?php echo $gameData['location']; ?></span></h5>
			<div class="basic-story"><?php echo $gameData['location_info']; ?></div>
		<?php
		endif;
		if ($gameData['homecity']) :
		?>

		<div class="race-basic home-city" style="background-image:url(<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/home.jpg)">
			<h5 class="basic-header"><span class="overview-icon"></span><?php echo $l->getString(($gameData['id'] == RACE_WORGEN ? 'template_game_race_homecity_location' : 'template_game_race_homecity')); ?><span><?php echo $gameData['homecity']; ?></span></h5>
			<div class="basic-story"><?php echo $gameData['homecity_info']; ?></div>

		<?php endif; ?>

		<div class="race-basic racial-mount" style="background-image:url(<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/mount.jpg)">
			<h5 class="basic-header"><span class="overview-icon"></span><?php echo $l->getString('template_game_race_mount'); ?><span><?php echo $gameData['mount']; ?></span></h5>
			<div class="basic-story"><?php echo $gameData['mount_info']; ?></div>

		<div class="race-basic leader" style="background-image:url(<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/leader.jpg)">
			<h5 class="basic-header"><span class="overview-icon"></span><?php echo $l->getString('template_game_race_leader'); ?><span><?php echo $gameData['leader']; ?></span></h5>
			<div class="basic-story"><?php echo $gameData['leader_info']; ?></div>
		</div>
	<span class="clear"><!-- --></span>
		</div>
	<?php if ($gameData['homecity']) : ?>
		</div>
	<span class="clear"><!-- --></span>
	<?php endif; if ($gameData['location']) : ?>
		</div>
	<span class="clear"><!-- --></span>
	<?php endif; ?>
	</div>

	<div class="right-col">
	<div class="game-scrollbox">
		<div class="scroll-title"><span><?php echo $l->format('template_game_race_racial_traits', $gameData['name']); ?></span></div>
		<div class="scroll-content">
			<div class="wrapper">
					<div class="feature-list">
						<?php
						$icons_server = $this->c('Config')->getValue('site.icons_server');
						foreach ($gameData['abilities'] as &$ability) : ?>
							<div class="feature-item clear-after">
								<span class="icon-frame-gloss float-left" style="background-image: url(<?php echo $icons_server; ?>/56/<?php echo $ability['icon']; ?>)">
									<span class="frame"></span>
								</span>
								<div class="feature-wrapper">
									<span class="feature-item-title"><?php echo $ability['title']; ?></span>
									<p class="feature-item-desc"><?php echo $ability['text']; ?></p>
								</div>
	<span class="clear"><!-- --></span>
							</div>
						<?php endforeach; ?>
					</div>
			</div>
		</div>
	</div>

	<div class="available-info-box ">
		<div class="available-info-box-title"><?php echo $l->getString('template_game_race_classes'); ?></div>
		<span class="available-info-box-desc"><?php echo $l->format('template_game_race_classes_desc', $l->getString('character_race_' . $gameData['id'] . '_decl')) ?></span>
		<div class="list-box">
			<div class="wrapper">
					<ul>
						<?php foreach ($gameData['classes'] as &$class) : ?>
							<li>
								<a href="../class/<?php echo $class['key']; ?>">
									<span class="icon-frame frame-36 class-icon-36 class-icon-36-<?php echo $class['key']; ?>">
										<span class="frame"></span>
									</span>
									<span class="list-title"><?php echo $class['name']; ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
	<span class="clear"><!-- --></span>
	<span class="clear"><!-- --></span>
			</div>
		</div>
	</div>


	<table class="media-frame">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
					<a href="<?php echo $this->getWowUrl('media/artwork/wow-races?view=&amp;keywords=' . $gameData['key']); ?>"><img src="<?php CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/thumb-artwork.jpg" alt="<?php echo $l->getString('template_game_class_artwork'); ?>" title="<?php echo $l->getString('template_game_class_artwork'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="<?php echo $this->getWowUrl('media/artwork/wow-races?view=&amp;keywords=' . $gameData['key']); ?>" class="view-all"><?php echo $l->getString('template_game_class_viewall'); ?></a>
						<?php echo $l->getString('template_game_class_artwork'); ?>
	<span class="clear"><!-- --></span>
					</div>
			</td>
			<td class="mr"></td>
		</tr>
		<tr>
			<td class="bl"></td>
			<td class="bm"></td>
			<td class="br"></td>
		</tr>
	</table>

	<table class="media-frame">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
					<a href="<?php echo $this->getWowUrl('media/screenshots/races?view=&amp;keywords=' . $gameData['key']); ?>"><img src="<?php CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/thumb-screenshot.jpg" alt="<?php echo $l->getString('template_game_class_screenshots'); ?>" title="<?php echo $l->getString('template_game_class_screenshots'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="<?php echo $this->getWowUrl('media/screenshots/races?view=&amp;keywords=' . $gameData['key']); ?>" class="view-all"><?php echo $l->getString('template_game_class_viewall'); ?></a>
						<?php echo $l->getString('template_game_class_screenshots'); ?>
	<span class="clear"><!-- --></span>
					</div>
			</td>
			<td class="mr"></td>
		</tr>
		<tr>
			<td class="bl"></td>
			<td class="bm"></td>
			<td class="br"></td>
		</tr>
	</table>
				
				<div class="fansite-link-box">
					<div class="wrapper">
						<span class="fansite-box-title"><?php echo $l->getString('template_game_class_more'); ?></span>
						<p><?php echo $l->getString('template_game_race_more_desc'); ?></p>
						<div id="sdgksdngklsdngl35"></div>
        <script type="text/javascript">
        //<![CDATA[
							$(document).ready(function() {
								Fansite.generate($('#sdgksdngklsdngl35'), "race|<?php echo $gameData['id'] . '|' . str_replace('-', '_', $gameData['key']); ?>");
							});
        //]]>
        </script>
					</div>
				</div>
			</div>
	<span class="clear"><!-- --></span>

	<div class="guide-page-nav">
		<span class="current-guide-title"><?php echo $gameData['name']; ?></span>

		<a class="ui-button next-race button1-next " href="<?php echo $gameData['next-race-lnk']; ?>">
			<span>
				<span><?php echo $l->format('template_game_race_next', $gameData['next-race']); ?></span>
			</span>
		</a>

		<a class="ui-button previous-race button1-previous " href="<?php echo $gameData['prev-race-lnk']; ?>">
			<span>
				<span><?php echo $l->format('template_game_race_prev', $gameData['prev-race']); ?></span>
			</span>
		</a>
	</div>