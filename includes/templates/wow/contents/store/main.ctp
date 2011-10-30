<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<h1>World of Warcraft Store</h1>

<div class="filter-details">

<span class="clear"><!-- --></span>

<h1>Items in current category:</h1>
</div>
</div>
</div>

<div style="min-height:900px;">
<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
<div class="item-results" id="item-results">
	<?php echo $this->region('pagination'); ?>
			<div class="table full-width">
				<table>
					<thead>
						<tr>
							<th><span class="sort-tab">Name</span></th>
							<th><span class="sort-tab">Item Level</span></th>
							<th><span class="sort-tab">Category</span></th>
							<th><span class="sort-tab">Price</span></th>
							<th><span class="sort-tab">Available</span></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$items = $store->getItemsInCategory();
					if ($items) :
						$toggleStyle = 2;
						foreach ($items as &$i) :
					?>
						<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
							<td data-raw="<?php echo (7 - $i['Quality']) . ' ' . $i['name']; ?>">
								<a href="<?php echo $this->getWowUrl('item/' . $i['entry']); ?>" class="item-link color-q<?php echo $i['Quality']; ?>">
<span  class="icon-frame frame-18 " style='background-image: url("http://eu.media.blizzard.com/wow/icons/18/<?php echo $i['icon']; ?>.jpg");'>
</span>
									<strong><?php echo $i['name']; ?></strong>
								</a>
							</td>
							<td class="align-center">
								<?php echo $i['ItemLevel']; ?>
							</td>
							<td class="align-center"><a href="<?php echo $this->getWowUrl('store/' . $i['storeInfo']['cat_id']); ?>"><?php echo $i['storeInfo']['catTitle']; ?></a>
							</td>
							<td>
							$<?php echo $i['storeInfo']['price']; ?>
							</td>
							<td>
							<?php if ($i['storeInfo']['in_store']) : ?>
							<a href="<?php echo $this->getWowUrl('store/' . $i['storeInfo']['cat_id'] . '/' . $i['entry']); ?>">Buy!</a>
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
						<span class="arrow">Home</span>
					</a>
				</li>

		<?php
		$store_cats = $store->getCategories();
		$categoryId = $store->getCategoryId();
		foreach ($store_cats as $cat) : ?>
			<li class="has-submenu<?php //if ($cat['info']['cat_id'] == $categoryId) echo ' item-active'; ?>"><a href="<?php echo $this->getWowUrl('store/' . $cat['info']['cat_id']); ?>"><span class="arrow"><?php echo $cat['info']['title']; ?></span></a>
			<?php
			if ($cat['child']) : ?><ul class="dynamic-menu" id="menu-store<?php echo $cat['info']['cat_id']; ?>"><?php foreach ($cat['child'] as $child) :?>
				<li class="has-submenu<?php //if ($cat['info']['cat_id'] == $categoryId) echo ' item-active'; ?>"><a href="<?php echo $this->getWowUrl('store/' . $child['info']['cat_id']); ?>"><span class="arrow"><?php echo $child['info']['title']; ?></span></a>
				<?php
				if ($child['child']) : echo '<ul class="dynamic-menu" id="menu-store' . $child['info']['cat_id'] . '">'; foreach ($child['child'] as $ch) :
					?>
						<li class="has-submenu<?php //if ($cat['info']['cat_id'] == $categoryId) echo ' item-active'; ?>"><a href="<?php echo $this->getWowUrl('store/' . $ch['info']['cat_id']); ?>"><span class="arrow"><?php echo $ch['info']['title']; ?></span></a>
				<?php
					if ($ch['child']) : echo '<ul class="dynamic-menu" id="menu-store' . $ch['info']['cat_id'] . '">'; foreach ($ch['child'] as $c) :
					?>
							<li class="has-submenu<?php //if ($cat['info']['cat_id'] == $categoryId) echo ' item-active'; ?>"><a href="<?php echo $this->getWowUrl('store/' . $c['info']['cat_id']); ?>"><span class="arrow"><?php echo $c['info']['title']; ?></span></a>
				<?php
					if ($c['child']) : echo '<ul class="dynamic-menu" id="menu-store' . $ch['info']['cat_id'] . '">'; foreach ($c['child'] as $t) :
					?>
								<li<?php //if ($cat['info']['cat_id'] == $categoryId) echo ' class="item-active"'; ?>><a href="<?php echo $this->getWowUrl('store/' . $t['info']['cat_id']); ?>"><span class="arrow"><?php echo $t['info']['title']; ?></span></a>
							<?php endforeach; echo '</ul>'; endif; ?></li>
						<?php endforeach; echo '</ul>'; endif; ?></li>
				<?php endforeach; echo '</ul>'; endif; ?></li>
			<?php endforeach; ?></ul><?php endif;?></li>
		<?php endforeach; ?></li>

</ul><span style="padding:20px;float:left"><?php
$cart = $store->getCart();
if (!$cart) : ?>
<h1 class="color-q3">Your <a href="<?php echo $this->getWowUrl('store/cart'); ?>">cart</a> is empty</h1>
<?php else : 
$price = $store->getTotalPrice();
?>
<h1 class="color-q2">You have <?php echo sizeof($cart); ?> item(s) in your <a href="<?php echo $this->getWowUrl('store/cart'); ?>">cart</a><br />(Total price: $<?php echo $price; ?>)</h1>
<?php endif; ?></span>
	</div>
</div>
	</div>
</div>