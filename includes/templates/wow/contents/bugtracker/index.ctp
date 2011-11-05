<div class="media-content">
<div class="media-content">

<div class="currently-viewing">
<div>
<span style="padding:20px;float:left"><h1>World of Warcraft Bug Tracker</h1><span style="color:#00ff00;">Select category to create new report</span></span>

<div class="filter-details">

<span class="clear"><!-- --></span>
</div>
</div>
</div>

<div style="min-height:900px;">
	<div style="padding:20px;width:720px;float:right;margin-top:-65px;">
		<form id="roster-form" action="">
					<label>State</label>
					<select name="closed">
						<option value="-1"<?php if (!isset($_GET['closed'])) echo ' selected="selected"'; ?>>All</option>
						<option value="0"<?php if (isset($_GET['closed']) && $_GET['closed'] == 0) echo ' selected="selected"'; ?>>Opened</option>
						<option value="1"<?php if (isset($_GET['closed']) && $_GET['closed'] == 1) echo ' selected="selected"'; ?>>Closed</option>
					</select>
					<label>Status</label>
					<select name="status">
						<option value="-1"<?php if (!isset($_GET['status'])) echo ' selected="selected"'; ?>>All</option>
						<option value="0"<?php if (isset($_GET['status']) && $_GET['status'] == 0) echo ' selected="selected"'; ?>>Unsolved</option>
						<option value="1"<?php if (isset($_GET['status']) && $_GET['status'] == 1) echo ' selected="selected"'; ?>>Solved</option>
					</select>
					<label>Priority</label>
					<select name="priority">
						<option value="0"<?php if (!isset($_GET['priority'])) echo ' selected="selected"'; ?>>All</option>
						<option value="1"<?php if (isset($_GET['priority']) && $_GET['priority'] == 1) echo ' selected="selected"'; ?>>Low</option>
						<option value="2"<?php if (isset($_GET['priority']) && $_GET['priority'] == 2) echo ' selected="selected"'; ?>>Medium</option>
						<option value="3"<?php if (isset($_GET['priority']) && $_GET['priority'] == 3) echo ' selected="selected"'; ?>>High</option>
					</select>
					<input type="radio" name="searchType" id="searchAnd" value="0"<?php if (!isset($_GET['searchType']) || (isset($_GET['searchType']) && $_GET['searchType'] == '0')) echo ' checked="checked"'; ?> /> <label for="searchAnd">All criterias</label>
					<input type="radio" name="searchType" id="searchOr" value="1"<?php if (isset($_GET['searchType']) && $_GET['searchType'] == '1') echo ' checked="checked"'; ?>/> <label for="searchOr">At least one criteria</label>
					&nbsp;&nbsp;&nbsp;
					<button class="ui-button button2" type="submit" >
						<span>
							<span>Filtro</span>
						</span>
					</button>
					<a href="<?php echo $this->getWowUrl('bugtracker/' . $bt->getCurrent()); ?>">Reiniciar</a>
					<?php if ($bt->getCurrent() != null) echo '<span style="float:right"><a href="' . $this->getWowUrl('bugtracker/' . $bt->getCurrent() . '/add') . '">Create Bug Report</a></span>'; ?>
					<span class="clear"><!-- --></span>
					<br />
			</form>
		<div class="item-results" id="item-results">
			<div class="table full-width">
				<table>
					<thead>
						<tr>
							<th><span class="sort-tab">Title</span></th>
							<th><span class="sort-tab">Type</span></th>
							<th><span class="sort-tab">Priority</span></th>
							<th><span class="sort-tab">Current State</span></th>
							<th><span class="sort-tab">Status</span></th>
							<th><span class="sort-tab">Created</span></th>
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
							<td><span style="color: <?php echo $item['closed'] == 0 ? '#ffff00' : '#00ff00'; ?>;"><strong><?php echo $item['closed'] == 0 ? 'Opened' : 'Closed'; ?></strong></span></td>
							<td><span style="color: <?php echo $item['status'] == 0 ? '#ffff00' : '#00ff00'; ?>;"><strong><?php echo $item['status'] == 0 ? 'Unsolved' : 'Solved'; ?></strong></span></td>
							<td><?php echo date('d/m/Y', $item['post_date']); ?></td>
						</tr>
						<?php ++$toggleStyle; endforeach; else : ?>
						<tr class="row1">
							<td colspan="6" class="align-center">Nothing found</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	<span class="clear"><!-- --></span>

	</div>

	<div style="float:left;width:230px;position:relative;">
		<?php echo $this->region('bt_menu'); ?>
	</div>
</div>
	</div>
	</div>