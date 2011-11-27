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
var discussionSigs = ["bcc972c21ed0d6b7adeb35e807713272", "c2fbb89cf2f119bbc01c7bb370f8c143", "cd060cb0ed14a69cbedb95eaec81fcf2", "4a2585f5fa59ad56cb5e81351b4ec29d", "10896a8a3a2464f73ff6e62517ef9975", "9385fffb2d4b26cef7ededb45a7869c5", "c8ba634afd448c03f39c689dc13a9701", "45912aa2c04543426b3ec37e7ec711ab", "7a14557bef5c6bf4dabc65d2830576cc", "a9f99be408baa9acf657761bfbea70d2", "dff9ddbeffe79f1bd73911075be450ef", "637684a12b1512f37b3c36888dc8d3c8", "87d5967536fee475f1e7a561ac15466f", "9dafe0dac013eb11eeebe763f70e9124", "d44b2d0eb1110891fc0740239fd8f58e", "6aae04d03e441c8b7ba691134b847d38", "f0a7f5eb83eb165f01f0ea6341180e94", "d4049b310d2d655db35d688bb4652676", "bd4cef6304b82e8aaf7bd9f046c5e387", "0b83a02704e3ede171c4980fe225fa2a", "7bba6fc24f0fbf0957dab98e99613e07"];
var indices = ["wow-cinematic", "naxxramas", "burning-crusade-cinematic", "lament-of-the-highborne", "black-temple", "zulaman", "sunwell", "wrath-reveal", "wrath-cinematic", "wrathgate", "ulduar", "call-of-the-crusade", "fall-of-the-lich-king", "wrath-ending", "cataclysm-reveal", "cataclysm-worldreborn", "cataclysm-tv-spot", "cataclysm-intro", "zandalari", "rage-of-the-firelands", "mists-of-pandaria-reveal"];
var itemPaths = ["http://eu.media.blizzard.com/wow/media/videos/wow-cinematic/wow-cinematic", "http://eu.media.blizzard.com/wow/media/videos/naxxramas/naxxramas", "http://eu.media.blizzard.com/wow/media/videos/burning-crusade-cinematic/burning-crusade-cinematic", "http://eu.media.blizzard.com/wow/media/videos/lament-of-the-highborne/lament-of-the-highborne", "http://eu.media.blizzard.com/wow/media/videos/black-temple/black-temple", "http://eu.media.blizzard.com/wow/media/videos/zulaman/zulaman", "http://eu.media.blizzard.com/wow/media/videos/sunwell/sunwell", "http://eu.media.blizzard.com/wow/media/videos/wrath-reveal/wrath-reveal", "http://eu.media.blizzard.com/wow/media/videos/wrath-cinematic/wrath-cinematic", "http://eu.media.blizzard.com/wow/media/videos/wrathgate/wrathgate", "http://eu.media.blizzard.com/wow/media/videos/ulduar/ulduar", "http://eu.media.blizzard.com/wow/media/videos/call-of-the-crusade/call-of-the-crusade", "http://eu.media.blizzard.com/wow/media/videos/fall-of-the-lich-king/fall-of-the-lich-king", "http://eu.media.blizzard.com/wow/media/videos/wrath-ending/wrath-ending", "http://eu.media.blizzard.com/wow/media/videos/cataclysm-reveal/cataclysm-reveal", "http://eu.media.blizzard.com/wow/media/videos/cataclysm-worldreborn/cataclysm-worldreborn", "http://eu.media.blizzard.com/wow/media/videos/cataclysm-tv-spot/cataclysm-tv-spot", "http://eu.media.blizzard.com/wow/media/videos/cataclysm-intro/cataclysm-intro", "http://eu.media.blizzard.com/wow/media/videos/zandalari/zandalari", "http://eu.media.blizzard.com/wow/media/videos/rage-of-the-firelands/rage-of-the-firelands", "http://eu.media.blizzard.com/wow/media/videos/mists-reveal/mists-of-pandaria-reveal" ];
var videoData = [{ flv: "/wow-cinematic/wow-cinematic-es_ES.flv", w:704, h:299, captionsPath:"", customRating:"" }, { flv: "/naxxramas/naxxramas-en_US.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/burning-crusade-cinematic/burning-crusade-cinematic-es_ES.flv", w:704, h:299, captionsPath:"", customRating:"" }, { flv: "/lament-of-the-highborne/lament-of-the-highborne-en_US.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/black-temple/black-temple-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/zulaman/zulaman-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/sunwell/sunwell-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/wrath-reveal/wrath-reveal-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/wrath-cinematic/wrath-cinematic-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/wrathgate/Puerta de la Cólera-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/ulduar/ulduar-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/call-of-the-crusade/call-of-the-crusade-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/fall-of-the-lich-king/fall-of-the-lich-king-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/wrath-ending/wrath-ending-en_US.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/cataclysm-reveal/cataclysm-reveal-es_ES.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/cataclysm-worldreborn/cataclysm-worldreborn_en-US.flv", w:704, h:397, captionsPath:"", customRating:"" }, { flv: "/cataclysm-tv-spot/cataclysm_tvspot_en-GB.flv", w:704, h:291, captionsPath:"", customRating:"" }, { flv: "/cataclysm-intro/cataclysm-intro-es_ES.flv", w:704, h:299, captionsPath:"", customRating:"" }, { flv: "/zandalari/zandalari-es_ES.flv", w:704, h:398, captionsPath:"", customRating:"" }, { flv: "/rage-of-the-firelands/rage-of-the-firelands-es_ES.flv", w:704, h:398, captionsPath:"", customRating:"" }, { flv: "/mists-reveal/mists-reveal-es_ES.flv", w:704, h:396, captionsPath:"http://eu.media.blizzard.com/wow/media/videos/mists-reveal/captions/es-es.xml", customRating:"http://eu.media.blizzard.com/global-video-player/ratings/wow/may-contain-content.jpg" } ];
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
</div>
</div>
</div>
<div style="display:none" id="media-preload-container"></div>