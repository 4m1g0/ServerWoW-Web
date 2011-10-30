<h3>Edit Configs</h3>
<a href="/admin/configs/site">Site Configs</a> | 
Realms |
<a href="/admin/configs/mysql">MySQL</a>
<br />
<a href="/admin/configs/realms/add">Add New</a>
<hr />
<ul>
<?php
$realms = $this->c('Config')->getValue('realms');
foreach ($realms as $id => $realm) :
?>
<li><a href="/admin/configs/realms/edit/<?php echo $id; ?>"><?php echo $realm['name']; ?></a></li>
<?php endforeach; ?>
</ul>