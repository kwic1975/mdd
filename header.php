<?php 
include_once(dirname(__FILE__)."/site_config.php"); 
include_once(dirname(__FILE__)."/common-header.php"); 

if(isset($_SESSION['mdd']))
{
	$con=mysqli_connect('localhost',$_SESSION['mdd']['uname'],$_SESSION['mdd']['pass'],'blinkcoders_mdd');
	if(mysqli_connect_errno()){
	    die ("**Cannot connect to the database");
	}
}
else
{
	header('Location:logout.php');
}
?>