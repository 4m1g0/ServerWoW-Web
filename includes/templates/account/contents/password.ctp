<?php if ($account->showNotify()) : ?>
<div class="alert error closeable border-4 glow-shadow">
<div class="alert-inner">
<div class="alert-message">
<p class="title"><strong><?php echo $l->getString('template_js_unexpectedError'); ?></strong></p>
<p class="error.password.incorrect"><?php echo $l->getString($account->lastMessageIndex()); ?></p>
</div>
</div>
<a class="alert-close" href="#" onclick="$(this).parent().fadeOut(250, function() { $(this).css({opacity:0}).animate({height: 0}, 100, function() { $(this).remove(); }); }); return false;">Закрыть</a>
<span class="clear"><!-- --></span>
</div>
<?php endif; ?>
<?php if ($account->success()) : ?>
<div class="alert-page">
<div class="alert-page-message success-page">
<p class="text-green title"><strong><?php echo $l->getString('template_account_change_pass_success_title'); ?></strong></p>
<p class="caption"><?php echo $l->getString('template_account_change_pass_success_t1'); ?></p>
<p class="caption"><a href="<?php echo $this->getCoreUrl('account/'); ?>"><?php echo $l->getString('template_account_change_pass_success_t2'); ?></a></p>
</div>
</div>
<?php else : ?>
<div id="page-header">
<span class="float-right"><span class="form-req">*</span> <?php echo $l->getString('template_account_change_pass_s1t1'); ?></span>
<h2 class="subcategory"><?php echo $l->getString('template_management_menu_parameters'); ?></h2>
<h3 class="headline"><?php echo $l->getString('template_account_change_pass_s1t2'); ?></h3>
</div>
<div id="page-content" class="page-content">
<p><?php echo $l->getString('template_account_change_pass_s1t3'); ?></p>
<form method="post" action="change-password.html" id="change-settings">
<input type="hidden" name="csrftoken" value="9c55345b-f40d-4903-82b6-fd1a4b7d250f" />
<div class="form-row required">
<label for="oldPassword" class="label-full ">
<strong> <?php echo $l->getString('template_account_change_pass_s1t4'); ?>
</strong>
<span class="form-required">*</span>
</label>
<input type="password" id="oldPassword" name="oldPassword" value="" class=" input border-5 glow-shadow-2
" maxlength="16" tabindex="1" />
</div>
<div class="form-row required">
<label for="newPassword" class="label-full ">
<strong> <?php echo $l->getString('template_account_change_pass_s1t5'); ?>
</strong>
<span class="form-required">*</span>
</label>
<input type="password" id="newPassword" name="newPassword" value="" class=" input border-5 glow-shadow-2
" maxlength="16" tabindex="1" />
</div>
<div class="form-row required">
<label for="newPasswordVerify" class="label-full ">
<strong> <?php echo $l->getString('template_account_change_pass_s1t6'); ?>
</strong>
<span class="form-required">*</span>
</label>
<input type="password" id="newPasswordVerify" name="newPasswordVerify" value="" class=" input border-5 glow-shadow-2
" maxlength="16" tabindex="1" />
</div>
<fieldset class="ui-controls " >
<button
class="ui-button button1 disabled"
type="submit"
disabled="disabled"
id="settings-submit"
tabindex="1"
>
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
<?php endif; ?>