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

if (!defined('CCADMIN')) { echo "NO DICE"; exit; }

$navigation = <<<EOD
	<div id="leftnav">
	<a href="?module=modules">Live modules</a>
	<a href="?module=modules&action=createmodule">Add custom tray icon</a>
	</div>
EOD;

function index() {
	global $db;
	global $body;	
	global $trayicon;
	global $navigation;

	$modules = array();
	if (empty($trayicon)) {
		$trayicon = array();
	}
	
	if ($handle = opendir(dirname(dirname(__FILE__)).'/modules')) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && file_exists(dirname(dirname(__FILE__)).'/modules/'.$file.'/code.php')) {
				$modules[] = $file;
			}
		}
		closedir($handle);
	}

	$moduleslist = '';

	foreach ($modules as $module) {
		require dirname(dirname(__FILE__)).'/modules/'.$module.'/code.php';
		$moduleslist .= '<li class="ui-state-default"><img src="../modules/'.$trayiconinfo[0].'/icon.png" style="margin:0;margin-right:5px;float:left;"></img><span style="font-size:11px;float:left;margin-top:2px;margin-left:5px;width:120px">'.$trayiconinfo[1].'</span><span style="font-size:11px;float:right;margin-top:2px;margin-right:5px;"><a href="?module=modules&action=addmodule&data='.$trayicondata.'">add</a></span><div style="clear:both"></div></li>';
	}

	$livetrayicons = '';
	
	foreach ($trayicon as $ti) {
		if (empty($ti[2])) { $ti[2] = ''; }
		if (empty($ti[3])) { $ti[3] = ''; }
		if (empty($ti[4])) { $ti[4] = ''; }
		if (empty($ti[5])) { $ti[5] = ''; }
		if (empty($ti[6])) { $ti[6] = ''; }
		if (empty($ti[7])) { $ti[7] = ''; }
		if (empty($ti[8])) { $ti[8] = ''; $showhide = 'show'; } else { $showhide = 'hide'; }
		$livetrayicons .= '<li class="ui-state-default" id="'.$ti[0].'" d1="'.addslashes($ti[1]).'" d2="'.$ti[2].'" d3="'.$ti[3].'" d4="'.$ti[4].'" d5="'.$ti[5].'" d6="'.$ti[6].'" d7="'.$ti[7].'" d8="'.$ti[8].'" ><img src="../modules/'.$ti[0].'/icon.png" style="margin:0;margin-right:5px;float:left;"></img><span style="font-size:11px;float:left;margin-top:2px;margin-left:5px;" id="'.$ti[0].'_title">'.stripslashes($ti[1]).'</span><span style="font-size:11px;float:right;margin-top:2px;margin-right:5px;"><a href="javascript:void(0)" onclick="javascript:modules_renamemodule(\''.$ti[0].'\')">rename</a> | <a onclick="javascript:modules_showtext(this,\''.$ti[0].'\');" href="javascript:void(0)">'.$showhide.' text</a> | <a onclick="javascript:embed_link(\''.BASE_URL.'modules/'.$ti[0].'/index.php\',\''.$ti[4].'\',\''.$ti[5].'\');" href="javascript:void(0)">embed</a> | <a href="javascript:void(0)" onclick="javascript:modules_configmodule(\''.$ti[0].'\')">config</a> | <a href="javascript:void(0)" onclick="javascript:modules_removemodule(\''.$ti[0].'\')">remove</a></span><div style="clear:both"></div></li>';
	}


	$body = <<<EOD
	$navigation

	<div id="rightcontent" style="float:left;width:720px;border-left:1px dotted #ccc;padding-left:20px;">
		<h2>Live Modules</h2>
		<h3>Use your mouse to change the order in which the modules appear on the bar (left-to-right). You can add available modules from the right.</h3>

		<div>
			<ul id="modules_livemodules">
				$livetrayicons
			</ul>
			<div id="rightnav" style="margin-top:5px">
				<h1>Available modules</h1>
				<ul id="modules_availablemodules">
				$moduleslist
				</ul>
			</div>
		</div>

		<div style="clear:both;padding:7.5px;"></div>
		<input type="button" onclick="javascript:modules_updateorder()" value="Update order" class="button">&nbsp;&nbsp;or <a href="?module=modules">cancel</a>
	</div>

	<div style="clear:both"></div>

	<script type="text/javascript">
		$(function() {
			$("#modules_livemodules").sortable({ connectWith: 'ul' });
			$("#modules_livemodules").disableSelection();
		});
	</script>

EOD;

	template();

}

function updateorder() {

	$icons = '';

	if (!empty($_POST['order'])) {
		foreach ($_POST['order'] as $order) {
			$icons .= $order."\r\n";
		}
	}

	$icons = str_replace("\\\\\\","\\\\\\\\\\\\",$icons); // Hack

	configeditor('ICONS',trim($icons),0);

	echo "1";

}

function addmodule() {
	if (!empty($_GET['data'])) {
		configeditor('ICONS',base64_decode($_GET['data']),1);
	}
	header("Location:?module=modules");
}

function createmodule() {
	global $db;
	global $body;	
	global $trayicon;
	global $navigation;

	$body = <<<EOD
	$navigation
	<form action="?module=modules&action=createmoduleprocess" method="post" enctype="multipart/form-data">
	<div id="rightcontent" style="float:left;width:720px;border-left:1px dotted #ccc;padding-left:20px;">
		<h2>Add custom tray icon</h2>
		<h3>The maximum height for the icon is 16px</h3>

		<div>
			<div id="centernav">
				<div class="title">Title:</div><div class="element"><input type="text" class="inputbox" name="title"></div>
				<div style="clear:both;padding:5px;"></div>
				<div class="title">Icon:</div><div class="element"><input type="file" class="inputbox" name="file"></div>
				<div style="clear:both;padding:5px;"></div>
				<div class="title">Link:</div><div class="element"><input type="text" class="inputbox" name="link" value="http://www.cometchat.com"></div>
				<div style="clear:both;padding:5px;"></div>

				<div class="title">Type:</div><div class="element"><select class="inputbox" name="type"><option value="">Same window<option  value="_blank">New window<option  value="_popup">Pop-up</select></div>
				<div style="clear:both;padding:5px;"></div>
				<div class="titlefull">If type is pop-up, please enter the width and height</div>
				<div style="clear:both;padding:5px;"></div>
				<div class="title">Width:</div><div class="element"><input type="text" class="inputbox" name="width" value="300"></div>
				<div style="clear:both;padding:5px;"></div>	
				<div class="title">Height:</div><div class="element"><input type="text" class="inputbox" name="height" value="200"></div>
				<div style="clear:both;padding:5px;"></div>
			</div>
			<div id="rightnav">
				<h1>Tips</h1>
				<ul id="modules_availablemodules">
					<li>It is best to use PNG format for your icons. Set transparency on for your icons.</li>
 				</ul>
			</div>
		</div>

		<div style="clear:both;padding:7.5px;"></div>
		<input type="submit" value="Add custom tray icon" class="button">&nbsp;&nbsp;or <a href="?module=modules">cancel</a>
	</div>

	<div style="clear:both"></div>

EOD;

	template();

}

function createmoduleprocess() {
	
	$extension = '';
	$error = '';

	$modulename = createslug($_POST['title'],true);

	if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/png"))) {
		if ($_FILES["file"]["error"] > 0) {
			$error = "Module icon incorrect. Please try again.";
		} else {
			if (file_exists(dirname(dirname(__FILE__))."/temp/" . $modulename)) {
				unlink(dirname(dirname(__FILE__))."/temp/" . $modulename);
			}

			$extension = extension($_FILES["file"]["name"]);
			if (!move_uploaded_file($_FILES["file"]["tmp_name"], dirname(dirname(__FILE__))."/temp/" . $modulename)) {
				$error = "Unable to copy to temp folder. Please CHMOD temp folder to 777.";
			}
		}
	} else {
		$error = "Module icon not found. Please try again.";
	}
	
	if (empty($_POST['title'])) {
		$error = "Module title is empty. Please try again.";
	}

	if (empty($_POST['link'])) {
		$error = "Module link is empty. Please try again.";
	}

	if (!empty($error)) {
		$_SESSION['cometchat']['error'] = $error;
		header("Location: ?module=modules&action=createmodule");
		exit;
	}

	mkdir(dirname(dirname(__FILE__)).'/modules/'.$modulename);

	copy(dirname(dirname(__FILE__))."/temp/" . $modulename,dirname(dirname(__FILE__)).'/modules/'.$modulename.'/icon.png');

	unlink(dirname(dirname(__FILE__))."/temp/" . $modulename);

	$code = "\$trayicon[] = array('".$modulename."','".addslashes(addslashes(addslashes(str_replace('"','',$_POST['title']))))."','".$_POST['link']."','".$_POST['type']."','".$_POST['width']."','".$_POST['height']."','','');";
	
	configeditor('ICONS',$code,1);
	header("Location:?module=modules");	
	
}


function uploadmodule() {
	global $db;
	global $body;	
	global $trayicon;
	global $navigation;

	$body = <<<EOD
	$navigation
	<form action="?module=modules&action=uploadmoduleprocess" method="post" enctype="multipart/form-data">
	<div id="rightcontent" style="float:left;width:720px;border-left:1px dotted #ccc;padding-left:20px;">
		<h2>Upload new module</h2>
		<h3>Have you downloaded a new CometChat module? Use our simple installation facility to add the new module to your site.</h3>

		<div>
			<div id="centernav">
				<div class="title">Module:</div><div class="element"><input type="file" class="inputbox" name="file"></div>
				<div style="clear:both;padding:5px;"></div>
			</div>
			<div id="rightnav">
				<h1>Tips</h1>
				<ul id="modules_availablemodules">
					<li>You can download new modules from <a href="http://www.cometchat.com">our website</a>.</li>
 				</ul>
			</div>
		</div>

		<div style="clear:both;padding:7.5px;"></div>
		<input type="submit" value="Add module" class="button">&nbsp;&nbsp;or <a href="?module=modules">cancel</a>
	</div>

	<div style="clear:both"></div>

EOD;

	template();

}

function uploadmoduleprocess() {
	global $db;
	global $body;	
	global $trayicon;
	global $navigation;

	$extension = '';
	$error = '';

	if (!empty($_FILES["file"]["size"])) {
		if ($_FILES["file"]["error"] > 0) {
			$error = "Module corrupt. Please try again.";
		} else {
			if (file_exists(dirname(dirname(__FILE__))."/temp/" . $_FILES["file"]["name"])) {
				unlink(dirname(dirname(__FILE__))."/temp/" . $_FILES["file"]["name"]);
			}

			if (!move_uploaded_file($_FILES["file"]["tmp_name"], dirname(dirname(__FILE__))."/temp/" . $_FILES["file"]["name"])) {
				$error = "Unable to copy to temp folder. Please CHMOD temp folder to 777.";
			}
		}
	} else {
		$error = "Module not found. Please try again.";
	}
	
	if (!empty($error)) {
		$_SESSION['cometchat']['error'] = $error;
		header("Location: ?module=modules&action=uploadmodule");
		exit;
	}

	require_once('pclzip.lib.php');

	$filename = $_FILES['file']['name'];
	$modulename = basename($filename, ".zip");

	$archive = new PclZip(dirname(dirname(__FILE__))."/temp/" . $_FILES["file"]["name"]);

	if (is_dir(dirname(dirname(__FILE__))."/modules/".$modulename)) {
		deletedirectory(dirname(dirname(__FILE__))."/modules/".$modulename);
	}

	if ($archive->extract(PCLZIP_OPT_PATH, dirname(dirname(__FILE__))."/modules") == 0) {
		$error = "Unable to unzip archive. Please manually upload the contents of the zip file to modules folder.";
	}

	if (!empty($error)) {
		$_SESSION['cometchat']['error'] = $error;
		header("Location: ?module=modules&action=uploadmodule");
		exit;
	}

	unlink(dirname(dirname(__FILE__))."/temp/" . $_FILES["file"]["name"]);

	

	require dirname(dirname(__FILE__))."/modules/".$modulename."/code.php";
		
	configeditor('ICONS',base64_decode($trayicondata),1);

	$src = BASE_URL."/modules/$modulename/install.php";

	$body = <<<EOD
	$navigation
	<form action="?module=modules&action=uploadmoduleprocess" method="post" enctype="multipart/form-data">
	<div id="rightcontent" style="float:left;width:720px;border-left:1px dotted #ccc;padding-left:20px;">
		<h2>Module installation</h2>
		<h3>We are now proceeding to install any configurations that might be necessary.</h3>

		<div>
			<div id="centernav">
				<iframe src="{$src}" width=400 height=300 frameborder=1></iframe>
				<div style="clear:both;padding:5px;"></div>
			</div>
		</div>

	</div>

	<div style="clear:both"></div>

EOD;

	template();
	
}

