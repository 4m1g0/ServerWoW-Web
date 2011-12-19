<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<div class="filter-details">

	<div style="float:left;width:230px;position:relative;">
	<span style="padding:0px;float:left">
<?php
$cart = $store->getCart();
if (!$cart) : ?>
<h1 class="">Tu <a href="<?php echo $this->getWowUrl('store/cart'); ?>"><u>CARRO DE COMPRAS</u></a> esta vacio
<?php else : 
$price = $store->getTotalPrice();
?>
<h1 class="">Tienes <?php echo sizeof($cart); ?> item(s) en tu Carro de Compras <a href="<?php echo $this->getWowUrl('store/cart'); ?>"><B><u>Ir al Carro de Compras!</u></B></a>
<?php endif; ?>
<br /><br />Puntos Disponibles: <?php echo $this->c('AccountManager')->user('amount'); ?> (<a href="<?php echo $this->core->getCoreUrl('account/management/'); ?>"><u>COMPRAR MAS</u></a>)</h1>
</span>
<br><br><br>
<br><br><br>
	</div>

</div>
</div>
</div>

<div style="min-height:900px;">
<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
<?php if ($pagination) echo '<ul class="ui-pagination">' . $pagination . '</ul>'; ?><br />
<div class="item-results" id="item-results">
			<div class="table full-width">
				<table>
					<thead>
						<tr>
							<th><span class="sort-tab">Nombre</span></th>
							<th><span class="sort-tab">Item Level</span></th>
							<th><span class="sort-tab">Categoria</span></th>
							<th><span class="sort-tab">Precio</span></th>
							<th><span class="sort-tab">Disponible</span></th>
						</tr>
					</thead>
					<tbody>
					<?php
					
					if ($items) :
						$toggleStyle = 2;
						foreach ($items as &$i) :
					?>
						<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
						<?php
						if (isset($i['itemset_items'])) : ?>
						<td><?php echo $i['title']; ?> 
						<?php
							foreach ($i['itemset_items'] as $pi) :
						?>
							<a href="<?php echo $this->getWowUrl('item/' . $pi['entry']); ?>" class="item-link color-q<?php echo $pi['Quality']; ?>">
								<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/<?php echo $pi['icon']; ?>.jpg");'></span>
							</a>
						<?php
						endforeach;?>
						</td><?php
						else :
						?>
							<td<?php if ($i['storeInfo']['service_type'] == 0) : ?> data-raw="<?php echo (7 - $i['Quality']) . ' ' . $i['name']; ?>"<?php endif; ?>>
								<?php if ($i['storeInfo']['service_type'] == 0) : ?><a href="<?php echo $this->getWowUrl('item/' . $i['entry']); ?>" class="item-link color-q<?php echo $i['Quality']; ?>">
<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/<?php echo $i['icon']; ?>.jpg");'>
</span>
									<strong><?php echo $i['name']; ?></strong>
								</a>
								<?php else : echo $i['name'];
								if ($i['storeInfo']['service_type'] == SERVICE_GOLD)
									echo ' (' . $i['storeInfo']['gold_amount'] . ' gold)';
								elseif ($i['storeInfo']['service_type'] == SERVICE_PROFESSION)
									echo ' (' . $l->getString('profession_' . $i['storeInfo']['prof_skill_id']) . ')';
								?>
								<?php endif; ?>
							</td>
						<?php endif; ?>
							<td class="align-center">
								<?php
								if ($i['storeInfo']['service_type'] == 0 && isset($i['ItemLevel']))
									echo $i['ItemLevel'];
								else
									echo 'None';
								?>
							</td>
							<td class="align-center"><a href="<?php echo $this->getWowUrl('store/' . $i['storeInfo']['cat_id']); ?>"><?php echo $i['storeInfo']['catTitle']; ?></a>
							</td>
							<td>
							<?php
							$total_price = $i['storeInfo']['price'];
							if ($i['storeInfo']['discount'] > 0 && $i['storeInfo']['discount'] <= 100)
							{
								$total_price = floor($total_price - ($total_price / 100 * $i['storeInfo']['discount']));
								echo '<span style="color:red;">' . $total_price . '</span>';
							}
							else
								echo $total_price; ?> PTS
							</td>
							<td>
							<?php if ($i['storeInfo']['in_store']) : ?>
							<a href="<?php echo $this->getWowUrl('store/' . $i['storeInfo']['cat_id'] . '/' . $i['storeInfo']['item_id']); ?>">Adquirir!</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php ++$toggleStyle; endforeach; else : ?>
						<tr class="row1">
							<td colspan="5" class="align-center">Nothing found</td><?php endif; ?>
						</tr>

					</tbody>
				</table>
			</div>
		</div><br/>
	<?php if ($pagination) echo '<ul class="ui-pagination">' . $pagination . '</ul>'; ?>
	<span class="clear"><!-- --></span>

	</div>
	<div style="float:left;width:230px;position:relative;">

	<ul class="dynamic-menu" style="display:true">
				<li class="root-item item-active">
					<a href="<?php echo $this->getWowUrl('store'); ?>">
						<span class="arrow">Inicio</span>
					</a>
				</li>

		<?php
		$menu = $store->getMenuItems();
		$categoryId = $store->getCategoryId();
		foreach ($menu as $cat) : ?>
			<li class="has-submenu">
				<a href="<?php echo $this->getWowUrl('store/' . $cat['cat_id']); ?>"><span class="arrow"><?php echo $cat['title']; ?></span></a>
			</li>
		<?php endforeach; ?>
	</ul>
	</div>
</div>
	</div>
</div>