<h3>Edit Configs</h3>
Site Configs | 
<a href="/admin/configs/realms">Realms</a> |
<a href="/admin/configs/mysql">MySQL</a>
<?php
$site = $this->c('Config')->getValue('site');
$misc = $this->c('Config')->getValue('misc');
$sess = $this->c('Config')->getValue('session');
?>
<hr />
<form action="" method="post">
<div class="input text long">
Client files path
<input type="text" name="site[path]" size=50 value="<?php echo $site['path']; ?>" />
</div>
<div class="input text long">
Creation page video ID (YouTube)
<input type="text" name="site[creation_youtube_id]" size=50 value="<?php echo $site['creation_youtube_id']; ?>" />
</div>
<div class="input text long">
Locale Indexes
<input type="text" name="site[locale_indexes]" size=50 value="<?php echo implode(', ', array_values($site['locale_indexes'])); ?>" />
</div>
<div class="input checkbox">
<br />
<input type="checkbox" name="site[log][enabled]" id="log" value="1" <?php if ($site['log']['enabled']) echo ' checked="checked"'; ?> /> <label for="log">Enable Log</label>
<br />
<br />
</div>
<div class="input text long">
Log File
<input type="text" name="site[log][filename]" size=50 value="<?php echo $site['log']['filename']; ?>" />
</div>
<div class="input select">
Log Level
<select name="site[log][level]">
<option value="1"<?php if ($site['log']['level'] == 1) echo ' selected="selected"'; ?>>Errors Only</option>
<option value="2"<?php if ($site['log']['level'] == 2) echo ' selected="selected"'; ?>>Errors and Debug</option>
<option value="3"<?php if ($site['log']['level'] == 3) echo ' selected="selected"'; ?>>Errors, Debug and SQL</option>
</select>
</div>
<div class="input select">
Default Site Locale
<select name="site[locale][default]">
<option value="de"<?php if ($site['locale']['default'] == 'de') echo ' selected="selected"'; ?>>Deutch</option>
<option value="en"<?php if ($site['locale']['default'] == 'en') echo ' selected="selected"'; ?>>English</option>
<option value="es"<?php if ($site['locale']['default'] == 'es') echo ' selected="selected"'; ?>>Spanish</option>
<option value="fr"<?php if ($site['locale']['default'] == 'fr') echo ' selected="selected"'; ?>>French</option>
<option value="ru"<?php if ($site['locale']['default'] == 'ru') echo ' selected="selected"'; ?>>Russian</option>
</select>
</div>
<div class="input text long">
Admin Email
<input type="text" name="misc[admin_email]" size=50 value="<?php echo $misc['admin_email']; ?>" />
</div>
<div class="input text long">
Session ID (change it only if you know what are you doing!)
<input type="text" name="session[identifier]" size=50 value="<?php echo $sess['identifier']; ?>" />
</div>
<div class="input text long">
User Storage (change it only if you know what are you doing!)
<input type="text" name="session[user][storage]" size=50 value="<?php echo $sess['user']['storage']; ?>" />
</div>
<div class="input text long">
Magic String (change it only if you know what are you doing!)
<input type="text" name="session[magic_string]" size=50 value="<?php echo $sess['magic_string']; ?>" />
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>