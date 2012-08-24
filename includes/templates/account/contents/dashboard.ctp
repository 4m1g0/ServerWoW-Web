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
<dt class="subcategory">Correo</dt>
<dd class="account-name"><?php echo $account->user('email'); ?></dd>
<?php
$banned = $account->user('banned');
if ($banned)
{
?>
<dt class="subcategory"><?php echo $l->getString('template_wow_dashboard_account_status'); ?></dt>
<dd class="account-status">
<strong class="active"><font color="#990000"><?php echo $l->getString('template_wow_dashboard_account_banned'); ?></font></strong>
</dd>
<dd class="account-status">
<strong class="active"><font color="#990000"><?php echo $l->getString('template_wow_dashboard_date_banned'); ?>:</font> <?php echo date('d-m-Y G:i', $banned['bandate']); ?></strong>
</dd>
<dd class="account-status">
<strong class="active"><font color="#990000"><?php echo $l->getString('template_wow_dashboard_date_unbanned'); ?>:</font> <?php echo date('d-m-Y G:i', $banned['unbandate']); ?></strong>
</dd>
<dd class="account-status">
<strong class="active"><font color="#990000"><?php echo $l->getString('template_wow_dashboard_bannedby'); ?>:</font> <?php echo $banned['bannedby']; ?></strong>
</dd>
<dd class="account-status">
<strong class="active"><font color="#990000"><?php echo $l->getString('template_wow_dashboard_banreason'); ?>:</font> <?php echo $banned['banreason']; ?></strong>
</dd>
<?php
}
else
{
?>
<dt class="subcategory"><?php echo $l->getString('template_wow_dashboard_account_status'); ?></dt>
<dd class="account-status">
<strong class="active"><?php echo $l->getString('template_wow_dashboard_account_active'); ?></strong>
</dd>
<?php
}
?>
<dt class="subcategory"><?php echo $l->getString('template_wow_dashborad_subscribe'); ?></dt>
<dd class="account-time">Unlimited
</dd>
<dt class="subcategory"><?php echo $l->getString('template_wow_dashboard_product_level'); ?></dt>
<dd class="account primary-account account-status">
<span class="account-history"><?php echo $l->getString('template_game_expansion_' . $account->user('expansion')); ?>
<em><?php echo $l->getString('template_wow_dashboard_standart_edition'); ?></em>
</span>
</dd>
<dd class="account secondary-account">
<form method="post" action="gameversion.html" id="change-settings">
<select name="expansion" class="select">
<option value="0" <?php if($account->user('expansion')==0) echo 'selected="selected"';?>>Clásico</option>
<option value="1" <?php if($account->user('expansion')==1) echo 'selected="selected"';?>>The Burning Crusade</option>
<option value="2" <?php if($account->user('expansion')==2) echo 'selected="selected"';?>>Wrath Of The Lich King</option>
<option value="3" <?php if($account->user('expansion')==3) echo 'selected="selected"';?>>Cataclysm</option></td>
<input type="submit" class="button" value="Cambiar versión">
</form>
</dd>
<br>
<dt class="subcategory"><?php echo $l->getString('template_wow_dashboard_region'); ?></dt>
<dd class="account-region EU">Europa && America Latina</dd>

</dl>
</div>
<div class="section available-actions">
<!-- ACTIONS -->
</div>
</div>
</div>
Nota: Si la fecha de baneo es igual a la fecha de desbaneo, el Baneo es PERMANENTE
</div>
<!-- SECONDARY -->
</div>