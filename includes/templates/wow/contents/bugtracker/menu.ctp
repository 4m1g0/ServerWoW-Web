		<ul class="dynamic-menu" id="menu-pvp" style="display:true">
			<li class="root-item <?php if (!$bt->getCurrent() && !$bt->item('type')) echo 'item-active'; ?>">
				<a href="<?php echo $this->getWowUrl('bugtracker/'); ?>">
					<span class="arrow">Home</span>
				</a>
			</li>
			<?php
			$types = array(
				array('web', 'Web Site'),
				array('items', 'WoW Items'),
				array('quests', 'WoW Quests'),
				array('spells', 'WoW Spells'),
				array('objects', 'WoW Objects'),
				array('npcs', 'WoW NPCs'),
				array('zones', 'WoW Zones'),
				array('others', 'Other Bugs'),
			);
			foreach ($types as $type) :
			?>
			<li class="<?php if ($bt->getCurrent() == $type[0] || $bt->item('type_str') == $type[0]) echo 'item-active'; ?>">
				<a href="<?php echo $this->getWowUrl('bugtracker/' . $type[0]); ?>">
					<span class="arrow"><?php echo $type[1]; ?></span>
				</a>
			</li>
			<?php endforeach; ?>

		</ul>