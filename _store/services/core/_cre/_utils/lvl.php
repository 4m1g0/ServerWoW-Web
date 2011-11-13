<script type="text/javascript">
function changeRealm()
{
	var realm = document.getElementById('realm').value;
	document.reino.action = 'servicios.php?p=29&realm='+realm;
}
</script>
<div class="section-title">
    <span>Power Leveling</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, desde esta pagina puedes modificar el nivel de tus personajes.</p>
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
		<b>Sistema de Power Leveling</b><br><br><br><br>
		<b>Personaje</b> - Escoje el Personaje.<br><br>
		<b>Niveles</b> - Escoje los Niveles que quieres subirle al personaje.<br><br>
		<b>Costo</b> - Se calcula automaticamente.<br><br>
		<b><span class="red">Recuerda que el personaje debe estar FUERA del juego para que no pierdas los Creditos. </span></b><br><br>
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
        <td width="40%" align="center">Niveles a Subir</td>
        <td width="40%" align="center">Costo</td>
		<td width="20%" align="center"></td>
		</tr>
		<tr>
		<td align=center><select class="select" name="guid" id="guid" style="width: 80%;">';

		echo $char;
		
		?>
        <script type="text/javascript">
		function ShardsTolvl()
		{
			var realm = <? echo $_POST['realm']; ?>;
		<?
			foreach ($lvlRate as $i => $value)
			{
				echo "if (realm == '".$i."') {var lvlrate = ".$value.";}";
			}
		?>
			document.getElementById('shards').value = Math.ceil(document.getElementById('lvl').value * lvlrate ) + ' Creditos';
		}
		</script>
        
        <?
        echo'</select>
		</td>
		<td align=center><input type="text" class="inp" name="lvl" id="lvl" onkeydown="javascript:ShardsTolvl();" onkeyup="javascript:ShardsTolvl();" size="15" style="width: 80%;"></td>
		<td align=center><input type="text" class="inp" name="shards" id="shards"  size="15" readonly="readonly" style="width: 80%;"></td>
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
else if (isNum($_POST['realm']) && isNum($_POST['guid']) && isNum($_POST['lvl']) && isset($cre_reward['lvl']))
{
	switchConnection(1,"realmd");
    
	foreach ($lvlRate as $i => $value)
	{
		if ($_POST['realm'] == $i)
			$price = ceil($_POST['lvl'] * $value);
	}

	$ac_id = $game_information[id];
	$shard = dbquery("SELECT * FROM cp_cre WHERE acid ='$ac_id'")or die("eror");
	$shard  = dbarray($shard);

	if($shard['cre'] >= $price)
	{
  
		switchConnection($_POST['realm'],"character");
		$char = dbquery("SELECT * FROM characters WHERE guid='$_POST[guid]' and account =$ac_id and online='0' limit 1 ")or die("eror") ;

		if(dbrows($char) != 0)
		{
			$ch = dbarray($char);
			$ch_lvl = $ch[level] + $_POST['lvl'];
			
			if ($ch_lvl > 80)
			{
		        echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td height="100"></td>
				</tr>
				<tr>
				<td align="center">
				<b><span class="red">La suma de nivel que quieres, da como resultado un nivel mayor al 80, por favor, recalcula el nivel y vuelve a intentarlo.</span></b>
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
				dbquery("UPDATE characters SET `level`= '$ch_lvl' WHERE guid='$_POST[guid]' limit 1")or die("eror") ;

				switchConnection(1,"realmd");
		        $value="Power leveleing ".$ch[level]."-".$ch_lvl;
		        dbquery("INSERT INTO cp_history (acid, type, com, ip, usluga, bns, realm, char_name, guid, estado) VALUES ($game_information[id], 1, $value, $_SERVER[REMOTE_ADDR], 0, 0, $_POST[realm], $ch[name], $_POST[guid], 1)");
				
				mysql_close();
		
	        	echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td height="100"></td>
				</tr>
				<tr>
				<td align="center">
				<b><span class="red">'.$ch[name].' Estaba en el Nivel '.$ch[level].', ahora esta en el Nivel '.$ch_lvl.' .</span></b>
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
			<b><span class="red">El personaje se Encuentra en linea, o no cumple los requisitos.</span></b>
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
		<b><span class="red">No tienes los Creditos suficientes.</span></b>
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
