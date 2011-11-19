<script language="JavaScript" type="text/javascript">
	$(document).ready(function() {
		$('#amount_').blur(function() {
			var amount = parseInt($('#amount_').val(), 10);
			if (!amount)
			{
				$('#price').val('0');
				$('#pp_amount').val('0');
				$('#confirmation').fadeOut('slow');
				$('#settings-submit').attr('disabled', 'attr');
				$('#settings-submit').addClass('disabled');
				return;
			}
			var price = amount * <?php echo POINT_PRICE; ?>;
			$('#price').val(price);
			$('#price_val').text(price);
			$('#points_val').text(amount);
			$('#confirmation').fadeIn('slow');
			$('#pp_amount').val(price);
		});
		$('#confirmed').click(function() {
			if ($('#confirmed').attr('checked'))
				$('#settings-submit').removeAttr('disabled');
			else
				$('#settings-submit').attr('disabled', 'disabled');

			$('#settings-submit').toggleClass('disabled');
		});
		$('#paypal_form').submit(function() {
			$.ajax({
				url: '<?php echo $this->core->getCoreUrl('paypal/json'); ?>',
				type: 'POST',
				data: {'_pp': true, 'amount': parseInt($('#amount_').val(), 10), 'item_number': '<?php echo $this->c('Paypal')->getOrderId(); ?>'},
				error: function() {
					return false;
				}
			});
		});
	});
</script>
<div id="page-header">
<h2 class="subcategory">Payments</h2>
<h3 class="headline">Earn World of Warcraft Bonus Points!</h3>
</div>
<div id="page-content" class="page-content">
<form method="post" action="<?php echo $this->c('Paypal')->getGatewayUrl(); ?>" id="paypal_form">
<div class="form-row required">
<label for="amount_" class="label-full ">
<strong> Bonus Points Amount
</strong>
<span class="form-required">*</span>
</label>
<input type="text" id="amount_" name="amount_" value="" class=" input border-5 glow-shadow-2" tabindex="1" />
</div>
<div class="form-row required">
<label for="price" class="label-full ">
<strong> Price:
</strong>
</label>
<input type="text" id="price" name="price" value="" class=" input border-5 glow-shadow-2 disabled" disabled="disabled" tabindex="1" />
</div>
<div class="form-row" id="confirmation" style="display:none;">
<input type="checkbox" id="confirmed" name="confirmed" value=""  tabindex="1" class="input"/>
<label for="confirmed" >
I agree to pay <?php echo CURRENCY_CHAR; ?><span id="price_val">0</span> to earn <span id="points_val"></span> WoW points!
</label>
</div>
<fieldset class="ui-controls " >
<?php
$pp_form = $this->c('Paypal')->buildPayPalFormData();
foreach ($pp_form as $key => $val) :
?>
<input type="hidden" name="<?php echo str_replace('pp_', '', $key); ?>" id="<?php echo $key; ?>" value="<?php echo $val; ?>" />
<?php endforeach; ?>
<button class="ui-button button1 disabled" disabled="disabled" type="submit" id="settings-submit" tabindex="1">
<span>
<span><?php echo $l->getString('template_account_conversion_next'); ?></span>
</span>
</button>
<a class="ui-cancel " href="/account/management/" tabindex="1"><span><?php echo $l->getString('template_blog_cancel_report'); ?> </span></a>
</fieldset>
</form>
</div>