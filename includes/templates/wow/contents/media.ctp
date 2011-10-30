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
Capturas de pantalla <span class="total">(4.042)</span>
</a>
<div class="section-content">
<a class="thumb-wrapper left-col" href="screenshots/mop">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/screenshots/mop/wowx4-screenshot-10-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 19/10/2011</span>
</a>
<a class="thumb-wrapper" href="screenshots/mop">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/screenshots/mop/wowx4-screenshot-06-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 19/10/2011</span>
</a>
<a class="thumb-wrapper left-col bottom-row" href="screenshots/mop">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/screenshots/mop/wowx4-screenshot-19-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 19/10/2011</span>
</a>
<a class="thumb-wrapper bottom-row" href="screenshots/screenshot-of-the-day/cataclysm">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/screenshots/screenshot-of-the-day/cataclysm/cataclysm-ss1822-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 19/10/2011</span>
</a>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
<div class="media-index-section float-left">
<a class="gallery-title artwork" href="artwork/">
<span class="view-all"><span class="arrow"></span>Mostrar todo</span>
<span class="gallery-icon"></span>
Bocetos e Ilustraciones <span class="total">(1.178)</span>
</a>
<div class="section-content">
<a class="thumb-wrapper left-col" href="artwork/wow-mop">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/artwork/wow-mop/wowx4-artwork-00-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 21/10/2011</span>
</a>
<a class="thumb-wrapper" href="artwork/wow-wrath">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/artwork/wow-wrath/dalaran-dome-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 27/10/2011</span>
</a>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
</div>
<div class="media-index-section float-right">
<a class="gallery-title wallpapers" href="wallpapers/">
<span class="view-all"><span class="arrow"></span>Mostrar todo</span>
<span class="gallery-icon"></span>
Fondos de pantalla <span class="total">(218)</span>
</a>
<div class="section-content">
<a class="thumb-wrapper left-col" href="wallpapers/fan-art?view#/wallpaper26">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/wallpapers/fan-art/wallpaper26/wallpaper26-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 11/10/2011</span>
</a>
<a class="thumb-wrapper" href="wallpapers/other?view#/facebook-wow2">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/wallpapers/other/facebook-wow2/facebook-wow2-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 19/09/2011</span>
</a>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
</div>
<div class="media-index-section float-left">
<a class="gallery-title comics" href="comics/">
<span class="view-all"><span class="arrow"></span>Mostrar todo</span>
<span class="gallery-icon"></span>
Cómics <span class="total">(367)</span>
</a>
<div class="section-content">
<a class="thumb-wrapper left-col" href="comics/?view#/comic-2011-10-01">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/comics/comic-2011-10-01-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 07/10/2011</span>
</a>
<a class="thumb-wrapper" href="comics/?view#/comic-2011-09-01">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/comics/comic-2011-09-01-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 01/09/2011</span>
</a>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
</div>
<div class="media-index-section float-right">
<a class="gallery-title fanart" href="fanart/">
<span class="view-all"><span class="arrow"></span>Mostrar todo</span>
<span class="gallery-icon"></span>
Fan Art <span class="total">(1.138)</span>
</a>
<div class="section-content">
<a class="thumb-wrapper left-col" href="fanart/">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/fanart/fanart-1139-index-thumb.jpg)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: 26/10/2011</span>
</a>
<a class="thumb-wrapper" href="fanart/">
<span class="thumb-bg" style="background-image:url(http://eu.media.blizzard.com/wow/media/fanart/fanart-1130-index-thumb.jpg)">
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