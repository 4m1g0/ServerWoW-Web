<style type="text/css">
input {margin-left:1px;width:400px;}
</style>
<h1>Configuration</h1>
<form action="" method="POST">
<input type="hidden" name="cfg" value="1" />
Site path: <input type="text" name="site[path]" value="<?php echo $c['site']['path']; ?>" /><br />
Site locale indexes: <input type="text" name="site[locale_indexes]" value="<?php echo implode(',', $c['site']['locale_indexes']); ?>" /><br />
Log enabled: <input type="checkbox" name="site[log][enabled]" value="1" <?php if ($c['site']['log']['enabled']) echo ' checked="checked"'; ?> /><br />
Log filename: <input type="text" name="site[log][filename]" value="<?php echo $c['site']['log']['filename']; ?>" /><br />
Log level: <select name="site[log][level]">
<?php for ($i = 1; $i < 4; ++$i) echo '<option value="' . $i . '"' . (($c['site']['log']['level'] == $i ) ? ' selected="selected"' : '') . '>' . $i . '</option>'; ?>
</select><br />
Site title: <input type="text" name="site[title]" value="<?php echo $c['site']['title']; ?>" /><br />
Battlegroup: <input type="text" name="site[battlegroup]" value="<?php echo $c['site']['battlegroup']; ?>" /><br />
Icons server: <input type="text" name="site[icons_server]" value="<?php echo $c['site']['icons_server']; ?>" /><br />
<hr />
Admin email: <input type="text" name="misc[admin_email]" value="<?php echo $c['misc']['admin_email']; ?>" /><br />
<hr />
Session identifier: <input type="text" name="session[identifier]" value="<?php echo $c['session']['identifier']; ?>" /></br />
User storage: <input type="text" name="session[user][storage]" value="<?php echo $c['session']['user']['storage']; ?>" /></br />
Magic string: <input type="text" name="session[magic_string]" value="<?php echo $c['session']['magic_string']; ?>" /></br />
<hr />
<?php foreach ($c['realms'] as $realm) : ?>
Realm <?php echo $realm['id']; ?> ID: <input type="text" name="realms[<?php echo $realm['id']; ?>][id]" value="<?php echo $realm['id']; ?>" /><br />
Realm <?php echo $realm['id']; ?> Name: <input type="text" name="realms[<?php echo $realm['id']; ?>][name]" value="<?php echo $realm['name']; ?>" /><br />
Realm <?php echo $realm['id']; ?> Type: <select name="realms[<?php echo $realm['id']; ?>][type]">
<option value="SERVER_TRINITY"<?php if ($realm['type'] == SERVER_TRINITY || $realm['type'] == 'SERVER_TRINITY') echo ' selected="selected"'; ?>>Trinity Core</option>
<option value="SERVER_MANGOS"<?php if ($realm['type'] == SERVER_MANGOS || $realm['type'] == 'SERVER_MANGOS') echo ' selected="selected"'; ?>>MaNGOS</option>
</select>
<br />
<?php endforeach; ?>
<hr />
<h3>Databases</h3>
<?php
$dbs = array(
	'realm' => array('multi' => false),
	'characters' => array('multi' => true),
	'world' => array('multi' => true),
	'wow' => array('multi' => false)
);
foreach ($dbs as $type => $info) : ?>
<h4><?php echo ucfirst($type); ?><h4>
<?php if ($info['multi']) : foreach ($c['database'][$type] as $id => $db) : ?>
<?php echo $type . ' #' . $id; ?> host: <input type="text" name="database[<?php echo $type .'][' . $id; ?>][host]" value="<?php echo $db['host']; ?>" /><br />
<?php echo $type . ' #' . $id; ?> user: <input type="text" name="database[<?php echo $type .'][' . $id; ?>][user]" value="<?php echo $db['user']; ?>" /><br />
<?php echo $type . ' #' . $id; ?> password: <input type="text" name="database[<?php echo $type .'][' . $id; ?>][password]" value="<?php echo $db['password']; ?>" /><br />
<?php echo $type . ' #' . $id; ?> DB name: <input type="text" name="database[<?php echo $type .'][' . $id; ?>][db_name]" value="<?php echo $db['db_name']; ?>" /><br />
<?php echo $type . ' #' . $id; ?> charset: <input type="text" name="database[<?php echo $type .'][' . $id; ?>][charset]" value="<?php echo $db['charset']; ?>" /><br />
<?php echo $type . ' #' . $id; ?> driver: <input type="text" name="database[<?php echo $type .'][' . $id; ?>][driver]" value="<?php echo $db['driver']; ?>" /><br />
<?php echo $type . ' #' . $id; ?> prefix: <input type="text" name="database[<?php echo $type .'][' . $id; ?>][prefix]" value="<?php echo $db['prefix']; ?>" /><br />
<?php endforeach; else : $db = $c['database'][$type]; ?>
<?php echo $type; ?> host: <input type="text" name="database[<?php echo $type; ?>][host]" value="<?php echo $db['host']; ?>" /><br />
<?php echo $type; ?> user: <input type="text" name="database[<?php echo $type; ?>][user]" value="<?php echo $db['user']; ?>" /><br />
<?php echo $type; ?> password: <input type="text" name="database[<?php echo $type; ?>][password]" value="<?php echo $db['password']; ?>" /><br />
<?php echo $type; ?> DB name: <input type="text" name="database[<?php echo $type; ?>][db_name]" value="<?php echo $db['db_name']; ?>" /><br />
<?php echo $type; ?> charset: <input type="text" name="database[<?php echo $type; ?>][charset]" value="<?php echo $db['charset']; ?>" /><br />
<?php echo $type; ?> driver: <input type="text" name="database[<?php echo $type; ?>][driver]" value="<?php echo $db['driver']; ?>" /><br />
<?php echo $type; ?> prefix: <input type="text" name="database[<?php echo $type; ?>][prefix]" value="<?php echo $db['prefix']; ?>" /><br />

<?php endif ; ?>
<?php endforeach; ?>
<hr />
<input type="submit" value="SAVE" />
<hr />
</form>