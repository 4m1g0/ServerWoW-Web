<?php
if (!$items) return;

$size = min(4, sizeof($items));

for ($i = 0; $i < $size; ++$i)
	echo '<div class="featured">
	            <a href="' . $this->getWowUrl('blog/' . $items[$i]['id']) . '#blog">
	               <span class="featured-img" style="background-image: url(\'' . CLIENT_FILES_PATH . '/cms/blog_thumbnail/' . $items[$i]['image'] . '\');"><span class="featured-img-frame"></span></span>
	               <span class="featured-desc">' . $items[$i]['title'] . '</span>
	            </a>
	        </div>' . NL;
?>