<div class="related-content" id="related-npcs">
	<div class="filters inline">
		<div class="keyword">
			<span class="view"></span>
			<span class="reset" style="display: none"></span>
			<input id="filter-name-npcs" type="text" class="input filter-name" data-filter="row" maxlength="25" title="Filtro..." value="Filtro..." />
		</div>

		

		
	<span class="clear"><!-- --></span>
	</div>
	
		<div class="data-options-top">





	<div class="table-options data-options ">
			<div class="option">

				<ul class="ui-pagination"></ul>

			</div>


			Mostrando <strong class="results-start">1</strong>–<strong class="results-end"><?php echo min(50, sizeof($tab)); ?></strong> de <strong class="results-total"><?php echo sizeof($tab); ?></strong> resultados

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
							<th>
										<a href="javascript:;" class="sort-link default">
		<span class="arrow">Tipo</span>
	</a>

							</th>
							<th class="align-center">
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow">Nivel</span>
	</a>

							</th>
					</tr>
				</thead>
			<tbody>

			<?php
			if ($tab) :
				$toggleStyle = 2;
				foreach ($tab as $npc) :
					if (!$npc)
						continue;
			?>
				<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
					<td style="width: 50%">
	<a href="javascript:;" data-fansite="npc|<?php echo $npc['entry'] . '|' . $npc['name']; ?>" class="fansite-link float-right"> </a>
		<strong><?php echo $npc['name']; ?></strong>

		<?php if ($npc['subname']) : ?>
		<em>&#60;<?php echo $npc['subname']; ?>&#62;</em>
		<?php endif; ?>
					</td>
					<td>
							<?php echo $l->getString('creature_type_' . $npc['type']); ?>
					</td>
					<td data-raw="<?php echo $npc['maxlevel']; ?>" class="align-center">
							<?php echo $npc['maxlevel']; ?>
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


			Mostrando <strong class="results-start">1</strong>–<strong class="results-end"><?php echo min(50, sizeof($tab)); ?></strong> de <strong class="results-total"><?php echo sizeof($tab); ?></strong> resultados

	<span class="clear"><!-- --></span>
	</div>
		</div>

        <script type="text/javascript">
        //<![CDATA[
		Wiki.related['npcs'] = new WikiRelated('npcs', {
			paging: true,
			totalResults: <?php echo sizeof($tab); ?>,
			column: 0,
			method: 'default',
			type: 'asc'
		});
        //]]>
        </script>
</div>