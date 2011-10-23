	<div id="profile-wrapper" class="profile-wrapper profile-wrapper-<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>">

		<div class="profile-sidebar-anchor">
			<div class="profile-sidebar-outer">
				<div class="profile-sidebar-inner">
					<div class="profile-sidebar-contents">
		<div class="profile-sidebar-tabard">

			<div class="guild-tabard">

		<canvas id="guild-tabard" width="240" height="240">
			<div class="guild-tabard-default tabard-<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>" ></div>
		</canvas>
        <script type="text/javascript">
        //<![CDATA[
			$(document).ready(function() {
				var tabard = new GuildTabard('guild-tabard', {
					'ring': '<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>',
					'bg': [ 0, 5 ],
					'border': [ 2, 16 ],
					'emblem': [ 13, 16 ]
				});
			});
        //]]>
        </script>
				<div class="tabard-overlay"></div>
				<div class="crest"></div>
				<a class="tabard-link" href="<?php echo $guild->getUrl(); ?>"></a>
			</div>

			<div class="profile-sidebar-info">
				<div class="name"><a href="<?php echo $guild->getUrl(); ?>"><?php echo $guild->getName(); ?></a></div>
				<div class="under-name">
					<?php echo $l->extraFormat('template_guild_crest_fmt', array(
						'level' => $guild->getLevel(),
						'faction' => $l->getString(($guild->getFaction() == FACTION_ALLIANCE ? 'faction_alliance' : 'faction_horde'))
					)); ?>
				</div>

				<div class="realm">
					<span id="profile-info-realm" class="tip" data-battlegroup="<?php echo $this->c('Config')->getValue('site.battlegroup'); ?>"><?php echo $guild->getRealmName(); ?></span>
				</div>
			</div>
		</div>
	<?php echo $this->region('profileMenu'); ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="profile-contents">
		<div class="profile-section-header">
	<div class="ui-dropdown" id="roster-view">
		<select>
			<option value="achievementPoints"<?php if (!isset($_GET['view']) || $_GET['view'] == 'achievementPoints') echo ' selected="selected"'; ?>><?php echo $l->getString('template_guild_roster_achievements'); ?></option>
			<option value="guildActivity"<?php if (isset($_GET['view']) && $_GET['view'] == 'guildActivity') echo ' selected="selected"'; ?>><?php echo $l->getString('template_guild_roster_activity'); ?></option>
			<option value="professions"><?php echo $l->getString('template_guild_roster_professions'); ?></option>
						</select>
					</div>

	<h3 class="category "><?php echo $l->getString('template_guild_menu_roster'); ?>
</h3>
		</div>
		<div class="profile-section">
			<form id="roster-form" action="">
				<div class="roster-filters clear-after">
					<input type="hidden" name="view" id="filter-view" />
					<div id="roster-buttons">						
	<button class="ui-button button2 " type="submit" >
		<span>
			<span><?php echo $l->getString('template_guild_roster_filter'); ?></span>
		</span>
	</button>
						<a href="javascript:;" onclick="Guild.reset();"><?php echo $l->getString('template_guild_roster_reset_filter'); ?></a>
					</div>
					<div class="selection">
						<label for="filter-name"><?php echo $l->getString('template_search_table_charname'); ?></label>
						<input type="text" name="name" class="input character" id="filter-name" data-column="0" value="<?php if (isset($_GET['name'])) echo $_GET['name']; ?>" data-filter="column" alt="<?php echo $l->getString('template_guild_roster_tip_enter_name'); ?>"/>
					</div>
					<div class="selection">
						<label for="filter-minLvl"><?php echo $l->getString('template_search_table_level'); ?></label>
						<input type="text" name="minLvl" id="filter-minLvl" class="input level" value="<?php echo isset($_GET['minLvl']) ? intval($_GET['minLvl']) : '1'; ?>" maxlength="2" data-min="<?php echo isset($_GET['minLvl']) ? intval($_GET['minLvl']) : '1'; ?>" data-filter="range" data-column="3" /> -
						<input type="text" name="maxLvl" id="filter-maxLvl" class="input level" value="<?php echo isset($_GET['minLvl']) ? intval($_GET['maxLvl']) : MAX_PLAYER_LEVEL; ?>" maxlength="2" data-max="<?php echo isset($_GET['maxLvl']) ? intval($_GET['maxLvl']) : MAX_PLAYER_LEVEL; ?>" data-filter="range" data-column="3" />
		</div>
					<div class="selection">
						<label for="filter-race"><?php echo $l->getString('template_search_table_race'); ?></label>
						<select name="race" class="input class" id="filter-race" data-column="1" data-filter="column">
							<option value=""><?php echo $l->getString('template_guild_roster_all_races'); ?></option>
							<?php foreach ($this->c('Wow')->getRacesInFaction($guild->getFaction()) as $race) : ?>
								<option value="<?php echo $race['id']; ?>"<?php if (isset($_GET['race']) && $_GET['race'] == $race['id']) echo ' selected="selected"'; ?>><?php echo $race['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="selection">
						<label for="filter-class"><?php echo $l->getString('template_search_table_class'); ?></label>
						<select name="class" class="input class" id="filter-class" data-column="2" data-filter="column">
							<option value=""><?php echo $l->getString('template_guild_roster_all_classes'); ?></option>
								<?php for ($i = CLASS_WARRIOR; $i < MAX_CLASSES; ++$i) :
									if ($i == 10)
										continue; ?>
								<option value="<?php echo $i; ?>"<?php if (isset($_GET['class']) && $_GET['class'] == $i) echo ' selected="selected"'; ?>><?php echo $l->getString('character_class_' . $i); ?></option>
								<?php endfor; ?>
						</select>
					</div>
					<div class="selection inputs-rank">
						<label for="filter-rank"><?php echo $l->getString('template_guild_roster_guild_rank'); ?></label>
						<select name="rank" class="input guildrank" id="filter-rank" data-column="4" data-filter="column">
							<option value=""><?php echo $l->getString('template_guild_roster_all_ranks'); ?></option>
							<?php $ranks = $guild->getGuildRanks();
							if ($ranks) : 
								foreach ($ranks as $rank) :
							?>
								<option value="<?php echo $rank; ?>"<?php if (isset($_GET['rank']) && $_GET['rank'] == $rank) echo ' selected="selected"'; ?>><?php echo $rank; ?></option>
							<?php endforeach; endif; ?>
						</select>
					</div>
	<span class="clear"><!-- --></span>
				</div>
			</form>
	<?php echo $this->region('pagination'); ?>
	<div id="roster" class="table">
		<table>
			<thead>
				<tr>
					<th class="name">
						<a href="?page=<?php echo $guild->getPage(false); ?>&amp;sort=name&amp;dir=a" class="sort-link">
							<span class="arrow"><?php echo $l->getString('template_search_table_charname'); ?> </span>
						</a>
					</th>
					<th class="race align-center">
						<a href="?page=<?php echo $guild->getPage(false); ?>&amp;sort=race&amp;dir=a" class="sort-link">
							<span class="arrow"><?php echo $l->getString('template_search_table_race'); ?></span>
						</a>
					</th>
					<th class="cls align-center">
						<a href="?page=<?php echo $guild->getPage(false); ?>&amp;sort=class&amp;dir=a" class="sort-link">
							<span class="arrow"><?php echo $l->getString('template_search_table_class'); ?></span>
						</a>
					</th>
					<th class="lvl align-center">
						<a href="?page=<?php echo $guild->getPage(false); ?>&amp;sort=lvl&amp;dir=a" class="sort-link">
							<span class="arrow"><?php echo $l->getString('template_search_table_level'); ?></span>
						</a>
					</th>
					<th class="rank align-center">
						<a href="?page=<?php echo $guild->getPage(false); ?>&amp;sort=rank&amp;dir=a" class="sort-link">
							<span class="arrow"><?php echo $l->getString('template_guild_roster_guild_rank'); ?></span>
						</a>
					</th>
					<th class="ach-points align-center">
						<a href="?page=<?php echo $guild->getPage(false); ?>&amp;sort=achievements&amp;dir=d" class="sort-link">
							<span class="arrow up"><?php echo $l->getString('template_guild_roster_achievements'); ?></span>
						</a>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$roster = $guild->getRoster();
			if ($roster) :
				$toggleStyle = 2;
				$icons_server = $this->c('Config')->getValue('site.icons_server');
				foreach ($roster as $member) :
			?>
			<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>" data-level="<?php echo $member['level']; ?>">
				<td class="name"><strong><a href="<?php echo $this->getWowUrl('character/' . $guild->getRealmName() . '/' . $member['name'] . '/'); ?>" class="color-c<?php echo $member['class']; ?>"><?php echo $member['name']; ?></a></strong></td>
				<td class="race" data-raw="<?php echo $member['race']; ?>">
					<span class="icon-frame frame-14 " data-tooltip="<?php echo $l->getString('character_race_' . $member['race']); ?>">
						<img src="<?php echo $icons_server ?>/wow/icons/18/race_<?php echo $member['race']; ?>_<?php echo $member['gender']; ?>.jpg" alt="" width="14" height="14" />
					</span>
				</td>
				<td class="cls" data-raw="<?php echo $member['class']; ?>">
					<span class="icon-frame frame-14 " data-tooltip="<?php echo $l->getString('character_class_' . $member['class']); ?>">
						<img src="<?php echo $icons_server; ?>/18/class_<?php echo $member['class']; ?>.jpg" alt="" width="14" height="14" />
					</span>
				</td>
				<td class="lvl"><?php echo $member['level']; ?></td>
				<td class="rank" data-raw="<?php echo $member['rank']; ?>">
					<span >
							<?php echo $l->format('template_guild_roster_rank', $member['rank']); ?>
					</span>
				</td>
				<td class="ach-points">
					<span class="ach-icon">0</span>
				</td>
			</tr>
			<?php ++$toggleStyle; endforeach; endif; ?>
			</tbody>
		</table>
	</div>

	<?php echo $this->region('pagination'); ?>
		</div>
	</div>

	<span class="clear"><!-- --></span>
</div>

        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			Profile.url = '<?php echo $guild->getUrl(); ?>/roster';
		});

			<?php echo $l->getString('template_guild_js_strings'); ?>
        //]]>
        </script>
