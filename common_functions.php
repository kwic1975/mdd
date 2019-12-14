<?php
function Check_if_Admin()
{
	if(isset($_SESSION['mdd']))
	{
		if($_SESSION['mdd']['utype']!="admin")
		{
			echo "<center><h2>You Do Not have Permission to Perform this Action.</h2>";
			die();
		}
	}
}
function restore_last_good_copy(){
	$data=array(
		"status"=>0,
		"errors"=>array()
	);
	global $con;
	// if($table_id==1){
		// DictionaryData
		$del="delete from DictionaryData";
		$res=$con->query($del);
		if($res){
			$insert="insert into DictionaryData select * from DictionaryData_lgc";
			$res=$con->query($insert);
			if($res){
				// $data['status']=1;
			}else{
				$data['errors'][] = $con->error;
			}
		}
	// }elseif($table_id==2){
		// FileData
		$del="delete from FileData";
		$res=$con->query($del);
		if($res){
			$insert="insert into FileData select * from FileData_lgc";
			$res=$con->query($insert);
			if($res){
				// $data['status']=1;
			}else{
				$data['errors'][] = $con->error;
			}
		}
	// }elseif($table_id==3){
		// FieldData
		$del="delete from FieldData";
		$res=$con->query($del);
		if($res){
			$insert="insert into FieldData select * from FieldData_lgc";
			$res=$con->query($insert);
			if($res){
				// $data['status']=1;
			}else{
				$data['errors'][] = $con->error;
			}
		}
	// }else{
		// $data['errors'][] = "Invalid input";
	// }
	if(empty($data['errors'])){
		$data['status']=1;
	}
	return $data;
}
function keep_last_good_copy(){
	$data=array(
		"status"=>0,
		"errors"=>array()
	);
	global $con;
	// if($table_id==1){
		// DictionaryData
		$del="delete from DictionaryData_lgc";
		$res=$con->query($del);
		if($res){
			$insert="insert into DictionaryData_lgc select * from DictionaryData";
			$res=$con->query($insert);
			if($res){
				//$data['status']=1;
			}else{
				$data['errors'][] = $con->error;
			}
		}
	// }elseif($table_id==2){
		// FileData
		$del="delete from FileData_lgc";
		$res=$con->query($del);
		if($res){
			$insert="insert into FileData_lgc select * from FileData";
			$res=$con->query($insert);
			if($res){
				//$data['status']=1;
			}else{
				$data['errors'][] = $con->error;
			}
		}
	// }elseif($table_id==3){
		// FieldData
		$del="delete from FieldData_lgc";
		$res=$con->query($del);
		if($res){
			$insert="insert into FieldData_lgc select * from FieldData";
			$res=$con->query($insert);
			if($res){
				//$data['status']=1;
			}else{
				$data['errors'][] = $con->error;
			}
		}
	// }else{
		// $data['errors'][] = "Invalid input";
	// }
	if(empty($data['errors'])){
		$data['status']=1;
	}
	return $data;
}
function UpdateDateTimeFields(){
	$data=array(
		"status"=>0,
		"errors"=>array()
	);
	global $con;
	$date = date('Y-m-d');
	$time = date('H:i:s');
	$update="update DictionaryData set Update_Date='".$date."', Update_Time='".$time."'";
	$res=$con->query($update);
	if($res){
		$update="update FileData set Update_Date='".$date."' , Update_Time='".$time."'";
		$res=$con->query($update);
		if($res){
			$update="update FieldData set Update_Date='".$date."' , Update_Time='".$time."'";
			$res=$con->query($update);
			if($res){
				$data['status']=1;
			}else{
				$data['errors'][] = $con->error;
			}
		}else{
			$data['errors'][] = $con->error;
		}
	}else{
		$data['errors'][] = $con->error;
	}
	return $data;
}
function Check_permission()
{
	if(isset($_SESSION['mdd']))
	{
		if($_SESSION['mdd']['utype']!="admin" and $_SESSION['mdd']['utype']!="editor")
		{
			echo "<center><h2>You Do Not have Permission to Access this Page.</h2>";
			echo "<a href='index.php'>Go back</a></center>";
			die();
		}
	}else{
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ 
			header('HTTP/1.0 401 Unauthorized');
			die; exit();
		}else{
			//means page requested directly
			ob_end_clean();
			header("Location: ".SITE_URL);

			exit();
		}
	}
}
function ui_date($date_format){
	if($date_format!=""){
		if(substr($date_format,0,10)=="0000-00-00"){
			return "00-00-0000";
		}
		else{
			$newDate = date("m/d/Y", strtotime($date_format));
			return substr($newDate,0,10);
		}
	}
}
function mysql_time($time12hour){
	// 12-hour time to mysql time 
	if($time12hour!=""){
		return $mysql_time  = date("H:i:s", strtotime($time12hour));
	}
}
function mysql_date($mydate){
	if($mydate!=""){
		if(substr($mydate,0,10)=="00-00-0000"){
			return "0000-00-00";
		}
		else{
			$newDate = date("Y-m-d", strtotime($mydate));
			return substr($newDate,0,10);
		}
	}
}
function mysql_datetime($datetime){
	if($datetime!=""){
		return mysql_date($datetime)." ".mysql_time($datetime); 
	}
}

?>