<?php
$realms_str = '';
$chars_str = array();
$chars = $this->c('AccountManager')->getCharacters();
$char_realms = array();

foreach ($chars as $c)
	$char_realms[$c['realmId']][] = $c;

foreach ($char_realms as $rId => $rc)
{
	foreach ($rc as $cr)
	{
		if (!isset($chars_str[$rId]))
			$chars_str[$rId] = '';

		$chars_str[$rId] .= '<option value="' . $cr['guid'] . '">' . $cr['name'] . '</option>';
	}
}

foreach ($this->c('Config')->getValue('realms') as $realm)
	$realms_str .= '<option value="' . $realm['id'] . '">' . $realm['name'] . '</option>';
?>
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
<script>
<?php
$items = $store->getCartItems();
echo 'var items_count = ' . sizeof($items) . ';';
?>

var totalPrice = <?php echo $store->getCartPrice(); ?>;
var totalPoints = <?php echo $this->c('AccountManager')->user('amount'); ?>;
var postdata = [];
var lastIdx = 0;
function getCharactersList(realmId, itemId)
{
	if (!itemId || !realmId)
		return;

	if (!$('#item' + itemId + 'character').length)
		return;

	var characters = [];
	<?php foreach ($chars_str as $realm => $str) : ?>
characters[<?php echo $realm; ?>] = '<?php echo $str; ?>';
<?php endforeach; ?>

	if (!characters[realmId].length)
		return;

	$('#item' + itemId + 'character').html(
		'<option value="0">-- Select --</option>' + characters[realmId]
	);
}

function setCharacter(guid, itemId)
{
	if (!guid || !itemId)
		return;

	var found = false;

	for (var i = 0; i < lastIdx; ++i)
	{
		if (postdata[i].item == itemId)
		{
			// Update
			postdata[i] = {item: itemId, realm: $('#item' + itemId + 'realm').val(), guid: guid};
			found = true;
		}
	}

	if (!found)
	{
		postdata[lastIdx] = {item: itemId, realm: $('#item' + itemId + 'realm').val(), guid: guid};
		++lastIdx;
	}
}

function buyout()
{
	if (totalPrice > totalPoints)
	{
		$('#error').html('You don\'t have enough points to buy all items listed here. Please, <a href="<?php echo $this->getWowUrl('store/cart'); ?>">remove some of them</a> or <a href="<?php echo $this->getCoreUrl('account/management/payments'); ?>">buy some more points</a>.');
		return false;
	}

	if (lastIdx < items_count)
	{
		$('#error').html('Please, make sure that you have selected character for all items.');
		return false;
	}

	$('#error').html('');

	$.ajax({
		url: '<?php echo $this->getWowUrl('store/api2/buyoutall'); ?>',
		type: 'POST',
		data: {'buyout': postdata},
		success: function(data) {
			location.href = '<?php echo $this->getWowUrl('store/cart'); ?>';
		}
	});
}
</script>
<div style="min-height:900px;">
<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
<div class="item-results" id="item-results">
	<?php echo $this->region('pagination'); ?>
			<div class="table full-width">
				<table>
					<thead>
						<tr>
							<th><span class="sort-tab">Name</span></th>
							<th><span class="sort-tab">Realm Name</span></th>
							<th><span class="sort-tab">Character Name</span></th>
						</tr>
					</thead>
					<tbody>
					<?php
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
								<select id="item<?php echo $i['storeInfo']['item_id']; ?>realm" onchange="getCharactersList($(this).val(), <?php echo $i['storeInfo']['item_id']; ?>);">
									<option value="0">-- Select -- </option>
									<?php echo $realms_str; ?>
								</select>
							</td>
							<td class="align-center">
								<select id="item<?php echo $i['storeInfo']['item_id']; ?>character" onchange="setCharacter($(this).val(), <?php echo $i['storeInfo']['item_id']; ?>);">
									<option value="0">-- Select -- </option>
								</select>
							</td>
						</tr>
					<?php ++$toggleStyle; endforeach; endif; ?>

					</tbody>
				</table>
			</div>
			<button onclick="buyout();">Buyout</button>
			<div id="error"></div>
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
<h1 class="color-q3">Your <a href="<?php echo $this->getWowUrl('store/cart'); ?>">cart</a> is empty
<br /><br />Available Points: <?php echo $this->c('AccountManager')->user('amount'); ?> (<a href="<?php echo $this->core->getCoreUrl('account/management/payments'); ?>">Buy more</a>)</h1>
<?php else : 
$price = $store->getTotalPrice();
?>
<h1 class="color-q2">You have <?php echo sizeof($cart); ?> item(s) in your <a href="<?php echo $this->getWowUrl('store/cart'); ?>">cart</a><br />(Total price: <?php echo $price; ?> points)
<br /><br />Available Points: <?php echo $this->c('AccountManager')->user('amount'); ?> (<a href="<?php echo $this->core->getCoreUrl('account/management/payments'); ?>">Buy more</a>)</h1>
<br />
<a href="<?php echo $this->getWowUrl('store/cart/buyout'); ?>">Buyout</a>
<?php endif; ?></span>
	</div>
</div>
	</div>
</div>