<?php
if (!$character) return;
$mounts = $character->getMounts();
if (!$mounts) return;
?>
<div class="profile-section-header">
	<ul class="profile-tabs">
			<li<?php if ($character->getProfilePage() == 'profile_companion') echo ' class="tab-active"'; ?>>
				<a href="companion" rel="np">
					<span class="r"><span class="m">
						<?php echo $l->getString('template_profile_companion'); ?>
					</span></span>
				</a>
			</li>
			<li<?php if ($character->getProfilePage() == 'profile_mount') echo ' class="tab-active"'; ?>>
				<a href="mount" rel="np">
					<span class="r"><span class="m">
						<?php echo $l->getString('template_profile_mount'); ?>
					</span></span>
				</a>
			</li>
	</ul>
		</div>

		<div class="profile-section">
	<div class="profile-filters" id="filters">
		<div class="keyword">
			<span class="view"></span>
			<span class="reset" style="display: none"></span>
			<input class="input" id="filter-keyword" type="text" value="Фильтр" alt="Фильтр" data-filter="row" data-name="filter" />
		</div>

		<div class="tabs">
			<a href="javascript:;" data-status="is-collected">
				<?php echo $l->format('template_companion_collected', $mounts['counters']['collected']); ?>
			</a>

			<a href="javascript:;" data-status="not-collected">
				<?php echo $l->format('template_companion_not_collected', $mounts['counters']['not_collected']); ?>
			</a>
		</div>

		<div class="mode">
			<span class="advanced-togglers" id="advanced-toggle">
				<a href="javascript:;" onclick="Companion.toggleAdvanced(this, true);" class="advanced-toggle">
					<?php echo $l->getString('template_companion_show_filters'); ?>
				</a>

				<a href="javascript:;" onclick="Companion.toggleAdvanced(this, false);" class="advanced-toggle" style="display: none">
					<?php echo $l->getString('template_companion_hide_filters'); ?>
				</a>
			</span>
			<?php
            if($character->getProfilePage() == 'profile_mount')
			{
                $modes = array('all', 'ground', 'flying', 'aquatic');
                foreach($modes as $mode)
                    echo '<label for="mode-' . $mode . '"><input type="radio" name="mode" id="mode-' . $mode . '" data-filter="class" data-name="mode" value="' . ($mode != 'all' ? $mode : null) . '"' . ($mode == 'all' ? ' checked="checked"' : null) . ' />' . $l->getString('template_companion_js_mount_' . $mode) . '</label>';
            }
            ?>

	<span class="clear"><!-- --></span>
		</div>

		<div class="advanced" id="advanced-filters" style="display: none">

			<div class="group advanced-filters-quality" style="">
				<span class="group-name"><?php echo $l->getString('template_rarity_filter'); ?></span>
				<ul>		
					<?php
					for($i = 4; $i > 0; --$i)
					{
						if($i == 2)
							continue;
						echo '
						<li>
							<label for="quality-' . $i . '" class="color-q' . $i . '">
							<input type="checkbox" name="type" data-name="quality" value="' . $i . '" data-filter="column" id="quality-' . $i . '" />
							' . $l->getString('template_rarity_' . $i) . '
						</label>
						</li>';
					}
					?>
				</ul>
			</div>
			<div class="group advanced-filters-source">
				<span class="group-name"><?php echo $l->getString('template_companion_source'); ?></span>
				<?php
				$sources = array(
					array('drop', 'quest', 'vendor', 'prof'),
					array('achv', 'faction', 'event', 'promo'),
					array('store', 'tcg', 'other')
				);
				foreach($sources as $list)
				{
					echo '<ul>';
					foreach($list as $source)
					{
						echo '
							<li>
								<label for="type-' . $source . '">
									<input type="checkbox" name="type" data-name="source" value="' . $source . '" data-filter="column" id="type-' . $source . '" />
									' . $l->getString('template_source_' . $source) . '
								</label>
							</li>';
					}
					echo '</ul>';
				}
				?>
			</div>

	<span class="clear"><!-- --></span>
		</div>
	</div>

			<div id="companions-loading"></div>
			<div class="companion-grid all-view" id="companions">





	<div class="table-options data-options table-top">
			<div class="option">

		<ul class="ui-pagination"></ul>

			</div>


	<?php echo $l->format('template_guild_roster_results_count', 1, min($mounts['counters']['collected'], 24), ($mounts['counters']['collected'] + $mounts['counters']['not_collected'])); ?>

	<span class="clear"><!-- --></span>
	</div>

				<div class="data-container">





	<?php if($mounts['mounts']) : foreach ($mounts['mounts'] as &$collected) : ?>
	<div data-raw="<?php echo $collected['source_type'] . ' ' . $collected['quality']; ?>" class="grid-item <?php echo $collected['add_style']; ?>" >
		<a class="preview"
			data-companion="<?php echo $collected['spell']; ?>"
			href="<?php echo $this->getWowUrl('item/' . $collected['item_id']); ?>"
			rel="np">

			<span class="render">
				<span class="render-model" style="background-image: url(http://eu.media.blizzard.com/wow/renders/npcs/grid/creature<?php echo $collected['npc_id']; ?>.jpg)"></span>
			</span>

			<span class="name color-q<?php echo $collected['quality']; ?>"><?php echo $collected['name']; ?></span>


		</a>
	</div>
	<?php endforeach; else :?>
	<?php endif; ?>

		<div class="no-results" id="no-results" style="display: none">
			<span class="is-collected">
					<?php if ($mounts['counters']['collected'] > 0) echo $l->getString('template_no_results'); else echo $l->getString('template_companion_no_' . ($character->getProfilePage() == 'profile_mount' ? 'mount' : 'companion')); ?>
			</span>

			<span class="not-collected" style="display: none">
					<?php echo $l->getString('template_no_results'); ?>
			</span>
		</div>

	<span class="clear"><!-- --></span>
				</div>






	<div class="table-options data-options table-bottom">
			<div class="option">

		<ul class="ui-pagination"></ul>

			</div>


	<?php echo $l->format('template_guild_roster_results_count', 1, min($mounts['counters']['collected'], 24), ($mounts['counters']['collected'] + $mounts['counters']['not_collected'])); ?>

	<span class="clear"><!-- --></span>
	</div>
			</div>

	<div id="model-popup" class="model-popup" style="display: none">
	<div class="model-viewer">
			<div class="model "	id="model-cm">
				
				<div class="loading">
					<div class="viewer"></div>
				</div>

				<a href="javascript:;" class="zoom"></a>
				<a href="javascript:;" class="rotate"></a>
			</div>
	</div>

		<div class="details"></div>

        <script type="text/javascript">
        //<![CDATA[
			$(function() {
				Companion.modelViewer = new ModelRotator("#model-cm", {
					zoom: false,
					rotate: false,
					dragCallback: Companion.dragCallback
				});
			});
        //]]>
        </script>
	</div>
		</div>

        <script type="text/javascript">
        //<![CDATA[
			$(function() {
				Companion.renderPath = 'http://eu.media.blizzard.com/wow/renders/npcs/grid/creature{id}.jpg';
				Companion.itemPath = '<?php echo $this->getWowUrl('item/{id}'); ?>'; 
				Companion.setData({
					<?php if ($mounts['mounts']) : foreach($mounts['mounts'] as &$mount) : ?>
					<?php echo $mount['spell']; ?>: { name: "<?php echo $mount['name']; ?>", icon: "<?php echo $mount['icon']; ?>", spellId: <?php echo $mount['spell']; ?>, qualityId: <?php echo $mount['quality']; ?>, npcId: <?php echo $mount['npc_id']; ?>, source: "<?php echo str_replace(array('>', '"'), array('\>', '\"'), $mount['source']); ?>"<?php if ($mount['item_id'] > 0) echo ', itemId: ' . $mount['item_id']; if ($mount['type'] == 1) echo ', type: ' . $mount['type']; ?>},

					<?php endforeach; endif;?>
				});
				Companion.grid = new DataSet('#companions', {
					elementControls: '.data-options',
					elementRow: '.grid-item, .no-results',
					altRows: false,
					results: <?php if ($mounts['counters']['collected'] > 0) echo min(24, $mounts['counters']['collected']); else echo '24'; ?>,
					totalResults: <?php echo ($mounts['counters']['collected'] + $mounts['counters']['not_collected']); ?>,
					paging: true,
					cache: true,
					afterProcess: Companion.afterProcess
				});
				Companion.msg = {
	companion: '<?php echo $l->getString('template_companion_js_companion'); ?>',
	mount: '<?php echo $l->getString('template_companion_js_mount'); ?>',
	mountTypes: {
		'1': '<?php echo $l->getString('template_companion_js_mount_ground'); ?>',
		'2': '<?php echo $l->getString('template_companion_js_mount_flying'); ?>',
		'3': '<?php echo $l->getString('template_companion_js_mount_aquatic'); ?>'
	}
				};
			});
        //]]>
        </script>
	
        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			Profile.url = '<?php echo $character->getUrl() . '/' . ($character->getProfilePage() == 'profile_companion' ? 'companion' : 'mount'); ?>';
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