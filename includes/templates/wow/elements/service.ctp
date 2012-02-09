<ul class="service-bar">
<li class="service-cell service-home"><a href="/" tabindex="50" accesskey="1" title="Server WoW"> </a></li>
<li class="service-cell service-welcome">
<?php if (!$this->c('AccountManager')->isLoggedIn()) echo $l->format('template_servicebar_auth_caption', $this->getAppUrl('login/login.frag'), $this->getAppUrl('account/creation/tos.html')); else echo $l->format('template_servicebar_welcome_caption', $this->c('AccountManager')->user('username')); ?>
</li>
<li class="service-cell service-account"><a href="<?php echo $this->getAppUrl('account/management/'); ?>" class="service-link" tabindex="50" accesskey="3"><?php echo $l->getString('template_servicebar_account'); ?></a></li>
<?php if ($this->c('AccountManager')->isLoggedIn() && $this->c('AccountManager')->isAllowedToReceiveMsg()) : ?><li class="service-cell service-account"><a href="<?php echo $this->getAppUrl('account/management/inbox'); ?>" class="service-link"><?php
$unread = $this->c('AccountManager')->getUnreadMessagesCount();
if ($unread > 0)
{
	echo "<font color=red>(".$unread.")</font> ".$l->getString('template_messages');?></a></li>
<?php
}
else
	echo "(".$unread.") ".$l->getString('template_messages');?></a></li>
<?php endif; ?>
<li class="service-cell service-explore" style="background-position:-140px -200px;">
            <a href="#explore" tabindex="50" accesskey="6" class="dropdown" id="vote-link" style="cursor: pointer; " rel="javascript">Votar</a>
            <div class="explore-menu" id="vote-menu" style="display:none;width:350px;">
                <div class="explore-primary">
                    <div class="explore-links" style="float:left;">
                        <ul>
							<li><a href="http://serversprivados.com/?in=33" target="_blank" tabindex="55"><img src="http://serversprivados.com/vote.jpg" width="142" height="52" border="0" alt="World of Warcraft"></a></li><li><a href="http://www.wowtop.es/" target="_blank" tabindex="55"><img src="http://www.wowtop.es/button.php?u=nanouniko" width="142" height="52" border="0" alt="World of Warcraft"></a></li><li><a href="http://100ranking.com/" target="_blank" tabindex="55"><img src="http://100ranking.com/button.php?u=nache" width="142" height="52" border="0" alt="Servidor privado"></a></li><!-- Start Servers WoW Code --> 
<li><a href="http://world-of-warcraft.serverswow.net/?p=vote&v=30" target="_blank" alt="Vota por Server WoW | Server de WoW | Mas de 8000 Jugadores Online | Juega Gratis WoW | Server de World of Warcraft privado!"><img src="http://serverswow.net/vote.jpg" width="142px" height="52px" border="0" /></a><!-- End Servers WoW Code --></li><li>                       
                        </ul>
                    </div>
                    <div class="explore-links" style="margin-right:20px;">
                        <ul>

                          <li><a href="http://gratis-wow.es/" target="_blank" tabindex="55"><img src="http://gratis-wow.es/button.php?u=nache" width="142" height="52" border="0" alt="Server"></a></li><li><a href="http://wowranking.es/" target="_blank" tabindex="55"><img src="http://wowranking.es/button.php?u=nanouniko" width="142" height="52" border="0" alt="servidor"></a></li><li><a href="http://www.servidoreswow.es/" target="_blank" tabindex="55"><img src="http://www.servidoreswow.es/button.php?u=nanouniko" width="142" height="52" border="0" alt="Server de World of Warcraft"></a></li>                        
                        </ul>
                    </div>
                    <center><span class="clear">Recuerda que cada vez que votas por nosotros, Agradeces nuestro trabajo, e invitas a que tengas <b>Muchos mas compañeros con quien jugar y COMPETIR!!</b></span></center>
                </div>
         	</div>
 </li>

<li class="service-cell service-explore">
<a href="#explore" tabindex="50" accesskey="5" class="dropdown" id="explore-link" onclick="return false" style="cursor: progress" rel="javascript"><?php echo $l->getString('template_servicebar_explore'); ?></a>
<div class="explore-menu" id="explore-menu" style="display:none;">
<div class="explore-primary">

<ul class="explore-nav">
<li>
<a href="http://serverwow.com/wow/game/guide/" tabindex="55">
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
<a href="<?php echo CLIENT_FILES_PATH; ?>/forum/" tabindex="55">
<strong class="explore-caption"><?php echo $l->getString('template_servicebar_explore_menu_support_title'); ?></strong>
<?php echo $l->getString('template_servicebar_explore_menu_support_description'); ?>
</a>
</li>
</ul>
<div class="explore-links">
<h2 class="explore-caption"><?php echo $l->getString('template_servicebar_explore_menu_more_title'); ?></h2>
<ul>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/wow/server-wow/" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link1'); ?></a></li>
<li><a href="http://serverwow.com/wow/forum/topic/21" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link2'); ?></a></li>
<li><a href="http://serverwow.com/wow/bugtracker/" tabindex="55"><?php echo $l->getString('template_footer_support_link2'); ?></a></li>
<li><a href="http://serverwow.com/wow/community/" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link3'); ?></a></li>
<li><a href="http://serverwow.com/wow/forum/7/" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link4'); ?></a></li>
<li><a href="http://serverwow.com/wow/status/" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link5'); ?></a></li>
<li><a href="http://serverwow.com/wow/pvp/arena/" tabindex="55"><?php echo $l->getString('template_servicebar_explore_menu_more_link6'); ?></a></li>
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
<li class="explore-game explore-facebook">
<!-- <div class="fb-like-box" data-href="http://www.facebook.com/ServerWoW" data-width="380" data-height="200" data-colorscheme="dark" data-show-faces="false" data-border-color="grey" data-stream="true" data-header="false"></div>-->
<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FServerWoW&amp;width=380&amp;colorscheme=dark&amp;show_faces=false&amp;border_color=grey&amp;stream=true&amp;header=false&amp;height=200" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:380px; height:200px;" allowTransparency="true"></iframe>
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