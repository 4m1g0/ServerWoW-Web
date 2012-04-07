<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:Medios-Centro:Arriba', [728, 90], 'div-gpt-ad-1328887221789-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<center>
<!-- ServerWoW:Medios-Centro:Arriba -->
<div id='div-gpt-ad-1328887221789-0' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328887221789-0'); });
</script>
</div>
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
var itemPaths = [];//"<?php echo $this->getMediaServer(); ?>/wow/media/videos/wow-cinematic/wow-cinematic", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/naxxramas/naxxramas", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/burning-crusade-cinematic/burning-crusade-cinematic", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/lament-of-the-highborne/lament-of-the-highborne", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/black-temple/black-temple", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/zulaman/zulaman", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/sunwell/sunwell", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/wrath-reveal/wrath-reveal", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/wrath-cinematic/wrath-cinematic", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/wrathgate/wrathgate", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/ulduar/ulduar", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/call-of-the-crusade/call-of-the-crusade", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/fall-of-the-lich-king/fall-of-the-lich-king", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/wrath-ending/wrath-ending", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/cataclysm-reveal/cataclysm-reveal", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/cataclysm-worldreborn/cataclysm-worldreborn", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/cataclysm-tv-spot/cataclysm-tv-spot", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/cataclysm-intro/cataclysm-intro", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/zandalari/zandalari", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/rage-of-the-firelands/rage-of-the-firelands", "<?php echo $this->getMediaServer(); ?>/wow/media/videos/mists-reveal/mists-of-pandaria-reveal" ];
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
<div style="margin-left:20px"><?php if ($pagination) echo '<ul class="ui-pagination">' . $pagination . '</ul>'; ?></div>
</div>
<div style="display:none" id="media-preload-container"></div>