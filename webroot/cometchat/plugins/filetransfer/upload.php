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

include dirname(dirname(dirname(__FILE__)))."/"."plugins.php";

if (!in_array('filetransfer',$plugins)) {
	echo "Access denied. Please contact administrator.";
	exit;
}

include dirname(__FILE__)."/lang/en.php";

if (file_exists(dirname(__FILE__)."/lang/".$lang.".php")) {
	include dirname(__FILE__)."/lang/".$lang.".php";
}

if ($rtl == 1) {
	$rtl = "_rtl";
} else {
	$rtl = "";
}

if (!file_exists(dirname(__FILE__)."/themes/".$theme."/filetransfer".$rtl.".css")) {
	$theme = "default";
}

$message = '';

$filename = preg_replace("/[^a-zA-Z0-9 ]/", "", $_FILES['Filedata']['name']);
$filename = str_replace(" ", "_", $filename);
$md5filename = md5($filename."cometchat");

if (!(!isset($_FILES['Filedata']) || !is_uploaded_file($_FILES['Filedata']['tmp_name']))) {
	if (!move_uploaded_file($_FILES['Filedata']['tmp_name'], dirname(__FILE__).'/uploads/' . $md5filename)) {
		$message = 'An error has occurred. Please contact administrator. Closing Window.';
	}
}

if (empty($message)) {

	if (!empty($_POST['chatroommode'])) {

/*		$ext = strtolower(end(explode('.', $_FILES['Filedata']['name'])));
		
		$text = '';

		if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'bmp') {
			$text = "<br/><a href=\"".BASE_URL."plugins/filetransfer/download.php?file=".$_FILES['Filedata']['name']."\" target=\"_blank\" style=\"display:inline-block;margin-bottom:3px;margin-top:3px;\"><img src=\"".BASE_URL."plugins/filetransfer/download.php?file=".$_FILES['Filedata']['name']."\" border=\"0\" style=\"padding:0px;display: inline-block;border:1px solid #666;\" height=\"90\"></a>"; 
		}
*/

		sendChatroomMessage($_POST['to'],$filetransfer_language[9]." (".$_FILES['Filedata']['name']."). <a href=\"".BASE_URL."plugins/filetransfer/download.php?file=".$_FILES['Filedata']['name']."\" target=\"_blank\">".$filetransfer_language[6]."</a>");
	} else {
		sendMessageTo($_POST['to'],$filetransfer_language[5]." (".$_FILES['Filedata']['name']."). <a href=\"".BASE_URL."plugins/filetransfer/download.php?file=".$_FILES['Filedata']['name']."\" target=\"_blank\">".$filetransfer_language[6]."</a>");
		sendSelfMessage($_POST['to'],$filetransfer_language[7]." (".$_FILES['Filedata']['name'].").");
	}

	$message = $filetransfer_language[8];
}

echo <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>{$filetransfer_language[0]}</title> 
<link type="text/css" rel="stylesheet" media="all" href="themes/{$theme}/filetransfer{$rtl}.css" /> 

<script type="text/javascript" src="styleinput.js"></script>


</head>
<body onload="setTimeout('window.close()',2000);"><form action="upload.php" method="post" enctype="multipart/form-data">
<div class="container">
<div class="container_title">{$filetransfer_language[1]}</div>

<div class="container_body">

<div>$message</div>

<div style="clear:both"></div>

</div>
</div>
</div>
</form>
</body>
</html>
EOD;
?>