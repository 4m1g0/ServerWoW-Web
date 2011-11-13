<?
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nano
 * Copyright: Nano
 * Email: Nano@serverwow.com
*/
/*require_once "../../../../configs.php";
require_once "../../../config/config.php";*/

require_once "configs.php";
require_once "services/config/config.php";

if(!$_SESSION['cp_login']) exit('Error');
if (isNum($_GET['id']) && isNum($_GET['char']) && isNum($_GET['realm']))
{
	switchConnection(1,"realmd");
    $query = dbquery("SELECT `item`, `set`, `price`, `name`, `value2` FROM cp_items WHERE id ='".$_GET[id]."'")or die("eror");
    $petition = dbarray($query);
    
    // For ITEMS
    if($petition['set']==0)
    {

	    $shard = dbquery("SELECT `cre` FROM cp_cre WHERE acid ='".$game_information[id]."' LIMIT 1")or die("eror");
	    $shard  = dbarray($shard);

	    if($shard['cre'] >= $petition['price'])
	    {
		    switchConnection($_GET['realm'],"character");

		    $char = dbquery("SELECT `name`, `money` FROM characters WHERE guid='$_GET[char]' and account ='".$game_information[id]."' AND `online`=0 limit 1 ")or die("eror");

		    if(dbrows($char) != 0)
		    {
		        $char=dbarray($char);
			    switchConnection(1,"realmd");
			    dbquery("UPDATE cp_cre SET cre=cre-$petition[price] WHERE acid='".$game_information[id]."'")or die("eror");
			    
                switchConnection($_GET['realm'],"character");
                if ($petition['item']){
			        $mail_id = ingame_mail($game_information['id'], $_GET['char'], $petition['name'], "Gracias por tu Donacion", 0, $petition['item'], 1, "m");
					$texto = "Tu petición esta en curso, puedes consultar su estado en el historial de envios.";
				}
			    else{
			        $gold = insert_gold($game_information['id'], $_GET['char'], $petition['value2']);
			        $money=floor($char['money']/10000);
					$texto = 'Tenías '.$money.' Oros, se han agregado '.$petition['value2'].' Oros más a tu personaje.';
					
					if ($gold)
					    $mail_id = 0;
				}
				
				switchConnection(1,"realmd");
			    dbquery("INSERT INTO cp_history (acid,sent_id,type,com,ip,usluga,bns,realm,char_name,guid,item,estado) VALUES ('$game_information[id]','$mail_id','1','$petition[name]','$_SERVER[REMOTE_ADDR]','0','0','$_GET[realm]','$char[name]','$_GET[char]','$petition[item]','0')");
			    
			
			    mysql_close();
			
			    echo $texto;
		    }
		    else
			    echo'El Personaje se encuentra en Linea.';
	    }
	    else
		    echo'No tienes los Creditos Suficientes.';
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

                $item_set=dbquery("SELECT item FROM cp_set_item where id ='".$petition['set']."' LIMIT 10")or die("eror");
                
                while($row=dbarray($item_set))
                {
                    $item[]= $row['item'];
                }
                
                switchConnection($_GET['realm'],"character");
			    $mail_id=ingame_mail($game_information['id'], $_GET['char'], $petition['name'], "Gracias por tu Donacion", 0, $item, 1, "m", 1);
				$texto = "Tu petición esta en curso, puedes consultar su estado en el historial de envios.";
			
			    switchConnection(1,"realmd");
			    dbquery("INSERT INTO cp_history (acid,sent_id,type,com,ip,usluga,bns,realm,char_name,guid,item,estado) VALUES ('$game_information[id]','$mail_id','1','$petition[name]','$_SERVER[REMOTE_ADDR]','0','0','$_GET[realm]','$char[name]','$_GET[char]','$petition[item]','0')");
			    
			
			    mysql_close();
			
			    echo $texto;
		    }
		    else
			    echo'El Personaje se encuentra en Linea.';
	    }
	    else
		    echo'No tienes los Creditos Suficientes.';
    }
}
else
	echo'Error.';
  ?>
