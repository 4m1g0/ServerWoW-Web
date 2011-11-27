<style type="text/css">
input {margin-left:1px;width:400px;}
</style>
<h1>Configuration</h1>
<form action="" method="POST">
<input type="hidden" name="cfg" value="1" />
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