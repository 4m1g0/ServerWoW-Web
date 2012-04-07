
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
			<option value="achievementPoints"><?php echo $l->getString('template_guild_roster_achievements'); ?></option>
			<option value="guildActivity"><?php echo $l->getString('template_guild_roster_activity'); ?></option>
			<option value="professions" selected="selected"><?php echo $l->getString('template_guild_roster_professions'); ?></option>
						</select>
					</div>

	<h3 class="category "><?php echo $l->getString('template_guild_menu_roster'); ?>
</h3>
		</div>

		<div class="profile-section">

			<form id="roster-form" action="">
				<div class="roster-filters clear-after">


	<button class="ui-button button2 " type="button" id="reset-button" onclick="Professions.reset();">
		<span>
			<span><?php echo $l->getString('template_guild_roster_reset_filter'); ?></span>
		</span>
	</button>
					
					<div class="selection">
						<label for="filter-name"><?php echo $l->getString('template_search_table_charname'); ?></label>
						<input type="text" class="input character" id="filter-name" data-column="0" data-filter="column" alt="<?php echo $l->getString('template_guild_roster_tip_enter_name'); ?>"/>
					</div>

					<div class="selection">
						<label for="filter-skill"><?php echo $l->getString('template_guild_roster_profession'); ?></label>
						<select class="input" id="filter-skill" data-column="4" data-filter="column">
							<option value=""><?php echo $l->getString('template_guild_roster_all_professions'); ?></option>
							<?php
							$profs = $guild->getProfessions();
							if ($profs):
								foreach ($profs as $p) :
							?>
								<option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
							<?php endforeach; endif; ?>
						</select>
					</div>

					<div class="selection inputs-skill">
						<label for="filter-minSkill"><?php echo $l->getString('template_guild_roster_skill_level'); ?></label>
						<input type="text" id="filter-minSkill" class="input skill" value="1" maxlength="3" data-min="1" data-column="4" data-filter="range" /> -
						<input type="text" id="filter-maxSkill" class="input skill" value="<?php echo MAX_PROFESSION_SKILL_VALUE; ?>" maxlength="3" data-max="<?php echo MAX_PROFESSION_SKILL_VALUE; ?>" data-column="4" data-filter="range" />
					</div>

					<div class="selection">
						<input class="input show-max-skill" id="filter-onlyMaxSkill" value="0" type="checkbox" data-column="4" data-filter="column" />
						<label for="filter-onlyMaxSkill" class="show-max-skill-label"><?php echo $l->getString('template_guild_roster_only_max_skill'); ?></label>
					</div>

	<span class="clear"><!-- --></span>
				</div>
			</form>


	<div id="profession-tables" class="profession-tables">


	<div id="professions" class="table">
		<table>
			<thead>
				<tr>
						<th class="name">
								<a href="javascript:;" class="sort-link">
									<span class="arrow"><?php echo $l->getString('template_search_table_charname'); ?></span>
								</a>
						</th>
						<th class="race align-center">
								<a href="javascript:;" class="sort-link">
									<span class="arrow"><?php echo $l->getString('template_search_table_race'); ?></span>
								</a>
						</th>
						<th class="cls align-center">
								<a href="javascript:;" class="sort-link">
									<span class="arrow"><?php echo $l->getString('template_search_table_class'); ?></span>
								</a>
						</th>
						<th class="lvl align-center">
								<a href="javascript:;" class="sort-link numeric">
									<span class="arrow"><?php echo $l->getString('template_search_table_level'); ?></span>
								</a>
						</th>
						<th class="skill align-center">
								<a href="javascript:;" class="sort-link numeric">
									<span class="arrow"><?php echo $l->getString('template_guild_roster_profession_skill'); ?></span>
								</a>
						</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

        <script type="text/javascript">
        //<![CDATA[
			$(function() {
					Professions.table = new Table('#professions', { column: 0 });
			});
        //]]>
        </script>


			<?php
			$roster = $guild->getRoster(true);
			if ($roster) :
				foreach ($roster as $prof) :
			?>
			<div id="professions-<?php echo $prof['info']['id']; ?>" class="parentTable">

					<a href="javascript:;" class="table-bar" onclick="Professions.toggleSection(this);">
						<span class="toggler">




		<span  class="icon-frame frame-18 " style='background-image: url("<?php echo $this->getMediaServer(); ?>/wow/icons/18/<?php echo $prof['info']['icon']; ?>.jpg");'>
		</span>
							<?php echo $prof['info']['name']; ?> (<span class="total"><?php echo sizeof($prof['members']); ?></span>)
						</span>
					</a>


	<div id="professions-table-171" class="table childTable">
		<table>
			<thead>
				<tr>
						<th class="name">
								<a href="javascript:;" class="sort-link">
									<span class="arrow"><?php echo $l->getString('template_search_table_charname'); ?></span>
								</a>
						</th>
						<th class="race align-center">
								<a href="javascript:;" class="sort-link">
									<span class="arrow"><?php echo $l->getString('template_search_table_race'); ?></span>
								</a>
						</th>
						<th class="cls align-center">
								<a href="javascript:;" class="sort-link">
									<span class="arrow"><?php echo $l->getString('template_search_table_class'); ?></span>
								</a>
						</th>
						<th class="lvl align-center">
								<a href="javascript:;" class="sort-link numeric">
									<span class="arrow"><?php echo $l->getString('template_search_table_level'); ?></span>
								</a>
						</th>
						<th class="skill align-center">
								<a href="javascript:;" class="sort-link numeric">
									<span class="arrow"><?php echo $l->getString('template_guild_roster_profession_skill'); ?></span>
								</a>
						</th>
				</tr>
			</thead>
			<tbody>



			<?php
			$toggleStyle = 2;
			foreach ($prof['members'] as $m) :
			?>
				<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>" data-level="<?php echo $m['level']; ?>" data-skill="<?php echo $m['profSkill']['value']; ?>">
					<td class="name">
						<strong><a href="<?php echo $this->getWowUrl('character/' . $guild->getRealmName() . '/' . $m['name'] . '/'); ?>" class="color-c<?php echo $m['class']; ?>">
							<?php echo $m['name']; ?>
						</a></strong>
					</td>
					<td class="race" data-raw="<?php echo $l->getString('character_race_' . $m['race']); ?>">




<span class="icon-frame frame-14 " data-tooltip="<?php echo $l->getString('character_race_' . $m['race']); ?>">
<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/race_<?php echo $m['race'] . '_' . $m['gender']; ?>.jpg" alt="" width="14" height="14" />
</span>
					</td>
					<td class="cls" data-raw="<?php echo $l->getString('character_class_' . $m['class']); ?>">




<span class="icon-frame frame-14 " data-tooltip="<?php echo $l->getString('character_class_' . $m['class']); ?>">
<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/class_<?php echo $m['class']; ?>.jpg" alt="" width="14" height="14" />
</span>
					</td>
					<td class="lvl"><?php echo $m['level']; ?></td>
					<td class="skill" data-raw="<?php echo $m['profSkill']['value']; ?>"><?php echo $m['profSkill']['value']; ?></td>
				</tr>
				<?php ++$toggleStyle; endforeach; ?>

						<tr class="no-results" style="display: none">
							<td colspan="8"><?php echo $l->getString('template_guild_roster_no_chars_found'); ?></td>
						</tr>

			</tbody>
		</table>
	</div>

        <script type="text/javascript">
        //<![CDATA[
			$(function() {
					Professions.tables.push( new Table('#professions-table-<?php echo $prof['info']['id']; ?>', { column: 0 }) );
			});
        //]]>
        </script>


			</div>
			<?php endforeach; endif; ?>
		<div id="professions-noResults" class="no-results" style="display: none">
			<?php echo $l->getString('template_guild_roster_no_chars_found'); ?>
		</div>
	</div>

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

<script type="text/javascript" src="/wow/static/js/guild/professions.js?v17"></script>