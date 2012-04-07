<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:PvP:Arena:Equipos-Bloque_Lateral_Izquierdo:Abajo', [160, 600], 'div-gpt-ad-1328882788522-0').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:PvP:Arena:Equipos-Centro', [336, 280], 'div-gpt-ad-1328882788522-1').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<div id="profile-wrapper" class="profile-wrapper profile-wrapper-<?php echo $team['faction_text']; ?>">
		<div class="profile-sidebar-anchor">
			<div class="profile-sidebar-outer">
				<div class="profile-sidebar-inner">
					<div class="profile-sidebar-contents">



		<div class="profile-info-anchor">
			<div class="arenateam-flag">

		<canvas id="arenateam-flag" width="240" height="240">
			<div class="arenateam-flag-default" ></div>
		</canvas>
        <script type="text/javascript">
        //<![CDATA[
			$(document).ready(function() {
				var flag = new ArenaFlag('arenateam-flag', {
					'bg': [ 2, '<?php echo dechex($team['backgroundColor']-255); ?>' ],
					'border': [ <?php echo $team['borderStyle']; ?>, '<?php echo dechex($team['borderColor']-255); ?>' ],
					'emblem': [<?php echo $team['emblemStyle']; ?>, '<?php echo dechex($team['emblemColor']-255); ?>' ]
				});
			});
        //]]>
        </script>
			</div>


			<div class="profile-info profile-arenateam-info">
				<div class="name ">
					<a href="<?php echo $team['url']; ?>"><?php echo $team['name']; ?></a>
				</div>

				<div class="under-name">
<div>
<table border='0' cellpadding='7' width='50%'>
<tr>
<td width='25%'>
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=201748293206869&xfbml=1"></script><fb:like send="true" width="400" show_faces="false" font="" data-colorscheme="dark"></fb:like>
</td>
<td width='10%'>
<a href="https://twitter.com/share" class="twitter-share-button" data-via="serverwow" data-lang="es" data-related="serverwow" data-hashtags="serverwow">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</td>
<td width='5%'>
<g:plusone size="medium"></g:plusone>
</tr>
</table>
</div>
					<?php echo $l->extraFormat('template_arena_team_info_fmt',
						array(
							'format' => $l->format('template_team_type_format', $team['type'], $team['type']),
							'faction' => $l->getString('faction_' . $team['faction_text'])
						)
					); ?>

					<span class="realm tip" id="profile-info-realm" data-battlegroup="<?php echo $team['realmName']; ?>">
						<a href="<?php echo $team['bg_link']; ?>" class="realm tip" id="profile-info-realm" data-battlegroup="<?php echo $team['realmName']; ?>"><?php echo $team['bg']; ?></a>
					</span>
				</div>

				<div class="rank">
						<h3>
								<a href="<?php echo $team['bg_link']; ?>">
									<?php echo $l->getString('template_pvp_ladder_rating'); ?> #<?php echo $team['rank']; ?>
								</a>
						</h3>
				</div>

			</div>
		</div>



	<ul class="profile-sidebar-menu" id="profile-sidebar-menu">
			<li class="">
	<a href="<?php echo $team['bg_link']; ?>" class="back-to" rel="np"><span class="arrow"><span class="icon"><?php echo $l->getString('template_pvp_ladder_rating'); ?></span></span></a>
			</li>


			<li class=" active">

		<a href="<?php echo $team['url']; ?>" class="" rel="np">
			<span class="arrow"><span class="icon">
				<?php echo $l->getString('template_profile_summary'); ?>
			</span></span>
		</a>

			</li>
			<li>
			<center>
<br>
<!-- ServerWoW:PvP:Arena:Equipos-Bloque_Lateral_Izquierdo:Abajo -->
<div id='div-gpt-ad-1328882788522-0' style='width:160px; height:600px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328882788522-0'); });
</script>
</div>
</center>
			</li>

		
	</ul>

					</div>
				</div>
			</div>
		</div>
		
		<div class="profile-contents">
		
		<div class="summary">

			<div class="profile-section">
			
					<div class="summary-stats">
				
	<div class="arenateam-stats table">
	

	
		<table>
			<thead>
				<tr>
					<th class="align-left">	<span class="sort-tab">&#0160;</span>
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
			<strong class="week"><?php echo $l->getString('template_character_pvp_week'); ?></strong>
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
			<strong class="season"><?php echo $l->getString('template_character_pvp_season'); ?></strong>
		</td>
		<td class="align-center"><?php echo $team['seasonGames']; ?></td>
		<td class="align-center arenateam-gameswonlost">
			<span class="arenateam-gameswon"><?php echo $team['seasonGames']; ?></span> &#8211; <span class="arenateam-gameslost"><?php echo $team['seasonGames'] - $team['seasonWins']; ?></span>
			<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($team['seasonGames'], $team['seasonWins'])); ?>%)</span>
		</td>
		<td class="align-center">
				<span class="arenateam-rating"><?php echo $team['rating']; ?></span>
		</td>
	</tr>
			</tbody>
		</table>
	</div>
					</div>

				<div class="summary-roster">
<center>
<!-- ServerWoW:PvP:Arena:Equipos-Centro -->
<div id='div-gpt-ad-1328882788522-1' style='width:336px; height:280px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328882788522-1'); });
</script>
</div>
</center>
				
					<div class="ui-dropdown" id="filter-timeframe">
						<select>
							<option value="season"><?php echo $l->getString('template_character_team_per_season'); ?></option>
							<option value="weekly"><?php echo $l->getString('template_character_team_per_week'); ?></option>
						</select>
					</div>

							<h3 class="category "><?php echo $l->getString('template_character_pvp_roster'); ?></h3>

	<div class="arenateam-roster table" id="arena-roster">
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
					<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
						<td data-raw="<?php echo $m['name']; ?>" style="width: 40%">
							<a href="<?php echo $m['url']; ?>" rel="np">
							</a>
							
							<a href="<?php echo $m['url']; ?>" class="color-c<?php echo $m['class']; ?>" rel="allow">




		<span class="icon-frame frame-14 ">
			<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/race_<?php echo $m['race'] . '_' . $m['gender']; ?>.jpg" alt="" width="14" height="14" />
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
							<span class="arenateam-gameslost"><?php echo $m['seasonGames'] - $m['seasonWins']; ?></span>

							<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($m['seasonGames'], $m['seasonWins'])); ?>%)</span>
						</td>

						<td class="align-center weekly" style="display: none">
							<?php echo $m['weekGames']; ?>

							<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($team['weekGames'], $m['weekGames'])); ?>%)</span>
						</td>
						<td class="align-center weekly arenateam-gameswonlost" data-raw="<?php echo $m['weekWins']; ?>" style="display: none">
							<span class="arenateam-gameswon"><?php echo $m['weekWins']; ?></span> &#8211;
							<span class="arenateam-gameslost"><?php echo $m['weekGames'] - $m['weekWins']; ?></span>

							<span class="arenateam-percent">(<?php echo round($this->c('Wow')->getPercent($m['weekGames'], $m['weekWins'])); ?>%)</span>
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
			new Table('#arena-roster', { column: 3, method: 'numeric', type: 'desc' });
		});
        //]]>
        </script>
					</div>

			</div>
		</div>

        <script type="text/javascript">
        //<![CDATA[
			$(function() {
				$('.ui-dropdown').dropdown({
					callback: function(dropdown, value) {
						Arena.swapStats('#arena-roster', value, dropdown);
					}
				});
			});
        //]]>
        </script>

		</div>

	<span class="clear"><!-- --></span>
	</div>

        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			Profile.url = '<?php echo $team['url']; ?>/summary';
		});

			<?php echo $l->getString('template_guild_js_strings'); ?>
        //]]>
        </script>
<br><br><br><br><br><br>