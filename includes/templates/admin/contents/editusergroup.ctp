<h3>Edit Group</h3>
<?php
$group = $admin->getEditableGroup();
if (!$group)
	return;
?>
<a href="/admin/users/groups">Groups</a> |
<a href="/admin/users/groups/add">Add Group</a> |
<a href="/admin/users/groups/delete/<?php echo $group['group_id']; ?>">Delete Current</a>
<hr />
<form action="" method="post">
<div class="input text long">
Title
<input type="text" name="group[group_title]" value="<?php echo $group['group_title']; ?>" size=32 />
</div>
<div class="input text long">
<?php
$permissions = $admin->getPermissions();
foreach ($permissions as $p)
	echo '<label for="' . $p['id'] . '">' . $p['label'] . '</label><input type="checkbox" id="' . $p['id'] . '" name="group[mask][' . $p['id'] . ']"' . ($group['group_mask'] & $p['mask'] ? ' checked="checked"' : '') . ' /> ';
?>
</div>
<div class="input text long">
Extra forum style (works only with "Extra Color (forums)" selected)
<input type="text" name="group[group_style]" value="<?php echo $group['group_style']; ?>" size=32 />
</div>
<div class="input text long">
<input type="submit" value="Send" />
</div>
</form>