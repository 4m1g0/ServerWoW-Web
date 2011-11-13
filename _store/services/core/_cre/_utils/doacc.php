<?
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nano
 * Copyright: Nano
 * Email: Nano@serverwow.com
*/
   
if (isNum($_GET['realm']) && isNum($_GET['guid']) && isset($_GET['acc']) && isset($cre_reward['acc']))
{
	switchConnection(1,"realmd");
	$price = $cre_reward[acc][0];

	$shard = dbquery("SELECT * FROM cp_cre WHERE acid ='$ac_id'")or die("eror") ;
    $shard  = dbarray($shard);

	if($shard['cre'] >= $price)
	{
		switchConnection($_GET['realm'],"character");

		$char = dbquery("SELECT * FROM characters WHERE guid='$_GET[guid]' and account =$ac_id and online='0' limit 1 ")or die("eror");

		if(dbrows($char) != 0)
		{
			switchConnection(1,"realmd");
			$n_acc = mysql_real_escape_string($_GET['acc']);
			$chkacc = dbquery("SELECT id FROM account WHERE username='$n_acc' ")or die("eror");

			if(dbrows($chkacc)!=0)
			{
				$id=dbresult($chkacc,0);
				switchConnection($_GET['realm'],"character");
				$chkcochar = dbquery("SELECT race FROM characters WHERE account='$id' order by guid desc ")or die("eror") ;
				
				if(dbrows($chkcochar) < $CharactersPerAccount)
				{
					$char=dbarray($char);
					
					if(!$CharactersTwoSide && dbrows($chkcochar)>0)
					{
						if(chfaction($char[race]) == chfaction(dbresult($chkcochar,0)))
						{
							switchConnection(1,"realmd");
							dbquery("UPDATE cp_shards SET shard=shard-$price WHERE acid='$ac_id'");
							
							switchConnection($_GET['realm'],"character");
    						dbquery("UPDATE characters SET `account`='$id' WHERE guid='$_GET[guid]' limit 1");
		
							$value="Cambio de Cuenta, Personaje $char[name], Precio $price";
							history($value,$ac_id,'acc',$price,$_GET['realm'],$_GET['guid']);
							
							mysql_close();
	
							echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
							<tr>
							<td height="100"></td>
							</tr>
							<tr>
							<td align="center">
							<b><span class="red">Cambio realizado Correctamente.</span></b>
							</td>
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
							<b><span class="red">Cambio NO realizado, No puedes tener Personajes de diferentes Facciones en la cuenta: <b>'.$_GET[acc].'</b>.</span></b>
							</td>
							</tr>
							</table>';
						}
					}
					else
					{
						switchConnection(1,"realmd");
						dbquery("UPDATE cp_shards SET shard=shard-$price WHERE acid='$ac_id'");
						
						switchConnection($_GET['realm'],"character");
						dbquery("UPDATE characters SET `account`='$id' WHERE guid='$_GET[guid]' limit 1");
			
						$value="Cambio de Cuenta, Personaje $char[name], Precio $price";
						history($value,$ac_id,'acc',$price,$_GET['realm'],$_GET['guid']);
						
						mysql_close();
			
						echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
						<tr>
						<td height="100"></td>
						</tr>
						<tr>
						<td align="center">
						<b><span class="red">Cambio realizado Correctamente.</span></b>
						</td>
						</tr>	
						</table>';
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
					<b><span class="red">La cuenta <b>'.$_GET[acc].'</b> Tiene el Maximo Permitido de personajes.</span></b>
					</td>
					</tr>
					</table>';
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
				<b><span class="red">La cuenta que digito: <b>'.$_GET[acc].'</b> NO es valida</span></b>
				</td>
				</tr>
				</table>';
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
			<b><span class="red">Error en a Consulta</span></b>
			</td>
			</tr>
			</table>';
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
		<b><span class="red">Error.</span></b>
		</td>
		</tr>
		</table>';
	}
}
?>
