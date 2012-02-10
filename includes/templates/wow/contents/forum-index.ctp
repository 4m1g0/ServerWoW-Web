<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:Foros-Bloque_Lateral_Derecho:Abajo', [300, 250], 'div-gpt-ad-1328889133628-0').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:Foros-Bloque_Lateral_Derecho:Arriba', [300, 250], 'div-gpt-ad-1328889133628-1').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:Foros-Centro', [468, 60], 'div-gpt-ad-1328889133628-2').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
<script type="text/javascript">
	$(function(){Cms.Station.init();});
</script>
	<!---->
	<div id="station-view">
            <div class="bt-lite">
                <div class="bt-link readmore"><?php echo $l->getString('template_forums_blizztracker_title'); ?> <span><a href="<?php echo $this->getWowUrl('forum/blizztracker/'); ?>"><?php echo $l->getString('template_forums_all_blizz_posts'); ?></a></span></div>
                    <a href="javascript:;" onclick="Cms.Station.btLiteScroll(1)" class="bt-left"></a>
                    <a href="javascript:;" onclick="Cms.Station.btLiteScroll(-1)" class="bt-right"></a>
                <div class="bt-adjust">
                    <div class="bt-mask">
                        <div id="bt-holder">
							<?php
							$tracker = $forum->getBlizztrackerPreviewMessages();
							if ($tracker) : 
								$count = 1;
								foreach ($tracker as $group) : ?>
                                <div class="bt-set">
								<?php foreach ($group as $msg) : ?>
                                    <a href="<?php echo $this->getWowUrl('forum/topic/' . $msg['thread_id'] . ($msg['page'] > 1 ? '?page=' . $msg['page'] : '') . '#' . $msg['post_num']); ?>">
                                        <span class="desc">
											<span class="int">
                                            «<?php echo $msg['message']; ?>»
                                        </span>
										</span>
                                        <span class="info">
                                                <span class="char"><?php echo $msg['blizz_name']; ?></span>
                                                 <?php echo date('d/m/Y', $msg['post_date']); ?>
                                                 <?php echo $l->getString('template_forums_in'); ?> <strong><?php echo $msg['catTitle']; ?></strong>:
                                                 "<?php echo $msg['title']; ?>"
                                         </span>
                                    </a>
								<?php endforeach; ?>
                                </div>
								<?php endforeach; endif; ?>
                                <div class="bt-set">
                                    <a href="<?php echo $this->getWowUrl('forum/blizztracker/'); ?>">
                                        <span class="desc">
											<span class="int">
                                            <?php echo $l->getString('template_forums_blizztracker_all'); ?>
                                        </span>
										</span>
                                        <span class="info"> </span>
                                    </a>
                                </div>
                        </div>
                    </div>

                    <div class="bt-mask-l"></div>
                    <div class="bt-mask-r"></div>
                </div>
            </div>
		<div id="station-content">
			<div class="station-content-wrapper">
				<div class="station-inner-wrapper">
					<div id="forum-list">
						<div id="forum-list-interior">
						
						<center>
<!-- ServerWoW:Foros-Centro -->
<div id='div-gpt-ad-1328889133628-2' style='width:468px; height:60px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328889133628-2'); });
</script>
</div>
</center>
						
						<?php
						$categories = $forum->getIndexCategories();
						$isLoggedIn = $this->c('AccountManager')->isLoggedIn();
						if ($categories) :
							foreach ($categories as &$category) :
								$info = $category['category_info'];
								$subcats = $category['subcategories'];
						?>
								<a id="<?php echo 'forum' . $info['cat_id']; ?>" href="javascript:;" onclick="Cms.Station.parentToggle('<?php echo $info['cat_id']; ?>',this)" class="forum-parent">
									<?php echo $info['title']; ?>
								</a>

								<?php if ($subcats) : ?>
								<div class="child-forums<?php if ($info['realm_cat'] == 1) echo ' filtered-parent'; if ($info['short'] == 1) echo ' non-verbose'; ?>" id="child<?php echo $info['cat_id']; ?>">
									<?php if ($info['realm_cat'] == 1) : ?>
									<div class="child-filter">
										<div class="forum-filter png-fix">
											<img width="27" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/icons/mag-glass.png" />
											<input class='filter' type="text"/>
										</div>
										<?php if ($isLoggedIn) : ?>
										<div class="filter-options">
											<a href="javascript:;" class="selected" onclick="Cms.Station.toggleFilter(this)"><?php echo $l->getString('template_forums_my_realms'); ?></a>
											<a href="javascript:;" onclick="Cms.Station.toggleFilter(this,true)"><?php echo $l->getString('template_forums_all_realms'); ?></a>
										</div>
										<?php endif; ?>
										<span class="clear"><!-- --></span>
									</div>
									<?php endif; ?>
									<div class="forums-list">
									<?php foreach ($subcats as &$subcat) : ?>
												<a href="<?php echo $this->getWowUrl('forum/' . $subcat['cat_id'] . '/'); ?>" class="forum-link<?php if ($info['realm_cat'] == 1 && (!isset($subcat['my_realm']) || !$subcat['my_realm']) && $isLoggedIn) echo ' pre-filtered'; ?>" <?php if ($info['realm_cat'] == 1 && (isset($subcat['my_realm']) && $subcat['my_realm']) && $isLoggedIn) echo ' alt="flagged"'; ?>>

													<span class="forum-icon">
															<?php if ($subcat['icon']) : ?><img src="<?php echo CLIENT_FILES_PATH; ?>/cms/forum_icon/<?php echo $subcat['icon']; ?>"/><?php endif; ?>
													</span>

													<span class="int">
														<span class="int-padding">
															<?php echo $subcat['title']; ?>

															<span class="desc"><?php echo $subcat['desc']; ?></span>
														</span>
													</span>

												</a>
									<?php endforeach; ?>

									</div>
								</div>
							<?php endif; endforeach; endif; ?>
						</div>
					</div>
				<div class="right-column">
				
				<div id="popular-topics">
					<div class="readmore">
						Publicidad
					</div>
<!-- ServerWoW:Foros-Bloque_Lateral_Derecho:Arriba -->
<div id='div-gpt-ad-1328889133628-1' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328889133628-1'); });
</script>
</div>
                    </div>
					
				<br><div id="popular-topics">
					<div class="readmore">
						Twitter
					</div>
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
                    </div><br>
	
					<div id="popular-topics" class="module">
						<div class="readmore">
						<?php echo $l->getString('template_forums_popular_threads'); ?>
					</div>
					<div id="popular-topics-inner"></div>
				</div>

				<div id="popular-topics">
					<div class="readmore">
						Publicidad
					</div>
<!-- ServerWoW:Foros-Bloque_Lateral_Derecho:Abajo -->
<div id='div-gpt-ad-1328889133628-0' style='width:300px; height:250px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328889133628-0'); });
</script>
</div>
                    </div><br>
	
					
	   			<div class="coc">
	   					<a href="http://battle.net/community/conduct"><?php echo $l->getString('template_forums_forum_rules'); ?></a>.
	   			</div>

				</div>
	<span class="clear"><!-- --></span>
				</div>
			</div>
		</div>
	</div>