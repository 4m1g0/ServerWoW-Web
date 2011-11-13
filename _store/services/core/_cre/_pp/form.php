<style type="text/css">
	/*select
	{
		background:url(/parchment-light2.jpg) repeat;
		color:#FFFFFF;
		border:#000000 solid 1px;
	}
	legend
	{
		font-weight:bold;
		color:#FFFFFF;
	}*/
	
	.SlidingPanelsContentGroup
	{
		float:left;
		width:850px;
	}
	.SlidingPanels
	{
		float:left;
		width:204px;
		height:204px;
		border:#000000 1px inset;
	}
	.SlidingPanelsContent
	{
		float:left;
		width:200px;
		height:200px;
	}
</style>
</head>
<body>
<center>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="apDiv3">
  <table width="525" border="0" cellspacing="5px" style="text-align:left;">
    <tr valign="top">
      <td>Realm:</td>
      <td><select id="realm" name="realm" style="width:150px;" onChange="getRewards(this.value);">
        <option>Your browser does not support this page.</option>
      </select></td>
      <td rowspan="5"><div id="description" class="SlidingPanels">
          <div class="SlidingPanelsContentGroup"> <?php echo $DESCRIPTIONS; ?> </div>
      </div></td>
    </tr>
    <tr valign="top">
      <td>Selecciona la Recompensa:</td>
      <td><select id="reward" name="reward" style="width:150px;" onChange="getPrice(this.value);">
        <option>Your browser does not support this page.</option>
     </select></td>
    </tr>
    <tr valign="top">
      <td>Costo:</td>
      <td><?php echo CURRENCY_CHAR; ?><span id="price"></span></td>
    </tr>
    <tr valign="top">
      <td><form onSubmit="return prepForm();" action="https://<?php echo PAYPAL_URL; ?>/cgi-bin/webscr" method="post" target="paypal">
          <!--
          Don't bother trying to change anything here,
          you won't get your reward.
          -->
          <input type="hidden" name="add" value="1" />
          <input type="hidden" name="cmd" value="_cart" />
          <input type="hidden" name="notify_url" value="<?php echo NOTIFY_URL; ?>" />
          <input type="hidden" id="item_name" name="item_name" value="" />
          <input type="hidden" id="amount" name="amount" value="" />
          <input type="hidden" id="item_number" name="item_number" value="" />
          <input type="hidden" name="quantity" value="1" />
          <input type="hidden" name="business" value="<?php echo PAYPAL_EMAIL; ?>" />
          <input type="hidden" name="currency_code" value="<?php echo CURRENCY_CODE; ?>" />
          <input type="image" src="https://www.paypal.com/es_ES/i/btn/btn_cart_SM.gif" name="submit" alt="PayPal - La forma Segura de Hacer compras en linea!" />
      	  <!--
          Donation system by 1337D00D
          -->
      </form></td>
      <td></td>
    </tr>
  </table>

</div></center>
<script type="text/javascript">

	Description = new Spry.Widget.SlidingPanels("description",{transition:Spry.circleTransition});

	var Realms = <?php echo $REALMS; ?>;
	var Rewards = <?php echo $REWARDS; ?>;
	var Status = document.getElementById("status");
	var Realm = document.getElementById("realm");
	var Reward = document.getElementById("reward");
	var Price = document.getElementById("price");
	var CharId = <?php echo $account_information['id']; ?>;

	function setupRealmlist()
	{
		var val;
		Realm.options.length = 0;
		for(val in Realms)
		{
			Realm.options[val] = new Option(Realms[val],val);
		}
	}
	
	function getRewards(realm)
	{
		var val;
		var i = 0;
		Reward.options.length = 0;
		for(val in Rewards)
		{
			if(Rewards[val].realm == realm)
			{
				Reward.options[i] = new Option(Rewards[val].name,val);
				i++;
			}
		}
		getPrice(Reward.value);
	}
	
	function getPrice(id)
	{
		Price.innerHTML = Rewards[id].price;
		Description.showPanel(parseInt(id));
	}
	

	function prepForm()
	{
		document.getElementById("item_name").value = Rewards[Reward.value].name;
		document.getElementById("amount").value = Rewards[Reward.value].price;
		document.getElementById("item_number").value = (parseInt(Realm.value)+1) +"-"+(parseInt(Reward.value)+1) +"-"+CharId;
		if(CharId == "0")
		{
			return confirm("La Cuenta NO Existe.\nSi Continuas NO Recibiras tu Recompenza.");
		}
		if(isNaN(CharId))
		{
			alert("There is a problem with the donation system.\nIt may not have been properly configured.\nPlease contact the administrator.");
			return false;
		}
		return true;
	}
	setupRealmlist();
	getRewards(0);
	
</script>
</body>
</html>
