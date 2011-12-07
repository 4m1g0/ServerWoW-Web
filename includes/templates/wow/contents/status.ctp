<div class="content-header">
				<h2 class="header ">Estado de los reinos</h2>


		<div class="desc">Esta página muestra todos los reinos de World of Warcraft disponibles, así como su estado actual. Un reino puede aparecer como ACTIVO o NO ACTIVO. Los mensajes sobre el estado del reino y los horarios de mantenimiento se publicarán en los foros del <a href="http://eu.battle.net/wow/es/forum/1028283/">Estado del servicio</a>. Queremos pedir disculpas de antemano si tu reino aparece como “no activo”. Lo más probable es que ya estemos trabajando para reactivarlo lo antes posible.</div>
	<span class="clear"><!-- --></span>
	</div>

	<div id="realm-status">
	<ul class="tab-menu ">
				<li>
					<a href="javascript:;"
					   
					    class="tab-active">
					   Todos los reinos
					</a>
				</li>
	</ul>

		<div class="filter-toggle">
			<a href="javascript:;" class="selected" onclick="RealmStatus.filterToggle(this)">
				<span style="display: none">Mostrar ocultar filtros</span>
				<span>Ocultar filtros</span>
			</a>
		</div>

		<div id="realm-filters" class="table-filters">
			<form action="">
				<div class="filter">
					<label for="filter-status">Estado</label>
					
					<select id="filter-status" class="input select" data-filter="column" data-column="0">
						<option value="">Todos</option>
						<option value="up">Activo</option>
						<option value="down">No activo</option>
					</select>
				</div>

				<div class="filter">
					<label for="filter-name">Nombre del reino</label>

					<input type="text" class="input" id="filter-name" 
						   data-filter="column" data-column="1" />
				</div>

				<div class="filter">
					<label for="filter-type">Tipo</label>

					<select id="filter-type" class="input select" data-filter="column" data-column="2">
						<option value="">Todos</option>
							<option value="pve">
								JcE
							</option>
							<option value="rppvp">
								JR JcJ
							</option>
							<option value="pvp">
								JcJ
							</option>
							<option value="rp">
								JR
							</option>
					</select>
				</div>
				<div class="filter">
					<label for="filter-population">Población</label>

					<select id="filter-population" class="input select" data-filter="column" data-column="3">
						<option value="">Todos</option>
							<option value="high">Alto</option>
							<option value="medium">Medio</option>
							<option value="low">Bajo</option>
					</select>
				</div>

				<div class="filter" id="locale-filter">
					<label for="filter-locale">Local</label>

					<select id="filter-locale" class="input select" data-column="4" data-filter="column">
						<option value="">Todos</option>
							<option value="español">Español</option>
							<option value="alemán">Alemán</option>
							<option value="francés">Francés</option>
							<option value="ruso">Ruso</option>
							<option value="inglés">Inglés</option>
					</select>
				</div>


				<div class="filter" style="margin: 5px 0 5px 15px">
					

	<button
		class="ui-button button1 "
			type="button"
			
		
		id="filter-button"
		
		onclick="RealmStatus.reset();"
		
		
		
		>
		<span>
			<span>Restablecer</span>
		</span>
	</button>

				</div>

	<span class="clear"><!-- --></span>
			</form>
		</div>
	</div>
<center>
	<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Estado 728&#42;90) */
google_ad_slot = "2183527149";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center>

		<div id="all-realms">
	<div class="table full-width">
		<table>
			<thead>
				<tr>
					<th><a href="javascript:;" class="sort-link"><span class="arrow">Estado</span></a></th>
					<th><a href="javascript:;" class="sort-link"><span class="arrow">Nombre del reino</span></a></th>
					<th><a href="javascript:;" class="sort-link"><span class="arrow">Tipo</span></a></th>
					<th><a href="javascript:;" class="sort-link"><span class="arrow">Población</span></a></th>
					<th><a href="javascript:;" class="sort-link"><span class="arrow">Local</span></a></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($realms):
					$toggleStyle = 2;
					foreach ($realms as &$r) :
				?>
					<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
						<td class="status" data-raw="<?php echo $r['status']; ?>">
							<div class="status-icon <?php echo $r['status']; ?>"
								 data-tooltip="<?php echo $l->getString(($r['status'] == 'up' ? 'template_realm_status_available' : 'template_realm_status_not_available')); ?>">
							</div>
						</td>
						<td class="name">
							<?php echo $r['name']; ?>
						</td>
						<td data-raw="<?php echo strtolower($r['type']); ?>" class="type">
							<span class="<?php echo strtolower($r['type']); ?>">
									(<?php echo $r['type']; ?>)
							</span>
						</td>
						<td class="population" data-raw="medium">
							<span class="medium">
									<?php echo $l->getString('template_realm_status_popul_medium'); ?>
							</span>
						</td>
						<td class="locale">
							<?php echo $r['language']; ?>
						</td>
					</tr>
				<?php endforeach; endif; ?>
				<tr class="no-results" style="display: none">
					<td colspan="6">Ningún resultado coincide con los filtros seleccionados.</td>
				</tr>
			</tbody>
		</table>
	</div>
		</div>

	<span class="clear"><!-- --></span>