<?php 
$audit = $character->getAudit(); 
$locale = $l->getLocale();
$icons_server = $this->c('Config')->getValue('site.icons_server');
?>

		<div class="summary-middle">
				<div class="summary-middle-inner">

					<div class="summary-middle-right">
						<div class="summary-audit" id="summary-audit">
							<div class="category-right"><span class="tip" id="summary-audit-whatisthis"><?php echo $l->getString('template_character_audit_help'); ?></span></div>
								<h3 class="category "><?php echo $l->getString('template_character_audit'); ?></h3>

							<div class="profile-box-simple">
		<?php if ($character->isAuditPassed()) : echo $l->getString('template_character_audit_passed'); else : ?>
		<ul class="summary-audit-list">
		<?php
		if (isset($audit[AUDIT_TYPE_EMPTY_GLYPH_SLOT]) && $audit[AUDIT_TYPE_EMPTY_GLYPH_SLOT] > 0)
			echo $l->format('template_character_audit_empty_glyph_slots', $audit[AUDIT_TYPE_EMPTY_GLYPH_SLOT]);

		if (isset($audit[AUDIT_TYPE_UNSPENT_TALENT_POINTS]) && $audit[AUDIT_TYPE_UNSPENT_TALENT_POINTS] > 0)
			echo $l->format('template_character_audit_unspent_talent_points', $audit[AUDIT_TYPE_UNSPENT_TALENT_POINTS]);

		$data_audit = array(
			array('type' => AUDIT_TYPE_UNENCHANTED_ITEM, 'locale' => 'template_character_audit_unenchanted_items', 'add' => ''),
			array('type' => AUDIT_TYPE_EMPTY_SOCKET, 'locale' => 'template_character_audit_empty_sockets', 'add' => ''),
			array('type' => AUDIT_TYPE_NONOPTIMAL_ARMOR, 'locale' => 'template_character_audit_nonop_armor', 'add' => $this->c('Wow')->getOptimalArmorTypeForClassAndLevel($character->getClass(), $character->getLevel()))
		);
		$strings_audit = array();
		foreach ($data_audit as $audit_type)
		{
			if (isset($audit[$audit_type['type']]) && $audit[$audit_type['type']])
			{
				$strings_audit[$audit_type['type']] = '';
				echo '<li data-slots="';
				$count = sizeof($audit[$audit_type['type']]);
				for ($i = 0; $i < $count; ++$i)
				{
					if ($i > 0 && $i < $count)
					{
						$strings_audit[$audit_type['type']] .= ',';
						echo ',';
					}
					echo $audit[$audit_type['type']][$i][0];
					$strings_audit[$audit_type['type']] .= $audit[$audit_type['type']][$i][0] . ': 1';
				}
				echo '"><span class="tip">' . $l->format($audit_type['locale'], $count, $audit_type['add']) . '</span></li>';
			}
		}
		if (isset($audit[AUDIT_TYPE_MISSING_BELT_BUCKLE]) && $audit[AUDIT_TYPE_MISSING_BELT_BUCKLE])
			echo '<li data-slots="5">' . $l->format('template_character_audit_missing_belt_buckle', $this->getWowUrl('item/' . BELT_BUCKLE_ID) , $audit[AUDIT_TYPE_MISSING_BELT_BUCKLE]) . '</li>';
		?>
		</ul>
		<?php endif; ?>
							</div>
						</div>
						<script type="text/javascript">
						//<![CDATA[
						$(document).ready(function() {
							new Summary.Audit({
								<?php if (isset($strings_audit[AUDIT_TYPE_UNENCHANTED_ITEM]) && $strings_audit[AUDIT_TYPE_UNENCHANTED_ITEM]) : ?>
				"unenchantedItems": {
										<?php echo $strings_audit[AUDIT_TYPE_UNENCHANTED_ITEM]; ?>

				},
								<?php endif; if (isset($strings_audit[AUDIT_TYPE_EMPTY_SOCKET]) && $strings_audit[AUDIT_TYPE_EMPTY_SOCKET]) : ?>
				"itemsWithEmptySockets": {
										<?php echo $strings_audit[AUDIT_TYPE_EMPTY_SOCKET]; ?>

				},
								<?php endif; if (isset($audit[AUDIT_TYPE_MISSING_BELT_BUCKLE]) && $audit[AUDIT_TYPE_MISSING_BELT_BUCKLE]) : ?>

				"missingExtraSockets": {
										5: 1
								},
								recommendedBeltBuckleName: "<?php echo $audit[AUDIT_TYPE_MISSING_BELT_BUCKLE]; ?>",
								recommendedBeltBuckleQualityId: 3,
								<?php endif; ?>
								"foo": true
							});
						});
						//]]>
						</script>
						<div id="summary-reforging" class="summary-reforging">
								<h3 class="category "><?php echo $l->getString('template_character_reforge'); ?></h3>

							<div class="profile-box-simple">

		<?php echo $l->getString('template_character_reforge_none'); ?>
							</div>
						</div>
					</div>
				
					<div class="summary-middle-left">
						<div class="summary-bonus-tally">
								<h3 class="category "><?php echo $l->getString('template_gems_enchants_bonuses'); ?></h3>

							<div class="profile-box-simple">

			<?php if (isset($audit[AUDIT_TYPE_STAT_BONUS]) && $audit[AUDIT_TYPE_STAT_BONUS]) : ?>

		<div class="numerical">
			<ul>
				<?php foreach ($audit[AUDIT_TYPE_STAT_BONUS] as $stat => $value) : ?>
					<li>
						<span class="value">+<?php echo $value; ?></span> <?php echo $l->getString('template_stat_name_' . $stat); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
		$weapon_ench = $character->getItemSlotInfo(EQUIPMENT_SLOT_MAINHAND, 'enchant');
		$head_gems = $character->getItemSlotInfo(EQUIPMENT_SLOT_HEAD, 'gems');
		if ($weapon_ench || $head_gems) :
		?>
		<div class="other">
			<?php if ($weapon_ench) : ?>
				<span class="name"><a href="<?php echo $this->getWowUrl('item/' . $weapon_ench['item']['entry']); ?>"><?php echo $weapon_ench['item']['name']; ?></a></span>
				<?php if ($head_gems) : ?><span class="comma">,</span><?php endif; ?>
			<?php endif;
			$head = false;
			if ($head_gems) :
			foreach ($head_gems as &$gem) if ($gem['gemcolor'] == 1) $head = $gem;
			if ($head) :
			?>
				<span class="name"><a href="<?php echo $this->getWowUrl('item/' . $head['gem']); ?>"><?php echo $head['item']['name']; ?></a></span>
			<?php unset($head); endif; unset($head_gems); endif; unset($weapon_ench); endif; ?>
		</div>
			<?php else : echo $l->getString('template_character_audit_no_bonuses'); endif; ?>
		
							</div>
						</div>

						<div class="summary-gems">
								<h3 class="category "><?php echo $l->getString('template_used_gems'); ?></h3>

							<div class="profile-box-simple">
							<?php if (isset($audit[AUDIT_TYPE_USED_GEMS]) && is_array($audit[AUDIT_TYPE_USED_GEMS])) : ?>


	<div class="summary-gems">
		<ul>
			<?php
			foreach ($audit[AUDIT_TYPE_USED_GEMS] as $gem) :
				if ($gem['counter'] <= 0 || !isset($gem['item']) || !is_array($gem['item'])) continue;
			?>
				<li>
					<span class="value"><?php echo $gem['counter']; ?></span>
					<span class="times">x</span>
					<span class="icon">	<span class="icon-socket socket-<?php echo $gem['gemcolor']; ?>">
			<a href="<?php echo $this->getWowUrl('item/' . $gem['item']['entry']); ?>" class="gem">
				<img src="<?php echo $icons_server; ?>/18/<?php echo $gem['gemicon']; ?>.jpg" alt="" />
				<span class="frame"></span>
			</a>
	</span>
</span>
					<a href="<?php echo $this->getWowUrl('item/' . $gem['item']['entry']); ?>" class="name color-q<?php echo $gem['item']['Quality']; ?>"><?php echo $gem['item']['name']; ?></a>
	<span class="clear"><!-- --></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php else : echo $l->getString('template_character_audit_no_gems'); endif; ?>
							</div>
						</div>

	<span class="clear"><!-- --></span>
					</div>
	<span class="clear"><!-- --></span>
				</div>
			</div>