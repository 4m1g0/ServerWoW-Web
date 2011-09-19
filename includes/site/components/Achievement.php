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

class Achievement_Component extends Component
{
	protected $m_guid = 0;
	protected $m_achievements = array();
	protected $m_categories = array();
	protected $m_points = 0;
	protected $m_achievementsAction = '';
	protected $m_profileMenu = array();
	protected $m_wowAchievements = array();
	protected $m_totalCompleted = 0;
	protected $m_achProgress = array();
	protected $m_achCriterias = array();
	protected $m_categoryId = 0;

	public function setCategory($id)
	{
		$this->m_categoryId = (int) $id;

		return $this;
	}

	public function loadSimple($guid)
	{
		if (!$guid)
			return $this;

		$this->m_guid = $guid;

		return $this->loadAchievementIDs()->setPoints();
	}

	protected function loadAchievements()
	{
		if ($this->m_categoryId > 0)
			return $this;

		if ($this->m_wowAchievements || !$this->m_achievements)
			return $this;

		$this->m_wowAchievements = $this->c('QueryResult', 'Db')
			->model('WowAchievement')
			->fieldCondition('id', array_keys($this->m_achievements['ids']))
			->loadItems();

		if (!$this->m_wowAchievements)
			return $this;

		$achievements = array();

		foreach ($this->m_wowAchievements as $ach)
		{
			if (!isset($achievements[$ach['categoryId']]))
			{
				$achievements[$ach['categoryId']] = array(
					'pointsInCategory' => 0,
					'count' => 0,
					'achievements' => array()
				);
			}
			$achievements[$ach['categoryId']]['pointsInCategory'] += $ach['points'];
			$achievements[$ach['categoryId']]['count']++;
			$this->m_totalCompleted++;

			if (isset($this->m_achievements['ids'][$ach['id']]))
				$ach['date'] = $this->m_achievements['ids'][$ach['id']]['date'];

			$achievements[$ach['categoryId']]['achievements'][$ach['id']] = $ach;
			$this->m_points += $ach['points'];
		}

		$this->m_wowAchievements = $achievements;
		unset($achievements, $ach);

		return $this;
	}

	public function initAchievements($guid, $action)
	{
		$this->m_achievementsAction = $action;
		$this->m_guid = $guid;
		$this->loadAchievementIDs()
			->loadAchievements();

		return $this;
	}

	public function buildProfileMenu($stat = false)
	{
		if ($this->m_categoryId > 0)
			return $this;

		if ($this->m_profileMenu)
			return $this->m_profileMenu;

		$q = $this->c('QueryResult', 'Db')
			->model('WowAchievementCategory')
			->keyIndex('id');

		if (!$stat)
			$q->fieldCondition('id', ' <> 1');
		else
			$q->fieldCondition('parentCategory', ' = 1');

		$categories = $q->loadItems();

		if (!$categories)
			return false;

		if ($stat)
		{
			$subcategories = $this->c('QueryResult', 'Db')
				->model('WowAchievementCategory')
				->keyIndex('id')
				->fieldCondition('parentCategory', array_keys($categories))
				->loadItems();

			if ($subcategories)
			{
				foreach ($subcategories as $subcategory)
				{
					if (isset($categories[$subcategory['parentCategory']]))
					{
						if (!isset($categories[$subcategory['parentCategory']]['child']))
							$categories[$subcategory['parentCategory']]['child'] = array();

						$categories[$subcategory['parentCategory']]['child'][] = $subcategory;
					}
				}
			}
			unset($subcategories);
			return $categories;
		}

		$tree = array();
		$child_categories = array();

		foreach ($categories as &$cat)
		{
			if (($cat['parentCategory'] > 0 && !$stat) || ($cat['parentCategory'] == 1 && $stat))
			{
				if (!isset($child_categories[$cat['parentCategory']]))
					$child_categories[$cat['parentCategory']] = array();

				$child_categories[$cat['parentCategory']][] = $cat;
				unset($cat);
			}
			elseif ($cat['parentCategory'] == -1)
			{
				$tree[$cat['id']] = $cat;
				$tree[$cat['id']]['child'] = false;
			}
		}

		foreach ($child_categories as $subcat)
		{
			foreach ($subcat as $child)
				if (isset($tree[$child['parentCategory']]))
					$tree[$child['parentCategory']]['child'][] = $child;
		}

		$this->m_profileMenu = $tree;
		unset($categories, $child_categories, $tree);

		return $this->m_profileMenu;
	}

	protected function loadAchievementIDs()
	{
		$this->m_achievements['ids'] = $this->c('QueryResult', 'Db')
			->model('CharacterAchievement')
			//->fields(array('CharacterAchievement' => array('achievement')))
			->setItemId($this->m_guid)
			->keyIndex('achievement')
			->order(array('CharacterAchievement' => array('date')), 'DESC')
			->loadItems();

		return $this;
	}

	public function getAchievementDate($id)
	{
		return isset($this->m_achievements['ids'][$id]) ? $this->m_achievements['ids'][$id]['date'] : 0;
	}

	public function getRecentAchievements()
	{
		$achievements = array();
		$count = 0;
		foreach ($this->m_achievements['ids'] as &$ach)
		{
			if ($count > 4)
				break;
			$achievements[] = $this->findAchievement($ach['achievement']);
			++$count;
		}

		return $achievements;
	}

	protected function findAchievement($id)
	{
		foreach ($this->m_wowAchievements as &$cat)
			foreach ($cat['achievements'] as $ach_id => $ach)
				if ($ach_id == $id)
					return $ach;

		return false;
	}

	protected function setPoints()
	{
		if (!isset($this->m_achievements['ids']) || !$this->m_achievements['ids'])
			return $this;

		$p = $this->c('QueryResult', 'Db')
			->model('WowAchievement')
			->fields(array('WowAchievement' => array('points')))
			->fieldCondition('id', array_keys($this->m_achievements['ids']))
			->runFunction('SUM', 'points')
			->loadItem();
		
		$this->m_points = isset($p['points']) ? $p['points'] : 0;

		unset($p);

		return $this;
	}

	public function getPoints()
	{
		return $this->m_points;
	}

	public function getAchievement($id)
	{
		return $this->c('QueryResult', 'Db')
			->model('WowAchievement')
			->setItemId($id)
			->loadItem();
	}

	public function getProgressInfo()
	{
		$achievements_count = array(
			0 => array('count' => 1058, 'points' => 12775),
			ACHIEVEMENTS_CATEGORY_GENERAL => array('count' => 54, 'points' => 570),
			ACHIEVEMENTS_CATEGORY_QUESTS => array('count' => 49, 'points' => 310),
			ACHIEVEMENTS_CATEGORY_EXPLORATION => array('count' => 70, 'points' => 680, 'extraClass' => 'entry-inner-right'),
			ACHIEVEMENTS_CATEGORY_PVP => array('count' => 166, 'points' => 1560),
			ACHIEVEMENTS_CATEGORY_DUNGEONS => array('count' => 458, 'points' => 4520),
			ACHIEVEMENTS_CATEGORY_PROFESSIONS => array('count' => 75, 'points' => 690, 'extraClass' => 'entry-inner-right'),
			ACHIEVEMENTS_CATEGORY_REPUTATION => array('count' => 45, 'points' => 385),
			ACHIEVEMENTS_CATEGORY_EVENTS => array('count' => 141, 'points' => 1350, 'extraClass' => 'entry-inner-right'),
			ACHIEVEMENTS_CATEGORY_FEATS => array('count' => 0, 'points' => 0)
		);

		foreach ($achievements_count as $cat_id => &$ach)
		{
			if ($cat_id == 0)
			{
				$ach['completed'] = $this->m_totalCompleted;
				$ach['pointsCompleted'] = $this->m_points;
			}
			else
			{
				$ach['title'] = $this->m_profileMenu[$cat_id]['name'];
				$info = $this->getCompletedCategoryInfo($cat_id);

				if (!$info)
					continue;

				$ach['completed'] = $info['count'];
				$ach['pointsCompleted'] = $info['points'];
			}
			$ach['percent'] = $this->c('Wow')->GetPercent($ach['count'], $ach['completed']);
		}

		return $achievements_count;
	}

	public function getCompletedCategoryInfo($cat_id)
	{
		$categories = array(
			ACHIEVEMENTS_CATEGORY_GENERAL     => array(92),
			ACHIEVEMENTS_CATEGORY_QUESTS      => array(14861, 14862, 14863),
			ACHIEVEMENTS_CATEGORY_EXPLORATION => array(14777, 14778, 14779, 14780),
			ACHIEVEMENTS_CATEGORY_PVP         => array(165, 14801, 14802, 14803, 14804, 14881, 14901, 15003),
			ACHIEVEMENTS_CATEGORY_DUNGEONS    => array(14808, 14805, 14806, 14921, 14922, 14923, 14961, 14962, 15001, 15002, 15041, 15042),
			ACHIEVEMENTS_CATEGORY_PROFESSIONS => array(170, 171, 172),
			ACHIEVEMENTS_CATEGORY_REPUTATION  => array(14864, 14865, 14866),
			ACHIEVEMENTS_CATEGORY_EVENTS      => array(160, 187, 159, 163, 161, 162, 158, 14981, 156, 14941),
			ACHIEVEMENTS_CATEGORY_FEATS       => array(81)
		);

		if (!$cat_id || !isset($categories[$cat_id]))
			return false;

		$count = 0;
		$points = 0;
		foreach ($categories[$cat_id] as $cat)
		{
			if (isset($this->m_wowAchievements[$cat]))
			{
				$count += $this->m_wowAchievements[$cat]['count'];
				$points += $this->m_wowAchievements[$cat]['pointsInCategory'];
			}
		}
		return array('count' => $count, 'points' => $points);
	}

	public function getCategory($cat_id)
	{
		$cat_id = (int) $cat_id;
		$achievements = $this->c('QueryResult', 'Db')
			->model('WowAchievement')
			->fieldCondition('categoryId', ' = ' . $cat_id)
			->fieldCondition('factionFlag', array(($this->c('CharacterProfile')->getFactionId() == FACTION_ALLIANCE ? FACTION_HORDE : FACTION_ALLIANCE), -1))
			->keyIndex('id')
			->loadItems();

		if (!$achievements)
			return false;

		$original = $achievements; // save in memory

		$this->m_achCriterias = $this->c('QueryResult', 'Db')
			->model('WowAchievementCriteria')
			->fieldCondition('referredAchievement', array_keys($achievements))
			->keyIndex('id')
			->loadItems();

		if (!$this->m_achCriterias)
		{
			unset($achievements);
			return false;
		}

		$q = $this->c('QueryResult', 'Db')
			->model('AchievementReward')
			->addModel('ItemTemplate')
			->join('left', 'ItemTemplate', 'AchievementReward', 'item', 'entry');
		if ($this->c('Locale')->GetLocaleID() != LOCALE_EN)
			$q->addModel('LocalesItem')
				->join('left', 'LocalesItem', 'ItemTemplate', 'entry', 'entry')
				->fields(array('AchievementReward' => array('entry', 'item'), 'ItemTemplate' => array('displayid', 'name', 'Quality'), 'LocalesItem' => array('name_loc' . $this->c('Locale')->GetLocaleID())));
		else
			$q->fields(array('AchievementReward' => array('entry', 'item'), 'ItemTemplate' => array('displayid', 'name', 'Quality')));

		$reward_items = $q->fieldCondition('achievement_reward.entry', array_keys($achievements))
			->keyIndex('entry')
			->loadItems();

		if ($reward_items)
		{
			$list_items = array();
			foreach($reward_items as &$item)
				$list_items[] = $item['item'];

			$items_icons = $this->c('QueryResult', 'Db')
				->model('WowIcons')
				->fieldCondition('displayid', $list_items)
				->loadItems();

			if ($items_icons)
			{
				foreach ($items_icons as &$icon)
					$reward_items[$icon['displayid']]['icon'] = $icon['icon'];
			}

			unset($items_icons, $list_items);
		}

		$this->m_achProgress = $this->c('QueryResult', 'Db')
			->model('CharacterAchievementProgress')
			->fieldCondition('criteria', array_keys($this->m_achCriterias))
			->fieldCondition('guid', ' = ' . $this->m_guid)
			->keyIndex('criteria')
			->loadItems();
		
		foreach ($this->m_achCriterias as &$criteria)
			if (isset($this->m_achProgress[$criteria['id']]))
				$criteria = array_merge($criteria, $this->m_achProgress[$criteria['id']]);

		// Do not check $this->m_achProgress because player may have no achievements earned in current category.
		$totalPoints = 0;
		foreach ($achievements as &$achievement)
		{
			$achievement['criterias'] = array();
			if ($achievement['titleReward'] != null && isset($reward_items[$achievement['id']]))
			{
				$rew = explode(':', $achievement['titleReward']);
				$achievement['titleReward'] = $rew[0] . ': <a href="' . $this->getWowUrl('item/' . $reward_items[$achievement['id']]['item']) . '" class="color-q' . $reward_items[$achievement['id']]['Quality'] . '">' . $reward_items[$achievement['id']]['name'] . '</a>';
			}
			$totalPoints += $achievement['points'];
			foreach ($this->m_achCriterias as &$cr)
			{
				if ($cr['referredAchievement'] == $achievement['id'])
					$achievement['criterias'][] = $cr;
			}
			if (isset($this->m_achievements['ids'][$achievement['id']]))
				$achievement['date'] = $this->m_achievements['ids'][$achievement['id']]['date'];
			else
				$achievement['date'] = 0;
		}
		unset($reward_items, $rew);

		$totalCount = 0;
		$completedCount = 0;
		foreach ($achievements as &$ach)
		{
			++$totalCount;
			if ($parent = $ach['parentAchievement'])
			{
				$p = &$achievements[$parent];
				if ($ach['date'])
				{
					++$completedCount;
					$p['parentAchievement'] = 1;
					$ach['points'] += $p['points'];
					foreach ($p['criterias'] as &$p_cr)
					{
						$p_cr['iconname'] = $achievements[$p_cr['referredAchievement']]['iconname'];
						$p_cr['is_ach'] = true;
						$p_cr['ach_id'] = $achievements[$p_cr['referredAchievement']]['id'];
						$p_cr['points'] = $achievements[$p_cr['referredAchievement']]['points'];
					}
					$ach['criterias'] = array_merge($p['criterias'], $ach['criterias']);
					$ach['ach_criterias'] = true;
					foreach ($ach['criterias'] as &$r)
						$r['completionFlag'] = 0;
				}
				if ($p['date'])
					$ach['parentAchievement'] = 0;
			}
		}
		// Final prepares
		$completed = array();
		$incompleted = array();
		$earnedPoints = 0;
		$list_ids = array();
		foreach ($achievements as $a)
		{
			$used = false;
			if ($a['criterias'])
			{
				foreach ($a['criterias'] as $cr_index => &$crit)
					if ($crit['completionFlag'] & ACHIEVEMENT_CRITERIA_FLAG_HIDE_CRITERIA)
						continue;
					elseif ($crit['completionFlag'] & ACHIEVEMENT_CRITERIA_FLAG_SHOW_PROGRESS_BAR)
					{
						if (!isset($crit['counter']))
							$crit['counter'] = 0;

						$crit['percent'] = $this->c('Wow')->GetPercent($crit['value'], $crit['counter']);
						$used = true;
					}
					elseif ($crit['requiredType'] == 8)
					{
						// ACHIEVEMENT_CRITERIA_TYPE_COMPLETE_ACHIEVEMENT
						$id = $crit['data'];
						if (isset($original[$id]))
						{
							$crit['achievementInfo'] = array(
								'id' => $id,
								'name' => $original[$id]['name'],
								'iconname' => $original[$id]['iconname'],
								'categoryId' => $original[$id]['categoryId']
							);
						}
						else
							$list_ids[$id] = array($a['id'], $cr_index);

						$used = true;
					}
					else
						$used = true;
			}
			$a['use_criterias'] = $used;
			if ($a['date'])
			{
				$completed[$a['id']] = $a;
				$earnedPoints += $original[$a['id']]['points'];
			}
			else
				$incompleted[$a['id']] = $a;
		}

		if ($list_ids)
		{
			$extra_ach = $this->c('QueryResult', 'Db')
				->model('WowAchievement')
				->fields(array('WowAchievement' => array('id', 'name_' . $this->c('Locale')->getLocale(), 'iconname', 'categoryId')))
				->fieldCondition('id', array_keys($list_ids))
				->keyIndex('id')
				->loadItems();

			if ($extra_ach)
			{
				foreach ($list_ids as $id => $data)
				{
					if (isset($extra_ach[$id]))
					{
						if (isset($completed[$data[0]]) && isset($completed[$data[0]]['criterias'][$data[1]]))
						{
							$completed[$data[0]]['criterias'][$data[1]]['achievementInfo'] = $extra_ach[$id];
						}
						elseif (isset($incompleted[$data[0]]) && isset($incompleted[$data[0]]['criterias'][$data[1]]))
						{
							$incompleted[$data[0]]['criterias'][$data[1]]['achievementInfo'] = $extra_ach[$id];
						}
					}
				}
			}
			unset($extra_ach, $list_ids);
		}
		$achievements = array_merge($completed, $incompleted);
		unset($completed, $incompleted, $original, $this->m_achCriterias, $this->m_achProgress);

		return array(
			'achievements' => $achievements,
			'completedCount' => $completedCount,
			'total' => $totalCount,
			'points' => $totalPoints,
			'earnedPoints' => $earnedPoints,
			'percent' => $this->c('Wow')->GetPercent($totalCount, $completedCount)
		);
	}

	public function getStatisticCategory($cat_id)
	{
		$achievements = $this->c('QueryResult', 'Db')
			->model('WowAchievement')
			->fieldCondition('categoryId', ' = ' . ((int) $cat_id))
			->keyIndex('id')
			->loadItems();

		if (!$achievements)
			return false;

		$this->m_achCriterias = $this->c('QueryResult', 'Db')
			->model('WowAchievementCriteria')
			->fieldCondition('referredAchievement', array_keys($achievements))
			->fields(array('WowAchievementCriteria' => array('id')))
			->keyIndex('id')
			->loadItems();

		if (!$this->m_achCriterias)
		{
			unset($achievements);
			return false;
		}

		$this->m_achProgress = $this->c('QueryResult', 'Db')
			->model('CharacterAchievementProgress')
			->fieldCondition('guid', ' = ' . $this->m_guid)
			->fieldCondition('criteria', array_keys($this->m_achCriterias))
			->keyIndex('criteria')
			->loadItems();

		foreach ($achievements as &$ach)
		{
			if (!isset($this->m_achCriterias[$ach['id']]))
				$ach['quantity'] = '--';
			elseif (!isset($this->m_achProgress[$this->m_achCriterias[$ach['id']]]))
				$ach['quantity'] = '--';
			else
				$ach['quantity'] = $this->m_achProgress[$this->m_achCriterias[$ach['id']]];
		}
		unset($this->m_achCriterias, $this->m_achProgress);
		return $achievements;
	}

	public function getStatisticSummary()
	{
		$achievements = $this->c('QueryResult', 'Db')
			->model('WowAchievement')
			->fieldCondition('id', array(377, 1198, 338, 529, 931, 588, 378, 339))
			->keyIndex('id')
			->loadItems();

		if (!$achievements)
			return false;

		$this->m_achCriterias = $this->c('QueryResult', 'Db')
			->model('WowAchievementCriteria')
			->fieldCondition('referredAchievement', array_keys($achievements))
			->fields(array('WowAchievementCriteria' => array('id')))
			->keyIndex('id')
			->loadItems();

		if (!$this->m_achCriterias)
		{
			unset($achievements);
			return false;
		}

		$this->m_achProgress = $this->c('QueryResult', 'Db')
			->model('CharacterAchievementProgress')
			->fieldCondition('guid', ' = ' . $this->m_guid)
			->fieldCondition('criteria', array_keys($this->m_achCriterias))
			->keyIndex('criteria')
			->loadItems();

		foreach ($achievements as &$ach)
		{
			if (!isset($this->m_achCriterias[$ach['id']]))
				$ach['quantity'] = '--';
			elseif (!isset($this->m_achProgress[$this->m_achCriterias[$ach['id']]]))
				$ach['quantity'] = '--';
			else
				$ach['quantity'] = $this->m_achProgress[$this->m_achCriterias[$ach['id']]];
		}
		unset($this->m_achCriterias, $this->m_achProgress);
		return $achievements;
	}
}
?>