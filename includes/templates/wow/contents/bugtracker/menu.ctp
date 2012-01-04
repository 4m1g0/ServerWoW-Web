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
			<center><br>
			<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Bugtracker 200&#42;200) */
google_ad_slot = "1165232208";
google_ad_width = 200;
google_ad_height = 200;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
			</center>
			</li>

		</ul>