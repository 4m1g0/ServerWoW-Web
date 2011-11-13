<?
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nano
 * Copyright: Nano
 * Email: Nano@serverwow.com
*/

if (isNum($_GET['realm']))
{
	switchConnection($_GET['realm'],"character");
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
		<b>Cambio de Cuenta</b><br><br><br><br>
		<b>Personaje</b> - Seleccionar el Personaje.<br><br>
		<b>Cuenta</b> - Escribir la Cuenta de Destino.<br><br>
	    <b>Costo</b> - Costo de la Operacion.<br><br>

		<b><span class="red">Asegurece de que ninguna de las dos cuentas estan siendo usadas, de lo contrario podria causar la PERDIDA del personaje</span></b><br><br>
		</td>
		</tr>
		<tr>
		<td height="15"></td>
		</tr>
		<tr>
		<td align="center">

		<table width="90%" class="smstable" border="0" cellpadding="0" cellspacing="0">
		<tr class="smstabletr">
		<td width="40%" align="center">Personaje</td>
        <td width="40%" align="center">Cuenta destino</td>
        <td width="40%" align="center">Costo</td>
		<td width="20%" align="center"></td>
		</tr>
		<tr>
		<td align=center><select class="select" name="select" id="accchar" style="width: 80%;">';

        echo $char;


        echo'</select>
        </td>
        <td align=center><input type="text" class="inp" name="acc" id="acc"  size="15" style="width: 80%;"></td>
        <td align=center><input type="text" class="inp" name="bonusesforrename" id="bonusesforrename" value="'.$cre_reward[acc][0].' Creditos" size="15" readonly style="width: 80%;"></td>
		<td align=center><input type="submit" class="submit" value="Solicitar" alt="Solicitar" title="Solicitar" style="width: 70px;" onClick="javascript:doacc();"></td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
		<td height="15"></td>
		</tr>
		</table>';
	}
	else
		echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td height="100"></td>
		</tr>
		<tr>
		<td align="center">
		<b><span class="red">Error</span></b>
		</td>
		</tr>
		</table>';
}
?>