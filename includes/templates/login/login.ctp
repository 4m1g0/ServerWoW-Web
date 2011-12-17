<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ServerWoW : Inicia sesión con tu cuenta de WoW</title>
<meta name="description" content="ServerWoW Ingresa con tu Cuenta de World of Warcraft, y personaliza tu Cuenta">
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
		</ul>
	</div>
<?php endif; ?>
<div id="left">
<h2>Iniciar sesión</h2>
<form method="post" id="form" action="">
<p><label for="accountName" class="label">Dirección de e-mail</label>
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
¿No puedes <a href="<?php echo $this->getCoreUrl('account/support/password-reset.html'); ?>">iniciar sesión</a>?
</li>
<li class="icon-secure">
Más información sobre cómo <a href="">proteger tu cuenta</a>.
</li>
<li class="icon-signup">
¿Aún no tienes una cuenta? ¡<a href="<?php echo $this->getCoreUrl('account/creation/'); ?>">Regístrate ya</a>!
</li>
</ul>
</div>
<div id="right">
<h2>¿Necesitas una cuenta?</h2>
<h3>Crear una cuenta de ServerWoW.com es rápido, sencillo y gratis.</h3>
<a
class="ui-button button1 "
href="<?php echo $this->getCoreUrl('account/creation/'); ?>"
>
<span>
<span>Crear una cuenta</span>
</span>
</a>
<br><br>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Login 336&#42;280) */
google_ad_slot = "0980210044";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<span class="clear"><!-- --></span>
<script type="text/javascript">
$(function() {
$('#accountName').focus();
});
</script>
</div>
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
<a href="http://eu.blizzard.com/support/" tabindex="100"><?php echo $l->getString('template_footer_support_title'); ?></a>
</h3>
<ul>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/wow/forum/"><?php echo $l->getString('template_footer_support_link1'); ?></a></li>
<li><a href="<?php echo CLIENT_FILES_PATH; ?>/wow/bugtracker/"><?php echo $l->getString('template_footer_support_link2'); ?></a></li>
</ul>
</div>

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
</body>
</html>
