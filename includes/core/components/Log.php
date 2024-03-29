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

class Log_Component extends Component
{
	/**
	 * Log filename
	 * @access private
	 * @var    string
	 **/
	private $m_logFile = '';

	/**
	 * Log level
	 * @access private
	 * @var    int
	 **/
	private $m_logLevel = 1;

	/**
	 * Is logging enabled?
	 * @access private
	 * @var    bool
	 **/
	private $m_isEnabled = true;

	public function initialize()
	{
		$this->m_isEnabled = $this->c('Config')->getValue('site.log.enabled');

		if (!$this->m_isEnabled && !isset($_GET['coreDebug']))
			return $this;
		elseif (isset($_GET['coreDebug']) && $_GET['coreDebug'] == true)
			$this->m_isEnabled = true;

		$this->m_logFile = WEBROOT_DIR . '_debug' . DS . 'tmp.dbg';

		$this->m_logLevel = $this->c('Config')->getValue('site.log.level');

		return $this;
	}

	/**
	 * Adds some lines to debug message
	 * @access public
	 * @param  array $args
	 * @param  string $type
	 * @return void
	 **/
	private function addLines($args, $type)
	{
		if (!$this->m_isEnabled)
			return;

		$log = $this->applyStyle($type);
		$text = call_user_func_array('sprintf', $args);
		$log .= $text . '<br />' . NL;
		$this->writeData($log);
	}

	/**
	 * Writes error message to log file (if allowed)
	 * @access public
	 * @param  string $message,...
	 * @return void
	 **/
	public function writeError($message)
	{
		if (!$this->m_isEnabled)
			return;
		
		$this->addLines(func_get_args(), 'error');
	}

	/**
	 * Writes debug message to log file (if allowed)
	 * @access public
	 * @param  string $message,...
	 * @return void
	 **/
	public function writeDebug($message)
	{
		if (!$this->m_isEnabled || $this->m_logLevel < 2)
			return;
		
		$this->addLines(func_get_args(), 'debug');
	}

	/**
	 * Writes sql log message to log file (if allowed)
	 * @access public
	 * @param  string $message,...
	 * @return void
	 **/
	public function writeSql($message)
	{
		if (!$this->m_isEnabled || $this->m_logLevel < 3)
			return;
		
		$this->addLines(func_get_args(), 'sql');
	}

	/**
	 * Applies HTML style to log message
	 * @access public
	 * @param  string $type
	 * @return string
	 **/	
	private function applyStyle($type)
	{
		if (!$this->m_isEnabled)
			return;

		switch ($type)
		{
			case 'error':
				return '<strong>ERROR</strong> [' . date('d-m-Y H:i:s') . ']: ';
			case 'debug':
				return '<strong>DEBUG</strong> [' . date('d-m-Y H:i:s') . ']: ';
			case 'sql':
				return '<strong>SQL</strong> [' . date('d-m-Y H:i:s') . ']: ';
			default:
				return '';
		}
	}

	/**
	 * Writes new log message to log file
	 * @access private
	 * @param  string $data
	 * @return void
	 **/
	private function writeData($data)
	{
		if (!$this->m_isEnabled)
			return;

		file_put_contents($this->m_logFile, $data, FILE_APPEND);
	}
}
?>