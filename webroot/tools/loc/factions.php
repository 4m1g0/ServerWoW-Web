<?php
exit;
set_time_limit(0);
$models_pattern = '/"(.+?)"\: new ModelRotator\("#model\-(.+?)"\)/';
$faction_pattern = '/\<span class\="icon\-faction\-(.+?)"\>\<\/span\>/';
$leader_pattern = '/\<li\>\<span class\="term"\>Líder\:\<\/span\>\<span class\="tip" data\-npc\="(.+?)"\>(.+?)\<\/span\>\<\/li\>/';
$intendant_pattern = '/\<li\>\<span class\="term"\>Intendente\:\<\/span\>\<span class\="tip" data\-npc\="(.+?)"\>(.+?)\<\/span\>\<\/li\>/';
$location_pattern = '/\<li\>\<span class\="term"\>Lugar\:\<\/span\>(.+?)\<\/li\>/';
$idname_pattern = '/Fansite\.generate\(\'#fansite-links\'\, "faction\|(.+?)\|(.+?)"\)\;/';
$exp_pattern = '/\<span class\="expansion-name color-ex(.+?)"\>/';
$intro_pattern = '/\<p class\="intro"\>(.+?)\<\/p\>\<div class\="lore"\>/';
$lore_pattern = '/\<div class\="lore"\>(.+?)\<\/div\>/';
$npcs_pattern = '/"id"\: (.+?)\,"name"\: "(.+?)"\,"slug"\: "(.+?)"/';

$keys = array('baradins-wardens','dragonmaw-clan','wildhammer-clan','the-earthen-ring','guardians-of-hyjal','hellscreams-reach','ramkahen','therazane','avengers-of-hyjal','knights-of-the-ebon-blade','argent-crusade','the-wyrmrest-accord','the-ashen-verdict','kirin-tor','the-sons-of-hodir','the-kaluak','the-oracles','frenzyheart-tribe','horde-expedition','the-hand-of-vengeance','the-sunreavers','the-taunka','warsong-offensive','alliance-vanguard','the-silver-covenant','valiance-expedition','explorers-league','the-frostborn','netherwing','honor-hold','the-consortium','the-violet-eye','sporeggar','cenarion-expedition','ashtongue-deathsworn','kurenai','the-scale-of-the-sands','the-maghar','ogrila','thrallmar','tranquillien','keepers-of-time','lower-city','shatari-skyguard','the-aldor','the-scryers','the-shatar','shattered-sun-offensive','timbermaw-hold','bloodsail-buccaneers','gelkis-clan-centaur','magram-clan-centaur','cenarion-circle','argent-dawn','darkmoon-faire','thorium-brotherhood','wintersaber-trainers','syndicate','brood-of-nozdormu','ravenholdt','shendralar','hydraxian-waterlords','zandalar-tribe','darnassus','exodar','ironforge','gilneas','gnomeregan','stormwind','booty-bay','gadgetzan','ratchet','everlook','silverwing-sentinels','stormpike-guard','the-league-of-arathor','frostwolf-clan','warsong-outriders','the-defilers','thunder-bluff','silvermoon-city','bilgewater-cartel','undercity','orgrimmar','darkspear-trolls');

foreach ($keys as $key)
{
	$data = file_get_contents('http://eu.battle.net/wow/es/faction/' . $key);
	$data = str_replace(array("\n", "\r", "\t"), '', $data);

	$faction = array();
	preg_match_all($faction_pattern, $data, $faction);

	$leader = array();
	preg_match_all($leader_pattern, $data, $leader);

	$intendant = array();
	preg_match_all($intendant_pattern, $data, $intendant);

	$location = array();
	preg_match_all($location_pattern, $data, $location);

	$idname = array();
	preg_match_all($idname_pattern, $data, $idname);

	$exp = array();
	preg_match_all($exp_pattern, $data, $exp);

	$intro = array();
	preg_match_all($intro_pattern, $data, $intro);

	$lore = array();
	preg_match_all($lore_pattern, $data, $lore);

	$npcs = array();
	preg_match_all($npcs_pattern, $data, $npcs);

	echo 'INSERT INTO wow_factions (`key`,id,name,`intro_es`,`desc_es`,faction,`leader_es`,`intendant_es`,`location_es`,`leader_id`,`intendant_id`,expansion) VALUES (';
	echo '\'' . $key . '\', ' . $idname[1][0]  . ', \'' . $idname[2][0] . '\', \'' . str_replace("'", "\'", $intro[1][0]) . '\', ';
	echo '\'' . str_replace("'", "\'", $lore[1][0]) . '\', ';
	echo $faction[1][0] . ', \'' . str_replace("'", "\'", $leader[2][0]) . '\', ';
	echo '\'' . str_replace("'", "\'", $intendant[2][0]) . '\', \'' . str_replace("'", "\'", $location[1][0]) . '\', ';
	echo $leader[1][0] . ', ' . $intendant[1][0] . ', ' . $exp[1][0];
	echo ');' . "\n";
	$ns = sizeof($npcs[1]);
	for ($i = 0; $i < $ns; ++$i)
	{
		echo 'INSERT INTO wow_faction_npcs VALUES(' . $idname[1][0] . ', ' . $npcs[1][$i] . ', \'' . $npcs[3][$i] . '\', \'' . str_replace("'", "\'", $npcs[2][$i]) . '\');' . "\n";
	}
}
