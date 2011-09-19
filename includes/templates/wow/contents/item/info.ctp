	<div id="wiki" class="wiki wiki-item">
		<div class="sidebar">
	
	<?php if (in_array($item->item('class'), array(ITEM_CLASS_ARMOR, ITEM_CLASS_WEAPON))) :
		if (!in_array($item->item('InventoryType'), array(INV_TYPE_FINGER, INV_TYPE_NECK, INV_TYPE_RANGED, INV_TYPE_RELIC, INV_TYPE_TRINKET))) :
	?>
	<div class="snippet">
		<div class="model-viewer">
				<div class="model" id="model-<?php echo $item->item('entry'); ?>">
					<div class="loading">
						<div class="viewer" style="background-image: url('http://eu.media.blizzard.com/wow/renders/items/item<?php echo $item->item('entry'); ?>.jpg');"></div>
					</div>
					<a href="javascript:;" class="zoom"></a>
					<a href="javascript:;" class="rotate"></a>
				</div>


		</div>

        <script type="text/javascript">
        //<![CDATA[
			$(function() {
				Item.model = new ModelRotator("#model-<?php echo $item->item('entry'); ?>", {
					zoom: false,
					rotate: false
				});
			});
        //]]>
        </script>
	</div>
	<?php endif; endif; ?>

	<div class="snippet">
		<h3><?php echo $l->getString('template_item_quick_facts'); ?></h3>
		<ul class="fact-list">
			<?php if ($item->item('RequiredDisenchantSkill') > 0) : ?>
				<li>
					<?php echo $l->format('template_item_disenchant_fact', $item->item('RequiredDisenchantSkill')); ?>
				</li>
			<?php endif; ?>
			<?php if ($exCost = $item->item('extended_cost')) : ?>
				<li>
					<?php if ($exCost['items']) : foreach ($exCost['items'] as &$cost_item) : ?>
					<a href="<?php echo $this->getWowUrl('item/' . $cost_item['entry']); ?>" class="item-link-small-right color-q<?php echo $cost_item['Quality']; ?>">
						<span class="count"><?php echo $cost_item['count']; ?></span>
						<span class="icon-frame frame-14 ">
							<img src="<?php echo $this->c('Config')->getValue('site.icons_server'); ?>/18/<?php echo $cost_item['icon']; ?>.jpg" alt="" width="14" height="14" />
						</span>
					</a>
					<?php endforeach; endif; ?>
				</li>
			<?php endif; ?>
		</ul>
	</div>

	<div class="snippet">
			<h3><?php echo $l->getString('template_item_learn_more'); ?></h3>
		<span id="fansite-links"></span>
        <script type="text/javascript">
        //<![CDATA[
			$(function() {
				Fansite.generate('#fansite-links', "item|<?php echo $item->item('entry'); ?>|<?php echo $item->item('name'); ?>");
			});
        //]]>
        </script>
	</div>
		</div>

	<?php echo $this->region('wow_ajax'); ?>

	<span class="clear"><!-- --></span>
			<div class="related">
				<div class="tabs ">
					<ul id="related-tabs">
								<li>
									<a href="#dropCreatures" data-key="dropCreatures" id="tab-dropCreatures">
										<span><span>
												Dropped From
												(<em>1</em>)
										</span></span>
									</a>
								</li>
								<li>
									<a href="#disenchantItems" data-key="disenchantItems" id="tab-disenchantItems">
										<span><span>
												Disenchants Into
												(<em>1</em>)
										</span></span>
									</a>
								</li>
								<li>
									<a href="#comments" data-key="comments" id="tab-comments">
										<span><span>
												Comments
												(<em>0</em>)
										</span></span>
									</a>
								</li>
					</ul>

	<span class="clear"><!-- --></span>
				</div>

				<div id="relateds-content" class="loading">
				</div>
			</div>

        <script type="text/javascript">
        //<![CDATA[
				$(function() {
					Wiki.pageUrl = '<?php echo $this->getWowUrl('item/' . $item->item('entry')); ?>/';
				});
        //]]>
        </script>
	</div>