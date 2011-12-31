<!-- START: Footer -->
<div id="footer">
<div id="sitemap" class="promotions">
<div class="column">
<h3 class="bnet">
<a href="<?php echo CLIENT_FILES_PATH; ?>/" tabindex="100"><?php echo $l->getString('template_footer_home_title'); ?></a>
</h3>
<ul>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/what-is/"><?php echo $l->getString('template_footer_home_link1'); ?></a></li>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/account/management/"><?php echo $l->getString('template_footer_home_link4'); ?></a></li>
</ul>
</div>
<div class="column">
<h3 class="games">
<a href="<?php echo CLIENT_FILES_PATH; ?>" tabindex="100"><?php echo $l->getString('template_footer_games_title'); ?></a>
</h3>
<ul>
<li><a href=""><?php echo $l->getString('template_footer_games_link1'); ?></a></li>
<li><a href=""><?php echo $l->getString('template_footer_games_link2'); ?></a></li>
<li><a href=""><?php echo $l->getString('template_footer_games_link3'); ?></a></li>
<li><a href=""><?php echo $l->getString('template_footer_games_link4'); ?></a></li>
</ul>
</div>
<div class="column">
<h3 class="account">
<a href="<?php echo CLIENT_FILES_PATH; ?>/account/management/" tabindex="100"><?php echo $l->getString('template_footer_account_title'); ?></a>
</h3>
<ul>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/account/support/password-reset.html"><?php echo $l->getString('template_footer_account_link1'); ?></a></li>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/account/creation/tos.html"><?php echo $l->getString('template_footer_account_link2'); ?></a></li>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/account/management/"><?php echo $l->getString('template_footer_account_link3'); ?></a></li>
</ul>
</div>
<div class="column">
<h3 class="support">
<a href="<?php echo CLIENT_FILES_PATH; ?>/wow/forum/9/" tabindex="100"><?php echo $l->getString('template_footer_support_title'); ?></a>
</h3>
<ul>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/wow/forum/"><?php echo $l->getString('template_footer_support_link1'); ?></a></li>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/wow/bugtracker/"><?php echo $l->getString('template_footer_support_link2'); ?></a></li>
</ul>
</div>
<span class="clear"><!-- --></span>
</div>
<div id="copyright">
<a href="javascript:;" tabindex="100" id="change-language">
<span><?php echo $l->getString('locale_region') . ' - ' . $l->getString('locale_name'); ?></span>
</a>
<?php echo $l->getString('copyright_bottom_title'); ?>
<a onclick="return Core.open(this);" href="http://eu.blizzard.com/company/about/termsofuse.html" tabindex="100"><?php echo $l->getString('copyright_bottom_tos'); ?></a>
<a onclick="return Core.open(this);" href="http://eu.blizzard.com/company/legal/" tabindex="100"><?php echo $l->getString('copyright_bottom_legal'); ?></a>
<a onclick="return Core.open(this);" href="http://eu.blizzard.com/company/about/privacy.html" tabindex="100"><?php echo $l->getString('copyright_bottom_privacy'); ?></a>
<a onclick="return Core.open(this);" href="http://eu.blizzard.com/company/about/infringementnotice.html" tabindex="100"><?php echo $l->getString('copyright_bottom_copyright'); ?></a>
</div>
<div id="international"></div>
<div id="legal">
<div id="legal-ratings" class="png-fix">
<a href="http://www.pegi.info/" onclick="return Core.open(this);">
<img class="legal-image" alt="" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/images/legal/eu/pegi-wow.png" />
</a>
</div>
<div id="blizzard" class="png-fix">
<span id="cdSiteSeal2"><script type="text/javascript" src="//tracedseals.starfieldtech.com/siteseal/get?scriptId=cdSiteSeal2&amp;cdSealType=Seal2&amp;sealId=55e4ye7y7mb73baeb3016453fcaa57x90cy7mb7355e4ye7d39bdb92695749257"></script></span>
</div>
<span class="clear"><!-- --></span>
</div>

</div>
<!-- END: Footer -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21791001-6']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>