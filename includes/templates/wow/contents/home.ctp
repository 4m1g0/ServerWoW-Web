    <div id="homepage">
        <div id="left">
		<?php echo $this->c('Document')->releaseJs('home_content'); ?>

	<?php if ($this->issetRegion('carousel')) echo $this->region('carousel'); ?>

			<div class="homepage-news-wrapper">
  <div class="featured-news">
	  	<div class="featured-news-inner">
			<?php if ($this->issetRegion('featured')) echo $this->region('featured'); ?>

	        <span class="clear"></span>
        </div>
    </div>

<center><script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Home 468&#42;60) */
google_ad_slot = "2668940216";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center>

		        <div id="news-updates">
		        	<div id="news-updates-inner">
    <?php if ($this->issetRegion('news')) echo $this->region('news'); ?>
	<div class="blog-paging">
	
<center><script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Home 468&#42;60) */
google_ad_slot = "2668940216";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center>	
	<?php
	if ($this->core->getDataVar('nextPage') > 0) :
	?>
	<a class="ui-button button1 button1-next float-right " href="?page=<?php echo $this->core->getDataVar('nextPage'); ?>">
		<span>
			<span>Next</span>
		</span>
	</a>
	<?php
	endif;
	if (isset($_GET['page']) && intval($_GET['page']) > 1) : ?>
	<a class="ui-button button1 button1-previous" href="?page=1">
		<span>
			<span>Prev.</span>
		</span>
	</a>
	<?php endif; ?>


	<span class="clear"><!-- --></span>
						</div>
					</div>
		        </div>
            </div>
        </div>

		<div id="right" class="ajax-update">
			<div id="sidebar-promo" class="sidebar-module">
 






	<div class="bnet-offer">
		<!--  -->
		            		<div class="sidebar-title">
			            <h3 class="title-bnet-ads">PUBLICIDAD</h3>
		            </div>		
		<div class="bnet-offer-bg">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW 300&#42;250 */
google_ad_slot = "5710665508";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
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



	<div class="sidebar-module" id="sidebar-sotd">
		<div class="sidebar-title">
			<h3 class="title-sotd">Screenshot of the Day</h3>
		</div>

		<div class="sidebar-content loading"></div>
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
			App.sidebar(['sotd','forums']);
		});
        //]]>
        </script>
		</div>

	<span class="clear"><!-- --></span>
    </div>