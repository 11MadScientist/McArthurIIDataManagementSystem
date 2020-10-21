<?php
include('header.php');
?>
<title>McArthurIIDistrictEventCalendar</title>
<link rel="stylesheet" href="css/calendar.css">
</head>
<body>
<div class="container" style="position: center;">
	<div class="page-header">
		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary"  style="margin-left:-350px;" data-calendar-nav="prev"><< Prev</button>
				<button class="btn btn-default" style="margin-left:-275px;" data-calendar-nav="today">Today</button>
				<button class="btn btn-primary" style="margin-left:-212px;" data-calendar-nav="next">Next >></button>
			</div>
			<div class="btn-group">
				<button class="btn btn-warning" data-calendar-view="year">Year</button>
				<button class="btn btn-warning active" data-calendar-view="month">Month</button>
				<button class="btn btn-warning" data-calendar-view="week">Week</button>
				<button class="btn btn-warning" data-calendar-view="day">Day</button>
			</div>
		</div>
		<h3 style="font-size: 180%; font-family:'Century Gothic'; "></h3>

	</div>
	<div class="row">
		<div class="col-md-9">
			<div id="showEventCalendar"></div>
		</div>
		<div class="col-md-3">
			<h4>All Events List</h4>
			<ul id="eventlist" class="nav nav-list"></ul>
		</div>
	</div>
	<div style="margin:50px 0px 0px 0px;">
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="../dashboard.php">Back to Tutorial</a>
	</div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/events.js"></script>
<?php include('footer.php');?>
