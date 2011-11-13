<div style="min-height:50px;" class="section-title">
    <span>Estado de Cuenta</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, En esta página puedes ver el estado actual de tu cuenta.</p>
</div>
<span class="clear"><!-- --></span>
<div>
  <div align="center">
    <?
if(!$_SESSION['cp_login']) exit();
error_reporting(0);
function getLocale($locale)
{
  switch ($locale):
      case 0:
      $locale = "English";
      break;
    case 1:
      $locale = "Korean";
      break;
    case 6:
      $locale = "Spanish";
      break;
    case 7:
      $locale = "Spanish Mexico";
      break;
    case 8:
      $locale = "Russian";
      break;
  endswitch;

return $locale;
}

function getExpansion($typ)
{
  switch ($typ):
    case 0:
    $typ = "World of Warcraft";
    break;
    case 1:
    $typ = "World of Warcraft the Burning Crusade";
    break;
    case 2:
    $typ = "World of Warcraft Wrath of the Lich King";
    break;
  endswitch;
  
return $typ;
}

switchConnection(1,"realmd");
$account = dbarray(dbquery("SELECT * FROM account WHERE id=$account_information[id] LIMIT 1"));
$account_banned = dbarray(dbquery("SELECT * FROM account_banned WHERE unbandate=(SELECT MAX(unbandate) FROM account_banned WHERE active=1 AND id=$account_information[id])"));

$email = $account["email"];
$typ = getExpansion($account["expansion"]);
$join_date = $account["joindate"];
$last_login = $account["last_login"]; 
$last_ip = $account["last_ip"];  
$locked = $account["locked"]; 
$online = $account["online"];
$sms_user = $account["username"];
@$locale = getLocale($account["locale"]);
// Baneado
$bandate = $account_banned["bandate"];
$unbandate = $account_banned["unbandate"];
$bannedby = $account_banned["bannedby"];
$banreason = $account_banned["banreason"];

if ($account_banned!=''){$ban = "<font color='red'>Cuenta Baneada</font>";}
   else{$ban = "<font color='green'>Cuenta Activa</font>";}
   
if ($locked == "0"){$locked = "<font color='red'><span title=''>Cuenta sin Bloqueo</span></font>";}
elseif($locked == "1"){$locked = "<font color='green'><span title=''>Cuenta Bloqueada</span></font>";}

if ($online == "0"){$online = "Fuera";}
elseif($online == "1"){$online = "<font color='green'>En Linea</font>";}
?>
    <table border="0" width="70%">
      <tr valign="top" align="left" class="browntext" height="20"><th>Expansion: </th><td class=greyText><? echo $typ; ?></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><th>Correo: </th><td class=greyText><? echo $email; ?></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><td colspan="2" height="12" valign="center"><img src="images/content-separator.png"></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><th>Fecha de Ingreso: </th><td class=greyText><? echo $join_date; ?></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><th>Ultimo Ingreso: </th><td class=greyText><? echo $last_login; ?></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><th>Ultima IP: </th><td class=greyText><? echo $last_ip; ?></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><td colspan="2" height="12" valign="center"><img src="images/content-separator.png"></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><th>Bloqueado: </th><td class=greyText><? echo $locked; ?></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><th>Estado de Cuenta: </th><td class=greyText><? echo $ban; ?></td></tr>
      <?php
if ($account_banned!="")
{
	echo "<tr valign='top' align='left' height='20'><th colspan=2 class=ban><b>Fecha de Baneo:</b> ".date('d-m-Y G:i', $bandate)." | <b>Fecha de Desbaneo:</b> ".date('d-m-Y G:i', $unbandate)." <br> <b>Baneado por:</b> $bannedby<br> <b>Razon:</b> $banreason</th></tr>";
} ?>
      <tr valign="top" align="left" class="browntext" height="20"><th>Estado: </th><td class=greyText><? echo $online; ?></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><th>Lenguaje: </th><td class=greyText><? echo $locale; ?></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><td colspan="2" height="12" valign="center"><img src="images/content-separator.png"></td></tr>
      <tr valign="top" align="left" class="browntext" height="20"><th>VIP: </th><td class=greyText>No</td></tr>
    </table>
  </div>
</div>