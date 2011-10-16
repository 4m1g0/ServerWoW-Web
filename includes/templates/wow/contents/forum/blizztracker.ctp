<div id="forum-content" class="bluetracker">
	<div class="forum-actions top">
		<div class="actions-panel">
			<ul class="ui-pagination">
				<?php echo $this->region('pagination'); ?>
			</ul>
			<span class="clear"><!-- --></span>
		</div>
	</div>

    <div id="posts-container">
		<table id="posts" cellspacing="0" class="simple">
			<thead>
				<tr class="post-th">
					<td></td>
					<td colspan="2"><?php echo $l->getString('template_forums_table_thread'); ?></td>
					<td><?php echo $l->getString('template_forums_table_author'); ?></td>
				</tr>
			</thead>

			<tbody class="bluetracker-body">
				<?php if ($posts) : $jump = $l->getString('template_blizztracker_jump_first'); foreach ($posts as $post) : ?>
				<tr id="postRow<?php echo $post['post_id']; ?>" class="blizzard">
					<td class="post-icon">
						<div class="forum-post-icon">
								<div class="blizzard_icon">
									<a href="<?php echo $this->getWowUrl('forum/topic/' . $post['thread_id'] . ($post['page'] > 1 ? '?page=' . $post['page'] : '') . '#' . $post['post_num']); ?>" data-tooltip="<?php echo $jump; ?>"></a>
								</div>
						</div>
					</td>
					<td class="post-title" colspan="2">
						<div class="content">
							<a href="<?php echo $this->getWowUrl('forum/topic/' . $post['thread_id'] . ($post['page'] > 1 ? '?page=' . $post['page'] : '') . '#' . $post['post_num']); ?>">‘<?php echo $post['message']; ?>’</a>
						</div>
						<div class="desc">
							[<a href="../872818/" class="forum-source"><?php echo $post['catTitle']; ?></a>]
							<a href="../topic/2793223621#1"><?php echo $post['title']; ?></a>
							- <?php echo date('d/m/Y', $post['post_date']); ?>
						</div>
					</td>
					<td class="post-author">
						<span class="type-blizzard"><?php echo $post['blizz_name']; ?> <img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/layout/cms/icon_blizzard.gif" alt="" />
						</span>
					</td>
				</tr>
				<?php endforeach; endif; ?>
			</tbody>
		</table>
    </div>

	<div class="forum-actions topic-bottom">
		<div class="actions-panel">
			<ul class="ui-pagination">
				<?php echo $this->region('pagination'); ?>
			</ul>

			<span class="clear"><!-- --></span>
		</div>
	</div>
</div>