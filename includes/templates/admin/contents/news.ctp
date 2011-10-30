<h3>News</h3>
<p><a href="/admin/news/add">Add New Item</a> | <a href="/admin/news/deleteAll" onclick="javascript:return confirm('Delete all news? Are you sure?');">Delete All</a> </p>
<hr />
<p>
	<ul>
		<?php
		$news = $admin->getNews();
		if ($news) :
			foreach ($news as $n) : ?>
		<li><a href="/admin/news/edit/<?php echo $n['id']; ?>"><?php echo $n['title']; ?></a></li>
		<?php endforeach; endif; ?>
	</ul>
</p>