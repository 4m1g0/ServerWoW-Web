<?php if (!isset($gameData) || !$gameData) return; ?>
<div id="content-subheader">
				<a class="class-parent" href="./"><?php echo $l->getString('template_game_classes_title'); ?></a>
	<span class="clear"><!-- --></span>
				<h4><?php echo $gameData['class']; ?></h4>
			</div>
			<div class="faction-req">
			<?php if (isset($gameData['req_exp'])) : ?>
				<span class="req <?php echo $gameData['req_exp']; ?>"><?php echo $gameData['req_exp_str']; ?></span>
			<?php endif; ?>
			</div>
	<span class="clear"><!-- --></span>

			<div class="left-col">
				<div class="story-highlight"><p><?php echo $gameData['story']; ?></p></div>
				<div class="story-main"><div class="story-illustration"></div><?php echo $gameData['info']; ?></div>

	<div class="basic-info-box-list basic-info">
		<div class="basic-info-box-list-title"><span><?php echo $l->format('template_game_class_information', $gameData['class']); ?></span></div>
		<div class="list-box">
			<div class="wrapper">
					<p><?php echo $gameData['desc']; ?></p>
					<ul>
						<li>
							<span class="basic-info-title"><?php echo $l->getString('template_game_class_type'); ?></span>
								<?php echo $gameData['roles']; ?>
						</li>
						<li>
							<span class="basic-info-title"><?php echo $l->getString('template_game_class_bars'); ?></span>
							<?php echo $l->getString('power_health') . ', ' . $gameData['powers_info']; ?>
						</li>
						<li>
							<span class="basic-info-title"><?php echo $l->getString('template_game_class_armor'); ?></span>
								<?php echo $gameData['armor_info']; ?>
						</li>
						<li>
							<span class="basic-info-title"><?php echo $l->getString('template_game_class_weapons'); ?></span>
									<?php echo $gameData['weapons_info']; ?>
						</li>
					</ul>
	<span class="clear"><!-- --></span>
			</div>
		</div>
	</div>

	<div class="basic-info-box-list talent-info">
		<div class="basic-info-box-list-title"><span><?php echo $l->format('template_game_class_talents', $gameData['class']); ?></span></div>
		<div class="list-box">
			<div class="wrapper">
					<p><?php echo $gameData['talents']; ?></p>

					<div class="talent-info-wrapper">
						<div class="talent-header"><?php echo $l->format('template_game_class_talent_trees', $gameData['class']); ?></div>
	<span class="clear"><!-- --></span>
							<?php
							$icons_server = $this->c('Config')->getValue('site.icons_server');
							foreach ($gameData['talents_info'] as &$talent) :
							?>
							<div class="talent-wrapper">
								<a href="<?php echo $this->getWowUrl('tool/talent-calculator#' . $gameData['key']); ?>">
									<span class="talent-block" style="background-image:url(<?php echo $icons_server . '/56/' . $talent['icon']; ?>.jpg)">
									<span class="circle-frame"></span>
									</span>
								<?php echo $talent['name']; ?>
								</a>
							</div>
							<?php endforeach; ?>
	<span class="clear"><!-- --></span>
					</div>
	<span class="clear"><!-- --></span>
			</div>
		</div>
	</div>
			</div>

			<div class="right-col">
	<div class="game-scrollbox">
		<div class="scroll-title"><span><?php echo $l->format('template_game_class_features', $gameData['class']); ?></span></div>
		<div class="scroll-content">
			<div class="wrapper">
					<div class="feature-list">
						<?php
						foreach ($gameData['abilities_info'] as &$ability) : ?>
							<div class="feature-item clear-after">
								<span class="icon-frame-gloss float-left" style="background-image: url(<?php echo $icons_server; ?>/56/<?php echo $ability['icon']; ?>);">
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
		<div class="available-info-box-title"><?php echo $l->format('template_game_class_races', $gameData['class']); ?></div>
		<span class="available-info-box-desc"></span>
		<div class="list-box">
			<div class="wrapper">
					<ul>
					<?php foreach ($gameData['races_info'] as &$race) : ?>
							<li>
								<a href="../race/<?php echo $race['key']; ?>">
									<span class="icon-frame frame-36" style="background-image: url(<?php echo $race['icon']; ?>);"><span class="frame"></span></span>
									<span class="list-title"><?php echo $race['title']; ?>
										<span class="list-faction <?php echo $race['faction']; ?>"><?php echo $race['faction_title']; ?></span>
									</span>
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
					<a href="<?php echo $this->getWowUrl('media/artwork/wow-classes?keywords=' . $gameData['key']); ?>"><img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/class/thumbnails/<?php echo $gameData['key']; ?>-artwork.jpg"
						alt="<?php echo $l->getString('template_game_class_artwork'); ?>" title="<?php echo $l->getString('template_game_class_artwork'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="<?php echo $this->getWowUrl('media/artwork/wow-classes?keywords=' . $gameData['key']); ?>" class="view-all"><?php echo $l->getString('template_game_class_viewall'); ?></a>
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
					<a href="<?php echo $this->getWowUrl('media/screenshots/classes?keywords=' . $gameData['key']); ?>"><img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/class/thumbnails/<?php echo $gameData['key']; ?>-screenshot.jpg"
						alt="<?php echo $l->getString('template_game_class_screenshots'); ?>" title="<?php echo $l->getString('template_game_class_screenshots'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="<?php echo $this->getWowUrl('media/screenshots/classes?keywords=' . $gameData['key']); ?>" class="view-all"><?php echo $l->getString('template_game_class_viewall'); ?></a>
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
	<span class="clear"><!-- --></span>
				
				<div class="fansite-link-box">
					<div class="wrapper">
						<span class="fansite-box-title"><?php echo $l->getString('template_game_class_more'); ?></span>
						<p><?php echo $l->getString('template_game_class_more_desc'); ?></p>
						<div id="sdgksdngklsdngl35"></div>
        <script type="text/javascript">
        //<![CDATA[
							$(document).ready(function() {
								Fansite.generate($('#sdgksdngklsdngl35'), "class|<?php echo $gameData['id'] . '|' . $gameData['class']; ?>");
							});
        //]]>
        </script>
					</div>
				</div>
			</div>

	<span class="clear"><!-- --></span>

	<div class="guide-page-nav">
		<span class="current-guide-title"><?php echo $gameData['class']; ?></span>

		<a class="ui-button next-class button1-next " href="<?php echo $gameData['next-class-lnk']; ?>">
		<span>
			<span><?php echo $l->format('template_game_class_next', $gameData['next-class']); ?></span>
		</span>
		</a>

		<a class="ui-button previous-class button1-previous " href="<?php echo $gameData['prev-class-lnk']; ?>">
		<span>
			<span><?php echo $l->format('template_game_class_prev', $gameData['prev-class']); ?></span>
		</span>
		</a>
	</div>