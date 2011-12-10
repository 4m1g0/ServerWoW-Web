<div id="wiki" class="wiki wiki-faction">
		<div class="sidebar">


	<div class="snippet">

	<div class="model-viewer">
		<?php
		$npcs = array(
			array($faction['leader_id'], $faction['leader']),
			array($faction['intendant_id'], $faction['intendant'])
		);
		$i = 0;
		foreach ($npcs as $n) :
			if (!$n[0])
				continue;
		?>
			<div class="model "
				id="model-<?php echo $n[0]; ?>"
				<?php if ($i != 0) echo 'style="display: none"';?>
				>

				<div class="loading">
					<div class="viewer" style="background-image: url('http://eu.media.blizzard.com/wow/renders/npcs/rotate/creature<?php echo $n[0]; ?>.jpg');"></div>
				</div>

				<a href="javascript:;" class="rotate"></a>
			</div>
		<?php ++$i; endforeach; ?>

			<div class="buttons" id="model-buttons">
			<?php
			reset($npcs);
			$i = 0;
			foreach ($npcs as $n) :
				if (!$n[0])
					continue;
			?>
					<a href="javascript:;"
						id="model-button-<?php echo $n[0]; ?>"
						data-id="<?php echo $n[0]; ?>"
						data-tooltip="<?php echo $n[1]; ?>"
						class="<?php if ($i == 0) echo 'button-active'; ?>">
					</a>
				<?php ++$i; endforeach; ?>
			</div>

        <script type="text/javascript">
        //<![CDATA[
				$(function() {
					Npc.models = {
					<?php
					reset($npcs);
					foreach ($npcs as $n) :
						if (!$n[0])
							continue;
					?>
							"<?php echo $n[0]; ?>": new ModelRotator("#model-<?php echo $n[0]; ?>"),
						<?php endforeach; ?>
					};
				});
        //]]>
        </script>
	</div>
	</div>
	
<div class="snippet">
			<h3>Información principal</h3>

		<ul class="fact-list">

			<li>
				<span class="term">Facción</span>
				<?php if (in_array($faction['faction'], array(FACTION_ALLIANCE, FACTION_HORDE))) : ?>
				<?php echo $l->getString('faction_' . ($faction['faction'] == FACTION_ALLIANCE ? 'alliance' : 'horde')); ?><span class="icon-faction-<?php echo $faction['faction']; ?>"></span>
				<?php elseif ($faction['faction'] == -1) : echo $l->getString('faction_neutral'); endif; ?>
			</li>

			<?php if ($faction['leader_id'] > 0) : ?>
				<li>
					<span class="term">Líder:</span>
					<span class="" datas-npc="<?php echo $faction['leader_id']; ?>"><?php echo $faction['leader']; ?></span>
				</li>
			<?php endif; ?>
			<?php if ($faction['intendant_id'] > 0) : ?>
				<li>
					<span class="term">Intendente:</span>
					<span class="" datas-npc="<?php echo $faction['intendant_id']; ?>"><?php echo $faction['intendant']; ?></span>
				</li>
			<?php endif; ?>

			<?php if ($faction['location']) : ?> 
				<li>
					<span class="term">Lugar:</span>
					<?php echo $faction['location']; ?>
				</li>
			<?php endif; ?>
		</ul>
	</div>

	<div class="snippet">
			<h3>Más información</h3>

		<span id="fansite-links"></span>
        <script type="text/javascript">
        //<![CDATA[
			$(function() {
				Fansite.generate('#fansite-links', "faction|<?php echo $faction['id'] . '|' . str_replace('"', '\"', $faction['name']); ?>");
			});
        //]]>
        </script>
	</div>
		</div>

		<div class="info">

		<div class="title">
			<h2><?php echo $faction['name']; ?></h2>
			

	<?php if ($faction['expansion'] > 0) : ?>
	<span class="expansion-name color-ex<?php echo $faction['expansion']; ?>">
		<span class="color-ex<?php echo $faction['expansion']; ?>">Requiere <?php echo $l->getString('template_expansion_' . $faction['expansion']); ?></span>
	</span>
	<?php endif; ?>
		</div>

	<p class="intro">
		<?php echo $faction['intro']; ?>
	</p>
	<?php if ($faction['desc']): ?>
		<div class="lore">
			<?php echo $faction['desc']; ?>
		</div>
	<?php endif; ?>

        <script type="text/javascript">
        //<![CDATA[
				$(function() {
					Npc.total = <?php echo sizeof($faction['creatures']); ?>;
					Npc.npcs = {
					<?php
					if ($faction['creatures']) :
						foreach ($faction['creatures'] as $c) :
					?>
						"<?php echo $c['npc_id']; ?>": {
							"id": <?php echo $c['npc_id']; ?>,
							"name": "<?php echo $c['npc_name']; ?>",
							"slug": "<?php echo $c['npc_key']; ?>"
						},
					<?php endforeach; endif; ?>
					};
				});
        //]]>
        </script>

		</div>

	<span class="clear"><!-- --></span>


		<?php if ($allowTabs) : ?>
			<div class="related">
				<div class="tabs ">
					<ul id="related-tabs">
						<?php
						if ($tabs) :
							foreach ($tabs as $key => $value) :
								if ($value <= 0)
									continue;
						?>
						
								<li>
									<a href="#<?php echo $key; ?>" data-key="<?php echo $key; ?>" id="tab-<?php echo $key; ?>">
										<span><span>
												<?php echo $l->getString('template_item_tab_' . $key); ?>
												(<em><?php echo $value; ?></em>)
										</span></span>
									</a>
								</li>
						<?php endforeach; endif; ?>
					</ul>

	<span class="clear"><!-- --></span>
				</div>

				<div id="related-content" class="loading">
				</div>
			</div>
		<?php endif; ?>

        <script type="text/javascript">
        //<![CDATA[
				$(function() {
					Wiki.pageUrl = '<?php echo $this->getWowUrl('faction/' . $faction['key']); ?>/';
				});
        //]]>
        </script>
	</div>