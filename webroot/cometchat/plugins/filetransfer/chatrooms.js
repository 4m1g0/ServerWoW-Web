<?php
		if (file_exists(dirname(__FILE__)."/"."lang/".$lang.".php")) {
			include dirname(__FILE__)."/"."lang/".$lang.".php";
		} else {
			include dirname(__FILE__)."/"."lang/en.php";
		}

		foreach ($filetransfer_language as $i => $l) {
			$filetransfer_language[$i] = str_replace("'", "\'", $l);
		}
?>

/*
 * CometChat
 * Copyright (c) 2011 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.ccfiletransfer = (function () {

		var title = '<?php echo $filetransfer_language[0];?>';

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id) {
				baseUrl = getBaseUrl();
				window.open (baseUrl+'plugins/filetransfer/index.php?chatroommode=1&id='+id, 'filetransfer',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=0, width=400,height=170"); 
			}

        };
    })();
 
})(jqcc);