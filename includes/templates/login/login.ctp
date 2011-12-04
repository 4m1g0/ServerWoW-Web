<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Inicia sesión en tu cuenta de Battle.net</title>
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
<h1 id="logo"><a href="<?php echo $this->getCoreUrl(); ?>">Battle.net</a></h1>
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
Más información sobre cómo <a href="http://eu.battle.net/security/">proteger tu cuenta</a>.
</li>
<li class="icon-signup">
¿Aún no tienes una cuenta? ¡<a href="<?php echo $this->getCoreUrl('account/creation/'); ?>">Regístrate ya</a>!
</li>
</ul>
</div>
<div id="right">
<h2>¿Necesitas una cuenta?</h2>
<h3>Crear una cuenta de Battle.net es rápido, sencillo y gratis.</h3>
<a
class="ui-button button1 "
href="<?php echo $this->getCoreUrl('account/creation/'); ?>"
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
<div id="sitemap">
<div class="column">
<h3 class="bnet">
<a href="http://eu.battle.net/" tabindex="100">Battle.net</a>
</h3>
<ul>
<li><a href="http://eu.battle.net/what-is/">¿Qué es Battle.net?</a></li>
<li><a href="https://eu.battle.net/account/management/get-a-game.html">Adquirir juegos</a></li>
<li><a href="http://eu.battle.net/sc2/community/esports/">e-Sports</a></li>
<li><a href="https://eu.battle.net/account/management/">Cuenta</a></li>
<li><a href="http://eu.blizzard.com/support/">Asistencia</a></li>
<li><a href="http://eu.battle.net/realid/">ID Real</a></li>
</ul>
</div>
<div class="column">
<h3 class="games">
<a href="http://eu.battle.net/" tabindex="100">Juegos</a>
</h3>
<ul>
<li><a href="http://eu.battle.net/sc2/">StarCraft II</a></li>
<li><a href="http://eu.battle.net/wow/">World of Warcraft</a></li>
<li><a href="http://eu.battle.net/d3">Diablo III</a></li>
<li><a href="http://eu.battle.net/games/classic">Juegos clásicos</a></li>
<li><a href="https://eu.battle.net/account/download/">Descarga de juegos</a></li>
</ul>
</div>
<div class="column">
<h3 class="account">
<a href="https://eu.battle.net/account/management/" tabindex="100">Cuenta</a>
</h3>
<ul>
<li><a href="https://eu.battle.net/account/support/password-reset.html">¿No puedes iniciar sesión?</a></li>
<li><a href="https://eu.battle.net/account/creation/tos.html">Crear cuenta</a></li>
<li><a href="https://eu.battle.net/account/management/">Resumen de cuenta</a></li>
<li><a href="https://eu.battle.net/account/management/authenticator.html">Seguridad de cuentas</a></li>
<li><a href="https://eu.battle.net/account/management/add-game.html">Añadir juego</a></li>
<li><a href="https://eu.battle.net/account/management/redemption/redeem.html">Canjear código de promoción</a></li>
</ul>
</div>
<div class="column">
<h3 class="support">
<a href="http://eu.blizzard.com/support/" tabindex="100">Asistencia</a>
</h3>
<ul>
<li><a href="http://eu.blizzard.com/support/">Artículos de Asistencia</a></li>
<li><a href="https://eu.battle.net/account/parental-controls/index.html">Control paterno</a></li>
<li><a href="http://eu.battle.net/security/">Protege tu cuenta</a></li>
<li><a href="http://eu.battle.net/security/help">¡Ayuda, me han pirateado!</a></li>
</ul>
</div>
<span class="clear"><!-- --></span>
</div>
<div id="copyright">
<a href="javascript:;" tabindex="100" id="change-language">
<span>Europa - Español (EU)</span>
</a>
©2011 Blizzard Entertainment, Inc. Todos los derechos reservados
<a onclick="return Core.open(this);" href="http://eu.blizzard.com/company/about/termsofuse.html" tabindex="100">Condiciones de Uso</a>
<a onclick="return Core.open(this);" href="http://eu.blizzard.com/company/legal/" tabindex="100">Legal</a>
<a onclick="return Core.open(this);" href="http://eu.blizzard.com/company/about/privacy.html" tabindex="100">Protección de datos</a>
<a onclick="return Core.open(this);" href="http://eu.blizzard.com/company/about/infringementnotice.html" tabindex="100">Derechos de autor</a>
</div>
<div id="international"></div>
<div id="legal">
<span class="clear"><!-- --></span>
</div>
</div>
</div>
</body>
</html>
