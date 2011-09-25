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

class Creature_Component extends Component
{
	public function getZoneInfo(&$creature, $tryOthers = true)
	{
		if (!$creature)
			return false;

		if (isset($creature['map'], $creature['position_x']) && $creature['map'] && $creature['position_x'])
		{
			$zone = $this->c('QueryResult', 'Db')
				->model('WowZones')
				->addModel('WowAreas')
				->addModel('WowInstances')
				->join('left', 'WowAreas', 'WowZones', 'area', 'id')
				->join('left', 'WowInstances', 'WowZones', 'area', 'zone_id')
				->fields(array(
					'WowZones' => array('area'),
					'WowAreas' => array('name_' . $this->c('Locale')->GetLocale()),
					'WowInstances' => array('flags', 'zone_key')
				))
				->fieldCondition('wow_zones.map', ' = ' . $creature['map'])
				->fieldCondition('wow_zones.y_min', ' > ' . $creature['position_y'])
				->fieldCondition('wow_zones.y_max', ' < ' . $creature['position_y'])
				->fieldCondition('wow_zones.x_min', ' > ' . $creature['position_x'])
				->fieldCondition('wow_zones.x_max', ' < ' . $creature['position_x'])
				->loadItem();

			if (!$zone && $tryOthers)
			{
				// Try to check instances
				$add = $this->c('QueryResult', 'Db')
					->model('WowAreas')
					->fields(array('WowAreas' => array('id', 'mapID', 'zoneID', 'name_en')))
					->fieldCondition('mapID', ' = ' . $creature['map'])
					->loadItems();

				if (sizeof($add) == 1)
				{
					// Instance?
					$instance_info = $this->c('QueryResult', 'Db')
						->model('WowInstances')
						->fields(array('WowInstances' => array('zone_id', 'flags', 'zone_key', 'name_' . $this->c('Locale')->GetLocale())))
						->fieldCondition('zone_id', ' = ' . $add[0]['id'])
						->loadItem();

					unset($add);

					if ($instance_info)
					{
						$instance_info['area'] = $instance_info['zone_id'];
						return $instance_info;
					}
				}

				unset($add);

				return false;
			}

			return $zone;
		}
		elseif (isset($creature['name'], $creature['rank']) && $creature['name'] && $creature['rank'] = 3 && $tryOthers)
		{
			// TODO: This requires table 'wow_instance_bosses' to be filled.
			$boss_info = $this->c('QueryResult', 'Db')
				->model('WowInstanceBosses')
				->addModel('WowInstances')
				->join('left', 'WowInstances', 'WowInstanceBosses', 'instance_id', 'zone_id')
				->fields(array(
					'WowInstanceBosses' => array('boss_id', 'instance_id'),
					'WowInstances' => array('zone_key', 'zone_id', 'flags')
				))
				->fieldCondition('wow_instance_bosses.bossName_' . $this->c('Locale')->GetLocale(), ' = \'' . $creature['name'] . '\'')
				->loadItem();

			if ($boss_info)
			{
				$boss_info['area'] = $boss_info['zone_id'];
				return $boss_info;
			}
		}
	}

	public function getCreatureFields()
	{
		$type = $this->c('Config')->getValue('realms.1.type');

		if ($type == SERVER_MANGOS || $type == 'SERVER_MANGOS')
			$fields = array(
				'CreatureLootTemplate' => array('entry', 'item', 'ChanceOrQuestChance', 'groupid', 'mincountOrRef', 'maxcount', 'lootcondition', 'condition_value1', 'condition_value2'),
				'CreatureTemplate' => array('entry', 'name', 'subname', 'difficulty_entry_1', 'difficulty_entry_2', 'difficulty_entry_3', 'KillCredit1', 'KillCredit2', 'minlevel', 'maxlevel', 'type', 'rank'),
				'Creature' => array('guid', 'id', 'map', 'position_x', 'position_y', 'position_z')
			);
		else
			$fields = array(
				'CreatureLootTemplate' => array('entry', 'item', 'ChanceOrQuestChance', 'groupid', 'mincountOrRef', 'maxcount', 'lootmode'),
				'CreatureTemplate' => array('entry', 'name', 'subname', 'difficulty_entry_1', 'difficulty_entry_2', 'difficulty_entry_3', 'KillCredit1', 'KillCredit2', 'minlevel', 'maxlevel', 'type', 'rank'),
				'Creature' => array('guid', 'id', 'map', 'position_x', 'position_y', 'position_z')
			);

		if ($this->c('Locale')->GetLocaleID() != LOCALE_EN)
			$fields['LocalesCreature'] = array('name_loc' . $this->c('Locale')->GetLocaleID(), 'subname_loc' . $this->c('Locale')->GetLocaleID());

		return $fields;
	}

	public function getOriginalCreaturesInfo(&$creatures)
	{
		$lId = $this->c('Locale')->GetLocaleID();
		$lName = $this->c('Locale')->GetLocale();

		$fields = $this->getCreatureFields();

		if ($creatures)
		{
			$propIds = array();

			foreach ($creatures as &$cr)
				$propIds[$cr['entry']] = 'entry';

			$new_creatures = array();
			if ($propIds)
			{
				$q = $this->c('QueryResult', 'Db')
					->model('CreatureTemplate')
					->addModel('Creature')
					->join('left', 'Creature', 'CreatureTemplate', 'entry', 'id');

				if ($lId != LOCALE_EN)
					$q->addModel('LocalesCreature')
						->join('left', 'LocalesCreature', 'CreatureTemplate', 'entry', 'entry')
						->fields(array(
							'CreatureTemplate' => $fields['CreatureTemplate'],
							'Creature' => $fields['Creature'],
							'LocalesCreature' => $fields['LocalesCreature']
						));
				else
					$q->fields(array(
						'CreatureTemplate' => $fields['CreatureTemplate'],
						'Creature' => $fields['Creature'],
					));

				$propCreatures = $q
					->fieldCondition('difficulty_entry_1', array_keys($propIds), 'OR')
					->fieldCondition('difficulty_entry_2', array_keys($propIds), 'OR')
					->fieldCondition('difficulty_entry_3', array_keys($propIds), 'OR')
					->keyIndex('entry')
					->loadItems();

				if ($propCreatures)
				{
					foreach ($propCreatures as $creature)
					{
						$kcEntry = 0;
						$difficulty = 0;
						for ($i = 1; $i < 4; ++$i)
						{
							if (isset($creatures[$creature['difficulty_entry_' . $i]]))
							{
								$kcEntry = $creature['difficulty_entry_' . $i];
								$difficulty = $i;
							}
						}

						if ($kcEntry > 0)
						{
							$tables = array('CreatureTemplate', 'Creature');
							foreach ($tables as $tbl)
							{
								$creatures[$kcEntry]['loot_entry'] = $kcEntry;
								foreach ($fields[$tbl] as $field)
									$creatures[$kcEntry][$field] = $creature[$field];
							}

							$creatures[$kcEntry]['isHeroic'] = true;
							$creatures[$kcEntry]['difficulty'] = $difficulty;
							$new_creatures[$creature['entry']] = $creatures[$kcEntry];
						}
					}
					$creatures = $new_creatures;
				}
			}

			// Zone info
			foreach ($creatures as &$creature)
				$creature['zone_info'] = $this->c('Creature')->getZoneInfo($creature);

			unset($new_creatures, $creature, $propCreatures, $q);
		}
	}
}
?>