<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:PvP:Arena-Bloque_Lateral_Izquierdo:Abajo', [160, 600], 'div-gpt-ad-1328881032920-0').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:PvP:Arena-Centro:Abajo', [728, 90], 'div-gpt-ad-1328849578247-1').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:PvP:Arena-Centro:Arriba', [728, 90], 'div-gpt-ad-1328849578247-2').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

	<div class="content-header">
				<h2 class="header ">PvP</h2>

<?php
$bg = $this->c('Config')->getValue('site.battlegroup');
$format = $pvp->getLadderType() . 'v' . $pvp->getLadderType();
?>
	<span class="clear"><!-- --></span>
	</div>
        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			Ladder.maxComps = 2;
			Ladder.classes = {
				0: '- Любая специализация -',
				1: ['Оружие', 'Неистовство', 'Защита'],
				2: ['Свет', 'Защита', 'Воздаяние'],
				3: ['Повелитель зверей', 'Стрельба', 'Выживание'],
				4: ['Ликвидация', 'Бой', 'Скрытность'],
				5: ['Послушание', 'Свет', 'Тьма'],
				6: ['Кровь', 'Лед', 'Нечестивость'],
				7: ['Стихии', 'Совершенствование', 'Исцеление'],
				8: ['Тайная магия', 'Огонь', 'Лед'],
				9: ['Колдовство', 'Демонология', 'Разрушение'],
				11: ['Баланс', 'Сила зверя', 'Исцеление']
			};

			Ladder.initialize('');
		});
        //]]>
        </script>

	<div class="pvp pvp-ladder">
		<div class="pvp-right">
			<div class="ladder-title">
	<h3 class="category "><?php echo $l->format('template_pvp_ladder_header', $pvp->getLadderType(), $pvp->getLadderType()); ?> - <span><?php echo $bg; ?></span>
</h3>
			</div>

			<form action="" method="get" onsubmit="return Ladder.submit();" id="pvp-filters" class="table-filters">
				<input type="hidden" name="comp" id="filter-comp" value="" />


				<div class="filter">
					<label for="filter-team">Equipo:</label>
					<input type="text" class="input" id="filter-team" name="team" value="<?php if (isset($_GET['team'])) echo $_GET['team']; ?>" maxlength="30" />
				</div>

				<div class="filter">
					<label for="filter-realm"><?php echo $l->getString('template_pvp_ladder_filter_realm'); ?>:</label>

					<select class="input select" id="filter-realm" name="realm">
						<option value="-1">Seleccionar</option>
						<?php
						$realms = $this->c('Config')->getValue('realms');
						if ($realms) : foreach ($realms as $realm) : ?>
								<option value="<?php echo $realm['id']; ?>"<?php if (isset($_GET['realm']) && $_GET['realm'] == $realm['id']) echo ' selected="selected"'; ?>><?php echo $realm['name']; ?></option>
						<?php endforeach; endif; ?>
					</select>
				</div>

				<div class="filter">
					<label for="filter-faction">Faccion:</label>

					<select class="input select" id="filter-faction" name="faction">
						<option value="-1">Seleccionar</option>
							<option value="0"<?php if (isset($_GET['faction']) && $_GET['faction'] == FACTION_ALLIANCE) echo ' selected="selected"'; ?>><?php echo $l->getString('faction_alliance'); ?></option>
							<option value="1"<?php if (isset($_GET['faction']) && $_GET['faction'] == FACTION_HORDE) echo ' selected="selected"'; ?>><?php echo $l->getString('faction_horde'); ?></option>
					</select>
				</div>

				<div class="filter">
					<label for="filter-rating-min"><?php echo $l->getString('template_pvp_ladder_rating'); ?>:</label>
					<input type="text" class="input align-center" name="minRating" id="filter-rating-min" maxlength="4" value="<?php if (isset($_GET['minRating'])) echo intval($_GET['minRating']); ?>" /> -
					<input type="text" class="input align-center" name="maxRating" id="filter-rating-max" maxlength="4" value="<?php if (isset($_GET['maxRating'])) echo intval($_GET['maxRating']); ?>" />
				</div>

	<span class="clear"><!-- --></span>



				<div id="filter-buttons">
					

	<button class="ui-button button1 " type="submit" id="submit-button">
		<span>
			<span>Filtrar</span>
		</span>
	</button>
					<a href="<?php echo $this->getWowUrl('pvp/arena/' . $bg . '/' . $format); ?>">Restablecer</a>
				</div>
			</form>

		<div id="ladders">

	<?php echo $this->region('pagination'); ?>
	<div class="table ">
<center>
<!-- ServerWoW:PvP:Arena-Centro:Arriba -->
<div id='div-gpt-ad-1328849578247-2' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328849578247-2'); });
</script>
</div>
</center>	
	<br>
		<table>
				<thead>
					<tr>
							<th>
										



	<a href="#" class="sort-link" onclick="return false;">
		<span class="arrow up">#</span>
	</a>

							</th>
							<th>
										



	<a href="#" class="sort-link" onclick="return false;">
		<span class="arrow"><?php echo $l->getString('template_character_team_name'); ?></span>
	</a>

							</th>
							<th>
										



	<a href="#" class="sort-link" onclick="return false;">
		<span class="arrow"><?php echo $l->getString('template_search_table_realm'); ?></span>
	</a>

							</th>
							<th>
										



	<a href="#" class="sort-link" onclick="return false;">
		<span class="arrow"><?php echo $l->getString('template_search_table_faction'); ?></span>
	</a>

							</th>
							<th>
										



	<a href="#" class="sort-link" onclick="return false;">
		<span class="arrow"><?php echo $l->getString('template_pvp_ladder_wins'); ?></span>
	</a>

							</th>
							<th>
										



	<a href="#" class="sort-link" onclick="return false;">
		<span class="arrow"><?php echo $l->getString('template_pvp_ladder_loses'); ?></span>
	</a>

							</th>
							<th>
										



	<a href="#" class="sort-link" onclick="return false;">
		<span class="arrow"><?php echo $l->getString('template_pvp_ladder_rating'); ?></span>
	</a>

							</th>
					</tr>
				</thead>
			<tbody>
			<?php
			$ladder = $pvp->getLadder();
			if ($ladder) :
				$toggleStyle = 2;
				$id = 1;
				foreach ($ladder as $t) : if (!$t) continue;
			?>
				<tr class="row<? echo $toggleStyle % 2 ? '1' : '2'; ?>" id="rank-<?php echo $id; ?>">
									<td class="ranking">		<?php echo $t['rank']; ?></td>
									<td>
										<a href="<?php echo $this->getWowUrl('arena/' . $t['realmName'] . '/' . $format . '/' . $t['name'] . '/'); ?>"><?php echo $t['name']; ?></a>
									</td>
									<td><?php echo $t['realmName']; ?></td>
									<td class="align-center">




		<span class="icon-frame frame-14 " data-tooltip="<?php echo $l->getString('faction_' . ($this->c('Wow')->getFactionId($t['race']) == FACTION_ALLIANCE ? 'alliance' : 'horde')); ?>">
			<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/faction_<?php echo $this->c('Wow')->getFactionId($t['race']); ?>.jpg" alt="" width="14" height="14" />
		</span>
									</td>
									<td class="align-center"><span class="win"><?php echo $t['seasonWins']; ?></span></td>
									<td class="align-center"><span class="loss"><?php echo $t['seasonGames'] - $t['seasonWins']; ?></span></td>
									<td class="align-center"><span class="rating"><?php echo $t['rating']; ?></span></td>
								</tr>
							<?php ++$toggleStyle; endforeach; endif; ?>
			</tbody>
		</table>
	</div>
<center>
<!-- ServerWoW:PvP:Arena-Centro:Abajo -->
<div id='div-gpt-ad-1328849578247-1' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328849578247-1'); });
</script>
</div>
</center>	
	<?php echo $this->region('pagination'); ?>
			</div>
		</div>

		<div class="pvp-left">
<script type='text/javascript'>
(function() {
var useSSL = 'https:' == document.location.protocol;
var src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt.js';
document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
})();
</script>
			<ul class="dynamic-menu" id="menu-pvp">
				<li class="root-item">
					<a href="<?php echo $this->getWowUrl('pvp/'); ?>">
						<span class="arrow"><?php echo $l->getString('template_pvp_arena_summary'); ?></span>
					</a>
				</li>
				<?php
				$types = array(2, 3, 5);
				foreach ($types as $t):
				?>
				<li<?php if ($pvp->getLadderType() == $t) echo ' class="item-active"'; ?>>
					<a href="<?php echo $this->getWowUrl('pvp/arena/' . $bg . '/' . $t . 'v' . $t); ?>">
						<span class="arrow"><?php echo $l->format('template_team_type_format', $t, $t); ?></span>
					</a>
				</li>
				<?php endforeach; ?>
				<li>
				<center>
			<br>
<!-- ServerWoW:PvP:Arena-Bloque_Lateral_Izquierdo:Abajo -->
<div id='div-gpt-ad-1328881032920-0' style='width:160px; height:600px;'>
<script type='text/javascript'>
googletag.display('div-gpt-ad-1328881032920-0');
</script>
</div>
</center>
	</li>
			</ul>
		</div>

	<span class="clear"><!-- --></span>
	</div>