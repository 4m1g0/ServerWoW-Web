<script type="text/javascript" language="JavaScript">
	Bt.setXsToken('<?php echo $this->c('Cookie')->read('xstoken'); ?>');
</script>
<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<span style="padding:20px;float:left"><h1>World of Warcraft Bug Tracker</h1>
</span>

<div class="filter-details">

<span class="clear"><!-- --></span>
</div>
</div>
</div>

<div style="min-height:900px;">
	<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
		<br />
		<form action="" method="POST">
		<input type="hidden" name="type" value="<?php echo $bt->getCategoryId(); ?>" id="type" />
		<?php if (!in_array($bt->getCategoryId(), array(BT_WEB, BT_OTHER, BT_DEFAULT, BT_STORE))) :?>
		<span style="color: #ffff00;">Use Wowhead to find out ID</span>
		<?php endif; ?>
		<br />
		<table>
		<?php if (!in_array($bt->getCategoryId(), array(BT_WEB, BT_OTHER, BT_DEFAULT, BT_STORE))) :?>
			<tr>
				<td><label for="item">ID:</label></td>
				<td><input type="text" class="input text" name="item" id="item" value="<?php if (isset($_POST['item'])) echo $_POST['item']; ?>" /></td>
			</tr>
		<?php else : ?>
			<tr>
				<td><label for="title">Title:</label></td>
				<td><input type="text" class="input text" size=64 name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>" /></td>
			</tr>
		<?php endif; ?>
			<tr id="sameReport" style="display:none;">
				<td colspan="2" id="sameReportText">
					<span style="color: #ff0000;">
						There's already created bug report for current ID: <a href="<?php echo $this->getWowUrl('bugtracker/'); ?>" id="sameReportUrl">#0</a>.<br />Please, use this report instead of creating the new one.
					</span>
				</td>
			</tr>
			<tr>
				<td><label for="priority">Priority:</label></td>
				<td>
					<select class="input select" name="priority" id="priority">
						<option value="1"<?php if (isset($_POST['priority']) && $_POST['priority'] == 1) echo ' selected="selected"'; ?>>Low</option>
						<option value="2"<?php if (isset($_POST['priority']) && $_POST['priority'] == 2) echo ' selected="selected"'; ?>>Medium</option>
						<option value="3"<?php if (isset($_POST['priority']) && $_POST['priority'] == 3) echo ' selected="selected"'; ?>>High</option>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top"><label for="desc">Description:</label></td>
				<td>
					<textarea name="desc" id="desc" class="input textarea" rows="10" cols="80"><?php if (isset($_POST['desc'])) echo $_POST['desc']; ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2"><button id="submitter" class="ui-button button2" type="submit"><span><span>Create</span></span></button></td>
			</tr>
		</table>
		</form>
	</div>

	<div style="float:left;width:230px;position:relative;">
		<?php echo $this->region('bt_menu'); ?>
	</div>
</div>
	</div>
	</div>