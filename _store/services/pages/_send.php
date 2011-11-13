<?
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nano
 * Copyright: Nano
 * Email: Nano@serverwow.com
*/
if(!$_SESSION['cp_login']) exit();
if (isNum($_GET['id']) && isNum($_GET['char']) && isNum($_GET['realm']))
{
    $query = dbquery("SELECT `item`, `set`, `price`, `name`, `value2` FROM cp_items WHERE id ='".$_GET[id]."'")or die("eror");
    $petition = dbarray($query);
    
    // For ITEMS
    if($petition['set']==0)
    {

	    $shard = dbquery("SELECT `cre` FROM cp_cre WHERE acid ='".$game_information[id]."'")or die("eror");
	    $shard  = dbarray($shard);

	    if($shard['cre'] >= $petition['price'])
	    {
		    switchConnection($_GET['realm'],"character");

		    $char = dbquery("SELECT `guid`, `name` FROM characters WHERE guid='$_GET[char]' and account ='".$game_information[id]."' and online='0' limit 1 ")or die("eror");

		    if(dbrows($char) != 0)
		    {
			    switchConnection(1,"realmd");
			    dbquery("UPDATE cp_cre SET cre=cre-$petition[price] WHERE acid='".$game_information[id]."'")or die("eror");
			    
                switchConnection($_GET['realm'],"character");
                if ($petition[item])
			        $mail_id=ingame_mail($game_information['id'], $_GET['char'], $petition['name'], "Gracias por tu Donacion", 0, $petition['item'], 1, "m");
			    else
			        $gold=insert_gold($game_information['id'], $_GET['char'], $petition['value2']);
			
			    switchConnection(1,"realmd");
			    dbquery("INSERT INTO cp_history (acid,sent_id,type,com,ip,usluga,bns,realm,char_name,guid,item,estado) VALUES ('$game_information[id]','$mail_id','1','$petition[name]','$_SERVER[REMOTE_ADDR]','0','0','$_GET[realm]','$char[name]','$_GET[char]','$petition[item]','0')");
			    
			
			    mysql_close();
			
			    echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
			    <tr>
			    <td height="100"></td>
			    </tr>
			    <tr>
			    <td align="center">
			    <b><span class="red">Item Enviado Correctamente.</span></b>
			    </td>
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
			    <b><span class="red">El Personaje se encuentra en Linea.</span></b>
			    </td>
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
		    <b><span class="red">No tienes los Creditos Suficientes.</span></b>
		    </td>
		    </tr>
		    </table>';
    }else // FOR SETS
    {
        
    $shard = dbquery("SELECT `cre` FROM cp_cre WHERE acid ='".$game_information[id]."'")or die("eror");
	    $shard  = dbarray($shard);

	    if($shard['cre'] >= $petition['price'])
	    {
		    switchConnection($_GET['realm'],"character");

		    $char = dbquery("SELECT `guid`, `name` FROM characters WHERE guid='$_GET[char]' and account ='".$game_information[id]."' and online='0' limit 1 ")or die("eror");

		    if(dbrows($char) != 0)
		    {
			    switchConnection(1,"realmd");
			    dbquery("UPDATE cp_cre SET cre=cre-$petition[price] WHERE acid='".$game_information[id]."'")or die("eror");

                $item_set=dbquery("SELECT item FROM set_item where id ='".$petition['set']."' LIMIT 10")or die("eror");
                
                while($row=dbarray($item_set))
                {
                    $item[]= $row['item'];
                }
                
                switchConnection($_GET['realm'],"character");
			    $mail_id=ingame_mail($game_information['id'], $_GET['char'], $petition['name'], "Gracias por tu Donacion", 0, $item, 1, "m", 1);
			
			    switchConnection(1,"realmd");
			    dbquery("INSERT INTO cp_history (acid,sent_id,type,com,ip,usluga,bns,realm,char_name,guid,item,estado) VALUES ('$game_information[id]','$mail_id','1','$petition[name]','$_SERVER[REMOTE_ADDR]','0','0','$_GET[realm]','$char[name]','$_GET[char]','$petition[item]','0')");
			    
			
			    mysql_close();
			
			    echo'<table width="100%" align="center" cellpadding="0" cellspacing="0">
			    <tr>
			    <td height="100"></td>
			    </tr>
			    <tr>
			    <td align="center">
			    <b><span class="red">Item Enviado Correctamente.</span></b>
			    </td>
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
			    <b><span class="red">El Personaje se encuentra en Linea.</span></b>
			    </td>
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
		    <b><span class="red">No tienes los Creditos Suficientes.</span></b>
		    </td>
		    </tr>
		    </table>';
    
    }
}
else
	echo'<table width="100%" align="center" cellpadding="0" cellspacing="0"><tr><td height="100"></td></tr><tr><td align="center"><b><span class="red">Error.</span></b></td></tr></table>';
  ?>
