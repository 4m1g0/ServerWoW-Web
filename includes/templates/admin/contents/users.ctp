<h3>Users Management</h3>
<a href="/admin/users/add">Add User</a> | <a href="/admin/users/groups">Groups</a>
<br />
<br />

<h4>Edit User:</h4>
<ul>
<?php
$users = $admin->getAdminUsers();
if ($users) :
	foreach ($users as &$u):
?>
<li><a href="/admin/users/edit/<?php echo $u['game_id']; ?>"><?php echo $u['name']; ?></a></li>
<?php endforeach; endif; ?>
</ul>