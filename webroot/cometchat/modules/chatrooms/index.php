<?php

/*

CometChat
Copyright (c) 2011 Inscripts

CometChat ('the Software') is a copyrighted work of authorship. Inscripts 
retains ownership of the Software and any copies of it, regardless of the 
form in which the copies may exist. This license is not a sale of the 
original Software or any copies.

By installing and using CometChat on your server, you agree to the following
terms and conditions. Such agreement is either on your own behalf or on behalf
of any corporate entity which employs you or which you represent
('Corporate Licensee'). In this Agreement, 'you' includes both the reader
and any Corporate Licensee and 'Inscripts' means Inscripts (I) Private Limited:

CometChat license grants you the right to run one instance (a single installation)
of the Software on one web server and one web site for each license purchased.
Each license may power one instance of the Software on one domain. For each 
installed instance of the Software, a separate license is required. 
The Software is licensed only to you. You may not rent, lease, sublicense, sell,
assign, pledge, transfer or otherwise dispose of the Software in any form, on
a temporary or permanent basis, without the prior written consent of Inscripts. 

The license is effective until terminated. You may terminate it
at any time by uninstalling the Software and destroying any copies in any form. 

The Software source code may be altered (at your risk) 

All Software copyright notices within the scripts must remain unchanged (and visible). 

The Software may not be used for anything that would represent or is associated
with an Intellectual Property violation, including, but not limited to, 
engaging in any activity that infringes or misappropriates the intellectual property
rights of others, including copyrights, trademarks, service marks, trade secrets, 
software piracy, and patents held by individuals, corporations, or other entities. 

If any of the terms of this Agreement are violated, Inscripts reserves the right 
to revoke the Software license at any time. 

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

include dirname(dirname(dirname(__FILE__)))."/"."modules.php";
include dirname(__FILE__)."/"."config.php";
include dirname(__FILE__)."/"."lang/en.php";

if (file_exists(dirname(__FILE__)."/"."lang/".$lang.".php")) {
	include dirname(__FILE__)."/"."lang/".$lang.".php";
}

if ($rtl == 1) {
	$rtl = "_rtl";
} else {
	$rtl = "";
}

if (!file_exists(dirname(__FILE__)."/themes/".$theme."/chatrooms".$rtl.".css")) {
	$theme = "default";
}

unset($_SESSION['cometchat']['cometchat_chatroomslist']);

if (isset($_SESSION['cometchat']['timedifference'])) {
	$_SESSION['cometchat']['timedifference'] = 0;
}

if (!empty($_REQUEST['basedata'])) {
	$_SESSION['basedata'] = $_REQUEST['basedata'];
}

if ($userid == 0 || in_array($userid,$bannedUserIDs) || !empty($_SESSION['guestMode'])) {

	if (in_array($userid,$bannedUserIDs)) {
		$chatrooms_language[0] = $bannedMessage;
	}

echo <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="-1">
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
<link type="text/css" rel="stylesheet" media="all" href="themes/{$theme}/chatrooms{$rtl}.css" /> 
</head>
<body>

<div class="container">

{$chatrooms_language[0]}

</div>
</div>
</body>
</html>
EOD;
} else {

$joinroom = '';

if (!empty($_COOKIE[$cookiePrefix.'chatroom']) && empty($_GET['roomid']) && empty($_GET['id'])) {
	$info = explode(':',base64_decode($_COOKIE[$cookiePrefix.'chatroom']));
	$_GET['roomid'] = $info[0];
	$_GET['inviteid'] = $info[1];
	$_GET['roomname'] = $info[2];
}

if (!empty($_GET['roomid'])) {
	$joinroom = <<<EOD
	silentroom('{$_GET['roomid']}','{$_GET['inviteid']}','{$_GET['roomname']}');
EOD;
	$autoLogin = 0;
}

if (!empty($_GET['id'])) {
	$sql = ("select id,name from cometchat_chatrooms where id = '".mysql_real_escape_string($_GET['id'])."' and type = '0' limit 1");
	$query = mysql_query($sql);
	$room = mysql_fetch_array($query);
	
	if ($room['id'] > 0) {
	$roomname = base64_encode($room['name']);
	$joinroom = <<<EOD
	silentroom('{$_GET['id']}','','{$roomname}');
EOD;
	$autoLogin = 0;
	}
}

$time = getTimeStamp();

echo <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="-1">
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
<link type="text/css" rel="stylesheet" media="all" href="themes/{$theme}/chatrooms{$rtl}.css" /> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="chatroomsjs.php?auto=$autoLogin"></script>
<script>
$(document).ready(function() {
	$joinroom
});
</script>
</head>
<body>

<div id="container">
<div class="topbar">
	<ol class="tabs">
			  <li id="lobbytab" class="tab_selected">
			<a href="javascript:void(0);" onclick="javascript:loadLobby()">{$chatrooms_language[3]}</em></a>
		  </li>
EOD;

if ($allowUsers == 1) {
	echo <<<EOD
		  <li id="createtab">
			<a href="javascript:void(0);" onclick="javascript:createChatroom()">{$chatrooms_language[2]}</a>
		  </li>
EOD;
}

echo <<<EOD
	      <li id="popouttab" style="display:none">
			<a href="javascript:void(0);" onclick="javascript:popoutChat()">{$chatrooms_language[9]}</a>
		  </li>
			<li id="closetab" style="display:none">
			<a href="javascript:void(0);" onclick="javascript:window.close()">{$chatrooms_language[10]}</a>
		  </li>
			<li id="currentroomtab" style="display:none">
		  </li>
    </ol>
	<div style="clear:both"></div>
	<div class="topbar_text"><div id="plugins"></div><div class="welcomemessage">{$chatrooms_language[1]}</div></div>
	<div style="clear:both"></div>
</div>
<div style="clear:both"></div>
<div id="lobby">
<div class="lobby_rooms content_div" id="lobby_rooms"></div>
</div>

<div class="content_div" id="currentroom" style="display:none">
	<div id="currentroom_left" class="content_div">
		<div id="currentroom_convo"><div id="currentroom_convotext"></div></div><div style="clear:both"></div>
		<div class="cometchat_tabcontentinput"><textarea class="cometchat_textarea"></textarea><div class="cometchat_tabcontentsubmit" style="display:none"></div></div>
	</div>
	<div id="currentroom_users" class="content_div"></div>
</div>

<div class="content_div" id="create" style="display:none">
	<div id="currentroom_left" class="content_div">
		<div class="create">
			<div style="clear:both;padding-top:10px"></div>
			<div class="create_name">{$chatrooms_language[27]}</div><div class="create_value"><input type="textbox" id="name" class="create_input"></div>
			<div style="clear:both;padding-top:10px"></div>
			<div class="create_name">{$chatrooms_language[28]}</div><div class="create_value" ><select id="type" onchange="checkDropDown(this)" class="create_input"><option value="0">{$chatrooms_language[29]}</option><option value="1">{$chatrooms_language[30]}</option><option value="2">{$chatrooms_language[31]}</option></select></div>
			<div style="clear:both;padding-top:10px"></div>
			<div class="create_name password_hide">{$chatrooms_language[32]}</div><div class="create_value password_hide"><input id="password" type="password"  class="create_input"></div>
			<div style="clear:both;padding-top:10px"></div>
			<div class="create_name">&nbsp;</div><div class="create_value"><input type="button" value="{$chatrooms_language[33]}" onclick="javascript:createChatroomSubmit()"></div>
		</div>
	</div>
</div>



</div>


</body>
</html>
EOD;

}

?>