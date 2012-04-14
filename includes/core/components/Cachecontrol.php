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

class CacheControl_Component extends Component
{
	private $m_noCachingModels = array();

	public function initialize()
	{
		$types = array('memcached');

		foreach ($types as $t)
			$this->m_noCachingModels[$t] = $this->c('Config')->getValue('cache.' . $t . '.nocache');

		return $this;
	}

	public function isCachingAllowed($model, $type = 'memcached')
	{
		if (!$type || !isset($this->m_noCachingModels[$type]))
			return true;

		if (is_string($model))
		{
			if (!isset($this->m_noCachingModels[$type][$model]))
				return true;
		}
		elseif (is_object($model))
		{
			if (!isset($this->m_noCachingModels[$type][$model->m_model]))
				return true;
		}

		return false;
	}

	/**
	 * Disable cache for model(s)
	 * @param mixed $model
	 * @param string $type = 'memcached'
	 * @param bool $updateConfig = false
	 * @example $this->c('CacheControl')->disableCacheFor('ItemTemplate', 'memcached');
	 * @example $this->c('CacheControl')->disableCacheFor($this->c('ItemTemplate', 'Model'), 'memcached');
	 * @example $this->c('CacheControl')->disableCacheFor(array('ItemTemplate', $this->c('CreatureTemplate', 'Model')), 'memcached');
	 **/
	public function disableCacheFor($model, $type = 'memcached', $updateConfig = false)
	{
		if (!$type || !isset($this->m_noCachingModels[$type]))
			return $this;

		if (is_string($model))
			$this->m_noCachingModels[$type][$model] = true;
		elseif (is_object($model))
			$this->m_noCachingModels[$type][$model->m_model] = true;
		elseif (is_array($model))
		{
			foreach ($model as $m)
				if (is_string($m))
					$this->m_noCachingModels[$type][$m] = true;
				elseif (is_object($m))
					$this->m_noCachingModels[$type][$m->m_model] = true;
		}

		if ($updateConfig)
		{
			$this->c('Config')->setValue('cache.' . $type . '.nocache', $this->m_noCachingModels[$type]);
			$this->c('Config')->updateConfigFile();
		}

		return $this;
	}
}
?>