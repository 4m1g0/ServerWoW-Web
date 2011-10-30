<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<h1>World of Warcraft Store</h1>

<div class="filter-details">

<span class="clear"><!-- --></span>
<?php if (!$store) return;
$store_item = $store->getItem();
if (!$store_item) return;
$item = $store_item['template'];
?>
<script><?php $xstoken = $this->c('Cookie')->read('xstoken'); ?>Store.init(<?php echo $xstoken; ?>);</script>
<h1 class="color-q<?php echo $item['Quality']; ?>"><a href="<?php echo $this->getWowUrl('item/' . $item['entry']); ?>"><?php

echo $item['name']; ?></a></h1>
<h2 class="color-q2">Price: <?php echo $store_item['store']['price']; ?></h2>
<span id="add2cart-link-<?php echo $item['entry']; ?>" style="display:<?php if (!$store->isItemInCart($store_item['store']['item_id'])) echo 'true'; else echo 'none'; ?>;">
	Quantity: <input type="text" id="item-<?php echo $item['entry']; ?>-quantity" value="1" /><br />
	<a href="javascript:;" onclick="Store.addToCart(<?php echo $item['entry'] . ', ' . $store_item['store']['cat_id'] . ', ' . $xstoken; ?>);">Add to Cart</a>
	
</span>
<div id="op-result-<?php echo $item['entry']; ?>"><?php if ($store->isItemInCart($item['entry'])) : ?>This item is in your <a href="<?php echo $this->getWowUrl('store/cart'); ?>">cart</a>!<?php endif; ?></div>
<span id="removefromcart-link-<?php echo $item['entry']; ?>" style="display:<?php if ($store->isItemInCart($store_item['store']['item_id'])) echo 'true'; else echo 'none'; ?>;"><a href="javascript:;" onclick="Store.removeFromCart(<?php echo $item['entry'] . ', ' . $xstoken; ?>);">Remove from Cart</a></span>
</div>
</div>
</div>
	</div>
</div>