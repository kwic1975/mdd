<?php 
session_start();
error_reporting(E_ALL ^ E_WARNING); 
function base_url(){
    $base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
    $base_url .= '://'. $_SERVER['HTTP_HOST'];
    return $base_url;
}
if(isset($_SESSION['mdd']))
{
	// $con=mysqli_connect('localhost',$_SESSION['mdd']['uname'],$_SESSION['mdd']['pass'],'blinkcoders_mdd');
	$con=mysqli_connect('localhost',$_SESSION['mdd']['uname'],$_SESSION['mdd']['pass'],'mdd');
	if(mysqli_connect_errno()){
		die ("**Cannot connect to the database");
	}
}
define('SUB_FOLDER', "/mdd"); // without trailing slash
define('SITE_URL', base_url().SUB_FOLDER);
define('BASE_DIR', dirname(__FILE__));
define('RESOURCES_URL', base_url().SUB_FOLDER.'/resources/');
define('RESOURCES_DIR', BASE_DIR.'/resources');

$PRODUCT_HEADERS['Dict']=" Update_Date,Update_Time,Variable_Name_Type,Variable_Name,Business_Definition,Business_Example,Technical_Definition,Technical_Example,Keyword,Reference,See_Also,X_Ref,User_Defined1,User_Defined2,User_Defined3,User_Defined4,User_Defined5";

$PRODUCT_HEADERS['Field']="Update_Date,Update_Time,Anniversary_Date,FieldName,FileName,Active_Indicator,Inactive_Date,Risk_Rating,Comments,Field_Type,Field_Length,Field_Format,Prior_Name,Prior_Name_Date,PROC_Step,User_Defined1,User_Defined2,User_Defined3,User_Defined4,User_Defined5";

$PRODUCT_HEADERS['File']="Update_Date,Update_Time,Class1,Class2,Class3,FileName,FilePath,Active_Indicator,Inactive_Date,Risk_Rating,Comments,Anniversary_Date,User_Defined1,User_Defined2,User_Defined3,User_Defined4,User_Defined5";

include_once(BASE_DIR ."/common_functions.php");

?>