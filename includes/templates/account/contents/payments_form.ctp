<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
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
<h2 class="subcategory">PayPal Puntos</h2>
<h3 class="headline">Compra puntos para Gastar en la Tienda!</h3>
</div>
<div id="page-content" class="page-content">
<form method="post" action="<?php echo $this->c('Paypal')->getGatewayUrl(); ?>" id="paypal_form">
<div class="form-row required">
<label for="amount_" class="label-full ">
<strong> Puntos a Comprar
</strong>
<span class="form-required">*</span>
</label>
<input type="text" id="amount_" name="amount_" value="" class=" input border-5 glow-shadow-2" tabindex="1" />
</div>
<div class="form-row required">
<label for="price" class="label-full ">
<strong> Precio:
</strong>
</label>

<input type="text" id="price" name="price" value="" class=" input border-5 glow-shadow-2 disabled" disabled="disabled" tabindex="1" />
</div>
<div>
  <p>&nbsp;</p>
  <p><strong><font color="#990000">ATENCION:</font></strong></p>
  <p>* Para las compras mayores a 40 euros, enviaremos un formato de <strong>Recibido</strong>, que el o la comprador(a) debera:</p>
  <p><em>1) Imprimir<br />
    2) Diligenciar debidamente (Por favor, no olvidar escribir el ID de la transaccion. Este se encuentra en el correo que PayPal envia a su cuenta despues de efectuada la transaccion.)<br />
3) Escanear y mandar debidamente firmado y diligenciado dicho formato a <a onclick="onClickUnsafeLink(event);" href="mailto:tienda@serverwow.com">tienda@serverwow.com</a>,<strong> junto</strong> con una fotocopia del documento de identidad de la o el comprador(a)<br />
4) Solo cuando recibamos estos documentos, se desbloquearan los creditos para su uso en el ServerWow.com.</em></p>
<p> </p>
  <p>* Para las compras realizadas por el mismo comprador(a) o titular de PayPal que superen 40 Euros en un mismo mes (sin importar si es para diferentes cuentas del Server Wow):</p>
  <p><em>1) Se aplicara el mismo procedimiento, en cuyo caso el o la comprador(a) tendra que firmar y diligenciar el formato aun despues de haber recibido los creditos. Por favor, escribir TODOS los IDs de las transacciones implicadas. <br />
2) Si la o el comprador(a) o titular de la cuenta en PayPal se negara a llevar a cabo este requerimiento en un lapso de 36 horas, todas las cuentas asociadas a estas compras seran suspendidas temporalmente mientras se soluciona. </em></p>
  <p>&nbsp;</p>
</div>
<div class="form-row" id="confirmation" style="display:none;">
<input type="checkbox" id="confirmed" name="confirmed" value=""  tabindex="1" class="input"/>
<label for="confirmed" >
Acepto pagar <?php echo CURRENCY_CHAR; ?><span id="price_val">0</span> EUR a cambio de <span id="points_val"></span> puntos!
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
</body>
</html>