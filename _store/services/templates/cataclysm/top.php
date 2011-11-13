<? error_reporting(0);
 if($cp_login){
         if($datag['locked']==0)
		 	$lock="Locked <a href='#' onClick='lock(); return false'><Bloquear></a>"; else $lock="Desbloquear <a href='#' onClick='unlock(); return false'><Desbloquear</a>";
			
        $gm="Jugador";
        If($datag['gmlevel']==1)$gm="Moderador";
        If($datag['gmlevel']==2)$gm="Game Master";
        If($datag['gmlevel']==3)$gm="Dir Gm's";
		If($datag['gmlevel']==4)$gm="Sub Admin";
		If($datag['gmlevel']>4)$gm="Admin";
		 
        $result = dbquery("SELECT * FROM cp_cre WHERE acid ='$ac_id' limit 1")or die("eror") ;
		$shar = dbarray($result);
		 
        if(dbrows($result)==0)
		 	$shar['cre']=0;
			
		if($datag['accstat']==0)
			$acctive="Cuenta Activa";
		else
			$acctive="Cuenta Baneada";
		 

 echo" <div id='userinfo'><div class='content' align='left'><p>
  <p>Hola, <strong>$datag[username]</strong> (<a href='".$cp_url."logout.php'>Salir</a>)</p>
  <p>Nivel: $gm</p>
  <p>Creditos LCV: $shar[cre] Cre</p>
  <p>Ultima IP: $datag[last_ip]</p>
  <p>Estado: <a href='?p=8'>$acctive</a></p>  
  <p><span class='red'>Registro de Acciones:</span> <a href='".$cp_url."?p=7'>Logs</a></p></p></div></div>";
              }
  ?>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
    <td colspan="3" id="top"><? echo $site_name?> - Administracion de Cuenta</td>
  </tr>
  <tr>
    <td colspan="3"><img src="templates/<?echo $cp_template ?>/style/bg_header.jpg"></td>
  </tr>
  <tr>
    <td id="left">
<?include "templates/$cp_template/menu.php"?>
		</td>
		<td valign="top"><img src="templates/<?echo $cp_template ?>/style/bg_sepa.jpg" width="2" height="525"></td>
   <td id="right">
