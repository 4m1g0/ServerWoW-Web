
	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/local-common/css/common.css?v22"/>
		<link rel="stylesheet" type="text/css" href="<?php echo CLIENT_FILES_PATH; ?>/login/static/_themes/bam/css/master.css?v1"/>
		<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/login/static/local-common/js/third-party/jquery-1.4.4-p1.min.js"></script>
		<script type="text/javascript" src="<?php echo CLIENT_FILES_PATH; ?>/login/static/local-common/js/core.js?v22"></script>
		<script>
			var targetOrigin = "http://<?php echo $_SERVER['HTTP_HOST'] . CLIENT_FILES_PATH; ?>/";

			function updateParent(action, key, value) {
				var obj = { action: action };

				if (key) obj[key] = value;

				parent.postMessage(JSON.stringify(obj), targetOrigin);
				return false;
			}

			function checkDefaultValue(input, isPass) {
				if (input.value == input.title)
					input.value = "";

				if (isPass)
					input.type = "password";
			}
		</script>
	</head>
	<body>
		<div id="embedded-login">
			<h1>Battle.net</h1>

	<form action="" method="post">
		<a id="embedded-close" href="javascript:;" onclick="updateParent('close')"> </a>
		<div>
		<?php if ($loginError != ERROR_NONE) : ?>
			<div id="errors">
				<ul>
					<?php if ($loginError & ERROR_EMPTY_USERNAME) echo '<li>' . $l->getString('login_error_empty_username_title') . '</li>'; ?>
					<?php if ($loginError & ERROR_EMPTY_PASSWORD) echo '<li>' . $l->getString('login_error_empty_password_title') . '</li>'; ?>
					<?php if ($loginError & ERROR_WRONG_USERNAME_OR_PASSWORD) echo '<li>' . $l->getString('login_error_wrong_username_or_password_title') . '</li>'; ?>
					<?php if ($loginError & ERORR_INVALID_PASSWORD_FORMAT) echo '<li>' . $l->getString('login_error_invalid_password_format_title') . '</li>'; ?>
					<?php if ($loginError & ERROR_RECAPTCHA_FAILED) echo '<li>' . $l->getString('login_error_invalid_captcha') . '</li>'; ?>
				</ul>
			</div>
		<?php endif; ?>

			<p><label for="accountName" class="label"><?php echo $l->getString('login_title'); ?></label>
			<input id="accountName" value="<?php if (isset($_POST['accountName'])) echo $_POST['accountName']; ?>" name="accountName" maxlength="320" type="text" tabindex="1" class="input" /></p>

			<p><label for="password" class="label"><?php echo $l->getString('password_title'); ?></label>
			<input id="password" name="password" maxlength="16" type="password" tabindex="2" autocomplete="off" class="input"/></p>

			<p>
			<?php
			if ($this->c('AccountManager')->getLoginErrorsCount() >= 3)
			{
				require_once(SITE_CLASSES_DIR . 'recaptchalib.php');
				$publickey = "6LcZjsoSAAAAAPYGkJOTrHl_j_4zS6S9Chcyh2m6"; // you got this from the signup page
				echo recaptcha_get_html($publickey);
			}
			?>
			</p>
			

			<p>
				<span id="remember-me">
					<label for="persistLogin">
						<input type="checkbox" checked="checked" name="persistLogin" id="persistLogin" />
						<?php echo $l->getString('remember_me_title'); ?>
					</label>
				</span>

				<input type="hidden" name="app" value="com-sc2"/>

				

	<button	class="ui-button button1 " type="submit" data-text="<?php echo $l->getString('login_processing_title'); ?>">
		<span>
			<span><?php echo $l->getString('authorization_title'); ?></span>
		</span>
	</button>

			</p>
		</div>
        
	<ul id="help-links">


				<li class="icon-pass">
					<a href="<?php echo $this->getCoreUrl('account/support/password-reset.html'); ?>"><?php echo $l->getString('login_help_title'); ?></a>
				</li>

			<li class="icon-secure">
				<a href="<?php echo $this->getCoreUrl('security/?ref='); ?>"><?php echo $l->getString('account_security_title'); ?></a>
			</li>
		
		
		
				<li class="icon-signup">
					<?php echo $l->getString('have_no_account_title'); ?> <a href="<?php echo $this->getCoreUrl('account/creation/tos.html?ref='); ?>"><?php echo $l->getString('create_account_title'); ?></a>
				</li>

		
		
	</ul>
		
		
		<script type="text/javascript">
			$(function() {
				$("#ssl-trigger").click(function() {
					updateParent('onload', 'height', $(document).height() + 76);
					$("#thawteseal").show();
				});
				
				$("#help-links a").click(function() {
					updateParent('redirect', 'url', this.href);
					return false;
				});

				$('#accountName').focus();

				updateParent('onload', 'height', $(document).height());
			});
		</script>
	</form>
		</div>
	</body>
	</html>

