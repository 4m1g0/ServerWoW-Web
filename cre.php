<div class="section-title">
<span>Obtener creditos</span>
<p>Hola <?php echo $_SESSION['username']; ?>, con esta opción puedes obtener créditos por SMS y/o telefono, por cada SMS/llamada que realices te dictarán un codigo. Pondremos un crédito en tu cuenta por cada codigo que obtengas, selecciona tu pais y empeza.</p>
</div>
 <span class="clear"><!-- --></span>
<?
if(!$_SESSION['cp_login']) exit();

$codigo_allopass = mysql_real_escape_string($_POST["codigo_allopass"]);
$codigo_sepomo = mysql_real_escape_string($_POST["codigo_sepomo"]);

function check_code($codigo)
{
	$query = dbquery("SELECT * FROM cp_sms_log WHERE codigo='$codigo'");
	if (mysql_num_rows($query)>0)
	{
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}

if ($_SESSION['cp_cre_valid_restart'] == TRUE)
{
	unset($_POST["codigo_allopass"]);
	unset($_POST["codigo_sepomo"]);
	$_SESSION['cp_cre_valid_restart'] = FALSE;
	?><meta http-equiv="refresh" content="0"><?php
}
elseif (isset($game_information['id']) && trim($codigo_allopass != "") && $_SESSION['cp_cre_valid_restart']==FALSE)
{
	$codigo = $codigo_allopass;
	if (check_code($codigo)) // Prevent Web Hach
	{
		$auth = urlencode("251040/989132/4580667");
		$r = @file("http://payment.allopass.com/acte/access.apu?ids=251040&idd=989132&code[]=".$codigo);
		$r = @file("http://payment.allopass.com/api/checkcode.apu?code=$codigo&auth=$auth");
		
		if (substr($r[0],0,2) != "OK")
		{
			echo "<center><font color=red>El Codigo NO es Valido o Ya fue usado!</font></center><br>";
			?><meta http-equiv="refresh" content="5"><?php
			# Develop here the action you want to perform when the PIN is NOT Valid
		}
		else
		{
			# Here, you may wish to store the validation code in case of dispute.   
			$date = date("Y-m-d");
			$cel = 0;
		
			$result = dbquery("SELECT cre FROM cp_cre WHERE acid ='".$game_information['id']."' limit 1")or die("eror") ;

			if($result==FALSE)
			{
				echo "<center><font color=red>Hay errores en la consulta sql</font></center><br>";
			}
			elseif(mysql_num_rows($result)<1)
			{   
				$_SESSION['cp_cre_valid_restart'] = TRUE;
	    		dbquery("INSERT INTO cp_cre VALUES ('".$game_information['id']."', 1+".$promo.", 1+".$promo.")")or die("eror");
    		}
			else
			{
				$_SESSION['cp_cre_valid_restart'] = TRUE;
		    	dbquery("UPDATE cp_cre SET `cre`=`cre`+1+".$promo.", `cre_used`=`cre_used`+1+".$promo." WHERE `acid`='".$game_information['id']."'");
        	}
				$query = dbquery("INSERT INTO cp_sms_log (acid, codigo, cel, system, date) VALUES ('".$game_information['id']."', '$codigo', '$cel', 'AlloPass', '$date')");

				if ($query)
				{
					echo "<center><font color=red>Codigo Ingresado Correctamente.</font></center><br>";
					?><meta http-equiv="refresh" content="4"><?php
				}
		}
	}
	else
	{
		$_SESSION['cp_cre_valid_restart'] = TRUE;
		echo "<center><font color=red>El Codigo que ingresaste ya se ha usado.</font></center><br>";
	}
}
elseif (isset($game_information['id']) && trim($codigo_sepomo != "") && $_SESSION['cp_cre_valid_restart']==FALSE)
{
	# The next three lines aren't obligatory but they exist to remove some possible problems
	# in copying the code from the mobile into the form.
	$codigo = strtoupper($codigo_sepomo);
	$codigo = str_replace(" ","",$codigo);
	$codigo = htmlentities($codigo);
	if (check_code($codigo)) // Prevent Web Hach
	{
		$fp = fsockopen ("69.36.9.147", 8090, $errno, $errstr, 30); # Abre el socket para la conexión http
		if (!$fp) 
		{
			# The next line shows an error message if connection with the Sepomo server cannot be established
   			echo "<center><font color=red>$errstr ($errno)<br>\n</font></center><br>";
		}
		else 
		{
			# Once the connection is established, the next lines send the access code 
			# and the client code (ZD) for validation, and wait for the response.
			$query="codigo=$codigo&cliente=SETA6";
			$request = "GET /clientes/SMS_API_OUT.jsp" . "?" . "$query" . " HTTP/1.1\r\n";
			$request .= "Host: 69.36.9.147\r\n\r\n";

	   		fputs ($fp, $request);

			while (!feof($fp)) 
   			{
	    	  	$cadena.= fgets ($fp,4096);

				if (substr_count($cadena, "<valor>") > 0) 
					break;
	   		}
	   	}
		
    	fclose ($fp);
		$comodin = explode("<codigo>",$cadena);
		$comodin2 = explode("</codigo>",$comodin[1]);
		$resultado = $comodin2[0];
		$comodin = explode("<valor>",$cadena);
		$comodin2 = explode("</valor>",$comodin[1]);
		$codval = $comodin2[0];

		# The resulting parameter contains the server response 
		# If it's a 1, the code is valid and it's the first time it's been used
		# If it's a 2, the code is valid and it's been used before 
		# If it's a 3, the code is not valid 
		# The parameter codval contains the validation code which is the Sepomo authorisation for payment.
		# This parameter appears if the value if the parameter valor is 1.
		# If valor is 2, codval contains the date the code was first validated, in timestamp format. 
		$error = "Sin respuesta";
		if ($resultado == "2") 
		{
			$error="<center><font color=#000000 size=2 face=arial><b>El código ya esta ha sido usado.</b></font></center><br>";
		}
		if ($resultado == "3")
		{
			$error="<center><font color=#000000 size=2 face=arial><b>¡Lo siento el codigo es invalido!</b></font></center><br>";
			echo $error;
		}
		if ($resultado == "1")
		{
			# Here, you may wish to store the validation code in case of dispute.   
			# Also, this is where you put the code for execution once the user has paid. In this case, downloading a file.
			$date = date("Y-m-d");
			$cel = 0;

			$result = dbquery("SELECT cre FROM cp_cre WHERE acid ='".$game_information['id']."' limit 1")or die("eror") ;

			if($result == FALSE)
			{
				echo "<center><font color=red>Hay errores en la consulta sql</font></center><br>";
			}
			elseif(mysql_num_rows($result)<1)
			{
				$_SESSION['cp_cre_valid_restart'] = TRUE;
				dbquery("INSERT INTO cp_cre VALUES ('".$game_information['id']."', 1+".$promo.", 1+".$promo.")")or die("eror");
			}
			else
			{   
				$_SESSION['cp_cre_valid_restart'] = TRUE;
				dbquery("UPDATE cp_cre SET `cre`=`cre`+1+".$promo.", `cre_used`=`cre_used`+1+".$promo." WHERE `acid`='".$game_information['id']."'");
			}

			$query = dbquery("INSERT INTO cp_sms_log (acid, codigo, cel, system, date) VALUES ('".$game_information['id']."', '$codigo', '$cel', 'SEPOMO', '$date')");

			if($query)
			{
				echo "<center><font color=red>Codigo Ingresado Correctamente.</font></center><br>";
				?><meta http-equiv="refresh" content="4"><?php
			}
		}
		else
		{
			echo "<center><font color=red>Debes insertar un codigo válido.</font></center><br>";
			?><meta http-equiv="refresh" content="6"><?php
		}
	}
	else
	{
		$_SESSION['cp_cre_valid_restart'] = TRUE;
		echo "<center><font color=red>El Codigo que ingresaste ya se ha usado.</font></center><br>";
	}
}
?>
<style type="text/css">
<!--
.Estilo2 {color: #FF0000}
-->
</style>

<div align="center">
<select id="country" onchange="javascript:realm=changecountry();" style="width: 150px;">
<option value="default">Selecciona tu Pais</option>
<option value="argentina">Argentina</option>
<option value="bolivia">Bolivia</option>
<option value="brasil">Brasil</option>
<option value="chile">Chile</option>
<option value="colombia">Colombia</option>
<option value="costarica">Costa Rica</option>
<option value="ecuador">Ecuador</option>
<option value="spain">España</option>
<option value="elsalvador">El Salvador</option>
<option value="guatemala">Guatemala</option>
<option value="honduras">Honduras</option>
<option value="mexico">Mexico</option>
<option value="nicaragua">Nicaragua</option>
<option value="panama">Panama</option>
<option value="peru">Peru</option>
<option value="republicdom">Republica Dominicana</option>
<option value="uruguay">Uruguay</option>
<option value="venezuela">Venezuela</option>
<option value="a">---</option>
<option value="alemania">Alemania</option>
<option value="canada">Canada</option>
<option value="usa">USA</option>
<option value="b">---</option>
<option value="sepomo">TEMP SEPOMO</option>
</select>
<div id="default" style="display:none;">
  <div class="descipccion">
    <br>Selecciona tu Pais para ver las opciones disponibles
  </div>
</div>
<div id="argentina" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>27777</b> para obtener tu Codigo
    <br>
    <i><small>*Servicio válido para Claro, Movistar, Personal y Nextel.<br>Precio del mensaje al 27777 : $5,99 ARS + Imp en Claro y $6,00 + Imp en Movistar, Personal y Nextel.<br> Servicio limitado a 60 sms/mes.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="bolivia" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CAVE</b> al <b>636</b> para obtener tu Codigo
    <br>
    <i><small>*El precio del mensaje es de 8.85 BOB + I.V.A.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_sepomo" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="brasil" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>44844</b> para obtener tu Codigo
    <br>
    <i><small>*Custo: 4.99 BRL/SMS</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="chile" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>3113</b> para obtener tu Codigo
    <br>
    <i><small>*Precio del sms $750 pesos impuestos incluídos.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="colombia" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>ALL</b> al <b>3911</b> para obtener tu Codigo
    <br>
    <i><small>*Servicio válido para Movistar, Tigo y Comcel.<br>Precio del mensaje $3.596 IVA. Inc. </small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="costarica" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>2224</b> para obtener tu Codigo
    <br>
    <i><small>Servicio disponible en ICE.<br>Precio del mensaje: C.700 impuestos incluídos</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="ecuador" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>7722</b> para obtener tu Codigo
    <br>
    <i><small>*Servicio válido para Alegro y Movistar a $1,25 + Imp.<br>Porta con precio por mensaje al 7722 de $1,30 + Imp.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="spain" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>25065</b> para obtener tu Codigo
    <br>
    <i><small>*1,42€ IVA incluido.</small></i>
  </div>
    <div class="descipccion">
    <br>Llama al <b>905 40 31 23</b> para obtener tu Codigo
    <br>
    <i><small>*1,42€/llamada IVA incluído desde un teléfono de la red fija.<br>1,95€/llamada IVA incluído desde red móvil</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="elsalvador" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>2580</b> para obtener tu Codigo
    <br>
    <i><small>Servicio disponible para Claro, Digicel, Movistar y Tigo<br>Precio del mensaje $3.00 USD + impuestos</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="guatemala" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>1255</b> para obtener tu Codigo
    <br>
    <i><small>*Claro y Movistar $ 1,69 + Impuestos.<br>Tigo 15 Qzt + impuestos.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="honduras" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>55255</b> para obtener tu Codigo
    <br>
    <i><small>*Precio del mensaje 1,73 + impuestos.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="mexico" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>28000</b> para obtener tu Codigo
    <br>
    <i><small>*Servicio disponible para usuarios Telcel, Movistar, Iusacell, Unefon, Nextel.<br>$23.20 pesos IVA incluido por SMS.<br>$22.20 pesos en ciudades fronterizas en donde aplica el 11% de IVA<br>El servicio Allopass tiene un limite mensual de 50 SMS</small></i>
  </div>
    <div class="descipccion">
    <br>Llama al <b>01 900 849 77 23</b> para obtener tu Codigo
    <br>
    <i><small>*$23.20 por minuto (incluye iva) Duración máxima de la llamada 1 minuto<br>Servicio para mayores de 18 años.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="nicaragua" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>95100</b> para obtener tu Codigo
    <br>
    <i><small>*$1,00 USD + impuestos <br>Servicio disponible en Claro y Movistar.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_123ticket" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="panama" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>1255</b> para obtener tu Codigo
    <br>
    <i><small>*$2 SMS IVA incluido.<br>Servicio disponible en Movistar.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_123ticket" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="peru" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>7766</b> para obtener tu Codigo
    <br>
    <i><small>*Servicio válido para Claro, precio del mensaje al 7766, S./3,47 IGV incluido.<br>Movistar, precio del mensaje al 7766 es de USD1,19 IGV incluido.<br>Servicio limitado a 60 sms/mes. </small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="republicdom" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al <b>92800</b> para obtener tu Codigo
    <br>
    <i><small>Servicio disponible para Claro, Orange, Viva y Tricom<br>Precio del mensaje $64,00 DOP impuestos incluídos.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_123ticket" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="uruguay" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>LCV</b> al <b>1714</b> para obtener tu Codigo
    <br>
    <i><small>*Precio del mensaje 60 UYU/SMS + Basico + IVA.<br>Disponible para Ancel.</small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="venezuela" style="display:none;">
  <div class="descipccion">
    <br>Envia <b>CODE</b> al: <b>5833</b> para obtener tu Codigo <em>(Usuarios Movilnet)</em>
    <br>Envia <b>CODE</b> al: <b>2658</b> para obtener tu Codigo <em>(Usuarios Movistar y Digitel)</em>
    <br><br>
    <i><small>*Costo del mensaje 7,5 BsF + impuestos en Movistar y Digitel.<br>5,0 BsF + impuestos en Movilnet.<br>Servicio limitado a 60 sms/mes. </small></i>
  </div>
<br><br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<!-- Other Countries -->
<div id="alemania" style="display:none;">
  <div class="descipccion">
    <br>Schicken sie <b>LOS</b> an <b>41414</b> Um Ihren Code
    <br>
    <i><small>*Precio del mensaje €1.49/SMS</small></i>
  </div>
<br><br>
<center>
  <div align="center">Geben Sie Ihren Zugangs-Code ein <span class="Estilo2"><strong>empfangen</strong></span> Via SMS oder Phone. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="canada" style="display:none;">
  <div class="descipccion">
    <br>Send <b>CODE</b> to <b>52624</b> To reveive your code
    <br>
    <i><small>*Price of SMS 3.00$</small></i>
  </div>
<br><br>
<center>
  <div align="center">Enter your access code <span class="Estilo2"><strong>Receive</strong></span> Via SMS or Phone. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<div id="usa" style="display:none;">
  <div class="descipccion">
    <br>Send <b>AP</b> to <b>23333</b> To reveive your code
    <br>
    <i><small>Payment is available to subscribers on AT&T, Sprint, Cellular One, Nextel, Boost, Alltel, Virgin Mobile <br>*Price of SMS $2.99</small></i>
  </div>
<br><br>
<center>
  <div align="center">Enter your access code <span class="Estilo2"><strong>Receive</strong></span> Via SMS or Phone. <br><br>
	<form method="post">
      <input type="text" name="codigo_allopass" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<!-- Finish Other Countries -->
<div id="sepomo" style="display:none;">
<br>
<center>
  <div align="center">Introduce El Codigo <span class="Estilo2"><strong>Recibido</strong></span> Via SMS ó Telefono. <br><br>
	<form method="post">
      <input type="text" name="codigo_sepomo" size="8">
      <br><br>
      <input type="submit" class="button" value="Enviar">
	</form>
  </form>
  </div>
</center>
</div>
<script>
var current= 'default';
function changecountry() {
	var indice = document.getElementById('country').selectedIndex;
	var pais = document.getElementById('country').options[indice].value;
	
	document.getElementById(current).style.display = 'none';
    document.getElementById(pais).style.display = 'block'; 
	current= pais;   
}
</script>
</div>