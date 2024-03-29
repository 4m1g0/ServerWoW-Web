<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<title><?php echo $l->getString('template_management_main_title'); ?></title>
<meta name="description" content="<?php echo $l->getString('template_management_main_description'); ?>">
<meta name="keywords" content="<?php echo $l->getString('template_management_main_keywords'); ?>">
<meta content="false" http-equiv="imagetoolbar" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<link rel="shortcut icon" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/images/favicons/bam.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" media="all" href="/account/local-common/css/common.css?v35" />
<!--[if IE]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/css/common-ie.css?v35" />
<![endif]-->
<!--[if IE 6]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/css/common-ie6.css?v35" />
<![endif]-->
<!--[if IE 7]> <link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/css/common-ie7.css?v35" />
<![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet.css?v23" />
<link rel="stylesheet" type="text/css" media="print" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet-print.css?v23" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/inputs.css?v23" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/inputs-ie6.css?v23" /><![endif]-->
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/inputs-ie.css?v23" /><![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/management/lobby.css?v23" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/management/dashboard.css?v23" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/management/wow/dashboard.css?v23" />
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="/account/css/management/wow/dashboard-ie.css?v23" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="/account/css/management/dashboard-ie6.css?v23" /><![endif]-->
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/management/lobby-ie.css?v23" /><![endif]-->
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet-ie.css?v23" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet-ie6.css?v23" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/bnet-ie7.css?v23" /><![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/css/locale/ru-ru.css?v35" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/locale/ru-ru.css?v23" />
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/jquery.js?v35"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/core.js?v35"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/tooltip.js?v35"></script>
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
Core.cdnUrl = 'http://serverwow.com';
Core.supportUrl = 'http://serverwow.com/wow/forum/9/';
Core.secureSupportUrl= 'https://serverwow.com/wow/forum/9/';
Core.project = 'wow';
Core.locale = '<?php echo $l->getLocale(LOCALE_DOUBLE); ?>';
Core.buildRegion = 'eu';
Core.shortDateFormat= 'dd/MM/yyyy';
Core.dateTimeFormat = 'dd/MM/yyyy HH:mm';
Core.loggedIn = false;
Flash.videoPlayer = '<?php echo CLIENT_FILES_PATH; ?>/wow/player/video-player.swf';
Flash.videoBase = '<?php echo CLIENT_FILES_PATH; ?>/wow/media/videos';
Flash.ratingImage = '<?php echo CLIENT_FILES_PATH; ?>/wow/player/rating-pegi.jpg';
Flash.expressInstall= '<?php echo CLIENT_FILES_PATH; ?>/wow/player/video-player.swf';
//]]>
</script>
<script type="text/javascript">
var phplive_v = new Object;
phplive_v["name"] = "<?php echo strtolower($this->c('AccountManager')->user('username')) ?>";
phplive_v["email"] = "<?php echo $this->c('AccountManager')->user('email') ?>";
phplive_v["Login"] = "<?php echo $this->c('AccountManager')->user('username') ?>";
phplive_v["CID"] = "<?php echo $this->c('AccountManager')->user('id') ?>";
</script>
</head>
<body class="<?php echo $l->getLocale(LOCALE_DOUBLE); ?> logged-in">
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=336076233078446";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="layout-top">
<div class="wrapper">
<div id="header">
<div id="search-bar">
<form action="<?php echo $this->getWowUrl('search'); ?>" method="get" id="search-form">
<div>
<input type="text" name="q" id="search-field" value="<?php echo $l->getString('template_search_site'); ?>" maxlength="35" alt="<?php echo $l->getString('template_search_site'); ?>" tabindex="50" accesskey="q" />
<input type="submit" id="search-button" value="" title="<?php echo $l->getString('template_search_site'); ?>" tabindex="50" />
</div>
</form>
</div>
<h1 id="logo"><a href="<?php echo $this->getAppUrl(); ?>" tabindex="50" accesskey="h">Server WoW</a></h1>
<div id="navigation">
<div id="page-menu" class="large">
<h2><a href="<?php echo $this->getAppUrl('account/management/'); ?>"> <?php echo $l->getString('template_management_account_management'); ?>
</a></h2>
<ul>
<li class="active">
<a href="<?php echo $this->getAppUrl('account/management/'); ?>" class="border-3"><?php echo $l->getString('template_management_menu_information'); ?></a>
<span></span>
</li>
<li>
<a href="#" class="border-3 menu-arrow" onclick="openAccountDropdown(this, 'settings'); return false;"><?php echo $l->getString('template_management_menu_parameters'); ?></a>
<span></span>
<div class="flyout-menu" id="settings-menu" style="display: none">
<ul>
<li><a href="<?php echo $this->getAppUrl('account/management/settings/change-password.html'); ?>"><?php echo $l->getString('template_management_menu_parameters_change_password'); ?></a></li>
<li><a href="<?php echo $this->getAppUrl('account/management/settings/forums.html'); ?>"><?php echo $l->getString('template_management_menu_parameters_forums_settings'); ?></a></li>
<li><a href="<?php echo $this->getAppUrl('account/management/settings/unstuck.html'); ?>"><?php echo $l->getString('template_management_menu_parameters_unstuck'); ?></a></li>
</ul>
</div>
</li>
<li>
<a href="#" class="border-3 menu-arrow" onclick="openAccountDropdown(this, 'payments'); return false;"><?php echo $l->getString('template_management_menu_payments'); ?></a>
<span></span>
<div class="flyout-menu" id="payments-menu" style="display: none">
<ul>
<li><a href="<?php echo $this->getAppUrl('account/management/payments'); ?>"><?php echo $l->getString('template_management_menu_parameters_payments_pp'); ?></a></li>
<li><a href="<?php echo $this->getAppUrl('account/management/smspayments'); ?>"><?php echo $l->getString('template_management_menu_parameters_payments_sms'); ?></a></li>
<li><a href="<?php echo $this->getAppUrl('account/management/otherpayments'); ?>"><?php echo $l->getString('template_management_menu_parameters_payments_other'); ?></a></li>
</ul>
</div>
</li>
<?php
if ($this->c('AccountManager')->isAllowedToReceiveMsg() || $this->c('AccountManager')->isAllowedToSendMsg()) : ?>
<li>
<a href="#" class="border-3 menu-arrow" onclick="openAccountDropdown(this, 'mailbox'); return false;"><?php echo $l->getString('template_management_menu_mail_caption'); ?></a>
<span></span>
<div class="flyout-menu" id="mailbox-menu" style="display: none">
<ul>
<?php if ($this->c('AccountManager')->isAllowedToReceiveMsg()) : ?><li><a href="<?php echo $this->getAppUrl('account/management/inbox'); ?>"><?php echo $l->getString('template_inbox_messages'); ?></a></li><?php endif; ?>
<?php if ($this->c('AccountManager')->isAllowedToSendMsg()) : ?>
<li><a href="<?php echo $this->getAppUrl('account/management/newmessage'); ?>"><?php echo $l->getString('template_create_new_message'); ?></a></li>
<li><a href="<?php echo $this->getAppUrl('account/management/sent'); ?>"><?php echo $l->getString('template_sent_messages'); ?></a></li>
<?php endif; ?>
</ul>
</div>
</li>
<?php endif; ?>
</ul>
<span class="clear"><!-- --></span>
</div>
<span class="clear"></span>
</div>
</div>
<div id="service">
<?php if ($this->issetRegion('service')) echo $this->region('service'); ?>
</div>
<div id="layout-middle">
<div class="wrapper">
<div id="content">
<?php echo $this->region('pagecontent'); ?>
<script type="text/javascript">
//<![CDATA[
var SecurityStrings = {
'PENDING' : {
'part1': 'Pending, call',
'part2': 'to set up the pin.'
},
'ERROR': {
'title': 'Error Battle.net Dial-in Authenticator Details',
'desc': 'We were unable to retrieve your Battle.net Dial-in Authenticator details.'
},
'EDIT': {
'cancel': 'Cancel Battle.net Dial-in Authenticator Enrollment',
'remove': 'Quitar'
}
};
var PaymentStrings = {
'NONE': {
'desc': 'Actualmente no hay formas de pago vinculadas a tu cuenta.',
'button': 'Añadir una forma de pago principal'
},
'GOOD': {
'desc': 'Importante: este método de pago puede ser diferente al que sueles utilizar para tu suscripción a World of Warcraft.',
'CREDIT_CARD': {
'title': 'Método de pago por defecto',
'label': 'Tarjeta de crédito',
'details': 'PAYMENTSUBTYPE que acaba en “XXX”',
'button': 'Editar'
},
'DIRECT_DEBIT': {
'title': 'Método de pago por defecto',
'label': 'Domiciliación bancaria',
'details': '',
'button': 'Editar'
}
},
'ERROR': {
'title': 'Error al cargar la información de pago.',
'desc': 'No hemos podido recibir tu información de pago.'
}
};
var GameId = {
'WOWT': ['World of Warcraft®', '/account/management/wow/dashboard.html'],
'WOWC': ['World of Warcraft®', '/account/management/wow/dashboard.html'],
'WOWB1': ['World of Warcraft® Battle Chest®®', '/account/management/wow/dashboard.html'],
'WOWX1': ['World of Warcraft® Battle Chest®®', '/account/management/wow/dashboard.html'],
'WOWX2': ['World of Warcraft®: Wrath of the Lich King', '/account/management/wow/dashboard.html'],
'WOWX3': ['World of Warcraft®: Cataclysm', '/account/management/wow/dashboard.html']
};
var IconTag = {
'starter': 'Starter Edition',
'trial': 'Prueba',
'trialSingular': '1 día restante',
'trialPlural': 'XXX días restantes',
'trialExpired': 'Versión de prueba terminada',
'starterUpgrade': 'Starter Edition (Actualización disponible)',
'upgrade': 'Actualización disponible'
};
var chargebackTooltip = {
'chargeback': 'Debes reembolsar una devolución en esta cuenta.'
};
var MaxBoxLevel = {
'WOWT': 3,
'WOWC': 3,
'WOWB1': 3,
'WOWX1': 3,
'WOWX2': 3,
'WOWX3': 3
};
var Maintenance = {
'ERROR': 'No se encuentra disponible en estos momentos.'
};
var Turbo = {
'enabled': false
};
var Promotion = {
'enabled': false,
'available': true
};
var GameRegions = {
'CN': 'China (CN)',
'EU': 'Europa (EU)',
'KR': 'Corea (KR)',
'LA': 'Latinoamérica (LA)',
'NA': 'Norteamérica (NA)',
'PTR': 'Reino público de pruebas (PTR)',
'RU': 'Rusia (RU)',
'SE': 'Asia Suroriental y Oceanía (SEA)',
'SEA': 'Asia Suroriental y Oceanía (SEA)',
'TW': 'Taiwán (TW)',
'US': 'Estados Unidos (US)'
};
//]]>
</script>
<!--[if IE 6]> <script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/DD_belatedPNG.js?v35"></script>
<script type="text/javascript">
//<![CDATA[
DD_belatedPNG.fix('.icon-16');
//]]>
</script>
<![endif]-->
</div>
</div>
</div>
<div id="layout-bottom">
<div class="wrapper">
<?php echo $this->region('footer'); ?>
</div>
</div>
<script type="text/javascript">
//<![CDATA[
var xsToken = '8078f7de-ea17-4272-9507-8c40f0b280b9';
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
stickyHasBeenRequested: 'You have already sent a sticky request for this topic.',
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
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/bam.js?v23"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/tooltip.js?v35"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/menu.js?v35"></script>
<script type="text/javascript">
$(function() {
Menu.initialize();
Menu.config.colWidth = 190;
Locale.dataPath = 'data/i18n.frag.xml';
});
</script>
<!--[if lt IE 8]>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/jquery.pngFix.pack.js?v35"></script>
<script type="text/javascript">$('.png-fix').pngFix();</script>
<![endif]-->
<script type="text/javascript" src="/account/js/management/lobby.js?v23"></script>
<script type="text/javascript">
//<![CDATA[
Core.load("<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/jquery-ui-1.8.6.custom.min.js?v35");
Core.load("<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/search.js?v35");
Core.load("<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/login.js?v35", false, function() {
if (typeof Login !== 'undefined') {
Login.embeddedUrl = '<?php echo $this->getAppUrl('login/login.frag'); ?>';
}
});
//]]>
</script>
<!--[if lt IE 8]> <script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/jquery.pngFix.pack.js?v35"></script>
<script type="text/javascript">
//<![CDATA[
$('.png-fix').pngFix(); //]]>
</script>
<![endif]-->
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/swfobject.js?v35"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/management/dashboard.js?v23"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/management/wow/dashboard.js?v23"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/settings/settings.js?v23"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/settings/password.js?v23"></script>
</body>
</html>
<?php if (!$this->c('AccountManager')->isBanned() && $this->c('AccountManager')->user('id')) { ?>
<div style="position:fixed;right:0;top:150px;width:137px;" id="tabone">
<!-- BEGIN PHP Live! code, (c) OSI Codes Inc. --><span id="phplive_btn_1337210059" onclick="phplive_launch_chat_0(0)" style="color: #0000FF; text-decoration: underline; cursor: pointer;"></span><script type="text/javascript">(function() { var phplive_e_1337210059 = document.createElement("script") ; phplive_e_1337210059.type = "text/javascript" ; phplive_e_1337210059.async = true ; phplive_e_1337210059.src = "http://live.serverwow.com/js/phplive_v2.js.php?q=0|1337210059|1|" ; document.getElementById("phplive_btn_1337210059").appendChild( phplive_e_1337210059 ) ; })() ;</script><!-- END PHP Live! code, (c) OSI Codes Inc. -->
</div>
<?php } ?>
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