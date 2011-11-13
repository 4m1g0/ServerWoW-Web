<div style="min-height:50px;" class="section-title">
    <span>Opciones de personaje</span>
    <p>Hola <?php echo $_SESSION['username']; ?>, En esta página puede gestionar todas las opciones de tus personajes, asi como ver información referente a ellos.</p>
</div>
<span class="clear"><!-- --></span>
<div>
<?
/*
 * Project Name: WoW LCV Panel
 * Date: 15/01/2011 version (0.1)
 * Author: Nano
 * Copyright: Nano
 * Email: Nano@serverwow.com
*/
if (isNum($_POST['r']) && isNum($_POST['g']))
{
    $tele=$_POST['g'];
    switchConnection($_POST['r'],"character");
	$online = dbquery("SELECT * FROM `characters` WHERE `guid` ='$tele' and `online`='0'")or die("eror") ;

	$onl = dbarray($online);
	
    if(dbrows($online) != 0 )
	{
	    // Limpiar Auras del Personaje
	    if($repair_aurs_clean) dbquery("DELETE FROM `character_aura` WHERE `guid` = '$tele' ");
    	// Limpia Los Grupos del Personaje
	    if($repair_groups_clean)
		{
			dbquery("DELETE FROM `groups` WHERE `leaderGuid` = '$tele' ");
			// Limpia el Lider del Grupo
			dbquery("DELETE FROM `group_member` WHERE `memberGuid`= '$tele' ");
			// Limpia al Resto de personajes del Grupo
	 	}
		// Limpia al Personaje de un grupo de Instance
		if($repair_instance_clean) dbquery("DELETE FROM `character_instance` WHERE `guid` = '$tele' ");
		// Añade Penalizacion al Finalizar la Reparacion
		if($repair_add_sicknes) dbquery("INSERT INTO `character_aura` (`guid`, `caster_guid`, `item_guid`, `spell`, `effect_mask`, `recalculate_mask`, `stackcount`, `amount0`, `amount1`, `amount2`, `base_amount0`, `base_amount1`, `base_amount2`, `maxduration`, `remaintime`, `remaincharges`) values ('$tele','$tele','0','15007','7','7','1','-75','-75','0','-76','-76','-1','600000','600000','0')");
		// Desbloquea el Personaje lo lleva a la Piedra de hogar
		if($repair_tele_home) dbquery("UPDATE `characters`, `character_homebind` SET `characters`.`position_x`=`character_homebind`.`position_x`, `characters`.`position_y`=`character_homebind`.`position_y`, `characters`.`position_z`=`character_homebind`.`position_z`, `characters`.`map`=`character_homebind`.`map` WHERE `characters`.`guid`=$tele AND `characters`.`guid`=`character_homebind`.`guid`")or die("Error en la Query");

    	echo "<h2>Finalizado</h2>
			<p><span class='error' align='center'>Hola, el personaje $onl[name] fue arreglado correctamente.</span></p>";
	}
	else
	{
		echo "El Personaje debe estar Offline.";
	}
}
else
{
	echo "<script type='text/javascript'>
	function fixcharrepair(realm)
	{";
	foreach ($characters_db as $i => $value)
	{
		echo" if (realm == '$value[0]'){
		document.getElementById('antierror_$value[0]').innerHTML = '';
	}";
	}
	echo "}
	</script>";

	foreach ($characters_db as $i => $value)
	{
		echo'<div id="antierror_'.$value[0].'"></div>
		<div class="table-options"><h2><b>REALM '.$i.'</b></h2>
		<p>
		</div><div class="table ">
		<table>
		<thead>
		<tr>
		<th>
		<a href="#" class="sort-link">
		<span class="arrow up"><b>Nombre</span>
		</a>
		</th>
		<th>
		<a href="#" class="sort-link">
		<span class="arrow">Nivel</span>
		</a>
		</th>
		<th>
		<a href="#" class="sort-link">
		<span class="arrow">Raza</span>
		</a>
		</th>
		<th>
		<a href="#" class="sort-link">
		<span class="arrow">Clase</span>
		</a>
		</th>
		<th>
		<a href="#" class="sort-link">
		<span class="arrow">Oro</span>
		</a>
		</th>
		<th>
		<a href="#" class="sort-link">
		<span class="arrow">Tiempo Jugado</span>
		</a>
		</th>
		<th>
		<a href="#" class="sort-link">
		<span class="arrow">Opciones</span>
		</a>
		</th>
		</tr>
		</thead>
		<tbody>';

		switchConnection($value[0],"character");

		$result = dbquery("SELECT `name`, `class`, `guid`, `race`, `online`, `gender`, `level`, `money`, `totaltime` FROM `characters` WHERE account ='".$game_information['id']."' order by guid asc")or die("eror") ;

		if(dbrows($result) != 0)
		{
	    	$u=1;

			while ($data = dbarray($result))
			{
			    if($u>1) $u=1; else ++$u;
		        $tot_time = $data['totaltime'];
				$tot_days = (int)($tot_time/86400);
				$tot_time = $tot_time - ($tot_days*86400);
				$total_hours = (int)($tot_time/3600);
				$tot_time = $tot_time - ($total_hours*3600);
				$total_min = (int)($tot_time/60);
			
				$money = getGold($data['money']);

				echo'<tr height="25" class="row'.$u.'" id="rank-'.$u.'">
				<td align="center">'.$data[name].'</td>
				<td align="center">'.$data[level].'</td>
				<td align="center"><img src="services/img/c_icons/'.$data[race].'-'.$data[gender].'.gif"></td>
				<td align="center"><img src="services/img/c_icons/'.$data['class'].'.gif"></td>
				<td align="center">'.$money.'</td>			
				<td align="center">'.$tot_days.'d '.$total_hours.'h '.$total_min.'min</td>
				<form method="post">
				<input type="hidden" name="r" value="'.$value[0].'">
				<input type="hidden" name="g" value="'.$data[guid].'">
				<td align="center" style="padding:0;"><input type="submit" class="submit" value="Desbloquear" alt="Reparar Personaje" title="Reparar/Desbloquear Personaje" style="width: 80%;">
				</form>
				</td>
				</tr>';
			}
		}
		else
		{
			echo'<tr height="50"><td colspan="6"><center>No dispones de Ningun personaje en el reino '.$i.'.</center></td></tr>';
		}

			echo'</tbody></table></div>
			</p>';
	}
}
?></div>