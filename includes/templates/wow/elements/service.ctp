<ul class="service-bar">
<li class="service-cell service-home"><a href="<?php echo $this->getAppUrl(); ?>/" tabindex="50" accesskey="1" title="Battle.net Home"> </a></li>
<li class="service-cell service-welcome">
<?php if (!$this->c('AccountManager')->isLoggedIn()) echo $l->format('template_servicebar_auth_caption', $this->getAppUrl('login/login.frag'), $this->getAppUrl('account/creation/tos.html')); else echo $l->format('template_servicebar_welcome_caption', $this->c('AccountManager')->user('username')); ?>
</li>
<li class="service-cell service-account"><a href="<?php echo $this->getAppUrl('account/management/'); ?>" class="service-link" tabindex="50" accesskey="3"><?php echo $l->getString('template_servicebar_account'); ?></a></li>
<li class="service-cell service-support service-support-enhanced">
<a href="#support" class="service-link service-link-dropdown" tabindex="50" accesskey="4" id="support-link" onclick="return false" style="cursor: progress" rel="javascript"><?php echo $l->getString('template_servicebar_support'); ?><span class="no-support-tickets" id="support-ticket-count"></span></a>
<div class="support-menu" id="support-menu" style="display:none;">
<div class="support-primary">
<ul class="support-nav">
<li>
<a href="http://eu.blizzard.com/support/" tabindex="55" class="support-category">
<strong class="support-caption">Knowledge Center</strong>
Browse our support articles
</a>
</li>
<li>
<a href="https://eu.battle.net/support/ticket/submit" tabindex="55" class="support-category">
<strong class="support-caption">Ask a Question</strong>
Create a new support ticket
</a>
</li>
<li>
<a href="https://eu.battle.net/support/ticket/status" tabindex="55" class="support-category">
<strong class="support-caption">Your Support Tickets</strong>
View your active tickets (login required).
</a>
</li>
</ul>
<span class="clear"><!-- --></span>
</div>
<div class="support-secondary"></div>
<!--[if IE 6]> <iframe id="support-shim" src="javascript:false;" frameborder="0" scrolling="no" style="display: block; position: absolute; top: 0; left: 9px; width: 297px; height: 400px; z-index: -1;"></iframe>
<script type="text/javascript">
//<![CDATA[
(function(){
var doc = document;
var shim = doc.getElementById('support-shim');
shim.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0)';
shim.style.display = 'block';
})();
//]]>
</script>
<![endif]-->
</div>
</li>
<li class="service-cell service-explore">
<a href="#explore" tabindex="50" accesskey="5" class="dropdown" id="explore-link" onclick="return false" style="cursor: progress" rel="javascript"><?php echo $l->getString('template_servicebar_explore'); ?></a>
<div class="explore-menu" id="explore-menu" style="display:none;">
<div class="explore-primary">
<ul class="explore-nav">
<li>
<a href="<?php echo CLIENT_FILES_PATH; ?>/" tabindex="55">
<strong class="explore-caption"><?php echo $l->getString('template_servicebar_explore_menu_home_title'); ?></strong>
<?php echo $l->getString('template_servicebar_explore_menu_home_description'); ?>
</a>
</li>
<li>
<a href="<?php echo CLIENT_FILES_PATH; ?>/account/management/" tabindex="55">
<strong class="explore-caption"><?php echo $l->getString('template_servicebar_explore_menu_account_title'); ?></strong>
<?php echo $l->getString('template_servicebar_explore_menu_account_description'); ?>
</a>
</li>
<li>
<a href="http://eu.blizzard.com/support/" tabindex="55">
<strong class="explore-caption"><?php echo $l->getString('template_servicebar_explore_menu_support_title'); ?></strong>
<?php echo $l->getString('template_servicebar_explore_menu_support_description'); ?>
</a>
</li>
<li>
<a href="https://eu.battle.net/account/management/get-a-game.html" tabindex="55">
<strong class="explore-caption"><?php echo $l->getString('template_servicebar_explore_menu_buy_title'); ?></strong>
<?php echo $l->getString('template_servicebar_explore_menu_buy_description'); ?>
</a>
</li>
</ul>
<div class="explore-links">
<h2 class="explore-caption"><?php echo $l->getString('template_servicebar_explore_menu_more_title'); ?></h2>
<ul>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/what-is/" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link1'); ?></a></li>
<li><a href="http://eu.battle.net/realid/" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link2'); ?></a></li>
<li><a href="https://eu.battle.net/account/parental-controls/index.html" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link3'); ?></a></li>
<li><a href="http://eu.battle.net/security/" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link4'); ?></a></li>
<li><a href="http://eu.battle.net/games/classic" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link5'); ?></a></li>
<li><a href="https://eu.battle.net/account/support/index.html" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link6'); ?></a></li>
</ul>
</div>
<span class="clear"><!-- --></span>
<!--[if IE 6]> <iframe id="explore-shim" src="javascript:false;" frameborder="0" scrolling="no" style="display: block; position: absolute; top: 0; left: 9px; width: 409px; height: 400px; z-index: -1;"></iframe>
<script type="text/javascript">
//<![CDATA[
(function(){
var doc = document;
var shim = doc.getElementById('explore-shim');
shim.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0)';
shim.style.display = 'block';
})();
//]]>
</script>
<![endif]-->
</div>
<ul class="explore-secondary">
<li class="explore-game explore-game-sc2">
<a href="http://eu.battle.net/sc2/" tabindex="55">
<strong class="explore-caption">StarCraft II</strong>
<?php echo $l->getString('template_servicebar_explore_menu_starcraft'); ?>
</a>
</li>
<li class="explore-game explore-game-wow">
<a href="<?php echo $this->getWowUrl(); ?>" tabindex="55">
<strong class="explore-caption">World of Warcraft</strong>
<?php echo $l->getString('template_servicebar_explore_menu_worldofwarcraft'); ?>
</a>
</li>
<li class="explore-game explore-game-d3">
<a href="http://eu.battle.net/games/d3" tabindex="55">
<strong class="explore-caption">Diablo III</strong>
<?php echo $l->getString('template_servicebar_explore_menu_diablo'); ?>
</a>
</li>
</ul>
</div>
</li>
</ul>
<div id="warnings-wrapper">
<!--[if IE]>
<div id="browser-warning" class="warning warning-red">
<?php echo $l->getString('template_bn_browser_warning'); ?>
</div>
<![endif]-->
<!--[if IE]>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/third-party/CFInstall.min.js?v27"></script>
<script type="text/javascript">
//<![CDATA[
$(function() {
var age = 365 * 24 * 60 * 60 * 1000;
var src = 'https://www.google.com/chromeframe/?hl=en-GB';
if ('http:' == document.location.protocol) {
src = 'http://www.google.com/chromeframe/?hl=en-GB';
}
document.cookie = "disableGCFCheck=0;path=/;max-age="+age;
$('#chrome-frame-link').bind({
'click': function() {
App.closeWarning('#browser-warning');
CFInstall.check({
mode: 'overlay',
url: src
});
return false;
}
});
});
//]]>
</script>
<![endif]-->
<noscript>
<div id="javascript-warning" class="warning warning-red">
<div class="warning-inner2">
<?php echo $l->getString('template_bn_js_warning'); ?>
</div>
</div>
</noscript>
</div>
</div>