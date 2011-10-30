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
var viewType = "thumbnail-page";
var numThumbnailPages = 3;
var keywordParameter = "";
var discussionSigs = [];
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
var thumbPage = parseInt(location.hash.substring(2));
if (thumbPage != 1 && !isNaN(thumbPage)) {
$("#thumbnail-page div").css("visibility", "hidden");
}
}
//]]>
</script>
<div class="thumbnail-page-wrapper">
<div id="thumbnail-page">
<?php
$items = $media->getVideos();
if ($items) :
	foreach ($items as $s) :
?>
<a href="<?php echo $this->getWowUrl('media/screenshots/?view=' . $s['id']); ?>" class="thumb-wrapper">
<span class="thumb-bg" style="background-size: 188px 118px;background-image:url(<?php echo CLIENT_FILES_PATH . '/uploads/screenshots/' . $s['id'] . '.jpg'; ?>)">
<span class="thumb-frame">
</span>
</span>
</a>
<?php endforeach; endif; ?>

<span class="clear"><!-- --></span>
<span class="clear"><!-- --></span>
</div>
</div>
</div>
<div style="display:none" id="media-preload-container"></div>