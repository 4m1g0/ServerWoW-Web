<?
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nache
 * Copyright: Nache
 * Email: nache@wowlcv.com
*/

error_reporting(0);

// Incluir Los Worlds (Multi Reino Support)
foreach($world_db as $key => $val)
{
	$world_Host[$val[0]] = $val[3];
	$world_User[$val[0]] = $val[1];
	$world_Password[$val[0]] = $val[2];
	$worldDB[$val[0]] = $val[4];
}
// Incluir Los Chars (Multi Reino Support)
foreach($characters_db as $key => $val)
{
	$characters_Host[$val[0]] = $val[3];
	$characters_User[$val[0]] = $val[1];
	$characters_Password[$val[0]] = $val[2];
	$charactersDB[$val[0]] = $val[4];
}

function switchConnection($key, $db_type)
{
	global $realm_db, $CurrentConnection, $CurrentDB;
	global $world_Host, $world_User,$world_Password,$worldDB;
	global $characters_Host, $characters_User,$characters_Password,$charactersDB;
	global $web_db;

    mysql_close();
	if($db_type == 'character')
	{
		mysql_connect($characters_Host[$key], $characters_User[$key], $characters_Password[$key]) or die("Unable to connect to SQL host: ".mysql_error());
        mysql_select_db($charactersDB[$key]) or die("Unable to connect to Character SQL database: ".mysql_error());
	}
    else if($db_type == 'world')
	{
		mysql_connect($world_Host[$key], $world_User[$key], $world_Password[$key]) or die("Unable to connect to SQL host: ".mysql_error());
		mysql_select_db($worldDB[$key]) or die("Unable to connect to World SQL database: ".mysql_error());
	}
    else if($db_type == 'realmd')
	{
		mysql_connect($realm_db['addr'], $realm_db['user'], $realm_db['pass']) or die("Unable to connect to SQL host: ".mysql_error());
        mysql_select_db($realm_db['name']) or die("Unable to connect to Realm SQL database: ".mysql_error());
	}
	else if($db_type == 'web_db')
	{
	    mysql_connect($web_db['addr'], $web_db['user'], $web_db['pass']) or die("Unable to connect to SQL host: ".mysql_error());
        mysql_select_db($web_db['name']) or die("Unable to connect to Realm SQL database: ".mysql_error());
	}

		mysql_query("SET CHARACTER SET $encoding");
		mysql_query("SET NAMES '$encoding'");
}

function dbconnect($db_host, $db_user, $db_pass, $db_name) 
{
	$db_connect = @mysql_connect($db_host, $db_user, $db_pass);
	$db_select = @mysql_select_db($db_name);

	if (!$db_connect) 
	{
		die("<div style='font-family:Verdana;font-size:11px;text-align:center;'><b>Unable to establish connection to MySQL</b><br>".mysql_errno()." : ".mysql_error()."</div>");
	}
	elseif (!$db_select)
	{
		die("<div style='font-family:Verdana;font-size:11px;text-align:center;'><b>Unable to select MySQL database</b><br>".mysql_errno()." : ".mysql_error()."</div>");
	}
}

function dbquery($query)
{
	$result = @mysql_query($query);
	if (!$result)
	{
		echo mysql_error();
		return false;
	}
	else
	{
		return $result;
	}
}

function dbcount($field,$table,$conditions="")
{
	$cond = ($conditions ? " WHERE ".$conditions : "");
	$result = @mysql_query("SELECT Count".$field." FROM ".$table.$cond);
	if (!$result)
	{
		echo mysql_error();
		return false;
	}
	else
	{
		$rows = mysql_result($result, 0);
		return $rows;
	}
}

function dbresult($query, $row)
{
	$result = @mysql_result($query, $row);
	if (!$result)
	{
		echo mysql_error();
		return false;
	}
	else
	{
		return $result;
	}
}

function dbrows($query)
{
	$result = @mysql_num_rows($query);
	return $result;
}

function dbarray($query)
{
	$result = @mysql_fetch_assoc($query);
	if (!$result)
	{
		echo mysql_error();
		return false;
	}
	else
	{
		return $result;
	}
}

function dbarraynum($query)
{
	$result = @mysql_fetch_row($query);
	if (!$result)
	{
		echo mysql_error();
		return false;
	} 
	else
	{
		return $result;
	}
}

function stripinput($text)
{
	if (QUOTES_GPC) $text = stripslashes($text);
	$search = array("\"", "'", "\\", '\"', "\'", "<", ">", "&nbsp;");
	$replace = array("&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;", " ");
	$text = str_replace($search, $replace, $text);
	return $text;
}

function redirect($location, $type="header")
{
	if ($type == "header")
	{
		header("Location: ".$location);
	}
	else
	{
		echo "<script type='text/javascript'>document.location.href='".$location."'</script>\n";
	}
}
function isNum($value)
{
	return (preg_match("/^[0-9]+$/", $value));
}

function isLetr($value)
{
	return (preg_match("/^[a-z|A-Z|a-ÿ|À-ß]+$/", $value));
}

function history($value,$acid,$usluga=0,$bns=0,$realm=0,$guid=0)
{
        // $value = win2151_to_utf8($value);
		dbquery("INSERT INTO cp_history (acid,com,ip,usluga,bns,realm,guid) VALUES ('$acid','$value','$_SERVER[REMOTE_ADDR]','$usluga','$bns','$realm','$guid')");
}

function send_mail($admin_username="", $admin_email="", $username="", $email="", $pass="", $user_code="", $type="", $subject="", $message="")
{
	global $from,$site_name,$email_subject_sendpass,$email_body_sendpass,$site_url,$email_body_sendmail;
	require_once ("phpmailer/mail.php"); 
	
	$from = "noreply@wowlcv.com";
	
	if($type=="sendpass")
	{
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "X-Mailer: PHP's mail() Function\r\n";
		$headers .= "From: $from\r\n";
		$site_url = $website['address'];

		$email_body_sendpass = str_replace("[DATE]", date("Y-m-d H:i:s",time()), $email_body_sendpass);
		$email_body_sendpass = str_replace("[USERNAME]", $username, $email_body_sendpass);
		$email_body_sendpass = str_replace("[EMAIL]", $email, $email_body_sendpass);
		$email_body_sendpass = str_replace("[USERPASS]", $pass, $email_body_sendpass);
		$email_body_sendpass = str_replace("[USERCODE]", $user_code, $email_body_sendpass);
		$email_body_sendpass = str_replace("[REMOTE_ADDR]", $_SERVER['REMOTE_ADDR'], $email_body_sendpass);
		$email_body_sendpass = str_replace("[SITE_URL]", $site_url, $email_body_sendpass);
        
		$msg = array();
		$msg['from_email'] = $from;
		$msg['from_name'] = "Administracion de Cuenta - WoW LCV";
		$msg['to_email'] = $email;
		$msg['to_name'] = $username;
		$msg['subject'] = 'Recuperacion de Clave - "'.$username.'"';
		$msg['body'] = $email_body_sendpass;
		
		$mail = new mail();
		$mail->send($msg, $headers);
		
		return TRUE;
	}

   if($type=="sendmail")
   {
   		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "X-Mailer: PHP's mail() Function\r\n";
		$headers .= "From: $email\r\n";
		$site_url = $website['address'];
		
		$email_body_sendmail = str_replace("[USERNAME]", $username, $email_body_sendmail);
		$email_body_sendmail = str_replace("[MESSAGE]", $message, $email_body_sendmail);
		$email_body_sendmail = str_replace("[REMOTE_ADDR]", $_SERVER['REMOTE_ADDR'], $email_body_sendmail);
		$email_body_sendpass = str_replace("[SITE_URL]", $site_url, $email_body_sendpass);
               
		$msg = array();
		$msg['from_email'] = $email;
		$msg['from_name'] =  $username;
		$msg['to_email'] = $admin_email;
		$msg['to_name'] = $admin_username;
		$msg['subject'] = 'Envio de Ticket de - "'.$username.'"';
		$msg['body'] = $email_body_sendmail;
		
		$mail = new mail();
		$mail->send($msg, $headers);
		
		return TRUE;
	}
	
	if($type=="changemail")
   {
        $headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "X-Mailer: PHP's mail() Function\r\n";
		$headers .= "From: $email\r\n";
		
		$email_body_changemail = str_replace("[DATE]", date("Y-m-d H:i:s",time()), $email_body_changemail);
		$email_body_changemail = str_replace("[USERNAME]", $username, $email_body_changemail);
		$email_body_changemail = str_replace("[EMAIL]", $email, $email_body_changemail);
		$email_body_changemail = str_replace("[USERMAIL]", $pass, $email_body_changemail);
		$email_body_changemail = str_replace("[USERCODE]", $user_code, $email_body_changemail);
		$email_body_changemail = str_replace("[REMOTE_ADDR]", $_SERVER['REMOTE_ADDR'], $email_body_changemail);
		$email_body_changemail = str_replace("[SITE_URL]", $site_url, $email_body_changemail);
                
		$msg = array();
		$msg['from_email'] = $from;
		$msg['from_name'] = "Administracion de Cuenta - WoW LCV";
		$msg['to_email'] = $email;
		$msg['to_name'] = $username;
		$msg['subject'] = 'Cambio de correo - "'.$username.'"';
		$msg['body'] = $email_body_changemail;
		
		$mail = new mail();
		$mail->send($msg, $headers);
		
		return TRUE;
   }
}

function random_password()
{  
  $longitud = 12; // longitud del password  
  $new_pass = substr(md5(rand()),0,$longitud);  
  return($new_pass); // devuelve el password   
}  


function open()
{
	$open = array('d293LmNsbi5ydQ==','d293Lmljbi5vZC51YQ==','Y29udHJvbC52aXJnaW4td293LnJ1','YmFja2tvci5ydQ==','d293LXdvcmxkLnJ1','Z2FtZXMucmlhbGNvbS5uZXQ=','d293Lmljbi5vZC51YQ==','d293bWFyeW5vLnJ1','d293LW5zay5ydQ==',);
	$url = "http://".$_SERVER['HTTP_HOST']."/";
	$parse_url = parse_url($url);
	$host = $parse_url['host'];
	
	while (list($key, $val) = each($open))
	{
		if($host == base64_decode($val))
		{
			die(base64_decode('wuD4IOTu7OXtIOLw5ezl7e3uIOfg4evu6ujw7uLg7S4gz/Do9+jt4Dog6Ofs5e3l7ejlIOru7+jw4Ony7uIu'));
		};
	}
}

function convert_charset($item)
{
	if ($unserialize = unserialize($item))
	{
		foreach ($unserialize as $key => $value)
		{
			$unserialize[$key] = @iconv('windows-1256', 'UTF-8', $value);
		}

			$serialize = serialize($unserialize);
            return $serialize;
	}
	else
	{
		return @iconv('windows-1256', 'UTF-8', $item);
	}
}

function getGold($money)
{  
	$g = floor( $money / (100*100) );
	$money = $money - $g*100*100;
	$s = floor( $money / 100 );
	$money = $money - $s*100;
	$c = floor( $money );
	return sprintf("<b>%d<img src=\"services/img/gold.png\">&nbsp;%02d<img src=\"services/img/silver.png\">&nbsp;%02d<img src=\"services/img/copper.png\"></b>", $g, $s, $c);
}

function chfaction($race)
{
	$aliance=array(1,3,4,7,11);
    if(!in_array($race,$aliance))
		return 1; 
	else
		return 0;
}

function new_id($type)
{
	global  $db_characters,$realm;
	switchConnection($_GET['realm'],"character");
	
	switch ($type)
	{
		case 'mail_external':
			$result = dbquery("SELECT MAX(id) FROM mail_external");
			$guid = $result++;
			return $guid;
		break;
	}
}

function ingame_mail($ac_id, $to, $subject, $body, $gold = 0, $item = 0, $stack = 1, $type, $set=0)
{
	global  $db_characters, $realm;
	
	$date = date("Y-m-d");

	/*if($set!=0){
    	foreach($set as $i){
			$item_guid[] = $i;
		}
	}
	else{
			$item_guid = $item;
	}*/
                     
	if ($item == 0){
		$has_items = 0;
	}
	else{
		$has_items = 1;
	}

	if($set!=0)
	{
		$r=0;
		
		foreach($item as $i){
		    $result = dbquery("INSERT INTO `mail_external` (`acct`, `receiver`, `subject`, `message`, `money`, `item`, `item_count`, `date`) VALUES ('$ac_id', '$to', '$subject', '$body', '0', '$i', '1', '$date')");
            $r++;
		}
	}
	elseif($has_items){
	    $result = dbquery("INSERT INTO `mail_external` (`acct`, `receiver`, `subject`, `message`, `money`, `item`, `item_count`, `date`) VALUES ('$ac_id', '$to', '$subject', '$body', '0', '$item', '1', '$date')");
	}
	if ($result)
	{
	    $result = dbquery("SELECT `id` FROM `mail_external` WHERE `acct` = '$ac_id' ORDER BY id DESC LIMIT 1");
	    $mail=dbarray($result);
	    return $mail[id];
	}else return 0;
}

function GetAccountChars($accid){
    $name = mysql_query("SELECT `guid`,`name` FROM characters WHERE account='$accid' ")or die("eror");
	while ($datac = mysql_fetch_array($name))
	{
		echo"<option value='$datac[guid]'>$datac[name]</option>";
	}
}

function getImages($setid){
    $query=mysql_query("SELECT img FROM set_item WHERE id='.$setid.'");
    while($data = mysql_fetch_array($name))
    {
        $images.='<img src="'.$data[img].'"> ';
    }
    return $images;
}

function insert_gold($ac_id, $char, $gold)
{
    $copper=$gold*10000;
    $result = dbquery("UPDATE `characters` SET `money`=`money`+".$copper." WHERE `guid`='".$char."'");
	if ($result)
		return TRUE;
}

function getClass($classid)
{
    switch($classid)
    {
        case 1:
            return 'Guerrero';
        case 2:
            return 'Paladín';
        case 3:
            return 'Cazador';
        case 4:
            return 'Pícaro';
        case 5:
            return 'Sacerdote';
        case 6:
            return 'Dk';
        case 7:
            return 'Chamán';
        case 8:
            return 'Mago';
        case 9:
            return 'Brujo';
        case 11:
            return 'Druida';
    }    
}

?>
