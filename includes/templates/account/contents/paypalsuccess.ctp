<div class="alert-page">
<div class="alert-page-message success-page">
<p class="text-green title"><strong><?php echo $l->getString('template_account_sms_success_title'); ?></strong></p>
<p class="caption"><?php echo $l->getString('template_account_paypal_success_text'); ?></p>
<p class="caption"><a href="<?php echo $this->getCoreUrl('account/'); ?>"><?php echo $l->getString('template_account_change_pass_success_t2'); ?></a></p>
</div>
</div>
<script language="javascript" type="text/javascript">
setTimeout(function() {
	document.location.href = '<?php echo $this->getAppUrl('account/management'); ?>';
}, 1000);
</script>