	<div class="top-banner">
	<?php echo $this->c('Document')->releaseJs('contents'); ?>
    <div id="slideshow" class="ui-slideshow">
        <div class="slideshow">

				<div class="slide" id="slide-0"
					style="background-image: url('http://eu.media2.battle.net/cms/carousel_header/XRXPB47F3QF91291995637312.jpg'); ">

				</div>

				<div class="slide" id="slide-1"
					style="background-image: url('http://eu.media4.battle.net/cms/carousel_header/B6VFIWW8R57O1295009861000.jpg'); display: none;">

				</div>

				<div class="slide" id="slide-2"
					style="background-image: url('http://eu.media5.battle.net/cms/carousel_header/YYA2582XN4VT1306756385531.jpg'); display: none;">

				</div>

				<div class="slide" id="slide-3"
					style="background-image: url('http://eu.media2.battle.net/cms/carousel_header/LJ9NRL6DTH091288953375465.jpg'); display: none;">

				</div>
		</div>

			<div class="paging">

					<a href="javascript:;" id="paging-0"
					    onclick="Slideshow.jump(0, this);"
						
						class="current">
							<span class="paging-title">Гаррош: Сердце Войны</span>
							<span class="paging-date">10/12/10</span>
					</a>

					<a href="javascript:;" id="paging-1"
					    onclick="Slideshow.jump(1, this);"
						
						>
							<span class="paging-title">Лидеры Альянса: Генн Седогрив</span>
							<span class="paging-date">24/01/11</span>
					</a>

					<a href="javascript:;" id="paging-2"
					    onclick="Slideshow.jump(2, this);"
						
						>
							<span class="paging-title">Руководство по обновлению 4.2</span>
							<span class="paging-date">27/06/11</span>
					</a>

					<a href="javascript:;" id="paging-3"
					    onclick="Slideshow.jump(3, this);"
						
						class=" last-slide">
							<span class="paging-title">Обновление галереи фан-арт</span>
							<span class="paging-date">10/12/10</span>
					</a>
			</div>

		<div class="caption">
			<h3><a href="#" class="link">Гаррош: Сердце Войны</a></h3>
			Первый рассказ в этой серии под названием Гаррош: Сердце Войны повествует о событиях, сделавших этого сурового лидера таким, каким мы его знаем сейчас
		</div>

		<div class="preview"></div>
		<div class="mask"></div>
    </div>

        <script type="text/javascript">
        //<![CDATA[
        $(function() {
            Slideshow.initialize('#slideshow', [
                {
					image: "http://eu.media2.battle.net/cms/carousel_header/XRXPB47F3QF91291995637312.jpg",
					desc: "Первый рассказ в этой серии под названием Гаррош: Сердце Войны повествует о событиях, сделавших этого сурового лидера таким, каким мы его знаем сейчас",
                    title: "Гаррош: Сердце Войны",
                    url: "http://eu.battle.net/wow/ru/blog/1173777#blog",
					id: "1320818"
                },
                {
					image: "http://eu.media4.battle.net/cms/carousel_header/B6VFIWW8R57O1295009861000.jpg",
					desc: "Узнайте о судьбе Генна Седогрива, короля Гилнеаса.",
                    title: "Лидеры Альянса: Генн Седогрив",
                    url: "http://eu.battle.net/wow/ru/blog/1706309#blog",
					id: "1706580"
                },
                {
					image: "http://eu.media5.battle.net/cms/carousel_header/YYA2582XN4VT1306756385531.jpg",
					desc: "«Ярость огня»",
                    title: "Руководство по обновлению 4.2",
                    url: "http://eu.battle.net/wow/ru/blog/2513297#blog",
					id: "2535282"
                },
                {
					image: "http://eu.media2.battle.net/cms/carousel_header/LJ9NRL6DTH091288953375465.jpg",
					desc: "Галерея фан-арт пополнилась 8 новыми работами по миру Warcraft.",
                    title: "Обновление галереи фан-арт",
                    url: "http://us.blizzard.com/en-us/community/fanart/index.html",
					id: "1320819"
                }
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
<div class="inside-section contests">
	<a href="http://eu.blizzard.com/ru-ru/community/contests/" target="_blank" class="main-link" style="background-image:url('<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/community/thumbnails/thumb-contests.jpg');">
		<span>
			<span class="wrapper">
				<span class="banner-title">Конкурсы </span>
				<span class="banner-desc">Узнайте о прошедших конкурсах и участвуйте в новых!</span>
			</span>
		</span>
	</a>
</div>
<div class="inside-section forum">
	<a href="../forum/" class="main-link" style="background-image:url('<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/community/thumbnails/thumb-forum.jpg');">
		<span>
			<span class="wrapper">
				<span class="banner-title">Форумы </span>
				<span class="banner-desc">Общайтесь с другими игроками на официальных форумах.</span>
			</span>
		</span>
	</a>
</div>
						
	<span class="clear"><!-- --></span>
<div class="inside-section fanart">
	<a href="http://eu.blizzard.com/ru-ru/community/fanart/" target="_blank" class="main-link" style="background-image:url('<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/community/thumbnails/thumb-fanart.jpg');">
		<span class="panel">
			<span class="wrapper">
				<span class="banner-title">Фан-арт </span>
				<span class="view-all">Все композиции</span>
			</span>
		</span>
	</a>
		<a href="http://eu.blizzard.com/ru-ru/community/fanart/rules.html" class="tosubmit external">Отправить работу</a>
</div>
<div class="inside-section comics">
	<a href="../media/comics/" class="main-link" style="background-image:url('<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/community/thumbnails/thumb-comics.jpg');">
		<span class="panel">
			<span class="wrapper">
				<span class="banner-title">Комиксы <em>(365)</em></span>
				<span class="view-all">Все комиксы</span>
			</span>
		</span>
	</a>
		<a href="http://eu.blizzard.com/ru-ru/community/contests/comic/rules.html" class="tosubmit external">Отправить комикс</a>
</div>
	<span class="clear"><!-- --></span>
<div class="inside-section screenshot">
	<a href="../media/screenshots/" class="main-link" style="background-image:url('<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/community/thumbnails/thumb-screenshot.jpg');">
		<span class="panel">
			<span class="wrapper">
				<span class="banner-title">Скриншоты <em>(3 518)</em></span>
				<span class="view-all">Все скриншоты</span>
			</span>
		</span>
	</a>
		<a href="http://eu.blizzard.com/ru-ru/community/screenshots/index.html" class="tosubmit external">Отправить скриншот</a>
</div>
<div class="inside-section wallpaper">
	<a href="../media/wallpapers/fan-art" class="main-link" style="background-image:url('<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/community/thumbnails/thumb-wallpaper.jpg');">
		<span class="panel">
			<span class="wrapper">
				<span class="banner-title">Обои от поклонников <em>(25)</em></span>
				<span class="view-all">Все обои</span>
			</span>
		</span>
	</a>
		<a href="http://eu.blizzard.com/ru-ru/community/fanart/rules.html" class="tosubmit external">Отправить обои</a>
</div>
	<span class="clear"><!-- --></span>
					</div>	
				</div>
				
				<div class="outside-col">
										
					<div class="outside-section social-media">
						<div class="title-block">
							<span class="title">Социальные сети</span>
	<span class="clear"><!-- --></span>
						</div>
						<div class="content-block">
							<ul>
								<li><a href="http://www.facebook.com/WarcraftRU" class="facebook" target="_blank"><span class="content-title">World of Warcraft на Facebook</span><span class="content-desc">Присоединитесь к сообществу игроков World of Warcraft на Facebook, и вы будете каждый день узнавать что-то новое.   								</span></a></li>
								<li><a href="http://twitter.com/warcraft_RU" class="twitter" target="_blank"><span class="content-title">World of Warcraft на Twitter</span><span class="content-desc">Следите за новостями World of Warcraft на Twitter.</span></a></li>
								<li><a href="http://www.youtube.com/user/WorldofWarcraftRU" class="youtube" target="_blank"><span class="content-title">World of Warcraft на Youtube</span><span class="content-desc">Заставки, игровые и рекламные видеоролики на нашем официальном канале.</span></a></li>
							</ul>
						</div>
					</div>
					
					<div class="outside-section blizzard-community">
						<div class="title-block">
							<span class="title">Сообщество Blizzard</span>
	<span class="clear"><!-- --></span>
						</div>
						<div class="content-block">
							<ul>
								<li><a href="http://eu.blizzard.com/ru-ru/community/insider/" class="blizzard-insider" target="_blank"><span class="content-title">Blizzard Insider</span><span class="content-desc">Вам нравятся наши идеи? Подпишитесь на нашу рассылку!</span></a></li>
								<li><a href="http://eu.blizzard.com/ru-ru/community/blizzcast/" class="blizzcast" target="_blank"><span class="content-title">Blizzcast</span><span class="content-desc">Официальный аудиовыпуск новостей Blizzard: интервью с разработчиками, ответы на вопросы пользователей и многое другое.</span></a></li>
							</ul>
						</div>
					</div>
				</div>
	<span class="clear"><!-- --></span>
			</div>		
		</div>	
	</div>
			
	<span class="clear"><!-- --></span>
