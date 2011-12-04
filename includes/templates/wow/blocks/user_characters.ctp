<?php
$character = $this->c('AccountManager')->getActiveCharacter();
$characters = $this->c('AccountManager')->getCharacters();
if ($character) :
?>
<div class="character">
	<a class="character-name context-link" rel="np" href="<?php echo $this->getWowUrl('character/' . $character['realmName'] . '/' . $character['name']); ?>" data-tooltip="<?php echo $l->getString('template_change_character'); ?>" data-tooltip-options='{"location": "topCenter"}'>
		<?php echo $character['name']; ?>
		<span class="arrow"></span>
	</a>
	<div id="context-1" class="ui-context character-select">
		<div class="context">
			<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>
			<div class="context-user">
				<strong><?php echo $character['name']; ?></strong>
				<br />
				<span class="realm up"><?php echo $character['realmName']; ?></span>
			</div>
			<div class="context-links">
				<a href="<?php echo $this->getWowUrl('character/' . $character['realmName'] . '/' . $character['name']); ?>" title="<?php echo $l->getString('template_profile_caption'); ?>" rel="np" class="icon-profile link-first"><?php echo $l->getString('template_profile_caption'); ?></a>
				<a href="<?php echo $this->getWowUrl('search?f=post&amp;a=' . urlencode($character['name'] . '@' . $character['realmName']) . '&amp;sort=time') ?>" title="<?php echo $l->getString('template_my_forum_posts_caption'); ?>" rel="np"class="icon-posts"> </a>
				<a href="<?php echo $this->getWowUrl('vault/character/auction/' . $character['faction_text'] . '/'); ?>" title="<?php echo $l->getString('template_browse_auction_caption'); ?>" rel="np" class="icon-auctions"> </a>
				<a href="<?php echo $this->getWowUrl('vault/character/event'); ?>" title="<?php echo $l->getString('template_browse_events_caption'); ?>" rel="np" class="icon-events link-last"> </a>
			</div>
		</div>
		<div class="character-list">
			<div class="primary chars-pane">
				<div class="char-wrapper">
					<a href="javascript:;" class="char pinned" rel="np">
						<span class="pin"></span>
						<span class="name"><?php echo $character['name']; ?></span>
						<span class="class color-c<?php echo $character['class']; ?>"><?php echo $l->extraFormat('template_charinfo_plate', array('classname' => $character['class_text'], 'racename' => $character['race_text'], 'level' => $character['level'])); ?></span>
						<span class="realm up"><?php echo $character['realmName']; ?></span>
					</a>
					<?php
					$idx = 1;
					if ($characters) :
						foreach ($characters as $char) : if ($char['realmName'] == $character['realmName'] && $char['name'] == $character['name']) continue;
					?>
					<a href="<?php echo $this->getWowUrl('character/' . $char['realmName'] . '/' . $char['name']); ?>" onclick="CharSelect.pin(<?php echo $char['index']; ?>, this); return false;" class="char " rel="np">
						<span class="pin"></span>
						<span class="name"><?php echo $char['name']; ?></span>
						<span class="class color-c<?php echo $char['class']; ?>"><?php echo $l->extraFormat('template_charinfo_plate', array('classname' => $char['class_text'], 'racename' => $char['race_text'], 'level' => $char['level'])); ?></span>
						<span class="realm up"><?php echo $char['realmName']; ?></span>
					</a>
					<?php ++$idx; endforeach; endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if ($character['guildId'] > 0) : ?>
<div class="guild">
	<a class="guild-name" href="<?php echo $this->getWowUrl('guild/' . $character['realmName'] . '/' . $character['guildName']); ?>"><?php echo $character['guildName']; ?></a>
</div>
<?php endif; endif; ?>
