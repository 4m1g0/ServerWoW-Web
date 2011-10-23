<div class="dashboard wow<?php echo $account->user('expansion') == EXPANSION_CLASSIC ? 'с' : 'x' . $account->user('expansion'); ?> eu">
<div class="primary">
<div class="header">
<h2 class="subcategory"><?php echo $l->getString('template_wow_dashboard_management'); ?></h2>
<h3 class="headline"><?php echo $l->getString('expansion_' . $account->user('expansion')); ?></h3>
<a href="<?php echo $this->getCoreUrl('account/management/wow/dashboard.html?region=EU&amp;accountName=' . $account->user('username'));?>"><img src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/images/game-icons/wowx2.png?v35" alt="World of Warcraft" title="" width="48" height="48" /></a>
</div>
<div class="account-summary">
<div class="account-management">
<div class="section box-art" id="box-art">
<img src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/images/game-boxes/en-gb/wow<?php echo $account->user('expansion') == EXPANSION_CLASSIC ? 'с' : 'x' . $account->user('expansion'); ?>-big.png" alt="World of Warcraft" title="" width="242" height="288" id="box-img" />
</div>
<div class="section account-details">
<dl>
<dt class="subcategory"><?php echo $l->getString('template_servicebar_account'); ?></dt>
<dd class="account-name"><?php echo $account->user('username'); ?></dd>
<dt class="subcategory"><?php echo $l->getString('template_wow_dashboard_account_status'); ?></dt>
<dd class="account-status">
<strong class="active"><?php echo $l->getString('template_wow_dashboard_account_active'); ?></strong>
</dd>
<dt class="subcategory"><?php echo $l->getString('template_wow_dashborad_subscribe'); ?></dt>
<dd class="account-time">Unlimited
</dd>
<dt class="subcategory"><?php echo $l->getString('template_wow_dashboard_product_level'); ?></dt>
<dd class="account primary-account account-status">
<span class="account-history"><?php echo $l->getString('template_game_expansion_' . $account->user('expansion')); ?>
<em><?php echo $l->getString('template_wow_dashboard_standart_edition'); ?></em>
</span>
</dd>
<?php
if ($account->user('expansion') > 0) :
	for ($i = $account->user('expansion')-1; $i >= 0; --$i) :
?>
<dd class="account secondary-account"><?php echo $l->getString('template_game_expansion_' . $i); ?>
<em><?php echo $l->getString('template_wow_dashboard_standart_edition'); ?></em>
</dd>
<?php endfor; endif; ?>
<dt class="subcategory"><?php echo $l->getString('template_wow_dashboard_region'); ?></dt>
<dd class="account-region EU">Europe</dd>

</dl>
</div>
<div class="section available-actions">
<!-- ACTIONS -->
</div>
</div>
</div>
</div>
<!-- SECONDARY -->
</div>