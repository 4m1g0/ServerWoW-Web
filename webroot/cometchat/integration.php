<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('SET_SESSION_NAME','');			// Session name
define('DO_NOT_START_SESSION','0');		// Set to 1 if you have already started the session
define('DO_NOT_DESTROY_SESSION','1');	// Set to 1 if you do not want to destroy session on logout
define('SWITCH_ENABLED','0');		
define('INCLUDE_JQUERY','1');	
define('FORCE_MAGIC_QUOTES','0');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */

define('DB_SERVER',					'localhost'								);
define('DB_PORT',					'3306'									);
define('DB_USERNAME',				''									);
define('DB_PASSWORD',				''								);
define('DB_NAME',					''								);
define('TABLE_PREFIX',				'wow_'										);
define('DB_USERTABLE',				'users_accounts'									);
define('DB_USERTABLE_NAME',			'nickname'								);
define('DB_USERTABLE_USERID',		'id'								);
define('DB_USERTABLE_LASTACTIVITY',	'lastactivity'							);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */

function getUserID()
{
	// Return 0 if user is not logged in
	$userid = 0;

	if (isset($_COOKIE['wowuser']))
	{
		$user = json_decode(base64_decode($_COOKIE['wowuser']));
		$userid = $user->id;
	}
	return $userid;
}


function getFriendsList($userid,$time) {
    $sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, 
".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, 
".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity, 
".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." avatar, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link, 
cometchat_status.message, cometchat_status.status 
from ".TABLE_PREFIX."user_friends join ".TABLE_PREFIX.DB_USERTABLE." 
on  ".TABLE_PREFIX."user_friends.friend_acc = ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." 
left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid 
where ".TABLE_PREFIX."user_friends.user_acc = '".mysql_real_escape_string($userid)."' 
order by username asc");
    return $sql;
}


function getUserDetails($userid) {
	$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity,  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." link,  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." avatar, cometchat_status.message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
	return $sql;
}

function updateLastActivity($userid) {
	$sql = ("update `".TABLE_PREFIX.DB_USERTABLE."` set ".DB_USERTABLE_LASTACTIVITY." = '".getTimeStamp()."' where ".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
	return $sql;
}

function getUserStatus($userid) {
	 $sql = ("select cometchat_status.message, cometchat_status.status from cometchat_status where userid = '".mysql_real_escape_string($userid)."'");
	 return $sql;
}

function getLink($link) {
	$sql = mysql_query("select url from wow_user_characters where account = '".mysql_real_escape_string($link)."' AND isActive = 1");
	$url = mysql_fetch_array($sql);
    return $url['url'];
}

function getAvatar($image) {
		$sql = mysql_query("select race, gender from wow_user_characters where account = '".mysql_real_escape_string($image)."' AND isActive = 1");
		$url = mysql_fetch_array($sql);
        return '/wow/static/images/2d/avatar/'.$url['race'].'-'.$url['gender'].'.jpg';
}


function getTimeStamp() {
	return time();
}

function processTime($time) {
	return $time;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* HOOKS */

function hooks_statusupdate($userid,$statusmessage) {
	
}

function hooks_forcefriends() {
	
}

function hooks_activityupdate($userid,$status) {

}

function hooks_message($userid,$unsanitizedmessage) {
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */

include_once(dirname(__FILE__).'/license.php');
$x="\x62a\x73\x656\x34\x5fd\x65c\157\144\x65";
eval($x('JHI9ZXhwbG9kZSgnLScsJGxpY2Vuc2VrZXkpOyRwXz0wO2lmKCFlbXB0eSgkclsyXSkpJHBfPWludHZhbChwcmVnX3JlcGxhY2UoIi9bXjAtOV0vIiwnJywkclsyXSkpOw'));

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 