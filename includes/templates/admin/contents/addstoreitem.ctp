<?php
$cats = $admin->getStoreCategories();
if (!$cats) return ;
?>
<h3>Add Item</h3>
<form action="" method="post">
<div class="input select">
Category
<select name="item[cat_id]">
<?php
$cats = $admin->getStoreCategories();
if ($cats) : foreach ($cats as $c) :
?>
	<option value="<?php echo $c['cat_id']; ?>"<?php if (isset($_POST['item']['cat_id']) && $_POST['item']['cat_id'] == $c['cat_id']) echo ' selected="selected"'; ?>><?php echo $c['title']; ?></option>
<?php endforeach; endif; ?>
</select>
</div>
<div class="input text long">
ID
<input type="text" name="item[id]" value="<?php if (isset($_POST['item']['id'])) echo $_POST['item']['id']; ?>" size=50 />
</div>
<div class="input text long">
Title
<input type="text" name="item[title]" value="<?php if (isset($_POST['item']['title'])) echo $_POST['item']['title']; ?>" size=50 />
</div>
<div class="input text long">
Price
<input type="text" name="item[price]" value="<?php if (isset($_POST['item']['price'])) echo $_POST['item']['price']; else echo '0'; ?>" size=50 />
</div>
<div class="input select">
Service Type
<script language="javascript">
	$(document).ready(function() {
		hideServiceFields();
		showFields();
		<?php if (isset($_POST['item']['itemset_pieces']) && $_POST['item']['itemset_pieces'] != '') echo '$(\'#isetpieces\').show();'; ?>
	});

	function showFields()
	{
		var serviceType = parseInt($('#servicetype').val(), 10);

		hideServiceFields();
		if (!serviceType || serviceType < 0)
			return;

		switch (serviceType)
		{
			case 8:
				$('#goldamount').show();
				break;
			case 9:
				$('#profskill').show();
				break;
		}
	}

	function hideServiceFields()
	{
		$('#isetpieces').hide();
		$('#goldamount').hide();
		$('#profskill').hide();
	}
</script>
<select id="servicetype" name="item[service]" onchange="showFields();">
<option value="0"<?php if (!isset($_POST['item']['service']) || (isset($_POST['item']['service']) && $_POST['item']['service'] == 0)) echo ' selected="selected"'; ?>>-- No Service --</option>
<?php
foreach ($GLOBALS['_STORE_SERVICES'] as $c) :
?>
	<option value="<?php echo $c[0]; ?>"<?php if (isset($_POST['item']['service']) && $_POST['item']['service'] == $c[0]) echo ' selected="selected"'; ?>><?php echo $c[1]; ?></option>
<?php endforeach; ?>
</select>
</div>
<br />
<div class="input checkbox">
<input type="checkbox" name="item[in_store]" value="1" <?php if (isset($_POST['item']) && isset($_POST['item']['in_store'])) echo ' checked="checked"'; elseif (!isset($_POST['item'])) echo ' checked="checked"'; ?> id="instore" /><label for="instore">Available in store</label>
</div>
<br />
<div class="input checkbox">
<script language="javascript">
</script>
<input type="checkbox" onclick="if ($(this).attr('checked')) $('#isetpieces').fadeIn(); else $('#isetpieces').fadeOut();" name="item[itemset]" value="1" <?php if (isset($_POST['item']['itemset'])) echo ' checked="checked"'; ?> id="itemset" /><label for="itemset">Itemset</label>
</div><br />
<div class="input text long" id="isetpieces" style="display:none;">
Itemset pieces ("32458 32459 32460", for example)
<input type="text" name="item[itemset_pieces]" value="<?php if (isset($_POST['item']['itemset_pieces'])) echo $_POST['item']['itemset_pieces']; else echo ''; ?>" size=50 />
</div>
<div class="input text long">
Price Discount (%; left 0 to disable discounts):
<input type="text" name="item[discount]" value="<?php if (isset($_POST['item']['discount'])) echo $_POST['item']['discount']; else echo ''; ?>" />
</div>
<div class="input text long" id="goldamount" style="display:none;">
Gold Amount (GOLD_ITEM is enabled if value > 0):
<input type="text" name="item[gold_amount]" value="<?php if (isset($_POST['item']['gold_amount'])) echo $_POST['item']['gold_amount']; else echo ''; ?>" />
</div>
<div class="input select" id="profskill" style="display:none;">
Profession SKILL ID:
<select name="item[prof_skill_id]">
<option value="0"<?php if (!isset($_POST['item']['prof_skill_id']) || (isset($_POST['item']['prof_skill_id']) && $_POST['item']['prof_skill_id'] == 0)) echo ' selected="selected"'; ?>>-- No Profession --</option>
<?php

foreach ($GLOBALS['_STORE_PROFESSIONS'] as $c) :
?>
	<option value="<?php echo $c; ?>"<?php if (isset($_POST['item']['prof_skill_id']) && $_POST['item']['prof_skill_id'] == $c) echo ' selected="selected"'; ?>><?php echo $l->getString('profession_' . $c); ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>