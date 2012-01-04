<script type="text/javascript" language="JavaScript">
	Bt.setXsToken('<?php echo $this->c('Cookie')->read('xstoken'); ?>');
</script>
<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<span style="padding:20px;float:left"><h1>ServerWoW BugTracker</h1>
</span>

<div class="filter-details">

<span class="clear"><!-- --></span>
</div>
</div>
</div>

<div style="min-height:900px;">
	<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
		<br />
		<?php if ($error_add) : ?><span style="color: #ff0000;">All fields are required!</span><?php endif; ?>
		<form action="" method="POST">
		<br />
		<table>
		<?php
		$form_fields = array(
			'revid' => array('Revision ID', 'text'),
			'fixid' => array('Fix ID', 'text'),
			'commiter' => array('Commiter', 'text'),
			'description' => array('Description', 'textarea'),
			'post_date' => array('Fix date (DD.MM.YYY Format)', 'text')
		);
		foreach ($form_fields as $field => $label) : 
		?>
			<tr valign="top">
				<td><label for="<?php echo $field; ?>"><?php echo $label[0]; ?></label></td>
				<td><?php if ($label[1] == 'text') : ?><input id="<?php echo $field; ?> type="text" class="input text" size=64 name="changelog[<?php echo $field; ?>]" value="<?php if (isset($_POST['changelog'][$field])) echo $_POST['changelog'][$field]; ?>" />
				<?php elseif ($label[1] == 'textarea') : ?><textarea name="changelog[<?php echo $field; ?>]" id="<?php echo $field; ?>" class="input textarea" rows="10" cols="80"><?php if (isset($_POST['changelog'][$field])) echo $_POST['changelog'][$field]; ?></textarea><?php endif; ?></td>
			</tr>
		<?php endforeach; ?>
			<tr>
				<td colspan="2"><button id="submitter" class="ui-button button2" type="submit"><span><span>Crear</span></span></button></td>
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