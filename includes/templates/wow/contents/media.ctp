<div class="media-content">
<center>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Media 728&#42;90) */
google_ad_slot = "3247785244";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>

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
<a href="<?php echo $this->getWowUrl('media/videos/?view=' .$vi['key']); ?>" class="thumb-wrapper video-thumb-wrapper<?php if ($i == 0) echo ' first-video'; ?>">
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
<?php
$ss = $qv['ss'];
?>
Capturas de pantalla <span class="total">(<?php echo $ss['count']; ?>)</span>
</a>
<div class="section-content">
<?php
if ($ss['latest']) :
	$id = 1;
	foreach ($ss['latest'] as $s) : ?>
<a class="thumb-wrapper <?php if ($id == 1 || $id == 3) echo 'left-col'; if ($id >= 3) echo ' bottom-row'; ?>" href="screenshots/">
<span class="thumb-bg" style="background-size: 188px 118px; background-image:url(/uploads/screenshots/<?php echo $s['file']; ?>)">
<span class="thumb-frame"></span>
</span>
<span class="date-added">Fecha: <?php echo date('d/m/Y', $s['post_date']); ?></span>
</a><?php ++$id; endforeach; endif; ?>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
</div>
<span class="clear"><!-- --></span>
<center>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Media 728&#42;90) */
google_ad_slot = "3247785244";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>
</div>
</div>
<div style="display:none" id="media-preload-container"></div>