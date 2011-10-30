<h3>Forums Management</h3>
<a href="/admin/forums/add">Add Category</a>

<h4>Edit Category:</h4>
<fieldset>
<select id="forum" onchange="javascript:window.location.href='/admin/forums/edit/' + $('#forum').val();">
<option value="-1">---Select---</option>
<?php
$cats = $admin->getForumCategories();
if ($cats) : foreach ($cats as $c) :
?>
<option value="<?php echo $c['cat_id']; ?>"><?php echo $c['title']; ?></option>
<?php endforeach; endif; ?>
</select>
</fieldset>