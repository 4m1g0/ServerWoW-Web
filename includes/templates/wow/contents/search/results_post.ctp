<div class="view-list">

	<?php
	$posts = $search->getResults('post');
	if ($posts) :
		$count = 1;
		$offset = $this->getPage(false) * 20;
		$iter = 20;
		foreach ($posts as &$p) :
			++$iter;
			if ($iter < $offset)
				continue;
			if ($count == 20)
				break;
	?>
	<div class="result ">
	<h4 class="subcategory ">
			<a href="<?php echo $p['url']; ?>"><?php echo $p['title']; ?></a> 

			<span class="small">(<?php echo $l->format('template_search_post_answers', $p['replies']); ?>)</span>
</h4>

		<div class="meta">
			<a href="<?php echo $p['cat_url']; ?>" class="sublink"><?php echo $p['cat_title']; ?></a> -

			<?php echo $l->getString('template_search_post_author'); ?><a href="<?php echo $this->getWowUrl('character/' . $p['author_realm'] . '/' . $p['author_name'] . '/'); ?>" class="author">
			<?php echo $p['author_name']; ?>
		</a> <?php echo $p['post_date']; ?>
		</div>

		<div class="content">
			<?php echo $p['post_preview']; ?>
		</div>

	<span class="clear"><!-- --></span>
	</div>
	<?php ++$count; endforeach; endif; ?>

		</div>

<?php echo $this->region('pagination'); ?>