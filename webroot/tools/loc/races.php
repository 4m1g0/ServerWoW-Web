<?php
set_time_limit(0);
$story_pattern = '/\<div class\="story\-highlight"\>(.+?)\<\/div\>/';
$info_pattern = '/\<div class\="story\-main"\>(.+?)\<\/p\>\<\/div\>/';
$location_pattern = '/\<h5 class\="basic\-header"\>\<span class\="overview\-icon"\>\<\/span\>Zona de inicio:\<span\>(.+?)\<\/span\>\<\/h5\>/';
$homecity_pattern = '/\<h5 class\="basic\-header"\>\<span class\="overview\-icon"\>\<\/span\>Ciudad capital:\<span\>(.+?)\<\/span\>\<\/h5\>/';
$mount_pattern = '/\<h5 class\="basic\-header"\>\<span class\="overview\-icon"\>\<\/span\>Montura racial:\<span\>(.+?)\<\/span\>\<\/h5\>/';
$leader_pattern = '/\<h5 class\="basic\-header"\>\<span class\="overview\-icon"\>\<\/span\>Líder:\<span\>(.+?)\<\/span\>\<\/h5\>/';
$infos_pattern = '/\<div class\="basic\-story"\>(.+?)\<\/div\>/'; //0->location_info, 1->homecity_info, 2->mount_info, 3->leader_info

$racial_titles = '/\<span class\="feature\-item\-title"\>(.+?)\<\/span\>/';
$racial_texts = '/\<p class\="feature\-item\-desc"\>(.+?)\<\/p\>/';

$races = array(
	'human', 'orc', 'dwarf', 'night-elf', 'forsaken', 'tauren', 'gnome', 'troll', 'goblin', 'blood-elf', 'draenei', 21 => 'worgen'
);

foreach ($races as $id => $key)
{
	$data = file_get_contents('http://eu.battle.net/wow/es/game/race/' . $key);
	$matches = array();
	$matches2 = array();
	preg_match_all($racial_titles, $data, $matches);
	preg_match_all($racial_texts, $data, $matches2);
	for ($i = 0; $i < sizeof($matches[1]); ++$i)
	{
		echo 'UPDATE `wow_race_abilities` SET `title_es` = \''  . str_replace('\'', "\'", $matches[1][$i]) . '\', `text_es` = \'' . str_replace('\'', "\'", $matches2[1][$i]) . '\' WHERE `race` = ' . ($id + 1) . ' AND `title_es` = \'\' LIMIT 1;';
	}
	//echo '<br />';
	/*echo 'UPDATE `wow_races` SET ';
	preg_match_all($story_pattern, $data, $matches);
	if ($matches[1])
		echo '`story_es` = \'' . str_replace('\'', "\'", $matches[1][0]) . '\'';
	preg_match_all($info_pattern, $data, $matches);
	if ($matches[1])
		echo ', `info_es` = \'' . str_replace('\'', "\'", $matches[1][0]) . '</p>\'';
	preg_match_all($location_pattern, $data, $matches);
	if ($matches[1])
		echo ', `location_es` = \'' . str_replace('\'', "\'", $matches[1][0]) . '\'';
	preg_match_all($homecity_pattern, $data, $matches);
	if ($matches[1])
		echo ', `homecity_es` = \'' . str_replace('\'', "\'", $matches[1][0]) . '\'';
	preg_match_all($mount_pattern, $data, $matches);
	if ($matches[1])
		echo ', `mount_es` = \'' . str_replace('\'', "\'", $matches[1][0]) . '\'';
	preg_match_all($leader_pattern, $data, $matches);
	if ($matches[1])
		echo ', `leader_es` = \'' . str_replace('\'', "\'", $matches[1][0]) . '\'';
	preg_match_all($infos_pattern, $data, $matches);
	if ($matches[1])
	{
		echo ', `location_info_es` = \'' . str_replace('\'', "\'", $matches[1][0]) . '\'';
		echo ', `homecity_info_es` = \'' . str_replace('\'', "\'", $matches[1][1]) . '\'';
		echo ', `mount_info_es` = \'' . str_replace('\'', "\'", $matches[1][2]) . '\'';
		echo ', `leader_info_es` = \'' . str_replace('\'', "\'", $matches[1][3]) . '\'';
	}
	echo ' WHERE `key` = \'' . $key . '\';<br />';*/
}