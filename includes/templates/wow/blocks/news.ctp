<?php
if (!$items) return;

$first = false;
foreach ($items as $item) :
?>
	<div class="news-article<?php if (!$first) echo ' first-child'; ?>">
    	<div class="news-article-inner">
			<h3>
				<a href="<?php echo $this->getWowUrl('blog/' . $item['id']); ?>#blog"><?php echo $item['title']; ?></a>
			</h3>
			<div class="by-line">
				por <a href="javascript:;"><?php echo $item['author']; ?></a>
			<span class="spacer"></span> <?php echo date('d/m/Y', $item['postdate']); ?>
			  <?php if ($item['allow_comments']): ?><a href="<?php echo $this->getWowUrl('blog/' . $item['id']); ?>#comments" class="comments-link"><?php echo $item['comments_count']; ?></a><?php endif; ?>
			</div>

	        <div class="article-left" style="background-image: url('<?php echo CLIENT_FILES_PATH; ?>/cms/blog_thumbnail/<?php echo $item['image']; ?>');">
	            <a href="<?php echo $this->getWowUrl('blog/' . $item['id']); ?>"><span class="thumb-frame"></span></a>
	        </div>

	        <div class="article-right">
	            <div class="article-summary">
	                <p><?php echo $item['desc']; ?></p>
	                <a href="<?php echo $this->getWowUrl('blog/' . $item['id']); ?>#blog" class="more">Más</a>
	            </div>
	        </div>

	<span class="clear"><!-- --></span>
        </div>
    </div><?php echo NL; $first = true; endforeach; ?>