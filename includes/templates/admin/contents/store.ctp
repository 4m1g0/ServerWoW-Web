<h3>Store Management</h3>
<a href="/admin/store/category/add">Add Category</a> | <a href="/admin/store/item/add">Add Item</a>
<hr />
<h4>Edit Category:</h4>
<fieldset>
	<div class="input select">
		<select id="forum" onchange="javascript:window.location.href='/admin/store/category/' + $('#forum').val() + '/edit'">
			<option value="-1">---Select---</option>
		<?php
		$cats = $admin->getStoreCategories();
		if ($cats) : foreach ($cats as $c) :
		?>
			<option value="<?php echo $c['cat_id']; ?>"><?php echo $c['title']; ?></option>
		<?php endforeach; endif; ?>
		</select>
	</div>
</fieldset>
