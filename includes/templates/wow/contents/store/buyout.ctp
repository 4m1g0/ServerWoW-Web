<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<h1>World of Warcraft Store</h1>

<div class="filter-details">

<span class="clear"><!-- --></span>

<h1>Items in your cart:</h1>
</div>
</div>
</div>
<script><?php $xstoken = $this->c('Cookie')->read('xstoken'); ?>Store.init(<?php echo $xstoken; ?>);</script>
<div style="min-height:900px;">
<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
	
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
<h1 class="color-q3">Your <a href="<?php echo $this->getWowUrl('store/cart'); ?>">cart</a> is empty</h1>
<?php else : 
$price = $store->getTotalPrice();
?>
<h1 class="color-q2">You have <?php echo sizeof($cart); ?> item(s) in your <a href="<?php echo $this->getWowUrl('store/cart'); ?>">cart</a><br />(Total price: $<?php echo $price; ?>)</h1>
<br />
<a href="<?php echo $this->getWowUrl('store/cart/buyout'); ?>">Buyout</a>
<?php endif; ?></span>
	</div>
</div>
	</div>
</div>