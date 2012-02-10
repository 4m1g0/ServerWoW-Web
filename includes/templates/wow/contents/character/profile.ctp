<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:Character-Centro_Derecha:Arriba', [468, 60], 'div-gpt-ad-1328908353137-0').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:Character-Centro_Izquierda:Abajo', [468, 60], 'div-gpt-ad-1328908353137-1').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<div align="right" style="margin-right:30px">
<!-- ServerWoW:Character-Centro_Derecha:Arriba -->
<div id='div-gpt-ad-1328908353137-0' style='width:468px; height:60px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328908353137-0'); });
</script>
</div>
</div>

<?php $profileType = $character->getProfileType(); ?>
<div class="summary-top">
	<div class="summary-top-right">
		<ul class="profile-view-options" id="profile-view-options-summary">
			<li<?php if ($profileType == 'advanced') echo ' class="current"'; ?>>
				<a href="<?php echo $character->getUrl(); ?>/advanced" rel="np" class="advanced">
					<?php echo $l->getString('template_profile_advanced_profile'); ?>
				</a>
			</li>
			<li<?php if ($profileType == 'simple') echo ' class="current"'; ?>>
				<a href="<?php echo $character->getUrl(); ?>/simple" rel="np" class="simple">
					<?php echo $l->getString('template_profile_simple_profile'); ?>
				</a>
			</li>
		</ul>
		<div class="summary-averageilvl">
			<div class="rest">
				<?php echo $l->getString('template_profile_avg_itemlevel'); ?><br />(<span class="equipped"><?php echo $character->getField('avgILvlEquipped'); ?></span> <?php echo $l->getString('template_profile_avg_equipped_itemlevel'); ?>)
			</div>
			<div id="summary-averageilvl-best" class="best tip" data-id="averageilvl">
				<?php echo $character->getField('avgILvl'); ?>
			</div>
		</div>
	</div>

	<div class="summary-top-inventory">
		<div id="summary-inventory" class="summary-inventory summary-inventory-<?php echo $profileType; ?>">
			<?php
			$item_slots = array(
				EQUIPMENT_SLOT_HEAD      => array('slot' => 1,  'style' => ' left: 0px; top: 0px;'),
				EQUIPMENT_SLOT_NECK      => array('slot' => 2,  'style' => ' left: 0px; top: 58px;'),
				EQUIPMENT_SLOT_SHOULDERS => array('slot' => 3,  'style' => 'left: 0px; top: 116px;'),
				EQUIPMENT_SLOT_BACK      => array('slot' => 16, 'style' => ' left: 0px; top: 174px;'),
				EQUIPMENT_SLOT_CHEST     => array('slot' => 5,  'style' => ' left: 0px; top: 232px;'),
				EQUIPMENT_SLOT_BODY      => array('slot' => 4,  'style' => ' left: 0px; top: 290px;'),
				EQUIPMENT_SLOT_TABARD    => array('slot' => 19, 'style' => ' left: 0px; top: 348px;'),
				EQUIPMENT_SLOT_WRISTS    => array('slot' => 9,  'style' => ' left: 0px; top: 406px;'),
				EQUIPMENT_SLOT_HANDS     => array('slot' => 10, 'style' => ' top: 0px; right: 0px;'),
				EQUIPMENT_SLOT_WAIST     => array('slot' => 6,  'style' => ' top: 58px; right: 0px;'),
				EQUIPMENT_SLOT_LEGS      => array('slot' => 7,  'style' => ' top: 116px; right: 0px;'),
				EQUIPMENT_SLOT_FEET      => array('slot' => 8,  'style' => ' top: 174px; right: 0px;'),
				EQUIPMENT_SLOT_FINGER1   => array('slot' => 11, 'style' => ' top: 232px; right: 0px;'),
				EQUIPMENT_SLOT_FINGER2   => array('slot' => 11, 'style' => ' top: 290px; right: 0px;'),
				EQUIPMENT_SLOT_TRINKET1  => array('slot' => 12, 'style' => ' top: 348px; right: 0px;'),
				EQUIPMENT_SLOT_TRINKET2  => array('slot' => 12, 'style' => ' top: 406px; right: 0px;'),
				EQUIPMENT_SLOT_MAINHAND  => array('slot' => 21, 'style' => $profileType == 'simple' ? ' left: 241px; bottom: 0px;' : 'left: -6px; bottom: 0px;'),
				EQUIPMENT_SLOT_OFFHAND   => array('slot' => 22, 'style' => $profileType == 'simple' ? ' left: 306px; bottom: 0px;' : 'left: 271px; bottom: 0px;'),
				EQUIPMENT_SLOT_RANGED    => array('slot' => 28, 'style' => $profileType == 'simple' ? ' left: 371px; bottom: 0px;' : ' left: 548px; bottom: 0px;')
			);

			if ($profileType == 'simple')
				$slots_right = array(9, 10, 11, 12, 13, 14, 15);
			else
				$slots_right = array(6, 7, 8, 10, 11, 12, 15, 21);

			$items = $character->getInventory();
			if ($items) :
				$icons_server = $this->c('Config')->getValue('site.icons_server');
				$locale = $l->getLocale();
				foreach ($item_slots as $slot => $data) :
			?>
			<div data-id="<?php echo $data['slot']-1; ?>" data-type="<?php echo (($data['slot'] == 28 && in_array($character->GetRole(), array(ROLE_CASTER))) ? 15 : $data['slot']); ?>" class="slot slot-<?php echo (($data['slot'] == 28 && in_array($character->GetRole(), array(ROLE_CASTER))) ? 15 : $data['slot']) . (in_array($data['slot'], $slots_right) ? ' slot-align-right' : '') . (isset($items[$slot]) ? ' item-quality-' . $items[$slot]['Quality'] : ''); ?>" style="<?php echo $data['style']; ?>">
				<div class="slot-inner">
					<div class="slot-contents">
<?php if (isset($items[$slot])) : ?>
						<a href="<?php echo $this->getWowUrl('item/' . $items[$slot]['entry']); ?>" class="item" data-item="<?php if (isset($items[$slot]['data_item'])) echo $items[$slot]['data_item']; ?>"><img src="<?php echo $icons_server; ?>/56/<?php echo $items[$slot]['icon']; ?>.jpg" alt="" />
<?php else: ?>
						<a href="javascript:;" class="empty">
<?php endif; ?>
							<span class="frame"></span>
						</a>
<?php if ($profileType == 'advanced' && isset($items[$slot])) : ?>
						<div class="details">
							<span class="name-shadow"><?php echo $items[$slot]['name']; ?></span>
							<span class="name color-q<?php echo $items[$slot]['Quality']; ?>">
								<?php if (($items[$slot]['can_ench'] && (!isset($items[$slot]['enchant']) || !$items[$slot]['enchant'])) || ($items[$slot]['socketsCount'] > 0 && (!isset($items[$slot]['gems']) || sizeof($items[$slot]['gems']) < $items[$slot]['socketsCount']))) echo '<a href="javascript:;" class="audit-warning"></a>'; ?>

								<a href="<?php echo $this->getWowUrl('item/' . $items[$slot]['entry']); ?>" data-item="<?php echo $items[$slot]['data_item']; ?>"><?php echo $items[$slot]['name']; ?></a>
							</span>
<?php if (isset($items[$slot]['enchant']) && is_array($items[$slot]['enchant'])) : ?>
							<span class="enchant-shadow">
								<?php echo isset($items[$slot]['enchant']['item']) ? $items[$slot]['enchant']['item']['name'] : $items[$slot]['enchant']['text']; ?>
							</span>
							<div class="enchant color-q2">
<?php if (isset($items[$slot]['enchant']['item'])) : ?>
								<a href="<?php echo $this->getWowUrl('item/' . $items[$slot]['enchant']['item']['entry']); ?>">
<?php endif; ?>
<?php echo isset($items[$slot]['enchant']['item']) ? $items[$slot]['enchant']['item']['name'] : $items[$slot]['enchant']['text']; ?>
<?php if (isset($items[$slot]['enchant']['item'])) : ?></a><?php endif; ?>
							</div>
<?php endif; ?>
							<span class="level"><?php echo $items[$slot]['ItemLevel']; ?></span>
							<span class="sockets">
								<?php for ($i = 1; $i < MAX_ITEM_PROTO_SOCKETS+1; ++$i) :
									if ($items[$slot]['socketColor_' . $i] == 0) continue;
								?>
								<span class="icon-socket socket-<?php echo $items[$slot]['socketColor_' . $i]; ?>">
								<?php if (isset($items[$slot]['gems'][$i-1]) && $items[$slot]['gems'][$i-1]) : ?>
										<a href="<?php echo $this->getWowUrl('item/' . $items[$slot]['gems'][$i-1]['gem']); ?>" class="gem">
											<img src="<?php echo $icons_server; ?>/18/<?php echo $items[$slot]['gems'][$i-1]['gemicon']; ?>.jpg" alt="" />
											<span class="frame"></span>
										</a>
								<?php else : ?>
								<span class="empty"></span>
								<span class="frame"></span>
								<?php endif; ?>
								</span>
								<?php endfor; ?>
							</span>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

<?php endforeach; endif; ?>
		</div>

		<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function() {
			new Summary.Inventory({ view: "simple" }, {
<?php
if (isset($items) && $items) :
foreach ($items as &$item) :
?>
				
				<?php echo $item['slot']; ?>: {
					name: "<?php echo addslashes($item['name']); ?>",
					quality: <?php echo $item['Quality']; ?>,
					icon: "<?php echo $item['icon']; ?>"
				}
				,
<?php
endforeach;
endif; ?>
				});
			});
			//]]>
		</script>
	</div>
</div>

<?php if ($this->issetRegion('audit')) echo $this->region('audit'); ?>

	<div class="summary-bottom">

<?php if ($this->issetRegion('recentActivity')) echo $this->region('recentActivity'); ?>
		<div class="summary-bottom-left">
		<center>
		<!-- ServerWoW:Character-Centro_Izquierda:Abajo -->
<div id='div-gpt-ad-1328908353137-1' style='width:468px; height:60px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328908353137-1'); });
</script>
</div>
</center>
<br>
			<div class="summary-talents" id="summary-talents">
				<ul>
<?php
$icons_server = $this->c('Config')->getValue('site.icons_server');
if ($character->getField('talentsOk')) :
foreach ($character->getField('talentPoints') as $p) :
?>
					<li class="summary-talents-1">
						<a href="<?php echo $character->getUrl(); ?>/talent/<?php echo $p['type']; ?>"<?php if ($p['active']) echo ' class="active"'; ?>>
							<span class="inner">
								<span class="checkmark"></span>
								<span class="icon">
									<img src="<?php echo $icons_server; ?>/36/<?php echo $p['icon']; ?>.jpg" alt="" /><span class="frame"></span>
								</span>
								<span class="roles">
										<?php if (is_array($p['roles'])) : foreach ($p['roles'] as $role) : ?>
										<span class="icon-<?php echo $role; ?>"></span>
										<?php endforeach; endif; ?>
								</span>
								<span class="name-build">
									<span class="name"><?php echo $p['name']; ?></span>
									<span class="build"><?php echo $p['treeOne']; ?><ins>/</ins><?php echo $p['treeTwo']; ?><ins>/</ins><?php echo $p['treeThree']; ?></span>
								</span>
							</span>
						</a>
					</li>

<?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="summary-health-resource">
				<ul>
					<li class="health" id="summary-health" data-id="health"><span class="name"><?php echo $l->getString('stat_health'); ?></span><span class="value"><?php echo $character->getField('health'); ?></span></li>
					<li class="resource-<?php echo $character->getPowerType(); ?>" id="summary-power" data-id="power-<?php echo $character->getPowerType(); ?>"><span class="name"><?php echo $l->getString('stat_power' . $character->getPowerType()); ?></span><span class="value"><?php echo $character->getField('powerValue'); ?></span></li>
				</ul>
			</div>

			<div class="summary-stats-profs-bgs">
				<?php if ($this->issetRegion('profileStats')) echo $this->region('profileStats'); ?>
				<div class="summary-stats-bottom">
					<?php if ($this->issetRegion('statsBottom')) echo $this->region('statsBottom'); ?>
					<span class="clear"><!-- --></span>
				</div>
			</div>
		</div>
		<span class="clear"><!-- --></span>
		<?php if ($this->issetRegion('raidProgress')) echo $this->region('raidProgress'); ?>
		<div class="summary-lastupdate">
			<?php echo $l->getString('template_profile_lastupdate') . ' ' . date('d/m/Y', $character->getField('lastUpdate')); ?>
		</div>
	</div>
	<span class="clear"><!-- --></span>