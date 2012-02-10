<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:Foros:Categoria-Centro:Abajo', [728, 90], 'div-gpt-ad-1328890364205-0').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:Foros:Categoria-Centro:Arriba', [728, 90], 'div-gpt-ad-1328890364205-1').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<center>
<!-- ServerWoW:Foros:Categoria-Centro:Arriba -->
<div id='div-gpt-ad-1328890364205-1' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328890364205-1'); });
</script>
</div>
</center>

<?php if (!isset($forum) || !$forum) return; ?>

<div id="forum-content">
		<script type="text/javascript">
		//<![CDATA[
			$(function(){ Cms.Forum.threadListInit('<?php echo $forum->getCategoryId(); ?>'); });
		//]]>
	    </script>
		<div class="forum-options">
            <a href="javascript:;"  onclick="Cms.Forum.setView('advanced',this)">Advanced</a>
        	<a href="javascript:;"  class="active" onclick="Cms.Forum.setView('simple',this)">Simple</a>
        </div>

    <div class="forum-actions top">
		<div class="actions-panel">
			<form action="<?php echo $this->getWowUrl('search'); ?>" class="forum-search" method="get">
				<div>
					<input type="text" name="q" value="Buscar en este foro.." alt="Buscar en este foro.." id="forum-search-field" />
					<input type="hidden" name="f" value="post" />
					<input type="hidden" name="forum" value="<?php echo $forum->getCategoryId(); ?>" />
				</div>
			</form>

			<script type="text/javascript">
			//<![CDATA[
				$(function() { Input.bind('#forum-search-field'); });
			//]]>
			</script>

			<a class="ui-button button1 <?php if (!$this->c('Forum')->isAllowedToAction('category', BANNED_FLAG_ALLOW_TOPICS)) echo 'disabled'; ?>" href="<?php if ($this->c('Forum')->isAllowedToAction('category', BANNED_FLAG_ALLOW_TOPICS)) echo $this->getWowUrl('forum/' . $forum->getCategoryId() . '/topic'); else echo 'javascript:;'; ?>"<?php if (!$this->c('AccountManager')->isLoggedIn()) : ?> onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>');"<?php endif; ?>>
				<span>
					<span><?php echo $l->getString('template_forums_create_thread'); ?></span>
				</span>
			</a>


			<span class="clear"><!-- --></span>
        </div>

        <?php if ($pagination) echo '<ul class="ui-pagination">' . $pagination . '</ul>'; ?>

	<span class="clear"><!-- --></span>
    </div>


    <div id="posts-container">
			<table id="posts" cellspacing="0" class="simple">
				<thead>
					<tr class="post-th">
						
						<td></td>
						<td colspan="2">Subject</td>
						<td>Author</td>
							<td class="replies">Replies</td>
							<td class="views">Views</td>
							<td class="poster">Last Poster</td>
					</tr>
				</thead>
				<?php
				$topics = $forum->getCategoryTopics();
				$topic_types = array(
					'featured' => array('class' => 'featured', 'prefix' => '[' . $l->getString('template_forum_thread_featured') . ']'),
					'pinned' => array('class' => 'stickied', 'prefix' => '[' . $l->getString('template_forum_thread_sticky') . ']'),
					'regular' => array('class' => '', 'prefix' => '')
				);
				if ($topics) :
					$jumpToBlizzPost = $l->getString('template_forum_jump_first_blizz');
					foreach ($topic_types as $type => $typeInfo) :
					if (isset($topics[$type]) && $topics[$type]) : ?>
					<tbody class="<?php echo $type; ?>">
					<?php
						foreach ($topics[$type] as $topic) :
				?>

				<tr id="postRow<?php echo $topic['thread_id']; ?>" class="<?php echo ' ' . $typeInfo['class']; if ($topic['read']) echo ' read'; ?>">
					<td class="post-icon">
						<div class="forum-post-icon">
							<?php if ($topic['flags'] & THREAD_FLAG_BLIZZ_ANSWERED) : ?>
								<div class="blizzard_icon">
									<a href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id'] . '#1'); ?>" data-tooltip="<?php echo $jumpToBlizzPost; ?>"></a>
								</div>
							<?php endif; ?>
						</div>
					</td>
					<td class="post-title">
								<span class="post-status">
								<?php echo $typeInfo['prefix']; ?></span>

							<div id="thread_tt_<?php echo $topic['thread_id']; ?>" style="display:none">
								<div class="tt_detail">
									‘<?php echo $topic['short_content']; ?>’
								</div>


								<div class="tt_time"><?php echo date('d/m/Y', $topic['post_date']); ?></div>
								<div class="tt_info">
									<?php echo $topic['views']; ?> Views / <?php echo $topic['posts']; ?> Replies<br />
										Last Post by <?php echo $topic['last_poster'] . ' (' . date('d/m/Y', $topic['last_update']) . ')'; ?>
									</div>
								</div>
							</div>
							<a href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id']); ?>" data-tooltip="#thread_tt_<?php echo $topic['thread_id']; ?>" data-tooltip-options='{"location": "mouse"}'>
								<?php echo $topic['title']; ?>
								<?php if ($topic['flags'] & THREAD_FLAG_CLOSED) echo '<img src="' . CLIENT_FILES_PATH . '/wow/static/images/layout/cms/post_locked.gif" alt="" />'; ?>
							</a>
					</td>
					<td class="post-pageNav">
					&#160;
					</td>
					<?php /* if ($topic['visited_page'] > 0) : ?>
					<td class="post-pages">
						<a class="last-read" data-tooltip="Jump to your last read page" href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id'] . '?page=' . $topic['visited_page']); ?>"></a>
						<!-- comment for ie6 -->
						<span> </span>
					</td>
					<?php endif; */ ?>
					<td class="post-author">
							<?php if ($topic['blizzpost'] == 1):  ?>
							<span class="type-blizzard">
								<?php echo $topic['forums_name'] ? $topic['forums_name'] : $topic['name']; ?>
								<img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/layout/cms/icon_blizzard.gif" alt="" />
							</span>
							<?php else : echo $topic['name']; endif; ?>
					</td>
					<td class="post-replies">
						<?php echo $topic['posts']; ?>
					</td>
					<td class="post-views">
						<?php echo $topic['views']; ?>
					</td>
					<td class="post-lastPost">
						<?php
						$lastAnch = $topic['last_poster_anchor'];
						$lPage = 0;
						if ($lastAnch > 20)
							$lPage = ceil($lastAnch / 20);
						?>
						<a href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id']); ?><?php echo $lPage > 0 ? '?page=' . $lPage : '';  ?>#<?php echo $lastAnch; ?>" data-tooltip="(<?php echo date('d/m/Y', $topic['last_update']); ?>)">
							<?php if ($topic['last_poster_type'] == 1) echo '<span class="type-blizzard">'; echo $topic['last_poster']; if ($topic['last_poster_type'] == 1) echo '</span>'; ?>
						</a>
						<?php if ($topic['last_poster_type'] == 1) : ?><img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/layout/cms/icon_blizzard.gif" alt="" /><?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>
					</tbody>
				<?php endif; endforeach; endif; ?>

			</table>
    </div>

        <div class="forum-info">

    <div class="forum-actions topic-bottom">
		<div class="actions-panel">
		
<center>
<!-- ServerWoW:Foros:Categoria-Centro:Abajo -->
<div id='div-gpt-ad-1328890364205-0' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328890364205-0'); });
</script>
</div>
</center>
<br><br>		
			<?php if ($pagination) echo '<ul class="ui-pagination">' . $pagination . '</ul>'; ?>

	<a class="ui-button button1 <?php if (!$this->c('Forum')->isAllowedToAction('category', BANNED_FLAG_ALLOW_TOPICS)) echo 'disabled'; ?>" href="<?php if ($this->c('Forum')->isAllowedToAction('category', BANNED_FLAG_ALLOW_TOPICS)) echo $this->getWowUrl('forum/' . $forum->getCategoryId() . '/topic'); else echo 'javascript:;'; ?>"<?php if (!$this->c('AccountManager')->isLoggedIn()) : ?> onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>');"<?php endif; ?>>
		<span>
			<span><?php echo $l->getString('template_forums_create_thread'); ?></span>
		</span>
	</a>

	<span class="clear"><!-- --></span>
        </div>

    </div>
        </div>
    </div>