<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf8" />
        <title>World of Warcraft Admin Panel</title>

        <link rel="stylesheet" type="text/css" href="/admin/css/common.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="/admin/css/style.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="/admin/css/style-ie.css" media="all"/>
		<link href="http://fonts.googleapis.com/css?family=PT+Serif&subset=cyrillic&v2" rel="stylesheet" type="text/css">

		<script language="javascript" type="text/javascript" src="/admin/js/third-party/ckeditor/ckeditor.js">
		</script>
        <script type="text/javascript" src="/admin/js/jquery-1.4.2.min.js">
        </script>
        <script type="text/javascript" src="/admin/js/jquery-ui.min.js">
        </script>
	</head>
<body>
	<div id="gp-map" style="height:100%; width:100%">
		<div class="admin-bar">
			<a href="/admin/">Main</a>
			<a href="/admin/news">Manage News</a>
			<a href="/admin/configs">Edit Configs</a>
			<a href="/admin/forums">Manage Forums</a>
			<a href="/admin/users">Manage Users</a>
			<a href="/admin/store">Manage Store</a>
		</div>
		<div class="info-col">
			<div class="contents">
			</div>
			<div class="map-col">
				<div id="map" style="width: 100%; height: 100%"></div>
			</div>
			<div class="edit">
				<div class="contents">
					<?php echo $this->region('adminpage'); ?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>