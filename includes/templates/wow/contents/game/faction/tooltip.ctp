<?php if (!$faction) return; ?>
<div class="wiki-tooltip">
	<?php if ($faction['leader_id'] > 0) : ?>
	<span class="icon-frame frame-56" style="background-image: url(<?php echo $this->getRenderServer(); ?>/wow/renders/npcs/portrait/creature<?php echo $faction['leader_id']; ?>.jpg)"></span>
	<?php endif; ?>
	<h3>
	<?php if ($faction['faction'] >= 0) : ?><span class="float-right color-q0"><?php echo $l->getString('faction_' . ($faction['faction'] == FACTION_ALLIANCE ? 'alliance' : 'horde')); ?><span class="icon-faction-<?php echo $faction['faction']; ?>"></span></span><?php endif; ?>

	<?php echo $faction['name']; ?></h3>

	<?php if ($faction['expansion'] > 0) : ?>
	<span class="expansion-name color-ex<?php echo $faction['expansion']; ?>">
		<span class="color-ex<?php echo $faction['expansion']; ?>">Requiere <?php echo $l->getString('template_expansion_' . $faction['expansion']); ?></span>
	</span>
	<?php endif; ?>

	<div class="color-tooltip-yellow">
		<?php echo $faction['intro']; ?>
	</div>

	<ul class="item-specs">
		<?php if ($faction['location']) : ?>
			<li>
				<span class="color-tooltip-yellow">Lugar:</span>
				<?php echo $faction['location']; ?>
			</li>
		<?php endif; ?>
	</ul>
</div>