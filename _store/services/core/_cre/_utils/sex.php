<script type="text/javascript">
function changeRealm()
{
	var realm = document.getElementById('realm').value;
	document.reino.action = 'servicios.php?p=26&realm='+realm;
}
</script>
<div class="section-title">
    <span>Cambio de Sexo de Personaje</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, desde esta pagina puedes modificar tu el Sexo de Tus personajes.</p>
</div>
<?
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nano
 * Copyright: Nano
 * Email: Nano@serverwow.com
*/
if (isset($_POST['realm']) && isNum($_POST['realm']) && ($_POST['guid']==NULL))
{
	switchConnection($_POST['realm'],"character");
	$ac_id = $account_information['id'];
	$name = dbquery("SELECT * FROM characters WHERE account='$ac_id' ")or die("eror");

	if(dbrows($name) != 0)
	{
		while ($datac = dbarray($name))
		{
			$char.="<option value='$datac[guid]'>$datac[name]</option>";
		}
		
		echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td height="15"></td>
		</tr>
		<tr>
		<td>
		<b>Cambio de Sexo</b><br><br><br><br>
		<b>Personaje</b> - Selecciona el Personaje que Recibir la Recompensa.<br><br>
		<b>Costo</b> - Te muestra la cantidad de Creditos Necesarios para esa opcion<br><br>

		<b><span class="red">Asegurate de que el Usuario NO este en Linea.</span></b><br><br>
		</td>
		</tr>
		<tr>
		<td height="15"></td>
		</tr>
		<tr>
		<td align="center">

		<table width="90%" class="smstable" border="0" cellpadding="0" cellspacing="0">
		<form method="post">
		<tr class="smstabletr">
		<td width="40%" align="center">Personaje</td>
		<td width="40%" align="center">Costo</td>
		<td width="20%" align="center"></td>
		</tr>
		<tr>
		<td><select class="select" name="guid" id="guid" style="width: 80%;">';
		
        echo $char;
		
		echo'</select>
        </td>
		<td><input type="text" class="inp" name="bonusesfor" id="bonusesfor" value="'.$cre_reward[sex][0].' Creditos" size="15" readonly style="width: 80%;"></td>
		<input type="hidden" name="realm" value="'.$_POST['realm'].'">
		<td><input type="submit" class="submit" value="Solicitar" alt="Solicitar" title="Solicitar" style="width: 70px;"></td>
		</tr>
		</form>
		</table>
		</td>
		</tr>
		<tr>
		<td height="15"></td>
		</tr>
		</table>';
	}
	else
	{
		echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td height="100"></td>
		</tr>
		<tr>
		<td align="center">
		<b><span class="red">El Personaje NO puede estar En Linea</span></b>
		</td>
		</tr>
		</table>
		';
	}
}
else if (isNum($_POST['realm']) && isNum($_POST['guid']) && isset($cre_reward['sex']))
{
	switchConnection(1,"realmd");
	$ac_id = $account_information['id'];
	$shard = dbquery("SELECT * FROM cp_cre WHERE acid ='$ac_id'")or die("eror") ;
	$shard  = dbarray($shard);

	$price = $cre_reward['sex']['0'];
    
	if($shard['cre'] >= $price)
	{
		switchConnection($_POST['realm'],"character");
		$char = dbquery("SELECT * FROM characters WHERE account='$ac_id' and guid='$_POST[guid]' and online='0' ")or die("eror") ;

		if(dbrows($char) != 0)
		{
			$char  = dbarray($char);
			if ($char['gender'] == 1) // Mujer
			{
				switchConnection(1,"realmd");
				dbquery("UPDATE cp_cre SET cre=cre-$price WHERE acid='$ac_id'");

				switchConnection($_POST['realm'],"character");
				dbquery("UPDATE characters SET `gender`='0' WHERE guid='$_POST[guid]' limit 1");
			}
			elseif ($char['gender'] == 0) // Hombre
			{
				switchConnection(1,"realmd");
				dbquery("UPDATE cp_cre SET cre=cre-$price WHERE acid='$ac_id'");

				switchConnection($_POST['realm'],"character");
				dbquery("UPDATE characters SET `gender`='1' WHERE guid='$_POST[guid]' limit 1");
			}
			
			switchConnection(1,"realmd");
	
			$value="Cambio de Sexo al personaje $char[name] :: Guid $_POST[guid]";
			history($value,$ac_id,'sex',$price,$_POST['realm'],$_POST['guid']);
			
			mysql_close();
          
			echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td height="100"></td>
			</tr>
			<tr>
			<td align="center">
			<b><span class="red">Cambio realizado con Exito.</span></b>
			</td>
			</tr>
			</table>';
			?><meta http-equiv="refresh" content="5"/><?php
		}
		else
		{
			echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td height="100"></td>
			</tr>
			<tr>
			<td align="center">
			<b><span class="red">El Personaje NO puede estar Conectado.</span></b>
			</td>
			</tr>
			</table>';
			?><meta http-equiv="refresh" content="5"/><?php
		}
	}
	else
	{
		echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td height="100"></td>
		</tr>
		<tr>
		<td align="center">
		<b><span class="red">No tienes los creditos Suficientes.</span></b>
		</td>
		</tr>
		</table>';
		?><meta http-equiv="refresh" content="5"/><?php
	}
}
else
{
?>
<table width="80%" border=0>
<form method="post" name="reino" action="javascript:changeRealm()">
<tr>
<td width="50%" align="center"><b>Seleccionar Reino:</b></td>
<td width="30%" align="left">
<select name="realm" id="realm" class="select" style="width: 150px;">
<option value="">Selecciona una Opcion...</option>
<?
	foreach ($world_db as $i => $value)
	{
		echo"<option value=$value[0]>$i</option>";
	}
?>
</select>
<br>
<INPUT TYPE="submit" NAME="submit" Value="Seleccionar">
<br>
</td>
</form>
</table>
<?
}
?>