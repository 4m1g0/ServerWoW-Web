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

		</ul>