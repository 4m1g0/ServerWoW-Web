		<ul class="dynamic-menu" id="menu-pvp" style="display:true">
			<li class="root-item <?php if (!$bt->getCurrent() && !$bt->item('type')) echo 'item-active'; ?>">
				<a href="<?php echo $this->getWowUrl('bugtracker/'); ?>">
					<span class="arrow">Home</span>
				</a>
			</li>
			<?php
			$types = array(
				'web',
				'store',
				'items',
				'quests',
				'spells',
				'objects',
				'npcs',
				'zones',
				'others',
			);
			foreach ($types as $type) :
			?>
			<li class="<?php if ($bt->getCurrent() == $type || $bt->item('type_str') == $type) echo 'item-active'; ?>">
				<a href="<?php echo $this->getWowUrl('bugtracker/' . $type); ?>">
					<span class="arrow"><?php echo $l->getString('template_bt_section_' . $type . '_menu'); ?></span>
				</a>
			</li>
			<?php endforeach; ?>
			<li<?php if ($this->core->getUrlAction(2) == 'changelog') echo ' class="item-active"'; ?>><a href="<?php echo $this->getWowUrl('bugtracker/changelog'); ?>"><span class="arrow">Changelog</span></a></li>
			<li>
			<center>
			<br>
<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:Juego:BugTracker-Bloque_Lateral_Izquierdo:Abajo', [200, 200], 'div-gpt-ad-1328884517362-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<!-- ServerWoW:Juego:BugTracker-Bloque_Lateral_Izquierdo:Abajo -->
<div id='div-gpt-ad-1328884517362-0' style='width:200px; height:200px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328884517362-0'); });
</script>
</div>
			</center>
			</li>

		</ul>