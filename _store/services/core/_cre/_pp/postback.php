<?php
include ("config.php");
include ("../../../config/config.php");
set_time_limit(60);

function handlePayment()
{
	switchConnection(1,"realmd");

	$Itemcount = (int)$_POST['num_cart_items'];
	$Money = (float)$_POST['mc_gross'];
	$memo = $_POST['memo'];

	//Prevent txn_id recycling.
	$res = dbquery("SELECT COUNT(*) FROM cp_log_pp WHERE txn_id = '{$_POST['txn_id']}'");

	if(dbresult($res) != 0)
	{
		dbquery("INSERT INTO cp_log_pp (date,email,txn_id,status,amount,info) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','failed','{$_POST['mc_gross']}','This transaction id is a duplicate.')");
		die;
	}

	//Check payment status.
	if($_POST['payment_status'] != "Completed")
	{
		dbquery("INSERT INTO cp_log_pp (date,email,txn_id,status,amount,info) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','failed','{$_POST['mc_gross']}','Payment status was not \"Completed\", but \"{$_POST['payment_status']}\".')");
		die;
	}

	//Get realm info
	$res = dbquery("SELECT entry, name FROM cp_realms_pp");
	$i = 1;
	while($row = dbarray($res))
	{
		$Realms[$i] = $row;
		$i++;
	}

	//Get reward info
	$res = dbquery("SELECT entry,name,realm,price,item1,quantity1,item2,quantity2,item3,quantity3,gold FROM cp_items_pp");
	$i = 1;
	while($row = dbarray($res))
	{
		$Rewards[$i] = $row;
		$i++;
	}

	//Get info of each item.
	for($i = 1;$i<=$Itemcount;$i++)
	{
		$quantity = (int)$_POST['quantity'.$i];
		for($j = 0;$j<$quantity;$j++)
		{
			$info = explode("-",$_POST['item_number'.$i]);
			$Items[$j+$i-1]["id"] = (int)$info[1]; // reward id
			$Items[$j+$i-1]["realm"] = (int)$info[0]; // realm id
			$Items[$j+$i-1]["character"] = (int)$info[2]; // character guid
		}
	}

	//Check availability of rewards on realms.
	foreach($Items as $key => $value)
	{
		if((int)$Rewards[$value["id"]]["realm"] != $value["realm"])
		{
			dbquery("INSERT INTO cp_log_pp (date,email,txn_id,status,amount,info) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','failed','{$_POST['mc_gross']}','Requested reward id ".$value['id'].", which is not available on realm ".$value['realm'].".')");
			die;
		}
	}

	//Check total payment amount.
	$sum = 0;
	foreach($Items as $key => $value)
	{
		$sum += (float)$Rewards[$value["id"]]["price"];
	}

	if($sum > $Money)
	{
		$info = "";
		foreach($Items as $key => $value)
		{
			$info .= "Reward: ".$Rewards[$value['id']]['name']." Cost: ".$Rewards[$value['id']]['price']."<br>\n";
		}

		dbquery("INSERT INTO cp_log_pp (date,email,txn_id,status,amount,info) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','failed','{$_POST['mc_gross']}','Cost of rewards ({$sum}) was not paid in full:<br>\n{$info}')");
		die;
	}

	//Begin rewarding items.
	foreach($Items as $key => $value)
	{
		switchConnection(1,"realmd");

		$result_r = dbquery("SELECT id, username FROM account WHERE id = '{$value['character']}'");
		$row_r = dbarray($result_r);
		$usuario = $row_r["username"];
		$acid = $row_r["id"];

		$REWARDNAME = mysql_real_escape_string($Rewards[$value['id']]['name'],$ccon);

		$result = dbquery("SELECT cre, cre_used FROM cp_cre WHERE acid ='$acid' limit 1");

		if($result==FALSE)
		{
			die ("<BR>Hay errores en la consulta sql");
		}
		elseif (dbrows($result) < 1)
		{   
			$bandera = TRUE;
			$actualizar = FALSE;
			$cre_number = 0;
		}
		else
		{   
			$bandera = FALSE;
			$actualizar = TRUE;
			$cre_number = 0;
		}
		
		$cel = 0;
		$promo = 0;
			
		// Ingreso de Recompenza
		if($value['id'] == 1)
		{
			$cre_number = 10; if($promo==1){$cre_number = $cre_number * 2;}

			if ($bandera==TRUE){
				dbquery("INSERT INTO cp_cre (acid, cre, cre_used) VALUES ('$acid', '$cre_number', '$cre_number')");
			}
			if ($actualizar==TRUE){
				dbquery("UPDATE cp_cre SET cre=cre+'$cre_number', cre_used=cre_used+'$cre_number' WHERE acid='$acid'");
			}
		}
		
		if($value['id'] == 2)
		{
			$cre_number = 20; if($promo==1){$cre_number = $cre_number * 2;}

			if ($bandera==TRUE){
				dbquery("INSERT INTO cp_cre (acid, cre, cre_used) VALUES ('$acid', '$cre_number', '$cre_number')");
			}
			if ($actualizar==TRUE){
				dbquery("UPDATE cp_cre SET cre=cre+'$cre_number', cre_used=cre_used+'$cre_number' WHERE acid='$acid'");
			}
		}

		if($value['id'] == 3)
		{
			$cre_number = 50; if($promo==1){$cre_number = $cre_number * 2;}

			if ($bandera==TRUE){
				dbquery("INSERT INTO cp_cre (acid, cre, cre_used) VALUES ('$acid', '$cre_number', '$cre_number')");
			}
			if ($actualizar==TRUE){
				dbquery("UPDATE cp_cre SET cre=cre+'$cre_number', cre_used=cre_used+'$cre_number' WHERE acid='$acid'");
			}
		}
		
		if($value['id'] == 4)
		{
			$cre_number = 75; if($promo==1){$cre_number = $cre_number * 2;}

			if ($bandera==TRUE){
				dbquery("INSERT INTO cp_cre (acid, cre, cre_used) VALUES ('$acid', '$cre_number', '$cre_number')");
			}
			if ($actualizar==TRUE){
				dbquery("UPDATE cp_cre SET cre=cre+'$cre_number', cre_used=cre_used+'$cre_number' WHERE acid='$acid'");
			}
		}
		
		if($value['id'] == 5)
		{
			$cre_number = 100; if($promo==1){$cre_number = $cre_number * 2;}

			if ($bandera==TRUE){
				dbquery("INSERT INTO cp_cre (acid, cre, cre_used) VALUES ('$acid', '$cre_number', '$cre_number')");
			}
			if ($actualizar==TRUE){
				dbquery("UPDATE cp_cre SET cre=cre+'$cre_number', cre_used=cre_used+'$cre_number' WHERE acid='$acid'");
			}
		}
		
		if($value['id'] == 6)
		{
			$cre_number = 200; if($promo==1){$cre_number = $cre_number * 2;}

			if ($bandera==TRUE){
				dbquery("INSERT INTO cp_cre (acid, cre, cre_used) VALUES ('$acid', '$cre_number', '$cre_number')");
			}
			if ($actualizar==TRUE){
				dbquery("UPDATE cp_cre SET cre=cre+'$cre_number', cre_used=cre_used+'$cre_number' WHERE acid='$acid'");
			}
		}
			
			if ($value['id'] == '1' || $value['id'] == '2' || $value['id'] == '3' || $value['id'] == '4' || $value['id'] == '5' || $value['id'] == '6')
			{
				$codigo = "ID: {$_POST['txn_id']} - Creditos:$cre_number - Promo:$promo";
				/*$codigo = "PRUEBA 1";*/
					
				dbquery("INSERT INTO cp_sms_log (acid, codigo, system, date) VALUES ('$acid', '$codigo', 'PAYPAL', NOW())");
			}
	}

	//log time
	$Info = "Successful transaction:<br>\n";
	foreach($Items as $key => $value)
	{
		$Info .= mysql_real_escape_string($Rewards[$value['id']]['name'],$Con)."<br>\n";
	}
	switchConnection(1,"realmd");
	
	dbquery("INSERT INTO cp_log_pp (date,email,txn_id,status,amount,info,memo) VALUES (NOW(),'{$_POST['payer_email']}','{$_POST['txn_id']}','completed','{$_POST['mc_gross']}','{$Info}','{$memo}')");
}

function handleInvalidPayment()
{
	switchConnection(1,"realmd");

	$Info = "";
	foreach($_POST as $key => $value)
	{
		$Info .= "{$key} = {$value} <br>\n";
	}
	dbquery("INSERT INTO cp_log_pp (date,status,info) VALUES (NOW(),'invalid','An invalid request was made. Postdata info:<br>\n{$Info}')");
}

function verifyPayment()
{
	if(sizeof($_POST) == 0)
	{
		//dont bother, maybe an accidental page visit.
		?><h1>Restricted Area</h1>
		<p>You are not permitted to access this page.</p><?php
		return;
	}

	$Postback = "cmd=_notify-validate";
	foreach($_POST as $key => $value)
	{
		$key = urlencode(stripslashes($key));
		$value = urlencode(stripslashes($value));
		$Postback .= "&{$key}={$value}";
	}

	$Sock = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);
	if(!$Sock)
	{
		//handleInvalidPayment();
	}

	// post back to PayPal system to validate
	$Head .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$Head .= "Content-type: application/x-www-form-urlencoded\r\n";
	$Head .= "Content-length: ".strlen($Postback)."\r\n\r\n";
	fputs($Sock,$Head.$Postback,strlen($Head.$Postback));

	while(!feof($Sock))
	{
		$txt = fgets($Sock,1024);
		if(strcmp($txt,"VERIFIED") == 0)
		{
			handlePayment();
		}
		elseif(strcmp($txt,"INVALID") == 0)
		{
			handleInvalidPayment();
		}
	}
	fclose($Sock);
}

verifyPayment();

?>