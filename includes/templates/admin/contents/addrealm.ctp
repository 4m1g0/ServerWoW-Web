<h3>Edit Configs</h3>
<a href="/admin/configs/site">Site Configs</a> | 
<a href="/admin/configs/realms">Realms</a> | 
<a href="/admin/configs/mysql">MySQL</a>
<br />
<a href="/admin/configs/realms/add">Add New</a>
<hr />
<form action="" method="post">
<input type="hidden" name="realm[isNew]" value="true" />
<div class="input text long">
Realm Name
<input type="text" size=50 name="realm[name]" value="" />
</div>
<div class="input select">
Realm Type
<select name="realm[type]">
<option value="SERVER_TRINITY">Trinity</option>
<option value="SERVER_MANGOS">MaNGOS</option>
</select>
</div>
<hr />
<div class="input text long">
Characters Database Host
<input type="text" size=50 name="mysql[character][host]" value="" />
</div>
<div class="input text long">
Characters Database User
<input type="text" size=50 name="mysql[character][user]" value="" />
</div>
<div class="input text long">
Characters Database Password
<input type="text" size=50 name="mysql[character][password]" value="" />
</div>
<div class="input text long">
Characters Database DB Name
<input type="text" size=50 name="mysql[character][db_name]" value="" />
</div>
<div class="input text long">
Characters Database Charset
<input type="text" size=50 name="mysql[character][charset]" value="" />
</div>
<div class="input text long">
Characters Database Driver (mysql or mysqli)
<input type="text" size=50 name="mysql[character][driver]" value="" />
</div>
<div class="input text long">
Characters Database Prefix (Leave Empty)
<input type="text" size=50 name="mysql[character][prefix]" value="" />
</div>
<hr />
<div class="input text long">
World Database Host
<input type="text" size=50 name="mysql[world][host]" value="" />
</div>
<div class="input text long">
World Database User
<input type="text" size=50 name="mysql[world][user]" value="" />
</div>
<div class="input text long">
World Database Password
<input type="text" size=50 name="mysql[world][password]" value="" />
</div>
<div class="input text long">
World Database DB Name
<input type="text" size=50 name="mysql[world][db_name]" value="" />
</div>
<div class="input text long">
World Database Charset
<input type="text" size=50 name="mysql[world][charset]" value="" />
</div>
<div class="input text long">
World Database Driver (mysql or mysqli)
<input type="text" size=50 name="mysql[world][driver]" value="" />
</div>
<div class="input text long">
World Database Prefix (Leave Empty)
<input type="text" size=50 name="mysql[world][prefix]" value="" />
</div>
<div class="input text long">
<input type="submit" value="Save" size=50 />
</div>
</form>