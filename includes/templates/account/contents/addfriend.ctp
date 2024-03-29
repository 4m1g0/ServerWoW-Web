<?php if ($this->c('AccountManager')->showNotify()) : ?>
<div class="alert error closeable border-4 glow-shadow">
<div class="alert-inner">
<div class="alert-message">
<p class="title"><strong><?php echo $l->getString('template_js_unexpectedError'); ?></strong></p>
<p class="error.password.incorrect"><?php echo $l->getString($this->c('AccountManager')->lastMessageIndex()); ?></p>
</div>
</div>
<a class="alert-close" href="#" onclick="$(this).parent().fadeOut(250, function() { $(this).css({opacity:0}).animate({height: 0}, 100, function() { $(this).remove(); }); }); return false;">Close</a>
<span class="clear"><!-- --></span>
</div>
<?php endif; ?>
<div id="page-header">
<h2 class="subcategory"><?php echo $l->getString('template_add_friends'); ?></h2>
<h3 class="headline"><?php echo $l->getString('template_add_friend_new'); ?></h3>
</div>
<div id="page-content" class="page-content">
<form method="post" action="" id="change-settings">
<input type="hidden" name="csrftoken" value="9c55345b-f40d-4903-82b6-fd1a4b7d250f" />
<div class="form-row">
<label for="receiver" class="label-full ">
<strong> <?php echo $l->getString('template_add_friend'); ?></strong>
</label>
<input type="text" id="friend" name="friend" value="<?php if (isset($_POST['friend'])) echo $_POST['friend']; ?>" class=" input border-5 glow-shadow-2" maxlength="16" tabindex="1" />
</div>
<div class="form-row">
<label for="receiver" class="label-full ">
<strong> <?php echo $l->getString('template_add_friend_realm'); ?></strong>
</label>
<select name="realmId">
<?php foreach ($this->c('Config')->getValue('realms') as $realm) : ?>
	<option value="<?php echo $realm['id']; ?>"<?php if (isset($_POST['realmId']) && $_POST['realmId'] == $realm['id']) echo ' selected="selected"'; ?>><?php echo $realm['name']; ?></option>
<?php endforeach; ?>
</select>
</div>
<fieldset class="ui-controls " >
<button class="ui-button button1" type="submit" id="settings-submit" tabindex="1">
<span>
<span><?php echo $l->getString('template_add_friend_send'); ?></span>
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