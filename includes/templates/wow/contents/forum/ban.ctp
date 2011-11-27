<div id="forum-content">
    <div class="talkback new-post">
        <form method="post" onsubmit="return Cms.Topic.postValidate(this);" action="">
			<div>
				<input type="hidden" name="xstoken" value="a4412b16-c5ad-4009-b373-afc78e5c9bcd"/>
				<input type="hidden" name="sessionPersist" value="forum.topic.form"/>
				<div class="post general">
					<div class="post-user-details ">
						<h4>Ban User</h4>
					</div>
					<div class="post-edit">
						<div id="post-errors">
						</div>
						<div class="editor1" id="post-edit">
							<h1><?php
							$user = $this->c('Forum')->getBan();
							echo $user['username'];
							?></h1>
							<label>Unban day:</label>
							<select name="ban[day]">
								<?php
								for ($i = 1; $i < 32; ++$i)
									echo '<option value="' . $i . '"' . (date('d') == $i ? ' selected="selected"' : '') . '>' . $i . '</option>'; 
								?>
							</select>
							<label>Unban month:</label>
							<select name="ban[month]">
								<?php
								for ($i = 1; $i < 13; ++$i)
									echo '<option value="' . $i . '"' . (date('m')+1 == $i ? ' selected="selected"' : '') . '>' . $i . '</option>'; 
								?>
							</select>
							<label>Unban year:</label>
							<input type="text" name="ban[year]" value="<?php echo date('Y'); ?>" />
							<br />
							
							<label for="postsd">Delete user posts</label>
							<input type="checkbox" id="postsd" name="ban[posts]" value="1" />
							<br />
							<br />
							<label>Ban Reason</label>
							<input type="text" name="ban[reason]" value="Forum Ban" />
						</div>
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
