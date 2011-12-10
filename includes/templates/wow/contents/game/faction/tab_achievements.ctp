<div class="related-content" id="related-achievements">
	<div class="filters inline">
		<div class="keyword">
			<span class="view"></span>
			<span class="reset" style="display: none"></span>
			<input id="filter-name-achievements" type="text" class="input filter-name" data-filter="row" maxlength="25" title="Filtro..." value="Filtro..." />
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
		<span class="arrow">Descripción</span>
	</a>

							</th>
							<th class="align-center">
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow">Puntos</span>
	</a>

							</th>
							<th>
										<a href="javascript:;" class="sort-link default">
		<span class="arrow">Categoría</span>
	</a>

							</th>
					</tr>
				</thead>
			<tbody>
			<?php
			if ($tab) :
				$toggleStyle = 2;
				foreach ($tab as $ach) :
					if (!$ach)
						continue;
			?>

				<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
					<td>
	<a href="javascript:;" data-fansite="achievement|<?php echo $ach['id']; ?>|<?php echo $ach['name']; ?>" class="fansite-link float-right"> </a>

						<strong class="item-link" data-achievement="<?php echo $ach['id']; ?>">




		<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/<?php echo $ach['iconname']; ?>.jpg");'>
		</span>
							<span class="has-tip"><?php echo $ach['name']; ?></span>
						</strong>
						<?php if ($ach['factionFlag'] >= 0) : ?>
							<span class="icon-faction-<?php echo $ach['factionFlag']; ?>" data-tooltip="<?php echo $l->getString('faction_' . ($ach['factionFlag'] == FACTION_ALLIANCE ? 'alliance' : 'horde')); ?>"></span>
						<?php endif; ?>
					</td>
					<td>
						<?php
						if (mb_strlen($ach['description'], 'UTF-8') > 50)
							echo mb_substr($ach['description'], 0, 50, 'UTF-8') . '...';
						else
							echo $ach['description'];
						?>
					</td>
					<td class="align-center">
							<?php echo $ach['points']; ?><span class="icon-achievement-points"></span>
					</td>
					<td>
							<?php echo $ach['catTitle']; ?>
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
		Wiki.related['achievements'] = new WikiRelated('achievements', {
			paging: true,
			totalResults: <?php echo sizeof($tab); ?>,
			column: 0,
			method: 'default',
			type: 'asc'
		});
        //]]>
        </script>
</div>