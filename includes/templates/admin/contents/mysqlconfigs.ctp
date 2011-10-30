<h3>Edit Configs</h3>
<a href="/admin/configs/site">Site Configs</a> | 
<a href="/admin/configs/realms">Realms</a> |
MySQL
<hr />
<?php
$conf = $this->c('Config')->getValue('database');
?>
<form action="" method="post">
<div>
<h3>Realm DB</h3>
<div class="input text long">
Host
<input type="text" name="mysql[realm][host]" value="<?php echo $conf['realm']['host']; ?>" size=50 />
</div>
<div class="input text long">
User
<input type="text" name="mysql[realm][user]" value="<?php echo $conf['realm']['user']; ?>" size=50 />
</div>
<div class="input text long">
Password
<input type="password" name="mysql[realm][password]" value="<?php echo $conf['realm']['password']; ?>" size=50 />
</div>
<div class="input text long">
Database
<input type="text" name="mysql[realm][db_name]" value="<?php echo $conf['realm']['db_name']; ?>" size=50 />
</div>
<div class="input text long">
Charset
<input type="text" name="mysql[realm][charset]" value="<?php echo $conf['realm']['charset']; ?>" size=50 />
</div>
<div class="input text long">
Driver (mysql or mysqli)
<input type="text" name="mysql[realm][driver]" value="<?php echo $conf['realm']['driver']; ?>" size=50 />
</div>
<div class="input text long">
Prefix (leave empty)
<input type="text" name="mysql[realm][prefix]" value="<?php echo $conf['realm']['prefix']; ?>" size=50 />
</div>
</div>
<br />
<div>
<h3>WoWCS DB</h3>
<div class="input text long">
Host
<input type="text" name="mysql[wow][host]" value="<?php echo $conf['wow']['host']; ?>" size=50 />
</div>
<div class="input text long">
User
<input type="text" name="mysql[wow][user]" value="<?php echo $conf['wow']['user']; ?>" size=50 />
</div>
<div class="input text long">
Password
<input type="password" name="mysql[wow][password]" value="<?php echo $conf['wow']['password']; ?>" size=50 />
</div>
<div class="input text long">
Database
<input type="text" name="mysql[wow][db_name]" value="<?php echo $conf['wow']['db_name']; ?>" size=50 />
</div>
<div class="input text long">
Charset
<input type="text" name="mysql[wow][charset]" value="<?php echo $conf['wow']['charset']; ?>" size=50 />
</div>
<div class="input text long">
Driver (mysql or mysqli)
<input type="text" name="mysql[wow][driver]" value="<?php echo $conf['wow']['driver']; ?>" size=50 />
</div>
<div class="input text long">
Prefix (leave empty)
<input type="text" name="mysql[wow][prefix]" value="<?php echo $conf['wow']['prefix']; ?>" size=50 />
</div>
</div>
<br />
<div class="input submit">
<input type="submit" value="Save" size=50 />
</div>
</form>