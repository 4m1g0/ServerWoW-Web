<div id="page-header">
<h2 class="subcategory">Amigos</h2>
<h3 class="headline">Amigos Bloqueados</h3>
</div>
<div id="page-content" class="page-content">
	<div align="center">
		<table style="width:50%;">
			<thead>
				<?php
					$block_user = $this->c('AccountManager')->getblockFriends();
					if ($block_user)
					{
						foreach ($block_user as $block_users)
						{
				?>			
				<tr>
					<th>Usuario</th>
					<th>Desbloquear</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $block_users['name']; ?></td>
					<td><a href="//serverwow.com/webroot/cometchat/plugins/block/index.php?action=unblock&id=<?php echo $block_users['id'];?>&basedata=null" target="_blank">Desbloquear</a></td>
				</tr>
					<?php
						}
					}
					else
					{
						echo "No has bloqueado a nadie";
					}
					?>
			</tbody>
		</table>
	</div>
</div>