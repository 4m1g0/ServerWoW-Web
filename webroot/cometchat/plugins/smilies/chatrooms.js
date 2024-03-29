<?php
		if (file_exists(dirname(__FILE__)."/"."lang/".$lang.".php")) {
			include dirname(__FILE__)."/"."lang/".$lang.".php";
		} else {
			include dirname(__FILE__)."/"."lang/en.php";
		}

		foreach ($smilies_language as $i => $l) {
			$smilies_language[$i] = str_replace("'", "\'", $l);
		}
?>

/*
 * CometChat - Smilies Plugin
 * Copyright (c) 2011 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.ccsmilies = (function () {

		var title = '<?php echo $smilies_language[0];?>';

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id) {
				baseUrl = getBaseUrl();
				window.open (baseUrl+'plugins/smilies/index.php?id='+id, 'smilies',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=0, width=220,height=130"); 
			},

			addtext: function (id,text) {

				var string = $('#currentroom .cometchat_textarea').val();
				
				if (string.charAt(string.length-1) == ' ') {
					$('#currentroom .cometchat_textarea').val($('#currentroom .cometchat_textarea').val()+text);
				} else {
					$('#currentroom .cometchat_textarea').val($('#currentroom .cometchat_textarea').val()+' '+text);
				}
				
				$('#currentroom .cometchat_textarea').focus();
				
			}

        };
    })();
 
})(jqcc);