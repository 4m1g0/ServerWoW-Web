<?php $profileType = $character->getProfileType(); ?>
<div id="profile-wrapper" class="profile-wrapper <?php if ($profileType == 'advanced') echo 'profile-wrapper-advanced'; ?> profile-wrapper-<?php echo $character->getFactionName(); ?> profile-wrapper-light">
		<div class="profile-sidebar-anchor">
			<div class="profile-sidebar-outer">
				<div class="profile-sidebar-inner">
					<div class="profile-sidebar-contents">
<?php if ($character->getProfilePage() == 'profile_home') : ?>
		<div class="profile-info-anchor">
			<div class="profile-info">
				<div class="name"><a href="<?php echo $character->getUrl(); ?>" rel="np"><?php echo $character->getName(); ?></a></div>
				<div class="title-guild">
					<div class="title"><?php if ($character->getField('chosenTitle') > 0) echo $character->getField('title'); else echo '&#160;'; ?></div>
						<div class="guild">
							<?php if ($character->getGuildInfo('guildid')) : ?>
							<a href="<?php echo $character->getGuildUrl(); ?>/?character=<?php echo $character->getName(); ?>"><?php echo $character->getGuildName(); ?></a>
							<?php else : echo '&#160;'; endif; ?>
						</div>
				</div>
	<span class="clear"><!-- --></span>

<div>
<table border='0' cellpadding='7' width='50%'>
<tr>
<td width='25%'>
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=201748293206869&xfbml=1"></script><fb:like send="true" width="400" show_faces="false" font="" data-colorscheme="dark"></fb:like>
</td>
<td width='10%'>
<a href="https://twitter.com/share" class="twitter-share-button" data-via="serverwow" data-lang="es" data-related="serverwow" data-hashtags="serverwow">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</td>
<td width='5%'>
<g:plusone size="medium"></g:plusone>
</tr>
</table>
</div>	

				<div class="under-name color-c<?php echo $character->getClass(); ?>">
						<?php
						echo $l->extraFormat(
							'template_charinfo_fmt',
							array(
								'level' => $character->getLevel(),
								'url1' => $this->getWowUrl('game/race/' . $character->getRaceKey()),
								'url2' => $this->getWowUrl('game/class/' . $character->getClassKey()),
								'racename' => $character->getRaceName(),
								'classname' => $character->getClassName(),
								'specname' => $character->getField('activeSpecName')
							)
						); ?>
					<span class="realm tip" id="profile-info-realm" data-battlegroup="<?php echo $this->c('Config')->getValue('site.battlegroup'); ?>">
						<?php echo $character->getRealmName(); ?>
					</span>
				</div>
				<div class="achievements"><a href="<?php echo $character->getUrl(); ?>/achievement"><?php echo $this->c('Achievement')->getPoints(); ?></a></div>
			</div>
		</div>
<?php else: ?>
		<div class="profile-sidebar-crest">
			<a href="<?php echo $character->getUrl(); ?>" rel="np" class="profile-sidebar-character-model" style="background-image: url(<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/2d/inset/<?php echo $character->getRace() . '-' . $character->getGender(); ?>.jpg);">
				<span class="hover"></span>
				<span class="fade"></span>
			</a>
			<div class="profile-sidebar-info">
				<div class="name"><a href="<?php echo $character->getUrl(); ?>" rel="np"><?php echo $character->getName(); ?></a></div>
				<div class="under-name color-c<?php echo $character->getClass(); ?>">
					<?php
						echo $l->extraFormat(
							'template_charinfo_fmt_crest',
							array(
								'level' => $character->getLevel(),
								'url1' => $this->getWowUrl('game/race/' . $character->getRaceKey()),
								'url2' => $this->getWowUrl('game/class/' . $character->getClassKey()),
								'racename' => $character->getRaceName(),
								'classname' => $character->getClassName()
							)
						); ?>
				</div>
				<?php if ($character->getGuildInfo('guildid')) : ?>
				<div class="guild">
						<a href="<?php echo $character->getGuildUrl(); ?>/?character=<?php echo urlencode($character->getName()); ?>"><?php echo $character->getGuildName(); ?></a>
				</div>
				<?php endif; ?>
				<div class="realm">
					<span id="profile-info-realm" class="tip" data-battlegroup="<?php echo $this->c('Config')->getValue('site.battlegroup'); ?>"><?php echo $character->getRealmName(); ?></span>
				</div>
			</div>
		</div>
<?php endif; ?>
<?php if ($this->issetRegion('profile_menu')) echo $this->region('profile_menu'); ?>
					</div>
				</div>
			</div>
		</div>

	<div class="profile-contents">

	<?php echo $this->region('profileContents'); ?>

	</div>

	<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/js/locales/summary_<?php echo $l->getLocale(); ?>.js"></script>
</div>