<?php
if (!$this->c('AccountManager')->isLoggedIn())
	return;

$character = $this->c('AccountManager')->getActiveCharacter();
$characters = $this->c('AccountManager')->getCharacters();
?>
<div class="avatar">
	<div class="avatar-interior">
		<a href="<?php echo $character['url']; ?>"><img src="/wow/static/images/2d/avatar/<?php echo $character['race'] . '-' . $character['gender']; ?>.jpg" alt="" width="64" /></a>
	</div>
</div>
<div class="character-info">
    <div class="user-name">
		<span class="char-name-code" style="display: none">
			<?php echo $character['name']; ?>
		</span>
		<div id="context-2" class="ui-context character-select">
			<div class="context">
				<a href="javascript:;" class="close" onclick="return CharSelect.close(this);"></a>
				<div class="context-user">
					<strong><?php echo $character['name']; ?></strong><br /><span class="realm up"><?php echo $character['realmName']; ?></span>
				</div>
				<div class="context-links">
					<a href="<?php echo $character['url']; ?>" title="<?php echo $l->getString('template_profile_caption'); ?>" rel="np" class="icon-profile link-first">
						<?php echo $l->getString('template_profile_caption'); ?>
					</a>
					<a href="<?php echo $this->getWowUrl('search?f=post&amp;a=' . urlencode($character['name'] . '@' . $character['realmName']) . '&amp;sort=time'); ?>" title="<?php echo $l->getString('template_my_forum_posts_caption'); ?>" rel="np"class="icon-posts"> </a>
					<a href="<?php echo $this->getWowUrl('vault/character/auction/' . $character['faction_text'] . '/'); ?>" title="<?php echo $l->getString('template_browse_auction_caption'); ?>" rel="np" class="icon-auctions" > </a>
					<a href="<?php echo $this->getWowUrl('vault/character/event'); ?>" title="<?php echo $l->getString('template_browse_events_caption'); ?>" rel="np" class="icon-events link-last"> </a>
				</div>
			</div>
			<div class="character-list">
				<div class="primary chars-pane">
					<div class="char-wrapper">
						<a href="<?php echo $character['url']; ?>" class="char pinned" rel="np">
							<span class="pin"></span>
							<span class="name"><?php echo $character['name']; ?></span>
							<span class="class wow-class-<?php echo $character['class']; ?>"><?php echo $l->extraFormat('template_charinfo_plate', array('racename' => $character['race_text'], 'classname' => $character['class_text'], 'level' => $character['level'])); ?></span>
							<span class="realm up"><?php echo $character['realmName']; ?></span>
						</a>
						<?php
						$chars_text = '';
						if ($characters) :
							$id = 1;
							foreach ($characters as $char) : if ($char['guid'] == $character['guid'] && $char['realmId'] == $character['realmId']) continue; ?>
						<a href="<?php echo $char['url']; ?>" onclick="CharSelect.pin(<?php echo $id; ?>, this); return false;" class="char " rel="np">
								<span class="pin"></span>
								<span class="name"><?php echo $char['name']; ?></span>
								<span class="class wow-class-<?php echo $char['class']; ?>"><?php echo $l->extraFormat('template_charinfo_plate', array('racename' => $char['race_text'], 'classname' => $char['class_text'], 'level' => $char['level'])); ?></span>
								<span class="realm up"><?php echo $char['realmName']; ?></span>
						</a>
						<?php
						$chars_text .= '<a href="' . $char['url'] . '" class="wow-class-' . $char['class'] . '" rel="np" onclick="CharSelect.pin(' . $id . ', this); return false;" data-tooltip="' . $char['race_text'] . ' ' . $char['class_text'] . ' (' . $char['realmName'] . ')">
								<span class="icon-frame frame-14 ">
										<img src="' . CLIENT_FILES_PATH . '/wow/static/local-common/images/wow/race/' . $char['race'] . '-' . $char['gender'] . '.jpg" alt="" width="14" height="14" />
										<span class="frame"></span>
								</span>
								<span class="icon-frame frame-14 ">
										<img src="' . CLIENT_FILES_PATH . '/wow/static/local-common/images/wow/class/' . $char['class'] . '.jpg" alt="" width="14" height="14" />
										<span class="frame"></span>
								</span>
								' . $char['level'] . ' ' . $char['name'] . '
							</a>' . NL;
						?>
						<?php ++$id; endforeach; endif; ?>
					</div>
					<a href="javascript:;" class="manage-chars" onclick="CharSelect.swipe('in', this); return false;">
						<span class="plus"></span><?php echo $l->getString('template_manage_characters_caption'); ?>
					</a>
				</div>
				<div class="secondary chars-pane" style="display: none">
					<div class="char-wrapper scrollbar-wrapper" id="scroll">
						<div class="scrollbar">
							<div class="track"><div class="thumb"></div></div>
						</div>
						<div class="viewport">
							<div class="overview">
								<a href="<?php echo $character['url']; ?>" class="wow-class-<?php echo $character['class']; ?> pinned" rel="np" data-tooltip="<?php echo $character['race_text'] . ' ' . $character['class_text'] . ' (' . $character['realmName'] . ')'; ?>">
									<span class="icon-frame frame-14 ">
									<img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/images/wow/race/<?php echo $character['race'] . '-' . $character['gender']; ?>.jpg" alt="" width="14" height="14" />
									<span class="frame"></span>
									</span>
									<span class="icon-frame frame-14 ">
									<img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/local-common/images/wow/class/<?php echo $character['class']; ?>.jpg" alt="" width="14" height="14" />
									<span class="frame"></span>
									</span><?php echo $character['level'] . ' ' . $character['name']; ?>
								</a>

								<?php echo $chars_text; ?>
								<div class="no-results hide"><?php echo $l->getString('template_characters_not_found'); ?></div>
							</div>
						</div>
					</div>
					<div class="filter">
						<input type="input" class="input character-filter" value="<?php echo $l->getString('template_filter_caption'); ?>" alt="<?php echo $l->getString('template_filter_caption'); ?>" /><br />
						<a href="javascript:;" onclick="CharSelect.swipe('out', this); return false;"><?php echo $l->getString('template_back_to_characters_list'); ?></a>
					</div>
				</div>
			</div>
		</div>
		<a href="<?php echo $character['url']; ?>" class="context-link wow-class-<?php echo $character['class']; ?>" rel="np">
        	<?php echo $character['name']; ?>
        </a>
    </div>
	<div class="userCharacter">
		<div class="character-desc">
			<span class="wow-class-<?php echo $character['class']; ?>"><?php echo $l->extraFormat('template_charinfo_plate', array('racename' => $character['race_text'], 'classname' => $character['class_text'], 'level' => $character['level'])); ?></span>
		</div>
		<?php if ($character['guildId'] > 0) : ?>
		<div class="guild">
			<a href="<?php echo $character['guildUrl']; ?>"><?php echo $character['guildName']; ?></a>
		</div>
		<?php endif; ?>
		<div class="achievements">4365</div>
	</div>
</div>