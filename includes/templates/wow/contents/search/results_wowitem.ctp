<?php echo $this->region('pagination'); ?>
<div class="view-table">


	<div class="table ">
		<table>
				<thead>
					<tr>


							<th class=" first-child">





		<a href="javascript:;" class="sort-link" >
			<span class="arrow"><?php echo $l->getString('template_item_table_name'); ?>
</span>
		</a>
							</th>


							<th>





		<a href="javascript:;" class="sort-link" >
			<span class="arrow">									<?php echo $l->getString('template_item_table_level'); ?>
</span>
		</a>
							</th>


							<th>





		<a href="javascript:;" class="sort-link" >
			<span class="arrow">									<?php echo $l->getString('template_item_table_required_level'); ?>
</span>
		</a>
							</th>


							<th>

			<span class="sort-tab" >									<?php echo $l->getString('template_item_table_source'); ?>
</span>

							</th>


							<th class=" last-child">

			<span class="sort-tab" >									<?php echo $l->getString('template_item_table_type'); ?>
</span>

							</th>
					</tr>
				</thead>
			<tbody>

			<?php
			$items = $search->getResults('wowitem');
			if ($items) :
				$toggleStyle = 2;
				$count = 1;
				$offset = $this->getPage(false) * 20;
				$iter = 20;
				foreach ($items as &$i) :
					++$iter;
					if ($iter < $offset)
						continue;
					if ($count == 20)
						break;
			?>
			<tr class="row<?php echo $toggleStyle % 2 ? '1' : '2'; ?>">
				<td>
					<a href="<?php echo $this->getWowUrl('item/' . $i['entry']); ?>" class="item-link color-q<?php echo $i['Quality']; ?>">




		<span  class="icon-frame frame-18 " style='background-image: url("<?php echo $this->getMediaServer(); ?>/wow/icons/18/<?php echo $i['icon']; ?>.jpg");'>
		</span>
						<strong><?php echo $i['name']; ?></strong>

					</a>
				</td>
				<td class="align-center">
						<?php echo $i['ItemLevel']; ?>
				</td>
				<td class="align-center">
					<?php if ($i['RequiredLevel'] > 0) echo $i['RequiredLevel']; ?>
				</td>
				<td>

				</td>
				<td>

			

				</td>
			</tr>
			<?php ++$toggleStyle; ++$count; endforeach; endif; ?>

			</tbody>
		</table>
	</div>
		</div>
<?php echo $this->region('pagination'); ?>