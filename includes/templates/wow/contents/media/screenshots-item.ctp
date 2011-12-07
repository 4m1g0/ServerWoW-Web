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
var discussionSigs = ["31389ed691fdb7ef4d62020c6814537f", "c4234abf90c7b9759acbd7cda6eba6ad", "e9b3974a93064cecab76d9cbbd1bdfbd", "1ca986087809f7bf4fd8f2e4e099cc47", "c263db6b43718e29f3609b83f54eeca3", "0ab6bd6bb2f918a6d3d586f2b78c5e62", "3505d6221e1e2c9a46a1d47d3ee9ee46", "50133444dd4a38a93398293407a4a008", "0aecab5054997f7559bf0d9bb17562c1", "ef33e815535084628705b8189a391542", "435e2db87cd86afc54424908d10774d6", "36a2d8225e50d5028384c7a22a314311", "de93aaf58d1c562dab69d043f7b45a54", "0375a2fb57e69780b81808624707970f", "5bfc1a3cc723516c3a1b678de68af104", "5c1086003e50794f92838c90b8cbb4e2", "75670e69564bb8e5a145e56872c7e0b3", "17be98af8372f3f69982bb5b7f0fbdc7", "d3058a89e80f8a562e545ecafaf5669e", "df9005b5f34c942e2d99f812112a5b23", "717dafe67fbca43d4783f9312216a16a", "18f524d44f235800cfc99d71d5ff4557", "93c5e0ca5a0790f7787f36845dc91015", "0a3234f3c0740b2909bbc7eb1e2a84ca", "d6a69324243e01547623fcc136397995", "996bd4058201a1fc3dc36f19602092f9", "ccdff28b2f23e6ddfc5d473374bbbfdd", "1229c99b7ed9de763f64c229803b7607", "0b3eb48d3553207740bd934c3aa04ce0"];
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
</div>
</div>
</div>
<div style="display:none" id="media-preload-container"></div>