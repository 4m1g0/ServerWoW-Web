<script type="text/javascript">
        //<![CDATA[
		$(function(){ Cms.Blog.init(); })
        //]]>
        </script>
	<div id="blog-wrapper">
    <div id="left">
        <div id="blog-container">
  <div class="featured-news">
	  	<div class="featured-news-inner">




	        <div class="featured">
	            <a href="/blizzcon/en/blog/2758736#blog">
	               <span class="featured-img" style="background-image: url('http://eu.media2.battle.net/cms/blog_thumbnail/5E0TPR82FE5S1311943473783.jpg');"><span class="featured-img-frame"></span></span>
	               <span class="featured-desc"> 2011 European Battle.net Invitational: Day Two Round-Up</span>
	            </a>
	        </div>




	        <div class="featured">
	            <a href="/wow/en/blog/2595375#blog">
	               <span class="featured-img" style="background-image: url('http://eu.media5.battle.net/cms/blog_thumbnail/3ASY9WFAIF531293443430148.jpg');"><span class="featured-img-frame"></span></span>
	               <span class="featured-desc"> New Player Tips – Death Becomes You</span>
	            </a>
	        </div>




	        <div class="featured">
	            <a href="/wow/en/blog/2545150#blog">
	               <span class="featured-img" style="background-image: url('http://eu.media2.battle.net/cms/blog_thumbnail/W0A8FMN4RTGW1290608599461.jpg');"><span class="featured-img-frame"></span></span>
	               <span class="featured-desc"> Patch 4.2 Hotfixes—Last update: 16 August</span>
	            </a>
	        </div>




	        <div class="featured">
	            <a href="/wow/en/blog/2513297#blog">
	               <span class="featured-img" style="background-image: url('http://eu.media3.battle.net/cms/blog_thumbnail/YIFIJUOHPPHN1308827158805.jpg');"><span class="featured-img-frame"></span></span>
	               <span class="featured-desc"> Patch 4.2: Rage of the Firelands Now Live </span>
	            </a>
	        </div>

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
	                    	by <a href="<?php echo $l->getLocale(); ?>/<?php echo $this->getWowUrl('search?a=' . urlencode($item['author']) . '&amp;q=' . urlencode($item['author']) . '&amp;f=article'); ?>"><?php echo $item['author']; ?></a>
							<span></span> <?php echo date('d.m.Y H:i', $item['postdate']); ?>
							</div>
							<a class="comments-link" href="#comments">1</a>
	<span class="clear"><!-- --></span>
						</div>
							<div class="header-image"><img alt="<?php echo $item['title']; ?>" src="<?php echo CLIENT_FILES_PATH; ?>/cms/blog_header/<?php echo $item['header_image']; ?>" /></div>

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
				</div>
            </div>




        <script type="text/javascript">
        //<![CDATA[

		$(function(){
			Cms.Comments.commentInit();
		});
        //]]>
        </script>
	<!--[if IE 6]>
        <script type="text/javascript">
        //<![CDATA[
		$(function() {
			Cms.Comments.commentInitIe();
		});
        //]]>
        </script>
	<![endif]-->

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
                            <a href="javascript:;" onclick="Cms.Topic.reportSubmit('comments')">Submit</a>
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
    <span id="comments"></span>
    <div id="page-comments">
    	<div class="page-comment-interior">
            <h3>
                Comments
            		(1)
            </h3>

			<div class="comments-container">

	<script type="text/javascript">
		//<![CDATA[
			var textAreaFocused = false;
		//]]>
	</script>




    <form action="/wow/en/discussion/eu.en_gb.blog.2849848/comment?sig=7eae01c8b108d56b7e649d95369b7e68&amp;d_ref=%2Fwow%2Fen%2Fblog%2F2849848" method="post" onsubmit="return Cms.Comments.validateComment(this);" id="comment-form-reply" class="nested">
    	<fieldset>
            <input type="hidden" id="replyTo" name="replyTo" value=""/>
            <input type="hidden" name="xstoken" value=""/>
            <input type="hidden" name="sessionPersist" value="discussion.comment"/>
        </fieldset>
        <div class="new-post loggedOut">
            <div class="comment">
	<table class="dynamic-center ">
		<tr>
			<td>
		

	<a
		class="ui-button button1 "
			href="?login"
		
		
		
		onclick="return Login.open('https://eu.battle.net/login/login.frag')"
		
		
		>
		<span>
			<span>Add a reply</span>
		</span>
	</a>


</td>
		</tr>
	</table>
            </div>
        </div>
    </form>

	<script type="text/javascript">
		//<![CDATA[
			var textAreaFocused = false;
		//]]>
	</script>




    <form action="/wow/en/discussion/eu.en_gb.blog.2849848/comment?sig=7eae01c8b108d56b7e649d95369b7e68&amp;d_ref=%2Fwow%2Fen%2Fblog%2F2849848" method="post" onsubmit="return Cms.Comments.validateComment(this);" id="comment-form">
    	<fieldset>
            
            <input type="hidden" name="xstoken" value=""/>
            <input type="hidden" name="sessionPersist" value="discussion.comment"/>
        </fieldset>
        <div class="new-post loggedOut">
            <div class="comment">
	<table class="dynamic-center ">
		<tr>
			<td>
		

	<a
		class="ui-button button1 "
			href="?login"
		
		
		
		onclick="return Login.open('https://eu.battle.net/login/login.frag')"
		
		
		>
		<span>
			<span>Add a reply</span>
		</span>
	</a>


</td>
		</tr>
	</table>
            </div>
        </div>
    </form>



							<div style="z-index: 1;" class="comment" id="c-2590769137">

								<div class="avatar portrait-b">

										<a href="/wow/en/character/spinebreaker/Jos%C3%A9e/">
											<img height="64" src="http://eu.battle.net/static-render/eu/spinebreaker/182/74539190-avatar.jpg?alt=/wow/static/images/2d/avatar/3-0.jpg" alt="" />
										</a>

								</div>

    <div class="karma" id="k-2590769137">
        	<div class="karma-feedback">
                <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">Login</a> to rate
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Josée 
		</span>



	<div id="context-1" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Josée</strong>
						<br />
						<span>Spinebreaker</span>
			</div>








			<div class="context-links">
					<a href="/wow/en/character/spinebreaker/Jos%C3%A9e/" title="Profile" rel="np"
					   class="icon-profile link-first"
					   >
						Profile
					</a>
					<a href="/wow/en/search?f=post&amp;a=Jos%C3%A9e%40Spinebreaker&amp;sort=time" title="View posts" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Ignore" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(19851029, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/en/character/spinebreaker/Jos%C3%A9e/" class="context-link color-c7" rel="np">
        	Josée
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2590769137">8 minutes ago</a>
										
									</span>

                                </div>

                                <div class="content">
                                    ooh the street art is nice :)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2590769137" onclick="Cms.Comments.replyTo('2590769137','1314216842092','Josée'); return false;">Reply</a>
                                </div>
                            </div>
                        </div>






                <div class="page-nav-container">
                    <div class="page-nav-int">





                    </div>
                </div>
			</div>
        </div>
    </div>
                </div>
        </div>

		<div id="right">
			<div id="sidebar-promo" class="sidebar-module">
 






	<div class="bnet-offer">
		<!--  -->
		<div class="bnet-offer-bg">
				<a href="https://eu.battle.net/account/creation/wow/signup/" target="_blank" id="ad2555187" class="bnet-offer-image" onclick="BnetAds.trackEvent('2555187', 'Trial-EU', 'wow', true);">
				<img src="http://eu.media1.battle.net/cms/ad_300x250/278A4B1NC79Q1309451833883.jpg" width="300" height="250" alt=""/>
			</a>
		</div>
		<script type="text/javascript">
			//<![CDATA[
				if(typeof (BnetAds.addEvent) != "undefined" )
					BnetAds.addEvent(window, 'load', function(){ BnetAds.trackEvent('2555187', 'Trial-EU', 'wow'); } );
				else
					BnetAds.trackEvent('2555187', 'Trial-EU', 'wow');
			//]]>
		</script>
	</div>
			</div>

        <div class="sidebar-module" id="sidebar-related">
			<div class="sidebar-title">
				<h3 class="title-article"> Related Articles </h3>
			</div>

			<div class="sidebar-content">
               <div class="featured-news">
                        <div id="related-news">
        <script type="text/javascript">
        //<![CDATA[
								$(function(){Cms.Blog.getRelated('2849848');});
        //]]>
        </script>
                        </div>
            	</div>
	<span class="clear"><!-- --></span>
        	</div>
       	</div>

        <div class="sidebar-module" id="sidebar-recent">
                <div class="sidebar-title">
                    <h3 class="title-recent"> Recent Articles </h3>
                </div>
			<div class="sidebar-content">
				<div class="featured-news">
                        <div class="featured">
                            <a href="/wow/en/blog/2849848">
                            	<span class="featured-desc"> Recap of Blizzard Entertainment at gamescom 2011</span>
                               <span class="date">24/08/2011 19:34 UTC</span>
                            </a>
                        </div>
                        <div class="featured">
                            <a href="/wow/en/blog/2846591">
                            	<span class="featured-desc"> Stay Awhile and Listen</span>
                               <span class="date">24/08/2011 11:16 UTC</span>
                            </a>
                        </div>
                        <div class="featured">
                            <a href="/wow/en/blog/2845821">
                            	<span class="featured-desc"> New J!NX Line Debuts this Fall </span>
                               <span class="date">24/08/2011 08:56 UTC</span>
                            </a>
                        </div>
                        <div class="featured">
                            <a href="/wow/en/blog/2843182">
                            	<span class="featured-desc"> Community News</span>
                               <span class="date">23/08/2011 18:19 UTC</span>
                            </a>
                        </div>
                        <div class="featured">
                            <a href="/wow/en/blog/2829268">
                            	<span class="featured-desc"> New Warcraft Fan Art</span>
                               <span class="date">22/08/2011 13:35 UTC</span>
                            </a>
                        </div>
                        <div class="featured">
                            <a href="/wow/en/blog/2822902">
                            	<span class="featured-desc"> Community News</span>
                               <span class="date">19/08/2011 12:37 UTC</span>
                            </a>
                        </div>

                </div>
            </div>

	<span class="clear"><!-- --></span>
		</div>



	<div class="sidebar-module" id="sidebar-forums">
		<div class="sidebar-title">
			<h3 class="title-forums">Popular Topics</h3>
		</div>

		<div class="sidebar-content loading"></div>
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