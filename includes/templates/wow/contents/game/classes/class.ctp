<?php if (!isset($gameData) || !$gameData) return; ?>
<div id="content-subheader">
				<a class="class-parent" href="./"><?php echo $l->getString('template_game_classes_title'); ?></a>
	<span class="clear"><!-- --></span>
				<h4><?php echo $gameData['class']; ?></h4>
			</div>
			<div class="faction-req">
			<?php if (isset($gameData['req_exp'])) : ?>
				<span class="req <?php echo $gameData['req_exp']; ?>"><?php echo $gameData['req_exp_str']; ?></span>
			<?php endif; ?>
			</div>
	<span class="clear"><!-- --></span>

			<div class="left-col">
				<div class="story-highlight"><p><?php echo $gameData['story']; ?></p></div>
				<div class="story-main"><div class="story-illustration"></div><?php echo $gameData['info']; ?></div>

	<div class="basic-info-box-list basic-info">
		<div class="basic-info-box-list-title"><span><?php echo $l->format('template_game_class_information', $gameData['class']); ?></span></div>
		<div class="list-box">
			<div class="wrapper">
					<p><?php echo $gameData['desc']; ?></p>
					<ul>
						<li>
							<span class="basic-info-title"><?php echo $l->getString('template_game_class_type'); ?></span>
								<?php echo $gameData['roles']; ?>
						</li>
						<li>
							<span class="basic-info-title"><?php echo $l->getString('template_game_class_bars'); ?></span>
							<?php echo $l->getString('power_health') . ', ' . $gameData['powers_info']; ?>
						</li>
						<li>
							<span class="basic-info-title"><?php echo $l->getString('template_game_class_armor'); ?></span>
								<?php echo $gameData['armor_info']; ?>
						</li>
						<li>
							<span class="basic-info-title"><?php echo $l->getString('template_game_class_weapons'); ?></span>
									<?php echo $gameData['weapons_info']; ?>
						</li>
					</ul>
	<span class="clear"><!-- --></span>
			</div>
		</div>
	</div>

	<div class="basic-info-box-list talent-info">
		<div class="basic-info-box-list-title"><span><?php echo $l->format('template_game_class_talents', $gameData['class']); ?></span></div>
		<div class="list-box">
			<div class="wrapper">
					<p><?php echo $gameData['talents']; ?></p>

					<div class="talent-info-wrapper">
						<div class="talent-header"><?php echo $l->format('template_game_class_talent_trees', $gameData['class']); ?></div>
	<span class="clear"><!-- --></span>
							<?php
							$icons_server = $this->c('Config')->getValue('site.icons_server');
							foreach ($gameData['talents_info'] as &$talent) :
							?>
							<div class="talent-wrapper">
								<a href="<?php echo $this->getWowUrl('tool/talent-calculator#' . $gameData['key']); ?>">
									<span class="talent-block" style="background-image:url(<?php echo $icons_server . '/56/' . $talent['icon']; ?>.jpg)">
									<span class="circle-frame"></span>
									</span>
								<?php echo $talent['name']; ?>
								</a>
							</div>
							<?php endforeach; ?>
	<span class="clear"><!-- --></span>
					</div>
	<span class="clear"><!-- --></span>
			</div>
		</div>
	</div>
			</div>

			<div class="right-col">
	<div class="game-scrollbox">
		<div class="scroll-title"><span><?php echo $l->format('template_game_class_features', $gameData['class']); ?></span></div>
		<div class="scroll-content">
			<div class="wrapper">
					<div class="feature-list">
						<?php
						foreach ($gameData['abilities_info'] as &$ability) : ?>
							<div class="feature-item clear-after">
								<span class="icon-frame-gloss float-left" style="background-image: url(<?php echo $icons_server; ?>/56/<?php echo $ability['icon']; ?>);">
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
		<div class="available-info-box-title"><?php echo $l->format('template_game_class_races', $gameData['class']); ?></div>
		<span class="available-info-box-desc"></span>
		<div class="list-box">
			<div class="wrapper">
					<ul>
					<?php foreach ($gameData['races_info'] as &$race) : ?>
							<li>
								<a href="../race/<?php echo $race['key']; ?>">
									<span class="icon-frame frame-36" style="background-image: url(<?php echo $race['icon']; ?>);"><span class="frame"></span></span>
									<span class="list-title"><?php echo $race['title']; ?>
										<span class="list-faction <?php echo $race['faction']; ?>"><?php echo $race['faction_title']; ?></span>
									</span>
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
					<a href="<?php echo $this->getWowUrl('media/artwork/wow-classes?keywords=' . $gameData['key']); ?>"><img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/class/thumbnails/<?php echo $gameData['key']; ?>-artwork.jpg"
						alt="<?php echo $l->getString('template_game_class_artwork'); ?>" title="<?php echo $l->getString('template_game_class_artwork'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="<?php echo $this->getWowUrl('media/artwork/wow-classes?keywords=' . $gameData['key']); ?>" class="view-all"><?php echo $l->getString('template_game_class_viewall'); ?></a>
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
					<a href="<?php echo $this->getWowUrl('media/screenshots/classes?keywords=' . $gameData['key']); ?>"><img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/game/class/thumbnails/<?php echo $gameData['key']; ?>-screenshot.jpg"
						alt="<?php echo $l->getString('template_game_class_screenshots'); ?>" title="<?php echo $l->getString('template_game_class_screenshots'); ?>" width="327" height="134" /></a>
					<div class="caption">
						<a href="<?php echo $this->getWowUrl('media/screenshots/classes?keywords=' . $gameData['key']); ?>" class="view-all"><?php echo $l->getString('template_game_class_viewall'); ?></a>
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
	<span class="clear"><!-- --></span>
				
				<div class="fansite-link-box">
					<div class="wrapper">
						<span class="fansite-box-title"><?php echo $l->getString('template_game_class_more'); ?></span>
						<p><?php echo $l->getString('template_game_class_more_desc'); ?></p>
						<div id="sdgksdngklsdngl35"></div>
        <script type="text/javascript">
        //<![CDATA[
							$(document).ready(function() {
								Fansite.generate($('#sdgksdngklsdngl35'), "class|<?php echo $gameData['id'] . '|' . $gameData['class']; ?>");
							});
        //]]>
        </script>
					</div>
				</div>
			</div>

	<span class="clear"><!-- --></span>

	<div class="guide-page-nav">
		<span class="current-guide-title"><?php echo $gameData['class']; ?></span>

		<a class="ui-button next-class button1-next " href="<?php echo $gameData['next-class-lnk']; ?>">
		<span>
			<span><?php echo $l->format('template_game_class_next', $gameData['next-class']); ?></span>
		</span>
		</a>

		<a class="ui-button previous-class button1-previous " href="<?php echo $gameData['prev-class-lnk']; ?>">
		<span>
			<span><?php echo $l->format('template_game_class_prev', $gameData['prev-class']); ?></span>
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
            		(1)
            </h3>

			<div class="comments-container">

	<script type="text/javascript">
		//<![CDATA[
			var textAreaFocused = false;
		//]]>
	</script>




    <form action="<?php echo $this->getWowUrl('discussion/eu.ru_ru.wow.class.warrior/comment?sig=6e51831d3eae6dc92080e4cf53decf48&amp;d_ref=%2Fwow%2Fru%2Fgame%2Fclass%2Fwarrior'); ?>" method="post" onsubmit="return Cms.Comments.validateComment(this);" id="comment-form-reply" class="nested">
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
		

	<a class="ui-button button1 " href="?login" onclick="return Login.open('<?php echo $this->getCoreUrl('login/login.frag'); ?>')" >
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




    <form action="/wow/ru/discussion/eu.ru_ru.wow.class.warrior/comment?sig=6e51831d3eae6dc92080e4cf53decf48&amp;d_ref=%2Fwow%2Fru%2Fgame%2Fclass%2Fwarrior" method="post" onsubmit="return Cms.Comments.validateComment(this);" id="comment-form">
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
			<span>Разместить ответ</span>
		</span>
	</a>


</td>
		</tr>
	</table>
            </div>
        </div>
    </form>



							<div style="z-index: 40;" class="comment" id="c-2624968808">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/голдринн/%D0%9A%D1%8B%D0%B7/">
												<img height="64" src="http://eu.battle.net/static-render/eu/голдринн/221/67598557-avatar.jpg?alt=/wow/static/images/2d/avatar/10-1.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624968808">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Кыз 
		</span>



	<div id="context-1" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Кыз</strong>
						<br />
						<span>Голдринн</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/голдринн/%D0%9A%D1%8B%D0%B7/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9A%D1%8B%D0%B7%40%D0%93%D0%BE%D0%BB%D0%B4%D1%80%D0%B8%D0%BD%D0%BD&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(25970797, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/голдринн/%D0%9A%D1%8B%D0%B7/" class="context-link wow-class-3" rel="np">
        	Кыз
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624968808">5 дн. 14 ч назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    как правильно качать война?не танка а война.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624968808" onclick="Cms.Comments.replyTo('2624968808','1315679653456','Кыз'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 39;" class="comment" id="c-2624809123">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%9C%D0%B8%D1%85%D0%B0%D0%B5%D0%BB%D1%8C%D0%B4%D0%B5%D1%81%D1%82%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/40/68145704-avatar.jpg?alt=/wow/static/images/2d/avatar/22-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624809123">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Михаельдестр 
		</span>



	<div id="context-2" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Михаельдестр</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%9C%D0%B8%D1%85%D0%B0%D0%B5%D0%BB%D1%8C%D0%B4%D0%B5%D1%81%D1%82%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9C%D0%B8%D1%85%D0%B0%D0%B5%D0%BB%D1%8C%D0%B4%D0%B5%D1%81%D1%82%D1%80%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(26565935, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%9C%D0%B8%D1%85%D0%B0%D0%B5%D0%BB%D1%8C%D0%B4%D0%B5%D1%81%D1%82%D1%80/" class="context-link wow-class-1" rel="np">
        	Михаельдестр
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624809123">5 дн. 13 ч назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Кыз: ? Какая война?Эсли вы имели в виду Штоб в рейдах и подземелиях быть Воином то вам надо качать ближний бой.Или вы хотели спросить штото другое?<br/>
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624809123" onclick="Cms.Comments.replyTo('2624809123','1315679653456','Михаельдестр'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 38;" class="comment" id="c-2624964733">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гром/%D0%91%D0%B0%D0%BB%D0%BE%D0%BD%D0%B0%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гром/186/68150714-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624964733">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Балонар 
		</span>



	<div id="context-3" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Балонар</strong>
						<br />
						<span>Гром</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гром/%D0%91%D0%B0%D0%BB%D0%BE%D0%BD%D0%B0%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%91%D0%B0%D0%BB%D0%BE%D0%BD%D0%B0%D1%80%40%D0%93%D1%80%D0%BE%D0%BC&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(1806561, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гром/%D0%91%D0%B0%D0%BB%D0%BE%D0%BD%D0%B0%D1%80/" class="context-link wow-class-1" rel="np">
        	Балонар
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624964733">04/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Хз, начал играть в защите и очень нравится, испытываю кайф от игры.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624964733" onclick="Cms.Comments.replyTo('2624964733','1315152030475','Балонар'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 37;" class="comment" id="c-2624964570">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%9C%D0%B8%D1%85%D0%B0%D0%B5%D0%BB%D1%8C%D0%B4%D0%B5%D1%81%D1%82%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/40/68145704-avatar.jpg?alt=/wow/static/images/2d/avatar/22-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624964570">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Михаельдестр 
		</span>



	<div id="context-4" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Михаельдестр</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%9C%D0%B8%D1%85%D0%B0%D0%B5%D0%BB%D1%8C%D0%B4%D0%B5%D1%81%D1%82%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9C%D0%B8%D1%85%D0%B0%D0%B5%D0%BB%D1%8C%D0%B4%D0%B5%D1%81%D1%82%D1%80%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(26565935, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%9C%D0%B8%D1%85%D0%B0%D0%B5%D0%BB%D1%8C%D0%B4%D0%B5%D1%81%D1%82%D1%80/" class="context-link wow-class-1" rel="np">
        	Михаельдестр
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624964570">04/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Я начал воином играть лиш для того штоб на 55 уровне создать рыцаря смерти<br/>
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624964570" onclick="Cms.Comments.replyTo('2624964570','1315138454359','Михаельдестр'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 36;" class="comment" id="c-2624802879">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/разувии/%D0%A0%D0%B0%D0%B9%D0%B4%D0%B0%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/разувии/152/29850776-avatar.jpg?alt=/wow/static/images/2d/avatar/2-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624802879">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Райдан 
		</span>



	<div id="context-5" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Райдан</strong>
						<br />
						<span>Разувий</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/разувии/%D0%A0%D0%B0%D0%B9%D0%B4%D0%B0%D0%BD/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A0%D0%B0%D0%B9%D0%B4%D0%B0%D0%BD%40%D0%A0%D0%B0%D0%B7%D1%83%D0%B2%D0%B8%D0%B9&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(6891934, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/разувии/%D0%A0%D0%B0%D0%B9%D0%B4%D0%B0%D0%BD/" class="context-link wow-class-7" rel="np">
        	Райдан
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624802879">02/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    о да куда там паладину то знать как варом играть.... скажи чем мне диспелить крылья и как дойти через хотя бы 4 новы до мага и как его законтролить, или все только умеют говорить что вар сильный класс и все кто им играет безрукие?
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624802879" onclick="Cms.Comments.replyTo('2624802879','1314947868838','Райдан'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 35;" class="comment" id="c-2625014685">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/251/66367227-avatar.jpg?alt=/wow/static/images/2d/avatar/9-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625014685">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Шмельлетучий 
		</span>



	<div id="context-6" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Шмельлетучий</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5995413, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" class="context-link wow-class-1" rel="np">
        	Шмельлетучий
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625014685">04/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Райдан:  ++++++++++++++++++++++++++++++   от так и не смог ответить как диспелить крылья ))) а я отвечу их невозможно диспелить
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625014685" onclick="Cms.Comments.replyTo('2625014685','1314947868838','Шмельлетучий'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 34;" class="comment" id="c-2601302419">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/черныи-шрам/%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/черныи-шрам/234/51839466-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601302419">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Пашапикапер 
		</span>



	<div id="context-7" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Пашапикапер</strong>
						<br />
						<span>Черный Шрам</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/черныи-шрам/%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80%40%D0%A7%D0%B5%D1%80%D0%BD%D1%8B%D0%B9%20%D0%A8%D1%80%D0%B0%D0%BC&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(9253721, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/черныи-шрам/%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80/" class="context-link wow-class-2" rel="np">
        	Пашапикапер
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601302419">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    от рук у вас одно названи,и крылья пупс сразу диспелят нормальные люди
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601302419" onclick="Cms.Comments.replyTo('2601302419','1314807327525','Пашапикапер'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 33;" class="comment" id="c-2601062479">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/251/66367227-avatar.jpg?alt=/wow/static/images/2d/avatar/9-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601062479">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Шмельлетучий 
		</span>



	<div id="context-8" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Шмельлетучий</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5995413, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" class="context-link wow-class-1" rel="np">
        	Шмельлетучий
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601062479">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    а я говорю убили класс и как бы это обидно не звучало ,  думаю многие со мной согласятся  , от ВОИНА одно название
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601062479" onclick="Cms.Comments.replyTo('2601062479','1314802616403','Шмельлетучий'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 32;" class="comment" id="c-2624803488">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/азурегос/%D0%A5%D0%B5%D1%82%D1%87/">
												<img height="64" src="http://eu.battle.net/static-render/eu/азурегос/56/35737144-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2624803488">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Хетч 
		</span>



	<div id="context-9" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Хетч</strong>
						<br />
						<span>Азурегос</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/азурегос/%D0%A5%D0%B5%D1%82%D1%87/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A5%D0%B5%D1%82%D1%87%40%D0%90%D0%B7%D1%83%D1%80%D0%B5%D0%B3%D0%BE%D1%81&amp;sort=time" title="Сообщения" rel="np"
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

        <a href="/wow/ru/character/азурегос/%D0%A5%D0%B5%D1%82%D1%87/" class="context-link wow-class-2" rel="np">
        	Хетч
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2624803488">02/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Шмельлетучий: че-то не знаю... у меня и с пвп шмотьём за вара топ дамаг в героиках)))) вроде всё супер, не знаю, чё тебя не устраивает.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2624803488" onclick="Cms.Comments.replyTo('2624803488','1314802616403','Хетч'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 31;" class="comment" id="c-2625014686">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/251/66367227-avatar.jpg?alt=/wow/static/images/2d/avatar/9-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625014686">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Шмельлетучий 
		</span>



	<div id="context-10" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Шмельлетучий</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5995413, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" class="context-link wow-class-1" rel="np">
        	Шмельлетучий
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625014686">04/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Хетч:  ну эт героикки , я про дамаг и ни чего не говорил , контроля нету у варов <br/>
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625014686" onclick="Cms.Comments.replyTo('2625014686','1314802616403','Шмельлетучий'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 30;" class="comment" id="c-2679750432">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гром/%D0%91%D0%B5%D0%BB%D0%BB%D0%B8%D0%B0%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гром/133/18642053-avatar.jpg?alt=/wow/static/images/2d/avatar/4-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2679750432">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Беллиар 
		</span>



	<div id="context-11" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Беллиар</strong>
						<br />
						<span>Гром</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гром/%D0%91%D0%B5%D0%BB%D0%BB%D0%B8%D0%B0%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%91%D0%B5%D0%BB%D0%BB%D0%B8%D0%B0%D1%80%40%D0%93%D1%80%D0%BE%D0%BC&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5150141, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гром/%D0%91%D0%B5%D0%BB%D0%BB%D0%B8%D0%B0%D1%80/" class="context-link wow-class-1" rel="np">
        	Беллиар
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2679750432">14 ч 34 мин назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Шмельлетучий: Ну, значит пвп не для тебя. Контроль есть у протов, у армсюков и фуриков миниконтроль всё же имеется, но если не пользоваться сбиванием кастов, отражением заклинаний, яростью берсерка и т.д. и т.п., то естественно будешь топовым фрагом=)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2679750432" onclick="Cms.Comments.replyTo('2679750432','1314802616403','Беллиар'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 29;" class="comment" id="c-2601302184">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/черныи-шрам/%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/черныи-шрам/234/51839466-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601302184">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Пашапикапер 
		</span>



	<div id="context-12" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Пашапикапер</strong>
						<br />
						<span>Черный Шрам</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/черныи-шрам/%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80%40%D0%A7%D0%B5%D1%80%D0%BD%D1%8B%D0%B9%20%D0%A8%D1%80%D0%B0%D0%BC&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(9253721, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/черныи-шрам/%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80/" class="context-link wow-class-2" rel="np">
        	Пашапикапер
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601302184">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    реюят просто берете и покупаете себе руки,вар может слить только фрост магу,все.а те кто говорит 1*1 ничего не может тому стыд и позор,потому что вары всегда были очень сильный класс даже после нерфа,топ дпс,контроль,которого как вы сказали нету ,хотя присутствует в изобилии,и им интересно играть,а кого сливают за вара у того просто реально руки из ж**ы,и стойки прекрасно меняются и помогают
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601302184" onclick="Cms.Comments.replyTo('2601302184','1314789975367','Пашапикапер'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 28;" class="comment" id="c-2601142429">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/15/66605327-avatar.jpg?alt=/wow/static/images/2d/avatar/6-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601142429">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Шоковей 
		</span>



	<div id="context-13" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Шоковей</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5995413, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9/" class="context-link wow-class-3" rel="np">
        	Шоковей
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601142429">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Пашапикапер:  сказал вам паладин , за которого играть  можно валиком водить по клаве  <br/>во 1ых  ни когда не снесете дк в крови во 2ох  криты   защита уже юзаютяс в 1ой стойке и нам надо только в защитную стойку перейти чтобы отразить заклинание  , у которого стало кд 25 секунд !  а тут включить крылья кинуть молот да прямые руки у всех паладинов очень прямые , из варов уже не сделали класс а контроль что стан фир ? пффф
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601142429" onclick="Cms.Comments.replyTo('2601142429','1314789975367','Шоковей'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 27;" class="comment" id="c-2601302338">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/251/66367227-avatar.jpg?alt=/wow/static/images/2d/avatar/9-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601302338">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Шмельлетучий 
		</span>



	<div id="context-14" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Шмельлетучий</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5995413, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" class="context-link wow-class-1" rel="np">
        	Шмельлетучий
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601302338">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Пашапикапер:  паладин уйди реально включай крылья будь доволен
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601302338" onclick="Cms.Comments.replyTo('2601302338','1314789975367','Шмельлетучий'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 26;" class="comment" id="c-2601302421">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/черныи-шрам/%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/черныи-шрам/234/51839466-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601302421">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Пашапикапер 
		</span>



	<div id="context-15" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Пашапикапер</strong>
						<br />
						<span>Черный Шрам</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/черныи-шрам/%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80%40%D0%A7%D0%B5%D1%80%D0%BD%D1%8B%D0%B9%20%D0%A8%D1%80%D0%B0%D0%BC&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(9253721, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/черныи-шрам/%D0%9F%D0%B0%D1%88%D0%B0%D0%BF%D0%B8%D0%BA%D0%B0%D0%BF%D0%B5%D1%80/" class="context-link wow-class-2" rel="np">
        	Пашапикапер
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601302421">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Шмельлетучий: норм вар сольет и пала и дк,и в бладе ололо полные бегают,которых мозга вообще нуль.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601302421" onclick="Cms.Comments.replyTo('2601302421','1314789975367','Пашапикапер'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 25;" class="comment" id="c-2601302587">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/251/66367227-avatar.jpg?alt=/wow/static/images/2d/avatar/9-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601302587">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Шмельлетучий 
		</span>



	<div id="context-16" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Шмельлетучий</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5995413, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" class="context-link wow-class-1" rel="np">
        	Шмельлетучий
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601302587">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Пашапикапер: блин мужик хоть они и олололо  но составит труда нажжать 3 кнопки , если ты мне скажешь как бороться , что как я взаранее благодарен
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601302587" onclick="Cms.Comments.replyTo('2601302587','1314789975367','Шмельлетучий'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 24;" class="comment" id="c-2601063031">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/251/66367227-avatar.jpg?alt=/wow/static/images/2d/avatar/9-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601063031">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Шмельлетучий 
		</span>



	<div id="context-17" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Шмельлетучий</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5995413, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BC%D0%B5%D0%BB%D1%8C%D0%BB%D0%B5%D1%82%D1%83%D1%87%D0%B8%D0%B9/" class="context-link wow-class-1" rel="np">
        	Шмельлетучий
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601063031">01/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Пашапикапер: чем тебе деспелить ?
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601063031" onclick="Cms.Comments.replyTo('2601063031','1314789975367','Шмельлетучий'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 23;" class="comment" id="c-2625016115">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ревущии-фьорд/%D0%A2%D1%8D%D1%80%D1%80%D0%BE%D0%B1%D0%BB%D0%B5%D0%B9%D0%B4/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ревущии-фьорд/170/50626986-avatar.jpg?alt=/wow/static/images/2d/avatar/2-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2625016115">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Тэрроблейд 
		</span>



	<div id="context-18" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Тэрроблейд</strong>
						<br />
						<span>Ревущий фьорд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ревущии-фьорд/%D0%A2%D1%8D%D1%80%D1%80%D0%BE%D0%B1%D0%BB%D0%B5%D0%B9%D0%B4/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A2%D1%8D%D1%80%D1%80%D0%BE%D0%B1%D0%BB%D0%B5%D0%B9%D0%B4%40%D0%A0%D0%B5%D0%B2%D1%83%D1%89%D0%B8%D0%B9%20%D1%84%D1%8C%D0%BE%D1%80%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(6288587, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ревущии-фьорд/%D0%A2%D1%8D%D1%80%D1%80%D0%BE%D0%B1%D0%BB%D0%B5%D0%B9%D0%B4/" class="context-link wow-class-1" rel="np">
        	Тэрроблейд
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2625016115">06/09/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Пашапикапер: Глупый ты, совсем не умный(В игровом плане и механиках, почитай и не позорься так больше)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2625016115" onclick="Cms.Comments.replyTo('2625016115','1314789975367','Тэрроблейд'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 22;" class="comment" id="c-2601302109">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/15/66605327-avatar.jpg?alt=/wow/static/images/2d/avatar/6-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601302109">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Шоковей 
		</span>



	<div id="context-19" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Шоковей</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5995413, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9/" class="context-link wow-class-3" rel="np">
        	Шоковей
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601302109">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Начинающие вары  - жмите быстрей удалить персонажа<br/>Воина убили полностью  , этот класс 1 на 1 сливает каждому  , взаимодействие стоек больше нету .... интерес играть  пропадает ..
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601302109" onclick="Cms.Comments.replyTo('2601302109','1314783168988','Шоковей'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 21;" class="comment" id="c-2601061098">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%94%D0%B0%D0%BC%D0%B0%D0%B3%D0%B8%D1%80%D1%83%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/63/55823679-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601061098">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Дамагирус 
		</span>



	<div id="context-20" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Дамагирус</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%94%D0%B0%D0%BC%D0%B0%D0%B3%D0%B8%D1%80%D1%83%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%94%D0%B0%D0%BC%D0%B0%D0%B3%D0%B8%D1%80%D1%83%D1%81%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(12130912, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%94%D0%B0%D0%BC%D0%B0%D0%B3%D0%B8%D1%80%D1%83%D1%81/" class="context-link wow-class-8" rel="np">
        	Дамагирус
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601061098">29/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Танкайр я варом как бы с бк играю ну я играл в бк и лк в пвп ток по сколько щас вары полный уг я сделал танка и просто ща танчить учусь)
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601061098" onclick="Cms.Comments.replyTo('2601061098','1314620581150','Дамагирус'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 20;" class="comment" id="c-2594390593">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/термоштепсель/%D0%9E%D0%B1%D0%B0%D0%BB%D0%B4%D0%B5%D0%B2%D1%88%D0%B8%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/термоштепсель/105/65783145-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2594390593">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Обалдевший 
		</span>



	<div id="context-21" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Обалдевший</strong>
						<br />
						<span>Термоштепсель</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/термоштепсель/%D0%9E%D0%B1%D0%B0%D0%BB%D0%B4%D0%B5%D0%B2%D1%88%D0%B8%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9E%D0%B1%D0%B0%D0%BB%D0%B4%D0%B5%D0%B2%D1%88%D0%B8%D0%B9%40%D0%A2%D0%B5%D1%80%D0%BC%D0%BE%D1%88%D1%82%D0%B5%D0%BF%D1%81%D0%B5%D0%BB%D1%8C&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(17653085, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/термоштепсель/%D0%9E%D0%B1%D0%B0%D0%BB%D0%B4%D0%B5%D0%B2%D1%88%D0%B8%D0%B9/" class="context-link wow-class-1" rel="np">
        	Обалдевший
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2594390593">26/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Ханапкус, полностью тобой согласен. На арене с хилом выношу очень многих. а в 1х1 некого не выношу. даже в пве шмоте убивают за пару ударов. Несмотря на то, что я латник и реса много. а на счёт того что выбирать другой класс - не соглашусь, т.к. всё таки на арене, бг, и тем более в рейдах мы очень востребованы.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2594390593" onclick="Cms.Comments.replyTo('2594390593','1314365570474','Обалдевший'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 19;" class="comment" id="c-2601300347">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/свежеватель-душ/%D0%92%D0%BE%D0%BB%D0%B4%D0%B6%D0%BE%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/свежеватель-душ/23/66119191-avatar.jpg?alt=/wow/static/images/2d/avatar/8-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601300347">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Волджон 
		</span>



	<div id="context-22" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Волджон</strong>
						<br />
						<span>Свежеватель Душ</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/свежеватель-душ/%D0%92%D0%BE%D0%BB%D0%B4%D0%B6%D0%BE%D0%BD/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%92%D0%BE%D0%BB%D0%B4%D0%B6%D0%BE%D0%BD%40%D0%A1%D0%B2%D0%B5%D0%B6%D0%B5%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%20%D0%94%D1%83%D1%88&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(23862467, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/свежеватель-душ/%D0%92%D0%BE%D0%BB%D0%B4%D0%B6%D0%BE%D0%BD/" class="context-link wow-class-3" rel="np">
        	Волджон
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601300347">27/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Обалдевший: я с вами обоими не соглошаюсь вары один на один хороши если банки хп есть!!!
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601300347" onclick="Cms.Comments.replyTo('2601300347','1314365570474','Волджон'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 18;" class="comment" id="c-2601142013">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/голдринн/%D0%90%D0%B4%D1%81%D0%BA%D0%B8%D0%B9%D0%B1%D1%8B%D0%BA/">
												<img height="64" src="http://eu.battle.net/static-render/eu/голдринн/164/56085924-avatar.jpg?alt=/wow/static/images/2d/avatar/6-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2601142013">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Адскийбык 
		</span>



	<div id="context-23" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Адскийбык</strong>
						<br />
						<span>Голдринн</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/голдринн/%D0%90%D0%B4%D1%81%D0%BA%D0%B8%D0%B9%D0%B1%D1%8B%D0%BA/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%90%D0%B4%D1%81%D0%BA%D0%B8%D0%B9%D0%B1%D1%8B%D0%BA%40%D0%93%D0%BE%D0%BB%D0%B4%D1%80%D0%B8%D0%BD%D0%BD&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(14430197, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/голдринн/%D0%90%D0%B4%D1%81%D0%BA%D0%B8%D0%B9%D0%B1%D1%8B%D0%BA/" class="context-link wow-class-1" rel="np">
        	Адскийбык
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2601142013">31/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Обалдевший: Вар сам по себе очень трудный класс и чтобы можно было играть в нагибатора надо рейтинги соблюдать малейшее отклонение от стандарта и всё жо па.+ещё символы нужны и конешно прямые руки<br/>
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2601142013" onclick="Cms.Comments.replyTo('2601142013','1314365570474','Адскийбык'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 17;" class="comment" id="c-2569188712">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/подземье/%D0%A5%D0%B0%D0%BD%D0%B0%D1%80%D0%BA%D1%83%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/подземье/112/40044400-avatar.jpg?alt=/wow/static/images/2d/avatar/5-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2569188712">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Ханаркус 
		</span>



	<div id="context-24" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Ханаркус</strong>
						<br />
						<span>Подземье</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/подземье/%D0%A5%D0%B0%D0%BD%D0%B0%D1%80%D0%BA%D1%83%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A5%D0%B0%D0%BD%D0%B0%D1%80%D0%BA%D1%83%D1%81%40%D0%9F%D0%BE%D0%B4%D0%B7%D0%B5%D0%BC%D1%8C%D0%B5&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(585321, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/подземье/%D0%A5%D0%B0%D0%BD%D0%B0%D1%80%D0%BA%D1%83%D1%81/" class="context-link wow-class-1" rel="np">
        	Ханаркус
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2569188712">23/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Воины ( Оружие ) в дуели многим проигрывают, все таки нету балнса на официальном. Воины только с хилами и могут бегать...<br/>Начинающие воины задумайтесь и выберите другой класс, к примеру мага ( фрост ) у него контроля много.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2569188712" onclick="Cms.Comments.replyTo('2569188712','1314114382619','Ханаркус'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 16;" class="comment" id="c-2569267480">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/галакронд/%D0%A2%D0%B0%D0%BD%D0%BA%D0%B0%D0%B9%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/галакронд/228/38410980-avatar.jpg?alt=/wow/static/images/2d/avatar/11-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2569267480">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Танкайр 
		</span>



	<div id="context-25" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Танкайр</strong>
						<br />
						<span>Галакронд</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/галакронд/%D0%A2%D0%B0%D0%BD%D0%BA%D0%B0%D0%B9%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A2%D0%B0%D0%BD%D0%BA%D0%B0%D0%B9%D1%80%40%D0%93%D0%B0%D0%BB%D0%B0%D0%BA%D1%80%D0%BE%D0%BD%D0%B4&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(12493551, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/галакронд/%D0%A2%D0%B0%D0%BD%D0%BA%D0%B0%D0%B9%D1%80/" class="context-link wow-class-1" rel="np">
        	Танкайр
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2569267480">21/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Успехов начинающим Варам :D
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2569267480" onclick="Cms.Comments.replyTo('2569267480','1313912960999','Танкайр'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 15;" class="comment" id="c-2564986528">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%94%D0%B0%D0%BC%D0%B0%D0%B3%D0%B8%D1%80%D1%83%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/63/55823679-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2564986528">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Дамагирус 
		</span>



	<div id="context-26" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Дамагирус</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%94%D0%B0%D0%BC%D0%B0%D0%B3%D0%B8%D1%80%D1%83%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%94%D0%B0%D0%BC%D0%B0%D0%B3%D0%B8%D1%80%D1%83%D1%81%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(12130912, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%94%D0%B0%D0%BC%D0%B0%D0%B3%D0%B8%D1%80%D1%83%D1%81/" class="context-link wow-class-8" rel="np">
        	Дамагирус
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2564986528">19/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    а как правильно танчить варом прост хочу научиться
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2564986528" onclick="Cms.Comments.replyTo('2564986528','1313724365426','Дамагирус'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 14;" class="comment" id="c-2504943370">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/седогрив/%D0%A2%D0%BE%D0%BE%D0%BD%D1%82/">
												<img height="64" src="http://eu.battle.net/static-render/eu/седогрив/87/53756503-avatar.jpg?alt=/wow/static/images/2d/avatar/2-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2504943370">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Тоонт 
		</span>



	<div id="context-27" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Тоонт</strong>
						<br />
						<span>Седогрив</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/седогрив/%D0%A2%D0%BE%D0%BE%D0%BD%D1%82/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A2%D0%BE%D0%BE%D0%BD%D1%82%40%D0%A1%D0%B5%D0%B4%D0%BE%D0%B3%D1%80%D0%B8%D0%B2&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(24061033, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/седогрив/%D0%A2%D0%BE%D0%BE%D0%BD%D1%82/" class="context-link wow-class-1" rel="np">
        	Тоонт
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2504943370">12/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Воины - основа фракции. Ведь именно мы стоим на предовой и закрываем грудью остальных. Именно мы терпим боль во время сражения. Мы не полагаемся на магию, приспешников или чудеса инженерии. Мы предпочитаем проверенное временем средство убийства - меч, топор, булаву или копьё. И не дай боже встретить вам на пути воина противоборствующей фракции...
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2504943370" onclick="Cms.Comments.replyTo('2504943370','1313175425197','Тоонт'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 13;" class="comment" id="c-2505194429">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/корольлич/%D0%9F%D0%BB%D0%B0%D1%81%D1%82%D1%83%D1%81%D1%8F/">
												<img height="64" src="http://eu.battle.net/static-render/eu/корольлич/47/63706415-avatar.jpg?alt=/wow/static/images/2d/avatar/22-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2505194429">
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



	<div id="context-28" class="ui-context">
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
										<a href="#c-2505194429">16/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Тоонт: да правда
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2505194429" onclick="Cms.Comments.replyTo('2505194429','1313175425197','Пластуся'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 12;" class="comment" id="c-2505195028">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/дракономор/%D0%92%D1%83%D0%BB%D1%8C%D1%84%D1%8D%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/дракономор/208/54630864-avatar.jpg?alt=/wow/static/images/2d/avatar/22-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2505195028">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Вульфэр 
		</span>



	<div id="context-29" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Вульфэр</strong>
						<br />
						<span>Дракономор</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/дракономор/%D0%92%D1%83%D0%BB%D1%8C%D1%84%D1%8D%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%92%D1%83%D0%BB%D1%8C%D1%84%D1%8D%D1%80%40%D0%94%D1%80%D0%B0%D0%BA%D0%BE%D0%BD%D0%BE%D0%BC%D0%BE%D1%80&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(25356210, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/дракономор/%D0%92%D1%83%D0%BB%D1%8C%D1%84%D1%8D%D1%80/" class="context-link wow-class-1" rel="np">
        	Вульфэр
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2505195028">17/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Тоонт: Безусловно Вары рулят<br/>
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2505195028" onclick="Cms.Comments.replyTo('2505195028','1313175425197','Вульфэр'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 11;" class="comment" id="c-2690949173">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%90%D1%80%D0%B0%D0%B3%D0%B3%D0%BE%D1%80%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/253/67359741-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2690949173">
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



	<div id="context-30" class="ui-context">
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
										<a href="#c-2690949173">3 ч 37 мин назад</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Тоонт: ya te skazhu ya varu s dk na krovi ne proigrival ni razu varov ochen legko ubit  i kogda ya igral s nim do 34 lvl ya ponyal chto on slab
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2690949173" onclick="Cms.Comments.replyTo('2690949173','1313175425197','Араггорн'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 10;" class="comment" id="c-2504812752">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/15/66605327-avatar.jpg?alt=/wow/static/images/2d/avatar/6-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2504812752">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Шоковей 
		</span>



	<div id="context-31" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Шоковей</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5995413, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/пиратская-бухта/%D0%A8%D0%BE%D0%BA%D0%BE%D0%B2%D0%B5%D0%B9/" class="context-link wow-class-3" rel="np">
        	Шоковей
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2504812752">10/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Ребят у всех в армсе с дамагом большие проблемы ?
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2504812752" onclick="Cms.Comments.replyTo('2504812752','1312984452718','Шоковей'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 9;" class="comment" id="c-2583978430">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/подземье/%D0%A5%D0%B0%D0%BD%D0%B0%D1%80%D0%BA%D1%83%D1%81/">
												<img height="64" src="http://eu.battle.net/static-render/eu/подземье/112/40044400-avatar.jpg?alt=/wow/static/images/2d/avatar/5-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2583978430">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Ханаркус 
		</span>



	<div id="context-32" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Ханаркус</strong>
						<br />
						<span>Подземье</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/подземье/%D0%A5%D0%B0%D0%BD%D0%B0%D1%80%D0%BA%D1%83%D1%81/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%A5%D0%B0%D0%BD%D0%B0%D1%80%D0%BA%D1%83%D1%81%40%D0%9F%D0%BE%D0%B4%D0%B7%D0%B5%D0%BC%D1%8C%D0%B5&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(585321, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/подземье/%D0%A5%D0%B0%D0%BD%D0%B0%D1%80%D0%BA%D1%83%D1%81/" class="context-link wow-class-1" rel="np">
        	Ханаркус
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2583978430">23/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Шоковей: по манекену 85 уровня при пвп вещах ил 370 дамаг заходит слабоват и лишь иногда можно ударить по 33-40к.  обычно 7к - 17к
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2583978430" onclick="Cms.Comments.replyTo('2583978430','1312984452718','Ханаркус'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 8;" class="comment" id="c-2504811477">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/пиратская-бухта/%D0%92%D0%B0%D1%80%D0%B3%D0%B0%D1%80/">
												<img height="64" src="http://eu.battle.net/static-render/eu/пиратская-бухта/192/20871872-avatar.jpg?alt=/wow/static/images/2d/avatar/2-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2504811477">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Варгар 
		</span>



	<div id="context-33" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Варгар</strong>
						<br />
						<span>Пиратская бухта</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/пиратская-бухта/%D0%92%D0%B0%D1%80%D0%B3%D0%B0%D1%80/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%92%D0%B0%D1%80%D0%B3%D0%B0%D1%80%40%D0%9F%D0%B8%D1%80%D0%B0%D1%82%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B1%D1%83%D1%85%D1%82%D0%B0&amp;sort=time" title="Сообщения" rel="np"
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

        <a href="/wow/ru/character/пиратская-бухта/%D0%92%D0%B0%D1%80%D0%B3%D0%B0%D1%80/" class="context-link wow-class-1" rel="np">
        	Варгар
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2504811477">07/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    На БГ - Оружие, это однозначно, в инстах на выбор - можно и Неистовство (с ним удобнее играть, если реакция хорошая) или Оружие (тут попроще будет, да и дамаг норм, в принципе).
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2504811477" onclick="Cms.Comments.replyTo('2504811477','1312727917584','Варгар'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 7;" class="comment" id="c-2504811551">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/подземье/%D0%9E%D1%85%D0%B0/">
												<img height="64" src="http://eu.battle.net/static-render/eu/подземье/94/52335454-avatar.jpg?alt=/wow/static/images/2d/avatar/6-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2504811551">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Оха 
		</span>



	<div id="context-34" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Оха</strong>
						<br />
						<span>Подземье</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/подземье/%D0%9E%D1%85%D0%B0/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9E%D1%85%D0%B0%40%D0%9F%D0%BE%D0%B4%D0%B7%D0%B5%D0%BC%D1%8C%D0%B5&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(18778283, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/подземье/%D0%9E%D1%85%D0%B0/" class="context-link wow-class-2" rel="np">
        	Оха
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2504811551">07/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Варгар: Спасибо тебе большое.Удачи)))<br/>
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2504811551" onclick="Cms.Comments.replyTo('2504811551','1312727917584','Оха'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>


							<div style="z-index: 6;" class="comment" id="c-2505190547">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/подземье/%D0%9E%D1%85%D0%B0/">
												<img height="64" src="http://eu.battle.net/static-render/eu/подземье/94/52335454-avatar.jpg?alt=/wow/static/images/2d/avatar/6-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2505190547">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Оха 
		</span>



	<div id="context-35" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Оха</strong>
						<br />
						<span>Подземье</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/подземье/%D0%9E%D1%85%D0%B0/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%9E%D1%85%D0%B0%40%D0%9F%D0%BE%D0%B4%D0%B7%D0%B5%D0%BC%D1%8C%D0%B5&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(18778283, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/подземье/%D0%9E%D1%85%D0%B0/" class="context-link wow-class-2" rel="np">
        	Оха
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2505190547">06/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Ребята подскажите пожалуста хочу поиграть за война для бг лучше прокачать таланты (оруж)или (истество)?зрание спасибо))))))))<br/>
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2505190547" onclick="Cms.Comments.replyTo('2505190547','1312620008318','Оха'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 5;" class="comment" id="c-2499390168">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/ткач-смерти/%D0%94%D0%B8%D0%BA%D0%B0%D1%8F%D1%88%D1%82%D1%83%D1%87%D0%BA%D0%B0/">
												<img height="64" src="http://eu.battle.net/static-render/eu/ткач-смерти/255/49569535-avatar.jpg?alt=/wow/static/images/2d/avatar/10-1.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2499390168">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Дикаяштучка 
		</span>



	<div id="context-36" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Дикаяштучка</strong>
						<br />
						<span>Ткач Смерти</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/ткач-смерти/%D0%94%D0%B8%D0%BA%D0%B0%D1%8F%D1%88%D1%82%D1%83%D1%87%D0%BA%D0%B0/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%94%D0%B8%D0%BA%D0%B0%D1%8F%D1%88%D1%82%D1%83%D1%87%D0%BA%D0%B0%40%D0%A2%D0%BA%D0%B0%D1%87%20%D0%A1%D0%BC%D0%B5%D1%80%D1%82%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5597910, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/ткач-смерти/%D0%94%D0%B8%D0%BA%D0%B0%D1%8F%D1%88%D1%82%D1%83%D1%87%D0%BA%D0%B0/" class="context-link wow-class-1" rel="np">
        	Дикаяштучка
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2499390168">05/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    если хотите прокачать танка вар это то что вам надо инфа 100  даст фору любому дк xD
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2499390168" onclick="Cms.Comments.replyTo('2499390168','1312568282439','Дикаяштучка'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 4;" class="comment" id="c-2491589477">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%AF%D0%BC%D0%B0%D1%85%D0%BE%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/89/30670681-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2491589477">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Ямахон 
		</span>



	<div id="context-37" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Ямахон</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%AF%D0%BC%D0%B0%D1%85%D0%BE%D0%BD/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%AF%D0%BC%D0%B0%D1%85%D0%BE%D0%BD%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(3939758, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%AF%D0%BC%D0%B0%D1%85%D0%BE%D0%BD/" class="context-link wow-class-1" rel="np">
        	Ямахон
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2491589477">04/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    Потоки крови и боли, своей и чужой, сопровождают нас каждое мгновение нашей жизни. Но для того мы созданы, что бы терпеть, прощать и отпускать врагов в лучший мир. Так будет продолжаться во веки веков, пока существуют такие как мы. И я Горжусь тем, что я Воин! За славу, за честь, за смерть!
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2491589477" onclick="Cms.Comments.replyTo('2491589477','1312476726532','Ямахон'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 3;" class="comment" id="c-2491629245">

                                <div class="avatar portrait-b">
										<div class="avatar-interior">
											<a href="/wow/ru/character/гордунни/%D0%AF%D0%BD%D1%81%D0%B0%D0%BD/">
												<img height="64" src="http://eu.battle.net/static-render/eu/гордунни/14/24314382-avatar.jpg?alt=/wow/static/images/2d/avatar/1-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2491629245">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Янсан 
		</span>



	<div id="context-38" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Янсан</strong>
						<br />
						<span>Гордунни</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/гордунни/%D0%AF%D0%BD%D1%81%D0%B0%D0%BD/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%AF%D0%BD%D1%81%D0%B0%D0%BD%40%D0%93%D0%BE%D1%80%D0%B4%D1%83%D0%BD%D0%BD%D0%B8&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(8184073, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/гордунни/%D0%AF%D0%BD%D1%81%D0%B0%D0%BD/" class="context-link wow-class-1" rel="np">
        	Янсан
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2491629245">04/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Янитанк: Фури вар (Неистовство). С 69 лвл.
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2491629245" onclick="Cms.Comments.replyTo('2491629245','1312446778788','Янсан'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





                        <div class="nested">
							<div style="z-index: 2;" class="comment" id="c-2491539349">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/галакронд/%D0%90%D0%B9%D1%81%D0%BA%D0%B8%D0%BB%D0%BB/">
												<img height="64" src="http://eu.battle.net/static-render/eu/галакронд/122/53328762-avatar.jpg?alt=/wow/static/images/2d/avatar/10-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2491539349">
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



	<div id="context-39" class="ui-context">
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
										<a href="#c-2491539349">04/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Янсан: идиот? я на варе с 10 носил
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2491539349" onclick="Cms.Comments.replyTo('2491539349','1312446778788','Айскилл'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>





							<div style="z-index: 1;" class="comment" id="c-2499359981">

                                <div class="avatar portrait-c">
										<div class="avatar-interior">
											<a href="/wow/ru/character/подземье/%D0%94%D0%B8%D1%81%D1%84%D1%83%D0%B7%D0%B8%D0%B9/">
												<img height="64" src="http://eu.battle.net/static-render/eu/подземье/240/51719920-avatar.jpg?alt=/wow/static/images/2d/avatar/22-0.jpg" alt="" />
											</a>
										</div>
								</div>

    <div class="karma" id="k-2499359981">
        	<div class="karma-feedback">
                Чтобы дать оценку, <a href="?login" onclick="return Login.open('https://eu.battle.net/login/login.frag')">авторизуйтесь</a>.
            </div>
	<span class="clear"><!-- --></span>
    </div>

                            <div class="comment-interior">
                                <div class="character-info user">




    <div class="user-name">
		<span class="char-name-code" style="display: none">
			Дисфузий 
		</span>



	<div id="context-40" class="ui-context">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>

			<div class="context-user">
				<strong>Дисфузий</strong>
						<br />
						<span>Подземье</span>
			</div>







			<div class="context-links">
					<a href="/wow/ru/character/подземье/%D0%94%D0%B8%D1%81%D1%84%D1%83%D0%B7%D0%B8%D0%B9/" title="Профиль" rel="np"
					   class="icon-profile link-first"
					   >
						Профиль
					</a>
					<a href="/wow/ru/search?f=post&amp;a=%D0%94%D0%B8%D1%81%D1%84%D1%83%D0%B7%D0%B8%D0%B9%40%D0%9F%D0%BE%D0%B4%D0%B7%D0%B5%D0%BC%D1%8C%D0%B5&amp;sort=time" title="Сообщения" rel="np"
					   class="icon-posts"
					   >
						
					</a>
					<a href="javascript:;" title="Внести в черный список" rel="np"
					   class="icon-ignore link-last"
					   onclick="Cms.ignore(5370832, false); return false;">
						
					</a>
			</div>
		</div>

	</div>

        <a href="/wow/ru/character/подземье/%D0%94%D0%B8%D1%81%D1%84%D1%83%D0%B7%D0%B8%D0%B9/" class="context-link wow-class-11" rel="np">
        	Дисфузий
        </a>
    </div>

                                    <span class="time">
										<a href="#c-2499359981">05/08/2011</a>
										
									</span>

                                </div>

                                <div class="content">
                                    @Айскилл: Не позорь орду он говорит про две двухручки чтобы их вместе таскали! а не про одноручки которые моно ттоскать в фурике с 10 лвл! незнаеш  молчал бы лучше )
                                </div>

                                <div class="comment-actions">


                                        <a class="reply-link" href="#c-2499359981" onclick="Cms.Comments.replyTo('2499359981','1312446778788','Дисфузий'); return false;">Ответить</a>
                                </div>
                            </div>
                        </div>



                        </div>



                <div class="page-nav-container">
                    <div class="page-nav-int">








        <div class="pageNav">

            	<span class="active">1</span>


						<a href="/wow/ru/game/class/warrior?page=2#page-comments">2</a>

						<div class="page-sep"></div>
						<a href="/wow/ru/game/class/warrior?page=3#page-comments">3</a>

						<div class="page-sep"></div>
						<a href="/wow/ru/game/class/warrior?page=4#page-comments">4</a>

						<div class="page-sep"></div>

            	<div class="page-sep">
            		…
        		</div>

	            <a href="/wow/ru/game/class/warrior?page=9#page-comments">9</a>
		            	<a href="/wow/ru/game/class/warrior?page=2#page-comments">Далее &gt;</a>
        </div>


                    </div>
                </div>
			</div>
        </div>
    </div>
			</div>