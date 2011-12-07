<center>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Search 728&#42;90) */
google_ad_slot = "2771465252";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>

<div class="search">
		<div class="search-right">
			<div class="search-header">
				<form action="<?php echo $this->getWowUrl('search'); ?>" method="get" class="search-form">
					<div>
						<input id="search-page-field" type="text" name="q" maxlength="200" tabindex="2" value="<?php echo $search->getAuthorQuery() != null ? $search->getAuthorQuery() : $search->getQuery(); ?>" />

	<button class="ui-button button1 " type="submit" >
		<span>
			<span><?php echo $l->getString('template_search'); ?></span>
		</span>
	</button>

					</div>
				</form>
			</div>

	<div class="helpers">
	<h3 class="subheader "><?php echo $l->format('template_search_results_' . $search->getSearchType(), $search->getQuery()); ?>
</h3>
	</div>

	<?php echo $this->region('searchResults'); ?>

		</div>

		<div class="search-left">
			<div class="search-header">
	<h2 class="header "><?php echo $l->getString('template_search'); ?></h2>
			</div>





	<ul class="dynamic-menu" id="menu-search">
	<?php
	$types = array('summary', 'wowarenateam', 'article', 'wowcharacter', 'post', 'static', 'wowguild', 'wowitem');
	foreach ($types as $type) : if (!$search->issetResultsFor($type) && $type != 'summary') continue;
	?>
	<li<?php if ($search->getSearchType() == $type) echo ' class="item-active"'; ?>>
		<a href="<?php echo $this->getWowUrl('search?q=' . $search->getQuery() . '&amp;f=' . ($type == 'summary' ? '' : $type)); ?>">
			<span class="arrow"><?php echo $l->getString('template_search_results_side_' . $type); ?><?php if ($type != 'summary') : ?> <span>(<?php echo $search->getCounters($type); ?>)</span><?php endif; ?></span>
		</a>
	</li>
	<?php
	endforeach;
	?>
	</ul>
		</div>

	<span class="clear"><!-- --></span>
	</div>