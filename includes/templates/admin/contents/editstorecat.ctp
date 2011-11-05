<?php
$cat = $admin->getStoreCategory();
$cats = $admin->getStoreCategories();
if (!$cat) return ;
?>
<h3>Edit Category</h3>
<a href="/admin/store/category/add">Add Category</a> |
<a href="/admin/store/category/<?php echo $cat['cat_id']; ?>/items">Show Items</a> |
<a href="/admin/store/category/<?php echo $cat['cat_id']; ?>/delete" onclick="return confirm('Are you sure you want to delete store category?\nAll items in current category will be deleted too!');">Delete Current</a>
<hr />
<form action="" method="post">
<input type="hidden" name="cat[cat_id]" value="<?php echo $cat['cat_id']; ?>" />
<div class="input select">
Parent category
<select name="cat[parent_id]">
<option value="-1"<?php if ($cat['cat_id'] == -1) echo ' selected="selected"'; ?>>-None-</option>
<?php
$cats = $admin->getStoreCategories();
if ($cats) : foreach ($cats as $c) :
?>
	<option value="<?php echo $c['cat_id']; ?>"<?php if ($c['cat_id'] == $cat['parent_id']) echo ' selected="selected"'; ?>><?php echo $c['title']; ?></option>
<?php endforeach; endif; ?>
</select>
</div>
<div class="input text long">
Title
<input type="text" name="cat[title]" value="<?php echo $cat['title']; ?>" size=50 />
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>