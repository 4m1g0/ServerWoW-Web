	<div id="wiki" class="wiki wiki-item">
	
	<br>
	<div style="margin-left:30px">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (items 728&#42;90) */
google_ad_slot = "5245760639";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
		<div class="sidebar">
	<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Armeria-items 300&#42;250) */
google_ad_slot = "3165312077";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>	
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
			<?php if ($item->isAvailableInStore()) : ?>
			<li>
				<a href="<?php echo $this->getWowUrl('store/' . $item->getStoreCatId() . '/' . $item->item('entry')); ?>" class="item-link-small-right color-q<?php echo $item->item('Quality'); ?>">
					<span class="icon-frame frame-14 ">
						<img src="<?php echo $this->c('Config')->getValue('site.icons_server'); ?>/18/<?php echo $item->item('icon'); ?>.jpg" alt="" width="14" height="14" />
					</span>
				</a>
				<a href="<?php echo $this->getWowUrl('store/' . $item->getStoreCatId() . '/' . $item->item('entry')); ?>">Este item esta disponible en la Tienda!</span></span></a>
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
					<?php
					$relatedTabs = array(
						'dropCreatures', 'dropGameObjects', 'vendors',
						'currencyForItems', 'rewardFromQuests', 'skinnedFromCreatures',
						'pickPocketCreatures', 'minedFromCreatures', 'createdBySpells',
						'reagentForSpells', 'disenchantItems', 'comments'
					);
					$tabs = $item->getItemTabsCounters();
					if ($tabs) :
						foreach ($relatedTabs as $tab) :
							if (!isset ($tabs[$tab])) continue;
					?>
						<li>
							<a href="#<?php echo $tab; ?>" data-key="<?php echo $tab; ?>" id="tab-<?php echo $tab; ?>">
								<span><span>
										<?php echo $l->format('template_item_tab_' . $tab, $tabs[$tab]); ?>
								</span></span>
							</a>
						</li>
					<?php endforeach; endif; ?>

					</ul>

	<span class="clear"><!-- --></span>
				</div>

				<div id="related-content" class="loading"> <!-- CHANGEME: related-content -->
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