<?php if (!isset($gameData) || !$gameData || !isset($gameData['races'])) return; ?>
<div class="section-title">
		<h2><?php echo $l->getString('template_game_race_title'); ?></h2>
	</div>
	
	<p class="main-header-desc"><?php echo $l->getString('template_game_race_intro'); ?></p>

	<?php
	foreach ($gameData['races'] as $groupName => $group) :
	?>
	<div class="racegroup <?php echo $groupName; ?>">
	<span class="race-title"><?php echo $l->getString('faction_' . $groupName); ?></span>
	<?php foreach ($group as $raceId => $race) : ?>
	<div class="flag-card <?php echo $race['key']; ?>">
		<div class="wrapper">
			<a href="<?php echo $race['key']; ?>">
				<span class="class-name"><?php echo $race['name']; ?></span>
				<?php if ($race['expansion'] > EXPANSION_CLASSIC) : ?>
					<em class="class-req <?php echo $race['req_exp']; ?>"><?php echo $race['req_exp_str']; ?></em>
				<?php endif; ?>
				<span class="class-desc"><?php echo $race['short_info']; ?></span>
			</a>
		</div>
	</div>
	<?php endforeach; ?>
	</div>
	<?php endforeach; ?>

	<span class="clear"><!-- --></span>
