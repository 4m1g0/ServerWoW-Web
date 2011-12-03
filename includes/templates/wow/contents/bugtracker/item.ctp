<?php
$item = $bt->getItem();
if (!$item) return;
?>
<script type="text/javascript" language="JavaScript">
	Bt.setXsToken('<?php echo $this->c('Cookie')->read('xstoken'); ?>');
	Bt.setId(<?php echo $item['id']; ?>);
	Bt.setItemInfo({priority: <?php echo $item['priority']; ?>, status: <?php echo $item['status']; ?>, closed: <?php echo $item['closed']; ?>, desc: '<?php echo str_replace(array("\'", "\n", "\r", "\t"), array('\'', '', '', ''), $item['description']); ?>', response: '<?php echo str_replace(array("\'", "\n", "\r", "\t"), array('\'', '', '', ''), $item['admin_response']); ?>'});
</script>

<div>
<div>
<span style="padding:20px;float:left"><h1>World of Warcraft Bug Tracker</h1>
</span>

<div class="filter-details">

<span class="clear"><!-- --></span>
</div>
</div>
</div>

<div style="">
	<div style="padding:20px;width:720px;height:<?php echo (500 + (sizeof($item['comments']) * 130)); ?>px;float:right;margin-top:-65px;position:relative;">
		<br />
		<h1<?php if ($item['type'] == BT_ITEM && isset($item['info'])) echo ' class="color-q' . $item['info']['Quality'] . '"'; ?>><?php
		switch ($item['type'])
		{
			case BT_ITEM:
			case BT_OBJECT:
			case BT_NPC:
				echo $item['info']['name'];
				break;
			case BT_QUEST:
				echo $item['info']['Title'];
				break;
			case BT_SPELL:
				echo $item['info']['SpellName'];
			default:
				echo $item['title'];
		}
		?></h1>
		Type: <strong><a href="<?php echo $this->getWowUrl('bugtracker/' . $item['type_str']); ?>"><span id="bugtype"><?php echo $item['categoryName']; ?></span></a></strong>
		<br />
		Author: <strong><a href="<?php echo $item['url']; ?>"><?php echo $item['name'] . ' @ ' . $item['realmName']; ?></a></strong>
		<br />
		Created: <strong><?php echo date('d/m/Y', $item['post_date']); ?></strong>
		<br />
		Status: <strong><?php echo !$item['closed'] ? '<span style="color: #ffff00;" id="bugopened">Opened' : '<span style="color: #00ff00;" id="bugopened">Closed'; ?></span></strong>
		<br />
		Solved: <strong><?php echo $item['status'] == 0 ? '<span style="color: #ff0000;" id="bugsolved">No' : '<span style="color: #00ff00;" id="bugsolved">Yes'; ?></span></strong>
		<br />
		Priority: <strong><?php echo '<span id="bugpriority" style="color: ' . $item['prColor'] . ';">' . $item['prName']; ?></span></strong>
		<br />
		Description: <strong><span id="bugdescription"><?php echo $item['description']; ?></span></strong>
		<?php if (!in_array($item['type'], array(BT_DEFAULT, BT_WEB, BT_OTHER, BT_STORE))) : ?>
		<br />
		Internal Link: <strong><a href="http://es.wowhead.com/<?php echo strtolower($item['categoryName']) . '=' . $item['item_id']; ?>" target="_blank">Wowhead.com</a></strong>
		<?php endif; ?>
		<span id="adminresponse">
		<?php
		if ($item['admin_response']) :
		?>
		<br />
		<b style="color: #00ff00;"><?php echo $item['admin_name'] ? $item['admin_name'] : 'Admin'; ?>'s Response:</b> <strong><?php echo $item['admin_response']; ?></strong> <i>(<?php echo date('d/m/Y', $item['response_date']); ?>)</i>
		<?php endif; ?>
		</span>
		<br />
		<br />
		<?php if ($this->c('AccountManager')->isAccountCharacter($item['realmId'], $item['guid']) || $this->c('AccountManager')->isAllowedToBugtracker()) : ?>
		<span id="editbug"><a class="ui-button button2" id="editbuglink" href="javascript:;"><span><span id="editbugcaption">Edit</span></span></a></span>
		<span id="solvebug"><a class="ui-button button2" id="solvebuglink" href="javascript:;"><span><span id="solvebugcaption">Mark as <?php echo $item['status'] ? 'Uns' : 'S'; ?>olved</span></span></a></span>
		<span id="closebug"><a class="ui-button button2" id="closebuglink" href="javascript:;"><span><span id="closebugcaption"><?php if ($item['closed']) echo 'Re-open'; else echo 'Close'; ?></span></span></a></span>
		<?php
		endif;
		if ($this->c('AccountManager')->isAllowedToBugtracker()) : ?>
		<span id="deletebug"><a class="ui-button button3" id="deletebuglink" href="javascript:;"><span><span id="deletebugcaption">Delete</span></span></a></span>
		<span id="responsebug"><a class="ui-button button3" id="responsebuglink" href="javascript:;"><span><span id="responsebugcaption">Post Response</span></span></a></span>
		<?php endif; ?>
		<br /><br />
		<div id="editformplace" style="display:none;"></div>
		<div id="responseformplace" style="display:none;"></div>

		<br />
		<span class="clear"><!-- --></span>
		
		<?php
		$char = $this->c('AccountManager')->getActiveCharacter();
		if ($char) :
		?>
		<h1>Add New Comment:</h1>
		<form action="" method="post">
		<table>
			<tr>
				<td>
					<strong><a href="<?php echo $this->getWowUrl('character/' . $char['realmName'] . '/' . $char['name']); ?>"><?php echo $char['name'] . ' @ ' . $char['realmName']; ?> </a></strong>
				</td>
			</tr>
			<tr>
				<td>
					<textarea name="comment[text]" cols=100 rows=10 class="input textarea"><?php if (isset($_POST['comment']['text'])) echo $_POST['comment']['text']; ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<button class="ui-button button2" type="submit" >
						<span>
							<span>Create</span>
						</span>
					</button>
				</td>
			</tr>
		</table>
		</form>
		<span class="clear"><!-- --></span>
		<br />
		<?php endif; ?>
		<?php if (isset($item['comments']) && $item['comments'] && sizeof($item['comments']) > 0) : ?>

		<h1>Comments (<?php echo sizeof($item['comments']); ?>):</h1>

		<div id="comments">
		<?php foreach ($item['comments'] as $c) : ?>
			<hr noshade/>
			<div>
				<strong><a href="<?php echo $c['url']; ?>" class="profile-link"><?php echo $c['name'] . ' @ ' . $c['realmName']; ?></a></strong>
				<br />
				<small><?php echo $c['date']; ?></small>
				<br />
				<br />
				<div>
					<?php echo $c['comment']; ?>
				</div>
				<span class="clear"><!-- --></span>
			</div>
			<br />
		<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>

	<div style="float:left;width:230px;height:<?php echo (500 + (sizeof($item['comments']) * 130)); ?>px;position:relative;">
		<?php echo $this->region('bt_menu'); ?>
	</div>
</div>