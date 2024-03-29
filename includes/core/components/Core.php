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

class Core_Component extends Component
{
	const pattern_for_clear_url = '/[^ \/_0-9A-Za-zА-Яа-я-]/';
	private $m_configs 		 = null;
	private $m_session 		 = null;
	private $m_page    		 = null;
	private $m_document      = null;
	private $m_localeHandler = null;
	private $m_cache	 	 = null;
	private $m_actions 	 	 = array();
	private $m_actionsCount  = 0;
	private $m_variables	 = array();
	private $m_terminated	 = false;
	private $m_urlLocale	 = '';
	private $m_rawUrl		 = '';
	private $m_isCached		 = false;
	private $m_cacheEntry	 = '';
	private $m_dataVars		 = array();

	/**
	 * Separate constructor for Core_Component class
	 * Because of Component::__constuct() requires $core as second argument,
	 * we need to construct Core_Component as the first application available class.
	 * Without it, Component will go to loop and die after 100 iterations.

	 * @access public
	 * @constructor
	 */
	public function __construct()
	{
		$this->core = $this;
		$this->m_component = 'Core';

		if (!isset(self::$m_components['default']))
			self::$m_components['default'] = array();

		self::$m_components['default']['Core'] = $this;

		if (!defined('CLIENT_FILES_PATH'))
			define('CLIENT_FILES_PATH', $this->c('Config')->getValue('site.path'));
	}

	public function initialize()
	{
		$this->m_configs  = $this->c('Config');

		$this->m_session  	   = $this->c('Session');
		$this->m_document 	   = $this->c('Document');
		$this->m_localeHandler = $this->c('Locale');
		$this->m_cache    	   = $this->c('Cache');

		return $this;
	}

	/**
	 * Creates Core_Component instance
	 * @access public
	 * @param  $type = ''
	 * @return Core_Component
	 **/
	public static function create($type = '')
	{
		$class = ($type ? $type . '_' : '') . 'Core_Component';

		$core = new $class();

		return $core->initialize();
	}

	/**
	 * Executes all requried actions
	 * @access public
	 * @return Core_Component
	 **/
	public function execute()
	{
		// Parse url string
		$this->parseUrl();
		// Call router BEFORE controllers!
		$this->c('Router');
		// IMPORTANT: this is when and where controller being created.
		$this->initController();

		return $this;
	}

	/**
	 * Shuts down the application
	 * @access public
	 * @return Core_Component
	 **/
	public function shutdown()
	{
		Component::prepareShutdown();
		foreach ($this as &$type)
			unset($type);
	}

	/**
	 * Parses URL string ($_SERVER['REQUEST_URI'])
	 * @access private
	 * @return Core_Component
	 **/
	private function parseUrl()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : '';

		$this->m_rawUrl = $url;

		$url_data = explode('/', $url);

		if ($url_data)
		{
			$index = 0;
			foreach ($url_data as $action)
			{
				if (!$action)
					continue;
				$this->m_actions['action' . $index] = $action;
				++$index;
				/*if (!$this->isLocale($action, $index))
				{
					$this->m_actions['action' . $index] = $action;
					++$index;
				}
				else
					$this->m_urlLocale = $action;*/
			}
			// SET LOCALE
			$this->c('Locale')->setLocale('es', $this->c('Locale')->GetLocaleIDForLocale('es'), true);
		}

		$this->m_actionsCount = $index;

		return $this;
	}

	public function getUrlLocale()
	{
		return $this->m_urlLocale;
	}

	/**
	 * Checks whether URL action index is allowed locale string
	 * @access private
	 * @param  string $action
	 * @param  int $index
	 * @return bool
	 **/
	private function isLocale($action, $index)
	{
		if (!in_array($index, $this->c('Config')->getValue('site.locale_indexes')))
			return false;

		if (!$this->c('Locale')->isLocale($action, $this->c('Locale')->GetLocaleIDForLocale($action)))
			return false;

		// $action is correct locale, set it.
		$this->c('Locale')->setLocale($action, $this->c('Locale')->GetLocaleIDForLocale($action), true);
		return true;
	}

	/**
	 * Performs controller initialization
	 * @access private
	 * @return Core_Component
	 **/
	private function initController()
	{
		if (defined('SKIP_CONTROLLER'))
			return $this;

		$controller_name = str_replace(' ', '', $this->getUrlAction(0));
		$controller_name = preg_replace('/[^ \/_A-Za-z-]/', '', $controller_name);

		if (!$controller_name)
			return $this->c('Home', 'Controller');

		return $this->c($controller_name, 'Controller');
	}

	/**
	 * Returns URL action with index $index
	 * @access public
	 * @param  int $index
	 * @return string
	 **/
	public function getUrlAction($index)
	{
		if ($index < 0 || $index >= $this->m_actionsCount)
			return false;

		return $this->m_actions['action' . $index];
	}

	public function getActions()
	{
		return $this->m_actions;
	}

	/**
	 * Sets global variable
	 * @access public
	 * @param  string $varName
	 * @param  mixed $varValue
	 * @return Core_Component
	 **/
	public function setVar($varName, $varValue)
	{
		$this->m_variables[$varName] = $varValue;

		return $this;
	}

	/**
	 * Returns global variable with $varName name
	 * @access public
	 * @param  string $varName
	 * @return mixed
	 **/
	public function getVar($varName)
	{
		return isset($this->m_variables[$varName]) ? $this->m_variables[$varName] : null;
	}

	/**
	 * Terminates script and shows error message.
	 * @access public
	 * @param  string $errorMessage = ''
	 * @return void
	 **/
	public function terminate($errorMessage = '')
	{
		$this->m_terminated = true;

		echo '<h1>Unable to load site</h1>' . NL . '<p>Script work was terminated ';
		if ($errorMessage)
			echo 'with message <strong>"' . $errorMessage . '"</strong>!';
		else
			echo 'due to fatal error(s) in core code!';

		$admin_email = $this->c('Config')->getValue('misc.admin_email');
		echo '</p>' . NL . '<p>Please, contact with administrator of this resource via E-Mail <a href="mailto:' . $admin_email . '">' . $admin_email . '</a>.</p>';

		exit(1);
	}

	/**
	 * Returns raw URL
	 * @access public
	 * @return string
	 **/
	public function getRawUrl()
	{
		return $this->m_rawUrl;
	}

	public function getAppUrl($url = '')
	{
		return implode('/', $this->m_actions);
	}

	public function getApplicationUrl($path = '')
	{
		return 'http://' . $_SERVER['SERVER_NAME'] . '/' . $path;
	}

	public function getCoreVars()
	{
		return $this->m_variables;
	}

	public function redirectUrl($path = '', $code = 302)
	{
		header('Location: ' . $this->getWowUrl($path), true, $code);
		exit;
	}
	
	public function redirectUrl2($path = '', $code = 302)
	{
		//header('Location: ' . $this->getWowUrl($path), true, $code);
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $this->getWowUrl($path), true, $code);
		exit;
	}

	public function redirectApp($path, $code = 302)
	{
		header('Location:' . $path, true, $code);
		exit;
	}

	public function setCacheEntry($entry)
	{
		$this->m_isCached = true;
		$this->m_cacheEntry = $entry;

		return $this;
	}

	public function isCached()
	{
		return $this->m_isCached;
	}

	public function getCacheEntry()
	{
		return $this->m_cacheEntry;
	}

	public function setDataVar($var, $value)
	{
		$this->m_dataVars[$var] = $value;

		return $this;
	}

	public function getDataVar($var)
	{
		return isset($this->m_dataVars[$var]) ? $this->m_dataVars[$var] : false;
	}

	public function getDataVars()
	{
		return $this->m_dataVars;
	}

	public function reportWebLag($time, $memory, $memory_peak, &$mysql)
	{
		if ($this->c('Session')->getSession('lag_report') == implode('/', $this->getActions()))
			return;

		$timers = 'Page generated in ' . $time . ' sec., memory: ' . $memory . 'MB, peak: ' . $memory_peak . 'MB, MySQL:<br/ >';
		foreach ($mysql as $type => $stat)
		{
			$timers .= '<b>[mysql-' . $type . ']</b>: count: ' . $stat['queryCount'] . ', time: ' . $stat['queryTimeGeneration'] . '<br />';
		}
		$this->c('Db')->wow()->query("INSERT INTO wow_lag_reports (user_ip, page_url, timers, date_time) VALUES ('%s', '%s', '%s', %d)", $_SERVER['REMOTE_ADDR'], implode('/', $this->getActions()), str_replace('%', '%%', $timers), time());
		$this->c('Session')->setSession('lag_report', implode('/', $this->getActions()));
		
	}
}
?>