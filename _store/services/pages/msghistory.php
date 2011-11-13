<script type="text/javascript">
var fullmsgdivstate = 0;
function fullmsg(msgid) {
	var fullmsgdiv = document.getElementById('fullmsg');
	if (fullmsgdivstate != msgid) {
   document.getElementById('fullmsg').innerHTML = HttpRequest('core/fullmsg.php?msgid=' + msgid);

  	fullmsgdivstate = msgid;
	} else {
		fullmsgdiv.innerHTML = '';
		fullmsgdivstate = 0;
	}
}
</script>
<div id='content'>
<?
error_reporting(0);
echo'<h2>Historial de Mensajes</h2>
<p>En esta página usted puede seguir el estado de los mensajes que envía al Servidor de Administración. Una vez que el mensaje es leído por uno de los administradores, Una vez que uno de los administradores Lea el correo, El estado cambiara y usted podra leer la respuesta.</p>
<div id="fullmsg" style="padding-bottom: 25px;"></div>
<p><table width="100%" align="center" cellpadding="0" cellspacing="0">
<tr width="100%" height="24" class="tr">
<td align="center" width="10%">Numero</td>
<td align="center" width="30%">Fecha</td>
<td align="center" width="20%">Asunto</td>
<td align="center" width="20%">Respuesta</td>
<td align="center" width="10%">Captura de Pantalla</td>
<td align="center" width="40%">Condicion</td>
</tr>';
switchConnection("1","realmd");
$result=dbquery("SELECT * FROM `cp_admessage` WHERE `ac_id`='$ac_id'  ");
if (dbrows($result)!=0)
{
	while ($data = dbarray($result))
	{
		$week = mktime ( 0 , 0 , 0 , date ( "m" ) , date ( "d" )-1 , date ( "Y" ));
		
		if(strtotime($data[date])<$week && $data[n_answer]!="")
		{
			dbquery("DELETE FROM `cp_admessage` WHERE `id` = '$data[id]' LIMIT 1  ");
		}
		
		if($data['screen']=="")
			$screen="";
		else
			$screen="<a href=upload/".$ac_id."_".$data['screen'].">$data[screen]</a>";
			
		if($data['answer']=="")
			$button="value=\"No hay Respuesta Aun\"";
		else
			$button='onClick="fullmsg('.$data[id].')" value="Leer Respuesta"';

		echo'<tr height="25">

		<td align="center">ID#'.$data[id].'</td>
		<td align="center">'.$data[date].'</td>
		<td align="center">'.$local[$data[type]].'</td>
		<td align="center">'.$data[n_answer].'</td>
		<td align="center">'.$screen.'</td>
		<td align="center"><input type="button" class="dissubmit" '.$button.' style="width: 175px;"></td>
		</tr>';
	}
}
else
	echo '<tr height="25"><td colspan=6 align="center">NO tienes ningun Mensaje Enviado</td></tr>';
	echo'</table></p>';?>