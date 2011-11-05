<?php
$cats = $admin->getStoreCategories();
if (!$cats) return ;
?>
<h3>Add Item</h3>
<form action="" method="post">
<div class="input select">
Category
<select name="item[cat_id]">
<?php
$cats = $admin->getStoreCategories();
if ($cats) : foreach ($cats as $c) :
?>
	<option value="<?php echo $c['cat_id']; ?>"<?php if (isset($_POST['item']['cat_id']) && $_POST['item']['cat_id'] == $c['cat_id']) echo ' selected="selected"'; ?>><?php echo $c['title']; ?></option>
<?php endforeach; endif; ?>
</select>
</div>
<div class="input text long">
ID
<input type="text" name="item[id]" value="<?php if (isset($_POST['item']['id'])) echo $_POST['item']['id']; ?>" size=50 />
</div>
<div class="input text long">
Title
<input type="text" name="item[title]" value="<?php if (isset($_POST['item']['title'])) echo $_POST['item']['title']; ?>" size=50 />
</div>
<div class="input text long">
Price
<input type="text" name="item[price]" value="<?php if (isset($_POST['item']['price'])) echo $_POST['item']['price']; else echo '0'; ?>" size=50 />
</div><br />
<div class="input checkbox">
<input type="checkbox" name="item[in_store]" value="1" <?php if (isset($_POST['item']['title'])) echo ' checked="checked"'; ?> id="instore" /><label for="instore">Available in store</label>
</div><br />
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>