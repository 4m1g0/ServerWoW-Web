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
var galleryType = "videos";
var dataKey = "videos";
var viewType = "film-strip";
var discussionSigs = ["" ];
var videoData = [{ flv: "/" } ];
if (location.hash) {
var hashInfo = /#\/([^&]*)(?:&commentsPage=(.*))?/.exec(location.hash);
var imageKey = hashInfo[1];
if (imageKey != "wow-cinematic") {
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
<div id="film-strip-thumbnails" class="video-thumbnails">
<?php
$videos = $media->getVideos();
if ($videos) :
	foreach ($videos as &$v) :
?>
<a id="wow-cinematic" data-tooltip="<?php echo $v['title']; ?>" class="film-strip-thumb-wrapper<?php if ($v['key'] == $media->video('key')) echo ' active-film-strip-thumb-wrapper'; ?>" style="background-image:url(http://img.youtube.com/vi/<?php echo $v['youtube']; ?>/2.jpg)" href="?view=<?php echo $v['key']; ?>">
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
<div id="flash-container1">
<div id="flash-video1"><object style="height: 390px; width: 640px"><param name="movie" value="http://www.youtube.com/v/<?php echo $media->getYoutubeId(); ?>?version=3&feature=player_profilepage"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="http://www.youtube.com/v/<?php echo $media->getYoutubeId(); ?>?version=3&feature=player_profilepage" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="640" height="360"></object></div>
</div>
</td>
</tr>
</table>
<a href="<?php echo $this->getWowUrl('media/videos/?view=' . $media->getNextKey()); ?>" onclick="" class="paging-arrow next"></a>
<a href="<?php echo $this->getWowUrl('media/videos/?view=' . $media->getPrevKey()); ?>" onclick="" class="paging-arrow previous"></a>
</div>
</div>
<div id="media-meta-data">
<div class="meta-data">
<div id="item-title"><?php echo $media->video('title'); ?></div>
<dl class="meta-details">
<dt>Fecha: </dt>
<dd><?php echo date('d/m/Y', (int)$media->video('post_date')); ?></dd>
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