<div id="cms-account-status" class="ajax-update">
	<div class="bannedInfo">
		<div class="banned-int">
			<div class="center">
				<?php if (isset($errorMsg) && $errorMsg)
					echo $errorMsg;
				else
					echo $l->getString('template_account_status_info_success');
				?>
			</div>
		</div>
	</div>
</div>