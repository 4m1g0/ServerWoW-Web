<h3>Edit User</h3>
<?php
$user = $admin->getEditableUser();
if (!$user)
	return;
?>
<a href="/admin/users/add">Add User</a> |
<a href="/admin/users/delete/<?php echo $user['id']; ?>">Delete Current</a>
<hr />
<form action="" method="post">
<div class="input text long">
Forums NickName
<input type="text" name="user[forums_name]" value="<?php echo $user['forums_name']; ?>" size=50 />
</div>
<div class="select">
<label>Group</label>
<select name="user[group_id]">
	<?php
	$groups = $this->c('Admin')->getUserGroups();
	foreach ($groups as $group)
		echo '<option value="' . $group['group_id'] . '"' . ($user['group_id'] == $group['group_id'] ? ' selected="selected"' : '') . '>' . $group['group_title'] . '</option>';
	?>
</select>
</div>
<div class="input text long">
<input type="submit" value="Send" />
</div>
</form>