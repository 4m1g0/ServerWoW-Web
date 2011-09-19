<?php if (!isset($gameData) || !$gameData || !isset($gameData['classes'])) return; ?>

<div class="section-title">
		<h2><?php echo $l->getString('template_game_class_index'); ?></h2>
	</div>
	
	<p class="main-header-desc"><?php echo $l->getString('template_game_class_intro'); ?></p>

	<?php
	$toggleStyle = 2;
	foreach ($gameData['classes'] as $classId => $class) :
	?>
		<div class="flag-card <?php echo $class['key']; ?>" style="<?php if ($toggleStyle % 2) echo 'float:right;'; ?>">
			<div class="wrapper">
				<a href="<?php echo $class['key']; ?>">
					<span class="class-name"><?php echo $l->getString('character_class_' . $classId); ?></span>
					<span class="class-type">
							<?php echo $class['roles']; ?>
					</span>
					<?php if ($class['expansion'] > EXPANSION_CLASSIC) : ?>
						<em class="class-req <?php echo $class['req_exp']; ?>"><?php echo $class['req_exp_str']; ?></em>
					<?php endif; ?>
					<span class="class-desc"><?php echo $class['short_info']; ?></span>
				</a>
			</div>
		</div>
	<?php ++$toggleStyle; endforeach; ?>

	<span class="clear"><!-- --></span>