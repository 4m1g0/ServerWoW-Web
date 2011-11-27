<?php
set_time_limit(0);
$story_pattern = '/\<div class\="story\-highlight"\>\<p\>(.+?)\<\/p\>\<\/div\>/';
$info_pattern = '/\<div class\="story\-main"\>\<div class\="story\-illustration"\>\<\/div\>(.+?)\<\/div\>/';

$desc_pattern = '/\<div class\="wrapper"\>\<p\>(.+?)\<\/p\>\<ul\>/';

$talents_pattern = '/\<div class\="basic\-info\-box\-list talent\-info"\>\<div class\="basic\-info\-box\-list\-title"\>\<span\>Talentos\<\/span\>\<\/div\>\<div class\="list-box"\>\<div class\="wrapper"\>\<p\>(.+?)\<\/p\>\<div class\="talent\-info\-wrapper"\>/';

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
define('CLASS_WARRIOR', 1);
define('CLASS_PALADIN', 2);
define('CLASS_HUNTER',  3);
define('CLASS_ROGUE',   4);
define('CLASS_PRIEST',  5);
define('CLASS_DK',      6);
define('CLASS_SHAMAN',  7);
define('CLASS_MAGE',    8);
define('CLASS_WARLOCK', 9);
define('CLASS_UNK',		10);
define('CLASS_DRUID',   11);
$classes = array(
	CLASS_WARRIOR => 'warrior',
	CLASS_PALADIN => 'paladin',
	CLASS_HUNTER => 'hunter',
	CLASS_ROGUE => 'rogue',
	CLASS_PRIEST => 'priest',
	CLASS_DK => 'death-knight',
	CLASS_SHAMAN => 'shaman',
	CLASS_MAGE => 'mage',
	CLASS_WARLOCK => 'warlock',
	CLASS_DRUID => 'druid'
);


foreach ($classes as $id => $key)
{
	$data = str_replace(array("\n", "\r", "\t"), '', file_get_contents('http://eu.battle.net/wow/es/game/class/' . $key));//);
	$matches = array();
	echo 'UPDATE `wow_classes` SET ';
	preg_match_all($story_pattern, $data, $matches);
	if ($matches[1])
		echo '`story_es` = \'' . str_replace("'", "\'", $matches[1][0]) . '\', ';
	preg_match_all($info_pattern, $data, $matches);
	if ($matches[1])
		echo '`info_es` = \'' . str_replace("'", "\'", $matches[1][0]) . '\', ';
	preg_match_all($desc_pattern, $data, $matches);
	if ($matches[1])
		echo '`desc_es` = \'' . str_replace("'", "\'", $matches[1][0]) . '\', ';
	preg_match_all($talents_pattern, $data, $matches);
	if ($matches[1])
		echo '`talents_es` = \'' . str_replace("'", "\'", $matches[1][0]) . '\' ';

	echo 'WHERE `key` = \'' . $key . '\';' . "\n";
	$matches = array();
	$matches2 = array();
	preg_match_all($racial_texts, $data, $matches);
	preg_match_all($racial_titles, $data, $matches2);
	if ($matches[1])
	{
		for ($i = 0; $i < sizeof($matches[1]); ++$i)
		{
			echo 'UPDATE `wow_class_abilities` SET `title_es` = \'' . str_replace("'", "\'", $matches2[1][$i]) . '\', `text_es` = \'' . str_replace("'", "\'", $matches[1][$i]) . '\' WHERE class = ' . $id . ' AND title_es = \'\' LIMIT 1;' . "\n";
		}
	}
}