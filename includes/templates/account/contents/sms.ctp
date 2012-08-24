<div id="page-header">
<h2 class="subcategory">SMS Puntos</h2>
<h3 class="headline">Compra puntos para Gastar en la Tienda!</h3>
</div>
Te recordamos que los SMS tienen un maximo de duracion de 2 Dias, asi que te recomendamos que los ingreses lo mas rapido posible.
<div id="page-content" class="page-content">
<form method="post" action="" id="change-settings">
<input type="hidden" name="csrftoken" value="9c55345b-f40d-4903-82b6-fd1a4b7d250f" />
<div class="form-row">
<label for="country" class="label-full ">
<strong> <?php echo $l->getString('template_account_sms_select_country'); ?>
</strong>
</label>
<script type="text/javascript" language="javascript">
var selectedCountry = '';
var countries = [<?php
$countries = array(
	array('id' => 'argentina', 'type' => 'allopass', 'code' => 'CODE', 'number' => 27777, 'info' => '*Servicio válido para Claro, Movistar, Personal y Nextel.<br>Precio del mensaje al 27777 : $5,99 ARS + Imp en Claro y $6,00 + Imp en Movistar, Personal y Nextel.<br> Servicio limitado a 60 sms/mes.'),
	array('id' => 'bolivia', 'type' => 'sepomo', 'code' => 'CAVE', 'number' => 636, 'info' => '*El precio del mensaje es de 8.85 BOB + I.V.A.'),
	array('id' => 'brasil', 'type' => 'allopass', 'code' => 'CODE', 'number' => 44844, 'info' => '*Custo: 4.99 BRL/SMS'),
	array('id' => 'chile', 'type' => 'allopass', 'code' => 'PASS', 'number' => 1714, 'info' => '*Precio del sms $750 pesos impuestos incluídos.'),
	array('id' => 'colombia', 'type' => 'allopass', 'code' => 'ALL', 'number' => 3911, 'info' => '*Servicio válido para Movistar, Tigo y Claro.<br>Precio del mensaje $3.596 IVA. Inc.', 'info2' => '- (Telefono Fijo)Llama al <b>01 901 444 4297</b> para obtener tu Codigo', 'info3' => '*(Telefono Fijo) $3900 pesos iva incluido por minuto Duración máxima de la llamada 1 minuto<br>'),
	array('id' => 'costarica', 'type' => 'allopass', 'code' => 'CODE', 'number' => 2224, 'info' => '*Servicio disponible en ICE.<br>Precio del mensaje: C.700 impuestos incluídos'),
	array('id' => 'ecuador', 'type' => 'allopass', 'code' => 'CODE', 'number' => 7722, 'info' => '*Servicio válido para Alegro y Movistar a $1,25 + Imp.<br>Porta con precio por mensaje al 7722 de $1,30 + Imp.'),
	array('id' => 'spain', 'type' => 'allopass', 'code' => 'CODE', 'number' => 25065, 'info' => '*1,42€ IVA incluido.', 'info2' => '- (Telefono Fijo)Llama al <b>905 40 31 23</b> para obtener tu Codigo', 'info3' => '*(Telefono Fijo) 1,42€/llamada IVA incluído desde un teléfono de la red fija.<br> 1,95€/llamada IVA incluído desde red móvil'),
	array('id' => 'elsalvador', 'type' => 'allopass', 'code' => 'CODE', 'number' => 2580, 'info' => '*Servicio disponible para Claro, Digicel, Movistar y Tigo<br>Precio del mensaje $3.00 USD + impuestos'),
	array('id' => 'guatemala', 'type' => 'allopass', 'code' => 'CODE', 'number' => 1255, 'info' => '*Claro y Movistar $ 1,69 + Impuestos.<br>Tigo 15 Qzt + impuestos.'),
	array('id' => 'honduras', 'type' => 'allopass', 'code' => 'CODE', 'number' => 55255, 'info' => '*Precio del mensaje 1,73 + impuestos.'),
	array('id' => 'mexico', 'type' => 'allopass', 'code' => 'CODE', 'number' => 28000, 'info' => '*Servicio disponible para usuarios Telcel, Movistar, Iusacell, Unefon, Nextel.<br>$23.20 pesos IVA incluido por SMS.<br>$22.20 pesos en ciudades fronterizas en donde aplica el 11% de IVA<br>El servicio Allopass tiene un limite mensual de 50 SMS', 'info2' => '- (Telefono Fijo)Llama al <b>01 900 849 77 23</b> para obtener tu Codigo', 'info3' => '*(Telefono Fijo) $23.20 por minuto (incluye iva) Duración máxima de la llamada 1 minuto'),
	array('id' => 'nicaragua', 'type' => '123ticket', 'code' => 'CODE', 'number' => 95100, 'info' => '*$1,00 USD + impuestos <br>Servicio disponible en Claro y Movistar.'),
	array('id' => 'panama', 'type' => '123ticket', 'code' => 'CODE', 'number' => 1255, 'info' => '*$2 SMS IVA incluido.<br>Servicio disponible en Movistar.'),
	array('id' => 'peru', 'type' => 'allopass', 'code' => 'CODE', 'number' => 7766, 'info' => '*Servicio válido para Claro, precio del mensaje al 7766, S./4,95 IGV incluido.<br>Movistar, precio del mensaje al 7766 es de USD1,77 IGV incluido.<br>Servicio limitado a 60 sms/mes.'),
	array('id' => 'portugal', 'type' => 'allopass', 'code' => 'CODE', 'number' => 68636, 'info' => '*2,10€/sms.'),
	array('id' => 'republicdom', 'type' => 'allopass', 'code' => 'CODE', 'number' => 92800, 'info' => 'Servicio disponible para Claro, Orange, Viva y Tricom<br>Precio del mensaje $64,00 DOP impuestos incluídos.'),
	array('id' => 'uruguay', 'type' => 'allopass_tmp', 'code' => 'LCV', 'number' => 1714, 'info' => '*Precio del mensaje 60 UYU/SMS + Basico + IVA.<br>Disponible para Ancel.'),
	array('id' => 'venezuela', 'type' => 'allopass', 'code' => 'CODE', 'number' => 5833, 'op1' => 'Usuarios Movilnet', 'number2' => 2658, 'op2' => 'Usuarios Movistar y Digitel', 'info' => '*Costo del mensaje 7,5 BsF + impuestos en Movistar y Digitel.<br>5,0 BsF + impuestos en Movilnet.<br>Servicio limitado a 60 sms/mes.'),
	array('id' => 'alemania', 'type' => 'allopass', 'code' => 'LOS', 'number' => 41414, 'info' => '*Precio del mensaje €1.49/SMS'),
	array('id' => 'canada', 'type' => 'allopass', 'code' => 'CODE', 'number' => 52624, 'info' => '*Price of SMS 3.00$'),
	array('id' => 'usa', 'type' => 'allopass', 'code' => 'AP', 'number' => 23333, 'info' => 'Payment is available to subscribers on AT&T, Sprint, Cellular One, Nextel, Boost, Alltel, Virgin Mobile <br>*Price of SMS $2.99'),
	array('id' => 'sepomo', 'type' => 'sepomo', 'code' => 'Ingresa el Codigo', 'number' => 0, 'info' => ''),
);
foreach ($countries as $c)
{
	echo '"' . $c['id'] . '"';
	if ($c['id'] != $countries[sizeof($countries)-1]['id'])
		echo ', ';
}
?>];
var isChecking = false;
$(document).ready(function() {
	$('#checkCode').click(function() {
		if (isChecking)
			return false;

		isChecking = true;

		var found = false;

		$.each(countries, function(idx, val) {
			if (selectedCountry == val)
				found = true;
		});

		if (!found)
		{
			isChecking = false;
			return false;
		}

		var type = $('#' + selectedCountry).attr('data-optype');

		if (type != 'allopass' && type != 'allopass_tmp' && type != 'sepomo' && type != '123ticket')
		{
			isChecking = false;
			return false;
		}

		var code = $('#code' + selectedCountry).val();

		if (!code)
		{
			isChecking = false;
			return false;
		}

		$.ajax({
			url: '<?php echo $this->getAppUrl('account/management/smspayments/confirm') ?>',
			type: 'POST',
			data: {'code': code, 'type': type},
			success: function(data) {
				if (data == 'ok')
					location.href = '<?php echo $this->getAppUrl('account/management/smspayments/success') ?>';
				else
					location.href = '<?php echo $this->getAppUrl('account/management/smspayments/failed') ?>';
			},
			error: function(data) {
			}
		});

		//location.href = '<?php echo $this->getAppUrl('account/management/smspayments/failed') ?>';

		isChecking = false;
	});
});
function changeCountry()
{
	var country = $('#country').val();

	hideAllCountries();
	selectedCountry = country;
	$('#' + country).show();
}

function hideAllCountries()
{
	$.each(countries, function(idx, val) {
		$('#' + val).hide();
	});
}
</script>
<select id="country" name="country" onclick="javascript:changeCountry();">
	<option value="default">Selecciona tu Pais</option>
	<option value="argentina">Argentina</option>
	<option value="bolivia">Bolivia</option>
	<option value="brasil">Brasil</option>
	<option value="chile">Chile</option>
	<option value="colombia">Colombia</option>
	<option value="costarica">Costa Rica</option>
	<option value="ecuador">Ecuador</option>
	<option value="spain">España</option>
	<option value="elsalvador">El Salvador</option>
	<option value="guatemala">Guatemala</option>
	<option value="honduras">Honduras</option>
	<option value="mexico">Mexico</option>
	<option value="nicaragua">Nicaragua</option>
	<option value="panama">Panama</option>
	<option value="peru">Peru</option>
	<option value="portugal">Portugal</option>
	<option value="republicdom">Republica Dominicana</option>
	<option value="uruguay">Uruguay</option>
	<option value="venezuela">Venezuela</option>
	<option value="a">---</option>
	<option value="alemania">Alemania</option>
	<option value="canada">Canada</option>
	<option value="usa">USA</option>
	<option value="b">---</option>
	<option value="sepomo">Codigos SERVERWOW</option>
</select>
</div>
<?php
foreach ($countries as $country) : ?>
<div id="<?php echo $country['id']; ?>" style="display:none;" data-optype="<?php echo $country['type']; ?>">
		<?php if (isset($country['number']) && $country['number'] == 0) : ?>
		<center>
		<br><br><br>
		- <strong><?php echo $country['code']; ?></strong>
		</center>        
		<?php elseif (!isset($country['number2'])) : ?>
		<center>
		<br><br><br>
		- Envia <strong><?php echo $country['code']; ?></strong> desde tu Celular al <strong><?php echo $country['number']; ?></strong> para obtener tu Codigo
		</center>
		<?php else : ?>
			<center>
			<br><br><br>
			- Envia <strong><?php echo $country['code']; ?></strong> desde tu Celular al <strong><?php echo $country['number']; ?></strong> para obtener tu Codigo (<?php echo $country['op1']; ?>)<br>
			- Envia <strong><?php echo $country['code']; ?></strong> desde tu Celular al <strong><?php echo $country['number2']; ?></strong> para obtener tu Codigo (<?php echo $country['op2']; ?>)
			</center>
		<?php endif;
				if (isset($country['info2']))
			echo '<center>' . $country['info2'] . '</center>';
		?>
		<br>
		<div class="form-row" align="center">
		<?php
		if (isset($country['info3']))
			echo '<center>' . $country['info3'] . '</center>';
		echo $country['info'];
		?>
	</div>
	<br><br><br>
	<div class="form-row">
		<label for="code<?php echo $country['id']; ?>" class="label-full ">
			<strong>Introduce El Codigo Recibido Via SMS ó Telefono.<strong>
		</label>
		<input type="text" name="code<?php echo $country['id']; ?>" id="code<?php echo $country['id']; ?>" />
	</div>
</div>
<?php endforeach; ?>
<fieldset class="ui-controls " >
<a id="checkCode" href="javascript:;" class="ui-button button1" tabindex="1">
<span>
<span><?php echo $l->getString('template_account_conversion_next'); ?></span>
</span>
</a>
<a class="ui-cancel " href="<?php echo $this->getAppUrl('account/management/'); ?>" tabindex="1">
<span>
<?php echo $l->getString('template_blog_cancel_report'); ?> </span>
</a>
</fieldset>
</form>
</div>