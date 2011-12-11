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

class Item_Component extends Component
{
	const ITEMS_PER_PAGE = 20;
	protected $m_entry = 0;
	protected $m_item = array();
	protected $m_classInfo = array();
	protected $m_tooltipData = array();
	protected $m_isCorrect = false;
	protected $m_isTooltip = false;
	protected $m_tooltip = '';
	protected $m_ssd = array();
	protected $m_ssv = array();
	protected $m_gems = array();
	protected $m_items = array();
	protected $m_itemsCount = array();
	protected $m_itemsClassInfo = array();
	protected $m_itemTab = '';
	protected $m_storeInfo = array();

	public function initItem($entry, $isTooltip, $tab)
	{
		$this->m_entry = (int) $entry;
		$this->m_isTooltip = $isTooltip;
		$this->m_itemTab = $tab;

		$tooltip_keys = array(
			'i', 'e', 'g0', 'g1', 'g2', 'set', 'pl', 'r', 'slot', 'cd'
		);

		foreach ($tooltip_keys as $key)
		{
			if (isset($_GET[$key]) && $_GET[$key])
			{
				if ($key == 'set')
					$this->m_tooltipData[$key] = explode(',', $_GET[$key]);
				else
					$this->m_tooltipData[$key] = $_GET[$key];

				if (in_array($key, array('g0', 'g1', 'g2')))
					$this->m_gems[] = $_GET[$key];
			}
		}

		if (!isset($this->m_tooltipData['set']))
			$this->m_tooltipData['set'] = array();

		$this->loadItem()
			->handleItem()
			->loadStoreInfo();

		return $this;
	}

	protected function loadItem()
	{
		if (!$this->m_entry || $this->m_item)
			return $this;

		$query = $this->c('QueryResult', 'Db')
			->model('ItemTemplate');

		if ($this->c('Locale')->getLocaleId() != LOCALE_EN)
			$query->addModel('LocalesItem')
			->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry');
		
		$this->m_item = $query->setItemId($this->m_entry)
			->loadItem();

		if (!$this->m_item)
		{
			$this->c('Item_WoW', 'Controller')->setErrorPage();
			$this->c('Error_WoW', 'Controller');
			return $this;
		}
	
		unset($query);

		$icon = $this->c('QueryResult', 'Db')
			->model('WowIcons')
			->fields(array('WowIcons' => array('icon')))
			->fieldCondition('displayid', ' = ' . $this->m_item['displayid'])
			->loadItem();

		if ($icon)
			$this->m_item['icon'] = $icon['icon'];

		unset($icon);

		$this->m_classInfo = $this->c('QueryResult', 'Db')
			->model('WowItemsubclass')
			->fieldCondition('class', ' = ' . $this->m_item['class'])
			->fieldCondition('subclass', ' = ' . $this->m_item['subclass'])
			->loadItem();

		if ($this->m_item['ScalingStatDistribution'] > 0)
		{
			$this->m_ssd = $this->c('QueryResult', 'Db')
				->model('WowSsd')
				->fieldCondition('entry', ' = ' . $this->m_item['ScalingStatDistribution'])
				->loadItem();

			if (!isset($this->m_tooltipData['pl']))
				$ssv_level = MAX_PLAYER_LEVEL;
			else
				$ssv_level = $this->m_tooltipData['pl'];

			$this->m_ssv = $this->c('QueryResult', 'Db')
				->model('WowSsv')
				->fieldCondition('level', ' = ' . $ssv_level)
				->loadItem();
		}

		if ($this->m_item['socketBonus'] > 0)
			$this->m_gems[] = $this->m_item['socketBonus'];

		if ($this->m_gems)
		{
			$this->m_gems = $this->c('QueryResult')
				->model('WowEnchantment')
				->fieldCondition('id', $this->m_gems)
				->keyIndex('id')
				->loadItems();
		}

		$this->m_item['Flags2'] = $this->m_item['FlagsExtra'];

		$this->m_isCorrect = true;

		return $this;
	}

	public function isCorrect()
	{
		return $this->m_isCorrect;
	}

	public function getClassInfo($type)
	{
		return isset($this->m_classInfo[$type]) ? $this->m_classInfo[$type] : false;
	}

	protected function handleItem()
	{
		if (!$this->m_item)
			return $this;

		if (!$this->m_isTooltip && !$this->m_itemTab)
			$this->getExtendedCostInfo();

		if ($this->m_itemTab)
			return $this;

		return $this->createTooltip();
	}

	public function item($info)
	{
		return isset($this->m_item[$info]) ? $this->m_item[$info] : false;
	}

	protected function createTooltip()
	{
		if (!$this->m_item)
			return $this;

		$t = ''; // tooltip buffer

		$icons_server = $this->c('Config')->getValue('site.icons_server');

		if (!$this->m_isTooltip)
		{
			$t .= '<div class="info"><div class="title"><h2 class="color-q' . $this->item('Quality') . '">' . $this->item('name') . '</h2></div><div class="item-detail"><span class="icon-frame frame-56 " style=\'background-image: url("' . $this->c('Config')->getValue('site.icons_server') . '/56/' . $this->item('icon') . '.jpg");\'>';
			
			if ($this->item('stackable') > 1)
				$t .= '<span class="stack">' . $this->item('stackable') . '</span>';

			$t .= '</span>';
		}
		else
			$t .= '<div class="wiki-tooltip"><span  class="icon-frame frame-56 " style=\'background-image: url("' . $icons_server . '/56/' . $this->item('icon') . '.jpg");\'></span><h3 class="color-q' . $this->item('Quality') . '">' . $this->item('name') . '</h3>';

		$t .= '<ul class="item-specs" style="margin: 0">';
		
		$l = $this->c('Locale');

		if ($this->item('map') > 0)
		{
			$map = $this->c('QueryResult', 'Db')
				->model('WowMaps')
				->fields(array('WowMaps' => array('name')))
				->setItemId($this->item('map'))
				->loadItem();

			if ($map)
				$t .= '<li>' . $map['name'] . '</li>';

			unset($map);
		}
		
		if ($this->item('Flags') & ITEM_FLAGS_HEROIC)
			$t .= '<li class="color-tooltip-green">' . $l->getString('template_item_heroic') . '</li>';

		if ($this->item('Flags') & ITEM_FLAGS_CONJURED)
			$t .= '<li>' . $l->getString('template_item_conjured') . '</li>';

		if ($this->item('bonding') > 0 && $this->item('bonding') < 4)
			$t .= '<li>' . $l->getString('template_item_bonding_' . $this->item('bonding')) . '</li>';

		if ($this->item('maxcount') == 1)
			$t .= '<li>' . $l->getString('template_item_unique') . '</li>';

		if (in_array($this->item('class'), array(ITEM_CLASS_ARMOR, ITEM_CLASS_WEAPON)))
			$t .= '<li><span class="float-right">' . $this->m_classInfo['subclass_name'] . '</span>' . $l->getString('template_item_invtype_' . $this->item('InventoryType')) . '</li>';
		elseif ($this->item('class') == ITEM_CLASS_CONTAINER)
			$t .= '<li>' . $l->format('template_item_container', $this->item('ContainerSlots')) . '</li>';

		if ($this->item('class') == ITEM_CLASS_WEAPON)
		{
			$minDmg = $this->item('dmg_min1');
			$maxDmg = $this->item('dmg_max1');
			$dps = 0;
			if ($this->m_ssv)
			{
				$extraDps = $this->GetDPSMod($this->m_ssv, $this->item('ScalingStatValue'));
				if ($extraDps)
				{
					$average = $extraDps * $this->item('delay') / 1000;
					$minDmg = 0.7 * $average;
					$maxDmg = 1.3 * $average;
					$dps = round(($maxDmg + $minDmg) / (2 * ($this->item('delay') / 1000)));
				}
			}

			for ($i = 1; $i < 3; ++$i)
			{
				$d_min  = $this->item('dmg_min' . $i);
				$d_max  = $this->item('dmg_max' . $i);
				if (($d_max > 0) && ($this->item('class') != ITEM_CLASS_PROJECTILE))
				{
				    $delay = $this->item('delay') / 1000;
				    if ($delay > 0)
				        $dps += round(($d_max + $d_min) / (2 * $delay), 1);

				    if ($i > 1)
				        $delay = 0;
				}
			}
			$t .= '<li><span class="float-right">' . $l->format('template_item_weapon_delay', ($this->item('delay') / 1000));
			$t .= '</span>' . $l->format('template_item_weapon_damage', $minDmg, $maxDmg);
			$t .= '</li><li>' . $l->format('template_item_weapon_dps', $dps) . '</li>';
		}

		if ($this->item('class') == ITEM_CLASS_PROJECTILE && $this->item('dmg_min1') > 0 && $this->item('dmg_max1') > 0)
			$t .= '<li>' . $l->format('template_item_projectile_dps', ($this->item('dmg_min1') + $this->item('dmg_max1') / 2));

		if ($this->item('class') == ITEM_CLASS_GEM && $this->item('GemProperties') > 0)
		{
			$gem = $this->c('QueryResult', 'Db')
				->model('WowEnchantment')
				->addModel('WowGemproperties')
				->join('left', 'WowGemproperties', 'WowEnchantment', 'id', 'spellitemenchantement')
				->fieldCondition('wow_gemproperties.id', ' = ' . $this->item('GemProperties'))
				->loadItem();

			if ($gem)
				$t .= '<li>' . $gem['text'] . '</li>';

			unset($gem);
		}

		if ($this->item('block') > 0)
			$t .= '<li>' . $l->format('template_item_block', $this->item('block')) . '</li>';

		$resistances = array('fire', 'nature', 'frost', 'shadow', 'arcane');
		foreach ($resistances as $resist)
			if ($this->item($resist . '_res') > 0)
				$t .= '<li>' . $l->format('template_item_' . $resist . '_res', $this->item($resist . '_res')) . '</li>';

		$armor = $this->item('armor');
		if ($this->m_ssv && $this->item('ScalingStatValue') > 0)
			if ($ssvarmor = $this->GetArmorMod($this->m_ssv, $this->item('ScalingStatValue')))
				$armor = $ssvarmor;

		if ($armor > 0)
			$t .= '<li>' . $l->format('template_item_armor', $armor) . '</li>';

		$green_stats = '';
		for ($i = 1; $i < MAX_ITEM_PROTO_STATS+1; ++$i)
		{
			if (!isset($this->m_item['stat_type' . $i]) || $this->m_item['stat_type' . $i] < 3)
				continue;

			if ($this->m_item['stat_type' . $i] >= 3 & $this->m_item['stat_type' . $i] <= 8)
				$t .= '<li id="stat-' . $this->m_item['stat_type' . $i] . '">+' . $l->format('template_item_stat_' . $this->m_item['stat_type' . $i], $this->m_item['stat_value' . $i]) . '</li>';
			else
				$green_stats .= '<li id=' . $this->m_item['stat_type' . $i] . ' class="color-tooltip-green">' . $l->format('template_item_stat_' . $this->m_item['stat_type' . $i], $this->m_item['stat_value' . $i]) . '</li>';
		}

		if (isset($this->m_tooltipData['e']) && $this->m_tooltipData['e'])
		{
			$ench = $this->c('QueryResult', 'Db')
				->model('WowEnchantment')
				->fields(array('WowEnchantment' => array('text_' . $l->GetLocale())))
				->setItemId($this->m_tooltipData['e'])
				->loadItem();
			if ($ench)
				$t .= '<li class="color-tooltip-green">' . $ench['text'] . '</li>';

			unset($ench);
		}

		$socketsText = '';
		$socketBonusEnabled = array();

		for ($i = 1; $i < 4; ++$i)
		{
			if ($this->item('socketColor_' . $i) == 0 && !isset($this->m_tooltipData['g' . ($i - 1)]))
				continue;

			$socketsText .= '<li' . (isset($this->m_tooltipData['g' . ($i - 1)]) ? '>' : ' class="color-d4">');
			$socketsText .= '<span class="icon-socket socket-' . $this->item('socketColor_' . $i) . '">';
			if (isset($this->m_tooltipData['g' . ($i - 1)]) && isset($this->m_gems[$this->m_tooltipData['g' . ($i - 1)]]))
			{
				$gem = $this->m_gems[$this->m_tooltipData['g' . ($i - 1)]];
				$socketsText .= '<a href="' . $this->getWowUrl('item/' . $gem['gem']) . '" class="gem">';
				$socketsText .= '<img src="' . $icons_server . '/18/' . $gem['gemicon'] . '.jpg" alt="" />';
				$socketsText .= '<span class="frame"></span></a></span>' . $gem['text'];

				if ($this->IsGemMatchesSocketColor($gem['gemcolor'], $this->item('socketColor_' . $i)))
					$socketBonusEnabled[] = true;
				else
					$socketBonusEnabled[] = false;
			}
			else
				$socketsText .= '<span class="empty"></span> <span class="frame"></span> </span>' . $l->getString('template_item_socket_' . $this->item('socketColor_' . $i));

			$socketsText .= '</li>';
		}
		$t .= $socketsText;

		if ($this->item('socketBonus') > 0 && isset($this->m_gems[$this->item('socketBonus')]))
		{
			$bEnabled = true;
			if ($socketBonusEnabled)
			{
				foreach ($socketBonusEnabled as $sb)
					if (!$sb) $bEnabled = false;
			}
			else
				$bEnabled = false;

			$t .= '<li class="' . (!$bEnabled ? 'color-d4' : '') . '">' . $l->format('template_item_socket_match', $this->m_gems[$this->item('socketBonus')]['text']) . '</li>';
		}

		if ($this->item('MaxDurability') > 0)
		{
			if (isset($this->m_tooltipData['cd']))
				$currentDur = (int) $this->m_tooltipData['cd'];
			else
				$currentDur = $this->item('MaxDurability');

			$t .= '<li>' . $l->format('template_item_durability', $currentDur, $this->item('MaxDurability')) . '</li>';
		}

		if ($this->item('AllowableClass') > 0)
		{
			$classes_data = $this->AllowableClasses($this->item('AllowableClass'));
			if (is_array($classes_data))
			{
				$t .= '<li>' . $l->getString('template_item_allowable_classes') . ' ';
				$i = 0;
				foreach ($classes_data as $classId => &$class)
				{
					if ($i > 0)
						$t .= ', ';
					$t .= ' <a href="' . $this->getWowUrl('game/class/' . $class['key']) . '" class="color-c' . $classId . '">' . $l->getString('character_class_' . $classId, GENDER_MALE) . '</a>';
					++$i;
				}
				$t .= '</li>';
			}
		}

		if ($this->item('AllowableRace') > 0)
		{
			$races_data = $this->AllowableRaces($this->item('AllowableRace'));
			if (is_array($races_data))
			{
				$t .= '<li>' . $l->getString('template_item_allowable_races') . ' ';
				$i = 0;
				foreach ($races_data as $raceId => &$race)
				{
					if ($i > 0)
						$t .= ', ';
					$t .= '<a href="' . $this->getWowUrl('game/race/' . $race['key']) . '">' . $l->getString('character_race_' . $raceId, GENDER_MALE) . '</a>';
					++$i;
				}
				$t .= '</li>';
			}
		}

		if ($this->item('RequiredLevel') > 0)
			$t .= '<li>' . $l->format('template_item_required_level', $this->item('RequiredLevel')) . '</li>';

		if ($this->item('RequiredSkill') > 0 && $this->item('RequiredSkillRank') > 0)
		{
			$skill_ranks = array(
				75 => 1,
				150 => 2,
				225 => 3,
				300 => 4,
				375 => 5,
				450 => 6,
				525 => 7
			);

			$skill = $this->c('QueryResult', 'Db')
				->model('WowSkills')
				->setItemId($this->item('RequiredSkill'))
				->loadItem();

			if ($this->item('RequiredSkill') == SKILL_RIDING)
			{
				
				$line_ability = $this->c('QueryResult', 'Db')
					->model('WowSkillLineAbility')
					->fieldCondition('skillId', ' = ' . $this->item('RequiredSkill'))
					->keyIndex('spellId')
					->order(array('WowSkillLineAbility' => array('spellId')), 'DESC')
					->fieldCondition('spellId', ' <> 54197')
					->loadItems();

				if ($line_ability)
				{
					$findId = 0;
					$source = $line_ability; // save
					foreach ($line_ability as $id => &$spell)
					{
						if ($spell['forward_spellid'] == 0)
						{
							$findId = $spell['spellId'];
							unset($spell);
							break;
						}
					}
					$new = array();
					if ($findId > 0)
					{
						$new[] = $findId;
						unset($line_ability[$id]);
						$size = sizeof($line_ability);
						$i = 0;
						while ($i < $size)
						{
							foreach ($line_ability as &$spell)
							{
								if ($spell['forward_spellid'] == $findId)
								{
									$findId = $spell['spellId'];
									$new[] = $findId;
									++$i;
									break;
								}
							}
						}
					}
					if ($new)
					{
						krsort($new);
						sort($new);
						if (isset($new[$skill_ranks[$this->item('RequiredSkillRank')]-1]))
						{
							$skillSpellId = (int) $new[$skill_ranks[$this->item('RequiredSkillRank')]-1];
							$skillSpell = $this->c('QueryResult', 'Db')
								->model('WowSpell')
								->fields(array('WowSpell' => array('SpellName_' . $this->c('Locale')->getLocale())))
								->setItemId($skillSpellId)
								->loadItem();
						}
					}
					if (isset($skillSpell) && $skillSpell)
					{
						$t .= '<li><span class="tip" data-spell="' . $skillSpellId . '">' . $l->format('template_item_required_spell', $skillSpell['SpellName']) . '</li>';
						unset($skillSpell, $skillSpellId, $new);
					}
		
					unset($skill, $line_ability, $source);
				}
			}
			else
				$t .= '<li>' . $l->format('template_item_required_skill', $skill['name'], $this->item('RequiredSkillRank')) . '</li>';
		}

		if ($this->item('requiredspell') > 0)
		{
			$spell = $this->c('QueryResult', 'Db')
				->model('WowSpell')
				->fields(array('WowSpell' => array('SpellName')))
				->setItemId($this->item('requiredspell'))
				->loadItem();

			if ($spell)
				$t .= '<li>' . $l->format('template_item_required_spell', $spell['SpellName']) . '</li>';

			unset($spell);
		}

		if ($this->item('RequiredReputationFaction') > 0 && $this->item('RequiredReputationRank') > 0)
		{
			$rep_faction = $this->c('QueryResult', 'Db')
				->model('WowFaction')
				->fields(array('WowFaction' => array('name_es')))
				->setItemId($this->item('RequiredReputationFaction'))
				->loadItem();

			if ($rep_faction)
				$t .= '<li>' . $l->format('template_item_required_reputation', $rep_faction['name'], $l->getString('reputation_rank_' . $this->item('RequiredSkillRank'))) . '</li>';

			unset($rep_faction);
		}

		if ($this->item('ItemLevel') > 0)
			$t .= '<li>' . $l->format('template_item_itemlevel', $this->item('ItemLevel')) . '</li>';

		$t .= $green_stats;
		unset($green_stats);

		if ($this->item('Description'))
			$t .= '<li class="color-tooltip-yellow">' . $this->item('Description') . '</li>';

		if ($this->item('itemset') > 0)
		{
			$itemset_pieces = array();
			$pieces_count = 5;

			$itemset = $this->c('QueryResult', 'Db')
				->model('WowItemsetdata')
				->addModel('WowItemsetinfo')
				->join('left', 'WowItemsetinfo', 'WowItemsetdata', 'original', 'id')
				->fields(
					array(
						'WowItemsetdata' => array('item1', 'item2', 'item3', 'item4', 'item5'),
						'WowItemsetinfo' => array('name_' . $l->GetLocale(), 'bonus1', 'bonus2', 'bonus3', 'bonus4', 'bonus5', 'bonus6', 'bonus7', 'bonus8', 'threshold1', 'threshold2', 'threshold3', 'threshold4', 'threshold5', 'threshold6', 'threshold7', 'threshold8')
					)
				)
				->fieldCondition('wow_itemsetdata.item1', ' = ' . $this->item('entry'), 'OR')
				->fieldCondition('wow_itemsetdata.item2', ' = ' . $this->item('entry'), 'OR')
				->fieldCondition('wow_itemsetdata.item3', ' = ' . $this->item('entry'), 'OR')
				->fieldCondition('wow_itemsetdata.item4', ' = ' . $this->item('entry'), 'OR')
				->fieldCondition('wow_itemsetdata.item5', ' = ' . $this->item('entry'), 'OR')
				->loadItem();
			if ($itemset)
			{
				$pieces_count = 5; // Overall items
				$currentActive = false;
				for ($i = 1; $i < 6; ++$i)
				{
					if (!isset($itemset['item' . $i]))
						continue;

					$itemset_pieces[] = $itemset['item' . $i];
				}
			}
			else
			{
				$itemset = $this->c('QueryResult', 'Db')
					->model('WowItemsetinfo')
					->fieldCondition('id', ' = ', intval($this->item('itemset')))
					->loadItem();
				
				if ($itemset)
				{
					for ($i = 1; $i < 18; ++$i)
					{
						if (!isset($itemset['item' . $i]))
							continue;

						if ($itemset['item' . $i] > 0)
							$itemset_pieces[] = $itemset['item' . $i];
					}
				}
			}

			if ($itemset_pieces && $itemset)
			{
				$q = $this->c('QueryResult', 'Db')
					->model('ItemTemplate')
					->addModel('LocalesItem')
					->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry')
					->fieldCondition('item_template.entry', $itemset_pieces)
					->keyIndex('entry');

				if ($l->GetLocaleID() != LOCALE_EN)
					$q->fields(array('ItemTemplate' => array('entry', 'name', 'Quality'), 'LocalesItem' => array('name_loc' . $l->GetLocaleID())));
				else
					$q->fields(array('ItemTemplate' => array('entry', 'name', 'Quality')));

				$itemset_items =$q->loadItems();
				unset($q);

				if ($itemset_items)
				{
					$t .= '<li><ul class="item-specs"><li class="color-tooltip-yellow">' . $itemset['name'] . ' ' . (isset($this->m_tooltipData['set']) ? count($this->m_tooltipData['set']) : 0) . ' / ' . $pieces_count . '</li>';
					foreach ($itemset_items as &$item)
						$t .= '<li class="indent"><a class="color-' . (in_array($item['entry'], $this->m_tooltipData['set']) ? 'tooltip-beige' : 'd' . $item['Quality']) . ' has-tip" href="' . $this->getWowUrl('item/' . $item['entry']) . '">' . $item['name'] . '</a></li>'; 
	
					$bonus_info = $this->getItemsetBonusInfo($itemset);
					$t .= '<li class="indent-top"> </li>';
					if ($bonus_info)
						foreach ($bonus_info as &$bonus)
							if ($bonus['desc'])
								$t .= '<li class="color-' . (count($this->m_tooltipData['set']) >= $bonus['threshold'] ? 'tooltip-green' : 'd4') .'">(' . $bonus['threshold'] . ') ' . $l->format('template_item_set_bonus', $bonus['desc']) . '</li>';
	
					$t .= '</ul></li>';
				}
			}
			unset($itemset, $itemset_items, $itemset_pieces, $bonus_info, $bonus);
		}

		$spells = array();
		for ($i = 1; $i < MAX_ITEM_PROTO_SPELLS+1; ++$i)
		{
			if ($this->item('spellid_' . $i) > 0 && !in_array($this->item('spellid_' . $i), array(483, 55884)) && in_array($this->item('spelltrigger_' . $i), array(0, 1, 2, 6)))
				$spells[$this->item('spellid_' . $i)] = $this->item('spelltrigger_' . $i);
		}

		if ($spells)
		{
			$item_spells = $this->c('QueryResult', 'Db')
				->model('WowSpell')
				->fieldCondition('id', array_keys($spells))
				->keyIndex('id')
				->loadItems();

			if ($item_spells)
			{
				foreach($item_spells as &$spell)
				{
					$sdesc = $this->c('Spell')->getSpellDescription($spell);
					if (!$sdesc)
						continue;
					$t .= '<li class="color-q2"><span class="tip" data-spell="' . $spell['id'] . '">' . $l->format('template_item_spell_trigger_' . $spells[$spell['id']], $sdesc) . '</span></li>';
				}
			}
			unset($item_spells, $spell);
		}
		unset($spells);

		if ($this->item('description'))
			$t .= '<li class="color-tooltip-yellow">' . $this->item('description') . '</li>';

		if ($this->item('SellPrice') > 0)
		{
			$price = $this->c('Wow')->GetMoneyFormat($this->item('SellPrice'));
			$t .= '<li>' . $l->getString('template_item_sell_price');
			$sMoney = array('gold', 'silver', 'copper');
			foreach ($sMoney as $money)
				if ($price[$money] > 0)
					$t .= '<span class="icon-' . $money . '"> ' . $price[$money] . '</span>';

			$t .= '</li>';
		}

		/*
		if ($this->m_isTooltip)
		{
			$source_info = array();
			if ($src_npc = $this->getItemSourceInfo(ITEM_SOURCE_TYPE_CREATURE))
			{
				$source_info = array(
					'type_id' => ITEM_SOURCE_TYPE_CREATURE,
					'type_string' => $l->getString('template_item_source_boss'),
					'type_category_string' => $l->getString('template_item_source_raid'),
					'type_subcategory_string' => $l->getString('template_item_tab_header_droprate'),
					'type_source_data' => $src_npc
				);
				unset($src_npc);
			}
			elseif ($src_quest = $this->getItemSourceInfo(ITEM_SOURCE_TYPE_QUEST))
			{
				$source_info = array(
					'type_id' => ITEM_SOURCE_TYPE_QUEST,
					'type_string' => $l->getString('template_item_source_quest'),
					'type_category_string' => '',
					'type_subcategory_string' => isset($src_quest['zone_name']) ? $l->getString('template_item_source_category') : '',
					'type_source_data' => $src_quest
				);
				unset($src_quest);
			}
			if ($source_info)
			{
				$t .= '<ul class="item-specs"><li><span class="color-tooltip-yellow">' . $source_info['type_string'] . '</span>';

				if ($source_info['type_id'] == ITEM_SOURCE_TYPE_CREATURE && $source_info['type_category_string'] && isset($source_info['type_source_data']['boss_id']))
				{
					$t .= '<a href="' . $this->getWowUrl('zone/' . $source_info['type_source_data']['zone_key'] . '/' . $source_info['type_source_data']['key'])  .'" data-npc="' . $source_info['type_source_data']['boss_id'] . '">' . $source_info['type_source_data']['bossName'] . '</a></li>
					<li><span class="color-tooltip-yellow">' . $source_info['type_category_string'] . '</span>
						<a href="' . $this->getWowUrl('zone/' . $source_info['type_source_data']['zone_key']) . '" data-zone="' . $source_info['type_source_data']['zone_id'] . '">' . $source_info['type_source_data']['name'] . '</a>
					</li><li>
					<span class="color-tooltip-yellow">' . $source_info['type_subcategory_string'] . ':</span>
					' . $l->getString('template_item_drop_rate_' . (isset($source_info['type_source_data']['percent_index']) ? $source_info['type_source_data']['percent_index'] : '0')) . '
					</li>';
				}
				elseif ($source_info['type_id'] == ITEM_SOURCE_TYPE_QUEST && $source_info['type_string'])
				{
					$t .= '<span class="tip" data-quest="' . $source_info['type_source_data']['entry'] . '">' . $source_info['type_source_data']['Title'] . '</span>
					</li>';

					if ($source_info['type_subcategory_string'])
						$t .= '<li><span class="color-tooltip-yellow">' . $source_info['type_subcategory_string'] . '</span>' . $source_info['type_source_data']['zone_name'] . '</li>';
				}

				$t .= '</ul>';
			}
		}*/

		$t .= '</ul>';

		if (!$this->m_isTooltip)
		{
			// Try to find faction equivalent item
			if ($this->item('Flags2') & ITEM_FLAGS2_ALLIANCE_ONLY)
				$iFaction = 'alliance';
			elseif ($this->item('Flags2') & ITEM_FLAGS2_HORDE_ONLY)
				$iFaction = 'horde';
			else
				$iFaction = 'none';

			if ($iFaction != 'none')
			{
				$equivalent = $this->c('QueryResult', 'Db')
					->model('WowItemEquivalents')
					->fields(array('WowItemEquivalents' => array('item_' . ($iFaction == 'alliance' ? 'horde' : 'alliance'))))
					->fieldCondition('item_' . $iFaction, ' = ' . $this->item('entry'))
					->loadItem();

				if ($equivalent)
				{
					$q = $this->c('QueryResult', 'Db')
						->model('ItemTemplate');
					if ($l->GetLocaleID() != LOCALE_EN)
						$q->addModel('LocalesItem')
							->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry')
							->fields(array('ItemTemplate' => array('entry', 'displayid', 'Quality', 'name'), 'LocalesItem' => array('name_loc' . $l->GetLocaleID())));
					else
						$q->fields(array('ItemTemplate' => array('entry', 'displayid', 'Quality', 'name')));

					$item_data = $q->fieldCondition('item_template.entry', ' = ' . $equivalent['item_' . ($iFaction == 'alliance' ? 'horde' : 'alliance')])
						->loadItem();

					if ($item_data)
					{
						$icon = $this->c('QueryResult', 'Db')
							->model('WowIcons')
							->fieldCondition('displayid', ' = ' . $item_data['displayid'])
							->loadItem();

						$t .= '<div class="faction-related">';
						$t .= '<a href="' . $this->getWowUrl('item/' . $item_data['entry']) . '" rel="np" data-tooltip="#faction-tooltip">';
						$t .= '<span class="icon-frame frame-14 "><img src="' . $icons_server . '/18/faction_' . ($iFaction == 'alliance' ? '1' : '0') . '.jpg" alt="" width="14" height="14" /></span> ';
						$t .= '<span class="icon-frame frame-14 "><img src="' . $icons_server . '/18/' . (isset($icon['icon']) ? $icon['icon'] : 'inv_questionmark') .'.jpg" alt="" width="14" height="14" /></span>';
						$t .= '</a>';
						$t .= '<div id="faction-tooltip" style="display: none">' . $l->format('template_item_convert_from_alliance', $item_data['Quality'], $item_data['name']) . '</div></div>';
					}
				}
			}
		}

		$t .= '<span class="clear"><!-- --></span>' . (!$this->m_isTooltip ? '</div>' : '') . '</div>';

		$this->m_tooltip = $t;
		unset($t);

		return $this;
	}

	public function getItemDropPercent($boss_id, $db_table, $item_id, $returnAsIndex = true)
	{
		$allowed_tables = array(
			'creature_loot_template' => 'CreatureLootTemplate',
			'disenchant_loot_template' => 'DisenchantLootTemplate',
			'fishing_loot_template' => 'FishingLootTemplate',
			'gameobject_loot_template' => 'GameobjectLootTemplate',
			'item_loot_template' => 'ItemLootTemplate',
			'reference_loot_template' => 'ReferenceLootTemplate'
		);

		if (!isset($allowed_tables[$db_table]))
			return false;

		$percent = 0;

		$loot_table = $this->c('QueryResult', 'Db')
			->model($allowed_tables[$db_table])
			->fieldCondition('entry', ' = ' . $boss_id)
			->loadItems();

		if (!$loot_table)
			return false;

		foreach ($loot_table as &$table)
		{
			if ($table['ChanceOrQuestChance'] > 0 && $table['item'] == $item_id)
				$percent = $table['ChanceOrQuestChance'];
			elseif ($table['ChanceOrQuestChance'] && $table['item'] == $item_id)
			{
				$current_group = $table['groupid'];
				$percent = 0;
				$i = 0;
				foreach ($loot_table as &$t)
				{
					if ($t['groupid'] == $current_group)
					{
						if ($t['ChanceOrQuestChance'])
							$percent += $t['ChanceOrQuestChance'];
						else
							++$i;
					}
				}
				if ($i > 0)
					$percent = round((100 - $percent) / $i, 3);
				else
					$percent = 0;
			}
		}
		unset($loot_table);

		if ($returnAsIndex)
		{
			if ($percent == 100)
				return 6;
			elseif ($percent > 80)
				return 5;
			elseif ($percent > 50)
				return 4;
			elseif ($percent > 30)
				return 3;
			elseif ($percent > 10)
				return 2;
			elseif ($percent > 0)
				return 1;
			elseif ($percent == 0)
				return 0;
		}
		return $percent;
	}

	public function getItemSourceInfo($type)
	{
		$model = '';
		$storage = array();
		switch($type)
		{
			case ITEM_SOURCE_TYPE_CREATURE:
				$storage = $this->c('QueryResult', 'Db')
					->model('CreatureLootTemplate')
					->addModel('CreatureTemplate')
					->join('left', 'CreatureTemplate', 'CreatureLootTemplate', 'entry', 'entry')
					->fieldCondition('item', ' = ' . $this->item('entry'))
					->fields(array('CreatureLootTemplate' => array_keys($this->c('CreatureLootTemplate', 'Model')->m_fields), 'CreatureTemplate' => array('entry', 'name', 'difficulty_entry_1', 'difficulty_entry_2', 'difficulty_entry_3', 'KillCredit1', 'KillCredit2')))
					->loadItem();
				if ($storage)
				{
					// Check diff_entries & KillCredits
					$entry = $storage['entry'];
					$storage['percent_index'] = $this->getItemDropPercent($entry, 'creature_loot_template', $this->item('entry'));
					
					for ($i = 1; $i < 3; ++$i)
						if ($storage['KillCredit' . $i] > 0)
							$entry = $storage['KillCredit' . $i];

					// Check if npc is a boss
					$boss = $this->c('QueryResult', 'Db')
						->model('WowInstanceBosses')
						->addModel('WowInstances')
						->join('left', 'WowInstances', 'WowInstanceBosses', 'instance_id', 'zone_id')
						->fields(array('WowInstanceBosses' => array('boss_id', 'key', 'bossName_' . $this->c('Locale')->getLocale()), 'WowInstances' => array('zone_id', 'zone_key', 'name_' . $this->c('Locale')->getLocale())))
						->fieldCondition('boss_id', ' = ' . $entry)
						->loadItem();

					if ($boss)
					{
						$boss = array_merge($storage, $boss);
						unset($storage);
						return $boss;
					}
				}
				break;
			case ITEM_SOURCE_TYPE_DISENCHANTING:
				break;
			case ITEM_SOURCE_TYPE_FISHING:
				break;
			case ITEM_SOURCE_TYPE_GAMEOBJECT:
				break;
			case ITEM_SOURCE_TYPE_QUEST:
				$q = $this->c('QueryResult', 'Db')
					->model('QuestTemplate');

				if ($this->c('Locale')->GetLocaleID() != LOCALE_EN)
					$q->addModel('LocalesQuest')
						->join('left', 'LocalesQuest', 'QuestTemplate', 'entry', 'entry')
						->fields(array('QuestTemplate' => array('entry', 'ZoneOrSort'), 'LocalesQuest' => array('Title_loc' . $this->c('Locale')->GetLocaleID())));
				else
					$q->fields(array('QuestTemplate' => array('entry', 'Title', 'ZoneOrSort')));

				for ($i = 1; $i < 7; ++$i)
				{
					if ($i < 5)
						$q->fieldCondition('quest_template.RewItemId' . $i, ' = ' . $this->item('entry'), 'OR');
					$q->fieldCondition('quest_template.RewChoiceItemId' . $i, ' = ' . $this->item('entry'), 'OR');
				}

				$storage = $q->loadItem();
				unset($q);

				if (!$storage)
					return false;

				if ($storage['ZoneOrSort'] > 0)
				{
					$zone = $this->c('QueryResult', 'Db')
						->model('WowAreas')
						->fields(array('WowAreas' => array('name_' . $this->c('Locale')->GetLocale())))
						->setItemId($storage['ZoneOrSort'])
						->loadItem();

					if ($zone)
						$storage['zone_name'] = $zone['name'];

					unset($zone);
				}
				break;
			case ITEM_SOURCE_TYPE_ITEM:
				break;
			case ITEM_SOURCE_TYPE_MILLING:
				break;
			case ITEM_SOURCE_TYPE_PICKPOCKETING:
				break;
			case ITEM_SOURCE_TYPE_PROSPECTING:
				break;
			case ITEM_SOURCE_TYPE_SKINNING:
				break;
			case ITEM_SOURCE_TYPE_SPELL:
				break;
			default:
				return false;
		}
		return $storage;
	}

	protected function getItemsetBonusInfo(&$itemset)
	{
		if (!$itemset)
			return false;

		$spells = array();
		$set_bonuses = array();
		for ($i = 1; $i < 9; ++$i)
			if (isset($itemset['bonus' . $i]) && isset($itemset['threshold' . $i]) && $itemset['bonus' . $i] > 0 && $itemset['threshold' . $i] > 0)
				$spells[$itemset['bonus' . $i]] = $itemset['threshold' . $i];

		if ($spells)
		{
			$bonuses = $this->c('QueryResult', 'Db')
				->model('WowSpell')
				->fieldCondition('id', array_keys($spells))
				->keyIndex('id')
				->loadItems();

			if (!$bonuses)
				return false;

			foreach ($bonuses as &$bonus)
			{
				$set_bonuses[$spells[$bonus['id']]] = array(
					'desc' => $this->c('Spell')->getSpellDescription($bonus),
					'threshold' => $spells[$bonus['id']]
				);
			}

			unset($spells, $bonuses, $bonus);
			sort($set_bonuses);
			return $set_bonuses;
		}

		return false;
	}

	public function AllowableClasses($mask)
	{
		$mask &= 0x5DF;
		if ($mask == 0x5DF || $mask == 0)
			return true;

		$classes_data = array();
		$i = 1;

		while($mask)
		{
			if ($mask & 1)
				$classes_data[$i] = $this->c('Classes', 'Data')->getValue($i);

			$mask >>= 1;
			$i++;
		}

		return $classes_data;
	}
	
	public function AllowableRaces($mask)
	{
		$mask &= 0x7FF;
		if ($mask == 0x7FF || $mask == 0)
			return true;

		$races_data = array();
		$i = 1;

		while($mask)
		{
			if ($mask & 1)
				$races_data[$i] = $this->c('Classes', 'Data')->getValue($i);

			$mask >>= 1;
			$i++;
		}

		return $races_data;
	}

	public function IsGemMatchesSocketColor($gem_color, $socket_color)
	{
		if ($socket_color == $gem_color)
			return true;
		elseif ($socket_color == 2 && in_array($gem_color, array(6, 10, 14)))
			return true;
		elseif ($socket_color == 4 && in_array($gem_color, array(6, 12, 14)))
			return true;
		elseif ($socket_color == 8 && in_array($gem_color, array(10, 12, 14)))
			return true;
		elseif ($socket_color == 0)
			return true; // Extra socket
		else
			return false;
	}

	public function GetDPSMod(&$ssv, $mask)
	{
		if (!is_array($ssv))
			return 0;

		if ($mask & 0x7E00)
		{
			if ($mask & 0x00000200)
				return $ssv['dpsMod_0'];

			if ($mask & 0x00000400)
				return $ssv['dpsMod_1'];

			if ($mask & 0x00000800)
				return $ssv['dpsMod_2'];

			if ($mask & 0x00001000)
				return $ssv['dpsMod_3'];

			if ($mask & 0x00002000)
				return $ssv['dpsMod_4'];

			if ($mask & 0x00004000)
				return $ssv['dpsMod_5'];   // not used?
		}

		return 0;
	}

	public function GetSpellBonus(&$ssv, $mask)
	{
		if (!is_array($ssv))
			return 0;

		if ($mask & 0x00008000)
			return $ssv['spellBonus'];

		return 0;
	}
 
	public function GetFeralBonus(&$ssv, $mask)
	{
		if (!is_array($ssv))
			return 0;

		if ($mask & 0x00010000)
			return 0;   // not used?

		return 0;
	}

	public function GetArmorMod(&$ssv, $mask)
	{
		if (!is_array($ssv))
			return 0;

		if ($mask & 0x00F001E0)
		{
			if ($mask & 0x00000020)
				return $ssv['armorMod_0'];

			if ($mask & 0x00000040)
				return $ssv['armorMod_1'];

			if ($mask & 0x00000080)
				return $ssv['armorMod_2'];

			if ($mask & 0x00000100)
				return $ssv['armorMod_3'];

			if ($mask & 0x00100000)
				return $ssv['armorMod2_0']; // cloth

			if ($mask & 0x00200000)
				return $ssv['armorMod2_1']; // leather

			if ($mask & 0x00400000)
				return $ssv['armorMod2_2']; // mail

			if ($mask & 0x00800000)
				return $ssv['armorMod2_3']; // plate
		}

		return 0;
	}

	public function GetSSDMultiplier(&$ssv, $mask)
	{
		if(!is_array($ssv))
			return 0;

		if($mask & 0x4001F)
		{
			if($mask & 0x00000001)
				return $ssv['ssdMultiplier_0'];

			if($mask & 0x00000002)
				return $ssv['ssdMultiplier_1'];

			if($mask & 0x00000004)
				return $ssv['ssdMultiplier_2'];

			if($mask & 0x00000008)
				return $ssv['ssdMultiplier2'];

			if($mask & 0x00000010)
				return $ssv['ssdMultiplier_3'];

			if($mask & 0x00040000)
				return $ssv['ssdMultiplier3'];
		}
		return 0;
	}

	public function getTooltip()
	{
		return $this->m_tooltip;
	}

	protected function getExtendedCostInfo($entry = 0)
	{
		if ($entry == 0)
			$entry = $this->item('entry');

		$cost = $this->c('QueryResult', 'Db')
			->model('NpcVendor')
			->fields(array('NpcVendor' => array('ExtendedCost')))
			->fieldCondition('item', ' = ' . $entry)
			->loadItem();

		if (!$cost)
			return false;

		$exCost = $this->c('QueryResult', 'Db')
			->model('WowExtendedCost')
			->setItemId($cost['ExtendedCost'])
			->loadItem();

		$item_entries = array();

		for ($i = 1; $i < 6; ++$i)
		{
			if ($exCost['item' . $i] > 0 && $exCost['item' . $i . 'count'] > 0)
				$item_entries[$exCost['item'. $i]] = $exCost['item'. $i . 'count'];
		}

		if ($item_entries)
		{
			$items = $this->getItemsInfo($item_entries);
			if ($items)
			{
				$ex_cost_items = array();
				foreach ($items as &$item)
				{
					$ex_cost_items[$item['entry']] = array(
						'entry' => $item['entry'],
						'Quality' => $item['Quality'],
						'displayid' => $item['displayid'],
						'icon' => isset($item['icon']) ? $item['icon'] : '',
						'name' => $item['name'],
						'count' => $item_entries[$item['entry']]
					);
				}

				unset($items);
				$this->m_item['extended_cost'] = array('items' => $ex_cost_items);
			}
		}

		unset($exCost, $cost);
	}

	public function getItemsInfo($entries, $values = false, $fields = null, $limit = 0, $offset = -1)
	{
		if (!$entries)
			return false;

		$query = $this->c('QueryResult', 'Db')
			->model('ItemTemplate');

		if ($this->c('Locale')->GetLocaleID() != LOCALE_EN)
			$query->addModel('LocalesItem')->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry');

		if (is_array($entries))
		{
			if ($values)
				$query->fieldCondition('item_template.entry', array_values($entries));
			else
				$query->fieldCondition('item_template.entry', array_keys($entries));
		}
		else
			$query->fieldCondition('item_template.entry', ' = ' . $entries);

		if ($fields)
			$query->fields($fields);

		if ($limit > 0 && $offset >= 0)
			$query->limit($limit, $offset);

	 	$items_info = $query->keyIndex('entry')
			->order(array('ItemTemplate' => array('Quality')), 'DESC')
			->loadItems();

		if ($items_info)
		{
			$display_ids = array();
			foreach ($items_info as &$item)
				$display_ids[] = $item['displayid'];

			$icons = $this->c('QueryResult', 'Db')
				->model('WowIcons')
				->fieldCondition('displayid', $display_ids)
				->keyIndex('displayid')
				->loadItems();

			if ($icons)
			{
				foreach($items_info as &$item)
				{

					$item['icon'] = $icons[$item['displayid']]['icon'];

					$item['allowable_classes'] = array();
					$item['allowable_races'] = array();

					if (isset($item['SellPrice']))
						$item['sell_price'] = $this->c('Wow')->GetMoneyFormat($item['SellPrice']);

					if (isset($item['AllowableClass']))
					{
						if ($item['AllowableClass'] > 0)
							$item['allowable_classes'] = $this->AllowableClasses($item['AllowableClass']);
					}

					if (isset($item['AllowableRace']))
					{
						if ($item['AllowableRace'] > 0)
							$item['allowable_races'] = $this->AllowableRaces($item['AllowableRace']);
					}
				}
			}

			unset($icons, $display_ids);

			if (is_array($entries))
				return $items_info;
			elseif (is_numeric($entries) && isset($items_info[$entries]))
				return $items_info[$entries];
		}
	}

	public function initItems($options)
	{
		$classId 	= isset($options['classId']) 	? (int) $options['classId'] 	 : -1;
		$subClassId = isset($options['subClassId']) ? (int) $options['subClassId']	 : -1;
		$invType 	= isset($options['invType']) 	? (int) $options['invType']	 	 : -1;
		$offset		= isset($options['page'])		? (((int) $options['page'] - 1) * $this->getDisplayLimit()) : 0;

		$query = $this->c('QueryResult', 'Db')
			->model('ItemTemplate');

		if ($this->c('Locale')->GetLocaleID() != LOCALE_EN)
			$query->addModel('LocalesItem')
				->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry')
				->fields(array('ItemTemplate' => array('entry', 'name', 'Quality', 'Flags', 'FlagsExtra', 'displayid', 'class', 'subclass', 'InventoryType', 'ItemLevel', 'RequiredLevel'), 'LocalesItem' => array('name_loc' . $this->c('Locale')->GetLocaleID())));
		else
			$query->fields(array('ItemTemplate' => array('entry', 'name', 'Quality', 'Flags', 'FlagsExtra', 'displayid', 'class', 'subclass', 'InventoryType', 'ItemLevel', 'RequiredLevel')));

		$query->keyIndex('entry');

		if ($classId >= 0)
			$query->fieldCondition('item_template.class', ' = ' . $classId);

		if ($subClassId >= 0)
			$query->fieldCondition('item_template.subclass', ' = ' . $subClassId);

		if ($invType >= 0)
			$query->fieldCondition('item_template.InventoryType', ' = ' . $invType);

		$this->m_items = $query
			->limit($this->getDisplayLimit(), $offset)
			->order(array('ItemTemplate' => array('Quality' => array('DESC'), 'ItemLevel' => array('DESC'))))
			->loadItems();

		if (!$this->m_items)
		{
			unset($query);
			return $this;
		}

		$query->model('ItemTemplate')->fields(array('ItemTemplate' => array('entry')))->runFunction('COUNT', 'entry');

		if ($classId >= 0)
			$query->fieldCondition('item_template.class', ' = ' . $classId);

		if ($subClassId >= 0)
			$query->fieldCondition('item_template.subclass', ' = ' . $subClassId);

		if ($invType >= 0)
			$query->fieldCondition('item_template.InventoryType', ' = ' . $invType);

		$this->m_itemsCount = $query->loadItem();
		$this->m_itemsCount = $this->m_itemsCount['entry'];

		unset($query);

		if ($classId >= 0)
		{
			// We can't use one handler for multiply queries. Maybe this should be fixed in core.
			if ($subClassId >= 0)
			{
				$this->m_itemsClassInfo = $this->c('QueryResult', 'Db')
					->model('WowItemSubclass')
					->fieldCondition('class', ' = ' . $classId)
					->fieldCondition('subclass', ' = ' . $subClassId)
					->loadItem();
			}
			else
			{
				$this->m_itemsClassInfo = $this->c('QueryResult', 'Db')
					->model('WowItemSubclass')
					->fieldCondition('class', ' = ' . $classId)
					->loadItem();
			}

			if ($this->m_itemsClassInfo && $invType >= 0)
				$this->m_itemsClassInfo['invType'] = $invType;
		}

		$display_id = array();

		foreach ($this->m_items as &$it)
			$display_id[] = $it['displayid'];

		$icons = $this->c('QueryResult', 'Db')
			->model('WowIcons')
			->fieldCondition('displayid', $display_id)
			->keyIndex('displayid')
			->loadItems();

		foreach ($this->m_items as &$item)
			if (isset($icons[$item['displayid']]))
				$item['icon'] = $icons[$item['displayid']]['icon'];

		unset($icons, $display_id);

		return $this;
	}

	public function getItems()
	{
		return $this->m_items;
	}

	public function getItemsCount()
	{
		return $this->m_itemsCount;
	}

	public function getDisplayLimit()
	{
		return self::ITEMS_PER_PAGE;
	}

	public function itemPageTitle()
	{
		if (!$this->m_itemsClassInfo)
			return $this->c('Locale')->getString('template_menu_items');

		if (isset($this->m_itemsClassInfo['invType']))
			return $this->c('Locale')->getString('template_item_invtype_' . $this->m_itemsClassInfo['invType']);

		if (isset($this->m_itemsClassInfo['subclass_name']))
			return $this->m_itemsClassInfo['subclass_name'];

		return $this->m_itemsClassInfo['class_name'];
	}

	public function getItemsClassInfo($type)
	{
		return isset($this->m_itemsClassInfo[$type]) ? $this->m_itemsClassInfo[$type] : '';
	}

	public function getItemTabsCounters($item_id = 0)
	{
		$item_id = $item_id ? $item_id : $this->item('entry');

		if (!$item_id)
			return false;

		$tabs_info = array();

		$query_info = array(
			'dropCreatures' => array(
				'model' => 'CreatureLootTemplate',
			),
			'dropGameObjects' => array(
				'model' => 'GameobjectLootTemplate',
			),
			'vendors' => array(
				'model' => 'NpcVendor',
			),
			'skinnedFromCreatures' => array(
				'model' => 'SkinningLootTemplate',
			),
			'pickPocketCreatures' => array(
				'model' => 'PickpocketingLootTemplate',
			),
			'disenchantItems' => array(
				'model' => 'DisenchantLootTemplate',
				'itemId' => $this->item('DisenchantID'),
				'condField' => 'entry'
			),
		);

		foreach ($query_info as $t => $q)
		{
			$data = $this->c('QueryResult', 'Db')
				->model($q['model'])
				->fields(array($q['model'] => array('entry')))
				->runFunction('COUNT', 'entry')
				->fieldCondition((!isset($q['condField']) ? 'item' : $q['condField']), ' = ' . (!isset($q['itemId']) ? $item_id : $q['itemId']))
				->loadItem();

			if ($data && isset($data['entry']) && $data['entry'] > 0)
				$tabs_info[$t] = $data['entry'];

			unset($data);
		}

		// Quest reward
		$quest_data = $this->c('QueryResult', 'Db')
			->model('QuestTemplate')
			->fields(array('QuestTemplate' => array('entry')))
			->runFunction('COUNT', 'entry')
			->fieldCondition('RewChoiceItemId1', ' = ' . $item_id, 'OR')
			->fieldCondition('RewChoiceItemId2', ' = ' . $item_id, 'OR')
			->fieldCondition('RewChoiceItemId3', ' = ' . $item_id, 'OR')
			->fieldCondition('RewChoiceItemId4', ' = ' . $item_id, 'OR')
			->fieldCondition('RewChoiceItemId5', ' = ' . $item_id, 'OR')
			->fieldCondition('RewChoiceItemId6', ' = ' . $item_id, 'OR')
			->fieldCondition('RewItemId1', ' = ' . $item_id, 'OR')
			->fieldCondition('RewItemId2', ' = ' . $item_id, 'OR')
			->fieldCondition('RewItemId3', ' = ' . $item_id, 'OR')
			->fieldCondition('RewItemId4', ' = ' . $item_id, 'OR')
			->loadItem();

		if ($quest_data && isset($quest_data['entry']) && $quest_data['entry'] > 0)
			$tabs_info['rewardFromQuests'] = $quest_data['entry'];
/*
// TODO: need to review this part (slow queries)
		// Created by spell
		$crafted_data = $this->c('QueryResult', 'Db')
			->model('WowSpell')
			->fields(array('WowSpell' => array('id')))
			->runFunction('COUNT', 'id')
			->fieldCondition('EffectItemType_1', ' = ' . $item_id, 'OR')
			->fieldCondition('EffectItemType_2', ' = ' . $item_id, 'OR')
			->fieldCondition('EffectItemType_3', ' = ' . $item_id, 'OR')
			->loadItem();

		if ($crafted_data && isset($crafted_data['id']) && $crafted_data['id'] > 0)
			$tabs_info['createdBySpells'] = $crafted_data['id'];

		// Reagent for spells
		$reagent_data = $this->c('QueryResult', 'Db')
			->model('WowSpell')
			->fields(array('WowSpell' => array('id')))
			->runFunction('COUNT', 'id')
			->fieldCondition('Reagent_1', ' = ' . $item_id, 'OR')
			->fieldCondition('Reagent_2', ' = ' . $item_id, 'OR')
			->fieldCondition('Reagent_3', ' = ' . $item_id, 'OR')
			->fieldCondition('Reagent_4', ' = ' . $item_id, 'OR')
			->fieldCondition('Reagent_5', ' = ' . $item_id, 'OR')
			->fieldCondition('Reagent_6', ' = ' . $item_id, 'OR')
			->fieldCondition('Reagent_7', ' = ' . $item_id, 'OR')
			->fieldCondition('Reagent_8', ' = ' . $item_id, 'OR')
			->loadItem();

		if ($reagent_data && isset($reagent_data['id']) && $reagent_data['id'] > 0)
			$tabs_info['reagentForSpells'] = $reagent_data['id'];
*/

		return $tabs_info;
	}

	public function getItemTab($tab)
	{
		switch (strtolower($tab))
		{
			case 'dropcreatures':
			case 'dropgameobjects':
			case 'vendors':
			case 'currencyforitems':
			case 'rewardfromquests':
			case 'skinnedfromcreatures':
			case 'pickpocketcreatures':
			case 'minedfromcreatures':
			case 'createdbyspells':
			case 'reagentforspells':
			case 'disenchantitems':
				return $this->{'getItemTab' . ucfirst(strtolower($tab))}();
			case 'comments':
				return false;
				break;
			default:
				return false;
		}
	}

	protected function getItemTabDropcreatures()
	{
		if (!$this->m_item)
			return false;

		$lId = $this->c('Locale')->GetLocaleID();
		$lName = $this->c('Locale')->GetLocale();

		$q = $this->c('QueryResult', 'Db')
			->model('CreatureLootTemplate')
			->addModel('CreatureTemplate')
			->addModel('Creature')
			->join('left', 'CreatureTemplate', 'CreatureLootTemplate', 'entry', 'entry')
			->join('left', 'Creature', 'CreatureLootTemplate', 'entry', 'id');

		$fields = $this->c('Creature')->getCreatureFields('CreatureLootTemplate');

		if ($lId != LOCALE_EN)
			$q->addModel('LocalesCreature')
				->join('left', 'LocalesCreature', 'CreatureLootTemplate', 'entry', 'entry');

		$q->fields($fields);

		$creatures = $q->fieldCondition('creature_loot_template.item', ' = ' . $this->item('entry'))
			->keyIndex('entry')
			->loadItems();

		$loot_data = $this->c('QueryResult', 'Db')
			->model('CreatureLootTemplate')
			->fields(array('CreatureLootTemplate' => array('entry', 'ChanceOrQuestChance', 'groupid', 'mincountOrRef', 'item')))
			->fieldCondition('entry', array_keys($creatures))
			->loadItems();

		$this->c('Creature')->getOriginalCreaturesInfo($creatures);

		$this->calculateDropRate($creatures, $loot_data);

		$tab_info = array(
			'type' => 'dropCreatures',
			'fields' => array(
				'name' => array('content_data' => 'data-npc'),
				'type' => array(),
				'level' => array('content_data' => 'data-raw', 'sort' => 'numeric'),
				'zone' => array('content_data' => 'data-zone'),
				'droprate' => array('content_data' => 'data-raw', 'sort' => 'numeric'),
			),
			'contents' => $creatures
		);

		unset($creatures);

		return $tab_info;
	}

	protected function getItemTabDropgameobjects()
	{
		if (!$this->m_item)
			return false;

		$fields = array(
			'GameobjectLootTemplate' => array('entry', 'item', 'ChanceOrQuestChance', 'groupid', 'mincountOrRef', 'maxcount'),
			'GameobjectTemplate' => array('entry', 'name'),
			'Gameobject' => array('id', 'map', 'position_x', 'position_y')
		);

		$q = $this->c('QueryResult', 'Db')
			->model('GameobjectLootTemplate')
			->addModel('GameobjectTemplate')
			->addModel('Gameobject')
			->join('left', 'GameobjectTemplate', 'GameobjectLootTemplate', 'entry', 'entry')
			->join('left', 'Gameobject', 'GameobjectLootTemplate', 'entry', 'id');
		if ($this->c('Locale')->GetLocaleID() != LOCALE_EN)
			$q->addModel('LocalesGameobject')
				->join('left', 'LocalesGameobject', 'GameobjectLootTemplate', 'entry', 'entry')
				->fields(array_merge($fields, array('LocalesGameobject' => array('name_loc' . $this->c('Locale')->GetLocaleID()))));
		else
			$q->fields($fields);

		$gobjects = $q->fieldCondition('gameobject_loot_template.item', ' = ' . $this->item('entry'))
			->keyIndex('entry')
			->loadItems();

		$loot_data = $this->c('QueryResult', 'Db')
			->model('GameobjectLootTemplate')
			->fields(array('GameobjectLootTemplate' => array('entry', 'ChanceOrQuestChance', 'groupid', 'mincountOrRef', 'item')))
			->fieldCondition('entry', array_keys($gobjects))
			->loadItems();

		$this->calculateDropRate($gobjects, $loot_data);

		foreach ($gobjects as &$go)
			$go['zone_info'] = $this->c('Creature')->getZoneInfo($go, false);

		unset($loot_data, $q, $fields);

		return array(
			'contents' => $gobjects
		);
	}

	protected function getItemTabVendors()
	{
		if (!$this->m_item)
			return false;

		$lId = $this->c('Locale')->GetLocaleID();
		$lName = $this->c('Locale')->GetLocale();

		$fields = $this->c('Creature')->getCreatureFields('NpcVendor');

		$q = $this->c('QueryResult', 'Db')
			->model('NpcVendor')
			->addModel('CreatureTemplate')
			->addModel('Creature')
			->join('left', 'CreatureTemplate', 'NpcVendor', 'entry', 'entry')
			->join('left', 'Creature', 'NpcVendor', 'entry', 'id');
		if ($lId != LOCALE_EN)
			$q->addModel('LocalesCreature')
				->join('left', 'LocalesCreature', 'NpcVendor', 'entry', 'entry');

		$vendors = $q->fields($fields)
			->fieldCondition('npc_vendor.item', ' = ' . $this->item('entry'))
			->keyIndex('entry')
			->loadItems();

		if (!$vendors)
			return false;

		$ex_cost = array();

		foreach ($vendors as &$v)
		{
			$v['zone_info'] = $this->c('Creature')->getZoneInfo($v, false);
			if ($v['ExtendedCost'] > 0)
				$ex_cost[$v['entry']] = $v['ExtendedCost'];
		}

		unset($q);

		if ($ex_cost)
		{
			$extended = $this->c('QueryResult', 'Db')
				->model('WowExtendedCost')
				->fieldCondition('id', array_values($ex_cost))
				->keyIndex('id')
				->loadItems();

			if ($extended)
			{
				foreach ($ex_cost as $entry => $x)
					if (isset($extended[$x], $vendors[$entry]))
						$vendors[$entry]['extended'] = $extended[$x];
			}
		}

		return array('contents' => $vendors);
	}

	protected function getItemTabCurrencyforitems()
	{
		
	}

	protected function getItemTabRewardFromQuests()
	{
		
	}

	protected function getItemTabSkinnedFromCreatures()
	{
		
	}

	protected function getItemTabCreatedbyspells()
	{
		
	}

	protected function getItemTabReagentforspells()
	{
		
	}

	protected function getItemTabDisenchantitems()
	{
		if (!$this->m_item)
			return false;

		$disID = $this->item('DisenchantID');

		if (!$disID)
			return false;

		$disData = $this->c('QueryResult', 'Db')
			->model('DisenchantLootTemplate')
			->fieldCondition('entry', ' = ' . $disID)
			->keyIndex('item')
			->loadItems();

		if (!$disData)
			return false;

		$item_ids = array_keys($disData);
		$items = $this->getItemsInfo($item_ids, true);

		foreach ($items as &$item)
		{
			if (isset($disData[$item['entry']]))
			{
				$item['dismaxcount'] = $disData[$item['entry']]['maxcount'];
				$item['dropInfo'] = array(
					'percent' => $disData[$item['entry']]['ChanceOrQuestChance'],
					'rate' => $this->getDropRate($disData[$item['entry']]['ChanceOrQuestChance'])
				);
			}
			else
				$item['dismaxcount'] = 0;
		}

		return array(
			'contents' => $items
		);
	}

	protected function calculateDropRate(&$creatures, &$loot_data)
	{
		if (!$loot_data || !$creatures)
			return;

		$percent = 0;
		foreach ($loot_data as &$loot)
		{
			$entry = 0;
			$percent = 0;
			if ($loot['ChanceOrQuestChance'] > 0 && $loot['item'] == $this->item('entry'))
			{
				$entry = $loot['entry'];
				$percent = $loot['ChanceOrQuestChance'];
			}
			elseif ($loot['ChanceOrQuestChance'] == 0 && $loot['item'] == $this->item('entry'))
			{
				$group = $loot['groupid'];
				$entry = $loot['entry'];
				$percent = 0;
				$i = 0;
				foreach ($loot_data as $l)
				{
					if ($l['groupid'] == $group)
					{
						if ($l['ChanceOrQuestChance'] > 0)
							$percent += $l['ChanceOrQuestChance'];
						else
							++$i;
					}
				}
				$percent = round((100 - $percent) / $i, 3);
			}

			foreach ($creatures as &$cr)
				if ((isset($cr['loot_entry']) && $cr['loot_entry'] == $entry) || ($cr['entry'] == $entry))
					$cr['dropInfo'] = array('percentage' => $percent, 'rate' => $this->getDropRate($percent));
		}
	}

	protected function getDropRate($percent) {
		if ($percent == 100) {
			return 6;
		}
		elseif ($percent > 51) {
			return 5;
		}
		elseif ($percent > 25) {
			return 4;
		}
		elseif ($percent > 15) {
			return 3;
		}
		elseif ($percent > 3) {
			return 2;
		}
		elseif ($percent > 0 && $percent <= 2) {
			return 1;
		}
		elseif ($percent < 0 || $percent == 0) {
			return 0;
		}

		return 0;
	}

	protected function loadStoreInfo()
	{
		if (!$this->m_item)
			return $this;

		$this->m_storeInfo = $this->c('QueryResult', 'Db')
			->model('WowStoreItems')
			->fieldCondition('item_id', ' = ' . $this->item('entry'))
			->loadItem();

		return $this;
	}

	public function isAvailableInStore()
	{
		if ($this->m_storeInfo && isset($this->m_storeInfo['item_id']) && $this->m_storeInfo['item_id'] == $this->item('entry') && $this->m_storeInfo['in_store'] == 1)
			return true;

		return false;
	}

	public function getStoreCatId()
	{
		if (!$this->isAvailableInStore())
			return 0;

		return $this->m_storeInfo['cat_id'];
	}
}
?>