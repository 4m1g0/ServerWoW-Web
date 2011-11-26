 <div class="media-content">
<div id="media-index">
<div class="media-index-section float-left">
<a class="gallery-title videos" href="<?php echo $this->getWowUrl('media/videos/'); ?>">
<span class="view-all"><span class="arrow"></span>Mostrar todo</span>
<?php
$qv = $media->getQuickView();
$v = $qv['videos'];
?>
<span class="gallery-icon"></span>
Vídeos <span class="total">(<?php echo $v['count']; ?>)</span>
</a>
<div class="section-content">
<?php
if ($v['latest']) :
	$i = 0;
	foreach ($v['latest'] as $vi) : ?>
<a href="<?php echo $this->getWowUrl('videos/?view=' .$vi['key']); ?>" class="thumb-wrapper video-thumb-wrapper<?php if ($i == 0) echo ' first-video'; ?>">
<span class="video-info">
<span class="video-title"><?php echo $vi['title']; ?></span>
<span class="video-desc"></span>
<span class="date-added">Fecha: <?php echo date('d/m/Y', $vi['post_date']); ?></span>
</span>
<span class="thumb-bg" style="background-size: 188px 118px;background-image:url(http://img.youtube.com/vi/<?php echo $vi['youtube']; ?>/hqdefault.jpg)">
<span class="thumb-frame"></span>
</span>
</a>
<?php ++$i; endforeach; endif; ?>

<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
</div>
<div class="media-index-section float-right">
<a class="gallery-title screenshots" href="screenshots/">
<span class="view-all"><span class="arrow"></span>Mostrar todo</span>
<span class="gallery-icon"></span>
Capturas de pantalla <span class="total">(3)</span>
</a>
<div class="section-content">
<a class="thumb-wrapper left-col" href="screenshots/">
<span class="thumb-bg" style="background-size: 188px 118px; background-image:url(/uploads/screenshots/1.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 19/10/2011</span>
</a>
<a class="thumb-wrapper" href="screenshots/">
<span class="thumb-bg" style="background-size: 188px 118px; background-image:url(/uploads/screenshots/2.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 19/10/2011</span>
</a>
<a class="thumb-wrapper left-col bottom-row" href="screenshots/">
<span class="thumb-bg" style="background-size: 188px 118px; background-image:url(/uploads/screenshots/3.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 19/10/2011</span>
</a>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>

</div>
</div>
<div style="display:none" id="media-preload-container"></div>