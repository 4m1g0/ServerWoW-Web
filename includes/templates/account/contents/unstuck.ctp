<div id="page-header">
<h2 class="subcategory"><?php echo $l->getString('template_management_menu_parameters'); ?></h2>
<h3 class="headline"><?php echo $l->getString('template_management_menu_parameters_unstuck'); ?></h3>
</div>
<div id="page-content" class="page-content">
<form method="post" action="unstuck.html" id="change-settings">
<input type="hidden" name="csrftoken" value="9c55345b-f40d-4903-82b6-fd1a4b7d250f" />
<?php
$characters = $this->c('AccountManager')->getCharacters();
if ($characters) :
	foreach ($characters as $char) :
?>
<div class="form-row">
<label for="character-<?php echo $char['realmId'] . '-' . $char['guid']; ?>" class="label-full ">
<strong><a href="<?php echo $char['url']; ?>" target="_blank"><?php echo $char['name'] . ' @ ' . $char['realmName']; ?></a></strong>
</strong>
</label>
<input type="checkbox" id="character-<?php echo $char['realmId'] . '-' . $char['guid']; ?>" name="characters[<?php echo $char['realmId']; ?>][<?php echo $char['guid']; ?>]" value="<?php echo $char['realmId'] . '-' . $char['guid']; ?>" />
</div>
<?php endforeach; endif; ?>

<fieldset class="ui-controls " >
<button class="ui-button button1" type="submit" id="settings-submit" tabindex="1">
<span>
<span><?php echo $l->getString('template_account_conversion_next'); ?></span>
</span>
</button>
<a class="ui-cancel "
href="<?php echo $this->getAppUrl('account/management/'); ?>"
tabindex="1">
<span>
<?php echo $l->getString('template_blog_cancel_report'); ?> </span>
</a>
</fieldset>
</form>
</div>