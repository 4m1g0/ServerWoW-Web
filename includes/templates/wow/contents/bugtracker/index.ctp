<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<span style="padding:20px;float:left"><h1>ServerWoW BugTracker</h1><span style="color:#00ff00;">Selecciona la Categoria</span></span>

<div class="filter-details">

<span class="clear"><!-- --></span>
</div>
</div>
</div>

<div style="min-height:900px;">
	<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
		<form id="roster-form" action="">
					<label>Estado</label>
					<select name="closed">
						<option value="-1"<?php if (!isset($_GET['closed'])) echo ' selected="selected"'; ?>>Todos</option>
						<option value="0"<?php if (isset($_GET['closed']) && $_GET['closed'] == 0) echo ' selected="selected"'; ?>>Abierto</option>
						<option value="1"<?php if (isset($_GET['closed']) && $_GET['closed'] == 1) echo ' selected="selected"'; ?>>Cerrado</option>
					</select>
					<label>Progreso</label>
					<select name="status">
						<option value="-1"<?php if (!isset($_GET['status'])) echo ' selected="selected"'; ?>>Todos</option>
						<option value="0"<?php if (isset($_GET['status']) && $_GET['status'] == 0) echo ' selected="selected"'; ?>>Sin Resolver</option>
						<option value="1"<?php if (isset($_GET['status']) && $_GET['status'] == 1) echo ' selected="selected"'; ?>>Solucionado</option>
					</select>
					<label>Prioridad</label>
					<select name="priority">
						<option value="0"<?php if (!isset($_GET['priority'])) echo ' selected="selected"'; ?>>Todos</option>
						<option value="1"<?php if (isset($_GET['priority']) && $_GET['priority'] == 1) echo ' selected="selected"'; ?>>Baja</option>
						<option value="2"<?php if (isset($_GET['priority']) && $_GET['priority'] == 2) echo ' selected="selected"'; ?>>Media</option>
						<option value="3"<?php if (isset($_GET['priority']) && $_GET['priority'] == 3) echo ' selected="selected"'; ?>>Alta</option>
					</select>
					<input type="radio" name="searchType" id="searchAnd" value="0"<?php if (!isset($_GET['searchType']) || (isset($_GET['searchType']) && $_GET['searchType'] == '0')) echo ' checked="checked"'; ?> /> <label for="searchAnd">Todos los Filtros</label>
					<input type="radio" name="searchType" id="searchOr" value="1"<?php if (isset($_GET['searchType']) && $_GET['searchType'] == '1') echo ' checked="checked"'; ?>/> <label for="searchOr">Un Filtro</label>
					&nbsp;&nbsp;&nbsp;
					<button class="ui-button button2" type="submit" >
						<span>
							<span>Filtro</span>
						</span>
					</button>
					<a href="<?php echo $this->getWowUrl('bugtracker/' . $bt->getCurrent()); ?>">Reiniciar</a>
					<?php if ($bt->getCurrent() != null && $this->c('AccountManager')->isLoggedIn()) echo '<br /><br /><span><a class="ui-button button2" href="' . $this->getWowUrl('bugtracker/' . $bt->getCurrent() . '/add') . '"><span><span>Crear reporte de Error</span></span></a></span>'; ?>
					<span class="clear"><!-- --></span>
					<br />
			</form>
			<center><script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Bugtracker 728&#42;90) */
google_ad_slot = "5141927827";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center>
		<div class="item-results" id="item-results">
			<div class="table full-width">
				<table>
					<thead>
						<tr>
							<th><span class="sort-tab">Titulo</span></th>
							<th><span class="sort-tab">Tipo</span></th>
							<th><span class="sort-tab">Prioridad</span></th>
							<th><span class="sort-tab">Estado</span></th>
							<th><span class="sort-tab">Progreso</span></th>
							<th><span class="sort-tab">Creado</span></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$items = $bt->getItems();
						if ($items) :
							$toggleStyle = 2;
							foreach ($items as $item) :
						?>
						<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
							<td><strong><a href="<?php echo $this->getWowUrl('bugtracker/bug/' . $item['id']); ?>"><?php echo $item['title']; ?></a></strong></td>
							<td class="align-center"><?php echo $item['categoryName']; ?></td>
							<td class="align-center"><span style="color: <?php echo $item['prColor']; ?>;"><strong><?php echo $item['prName']; ?></strong></span></td>
							<td><span style="color: <?php echo $item['closed'] == 0 ? '#ffff00' : '#00ff00'; ?>;"><strong><?php echo $item['closed'] == 0 ? 'Abierto' : 'Cerrado'; ?></strong></span></td>
							<td><span style="color: <?php if ($item['status'] == 0) echo '#ffff00'; else if ($item['status'] == 1) echo '#00ff00'; else echo '#cccccc'; ?>;"><strong><?php if ($item['status'] == 0) echo 'Sin Resolver'; else if ($item['status'] == 1) echo 'Solucionado'; else echo 'Desestimado'; ?></strong></span></td>
							<td><?php echo date('d/m/Y', $item['post_date']); ?></td>
						</tr>
						<?php ++$toggleStyle; endforeach; else : ?>
						<tr class="row1">
							<td colspan="6" class="align-center">No se ha encontrado ningun resultado</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	<span class="clear"><!-- --></span><br />
			<ul class="ui-pagination">
				<?php echo $pagination; ?>
			</ul>
	<span class="clear"><!-- --></span>
	<br>
<center><script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Bugtracker 728&#42;90) */
google_ad_slot = "5141927827";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center>
	</div>

	<div style="float:left;width:230px;position:relative;">
		<?php echo $this->region('bt_menu'); ?>
	</div>
</div>
	</div>
	</div>
