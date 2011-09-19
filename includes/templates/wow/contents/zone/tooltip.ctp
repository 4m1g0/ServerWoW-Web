<?php if (!isset($zone) || !$zone) return; ?>

<div class="wiki-tooltip">
	<span class="icon-frame frame-36" style="background-image: url(http://eu.battle.net/wow-assets/static/images/zones/thumbnails/<?php echo $zone['zone_key']; ?>.jpg)"></span>

	<h3>
		<span class="float-right color-q0">
				<?php echo $l->getString('template_boss_level'); ?> <?php if ($zone['minLevel'] == $zone['maxLevel']) echo $zone['minLevel']; else echo $zone['minLevel'] . ' - ' . $zone['maxLevel']; ?>

						<?php if ($zone['flags'] & INSTANCE_FLAG_HEROIC) : ?>
						<span class="icon-heroic-skull"></span>
						<?php endif; ?>
	</span>
		<?php echo $zone['name']; ?>
	</h3>


	<?php if ($zone['expansion'] > EXPANSION_CLASSIC) : ?>
	<span class="expansion-name color-ex<?php echo $zone['expansion']; ?>">
		<a href="<?php echo $this->getWowUrl('game/patch-notes'); ?>" class="color-ex<?php echo $zone['expansion']; ?>"><?php echo $l->getString('template_zone_expansion_required') . ' ' . $l->getString('template_expansion_' . $zone['expansion']); ?></a>
	</span>
	<?php endif; ?>

		<div class="color-tooltip-yellow">
			
		</div>

	<ul class="item-specs">
			<li>
				<span class="color-tooltip-yellow"><?php echo $l->getString('template_zone_type'); ?></span>
				<?php
				if ($zone['flags'] & INSTANCE_FLAG_DUNGEON)
					echo $l->getString('template_zone_dungeon');
				elseif ($zone['flags'] & INSTANCE_FLAG_RAID)
					echo $l->getString('template_zone_raid');
				?>

					<?php if ($zone['flags'] & INSTANCE_FLAG_HEROIC) : ?>
					(<?php echo $l->getString('template_item_heroic'); ?>)
					<span class="icon-heroic-skull"></span>
					<?php endif; ?>
		</li>


			<li>
				<span class="color-tooltip-yellow"><?php echo $l->getString('template_zone_location'); ?></span>
					<?php echo $zone['zoneName']; ?>
			</li>

	</ul>
</div>