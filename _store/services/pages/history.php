<div style="min-height:50px;" class="section-title">
    <span>Log de donaciones</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, En esta página puedes ver el estado de todos tu envios de premios a tu personaje, recuerda que cada envio permanece unas horas en espera hasta que es recibido en tu personaje.</p>
</div>

<span class="clear"><!-- --></span>
<p></p>
<table width = '100%'>
<td valign = 'top'>
<form action = "" method = "post" style = "text-align: left">
<input type = "hidden" name = "p" value = "events"/>
<table><tr><td class = 'backbox_text'>
</td></tr>
<tr><td class = 'backbox_text'>
<?
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nano
 * Copyright: Nano
 * Email: Nano@serverwow.com
*/
error_reporting(0);
if(!$_SESSION['cp_login']) exit('Error');
$result=dbquery("SELECT `id` FROM cp_history WHERE acid ='".$game_information['id']."' AND `type`=1") or die("eror");
// Cambiar esto al estilo correcto de las paginas.
if (dbrows($result) > 20)
{
	echo'<small>Enviar:&nbsp;<select name="page" onchange="this.form.submit()" class="select" style="width: 45px;">>';
	
	for ($i=1; $i <= ceil(dbrows($result) / 20); $i++)
	{
		if ($_POST['page'] == $i)
			echo "<option value=$i selected>$i</option>";
		else
			echo "<option value=$i >$i</option>";
	}

	echo '</select>';
}
// Update sent items on history
for ($i=1; $i<=3; $i++)
{
    switchConnection($i,"character");
    $result=dbquery("SELECT `id` FROM mail_external WHERE `sent`=0");
    while ($row=dbarray($result))
        $en_espera.= $row['id'].', ';
}
$en_espera.= '0';
switchConnection(1,"realmd");   
$query='UPDATE cp_history SET `estado`=1 WHERE estado=0 AND sent_id NOT IN ('.$en_espera.')';
dbquery($query);
?>
</td></tr></table>
</form>
<div class="table-options">
<p>
</div><div class="table ">
	<table>
		<thead>
			<tr>
				<th>
					<a href="#" class="sort-link">
		                <span class="arrow up"><b>Fecha</span>
		            </a>
		        </th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Reino</span>
	                </a>
	            </th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Personaje</span>
	                </a>
	            </th>
	            <th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Envio</span>
	                </a>
	            </th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">IP</span>
	                </a>
	            </th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Estado</span>
	                </a>
	            </th>
				<th>
                    <a href="#" class="sort-link">
	                	<span class="arrow">Reportar</span>
	                </a>
                </th>
			</tr>
		</thead>
		<tbody>
		

<?
if (!$_POST['page'])
	$p=0;
else
	$p=($_POST['page'] - 1) * 20;

	$result = dbquery("SELECT * FROM cp_history WHERE acid ='$game_information[id]' AND `type`=1 order by id desc limit $p, 20") or die("eror");
	$reino=array_keys($world_db);
	
	if (dbrows($result) != 0)
	{
		while ($data=dbarray($result))
		{
		    $realm=$data['realm']-1;
		    if($u>1) $u=1; else ++$u;
		    echo'<tr height="25" class="row'.$u.'" id="rank-'.$u.'">';
		    ?>
			<td align="center"><?php echo $data[date]; ?></td>
			<td align="center"><?php echo $reino[$realm]; ?></td>
			<td align="center"><?php echo $data[char_name]; ?></td>
			<td align="center"><?php echo utf8_encode($data[com]); ?></td>
			<td align="center"><?php echo $data[ip]; ?></td>
			<td align="center"><?php if ($data[estado]==0) echo 'En espera'; else echo 'Enviado correctamente'; ?></td>
			<td align="center" style="padding:0;"><input type="submit" class="submit" value="Reportar" alt="Reportar error" title="Reparar/Desbloquear Personaje" style="width: 80%;" onclick="window.location='?p=12&id=<?php echo $data[id]; ?>';">
			</td>
			</tr>
			<?php
		}
	}
	else
		echo "<tr>
        <td colspan=7 align='center'  class='backbox_1'>No tienes Ningun Registro de Actividad</td>
        </tr> ";
?>

</table>
<br><div id = 'BasketInput' class = 'backbox' style = 'visibility: hidden; color:black;' align = 'center' value = 'ghjgh'></div>
</td></table>
