<div class="summary-battlegrounds">
	<ul>
		<li class="rating"><span class="name"><?php echo $l->getString('template_rated_bg_rating'); ?></span><span class="value">0</span>	<span class="clear"><!-- --></span></li>
		<li class="kills"><span class="name"><?php echo $l->getString('template_honorable_kills'); ?></span><span class="value"><?php echo $character->getField('totalKills'); ?></span>	<span class="clear"><!-- --></span></li>
	</ul>
</div>

<div class="summary-professions">
	<ul>
		<?php
		$professions = $character->getProfessions();
		$icons_server = $this->c('Config')->getValue('site.icons_server');
		for ($i = 0; $i < 2; ++$i) :
		?>
		<li<?php if (!isset($professions[$i]) || !$professions[$i]) echo ' class="empty"'; ?>>
		<?php if (isset($professions[$i]) && $professions[$i]) : ?>
			<div class="profile-progress border-3 completed" >
				<div class="bar border-3 hover" style="width: <?php echo $this->c('Wow')->getPercent($professions[$i]['max'], $professions[$i]['value']); ?>%"></div>
				<div class="bar-contents">
					<a class="profession-details" href="<?php echo $this->getWowUrl('profession/' . $professions[$i]['key']); ?>">
						<span class="icon">
							<span class="icon-frame frame-12 "><img src="<?php echo $icons_server; ?>/18/<?php echo $professions[$i]['icon']; ?>.jpg" alt="" width="12" height="12" /></span>
						</span>
						<span class="name"><?php echo $professions[$i]['name']; ?></span>
						<span class="value"><?php echo $professions[$i]['value']; ?></span>
					</a>
				</div>
			</div>

		<?php else : ?>
			<span class="profession-details">
				<span class="name"><?php echo $l->getString('template_profile_no_professions'); ?></span>
			</span>

		<?php endif; ?>
		</li>
		<?php endfor; ?>

	</ul>
</div>
