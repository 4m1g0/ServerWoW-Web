<?php
		if (file_exists(dirname(__FILE__)."/"."lang/".$lang.".php")) {
			include dirname(__FILE__)."/"."lang/".$lang.".php";
		} else {
			include dirname(__FILE__)."/"."lang/en.php";
		}

		foreach ($transliterate_language as $i => $l) {
			$transliterate_language[$i] = str_replace("'", "\'", $l);
		}
?>

/*
 * CometChat
 * Copyright (c) 2011 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.cctransliterate = (function () {

		var title = '<?php echo $transliterate_language[0];?>';

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id) {
				baseUrl = getBaseUrl();
				window.open (baseUrl+'plugins/transliterate/index.php?chatroommode=1&id='+id, 'transliterate',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=0, width=430,height=220"); 
			}

        };
    })();
 
})(jqcc);