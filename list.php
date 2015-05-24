<?php
!defined('SERVER_EXEC') && define('SERVER_EXEC', 1);
require_once('lib/base.php');

$pollModel = Lib::model('poll');
$lastdate = date_create($pollModel->getLastPollDate());
$now = new DateTime();

$diff = (int) ceil(($now->format('U') - $lastdate->format('U')) / 60);
?>
<!DOCTYPE html>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="css/list.css" rel="stylesheet" />
	<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="js/list.js" type="text/javascript"></script>
</head>
<body>
<div class="wrapper">
	<div class="container">
		<div class="header">#fearlessSEA</div>
		<div class="subheader">Last updated: <?php echo $diff; ?> mins ago</div>
		<div class="list"></div>
		<a href="javascript:void(0);" class="more"><span class="text">Load more</span><span class="loader"><img src="img/loader.gif" /></a>
	</div>
</div>

<textarea class="structure">
	<div class="item">
		<div class="avatar"><a target="_blank" href="{link}"><img src="{avatar}" /></a></div>
		<div class="content">
			<a class="user" target="_blank" href="{link}">
				<span class="name">{name}</span>
				<span class="screenname">@{screenname}</span>
			</a>
			<div class="metas">
				<div class="meta distance">
					<i class="fa fa-dashboard"></i> {distancekm} km
				</div>
				<div class="meta count">
					<i class="fa fa-refresh"></i> {count}
				</div>
			</div>
		</div>
	</div>
</textarea>
</body>
</html>