<?php
$cat = $admin->getEditableCategory();
$cats = $admin->getForumCategories();
if (!$cat) return;
?>
<h3>Edit Category</h3>
<a href="/admin/forums/add">Add Category</a> |
<a href="/admin/forums/delete/<?php echo $cat['cat_id']; ?>">Delete Current</a>
<form action="" method="post">
<input type="hidden" name="cat[id]" value="<?php echo $cat['cat_id']; ?>" size=50 />
<div class="input text long">
Title
<input type="text" name="cat[title]" value="<?php echo $cat['title']; ?>" size=50 />
</div>
<div class="input checkbox">
<br/><input type="checkbox" name="cat[header]" id="header" value="1"<?php if ($cat['header']) echo ' checked="checked"'; ?> /> <label for="header">This category is main category</label><br/><br/>
</div>
<div class="input select">
Parent Category
<select name="cat[parent_cat]">
<option value="0">-None-</option>
<?php foreach ($cats as $c) : ?>
<option value="<?php echo $c['cat_id']; ?>"><?php echo $c['title']; ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="input checkbox">
<br/><input type="checkbox" name="cat[short]" id="short" value="1"<?php if ($cat['short']) echo ' checked="checked"'; ?> /> <label for="short">Small box</label><br/><br/>
</div>
<div class="input checkbox">
<input type="checkbox" name="cat[realm_cat]" id="realm_cat" value="1"<?php if ($cat['realm_cat']) echo ' checked="checked"'; ?> /> <label for="realm_cat">Realm Category</label><br/><br/>
</div>
<div class="input text long">
GM Level Access:
<input type="text" name="cat[gmlevel]" value="<?php echo $cat['gmlevel']; ?>" size=50 />
</div>
<div class="input text long">
Description
<input type="text" name="cat[desc]" value="<?php echo $cat['desc']; ?>" size=50 />
</div>
<div class="input text long">
Icon
<input type="text" name="cat[icon]" value="<?php echo $cat['icon']; ?>" size=50 />
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>