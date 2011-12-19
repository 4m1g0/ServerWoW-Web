<h3>Web Lags</h3>
<p><a href="/admin/lags/deleteAll" onclick="javascript:return confirm('Delete all reports? Are you sure?');">Delete All</a></p>
<hr />
<p>
<style type="text/css">
	.webpagination {font-weight:bold;}
	.webpagination ul {
		display: inline;
	} 

	.webpagination ul li {
		padding: 10px;
		display: inline;
	}

	.webpagination ul li.current {
		display: inline;
		color: #ff0000;
	}
</style>
	<div class="webpagination">
		<ul><?php
		$pagination = $admin->getLagReportsPagination();
		echo $pagination;
		?></ul>
	</div>
	
	<div><br />
	<ul>
		<?php
		$reports = $admin->getLagReports();
		if ($reports) : 
			foreach ($reports as $report) : ?>
		<li><a href="/admin/lags/<?php echo $report['id']; ?>"><?php echo date('d.m.Y H:i', $report['date_time']) . ' ('. $report['page_url'] . ')'; ?></a></li>
		<?php endforeach; endif; ?>
	</ul></div>
	<div class="webpagination">
		<ul><?php
		echo $pagination;
		?></ul>
	</div>
</p>