<div id="dev-fixed">
<div class="dev-right-menu">
    <div class="dev-panel">
		<span>Admin Box</span>
    	<ul>
			<li><a href="<?php echo $this->getCoreUrl('admin/'); ?>" target="_blank">Go to admin panel</a></li>
			<li><a href="http://eu.battle.net<?php echo $_SERVER['REQUEST_URI']; ?>" target="_blank">Open page on Battle.net</a></li>
			<?php
			$controller = $this->core->getUrlAction(1);
			switch ($controller)
			{
				case 'store':
					if ($this->core->getUrlAction(2) > 0)
						echo '<li><a href="' . $this->getCoreUrl('admin/store/item/add') . '" target="_blank">Add Store Item</a></li>';
					break;
			}
			?>
		</ul>
    </div>
</div>
</div>