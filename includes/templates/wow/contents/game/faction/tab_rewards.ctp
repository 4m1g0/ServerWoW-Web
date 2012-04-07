

<div class="related-content" id="related-rewards">


	<div class="filters inline">
		<div class="keyword">
			<span class="view"></span>
			<span class="reset" style="display: none"></span>
			<input id="filter-name-rewards" type="text" class="input filter-name" data-filter="row" maxlength="25" title="Filtro..." value="Filtro..." />
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
							<th>
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow">Coste</span>
	</a>

							</th>
							<th>
										<a href="javascript:;" class="sort-link numeric">
		<span class="arrow">Reputación</span>
	</a>

							</th>
					</tr>
				</thead>
			<tbody>
				<?php
				if ($tab) :
					$toggleStyle = 2;
					foreach ($tab as &$item) :
						if (!$item)
							continue;
				?>

				<tr class="row<?php echo $toggleStyle % 2 ? '1' : '0';
				if (isset($item['allowable_classes']) && is_array($item['allowable_classes']))
					foreach ($item['allowable_classes'] as $id => $c)
						echo ' class-' . $id;
				?> not-common">
					<td data-raw="<?php echo 7 - $item['Quality'] . ' ' . $item['name']; ?>">
						<a href="<?php echo $this->getWowUrl('item/' . $item['entry']); ?>" class="item-link color-q<?php echo $item['Quality']; ?>">




		<span  class="icon-frame frame-18 " style='background-image: url("<?php echo $this->getMediaServer(); ?>/wow/icons/18/<?php echo $item['icon']; ?>.jpg");'>
		</span>
							<strong><?php echo $item['name']; ?></strong>

						</a>
					</td>
					<td class="align-center" data-raw="<?php echo $item['ItemLevel']; ?>">
							<?php echo $item['ItemLevel']; ?>
					</td>
					<td class="align-center" data-raw="<?php echo $item['RequiredLevel']; ?>">
							<?php echo $item['RequiredLevel']; ?>
					</td>
						<td data-raw="<?php echo $item['SellPrice']; ?>">
						<?php if ($item['SellPrice'] > 0 && isset($item['sell_price']) && $item['sell_price']) :
							foreach ($item['sell_price'] as $type => $value) :
								if ($value > 0) :
						?>
							<span class="icon-<?php echo $type; ?>"><?php echo $value; ?></span>
						<?php endif; endforeach; endif; ?>



</td>
						<td data-raw="<?php echo $item['RequiredReputationRank']; ?>"><?php echo $l->getString('reputation_rank_' . $item['RequiredReputationRank']); ?></td>
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
		Wiki.related['rewards'] = new WikiRelated('rewards', {
			paging: true,
			totalResults: <?php echo sizeof($tab); ?>,
				column: 5,
				method: 'default',
				type: 'desc'
		});

        //]]>
        </script>
</div>
