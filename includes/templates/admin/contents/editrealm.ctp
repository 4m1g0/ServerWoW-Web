<h3>Edit Configs</h3>
<a href="/admin/configs/site">Site Configs</a> | 
<a href="/admin/configs/realms">Realms</a> | 
<a href="/admin/configs/mysql">MySQL</a>
<br />
<?php
$realm = $this->c('Config')->getValue('realms.' . intval($this->core->getUrlAction(4)));
if (!$realm)
	return;
?>
<a href="/admin/configs/realms/add">Add New</a> | <a href="/admin/configs/realms/delete/<?php echo $realm['id']; ?>">Delete current</a>
<hr />
<form action="" method="post">
<input type="hidden" name="realm[id]" value="<?php echo $realm['id']; ?>" />
<div class="input text long">
Realm Name
<input type="text" size=50 name="realm[name]" value="<?php echo $realm['name']; ?>" />
</div>
<div class="input select">
Realm Type
<select name="realm[type]">
<option value="SERVER_TRINITY"<?php if ($realm['type'] == 'SERVER_TRINITY' || $realm['type'] == SERVER_TRINITY) echo ' selected="selected"'; ?>>Trinity</option>
<option value="SERVER_MANGOS"<?php if ($realm['type'] == 'SERVER_MANGOS' || $realm['type'] == SERVER_MANGOS) echo ' selected="selected"'; ?>>MaNGOS</option>
</select>
</div>
<hr />
<?php $db = $this->c('Config')->getValue('database.characters.' . $realm['id']); ?>
<div class="input text long">
Characters Database Host
<input type="text" size=50 name="mysql[character][host]" value="<?php echo $db['host']; ?>" />
</div>
<div class="input text long">
Characters Database User
<input type="text" size=50 name="mysql[character][user]" value="<?php echo $db['user']; ?>" />
</div>
<div class="input text long">
Characters Database Password
<input type="text" size=50 name="mysql[character][password]" value="<?php echo $db['password']; ?>" />
</div>
<div class="input text long">
Characters Database DB Name
<input type="text" size=50 name="mysql[character][db_name]" value="<?php echo $db['db_name']; ?>" />
</div>
<div class="input text long">
Characters Database Charset
<input type="text" size=50 name="mysql[character][charset]" value="<?php echo $db['charset']; ?>" />
</div>
<div class="input text long">
Characters Database Driver (mysql or mysqli)
<input type="text" size=50 name="mysql[character][driver]" value="<?php echo $db['driver']; ?>" />
</div>
<div class="input text long">
Characters Database Prefix (Leave Empty)
<input type="text" size=50 name="mysql[character][prefix]" value="<?php echo $db['prefix']; ?>" />
</div>
<hr />
<?php $db = $this->c('Config')->getValue('database.world.' . $realm['id']); ?>
<div class="input text long">
World Database Host
<input type="text" size=50 name="mysql[world][host]" value="<?php echo $db['host']; ?>" />
</div>
<div class="input text long">
World Database User
<input type="text" size=50 name="mysql[world][user]" value="<?php echo $db['user']; ?>" />
</div>
<div class="input text long">
World Database Password
<input type="text" size=50 name="mysql[world][password]" value="<?php echo $db['password']; ?>" />
</div>
<div class="input text long">
World Database DB Name
<input type="text" size=50 name="mysql[world][db_name]" value="<?php echo $db['db_name']; ?>" />
</div>
<div class="input text long">
World Database Charset
<input type="text" size=50 name="mysql[world][charset]" value="<?php echo $db['charset']; ?>" />
</div>
<div class="input text long">
World Database Driver (mysql or mysqli)
<input type="text" size=50 name="mysql[world][driver]" value="<?php echo $db['driver']; ?>" />
</div>
<div class="input text long">
World Database Prefix (Leave Empty)
<input type="text" size=50 name="mysql[world][prefix]" value="<?php echo $db['prefix']; ?>" />
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>