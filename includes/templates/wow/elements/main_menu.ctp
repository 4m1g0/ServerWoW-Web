<?php
if (!isset($main_menu) || !$main_menu) return; ?>
<ul class="menu" id="menu">
<?php
foreach ($main_menu as $menu)
{
	echo '<li class="menu-' . $menu['icon'] . '">'. NL;
	echo '<a href="' . $this->localeWowUrl($menu['href']) . '"';
	if ($menu['active'])
		echo ' class="menu-active"';
	echo '>' . NL . '<span>' . $menu['title'] . '</span>' . NL . '</a>' . NL . '</li>' . NL;
}
?>
</ul>