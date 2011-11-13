<script type="text/javascript">
function countspeedandbns()
{
	var mount = document.getElementById('mount');
	var speed = document.getElementById('speed');
	var bns4mount = document.getElementById('bonusesformount');
	if (mount.value != '')
	{

<?php
	$result = dbquery("SELECT `item` FROM cp_items where `type`='mount' ")or die("eror") ;
	
	while ($data=dbarray($result))
	{
		switchConnection(1,"world");
		$mname = dbquery("SELECT `entry`, `speed`, `price` FROM item_template where entry='$data[item]' ")or die("eror") ;
		$mount = dbarray($mname);
		echo "if (mount.value == '$mount[entry]') {speed.value = '$data[speed]%'; bns4mount.value = '$data[price] Creditos';} ";
}
?>

	}
	else
	{
		speed.value = '';
		bns4mount.value = '';
	}
}

function countslotsandbns()
{
	var bag = document.getElementById('bag');
	var slots = document.getElementById('slots');
	var bns4bags = document.getElementById('bonusesforbag');
	if (bag.value != '')
	{

<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT `item` FROM cp_items where `type`='bag' ")or die("eror") ;

	while ($data=dbarray($result))
	{
		switchConnection(1,"world");
		$bname = dbquery("SELECT `entry`, `ContainerSlots`, `price` FROM item_template where entry='$data[item]' ")or die("eror") ;
		$bag = dbarray($bname);
		echo "if (bag.value == '$bag[entry]') {slots.value = '$bag[ContainerSlots]';bns4bags.value ='$data[price] Creditos';} ";
	}
?>
	}
	else
	{
		slots.value = '';
		bns4bags.value = '';
	}
}

function getlinkandbns_h()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='casco' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_s()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='hombros' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_ha()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='manos' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_w()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='cintura' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_l()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='piernas' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_f()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='pies' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_p()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='pecho' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_m()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='munecas' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_cu()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='cuello' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_ca()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='capas' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_ab()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='abalorio' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_am()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='amuleto' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}


function getlinkandbns_an()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='anillo' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_mtt()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='mountt' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_spone()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='espada_one' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_sptwo()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='espada_two' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_haone()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='hachas_one' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_hatwo()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='hachas_two' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_maone()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='mazas_one' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_matwo()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='mazas_two' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_ap()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='armas_puno' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_aa()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='armas_asta' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_dao()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='dagas_one' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_bo()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='bastones_one' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getlinkandbns_eo()
{
	var itt = document.getElementById('itt');
	var bns4fun = document.getElementById('bonusesforfun');
	if (itt.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='escudos_one' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$itemname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$item = dbarray($itemname);
		echo "if (itt.value == '$item[entry]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}

function getgoldandbns()
{
	var fung = document.getElementById('fungold');
	var bns4fun = document.getElementById('bonusesforfun');
	if (fung.value != '') {
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='money' ")or die("eror");

	while($data=dbarray($result))
	{
		echo "if (fung.value == '$data[id]') {bns4fun.value = '$data[price] Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}


function getsetandbns()
{
	var set = document.getElementById('itemset');
	var count = document.getElementById('itemcount');
	var bns4set = document.getElementById('bonusesforset');
	if (set.value != '')
	{
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='itemset' ")or die("eror") ;
	switchConnection(1,"world");
	
	while($data=dbarray($result))
	{
		$sname = dbquery("SELECT * FROM item_template where itemset='$data[item]' ")or die("eror") ;
		$count=dbrows($sname);
		echo "if (set.value == '$data[item]') {count.value = '$count'; bns4set.value = '$data[price] Creditos'; document.getElementById('itemslist').innerHTML ='<center>";

		while($set=dbarray($sname))
		{
			echo"<a href=$wowheadlink$set[entry]>".stripinput($set[name])."</a><br><br>";
		}

	echo"</center>';}";
	}
?>
	}
	else
	{
		bns4set.value = '';
		set.value = '';
		count.value = '';
		document.getElementById('itemslist').innerHTML ='';
	}
}

function ShardsToGold()
{
	var realm = document.getElementById('realmList');
<?
	foreach ($SendGoldPerRealmRate as $i => $value)
	{
		echo "if (realm.value == '".$i."') {var goldrate = ".$value.";}";
	}
?>
	document.getElementById('shards').value = Math.ceil(document.getElementById('gold').value * goldrate )+' Creditos';
}

function ShardsTolvl()
{
	var realm = document.getElementById('realmList');
<?
	foreach ($lvlRate as $i => $value)
	{
		echo "if (realm.value == '".$i."') {var lvlrate = ".$value.";}";
	}
?>
	document.getElementById('shards').value = Math.ceil(document.getElementById('lvl').value * lvlrate )+' Creditos';
}

function getgiftandbns()
{
	var fun = document.getElementById('funitem');
	var bns4fun = document.getElementById('bonusesforfun');
	var count = document.getElementById('count');
	if (fun.value != '')
	{
<?
	switchConnection(1,"realmd");
	$result = dbquery("SELECT * FROM cp_items where `type`='gift' ")or die("eror") ;

	while($data=dbarray($result))
	{
		switchConnection(1,"world");
		$fname = dbquery("SELECT * FROM item_template where entry='$data[item]' ")or die("eror") ;
		$fun=dbarray($fname);
		echo "var total=count.value*$data[price];";
		echo" if (fun.value == '$fun[entry]') {bns4fun.value = total+' Creditos';}";
	}
?>
	}
	else
	{
		bns4fun.value = '';
	}
}
</script>
<script src='services/js/servicios.js' type='text/javascript' language='JavaScript'></script>

<?
error_reporting(0);

if($wowhead) echo $wowheadjs;?>
<link rel="stylesheet" type="text/css" media="all" href="wow/static/css/cms.css?v4" />
<p><table width="100%" border=0>
<tr>
<td colspan="4" align="top" id="spacing" height="120"></td>
</tr>
<tr>
<td width="30%" align="center"><b>Seleccionar Reino:</b></td>
<td width="20%" align="left">
<select name="realm" id="realmList" class="select" onchange="javascript:changeRealm();" style="width: 150px;">
<?
	foreach ($world_db as $i => $value)
	{
		echo"<option value=$value[0]>$i</option>";
	}
?>
</select>
</td>
<td width="30%" align="center"><b>Seleccionar una Opcion:</b></td>
<td width="20%" align="left">
<select name="wasteType" id="wasteList" class="select" onchange="javascript:changeWaste();" style="width: 150px;">
<option value="">Selecciona una Opcion...</option>
<?
	foreach ($cre_reward as $u => $value)
	{
		echo"<option value=$u>$local[$u]</option>";
	}
?>
</select>
</td>
</tr>
<tr>
<td colspan="4" align="center" height="25"></td>
</tr>
<tr>
<td colspan="4"><div id='ServiceInput'></div></td>
</tr>
</table></p>
<div id="news-updates">

<div class="news-article first-child">	<h3><a href="news.php?id=11"> Welcome... </a></h3>
	<div class="by-line">by <a href="#">Unkown</a><span class="spacer"> //</span> 2010-12-19 10:00:00		<a href="news.php?id=11#comments" class="comments-link">18</a>

		</div>
		
		

        <div class="article-right">
			<div class="article-summary">
			<p>Welcome to World of Warcraft Community Website....</p>
			<a href="news.php?id=11" class="more">M&aacute;s</a>

            </div>
        </div>
	<span class="clear"><!-- --></span>
    </div>
</div>
