<h3>User Groups Management</h3>
<a href="/admin/users/groups/add">Add Group</a>
<br />
<br />

<h4>Edit Group:</h4>
<ul>
<?php
$groups = $admin->getUserGroups();
if ($groups) :
	foreach ($groups as &$g):
?>
<li><a href="/admin/users/groups/edit/<?php echo $g['group_id']; ?>"><?php echo $g['group_title']; ?></a></li>
<?php endforeach; endif; ?>
</ul>