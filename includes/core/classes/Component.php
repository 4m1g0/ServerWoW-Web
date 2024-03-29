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

/**
 * Abstract class that provides basic methods for Components
 * @copyright Copyright (C) 2010-2011 Shadez <https://github.com/Shadez>
 * @category  Core
 * @abstract
 **/
abstract class Component
{
	/**
	 * All available components
	 * @access protected
	 * @var    array
	 * @static
	 **/
	protected static $m_components = array();

	/**
	 * Core component instance
	 * @access public
	 * @var    Core_Component
	 **/
	public $core = null;

	/**
	 * Current component name
	 * @access protected
	 * @var    string
	 **/
	protected $m_component = null;

	/**
	 * Is component loaded? Yes (true) / No (false)
	 * @access protected
	 * @var    bool
	 **/
	protected $m_initialized = false;

	/**
	 * Unique component hash
	 * @access protected
	 * @var    string
	 **/
	protected $m_uniqueHash = '';

	protected $m_locale = '';
	protected $m_localeID = 0;
	protected $m_coreUrl = '';
	private $m_iconsServer = '';

	/**
	 * Class constructor
	 * @access public
	 * @param  string $name
	 * @param  Component $core
	 * @return void
	 **/
	public function __construct($name, Component $core)
	{
		if (!$name)
			throw new CoreCrash_Exception_Component('Component name was not provided!');

		$this->core = $core;
		$this->m_component = $name;

		$this->m_uniqueHash = uniqid(dechex(time()), true);
	}

	public function localePath()
	{
		return $this->m_locale . '/';
	}

	/**
	 * Class destructor
	 * @access public
	 * @return void
	 **/
	public function __destruct()
	{
		foreach ($this as $variable => &$value)
		{
			if (isset($this->{$variable}))
				unset($this->{$variable});
			elseif (isset(self::${$variable}))
				unset(self::${$variable});
		}
	}
	
	/**
	 * Initializes Component's object
	 * @access public
	 * @return Component
	 **/
	public function initialize()
	{
		return $this;
	}

	/**
	 * Initialization checker
	 * @access public
	 * @return bool
	 **/
	public function isInitialized()
	{
		return $this->m_initialized;
	}
	
	/**
	 * Sets initialization state
	 * @access public
	 * @param  bool $value
	 * @return Component
	 **/
	public function setInitialized($value)
	{
		$this->m_initialized = $value;

		return $this;
	}
	
	/**
	 * Returns or tries to create component
	 * @access public
	 * @param  string $name
	 * @param  string $type = ''
	 * @return Component
	 **/
	public function c($name, $type = '')
	{
		return $this->getComponent($name, $type);
	}
	
	/**
	 * Tries to find existed instance of $name component or creates new object
	 * @access private
	 * @param  string $name
	 * @param  string $type = ''
	 * @return Component
	 **/
	private function getComponent($name, $type = '')
	{
		$c_name = ucfirst($name) . ($type ? '_' . $type : '') . '_Component';

		if ($type == '')
			$c_type = 'default';
		else
			$c_type = strtolower($type);

		if (!isset(self::$m_components[$c_type]))
			self::$m_components[$c_type] = array();

		if (isset(self::$m_components[$c_type][$name]))
			return self::$m_components[$c_type][$name];

		//TODO: Try to check class file existence before create instance of class.
		//If this will be implemented, we'll can safely handle controller errors (404).

		$c_name = str_replace('-', '', $c_name);
		$component = new $c_name($c_name, $this->core); // 

		$this->addComponent($name, $c_type, $component);

		return $component->initialize()->setInitialized(true);
	}

	/**
	 * Adds component into components list
	 * @access private
	 * @param  string $name
	 * @param  Component $c
	 * @return Component
	 **/
	private function addComponent($name, $type, $c)
	{
		if (!isset(self::$m_components[$type]))
			self::$m_components[$type] = array();

		self::$m_components[$type][$name] = $c;

		return $this;
	}

	public function getPath($file = '')
	{
		$path = $this->c('Config')->getValue('site.path');
		if ($file)
			$path .= $file;

		return $path;
	}

	public function issetRegion($name)
	{
		return $this->c('Document')->regionExists($name);
	}

	public function region($name)
	{
		return $this->c('Page')->getContents($name);
	}

	public function shutdownComponent()
	{
		foreach ($this as &$field)
			unset($field);

		return $this;
	}

	public static function prepareShutdown()
	{
		foreach (self::$m_components as $type => &$components)
		{
			foreach ($components as $name => &$component)
			{
				if ($type == 'default' && $name == 'Core')
					continue;
				else
				{
					$component->shutdownComponent();
					unset($component, self::$m_components[$type][$name]);
				}
			}
			if ($type != 'default')
				unset(self::$m_components[$type]);
		}
	}

	public function localeWowUrl($url = '')
	{
		if (!$this->m_locale)
			$this->m_locale = $this->c('Locale')->GetLocale();

		if ($this->m_coreUrl != null)
			return $this->m_coreUrl . $url;

		if (!defined('CLIENT_FILES_PATH'))
			define('CLIENT_FILES_PATH', $this->c('Config')->getValue('site.path'));

		$this->m_coreUrl = CLIENT_FILES_PATH . '/wow';
		return $this->m_coreUrl . $url;
	}

	public function getWowUrl($url = '')
	{
		if (!$this->m_locale)
			$this->m_locale = $this->c('Locale')->GetLocale();

		if ($this->m_coreUrl != null)
			return $this->m_coreUrl . '/' . $url;

		if (!defined('CLIENT_FILES_PATH'))
			define('CLIENT_FILES_PATH', $this->c('Config')->getValue('site.path'));

		$this->m_coreUrl = CLIENT_FILES_PATH . '/wow';
		return $this->m_coreUrl . '/' . $url;
	}

	public function getCoreUrl($url = '')
	{
		if (!defined('CLIENT_FILES_PATH'))
			define('CLIENT_FILES_PATH', $this->c('Config')->getValue('site.path'));

		return CLIENT_FILES_PATH . '/' . $url;
	}

	public function getAppUrl($url = '')
	{
		return $this->getCoreUrl($url);
	}

	public function getPage($asOffset = false)
	{
		if (!isset($_GET['page']))
			return $asOffset ? 0 : 1;

		return $asOffset ? (intval($_GET['page']) - 1) : intval($_GET['page']);
	}

	public function isSSLConnection()
	{
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on');
	}

	public function reconnectWithSSL()
	{
		if (!$this->isSSLConnection() && $this->c('Config')->getValue('site.ssl'))
		{
			header('Location: https://' . $_SERVER['HTTP_HOST'] . '/' . $this->core->getRawUrl());
			exit;
		}
	}

	public function getIconsServer()
	{
		if (!$this->m_iconsServer)
		{
			$this->m_iconsServer = array(
				$this->c('Config')->getValue('site.icons_server'),
				$this->c('Config')->getValue('site.media_server'),
				$this->c('Config')->getValue('site.render_server')
			);
		}

		return $this->m_iconsServer[0];
	}

	public function getMediaServer()
	{
		if (!$this->m_iconsServer)
		{
			$this->m_iconsServer = array(
				$this->c('Config')->getValue('site.icons_server'),
				$this->c('Config')->getValue('site.media_server'),
				$this->c('Config')->getValue('site.render_server')
			);
		}

		return $this->m_iconsServer[1];
	}

	public function getRenderServer()
	{
		if (!$this->m_iconsServer)
		{
			$this->m_iconsServer = array(
				$this->c('Config')->getValue('site.icons_server'),
				$this->c('Config')->getValue('site.media_server'),
				$this->c('Config')->getValue('site.render_server')
			);
		}

		return $this->m_iconsServer[1];
	}

	/*** Some Events ***/

	public function onDataRequest(&$query)	{ return $this; }
	public function onDataReceive(&$data)	{ return $this; }
	public function onDataParsed(&$data)	{ return $this; }
	public function onBuildStart() 			{ return $this; }
	public function onBuildComplete()		{ return $this; }
	public function onUnitAvailable(&$unit) { return $this; }
}
?>
