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
            <span class="topic"><?php echo $l->getString('template_forum_topic'); ?></span>
			<span class="sub-title"><?php echo $forum->getTopicTitle(); ?></span>
        </div>

    <div class="forum-actions top">
		<div class="actions-panel">
			<a class="ui-button button1 " href="#new-post" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>');">
				<span>
					<span><?php echo $l->getString('template_blog_add_post'); ?></span>
				</span>
			</a>
			<span class="clear"><!-- --></span>
        </div>
    </div>
        <div id="thread">
				
                <?php
				$posts = $forum->getTopicPosts();
				if ($posts) :
					foreach ($posts as &$post) :
						$charUrl = $this->getWowUrl('character/' . $post['realmName'] . '/' . $post['name']);
				?>
				<div id="post-<?php echo $post['post_id']; ?>" class="post ">
					<span id="<?php echo $post['post_num']; ?>"></span>
                	<div class="post-interior">
                            <table><tr><td class="post-character">

	<div class="post-user">

            <div class="avatar">
                <div class="avatar-interior">
                    <a href="<?php echo $charUrl; ?>"><img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/2d/avatar/<?php echo $post['race'] . '-' . $post['gender']; ?>.jpg" alt="" width="64" /></a>
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
					<strong><?php echo $post['name']; ?></strong><br />
					<span><?php echo $post['realmName']; ?></span>
				</div>

				<div class="context-links">
						<a href="<?php echo $charUrl; ?>" title="Profile" rel="np" class="icon-profile link-first"><?php echo $l->getString('template_profile_caption'); ?></a>
						<a href="<?php echo $this->getWowUrl('search?f=post&amp;a=' . urlencode($post['name'] . '@' . $post['realmName']) . '&amp;sort=time'); ?>" title="<?php echo $l->getString('template_blog_lookup_forum_messages'); ?>" rel="np" class="icon-posts"> </a>
						<a href="javascript:;" title="<?php echo $l->getString('template_blog_add_to_black_list'); ?>" rel="np" class="icon-ignore link-last" onclick="Cms.ignore(<?php echo $post['guid']; ?>, false); return false;"> </a>
				</div>
			</div>
		</div>
			<a href="<?php echo $charUrl; ?>" class="context-link wow-class-<?php echo $post['class']; ?>" rel="np">
				<?php echo $post['name']; ?>
			</a>
		</div>
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
							</div>

								<?php if ($post['guildId'] > 0) : ?>
								<div class="guild">
									<a href="<?php echo $this->getWowUrl('guild/' . $post['realmName'] . '/' . $post['guildName'] . '/'); ?>"><?php echo $post['guildName']; ?></a>
								</div>
								<?php endif; ?>

								<div class="achievements">7465</div>

					</div>

		</div>
	</div>
							</td><td>
                                <div class="post-edited">
                                </div>
                                
                                <div class="post-detail">
                                    <?php echo $post['message']; ?>
                                </div>
                            </td><td class="post-info">
                                <div class="post-info-int">
                                    <div class="postData">
										
										<a href="#<?php echo $post['post_num']; ?>">
											#<?php echo $post['post_num']; ?>
										</a>
                                        
										<div class="date" data-tooltip="<?php echo date('d/m/Y H:i', $post['post_date']); ?>">
                                        	<?php echo date('d/m/Y H:i', $post['post_date']); ?>
                                        </div>
										
                                    </div>

    <div class="karma" id="k-<?php $post['post_id']; ?>">
        	<div class="karma-feedback">
                <a href="?login" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>')">Login</a> to rate
            </div>
	<span class="clear"><!-- --></span>
    </div>

                                </div>
                            </td></tr>
                            </table>
                            <div class="post-options">
                                    <div class="respond">

	<a class="ui-button button2 " href="#new-post"><span><span>Reply</span></span></a>
	<a class="ui-button button2 " href="#new-post" onclick="javascript:;" ><span><span><span class="icon-quote">Quote</span></span></span></a>

                                    </div>
	<span class="clear"><!-- --></span>
                            </div>

                	</div>
                </div>

			<?php endforeach; endif; ?>
				
        </div>
		
		

    <div class="forum-actions bottom">
		<div class="actions-panel">


		<ol class="ui-breadcrumb">
				<li>
						<a href="/wow/en/" rel="np">
                    	World of Warcraft
                    </a>
				</li>


				<li>
						<a href="/wow/en/forum/" rel="np">
                    	Forums
                    </a>
				</li>


				<li>
						<a href="/wow/en/forum/#forum874934" rel="np">
                    	Support
                    </a>
				</li>


				<li>
						<a href="/wow/en/forum/975485/" rel="np">
                    	Customer Support
                    </a>
				</li>


				<li class="last">
						<a href="/wow/en/forum/topic/2624977631" rel="np">
                    	a complaint
                    </a>
				</li>

		</ol>
	<span class="clear"><!-- --></span>
        </div>

    </div>


    <div class="talkback"><a id="new-post"></a>
        <form method="post" onsubmit="return Cms.Topic.postValidate(this);" action="#new-post">
			<div>
        	<input type="hidden" name="xstoken" value=""/>
        	<input type="hidden" name="sessionPersist" value="forum.topic.post"/>
            <div class="post ">
	<table class="dynamic-center ">
		<tr>
			<td>
		

	<a class="ui-button button1 " href="?login" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>')">
		<span>
			<span><?php echo $l->getString('template_forum_add_reply'); ?></span>
		</span>
	</a>
</td>
		</tr>
	</table>
            </div>
			</div>
        </form>
	<span class="clear"><!-- --></span>
        <div class="talkback-code">
			<div class="talkback-code-interior">
                <div class="talkback-icon">
                    <h4 class="code-header">Please report any Code of Conduct violations, including:</h4>
                    <p>Threats of violence. <strong>We take these seriously and will alert the proper authorities.</strong></p>
                    <p>Posts containing personal information about other players. <strong>This includes physical addresses, e-mail addresses, phone numbers, and inappropriate photos and/or videos.</strong></p>
                    <p>Harassing or discriminatory language. <strong>This will not be tolerated.</strong></p>
                    	<p>Click <a href="http://battle.net/community/conduct">here</a> to view the Forums Code of Conduct.</p>
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
                    <td></td>
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
                        </div></td>
                </tr>
            </table>
            <div id="report-success" style="text-align:center">
            	<h4>Reported!</h4>
            	[<a href='javascript:;' onclick='$("#report-post").hide()'>Close</a>]
            </div>
    </div>