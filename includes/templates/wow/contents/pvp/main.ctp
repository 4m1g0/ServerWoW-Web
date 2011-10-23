<?php
$bg = $this->c('Config')->getValue('site.battlegroup');
?>
<div class="content-header">
	<h2 class="header ">PvP</h2>


	<span class="clear"><!-- --></span>
	</div>

	<div class="pvp pvp-summary">
		<div class="pvp-right">
			<div class="top-title">
				<h3 class="category ">Лучшие команды Арены</h3>
				<span class="clear"><!-- --></span>
			</div>
			<div class="top-teams">
			<?php
			$types = array(2, 3, 5);
			$styles = array('first', 'second', 'third');
			$ladder = $pvp->getLadderTops();
			foreach ($types as $type) :
				$format = $type . 'v' . $type;
			?>
				<div class="column top-<?php echo $format; ?>">
					<h2><a href="<?php echo $this->getWowUrl('pvp/arena/' . $bg . '/' . $format); ?>"><?php echo $l->format('template_team_type_format', $type, $type); ?></a></h2>
						<ul>
							<?php
							if (isset($ladder[$type]) && $ladder[$type]) :
								$count = 0;
								foreach ($ladder[$type] as $t) :
							?>
							<li class="<?php echo $styles[$count]; ?>">
								<span class="ranking"><?php echo $t['rank']; ?></span>

								<div class="name">
									<a href="<?php echo $t['url']; ?>"><?php echo $t['name']; ?></a>
								</div>
								
								<div class="rating-realm">
								<span class="rating"><?php echo $t['rating']; ?></span>
								<span class="realm"><?php echo $t['realmName']; ?></span>
								</div>

								<!--
								<div class="members">
									<a href="/wow/ru/character/alakir/%C3%9Feast/">
										<span class="icon-frame frame-14 ">
											<img src="http://eu.media.blizzard.com/wow/icons/18/class_8.jpg" alt="" width="14" height="14" />
										</span>
									</a>
								</div> -->
							</li>
							<?php ++$count; endforeach; endif; ?>
						</ul>

						<a href="<?php echo $this->getWowUrl('pvp/arena/' . $bg . '/' . $format); ?>" class="all"><?php echo $l->format('template_pvp_browse_rating_caption', $type, $type); ?></a>
				</div>
			<?php endforeach; ?>

	<span class="clear"><!-- --></span>
			</div>
		</div>
	
		<div class="pvp-left">
			<ul class="dynamic-menu" id="menu-pvp">
				<li class="root-item item-active">
					<a href="<?php echo $this->getWowUrl('pvp/'); ?>">
						<span class="arrow"><?php echo $l->getString('template_pvp_arena_summary'); ?></span>
					</a>
				</li>
				<?php
				$types = array(2, 3, 5);
				foreach ($types as $t):
				?>
				<li>
					<a href="<?php echo $this->getWowUrl('pvp/arena/' . $bg . '/' . $t . 'v' . $t); ?>">
						<span class="arrow"><?php echo $l->format('template_team_type_format', $t, $t); ?></span>
					</a>
				</li>
				<?php endforeach; ?>

			</ul>
		</div>

<span class="clear"><!-- --></span>
</div>