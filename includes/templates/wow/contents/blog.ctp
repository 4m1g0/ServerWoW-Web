<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:Blog-Bloque_Lateral_Derecho:Abajo', [300, 250], 'div-gpt-ad-1328835256314-0').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:Blog-Bloque_Lateral_Derecho:Arriba', [300, 250], 'div-gpt-ad-1328835256314-1').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:Blog-Centro', [468, 60], 'div-gpt-ad-1328835256314-2').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<script type="text/javascript">
        //<![CDATA[
		$(function(){ Cms.Blog.init(); })
        //]]>
		<?php if ($this->c('AccountManager')->isAllowedToModerate()) : ?>
		function deleteComment(id)
		{
			$.ajax({
				url: '<?php echo $this->getWowUrl('discussion/' . $item['id'] . '/api?method=deleteComment'); ?>',
				data: {comment_id: id},
				type: 'POST',
				success: function(data) {
					if (data.substr(0, 2) == 'ok')
					{
						$('#c-' + id).fadeOut();
						var ccount = parseInt($('#comments_count').text(), 10);
						ccount -= 1;
						if (ccount >= 0)
							$('#comments_count').text(ccount);
						else
							$('#comments_count').text('0');
					}
				}
			});
		}
		<?php endif; ?>
</script>
	<div id="blog-wrapper">
    <div id="left">
        <div id="blog-container">
  <div class="featured-news">
	  	<div class="featured-news-inner">
			<?php if ($this->issetRegion('featured')) echo $this->region('featured'); ?>
	        <span class="clear"></span>
        </div>
    </div>
	
	
            <div id="blog">
            	<div class="blog-inner">
						<h3 class="blog-title">
							<?php echo $item['title']; ?>
						</h3>
						<div class="byline">
							<div class="blog-info">
	                    	by <a href="javascript:;"><?php echo $item['author']; ?></a>
							<span></span> <?php echo date('d.m.Y H:i', $item['postdate']); ?>
							</div>
							<?php if ($item['allow_comments']): ?><a href="#comments" class="comments-link"><?php echo $item['comments_count']; ?></a><?php endif; ?>
							
	<span class="clear"><!-- --></span>
						</div>
							<div class="header-image"><img alt="<?php echo $item['title']; ?>" src="<?php echo CLIENT_FILES_PATH; ?>/cms/blog_header/<?php echo $item['header_image']; ?>" /></div>
							
<center>
<br>
<!-- ServerWoW:Blog-Centro -->
<div id='div-gpt-ad-1328835256314-2' style='width:468px; height:60px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328835256314-2'); });
</script>
</div>
</center>							

						<div class="detail"><?php echo $item['text']; ?>
<style type="text/css">
#blog .detail img {
-moz-border-radius:4px;
-webkit-border-radius:4px;
border-radius:4px;
-moz-box-shadow:0 0 20px #000000;
-webkit-box-shadow:0 0 20px #000000;
box-shadow:0 0 20px #000000;
border: 1px solid #372511;
max-width: 570px !important;
padding: 1px;
}
#blog .detail td:hover > a img, #blog .detail a img:hover {
border: 1px solid #CD9000;
}</style>
</div>

						<div class="keyword-list">
						<?php
						if ($item['tags']) :
						$tags = explode(',', $item['tags']);
						if ($tags && is_array($tags)) :?>
								<strong>Tags</strong>:
								<?php foreach ($tags as $tag) : ?>
										<a href="<?php echo $this->getWowUrl('search?k=' . urlencode(trim($tag)) . '&amp;f=article'); ?>"><?php echo trim($tag); ?></a> 
								<?php endforeach; endif; endif; ?>
						</div>

<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=201748293206869&xfbml=1"></script><fb:like send="true" width="438" show_faces="false" font="" data-colorscheme="dark"></fb:like>						
<a href="https://twitter.com/share" class="twitter-share-button" data-via="serverwow" data-lang="es" data-size="large" data-related="serverwow" data-hashtags="serverwow">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script><div align="right"><g:plusone></g:plusone></div>

				</div>
            </div>
			<?php if ($item['allow_comments']) : ?>
			<span id="comments"></span>
    <div id="page-comments">
    	<div class="page-comment-interior">
            <h3>
                <?php echo $l->getString('template_blog_comments'); ?>
            		(<span id="comments_count"><?php echo $item['comments_count']; ?></span>)
            </h3>

			<div class="comments-container">

	<script type="text/javascript">
		//<![CDATA[
			var textAreaFocused = false;
		//]]>
	</script>




    <form action="<?php echo $this->getWowUrl('discussion/' . $item['id'] . '/'); ?>" method="post" onsubmit="return Cms.Comments.validateComment(this);" id="comment-form-reply" class="nested">
    	<fieldset>
            <input type="hidden" id="replyTo" name="replyTo" value=""/>
            <input type="hidden" name="xstoken" value=""/>
            <input type="hidden" name="sessionPersist" value="discussion.comment"/>
        </fieldset>
		<?php if ($this->c('AccountManager')->isLoggedIn()) : ?>
		<div class="new-post">
            <div class="comment">
					<div class="portrait-c ajax-update">
						<div class="avatar-interior">
							<a href="<?php echo $this->c('AccountManager')->charInfo('url'); ?>">
								<img height="64" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/2d/avatar/<?php echo $this->c('AccountManager')->charInfo('race') . '-' . $this->c('AccountManager')->charInfo('gender'); ?>.jpg" alt="" />
							</a>
						</div>
					</div>

                    <div class="comment-interior">
                        <div class="character-info user ajax-update">
                        <!--commentThrottle[]-->

    <div class="user-name">
		<span class="char-name-code" style="display: none">
			<?php echo $this->c('AccountManager')->charInfo('name'); ?> 
		</span>



	<div id="context-2" class="ui-context character-select">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong><?php echo $this->c('AccountManager')->charInfo('name'); ?></strong>
						<br />
						<span class="realm up"><?php echo $this->c('AccountManager')->charInfo('realmName'); ?></span>
			</div>
		</div>
	</div>

        <a href="<?php echo $this->c('AccountManager')->charInfo('url'); ?>" class=" wow-class-5" rel="np">
        	<?php echo $this->c('AccountManager')->charInfo('name'); ?>
        </a>
    </div>

                        </div>
                        <div class="content">
                            <div class="comment-ta">
                                <textarea id="comment-ta-reply" cols="78" rows="3" name="detail" onfocus="textAreaFocused = true;" onblur="textAreaFocused = false;"></textarea>
                            </div>
                            <div class="action">
                            	<div class="cancel">
                                	<span class="spacer">|</span>
                                	<a href="javascript:;" onclick="$('#comment-form-reply').slideUp();"><?php echo $l->getString('template_blog_cancel_report'); ?></a>
                                </div>
                            	<div class="submit">
	<button class="ui-button button1 comment-submit " type="submit">
		<span>
			<span><?php echo $l->getString('template_blog_add_post_button'); ?>ss</span>
		</span>
	</button>
                                </div>
	<span class="clear"><!-- --></span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
		<?php else : ?>
        <div class="new-post loggedOut">
            <div class="comment">
	<table class="dynamic-center ">
		<tr>
			<td>
	<a class="ui-button button1 " href="?login" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>')">
		<span>
			<span><?php echo $l->getString('template_blog_add_post'); ?></span>
		</span>
	</a>


</td>
		</tr>
	</table>
            </div>
        </div>
		<?php endif; ?>
    </form>

	<script type="text/javascript">
		//<![CDATA[
			var textAreaFocused = false;
		//]]>
	</script>




    <form action="<?php echo $this->getWowUrl('discussion/' . $item['id'] . '/'); ?>" method="post" onsubmit="return Cms.Comments.validateComment(this);" id="comment-form">
    	<fieldset>
            <input type="hidden" name="xstoken" value=""/>
            <input type="hidden" name="sessionPersist" value="discussion.comment"/>
        </fieldset>
		<?php
		if ($this->c('AccountManager')->isLoggedIn() && $this->c('AccountManager')->charInfo('guid') > 0) : ?>
		<div class="new-post">
            <div class="comment">
					<div class="portrait-c ajax-update">
						<div class="avatar-interior">
							<a href="<?php echo $this->c('AccountManager')->charInfo('url'); ?>">
								<img height="64" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/2d/avatar/<?php echo $this->c('AccountManager')->charInfo('race') . '-' . $this->c('AccountManager')->charInfo('gender'); ?>.jpg" alt="" />
							</a>
						</div>
					</div>

                    <div class="comment-interior">
                        <div class="character-info user ajax-update">
                        <!--commentThrottle[]-->

    <div class="user-name">
		<span class="char-name-code" style="display: none">
			<?php echo $this->c('AccountManager')->charInfo('name'); ?> 
		</span>



	<div id="context-2" class="ui-context character-select">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong><?php echo $this->c('AccountManager')->charInfo('name'); ?></strong>
						<br />
						<span class="realm up"><?php echo $this->c('AccountManager')->charInfo('realmName'); ?></span>
			</div>
		</div>
	</div>

        <a href="<?php echo $this->c('AccountManager')->charInfo('url'); ?>" class=" wow-class-5" rel="np">
        	<?php echo $this->c('AccountManager')->charInfo('name'); ?>
        </a>
    </div>

                        </div>
                        <div class="content">
                            <div class="comment-ta">
                                <textarea id="comment-ta-reply" cols="78" rows="3" name="detail" onfocus="textAreaFocused = true;" onblur="textAreaFocused = false;"></textarea>
                            </div>
                            <div class="action">
                            	<div class="cancel">
                                	<span class="spacer">|</span>
                                	<a href="javascript:;" onclick="$('#comment-form-reply').slideUp();"><?php echo $l->getString('template_blog_cancel_report'); ?></a>
                                </div>
                            	<div class="submit">
								<?php if (!$this->c('AccountManager')->isAllowedToModerate() && $this->c('Session')->getSession('postTimeCountdown') - time() > 0):  ?>
								<div class="postCountdown">
									Periodo de tiempo hasta la siguiente publicación: <span class="postTimeCountdown"><?php echo ($this->c('Session')->getSession('postTimeCountdown') - time()); ?></span>
								</div>
								<script type="text/javascript">
								//<![CDATA[
									$(function(){
										Cms.Topic.countDownInit('.postCountdown','.comment-submit');
									});
								//]]>
								</script>
								<?php endif; ?>

							<button class="ui-button button1 comment-submit " type="submit">
								<span>
									<span><?php echo $l->getString('template_blog_add_post_button'); ?></span>
								</span>
							</button>
                                </div>
	<span class="clear"><!-- --></span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
		<?php else : ?>
        <div class="new-post loggedOut">
            <div class="comment">
	<table class="dynamic-center ">
		<tr>
			<td>
		

	<a class="ui-button button1 " href="?login" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>')">
		<span>
			<span><?php echo $l->getString('template_blog_add_post'); ?></span>
		</span>
	</a>


</td>
		</tr>
	</table>
            </div>
        </div>
		<?php endif; ?>
    </form>

	<?php
	if (isset($item['blog_comments']) && $item['blog_comments'] ) :
		$id = sizeof($item['blog_comments']) - 1;
		foreach ($item['blog_comments'] as $c) : ?>
	<div style="z-index: <?php echo $id; ?>;" class="comment<?php if ($c['blizzard']) echo ' blizzard'; elseif ($c['mvp']) echo ' mvp'; ?>" id="c-<?php echo $c['comment_id']; ?>">
		<div class="avatar portrait-b">
			<div class="avatar-interior">
				<a href="<?php echo $c['url']; ?>">
					<img height="64" src="/wow/static/images/2d/avatar/<?php echo $c['race']; ?>-<?php echo $c['gender']; ?>.jpg" alt="" />
				</a>
			</div>
		</div>

		<div class="comment-interior">
			<div class="character-info user">
				<?php if ($c['blizzard']) echo '<img src="/wow/static/images/layout/cms/icon_blizzard.gif" alt="" />'; ?>
				<div class="user-name">
					<span class="char-name-code" style="display: none"><?php echo $c['name']; ?></span>
					<a href="<?php echo $c['url']; ?>" class="wow-class-<?php echo $c['class']; ?>" rel="np"><?php echo $c['name']; ?></a>
				</div>

				<span class="time">
					<a href="#c-<?php echo $c['comment_id']; ?>"><?php echo date('d/m/Y H:i', $c['postdate']); ?></a>
				</span>
			</div>

			<div class="content">
				<?php echo $c['comment_text']; ?>
			</div>
			<?php
			if (($this->c('AccountManager')->isAllowedToModerate() && !$c['blizzard'] && (!$c['mvp'] || ($c['account'] == $this->c('AccountManager')->user('id')))) || ($this->c('AccountManager')->isAdmin())) : 
			?>
			<div class="comment-actions">
				<a href="javascript:;" onclick="deleteComment(<?php echo $c['comment_id']; ?>);">Delete Comment</a>
			</div>
			<?php else : ?>
			<span class="clear"><!-- --></span><br/>
			<?php endif; ?>
		</div>
	</div>
	<?php --$id; endforeach; endif; ?>

	<ul class="ui-pagination">
		<?php echo $pagination; ?>
	</ul>

	<span class="clear"><!-- --></span>
                    </div>
                </div>
			</div>
			<?php endif; ?>
            </div>
        </div>

		<div id="right">
			<div id="sidebar-promo" class="sidebar-module">
 

	<div class="bnet-offer">
		<!--  -->
				            		<div class="sidebar-title">
			            <h3 class="title-bnet-ads">PUBLICIDAD</h3>
		            </div>
		<div class="bnet-offer-bg">
<!-- ServerWoW:Blog-Bloque_Lateral_Derecho:Arriba -->
<div id='div-gpt-ad-1328835256314-1' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328835256314-1'); });
</script>
</div>
		</div>
	</div>
			</div>



	<div class="sidebar-module" id="sidebar-forums">
		<div class="sidebar-title">
			<h3 class="title-forums">Popular Topics</h3>
		</div>

		<div class="sidebar-content loading"></div>
	</div>
	
			<div id="sidebar-promo" class="sidebar-module">
 

	<div class="bnet-offer">
		<!--  -->
				            		<div class="sidebar-title">
			            <h3 class="title-bnet-ads">PUBLICIDAD</h3>
		            </div>
		<div class="bnet-offer-bg">
<!-- ServerWoW:Blog-Bloque_Lateral_Derecho:Abajo -->
<div id='div-gpt-ad-1328835256314-0' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328835256314-0'); });
</script>
</div>
		</div>
	</div>
			</div>
			
        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			App.sidebar(['forums']);
		});
        //]]>
        </script>
		</div>

	<span class="clear"><!-- --></span>
	</div>