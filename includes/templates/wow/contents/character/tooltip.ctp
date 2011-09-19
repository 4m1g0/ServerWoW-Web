<?php if (!isset($character) || !$character) return; ?>
<div class="character-tooltip">
	<span class="icon-frame frame-56">
		<img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/2d/avatar/<?php echo $character->getRace() . '-' . $character->getGender(); ?>.jpg" alt="" width="56" height="56" />
		<span class="frame"></span>
	</span>

	<h3><?php echo $character->getName(); ?></h3>

	<div class="color-c<?php echo $character->getClass(); ?>">
			<?php
			echo $l->extraFormat(
				'template_charinfo_fmt_tooltip',
				array(
					'url1' => $this->getWowUrl('game/race/' . $character->getRaceKey()),
					'url2' => $this->getWowUrl('game/class/' . $character->getClassKey()),
					'level' => $character->getLevel(),
					'racename' => $character->getRaceName(),
					'classname' => $character->getClassName(),
					'specname' => $character->getField('activeSpecName')
				)
			); ?>
	</div>

	<div class="color-tooltip-<?php echo $character->getFactionName(); ?>"><?php echo $character->getRealmName(); ?></div>

		<span class="character-achievementpoints"><?php echo $this->c('Achievement')->getPoints(); ?></span>
	<span class="clear"><!-- --></span>
	<?php 
	if ($character->getField('talentsOk')) :
		$activeSpec = $character->getActiveSpec();
		if ($activeSpec) :
	?>
	<span class="character-talents">
		<span class="icon">
		<span class="icon-frame frame-12 ">
			<img src="<?php echo $this->c('Config')->getValue('site.icons_server'); ?>/18/<?php echo $activeSpec['icon']; ?>.jpg" alt="" width="12" height="12" />
		</span>
		</span>
		<?php echo '<span class="points">' . $activeSpec['treeOne'] . '<ins>/</ins>' . $activeSpec['treeTwo'] . '<ins>/</ins>' . $activeSpec['treeThree'] . '</span>'; ?>

	<span class="clear"><!-- --></span>
	</span>
	<?php unset($activeSpec); endif; endif; unset($character); ?>
</div>