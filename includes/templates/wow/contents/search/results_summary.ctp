<?php
$bg = $this->c('Config')->getValue('site.battlegroup');
?>
<div class="summary">
		<?php
		$chars = $search->getResults('wowcharacter');
		if ($chars) : ?>
		<div class="results results-grid wow-results">
	<h3 class="category "><a href="?q=<?php echo $search->getQuery(); ?>&amp;f=wowcharacter"><?php echo $l->getString('template_search_results_characters'); ?></a>
				(<?php echo $search->getCounters('wowcharacter'); ?>)
</h3>

	<?php
	$count = 0;
	$broke = false;
	foreach ($chars as $realm) :
		if ($broke)
			break;
		foreach ($realm as $c) :
		if ($count >= 3)
		{
			$broke = true;
			break;
		}
	?>

	<div class="grid">

		<div class="wowcharacter">

				<a href="<?php echo $c['url']; ?>" class="icon-frame frame-56 thumbnail">
					<img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/2d/avatar/<?php echo $c['race']. '-' . $c['gender']; ?>.jpg" alt="" width="56" height="56" />
				</a>

				<a href="<?php echo $c['url']; ?>" class="color-c<?php echo $c['class']; ?>">
					<strong><?php echo $c['name']; ?></strong>
				</a><br />

				<?php echo $c['level'] . ' ' . $c['race_text'] . ' ' . $c['class_text']; ?><br />
				<?php echo $c['realmName']; ?>


	<span class="clear"><!-- --></span>
		</div>
	</div>
	<?php ++$count; endforeach; endforeach; ?>

	<span class="clear"><!-- --></span>
		</div>
		<?php
		endif;
		?>

		<?php
		$guilds = $search->getResults('wowguild');
		$items = $search->getResults('wowitem');
		if ($guilds || $items) :
		?>
		<div class="results results-grid wow-results">
		<?php
		if ($guilds) :
			$key = array_keys($guilds);
			$guild = $guilds[$key[0]][0];
		?>
	<div class="grid">
	<h4 class="subcategory "><a href="?q=<?php echo $search->getQuery(); ?>&amp;f=wowguild"><?php echo $l->getString('template_search_results_guilds'); ?></a> (<?php echo $search->getCounters('wowguild'); ?>)</h4>
		<div class="wowguild">

				<canvas id="tabard-<?php echo $guild['guildid']; ?>" class="thumbnail" width="32" height="32"></canvas>

				<a href="<?php echo $guild['url']; ?>" class="sublink">
					<strong><?php echo $guild['name']; ?></strong>
				</a>
				- <?php echo $l->getString('faction_' . $guild['faction_text']); ?><br />

					<?php echo $guild['realmName'] . ' / ' . $bg; ?>

        <script type="text/javascript">

        //<![CDATA[

					$(function(){
						var tabard<?php echo $guild['guildid']; ?> = new GuildTabard('tabard-<?php echo $guild['guildid']; ?>', {
							ring: '<?php echo $guild['faction_text']; ?>',
							bg: [ 0, '2' ],
							border: [ '0', '16' ],
							emblem: [ '60', '16' ]
						});
					});
        //]]>

        </script>

	<span class="clear"><!-- --></span>
		</div>
	</div>
	<?php
	endif;
	if ($items):
		$key = array_keys($items);
		$item = $items[$key[0]];
	?>
	<div class="grid">
	<h4 class="subcategory "><a href="?q=<?php echo $search->getQuery(); ?>&amp;f=wowitem"><?php echo $l->getString('template_search_results_items'); ?></a> (<?php echo $search->getCounters('wowitem'); ?>)</h4>
		<div class="wowitem">
			<a href="<?php echo $this->getWowUrl('item/' . $item['entry']); ?>" class="thumbnail">
				<span class="icon-frame frame-32 ">
					<img src="<?php echo $this->c('Config')->getValue('site.icons_server'); ?>/36/<?php echo $item['icon']; ?>.jpg" alt="" width="32" height="32" />
				</span>
			</a>

			<a href="<?php echo $this->getWowUrl('item/' . $item['entry']); ?>" class="color-q<?php echo $item['Quality']; ?>">
				<strong><?php echo $item['name']; ?></strong>
			</a>
			<br />

			<?php echo $l->getString('template_js_ilvl') . ' ' . $item['ItemLevel']; ?>

			<span class="clear"><!-- --></span>
		</div>
	</div>
		<?php endif; ?>

	<span class="clear"><!-- --></span>

		</div>
		<?php
		endif;

		$ateams = $search->getResults('wowarenateam');
		if ($ateams) : ?>
		<div class="results results-grid wow-results">
		<?php
		$keys = array_keys($ateams);
		$a = $ateams[$keys[0]][0]; ?>
	<div class="grid">
	<h4 class="subcategory ">				<a href="?q=<?php echo $search->getQuery(); ?>&amp;f=wowarenateam"><?php echo $l->getString('template_search_results_arenateams'); ?></a>
				(<?php echo $search->getCounters('wowarenateam'); ?>)
</h4>

		<div class="wowarenateam">

				<canvas id="banner-<?php echo $a['arenaTeamId']; ?>" class="thumbnail" width="32" height="32"></canvas>

				<a href="<?php echo $a['url']; ?>" class="sublink">
					<strong><?php echo $a['name']; ?></strong>
				</a>
				- <?php echo $a['type_text']; ?><br />
				<?php echo $a['realmName'] . ' / ' . $bg; ?>

        <script type="text/javascript">
        //<![CDATA[
					$(function(){
						var flag<?php echo $a['arenaTeamId']; ?> = new ArenaFlag('banner-<?php echo $a['arenaTeamId']; ?>', {
							bg: [ '2', 'ff0c0c0b' ],
							border: [ '22', 'ffc3c7c1' ],
							emblem: [ '55', 'ffcdd9cb' ]
						});
					});
        //]]>
        </script>


	<span class="clear"><!-- --></span>
		</div>
	</div>

	<span class="clear"><!-- --></span>
		</div> <?php endif; ?>

		<?php
		$static = $search->getResults('static');
		if ($static) :
		?>
		<div class="results results-grid static-results">
	<h3 class="category ">				<a href="?q=<?php echo $search->getQuery(); ?>&amp;f=static"><?php echo $l->getString('template_search_results_static'); ?></a>
				(<?php echo $search->getCounters('static'); ?>)
</h3>

	<?php
	$count = 0;
	foreach ($static as $s) : if ($count >= 3) break; ?>
	<div class="grid">

		<div class="static">


				<a href="<?php echo $s['url']; ?>">
					<strong><?php echo $s['title']; ?></strong>
				</a>


	<span class="clear"><!-- --></span>
		</div>
	</div>
	<?php ++$count; endforeach; ?>

	<span class="clear"><!-- --></span>
		</div>
		<?php endif; ?>





		<?php
		$blogs = $search->getResults('article');
		if ($blogs) :
		?>
		<div class="results results-grid article-results">
	<h3 class="category ">				<a href="?q=<?php echo $search->getQuery(); ?>&amp;f=article"><?php echo $l->getString('template_search_results_articles'); ?></a>
				(<?php echo $search->getCounters('article'); ?>)
</h3>


	<?php
	$count = 0;
	foreach ($blogs as $b) : if ($count >= 3) break; ?>
	<div class="grid">

		<div class="article">


		<a href="<?php echo $b['url']; ?>" class="thumbnail">
			<span class="icon-frame frame-32">
				<img src="<?php echo CLIENT_FILES_PATH; ?>/cms/blog_thumbnail/<?php echo $b['image_small']; ?>" alt="" width="32" height="32" />
			</span>
		</a>

					<a href="<?php echo $b['url']; ?>">
						<strong><?php echo $b['title']; ?></strong>
					</a><br />

						<?php echo $b['comments_count']; ?> comments


	<span class="clear"><!-- --></span>
		</div>
	</div>
	<?php ++$count; endforeach; ?>

	<span class="clear"><!-- --></span>
		</div>
	<?php endif; ?>
	
	<?php
	$forums = $search->getResults('post');
	if ($forums) :
	?>


			<div class="results post-results">
	<h3 class="category ">					<a href="?q=<?php echo $search->getQuery(); ?>&amp;f=post"><?php echo $l->format('template_search_results_post', $search->getQuery()); ?></a>
					(<?php echo $search->getCounters('post'); ?>)
</h3>


	<?php
	$count = 0;
	foreach ($forums as $f) : if ($count >= 5) break; ?>
	<div class="result ">
	<h4 class="subcategory ">
			<a href="<?php echo $f['url']; ?>"><?php echo $f['title']; ?></a> 

			<span class="small">(<?php echo $f['replies']; ?> replies)</span>
</h4>

		<div class="meta">
			<a href="<?php echo $f['cat_url']; ?>" class="sublink"><?php echo $f['cat_title']; ?></a> -

			Posted by <a href="<?php echo $this->getWowUrl('search?sort=time&amp;a=' . urlencode($f['author_name'] . '@' . $f['author_realm'])); ?>" class="author">
			<?php echo $f['author_name']; ?>
		</a> on <?php echo $f['post_date']; ?>
		</div>

		<div class="content">
			<?php echo $f['post_preview']; ?>
		</div>

	<span class="clear"><!-- --></span>
	</div>
	<?php ++$count; endforeach; ?>

					<div class="view-all">
						<a href="?q=<?php echo $search->getQuery(); ?>&amp;f=post" class="sublink">View all forum results</a>
					</div>
			</div>
			<?php endif; ?>
	</div>