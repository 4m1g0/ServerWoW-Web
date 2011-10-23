<?php if ($this->core->isCached()) echo '<!-- Restored from cache: ' . $this->core->getCacheEntry() . ' -->' . NL; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
<head>
<title><?php echo $this->c('Layout')->getPageTitle(); ?></title>
<meta content="false" http-equiv="imagetoolbar" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<link rel="shortcut icon" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/images/favicons/wow.ico" type="image/x-icon"/>
<link rel="search" type="application/opensearchdescription+xml" href="http://eu.battle.net/en-gb/data/opensearch" title="Battle.net Search" />
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
Core.cdnUrl = 'http://eu.media.blizzard.com';
Core.supportUrl = 'http://eu.battle.net/support/';
Core.secureSupportUrl= 'https://eu.battle.net/support/';
Core.project = 'wow';
Core.locale = '<?php echo $l->getLocale(LOCALE_DOUBLE); ?>';
Core.buildRegion = 'eu';
Core.shortDateFormat= 'dd/MM/yyyy';
Core.dateTimeFormat = 'dd/MM/yyyy HH:mm';
Core.loggedIn = false;
Flash.videoPlayer = 'http://eu.media.blizzard.com/global-video-player/themes/wow/video-player.swf';
Flash.videoBase = 'http://eu.media.blizzard.com/wow/media/videos';
Flash.ratingImage = 'http://eu.media.blizzard.com/global-video-player/ratings/wow/rating-pegi.jpg';
Flash.expressInstall= 'http://eu.media.blizzard.com/global-video-player/expressInstall.swf';
//]]>
</script>
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
<meta name="title" content="World of Warcraft" />
<link rel="image_src" href="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/icons/facebook/game.jpg" />

<?php
if (isset($character) && $character && $character->getProfilePage() == 'profile_home') :
?>
<style type="text/css">
#content .content-top { background: url("/wow/static/images/character/summary/backgrounds/race/<?php echo $character->getRace(); ?>.jpg") left top no-repeat; }
.profile-wrapper { background-image: url("/wow/static/images/2d/profilemain/race/<?php echo $character->getRace(); ?>-<?php echo $character->getGender(); ?>.jpg"); }
</style>
<?php endif; ?>

</head>
<body class="<?php echo $l->getLocale(LOCALE_DOUBLE) . ' ' . (isset($body_class) ? $body_class : 'homepage'); if (!isset($notify)) echo ' has-notify-bar'; ?>">
<?php echo $this->region('adminBox'); ?>
<?php if (!isset($notify)) : ?>
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