<div class="sidebar-module " id="sidebar-sotd">
	<div class="sidebar-title">
		<h3 class="category title-sotd">
			<a href="<?php echo $this->getWowUrl('media/screenshots/'); ?>">
				Capturas de pantalla del día
			</a>
		</h3>
	</div>
	<div class="sidebar-content">
		<div class="sotd" style="background-size: 704px 440px; background-image: url('<?php echo CLIENT_FILES_PATH . '/uploads/screenshots/' . $sidebar['id'] . '.jpg'; ?>');">
			<a href="<?php echo $this->getWowUrl('media/screenshots/?view=4#/' . $sidebar['id']); ?>" class="image"> </a>
			<div class="caption">
				<a href="<?php echo $this->getWowUrl('media/screenshots/'); ?>" class="view">Todas las capturas</a>
				<span class="clear"><!-- --></span>
			</div>
		</div>
	</div>
</div>
