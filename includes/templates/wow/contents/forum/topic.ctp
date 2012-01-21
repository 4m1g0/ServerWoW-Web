<center>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Foro 728&#42;90) */
google_ad_slot = "7696919487";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>

<?php if (!isset($forum) || !$forum) return; ?>
<script type="text/javascript">
        //<![CDATA[
        $(function(){
			Cms.Topic.topicInit(<?php echo $forum->getTopicId(); ?>,<?php echo $forum->getTopicCategoryId(); ?>,1);
		});
        //]]>
 </script>

    <!--[if IE 6]>
        <script type="text/javascript">
        //<![CDATA[
		$(function(){ Cms.Topic.topicInitIe(); });
        //]]>
        </script>
	<![endif]-->

	<div id="forum-content">
		<div class="section-header">
			<?php
			$blizz_posts = $forum->getBlizzPostsInTopic();
			$lastBlizzPostIdx = 0;
			if ($blizz_posts)
			{
				echo '<span class="blizzard_icon">
                    <a class="nextBlizz" href="' . $this->getWowUrl('forum/topic/' . $forum->getTopicId() . ($blizz_posts[0]['page'] > 1 ? '?page=' . $blizz_posts[0]['page'] : '') . '#' . $blizz_posts[0]['anchor']) . '" data-tooltip="' . $l->getString('template_forum_jump_first_blizz') . '">
                    </a>
                </span>';
			}
			?>
            <span class="topic"><?php echo $l->getString('template_forum_topic'); ?></span>
			<span class="sub-title">
			<?php
			$topic = $forum->getTopicData();
			$flags = $topic['flags'];
			$flags_strings = array(THREAD_FLAG_PINNED => 'template_forum_subtitle_pinned_thread', THREAD_FLAG_CLOSED => 'template_forum_subtitle_closed_thread');
			$flag_str = '';
			foreach ($flags_strings as $flag => $string)
				if ($flags & $flag)
					$flag_str .= $this->c('Locale')->getString($string) . ' ';
			?>
			<?php echo ($flag_str ? '(' . $flag_str . ') ' : '') . $forum->getTopicTitle(); ?></span>
        </div>

		<div class="forum-actions top">
			<div class="actions-panel">
				<?php echo $this->region('pagination'); ?>
				<a class="ui-button button1<?php if (($flags & THREAD_FLAG_CLOSED && !$this->c('AccountManager')->isAllowedToModerate()) || !$this->c('Forum')->isAllowedToAction('topic', BANNED_FLAG_ALLOW_POSTS)) echo ' disabled'; ?>" href="<?php echo (($flags & THREAD_FLAG_CLOSED && !$this->c('AccountManager')->isAllowedToModerate()) || !$this->c('Forum')->isAllowedToAction('topic', BANNED_FLAG_ALLOW_POSTS)) ? 'javascript:;' : '#new-post'; ?>"<?php if (!$this->c('AccountManager')->isLoggedIn()) : ?> onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>');"<?php endif; ?>>
					<span>
						<span><?php echo $l->getString('template_blog_add_post'); ?></span>
					</span>
				</a>
				<span class="clear"><!-- --></span>
			</div>
			<?php if ($this->c('AccountManager')->isAllowedToModerate()) : ?>
				<div class="cm-actions">
					<?php if ($flags & THREAD_FLAG_CLOSED) : ?>
						<a class="button3" href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id'] . '/unlock'); ?>"><span title="Unlock" class="icon unlock"></span></a>
					<?php else : ?>
						<a class="button3" href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id'] . '/lock'); ?>"><span title="Lock" class="icon lock"></span></a>
					<?php endif; ?>
						<a class="button3" href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id'] . '/edit'); ?>"><span title="Edit" class="icon edit"></span></a>
					<?php if ($flags & THREAD_FLAG_PINNED) : ?>
						<a class="button3" href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id'] . '/unsticky'); ?>"><span title="Unsticky" class="icon unsticky"></span></a>
					<?php else : ?>
						<a class="button3" href="<?php echo $this->getWowUrl('forum/topic/' . $topic['thread_id'] . '/sticky'); ?>"><span title="Sticky" class="icon sticky"></span></a>
					<?php endif; ?>
				</div>
			<span class="clear"><!-- --></span>
			<?php endif; ?>
		</div>

		<div id="thread">
<?php
$posts = $forum->getTopicPosts();
if ($posts) :
	$currentPostNum = 1;
	foreach ($posts as &$post) :
		if ((!$post['realmName'] || !$post['name']) && !$post['blizzpost'])
			continue;

		if ($post['blizzpost'])
		{
			if ($post['forums_name'])
				$post['name'] = $post['forums_name'];
			elseif ($post['blizz_name'])
				$post['name'] = $post['blizz_name'];
		}
		else
			$charUrl = $this->getWowUrl('character/' . $post['realmName'] . '/' . $post['name']);
?>
			<div id="post-<?php echo $post['post_id']; ?>" class="post<?php if ($post['blizzpost']) echo ' blizzard'; else {if ($post['group_mask'] & ADMIN_GROUP_MVP) echo ' mvp'; elseif (($post['group_mask'] & ADMIN_GROUP_EXTRA_FORUM_COLOR) && $post['group_style']) echo ' ' . $post['group_style']; } if ($post['deleted']) echo ' hidden' ?>">
				<span id="<?php echo $post['post_num']; ?>"></span>
				<?php if ($post['deleted']) : ?>
				<div class="deleted">
					 <table>
						 <tr>
							<td class="post-character">
								<div class="character-info user-name-container">
									<div class="user-name">
										<span class="char-name-code" style="display: none"><?php echo $post['name']; ?></span>
										<div id="context-6" class="ui-context" style="display: none; ">
											<div class="context">
												<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

												<div class="context-user">
													<strong><?php echo $post['name']; ?></strong>
															<br />
															<span><?php echo $post['realmName']; ?></span>
												</div>
												<div class="context-links">
													<?php if (!$post['blizzpost']) :?>
														<a href="<?php echo $charUrl; ?>" title="<?php echo $l->getString('template_profile_caption'); ?>" rel="np" class="icon-profile link-first">
															<?php echo $l->getString('template_profile_caption'); ?>
														</a>
													<?php endif; ?>
														<a href="<?php echo $this->getWowUrl('search?f=post&amp;a=' . urlencode($post['name'] . ($post['blizzpost'] ? '' : '@' . $post['realmName'])) . '&amp;sort=time'); ?>" title="<?php echo $l->getString('template_blog_lookup_forum_messages'); ?>" rel="np" class="icon-posts">	</a>
												</div>
											</div>

										</div>
										<a href="" class="context-link wow-class-<?php echo $post['class']; ?>" rel="np"><?php echo $post['name']; ?></a></div>

                                    </div>
                                </td>
                                <td>
                                    <div class="post-detail">
										<?php
										echo $l->format('template_forum_post_deleted_by', ($post['deleted_by'] ? $post['deleted_by'] : $post['name'])); ?>
                                    </div>
								</td>
                                <td class="post-info">
                                    <div class="post-info-int">
                                        <div class="postData">
                                            <span class="lowrated">
                                                	<?php echo $l->getString('template_forum_post_deleted'); ?>
                                            </span>
                                           	<a href="#<?php echo $post['post_num']; ?>"> #<?php echo $post['post_num']; ?></a>
                                            <div class="date"><?php echo date('d/m/Y H:i', $post['post_date']); ?></div>
                                        </div>
                                    </div>
                                </td>
                             </tr>
							</table>
                         </div>
				<?php endif; ?>
				<div class="post-interior<?php if ($post['deleted']) echo ' low-rated'; ?>">
				<?php if (!$post['deleted']) : ?>
					<table>
						<tr>
							<td class="post-character">
								<div class="post-user">
									<div class="avatar">
										<div class="avatar-interior">
<?php if (!$post['blizzpost']) : ?>
											<a href="<?php echo $charUrl; ?>"><img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/2d/avatar/<?php echo $post['race'] . '-' . $post['gender']; ?>.jpg" alt="" width="64" /></a>
<?php else : ?>
											<img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/layout/cms/blizz_avatar.gif" alt="" width="64" />
<?php endif; ?>
										</div>
									</div>
									<div class="character-info">
										<div class="user-name">
											<span class="char-name-code" style="display: none">
												<?php echo $post['name']; ?>
											</span>
											<div id="context-<?php echo $post['post_num']; ?>" class="ui-context">
												<div class="context">
													<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

													<div class="context-user">
														<strong><?php echo $post['name']; ?></strong>
<?php if (!$post['blizzpost']) : ?>
														<br />
														<span><?php echo $post['realmName']; ?></span>
<?php endif; ?>
													</div>

													<div class="context-links">
<?php if (!$post['blizzpost']) : ?>
														<a href="<?php echo $charUrl; ?>" title="<?php echo $l->getString('template_profile_caption'); ?>" rel="np" class="icon-profile link-first"><?php echo $l->getString('template_profile_caption'); ?></a>
														<a href="<?php echo $this->getWowUrl('search?f=post&amp;a=' . urlencode($post['name'] . '@' . $post['realmName']) . '&amp;sort=time'); ?>" title="<?php echo $l->getString('template_blog_lookup_forum_messages'); ?>" rel="np" class="icon-posts"> </a>
														<a href="javascript:;" title="<?php echo $l->getString('template_blog_add_to_black_list'); ?>" rel="np" class="icon-ignore link-last" onclick="Cms.ignore(<?php echo $post['guid']; ?>, false); return false;"> </a>
<?php else : ?>
														<a href="<?php echo $this->getWowUrl('search?f=post&amp;a=' . urlencode($post['name']) . '&amp;sort=time'); ?>" title="<?php echo $l->getString('template_blog_lookup_forum_messages'); ?>" rel="np" class="icon-posts link-first link-last"><?php echo $l->getString('template_forum_message'); ?></a>
<?php endif; ?>

													</div>
												</div>
											</div>
<?php if (!$post['blizzpost']) : ?>
											<a href="<?php echo $charUrl; ?>" class="context-link <?php if ($post['group_mask'] & ADMIN_GROUP_EXTRA_FORUM_COLOR) echo $post['group_style']; else echo 'wow-class-' . $post['class']; ?> " rel="np"><?php echo $post['name']; ?></a>
<?php else : ?>
											<a href="javascript:;" class="context-link" rel="np"><?php echo $post['name']; ?></a>
<?php endif; ?>

										</div>
<?php if (!$post['blizzpost']) : ?>

										<div>
											<div class="character-desc">
												<span class="wow-class-<?php echo $post['class']; ?>">
													<?php echo $l->extraFormat('template_charinfo_plate', array(
														'level' => $post['level'],
														'racename' => $l->getString('character_race_' . $post['race']),
														'classname' => $l->getString('character_class_' . $post['class'])
													));
													?>
													</span>
												<?php
												if ($post['group_title']) :
												?><div class="<?php if ($post['group_mask'] & ADMIN_GROUP_EXTRA_FORUM_COLOR) echo $post['group_style']; ?>"><?php echo $post['group_title']; ?></div>
												<?php endif; ?>
												
											</div>
	<?php if ($post['guildId'] > 0) : ?>
											<div class="guild">
												<a href="<?php echo $this->getWowUrl('guild/' . $post['realmName'] . '/' . $post['guildName'] . '/'); ?>"><?php echo $post['guildName']; ?></a>
											</div>
	<?php endif; ?>
										</div>
<?php else : ?>
										<div class="blizzard-title"><?php echo $post['group_title']; ?></div>
<?php endif; ?>

									</div>
								</div>
							</td>
							<td>
								<div class="post-edited">
									<?php if ($post['edit_date'] > 0) echo $l->format('template_forum_post_edited', $post['post_editor'], date('d.m.Y H:i', $post['edit_date'])); ?>
								</div>
						
								<div class="post-detail">
									<?php echo $post['message']; ?>
									<?php if (isset($post['signature'])) : ?>
									<br /><br />
									<div>_____________<br />
											<small><?php echo $post['signature']; ?></small>
									</div>
									<?php endif; ?>
								</div>
							</td>
							<td class="post-info">
								<div class="post-info-int">
									<div class="postData">
										<a href="#<?php echo $post['post_num']; ?>">
											#<?php echo $post['post_num']; ?>
										</a>
										<div class="date" data-tooltip="<?php echo date('d/m/Y H:i', $post['post_date']); ?>">
											<?php echo date('d/m/Y H:i', $post['post_date']); ?>
										</div>
									</div>
									<?php
									if ($post['blizzpost'])
									{
										++$lastBlizzPostIdx;
										if (isset($blizz_posts[$lastBlizzPostIdx]) && $blizz_posts[$lastBlizzPostIdx] > $post['post_num'])
										echo '<div class="blizzard_icon">
                                            <a class="nextBlizz" href="' . $this->getWowUrl('forum/topic/' . $post['thread_id'] . ($blizz_posts[$lastBlizzPostIdx]['page'] > 1 ? '?page=' . $blizz_posts[$lastBlizzPostIdx]['page'] : ''). '#' . $blizz_posts[$lastBlizzPostIdx]['anchor']) . '" data-tooltip="' . $l->getString('template_forum_jump_next_blizz') . '">
                                            </a>
                                        </div>';
									}
									?>
									<!--
									<div class="karma" id="k-<?php $post['post_id']; ?>">
										<div class="karma-feedback">
											<a href="?login" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>')">Login</a> to rate
										</div>
										<span class="clear"><!-- - -></span>
									</div> -->
								</div>
							</td>
						</tr>
					</table>
					<div class="post-options">
						<?php if ($this->c('AccountManager')->isAllowedToModerate()) : ?>
						<div class="mod-actions">
							<a title="Edit post" href="<?php echo $this->getWowUrl('forum/topic/post/' . $post['post_id'] . '/edit'); ?>" class="edit"><span></span></a>
							<a title="Delete post" href="javascript:;" class="delete" onclick="return Cms.Topic.deletePost(<?php echo $post['post_id']; ?>, '<?php echo $l->getString('template_forum_post_delete_confirm'); ?>');"><span></span></a>
							<?php if ($post['group_id'] == 0) : ?><a title="Ban user" href="<?php echo $this->getWowUrl('forum/ban/' . $post['account_id']); ?>" class="delete"><span></span></a><?php endif; ?>
							<?php if ($post['blizzpost']) : ?><a title="<?php echo ($post['tracker_post_id'] == $post['post_id'] ? 'Remove from ' : 'Add to ') . 'tracker'; ?>" href="<?php echo $this->getWowUrl('forum/topic/post/' . $post['post_id'] . '/' . ($post['tracker_post_id'] == $post['post_id'] ? 'un' : '') . 'track'); ?>" class="bookmark<?php if ($post['tracker_post_id'] == $post['post_id']) echo 'ed'; ?>"><span></span></a><?php endif; ?>
						</div>
						<?php endif; ?>
						<div class="respond">
							<?php if ($this->c('AccountManager')->user('id') == $post['account_id']) : ?>
							<a class="ui-button button2 " href="post/<?php echo $post['post_id']; ?>/edit"><span><span><?php echo $l->getString('template_forum_post_edit'); ?></span></span></a>
							<a class="ui-button button2 " href="javascript:;" onmouseover="Tooltip.show(this,'<?php echo $l->getString('template_forum_post_delete_tooltip'); ?>')" onclick="return Cms.Topic.deletePost(<?php echo $post['post_id']; ?>, '<?php echo $l->getString('template_forum_post_delete_confirm'); ?>');"><span><span><?php echo $l->getString('template_forum_post_delete'); ?></span></span></a>
							<?php endif; ?>
							<a class="ui-button button2 " href="#new-post"><span><span><?php echo $l->getString('template_blog_answer'); ?></span></span></a>
							<a class="ui-button button2 " href="#new-post" onclick="<?php echo (!$this->c('AccountManager')->isLoggedIn() ? 'javascript:;' : 'Cms.Topic.quote(' . $post['post_id'] . ');'); ?>" ><span><span><span class="icon-quote"><?php echo $l->getString('template_js_quote'); ?></span></span></span></a>
						</div>
						<span class="clear"><!-- --></span>
					</div>
					<?php endif; ?>
				</div>
			</div>
			
<?php ++$currentPostNum; endforeach; endif; ?>

<center>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Foro 728&#42;90) */
google_ad_slot = "7696919487";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>

		</div>
		<div class="forum-actions bottom">
			<div class="actions-panel">
				<?php echo $this->region('pagination'); ?>
				<ol class="ui-breadcrumb">
					<?php echo $this->c('Breadcrumb')->getCrumb(); ?>
				</ol>
				<span class="clear"><!-- --></span>
			</div>
		</div>
		<div class="talkback">
			<a id="new-post"></a>
			<?php if (!$this->c('AccountManager')->isLoggedIn()) : ?>
			<form method="post" onsubmit="return Cms.Topic.postValidate(this);" action="#new-post">
				<div>
					<input type="hidden" name="xstoken" value=""/>
					<input type="hidden" name="sessionPersist" value="forum.topic.post"/>
					<div class="post ">
						<table class="dynamic-center ">
							<tr>
								<td>
									<a class="ui-button button1 " href="?login" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>')"><span><span><?php echo $l->getString('template_forum_add_reply'); ?></span></span></a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</form>
			<?php elseif ($this->c('Forum')->isAllowedToAction('topic', BANNED_FLAG_ALLOW_POSTS)) : ?>
		<form method="post" onsubmit="return Cms.Topic.postValidate(this);" action="#new-post">
			<div>
				<input type="hidden" name="xstoken" value="52df612a-c1dc-4537-98c1-f053f739302e"/>
				<input type="hidden" name="sessionPersist" value="forum.topic.post"/>
				<div class="post general">
				<?php if ($flags & THREAD_FLAG_CLOSED && !$this->c('AccountManager')->isAllowedToModerate()) : ?>
				<table class="dynamic-center ">
					<tr>
						<td><?php echo $l->getString('template_forum_topic_closed'); ?></td>
					</tr>
				</table>
				<?php else : ?>
                    <div class="post-user-details ">
                        <h4><?php echo $l->getString('template_blog_answer'); ?></h4>
						<div class="post-user ajax-update">
							<?php echo $this->region('characters_list'); ?>
						</div>
                    </div>
					<div class="post-edit">
						<div id="post-errors">
						</div>
						 <div class="talkback-controls">
							<a href="javascript:;" onclick="Cms.Topic.previewToggle(this, 'preview')" class="preview-btn">
								<span class="arr"></span><span class="r"></span><span class="c"><?php echo $l->getString('template_forum_preview'); ?></span>
							</a>
							<a href="javascript:;" onclick="Cms.Topic.previewToggle(this, 'edit')" class="edit-btn selected">
								<span class="arr"></span><span class="r"></span><span class="c"><?php echo $l->getString('template_forum_edit'); ?></span>
							</a>
						</div>
						<div class="editor1" id="post-edit">
							<a id="editorMax" rel="10000"></a>
							<textarea id="detail" name="detail" class="post-editor" cols="78" rows="13"></textarea>
							<?php if ($this->c('AccountManager')->isAllowedToModerate()) : ?><input type="checkbox" value="1" name="bluepost" id="bluepost" checked="checked"> <label for="bluepost">Bluepost</label><?php endif; ?>
							<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/bml.js"></script>
							<script type="text/javascript">
							//<![CDATA[
								$(function() {
										Wow.addBmlCommands();
									BML.initialize('#post-edit', false);
								});
							//]]>
							</script>
						</div>
						<div class="post-detail" id="post-preview"></div>
						<div class="talkback-btm">
							<table class="dynamic-center ">
								<tr>
									<td>
										<?php if (!$this->c('AccountManager')->isAllowedToModerate() && $this->c('Session')->getSession('forumPostTimeCountdown') - time() > 0):  ?>
										
										<div id="postCountdown">Periodo de tiempo hasta la siguiente publicación: <span class="postTimeCountdown"><?php echo ($this->c('Session')->getSession('forumPostTimeCountdown') - time()); ?></span>
											<script type="text/javascript">
												//<![CDATA[
													$(function(){
														Cms.Topic.countDownInit('#postCountdown','#submitBtn');
													});
												//]]>
											</script>
										</div>
										<?php endif; ?>
										<div id="submitBtn">
											<button class="ui-button button1 " type="submit">
												<span><span><?php echo $l->getString('template_blog_send_report'); ?></span></span>
											</button>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<span class="clear"><!-- --></span>
				<?php endif; ?>
				</div>
			</div>
        </form>
		<?php endif; ?>
			<span class="clear"><!-- --></span>
			<div class="talkback-code">
				<div class="talkback-code-interior">
					<div class="talkback-icon">
						<?php echo $l->getString('template_forum_conduct'); ?>
						<br><br>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Foro 728&#42;90) */
google_ad_slot = "7696919487";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="report-post">
		<table id="report-table">
			<tr>
				<td class="report-desc"> </td>
				<td class="report-detail report-data"> Report Post #<span id="report-postID"></span> written by <span id="report-poster"></span> </td>
				<td class="post-info"></td>
			</tr>
			<tr>
				<td class="report-desc"><div>Reason</div></td>
				<td class="report-detail">
					<select id="report-reason">
						<option value="SPAMMING">Spamming</option>
						<option value="REAL_LIFE_THREATS">Real Life Threats</option>
						<option value="BAD_LINK">Bad Link</option>
						<option value="ILLEGAL">Illegal</option>
						<option value="ADVERTISING_STRADING">Advertising</option>
						<option value="HARASSMENT">Harassment</option>
						<option value="OTHER">Other</option>
						<option value="NOT_SPECIFIED">Not Specified</option>
						<option value="TROLLING">Trolling</option>
					</select>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="report-desc"><div>Explain <small>(256 characters max)</small></div></td>
				<td class="report-detail"><textarea id="report-detail" class="post-editor" cols="78" rows="13"></textarea></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" class="report-submit">
					<div>
						<a href="javascript:;" onclick="Cms.Topic.reportSubmit('')">Submit</a>
						 |
						<a href="javascript:;" onclick="Cms.Topic.reportCancel()">Cancel</a>
					</div>
				</td>
			</tr>
		</table>
		<div id="report-success" style="text-align:center">
			<h4>Reported!</h4>
			[<a href='javascript:;' onclick='$("#report-post").hide()'>Close</a>]
		</div>
	</div>