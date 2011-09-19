
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<title></title>

	<script>

		parent.postMessage("{\"action\":\"success\",\"loginTicket\":\"<?php echo $loginTicket; ?>\"}", "http://<?php echo $_SERVER['HTTP_HOST'] . CLIENT_FILES_PATH; ?>/");

	</script>

</head>

</html>