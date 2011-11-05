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
					<div class="official-content">
<div class="inside-section forum">
	<a href="../forum/" class="main-link" style="background-image:url('<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/community/thumbnails/thumb-forum.jpg');">
		<span>
			<span class="wrapper">
				<span class="banner-title">Foros </span>
				<span class="banner-desc">Estate en contacto con otros jugadores de Blizzard a través de los foros oficiales de World of Warcraft.</span>
			</span>
		</span>
	</a>
</div>
						
<div class="inside-section screenshot">
	<a href="../media/screenshots/" class="main-link" style="background-image:url('<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/community/thumbnails/thumb-screenshot.jpg');">
		<span class="panel">
			<span class="wrapper">
				<span class="banner-title">Capturas de pantalla <em>(4.042)</em></span>
				<span class="view-all">Mostrar todo</span>
			</span>
		</span>
	</a>
</div>


	<span class="clear"><!-- --></span>
					</div>	
				</div>
				
				<div class="outside-col">
										
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
					
					<div class="outside-section blizzard-community">
						<div class="title-block">
							<span class="title">Concursos de la Comunidad de Blizzard</span>
	<span class="clear"><!-- --></span>
						</div>
						<div class="content-block">
							<ul>
								<li><a href="http://eu.blizzard.com/es-es/community/insider/" class="blizzard-insider" target="_blank"><span class="content-title">Blizzard Insider</span><span class="content-desc">¿Te intrigan nuestras ideas y deseas suscribirte a nuestro boletín de noticias? Esta es tu oportunidad.</span></a></li>
								<li><a href="http://eu.blizzard.com/es-es/community/blizzcast/" class="blizzcast" target="_blank"><span class="content-title">Blizzcast</span><span class="content-desc">El podcast oficial de Blizzard podcast: entrevistas con los programadores, rondas de preguntas y respuestas y mucho más.</span></a></li>
							</ul>
						</div>
					</div>
				</div>
	<span class="clear"><!-- --></span>
			</div>		
		</div>	
	</div>
			
	<span class="clear"><!-- --></span>