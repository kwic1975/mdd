<?php
session_start();
$response=array(
	'error'=>0,
	'message'=>"",
	'data'=>array()
);
if(isset($_SESSION['mdd']))
{
	$con=mysqli_connect('localhost',$_SESSION['mdd']['uname'],$_SESSION['mdd']['pass'],'blinkcoders_mdd');
	//$con=mysqli_connect('localhost',$_SESSION['mdd']['uname'],$_SESSION['mdd']['pass'],'mdd');
	if(mysqli_connect_errno()){
	    die ("**Cannot connect to the database");
	}
}
if(isset($_POST['action']) and $_POST['action']=="UpdateDict")
{
	if(isset($_POST['Step']) and $_POST['Step']==1)
	{
		$query="UPDATE DictionaryData SET Update_Date=CURDATE(),Update_Time=CURRENT_TIME(),Business_Definition=NULLIF('".mysqli_real_escape_string($con,$_POST['Bdefinition'])."',''),Business_Example=NULLIF('".mysqli_real_escape_string($con,$_POST['Bexample'])."','') where Variable_Name_Type='".mysqli_real_escape_string($con,$_POST['type'])."' and Variable_Name='".mysqli_real_escape_string($con,$_POST['var'])."'";
		if($con->query($query))
		{
			 $response['message']="Successful";
		}
		else
		{
			$response['error']=1;
			$response['message']="Failed";
		}
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==2)
	{
		$query="UPDATE DictionaryData SET Update_Date=CURDATE(),Update_Time=CURRENT_TIME(),Technical_Definition=NULLIF('".mysqli_real_escape_string($con,$_POST['Tdefinition'])."',''),Technical_Example=NULLIF('".mysqli_real_escape_string($con,$_POST['Texample'])."','') where Variable_Name_Type='".mysqli_real_escape_string($con,$_POST['type'])."' and Variable_Name='".mysqli_real_escape_string($con,$_POST['var'])."'";
		if($con->query($query))
		{
			 $response['message']="Successful";
		}
		else
		{
			$response['error']=1;
			$response['message']="Failed";
		}
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==3)
	{
		$query="UPDATE DictionaryData SET Update_Date=CURDATE(),Update_Time=CURRENT_TIME(),Keyword='".mysqli_real_escape_string($con,$_POST['Kword'])."',Reference=NULLIF('".mysqli_real_escape_string($con,$_POST['Ref'])."',''),See_also=NULLIF('".mysqli_real_escape_string($con,$_POST['See_also'])."',''),X_Ref=NULLIF('".mysqli_real_escape_string($con,$_POST['X_Ref'])."','') where Variable_Name_Type='".mysqli_real_escape_string($con,$_POST['type'])."' and Variable_Name='".mysqli_real_escape_string($con,$_POST['var'])."'";
		if($con->query($query))
		{
			 $response['message']="Successful";
		}
		else
		{
			$response['error']=1;
			$response['message']="Failed";
		}
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==4)
	{
		$query="UPDATE DictionaryData SET Update_Date=CURDATE(),Update_Time=CURRENT_TIME(),User_Defined1=NULLIF('".mysqli_real_escape_string($con,$_POST['ud1'])."',''),User_Defined2=NULLIF('".mysqli_real_escape_string($con,$_POST['ud2'])."',''),User_Defined3=NULLIF('".mysqli_real_escape_string($con,$_POST['ud3'])."',''),User_Defined4=NULLIF('".mysqli_real_escape_string($con,$_POST['ud4'])."',''),User_Defined5=NULLIF('".mysqli_real_escape_string($con,$_POST['ud5'])."','') where Variable_Name_Type='".mysqli_real_escape_string($con,$_POST['type'])."' and Variable_Name='".mysqli_real_escape_string($con,$_POST['var'])."'";
		if($con->query($query))
		{
			 $response['message']="Successful";
		}
		else
		{
			$response['error']=1;
			$response['message']="Failed";
		}
		echo json_encode($response);
	}
}
?>