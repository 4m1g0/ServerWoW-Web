<?php if (!$achievements || !$item) return; ?>
<div xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="group">
	<ul>
	<li id="cat-<?php echo $item['id']; ?>" class="table" style="display: none">
		<a name="s<?php echo $item['id']; ?>"></a>
	<h4><?php echo $item['name']; ?></h4>
	<?php
	$odd = 2;
	foreach ($achievements as &$ach) : ?>
			<dl<?php if ($odd % 2) echo ' class="odd"'; ?>>
				<dt><?php echo $ach['name'] ?></dt>
				<dd><?php echo $ach['quantity']; ?></dd>
			</dl>
	<?php ++$odd; endforeach; ?>
	</li>
	</ul>
</div>