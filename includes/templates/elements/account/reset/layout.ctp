<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es">
<head>
<title>¿No puedes iniciar sesión? - Battle.net</title>
<meta content="false" http-equiv="imagetoolbar" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<link rel="shortcut icon" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/images/favicons/bam.ico" type="image/x-icon"/>
<link rel="search" type="application/opensearchdescription+xml" href="http://eu.battle.net/es-es/data/opensearch" title="Búsqueda eb Battle.net" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/css/common.css?v37" />
<!--[if IE]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/css/common-ie.css?v37" />
<![endif]-->
<!--[if IE 6]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/css/common-ie6.css?v37" />
<![endif]-->
<!--[if IE 7]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/css/common-ie7.css?v37" />
<![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet.css?v23" />
<link rel="stylesheet" type="text/css" media="print" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet-print.css?v23" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/cant-login/cant-login.css?v23" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/cant-login/cant-login-ie6.css?v23" /><![endif]-->
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet-ie.css?v23" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet-ie6.css?v23" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet-ie7.css?v23" /><![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/css/locale/es-es.css?v37" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/locale/es-es.css?v23" />
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/jquery.js?v37"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/core.js?v37"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/tooltip.js?v37"></script>
<!--[if IE 6]> <script type="text/javascript">
//<![CDATA[
try { document.execCommand('BackgroundImageCache', false, true) } catch(e) {}
//]]>
</script>
<![endif]-->
<script type="text/javascript">
//<![CDATA[
Core.staticUrl = '<?php echo CLIENT_FILES_PATH; ?>/account';
Core.sharedStaticUrl= '<?php echo CLIENT_FILES_PATH; ?>/account/local-common';
Core.baseUrl = '<?php echo CLIENT_FILES_PATH; ?>/account';
Core.projectUrl = '<?php echo CLIENT_FILES_PATH; ?>/account';
Core.cdnUrl = 'http://eu.media.blizzard.com';
Core.supportUrl = 'http://eu.battle.net/support/';
Core.secureSupportUrl= 'https://eu.battle.net/support/';
Core.project = 'bam';
Core.locale = 'es-es';
Core.language = 'es';
Core.buildRegion = 'eu';
Core.region = 'eu';
Core.shortDateFormat= 'dd/MM/yyyy';
Core.dateTimeFormat = 'dd/MM/yyyy HH:mm';
Core.loggedIn = false;
Flash.videoPlayer = 'http://eu.media.blizzard.com/global-video-player/themes/bam/video-player.swf';
Flash.videoBase = 'http://eu.media.blizzard.com/bam/media/videos';
Flash.ratingImage = 'http://eu.media.blizzard.com/global-video-player/ratings/bam/es-es.jpg';
Flash.expressInstall= 'http://eu.media.blizzard.com/global-video-player/expressInstall.swf';
//]]>
</script>
</head>
<body class="es-es">
<div id="layout-top">
<div class="wrapper">
<div id="header">
<div id="search-bar">
<form action="<?php echo $this->GetWowUrl('search'); ?>" method="get" id="search-form">
<div>
<input type="text" name="q" id="search-field" value="Buscar en Battle.net" maxlength="35" alt="Buscar en Battle.net" tabindex="50" accesskey="q" />
<input type="submit" id="search-button" value="" title="Buscar en Battle.net" tabindex="50" />
</div>
</form>
</div>
<h1 id="logo"><a href="/" tabindex="50" accesskey="h">Battle.net</a></h1>
<div id="navigation">
<div id="page-menu" class="large">
<h2 class="isolated"><a href="/account/support/login-support.html"> ¿No puedes iniciar sesión?
</a></h2>
<span class="clear"></span>
</div>
<span class="clear"></span>
</div>
</div>
<div id="service">
<ul class="service-bar">
<li class="service-cell service-home"><a href="http://eu.battle.net/" tabindex="50" accesskey="1" title="Battle.net"> </a></li>
<li class="service-cell service-welcome">
<a href="?login" onclick="return Login.open()">Inicia sesión</a> o <a href="https://eu.battle.net/account/creation/tos.html">Crea una cuenta</a>
</li>
<li class="service-cell service-account"><a href="https://eu.battle.net/account/management/" class="service-link" tabindex="50" accesskey="3">Cuenta</a></li>
<li class="service-cell service-support service-support-enhanced">
<a href="#support" class="service-link service-link-dropdown" tabindex="50" accesskey="4" id="support-link" onclick="return false" style="cursor: progress" rel="javascript">Asistencia<span class="no-support-tickets" id="support-ticket-count"></span></a>
<div class="support-menu" id="support-menu" style="display:none;">
<div class="support-primary">
<ul class="support-nav">
<li>
<a href="http://eu.blizzard.com/support/" tabindex="55" class="support-category">
<strong class="support-caption">Artículos de asistencia</strong>
Explorar base de datos
</a>
</li>
<li>
<a href="https://eu.battle.net/support/ticket/submit" tabindex="55" class="support-category">
<strong class="support-caption">Hacer una pregunta</strong>
Consigue ayuda de nuestros agentes
</a>
</li>
<li>
<a href="https://eu.battle.net/support/ticket/status" tabindex="55" class="support-category">
<strong class="support-caption">Tus consultas</strong>
Ver historial completo de tus consultas (debes iniciar sesión).
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
<a href="#explore" tabindex="50" accesskey="5" class="dropdown" id="explore-link" onclick="return false" style="cursor: progress" rel="javascript">Explorar</a>
<div class="explore-menu" id="explore-menu" style="display:none;">
<div class="explore-primary">
<ul class="explore-nav">
<li>
<a href="/" tabindex="55" data-label="Home">
<strong class="explore-caption">Battle.net</strong>
Conecta. Juega. Une.
</a>
</li>
<li>
<a href="<?php echo CLIENT_FILES_PATH; ?>/account/management/" tabindex="55" data-label="Account">
<strong class="explore-caption">Cuenta</strong>
Gestiona tu cuenta
</a>
</li>
<li>
<a href="http://eu.blizzard.com/support/" tabindex="55" data-label="Support">
<strong class="explore-caption">Asistencia</strong>
Consigue asistencia
</a>
</li>
<li>
<a href="https://eu.battle.net/account/management/get-a-game.html" tabindex="55" data-label="Buy Games">
<strong class="explore-caption">Comprar juegos</strong>
Juegos en soporte digital para descargar
</a>
</li>
</ul>
<div class="explore-links">
<h2 class="explore-caption">Más</h2>
<ul>
<li><a href="http://eu.battle.net/what-is/" tabindex="55" data-label="More">¿Qué es Battle.net?</a></li>
<li><a href="http://eu.battle.net/realid/" tabindex="55" data-label="More">¿Qué es ID Real?</a></li>
<li><a href="https://eu.battle.net/account/parental-controls/index.html" tabindex="55" data-label="More">Control paterno</a></li>
<li><a href="http://eu.battle.net/security/" tabindex="55" data-label="More">Seguridad de cuentas</a></li>
<li><a href="http://eu.battle.net/games/classic" tabindex="55" data-label="More">Juegos clásicos</a></li>
<li><a href="https://eu.battle.net/account/support/index.html" tabindex="55" data-label="More">Asistencia de cuentas</a></li>
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
<a href="http://eu.battle.net/sc2/" tabindex="55" data-label="Game - sc2">
<span class="explore-game-inner">
<strong class="explore-caption">StarCraft II</strong>
<span>Noticias y Foros</span> <span>Guía para principiantes</span> <span>Perfil de jugador</span> <span>…</span>
</span>
</a>
</li>
<li class="explore-game explore-game-wow">
<a href="<?php echo $this->GetWowUrl(); ?>" tabindex="55" data-label="Game - wow">
<span class="explore-game-inner">
<strong class="explore-caption">World of Warcraft</strong>
<span>Perfil de personaje</span> <span>Noticias y Foros</span> <span>Guía de juego</span> <span>…</span>
</span>
</a>
</li>
<li class="explore-game explore-game-d3">
<a href="http://eu.battle.net/d3/" tabindex="55" data-label="Game - d3">
<span class="explore-game-inner">
<strong class="explore-caption">Diablo III</strong>
<span>Guía de juego</span> <span>Noticias sobre la beta</span> <span>Foros</span> <span>…</span>
</span>
</a>
</li>
</ul>
</div>
</li>
</ul>
<div id="warnings-wrapper">
<!--[if lt IE 8]> <div id="browser-warning" class="warning warning-red">
<div class="warning-inner2">
No estás utilizando la última versión de tu navegador.<br />
<a href="http://eu.blizzard.com/support/article/browserupdate">Actualizar</a> o <a href="http://www.google.com/chromeframe/?hl=es-ES" id="chrome-frame-link">instalar Google Chrome Frame</a>.
<a href="#close" class="warning-close" onclick="App.closeWarning('#browser-warning', 'browserWarning'); return false;"></a>
</div>
</div>
<![endif]-->
<!--[if lt IE 8]> <script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/CFInstall.min.js?v37"></script>
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
Debes tener activado JavaScript para utilizar esta página.
</div>
</div>
</noscript>
</div>
</div>
</div>
</div>
<div id="layout-middle">
<div class="wrapper">
<div id="content">
<?php
$errors = $this->core->getDataVar('errors');
if ($errors > 0) :
?>
<div class="alert error closeable border-4 glow-shadow">
<div class="alert-inner">
<div class="alert-message">
<p class="title"><strong>Se ha producido un error.</strong></p>
<?php if ($errors & 2) : ?>
<p class="error.invalid.combination">No existe esta combinación nombre/correo electrónico.</p>
<?php endif;
if ($errors & 4) : ?>
<p class="error.captcha.failed">El código de seguridad introducido no es válido. Vuelve a intentarlo.</p>
<?php endif; ?>
</div>
</div>
<a class="alert-close" href="#" onclick="$(this).parent().fadeOut(250, function() { $(this).css({opacity:0}).animate({height: 0}, 100, function() { $(this).remove(); }); }); return false;">Cerrar</a>
<span class="clear"><!-- --></span>
</div>
<?php endif; ?>
<div id="page-header">
<span class="float-right"><span class="form-req">*</span> Obligatorio</span>
<h2 class="subcategory">Recuperación de contraseña</h2>
<h3 class="headline">Información sobre la cuenta de Battle.net&#160;&#160;&#160;</h3>
</div>
<?php
$success = $this->core->getDataVar('success');
$failed = $this->core->getDataVar('failed');
if ($success) : ?>
<div class="alert-page">
<div class="alert-page-message success-page">
<p class="text-green title"><strong><?php echo $l->getString('template_password_recovery_success_title'); ?></strong></p>
<p class="caption"><?php echo $l->getString('template_password_recovery_success_body'); ?></p>
<p class="caption"><a href="<?php echo $this->getCoreUrl('account/management/'); ?>"><?php echo $l->getString('template_account_change_pass_success_t2'); ?></a></p>
</div>
</div>
<?php elseif ($failed) : ?>
<div class="alert-page">
<div class="alert-page-message error-page">
<p class="text-green title"><strong><?php echo $l->getString('template_password_recovery_failed_title'); ?></strong></p>
<p class="caption"><?php echo $l->getString('template_password_recovery_failed_body'); ?></p>
<p class="caption"><a href="<?php echo $this->getCoreUrl('account/support/password-reset.html'); ?>"><?php echo $l->getString('template_password_recovery_failed_back'); ?></a></p>
</div>
</div>
<?php else : ?>
<p>Introduce tus datos en los campos correspondientes para restablecer una contraseña olvidada o el acceso a una cuenta que ha sido bloqueada por motivos de seguridad.&#160;&#160;<span class="locked-tip"><a data-tooltip="Si has recibido un e-mail nuestro informando de que tu cuenta ha sido bloqueada, tendrás que restablecer la contraseña para volver a tener acceso a tu cuenta. Normalmente, se envía este e-mail por actividad sospechosa en tu cuenta." data-tooltip-options='{"location": "mouse"}'><img height='16' width='16' src='/account/images/icons/tooltip-help.gif' alt=''/>&#160;&#160;</a></span></p>
<form method="post" action="<?php echo CLIENT_FILES_PATH; ?>/account/support/password-reset.html" id="support-form">
<input type="hidden" name="csrftoken" value="128871cc-6ca4-41cc-94c5-de0f87913a32" />
<div class="form-row required">
<label for="email" class="label-full ">
<strong> Cuenta de Battle.net (dirección de e-mail):
</strong>
<span class="form-required">*</span>
</label>
<input type="text" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" class="input border-5 glow-shadow-2 
" maxlength="150" tabindex="1" />
</div>
<div class="form-row required">
<label class="label-full">
<strong></strong>
<span class="form-required"></span>
</label>
<span class="form-right">
<style type="text/css">
#recaptcha_response_field input{width:145px !important;}
#recaptcha_response_field {width:145px !important;}
</style>
<?php
require_once(SITE_CLASSES_DIR . 'recaptchalib.php');
$publickey = "6LcZjsoSAAAAAPYGkJOTrHl_j_4zS6S9Chcyh2m6"; // you got this from the signup page
echo recaptcha_get_html($publickey);
?>
</span>
</div>
<fieldset class="ui-controls " >
<button
class="ui-button button1 disabled"
type="submit"
disabled="disabled"
id="support-submit"
tabindex="1"
>
<span>
<span>Continuar</span>
</span>
</button>
</fieldset>
</form>
<?php endif; ?>
</div>
</div>
</div>
<div id="layout-bottom">
<div class="wrapper">
<div id="footer">
<div id="sitemap">
<div class="column">
<h3 class="bnet">
<a href="<?php echo CLIENT_FILES_PATH; ?>/" tabindex="100">Battle.net</a>
</h3>
<ul>
<li><a href="http://eu.battle.net/what-is/">¿Qué es Battle.net?</a></li>
<li><a href="https://eu.battle.net/account/management/get-a-game.html">Adquirir juegos</a></li>
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
<li><a href="http://eu.battle.net/d3/">Diablo III</a></li>
<li><a href="http://eu.battle.net/games/classic">Juegos clásicos</a></li>
<li><a href="https://eu.battle.net/account/download/">Descarga de juegos</a></li>
</ul>
</div>
<div class="column">
<h3 class="account">
<a href="https://eu.battle.net/account/management/" tabindex="100">Cuenta</a>
</h3>
<ul>
<li><a href="https://eu.battle.net/account/support/login-support.html">¿No puedes iniciar sesión?</a></li>
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
<li><a href="http://eu.blizzard.com/support/">Artículos de asistencia</a></li>
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
</div>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/search.js?v37"></script>
<script type="text/javascript">
//<![CDATA[
var xsToken = '';
var Msg = {
support: {
ticketNew: 'Se ha creado la consulta nº{0}.',
ticketStatus: 'El estado de tu consulta nº{0} se ha cambiado a {1}.',
ticketOpen: 'Abierta',
ticketAnswered: 'Respondida',
ticketResolved: 'Resuelta',
ticketCanceled: 'Cancelada',
ticketArchived: 'Archivado',
ticketInfo: 'Se necesita más información',
ticketAll: 'Ver todas las consultas'
},
cms: {
requestError: 'Tu petición no puede ser llevada a cabo.',
ignoreNot: 'No has bloqueado a este usuario.',
ignoreAlready: 'Ya has bloqueado a este usuario.',
stickyRequested: 'Realizada petición de adhesivo.',
stickyHasBeenRequested: 'Ya has realizado una petición de adhesivo para este asunto.',
postAdded: 'Comentario añadido al rastreador.',
postRemoved: 'Comentario eliminado del rastreador.',
userAdded: 'Usuario añadido al rastreador.',
userRemoved: 'Usuario eliminado del rastreador.',
validationError: 'Campo obligatorio sin cumplimentar.',
characterExceed: 'El cuerpo del comentario supera los XXXXXX caracteres.',
searchFor: "Buscar",
searchTags: "Artículos etiquetados:",
characterAjaxError: "Es posible que estés desconectado. Por favor, actualiza la página y vuelve a intentarlo.",
ilvl: "Nivel {0}",
shortQuery: "La búsqueda debe contener al menos 2 caracteres"
},
bml: {
bold: 'Negrita',
italics: 'Cursiva',
underline: 'Subrayar',
list: 'Lista sin orden',
listItem: 'Lista enumerada',
quote: 'Citar',
quoteBy: 'Publicado por {0}',
unformat: 'Elminar formato',
cleanup: 'Corregir saltos de líneas',
code: 'Bloques de código',
item: 'Objeto de WoW',
itemPrompt: 'Número de objeto:',
url: 'URL',
urlPrompt: 'Dirección de URL:'
},
ui: {
submit: 'Enviar',
cancel: 'Cancelar',
reset: 'Restablecer',
viewInGallery: 'Ver en galería',
loading: 'Cargando…',
unexpectedError: 'Se ha producido un error',
fansiteFind: 'Buscar en…',
fansiteFindType: 'Buscar {0} en…',
fansiteNone: 'Ningún fansite disponible.'
},
grammar: {
colon: '{0}:',
first: 'Primera',
last: 'Última'
},
fansite: {
achievement: 'logro',
character: 'personaje',
faction: 'facción',
'class': 'clase',
object: 'objeto',
talentcalc: 'talentos',
skill: 'profesión',
quest: 'misión',
spell: 'hechizo',
event: 'evento',
title: 'título',
arena: 'equipo de Arenas',
guild: 'hermandad',
zone: 'zona',
item: 'objeto',
race: 'raza',
npc: 'PNJ',
pet: 'mascota'
},
search: {
kb: 'Asistencia',
post: 'Foros',
article: 'Artículos',
static: 'Contenido',
wowcharacter: 'Personaje',
wowitem: 'Objeto',
wowguild: 'Hermandades',
wowarenateam: 'Equipos de Arenas',
other: 'Otros'
}
};
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
Core.load("<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/jquery-ui-1.8.6.custom.min.js?v37");
Core.load("<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/login.js?v37", false, function() {
Login.embeddedUrl = '<?php echo CLIENT_FILES_PATH; ?>/login/login.frag';
});
//]]>
</script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/bam.js?v23"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/tooltip.js?v37"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/menu.js?v37"></script>
<script type="text/javascript">
$(function() {
Menu.initialize();
Menu.config.colWidth = 190;
Locale.dataPath = 'data/i18n.frag.xml';
});
</script>
<!--[if lt IE 8]>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/jquery.pngFix.pack.js?v37"></script>
<script type="text/javascript">$('.png-fix').pngFix();</script>
<![endif]-->
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/cant-login/cant-login.js?v23"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/support/validation.js?v23"></script>
<!--[if lt IE 8]> <script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/jquery.pngFix.pack.js?v37"></script>
<script type="text/javascript">
//<![CDATA[
$('.png-fix').pngFix(); //]]>
</script>
<![endif]-->
</body>
</html>