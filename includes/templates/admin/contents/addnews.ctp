<?php
$item = isset($_POST['news']) ? $_POST['news'] : null;
?>
<h3>News</h3>
<p><a href="/admin/news/add">Add New Item</a> | <a href="/admin/news/deleteAll" onclick="javascript:return confirm('Delete all news? Are you sure?');">Delete All</a></p>
<hr />
<p>
<form action="" method="post" enctype="multipart/form-data">
<div class="input text long">
Title
<input type="text" name="news[title]" size="50" value="<?php echo is_array($item) ? $item['title'] : null; ?>" />
</div>
<div class="input file">
Image
<input type="file" name="news[image]" size="50" />
</div>
<div class="input file">
Header Image
<input type="file" name="news[header_image]" size="50" />
</div>
<div class="input text long">
Small Text<br />
<textarea class="textarea" name="news[desc]" cols=46 rows=8><?php echo is_array($item) ? $item['desc'] : null; ?></textarea>
</div>
<div class="input text long">
Carousel Text<br />
<input type="text" name="carousel[text]" size="50" value="<?php if (isset($_POST['carousel']['text'])) echo $_POST['carousel']['text']; ?>" />
</div>
<div class="input text long">
Text<br />
<textarea class="ckeditor" id="ckeditor" name="editor1"><?php echo isset($item['text']) ? $item['text'] : null; ?></textarea>
</div>
<div class="input checkbox">
<br />
<input id="carouselActive" type="checkbox" name="carousel[active]" value="1" checked="checked" /><label for="carouselActive">Carousel Active</label>
<br />
</div><br />
<div class="input text long">
Tags (separate with commas)
<input type="text" name="news[tags]" size="50" value="<?php echo isset($item['tags']) ? $item['tags'] : null; ?>" />
</div>
<div class="input checkbox">
<br />
<input id="communityPage" type="checkbox" name="news[community]" value="1" checked="checked" /><label for="communityPage">Add to Community page</label>
<br />
</div><br />
<div class="input checkbox">
<br />
<input id="allow_comments" type="checkbox" name="news[allow_comments]" value="1" checked="checked" /><label for="allow_comments">Allow comments for this entry</label>
<br />
</div><br />
<div class="input text">
<br />
<input type="submit" value="Send" />
</div>
</form>
</p>