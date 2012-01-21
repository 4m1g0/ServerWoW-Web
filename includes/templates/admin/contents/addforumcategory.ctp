<h3>Add Category</h3>
<?php
$cats = $admin->getForumCategories();
?>
<form action="" method="post">
<div class="input text long">
Title
<input type="text" name="cat[title]" value="" size=50 />
</div>
<div class="input checkbox">
<br/><input type="checkbox" name="cat[header]" id="header" value="1" /> <label for="header">This category is main category</label><br/><br/>
</div>
<div class="input select">
Parent Category
<select name="cat[parent_cat]">
<option value="0">-None-</option>
<?php foreach ($cats as $c) : ?>
<option value="<?php echo $c['cat_id']; ?>"><?php echo $c['title']; ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="input checkbox">
<br/><input type="checkbox" name="cat[short]" id="short" value="1" /> <label for="short">Small box</label><br/><br/>
</div>
<div class="input checkbox">
<input type="checkbox" name="cat[realm_cat]" id="realm_cat" value="1" /> <label for="realm_cat">Realm Category</label><br/><br/>
</div>
<div class="input checkbox">
<input type="checkbox" name="cat[banned_flag_allow_topics]" id="banned_flag_allow_topics" value="1" /> <label for="banned_flag_allow_topics">Allow banned users start new topics</label><br/><br/>
</div>
<div class="input checkbox">
<input type="checkbox" name="cat[banned_flag_allow_posts]" id="banned_flag_allow_posts" value="1" /> <label for="banned_flag_allow_posts">Allow banned users answer to created topics</label><br/><br/>
</div>
<div class="input text long">
GM Level Access:
<input type="text" name="cat[gmlevel]" value="0" size=50 />
</div>
<div class="input text long">
Description
<input type="text" name="cat[desc]" value="" size=50 />
</div>
<div class="input text long">
Icon
<input type="text" name="cat[icon]" value="" size=50 />
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>