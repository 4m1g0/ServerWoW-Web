<?php
		if (file_exists(dirname(__FILE__)."/"."lang/".$lang.".php")) {
			include dirname(__FILE__)."/"."lang/".$lang.".php";
		} else {
			include dirname(__FILE__)."/"."lang/en.php";
		}

		foreach ($chathistory_language as $i => $l) {
			$chathistory_language[$i] = str_replace("'", "\'", $l);
		}
?>

/*
 * CometChat
 * Copyright (c) 2011 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.ccchathistory = (function () {

		var title = '<?php echo $chathistory_language[0];?>';

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id) {
				baseUrl = $.cometchat.getBaseUrl();
				baseData = $.cometchat.getBaseData();
				window.open (baseUrl+'plugins/chathistory/index.php?history='+id+'&basedata='+baseData, 'chathistory',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=1, width=600,height=500"); 
			}

        };
    })();
 
})(jqcc);