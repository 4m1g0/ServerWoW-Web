<div id="page-header">
<h2 class="subcategory"><?php echo $l->getString('template_management_menu_mail_caption'); ?></h2>
<h3 class="headline"><?php echo $l->getString('template_inbox_messages'); ?></h3>
</div>
<div id="page-content" class="page-content">
	<div align="center">
		<table style="width:50%;">
			<thead>
				<tr>
					<th><?php echo $l->getString('template_msg_status'); ?></th>
					<th><?php echo $l->getString('template_msg_sender'); ?></th>
					<th><?php echo $l->getString('template_msg_date'); ?></th>
					<th><?php echo $l->getString('template_msg_title'); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr><td colspan="5">&nbsp;</td></tr>
				<?php
				$msgs = $this->c('AccountManager')->getPrivateMessages();
				if (!$msgs) :
				?>
				<tr><td colspan="4" align="center">Nothing found</td></tr>
				<?php
				else :
					foreach ($msgs as $msg) :
				?>
				<tr>
					<td><?php echo $msg['read'] ? 'Read' : 'Unread'; ?></td>
					<td><?php echo $msg['sender']; ?></td>
					<td><?php echo date('d/m/Y H:i', $msg['send_date']); ?></td>
					<td><a href="/account/management/inbox/<?php echo $msg['msg_id']; ?>"><?php echo $msg['title']; ?></a></td>
				</tr>
				<?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</div>