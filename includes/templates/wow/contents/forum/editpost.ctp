<?php if (!isset($topicEditing)) $topicEditing = false; ?>
<div id="forum-content">
    <div class="talkback new-post"><a id="new-post"></a>
        <form method="post" onsubmit="return Cms.Topic.postValidate(this);" action="<?php echo !$topicEditing ? '#new-post' : ''; ?>">
			<div>
				<input type="hidden" name="xstoken" value="a4412b16-c5ad-4009-b373-afc78e5c9bcd"/>
				<input type="hidden" name="sessionPersist" value="forum.topic.<?php echo $editing ? 'post.edit' : 'form'; ?>"/>
				<div class="post general">
					<div class="post-user-details ">
						<h4><?php echo $l->getString(($editing ? 'template_forum_edit' : 'template_forum_create_thread')); ?></h4>
						<div class="post-user ajax-update">
							<?php echo $this->region('characters_list'); ?>
						</div>
					</div>
					<div class="post-edit">
						<div id="post-errors">
						</div>
						<?php if (!$topicEditing) : ?>
						 <div class="talkback-controls">
							<a href="javascript:;" onclick="Cms.Topic.previewToggle(this, 'preview')" class="preview-btn">
								<span class="arr"></span><span class="r"></span><span class="c"><?php echo $l->getString('template_forum_preview'); ?></span>
							</a>
							<a href="javascript:;" onclick="Cms.Topic.previewToggle(this, 'edit')" class="edit-btn selected">
								<span class="arr"></span><span class="r"></span><span class="c"><?php echo $l->getString('template_forum_edit'); ?></span>
							</a>
						</div>
						<?php endif; ?>
						<div class="editor1" id="post-edit">
							<a id="editorMax" rel="10000"></a>
							<?php if (!$editing && !$topicEditing) echo '<input type="text" id="subject" name="subject" value="' . ($topicEditing ? $topic['title'] : '') . '" class="post-subject" maxlength="55"    />'; ?>
							<?php if (!$topicEditing) : ?><textarea id="detail" name="detail" class="post-editor" cols="78" rows="13"><?php if (isset($post['message'])) echo $post['message']; ?></textarea>
							<?php endif; if (!$editing && $this->c('AccountManager')->user('gmlevel') > 0): ?>
							<input type="checkbox" name="blizzard" id="blizzard" value="1" <?php if ((isset($topic, $topic['flags']) && $topic['flags'] & THREAD_FLAG_BLIZZARD) || !isset($topic)) echo ' checked="checked"'; ?> /><label for="blizzard">Blizzard Thread</label>
							<input type="checkbox" name="pinned" id="pinned" value="1" <?php if ((isset($topic, $topic['flags']) && $topic['flags'] & THREAD_FLAG_PINNED)) echo ' checked="checked"'; ?>/><label for="pinned">Pinned Thread</label>
							<input type="checkbox" name="featured" id="featured" value="1" <?php if ((isset($topic, $topic['flags']) && $topic['flags'] & THREAD_FLAG_FEATURED)) echo ' checked="checked"'; ?>/><label for="featured">Featured Thread</label>
							<input type="checkbox" name="closed" id="closed" value="1" <?php if ((isset($topic, $topic['flags']) && $topic['flags'] & THREAD_FLAG_CLOSED)) echo ' checked="checked"'; ?>/><label for="closed">Closed Thread</label>
							<?php endif; ?>
							<?php if ($topicEditing) : ?>
							<br />
							<label for="cat_id">Category</label>
							<select name="cat_id" id="cat_id">
								<?php foreach ($categories as $cat) : ?>
								<option value="<?php echo $cat['cat_id'] . '"'; if ($topic['cat_id'] == $cat['cat_id']) echo ' selected="selected"'; ?>><?php echo $cat['title']; ?></option>
								<?php endforeach; ?>
							</select>
							<?php else : ?>
							<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/bml.js"></script>
							<script type="text/javascript">
							//<![CDATA[
								$(function() {
										Wow.addBmlCommands();
									BML.initialize('#post-edit', false);
								});
							//]]>
							</script>
							<?php endif; ?>
						</div>
						<div class="post-detail" id="post-preview"></div>
						<div class="talkback-btm">
							<table class="dynamic-center ">
								<tr>
									<td>
										<div id="submitBtn">
											<button	class="ui-button button1 " type="submit">
												<span>
													<span><?php echo $l->getString('template_forum_submit'); ?></span>
												</span>
											</button>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
		<span class="clear"><!-- --></span>
				</div>
			</div>
        </form>
	<span class="clear"><!-- --></span>
        <div class="talkback-code">
			<div class="talkback-code-interior">
                <div class="talkback-icon">
                    <?php echo $l->getString('template_forum_conduct'); ?>
                </div>
			</div>
        </div>
    </div>
    </div>
