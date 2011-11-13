<script type="text/javascript">
function changeRealm()
{
	var realm = document.getElementById('realm').value;
	document.reino.action = 'servicios.php?p=31&realm='+realm;
}
</script>
<div class="section-title">
    <span>Profesiones Primarias</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, desde esta pagina puedes añader soporte total a las profesion de tu personaje.</p>
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
		<b>Personaje</b> - Selecciona el Personaje (Min lvl 70)<br><br>
		<b>Profesiones</b> - Selecciona la Profesion. (450max) <br><br>		
    	<b>Costo</b> - Costo de la Operacion.<br><br>
		<b><span class="red">Recuerda que el personaje debe estar FUERA de juego.</span></b><br><br>
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
		<td width="40%" align="center">Profesion</td>
		<td width="40%" align="center">Costo</td>
		<td width="20%" align="center"></td>
		</tr>
		<tr>
		<td align=center><select class="select" name="guid" id="guid" style="width: 80%;">';

        echo $char;
		
        echo'</select>
		</td>
		<td align=center><select class="select" name="proff" id="proff" style="width: 80%;">
		<option value="">Selecciona la Recompenza...</option>
		<option value="1">Alquimia</option>
		<option value="2">Desuello</option>
		<option value="3">Encantamiento</option>
		<option value="4">Herboristeria</option>
		<option value="5">Herreria</option>
		<option value="6">Ingemieria</option>
		<option value="7">Inscripcion</option>
		<option value="8">Joyeria</option>
		<option value="9">Mineria</option>
		<option value="10">Peleteria</option>
		<option value="11">Sastreria</option>
		</select>
		</td>
		<td align=center><input type="text" class="inp" name="bonusesforrename" id="bonusesforrename" value="'.$cre_reward[proff][0].' Creditos" size="15" readonly style="width: 80%;"></td>
		<input type="hidden" name="realm" value="'.$_POST['realm'].'">
		<td align=center><input type="submit" class="submit" value="Solicitar" alt="Solicitar" title="Solicitar" style="width: 70px;"></td>
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
		<b><span class="red">Error.</span></b>
		</td>
		</tr>
		</table>';
	}
}
else if (isNum($_POST['realm']) && isNum($_POST['guid']) && isNum($_POST['proff']) && isset($cre_reward['proff']))
{
	switchConnection(1,"realmd");
	$price = $cre_reward[proff][0];
	$ac_id = $account_information['id'];

	$shard = dbquery("SELECT * FROM cp_cre WHERE acid ='$ac_id'")or die("eror");
	$shard  = dbarray($shard);

	if($shard['cre'] >= $price)
	{
		switchConnection($_POST['realm'],"character");
		$char = dbquery("SELECT * FROM characters WHERE guid='$_POST[guid]' and account =$ac_id and online='0' and level > '69' limit 1 ")or die("eror");

		if(dbrows($char) != 0)
		{
			if ($_POST['proff'] == '1'){ $skill = 171;	} if ($_POST['proff'] == '2'){ $skill = 393; } if ($_POST['proff'] == '3'){ $skill = 333; }
			if ($_POST['proff'] == '4'){ $skill = 182; } if ($_POST['proff'] == '5'){ $skill = 164; } if ($_POST['proff'] == '6'){ $skill = 202; }
			if ($_POST['proff'] == '7'){ $skill = 773; } if ($_POST['proff'] == '8'){ $skill = 755; } if ($_POST['proff'] == '9'){ $skill = 186; }
			if ($_POST['proff'] == '10'){ $skill = 165; } if ($_POST['proff'] == '11'){ $skill = 197; }
			
			$char = dbarray($char);
			
			$sql_skill = "SELECT * FROM character_skills WHERE guid = '$_POST[guid]' AND skill ='$skill'";
			$result_skill = dbquery($sql_skill);
			$row_skill = dbarray($result_skill);

			if (dbrows($result_skill) < 1)
			{
		        echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td height="100"></td>
				</tr>
				<tr>
				<td align="center">
				<b><span class="red">La profesion que intentas subir aun no la has aprendido, Vuelve a intentar.</span></b>
				</td>
				</tr>
				</table>';	
				?><meta http-equiv="refresh" content="5"/><?php
			}
			else
			{
				switchConnection(1,"realmd");
				dbquery("UPDATE cp_cre SET cre=cre-$price WHERE acid='$ac_id'")or die("eror");
				
				switchConnection($_POST['realm'],"character");
				$sql = "UPDATE character_skills SET value = '450', max ='450' WHERE guid ='$_POST[guid]' AND skill = '$skill'";
				$result = dbquery($sql);
				
				switchConnection(1,"realmd");

				$value="Profesion $skill, Personaje $char[name], Precio $price";
   				history($value,$ac_id,'proff',$price,$_POST['realm'],$_POST['guid']);
				
				mysql_close();
       
		        echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td height="100"></td>
				</tr>
				<tr>
				<td align="center">
				<b><span class="red">Cambio Realizado Correctamente.</span></b>
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
			<b><span class="red">El Personaje se Encuentra en Linea y/o es menor al lvl 70</b>.</span></b>
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
		<b><span class="red">No Tienes los Creditos Suficientes</span></b>
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