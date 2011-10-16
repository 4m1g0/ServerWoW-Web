<?php if (!$sidebar) return; ?>
<div class="sidebar-module" id="sidebar-forums">
	<div class="sidebar-title">
		<h3 class="category title-forums">
			<a href="<?php echo $this->getWowUrl('forum/'); ?>"><?php echo $l->getString('template_menu_forums'); ?></a>
		</h3>
	</div>

	<div class="sidebar-content">
		<ul class="trending-topics">
		<?php foreach ($sidebar as $topic) : ?>

			<li>
				<a href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id']); ?>" class="topic"><?php echo $topic['title']; ?></a>
				<a href="<?php echo $this->getWowUrl('forum/' . $topic['cat_id']); ?>" class="forum"><?php echo $topic['catTitle']; ?></a> - <span class="date"><?php echo date('d/m/Y H:i', $topic['last_update']); ?></span>
			</li>
		<?php endforeach; ?>

		</ul>
	</div>
</div>
