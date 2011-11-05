<h3>Edit Category Items</h3>
<?php
$items = $admin->getStoreCategoryItems();
if (!$items) return ;
?>
<script language="javascript" type="text/javascript">
var toggled = false;
function toggleItems()
{
	if (toggled)
		$('form#items INPUT[type=checkbox]').removeAttr('checked');
	else
		$('form#items INPUT[type=checkbox]').attr('checked', 'checked');

	toggled = !toggled;
}
</script>
<a href="javascript:;" onclick="toggleItems();">Toggle Items</a>
<hr />
<form action="" method="post" id="items" name="items">
<input type="hidden" name="cat[cat_id]" value="<?php echo $this->core->getUrlAction(3); ?>" />
<?php
foreach ($items as $it) :
?>
<div class="input checkbox">
<input type="checkbox" class="cbitem" name="cat[items][<?php echo $it['item_id']; ?>]" id="item<?php echo $it['item_id']; ?>" <?php if (isset($_POST['cat']['items'][$it['item_id']])) echo ' checked="checked"'; ?>/>
<label for="item<?php echo $it['item_id']; ?>"><a href="/admin/store/item/<?php echo $it['item_id']; ?>/edit"><?php if (!isset($it['template'])) echo 'Item #' . $it['item_id']; else echo $it['template']['name']; ?></a></label>
</div><br />
<?php endforeach; ?>
<div class="input text long">
<input type="submit" value="Delete Selected" size=50 />
</div>
</form>