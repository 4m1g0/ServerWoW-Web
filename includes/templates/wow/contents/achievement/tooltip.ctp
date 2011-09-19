<?php if (!isset($item) || !$item) return; ?>
<div class="wiki-tooltip">
	<span  class="icon-frame frame-56 " style='background-image: url("<?php echo $this->c('Config')->getValue('site.icons_server'); ?>/56/<?php echo $item['iconname']; ?>.jpg");'> </span>
	<h3>
	<?php if ($item['points'] > 0) echo '<span class="float-right color-q0">' . $item['points'] . ' ' . $l->getString('template_feed_ach_points') . '</span>'; ?>
	<?php echo $item['name']; ?></h3>
	<span class="color-tooltip-yellow"><?php echo $item['description']; ?></span>
</div>