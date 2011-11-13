<div class="section-title">
<span>Reporte de bugs</span>
<p>Hola <?php echo $_SESSION['username']; ?>, en esta pagina puedes colaborar activamente con el equipo de desarrollo del servidor reportando los errores que encuentres, recuerda que esto no es un formulario para exigir una reparación, si no para poner un error en conocimiento de los desarrolladores.</p>
</div>
<span class="clear"><!-- --></span>
<?
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nano
 * Copyright: Nano
 * Email: Nano@serverwow.com
*/
error_reporting(0);
if (isset($_POST['submit']) && isset($_POST['server']) && isset($_POST['message']))
{
	if(strlen($_POST['message'])>7 && strlen($_POST['message'])<1000)
	{
		if (isset($_FILES["screen"]) && is_uploaded_file($_FILES["screen"]["tmp_name"]) && $_FILES["screen"]["error"] == 0)
		{
			$photo_types = array(".gif",".jpg",".jpeg",".png",".bmp");
			$screen = $_FILES["screen"]["name"];
			$photo_ext = strtolower(strrchr($screen,"."));
			
			if (in_array($photo_ext, $photo_types))
			{
				if ($_FILES["screen"]["size"] < 2000000)
				{
					$screen_id = $_FILES["screen"]["name"];
					$save_path = "upload/".$ac_id."_".$_FILES["screen"]["name"];
					@move_uploaded_file($_FILES["screen"]["tmp_name"],$save_path);
				}
			}
		}
 
		dbquery("INSERT INTO `cp_admessage` (`type`,`realm`,`ac_id`,`screen`,`message`) VALUES('AbuseReport','$_POST[server]','$ac_id','".$_FILES["screen"]["name"]."','".stripinput($_POST[message])."')");
		echo'<h2>Reporte de Abuso</h2><p><div class="log_error">Reporte de Abuso</div></p>';
	}
	else 
	{
		echo'<h2>Reporte de Abusos</h2>
		<p><div class="log_error">Reportar un Abuso</div><br><a href="?p=11"> Reportar!</a></p>';
	}
}
else
{
	echo'<h2>Reporte de Abusos</h2>
	<p>
	<form name="abuse" method="post" enctype="multipart/form-data">
	<table border="0" cellpadding="0" cellspacing="0" class="tbl">
	<tr>
	<td align="right" width="40%">Seleccionar Reino<span class="red">*</span>:</td>
	<td width="60%"><select name="server" id="server" class="select" style="width: 300px;">';

	foreach ($characters_db as $i => $value)
	{
		echo"<option value=$value[0]>$i</option>";
	}
	
	echo'</select></td>
	</tr>
	<tr>
	<td align="right">Adjuntar Informacion(ScreenShots):</td>
	<td><input name="screen" type="file" size="15" style="width: 300px;"></td>
	</tr>
	<tr>
	<td align="right">Descripcion<span class="red">*</span>:</td>
	<td><textarea rows="10" cols="40" name="message" class="inp" style="width: 300px;" wrap="hard"></textarea></td>
	</tr>
	<tr>
	<td colspan="2" align="right"><label>
	<input type="submit" class="submit" name="submit" value="Enviar Reporte" alt="Enviar Reporte" title="Enviar Reporte" style="width: 175px;">
	</label></td>
	</tr>
	<tr>
	<td></td>
	<td align="left"><span class="red">*</span> Leer la Guia para el Reporte de Abusos, Es necesario para que tu reporte sea tenido en Cuenta</td>
	</tr>
	</table>
	</form></p>';
}
?>

