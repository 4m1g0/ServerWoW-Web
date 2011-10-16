<?php if (!isset($post) || !$post) return;
$d = array('name' => '', 'detail' => '');
if ($post['blizzpost'] && $post['blizz_name'])
	$d['name'] = $post['blizz_name'];
else
	$d['name'] = $post['name'];
$d['detail'] = $post['message'];
echo json_encode($d);
?>