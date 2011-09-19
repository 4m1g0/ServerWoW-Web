<?php
if (!$achievements || !$item) return;
$icons_server = $this->c('Config')->getValue('site.icons_server');
?>
<div xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" style="">
	

	<div id="cat-<?php echo $item['id']; ?>" class="container<?php if ($item['id'] == ACHIEVEMENTS_CATEGORY_FEATS) echo ' feats'; ?>">
		<h3 class="category"><?php echo $item['name']; ?></h3>

	<?php if ($item['id'] != ACHIEVEMENTS_CATEGORY_FEATS) : ?>
	<div class="profile-progress border-4" onmouseover="Tooltip.show(this, &#39;<?php echo $achievements['earnedPoints'] . ' / ' . $achievements['points'] . ' ' . $l->getString('template_feed_ach_points'); ?>&#39;, { location: &#39;middleRight&#39; });">
		<div class="bar border-4 hover" style="width: <?php echo $achievements['percent']; ?>%"></div>
		<div class="bar-contents"><?php echo $achievements['completedCount'] . ' / ' . $achievements['total'] . ' (' . ((int) $achievements['percent']) . '%)'; ?></div>
	</div>
	<?php endif; ?>
	<ul>
	<?php
	foreach ($achievements['achievements'] as &$ach) :
	if ($ach['parentAchievement'] || (!$ach['date'] && !$ach['points']))
		continue;
	$use_criterias = (isset($ach['criterias']) && $ach['criterias'] && $ach['use_criterias']);
	?>
	<li class="achievement<?php if (!isset($ach['date']) || !$ach['date']) echo ' locked'; if ($use_criterias) echo ' has-sub';  ?>" data-id="<?php echo $ach['id']; ?>" data-href="#<?php echo $ach['categoryId'] . ':a' . $ach['id']; ?>">
		<p>
			<strong><?php echo $ach['name']; ?></strong>
			<span><?php echo $ach['description']; ?></span>
		</p>

	<a href="javascript:;" data-fansite="achievement|<?php echo $ach['id']; ?>" class="fansite-link "> </a>

	<?php if ($use_criterias) : ?>
	<div class="icon-expandable"></div>
	<div class="meta-achievements">
		<?php
		$skipall = false;
		$keys = array_keys($ach['criterias']);
		if (sizeof($ach['criterias']) == 1 && $ach['criterias'][$keys[0]]['completionFlag'] & ACHIEVEMENT_CRITERIA_FLAG_SHOW_PROGRESS_BAR)
		{
			echo '<div class="profile-progress border-4 ' . ($ach['date'] ? 'completed' : '') . '">
				<div class="bar border-4 hover" style="width: ' . $ach['criterias'][$keys[0]]['percent'] . '%"></div>
				<div class="bar-contents">' . number_format($ach['criterias'][$keys[0]]['counter']) . ' / ' . number_format($ach['criterias'][$keys[0]]['value']) . ' (' . ((int) $ach['criterias'][$keys[0]]['percent']) . '%)</div>
			</div>';
			$skipall = true;
		}
		if (!$skipall) :
		?>
				<ul<?php if (isset($ach['ach_criterias']) && $ach['ach_criterias']) echo ' class="sub-achievements"'; ?>>
				<?php
					foreach ($ach['criterias'] as &$meta) :
						if($meta['referredAchievement'] == $ach['id'] && (isset($ach['ach_criterias']) && $ach['ach_criterias']))
							continue;
				?>
					<?php if (isset($meta['is_ach']) && $meta['is_ach']) : ?>
					<li data-achievement="<?php echo $meta['ach_id']; ?>">
						<span  class="icon-frame frame-36 " style='background-image: url("<?php echo $icons_server; ?>/36/<?php echo $meta['iconname']; ?>.jpg");'> </span>
						<span class="points border-3"><?php echo $meta['points']; ?></span>
					</li>
					<?php else : ?>
					<li class="<?php if (isset($meta['date']) && $meta['date']) echo 'unlocked'; ?> linked">
						<?php if ($meta['requiredType'] == 8 && isset($meta['achievementInfo'])) : ?>
						<a href="achievement#<?php echo $ach['categoryId'] . ':' . $meta['achievementInfo']['categoryId'] . ':a' . $meta['achievementInfo']['id']; ?>" onclick="location.hash = '<?php echo $ach['categoryId'] . ':' . $meta['achievementInfo']['categoryId'] . ':a' . $meta['achievementInfo']['id']; ?>'; dm.openEntry(true)">
						<span  class="icon-frame frame-18 " style='background-image: url("<?php echo $icons_server; ?>/18/<?php echo $meta['achievementInfo']['iconname']; ?>.jpg");'> </span><?php echo $meta['achievementInfo']['name']; ?></a>
						<?php else : ?>
						<?php echo $meta['name'] ? $meta['name'] : $ach['name']; endif; ?>
					</li>
					<?php endif; endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

	<?php endif; ?>

		<span class="icon-frame frame-50 ">
			<img src="<?php echo $icons_server; ?>/56/<?php echo $ach['iconname']; ?>.jpg" alt="" width="50" height="50" />
		</span>

	<div class="points-big border-8">
		<strong><?php echo $ach['points']; ?></strong>

		<?php if ($ach['date']) : ?>
		<span class="date">
			<?php echo date('d/m/Y', $ach['date']); ?>
		</span>
		<?php endif; ?>
	</div>

	<?php if ($ach['titleReward'] != null) : ?>
	<div class="reward"><?php echo $ach['titleReward']; ?></div>
	<?php endif; ?>

	</li>
	<?php endforeach; ?>
	
	</ul>

	</div>

</div>