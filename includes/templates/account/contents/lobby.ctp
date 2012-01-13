<div id="lobby">
<div id="page-content" class="page-content">
<div id="lobby-account">
<h3 class="section-title"><?php echo $l->getString('template_management_account_details'); ?></h3>
<div class="lobby-box">
<h4 class="subcategory"><?php echo $l->getString('template_management_account_name'); ?></h4>
<p><?php echo $this->c('AccountManager')->user('username'); ?>
</p>
<h4 class="subcategory"><?php echo $l->getString('template_management_points_balance'); ?></h4>
<p><?php echo $l->format('template_management_points_balance_fmt', $this->c('AccountManager')->user('amount')); ?>
<br /><?php echo $l->format('template_management_points_balance_buy', $this->getAppUrl('account/management/smspayments')); ?></p>
</div>
</div>
<div id="lobby-games">
<h3 class="section-title"><?php echo $l->getString('template_management_your_games'); ?></h3>
<div id="games-list">
<a href="#wow" class="games-title border-2 opened" rel="game-list-wow">wow</a>
<ul id="game-list-wow">
<li class="border-4 " id="WoW1::EU" >
<span class="game-icon">
<img src="<?php echo CLIENT_FILES_PATH; ?>/account/local-common/images/game-icons/wowc-32.png" alt="" width="32" height="32" />
</span>
<span class="account-info">
<span class="account-link">
<?php
$banned = $this->c('AccountManager')->loadBanInfo($this->c('AccountManager')->user('id'));
if ($banned)
{
?>
<strong><a href="<?php echo $this->getCoreUrl('account/management/wow/dashboard.html?accountName=' . $this->c('AccountManager')->user('username') . '&amp;region=ES'); ?>">World of Warcraft®</a></strong>
<span class="account-id">[<?php echo $this->c('AccountManager')->user('username'); ?>] </span>
<span class="account-region">Cuenta <font color="#990000"><?php echo $l->getString('template_wow_dashboard_account_banned'); ?></font></span>
<?php
}
else
{
?>
<strong><a href="<?php echo $this->getCoreUrl('account/management/wow/dashboard.html?accountName=' . $this->c('AccountManager')->user('username') . '&amp;region=ES'); ?>">World of Warcraft®</a></strong>
<span class="account-id">[<?php echo $this->c('AccountManager')->user('username'); ?>] </span>
<span class="account-region"><?php echo $l->getString('template_wow_dashboard_account_active'); ?></span>
<?php
}
?>
</span>
</span>
</li>
</ul>
</div>
</div>
</div>
<center>
</center>
</div>