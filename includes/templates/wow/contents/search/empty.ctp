<div class="search">
		<div class="search-right">
			<div class="search-header">
				<form action="<?php echo $this->getWowUrl('search'); ?>" method="get" class="search-form">
					<div>
						<input id="search-page-field" type="text" name="q" maxlength="200" tabindex="2" value="<?php echo $search->getQuery(); ?>" />
	<button class="ui-button button1 " type="submit" >
		<span>
			<span><?php echo $l->getString('template_search'); ?></span>
		</span>
	</button>

					</div>
				</form>
			</div>

	<div class="no-results">
	<h3 class="subheader ">				<?php echo $l->getString('template_search_empty_caption'); ?>
</h3>

	<h3 class="category ">			<?php echo $l->getString('template_search_empty_suggestions'); ?>
</h3>

		<ul>
			<?php echo $l->getString('template_search_empty_tips'); ?>
		</ul>
	</div>

		</div>

		<div class="search-left">
			<div class="search-header">
	<h2 class="header"><?php echo $l->getString('template_search'); ?>
</h2>
			</div>

		</div>

	<span class="clear"><!-- --></span>
	</div>