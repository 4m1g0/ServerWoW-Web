<?php if (!isset($guild) || !$guild) return; ?>	
	<div id="profile-wrapper" class="profile-wrapper profile-wrapper-<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>">

		<div class="profile-sidebar-anchor">
			<div class="profile-sidebar-outer">
				<div class="profile-sidebar-inner">
					<div class="profile-sidebar-contents">



		<div class="profile-info-anchor profile-guild-info-anchor">
			<div class="guild-tabard">

		<canvas id="guild-tabard" width="240" height="240">
			<div class="guild-tabard-default " ></div>
		</canvas>
        <script type="text/javascript">
        //<![CDATA[
			$(document).ready(function() {
				var tabard = new GuildTabard('guild-tabard', {
					'ring': '<?php echo $guild->getFaction() == FACTION_ALLIANCE ? 'alliance' : 'horde'; ?>',
					'bg': [ 0, 45 ],
					'border': [ 0, 14 ],
					'emblem': [ 6, 14 ]
				});
			});
        //]]>
        </script>
			</div>

			<div class="profile-info profile-guild-info">
				<div class="name"><a href="<?php echo $guild->getUrl(); ?>"><?php echo $guild->getName(); ?></a></div>
				<div class="under-name">
					<?php echo $l->extraFormat('template_guild_info_fmt', array(
						'level' => $guild->getLevel(),
						'faction' => $l->getString(($guild->getFaction() == FACTION_ALLIANCE ? 'faction_alliance' : 'faction_horde')),
						'realm' => $guild->getRealmName(),
						'bg' => $this->c('Config')->getValue('site.battlegroup')
					)); ?>
					<span class="members">47 members</span>
				</div>

				<div class="achievements"><a href="/wow/en/guild/kazzak/We%20May%20Slack/achievement?character=voilon">520</a></div>
			</div>
		</div>



	<ul class="profile-sidebar-menu" id="profile-sidebar-menu">





			<li class="">


	<a href="/wow/en/character/kazzak/voilon/" class="back-to" rel="np"><span class="arrow"><span class="icon">Voilon</span></span></a>

			</li>





			<li class=" active">

		<a href="/wow/en/guild/kazzak/We%20May%20Slack/?character=voilon" class="" rel="np">
			<span class="arrow"><span class="icon">
				Summary
			</span></span>
		</a>

			</li>





			<li class="">

		<a href="/wow/en/guild/kazzak/We%20May%20Slack/roster?character=voilon" class="" rel="np">
			<span class="arrow"><span class="icon">
				Roster
			</span></span>
		</a>

			</li>





			<li class="">

		<a href="/wow/en/guild/kazzak/We%20May%20Slack/news?character=voilon" class="" rel="np">
			<span class="arrow"><span class="icon">
				News
			</span></span>
		</a>

			</li>





			<li class=" disabled">

		<a href="javascript:;" class=" vault" rel="np">
			<span class="arrow"><span class="icon">
				Events
			</span></span>
		</a>

			</li>





			<li class="">

		<a href="/wow/en/guild/kazzak/We%20May%20Slack/achievement?character=voilon" class=" has-submenu" rel="np">
			<span class="arrow"><span class="icon">
				Achievements
			</span></span>
		</a>

			</li>





			<li class="">

		<a href="/wow/en/guild/kazzak/We%20May%20Slack/perk?character=voilon" class="" rel="np">
			<span class="arrow"><span class="icon">
				Perks
			</span></span>
		</a>

			</li>





			<li class=" disabled">

		<a href="javascript:;" class=" vault" rel="np">
			<span class="arrow"><span class="icon">
				Rewards
			</span></span>
		</a>

			</li>

		
	</ul>

	




					</div>
				</div>
			</div>
		</div>
		
		<div class="profile-contents">

		<div class="summary">

			<div class="profile-section">

				<div class="summary-right">


	<div class="summary-simple-list summary-perks">
	<h3 class="category ">			Perks
</h3>
	
		<div class="profile-box-simple">

			<ul>
















						<li>

							<a href="/wow/en/guild/kazzak/We%20May%20Slack/perk?character=voilon#p15">

								<span class="icon-wrapper">




		<span  class="icon-frame frame-36 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/36/achievement_guildperk_cashflow_rank2.jpg");'>
		</span>
									<span class="symbol"></span>
								</span>
								<div class="text">
									<strong>Cash Flow (Rank 2)</strong>
									<span class="desc" title="Each time you loot money from an enemy, an extra 10% money is generated and deposited directly into your guild bank.">Each time you loot money from an enemy, an extra 10% money is generated and…</span>
								</div>

								<span class="type">Level 16</span>
	<span class="clear"><!-- --></span>

							</a>
						</li>


						<li class="locked">

							<a href="/wow/en/guild/kazzak/We%20May%20Slack/perk?character=voilon#p16">

								<span class="icon-wrapper">




		<span  class="icon-frame frame-36 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/36/achievement_guildperk_gmail.jpg");'>
		</span>
									<span class="symbol"></span>
								</span>
								<div class="text">
									<strong>G-Mail </strong>
									<span class="desc" title="In-game mail sent between guild members now arrives instantly.">In-game mail sent between guild members now arrives instantly.</span>
								</div>

								<span class="type">Level 17</span>
	<span class="clear"><!-- --></span>

							</a>
						</li>








			</ul>

	<div class="profile-linktomore">
		<a href="/wow/en/guild/kazzak/We%20May%20Slack/perk?character=voilon" rel="np">All perks</a>
	</div>

	<span class="clear"><!-- --></span>
		</div>
	</div>


	<div class="summary-weekly-contributors">
	<h3 class="category ">			Top Weekly Contributors
</h3>

		<div class="profile-box-simple">


	<div id="roster" class="table">
		<table>
			<thead>
				<tr>
						<th class="position">
									<span class="sort-tab">#</span>
						</th>
						<th class="name align-center">
									<span class="sort-tab">Name</span>
						</th>
						<th class="cls align-center">
									<span class="sort-tab">Class</span>
						</th>
						<th class="lvl align-center">
									<span class="sort-tab">Level</span>
						</th>
						<th class="weekly align-center">
									<span class="sort-tab">Weekly</span>
						</th>
				</tr>
			</thead>
			<tbody>


						<tr class="row1" data-level="85">
							<td class="rank">1</td>
							<td class="name">
								<a href="/wow/en/character/kazzak/Shadywarrior/" class="color-c1">Shadywarrior</a>
							</td>
							<td class="cls">




		<span class="icon-frame frame-14 " data-tooltip="Warrior">
			<img src="http://eu.media.blizzard.com/wow/icons/18/class_1.jpg" alt="" width="14" height="14" />
		</span>
							</td>
							<td class="lvl">85</td>
							<td class="weekly">1544440</td>
						</tr>


						<tr class="row2" data-level="85">
							<td class="rank">2</td>
							<td class="name">
								<a href="/wow/en/character/kazzak/Fjordabasker/" class="color-c2">Fjordabasker</a>
							</td>
							<td class="cls">




		<span class="icon-frame frame-14 " data-tooltip="Paladin">
			<img src="http://eu.media.blizzard.com/wow/icons/18/class_2.jpg" alt="" width="14" height="14" />
		</span>
							</td>
							<td class="lvl">85</td>
							<td class="weekly">1527150</td>
						</tr>


						<tr class="row1" data-level="85">
							<td class="rank">3</td>
							<td class="name">
								<a href="/wow/en/character/kazzak/Shadymage/" class="color-c8">Shadymage</a>
							</td>
							<td class="cls">




		<span class="icon-frame frame-14 " data-tooltip="Mage">
			<img src="http://eu.media.blizzard.com/wow/icons/18/class_8.jpg" alt="" width="14" height="14" />
		</span>
							</td>
							<td class="lvl">85</td>
							<td class="weekly">1308090</td>
						</tr>


						<tr class="row2" data-level="85">
							<td class="rank">4</td>
							<td class="name">
								<a href="/wow/en/character/kazzak/Diamanten/" class="color-c11">Diamanten</a>
							</td>
							<td class="cls">




		<span class="icon-frame frame-14 " data-tooltip="Druid">
			<img src="http://eu.media.blizzard.com/wow/icons/18/class_11.jpg" alt="" width="14" height="14" />
		</span>
							</td>
							<td class="lvl">85</td>
							<td class="weekly">1268860</td>
						</tr>


						<tr class="row1" data-level="85">
							<td class="rank">5</td>
							<td class="name">
								<a href="/wow/en/character/kazzak/Naphor/" class="color-c5">Naphor</a>
							</td>
							<td class="cls">




		<span class="icon-frame frame-14 " data-tooltip="Priest">
			<img src="http://eu.media.blizzard.com/wow/icons/18/class_5.jpg" alt="" width="14" height="14" />
		</span>
							</td>
							<td class="lvl">85</td>
							<td class="weekly">758894</td>
						</tr>
			</tbody>
		</table>
	</div>



	<div class="profile-linktomore">
		<a href="/wow/en/guild/kazzak/We%20May%20Slack/roster?view=guildActivity?character=voilon" rel="np">All contributions</a>
	</div>

	<span class="clear"><!-- --></span>

				
		</div>
	</div>
	
					
				</div>

				<div class="summary-left">





	<div class="summary-activity">
	<h3 class="category ">			Recent News
</h3>
	
		<div class="profile-box-simple">


					<ul class="activity-feed">



	<li data-id="16709401" class="item-purchased first">
		<dl>
			<dd>

	<a href="/wow/en/item/71260" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_bracer_plate_raidpaladin_i_01.jpg");'>
		</span>
</a>
	
	<a href="/wow/en/character/kazzak/Voilon/">Voilon</a> purchased item <a href="/wow/en/item/71260" class="color-q4">Bracers of Imperious Truths</a>.

</dd>
			<dt>in 48 minutes</dt>
		</dl>
	</li>


	<li data-id="16680575" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/69581" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_mace_18.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Naphor/">Naphor</a> obtained <a href="/wow/en/item/69581" class="color-q4">Amani Scepter of Rites</a>.

</dd>
			<dt>13 hours ago</dt>
		</dl>
	</li>


	<li data-id="16680233" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/69567" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_bracer_12.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Naphor/">Naphor</a> obtained <a href="/wow/en/item/69567" class="color-q4">Wristwraps of Departed Spirits</a>.

</dd>
			<dt>13 hours ago</dt>
		</dl>
	</li>


	<li data-id="16671024" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59221" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_boots_raidwarrior_i_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Voilon/">Voilon</a> obtained <a href="/wow/en/item/59221" class="color-q4">Massacre Treads</a>.

</dd>
			<dt>15 hours ago</dt>
		</dl>
	</li>


	<li data-id="16668133" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59318" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_chest_leatherraidrogue_i_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Diamanten/">Diamanten</a> obtained <a href="/wow/en/item/59318" class="color-q4">Sark of the Unwatched</a>.

</dd>
			<dt>16 hours ago</dt>
		</dl>
	</li>


	<li data-id="16665984" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/63537" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_hand_1h_bwdraid_d_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Shadymage/">Shadymage</a> obtained <a href="/wow/en/item/63537" class="color-q4">Claws of Torment</a>.

</dd>
			<dt>16 hours ago</dt>
		</dl>
	</li>


	<li data-id="16665382" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59349" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_belt_cloth_raidwarlock_i_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Shadymage/">Shadymage</a> obtained <a href="/wow/en/item/59349" class="color-q4">Belt of Arcane Storms</a>.

</dd>
			<dt>17 hours ago</dt>
		</dl>
	</li>


	<li data-id="16663727" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59220" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_misc_rubystar.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Voilon/">Voilon</a> obtained <a href="/wow/en/item/59220" class="color-q4">Security Measure Alpha</a>.

</dd>
			<dt>17 hours ago</dt>
		</dl>
	</li>


	<li data-id="16663744" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59118" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_bracer_plate_raiddeathknight_i_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Voilon/">Voilon</a> obtained <a href="/wow/en/item/59118" class="color-q4">Electron Inductor Coils</a>.

</dd>
			<dt>17 hours ago</dt>
		</dl>
	</li>


	<li data-id="16662758" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59452" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_helmet_cloth_raidpriest_i_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Zallad/">Zallad</a> obtained <a href="/wow/en/item/59452" class="color-q4">Crown of Burning Waters</a>.

</dd>
			<dt>17 hours ago</dt>
		</dl>
	</li>


	<li data-id="16659913" class="item-purchased">
		<dl>
			<dd>

	<a href="/wow/en/item/60362" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_shoulder_plate_raidpaladin_i_01.jpg");'>
		</span>
</a>
	
	<a href="/wow/en/character/kazzak/Voilon/">Voilon</a> purchased item <a href="/wow/en/item/60362" class="color-q4">Reinforced Sapphirium Mantle</a>.

</dd>
			<dt>18 hours ago</dt>
		</dl>
	</li>


	<li data-id="16659687" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59499" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_pant_raidshaman_i_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Phixx/">Phixx</a> obtained <a href="/wow/en/item/59499" class="color-q4">Kilt of the Forgotten Battle</a>.

</dd>
			<dt>18 hours ago</dt>
		</dl>
	</li>


	<li data-id="16659645" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59490" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_helmet_leatherraidrogue_i_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Diamanten/">Diamanten</a> obtained <a href="/wow/en/item/59490" class="color-q4">Membrane of C&#39;Thun</a>.

</dd>
			<dt>18 hours ago</dt>
		</dl>
	</li>


	<li data-id="16658411" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59521" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_sword_1h_grimbatolraid_d_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Zallad/">Zallad</a> obtained <a href="/wow/en/item/59521" class="color-q4">Soul Blade</a>.

</dd>
			<dt>18 hours ago</dt>
		</dl>
	</li>


	<li data-id="16657862" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59508" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_boots_cloth_raidpriest_i_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Zallad/">Zallad</a> obtained <a href="/wow/en/item/59508" class="color-q4">Treads of Liquid Ice</a>.

</dd>
			<dt>18 hours ago</dt>
		</dl>
	</li>


	<li data-id="16656051" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/63532" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_bow_2h_crossbow_grimbatolraid_d_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Zallad/">Zallad</a> obtained <a href="/wow/en/item/63532" class="color-q4">Dragonheart Piercer</a>.

</dd>
			<dt>18 hours ago</dt>
		</dl>
	</li>


	<li data-id="16656013" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59519" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/spell_arcane_teleportironforge.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Shadymage/">Shadymage</a> obtained <a href="/wow/en/item/59519" class="color-q4">Theralion&#39;s Mirror</a>.

</dd>
			<dt>18 hours ago</dt>
		</dl>
	</li>


	<li data-id="16654879" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/59482" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_chest_cloth_raidpriest_i_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Zallad/">Zallad</a> obtained <a href="/wow/en/item/59482" class="color-q4">Robes of the Burning Acolyte</a>.

</dd>
			<dt>19 hours ago</dt>
		</dl>
	</li>


	<li data-id="16561434" class="player-ach">
		<dl>
			<dd>
	<a href="/wow/en/character/kazzak/Phixx/achievement#92:a2516" rel="np" data-achievement="2516">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_box_petcarrier_01.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Phixx/">Phixx</a> earned the achievement <a href="/wow/en/character/kazzak/Phixx/achievement#92:a2516" rel="np" data-achievement="2516">Lil&#39; Game Hunter</a> for 10 points.
</dd>
			<dt>2 days ago</dt>
		</dl>
	</li>


	<li data-id="16525343" class="item-purchased">
		<dl>
			<dd>

	<a href="/wow/en/item/60245" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_pants_robe_raidmage_i_01.jpg");'>
		</span>
</a>
	
	<a href="/wow/en/character/kazzak/Shadymage/">Shadymage</a> purchased item <a href="/wow/en/item/60245" class="color-q4">Firelord&#39;s Leggings</a>.

</dd>
			<dt>2 days ago</dt>
		</dl>
	</li>


	<li data-id="16517039" class="item-purchased">
		<dl>
			<dd>

	<a href="/wow/en/item/60247" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_glove_robe_raidmage_i_01.jpg");'>
		</span>
</a>
	
	<a href="/wow/en/character/kazzak/Shadymage/">Shadymage</a> purchased item <a href="/wow/en/item/60247" class="color-q4">Firelord&#39;s Gloves</a>.

</dd>
			<dt>2 days ago</dt>
		</dl>
	</li>


	<li data-id="16472889" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/69622" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_mask_02.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Naphor/">Naphor</a> obtained <a href="/wow/en/item/69622" class="color-q4">The Hexxer&#39;s Mask</a>.

</dd>
			<dt>3 days ago</dt>
		</dl>
	</li>


	<li data-id="16472795" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/69802" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_jewelry_ring_04.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Naphor/">Naphor</a> obtained <a href="/wow/en/item/69802" class="color-q4">Band of the Gurubashi Berserker</a>.

</dd>
			<dt>3 days ago</dt>
		</dl>
	</li>


	<li data-id="16472765" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/69617" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_helmet_111.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Naphor/">Naphor</a> obtained <a href="/wow/en/item/69617" class="color-q4">Plumed Medicine Helm</a>.

</dd>
			<dt>3 days ago</dt>
		</dl>
	</li>


	<li data-id="16472738" class="item-looted">
		<dl>
			<dd>
	<a href="/wow/en/item/69613" class="color-q4">



		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/inv_pants_leather_37.jpg");'>
		</span>
</a>

	<a href="/wow/en/character/kazzak/Naphor/">Naphor</a> obtained <a href="/wow/en/item/69613" class="color-q4">Leggings of the Pride</a>.

</dd>
			<dt>3 days ago</dt>
		</dl>
	</li>
	
					</ul>
	<div class="profile-linktomore">
		<a href="/wow/en/guild/kazzak/We%20May%20Slack/news?character=voilon" rel="np">All news</a>
	</div>

	<span class="clear"><!-- --></span>



		</div>
	</div>

					
				</div>

	<span class="clear"><!-- --></span>
			</div>
		</div>

		</div>

	<span class="clear"><!-- --></span>
	</div>

        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			Profile.url = '/wow/en/guild/kazzak/We%20May%20Slack/summary';
		});

			var MsgProfile = {
				tooltip: {
					feature: {
						notYetAvailable: "This feature is not yet available."
					},
					vault: {
						character: "This section is only accessible if you are logged in as this character.",
						guild: "This section is only accessible if you are logged in as a character belonging to this guild."
					}
				}
			};
        //]]>
        </script>