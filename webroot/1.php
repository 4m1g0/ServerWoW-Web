<?php
$youtube_url = 'http://www.youtube.com/watch?feature=player_embedded&v=OSwsJtSfyXU&custom1=asd&custom2=dsa';
$url = array();
parse_str( parse_url($youtube_url, PHP_URL_QUERY), $url );
echo 'Youtube ID: ' . $url['v'];