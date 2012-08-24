<div class="search-bar">
<form action="<?php echo $this->getWowUrl('search'); ?>" method="get" autocomplete="off">
<div>
<input type="text" class="search-field input" name="q" id="search-field" maxlength="200" tabindex="40" alt="Buscar en la armeria, foro y mas…" value="Buscar en la armeria, foro y mas…" />
<input type="submit" class="search-button" value="" tabindex="41" />
</div>
</form>
<g:plusone></g:plusone>
<div><a href="https://plus.google.com/117818722165936859038?prsrc=3" style="text-decoration:none;" target="_blank"><img src="https://ssl.gstatic.com/images/icons/gplus-32.png" alt="" style="border:0;width:32px;height:32px;"/></a></div>
</div>
<h1 id="logo"><a href="<?php echo $this->getWowUrl(); ?>">World of Warcraft</a></h1>
<div class="header-plate">
<?php echo $this->region('main_menu'); ?>
<div class="user-plate ajax-update">
<?php if (!$this->c('AccountManager')->isLoggedIn()) : ?>
<a href="?login" class="card-login"
onclick="BnetAds.trackImpression('Battle.net Login', 'Character Card', 'New'); return Login.open('<?php echo $this->getAppUrl('login/login.frag'); ?>');">
<?php echo $l->getString('template_userbox_auth_caption'); ?>
</a>
<div class="card-overlay"></div>
</div>
<?php elseif (!$this->c('AccountManager')->isHaveAnyCharacters()) : ?>
<div class="card-nochars">
<div class="player-name"><?php echo $this->c('AccountManager')->user('username'); ?></div>
<?php echo $l->getString('template_characters_not_found'); ?>
</div>
<?php else : ?>
<div id="user-plate" class="card-character plate-<?php echo $this->c('AccountManager')->charInfo('faction_text'); ?> ajax-update" style="background: url(/wow/static/images/2d/card/<?php echo $this->c('AccountManager')->charInfo('race') . '-' . $this->c('AccountManager')->charInfo('gender'); ?>.jpg) 0 100% no-repeat;">
<a href="<?php echo $this->getWowUrl('character/' . $this->c('AccountManager')->charInfo('realmName') . '/' . $this->c('AccountManager')->charInfo('name')); ?>" rel="np" class="profile-link">
<span class="hover"></span>
</a>
<div class="meta">
<div class="player-name"><?php echo $this->c('AccountManager')->user('username'); ?></div>
<?php echo $this->region('user_characters'); ?>
</div>
</div>
<?php endif; ?>
</div>
<?php if (!$this->c('AccountManager')->isBanned() && $this->c('AccountManager')->user('id')) { ?>
<div style="position:fixed;right:0;top:150px;width:137px;" id="tabone">
<!-- BEGIN PHP Live! code, (c) OSI Codes Inc. --><span id="phplive_btn_1337210059" onclick="phplive_launch_chat_0(0)" style="color: #0000FF; text-decoration: underline; cursor: pointer;"></span><script type="text/javascript">(function() { var phplive_e_1337210059 = document.createElement("script") ; phplive_e_1337210059.type = "text/javascript" ; phplive_e_1337210059.async = true ; phplive_e_1337210059.src = "http://live.serverwow.com/js/phplive_v2.js.php?q=0|1337210059|1|" ; document.getElementById("phplive_btn_1337210059").appendChild( phplive_e_1337210059 ) ; })() ;</script><!-- END PHP Live! code, (c) OSI Codes Inc. -->
</div>
<?php } ?>
</script>
<div style="position:fixed;right:0;bottom:220px;width:37px;z-index:1000;" id="tabtwo">
	<a target="_blank" href="http://www.youtube.com/user/ServerW0W">
		<img border="0" src="/custom_files/youtube.png" width="37" height="37" title="Síguenos en YouTube" alt="Síguenos en YouTube" />
	</a>
</div>
<div style="position:fixed;right:0;bottom:180px;width:37px;z-index:1000;" id="tabthree">
	<a target="_blank" href="https://twitter.com/#!/n4ch3/lcv">
		<img border="0" src="/custom_files/twitter.png" width="37" height="37" title="Síguenos en Twitter" alt="Síguenos en Twitter" />
	</a>
</div>
<div style="position:fixed;right:0;bottom:140px;width:37px;z-index:1000;" id="tabfour">
	<a target="_blank" href="http://www.facebook.com/ServerWoW">
		<img border="0" src="/custom_files/facebook.png" width="37" height="37" title="Siguenos en Facebook" alt="Siguenos en Facebook" />
	</a>
</div>
<div style="position:fixed;right:0;bottom:100px;width:37px;z-index:1000;" id="tabfive">
	<a target="_blank" href="https://plus.google.com/117818722165936859038">
		<img border="0" src="/custom_files/delicious.png" width="37" height="37" title="Síguenos en Google Plus" alt="Síguenos en Google Plus" />
	</a>
</div>