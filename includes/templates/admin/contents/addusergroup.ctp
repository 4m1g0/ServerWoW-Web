<h3>Add Group</h3>
<a href="/admin/users/groups">Groups</a>
<hr />
<form action="" method="post">
<div class="input text long">
Title
<input type="text" name="group[group_title]" value="<?php if (isset($_POST['group']['group_title'])) echo $_POST['group']['group_title']; ?>" size=32 />
</div>
<div class="input text long">
<?php
$permissions = $admin->getPermissions();
foreach ($permissions as $p)
	echo '<label for="' . $p['id'] . '">' . $p['label'] . '</label><input type="checkbox" id="' . $p['id'] . '" name="group[mask][' . $p['id'] . ']"' . (isset($_POST['group']['mask'][$p['id']]) ? ' checked="checked"' : '') . ' /> ';
?>
</div>
<div class="input text long">
<input type="submit" value="Send" />
</div>
</form>