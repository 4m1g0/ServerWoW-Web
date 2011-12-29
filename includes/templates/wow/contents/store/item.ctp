<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<h1>ServerWoW Tienda & Servicios</h1>

<div class="filter-details">

<span class="clear"><!-- --></span>
<?php if (!$store) return;
$store_item = $store->getItem();
if (!$store_item) return;
$item = $store_item['template'];
if (!$item) return;
?>
<script><?php $xstoken = $this->c('Cookie')->read('xstoken'); ?>Store.init(<?php echo $xstoken; ?>);</script>
<?php if ($store_item['store']['service_type'] == 0) : ?>
<?php
if (trim($store_item['store']['itemset_pieces']) != '') : ?>
<h1 class="color-q5"><?php echo $store_item['store']['title']; ?></h1>
<h2 class="color-q2">Price: <?php
if ($store_item['store']['discount'] > 0 && $store_item['store']['discount'] <= 100)
	echo '<span style="color:red">' . floor($store_item['store']['price'] - ($store_item['store']['price'] / 100 * $store_item['store']['discount'])) . '</span>';
else
	echo $store_item['store']['price'];
?> points</h2>
<h3>Items in itemset:</h3>
<ul>
<?php
foreach ($store_item['itemset_items'] as $pi) :
?>
<li>
<a href="<?php echo $this->getWowUrl('item/' . $pi['entry']); ?>" class="item-link color-q<?php echo $pi['Quality']; ?>">
<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/<?php echo $pi['icon']; ?>.jpg");'></span>
 <?php echo $pi['name']; ?></a></li>
<?php
endforeach;
?>
</ul>
<span id="add2cart-link-<?php echo $store_item['store']['item_id']; ?>" style="display:<?php if (!$store->isItemInCart($store_item['store']['item_id'])) echo 'true'; else echo 'none'; ?>;">
	<input type="hidden" id="item-<?php echo $store_item['store']['item_id']; ?>-quantity" value="1" /><br />
	<a href="javascript:;" onclick="Store.addToCart(<?php echo $store_item['store']['item_id'] . ', ' . $store_item['store']['cat_id'] . ', ' . $xstoken; ?>);"><u>A&ntildeadir al Carro</u></a>
</span>
<?php
else :
?>
<h1 class="color-q<?php echo $item['Quality']; ?>"><a href="<?php echo $this->getWowUrl('item/' . $item['entry']); ?>"><?php

echo $item['name']; ?></a></h1>
<h2 class="color-q2">Price: <?php
if ($store_item['store']['discount'] > 0 && $store_item['store']['discount'] <= 100)
	echo '<span style="color:red">' . floor($store_item['store']['price'] - ($store_item['store']['price'] / 100 * $store_item['store']['discount'])) . '</span>';
else
	echo $store_item['store']['price'];
?> points</h2>
<span id="add2cart-link-<?php echo $item['entry']; ?>" style="display:<?php if (!$store->isItemInCart($store_item['store']['item_id'])) echo 'true'; else echo 'none'; ?>;">
	Quantity: <input type="text" id="item-<?php echo $item['entry']; ?>-quantity" value="1" /><br />
	<a href="javascript:;" onclick="Store.addToCart(<?php echo $item['entry'] . ', ' . $store_item['store']['cat_id'] . ', ' . $xstoken; ?>);"><u>A&ntildeadir al Carro</u></a>
	
</span>
<div id="op-result-<?php echo $item['entry']; ?>"><?php if ($store->isItemInCart($item['entry'])) : ?>This item is in your <a href="<?php echo $this->getWowUrl('store/cart'); ?>">cart</a>!<?php endif; ?></div>
<span id="removefromcart-link-<?php echo $item['entry']; ?>" style="display:<?php if ($store->isItemInCart($store_item['store']['item_id'])) echo 'true'; else echo 'none'; ?>;"><a href="javascript:;" onclick="Store.removeFromCart(<?php echo $item['entry'] . ', ' . $xstoken; ?>);"><u>Quitar del Carro</u></a></span>
<?php endif; else : ?>
<h1 class="color-q2"><?php echo $store_item['service']['name']; ?></h1><em>Service</em>
<span id="add2cart-link-<?php echo $store_item['store']['item_id']; ?>" style="display:<?php if (!$store->isItemInCart($store_item['store']['item_id'])) echo 'true'; else echo 'none'; ?>;">
	<?php
	$store_actions = array(
		SERVICE_POWERLEVEL => 'template_store_service_powerlevel_caption',
	);
	if (in_array($store_item['store']['service_type'], array(SERVICE_POWERLEVEL))) : ?>
	<br/><?php echo $l->getString($store_actions[$store_item['store']['service_type']]); ?>: <input type="text" id="item-<?php echo $store_item['store']['item_id']; ?>-quantity" value="1" /><br />
	<?php else : ?>
	<input type="hidden" id="item-<?php echo $store_item['store']['item_id']; ?>-quantity" value="1" /><br />
	<?php endif; ?>
	<a href="javascript:;" onclick="Store.addToCart(<?php echo $store_item['store']['item_id'] . ', ' . $store_item['store']['cat_id'] . ', ' . $xstoken; ?>);"><u>A&ntildeadir al Carro</u></a>
</span>
<?php endif;?>
</div>
</div>
</div>
	</div>
</div>