<center>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Media-videos-screenshots 728&#42;90) */
google_ad_slot = "8381664734";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>
<div class="media-content">

<!--[if IE]>
<script type="text/javascript">
//<![CDATA[
$("#filter-options").show().hide();
//]]>
</script>
<![endif]-->
<script type="text/javascript">
//<![CDATA[
var galleryType = "images";
var dataKey = "screenshots:mop";
var viewType = "film-strip";
var discussionSigs = [""];
<?php
$items = $media->getVideos();
if ($items) :
	?>var indices = [<?php foreach ($items as $i) :
?>
"<?php echo $i['id']; ?>", 
<?php endforeach; ?>];
var itemPaths = [<?php foreach ($items as $i) : ?>
"http://<?php echo $_SERVER['SERVER_NAME'] . CLIENT_FILES_PATH . '/uploads/screenshots/' . $i['id']; ?>",
<?php endforeach; endif; ?>
];
if (location.hash) {
var hashInfo = /#\/([^&]*)(?:&commentsPage=(.*))?/.exec(location.hash);
var imageKey = hashInfo[1];
if (imageKey != "1") {
$("#current-image").css("visibility", "hidden");
}
}
//]]>
</script>
<div class="film-strip-wrapper">
<div id="film-strip">
<div class="viewport-scrollbar">
<div class="track">
<div id="scroll-thumb" class="thumb"><div class="thumb-bot"></div></div>
</div>
</div>
<div class="viewport-content">
<div id="film-strip-thumbnails">
<?php
if ($items): 
	foreach ($items as $i) : ?>
<a id="<?php echo $i['id']; ?>" class="film-strip-thumb-wrapper<?php if ($i['id'] == $media->ss('id')) echo ' active-film-strip-thumb-wrapper'; ?>" style="background-size: 120px 75px;background-image:url(<?php echo CLIENT_FILES_PATH . '/uploads/screenshots/' . $i['id']; ?>.jpg)"
href="#/<?php echo $i['id']; ?>" onclick="GalleryViewer.loadItem('<?php echo $i['id']; ?>')">
<span class="film-strip-thumb-frame"></span>
</a>
<?php endforeach; endif; ?>
</div>
</div>
</div>
<div class="ajax-frame">
<table>
<tr>
<td id="film-strip-ajax-target">
<img id="current-image" onclick="GalleryViewer.getNextItem();" width="704" height="417" src="<?php echo CLIENT_FILES_PATH . '/uploads/screenshots/' . $media->ss('id') . '.jpg'; ?>" alt="" style="display:none" />
</td>
</tr>
</table>
<a href="javascript:;" onclick="GalleryViewer.getNextItem();" class="paging-arrow next"></a>
<a href="javascript:;" onclick="GalleryViewer.getPreviousItem();" class="paging-arrow previous"></a>
</div>
</div>
<div id="media-meta-data">
<div class="meta-data">
<dl class="meta-details">
<dt>Fecha: </dt>
<dd><?php echo date('d/m/Y', $media->ss('post_date')); ?></dd>
</dl>
<dl class="meta-details">
<dt class="dt-downloads">Descargar:</dt>
<dd class="dd-downloads">
<a class="format" href="<?php echo CLIENT_FILES_PATH . '/uploads/screenshots/' . $media->ss('id') . '.jpg'; ?>" onclick="window.open(this.href);return false;">Formato original</a> </dd>
</dl>
<span class="clear"><!-- --></span>
<div>
<table border='0' cellpadding='7' width='720'>
<tr>
<td width='40%'>
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=201748293206869&xfbml=1"></script><fb:like send="true" width="438" show_faces="false" font="" data-colorscheme="dark"></fb:like>
</td>
<td width='40%'>
<a href="https://twitter.com/share" class="twitter-share-button" data-via="serverwow" data-lang="es" data-size="large" data-related="serverwow" data-hashtags="serverwow">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</td>
<td width='10%'>
<g:plusone></g:plusone>
</tr>
</table>
</div>
</div>
</div>
</div>
<div style="display:none" id="media-preload-container"></div>