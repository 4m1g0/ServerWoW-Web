<?php
$cats = $admin->getStoreCategories();
if (!$cats) return ;
?>
<h3>Add Category</h3>
<form action="" method="post">
<div class="input select">
Parent category
<select name="cat[parent_id]">
<option value="-1"<?php if (!isset($_POST['cat']['parent_id']) || $_POST['cat']['parent_id'] == -1) echo ' selected="selected"'; ?>>-None-</option>
<?php
$cats = $admin->getStoreCategories();
if ($cats) : foreach ($cats as $c) :
?>
	<option value="<?php echo $c['cat_id']; ?>"<?php if (isset($_POST['cat']['parent_id']) && $_POST['cat']['parent_id'] == $c['cat_id']) echo ' selected="selected"'; ?>><?php echo $c['title']; ?></option>
<?php endforeach; endif; ?>
</select>
</div>
<div class="input text long">
Title
<input type="text" name="cat[title]" value="<?php if (isset($_POST['cat']['title'])) echo $_POST['cat']['title']; ?>" size=50 />
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>