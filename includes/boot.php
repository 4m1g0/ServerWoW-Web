<?php
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
 **/

if (!defined('BOOT_FILE'))
	exit;

session_start();
error_reporting(E_ALL);

$tstart = array_sum(explode(' ', microtime()));

define('ROOT', dirname(dirname(__FILE__)));
define('DS', '/');
define('WEBROOT_DIR', ROOT . DS . 'webroot' . DS);

define('INCLUDES_DIR', ROOT . DS . 'includes' . DS);
define('TEMPLATES_DIR', INCLUDES_DIR . 'templates' . DS);

define('CORE_DIR', INCLUDES_DIR . 'core' . DS);
define('CORE_CLASSES_DIR', CORE_DIR . 'classes' . DS);
define('CORE_CONFIGS_DIR', CORE_DIR . 'configs' . DS);
define('CORE_COMPONENTS_DIR', CORE_DIR . 'components' . DS);
define('CORE_MODELS_DIR', CORE_DIR . 'models' . DS);
define('CORE_LOCALES_DIR', CORE_DIR . 'locales' . DS);
define('CORE_TEMPLATES_DIR', CORE_DIR . 'templates' . DS);

define('SITE_DIR', INCLUDES_DIR . 'site' . DS);
define('SITE_CLASSES_DIR', SITE_DIR . 'classes' . DS);
define('SITE_CONFIGS_DIR', SITE_DIR . 'configs' . DS);
define('SITE_COMPONENTS_DIR', SITE_DIR . 'components' . DS);
define('SITE_MODELS_DIR', SITE_DIR . 'models' . DS);
define('SITE_LOCALES_DIR', SITE_DIR . 'locales' . DS);
define('SITE_TEMPLATES_DIR', SITE_DIR . 'templates' . DS);
define('CACHE_DIR', ROOT . DS . 'cache' . DS);
define('UPLOADS_DIR', WEBROOT_DIR . 'uploads' . DS);

define('NL', "\n");
define('TAB', "\t");
define('NLTAB', NL . TAB);
define('TABNL', TAB . NL);

// Load required files
include(INCLUDES_DIR . 'AppCrash.php');
include(CORE_DIR . 'dumpvar.php');
include(CORE_CLASSES_DIR . 'CacheInfo.php');
include(CORE_CLASSES_DIR . 'Autoload.php');
include(CORE_CLASSES_DIR . 'Component.php');
include(SITE_DIR . 'SharedDefines.php');

// Register classes autoloader
Autoload::register();

// Run application
try {
	// Create core
	$core = Core_Component::create();
	// Execute all actions
	$core->execute();
	// Collect MySQL statistics for all DBs
	$db_types = array('characters', 'world', 'realm', 'wow');
	$totalStat = array('count' => 0, 'time' => 0.0);
	foreach ($db_types as $type)
	{
		if (!$core->c('Db')->{$type}())
			continue;

		$mysql_statistics[$type] = $core->c('Db')->{$type}()->GetStatistics();
		$totalStat['count'] += $mysql_statistics[$type]['queryCount'];
		$totalStat['time'] += $mysql_statistics[$type]['queryTimeGeneration'];
	}
	$tend = array_sum(explode(' ', microtime()));
	$memory_usage = ((memory_get_usage(true)/1048576 * 100000)/100000);
	$memory_peak_usage = ((memory_get_peak_usage(true) / 1048576 * 100000)/100000);
	$debug_output = '';
	$debug_output .= '<div class="debug">';
	$totaltime = sprintf('%.2f', ($tend - $tstart));
	$reportLag = false;
	$debug_output .=sprintf('<p>Page generated in ~%.2f sec.<br />Memory usage: ~%.2f mbytes.<br />Memory usage peak: ~%.2f mbytes.</p>', $totaltime, $memory_usage , $memory_peak_usage);

	if ($totaltime > 1)
	{
		$reportLag = true;
		$debug_output .= '<h1 style="color:#ff0000;">WARNING: seems that your page generation time is too large, please, contact with developer</h1>';
	}

	if (memory_get_usage(true) > 9500000)
	{
		$debug_output .= '<h1 style="color:#ff0000;">WARNING: seems that your page takes a lot of memory, please, contact with developer</h1>';
		$reportLag = true;
	}

	if ($reportLag && $core->c('Config')->getValue('log.lag_report') > 0)
		$core->reportWebLag(($tend - $tstart), $memory_usage, $memory_peak_usage, $mysql_statistics); // Report about slow page generation

	foreach ($mysql_statistics as $type => $stat)
		$debug_output .= sprintf('MySQL queries count for %s DB: %d, approx. time: %.2f ms.<br />', $type, $stat['queryCount'], $stat['queryTimeGeneration']);

	$debug_output .= sprintf('Total MySQL queries count: %d, total approx. time: %.2f ms.<br />', $totalStat['count'], $totalStat['time']);
	$debug_output .= '</div>';

	
	
	if (!defined('SKIP_SHUTDOWN'))
		$core->shutdown(); // Shutdown application
}
catch(Exception $e) {

	$appCrash = new AppCrash($e);

	if ($core->c('Config')->getValue('log.debug') > 0)
		include(INCLUDES_DIR . 'ExceptionPage.php');
	else
		include(INCLUDES_DIR . 'ExceptionPageProduction.php');

	exit(1);
}

if ($core->c('Config')->getValue('log.debug') > 0 && !defined('AJAX_PAGE'))
{
	echo $debug_output;
}
?>
