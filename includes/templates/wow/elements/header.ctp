<div class="search-bar">
<form action="<?php echo $this->getWowUrl('search'); ?>" method="get" autocomplete="off">
<div>
<input type="text" class="search-field input" name="q" id="search-field" maxlength="200" tabindex="40" alt="Buscar en la armeria, foro y mas…" value="Buscar en la armeria, foro y mas…" />
<input type="submit" class="search-button" value="" tabindex="41" />
</div>
</form>
<g:plusone></g:plusone>
<div><a href="https://plus.google.com/117818722165936859038?prsrc=3" style="text-decoration:none;"><img src="https://ssl.gstatic.com/images/icons/gplus-32.png" alt="" style="border:0;width:32px;height:32px;"/></a></div>
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
<div style="width:38px;height: 117px;position:fixed;right: 0pt; top: 33%; z-index: 99999;">
<a href="http://www.facebook.com/ServerWoW" target="_blank" title="Sigueme en Facebook"><img src="http://serverwow.com/webroot/cms/hazte-fan_facebook.png" width="38" height="117" border="0" alt="Sigueme en Facebook" title="Sígueme en Facebook"></a>
</div>
<div style="width:39px;height: 179px;position:fixed;right: 0pt; top: 55%; z-index: 99999;">
<a href="https://twitter.com/#!/list/n4ch3/lcv" target="_blank" title="Sigueme en Twitter"><img src="http://serverwow.com/webroot/cms/naranja_twitter.png" width="39" height="179" border="0" alt="Sigueme en Twitter" title="Sigueme en Twitter" /></a>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'es'}
</script>
</div> 
