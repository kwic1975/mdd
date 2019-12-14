<?php 
include_once(dirname(__FILE__)."/site_config.php"); 
?>
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="<?php echo RESOURCES_URL; ?>/js/scripts.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo RESOURCES_URL; ?>/css/style.css">
		<link rel="stylesheet" href="<?php echo RESOURCES_URL; ?>/css/custom.css">
		<style>
		.user-text
		{
			padding-top:2%;
		}
		.centerTable 
		{ 
			margin: 0px auto;
			margin-top:50px;
		}
		th
		{
			padding:10px 100px 5px 5px;
			border:1px solid white;
			border-bottom:2px solid white;
			background-color:#5b9bd5;
			color:white;
		}
		td
		{
			width: 70px;
			padding:5px 10px 10px 5px;
			border:1px solid white;
			border-bottom:2px solid white;
			vertical-align: top;
		}
		tr
		{
			background-color:#e9eff7;
		}
		tr:nth-child(even)
		{
			background-color:#d0deef;
		}
		a,a:active,a:visited
		{
			color:black;
		}
		.border-blue
		{
			border:1px dashed blue;
			text-align:left !important;
		}
		.buttonn
		{
			text-align:center;
		}
		.buttonnn
		{
			border:1px dashed blue;
			text-align:center;
			font-size:16px;
		}
		.buttonn input
		{
			padding:10px 50px 10px 50px;
		}
		.grey{
		  top:0;
		  left:0;
		  background-color: #cccccc;
		}
		th.grey
		{
		  top:0;
		  left:0;
		  background-color: #7f7f7f;
		}
		#search-text
		{
			text-transform: uppercase;
		}
		.ajax_raDiv {
			background-image: url("<?php echo RESOURCES_URL; ?>/images/ajax-loader1.gif");
			height: 50px;
			left: 49%;
			position: fixed;
			top: 40%;
			width: 50px;
			z-index: 1090;
			background-size: contain;
		}
		.ajax_raTransp {
			background: grey;
			height: 100%;
			opacity: 0.4;
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 1089;
		}
		</style>
	</head>
	<body>
	    <div class="ajax_raDiv ajax_loading" style="display: none;"></div>
		<div class="ajax_raTransp ajax_loading" style="display: none;"></div>
		<div class='container'>
			<?php if(isset($_SESSION['mdd'])){ ?>
			<div class="row">
			
				<div class="col-md-4 col-sm-12 user-text">
						Welcome <b><?php echo htmlspecialchars($_SESSION['mdd']['uname']); ?></b>
						<br><a href="<?php echo SITE_URL;?>/landing-success.php">Home Page</a>
						<br><a href="<?php echo SITE_URL;?>/logout.php">Logout</a>
				</div>
			</div>
			<?php } ?>