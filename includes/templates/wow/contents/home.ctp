<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:Inicio-Bloque_Lateral_Derecho:Abajo', [300, 250], 'div-gpt-ad-1328831789868-0').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:Inicio-Bloque_Lateral_Derecho:Arriba', [300, 250], 'div-gpt-ad-1328831789868-1').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:Inicio-Centro', [468, 60], 'div-gpt-ad-1328833969661-2').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

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

<center>
<!-- ServerWoW:Inicio-Centro -->
<div id='div-gpt-ad-1328833969661-2' style='width:468px; height:60px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328833969661-2'); });
</script>
</div>
</center>

		        <div id="news-updates">
		        	<div id="news-updates-inner">
    <?php if ($this->issetRegion('news')) echo $this->region('news'); ?>
	<div class="blog-paging">
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
<!-- ServerWoW:Inicio-Bloque_Lateral_Derecho:Arriba -->
<div id='div-gpt-ad-1328831789868-1' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328831789868-1'); });
</script>
</div>
		</div>
	</div>
	</div>

	<div id="sidebar-promo" class="sidebar-module">
	<div class="bnet-offer">
		<!--  -->
		            		<div class="sidebar-title">
			            <h3 class="title-bnet-ads">Twitter</h3>
		            </div>		
		<div class="bnet-offer-bg">
							<script src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script>
			new TWTR.Widget({
			version: 2,
			type: 'list',
			rpp: 10,
			interval: 6000,
			width: 300,
			height: 200,
			theme: {
	    		shell: {
			      background: 'transparent',
	    		  color: '#7c7c85'
		    		},
	    		tweets: {
		    	  background: 'transparent',
    			  color: '#575757',
			      links: '#2897e0'
		    }
			},
			features: {
			    scrollbar: true,
		    	loop: false,
			    live: false,
			    hashtags: true,
			    timestamp: true,
			    avatars: true,
			    behavior: 'all'
			  }
			}).render().setList('n4ch3', 'lcv').start();
			</script>
		</div>
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

	<div id="sidebar-promo" class="sidebar-module">
	<div class="bnet-offer">
		<!--  -->
		            		<div class="sidebar-title">
			            <h3 class="title-bnet-ads">PUBLICIDAD</h3>
		            </div>		
		<div class="bnet-offer-bg">
<!-- ServerWoW:Inicio-Bloque_Lateral_Derecho:Abajo -->
<div id='div-gpt-ad-1328831789868-0' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328831789868-0'); });
</script>
</div>
		</div>
	</div>
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