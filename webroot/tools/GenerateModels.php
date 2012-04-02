<?php

/**
 * Copyright (C) 2011 Shadez <https://github.com/Shadez>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 **/

define('SKIP_SHUTDOWN', true);
define('BOOT_FILE', dirname(dirname(dirname(__FILE__))) . '/' . 'includes' . '/' . 'boot.php');
include(BOOT_FILE);
echo '<script language="javascript" type="text/javascript">
function redirect(url)
{
	location.href = url;
}
</script>';
$type = isset($_GET['type']) ? $_GET['type'] : false;
$dbId = isset($_GET['dbId']) ? $_GET['dbId'] : false;
$table = isset($_GET['table']) ? $_GET['table'] : false;
$all = isset($_GET['all']) ? $_GET['all'] : false;
$all_types = array('wow', 'characters', 'world', 'realm');
if (in_array($type, $all_types))
{
	if ($table || $all)
	{
		if ($all)
			GetModels($core, $type, $dbId, '', true);
		else if ($table)
			GetModels($core, $type, $dbId, $table);
	}
	else
	{
		if ($type == 'wow' || $type == 'realm')
		{
			$db_info = $core->c('Config')->getValue('database.' . $type);
			GetTablesList($core, $type);
		}
		else if ($dbId && $db_info = $core->c('Config')->getValue('database.' . $type . '.' . $dbId))
		{
			GetTablesList($core, $type, $dbId);
		}
		else
		{
			$dbs = $core->c('Config')->getValue('database.' . $type);
			if ($dbs)
			{
				echo '<p>Select DB:</p>';
				foreach ($dbs as $id => $db)
					echo '<p><a href="?type=' . $type .'&amp;dbId=' . $id . '">' . $db['db_name'] . '</a></p>';
			}
		}
	}
}
else
{
	foreach($all_types as $t) {
		echo '<a href="?type=' . $t . '">' . $t . '</a><br />';
	}
}

function GetTablesList($core, $type, $dbId = 0)
{
	if ($type == 'wow' || $type == 'realm')
		$db_info = $core->c('Config')->getValue('database.' . $type);
	else
		$db_info = $core->c('Config')->getValue('database.' . $type . '.' . $dbId);

	$core->c('Database')
		->connect($db_info);
	$tables = $core->c('Database')->select("SHOW TABLES FROM " . $db_info['db_name']);

	$index = 'Tables_in_' . $db_info['db_name'];
	
	echo '<h3><a href="?type=' . $type . (($type != 'wow' && $type != 'realm') ? '&amp;dbId=' . $dbId : '') . '&amp;all=true">All tables</a></h3>' . NL .
	'<select name="table" id="table">';
	
	foreach ($tables as $table)
		echo '<option value="' . $table[$index] . '">' . $table[$index] . '</option>';

	echo '</select> <input type="submit" value="Create" onclick="redirect(\'?type=' . $type . (($type != 'wow' && $type != 'realm') ? '&amp;dbId=' . $dbId : '') . '&amp;table=\' + getElementById(\'table\').value);">';
}

function GetModels($core, $type, $dbId, $table = '', $all = false)
{
	if ($type == 'wow' || $type == 'realm')
		$db_info = $core->c('Config')->getValue('database.' . $type);
	else
		$db_info = $core->c('Config')->getValue('database.' . $type . '.' . $dbId);

	$core->c('Database')
		->connect($db_info);

	if ($table && !$all)
	{
		$fields = $core->c('Database')->select("SHOW COLUMNS FROM " . $db_info['db_name'] . '.' . $table);
		parseFields($fields, $table, $type);
		echo 'Done';
	}
	else
	{
		$tables = $core->c('Database')->select("SHOW TABLES FROM " . $db_info['db_name']);
		$index = 'Tables_in_' . $db_info['db_name'];
		foreach ($tables as $table)
		{
			$fields = $core->c('Database')->select("SHOW COLUMNS FROM " . $db_info['db_name'] . '.' . $table[$index]);
			parseFields($fields, $table[$index], $type);
		}
		echo 'Done';
	}
}

function isAddedToLocale($field, $locale_fields, $type = 'wow')
{
	if ($type == 'wow')
	{
		$locales = array('es', 'en', 'de', 'fr', 'ru');
		foreach ($locales as $l)
			if (in_array($field . '_' . $l, $locale_fields))
				return true;
	}
	else
		for ($i = 1; $i < 9; ++$i)
			if (in_array($field . '_loc' . $i, $locale_fields))
				return true;
	return false;
}

function parseFields(&$fields, $table, $type)
{
	$text = '<?php

/**
 * Copyright (C) 2009-2011 Shadez <https://github.com/Shadez>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 **/' . NL . NL;

	$n = explode('_', $table);
	$text .= 'class ';
	$model = '';
	if ($n)
	{
		foreach ($n as $t)
			$model .= ucfirst($t);
	}
	else $model = ucfirst($table);

	$text .= $model . '_Model_Component extends Model_Db_Component' . NL . '{' . NLTAB;
	$text .= 'public $m_model = \'' . $model . '\';' . NLTAB;
	$text .= 'public $m_table = \'' . $table . '\';' . NLTAB;
	$text .= 'public $m_dbType = \'' . $type . '\';' . NLTAB;
	$text .= 'public $m_fields = array(' . NLTAB;
	$locale_fields = array();
	foreach ($fields as $field)
	{
		if (!isset($field['Field']) || in_array($field['Field'], $locale_fields))
			continue;

		$locale = false;
		$Dblocale = false;
		if ($type == 'wow')
		{
			if (preg_match('/_de/', $field['Field']) || preg_match('/_en/', $field['Field']) || preg_match('/_es/', $field['Field']) || preg_match('/_fr/', $field['Field']) || preg_match('/_ru/', $field['Field']))
			{
				$exp = explode('_', $field['Field']);
				unset($exp[sizeof($exp)-1]);
				$name = implode('_', $exp);
				if (isAddedToLocale($name, $locale_fields, 'wow'))
					continue;

				$locale_fields[] = $field['Field'];
				$locale = true;
			}
		}
		elseif ($type == 'world')
		{
			if (preg_match('/_loc[1-8]/', $field['Field']))
			{
				$exp = explode('_loc', $field['Field']);
				unset($exp[sizeof($exp)-1]);
				$name = implode('_', $exp);
				if (isAddedToLocale($name, $locale_fields, 'world'))
					continue;

				$locale_fields[] = $field['Field'];
				$Dblocale = true;
			}
		}

		if ($locale)
			$text .= TAB . '\'' . $name . '\' => \'Locale\',' . NLTAB;
		else if ($Dblocale)
			$text .= TAB . '\'' . $name . '\' => \'DbLocale\',' . NLTAB;
		elseif (($field['Field'] == 'id' && $type == 'wow') || ($field['Field'] == 'guid' && $type == 'characters') || ($field['Field'] == 'entry' && $type == 'world') || ($field['Field'] == 'account' && $type == 'realm'))
			$text .= TAB . '\'' . $field['Field'] . '\' => \'Id\',' . NLTAB;
		else if ($field['Field'] == 'id')
			$text .= TAB . '\'' . $field['Field'] . '\' => \'Id\',' . NLTAB;
		else
			if (preg_match('/text/', $field['Type']) || preg_match('/varchar/', $field['Type']))
				$text .= TAB . '\'' . $field['Field'] . '\' => array(\'type\' => \'string\'),' . NLTAB;
			elseif (preg_match('/float/', $field['Type']) || preg_match('/double/', $field['Type']))
				$text .= TAB . '\'' . $field['Field'] . '\' => array(\'type\' => \'float\'),' . NLTAB;
			else
				$text .= TAB . '\'' . $field['Field'] . '\' => array(\'type\' => \'integer\'),' . NLTAB;
	}
	$text .= ');' . NL . '}' . NL . '?>';
	$fName = SITE_DIR . 'components' . DS . 'models' . DS . ucfirst(strtolower($model)) . '.php';
	if (file_exists($fName)) 
	{
		echo '<b>Warning</b>: overwriting file ' . $fName . '!<br />';
	}
	file_put_contents($fName, $text);
}
?>