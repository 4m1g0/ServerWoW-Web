<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Server WoW - Server de World of Warcraft : Crear Cuenta Gratis</title>
		<meta name="description" content="Crear tu Cuenta para jugar World of Warcraft gratis en Server Wow, Server de Warcraft">
		<meta name="keywords" content="wow, juegos, multijugador masivo, world of warcraft, blizzlike, cataclysm, wotlk, server, privado">
		<link rel="shortcut icon" href="/account/images/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" media="screen, projection" href="/account/css/lightweight-account-creation/signup.css"/>
	<link rel="stylesheet" type="text/css" media="screen, projection" href="/account/css/lightweight-account-creation/signup-footer.css"/>
	<link rel="stylesheet" type="text/css" media="screen, projection" href="/account/css/lightweight-account-creation/signup-promo-tv-spot.css"/>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="/account/css/locale/es-es.css"/>
	<style type="text/css">
		body.es-es .header-text { background:url(/account/images/lightweight-account-creation/es-es/promo-tv-spot/header-text.jpg) no-repeat; }
		body.es-es .wow-logo { background:url(/account/images/lightweight-account-creation/es-es/promo-tv-spot/play-free.jpg) no-repeat; }
		.button-container a { background: url(/account/images/lightweight-account-creation/es-es/promo-tv-spot/button.jpg) 0 bottom no-repeat;}
	</style>

	<!--[if IE 6]>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="/account/css/lightweight-account-creation/signup-ie6.css"/>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="/account/css/lightweight-account-creation/signup-promo-tv-spot-ie6.css"/>
	<![endif]-->

	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="/account/css/lightweight-account-creation/signup-ie7.css"/>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="/account/css/lightweight-account-creation/signup-promo-free-starter-ie7.css"/>
	<![endif]-->
	<script type="text/javascript" src="/account/local-common/js/third-party/jquery-1.4.4-p1.min.js"></script>
	<script type="text/javascript" src="/account/local-common/js/core.js"></script>
	<script type="text/javascript" src="/account/local-common/js/third-party/swfobject.js"></script>
	<script type="text/javascript" src="/account/js/lightweight-account-creation/signup.js"></script>
	<script type="text/javascript" src="/account/js/lightweight-account-creation/form-validation.js"></script>

        <script type="text/javascript">
        //<![CDATA[
		FormValidation.validators.required.errorProperties.text         = "Por favor, rellena todos los campos obligatorios.";
		FormValidation.validators.emailMatch.errorProperties.text       = "Ambas direcciones de correo electrónico deben coincidir.";
		FormValidation.validators.captcha.errorProperties.text          = "El código de seguridad introducido no es válido. Vuelve a intentarlo.";
		FormValidation.validators.emailUnavailable.errorProperties.text = 'Esta dirección de correo electrónico ya está en uso. Los usuarios de ServerWoW pueden &lt;a href=&quot;{0}&quot;&gt;iniciar sesión&lt;/a&gt; y añadir una prueba gratuita a su cuenta.';
		FormValidation.validators.emailInvalid.errorProperties.text     = "Por favor, introduce una dirección de correo electrónico válido.";
		FormValidation.validators.password.errorProperties.text         = "Tu contraseña no reúne todos los requisitos.";
		FormValidation.validators.cannotPaste.errorProperties.text      = "Por favor, rellena este campo manualmente.";


		WowLanding.regionMenu.regionLabels = {
			us: "América/Oceanía",
			eu: "Europa",
			ru: "Rusia"
		};

			var regionalSites = {
				US: 'https://serverwow.com',
				EU: 'https://serverwow.com',
				RU: 'https://serverwow.com' 
			};

			var enforceCaptcha = true;

        //]]>
        </script>


	</head>
	<body class="es-es" onclick="WowLanding.regionMenu.hide();">
<div style="position:fixed;right:0;top:100px;width:137px;" id="tabfive">
</div>	
	<div class="positionWrapper starter-edition">
		<div class="relative">
			<div class="page">
				<div class="header-text"></div>
	<div class="leftColumn">
		<div class="video">
			<div id="chuck" style="width: 560px; height: 315px;">
                <object width="560" height="315">
                    <param name="movie" value="https://www.youtube.com/v/<?php echo $this->c('Config')->getValue('site.creation_youtube_id'); ?>?version=3&amp;hl=es_ES"></param>
                    <param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>
                    <embed src="https://www.youtube.com/v/<?php echo $this->c('Config')->getValue('site.creation_youtube_id'); ?>?version=3&amp;hl=es_ES" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed>
                </object>
            </div>
		</div>
		<div class="wow-logo"></div>
		<div class="starter-desc">
			¡Ahora podrás jugar gratis World of Warcraft y descubrir un mundo lleno de magia, mitos y aventuras legendarias. Esta es tu oportunidad de vivir una experiencia única…
		</div>
		<div class="human">
		</div>
		<div class="button-container">
			<a href="" class="learn-more" target="_blank"></a>
			<a href="" class="buy-now" target="_blank"></a>
		</div>
	</div>
	<div class="rightColumn">
	    <table class="topLogin">
	    	<tr>
	    		<td class="left" valign="middle">
	    			¿Deseas actualizar o gestionar una cuenta de prueba?
	    		</td>
	    		<td class="right" valign="middle">
			    	<a class="signIn" href="/account/">
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
		<div class="formHeader-desc">Bienvenido a ServerWoW.</div>


		<div class="relative">
	<div id="formValidation" class="messageBox" style="<?php if ($this->c('AccountManager')->getErrorCode() == 0) echo 'display:none'; ?>">
		<div class="background">
			<?php
			if ($this->c('AccountManager')->getErrorCode() & ERROR_USERNAME_TAKEN) :
			?>
			<ul id="errorList">
				 <li id="error.email.unavailable.trialSignup"><?php echo $l->getString('template_account_creation_username_taken'); ?></li>
			</ul>
			<?php endif; ?>
		</div>
	</div>
		</div>

	<div class="formBackground">
		<div class="formTop">
			<div class="formBottom">
				<table class="accountInfo">
	<tr id="firstNameRow" class="<?php if ($this->c('AccountManager')->getErrorCode() & ERROR_USERNAME_TAKEN)  echo 'invalid'; ?>">
		<td class="leftCol">
			<label for="firstName">Username</label>
		</td>
		<td class="rightCol">
    <input type="text" id="firstName" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" class='text validate required' onclick='$("#accountNote").show();' onfocus='$("#accountNote").show();' onblur='$("#accountNote").hide();FormValidation.validateField(this, event);' maxlength='32'    />

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

			<script type="text/javascript">
				document.getElementById("firstName").focus();
			</script>
			<div class="clear"><!-- --></div>
		</td>
	</tr>
    <input type="hidden" id="lastName" name="lastName" value="doe"/>
	<tr id="emailAddressRow" class="">
		<td class="leftCol">
			<label for="emailAddress">E-mail</label>
		</td>
		<td class="rightCol">
    <input type="text" id="emailAddress" name="emailAddress" value="<?php if (isset($_POST['emailAddress'])) echo $_POST['emailAddress']; ?>" class='text validate required emailMatch emailUnavailable emailInvalid' onblur='FormValidation.validateField(this, event);PasswordValidation.validate(event)' maxlength='320'    />

			<div class="validField"><!-- --></div>
		</td>
	</tr>
	<tr id="emailAddressConfirmationRow" class="">
		<td class="leftCol evenRow">
			<label for="emailAddressConfirmation">Confirmar e-mail</label>
		</td>
		<td class="rightCol evenRow">
    <input type="text" id="emailAddressConfirmation" name="emailAddressConfirmation" value="<?php if (isset($_POST['emailAddressConfirmation'])) echo $_POST['emailAddressConfirmation']; ?>" class='text validate required emailMatch' onblur='FormValidation.validateField(this, event);' maxlength='320'    />

			<div class="validField"><!-- --></div>
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
						<li id="passwordSimilarity" class="invalid">No debe ser similar a tu nombre de cuenta.</li>
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
			<input type="hidden" name="dobDay" value="1" />
			<input type="hidden" name="dobMonth" value="1" />
			<input type="hidden" name="dobYear" value="1980" />

			</table>
			</div>
		</div>
	</div>


		<div class="clear"><!-- --></div>
		<div id="captchaExtension" style="margin-left:22px;">
			<?php
            	if ($this->c('AccountManager')->getErrorCode() & ERROR_RECAPTCHA_FAILED)
					echo '<li>' . $l->getString('login_error_invalid_captcha') . '</li>';
            	elseif ($this->c('AccountManager')->getErrorCode() & ERROR_EMAIL_TAKEN)
					echo '<li>' . $l->getString('template_account_creation_email_taken') . '</li>';
				elseif ($this->c('AccountManager')->getErrorCode() & ERROR_DOMAIN_NOT_VALID)
					echo '<li>' . $l->getString('template_account_creation_domain_not_valid') . '</li>';
				elseif ($this->c('AccountManager')->getErrorCode() & ERROR_USER_SAME_PASS)
					echo '<li>' . $l->getString('template_account_creation_user_same_pass') . '</li>';
				elseif ($this->c('AccountManager')->getErrorCode() & ERROR_IP_BANNED)
					echo '<li>' . $l->getString('template_account_creation_ip_banned') . '</li>';
				else
					echo '';

				require_once(SITE_CLASSES_DIR . 'recaptchalib.php');
				$publickey = "6LcZjsoSAAAAAPYGkJOTrHl_j_4zS6S9Chcyh2m6"; // you got this from the signup page
				echo recaptcha_get_html($publickey);
			?>
		<br>	
		<table class="accountInfo">
		
	<tr id="touAgreeRow">
		<td valign="top" class="leftCol">
			<div class="checkboxBorder">
				<input id="touAgree" name="touAgree" type="checkbox" class="validate required"
					onclick="FormValidation.validateField(this, event);" />
			</div>
		</td>
		<td class="rightCol">
			<label for="touAgree">
					Acepto las <a href="" onclick="window.open(this.href);return false;">Condiciones de Uso</a>
			</label>
			<div class="terms-desc">
				No facilitaremos tu dirección de email a terceros, pero sí es posible que nos pongamos en contacto contigo sobre productos y promociones.
			</div>
			<div>
			<?php
			?>
			</div>
            
		</td>
	</tr>
	<tr>
		<td class="rightCol" colspan="2">
			<input id="prepopulate" name="prepopulate" type="hidden" value="false" />
			<input name="regionRef" type="hidden" value=""/>
			<br />
			<br />
			<br />
			<input id="btnSubmit" type="submit" class="submit" value="Jugar gratis" />
		</td>
	</tr>
			</table>
		</div>
			<div class="starter-additional-msg"></div>
	</form>
	<div id="returningVisitor" style="display:none">
		<h1 class="formHeader">
    		Bienvenido otra vez, <span id="nameHeader"><!-- --></span>
    	</h1>

    	<div class="returningInformation">
    		<p class="welcomeBack">Entra ahora en Gestión de cuentas para:</p>
    		<ul>
    			<li>
    				Actualizar la cuenta
    				<p>Realizar la actualización de una cuenta de prueba a una completa y configurar una suscripción.</p>
    			</li>
    			<li>
    				Descargar el juego
    				<p>Descargar World of Warcraft para Mac o PC y otros idiomas.</p>
    			</li>
    			<li>
    				Gestionar datos de la cuenta
    				<p>Cambiar la contraseña, actualizar información de contacto y mucho más.</p>
    			</li>
    		</ul>
    	</div>

    	<a class="login" href="http://www.worldofwarcraft.com/account/">Iniciar sesión</a>

    	<div class="returningInformation">
	    	<div class="newAccount">
	    		Para crear una nueva cuenta de prueba de World of Warcraft, haz clic <a href="javascript:ReturningUser.clear();">aquí</a>.
	    	</div>
    	</div>
    </div>
						</div>
					</div>
				</div>
			</div>
			<div class="parchment-bottom-edge">

			</div>
		</div>
	</div>

	<div class="clear"><!-- --></div>
	<br><br>
<div id="footer">
</div>
<div id="copyright">
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
</div>
</div>
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
	<script type="text/javascript">
		FormValidation.initialize("signUpForm", true);

		//returning user
		ReturningUser.check();
	</script>
	</body>
	</html>