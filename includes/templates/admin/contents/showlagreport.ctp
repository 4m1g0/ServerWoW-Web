<h3>Web Lags</h3>
<p><a href="/admin/lags">Back</a></p>
<hr />
<p><?php $lag = $admin->getLag(); ?>
	<strong>User IP:</strong> <?php echo $lag['user_ip']; ?><br />
	<strong>Date:</strong> <?php echo date('d/m/Y H:i:s', $lag['date_time']); ?><br />
	<strong>URL:</strong> <a href="/<?php echo $lag['page_url']; ?>" target="_blank"><?php echo '/'.$lag['page_url']; ?></a><br />
	<strong>Timers:</strong><br/>
	<code><?php echo $lag['timers']; ?></code>
</p>