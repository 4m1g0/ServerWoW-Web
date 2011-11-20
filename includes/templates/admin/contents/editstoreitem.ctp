<?php
$cats = $admin->getStoreCategories();
$item = $admin->getStoreItem($this->core->getUrlAction(3));
if (!$cats || !$item) return ;
?>
<h3>Edit Item</h3>
<form action="" method="post">
<input type="hidden" name="item[id]" value="<?php echo $item['item_id']; ?>" />
<div class="input select">
Category
<select name="item[cat_id]">
<?php
$cats = $admin->getStoreCategories();
if ($cats) : foreach ($cats as $c) :
?>
	<option value="<?php echo $c['cat_id']; ?>"<?php if ($item['cat_id'] == $c['cat_id']) echo ' selected="selected"'; ?>><?php echo $c['title']; ?></option>
<?php endforeach; endif; ?>
</select>
</div>
<div class="input text long">
ID
<?php echo $item['item_id']; ?>
</div>
<div class="input text long">
Title
<input type="text" name="item[title]" value="<?php echo $item['title']; ?>" size=50 />
</div>
<div class="input text long">
Price
<input type="text" name="item[price]" value="<?php echo $item['price']; ?>" size=50 />
</div><br />
<div class="input checkbox">
<input type="checkbox" name="item[in_store]" value="1" <?php if ($item['in_store']) echo ' checked="checked"'; ?> id="instore" /><label for="instore">Available in store</label>
</div>
<br />
<div class="input checkbox">
<input type="checkbox" name="item[itemset]" value="1" <?php if (trim($item['itemset_pieces']) != '') echo ' checked="checked"'; ?> id="itemset" /><label for="itemset">Itemset</label>
</div><br />
<div class="input text long">
Itemset pieces ("32458 32459 32460", for example)
<input type="text" name="item[itemset_pieces]" value="<?php echo $item['itemset_pieces']; ?>" size=50 />
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>