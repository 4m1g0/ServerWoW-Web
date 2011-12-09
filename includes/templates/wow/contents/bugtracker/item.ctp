<?php
$item = $bt->getItem();
if (!$item) return;
?>
<script type="text/javascript" language="JavaScript">
	Bt.setXsToken('<?php echo $this->c('Cookie')->read('xstoken'); ?>');
	Bt.setId(<?php echo $item['id']; ?>);
	Bt.setItemInfo({priority: <?php echo $item['priority']; ?>, status: <?php echo $item['status']; ?>, closed: <?php echo $item['closed']; ?>, desc: '<?php echo str_replace(array("\'", "\n", "\r", "\t"), array('\'', '', '', ''), $item['description']); ?>', response: '<?php echo str_replace(array("\'", "\n", "\r", "\t"), array('\'', '', '', ''), $item['admin_response']); ?>'});
	$(document).ready(function() {
	//	$('#content').attr('style', 'height:1024px');
	});
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
<div>
	<div style="padding:20px;width:720px;float:right;margin-top:-65px;position:relative;">
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
		Tipo: <strong><a href="<?php echo $this->getWowUrl('bugtracker/' . $item['type_str']); ?>"><span id="bugtype"><?php echo $item['categoryName']; ?></span></a></strong>
		<br />
		Autor: <strong><a href="<?php echo $item['url']; ?>"><?php echo $item['name'] . ' @ ' . $item['realmName']; ?></a></strong>
		<br />
		Created: <strong><?php echo date('d/m/Y', $item['post_date']); ?></strong>
		<br />
		Estado: <strong><?php echo !$item['closed'] ? '<span style="color: #ffff00;" id="bugopened">Abierto' : '<span style="color: #00ff00;" id="bugopened">Cerrado'; ?></span></strong>
		<br />
		Solucionado: <strong><?php echo $item['status'] == 0 ? '<span style="color: #ff0000;" id="bugsolved">No' : '<span style="color: #00ff00;" id="bugsolved">Si'; ?></span></strong>
		<br />
		Prioridad: <strong><?php echo '<span id="bugpriority" style="color: ' . $item['prColor'] . ';">' . $item['prName']; ?></span></strong>
		<br />
		Descripción: <strong><span id="bugdescription"><?php echo $item['description']; ?></span></strong>
		<?php if (!in_array($item['type'], array(BT_DEFAULT, BT_WEB, BT_OTHER, BT_STORE))) : ?>
		<br />
		Enlace interno: <strong><a href="http://es.wowhead.com/<?php echo strtolower(substr($item['type_str'], 0, -1)) . '=' . $item['item_id']; ?>" target="_blank">Wowhead.com</a></strong>
		<?php endif; ?>
		<span id="adminresponse">
		<?php
		if ($item['admin_response']) :
		?>
		<br />
		<b style="color: #00ff00;">Respuesta de <?php echo $item['admin_name'] ? $item['admin_name'] : 'Admin'; ?>:</b> <strong><?php echo $item['admin_response']; ?></strong> <i>(<?php echo date('d/m/Y', $item['response_date']); ?>)</i>
		<?php endif; ?>
		</span>
		<br />
		<br />
		<?php if ($this->c('AccountManager')->isAccountCharacter($item['realmId'], $item['guid']) || $this->c('AccountManager')->isAllowedToBugtracker()) : ?>
		<span id="editbug"><a class="ui-button button2" id="editbuglink" href="javascript:;"><span><span id="editbugcaption">Editar</span></span></a></span>
		<span id="solvebug"><a class="ui-button button2" id="solvebuglink" href="javascript:;"><span><span id="solvebugcaption"><?php echo $item['status'] ? 'Marcar no solucionado' : 'Marcar solucionado'; ?></span></span></a></span>
		<span id="closebug"><a class="ui-button button2" id="closebuglink" href="javascript:;"><span><span id="closebugcaption"><?php if ($item['closed']) echo 'Abrir'; else echo 'Cerrar'; ?></span></span></a></span>
		<?php
		endif;
		if ($this->c('AccountManager')->isAllowedToBugtracker()) : ?>
		<span id="deletebug"><a class="ui-button button3" id="deletebuglink" href="javascript:;"><span><span id="deletebugcaption">Borrar</span></span></a></span>
		<span id="responsebug"><a class="ui-button button3" id="responsebuglink" href="javascript:;"><span><span id="responsebugcaption">Respuesta desarrollo</span></span></a></span>
		<?php endif; ?>
		<br /><br />
		<div id="editformplace" style="display:none;"></div>
		<div id="responseformplace" style="display:none;"></div>

		<br />
		<span class="clear"><!-- --></span>
		
		<?php
		$char = $this->c('AccountManager')->getActiveCharacter();
		if ($char && !$item['closed']) :
		?>
		<h1>Añadir nuevo comentario:</h1>
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
							<span>Enviar</span>
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

		<?php if ($this->c('AccountManager')->isAllowedToModerate()) : ?>
		<script language="javascript">
			function deleteComment(id)
			{
				$.ajax({
					url: Core.baseUrl + '/bugtracker/api?id=<?php echo $item['id']; ?>&xstoken=<?php echo $this->c('Cookie')->read('xstoken'); ?>&type=deleteComment',
					'type': 'POST',
					data: {comment_id: id},
					success: function(data) {
						data = $.parseJSON(data);

						if (data.errno == 0)
							$('#comment-' + id).fadeOut();
					}
				});
			}
		</script>
		<?php endif; ?>
		<style type="text/css">
			.bt-blizzard {color:#00B6FF;}
			.bt-blizzard a{ color:#00B6FF;}
			.bt-mvp { color:#81b558 }
			.bt-mvp a{ color:#81b558 }
		</style>
		<h1>Comentarios (<?php echo sizeof($item['comments']); ?>):</h1>

		<div id="comments">
		<?php
		$i = 0;
		$page = 0;
		foreach ($item['comments'] as $c) :
		if ($i == 0)
		{
			++$page;
			echo '<span id="bt_page' . $page .'"' . ($page > 1 ? ' style="display:none;"' : '') . '>';
		}
		?>
			<div<?php if ($c['blizzard']) echo ' class="bt-blizzard"'; elseif ($c['mvp']) echo ' class="bt-mvp"'; ?> id="comment-<?php echo $c['comment_id']; ?>">
			<hr noshade/>
			<strong><a href="<?php echo $c['url']; ?>" class="profile-link"><?php echo $c['name'] . ' @ ' . $c['realmName']; ?></a></strong>
				<br />
				<small><?php echo $c['date']; ?></small>
				<?php 
				if (($this->c('AccountManager')->isAllowedToModerate() && !$c['blizzard'] && (!$c['mvp'] || ($c['account_id'] == $this->c('AccountManager')->user('id')))) || ($this->c('AccountManager')->isAdmin())) : 
				?>
				<small><a href="javascript:;" onclick="deleteComment(<?php echo $c['comment_id']; ?>);">Borrar comentario</a></small>
				<?php endif; ?>
				<br />
				<br />
				<div>
					<?php echo $c['comment']; ?>
				</div>
				<span class="clear"><!-- --></span>
			</div>
		<?php
		++$i;
		if ($i == 5)
		{
			echo '</span>';
			$i = 0;
		}
		endforeach; ?>
		</div>
		<span class="clear"><!-- --></span>
		<script language="javascript">
			var pages = <?php echo $page; ?>;
			var current = 1;
			function switchPage(ctx, type)
			{
				if (!ctx)
					return false;

				if (type == 'prev' && current == 1)
					return;
				else if (type == 'next' && current == pages)
					return;

				for (var i = 1; i <= pages; ++i)
				{
					$('#bt_page' + i).hide();
					$('#page' + i + 'li').removeClass('current');
				}

				if (!type)
				{
					current = parseInt($(ctx).attr('data-page'), 10);
					$('#page' + current + 'li').addClass('current');
					$('#bt_page' + current).show();
					return true;
				}

				if (type && type == 'prev' && current > 1)
				{
					current -= 1;
					$('#bt_page' + current).show();
					$('#page' + current + 'li').addClass('current');
				}
				else if (type && type == 'next' && current < pages)
				{
					current += 1;
					$('#bt_page' + current).show();
					$('#page' + current + 'li').addClass('current');
				}
				return true;
			}
		</script>
		<?php if ($page > 1) : ?>
		<br /><br />
		<ul class="ui-pagination">
			<li class="cap-item"><a href="javascript:;" onclick="switchPage(this, 'prev');" id="pageprev">Prev.</a></li>
			<?php
			for ($i = 0; $i < $page; ++$i) : ?>
			<li<?php if ($i == 0) echo ' class="current"'; ?> id="page<?php echo ($i + 1); ?>li"><a href="javascript:;" onclick="switchPage(this);" id="page<?php echo ($i + 1); ?>" data-page="<?php echo ($i + 1); ?>"><?php echo ($i + 1); ?></a></li>
			<?php endfor; ?>
			<li class="cap-item"><a href="javascript:;" onclick="switchPage(this, 'next');" id="pagenext">Next</a></li>
		</ul>
		<?php endif; ?>
		<?php endif; ?>
	</div>

	<div style="float:left;width:230px;">
		<?php echo $this->region('bt_menu'); ?>
	</div>
	<br />
</div>
<span class="clear"><!-- --></span>
<br/>
