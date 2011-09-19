<ul class="profile-sidebar-menu" id="profile-sidebar-menu">
<li>
    <a href="<?php echo $characterUrl; ?>" class="back-to" rel="np"><span class="arrow"><span class="icon"><?php echo $l->getString('template_menu_character_info'); ?></span></span></a>
</li>
<li class="root-menu">
    <a href="<?php echo $characterUrl; ?>/achievement" class="back-to" rel="np"><span class="arrow"><span class="icon"><?php echo $l->getString('template_profile_achievement'); ?></span></span></a>
</li>
<li class=" active">
    <a href="<?php echo $characterUrl; ?>/achievement#summary" class="" rel="np"><span class="arrow"><span class="icon"><?php echo $l->getString('template_profile_achievement'); ?></span></span></a>
</li>
<?php
if(isset($menuData) && $menuData) :
	foreach($menuData as $category) :
?>
		<li class="">
			<a href="<?php echo $characterUrl; ?>/achievement#<?php echo $category['id']; ?>" class="<?php if (is_array($category['child'])) echo 'has-submenu'; ?>" rel="np"><span class="arrow"><span class="icon"><?php echo $category['name']; ?></span></span></a>
			<?php
			if (is_array($category['child'])) : ?>
			<ul>
			<?php foreach ($category['child'] as &$child) : ?>
				<li class="">
					<a href="<?php echo $characterUrl; ?>/achievement#<?php echo $category['id']; ?>:<?php echo $child['id']; ?>" class="" rel="np"><span class="arrow"><span class="icon"><?php echo $child['name']; ?></span></span></a>
				</li>
			<?php endforeach;?>
			</ul>
			<?php endif; ?>
		</li>
<?php endforeach; endif; ?>
</ul>