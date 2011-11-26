<div id="page-header">
<h2 class="subcategory"><?php echo $l->getString('template_management_menu_parameters'); ?></h2>
<h3 class="headline"><?php echo $l->getString('template_management_menu_parameters_forums_settings'); ?></h3>
</div>
<div id="page-content" class="page-content">
<form method="post" action="forums.html" id="change-settings">
<input type="hidden" name="csrftoken" value="9c55345b-f40d-4903-82b6-fd1a4b7d250f" />
<?php if ($account->isAllowedToModerate()) : ?>
<div class="form-row">
<label for="forums_username" class="label-full ">
<strong style="color:#0093C7"> <?php echo $l->getString('template_management_forums_settings_forums_username'); ?></strong>
</label>
<input type="text" id="forums_username" name="forums_username" value="<?php echo $account->settings('forums_username', 'forums'); ?>" class=" input border-5 glow-shadow-2" maxlength="16" tabindex="1" />
</div>
<?php endif; ?>
<div class="form-row">
<label for="forums_signature" class="label-full ">
<strong> <?php echo $l->getString('template_management_forums_settings_forums_signature'); ?>
</strong>
</label>
<textarea cols=47 rows=10 id="forums_signature" name="forums_signature" class=" input border-5 glow-shadow-2" tabindex="1"><?php echo $account->settings('forums_signature', 'forums'); ?></textarea>
</div>
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