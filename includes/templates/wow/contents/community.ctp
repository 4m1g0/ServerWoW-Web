<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:Comunidad-Bloque_Lateral_Derecho', [300, 250], 'div-gpt-ad-1328886177869-0').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:Comunidad-Centro', [468, 60], 'div-gpt-ad-1328886177869-1').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

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
				<center>
<!-- ServerWoW:Comunidad-Centro -->
<div id='div-gpt-ad-1328886177869-1' style='width:468px; height:60px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328886177869-1'); });
</script>
</div>
</center>
<br>
											<span class="title">Facebook</span>
				<div class="fb-like-box" data-href="http://www.facebook.com/ServerWoW" data-width="600" data-height="800" data-colorscheme="dark" data-show-faces="true" data-border-color="grey" data-stream="true" data-header="false"></div>
				<br>				<br>
										<div class="title-block">
							<span class="title">_______________________________________</span>
							<br>
						</div>
						<div class="content-block">
						<br><br>

				<center>
</center>
	<span class="clear"><!-- --></span>
					</div>	
				</div>
				
				<div class="outside-col">
				
			<div class="outside-section">
						<div class="title-block">
							<span class="title">Twitter</span>
	<span class="clear"><!-- --></span>
						</div>
						<div class="content-block">

							<script src="http://widgets.twimg.com/j/2/widget.js"></script>
					</div>
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
							
							
			<div class="outside-section">
						<div class="title-block">
							<span class="title">Google +</span>
	<span class="clear"><!-- --></span>
						</div>
						<div class="content-block">
<g:plus href="https://plus.google.com/117818722165936859038" size="badge"></g:plus>
					</div>
						</div>
				
					<div class="outside-section blizzard-community">
						<div class="title-block">
							<span class="title">PUBLICIDAD</span>
	<span class="clear"><!-- --></span>
						</div>
						<div class="content-block">
<!-- ServerWoW:Comunidad-Bloque_Lateral_Derecho -->
<div id='div-gpt-ad-1328886177869-0' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328886177869-0'); });
</script>
</div>
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