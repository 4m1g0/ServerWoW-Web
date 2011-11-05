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
					<?php ++$toggleStyle; endforeach; else : ?>
						<tr class="row1">
							<td colspan="5" class="align-center">Nothing found</td><?php endif; ?>
						</tr>

					</tbody>
				</table>
			</div>
	<?php echo $this->region('pagination'); ?>
		</div>
	<span class="clear"><!-- --></span>

	</div>
	<div style="float:left;width:230px;position:relative;">

	<ul class="dynamic-menu" style="display:true">
				<li class="root-item item-active">
					<a href="<?php echo $this->getWowUrl('store'); ?>">
						<span class="arrow">Home</span>
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