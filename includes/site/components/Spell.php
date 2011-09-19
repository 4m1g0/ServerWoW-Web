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

class Spell_Component extends Component
{
	public function getSpellDescription(&$spell, $return = true)
	{
		if ($return)
			return $this->SpellReplace($spell, $this->ValidateSpellText($spell['Description']));
		else
			$spell['Description'] = $this->SpellReplace($spell, $this->ValidateSpellText($spell['Description']));
	}

	/**
	 * Spell Description handler
	 * @author   DiSlord aka Chestr
	 * @category Items class
	 * @access   public
	 * @param	array $spell
	 * @param	string $text
	 * @return   array
	 **/
	public function SpellReplace(&$spell, $text)
	{
		$letter = array('${','}');
		$values = array( '[',']');
		$text = str_replace($letter, $values, $text);
		$signs = array('+', '-', '/', '*', '%', '^');
		$data = $text;
		$pos = 0;
		$npos = 0;
		$str = null;
		$cacheSpellData=array(); // Spell data for spell
		$lastCount = 1;
		while(false !== ($npos = strpos($data, '$', $pos))) {
			if($npos != $pos) {
				$str .= substr($data, $pos, $npos-$pos);
			}
			$pos = $npos + 1;
			if('$' == substr($data, $pos, 1)) {
				$str .= '$';
				$pos++;
				continue;
			}
			if(!preg_match('/^((([+\-\/*])(\d+);)?(\d*)(?:([lg].*?:.*?);|(\w\d*)))/', substr($data, $pos), $result)) {
				continue;
			}
			$pos += strlen($result[0]);
			$op = $result[3];
			$oparg = $result[4];
			$lookup = $result[5]? $result[5]:$spell['id'];
			$var = $result[6] ? $result[6]:$result[7];
			if(!$var) {
				continue;
			}
			if($var[0] == 'l') {
				$select = explode(':', substr($var, 1));
				$str .= @$select[$lastCount == 1 ? 0 : 1];
			}
			elseif($var[0] == 'g') {
				$select = explode(':', substr($var, 1));
				$str .= $select[0];
			}
			else {
				$spellData = @$cacheSpellData[$lookup];
				if($spellData == 0) {
					if($lookup == $spell['id']) {
						$cacheSpellData[$lookup] = $this->GetSpellData($spell);
					}
					else {
						$tmp = $this->c('QueryResult', 'Db')
							->model('WowSpell')
							->fieldCondition('id', ' = ' . $lookup)
							->loadItem();

						$cacheSpellData[$lookup] = $this->GetSpellData($tmp);
					}
					$spellData = @$cacheSpellData[$lookup];
				}
				if($spellData && $base = @$spellData[strtolower($var)]) {
					if($op && is_numeric($oparg) && is_numeric($base)) {
						 $equation = $base.$op.$oparg;
						 @eval("\$base = $equation;");
					}
					if(is_numeric($base)) {
						$lastCount = $base;
					}
				}
				else {
					$base = $var;
				}
				$str .= $base;
			}
		}
		$str .= substr($data, $pos);
		$str = @preg_replace_callback("/\[.+[+\-\/*\d]\]/", array($this, 'MyReplace'), $str);
		return $str;
	}
	
	/**
	 * Spell Description handler
	 * @author   DiSlord aka Chestr
	 * @category Items class
	 * @access   public
	 * @param	array $spell
	 * @return   array
	 **/
	public function GetSpellData(&$spell) {
		// Basepoints
		$s1 = abs($spell['EffectBasePoints_1'] + 1 + $spell['EffectBaseDice_1']);
		$s2 = abs($spell['EffectBasePoints_2'] + 1 + $spell['EffectBaseDice_2']);
		$s3 = abs($spell['EffectBasePoints_3'] + 1 + $spell['EffectBaseDice_3']);

		if ($spell['EffectDieSides_1']>$spell['EffectBaseDice_1'] && ($spell['EffectDieSides_1']-$spell['EffectBaseDice_1'] != 1)) {
			$s1 .= ' - ' . abs($spell['EffectBasePoints_1'] + $spell['EffectDieSides_1']);
		}
		if ($spell['EffectDieSides_2']>$spell['EffectBaseDice_2'] && ($spell['EffectDieSides_2']-$spell['EffectBaseDice_2'] != 1)) {
			$s2 .= ' - ' . abs($spell['EffectBasePoints_2'] + $spell['EffectDieSides_2']);
		}
		if ($spell['EffectDieSides_3']>$spell['EffectBaseDice_3'] && ($spell['EffectDieSides_3']-$spell['EffectBaseDice_3'] != 1)) {
			$s3 .= ' - ' . abs($spell['EffectBasePoints_3'] + $spell['EffectDieSides_3']);
		}

		$d = 0;
		if ($spell['DurationIndex'])
		{
			$spell_duration = $this->c('QueryResult', 'Db')
				->model('WowSpellDuration')
				->setItemId($spell['DurationIndex'])
				->loadItem();

			if ($spell_duration)
				$d = $spell_duration['duration_1'] / 1000;
		}
		// Tick duration
		$t1 = $spell['EffectAmplitude_1'] ? $spell['EffectAmplitude_1'] / 1000 : 5;
		$t2 = $spell['EffectAmplitude_1'] ? $spell['EffectAmplitude_2'] / 1000 : 5;
		$t3 = $spell['EffectAmplitude_1'] ? $spell['EffectAmplitude_3'] / 1000 : 5;

		if ($t1 == 0)	 $t1 = 1;
		if ($t2 == 0)	 $t2 = 1;
		if ($t3 == 0)	 $t3 = 1;
		
		// Points per tick
		$o1 = (int)($s1 * $d / $t1);
		$o2 = (int)($s2 * $d / $t2);
		$o3 = (int)($s3 * $d / $t3);
		$spellData['t1'] = $t1;
		$spellData['t2'] = $t2;
		$spellData['t3'] = $t3;
		$spellData['o1'] = $o1;
		$spellData['o2'] = $o2;
		$spellData['o3'] = $o3;
		$spellData['s1'] = $s1;
		$spellData['s2'] = $s2;
		$spellData['s3'] = $s3;
		$spellData['m1'] = $s1;
		$spellData['m2'] = $s2;
		$spellData['m3'] = $s3;
		$spellData['x1'] = $spell['EffectChainTarget_1'];
		$spellData['x2'] = $spell['EffectChainTarget_2'];
		$spellData['x3'] = $spell['EffectChainTarget_3'];
		$spellData['i']  = $spell['MaxAffectedTargets'];
		$spellData['d']  = $this->GetTimeText($d);
		$spellData['d1'] = $this->GetTimeText($d);
		$spellData['d2'] = $this->GetTimeText($d);
		$spellData['d3'] = $this->GetTimeText($d);
		$spellData['v']  = $spell['MaxTargetLevel'];
		$spellData['u']  = $spell['StackAmount'];
		$spellData['a1'] = $this->GetRadius($spell['EffectRadiusIndex_1']);
		$spellData['a2'] = $this->GetRadius($spell['EffectRadiusIndex_2']);
		$spellData['a3'] = $this->GetRadius($spell['EffectRadiusIndex_3']);
		$spellData['b1'] = $spell['EffectPointsPerComboPoint_1'];
		$spellData['b2'] = $spell['EffectPointsPerComboPoint_2'];
		$spellData['b3'] = $spell['EffectPointsPerComboPoint_3'];
		$spellData['e']  = $spell['EffectMultipleValue_1'];
		$spellData['e1'] = $spell['EffectMultipleValue_1'];
		$spellData['e2'] = $spell['EffectMultipleValue_2'];
		$spellData['e3'] = $spell['EffectMultipleValue_3'];
		$spellData['f1'] = $spell['DmgMultiplier_1'];
		$spellData['f2'] = $spell['DmgMultiplier_2'];
		$spellData['f3'] = $spell['DmgMultiplier_3'];
		$spellData['q1'] = $spell['EffectMiscValue_1'];
		$spellData['q2'] = $spell['EffectMiscValue_2'];
		$spellData['q3'] = $spell['EffectMiscValue_3'];
		$spellData['h']  = $spell['procChance'];
		$spellData['n']  = $spell['procCharges'];
		$spellData['z']  = '<home>';
		return $spellData;
	}
	
	/**
	 * Replaces square brackets with NULL text
	 * @author   DiSlord aka Chestr
	 * @category Items class
	 * @access   public
	 * @param	array $matches
	 * @return   int
	 **/
	public function MyReplace($matches)
	{
		$text = str_replace( array('[' ,']'), '', $matches[0]);
		//@eval("\$text = abs(".$text.");");
		return intval($text);
	}



	public function ValidateSpellText($text)
	{
		return str_replace(array('\'', '"', '<','>', '>', "\r", NL, NL, NL), array('`', '&quot;', '&lt;', '&gt;', '&gt;', '', '<br>', '<br />', '<br/>'), $text);
	}

	/**
	 * Converts seconds to day/hour/minutes format.
	 * @category Utils class
	 * @access   public
	 * @param	 int $seconds
	 * @return   string
	 **/
	public function GetTimeText($seconds)
	{
		$strings_array = array(
			'en' => array(
				'days', 'hours', 'min', 'sec'
			),
			'ru' => array(
				'дней', 'часов', 'мин', 'сек'
			)
		);

		if (in_array($this->c('Locale')->getLocale(), array('ru', 'en')))
			$preferLocale = $strings_array[$this->c('Locale')->getLocale()];
		else
			$preferLocale = $strings_array['en'];

		$text = '';

		if ($seconds >= 24 * 3600) {
			$text .= intval($seconds / (24 * 3600)) . ' ' . $preferLocale[0];
			if ($seconds %= 24 * 3600)
				$text .= ' ';
		}

		if ($seconds >= 3600) {
			$text .= intval($seconds / 3600) . ' ' . $preferLocale[1];
			if ($seconds %= 3600)
				$text .= ' ';
		}

		if ($seconds >= 60) {
			$text .= intval($seconds / 60) . ' ' . $preferLocale[2];
			if ($seconds %= 60)
				$text .= ' ';
		}

		if ($seconds > 0)
			$text .= $seconds . ' ' .  $preferLocale[3];

		return $text;
	}
	
	/**
	 * Returns spell radius.
	 * @category Utils class
	 * @access   public
	 * @param	 int $index
	 * @return   string
	 **/
	public function GetRadius($index)
	{
		$gSpellRadiusIndex = array(
			 '7' => array(2,0,2),
			 '8' => array(5,0,5),
			 '9' => array(20,0,20),
			'10' => array(30,0,30),
			'11' => array(45,0,45),
			'12' => array(100,0,100),
			'13' => array(10,0,10),
			'14' => array(8,0,8),
			'15' => array(3,0,3),
			'16' => array(1,0,1),
			'17' => array(13,0,13),
			'18' => array(15,0,15),
			'19' => array(18,0,18),
			'20' => array(25,0,25),
			'21' => array(35,0,35),
			'22' => array(200,0,200),
			'23' => array(40,0,40),
			'24' => array(65,0,65),
			'25' => array(70,0,70),
			'26' => array(4,0,4),
			'27' => array(50,0,50),
			'28' => array(50000,0,50000),
			'29' => array(6,0,6),
			'30' => array(500,0,500),
			'31' => array(80,0,80),
			'32' => array(12,0,12),
			'33' => array(99,0,99),
			'35' => array(55,0,55),
			'36' => array(0,0,0),
			'37' => array(7,0,7),
			'38' => array(21,0,21),
			'39' => array(34,0,34),
			'40' => array(9,0,9),
			'41' => array(150,0,150),
			'42' => array(11,0,11),
			'43' => array(16,0,16),
			'44' => array(0.5,0,0.5),
			'45' => array(10,0,10),
			'46' => array(5,0,10),
			'47' => array(15,0,15),
			'48' => array(60,0,60),
			'49' => array(90,0,90)
		);

		if (!isset($gSpellRadiusIndex[$index]))
			return false;

		$radius = @$gSpellRadiusIndex[$index];
		if ($radius == 0)
			return false;

		if ($radius[0] == 0 || $radius[0] == $radius[2])
			return $radius[2];

		return $radius[0] . ' - ' . $radius[2];
	}
	// End of CSWOWD functions

	public function getSpell($id)
	{
		$id = (int) $id;

		if (!$id)
			return false;

		$spell = $this->c('QueryResult', 'Db')
			->model('WowSpell')
			->addModel('WowSpellIcon')
			->join('left', 'WowSpellIcon', 'WowSpell', 'SpellIconID', 'id')
			->setItemId($id)
			->loadItem();

		if (!$spell)
			return false;

		$this->getSpellDescription($spell, false);

		return $spell;
	}

	public function getSpellIcon(&$iconInfo)
	{
		if (is_array($iconInfo) && isset($iconInfo['SpellIconID']))
			$icon = $iconInfo['SpellIconID'];
		else
			$icon = $iconInfo;

		return $this->c('QueryResult', 'Db')
			->model('WowSpellIcon')
			->setItemId($icon)
			->loadItem();
	}
}
?>