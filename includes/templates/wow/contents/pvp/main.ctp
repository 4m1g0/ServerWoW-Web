<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/7727819/ServerWoW:PvP-Bloque_Lateral_Izquierdo:Abajo', [200, 200], 'div-gpt-ad-1328880547085-0').addService(googletag.pubads());
googletag.defineSlot('/7727819/ServerWoW:PvP-Centro:Arriba', [728, 90], 'div-gpt-ad-1328848630388-1').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<?php
$bg = $this->c('Config')->getValue('site.battlegroup');
?>
<div class="content-header">
	<h2 class="header ">PvP</h2>
	<span class="clear"><!-- --></span>
	</div>

	<div class="pvp pvp-summary">
		<div class="pvp-right">
			<div class="top-title">
				<h3 class="category ">Mejores Equipos de Arenas</h3>
				<center>
<!-- ServerWoW:PvP-Centro:Arriba -->
<div id='div-gpt-ad-1328848630388-1' style='width:728px; height:90px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1328848630388-1'); });
</script>
</div>
</center>
				<span class="clear"><!-- --></span>
			</div>
			<div class="top-teams">
			<?php
			$types = array(2, 3, 5);
			$styles = array('first', 'second', 'third');
			$ladder = $pvp->getLadderTops();
			foreach ($types as $type) :
				$format = $type . 'v' . $type;
			?>
				<div class="column top-<?php echo $format; ?>">
					<h2><a href="<?php echo $this->getWowUrl('pvp/arena/' . $bg . '/' . $format); ?>"><?php echo $l->format('template_team_type_format', $type, $type); ?></a></h2>
						<ul>
							<?php
							if (isset($ladder[$type]) && $ladder[$type]) :
								$count = 0;
								foreach ($ladder[$type] as $t) :
							?>
							<li class="<?php echo $styles[$count]; ?>">
								<span class="ranking"><?php echo $t['rank']; ?></span>

								<div class="name">
									<a href="<?php echo $t['url']; ?>"><?php echo $t['name']; ?></a>
								</div>
								
								<div class="rating-realm">
								<span class="rating"><?php echo $t['rating']; ?></span>
								<span class="realm"><?php echo $t['realmName']; ?></span>
								</div>

								<!--
								<div class="members">
									<a href="/wow/ru/character/alakir/%C3%9Feast/">
										<span class="icon-frame frame-14 ">
											<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/class_8.jpg" alt="" width="14" height="14" />
										</span>
									</a>
								</div> -->
							</li>
							<?php ++$count; endforeach; endif; ?>
						</ul>
						<a href="<?php echo $this->getWowUrl('pvp/arena/' . $bg . '/' . $format); ?>" class="all"><?php echo $l->format('template_pvp_browse_rating_caption', $type, $type); ?></a>
				</div>
			<?php endforeach; ?>
	<span class="clear"><!-- --></span>
			</div>
		</div>

		<div class="pvp-left">
<script type='text/javascript'>
(function() {
var useSSL = 'https:' == document.location.protocol;
var src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt.js';
document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
})();
</script>
			<ul class="dynamic-menu" id="menu-pvp">
				<li class="root-item item-active">
					<a href="<?php echo $this->getWowUrl('pvp/'); ?>">
						<span class="arrow"><?php echo $l->getString('template_pvp_arena_summary'); ?></span>
					</a>
				</li>
				<?php
				$types = array(2, 3, 5);
				foreach ($types as $t):
				?>
				<li>
					<a href="<?php echo $this->getWowUrl('pvp/arena/' . $bg . '/' . $t . 'v' . $t); ?>">
						<span class="arrow"><?php echo $l->format('template_team_type_format', $t, $t); ?></span>
					</a>
				</li>
				<?php endforeach; ?>
				<li>
<br>
<center>
<!-- ServerWoW:PvP-Bloque_Lateral_Izquierdo:Abajo -->
<div id='div-gpt-ad-1328880547085-0' style='width:200px; height:200px;'>
<script type='text/javascript'>
googletag.display('div-gpt-ad-1328880547085-0');
</script>
</div>
</center>
</li>
			</ul>
		</div>
<span class="clear"><!-- --></span>
</div>