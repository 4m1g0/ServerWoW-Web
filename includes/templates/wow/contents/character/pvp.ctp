		<div class="profile-section-header">
				<h3 class="category ">PvP</h3>

		</div>

		<div class="profile-section">
		<?php
		$teams = $character->getTeams();
		if ($teams) :
		?>
			<div class="pvp-weekly-best">
				<?php echo $l->getString('template_character_pvp_personal_rank_best'); ?>
				<span class="rating"><?php echo $teams['maxRating']['rating']; ?></span>
				(<?php echo $l->format('template_team_type_format', $teams['maxRating']['type'], $teams['maxRating']['type']); ?>)
			</div>
		<?php endif; ?>

			<div id="pvp-tabs" class="pvp-tabs">
			<?php
			if ($teams) : 
				$types = array(2, 3, 5);
				foreach ($types as $type) :
					if (!isset($teams['teams'][$type]))
						continue;
					$team = $teams['teams'][$type];
					$format = $team['type'] . 'v' . $team['type'];
			?>
		<div class="tab" id="pvp-tab-<?php echo $format; ?>" data-id="<?php echo $format; ?>">
			<span class="type"><?php echo $l->format('template_team_type_format', $team['type'], $team['type']); ?></span>

			<div class="arenateam-flag-simple">
		<canvas id="arenateam-flag-simple-<?php echo $format; ?>" width="128" height="128">
			<div class="arenateam-flag-simple-default" ></div>
		</canvas>
        <script type="text/javascript">
        //<![CDATA[
			$(document).ready(function() {
				var flag = new ArenaFlag('arenateam-flag-simple-<?php echo $format; ?>', {
					'bg': [ 2, 'ffe80da6' ],
					'border': [ 26, 'ff9c2e8c' ],
					'emblem': [ 59, 'ff459194' ]
				}, true);
			});
        //]]>
        </script>
			</div>

			<ul class="ratings">
				<li>
					<span class="rank">
							#<?php echo $team['rank']; ?>
					</span>
				</li>
				<li>
					<span class="value"><?php echo $team['rating']; ?></span>
					<span class="name"><?php echo $l->getString('template_character_team_name'); ?></span>
				</li>
				<li class="highest">
					<span class="value"><?php echo $team['personalRating']; ?></span>
					<span class="name"><?php echo $l->getString('template_character_personal_rating'); ?></span>
				</li>
			</ul>
		</div>
		<?php endforeach; endif; ?>

	<span class="clear"><!-- --></span>
			</div>

			<div id="pvp-tabs-content" class="pvp-tabs-content">

	<?php
	if ($teams) :
		foreach ($types as $type) :
			if (!isset($teams['teams'][$type]))
				continue;
			$team = $teams['teams'][$type];
			$format = $team['type'] . 'v' . $team['type'];
	?>
	<div class="tab-content" id="pvp-tab-content-<?php echo $format; ?>" style="display: none">
	<div class="arenateam-stats">
		<table>
			<thead>
				<tr>
					<th class="align-left">	<span class="sort-tab"><a class="team-name" href="<?php echo $this->getWowUrl('arena/' . $character->getRealmName() . '/' . $format . '/' . $team['name'] . '/'); ?>"><?php echo $team['name']; ?></a></span>
</th>
					<th width="23%" class="align-center">	<span class="sort-tab"><?php echo $l->getString('template_character_pvp_games'); ?></span>
</th>
					<th width="23%" class="align-center">	<span class="sort-tab"><?php echo $l->getString('template_character_pvp_lost_won'); ?></span>
</th>
					<th width="23%" class="align-center">	<span class="sort-tab"><?php echo $l->getString('template_character_team_rating'); ?></span>
</th>
				</tr>
			</thead>
			<tbody>
	
	<tr class="row2">
		<td class="align-left">
			<strong class="week"><?php echo $l->getString('template_character_team_this_week'); ?></strong>
		</td>
		<td class="align-center"><?php echo $team['weekGames']; ?></td>
		<td class="align-center arenateam-gameswonlost">
			<span class="arenateam-gameswon"><?php echo $team['weekWins']; ?></span> &#8211; <span class="arenateam-gameslost"><?php echo $team['weekGames'] - $team['weekWins']; ?></span>
			<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($team['weekGames'], $team['weekWins'])); ?>%)</span>
		</td>
		<td class="align-center">
				<span class="arenateam-rating"><?php echo $team['rating']; ?></span>
		</td>
	</tr>
	
	<tr class="row1">
		<td class="align-left">
			<strong class="season"><?php echo $l->getString('template_character_team_this_season'); ?></strong>
		</td>
		<td class="align-center"><?php echo $team['seasonGames']; ?></td>
		<td class="align-center arenateam-gameswonlost">
			<span class="arenateam-gameswon"><?php echo $team['seasonWins']; ?></span> &#8211; <span class="arenateam-gameslost"><?php echo $team['seasonGames'] - $team['seasonWins']; ?></span>
			<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($team['seasonGames'], $team['seasonWins'])); ?>%)</span>
		</td>
		<td class="align-center">
				<span class="arenateam-rating"><?php echo $team['rating']; ?></span>
		</td>
	</tr>
			</tbody>
		</table>
	</div>
	<span class="clear"><!-- --></span>

		<div class="pvp-roster">
			<div class="ui-dropdown" id="filter-timeframe-<?php echo $format; ?>">
				<select>
					<option value="season"><?php echo $l->getString('template_character_team_per_season'); ?></option>
					<option value="weekly"><?php echo $l->getString('template_character_team_per_week'); ?></option>
				</select>
		</div>

				<h3 class="category "><?php echo $l->getString('template_character_pvp_roster'); ?></h3>


	<div class="arenateam-roster table" id="arena-roster-<?php echo $format; ?>">
		<table>
			<thead>
				<tr>
					<th>	<a href="javascript:;" class="sort-link">
		<span class="arrow"><?php echo $l->getString('template_character_pvp_name_roster'); ?></span>
	</a>
</th>
					<th style="display: none" class="align-center season">	<a href="javascript:;" class="sort-link numeric">
		<span class="arrow"><?php echo $l->getString('template_character_pvp_played_roster'); ?></span>
	</a>
</th>
					<th style="display: none" class="align-center season">	<a href="javascript:;" class="sort-link numeric">
		<span class="arrow"><?php echo $l->getString('template_character_pvp_lost_won_roster'); ?></span>
	</a>
</th>
					<th class="align-center weekly">	<a href="javascript:;" class="sort-link numeric">
		<span class="arrow"><?php echo $l->getString('template_character_pvp_played_roster'); ?></span>
	</a>
</th>
					<th class="align-center weekly">	<a href="javascript:;" class="sort-link numeric">
		<span class="arrow"><?php echo $l->getString('template_character_pvp_lost_won_weekly_roster'); ?></span>
	</a>
</th>
					<th class="align-center">	<a href="javascript:;" class="sort-link numeric">
		<span class="arrow"><?php echo $l->getString('template_character_pvp_rating_roster'); ?></span>
	</a>
</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($team['members']) :
					$toggleStyle = 2;
					foreach ($team['members'] as $m) :
				?>
					<tr class="row<?php echo $toggleStyle % 2 ? '1': '2'; ?>">
						<td data-raw="<?php echo $m['name']; ?>" style="width: 40%">
							<a href="<?php echo $this->getWowUrl('character/' . $character->getRealmName() . '/' . $m['name'] .'/'); ?>" rel="np">
	
							</a>
							
							<a href="<?php echo $this->getWowUrl('character/' . $character->getRealmName() . '/' . $m['name'] .'/'); ?>" class="color-c<?php echo $m['class']; ?>" rel="allow">




		<span class="icon-frame frame-14 ">
			<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/race_<?php echo $m['race']; ?>_<?php echo $m['gender']; ?>.jpg" alt="" width="14" height="14" />
		</span>




		<span class="icon-frame frame-14 ">
			<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/class_<?php echo $m['class']; ?>.jpg" alt="" width="14" height="14" />
		</span>
								<?php echo $m['name']; ?>
							</a>

								<?php if ($team['captainGuid'] == $m['guid']) : ?><span class="leader" data-tooltip="<?php echo $l->getString('template_character_pvp_team_captain'); ?>"></span><?php endif; ?>
						</td>
						<td class="align-center season">
							<?php echo $m['seasonGames']; ?>

							<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($team['seasonGames'], $m['seasonGames'])); ?>%)</span>
						</td>
						<td class="align-center season arenateam-gameswonlost" data-raw="<?php echo $m['seasonWins']; ?>">
							<span class="arenateam-gameswon"><?php echo $m['seasonWins']; ?></span> &#8211;
							<span class="arenateam-gameslost"><?php echo ($m['seasonGames'] - $m['seasonWins']); ?></span>

							<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($m['seasonGames'], $m['seasonWins'])); ?>%)</span>
						</td>

						<td class="align-center weekly" style="display: none">
							<?php echo $m['weekGames']; ?>

							<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($team['weekGames'], $m['weekGames'])); ?>%)</span>
						</td>
						<td class="align-center weekly arenateam-gameswonlost" data-raw="<?php echo $m['weekWins']; ?> ?>" style="display: none">
							<span class="arenateam-gameswon"><?php echo $m['weekWins']; ?></span> &#8211;
							<span class="arenateam-gameslost"><?php echo ($m['weekGames'] - $m['weekWins']); ?></span>

							<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($team['weekGames'], $m['weekWins'])); ?>%)</span>
						</td>
						<td class="align-center"><span class="arenateam-rating"><?php echo $m['personalRating']; ?></span></td>
					</tr>
					<?php ++$toggleStyle; endforeach; endif; ?>
			</tbody>
		</table>
	</div>

        <script type="text/javascript">
        //<![CDATA[
		$(document).ready(function() {
			new Table('#arena-roster-<?php echo $format; ?>', { column: 3, method: 'numeric', type: 'desc' });
		});
        //]]>
        </script>
	</div>

        <script type="text/javascript">
        //<![CDATA[
			$(document).ready(function() {
				$('#filter-timeframe-<?php echo $format; ?>').dropdown({
					callback: function(dropdown, value) {
						Arena.swapStats('#arena-roster-<?php echo $format; ?>', value, dropdown);
					}
				});
			});
        //]]>
        </script>
	</div>
		<?php endforeach; endif; ?>

	<span class="clear"><!-- --></span>
			</div>
		</div>

<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {
		Pvp.initialize();
	});
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
$(function() {
	Profile.url = '<?php echo $character->getUrl(); ?>/pvp';
});

	var MsgProfile = {
		tooltip: {
			feature: {
				notYetAvailable: "<?php echo $l->getString('template_feature_not_available'); ?>"
			},
			vault: {
				character: "<?php echo $l->getString('template_vault_auth_required'); ?>",
				guild: "<?php echo $l->getString('template_vault_guild'); ?>"
			}
		}
	};
//]]>
</script>