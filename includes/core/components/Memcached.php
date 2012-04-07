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

class Memcached_Component extends Component
{
	private $m_isEnabled = false;
	private $m_isAvailable = false;
	private $m_memcached = null;
	private $m_memcachedConfigs = array();

	public function initialize()
	{
		$this->m_isEnabled = $this->c('Config')->getValue('cache.memcached.enabled');
		$this->m_memcachedConfigs = $this->c('Config')->getValue('cache.memcached.configs');

		if ($this->isMemcachedEnabled())
			$this->configureMemcached();

		return $this;
	}

	private function configureMemcached()
	{
		$this->m_memcached = new Memcache;

		$this->m_isAvailable = $this->getCache()->connect($this->getMemcachedServer(), $this->getMemcachedPort());

		return $this;
	}

	public function isMemcachedEnabled()
	{
		return $this->m_isEnabled;
	}

	public function isMemcachedAvailable()
	{
		return $this->m_isAvailable;
	}

	public function isAllowed()
	{
		return $this->isMemcachedEnabled() && $this->isMemcachedAvailable();
	}

	public function getCache()
	{
		return $this->m_memcached;
	}

	public function getMemcachedServer()
	{
		return isset($this->m_memcachedConfigs['server']) ? $this->m_memcachedConfigs['server'] : '';
	}

	public function getMemcachedPort()
	{
		return isset($this->m_memcachedConfigs['port']) ? $this->m_memcachedConfigs['port'] : '';
	}
}