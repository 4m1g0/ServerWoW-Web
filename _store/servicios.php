<?php 
require_once("configs.php");
if (isset($_GET['t']) == 99)
{
	include "services/core/_cre/_utils/doitt.php";
}
else
{
?>
<html>
<head>
<title><? echo $website['custom_title'] ?> - Servicios</title>
<?php include("top.php"); ?>
<link rel="shortcut icon" href="wow/static/local-common/images/favicons/wow.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common.css?v15" />
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common-ie.css?v15" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common-ie6.css?v15" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common-ie7.css?v15" /><![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="wow/static/css/wow.css?v4" />
<link rel="stylesheet" type="text/css" media="all" href="wow/static/css/services/services-index.css?v6" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/services/services-ie6.css?v4" /><![endif]-->
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/wow-ie.css?v4" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/wow-ie6.css?v4" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/wow-ie7.css?v4" /><![endif]-->
<script type="text/javascript" src="wow/static/local-common/js/third-party/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="wow/static/local-common/js/core.js?v15"></script>
<script type="text/javascript" src="wow/static/local-common/js/tooltip.js?v15"></script>
<link href="services/Spry/SprySlidingPanels.css" rel="stylesheet" type="text/css" />
<script src="services/Spry/SprySlidingPanels.js" type="text/javascript"></script>
<script src="services/Spry/SpryEffects.js" type="text/javascript"></script>
<script src="services/Spry/SpryUtils.js" type="text/javascript"></script>
<script src="services/Spry/xpath.js" type="text/javascript"></script>
<script src="services/Spry/SpryData.js" type="text/javascript"></script>
</head>
<body class="en-gb services-home logged-in" <?php if (!$_SESSION['username']) echo 'onload="Login.open(\''.$website[address].'loginframe.php\');"';?>>
<div id="wrapper">
<?php $page_cat="servicios"; include("header.php"); ?>
	<div id="content">
		<div class="content-top">
			<div class="content-trail">
<ol class="ui-breadcrumb">
<li><a href="index.html" rel="np"><?php echo $website['name']; ?></a></li>
<li <?php if (isset($_GET['p'])) echo 'class="last"'; ?>><a href="servicios.php" rel="np">Servicios</a></li>
<?php
switch(isset($_GET['p']))
{
case 3:
    switch($_GET['type']){
    case 'mount':
        echo '<li><a href="?p=3">CreditStore</a></li><li class="last"><a href="?p=3&type=mount">Monturas</a></li>';
        break;
    case 'set':
        echo '<li><a href="?p=3">CreditStore</a></li><li class="last"><a href="?p=3&type=set">Conjuntos de armadura</a></li>';
        break;
    case 'bag':
        echo '<li><a href="?p=3">CreditStore</a></li><li class="last"><a href="?p=3&type=bag">Bolsas y Oro</a></li>';
        break;
    case 'item':
        echo '<li><a href="?p=3">CreditStore</a></li><li class="last"><a href="?p=3&type=item">Items de armadura</a></li>';
        break;
    case 'weapon':
        echo '<li><a href="?p=3">CreditStore</a></li><li class="last"><a href="?p=3&type=weapon">Armas y escudos</a></li>';
        break;
    case 'pet':
        echo '<li><a href="?p=3">CreditStore</a></li><li class="last"><a href="?p=3&type=pet">Mascotas y misceláneo</a></li>';
        break;
    default:
        echo '<li class="last"><a href="?p=3">CreditStore</a></li>';
    }
    break;
case 4:
    echo '<li class="last"><a href="?p=4">Donación</a></li>';
    break;
case 17:
    echo '<li><a href="?p=4">Donación</a></li><li class="last"><a href="?p=17">SMS - Llamada telefónica</a></li>';
    break;
case 21:
    echo '<li><a href="?p=4">Donación</a></li><li class="last"><a href="?p=21">PayPal</a></li>';
    break;
case 19:
    echo '<li><a href="?p=4">Donación</a></li><li class="last"><a href="?p=19">MoneyGram - WesternUnion</a></li>';
    break;
}?>
</ol>
</div>
<script type="text/javascript" language="javascript">
function HttpRequest(url)
{
	var pageRequest = false //variable to hold ajax object

	if (window.XMLHttpRequest) // non-IE
		pageRequest = new XMLHttpRequest();
	else if (window.ActiveXObject) // IE
     	pageRequest = new ActiveXObject("Microsoft.XMLHTTP");
  	else
	{
		alert("Method is not supported. Use \"Save and return\".");
		return;
	}
	
	if (pageRequest)
	{ //if pageRequest is not false
		pageRequest.open('GET', url, false) //get page synchronously
		pageRequest.send(null)
   
		if (window.location.href.indexOf("http")==-1 || pageRequest.status==200)
			alert(pageRequest.responseText);
	}
}
</script>
<style type="text/css">
  .registration {
   height:28px;
   color:#FF6A00;
   border:0px;
   font-size:9px;
   background:url('wow/static/images/form/text.png') no-repeat;
   padding-left:10px;
   padding-left:10px;
  }
  
  .button {
    background:url('wow/static/images/buttons/button-account.png') no-repeat 0 0;
    height:40px;
    width:300px;
    border:0px;
    color:#FF6A00;
    font-size:15px;
    text-shadow:0px -1px 2px #000;
  }
  
  .button:hover {
    border:0px;
    background-position: 0 -41px;
  }
  
  .button:active {
    border:0px;
    background-position: 0 -81px;
  }
  
  select {
    background: #401A10;
    color: #FFAC04;
    font-size: 11px;
    width:200px;
  }
    .loader {
    width:24px;
    height:24px;
    background: url("wow/static/images/loaders/canvas-loader.gif") no-repeat;
    }
  </style><?php
  				if (isset($_GET['p']) == 2)
  					$height = 1200;
				else
					$height = 850;
			?>
			<div class="content-bot">
				<div class="bg-body" style="min-height:<?php echo $height; ?>px">
					<div class="bg-bottom" style="min-height:<?php echo $height; ?>px">		
						<div class="contents-wrapper" style="min-height:<?php echo $height; ?>px">
							<div class="left-col">
								<?php
								   // Include cp_config, cerrada conexion con la web y conectado con realm
								   require_once("services/config/config.php");
								   // Esto se puede cambiar por una ubicacion Custom para utilidades PERL o poniendolo directamente con un php.ini
								   set_include_path("services/include/".PATH_SEPARATOR.get_include_path());
								   include("Pager/Pager.php");
							   
                                   if($_GET['p'])
                                   {
                                       if($_SESSION['cp_login'])
                                       {   
                                           switch($_GET['p'])
                                           {
                                                case 1:
                                                    include "services/pages/status.php";
                                                    break;
                                                case 2:
                                                    include "services/pages/chars.php";
                                                    break;
                                                case 3:
                                                    include "services/pages/credits.php";
                                                    break;
                                                case 4:
                                                    include "services/pages/donar.php";
                                                    break;
                                                case 5:
                                                case 6:
                                                    include "services/pages/hello.php";
                                                    break;
                                                case 7:
                                                    include "services/pages/history.php";
                                                    break;
                                                case 8:
                                                case 9:
                                                case 10:
                                                    include "services/pages/bug.php";
                                                    break;
                                                case 11:
                                                    include "services/pages/abuse.php";
                                                    break;
                                                case 12:
                                                    include "services/pages/creproblem.php";
                                                    break;
                                                case 13:
                                                    include "services/pages/msghistory.php";
                                                    break;
                                                case 14:
                                                    include "services/pages/ver.php";
                                                    break;
                                                case 15:
                                                    include "services/pages/newpass.php";
                                                    break;
                                                case 16:
                                                    include "services/pages/newmail.php";
                                                    break;
                                                case 17:
	                                                include "services/core/_cre/cre.php";
                                                    break;
                                                case 18:
                                                    include "services/pages/sendmail.php";
                                                    break;
                                                case 19:
                                                    include "services/core/_cre/others.php";
                                                    break;												
                                                case 21:
                                                    include "services/core/_cre/pp.php";
                                                    break;
                                                case 24:
	                                                include "services/core/_cre/_utils/rename.php";
                                                    break;
                                                case 25:
	                                                include "services/core/_cre/_utils/race.php";
                                                    break;
                                                case 26:
	                                                include "services/core/_cre/_utils/sex.php";
                                                    break;
                                                case 27:
	                                                include "services/core/_cre/_utils/facc.php";
                                                    break;
                                                case 28:
	                                                include "services/core/_cre/_utils/cacc.php";
                                                    break;
                                                case 29:
	                                                include "services/core/_cre/_utils/lvl.php";
                                                    break;
                                                case 30:
                                                    include "services/core/_cre/_pp/postback.php";
                                                    break;
                                                case 31:
	                                                include "services/core/_cre/_utils/proff.php";
                                                    break;
                                                case 32:
	                                                include "services/core/_cre/_utils/proff_sec.php";
                                                    break;
                                                case 33:
                                                    include "services/pages/avatar.php";
                                                    break;
                                                case 34:
                                                case 35:
                                                default: include "services/menu.html";
                                           }                                         
                                       }else include "services/login.php";
                                   }else include "services/menu.html";
                                   // cerramos la conexion con el servidor y reestablecemos la conexion con la web
                                   switchConnection(1,"web_db");
								?>
							</div>
							<div class="right-col">
								<div class="sub-services">					
										<div class="sub-services-section">
											<!-- Slide Banners -->
                                            	<script type="text/javascript" src="slide_banners.js"></script>
    <img border="1" src="banners/banner_espana.jpg" width="300" height="64" id="banners">
	<script language="JavaScript">
	RunSlideShow("banners","banners/banner_espana.jpg;banners/banner_colombia.jpg;banners/banner_mexico.jpg;banners/banner_argentina.jpg;banners/banner_chile.jpg;banners/banner_bolivia.jpg;banners/banner_peru.jpg;banners/banner_ecuador.jpg;banners/banner_venezuela.jpg;" + "banners/banner_uruguay.jpg",5);
	</script>
    <br><br>
    <!-- FIN -->
											<div class="sub-title">
												<span>Servicios de cuentas</span>
											</div>
											<ul>
													<li><a href="?p=1" class="c1-l" ><span>Estado de Cuenta</span></a></li>
													<li><a href="?p=15" class="c1-l1" ><span>Cambiar contraseña</span></a></li>
													<li><a href="?p=16" class="c1-l2" ><span>Cambiar email</span></a></li>
													<li><a href="?p=14" class="c4-21" ><span>Cambiar la versión de cuenta</span></a></li>
													<li><a href="?p=33" class="c4-20" ><span>Perfil de cuenta</span></a></li>
											</ul>					
										</div>
										<div class="sub-services-section">
											<div class="sub-title">
												<span>SERVICIOS DE PERSONAJES</span>
											</div>
											<ul>
											        <li><a href="?p=2" class="c3-l6" ><span>Desatascar personaje</span></a></li>
  											        <li><a href="?p=29" class="c4-23" ><span>Power Leveling / Sistema de Niveles</span></a></li>
													<li><a href="?p=24" class="c3-l2" ><span>Cambio de nombre</span></a></li>
													<li><a href="?p=25" class="c3-l3" ><span>Cambio de raza</span></a></li>
  													<li><a href="?p=26" class="c4-22" ><span>Cambio de sexo</span></a></li>
													<li><a href="?p=27" class="c3-l4" ><span>Cambio de facción</span></a></li>
													<li><a href="?p=28" class="c3-l5" ><span>Personalización de personaje</span></a></li>
											</ul>					
										</div>
										<div class="sub-services-section">
											<div class="sub-title">
												<span>TIENDA CRE</span>
											</div>
											<ul>
													<li><a href="?p=4" class="c2-l4" ><span>Obtener créditos / Ingresar Codigos</span></a></li>
													<li><a href="?p=3" class="c2-l1" ><span>Usa tus créditos para obtener regalos</span></a></li>
													<li><a href="?p=31" class="c2-31" ><span>Profesiones Primarias</span></a></li>
   													<li><a href="?p=32" class="c2-32" ><span>Profesiones Secundarias</span></a></li>
													<li><a href="?p=7" class="c2-l3" ><span>Ver log de donaciones</span></a></li>
											</ul>					
										</div>
										<div class="sub-services-section">
											<div class="sub-title">
												<span>OTROS SERVICIOS Y PROMOCIONES</span>
											</div>
											<ul>
                                                    <li><a href="" class="c4-l1" ><span>Recluta a un amigo</span></a></li>
													<li><a href="" class="c3-l1" ><span>Transferencia de personajes</span></a></li>
													<li><a href="?p=11" class="c4-l2" ><span>Notificar un abuso</span></a></li>
											</ul>					
										</div>
								</div>	
							</div>
							<span class="clear"><!-- --></span>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
<?php include("footer.php"); ?>
</div>
</body>
</html>
<? }?>
