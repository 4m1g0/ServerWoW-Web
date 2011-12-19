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
</div>
<div class="input select">
Service Type
<select name="item[service]">
<option value="0"<?php if (!isset($_POST['item']['service']) || (isset($_POST['item']['service']) && $_POST['item']['service'] == 0)) echo ' selected="selected"'; ?>>-- No Service --</option>
<?php
foreach ($GLOBALS['_STORE_SERVICES'] as $c) :
?>
	<option value="<?php echo $c[0]; ?>"<?php if ($item['service_type'] == $c[0]) echo ' selected="selected"'; ?>><?php echo $c[1]; ?></option>
<?php endforeach; ?>
</select>
</div><br />
<div class="input checkbox">
<input type="checkbox" name="item[in_store]" value="1" <?php if ($item['in_store']) echo ' checked="checked"'; ?> id="instore" /><label for="instore">Available in store</label>
</div>
<br />
<div class="input checkbox">
<script language="javascript">
	$(document).ready(function() {
		<?php if ($item['itemset_pieces'] != '') echo '$(\'#isetpieces\').show();'; ?>
	});
</script>
<input type="checkbox" onclick="if ($(this).attr('checked')) $('#isetpieces').show(); else $('#isetpieces').hide();" name="item[itemset]" value="1" <?php if (trim($item['itemset_pieces']) != '') echo ' checked="checked"'; ?> id="itemset" /><label for="itemset">Itemset</label>
</div><br />
<div class="input text long" id="isetpieces" style="display:none;">
Itemset pieces ("32458 32459 32460", for example)
<input type="text" name="item[itemset_pieces]" value="<?php echo $item['itemset_pieces']; ?>" size=50 />
</div>
<div class="input text long">
Price Discount (%; left 0 to disable discounts):
<input type="text" name="item[discount]" value="<?php echo $item['discount']; ?>" />
</div>
<div class="input text long">
Gold Amount (GOLD_ITEM is enabled if value > 0):
<input type="text" name="item[gold_amount]" value="<?php echo $item['gold_amount']; ?>" />
</div>
<div class="input select">
Profession SKILL ID:
<select name="item[prof_skill_id]">
<option value="0"<?php if ($item['prof_skill_id'] == 0) echo ' selected="selected"'; ?>>-- No Profession --</option>
<?php

foreach ($GLOBALS['_STORE_PROFESSIONS'] as $c) :
?>
	<option value="<?php echo $c; ?>"<?php if ($item['prof_skill_id'] == $c) echo ' selected="selected"'; ?>><?php echo $l->getString('profession_' . $c); ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>