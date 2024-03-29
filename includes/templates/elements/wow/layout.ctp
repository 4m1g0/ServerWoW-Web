<?php if ($this->core->isCached()) echo '<!-- Restored from cache: ' . $this->core->getCacheEntry() . ' -->' . NL; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<title><?php echo $this->c('Layout')->getPageTitle(); ?></title>
<meta name="description" content="<?php echo $this->c('Layout')->getPageDescription(); ?>">
<meta name="keywords" content="<?php echo $this->c('Layout')->getPageKeywords(); ?>">
<meta content="false" http-equiv="imagetoolbar" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<link rel="shortcut icon" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/images/favicons/wow.ico" type="image/x-icon"/>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/css/common.css?v27" />
<!--[if IE]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/css/common-ie.css?v27" />
<![endif]-->
<!--[if IE 6]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/css/common-ie6.css?v27" />
<![endif]-->
<!--[if IE 7]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/css/common-ie7.css?v27" />
<![endif]-->
<link title="World of Warcraft - News" href="<?php echo CLIENT_FILES_PATH; ?>/wow/en/feed/news" type="application/atom+xml" rel="alternate" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/css/wow.css?v14" />
<!--[if IE]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/css/wow-ie.css?v14" />
<![endif]-->
<!--[if IE 6]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/css/wow-ie6.css?v14" />
<![endif]-->
<!--[if IE 7]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/css/wow-ie7.css?v14" />
<![endif]-->
<?php echo $this->c('Document')->releaseCss('header'); ?>
<?php if ($l->GetLocaleID() != LOCALE_EN) : ?><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/css/locale/<?php echo $l->getLocale(LOCALE_DOUBLE); ?>.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/css/locale/<?php echo $l->getLocale(LOCALE_DOUBLE); ?>.css" /><?php endif; ?>

<?php if ($isAdmin) : ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/admin/admin.css?v=1" />
<?php endif; ?>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/third-party/jquery.js?v27"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/core.js?v27"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/tooltip.js?v27"></script>
<!--[if IE 6]> <script type="text/javascript">
//<![CDATA[
try { document.execCommand('BackgroundImageCache', false, true) } catch(e) {}
//]]>
</script>
<![endif]-->
<script type="text/javascript">
//<![CDATA[
Core.staticUrl = '<?php echo CLIENT_FILES_PATH; ?>/wow/static';
Core.sharedStaticUrl= '<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common';
Core.baseUrl = '<?php echo $this->localeWowUrl(); ?>';
Core.cdnUrl = 'http://serverwow.com';
Core.supportUrl = 'http://serverwow.com/wow/forum/9/';
Core.secureSupportUrl= 'https://serverwow.com/wow/forum/9/';
Core.project = 'wow';
Core.locale = '<?php echo $l->getLocale(LOCALE_DOUBLE); ?>';
Core.buildRegion = 'eu';
Core.shortDateFormat= 'dd/MM/yyyy';
Core.dateTimeFormat = 'dd/MM/yyyy HH:mm';
Core.loggedIn = false;
Flash.videoPlayer = '<?php echo CLIENT_FILES_PATH; ?>/wow/player/video-player.swf';
Flash.videoBase = '<?php echo CLIENT_FILES_PATH; ?>/wow/media/videos';
Flash.ratingImage = '<?php echo CLIENT_FILES_PATH; ?>/wow/player/rating-pegi.jpg';
Flash.expressInstall= '<?php echo CLIENT_FILES_PATH; ?>/wow/player/video-player.swf';
//]]>
</script>
<?php echo $this->c('Document')->releaseJs('header'); ?>
<?php if (!isset($_COOKIE['featureclosed'])) : ?>
<script type="text/javascript">
$(document).ready(function() {
	$('div#feature-tip a.close').click(function() {
		$('#feature-tip').hide();
		Cookie.create('featureclosed', 1, {expires: 8760});
	});
});
</script>
<?php endif; ?>
<meta name="title" content="Server WoW : Server de World of Warcraft, Server de WoW" />
<link rel="image_src" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/icons/facebook/game.jpg" />

<?php
if (isset($character) && $character && $character->getProfilePage() == 'profile_home') :
?>
<style type="text/css">
#content .content-top { background: url("/wow/static/images/character/summary/backgrounds/race/<?php echo $character->getRace(); ?>.jpg") left top no-repeat; }
.profile-wrapper { background-image: url("/wow/static/images/2d/profilemain/race/<?php echo $character->getRace(); ?>-<?php echo $character->getGender(); ?>.jpg"); }
</style>
<?php endif; ?>

<link href="https://plus.google.com/117818722165936859038" rel="publisher" />
<script type="text/javascript">
window.___gcfg = {lang: 'es'};
(function() 
{var po = document.createElement("script");
po.type = "text/javascript"; po.async = true;po.src = "https://apis.google.com/js/plusone.js";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(po, s);
})();
</script>
<script type="text/javascript">
var phplive_v = new Object;
phplive_v["name"] = "<?php echo strtolower($this->c('AccountManager')->user('username')) ?>";
phplive_v["email"] = "<?php echo $this->c('AccountManager')->user('email') ?>";
phplive_v["Login"] = "<?php echo $this->c('AccountManager')->user('username') ?>";
phplive_v["CID"] = "<?php echo $this->c('AccountManager')->user('id') ?>";
</script>
</head>
<body class="<?php echo $l->getLocale(LOCALE_DOUBLE) . ' ' . (isset($body_class) ? $body_class : 'homepage'); if (isset($notify)) echo ' has-notify-bar'; ?>">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=336076233078446";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<?php echo $this->region('adminBox'); ?>
<?php if (isset($notify)) : ?>
<div class="notify-bar" id="notify-bar">
<div class="notify-bar-inner">
<span class="cell news" data-ad="">
<span>
<strong>Notify Title<?php //echo $notify['title']; ?></strong>
Notify Text<?php //echo $notify['text']; ?>
</span>
</span>
</div>
</div>
<?php endif; ?>
<div id="wrapper">
<div id="header">
<?php if ($this->issetRegion('header')) echo $this->region('header'); ?>
</div>
<div id="content">
<div class="content-top">
<?php if ($this->issetRegion('breadcrumb')) echo $this->region('breadcrumb'); ?>

<div class="content-bot">
<?php if ($this->issetRegion('pagecontent')) echo $this->region('pagecontent'); ?>
</div>
</div>
</div>
<div id="footer">
<?php if ($this->issetRegion('footer')) echo $this->region('footer'); ?>
</div>
<div id="service">
<?php if ($this->issetRegion('service')) echo $this->region('service'); ?>
</div>

<script type="text/javascript">
//<![CDATA[
var xsToken = '';
var Msg = {
support: {
ticketNew: 'Ticket {0} was created.',
ticketStatus: 'Ticket {0}’s status changed to {1}.',
ticketOpen: 'Open',
ticketAnswered: 'Answered',
ticketResolved: 'Resolved',
ticketCanceled: 'Cancelled',
ticketArchived: 'Archived',
ticketInfo: 'Need Info',
ticketAll: 'View All Tickets'
},
cms: {
requestError: 'Your request cannot be completed.',
ignoreNot: 'Not ignoring this user',
ignoreAlready: 'Already ignoring this user',
stickyRequested: 'Sticky requested',
postAdded: 'Post added to tracker',
postRemoved: 'Post removed from tracker',
userAdded: 'User added to tracker',
userRemoved: 'User removed from tracker',
validationError: 'A required field is incomplete',
characterExceed: 'The post body exceeds XXXXXX characters.',
searchFor: "Search for",
searchTags: "Articles tagged:",
characterAjaxError: "You may have become logged out. Please refresh the page and try again.",
ilvl: "Level {0}",
shortQuery: "Search requests must be at least three characters long."
},
bml: {
bold: 'Bold',
italics: 'Italics',
underline: 'Underline',
list: 'Unordered List',
listItem: 'List Item',
quote: 'Quote',
quoteBy: 'Posted by {0}',
unformat: 'Remove Formating',
cleanup: 'Fix Linebreaks',
code: 'Code Blocks',
item: 'WoW Item',
itemPrompt: 'Item ID:',
url: 'URL',
urlPrompt: 'URL Address:'
},
ui: {
viewInGallery: 'View in gallery',
loading: 'Loading…',
unexpectedError: 'An error has occurred',
fansiteFind: 'Find this on…',
fansiteFindType: 'Find {0} on…',
fansiteNone: 'No fansites available.'
},
grammar: {
colon: '{0}:',
first: 'First',
last: 'Last'
},
fansite: {
achievement: 'achievement',
character: 'character',
faction: 'faction',
'class': 'class',
object: 'object',
talentcalc: 'talents',
skill: 'profession',
quest: 'quest',
spell: 'spell',
event: 'event',
title: 'title',
arena: 'arena team',
guild: 'guild',
zone: 'zone',
item: 'item',
race: 'race',
npc: 'NPC',
pet: 'pet'
},
search: {
kb: 'Support',
post: 'Forums',
article: 'Blog Articles',
static: 'Game Content',
wowcharacter: 'Characters',
wowitem: 'Items',
wowguild: 'Guilds',
wowarenateam: 'Arena Teams',
other: 'Other'
}
};
//]]>
</script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/menu.js?v27"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/js/wow.js?v14"></script>
<script type="text/javascript">
//<![CDATA[
$(function(){
Menu.initialize('/data/menu.json');
Search.initialize('<?php echo CLIENT_FILES_PATH; ?>/ta/lookup');
});
//]]>
</script>
<?php echo $this->c('Document')->releaseJs('footer'); ?>

<script type="text/javascript">
//<![CDATA[
Core.load("<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/third-party/jquery-ui-1.8.6.custom.min.js?v27");
Core.load("<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/search.js?v27");
Core.load("<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/login.js?v27", false, function() {
Login.embeddedUrl = '<?php echo CLIENT_FILES_PATH; ?>/login/login.frag';
});
//]]>
</script>
<!--[if lt IE 8]> <script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/third-party/jquery.pngFix.pack.js?v27"></script>
<script type="text/javascript">
//<![CDATA[
$('.png-fix').pngFix(); //]]>
</script>
<![endif]-->

</body>
</html>
<?php //exit(0); ?>