<?php if (!isset($gameData) || !$gameData) return; ?>
			<div id="content-subheader">
				<a class="race-parent" href="./"><?php echo $l->getString('template_game_races_title'); ?></a>
	<span class="clear"><!-- --></span>
				<h4><?php echo $gameData['name']; ?></h4>
			</div>	<span class="clear"><!-- --></span>

			<div class="faction-req">
				<span class="group <?php echo $gameData['faction']; ?>"><?php echo $gameData['faction_title']; ?></span>
				<?php if ($gameData['expansion'] > EXPANSION_CLASSIC) :?>
					<span class="req <?php echo $gameData['req_exp']; ?>"><?php echo $gameData['req_exp_str']; ?></span>
				<?php endif; ?>
			</div>
	<span class="clear"><!-- --></span>

	<div class="left-col">
		<div class="story-highlight"><?php echo $gameData['story']; ?></div>
		<div class="story-main"><?php echo $gameData['info']; ?></div>

		<?php if ($gameData['location']) : ?>
		<div class="race-basic start-location" style="background-image:url(<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/start-location.jpg)">
			<h5 class="basic-header"><span class="overview-icon"></span><?php echo $l->getString('template_game_race_location'); ?><span><?php echo $gameData['location']; ?></span></h5>
			<div class="basic-story"><?php echo $gameData['location_info']; ?></div>
		<?php
		endif;
		if ($gameData['homecity']) :
		?>

		<div class="race-basic home-city" style="background-image:url(<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/home.jpg)">
			<h5 class="basic-header"><span class="overview-icon"></span><?php echo $l->getString(($gameData['id'] == RACE_WORGEN ? 'template_game_race_homecity_location' : 'template_game_race_homecity')); ?><span><?php echo $gameData['homecity']; ?></span></h5>
			<div class="basic-story"><?php echo $gameData['homecity_info']; ?></div>

		<?php endif; ?>

		<div class="race-basic racial-mount" style="background-image:url(<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/mount.jpg)">
			<h5 class="basic-header"><span class="overview-icon"></span><?php echo $l->getString('template_game_race_mount'); ?><span><?php echo $gameData['mount']; ?></span></h5>
			<div class="basic-story"><?php echo $gameData['mount_info']; ?></div>

		<div class="race-basic leader" style="background-image:url(<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/leader.jpg)">
			<h5 class="basic-header"><span class="overview-icon"></span><?php echo $l->getString('template_game_race_leader'); ?><span><?php echo $gameData['leader']; ?></span></h5>
			<div class="basic-story"><?php echo $gameData['leader_info']; ?></div>
		</div>
	<span class="clear"><!-- --></span>
		</div>
	<?php if ($gameData['homecity']) : ?>
		</div>
	<span class="clear"><!-- --></span>
	<?php endif; if ($gameData['location']) : ?>
		</div>
	<span class="clear"><!-- --></span>
	<?php endif; ?>
	</div>

	<div class="right-col">
	<div class="game-scrollbox">
		<div class="scroll-title"><span><?php echo $l->format('template_game_race_racial_traits', $gameData['name']); ?></span></div>
		<div class="scroll-content">
			<div class="wrapper">
					<div class="feature-list">
						<?php
						$icons_server = $this->c('Config')->getValue('site.icons_server');
						foreach ($gameData['abilities'] as &$ability) : ?>
							<div class="feature-item clear-after">
								<span class="icon-frame-gloss float-left" style="background-image: url(<?php echo $icons_server; ?>/56/<?php echo $ability['icon']; ?>)">
									<span class="frame"></span>
								</span>
								<div class="feature-wrapper">
									<span class="feature-item-title"><?php echo $ability['title']; ?></span>
									<p class="feature-item-desc"><?php echo $ability['text']; ?></p>
								</div>
	<span class="clear"><!-- --></span>
							</div>
						<?php endforeach; ?>
					</div>
			</div>
		</div>
	</div>

	<div class="available-info-box ">
		<div class="available-info-box-title"><?php echo $l->getString('template_game_race_classes'); ?></div>
		<span class="available-info-box-desc"><?php echo $l->format('template_game_race_classes_desc', $l->getString('character_race_' . $gameData['id'] . '_decl')) ?></span>
		<div class="list-box">
			<div class="wrapper">
					<ul>
						<?php foreach ($gameData['classes'] as &$class) : ?>
							<li>
								<a href="../class/<?php echo $class['key']; ?>">
									<span class="icon-frame frame-36 class-icon-36 class-icon-36-<?php echo $class['key']; ?>">
										<span class="frame"></span>
									</span>
									<span class="list-title"><?php echo $class['name']; ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
	<span class="clear"><!-- --></span>
	<span class="clear"><!-- --></span>
			</div>
		</div>
	</div>


	<table class="media-frame">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
					<a href="<?php echo $this->getWowUrl('media/artwork/wow-races?view=&amp;keywords=' . $gameData['key']); ?>"><img src="<?php CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/thumb-artwork.jpg" alt="<?php echo $l->getString('template_game_class_artwork'); ?>" title="<?php echo $l->getString('template_game_class_artwork'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="<?php echo $this->getWowUrl('media/artwork/wow-races?view=&amp;keywords=' . $gameData['key']); ?>" class="view-all"><?php echo $l->getString('template_game_class_viewall'); ?></a>
						<?php echo $l->getString('template_game_class_artwork'); ?>
	<span class="clear"><!-- --></span>
					</div>
			</td>
			<td class="mr"></td>
		</tr>
		<tr>
			<td class="bl"></td>
			<td class="bm"></td>
			<td class="br"></td>
		</tr>
	</table>

	<table class="media-frame">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
					<a href="<?php echo $this->getWowUrl('media/screenshots/races?view=&amp;keywords=' . $gameData['key']); ?>"><img src="<?php CLIENT_FILES_PATH; ?>/wow/static/images/game/race/<?php echo $gameData['key']; ?>/thumb-screenshot.jpg" alt="<?php echo $l->getString('template_game_class_screenshots'); ?>" title="<?php echo $l->getString('template_game_class_screenshots'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="<?php echo $this->getWowUrl('media/screenshots/races?view=&amp;keywords=' . $gameData['key']); ?>" class="view-all"><?php echo $l->getString('template_game_class_viewall'); ?></a>
						<?php echo $l->getString('template_game_class_screenshots'); ?>
	<span class="clear"><!-- --></span>
					</div>
			</td>
			<td class="mr"></td>
		</tr>
		<tr>
			<td class="bl"></td>
			<td class="bm"></td>
			<td class="br"></td>
		</tr>
	</table>
				
				<div class="fansite-link-box">
					<div class="wrapper">
						<span class="fansite-box-title"><?php echo $l->getString('template_game_class_more'); ?></span>
						<p><?php echo $l->getString('template_game_race_more_desc'); ?></p>
						<div id="sdgksdngklsdngl35"></div>
        <script type="text/javascript">
        //<![CDATA[
							$(document).ready(function() {
								Fansite.generate($('#sdgksdngklsdngl35'), "race|<?php echo $gameData['id'] . '|' . str_replace('-', '_', $gameData['key']); ?>");
							});
        //]]>
        </script>
					</div>
				</div>
			</div>
	<span class="clear"><!-- --></span>

	<div class="guide-page-nav">
		<span class="current-guide-title"><?php echo $gameData['name']; ?></span>

		<a class="ui-button next-race button1-next " href="<?php echo $gameData['next-race-lnk']; ?>">
			<span>
				<span><?php echo $l->format('template_game_race_next', $gameData['next-race']); ?></span>
			</span>
		</a>

		<a class="ui-button previous-race button1-previous " href="<?php echo $gameData['prev-race-lnk']; ?>">
			<span>
				<span><?php echo $l->format('template_game_race_prev', $gameData['prev-race']); ?></span>
			</span>
		</a>
	</div>
	<div class="comment-section">



        <script type="text/javascript">
        //<![CDATA[
					Core.loadDeferred('<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/css/cms/comments.css');
					Core.loadDeferred('<?php echo CLIENT_FILES_PATH; ?>/wow/static/css/cms.css');
					Core.loadDeferred('<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/js/cms.js');

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
                    <td class="report-detail report-data"> Сообщить модераторам о сообщении #<span id="report-postID"></span> игрока <span id="report-poster"></span> </td>
                    <td class="post-info"></td>
                </tr>
                <tr>
                    <td class="report-desc"><div>Причина</div></td>
                    <td class="report-detail">
                    	<select id="report-reason">
                                	<option value="SPAMMING">Спам</option>
                                	<option value="REAL_LIFE_THREATS">Угрозы в реальной жизни</option>
                                	<option value="BAD_LINK">«Битая» ссылка</option>
                                	<option value="ILLEGAL">Противозаконно</option>
                                	<option value="ADVERTISING_STRADING">Реклама</option>
                                	<option value="HARASSMENT">Оскорбления</option>
                                	<option value="OTHER">Иное</option>
                                	<option value="NOT_SPECIFIED">Не указано</option>
                                	<option value="TROLLING">Троллинг</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="report-desc"><div>Объяснение <small>(не более 256 символов)</small></div></td>
                    <td class="report-detail"><textarea id="report-detail" class="post-editor" cols="78" rows="13"></textarea></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" class="report-submit">
                    	<div>
                            <a href="javascript:;" onclick="Cms.Topic.reportSubmit('comments')">Отправить</a>
                             |
                            <a href="javascript:;" onclick="Cms.Topic.reportCancel()">Отмена</a>
                        </div></td>
                </tr>
            </table>
            <div id="report-success" style="text-align:center">
            	<h4>Готово!</h4>
            	[<a href='javascript:;' onclick='$("#report-post").hide()'>Закрыть</a>]
            </div>
    </div>
    <span id="comments"></span>
    <div id="page-comments">
    	<div class="page-comment-interior">
            <h3>
                Комментарии
            		(424)
            </h3>

			<div class="comments-container">

	<script type="text/javascript">
		//<![CDATA[
			var textAreaFocused = false;
		//]]>
	</script>




    <form action="/wow/ru/discussion/eu.ru_ru.wow.race.blood_elf/comment?sig=a146ee23797da3b0a967e433e1d8de0a&amp;d_ref=%2Fwow%2Fru%2Fgame%2Frace%2Fblood-elf" method="post" onsubmit="return Cms.Comments.validateComment(this);" id="comment-form-reply" class="nested">
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
		

	<a class="ui-button button1 " href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">
		<span>
			<span>Разместить ответ</span>
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




    <form action="/wow/ru/discussion/eu.ru_ru.wow.race.blood_elf/comment?sig=a146ee23797da3b0a967e433e1d8de0a&amp;d_ref=%2Fwow%2Fru%2Fgame%2Frace%2Fblood-elf" method="post" onsubmit="return Cms.Comments.validateComment(this);" id="comment-form">
    	<fieldset>
            
            <input type="hidden" name="xstoken" value=""/>
            <input type="hidden" name="sessionPersist" value="discussion.comment"/>
        </fieldset>
        <div class="new-post loggedOut">
            <div class="comment">
	<table class="dynamic-center ">
		<tr>
			<td>
		

	<a class="ui-button button1 " href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">
		<span>
			<span>Разместить ответ</span>
		</span>
	</a>


</td>
		</tr>
	</table>
            </div>
        </div>
    </form>



							<div style="z-index: 40;" class="comment" id="c-2680049210">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/седогрив/%D0%90%D1%81%D0%B8%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/седогрив/143/53516431-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2680049210">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Асис 
		</span>



	<div id="context-1" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Асис</strong>
						<br />
						<span>Седогрив</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/седогрив/%D0%90%D1%81%D0%B8%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D1%81%D0%B8%D1%81%40%D0%A1%D0%B5%D0%B4%D0%BE%D0%B3%D1%80%D0%B8%D0%B2&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(21944501, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/седогрив/%D0%90%D1%81%D0%B8%D1%81/" class="context-link wow-class-6" rel="np">
        	Асис
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2680049210">1 дн. 9 ч назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Боже мой, че так кипятиться и обсерать БЭ? Расса кулл, красива и могущественна. История впечатляет, что еще надо??? А к вопросу о гомиках - зайдите в АО за эльфов, все сомнения что БЭ-гетеросексуалы сразу отпадут
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2680049210" onclick="Cms.Comments.replyTo('2680049210','1316057595255','Асис'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 39;" class="comment" id="c-2679859218">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/седогрив/%D0%90%D1%81%D0%B8%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/седогрив/143/53516431-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2679859218">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Асис 
		</span>



	<div id="context-2" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Асис</strong>
						<br />
						<span>Седогрив</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/седогрив/%D0%90%D1%81%D0%B8%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D1%81%D0%B8%D1%81%40%D0%A1%D0%B5%D0%B4%D0%BE%D0%B3%D1%80%D0%B8%D0%B2&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(21944501, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/седогрив/%D0%90%D1%81%D0%B8%D1%81/" class="context-link wow-class-6" rel="np">
        	Асис
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2679859218">1 дн. 9 ч назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Асис: Да и к тому же, посмотрите на Лортемара Терона - ну чем не Мужик?))
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2679859218" onclick="Cms.Comments.replyTo('2679859218','1316057595255','Асис'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 38;" class="comment" id="c-2679859763">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/галакронд/122/53328762-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2679859763">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Айскилл 
		</span>



	<div id="context-3" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Айскилл</strong>
						<br />
						<span>Галакронд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB%40%D0%93%D0%B0%D0%BB%D0%B0%D0%BA%D1%80%D0%BE%D0%BD%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(17995222, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" class="context-link wow-class-6" rel="np">
        	Айскилл
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2679859763">23 ч 23 мин назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Асис: тоесть отпадут в какую сторону?
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2679859763" onclick="Cms.Comments.replyTo('2679859763','1316057595255','Айскилл'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 37;" class="comment" id="c-2624969565">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%9E%D0%BE%D1%83%D0%B2%D0%BD%D0%B8%D0%BD%D0%B3/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/139/57168267-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624969565">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Ооувнинг 
		</span>



	<div id="context-4" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Ооувнинг</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%9E%D0%BE%D1%83%D0%B2%D0%BD%D0%B8%D0%BD%D0%B3/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9E%D0%BE%D1%83%D0%B2%D0%BD%D0%B8%D0%BD%D0%B3%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(9125441, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%9E%D0%BE%D1%83%D0%B2%D0%BD%D0%B8%D0%BD%D0%B3/" class="context-link wow-class-6" rel="np">
        	Ооувнинг
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624969565">4 дн. 17 ч назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Ну у них довольно хитрожопый взгляд и хоть они по телосложению с топора никого не убьют, зато поднасрать магией могут неслабо. И да девочки там хорошие, я согласен иметь мускулатуру третьеклассника и быть один в один как они, если бы мне давали такие курочки)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624969565" onclick="Cms.Comments.replyTo('2624969565','1315770546703','Ооувнинг'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 36;" class="comment" id="c-2624808886">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/голдринн/%D0%9B%D0%B0%D0%B3%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/голдринн/95/61398879-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624808886">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Лагл 
		</span>



	<div id="context-5" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Лагл</strong>
						<br />
						<span>Голдринн</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/голдринн/%D0%9B%D0%B0%D0%B3%D0%BB/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9B%D0%B0%D0%B3%D0%BB%40%D0%93%D0%BE%D0%BB%D0%B4%D1%80%D0%B8%D0%BD%D0%BD&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(18184545, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/голдринн/%D0%9B%D0%B0%D0%B3%D0%BB/" class="context-link wow-class-6" rel="np">
        	Лагл
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624808886">6 дн., 1 ч назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    да кул раса! че вы насрали тут всякого<br/>
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624808886" onclick="Cms.Comments.replyTo('2624808886','1315655582835','Лагл'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 35;" class="comment" id="c-2624808823">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/253/67359741-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624808823">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Араггорн 
		</span>



	<div id="context-6" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Араггорн</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(23854888, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/" class="context-link wow-class-6" rel="np">
        	Араггорн
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624808823">6 дн. 2 ч назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Blad elfi luchshie v orde krome taurenov i eto ne kurica psina ti takih kak ti oborotnei serebrom rezali psina takaya
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624808823" onclick="Cms.Comments.replyTo('2624808823','1315651896084','Араггорн'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 34;" class="comment" id="c-2624967148">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/галакронд/122/53328762-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624967148">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Айскилл 
		</span>



	<div id="context-7" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Айскилл</strong>
						<br />
						<span>Галакронд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB%40%D0%93%D0%B0%D0%BB%D0%B0%D0%BA%D1%80%D0%BE%D0%BD%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(17995222, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" class="context-link wow-class-6" rel="np">
        	Айскилл
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624967148">08/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    даже тролли такие как блекметал. светобычок и тервис ничего против этой расы не имели
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624967148" onclick="Cms.Comments.replyTo('2624967148','1315507840804','Айскилл'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 33;" class="comment" id="c-2625017341">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ткач-смерти/%D0%9A%D0%B0%D0%BB%D0%B5%D0%B4%D1%80%D0%B0/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ткач-смерти/223/55513567-avatar.jpg?alt=/wow/static/images/2d/avatar/10-1.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625017341">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Каледра 
		</span>



	<div id="context-8" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Каледра</strong>
						<br />
						<span>Ткач Смерти</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ткач-смерти/%D0%9A%D0%B0%D0%BB%D0%B5%D0%B4%D1%80%D0%B0/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9A%D0%B0%D0%BB%D0%B5%D0%B4%D1%80%D0%B0%40%D0%A2%D0%BA%D0%B0%D1%87%20%D0%A1%D0%BC%D0%B5%D1%80%D1%82%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(9623184, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ткач-смерти/%D0%9A%D0%B0%D0%BB%D0%B5%D0%B4%D1%80%D0%B0/" class="context-link wow-class-4" rel="np">
        	Каледра
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625017341">08/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Айскилл: А они с нами в одной фракции, я думаю им незачем на своих матерится.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625017341" onclick="Cms.Comments.replyTo('2625017341','1315507840804','Каледра'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 32;" class="comment" id="c-2625017095">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/корольлич/%D0%9F%D0%BB%D0%B0%D1%81%D1%82%D1%83%D1%81%D1%8F/">
												<img height="64" src="http://eu.battle.net/static-render/eu/корольлич/47/63706415-avatar.jpg?alt=/wow/static/images/2d/avatar/22-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625017095">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Пластуся 
		</span>



	<div id="context-9" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Пластуся</strong>
						<br />
						<span>Король-лич</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/корольлич/%D0%9F%D0%BB%D0%B0%D1%81%D1%82%D1%83%D1%81%D1%8F/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9F%D0%BB%D0%B0%D1%81%D1%82%D1%83%D1%81%D1%8F%40%D0%9A%D0%BE%D1%80%D0%BE%D0%BB%D1%8C-%D0%BB%D0%B8%D1%87&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(15150903, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/корольлич/%D0%9F%D0%BB%D0%B0%D1%81%D1%82%D1%83%D1%81%D1%8F/" class="context-link wow-class-1" rel="np">
        	Пластуся
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625017095">08/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    а ваша курица яйцо не снесъот
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625017095" onclick="Cms.Comments.replyTo('2625017095','1315489279805','Пластуся'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 31;" class="comment" id="c-2624806814">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/азурегос/%D0%90%D1%80%D0%BE%D0%B3%D0%BD%D0%BE%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/азурегос/154/65562522-avatar.jpg?alt=/wow/static/images/2d/avatar/22-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624806814">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Арогнор 
		</span>



	<div id="context-10" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Арогнор</strong>
						<br />
						<span>Азурегос</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/азурегос/%D0%90%D1%80%D0%BE%D0%B3%D0%BD%D0%BE%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D1%80%D0%BE%D0%B3%D0%BD%D0%BE%D1%80%40%D0%90%D0%B7%D1%83%D1%80%D0%B5%D0%B3%D0%BE%D1%81&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(23827491, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/азурегос/%D0%90%D1%80%D0%BE%D0%B3%D0%BD%D0%BE%D1%80/" class="context-link wow-class-1" rel="np">
        	Арогнор
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624806814">07/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    маунт отстой! на курицах разежать.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624806814" onclick="Cms.Comments.replyTo('2624806814','1315412237964','Арогнор'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 30;" class="comment" id="c-2624807165">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/подземье/155/41491611-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624807165">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Эдикс 
		</span>



	<div id="context-11" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Эдикс</strong>
						<br />
						<span>Подземье</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%AD%D0%B4%D0%B8%D0%BA%D1%81%40%D0%9F%D0%BE%D0%B4%D0%B7%D0%B5%D0%BC%D1%8C%D0%B5&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(175859, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/" class="context-link wow-class-8" rel="np">
        	Эдикс
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624807165">08/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Арогнор: Кто бы говорил. Так и хочется дать пинка бегущему воргену в пятую точку=)<br/>Наши крылобеги очень изящные и преданные животные и подходят нам идеально.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624807165" onclick="Cms.Comments.replyTo('2624807165','1315412237964','Эдикс'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 29;" class="comment" id="c-2625017093">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/корольлич/%D0%9F%D0%BB%D0%B0%D1%81%D1%82%D1%83%D1%81%D1%8F/">
												<img height="64" src="http://eu.battle.net/static-render/eu/корольлич/47/63706415-avatar.jpg?alt=/wow/static/images/2d/avatar/22-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625017093">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Пластуся 
		</span>



	<div id="context-12" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Пластуся</strong>
						<br />
						<span>Король-лич</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/корольлич/%D0%9F%D0%BB%D0%B0%D1%81%D1%82%D1%83%D1%81%D1%8F/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9F%D0%BB%D0%B0%D1%81%D1%82%D1%83%D1%81%D1%8F%40%D0%9A%D0%BE%D1%80%D0%BE%D0%BB%D1%8C-%D0%BB%D0%B8%D1%87&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(15150903, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/корольлич/%D0%9F%D0%BB%D0%B0%D1%81%D1%82%D1%83%D1%81%D1%8F/" class="context-link wow-class-1" rel="np">
        	Пластуся
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625017093">08/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Эдикс: за то ми можем на коне...
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625017093" onclick="Cms.Comments.replyTo('2625017093','1315412237964','Пластуся'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 28;" class="comment" id="c-2624967150">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/галакронд/122/53328762-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624967150">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Айскилл 
		</span>



	<div id="context-13" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Айскилл</strong>
						<br />
						<span>Галакронд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB%40%D0%93%D0%B0%D0%BB%D0%B0%D0%BA%D1%80%D0%BE%D0%BD%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(17995222, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" class="context-link wow-class-6" rel="np">
        	Айскилл
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624967150">08/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Пластуся: я открою тебе страшную тайну: мы можем на трицикле. конесмерти. кодо, на ящере и волке
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624967150" onclick="Cms.Comments.replyTo('2624967150','1315412237964','Айскилл'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 27;" class="comment" id="c-2625017433">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/седогрив/%D0%A0%D0%B5%D0%BA%D1%83%D0%B0%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/седогрив/111/38563951-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625017433">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Рекуар 
		</span>



	<div id="context-14" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Рекуар</strong>
						<br />
						<span>Седогрив</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/седогрив/%D0%A0%D0%B5%D0%BA%D1%83%D0%B0%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A0%D0%B5%D0%BA%D1%83%D0%B0%D1%80%40%D0%A1%D0%B5%D0%B4%D0%BE%D0%B3%D1%80%D0%B8%D0%B2&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(2747911, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/седогрив/%D0%A0%D0%B5%D0%BA%D1%83%D0%B0%D1%80/" class="context-link wow-class-3" rel="np">
        	Рекуар
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625017433">09/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Айскилл: Он имел ввиду ,недавно добавленных "расовых" лошадей для воргенов)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625017433" onclick="Cms.Comments.replyTo('2625017433','1315412237964','Рекуар'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 26;" class="comment" id="c-2625018100">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/галакронд/122/53328762-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625018100">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Айскилл 
		</span>



	<div id="context-15" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Айскилл</strong>
						<br />
						<span>Галакронд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB%40%D0%93%D0%B0%D0%BB%D0%B0%D0%BA%D1%80%D0%BE%D0%BD%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(17995222, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" class="context-link wow-class-6" rel="np">
        	Айскилл
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625018100">6 дн. 19 ч назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Рекуар: спс кеп
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625018100" onclick="Cms.Comments.replyTo('2625018100','1315412237964','Айскилл'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 25;" class="comment" id="c-2624968830">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ревущии-фьорд/%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ревущии-фьорд/231/54705127-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624968830">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Септимусс 
		</span>



	<div id="context-16" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Септимусс</strong>
						<br />
						<span>Ревущий фьорд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ревущии-фьорд/%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81%40%D0%A0%D0%B5%D0%B2%D1%83%D1%89%D0%B8%D0%B9%20%D1%84%D1%8C%D0%BE%D1%80%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(17754254, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ревущии-фьорд/%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81/" class="context-link wow-class-9" rel="np">
        	Септимусс
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624968830">5 дн. 17 ч назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Пластуся: Ага, волк разъезжает на коне. Че за извращение. Тоже самое, если верблюд будет использовать медведя в качестве транспорта. Не, лучше оставайтесь на своих 4-х, так приятно наблюдать, как вы удираете, поджав свой хвост-обрубок!!!
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624968830" onclick="Cms.Comments.replyTo('2624968830','1315412237964','Септимусс'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 24;" class="comment" id="c-2624966074">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/свежеватель-душ/%D0%A1%D0%B0%D1%80%D0%BA%D0%BE%D1%82/">
												<img height="64" src="http://eu.battle.net/static-render/eu/свежеватель-душ/0/64142336-avatar.jpg?alt=/wow/static/images/2d/avatar/2-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624966074">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Саркот 
		</span>



	<div id="context-17" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Саркот</strong>
						<br />
						<span>Свежеватель Душ</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/свежеватель-душ/%D0%A1%D0%B0%D1%80%D0%BA%D0%BE%D1%82/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A1%D0%B0%D1%80%D0%BA%D0%BE%D1%82%40%D0%A1%D0%B2%D0%B5%D0%B6%D0%B5%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%20%D0%94%D1%83%D1%88&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(14967714, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/свежеватель-душ/%D0%A1%D0%B0%D1%80%D0%BA%D0%BE%D1%82/" class="context-link wow-class-3" rel="np">
        	Саркот
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624966074">06/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Есть  1 ужасный Фейл с анимацией БЭ мужского пола, когда они кастуют их верхняя губа , точнее ее левая часть отрывается от правой и уезжает куда то вверх - выглядит не лицеприятно. обратите внимание на эту перекошенную рожу)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624966074" onclick="Cms.Comments.replyTo('2624966074','1315333333005','Саркот'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 23;" class="comment" id="c-2625016103">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ткач-смерти/%D0%9A%D0%B0%D0%BB%D0%B5%D0%B4%D1%80%D0%B0/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ткач-смерти/223/55513567-avatar.jpg?alt=/wow/static/images/2d/avatar/10-1.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625016103">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Каледра 
		</span>



	<div id="context-18" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Каледра</strong>
						<br />
						<span>Ткач Смерти</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ткач-смерти/%D0%9A%D0%B0%D0%BB%D0%B5%D0%B4%D1%80%D0%B0/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9A%D0%B0%D0%BB%D0%B5%D0%B4%D1%80%D0%B0%40%D0%A2%D0%BA%D0%B0%D1%87%20%D0%A1%D0%BC%D0%B5%D1%80%D1%82%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(9623184, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ткач-смерти/%D0%9A%D0%B0%D0%BB%D0%B5%D0%B4%D1%80%D0%B0/" class="context-link wow-class-4" rel="np">
        	Каледра
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625016103">06/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Саркот: При беге у них дергается левая нога, после прыжка при приземление у них дёргается правая рука, Эльфы Крови мужики самые глючные в игре, их модельки самые корявые в игре, что не мешает им быть, самой играбельной частью Эльфов Крови в игре.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625016103" onclick="Cms.Comments.replyTo('2625016103','1315333333005','Каледра'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 22;" class="comment" id="c-2625016157">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/свежеватель-душ/%D0%A1%D0%B0%D1%80%D0%BA%D0%BE%D1%82/">
												<img height="64" src="http://eu.battle.net/static-render/eu/свежеватель-душ/0/64142336-avatar.jpg?alt=/wow/static/images/2d/avatar/2-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625016157">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Саркот 
		</span>



	<div id="context-19" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Саркот</strong>
						<br />
						<span>Свежеватель Душ</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/свежеватель-душ/%D0%A1%D0%B0%D1%80%D0%BA%D0%BE%D1%82/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A1%D0%B0%D1%80%D0%BA%D0%BE%D1%82%40%D0%A1%D0%B2%D0%B5%D0%B6%D0%B5%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%20%D0%94%D1%83%D1%88&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(14967714, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/свежеватель-душ/%D0%A1%D0%B0%D1%80%D0%BA%D0%BE%D1%82/" class="context-link wow-class-3" rel="np">
        	Саркот
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625016157">06/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Каледра: не скажи , по моему самый глюченый это хуман, - это же ужас  квадратная задница угловатые конечности - прям как будто как создали хи для вов классика с отстойной графой так и ост
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625016157" onclick="Cms.Comments.replyTo('2625016157','1315333333005','Саркот'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 21;" class="comment" id="c-2625015723">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%90%D0%BD%D1%82%D0%B8%D0%BD%D0%BE%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/169/65365161-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625015723">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Антиной 
		</span>



	<div id="context-20" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Антиной</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%90%D0%BD%D1%82%D0%B8%D0%BD%D0%BE%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D0%BD%D1%82%D0%B8%D0%BD%D0%BE%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(1781304, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%90%D0%BD%D1%82%D0%B8%D0%BD%D0%BE%D0%B9/" class="context-link wow-class-8" rel="np">
        	Антиной
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625015723">06/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Я выбрал бэ потому что они на людей похожи больши чем хуманы, в частности хотел воссоздать свой аватар в игре
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625015723" onclick="Cms.Comments.replyTo('2625015723','1315299073512','Антиной'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 20;" class="comment" id="c-2624804710">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%94%D1%80%D1%83%D0%BB%D0%BB%D0%B8%D1%8D%D0%BB%D1%8C/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/138/67279754-avatar.jpg?alt=/wow/static/images/2d/avatar/4-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624804710">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Друллиэль 
		</span>



	<div id="context-21" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Друллиэль</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%94%D1%80%D1%83%D0%BB%D0%BB%D0%B8%D1%8D%D0%BB%D1%8C/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%94%D1%80%D1%83%D0%BB%D0%BB%D0%B8%D1%8D%D0%BB%D1%8C%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(24808655, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%94%D1%80%D1%83%D0%BB%D0%BB%D0%B8%D1%8D%D0%BB%D1%8C/" class="context-link wow-class-11" rel="np">
        	Друллиэль
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624804710">04/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    А мне нравятся мужчины бладэльфы))) Няяяяя xD Они такие забавные.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624804710" onclick="Cms.Comments.replyTo('2624804710','1315113723031','Друллиэль'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 19;" class="comment" id="c-2625014896">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ясеневыи-лес/%D0%9C%D0%B0%D0%B3%D0%B8%D1%80%D0%B8%D0%BA%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ясеневыи-лес/67/66229059-avatar.jpg?alt=/wow/static/images/2d/avatar/9-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625014896">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Магирикс 
		</span>



	<div id="context-22" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Магирикс</strong>
						<br />
						<span>Ясеневый лес</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ясеневыи-лес/%D0%9C%D0%B0%D0%B3%D0%B8%D1%80%D0%B8%D0%BA%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9C%D0%B0%D0%B3%D0%B8%D1%80%D0%B8%D0%BA%D1%81%40%D0%AF%D1%81%D0%B5%D0%BD%D0%B5%D0%B2%D1%8B%D0%B9%20%D0%BB%D0%B5%D1%81&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(23495468, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ясеневыи-лес/%D0%9C%D0%B0%D0%B3%D0%B8%D1%80%D0%B8%D0%BA%D1%81/" class="context-link wow-class-8" rel="np">
        	Магирикс
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625014896">04/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Друллиэль: мне тоже
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625014896" onclick="Cms.Comments.replyTo('2625014896','1315113723031','Магирикс'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 18;" class="comment" id="c-2625013146">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/голдринн/%D0%95%D0%BD%D0%B8%D0%BC%D0%B0%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/голдринн/146/66573202-avatar.jpg?alt=/wow/static/images/2d/avatar/6-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625013146">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Енимал 
		</span>



	<div id="context-23" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Енимал</strong>
						<br />
						<span>Голдринн</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/голдринн/%D0%95%D0%BD%D0%B8%D0%BC%D0%B0%D0%BB/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%95%D0%BD%D0%B8%D0%BC%D0%B0%D0%BB%40%D0%93%D0%BE%D0%BB%D0%B4%D1%80%D0%B8%D0%BD%D0%BD&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(23327023, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/голдринн/%D0%95%D0%BD%D0%B8%D0%BC%D0%B0%D0%BB/" class="context-link wow-class-6" rel="np">
        	Енимал
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625013146">02/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Вопрос ко всем кто считает бэ геями:Где ето написано??? они что но 2 ходят? обнимаютса??? Опять 1 умник написал все за ним.Если 10-30 левел выскочил оскорбил какую-то расу и думает что он крутой а остальные гамно,то он глубоко ошибаетса,у бэ свои плюсы каторых нет у нэ и наоборот.А нубикам(Браттан) каторые токо зашли в ВоВ нечево тут мелькать.Качнитесь оденьтесь и заявите про себя В ИГРЕ а не тут дзявкать,ибо тут за то что вы нагрубили на другие расы голдов(чести бла бла бла)вам не дадут. А тем кто хамит на бэ(тауренов гоблинов орков и тп)из орды иль наоборот(воргены нэ хуманы из Альянса)ети люди ПОЛНЫЕ придурки (не нравитса вам раса НЕ ОСКОРБЛЯЙТЕ плз ее) ибо есть люди каторые в етой расе когда то нашли себя и то что вы оскорбляете расу вы оскорбляете тех людей каторые за них играют(Собираете себе врагов) так что не можете что то умное сказать лучше сесть и помолчать
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625013146" onclick="Cms.Comments.replyTo('2625013146','1314977973823','Енимал'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 17;" class="comment" id="c-2624963501">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ткач-смерти/%D0%9B%D0%B0%D0%BA%D1%83%D0%BD%D0%B0/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ткач-смерти/129/52398465-avatar.jpg?alt=/wow/static/images/2d/avatar/4-1.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624963501">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Лакуна 
		</span>



	<div id="context-24" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Лакуна</strong>
						<br />
						<span>Ткач Смерти</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ткач-смерти/%D0%9B%D0%B0%D0%BA%D1%83%D0%BD%D0%B0/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9B%D0%B0%D0%BA%D1%83%D0%BD%D0%B0%40%D0%A2%D0%BA%D0%B0%D1%87%20%D0%A1%D0%BC%D0%B5%D1%80%D1%82%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(9623184, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ткач-смерти/%D0%9B%D0%B0%D0%BA%D1%83%D0%BD%D0%B0/" class="context-link wow-class-4" rel="np">
        	Лакуна
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624963501">02/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Енимал: Перескажи плиз это Блекметалу (Тролль ДК) и Светобычоку (Паладин Таурен) когда они выйдут из бани. ))<br/>Мож тебя они послушают ??
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624963501" onclick="Cms.Comments.replyTo('2624963501','1314977973823','Лакуна'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 16;" class="comment" id="c-2624963678">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/голдринн/%D0%95%D0%BD%D0%B8%D0%BC%D0%B0%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/голдринн/146/66573202-avatar.jpg?alt=/wow/static/images/2d/avatar/6-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624963678">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Енимал 
		</span>



	<div id="context-25" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Енимал</strong>
						<br />
						<span>Голдринн</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/голдринн/%D0%95%D0%BD%D0%B8%D0%BC%D0%B0%D0%BB/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%95%D0%BD%D0%B8%D0%BC%D0%B0%D0%BB%40%D0%93%D0%BE%D0%BB%D0%B4%D1%80%D0%B8%D0%BD%D0%BD&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(23327023, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/голдринн/%D0%95%D0%BD%D0%B8%D0%BC%D0%B0%D0%BB/" class="context-link wow-class-6" rel="np">
        	Енимал
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624963678">03/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Лакуна: у меня нет времени за каждым игроком бегать и учить ево морали,тем более ети двое уже давно тут не появляютса,так что нефиг к ним приставать
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624963678" onclick="Cms.Comments.replyTo('2624963678','1314977973823','Енимал'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 15;" class="comment" id="c-2601062280">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/корольлич/%D0%92%D0%B0%D0%B9%D1%82%D0%B8%D1%80%D0%B8/">
												<img height="64" src="http://eu.battle.net/static-render/eu/корольлич/234/56206570-avatar.jpg?alt=/wow/static/images/2d/avatar/11-1.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601062280">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Вайтири 
		</span>



	<div id="context-26" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Вайтири</strong>
						<br />
						<span>Король-лич</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/корольлич/%D0%92%D0%B0%D0%B9%D1%82%D0%B8%D1%80%D0%B8/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%92%D0%B0%D0%B9%D1%82%D0%B8%D1%80%D0%B8%40%D0%9A%D0%BE%D1%80%D0%BE%D0%BB%D1%8C-%D0%BB%D0%B8%D1%87&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(2943867, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/корольлич/%D0%92%D0%B0%D0%B9%D1%82%D0%B8%D1%80%D0%B8/" class="context-link wow-class-6" rel="np">
        	Вайтири
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601062280">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Братан: У всех мнения разные. Например я думаю, что мужчины найт эльфов вообще стрёмные. Из всех остольных расс
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601062280" onclick="Cms.Comments.replyTo('2601062280','1314786076268','Вайтири'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 14;" class="comment" id="c-2601061619">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ткач-смерти/%D0%91%D1%80%D0%B0%D1%82%D1%82%D0%B0%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ткач-смерти/245/55323381-avatar.jpg?alt=/wow/static/images/2d/avatar/4-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601061619">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Браттан 
		</span>



	<div id="context-27" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Браттан</strong>
						<br />
						<span>Ткач Смерти</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ткач-смерти/%D0%91%D1%80%D0%B0%D1%82%D1%82%D0%B0%D0%BD/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%91%D1%80%D0%B0%D1%82%D1%82%D0%B0%D0%BD%40%D0%A2%D0%BA%D0%B0%D1%87%20%D0%A1%D0%BC%D0%B5%D1%80%D1%82%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(26244760, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ткач-смерти/%D0%91%D1%80%D0%B0%D1%82%D1%82%D0%B0%D0%BD/" class="context-link wow-class-11" rel="np">
        	Браттан
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601061619">30/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    породие эльфов ночных ночные лучши кровавых кровае позор орды
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601061619" onclick="Cms.Comments.replyTo('2601061619','1314703137974','Браттан'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 13;" class="comment" id="c-2601301680">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/253/67359741-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601301680">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Араггорн 
		</span>



	<div id="context-28" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Араггорн</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(23854888, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/" class="context-link wow-class-6" rel="np">
        	Араггорн
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601301680">30/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Браттан: s chego ti eto vzyal? nochnie elfi voshe na elfov ne pohozhi blin bomzhi kakie to, hahahahahahah vahahahahah vi nochnoi pozor vahahahahahah kak film nochnoi pozor vahahahahahahahahah
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601301680" onclick="Cms.Comments.replyTo('2601301680','1314703137974','Араггорн'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 12;" class="comment" id="c-2601142354">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/подземье/155/41491611-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601142354">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Эдикс 
		</span>



	<div id="context-29" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Эдикс</strong>
						<br />
						<span>Подземье</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%AD%D0%B4%D0%B8%D0%BA%D1%81%40%D0%9F%D0%BE%D0%B4%D0%B7%D0%B5%D0%BC%D1%8C%D0%B5&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(175859, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/" class="context-link wow-class-8" rel="np">
        	Эдикс
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601142354">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Браттан: По вам плачет учебник русского языка.Вами написанное можно сравнить с "казнить нельзя помиловать",где одна запятая может решить всё.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601142354" onclick="Cms.Comments.replyTo('2601142354','1314703137974','Эдикс'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 11;" class="comment" id="c-2601142584">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%BE%D0%BE%D1%80%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/204/66813644-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601142584">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Арагоорн 
		</span>



	<div id="context-30" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Арагоорн</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%BE%D0%BE%D1%80%D0%BD/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D1%80%D0%B0%D0%B3%D0%BE%D0%BE%D1%80%D0%BD%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(23854888, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%BE%D0%BE%D1%80%D0%BD/" class="context-link wow-class-4" rel="np">
        	Арагоорн
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601142584">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Эдикс: hahah soglasen
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601142584" onclick="Cms.Comments.replyTo('2601142584','1314703137974','Арагоорн'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 10;" class="comment" id="c-2601061425">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/свежеватель-душ/%D0%90%D0%BB%D0%B0%D0%BD%D0%B3%D1%80%D0%B8%D1%81%D0%B0/">
												<img height="64" src="http://eu.battle.net/static-render/eu/свежеватель-душ/18/67166994-avatar.jpg?alt=/wow/static/images/2d/avatar/10-1.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601061425">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Алангриса 
		</span>



	<div id="context-31" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Алангриса</strong>
						<br />
						<span>Свежеватель Душ</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/свежеватель-душ/%D0%90%D0%BB%D0%B0%D0%BD%D0%B3%D1%80%D0%B8%D1%81%D0%B0/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D0%BB%D0%B0%D0%BD%D0%B3%D1%80%D0%B8%D1%81%D0%B0%40%D0%A1%D0%B2%D0%B5%D0%B6%D0%B5%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%20%D0%94%D1%83%D1%88&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(22307011, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/свежеватель-душ/%D0%90%D0%BB%D0%B0%D0%BD%D0%B3%D1%80%D0%B8%D1%81%D0%B0/" class="context-link wow-class-6" rel="np">
        	Алангриса
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601061425">30/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    нормальная раса, да красивая не спрорю только кв выполнять далеко пиликать приходиться<br/><br/>
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601061425" onclick="Cms.Comments.replyTo('2601061425','1314676539138','Алангриса'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 9;" class="comment" id="c-2601061162">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ткач-смерти/%D0%90%D0%B2%D0%B0%D1%82%D0%B0%D1%80%D0%BA%D0%B0/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ткач-смерти/155/21793435-avatar.jpg?alt=/wow/static/images/2d/avatar/11-1.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601061162">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Аватарка 
		</span>



	<div id="context-32" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Аватарка</strong>
						<br />
						<span>Ткач Смерти</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ткач-смерти/%D0%90%D0%B2%D0%B0%D1%82%D0%B0%D1%80%D0%BA%D0%B0/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D0%B2%D0%B0%D1%82%D0%B0%D1%80%D0%BA%D0%B0%40%D0%A2%D0%BA%D0%B0%D1%87%20%D0%A1%D0%BC%D0%B5%D1%80%D1%82%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(9610842, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ткач-смерти/%D0%90%D0%B2%D0%B0%D1%82%D0%B0%D1%80%D0%BA%D0%B0/" class="context-link wow-class-6" rel="np">
        	Аватарка
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601061162">29/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Тут всё ясно история темна ваша как и сами вы. Выше сказано что именно Кил’джедена Велен помог вам. Он помог вам а вы озлоблено смотрите на дринеев. Как жаль что начиная играть в WoW не кто не задумывается кто его перс.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601061162" onclick="Cms.Comments.replyTo('2601061162','1314627919311','Аватарка'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 8;" class="comment" id="c-2601061074">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/подземье/155/41491611-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601061074">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Эдикс 
		</span>



	<div id="context-33" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Эдикс</strong>
						<br />
						<span>Подземье</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%AD%D0%B4%D0%B8%D0%BA%D1%81%40%D0%9F%D0%BE%D0%B4%D0%B7%D0%B5%D0%BC%D1%8C%D0%B5&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(175859, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/" class="context-link wow-class-8" rel="np">
        	Эдикс
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601061074">29/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Самая благородная и красивая раса. Пусть говорят,что хотят о нас.Мы останемся теми,кем есть.<br/>В Альянс не вернемся.Может нам там и место (как считают многие),но мы на своем месте и нас это устраивает вполне.<br/>Мы не любим другие расы и это факт. Для нас наше превосходство и безопасность превыше всего,но это не значит,что мы не уважаем сильные расы. Лишь Отрекшиеся и Сильвана наши верные и преданные союзники.<br/>Вы можете кричать,орать,обвинять нас в чем-угодно,но поймите одно - "нам плевать на ваше мнение".<br/>Да,мы самоуверенные,гордые,самовлюбленные эгоисты.И что!? Такая наша природа и это не исправить.<br/>Я горд тем,что я эльф крови и этим всё сказано!
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601061074" onclick="Cms.Comments.replyTo('2601061074','1314617301005','Эдикс'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 7;" class="comment" id="c-2601141285">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/253/67359741-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601141285">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Араггорн 
		</span>



	<div id="context-34" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Араггорн</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(23854888, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/" class="context-link wow-class-6" rel="np">
        	Араггорн
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601141285">29/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Эдикс: da soglasen s toboi luchshaya rasa i ya rad chto ona ne za alenei, Ya gorzhus tem chto ya Эльф крови
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601141285" onclick="Cms.Comments.replyTo('2601141285','1314617301005','Араггорн'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 6;" class="comment" id="c-2601062106">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/голдринн/%D0%9B%D0%B0%D0%B3%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/голдринн/95/61398879-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601062106">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Лагл 
		</span>



	<div id="context-35" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Лагл</strong>
						<br />
						<span>Голдринн</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/голдринн/%D0%9B%D0%B0%D0%B3%D0%BB/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9B%D0%B0%D0%B3%D0%BB%40%D0%93%D0%BE%D0%BB%D0%B4%D1%80%D0%B8%D0%BD%D0%BD&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(18184545, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/голдринн/%D0%9B%D0%B0%D0%B3%D0%BB/" class="context-link wow-class-6" rel="np">
        	Лагл
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601062106">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Эдикс: угу,в этом я с тобой согласен,и почему некоторые пацаны за баб эльфиек крови начинают?=)я не вьезжаю както
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601062106" onclick="Cms.Comments.replyTo('2601062106','1314617301005','Лагл'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 5;" class="comment" id="c-2601062187">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/галакронд/122/53328762-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601062187">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Айскилл 
		</span>



	<div id="context-36" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Айскилл</strong>
						<br />
						<span>Галакронд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB%40%D0%93%D0%B0%D0%BB%D0%B0%D0%BA%D1%80%D0%BE%D0%BD%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(17995222, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/" class="context-link wow-class-6" rel="np">
        	Айскилл
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601062187">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Лагл: а ты смахиваешь на меня)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601062187" onclick="Cms.Comments.replyTo('2601062187','1314617301005','Айскилл'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 4;" class="comment" id="c-2601062411">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/подземье/155/41491611-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601062411">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Эдикс 
		</span>



	<div id="context-37" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Эдикс</strong>
						<br />
						<span>Подземье</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%AD%D0%B4%D0%B8%D0%BA%D1%81%40%D0%9F%D0%BE%D0%B4%D0%B7%D0%B5%D0%BC%D1%8C%D0%B5&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(175859, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/подземье/%D0%AD%D0%B4%D0%B8%D0%BA%D1%81/" class="context-link wow-class-8" rel="np">
        	Эдикс
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601062411">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Лагл: Видимо им нравится внешне играть за красивых девушек=)<br/>У самого есть женский персонаж,но не эльф,а тауренка.Выбрал только из-за того,что моделька её поменьше бычка)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601062411" onclick="Cms.Comments.replyTo('2601062411','1314617301005','Эдикс'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 3;" class="comment" id="c-2625012849">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ревущии-фьорд/%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ревущии-фьорд/231/54705127-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625012849">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Септимусс 
		</span>



	<div id="context-38" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Септимусс</strong>
						<br />
						<span>Ревущий фьорд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ревущии-фьорд/%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81%40%D0%A0%D0%B5%D0%B2%D1%83%D1%89%D0%B8%D0%B9%20%D1%84%D1%8C%D0%BE%D1%80%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(17754254, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ревущии-фьорд/%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81/" class="context-link wow-class-9" rel="np">
        	Септимусс
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625012849">02/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Айскилл: Капец, вы однояйцевые близнецы, правда у Лагла кожа чуть темнее, наверное где-нибудь в степях под палящим солнцем переходил, вот и загорел. :)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625012849" onclick="Cms.Comments.replyTo('2625012849','1314617301005','Септимусс'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 2;" class="comment" id="c-2625012895">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ревущии-фьорд/%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ревущии-фьорд/231/54705127-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625012895">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Септимусс 
		</span>



	<div id="context-39" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Септимусс</strong>
						<br />
						<span>Ревущий фьорд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ревущии-фьорд/%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81%40%D0%A0%D0%B5%D0%B2%D1%83%D1%89%D0%B8%D0%B9%20%D1%84%D1%8C%D0%BE%D1%80%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(17754254, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ревущии-фьорд/%D0%A1%D0%B5%D0%BF%D1%82%D0%B8%D0%BC%D1%83%D1%81%D1%81/" class="context-link wow-class-9" rel="np">
        	Септимусс
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625012895">02/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Эдикс: Абсолютно согласен. Я горжусь, что я эльф крови. Мы самая лучшая расса. Остальные рассы стоят ниже нас на одну, две... ступени по уровню развития и мощи (кроме отрекшихся). Даешь геноцид (кроме отрекшихся)!!! Да низвергнется адское пламя гнева на головы наших врагов.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625012895" onclick="Cms.Comments.replyTo('2625012895','1314617301005','Септимусс'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 1;" class="comment" id="c-2624803468">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A2%D0%BE%D1%80%D1%80%D0%B0%D1%88/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/149/53425045-avatar.jpg?alt=/wow/static/images/2d/avatar/2-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624803468">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Торраш 
		</span>



	<div id="context-40" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Торраш</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A2%D0%BE%D1%80%D1%80%D0%B0%D1%88/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A2%D0%BE%D1%80%D1%80%D0%B0%D1%88%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(11196358, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A2%D0%BE%D1%80%D1%80%D0%B0%D1%88/" class="context-link wow-class-1" rel="np">
        	Торраш
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624803468">02/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Септимусс: Хы-хы. Все остальные ниже по уровню мощи?! *омгрукалицо* Вы вошли в Орду вместе с Нежитью так как над вами сжалился Тралл (как и другие расы Орды, кстате). Вы были жалки и слабы. Вы и до сих пор по силе проигрываете Оркам (А чего уж говорить о Тауренах).
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624803468" onclick="Cms.Comments.replyTo('2624803468','1314617301005','Торраш'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>



                <div class="page-nav-container">
                    <div class="page-nav-int">








        <div class="pageNav">

            	<span class="active">1</span>


						<a href="/wow/ru/game/race/blood-elf?page=2#page-comments">2</a>

						<div class="page-sep"></div>
						<a href="/wow/ru/game/race/blood-elf?page=3#page-comments">3</a>

						<div class="page-sep"></div>
						<a href="/wow/ru/game/race/blood-elf?page=4#page-comments">4</a>

						<div class="page-sep"></div>

            	<div class="page-sep">
            		…
        		</div>

	            <a href="/wow/ru/game/race/blood-elf?page=11#page-comments">11</a>
		            	<a href="/wow/ru/game/race/blood-elf?page=2#page-comments">Далее &gt;</a>
        </div>


                    </div>
                </div>
			</div>
        </div>
    </div>
			</div>