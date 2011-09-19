<?php
if (!$items) return;

foreach ($items as $item) :
?>
	echo '<div class="featured">
	            <a href="<?php echo $this->getWowUrl('blog/' . $item['id']); ?>#blog">
	               <span class="featured-img" style="background-image: url('<?php echo CLIENT_FILES_PATH; ?>/cms/blog_thumbnail/<?php echo $item['image'];?>');"><span class="featured-img-frame"></span></span>
	               <span class="featured-desc"><?php echo $items['title']; ?></span>
	            </a>
	        </div>
<?php echo NL; endforeach; ?>