<?php $menuItems = $guild->getProfileMenuItems(); ?>

	<ul class="profile-sidebar-menu" id="profile-sidebar-menu">
<?php
$name = $guild->getCharBackName();
if ($name) : 
?>
		<li class="">
			<a href="<?php echo $this->getWowUrl('character/' . $guild->getRealmName() . '/' . $name . '/'); ?>" class="back-to" rel="np"><span class="arrow"><span class="icon"><?php echo $name; ?></span></span></a>
		</li>
		<?php endif; ?>
<?php foreach ($menuItems as &$item) :
if (isset($item['login']) || (isset($item['available']) && !$item['available'])) continue;
	?>
		<li class="<?php if ($guild->getGuildPage() == $item['page']) echo ' active'; if (isset($item['locked']) && $item['locked']) echo ' disabled'; ?>">
			<a href="<?php echo ((isset($item['locked']) && $item['locked']) ? 'javascript:;' : (isset($item['external']) ? $item['link'] : $guild->appendUrl('/' . $item['link']))); ?>" class="<?php if (isset($item['extraClass'])) : if (isset($item['locked']) && !$item['locked']) : echo ' vault'; endif; echo ' ' . $item['extraClass']; endif; ?>" rel="np">
				<span class="arrow"><span class="icon"><?php echo isset($item['caption']) ? $item['caption'] : $l->getString($item['index']); ?></span></span>
			</a>
		</li>
<?php endforeach; ?>

	</ul>