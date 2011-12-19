<?php $msg = $this->c('AccountManager')->getPrivateMessage(); ?>
<div id="page-header">
<h2 class="subcategory"><a href="/account/management/inbox"><?php echo $l->getString('template_management_menu_mail_caption'); ?></a></h2>
<h3 class="headline"><?php echo $l->getString('template_show_message'); ?></h3>
</div>
<div id="page-content" class="page-content">
<div align="center">
Message from <b><?php echo $msg['forums_name']; ?></b> (sent: <?php echo date('d/m/Y H:i:s', $msg['send_date']); ?>)<br />
<b>Title:</b> <?php echo $msg['title']; ?><br />
<b>Message:</b> <blockquote><?php echo $msg['text']; ?></blockquote>
</div>
<?php if ($this->c('AccountManager')->isAllowedToSendMsg()) : ?>
<h3 class="headline">Answer:</h3>
<form method="post" action="/account/management/newmessage" id="change-settings">
<input type="hidden" name="csrftoken" value="9c55345b-f40d-4903-82b6-fd1a4b7d250f" />
<div class="form-row">
<label for="receiver" class="label-full ">
<strong> <?php echo $l->getString('template_new_msg_receiver'); ?></strong>
</label>
<input type="text" id="receiver" name="receiver" value="<?php echo $msg['username']; ?>" class=" input border-5 glow-shadow-2" maxlength="16" tabindex="1" />
</div>
<div class="form-row">
<label for="msgtitle" class="label-full ">
<strong> <?php echo $l->getString('template_new_msg_title'); ?></strong>
</label>
<input type="text" id="msgtitle" name="title" value="RE: <?php echo $msg['title']; ?>" class=" input border-5 glow-shadow-2" maxlength="16" tabindex="1" />
</div>
<div class="form-row">
<label for="messagebody" class="label-full ">
<strong> <?php echo $l->getString('template_new_msg_text'); ?>
</strong>
</label>
<textarea cols=47 rows=10 id="messagebody" name="messagebody" class=" input border-5 glow-shadow-2" tabindex="1"></textarea>
</div>
<fieldset class="ui-controls " >
<button class="ui-button button1" type="submit" id="settings-submit" tabindex="1">
<span>
<span><?php echo $l->getString('template_new_msg_send'); ?></span>
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
<?php endif; ?>
</div>