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
					<input type="text" name="q" value="Search this forum…" alt="Search this forum…" id="forum-search-field" />
					<input type="hidden" name="f" value="post" />
					<input type="hidden" name="forum" value="<?php echo $forum->getCategoryId(); ?>" />
				</div>
			</form>

			<script type="text/javascript">
			//<![CDATA[
						$(function() { Input.bind('#forum-search-field'); });
			//]]>
			</script>

			<a class="ui-button button1 " href="topic" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>');">
				<span>
					<span>Create Thread</span>
				</span>
			</a>


			<span class="clear"><!-- --></span>
        </div>

        <?php echo $this->region('pager'); ?>

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
					'sticky' => array('class' => 'stickied', 'prefix' => '[' . $l->getString('template_forum_thread_sticky') . ']'),
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

				<tr id="postRow<?php echo $topic['thread_id']; ?>" class="<?php echo ' ' . $typeInfo['class']; ?>">
					<td class="post-icon">
						<div class="forum-post-icon">
							<?php if ($topic['flags'] & THREAD_FLAG_BLIZZ_ANSWERED) : ?>
								<div class="blizzard_icon">
									<a href="../topic/<?php echo $topic['thread_id']; ?>#1" data-tooltip="<?php echo $jumpToBlizzPost; ?>"></a>
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
									<?php echo $topic['views']; ?> Views / 2 Replies<br />
										Last Post by Thuiljos (19/11/2010)
								</div>
							</div>
							<a href="../topic/<?php echo $topic['thread_id']; ?>" data-tooltip="#thread_tt_<?php echo $topic['thread_id']; ?>" data-tooltip-options='{"location": "mouse"}'>
								<?php echo $topic['title']; ?>
								<?php if ($topic['flags'] & THREAD_FLAG_CLOSED) echo '<img src="' . CLIENT_FILES_PATH . '/wow/static/images/layout/cms/post_locked.gif" alt="" />'; ?>
							</a>
					</td>
					<td class="post-pageNav">
						&#160;
					</td>
					<td class="post-author">
							<?php if ($topic['blizzpost'] == 1):  ?>
							<span class="type-blizzard">
								<?php echo $topic['blizz_name'] ? $topic['blizz_name'] : $topic['name']; ?>
								<img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/layout/cms/icon_blizzard.gif" alt="" />
							</span>
							<?php else : echo $topic['name']; endif; ?>
					</td>
					<td class="post-replies">
						2
					</td>
					<td class="post-views">
						<?php echo $topic['views']; ?>
					</td>
					<td class="post-lastPost">
						<a href="../topic/<?php echo $topic['thread_id']; ?>#3" data-tooltip="(19/11/2010)">
								<span class="type-blizzard">
										Thuiljos
								</span>
						</a>
								<img src="/wow/static/images/layout/cms/icon_blizzard.gif" alt="" />
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

			<?php echo $this->region('pager'); ?>



	<a class="ui-button button1 " href="topic" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>');" >
		<span>
			<span>Create Thread</span>
		</span>
	</a>


	<span class="clear"><!-- --></span>
        </div>

    </div>
        </div>
    </div>