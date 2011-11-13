<div style="min-height:100px" class="section-title">
<span>Obtener premios</span>
<p>Hola <?php echo $_SESSION['username']; ?>, En esta página puedes canjear tus créditos LCV por objetos en el juego.</p>
</div>
<span class="clear"><!-- --></span>
<?
if(!$_SESSION['cp_login']) exit();
if ($_GET['id'] && $_GET['char'] && $_GET['realm'])
{
    include "send.php";
}else
{
if ($_GET['type']){
if($wowhead) echo $wowheadjs;
?>

<link rel="stylesheet" type="text/css" media="all" href="wow/static/css/cms.css?v4" />
<script>
var guid = 0;
var realm = 0;
function changeRealm() {
	var indice = document.getElementById('realmList').selectedIndex;
	var realm = document.getElementById('realmList').options[indice].value;
	if (realm==1)
	{
	    document.getElementById('List0').style.display = 'none';
	    document.getElementById('List1').style.display = 'block';
	    document.getElementById('List2').style.display = 'none';
	    document.getElementById('List3').style.display = 'none';
	}
	if (realm==2)
	{
	    document.getElementById('List0').style.display = 'none';
	    document.getElementById('List1').style.display = 'none';
	    document.getElementById('List2').style.display = 'block';
	    document.getElementById('List3').style.display = 'none';
	}
	if (realm==3)
	{   
	    document.getElementById('List0').style.display = 'none';
	    document.getElementById('List1').style.display = 'none';
	    document.getElementById('List2').style.display = 'none';
	    document.getElementById('List3').style.display = 'block';
	}
	return realm;    
}

function changeChar(rchar) {
    if (rchar==1)
    {
	    var indice = document.getElementById('List1').selectedIndex;
	    var guid = document.getElementById('List1').options[indice].value;
	}
	if (rchar==2)
	{
	    var indice = document.getElementById('List2').selectedIndex;
	    var guid = document.getElementById('List2').options[indice].value;
	}
	if (rchar==3)
    {
	    var indice = document.getElementById('List3').selectedIndex;
	    var guid = document.getElementById('List3').options[indice].value;
	}
	return guid;
}

function send(id)
{
	if(realm && guid)
	{
    	var url = '?p=<?php echo $_GET[p]; ?>&type=<?php echo $_GET[type]; ?>&id='+id+'&realm='+realm+'&char='+guid;
	    
		if(window.confirm('¿Estas seguro?'))
		{
			window.location=url;
		}
	}
	else alert('Debes indicar un reino y personaje');
}

function doitt(id){
	if(realm && guid)
	{
		var url = '?t=99&type=<?php echo $_GET[type]; ?>&id='+id+'&realm='+realm+'&char='+guid;
		
	    if(window.confirm('¿Estas seguro?'))
		{
			HttpRequest(url);
		}
	}
		else alert('Debes indicar un reino y personaje');
}

function changeclass_()
{
	var clase = document.getElementById('f').value;
	var t = document.getElementById('t').value;
	var url = '?p=<?php echo $_GET[p]; ?>&type=<?php echo $_GET[type]; ?>&class='+clase+'&tip='+t;
	if (t == 0)
	{
		if (clase == 0)
		{
			var url = '?p=<?php echo $_GET[p]; ?>&type=<?php echo $_GET[type]; ?>';
		}
		else
		{
			var url = '?p=<?php echo $_GET[p]; ?>&type=<?php echo $_GET[type]; ?>&class='+clase;
		}
	}
	window.location = url;
}

function changeclass()
{
	var clase = document.getElementById('filtro').value;
	var url = '?p=<?php echo $_GET[p]; ?>&type=<?php echo $_GET[type]; ?>&class='+clase;
	if (clase == 0)
	{
		var url = '?p=<?php echo $_GET[p]; ?>&type=<?php echo $_GET[type];?>';
	}
	window.location = url;
}
</script>
<div id="news-updates">

<div class="news-article first-child">
<br />
    <center>	
    <table width="90%" border=0>
        <tr>
            <td align="left">
                <b>Seleccionar Reino:&nbsp;</b>
            </td>
            <td align="left">
                <select name="realm" id="realmList" class="select" onchange="javascript:realm=changeRealm();" style="width: 150px;"><option value="">Selecciona</option>
                <?
                        foreach ($world_db as $i => $value)
                        {
                                echo"<option value=$value[0]>$i</option>";
                        }
                ?>
                </select>
            </td>
            <td style="padding-left:10px;" align="right">
                <b>Selecciona personaje:&nbsp;</b>
            </td>
            <td align="left">
            <select name="realm1" id="List0" class="select" onchange="" style="width: 150px;display:block;"><option value="">Debes seleccionar un reino primero</option></select>
                <select name="realm1" id="List1" class="select" onchange="javascript:guid=changeChar(1);" style="width: 150px;display:none;"><option value="">Selecciona</option>
                <?
	                switchConnection(1, 'character');
	                GetAccountChars($game_information['id']);
                ?>
                </select>
                <select name="realm2" id="List2" class="select" onchange="javascript:guid=changeChar(2);" style="width: 150px;display:none;"><option value="">Selecciona</option>
                <?
	                switchConnection(2, 'character');
	                GetAccountChars($game_information['id']);
                ?>
                </select>
                <select name="realm3" id="List3" class="select" onchange="javascript:guid=changeChar(3);" style="width: 150px;display:none;"><option value="">Selecciona</option>
                <?
	                switchConnection(3, 'character');
	                GetAccountChars($game_information['id']);
                ?>
                </select>
            </td>
        </tr>
    </table>
    </center>
<br />
</div>
</div>
<?php
switchConnection(1, 'realmd');

// MONTURAS
if ($_GET['type']=='mount')
{
?>
<div class="table ">
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
		                <span class="arrow">tipo</span>
	                </a>
	            </th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">velocidad</span>
	                </a>
	            </th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">requiere</span>
	                </a>
	            </th>
				<th>
                    <a href="#" class="sort-link">
	                	<span class="arrow">Coste</span>
	                </a>
                </th>
				<th>
                    <a href="#" class="sort-link">
		                <span class="arrow">Canjear</span>
	                </a>
                </th>
			</tr>
		</thead>
		<tbody>
		<?php
			$result = mysql_query("SELECT * FROM cp_items where `type`='mount'");
			$totalRows = mysql_num_rows($result);
			
			$pager_options = array(
				'mode'       => 'Sliding',
				'perPage'    => 10,
				'delta'      => 4,
				'urlVar'	 => 'page',
				'totalItems' => $totalRows,
			);

			$pager = Pager::factory($pager_options);
			echo $pager->links;
			
			list($from, $to) = $pager->getOffsetByPageId();
			$from = $from - 1;
			
			$perPage = $pager_options['perPage'];
			
		    $result=mysql_query("SELECT * FROM cp_items where `type`='mount' ORDER by name LIMIT $from, $perPage");
		    $u=1;
		    while ($data=dbarray($result))
	        {
	            if($u>1) $u=1; else ++$u;
	            echo'<tr height="25" class="row'.$u.'" id="rank-'.$u.'">
			    <td align="center"><a href="http://es.wowhead.com/item='.$data[item].'" target="_blank" class="q1" alt="'.$data[name].'"><b>'.utf8_encode($data[name]).'</b></a></td>
			    <td align="center">'.$data[level].'</td>
			    <td align="center">'.$data[value1].'</td>
			    <td align="center">'.$data[value2].'%</td>
			    <td align="center">equitación('.$data[value3].')</td>			
			    <td align="center">'.$data[price].'<img src=wow/static/images/icons/creditos.png></td>
			    <td align="center" style="padding:0;"><input type="submit" onclick="doitt('.$data[id].');" class="submit" value="Canjear" alt="Canjear creditos" style="width: 80%;">
			    </td>
			    </tr>';
	        }
		?>
		</tbody>
	</table>
</div>	
<?php }

// BOLSAS & ORO
elseif ($_GET['type']=='bag')
{
?>
<div class="table ">
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
		                <span class="arrow">Casillas</span>
	                </a>
	            </th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Cantidad</span>
	                </a>
	            </th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">requiere</span>
	                </a>
	            </th>
				<th>
                    <a href="#" class="sort-link">
	                	<span class="arrow">Coste</span>
	                </a>
                </th>
				<th>
                    <a href="#" class="sort-link">
		                <span class="arrow">Canjear</span>
	                </a>
                </th>
			</tr>
		</thead>
		<tbody>
		<?php
		    $result=mysql_query("SELECT * FROM cp_items where `type`='bag'");
		    $u=1;
		    while ($data=dbarray($result))
	        {
	            if($u>1) $u=1; else ++$u;
	            if($data[item]) { $data[name]='<a href="http://es.wowhead.com/?item='.$data[item].'" alt="'.$data[name].'">'.$data[name].'</a>'; $data[value2]= '00<img src="wow/static/images/icons/gold.gif"> 00<img src="wow/static/images/icons/silver.gif"> 00<img src="wow/static/images/icons/copper.gif">'; }
				else { $data[value2]=$data[value2].'<img src="wow/static/images/icons/gold.gif"> 00<img src="wow/static/images/icons/silver.gif"> 00<img src="wow/static/images/icons/copper.gif">'; }
	            echo'<tr height="25" class="row'.$u.'" id="rank-'.$u.'">
			    <td align="center">'.utf8_encode($data[name]).'</td>
			    <td align="center">nivel '.$data[level].'</td>
			    <td align="center">'.$data[value1].'</td>
			    <td align="center">'.$data[value2].'</td>
			    <td align="center">'.$data[value3].'</td>			
			    <td align="center">'.$data[price].'<img src=wow/static/images/icons/creditos.png></td>
			    <td align="center" style="padding:0;"><input type="submit" onclick="doitt('.$data[id].');" class="submit" value="Canjear" alt="Canjear creditos" style="width: 80%;">
			    </td>
			    </tr>';
	        }
		?>
		</tbody>
	</table>
</div>	
<?php }

// ARMAS & ESCUDOS
elseif ($_GET['type']=='weapon')
{
?>
<div class="table ">
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
				<th><select name="filtro" class="select" id="filtro" onchange="javascript:changeclass();">
				  <option value="">Selecciona filtro</option>
   				  <option value="0">Ninguno</option>
				  <option value="1">Escudos</option>
				  <option value="2">Dagas</option>
				  <option value="3">Bastones</option>
                  
   				  <option value="12">Arcos</option>
   				  <option value="13">Ballestas</option>
   				  <option value="14">Armas de Fuego</option>
   				  <option value="15">Arrojadizas</option>
   				  <option value="16">Varitas</option>
                  
				  <option value="4">Armas de Asta</option>
				  <option value="5">Armas de Puño</option>
				  <option value="6">Espadas de Una Mano</option>
				  <option value="7">Espadas de Dos Manos</option>
				  <option value="8">Hachas de Una Mano</option>
				  <option value="9">Hachas de Dos Manos</option>
				  <option value="10">Mazas de Una Mano</option>
				  <option value="11">Mazas de Dos Manos</option>
		      </select></th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Manos</span>
	                </a>
	            </th>
	            <th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Lado</span>
	                </a>
	            </th>
				<th>
                    <a href="#" class="sort-link">
	                	<span class="arrow">Coste</span>
	                </a>
                </th>
				<th>
                    <a href="#" class="sort-link">
		                <span class="arrow">Canjear</span>
	                </a>
                </th>
			</tr>
		</thead>
		<tbody>
		<?php
		    $class = mysql_real_escape_string($_GET['class']);
			if ($class == "") $class = "";
			else $class = " AND value1='$class'";
			
			$result = mysql_query("SELECT * FROM cp_items where `type`='weapon' $class");
			$totalRows = mysql_num_rows($result);
			
			$pager_options = array(
				'mode'       => 'Sliding',
				'perPage'    => 10,
				'delta'      => 4,
				'urlVar'	 => 'page',
				'totalItems' => $totalRows,
			);

			$pager = Pager::factory($pager_options);
			echo $pager->links;
			
			list($from, $to) = $pager->getOffsetByPageId();
			$from = $from - 1;
			
			$perPage = $pager_options['perPage'];
			
		    $result = mysql_query("SELECT * FROM cp_items where `type`='weapon' $class ORDER by name LIMIT $from, $perPage");
		    $u=1;
		    while ($data=dbarray($result))
	        {
	            if($u>1) $u=1; else ++$u;
	            if($data[value3]!='--') $data[value3]='<img src="wow/static/images/icons/faction/'.$data[value3].'.gif">';
	            echo'<tr height="25" class="row'.$u.'" id="rank-'.$u.'">
				<td align="center"><a href="http://es.wowhead.com/?item='.$data[item].'" target="_blank" alt="'.$data[name].'">'.utf8_encode($data[name]).'</a></td>
			    <td align="center">'.$data[level].'</td>
			    <td align="center">'.$data[value1].'</td>
			    <td align="center">'.$data[value2].'</td>
			    <td align="center">'.$data[value3].'</td>			
			    <td align="center">'.$data[price].'<img src=wow/static/images/icons/creditos.png></td>
			    <td align="center" style="padding:0;"><input type="submit" onclick="doitt('.$data[id].');" class="submit" value="Canjear" alt="Canjear creditos" style="width: 80%;">
			    </td>
			    </tr>';
	        }
		?>
		</tbody>
	</table>
</div>	
<?php }

// ITEMS DE ARMADURA
elseif ($_GET['type']=='items')
{
?>
<div class="table ">
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
                   <select id="f" class="select">
                   <option value="0">Selecciona filtro</option>
                   <option value="1">Cabeza</option>
                   <option value="2">Manos</option>
                   <option value="3">Pies</option>
                   <option value="4">Piernas</option>
                   <option value="5">Muñecas</option>
                   <option value="6">Hombros</option>
                   <option value="7">Cabeza</option>
                   <option value="8">Pecho</option>
                   <option value="9">Cintura</option>
                   <option value="10">Capas</option>
                   <option value="11">Amuletos</option>
                   <option value="12">Anillos</option>
                   <option value="13">Abalorios</option>
                   </select>
	            </th>
				<th>
                   <select id="t" class="select" onchange="javascript:changeclass_();"  style="width: 120px;">
                   <option value="">Seleccionar filtro</option>
   	               <option value="0">Ninguno</option>
                   <option value="1">Placas</option>
	               <option value="2">Cuero</option>
   	               <option value="3">Malla</option>
  	               <option value="4">Tela</option>
                   </select>
	            </th>
				<th>
                    <a href="#" class="sort-link">
	                	<span class="arrow">Coste</span>
	                </a>
                </th>
				<th>
                    <a href="#" class="sort-link">
		                <span class="arrow">Canjear</span>
	                </a>
                </th>
			</tr>
		</thead>
		<tbody>
		<?php
		    $class = mysql_real_escape_string($_GET['class']);
			$tip = mysql_real_escape_string($_GET['tip']);
			if ($class == ""){ $class = ""; $tip = ""; }
			elseif ($tip == "") { $class = " AND value1='$class'"; $tip = ""; }
			else { $class = " AND value1='$class'"; $tip = " AND value2='$tip'"; }
			
			$result = mysql_query("SELECT * FROM cp_items where `type`='items' $class $tip");
			$totalRows = mysql_num_rows($result);
			
			$pager_options = array(
				'mode'       => 'Sliding',
				'perPage'    => 10,
				'delta'      => 4,
				'urlVar'	 => 'page',
				'totalItems' => $totalRows,
			);

			$pager = Pager::factory($pager_options);
			echo $pager->links;
			
			list($from, $to) = $pager->getOffsetByPageId();
			$from = $from - 1;
			
			$perPage = $pager_options['perPage'];
			
		    $query="SELECT * FROM cp_items where `type`='items' $class $tip ORDER by name LIMIT $from, $perPage";
		    $result=mysql_query($query);
		    $u=1;
		    while ($data=dbarray($result))
	        {
	            if($u>1) $u=1; else ++$u;
	            echo'<tr height="25" class="row'.$u.'" id="rank-'.$u.'">
			    <td align="center"><a href="http://es.wowhead.com/?item='.$data[item].'" target="_blank" alt="'.$data[name].'">'.utf8_encode($data[name]).'</a></td>
			    <td align="center">'.$data[level].'</td>
			    <td align="center">'.$data[value1].'</td>
			    <td align="center">'.$data[value2].'</td>
			    <td align="center">'.$data[value3].'</td>			
			    <td align="center">'.$data[price].'<img src=wow/static/images/icons/creditos.png></td>
			    <td align="center" style="padding:0;"><input type="submit" onclick="doitt('.$data[id].');" class="submit" value="Canjear" alt="Canjear creditos" style="width: 80%;">
			    </td>
			    </tr>';
	        }
		?>
		</tbody>
	</table>
</div>	
<?php }

// SETS DE ARMADURA
elseif ($_GET['type']=='set')
{
function get_icons($set_id)
{
    $result=mysql_query("SELECT item FROM cp_set_item WHERE id='".$set_id."'");
    while($row=mysql_fetch_array($result))
    {
        $img=mysql_query("SELECT iconname FROM cp_icons WHERE id='".$row[item]."'");
        if ($icon=mysql_fetch_array($img))
            $images.='<a href="http://es.wowhead.com/item='.$row[item].'"><img src="wow/static/images/icons/items/'.strtolower($icon[iconname]).'.jpg"> </a>';
    }
    return $images;
}
?>
<div class="table ">
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
		                <span class="arrow">Tipo</span>
	                </a>
	            </th>
	            <th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Clase</span>
	                </a>
	            </th>
	            <th style="width:150px;">
				    <a href="#" class="sort-link">
		                <span class="arrow">Items</span>
	                </a>
	            </th>
				<th>
                    <a href="#" class="sort-link">
	                	<span class="arrow">Coste</span>
	                </a>
                </th>
				<th>
                    <a href="#" class="sort-link">
		                <span class="arrow">Canjear</span>
	                </a>
                </th>
			</tr>
		</thead>
		<tbody>
		<?php
			$result = mysql_query("SELECT * FROM cp_items where `type`='set'");
			$totalRows = mysql_num_rows($result);
			
			$pager_options = array(
				'mode'       => 'Sliding',
				'perPage'    => 9,
				'delta'      => 4,
				'urlVar'	 => 'page',
				'totalItems' => $totalRows,
			);

			$pager = Pager::factory($pager_options);
			echo $pager->links;
			
			list($from, $to) = $pager->getOffsetByPageId();
			$from = $from - 1;
			
			$perPage = $pager_options['perPage'];
			
		    $result=mysql_query("SELECT * FROM cp_items where `type`='set' ORDER by name LIMIT $from, $perPage");
		    $u=1;
		    while ($data=dbarray($result))
	        {
	            if($u>1) $u=1; else ++$u;
	            if($data[value3]!='--') $data[value3]='<a src="wow/static/images/icons/faction/'.$data[value3].'.jpg">';
	            echo'<tr height="25" class="row'.$u.'" id="rank-'.$u.'">
			    <td align="center" style="color:#A335EE;">'.utf8_encode($data[name]).'</td>
			    <td align="center">nivel '.$data[level].'</td>
			    <td align="center">'.$data[value2].'</td>	
			    <td align="center">'.getClass($data[value1]).'</td>	
			    <td align="center">'.get_icons($data[set]).'</td>		
			    <td align="center">'.$data[price].'<img src=wow/static/images/icons/creditos.png></td>
			    <td align="center" style="padding:0;"><input type="submit" onclick="doitt('.$data[id].');" class="submit" value="Canjear" alt="Canjear creditos" style="width: 80%;">
			    </td>
			    </tr>';
	        }
		?>
		</tbody>
	</table>
</div>	
<?php }

// PETS
elseif ($_GET['type']=='pet')
{
?>
<div class="table ">
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
		                <span class="arrow">Tipo</span>
	                </a>
	            </th>
				<th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Descripcion</span>
	                </a>
	            </th>
	            <th>
				    <a href="#" class="sort-link">
		                <span class="arrow">Lado</span>
	                </a>
	            </th>
				<th>
                    <a href="#" class="sort-link">
	                	<span class="arrow">Coste</span>
	                </a>
                </th>
				<th>
                    <a href="#" class="sort-link">
		                <span class="arrow">Canjear</span>
	                </a>
                </th>
			</tr>
		</thead>
		<tbody>
		<?php
			$result = mysql_query("SELECT * FROM cp_items where `type`='pet'");
			$totalRows = mysql_num_rows($result);
			
			$pager_options = array(
				'mode'       => 'Sliding',
				'perPage'    => 10,
				'delta'      => 4,
				'urlVar'	 => 'page',
				'totalItems' => $totalRows,
			);

			$pager = Pager::factory($pager_options);
			echo $pager->links;
			
			list($from, $to) = $pager->getOffsetByPageId();
			$from = $from - 1;
			
			$perPage = $pager_options['perPage'];
			
			$result=mysql_query("SELECT * FROM cp_items where `type`='pet' ORDER by name LIMIT $from, $perPage");
		    $u=1;
		    while ($data=dbarray($result))
	       	{
	            if($u>1) $u=1; else ++$u;
	            if($data[value3]!='--') $data[value3]='<a src="wow/static/images/icons/faction/'.$data[value3].'.jpg">';
	   	        echo'<tr height="25" class="row'.$u.'" id="rank-'.$u.'">
			    <td align="center"><a href="http://es.wowhead.com/?item='.$data[item].'" target="_blank" alt="'.$data[name].'">'.utf8_encode($data[name]).'</a></td>
		    	<td align="center">nivel '.$data[level].'</td>
			    <td align="center">'.utf8_encode($data[value1]).'</td>
			    <td align="center">'.utf8_encode($data[description]).'</td>
			    <td align="center">'.$data[value3].'</td>			
			    <td align="center">'.$data[price].'<img src=wow/static/images/icons/creditos.png></td>
			    <td align="center" style="padding:0;"><input type="submit" onclick="doitt('.$data[id].');" class="submit" value="Canjear" alt="Canjear creditos" style="width: 80%;">
			    </td>
			    </tr>';
				/*<td align="center" style="padding:0;"><input type="submit" onclick="send('.$data[id].');" class="submit" value="Canjear" alt="Canjear creditos" style="width: 80%;">*/
			}
		?>
		</tbody>
	</table>
</div>	
<?php }


}else{ ?>
<div class="main-services">
    <a href="?p=3&type=set" class="main-services-banner left-bnr" style="background-image:url('wow/static/images/services/thumbnails/thumb-cre-services-6.jpg');">
        <span class="banner-title">Conjuntos completos</span>
        <span class="banner-desc">Sets de arena PvP y tiers PvE, paquetes completos.</span>
    </a>
    <a href="?p=3&type=items" class="main-services-banner right-bnr" style="background-image:url('wow/static/images/services/thumbnails/thumb-cre-services-2.jpg');">
        <span class="banner-title">Items de armadura</span>
        <span class="banner-desc">Casco, manos, muñeca, abalorios, collares... todos los items de armadura sueltos disponibles aquí.</span>
    </a>
    <a href="?p=3&type=weapon" class="main-services-banner left-bnr" style="background-image:url('wow/static/images/services/thumbnails/thumb-cre-services-1.jpg');">
        <span class="banner-title">Armas y Escudos</span>
        <span class="banner-desc">Espadas de una mano, de dos manos, varitas, dagas, escudos, todo lo que puedas llevar en la mano, aquí.</span>

    </a>
    <a href="?p=3&type=mount" class="main-services-banner right-bnr" style="background-image:url('wow/static/images/services/thumbnails/thumb-cre-services-4.jpg');">
        <span class="banner-title">Monturas</span>
        <span class="banner-desc">Monturas voladoras, terrestres, las mejores monturas del juego disponibles en esta sección.</span>
    </a>
    <a href="?p=3&type=bag" class="main-services-banner left-bnr" style="background-image:url('wow/static/images/services/thumbnails/thumb-cre-services-5.jpg');">
        <span class="banner-title">Bolsas y oro</span>
        <span class="banner-desc">Necesitas espacio, bolsas inmensas y paquetes de oro para tu personaje disponibles aquí.</span>
    </a>
    <a href="?p=3&type=pet" class="main-services-banner right-bnr" style="background-image:url('wow/static/images/services/thumbnails/thumb-cre-services-3.jpg');">
        <span class="banner-title">Mascotas y miscelaneo</span>
        <span class="banner-desc">Si eres un coleccionista de compañeros, o buscas items raros esta es tu sección.</span>
    </a>
    <span class="clear"><!-- --></span>
</div>

<?php }} ?>
