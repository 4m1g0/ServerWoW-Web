<h3>Add User</h3>
<form action="" method="post">
<div class="input text long">
<strong>WoW</strong> account username
<input type="text" name="user[username]" value="" size=50 />
</div>
<div class="input text long">
Forums NickName
<input type="text" name="user[forums_name]" value="" size=50 />
</div>
<div class="select">
<label>Group</label>
<select name="user[group_id]">
	<option value="0">-- Select --</option>
	<?php
	$groups = $this->c('Admin')->getUserGroups();
	foreach ($groups as $group)
		echo '<option value="' . $group['group_id'] . '">' . $group['group_title'] . '</option>';
	?>
</select>
</div>
<br />
<div class="input text long">
<input type="submit" value="Send" />
</div>
</form>