<?php
		if (file_exists(dirname(__FILE__)."/"."lang/".$lang.".php")) {
			include dirname(__FILE__)."/"."lang/".$lang.".php";
		} else {
			include dirname(__FILE__)."/"."lang/en.php";
		}

		foreach ($writeboard_language as $i => $l) {
			$writeboard_language[$i] = str_replace("'", "\'", $l);
		}
?>

/*
 * CometChat
 * Copyright (c) 2011 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.ccwriteboard = (function () {

		var title = '<?php echo $writeboard_language[0];?>';
		var lastcall = 0;

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id) {
				var currenttime = new Date();
				currenttime = parseInt(currenttime.getTime()/1000);
				if (currenttime-lastcall > 10) {
					baseUrl = $.cometchat.getBaseUrl();
					baseData = $.cometchat.getBaseData();

					var random = currenttime;
					$.getJSON(baseUrl+'plugins/writeboard/index.php?action=request&callback=?', {to: id, id: random, basedata: baseData});
					lastcall = currenttime;

					var w =window.open (baseUrl+'plugins/writeboard/index.php?action=writeboard&type=1&id='+random+'&basedata='+baseData, 'writeboard',"status=0,toolbar=0,menubar=0,directories=0,resizable=1,location=0,status=0,scrollbars=0, width=800,height=600");
					w.focus();

				} else {
					alert('<?php echo $writeboard_language[1];?>');
				}
			},

			accept: function (id,random) {
				baseUrl = $.cometchat.getBaseUrl();
				baseData = $.cometchat.getBaseData();

				$.getJSON(baseUrl+'plugins/writeboard/index.php?action=accept&callback=?', {to: id, basedata: baseData});
				var w = window.open (baseUrl+'plugins/writeboard/index.php?action=writeboard&type=0&id='+random+'&basedata='+baseData, 'writeboard',"status=0,toolbar=0,menubar=0,directories=0,resizable=1,location=0,status=0,scrollbars=0, width=800,height=600"); 
				w.focus();
			}
        };
    })();
 
})(jqcc);