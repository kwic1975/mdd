<?php 
require_once(dirname(__FILE__)."/site_config.php"); 
?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
</style>
</head>
<body>