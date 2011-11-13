<div style="min-height:50px;" class="section-title">
    <span>Log de donaciones</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, En esta página puedes ver el estado de todos tu envios de premios a tu personaje, recuerda que cada envio permanece unas horas en espera hasta que es recibido en tu personaje.</p>
</div>

<span class="clear"><!-- --></span>
<?
if(!$_SESSION['cp_login']) exit('Error');
error_reporting(0);
if (isset($_POST['message']))
{
	if(strlen($_POST['message'])>7 && strlen($_POST['message'])<1000)
	{
		dbquery("INSERT INTO `cp_creproblem` (`type`,`ac_id`,`message`,`petition`,`ip`) VALUES('".stripinput($_POST[bnstype])."','$game_information[id]','".stripinput($_POST[message])."','".stripinput($_POST[item])."','".$_SERVER[REMOTE_ADDR]."')");

		echo'Reportado';
 	}
	else 
	{
		echo'<p><div class="log_error">El Mensaje es Muy Corto, o es Demasiado Largo, el Limite de contenido es de 1000 Palabras</div><br><a href="?p=12"> Volver a Intentar</a></p>';
 	}
}
else
{
    ?>
	<p><center>
	<form name="bug" method="post" enctype="multipart/form-data">
	<table border="0" cellpadding="0" cellspacing="0" class="tbl">
	<tr>
	<td>Tipo de error:</td>
	</tr>
	<tr>
	<td>
	<select name="bnstype" id="bnstype" class="select" style="width: 310px;">
	<option value=0>El item lleva mas de 24h en espera</option>
	<option value=1>El item aparece como enviado pero no ha llegado</option>
	<option value=2>El item que ha llegado no se corresponde</option>
    </select><br />&nbsp;</td>
    </tr>
    <input name="item" type="hidden" value="<?php echo $_GET['id']; ?>">
	<tr>
	<td>Descripción<span class="red"></span>:</td>
	</tr>
	<tr>
	<td><textarea style="background-color:#F1EBD7;-moz-border-radius:5px 5px 5px 5px;" rows="10" cols="40" name="message" class="inp" wrap="hard"></textarea><br />&nbsp;</td>
	</tr>
	<tr>
	<td align="center"><label>
	<input type="submit" class="button" name="submit" value="Enviar Reporte" alt="Enviar Reporte" title="Enviar Reporte">
	</label></td>
	</tr>
	</table>
	</form></center></p>
	<?php
}
?>
