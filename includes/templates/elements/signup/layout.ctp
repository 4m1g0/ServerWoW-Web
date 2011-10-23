<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Suscribirse a una prueba gratis de World of Warcraft</title>
	<meta name="description" content="Regístrate para probar World of Warcraft gratis"/>
	<link rel="shortcut icon" href="<?php echo CLIENT_FILES_PATH; ?>/account/images/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/lightweight-account-creation/signup.css"/>
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/lightweight-account-creation/signup-footer.css"/>
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/lightweight-account-creation/signup-promo-free-starter.css"/>
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/locale/es-es.css"/>
<style type="text/css">
	body.es-es .header-text { background:url(<?php echo CLIENT_FILES_PATH; ?>/account/images/lightweight-account-creation/es-es/promo-free-starter/header-text.jpg) no-repeat; }
	body.es-es .wow-logo { background:url(<?php echo CLIENT_FILES_PATH; ?>/account/images/lightweight-account-creation/es-es/promo-free-starter/starter_edition.jpg) no-repeat; }
</style>

<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/lightweight-account-creation/signup-ie6.css"/>
	<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/lightweight-account-creation/signup-promo-free-starter-ie6.css"/>
<![endif]-->

<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/lightweight-account-creation/signup-ie7.css"/>
	<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo CLIENT_FILES_PATH; ?>/account/css/lightweight-account-creation/signup-promo-free-starter-ie7.css"/>
<![endif]-->
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/jquery-1.4.4-p1.min.js"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/core.js"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/js/third-party/swfobject.js"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/lightweight-account-creation/signup.js"></script>
<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/account/js/lightweight-account-creation/form-validation.js"></script>

<script type="text/javascript">
		FormValidation.validators.required.errorProperties.text         = "Por favor, rellena todos los campos obligatorios.";
		FormValidation.validators.emailMatch.errorProperties.text       = "Ambas direcciones de correo electrónico deben coincidir.";
		FormValidation.validators.captcha.errorProperties.text          = "El código de seguridad introducido no es válido. Vuelve a intentarlo.";
		FormValidation.validators.emailUnavailable.errorProperties.text = 'Esta dirección de correo electrónico ya está en uso. Los usuarios de Battle.net pueden &lt;a href=&quot;{0}&quot;&gt;iniciar sesión&lt;/a&gt; y añadir una prueba gratuita a su cuenta.';
		FormValidation.validators.emailInvalid.errorProperties.text     = "Por favor, introduce una dirección de correo electrónico válido.";
		FormValidation.validators.password.errorProperties.text         = "Tu contraseña no reúne todos los requisitos.";
		FormValidation.validators.cannotPaste.errorProperties.text      = "Por favor, rellena este campo manualmente.";


		WowLanding.regionMenu.regionLabels = {
			us: "América/Oceanía",
			eu: "Europa",
			ru: "Rusia"
		};

			var regionalSites = {
				US: 'https://us.battle.net',
				EU: 'https://eu.battle.net',
				RU: 'https://eu.battle.net' 
			};

			var enforceCaptcha = false;

	</script>	


</head>
<body class="es-es" onclick="WowLanding.regionMenu.hide();">
	<div class="positionWrapper">
		<div class="relative">
			<div class="page">
				<div class="header-text"></div>
	<div class="leftColumn">

		<div class="wow-logo"></div>
		<div class="starter-desc">
			¡Ahora podrás jugar gratis los primeros veinte niveles del juego online más épico del planeta! <br/>Entra en World of Warcraft y descubre un mundo lleno de magia, mitos y aventuras legendarias. Esta es tu oportunidad de vivir una experiencia única…
		</div>
	</div>
	<div class="rightColumn">
	    <table class="topLogin">
	    	<tr>
	    		<td class="left" valign="middle">
	    			¿Deseas actualizar o gestionar una cuenta de prueba ya existente?
	    		</td>
	    		<td class="right" valign="middle">
			    	<a class="signIn" href="<?php echo $this->getCoreUrl('account/'); ?>">
			    		<span>Iniciar sesión</span>
			    	</a>
			    </td>
			</tr>
	    </table>

	    <div class="clear"><!-- --></div>
		<div id="parchment-container">
			<div class="wrapper-parchment-bottom">
				<div class="parchment-bottom">
					<div class="parchment-top">
						<div class="parchment-top-smoothener">
	<form id="signUpForm" name="signUpForm" class="signUpForm" action="." method="post"
		onsubmit="return FormValidation.validateForm(this);">

		<h1 class="formHeader">
			<!-- Regístrate. Es gratis. -->
					</h1>
		<div class="formHeader-desc">Ahora World of Warcraft: Starter Edition es gratis hasta el nivel 80.</div>


		<div class="relative">


	<div id="formValidation" class="messageBox" style="display:none">
		<div class="background">
			<ul id="errorList">
			</ul>
		</div>
	</div>
		</div>

	<div class="formBackground">
		<div class="formTop">
			<div class="formBottom">
				<table class="accountInfo">
	<tr id="emailAddressRow" class="">
		<td class="leftCol">
			<label for="emailAddress">Username</label>
		</td>
		<td class="rightCol">
    <input type="text" id="emailAddress" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" class='text validate required emailMatch emailUnavailable emailInvalid' onclick='$("#accountNote").show();' onfocus='$("#accountNote").show();' onblur='$("#accountNote").hide();FormValidation.validateField(this, event);PasswordValidation.validate(event)' maxlength='320'    />

			<div class="validField"><!-- --></div>
			<div class="clear"><!-- --></div>
			<div id="accountNote" class="messageBox" style="display:none">
				<div class="arrowLeft"><!-- --></div>
				<div class="background">
					<p>
						<strong>Este será el nombre de tu cuenta</strong>
					</p>
				</div>
			</div>
		</td>
	</tr>
	<tr id="emailAddressRow1" class="">
		<td class="leftCol">
			<label for="emailAddress1">E-Mail</label>
		</td>
		<td class="rightCol">
    <input type="text" id="emailAddress1" name="emailAddress" value="<?php if (isset($_POST['emailAddress'])) echo $_POST['emailAddress']; ?>" class='text validate required emailMatch emailUnavailable emailInvalid'maxlength='320'    />

			<div class="validField"><!-- --></div>
			<div class="clear"><!-- --></div>
		</td>
	</tr>
	<tr id="passwordRow" class="">
		<td class="leftCol">
			<label for="password">Contraseña</label>
		</td>
		<td class="rightCol">
    <input type="password" id="password" name="password" value="" class='text validate required password' onkeyup='FormValidation.validateField(this, event);' onblur='FormValidation.validateField(this, event);' maxlength='16'    />

			<div class="validField"><!-- --></div>
			<div class="clear"><!-- --></div>
			<div id="passwordValidation" class="messageBox" style="display:none">
				<div class="arrowLeft"><!-- --></div>
				<div class="background">
					<ul>
						<li id="passwordLength" class="invalid">La longitud debe estar entre 8 y 16 caracteres.</li>
						<li id="passwordNumber" class="invalid">Debe contener al menos 1 número.</li>
						<li id="passwordCharacter" class="invalid">Debe contener al menos un caracter alfabético</li>
						<li id="passwordCharacters" class="invalid">Solo puede contener caracteres alfabéticos (A–Z), numéricos (0–9) y de puntuación.</li>
						<li id="passwordSimilarity" class="invalid">No debe ser similar al tu nombre de cuenta.</li>
						<li id="passwordsMatch" class="invalid">Ambas contraseñas deben coincidir.</li>
					</ul>
				</div>
			</div>
		</td>
	</tr>
	<tr id="passwordConfirmationRow" class="">
		<td class="leftCol">
			<label for="passwordConfirmation">Confirmar contraseña</label>
		</td>
		<td class="rightCol evenRow">
    <input type="password" id="passwordConfirmation" name="passwordConfirmation" value="" class='text validate required password' onkeyup='FormValidation.validateField(this, event);' maxlength='16'    />

			<div class="validField"><!-- --></div>
		</td>
	</tr>
				</table>
			</div>
		</div>
	</div>


		<div class="clear"><!-- --></div>
		<div id="captchaExtension">
			<table class="accountInfo">
	<tr>
		<td class="rightCol" colspan="2">
			<input id="prepopulate" name="prepopulate" type="hidden" value="false" />
			<input name="regionRef" type="hidden" value=""/>
			<input id="btnSubmit" type="submit" class="submit" value="Jugar gratis" />
		</td>
	</tr>
			</table>
		</div>
	</form>
						</div>
					</div>
				</div>
			</div>
			<div class="parchment-bottom-edge">

			</div>
		</div>
	</div>

	<div class="clear"><!-- --></div>


		<div class="languageSelection">

			<span style="float:left">Idioma:</span>

	<a id="toggleGlobal2" class="changeLanguage" href="javascript:void(0)" onclick="Toggle.open(this, '', $('#globalOptions2'))">
		Español (EU)
	</a>
	
	<div class="languageContainer" id="globalOptions2">
				<table id="languageOptions">
					<tr>
							<th style="padding-right:20px">Américas y Oceanía</th>
							<th>Europa</th>
									<th><!-- --></th>
					</tr>
					<tr>
						<td valign="top">
							
									<a href="http://us.battle.net/account/creation/wow/signup/?locale=en_US" onclick="selectLanguage('en_US');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to en_US'); return false;">
										English (US)
									</a>
							
									<a href="http://us.battle.net/account/creation/wow/signup/?locale=es_MX" onclick="selectLanguage('es_MX');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to es_MX'); return false;">
										Español (AL)
									</a>
							
									<a href="http://us.battle.net/account/creation/wow/signup/?locale=pt_BR" onclick="selectLanguage('pt_BR');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to pt_BR'); return false;">
										Português (BR)
									</a>
						</td>
						<td valign="top">
							
									<a href="javascript:;" onclick="selectLanguage('de_DE');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to de_DE'); return false;">
										Deutsch
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('en_GB');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to en_GB'); return false;">
										English (EU)
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('es_ES');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to es_ES'); return false;">
										Español (EU)
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('fr_FR');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to fr_FR'); return false;">
										Français
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('ru_RU');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to ru_RU'); return false;">
										Русский
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('it_IT');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to it_IT'); return false;">
										Italiano
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('pl_PL');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to pl_PL'); return false;">
										Polski
									</a>
							</td><td valign="top">
									<a href="javascript:;" onclick="selectLanguage('nl_NL');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to nl_NL'); return false;">
										Nederlands
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('da_DK');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to da_DK'); return false;">
										Dansk
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('sv_SE');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to sv_SE'); return false;">
										Svenska
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('nb_NO');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to nb_NO'); return false;">
										Norsk
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('fi_FI');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to fi_FI'); return false;">
										Suomi
									</a>
							
									<a href="javascript:;" onclick="selectLanguage('tr_TR');pageTracker._trackEvent('WoW Trial Signup', 'Change Language', 'es_ES to tr_TR'); return false;">
										Türkçe
									</a>
						</td>
					</tr>
				</table>
			<div class="clear"><!-- --></div>
	</div>
			<span class="starter-faq">Más información en las <a href="http://eu.blizzard.com/support/article/wowclassictrialfaq?locale=es">Preguntas Frecuentes de Starter Edition</a>.</span>			
			<div class="clear"><!-- --></div>
		</div>

	<div class="footer">


		<div class="needHelp">
			¿Necesitas ayuda?<br />
			<a href="http://eu.blizzard.com/support/index.xml?locale=es_ES" onclick="window.open(this.href);return false;">Página web de Asistencia</a>
		</div>

			<div class="legal">
				<a class="blizzard" onclick="window.open(this.href);return false;" href="http://eu.blizzard.com/es-es/"><!-- --></a>
				<a class="bnet" onclick="window.open(this.href);return false;" href="http://eu.battle.net?locale=es_ES"><!-- --></a>
	
				<a href="http://eu.blizzard.com/es-es/company/about/privacy.html" onclick="window.open(this.href);return false;">Política de Protección de Datos</a>
	
				<span class="divider">|</span>
	
				<a href="http://eu.blizzard.com/es-es/company/about/termsofuse.html" onclick="window.open(this.href);return false;">Condiciones de Uso Blizzard</a>
				<div class="asterisks"><span>*</span>Basado en datos internos de la compañía, información pública, y/o informes de colaboradores clave.</div>
				<a href="http://eu.blizzard.com/es-es/company/about/legal-faq.html" onclick="window.open(this.href);return false;">©2004 – 2011 Blizzard Entertainment, Inc. Todos los derechos reservados.<br/> Todas las marcas registradas aquí mencionadas son propiedad de sus respectivos dueños.</a>
	
				<div class="clear"><!-- --></div>
			</div>

	</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		FormValidation.initialize("signUpForm", true);

		//returning user
		ReturningUser.check();
	</script>

	</body>
</html>