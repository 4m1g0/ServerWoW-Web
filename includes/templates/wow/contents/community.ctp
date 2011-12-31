	<div class="top-banner">
	<?php echo $this->c('Document')->releaseJs('contents'); ?>

    <div id="slideshow" class="ui-slideshow">
        <div class="slideshow">
		<?php
		$blogs = $this->c('Community')->getBlogEntries();
		if ($blogs) :
			$id = 0;
				foreach ($blogs as $b) :
		?>

				<div class="slide" id="slide-<?php echo $id; ?>" style="<?php if ($id > 0) echo ' display: none;'; ?>background-image: url('<?php echo CLIENT_FILES_PATH; ?>/cms/carousel_header/<?php echo $b['carouselImage']; ?>');" >

				</div>
				<?php ++$id; endforeach; endif; ?>
		</div>
		
			<div class="paging">

				<?php
				if ($blogs) :
					$id = 0;
						foreach ($blogs as $b) : ?>
					<a href="javascript:;" id="paging-<?php echo $id; ?>"
					   onclick="Slideshow.jump(<?php echo $id; ?>, this);"
						
						<?php if ($id == 0) echo 'class="current"'; ?>>
							<span class="paging-title"><?php echo $b['title']; ?></span>
							<span class="paging-date"><?php echo date('d/m/Y', $b['postdate']); ?></span>
					</a>
				<?php ++$id; endforeach; endif; ?>
			</div>

		<div class="caption">
			<?php if ($blogs) : ?><h3><a href="#" class="link"><?php echo $blogs[0]['title']; ?></a></h3>
			<?php echo $blogs[0]['carouselDesc']; endif; ?>
		</div>

		<div class="preview"></div>
		<div class="mask"></div>
    </div>
	
        <script type="text/javascript">
        //<![CDATA[
        $(function() {
            Slideshow.initialize('#slideshow', [
			<?php if ($blogs) : foreach ($blogs as $b ) : ?>
                {
					image: "<?php echo CLIENT_FILES_PATH; ?>/cms/carousel_header/<?php echo $b['carouselImage']; ?>",
					desc: "<?php echo $b['carouselDesc']; ?>",
                    title: "<?php echo $b['title']; ?>",
                    url: "<?php echo $this->getWowUrl('blog/' . $b['id']); ?>#blog",
					id: "<?php echo $this->getWowUrl('blog/' . $b['id']); ?>"
                },
			<?php endforeach; endif; ?>
            ]);

        });
        //]]>
        </script>
	</div>
	
	<div class="community-content-body">
		<div class="body-wrapper">
			<div class="content-wrapper">
				<div class="inside-col">
				<br>
				<center><script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Comunidad 468&#42;60) */
google_ad_slot = "7125709149";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center><br>
											<span class="title">Facebook</span>
				<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fserverwow&amp;width=600&amp;colorscheme=dark&amp;show_faces=true&amp;border_color=black&amp;stream=true&amp;header=false&amp;height=300" scrolling="yes" frameborder="0" style="border:none; overflow:hidden; width:600px; height:300px;" allowTransparency="true"></iframe>
				<br>				<br>
										<div class="title-block">
							<span class="title">_______________________________________</span>
							<br>
						</div>
						<div class="content-block">
						<br><br>
						<? /* ?>
							<script src="http://widgets.twimg.com/j/2/widget.js"></script>
							<span class="title">Twitter</span>
			<script>
			new TWTR.Widget({
			version: 2,
			type: 'list',
			rpp: 10,
			interval: 6000,
			width: 600,
			height: 150,
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
			<? */ ?>

<center><script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Comunidad 468&#42;60) */
google_ad_slot = "7125709149";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></center>
	<span class="clear"><!-- --></span>
					</div>	
				</div>
				
				<div class="outside-col">
				
					<div class="outside-section blizzard-community">
						<div class="title-block">
							<span class="title">PUBLICIDAD</span>
	<span class="clear"><!-- --></span>
						</div>
						<div class="content-block">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5286168753620257";
/* ServerWoW.com (Comunidad 300&#42;250) */
google_ad_slot = "5936098316";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
						</div>
					</div>
										
					<div class="outside-section social-media">
						<div class="title-block">
							<span class="title">Redes sociales</span>
	<span class="clear"><!-- --></span>
						</div>
						<div class="content-block">
							<ul>
								<li><a href="http://www.facebook.com/ServerWoW" class="facebook" target="_blank"><span class="content-title">World of Warcraft en Facebook</span><span class="content-desc">Hazte amigo de World of Warcraft en Facebook para consultar todas las noticias y vídeos.</span></a></li>
								<li><a href="https://twitter.com/ServerWoW" class="twitter" target="_blank"><span class="content-title">World of Warcraft en Twitter</span><span class="content-desc">No te pierdas ninguna novedad de World of Warcraft en Twitter.</span></a></li>
								<!--<li><a href="http://www.youtube.com/user/WorldofWarcraftES" class="youtube" target="_blank"><span class="content-title">World of Warcraft en Youtube</span><span class="content-desc">Disfruta con nuestros vídeos, tráilers, cinemáticas y mucho más en nuestro canal oficial.</span></a></li>-->
							</ul>
						</div>
					</div>
					
					
				</div>
				
	<span class="clear"><!-- --></span>
			</div>		
		</div>	
	</div>
			
	<span class="clear"><!-- --></span>