

<div class="related-content" id="related-quests">
	<div class="filters inline">
		<div class="keyword">
			<span class="view"></span>
			<span class="reset" style="display: none"></span>
			<input id="filter-name-quests" type="text" class="input filter-name" data-filter="row" maxlength="25" title="Filtro..." value="Filtro..." />
		</div>

			<div class="filter-tabs">
				<a href="javascript:;" data-filter="class" data-value="" class="tab-active" data-name="type">
					Todos
				</a>

				<a href="javascript:;" data-filter="class" data-value="quest-regular" data-name="type">
					Normal (<?php echo $tab['normal']; ?>)
				</a>

				<a href="javascript:;" data-filter="class" data-value="quest-daily" data-name="type">
					Diaria (<?php echo $tab['daily']; ?>)
				</a>

			</div>
	<span class="clear"><!-- --></span>
		

		
	<span class="clear"><!-- --></span>
	</div>

		<div class="data-options-top">





	<div class="table-options data-options ">
			<div class="option">

				<ul class="ui-pagination"></ul>

			</div>


			Mostrando <strong class="results-start">1</strong>–<strong class="results-end"><?php echo min(50, sizeof($tab['quests'])); ?></strong> de <strong class="results-total"><?php echo sizeof($tab['quests']); ?></strong> resultados

	<span class="clear"><!-- --></span>
	</div>
		</div>


	<div class="table full-width">
		<table>
				<thead>
					<tr>
							<th>
										<a href="javascript:;" class="sort-link default">
		<span class="arrow">Nombre</span>
	</a>

							</th>
							<th class="align-center">
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow">Nivel</span>
	</a>

							</th>
							<th class="align-center">
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow">Requiere</span>
	</a>

							</th>
							<th class="align-center">
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow">Reputación</span>
	</a>

							</th>
					</tr>
				</thead>
			<tbody>

			<?php
			if ($tab['quests']) :
				$toggleStyle = 2;
				foreach ($tab['quests'] as $q) :
					if (!$q || $q['QuestLevel'] < 0)
						continue;
			?>
				<tr class="row<?php echo $toggleStyle %2 ? '1' : '2'; ?> quest-regular">
					<td>
	<a href="javascript:;" data-fansite="quest|<?php echo $q['entry']; ?>|<?php echo $q['Title']; ?>" class="fansite-link float-right"> </a>

						<strong data-quest="<?php echo $q['entry']; ?>">
							<?php echo $q['Title']; ?></strong>

					</td>
					<td data-raw="<?php echo $q['QuestLevel']; ?>" class="align-center">
							<?php echo $q['QuestLevel']; ?>
					</td>
					<td data-raw="<?php echo $q['MinLevel']; ?>" class="align-center">
							<?php echo $q['MinLevel']; ?>
					</td>
						<td data-raw="<?php
						for ($i = 1; $i < 6; ++$i)
							if ($q['RewRepFaction' . $i] == $faction['id'])
								echo $q['RewRepValueId' . $i];
						?>" class="align-center">
							<?php
						for ($i = 1; $i < 6; ++$i)
							if ($q['RewRepFaction' . $i] == $faction['id'])
								echo $q['RewRepValueId' . $i];
						?>
						</td>
				</tr>
			<?php ++$toggleStyle; endforeach; endif; ?>

			</tbody>
		</table>
	</div>

		<div class="data-options-bottom">





	<div class="table-options data-options ">
			<div class="option">

				<ul class="ui-pagination"></ul>

			</div>


			Mostrando <strong class="results-start">1</strong>–<strong class="results-end"><?php echo min(50, sizeof($tab['quests'])); ?></strong> de <strong class="results-total"><?php echo sizeof($tab['quests']); ?></strong> resultados

	<span class="clear"><!-- --></span>
	</div>
		</div>

        <script type="text/javascript">
        //<![CDATA[
		Wiki.related['quests'] = new WikiRelated('quests', {
			paging: true,
			totalResults: <?php echo sizeof($tab['quests']); ?>,
			column: 0,
			type: 'asc'
		});
        //]]>
        </script>
</div>

