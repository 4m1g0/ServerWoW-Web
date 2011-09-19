<?php if (!isset($spell) || !$spell) return; ?>
<div class="wiki-tooltip">
		<span  class="icon-frame frame-56 " style='background-image: url("<?php echo $this->c('Config')->getValue('site.icons_server'); ?>/56/<?php echo $spell['icon']; ?>.jpg");'>
		</span>
	<h3><?php echo $spell['SpellName']; ?></h3>
	<div class="color-tooltip-yellow"><?php echo $spell['Description']; ?></div>
</div>