<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<h1>ServerWoW Tienda & Servicios</h1>

<div class="filter-details">

<span class="clear"><!-- --></span>

<h1>Items en tu carro:</h1>
</div>
</div>
</div>
<script><?php $xstoken = $this->c('Cookie')->read('xstoken'); ?>Store.init(<?php echo $xstoken; ?>);</script>
<div style="min-height:900px;">
<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
<div class="item-results" id="item-results">
	<?php echo $this->region('pagination'); ?>
			<div class="table full-width">
				<table>
					<thead>
						<tr>
							<th><span class="sort-tab">Nombre</span></th>
							<th><span class="sort-tab">Item Level</span></th>
							<th><span class="sort-tab">Categoria</span></th>
							<th><span class="sort-tab">Precio</span></th>
							<th><span class="sort-tab">Cantidad</span></th>
							<th><span class="sort-tab">Acciones</span></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$items = $store->getCartItems();
					if ($items) :
						$toggleStyle = 2;
						foreach ($items as &$i) :
					?>
						<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>" id="removefromcart-link-<?php echo $i['storeInfo']['item_id']; ?>">
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
							<?php if ($i['storeInfo']['service_type'] == 0) : ?>
								<a href="<?php echo $this->getWowUrl('item/' . $i['entry']); ?>" class="item-link color-q<?php echo $i['Quality']; ?>">
									<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/<?php echo $i['icon']; ?>.jpg");'>
									</span>
									<strong><?php echo $i['name']; ?></strong>
								</a>
							<?php else : ?>
							<strong><?php echo $i['name']; ?></strong><?php endif; ?>
							</td>
						<?php endif; ?>
							<td class="align-center">
								<?php if ($i['storeInfo']['service_type'] == 0 && isset($i['ItemLevel'])) echo $i['ItemLevel']; else echo 'None'; ?>
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
								echo $total_price; ?> puntos
							</td>
							<td>
							<?php echo $i['storeInfo']['quantity']; ?>
							</td>
							<td>
							<?php if ($i['storeInfo']['in_store']) : ?>
							<a href="javascript:;" onclick="Store.removeFromCart(<?php echo $i['storeInfo']['item_id'] . ', ' . $xstoken; ?>);">Quitar</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php ++$toggleStyle; endforeach; endif; ?>

					</tbody>
				</table>
			</div>
	<?php echo $this->region('pagination'); ?>
		</div>
	<span class="clear"><!-- --></span>

	</div>
	<div style="float:left;width:230px;position:relative;">

	<ul class="dynamic-menu" id="menu-pvp" style="display:true">
				<li class="root-item  item-active">
					<a href="<?php echo $this->getWowUrl('store'); ?>">
						<span class="arrow">Store</span>
					</a>
				</li>

</ul><span style="padding:20px;float:left"><?php
$cart = $store->getCart();
if (!$cart) : ?>
<h1 class="color-q3">Tu <a href="<?php echo $this->getWowUrl('store/cart'); ?>"><u>CARRO DE COMPRAS</u></a> esta vacio
<br /><br />Puntos Disponibles: <?php echo $this->c('AccountManager')->user('amount'); ?> (<a href="<?php echo $this->core->getCoreUrl('account/management/'); ?>"><u>COMPRAR MAS</u></a>)</h1>
<?php else : 
$price = $store->getTotalPrice();
?>
<h1 class="color-q2">Tienes <?php echo sizeof($cart); ?> item(s) en tu <a href="<?php echo $this->getWowUrl('store/cart'); ?>"><u>CARRO DE COMPRAS</u></a><br />(Precio Total: <?php echo $price; ?> puntos)
<br /><br />Puntos Disponibles: <?php echo $this->c('AccountManager')->user('amount'); ?> (<a href="<?php echo $this->core->getCoreUrl('account/management/'); ?>"><u>COMPRAR MAS</u></a>)</h1>
<br />
<a href="<?php echo $this->getWowUrl('store/cart/buyout'); ?>"><u>COMPRAR</u></a>
<?php endif; ?></span>
	</div>
</div>
	</div>
</div>