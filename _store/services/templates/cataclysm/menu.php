<?
if(!isset($_GET['p']) && !$success)
{
	if(!$cp_register)$register_url; else $register_url=$cp_url."?s=register";
		echo'<div id="navi">
		
	<H1><STRONG>Menu</STRONG></H1>
	<p><a href="'.$cp_url.'index.php">Administar Cuenta</a></p>
	<p><a href="'.$cp_url.'?s=send">Recordar Password</a></p>
	<P><A href="'.$site_url.'">Volver a WoW LCV</A></P>
	<P><A href="'.$forum_url.'">Ir a los Foros</A></P></DIV>';
}
	elseif($cp_login)
	{
		echo'<div id="navi">
		<h1><strong>Inicio</strong></h1>
		<p><a href="'.$cp_url.'?p=6&do=news">Noticias</a></p>
		<br><br>

		<h1><strong>Menu</strong></h1>
		<p><a href="'.$cp_url.'?p=2">Personajes</a></p>
		<p><a href="'.$cp_url.'?p=14">Cambio de versión</a></p>
		<p><a href="'.$cp_url.'?p=15">Cambiar contraseña</a></p>
		<p><a href="'.$cp_url.'?p=16">Cambio de dirección</a></p>
		<br><br>
		
		<h1><strong>Tienda Cre</strong></h1>
		<p><a href="'.$cp_url.'?p=4">Ingresar Creditos</a></p>
		<p><a href="'.$cp_url.'?p=3">Usar Creditos</a></p>
		<br><br>

		<h1><strong>Utils</strong></h1>
		<p><a href="'.$cp_url.'?p=10">Reportar Errores/Bugs</a></p>
		<p><a href="'.$cp_url.'?p=11">Notificar un Abuso</a></p>
		<p><a href="'.$cp_url.'?p=12">Notificar Error en Donaciones</a></p>
		<p><a href="'.$cp_url.'?p=18">Enviar Correo a la Administracion</a></p>
		<p><a href="'.$cp_url.'?p=13">Registro de Mensajes</a></p></div>';
	}

?>
