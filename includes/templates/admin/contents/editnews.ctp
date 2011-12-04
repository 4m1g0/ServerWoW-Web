
<?php
$item = $admin->getNewsItem();
if ($item) :
?>
<h3>News</h3>
<p><a href="/admin/news/add">Add New Item</a> | <a href="/admin/news/deleteAll" onclick="javascript:return confirm('Delete all news? Are you sure?');">Delete All</a> | <a href="/admin/news/delete/<?php echo $item['id']; ?>" onclick="javascript:return confirm('Delete current? Are you sure?');">Delete Current</a> </p>
<hr />
<p>
<form action="" method="post">
<div class="input text long">
Title
<input type="text" name="news[title]" size="50" value="<?php echo is_array($item) ? $item['title'] : null; ?>" />
</div>
<div class="input text long">
Image
<input type="text" name="news[image]" value="<?php echo $item['image']; ?>" size="50" />
</div>
<div class="input text long">
Header Image
<input type="text" name="news[header_image]" size="50" value="<?php echo $item['header_image']; ?>" />
</div>
<div class="input text long">
Small Text<br />
<textarea class="textarea" name="news[desc]" cols=46 rows=8><?php echo $item['desc']; ?></textarea>
</div>
<div class="input text long">
Carousel Text<br />
<input type="text" name="carousel[text]" size="50" value="<?php echo $item['carouselDesc']; ?>" />
</div>
<div class="input text long">
Text<br />
<textarea class="ckeditor" id="ckeditor" name="editor1"><?php echo $item['text']; ?></textarea>
</div>
<div class="input checkbox">
<br />
<input id="carouselActive" type="checkbox" name="carousel[active]" value="1"<?php if ($item['active']) echo ' checked="checked"'; ?> /><label for="carouselActive">Carousel Active</label>
<br />
</div><br />
<div class="input text long">
Tags (separate with commas)
<input type="text" name="news[tags]" size="50" value="<?php echo $item['tags']; ?>" />
</div>
<div class="input checkbox">
<br />
<input id="communityPage" type="checkbox" name="news[community]" value="1"<?php if ($item['community'] == 1) echo ' checked="checked"'; ?> /><label for="communityPage">Add to Community page</label>
<br />
</div><br />
<div class="input checkbox">
<br />
<input id="allow_comments" type="checkbox" name="news[allow_comments]" value="1"<?php if ($item['allow_comments'] == 1) echo ' checked="checked"'; ?> /><label for="allow_comments">Allow comments for this entry</label>
<br />
</div><br />
<div class="input text">
<br />
<input type="submit" value="Send" />
</div>
</form>
<?php endif; ?>
</p>