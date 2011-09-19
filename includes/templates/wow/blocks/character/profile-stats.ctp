<?php $profileType = $character->getProfileType(); ?>
<div class="summary-stats" id="summary-stats">

<?php if ($profileType == 'advanced') : ?>
<div id="summary-stats-advanced" class="summary-stats-advanced">
	<div class="summary-stats-advanced-base">
		<div class="summary-stats-column">
			<h4><?php echo $l->getString('template_profile_stats'); ?></h4>
			<ul>
			<?php
			$appropriate_stats = $character->GetAppropriateStatsForClassAndSpec();
			if ($appropriate_stats) :
				foreach ($appropriate_stats['main'] as $main) :
			?>
				<li data-id="<?php echo $main['name']; ?>" class="">
					<span class="name"><?php echo $l->getString($main['type']); ?></span>
					<span class="value"><?php echo $main['stat']; ?></span>
					<span class="clear"><!-- --></span>
				</li>
			<?php endforeach; endif; ?>
			</ul>
		</div>
	</div>
	<div class="summary-stats-advanced-role">
		<div class="summary-stats-column">
			<h4><?php echo $l->getString('template_character_profile_other_stats'); ?></h4>
			<ul>
			<?php
			if ($appropriate_stats) :
				foreach ($appropriate_stats['advanced'] as $advanced) :
			?>
				<li data-id="<?php echo $advanced['name']; ?>" class="">
					<span class="name"><?php echo $l->getString($advanced['type']); ?></span>
					<span class="value"><?php echo $advanced['stat']; ?></span>
					<span class="clear"><!-- --></span>
				</li>
			<?php endforeach; endif; ?>
			</ul>
		</div>
	</div>
	<div class="summary-stats-end"></div>
</div>
<?php endif; ?>

<div id="summary-stats-simple" class="summary-stats-simple"<?php if ($profileType == 'advanced') echo ' style="display:none;"'; ?>>
	<div class="summary-stats-simple-base">
		<div class="summary-stats-column">
		<?php
		$strength = $character->GetCharacterStrength();
		$agility = $character->GetCharacterAgility();
		$stamina = $character->GetCharacterStamina();
		$intellect = $character->GetCharacterIntellect();
		$spirit = $character->GetCharacterSpirit();
		$melee_stats = $character->GetMeleeStats();
		$ranged_stats = $character->GetRangedStats();
		$spell = $character->GetSpellStats();
		$defense = $character->GetDefenseStats();
		$resistances = $character->GetResistanceStats();
		?>
			<h4><?php echo $l->getString('template_profile_stats'); ?></h4>
			<ul>
				<li data-id="strength" class="">
					<span class="name"><?php echo $l->getString('stat_strength'); ?></span>
					<span class="value<?php if ($strength['effective'] - $strength['base'] > 0) echo ' color-q2'; ?>"><?php echo $strength['effective']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="agility" class="">
					<span class="name"><?php echo $l->getString('stat_agility'); ?></span>
					<span class="value<?php if ($agility['effective'] - $agility['base'] > 0) echo ' color-q2'; ?>"><?php echo $agility['effective']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="stamina" class="">
					<span class="name"><?php echo $l->getString('stat_stamina'); ?></span>
					<span class="value<?php if ($stamina['effective'] - $stamina['base'] > 0) echo ' color-q2'; ?>"><?php echo $stamina['effective']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="intellect" class="">
					<span class="name"><?php echo $l->getString('stat_intellect'); ?></span>
					<span class="value<?php if ($intellect['effective'] - $intellect['base'] > 0) echo ' color-q2'; ?>"><?php echo $intellect['effective']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="spirit" class="">
					<span class="name"><?php echo $l->getString('stat_spirit'); ?></span>
					<span class="value<?php if ($spirit['effective'] - $spirit['base'] > 0) echo ' color-q2'; ?>"><?php echo $spirit['effective']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="mastery" class="">
					<span class="name"><?php echo $l->getString('stat_mastery'); ?></span>
					<span class="value">0,0</span>
				<span class="clear"><!-- --></span>
				</li>
			</ul>
		</div>
	</div>
	<div class="summary-stats-simple-other">
		<a id="summary-stats-simple-arrow" class="summary-stats-simple-arrow" href="javascript:;"></a>
		<div class="summary-stats-column" style="<?php echo $character->GetRole() != ROLE_MELEE ? 'display: none;' : null; ?>">
			<h4><?php echo $l->getString('template_profile_melee_stats'); ?></h4>
			<ul>
				<li data-id="meleedamage" class="">
					<span class="name"><?php echo $l->getString('stat_damage'); ?></span>
					<span class="value"><?php echo sprintf('%d - %d', $melee_stats['damage']['min'], $melee_stats['damage']['max']); ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="meleedps" class="">
					<span class="name"><?php echo $l->getString('stat_dps'); ?></span>
					<span class="value"><?php echo $melee_stats['damage']['dps']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="meleeattackpower" class="">
					<span class="name"><?php echo $l->getString('stat_attack_power'); ?></span>
					<span class="value"><?php echo $melee_stats['attack_power']['effective']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="meleespeed" class="">
					<span class="name"><?php echo $l->getString('stat_haste'); ?></span>
					<span class="value"><?php echo $melee_stats['haste_rating']['value']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="meleehaste" class="">
					<span class="name"><?php echo $l->getString('stat_haste_rating'); ?></span>
					<span class="value"><?php echo $melee_stats['haste_rating']['hastePercent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="meleehit" class="">
					<span class="name"><?php echo $l->getString('stat_hit'); ?></span>
					<span class="value">+<?php echo $melee_stats['hit_rating']['increasedHitPercent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="meleecrit" class="">
					<span class="name"><?php echo $l->getString('stat_crit'); ?></span>
					<span class="value"><?php echo $melee_stats['crit_rating']['percent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="expertise" class="">
					<span class="name"><?php echo $l->getString('stat_expertise'); ?></span>
					<span class="value"><?php echo $melee_stats['expertise_rating']['value']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
			</ul>
		</div>
		
		<div class="summary-stats-column" style="<?php echo $character->GetRole() != ROLE_RANGED ? 'display: none;' : null; ?>">
			<h4><?php echo $l->getString('template_profile_ranged_stats'); ?></h4>
			<ul>
				<li data-id="rangeddamage" class="">
					<span class="name"><?php echo $l->getString('stat_damage'); ?></span>
					<span class="value"><?php echo sprintf('%s - %d', $ranged_stats['damage']['min'], $ranged_stats['damage']['max']); ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="rangeddps" class="">
					<span class="name"><?php echo $l->getString('stat_dps'); ?></span>
					<span class="value"><?php echo $ranged_stats['damage']['dps']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="rangedattackpower" class="">
					<span class="name"><?php echo $l->getString('stat_attack_power'); ?></span>
					<span class="value"><?php echo $ranged_stats['attack_power']['effective']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="rangedspeed" class="">
					<span class="name"><?php echo $l->getString('stat_haste'); ?></span>
					<span class="value"><?php echo $ranged_stats['haste_rating']['value']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="rangedhaste" class="">
					<span class="name"><?php echo $l->getString('stat_haste_rating'); ?></span>
					<span class="value"><?php echo $ranged_stats['haste_rating']['hastePercent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="rangedhit" class="">
					<span class="name"><?php echo $l->getString('stat_hit'); ?></span>
					<span class="value">+<?php echo $melee_stats['hit_rating']['increasedHitPercent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="rangedcrit" class="">
					<span class="name"><?php echo $l->getString('stat_crit'); ?></span>
					<span class="value"><?php echo $melee_stats['crit_rating']['percent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
			</ul>
		</div>

		<div class="summary-stats-column" style="<?php echo ($character->GetRole() != ROLE_CASTER && $character->GetRole() != ROLE_HEALER) ? 'display: none;' : null; ?>">
			<h4><?php echo $l->getString('template_profile_spell_stats'); ?></h4>
			<ul>
				<li data-id="spellpower" class="">
					<span class="name"><?php echo $l->getString('stat_spell_power'); ?></span>
					<span class="value"><?php echo $spell['power']['value']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="spellhaste" class="">
					<span class="name"><?php echo $l->getString('stat_spell_haste'); ?></span>
					<span class="value"><?php echo $spell['haste_rating']['hastePercent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="spellhit" class="">
					<span class="name"><?php echo $l->getString('stat_hit'); ?></span>
					<span class="value">+<?php echo $spell['hit_rating']['increasedHitPercent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="spellcrit" class="">
					<span class="name"><?php echo $l->getString('stat_crit'); ?></span>
					<span class="value"><?php echo $spell['crit_rating']['value']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="spellpenetration" class="">
					<span class="name"><?php echo $l->getString('stat_spell_penetration'); ?></span>
					<span class="value"><?php echo $spell['hit_rating']['penetration']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="manaregen" class="">
					<span class="name"><?php echo $l->getString('stat_mana_regen'); ?></span>
					<span class="value"><?php echo $spell['mana_regen']['notCasting']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="combatregen" class="">
					<span class="name"><?php echo $l->getString('stat_combat_regen'); ?></span>
					<span class="value"><?php echo $spell['mana_regen']['casting']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
			</ul>
		</div>

		<div class="summary-stats-column" style="<?php echo $character->GetRole() != ROLE_TANK ? 'display: none' : null; ?>">
			<h4><?php echo $l->getString('template_profile_defense_stats'); ?></h4>
			<ul>
				<li data-id="armor" class="">
					<span class="name"><?php echo $l->getString('stat_armor'); ?></span>
					<span class="value"><?php echo $defense['armor']['effective']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="dodge" class="">
					<span class="name"><?php echo $l->getString('stat_dodge'); ?></span>
					<span class="value"><?php echo $defense['dodge']['percent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="parry" class="">
					<span class="name"><?php echo $l->getString('stat_parry'); ?></span>
					<span class="value"><?php echo $defense['parry']['percent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="block" class="">
					<span class="name"><?php echo $l->getString('stat_block'); ?></span>
					<span class="value"><?php echo $defense['block']['percent']; ?>%</span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="resilience" class="">
					<span class="name"><?php echo $l->getString('stat_resilience'); ?></span>
					<span class="value"><?php echo $defense['resilience']['value']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
			</ul>
		</div>

		<div class="summary-stats-column" style="display: none">
			<h4><?php echo $l->getString('template_profile_resistances_stats'); ?></h4>
			<ul>
				<li data-id="arcaneres" class=" has-icon">
						<span class="icon"> 
					<span class="icon-frame frame-12">
						<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_arcane.jpg" alt="" width="12" height="12" />
					</span>
			</span>
					<span class="name"><?php echo $l->getString('stat_resistance_arcane'); ?></span>
					<span class="value"><?php echo $resistances['resistance']['arcane']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="fireres" class=" has-icon">
						<span class="icon"> 
					<span class="icon-frame frame-12">
						<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_fire.jpg" alt="" width="12" height="12" />
					</span>
			</span>
					<span class="name"><?php echo $l->getString('stat_resistance_fire'); ?></span>
					<span class="value"><?php echo $resistances['resistance']['fire']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="frostres" class=" has-icon">
						<span class="icon"> 
					<span class="icon-frame frame-12">
						<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_frost.jpg" alt="" width="12" height="12" />
					</span>
			</span>
					<span class="name"><?php echo $l->getString('stat_resistance_frost'); ?></span>
					<span class="value"><?php echo $resistances['resistance']['frost']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="natureres" class=" has-icon">
						<span class="icon">
					<span class="icon-frame frame-12">
						<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_nature.jpg" alt="" width="12" height="12" />
					</span>
			</span>
					<span class="name"><?php echo $l->getString('stat_resistance_nature'); ?></span>
					<span class="value"><?php echo $resistances['resistance']['nature']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
				<li data-id="shadowres" class=" has-icon">
						<span class="icon">
					<span class="icon-frame frame-12">
						<img src="http://eu.battle.net/wow-assets/static/images/icons/18/resist_shadow.jpg" alt="" width="12" height="12" />
					</span>
			</span>
					<span class="name"><?php echo $l->getString('stat_resistance_shadow'); ?></span>
					<span class="value"><?php echo $resistances['resistance']['shadow']; ?></span>
				<span class="clear"><!-- --></span>
				</li>
			</ul>
		</div>

	</div>
	<div class="summary-stats-end"></div>
</div>
<?php if ($profileType == 'advanced') : ?>
<a href="javascript:;" id="summary-stats-toggler" class="summary-stats-toggler"><span class="inner"><span class="arrow"><?php echo $l->getString('template_character_profile_toggle_stats_all'); ?></span></span></a>
<?php endif; ?>
</div>
    <script type="text/javascript">
	//<![CDATA[
		$(document).ready(function() {
			new Summary.Stats({

			"health": <?php echo $character->getField('health'); ?>,
			"power": <?php echo $character->getField('powerValue'); ?>,
			"powerTypeId": <?php echo $character->getPowerType(); ?>,
			"hasOffhandWeapon": false,
			"masteryName": "",
			"masteryDescription": "",
			"averageItemLevelEquipped": <?php echo $character->getField('avgILvlEquipped'); ?>,
			"averageItemLevelBest": <?php echo $character->getField('avgILvl'); ?>,
			"dmgMainMax": <?php echo $melee_stats['damage']['max']; ?>,
			"dmgMainMin": <?php echo $melee_stats['damage']['min']; ?>,
			"resilience_crit": -1,
			"holyResist": 0,
			"spellHitRating": <?php echo $spell['hit_rating']['value']; ?>,
			"agiBase": <?php echo $agility['base']; ?>,
			"rangeAtkPowerBase": <?php echo $ranged_stats['attack_power']['effective']; ?>,
			"expertiseOffPercent": <?php echo $melee_stats['expertise_rating']['percent']; ?>,
			"critPercent": <?php echo $melee_stats['crit_rating']['percent']; ?>,
			"dmgOffMin": 0,
			"spellDmg_petAp": -1,
			"agi_armor": <?php echo $agility['armor']; ?>,
			"rangeCritPercent": <?php echo $melee_stats['crit_rating']['percent']; // they are the same. ?>,
			"resistHoly_pet": -1,
			"dodgeRatingPercent": <?php echo $defense['dodge']['increasePercent']; ?>,
			"parryRating": <?php echo $defense['parry']['rating']; ?>,
			"parry": <?php echo $defense['parry']['percent']; ?>,
			"rangeBonusWeaponRating": 0,
			"atkPowerBase": <?php echo $melee_stats['attack_power']['base']; ?>,
			"str_ap": <?php echo $strength['attack']; ?>,
			"hitRating": <?php echo $melee_stats['hit_rating']['value']; ?>,
			"block_damage": <?php echo $defense['block']['percent']; ?>,
			"dmgOffMax": 0,
			"masteryRating": 0,
			"spellCritRating": <?php echo $spell['crit_rating']['rating']; ?>,
			"bonusOffWeaponRating": 0,
			"resilience_damage": <?php echo $defense['resilience']['damagePercent']; ?>,
			"resilience": <?php echo $defense['resilience']['value']; ?>,
			"masteryRatingBonus": 0,
			"expertiseOff": 0,
			"dmgMainSpeed": <?php echo $melee_stats['damage']['haste']; ?>,
			"rangeAtkPowerBonus": 0,
			"expertiseMain": 0,
			"shadowDamage": <?php echo $spell['power']['value']; ?>,
			"defensePercent": 0,
			"rangeHitRating": <?php echo $melee_stats['hit_rating']['value']; ?>,
			"blockRating": <?php echo $defense['block']['rating']; ?>,
			"spellDmg_petSpellDmg": -1,
			"shadowResist": <?php echo $resistances['resistance']['shadow']; ?>,
			"armor_petArmor": -1,
			"block": <?php echo $defense['block']['percent']; ?>,
			"dmgOffDps": 0,
			"resistNature_pet": -1,
			"dmgRangeMax": <?php echo $ranged_stats['damage']['max']; ?>,
			"armorPercent": <?php echo $defense['armor']['reductionPercent']; ?>,
			"resistArcane_pet": -1,
			"dmgMainDps": <?php echo $melee_stats['damage']['dps']; ?>,
			"spellHitRatingPercent": <?php echo $spell['hit_rating']['increasedHitPercent']; ?>,
			"healing": <?php echo $spell['power']['value']; ?>,
			"manaRegenPerFive": <?php echo $spell['mana_regen']['notCasting']; ?>,
			"str_block": <?php echo $strength['block']; ?>,
			"rangeAtkPowerLoss": 0,
			"dmgRangeDps": <?php echo $ranged_stats['damage']['dps']; ?>,
			"frostCrit": <?php echo $spell['crit_rating']['rating']; ?>,
			"armorPenetrationPercent": 0,
			"rangeCritRating": <?php echo $melee_stats['crit_rating']['value']; ?>,
			"fireDamage": <?php echo $spell['power']['value']; ?>,
			"resistShadow_pet": -1,
			"shadowCrit": <?php echo $spell['crit_rating']['rating']; ?>,
			"hasteRating": <?php echo $melee_stats['haste_rating']['hasteRating']; ?>,
			"rangeHitRatingPercent": <?php echo $melee_stats['hit_rating']['increasedHitPercent']; // they are the same ?>,
			"natureResist": <?php echo $resistances['resistance']['nature']; ?>,
			"arcaneDamage": <?php echo $spell['power']['value']; ?>,
			"intTotal": <?php echo $intellect['effective']; ?>,
			"expertiseRating": 0,
			"bonusOffMainWeaponSkill": 0,
			"expertiseMainPercent": <?php echo $melee_stats['expertise_rating']['percent']; ?>,
			"agiTotal": <?php echo $agility['effective']; ?>,
			"frostResist": <?php echo $resistances['resistance']['frost']; ?>,
			"int_mp": <?php echo $intellect['mana']; ?>,
			"arcaneCrit": <?php echo $spell['crit_rating']['rating']; ?>,
			"ap_dps": <?php echo $melee_stats['attack_power']['increasedDps']; ?>,
			"holyCrit": <?php echo $spell['crit_rating']['rating']; ?>,
			"atkPowerLoss": 0,
			"staBase": <?php echo $stamina['base']; ?>,
			"bonusMainWeaponSkill": 0,
			"fireResist": <?php echo $resistances['resistance']['fire']; ?>,
			"blockRatingPercent": <?php echo $defense['block']['increasePercent']; ?>,
			"natureCrit": <?php echo $spell['crit_rating']['rating']; ?>,
			"hitRatingPercent": <?php echo $melee_stats['hit_rating']['increasedHitPercent']; ?>,
			"sprBase": <?php echo $spirit['base']; ?>,
			"agi_ap": <?php echo $agility['attack']; ?>,
			"dodge": <?php echo $defense['dodge']['percent']; ?>,
			"atkPowerBonus": 0,
			"int_crit": <?php echo $intellect['hitCritPercent']; ?>,
			"rap_petSpellDmg": -1,
			"spr_regen": <?php echo $spirit['manaRegen']; ?>,
			"mastery": 0,
			"expertiseRatingPercent": 0,
			"arcaneResist": <?php echo $resistances['resistance']['arcane']; ?>,
			"sprTotal": <?php echo $spirit['effective']; ?>,
			"manaRegenCombat": <?php echo $spell['mana_regen']['casting']; ?>,
			"rangeCritRatingPercent": <?php echo $melee_stats['crit_rating']['percent']; ?>,
			"resistFrost_pet": -1,
			"dmgRangeSpeed": <?php echo $ranged_stats['damage']['haste']; ?>,
			"dodgeRating": <?php echo $defense['dodge']['rating']; ?>,
			"bonusMainWeaponRating": 0,
			"intBase": <?php echo $intellect['base']; ?>,
			"hasteRatingPercent": <?php echo $melee_stats['haste_rating']['hastePercent']; ?>,
			"frostDamage": <?php echo $spell['power']['value']; ?>,
			"agi_crit": <?php echo $agility['hitCritPercent']; ?>,
			"sta_hp": <?php echo $stamina['health']; ?>,
			"strBase": <?php echo $strength['base']; ?>,
			"armorTotal": <?php echo $defense['armor']['effective']; ?>,
			"critRatingPercent": <?php echo $melee_stats['crit_rating']['percent']; ?>,
			"rangeHasteRatingPercent": <?php echo $melee_stats['haste_rating']['hastePercent']; ?>,
			"rangeBonusWeaponSkill": 0,
			"sta_petSta": <?php echo $stamina['petBonus']; ?>,
			"spellCritRatingPercent": <?php echo $spell['crit_rating']['value']; ?>,
			"dmgRangeMin": <?php echo $ranged_stats['damage']['min']; ?>,
			"rangeHasteRating": <?php echo $melee_stats['haste_rating']['value']; ?>,
			"armorBase": <?php echo $defense['armor']['base']; ?>,
			"critRating": <?php echo $melee_stats['crit_rating']['value']; ?>,
			"spellCritPercent": <?php echo $spell['crit_rating']['value']; ?>,
			"armorPenetration": 0,
			"dmgOffSpeed": 0,
			"resistFire_pet": -1,
			"defense": 0,
			"spellPenetration": <?php echo $spell['hit_rating']['penetration']; ?>,
			"strTotal": <?php echo $strength['effective']; ?>,
			"parryRatingPercent": <?php echo $defense['parry']['increasePercent']; ?>,
			"staTotal": <?php echo $stamina['effective']; ?>,
			"rap_petAp": -1,
			"fireCrit": <?php echo $spell['crit_rating']['rating']; ?>,
			"natureDamage": <?php echo $spell['power']['value']; ?>,
			"holyDamage": <?php echo $spell['power']['value']; ?>,
            "foo": true
		});
	});
	//]]>
	</script>
