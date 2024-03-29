<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Server WoW - Server de World of Warcraft : Iniciar sesión</title>
<meta name="description" content="Ingresa con tu Cuenta de Server WoW, y personaliza tu Cuenta, Server de Warcraft">
<meta name="keywords" content="wow, juegos, multijugador masivo, world of warcraft, blizzlike, cataclysm, wotlk, server, privado">
<meta http-equiv="imagetoolbar" content="false"/>
<link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/local-common/css/common.css?v22"/>
<!--[if IE]><link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/local-common/css/common-ie.css?v22"/><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/local-common/css/common-ie6.css?v22"/><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/local-common/css/common-ie7.css?v22"/><![endif]-->
<link rel="shortcut icon" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/_themes/bam/img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/_themes/bam/css/master.css?v1"/>
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/_themes/bam/css/master-ie6.css?v1" /><![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/_themes/bam/css/_lang/es-es.css?v1"/>
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/_themes/store/css/_lang/es-es-ie6.css?v1" /><![endif]-->
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/login/static/local-common/js/third-party/jquery-1.4.4-p1.min.js"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/login/static/local-common/js/core.js?v22"></script>
<script type="text/javascript">
Core.baseUrl = '<?php echo $this->getCoreUrl('login/'); ?>';
</script>
</head>
<body class="es-es">
<div id="wrapper">
<h1 id="logo"><a href="<?php echo $this->getCoreUrl(); ?>">ServerWoW.com</a></h1>
<div id="content" class="login">
<?php
$loginError = $this->c('AccountManager')->getErrorCode();
if ($loginError != ERROR_NONE) : ?>
	<div id="errors">
		<ul>
			<?php if ($loginError & ERROR_EMPTY_USERNAME) echo '<li>' . $l->getString('login_error_empty_username_title') . '</li>'; ?>
			<?php if ($loginError & ERROR_EMPTY_PASSWORD) echo '<li>' . $l->getString('login_error_empty_password_title') . '</li>'; ?>
			<?php if ($loginError & ERROR_WRONG_USERNAME_OR_PASSWORD) echo '<li>' . $l->getString('login_error_wrong_username_or_password_title') . '</li>'; ?>
			<?php if ($loginError & ERORR_INVALID_PASSWORD_FORMAT) echo '<li>' . $l->getString('login_error_invalid_password_format_title') . '</li>'; ?>
			<?php if ($loginError & ERROR_RECAPTCHA_FAILED) echo '<li>' . $l->getString('login_error_invalid_captcha') . '</li>'; ?>
			<?php if ($loginError & ERROR_USERNAME_BANNED) echo '<li>' . $l->getString('login_error_username_banned') . '</li>'; ?>
		</ul>
	</div>
<?php endif; ?>
<div id="left">
<h2>Iniciar sesión</h2>
<form method="post" id="form" action="">
<p><label for="accountName" class="label">Nombre de Usuario</label>
<input id="accountName" value="<?php if (isset($_POST['accountName'])) echo $_POST['accountName']; ?>" name="accountName" maxlength="320" type="text" tabindex="1" class="input" /></p>
<p><label for="password" class="label">Contraseña</label>
<input id="password" name="password" maxlength="16" type="password" tabindex="2" autocomplete="off" class="input"/></p>
<p>
<p>
<?php
if ($this->c('AccountManager')->getLoginErrorsCount() >= 3)
{
	require_once(SITE_CLASSES_DIR . 'recaptchalib.php');
	$publickey = "6LcZjsoSAAAAAPYGkJOTrHl_j_4zS6S9Chcyh2m6"; // you got this from the signup page
	echo recaptcha_get_html($publickey);
}
?>
</p>
<span id="remember-me">
<label for="persistLogin">
<input type="checkbox" checked="checked" name="persistLogin" id="persistLogin" />
Seguir conectado
</label>
</span>
<button
class="ui-button button1 "
type="submit"
data-text="Procesando…"
>
<span>
<span>Iniciar sesión</span>
</span>
</button>
</p>
</form>
<ul id="help-links">
<li class="icon-pass">
¿No puedes <a href="http://serverwow.com/account/support/password-reset.html">iniciar sesión</a>?
</li>
<li class="icon-secure">
Más información sobre cómo <a href="">proteger tu cuenta</a>.
</li>
<li class="icon-signup">
¿Aún no tienes una cuenta? ¡<a href="http://serverwow.com/account/creation/">Regístrate ya</a>!
</li>
</ul>
</div>
<div id="right">
<h2>¿Necesitas una cuenta?</h2>
<h3>Crear una cuenta de ServerWoW.com es rápido, sencillo y gratis.</h3>
<a
class="ui-button button1 "
href="http://serverwow.com/account/creation/"
>
<span>
<span>Crear una cuenta</span>
</span>
</a>
</div>
<span class="clear"><!-- --></span>
<script type="text/javascript">
$(function() {
$('#accountName').focus();
});
</script>
</div>
<div id="footer">
<?php
/*
<div style="position:fixed;right:0;top:100px;width:137px;" id="tabfive">
<!-- BEGIN PHP Live! code, (c) OSI Codes Inc. --><a href="https://live.serverwow.com/phplive.php?d=4" target="new"><img src="https://live.serverwow.com/ajax/image.php?d=4" border=0></a><!-- END PHP Live! code, (c) OSI Codes Inc. -->
</div>	

<div id="sitemap" class="promotions">
<div class="column">
<h3 class="bnet">
<a href="<?php echo CLIENT_FILES_PATH; ?>/" tabindex="100"><?php echo $l->getString('template_footer_home_title'); ?></a>
</h3>
<ul>
<li><a href="server-wow"><?php echo $l->getString('template_footer_home_link1'); ?></a></li>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/account/management/"><?php echo $l->getString('template_footer_home_link4'); ?></a></li>
<li><a href="refund"><?php echo $l->getString('template_footer_home_link5'); ?></a></li>
<li><a href="privacy"><?php echo $l->getString('template_footer_home_link6'); ?></a></li>
</ul>
</div>
<div class="column">
<h3 class="games">
<a href="<?php echo CLIENT_FILES_PATH; ?>" tabindex="100"><?php echo $l->getString('template_footer_games_title'); ?></a>
</h3>
<ul>
<li><a href="http://serverwow.com/wow/forum/39/"><?php echo $l->getString('template_footer_games_link1'); ?></a></li>
<li><a href="http://serverwow.com/wow/forum/40/"><?php echo $l->getString('template_footer_games_link2'); ?></a></li>
<li><a href="http://serverwow.com/wow/forum/43/"><?php echo $l->getString('template_footer_games_link3'); ?></a></li>
<li><a href="http://serverwow.com/wow/forum/44/"><?php echo $l->getString('template_footer_games_link4'); ?></a></li>
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
<a href="" tabindex="100"><?php echo $l->getString('template_footer_support_title'); ?></a>
</h3>
<ul>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/wow/forum/"><?php echo $l->getString('template_footer_support_link1'); ?></a></li>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/wow/bugtracker/"><?php echo $l->getString('template_footer_support_link2'); ?></a></li>
</ul>
</div>
*/
?>
<br><br><br><br>
</div>
<div id="copyright">
<a href="javascript:;" tabindex="100" id="change-language">
<span><?php echo $l->getString('locale_region') . ' - ' . $l->getString('locale_name'); ?></span>
</a>
<?php echo $l->getString('copyright_bottom_title'); ?>
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
var src = 'https://www.google.com/chromeframe/?hl=es-ES';
if ('http:' == document.location.protocol) {
src = 'http://www.google.com/chromeframe/?hl=es-ES';
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
</body>
</html>
