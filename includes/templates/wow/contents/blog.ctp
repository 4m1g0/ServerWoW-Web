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
            </div>
        </div>

		<div id="right">
			<div id="sidebar-promo" class="sidebar-module">
 

	<div class="bnet-offer">
		<!--  -->
		<div class="bnet-offer-bg">
				<a href="<?php echo $this->getCoreUrl('account/creation/wow/signup/'); ?>" target="_blank" id="ad2555187" class="bnet-offer-image" onclick="BnetAds.trackEvent('2555187', 'Trial-EU', 'wow', true);">
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