<?php
$c= mysql_connect('localhost', 'root', '');
mysql_query('set names utf8');
$d = mysql_select_db('wow_cs');
$q = mysql_query("select id, name_es FROM wow_profession_data");
while($r = mysql_fetch_assoc($q))
	echo "    'profession_" . $r['id'] . "' => '" . htmlspecialchars_decode($r['name_es']) . "',<br/>";