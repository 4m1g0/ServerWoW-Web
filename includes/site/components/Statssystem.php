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

class StatsSystem_Component extends Component
{
	protected $m_stats = array();
	protected $m_items = array();
	protected $m_talents = array();
	protected $m_skills = array();
	protected $m_spells = array();
	protected $m_basicStats = array();

	public function initStats(&$items, &$talents, &$skills, &$spells)
	{
		$this->m_stats = array();
		$this->m_talents = &$talents;
		$this->m_skills = &$skills;
		$this->m_spells = &$spells;
		$this->m_items = $items;

		$this->loadClassLevelStats()
			->handleItems();
	}

	protected function appendStats($stat, $value, $type = 'primary', $overWrite = false)
	{
		if (!isset($this->m_stats[$type]))
			$this->m_stats[$type] = array();

		if (!isset($this->m_stats[$type][$stat]))
			$this->m_stats[$type][$stat] = 0;

		if ($overWrite)
			$this->m_stats[$type][$stat] = $value;
		else
			$this->m_stats[$type][$stat] += $value;

		return $this;
	}

	protected function setStat($stat, $value, $type = 'primary')
	{
		return $this->appendStats($stat, $value, $type, true);
	}

	protected function getStat($stat, $type = 'primary')
	{
		return isset($this->m_stats[$type][$stat]) ? $this->m_stats[$type][$stat] : 0;
	}

	protected function loadClassLevelStats()
	{
		$this->m_basicStats = array(
			'classLevelStats' => $this->c('QueryResult', 'Db')
				->model('PlayerClassLevelstats')
				->fieldCondition('class', ' = ' . $this->c('CharacterProfile')->getClass())
				->fieldCondition('level', ' = ' . $this->c('CharacterProfile')->getLevel())
				->loadItem(),
			'levelStats' => $this->c('QueryResult', 'Db')
				->model('PlayerLevelstats')
				->fieldCondition('race', ' = ' . $this->c('CharacterProfile')->getRace())
				->fieldCondition('class', ' = ' . $this->c('CharacterProfile')->getClass())
				->fieldCondition('level', ' = ' . $this->c('CharacterProfile')->getLevel())
				->loadItem()
		);

		$this->appendStats('basehp', $this->m_basicStats['classLevelStats']['basehp'])
			->appendStats('basemana', $this->m_basicStats['classLevelStats']['basemana'])
			->appendStats('strength', $this->m_basicStats['levelStats']['str'])
			->appendStats('agility', $this->m_basicStats['levelStats']['agi'])
			->appendStats('stamina', $this->m_basicStats['levelStats']['sta'])
			->appendStats('intellect', $this->m_basicStats['levelStats']['inte'])
			->appendStats('spirit', $this->m_basicStats['levelStats']['spi']);

		return $this;
	}

	protected function handleStrength($val)
	{
		return $this->appendStats('strength', $val);
	}

	protected function handleAgility($val)
	{
		return $this->appendStats('strength', $val);
	}

	protected function handleStamina($val)
	{
		return $this->appendStats('stamina', $val)->updateMaxHealth();
	}

	protected function handleIntellect($val)
	{
		return $this->appendStats('intellect', $val)->updateMaxPower(POWER_MANA);
	}

	protected function handleSpirit($val)
	{
		return $this;
	}

	protected function handleItems()
	{
		if (!$this->m_items)
			return $this;

		foreach ($this->m_items as &$item)
		{
			if (!isset($item['ItemLevel']))
				continue; // Wrong item handler

			for ($i = 1; $i < 11; ++$i)
			{
				switch ($item['stat_type' . $i])
				{
					case ITEM_MOD_MANA:
						$this->appendStats('mana', $item['stat_value' . $i]);
						break;
					case ITEM_MOD_HEALTH:
						$this->appendStats('health', $item['stat_value' . $i]);
						break;
					case ITEM_MOD_AGILITY:
						$this->handleAgility($item['stat_value' . $i]);
						break;
					case ITEM_MOD_STRENGTH:
						$this->handleStrength($item['stat_value' . $i]);
						break;
					case ITEM_MOD_INTELLECT:
						$this->handleIntellect($item['stat_value' . $i]);
						break;
					case ITEM_MOD_SPIRIT:
						$this->handleSpirit($item['stat_value' . $i]);
						break;
					case ITEM_MOD_STAMINA:
						$this->handleStamina($item['stat_value' . $i]);
						break;
				}
			}
		}

		return $this;
	}

	protected function updateMaxHealth()
	{
		$base = $this->m_basicStats['classLevelStats']['basehp'];
		$more = $this->getHealthBonusFromStamina();

		return $this->setStat('health', ($base + $more));
	}

	protected function updateMaxPower($power)
	{
		switch ($power)
		{
			case POWER_MANA:
				$create_power = $this->m_basicStats['classLevelStats']['basemana'];
				break;
			case POWER_ENERGY:
			case POWER_RAGE:
			case POWER_RUNIC_POWER:
				$create_power = 100;
				break;
			default:
				return $this;
		}

		$bonus_power = ($power == POWER_MANA && $create_power) ? $this->getManaBonusFromIntellect() : 0;
		
		return $this->appendStats($power, $bonus_power + $create_power, 'powers');
	}

	protected function getHealthBonusFromStamina()
	{
		$stamina = $this->getStat('stamina');
		$baseStam = $stamina < 20 ? $stamina : 20;
		$moreStam = $stamina - $baseStam;

		return $baseStam + ($moreStam * 10);
	}

	protected function getManaBonusFromIntellect()
	{
		$intellect = $this->getStat('intellect');
		$baseInt = $intellect < 20 ? $intellect : 20;
		$moreInt = $intellect - $baseInt;

		return $baseInt + ($moreInt * 15);
	}
}
?>