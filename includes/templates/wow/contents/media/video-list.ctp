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

<script type="text/javascript">
function showSubmitForm()
{
	$('#submitform').show();
}

function hideSubmitForm()
{
	$('#video-submit-youtube').val('');
	$('#video-submit-title').val('');
	$('#submitform').hide();
}

function submitForm()
{
	$('#errors-submit').html('<br /><br />').hide();
	var youtube = $('#video-submit-youtube').val();
	var title = $('#video-submit-title').val();

	if (!youtube || !title)
	{
		$('#errors-submit').html('All fields are requried!<br /><br />').show();
		return false;
	}

	$.ajax({
		url: '<?php echo $this->getWowUrl('media/api/addvideo'); ?>',
		type: 'POST',
		'data-type': 'JSON',
		data: {'link': youtube, 'title': title},
		success: function(resp) {
			resp = $.parseJSON(resp);
			$('#op-result').html(resp.result).show();
		}
	});
}
</script>
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
var viewType = "thumbnail-page";
var numThumbnailPages = 2;
var keywordParameter = "";
var discussionSigs = [];
var indices = [];//"wow-cinematic", "naxxramas", "burning-crusade-cinematic", "lament-of-the-highborne", "black-temple", "zulaman", "sunwell", "wrath-reveal", "wrath-cinematic", "wrathgate", "ulduar", "call-of-the-crusade", "fall-of-the-lich-king", "wrath-ending", "cataclysm-reveal", "cataclysm-worldreborn", "cataclysm-tv-spot", "cataclysm-intro", "zandalari", "rage-of-the-firelands", "mists-of-pandaria-reveal"];
var itemPaths = [];//"http://eu.media.blizzard.com/wow/media/videos/wow-cinematic/wow-cinematic", "http://eu.media.blizzard.com/wow/media/videos/naxxramas/naxxramas", "http://eu.media.blizzard.com/wow/media/videos/burning-crusade-cinematic/burning-crusade-cinematic", "http://eu.media.blizzard.com/wow/media/videos/lament-of-the-highborne/lament-of-the-highborne", "http://eu.media.blizzard.com/wow/media/videos/black-temple/black-temple", "http://eu.media.blizzard.com/wow/media/videos/zulaman/zulaman", "http://eu.media.blizzard.com/wow/media/videos/sunwell/sunwell", "http://eu.media.blizzard.com/wow/media/videos/wrath-reveal/wrath-reveal", "http://eu.media.blizzard.com/wow/media/videos/wrath-cinematic/wrath-cinematic", "http://eu.media.blizzard.com/wow/media/videos/wrathgate/wrathgate", "http://eu.media.blizzard.com/wow/media/videos/ulduar/ulduar", "http://eu.media.blizzard.com/wow/media/videos/call-of-the-crusade/call-of-the-crusade", "http://eu.media.blizzard.com/wow/media/videos/fall-of-the-lich-king/fall-of-the-lich-king", "http://eu.media.blizzard.com/wow/media/videos/wrath-ending/wrath-ending", "http://eu.media.blizzard.com/wow/media/videos/cataclysm-reveal/cataclysm-reveal", "http://eu.media.blizzard.com/wow/media/videos/cataclysm-worldreborn/cataclysm-worldreborn", "http://eu.media.blizzard.com/wow/media/videos/cataclysm-tv-spot/cataclysm-tv-spot", "http://eu.media.blizzard.com/wow/media/videos/cataclysm-intro/cataclysm-intro", "http://eu.media.blizzard.com/wow/media/videos/zandalari/zandalari", "http://eu.media.blizzard.com/wow/media/videos/rage-of-the-firelands/rage-of-the-firelands", "http://eu.media.blizzard.com/wow/media/videos/mists-reveal/mists-of-pandaria-reveal" ];
if (location.hash) {
var thumbPage = parseInt(location.hash.substring(2));
if (thumbPage != 1 && !isNaN(thumbPage)) {
$("#thumbnail-page div").css("visibility", "hidden");
}
}
//]]>
</script>
<div class="thumbnail-page-wrapper">

<div id="thumbnail-page" class="video-page">
<div>
<?php
if ($this->c('AccountManager')->admin('group_mask') & ADMIN_GROUP_ADD_VIDEO) : ?>
<a href="javascript:;" onclick="showSubmitForm();">Submit New Video</a>
<div id="submitform" style="display:none">
<br />
<fieldset>
<input type="text" name="youtube" class="input text" id="video-submit-youtube" value="" /> <label for="video-submit-youtube">YouTube Link</label><br />
<input type="text" name="title" class="input text" id="video-submit-title" value="" /> <label for="video-submit-title">Title</label><br />
<input type="button" value="Send" class="input submit" onclick="javascript:submitForm();" />
<br />
<br />
<div id="errors-submit" style="display:none;">
</div>
<div id="op-result" style="display:none;">
</div>
<a href="javascript:;" onclick="javascript:hideSubmitForm();">Cancel and hide form</a>
</fieldset>
</div>
<?php endif; ?>
</div>
<Br />
<?php
$videos = $media->getVideos();
if ($videos) : 
	$i = 0;
	foreach ($videos as &$v) :
?>
<a href="<?php echo $this->getWowUrl('media/videos/?view=' . $v['key']); ?>" class="thumb-wrapper">
<span class="thumb-bg" style="background-size: 188px 118px;background-image:url(http://img.youtube.com/vi/<?php echo $v['youtube']; ?>/hqdefault.jpg)">
<span class="thumb-frame">
</span>
</span>
<span class="thumb-title"><?php echo $v['title']; ?></span>
</a>
<?php ++$i; endforeach; endif; ?>
<span class="clear"><!-- --></span>
<span class="clear"><!-- --></span>
<span class="clear"><!-- --></span>
</div>
</div>
</div>
<div style="display:none" id="media-preload-container"></div>