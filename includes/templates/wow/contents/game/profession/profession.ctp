<?php if (!$prof) return; ?>
	<div id="wiki" class="wiki wiki-profession">
		<div class="sidebar">
	<table class="media-frame">
		<tr>
			<td class="tl"></td>
			<td class="tm"></td>
			<td class="tr"></td>
		</tr>
		<tr>
			<td class="ml"></td>
			<td class="mm">
			<span class="view"></span>
			<img src="<?php echo CLIENT_FILES_PATH; ?>/wow/static/images/wiki/profession/thumbnails/<?php echo $prof['info']['key']; ?>.jpg" width="265" alt="" />
			</td>
			<td class="mr"></td>
		</tr>
		<tr>
			<td class="bl"></td>
			<td class="bm"></td>
			<td class="br"></td>
		</tr>
	</table>



	<div class="snippet">
			<h3>Ventajas y beneficios</h3>


        <ul class="fact-list perks">

		<?php
		if ($prof['bonuses']) : 
			foreach ($prof['bonuses'] as $b) :
		?>
                <li>
		<span class="icon-frame frame-14 ">
			<img src="<?php echo $this->getMediaServer(); ?>/wow/icons/18/<?php echo $b['icon']; ?>.jpg" alt="" width="14" height="14" />
		</span>

						<strong><?php echo $b['name']; ?></strong>

                    <?php echo $b['desc']; ?>
                </li>
		<?php endforeach; endif; ?>
        </ul>

	</div>

	<?php
	if ($prof['related']) : ?>
	<div class="snippet">
			<h3>Profesiones relacionadas</h3>
            <div class="related-professions">
			<?php foreach ($prof['related'] as $r) : ?>
                <a class="profession" href="<?php echo $this->getWowUrl('profession/' . $r['prof_key']); ?>">
		<span  class="icon-frame frame-56 circle-frame" style='background-image: url("<?php echo $this->getMediaServer(); ?>/wow/icons/56/<?php echo $r['icon']; ?>.jpg");'>
		</span>
                        <strong><?php echo $r['prof_name']; ?></strong>

                            <span>
                                <?php echo $r['prof_desc']; ?>
                            </span>
                    </a>
				<?php endforeach; ?>
            </div>
        
	</div>
	<?php endif; ?>

	<div class="snippet">
			<h3>Más información</h3>

		<span id="fansite-links"></span>
        <script type="text/javascript">
        //<![CDATA[
			$(function() {
				Fansite.generate('#fansite-links', "skill|<?php echo $prof['info']['id'] . '|' . $prof['info']['name']; ?>");
			});
        //]]>
        </script>
	</div>
		</div>

		<div class="info">

		<div class="title">
			<h2>




		<span  class="icon-frame frame-56 circle-frame" style='background-image: url("<?php echo $this->getMediaServer(); ?>/wow/icons/56/<?php echo $prof['info']['icon']; ?>.jpg");'>
		</span>
				<?php echo $prof['info']['name']; ?>
	<span class="clear"><!-- --></span>
			</h2>


	<?php
	$exp = array('inscription' => 2, 'jewelcrafting' => 1, 'archaeology' => 3);
	if (isset($exp[$prof['info']['key']])) :
	?>
	<span class="expansion-name color-ex<?php echo $exp[$prof['info']['key']]; ?>">
		<span class="color-ex<?php echo $exp[$prof['info']['key']]; ?>">Requiere <?php echo $l->getString('template_expansion_' . $exp[$prof['info']['key']]) ?></span>
	</span>
	<?php endif; ?>
		</div>

		<p class="intro">
			<?php echo $prof['info']['intro']; ?>
		</p>
		<div class="lore">
			<?php echo $prof['info']['desc']; ?>
		</div>



	<div class="panel">
		<div class="panel-title">Instrucciones</div>

		<ul class="how-to">
				<?php echo $prof['info']['howto']; ?>
		</ul>
	</div>

		</div>

	<span class="clear"><!-- --></span>
        <script type="text/javascript">
        //<![CDATA[
				$(function() {
					Wiki.pageUrl = '<?php echo $this->getWowUrl('profession/' . $prof['info']['key']); ?>/';
				});
        //]]>
        </script>
	</div>