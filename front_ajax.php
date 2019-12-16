<?php
include_once(dirname(__FILE__)."/site_config.php");

Check_permission();

if(isset($_POST['RestoreData'])){
	// check only admin has permission 
	Check_if_Admin();
	$table_id = $_POST['table'];
	$data = restore_last_good_copy($table_id);
	header('Content-type: application/json');
	echo json_encode($data);
}

if(isset($_POST['action']) and $_POST['action']=="UpdateFile")
{
	$response=array(
	'error'=>0,
	'message'=>"",
	'data'=>array()
	);
	$query="SELECT count(*) from FileData where FileName='".mysqli_real_escape_string($con,urldecode($_POST['file']))."'";
	{
		$result=$con->query($query);
		if($result and $result->num_rows!=0)
		{
			$row_count=$result->fetch_assoc();
		}
		$count=$row_count['count(*)'];
	}
	if(isset($_POST['Step']) and $_POST['Step']==1)
	{
		if($count>1)
		{
			$query="UPDATE FileData SET Class1='".mysqli_real_escape_string($con,$_POST['class1'])."',Class2 ='".mysqli_real_escape_string($con,$_POST['class2'])."' where FileName='".mysqli_real_escape_string($con,urldecode($_POST['file']))."'";
		}
		else
		{
			$query="UPDATE FileData SET Class1='".mysqli_real_escape_string($con,$_POST['class1'])."',Class2 ='".mysqli_real_escape_string($con,$_POST['class2'])."',Class3='".mysqli_real_escape_string($con,$_POST['class3'])."',FilePath='".mysqli_real_escape_string($con,$_POST['fpath'])."' where FileName='".mysqli_real_escape_string($con,urldecode($_POST['file']))."'";
		}
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==2)
	{
		if(isset($_POST['act_indicator']) and $_POST['act_indicator']=='on')
		{
			$Active="YES";
			$Inactive_Date=mysql_date(mysqli_real_escape_string($con,$_POST['Indate']));
		}
		else
		{
			$Active="NO";
			$Inactive_Date=mysql_date(date("Y/m/d"));
		}
		$query="UPDATE FileData SET Inactive_Date='".$Inactive_Date."',Risk_Rating='".mysqli_real_escape_string($con,$_POST['rsk_rating'])."',Comments='".mysqli_real_escape_string($con,$_POST['file_comments'])."',Anniversary_Date='".mysql_date(mysqli_real_escape_string($con,$_POST['Anndate']))."',Active_Indicator='".mysqli_real_escape_string($con,$Active)."' where FileName='".mysqli_real_escape_string($con,urldecode($_POST['file']))."'";
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==3)
	{
		$query="UPDATE FileData SET User_Defined1=NULLIF('".mysqli_real_escape_string($con,$_POST['ud1'])."',''),User_Defined2=NULLIF('".mysqli_real_escape_string($con,$_POST['ud2'])."',''),User_Defined3=NULLIF('".mysqli_real_escape_string($con,$_POST['ud3'])."',''),User_Defined4=NULLIF('".mysqli_real_escape_string($con,$_POST['ud4'])."',''),User_Defined5=NULLIF('".mysqli_real_escape_string($con,$_POST['ud5'])."','') where FileName='".mysqli_real_escape_string($con,urldecode($_POST['file']))."'";
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
}

if(isset($_POST['action']) and $_POST['action']=="UpdateDict")
{
    $response=array(
    	'error'=>0,
    	'message'=>"",
    	'data'=>array()
    );
	if(isset($_POST['Step']) and $_POST['Step']==1)
	{
		$query="UPDATE DictionaryData SET Business_Definition=NULLIF('".mysqli_real_escape_string($con,$_POST['Bdefinition'])."',''),Business_Example=NULLIF('".mysqli_real_escape_string($con,$_POST['Bexample'])."','') where Variable_Name_Type='".mysqli_real_escape_string($con,$_POST['type'])."' and Variable_Name='".mysqli_real_escape_string($con,$_POST['var'])."'";
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==2)
	{
		$query="UPDATE DictionaryData SET Technical_Definition=NULLIF('".mysqli_real_escape_string($con,$_POST['Tdefinition'])."',''),Technical_Example=NULLIF('".mysqli_real_escape_string($con,$_POST['Texample'])."','') where Variable_Name_Type='".mysqli_real_escape_string($con,$_POST['type'])."' and Variable_Name='".mysqli_real_escape_string($con,$_POST['var'])."'";
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==3)
	{
		$query="UPDATE DictionaryData SET Keyword='".mysqli_real_escape_string($con,$_POST['Kword'])."',Reference=NULLIF('".mysqli_real_escape_string($con,$_POST['Ref'])."',''),See_also=NULLIF('".mysqli_real_escape_string($con,$_POST['See_also'])."',''),X_Ref=NULLIF('".mysqli_real_escape_string($con,$_POST['X_Ref'])."','') where Variable_Name_Type='".mysqli_real_escape_string($con,$_POST['type'])."' and Variable_Name='".mysqli_real_escape_string($con,$_POST['var'])."'";
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==4)
	{
		$query="UPDATE DictionaryData SET User_Defined1=NULLIF('".mysqli_real_escape_string($con,$_POST['ud1'])."',''),User_Defined2=NULLIF('".mysqli_real_escape_string($con,$_POST['ud2'])."',''),User_Defined3=NULLIF('".mysqli_real_escape_string($con,$_POST['ud3'])."',''),User_Defined4=NULLIF('".mysqli_real_escape_string($con,$_POST['ud4'])."',''),User_Defined5=NULLIF('".mysqli_real_escape_string($con,$_POST['ud5'])."','') where Variable_Name_Type='".mysqli_real_escape_string($con,$_POST['type'])."' and Variable_Name='".mysqli_real_escape_string($con,$_POST['var'])."'";
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
}
if(isset($_POST['action']) and $_POST['action']=="UpdateField")
{
	$response=array(
	'error'=>0,
	'message'=>"",
	'data'=>array()
	);
	$query="SELECT count(*) from FieldData where FieldName='".mysqli_real_escape_string($con,urldecode($_POST['field']))."'";
	{
		$result=$con->query($query);
		if($result and $result->num_rows!=0)
		{
			$row_count=$result->fetch_assoc();
		}
		$count=$row_count['count(*)'];
	}
	if(isset($_POST['Step']) and $_POST['Step']==1)
	{
		if($count>1)
		{
			$query="UPDATE FieldData SET Field_Type ='".mysqli_real_escape_string($con,$_POST['Field_Type'])."',Field_Length='".mysqli_real_escape_string($con,$_POST['FieldLength'])."',Field_Format='".mysqli_real_escape_string($con,$_POST['FieldFormat'])."' where FieldName='".mysqli_real_escape_string($con,urldecode($_POST['field']))."'";
		}
		else
		{
			$query="UPDATE FieldData SET FileName='".mysqli_real_escape_string($con,$_POST['FileName'])."',Field_Type ='".mysqli_real_escape_string($con,$_POST['Field_Type'])."',Field_Length='".mysqli_real_escape_string($con,$_POST['FieldLength'])."',Field_Format='".mysqli_real_escape_string($con,$_POST['FieldFormat'])."' where FieldName='".mysqli_real_escape_string($con,urldecode($_POST['field']))."'";
		}
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==2)
	{
		if(isset($_POST['act_indicator']) and $_POST['act_indicator']=='on')
		{
			$Active="YES";
			$Inactive_Date=mysql_date($_POST['Indate']);
		}
		else
		{
			$Active="NO";
			$Inactive_Date=mysql_date(date("Y/m/d"));
		}
		$query="UPDATE FieldData SET Inactive_Date='".$Inactive_Date."',Risk_Rating='".mysqli_real_escape_string($con,$_POST['rsk_rating'])."',Comments='".mysqli_real_escape_string($con,$_POST['field_comments'])."',Anniversary_Date='".mysqli_real_escape_string($con,mysql_date($_POST['Anndate']))."',Active_Indicator='".mysqli_real_escape_string($con,$Active)."' where FieldName='".mysqli_real_escape_string($con,urldecode($_POST['field']))."'";
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==3)
	{
		if($count>1)
		{
			$query="UPDATE FieldData SET Prior_Name ='".mysqli_real_escape_string($con,$_POST['PriorName'])."',Prior_Name_Date='".mysqli_real_escape_string($con,$_POST['PNdate'])."' where FieldName='".mysqli_real_escape_string($con,urldecode($_POST['field']))."'";
		}
		else
		{
			$query="UPDATE FieldData SET Prior_Name ='".mysqli_real_escape_string($con,$_POST['PriorName'])."',Prior_Name_Date='".mysqli_real_escape_string($con,mysql_date($_POST['PNdate']))."',PROC_Step='".mysqli_real_escape_string($con,$_POST['PROC_Step'])."' where FieldName='".mysqli_real_escape_string($con,urldecode($_POST['field']))."'";
		}
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
	if(isset($_POST['Step']) and $_POST['Step']==4)
	{
		$query="UPDATE FieldData SET User_Defined1=NULLIF('".mysqli_real_escape_string($con,$_POST['ud1'])."',''),User_Defined2=NULLIF('".mysqli_real_escape_string($con,$_POST['ud2'])."',''),User_Defined3=NULLIF('".mysqli_real_escape_string($con,$_POST['ud3'])."',''),User_Defined4=NULLIF('".mysqli_real_escape_string($con,$_POST['ud4'])."',''),User_Defined5=NULLIF('".mysqli_real_escape_string($con,$_POST['ud5'])."','') where FieldName='".mysqli_real_escape_string($con,$_POST['field'])."'";
		$res=$con->query($query);
		if($res)
		{
			$res = UpdateDateTimeFields();
		    if($res['status']==1){
				$response['status']=1;
			}
			else
			{
			    $response['error']=1;
				$response['errors'][] = "Error updating Date Time Fields.";
			}	
		}
		else
		{
			$response['error']=1;
		    $response['message']=$con->error;
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}
}
if(isset($_POST['action']) && $_POST['action']=='AddDict'){
	// global $con;
	$data=array(
		"status"=>0,
		"errors"=>array(),
		"type"=>'',
		"name"=>''
	);
	if(empty($_POST['VName'])){
		$data['errors'][] = 'Variable_Name is required';
	}
	if(empty($_POST['VNameType'])){
		$data['errors'][] = 'Variable_Name_Type is required';
	}else{
		if($_POST['VNameType']!='FILE' || $_POST['VNameType']!='FIELD'){
			// ok 
		}else{
			$data['errors'][] = 'Please select a valid Variable_Name_Type';
		}
	}
	if(empty($data['errors'])){
		// add a dictionary 
		// check if already exists 
		$select = "select * from `DictionaryData` where Variable_Name='".mysqli_real_escape_string($con,strtoupper($_POST['VName']))."' and Variable_Name_Type='".mysqli_real_escape_string($con,$_POST['VNameType'])."'";
		$res=$con->query($select);
		if($res->num_rows){
			$data['errors'][] = "Variable_Name and Variable_Name_Type already exists.";
		}else{
			// echo mysqli_real_escape_string($con,$_POST['VName']);die;
			$insert = "INSERT INTO `DictionaryData`(`Update_Date`, `Update_Time`, `Variable_Name_Type`, `Variable_Name`) values('".date('Y-m-d')."','".date('H:i:s')."','".mysqli_real_escape_string($con,$_POST['VNameType'])."','".mysqli_real_escape_string($con,strtoupper($_POST['VName']))."')";
			$res=$con->query($insert);
			if($res){
				$res = UpdateDateTimeFields();
				if($res['status']==1){
					$data['status']=1;
					$data['type'] = $_POST['VNameType'];
					$data['name'] = strtoupper($_POST['VName']);
				}else{
					$data['errors'][] = "Error updating Date Time Fields.";
				}
			}else{
				$data['errors'][] = $con->error;
			}
		}
	}
	header('Content-type: application/json');
	echo json_encode($data);
}

if(isset($_POST['action']) && $_POST['action']=='AddFile'){
	// global $con;
	$data=array(
		"status"=>0,
		"errors"=>array(),
		"file"=>'',
	);
	if(empty($_POST['FName'])){
		$data['errors'][] = 'FileName is required';
	}
	if(empty($data['errors'])){
		// add file 
		// check if already exists 
		$select = "select * from `FileData` where FileName='".mysqli_real_escape_string($con,strtoupper($_POST['FName']))."'";
		$res=$con->query($select);
		if($res->num_rows){
			$data['errors'][] = "FileName already exists.";
		}else{
			$insert = "INSERT INTO `FileData`(`Update_Date`, `Update_Time`, `FileName`) values('".date('Y-m-d')."','".date('H:i:s')."','".mysqli_real_escape_string($con,strtoupper($_POST['FName']))."')";
			$res=$con->query($insert);
			if($res){
				$res = UpdateDateTimeFields();
				if($res['status']==1){
					$data['status']=1;
					$data['file'] = strtoupper($_POST['FName']);
				}else{
					$data['errors'][] = "Error updating Date Time Fields.";
				}
			}else{
				$data['errors'][] = $con->error;
			}
		}
	}
	header('Content-type: application/json');
	echo json_encode($data);
}


if(isset($_POST["import-csv"])){
    $data=array(
		"status"=>0,
		"errors"=>array(),
		"file"=>'',
	);
    $fileName = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($fileName, "r");
        $i=0; 
		$insert_query="insert into DictionaryData(".$PRODUCT_HEADERS['Dict'].") values ";
		$counter=0;
        // $column_heading = '`user_type`, `membership_type_id`, `first_name`, `last_name`, `user_email`, `is_enabled`, `created_on`';      
        while (($column = fgetcsv($file)) !== FALSE) {
            if($i==0){
            	$i=1;
				if(strcasecmp(trim(implode(",",$column)),trim($PRODUCT_HEADERS['Dict']))!=0)
				{
					$data['errors'][]="Headers are not in correct order or format. The Correct order is as follows: <br>".$PRODUCT_HEADERS['Dict'];
					$counter++;
					break;
				}
           		continue;
            }
			$check_existence_query="select * from DictionaryData where Variable_Name='".mysqli_real_escape_string($con,$column[3])."' and Variable_Name_Type='".mysqli_real_escape_string($con,$column[2])."'";
			$result=$con->query($check_existence_query);
			if($result and $result->num_rows!=0)
			{
				$data['errors'][]="Request Failed. No records were added or updated. Duplicate records found in CSV file. Please use the ‘Edit’ pages to update existing records and use the CSV file to upload new records.";
				$counter++;
				break;
			}
			else
			{
				if($column[2]=="FIELD" or $column[2]=="FILE")
				{
					$var_name_type=mysqli_real_escape_string($con,$column[2]);
				}
				else
				{
					$data['errors'][]="Error at Row $i,Column Variable_Name_Type:- Invalid Value(Only FIELD and FILE allowed)";
					$counter++;
				}
				if(trim($column[3])!="")
				{
					$var_name=mysqli_real_escape_string($con,$column[3]);
				}
				else
				{
			    	$data['errors'][]="Error at Row $i,Column Variable_Name:- Value is Required";
					$counter++;
				}
				$business_def=mysqli_real_escape_string($con,$column[4]);
				$business_exam=mysqli_real_escape_string($con,$column[5]);
				$tech_def=mysqli_real_escape_string($con,$column[6]);
				$tech_example=mysqli_real_escape_string($con,$column[7]);
				$keyword=mysqli_real_escape_string($con,$column[8]);
				$reference=mysqli_real_escape_string($con,$column[9]);
				$See_also=mysqli_real_escape_string($con,$column[10]);
				$X_Ref=mysqli_real_escape_string($con,$column[11]);
				$UD1=mysqli_real_escape_string($con,$column[11]);
				$UD2=mysqli_real_escape_string($con,$column[12]);
				$UD3=mysqli_real_escape_string($con,$column[13]);
				$UD4=mysqli_real_escape_string($con,$column[14]);
				$UD5=mysqli_real_escape_string($con,$column[15]);
				if($counter==0)
				{
					$insert_query.="('','','".$var_name_type."','".$var_name."','".$business_def."','".$business_exam."','".$tech_def."','".$tech_example."','".$keyword."','".$reference."','".$See_also."','".$X_Ref."','".$UD1."','".$UD2."','".$UD3."','".$UD4."','".$UD5."'),";
					$i++;
				}
				else
				{
				    $i++;
					continue;
				}
			}
        }
		if($counter==0)
		{
		    keep_last_good_copy();
			$insert_query=substr($insert_query,0,strlen($insert_query)-1);
			$result=$con->query($insert_query);
			if($result)
			{
				$data['status']=1;
				UpdateDateTimeFields();
			}
			else
			{
			    $data['errors'][]=$con->error;
			}
		}
    }
    header('Content-type: application/json');
    echo json_encode($data);
}







if(isset($_POST["import-field-csv"])){
    $data=array(
		"status"=>0,
		"errors"=>array(),
		"file"=>'',
	);
    $fileName = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($fileName, "r");
        $i=0; 
    	$insert_query="insert into FieldData(".$PRODUCT_HEADERS['Field'].") values ";
		$counter=0;
        // $column_heading = '`user_type`, `membership_type_id`, `first_name`, `last_name`, `user_email`, `is_enabled`, `created_on`';      
        while (($column = fgetcsv($file)) !== FALSE) {
            if($i==0){
            	$i=1;
				if(strcasecmp(trim(implode(",",$column)),trim($PRODUCT_HEADERS['Field']))!=0)
				{
					$data['errors'][]="Headers are not in correct order or format. The Correct order is as follows: <br>".$PRODUCT_HEADERS['Field'];
					$counter++;
					break;
				}
           		continue;
            }
			$check_existence_query="select * from FieldData where FieldName='".mysqli_real_escape_string($con,$column[3])."';";
			$result=$con->query($check_existence_query);
			if($result and $result->num_rows!=0)
			{
				$data['errors'][]="Request Failed. No records were added or updated. Duplicate records found in CSV file. Please use the ‘Edit’ pages to update existing records and use the CSV file to upload new records.";
				$counter++;
				break;
			}
			else
            {
					$Anniversary_Date=mysqli_real_escape_string($con,mysql_date($column[2]));
					if(trim($column[3])!="")
					{
						$FName=mysqli_real_escape_string($con,$column[3]);
					}
					else
					{
						$data['errors'][]="Error at Row $i,Column FieldName:- Value is Required";
						$counter++;
					}
					if(trim($column[4])!="")
					{
						$FlName=mysqli_real_escape_string($con,$column[4]);
					}
					else
					{
						$data['errors'][]="Error at Row $i,Column FileName:- Value is Required";
						$counter++;
					}
					if(trim($column[5])!="")
					{
						$Act_Ind=mysqli_real_escape_string($con,$column[4]);
					}
					else
					{
						$data['errors'][]="Error at Row $i,Column Active_Indicator:- Value is Required";
						$counter++;
					}
					if(trim($column[5])=="YES" and trim($column[6])=="")
					{
						$InDate="2100-12-31";
					}
					else if(trim($column[5])=="YES" and trim($column[6])!="")
					{
						$InDate=mysqli_real_escape_string($con,mysql_date($column[6]));
					}
					else if(trim($column[5])=="NO" and trim($column[6])!="")
					{
						$InDate=mysqli_real_escape_string($con,mysql_date($column[6]));
					}
					else
					{
						$data['errors'][]="Error at Row $i,Column Inactive_Date:- Value is Required when Active_Indicator is 'NO'";
						$counter++;
					}
					//if(trim(strtoupper($column[7]))!="HIGH" and trim(strtoupper($column[7]))!="CRITICAL" and trim(strtoupper($column[7]))!="LOW" and trim(strtoupper($column[7]))!="MEDIUM" and trim(strtoupper($column[7]))!="IGNORE")
				//	{
					//	$data['errors'][]="Error at Row $i,Column Risk_Rating:- Invalid Value; Allowed Values:- High,Low,Critical,Medium,Ignore";
					//	$counter++;
				//	}
				//	else
				//	{
						$rsk=mysqli_real_escape_string($con,$column[7]);
				//	}
					$Comm=mysqli_real_escape_string($con,$column[8]);
					//if(trim(strtoupper($column[9]))=="NUMBER" or trim(strtoupper($column[9]))=="STRING" or trim(strtoupper($column[9]))=="DATE")
					//{
						$type=mysqli_real_escape_string($con,$column[9]);
					//}
				//	else
				//	{
					//	$data['errors'][]="Error at Row $i,Column Field Type:- Invalid Value; Allowed Values:- Number,String";
					//	$counter++;
				//	}
					if(is_numeric(trim($column[10])) and $column[10]>0)
					{
						$Fllen=mysqli_real_escape_string($con,$column[10]);
					}
					else
					{
						$data['errors'][]="Error at Row $i,Column Field Length:- Invalid Value; Allowed Values:- Integer Greater than 0";
						$counter++;
					}
					$Flformat=mysqli_real_escape_string($con,$column[11]);
					$PrName=mysqli_real_escape_string($con,$column[12]);
					$PRDate=mysqli_real_escape_string($con,mysql_date($column[13]));
					$PrStep=mysqli_real_escape_string($con,$column[14]);
					$UD1=mysqli_real_escape_string($con,$column[15]);
					$UD2=mysqli_real_escape_string($con,$column[16]);
					$UD3=mysqli_real_escape_string($con,$column[17]);
					$UD4=mysqli_real_escape_string($con,$column[18]);
					$UD5=mysqli_real_escape_string($con,$column[19]);
					if($counter==0)
					{
						$insert_query.="('','','".$Anniversary_Date."','".$FName."','".$FlName."','".$Act_Ind."','".$InDate."','".$rsk."','".$Comm."','".$type."','".$Fllen."','".$Flformat."','".$PrName."','".$PRDate."','".$PrStep."','".$UD1."','".$UD2."','".$UD3."','".$UD4."','".$UD5."'),";
						$i++;
					}
					else
					{
						$i++;
						continue;
					}
				}
        }
		if($counter==0)
		{
		    keep_last_good_copy();
			$insert_query=substr($insert_query,0,strlen($insert_query)-1);
			$result=$con->query($insert_query);
			if($result)
			{
				$data['status']=1;
				UpdateDateTimeFields();
			}
			else
			{
			    $data['errors'][]=$con->error;
			}
		}
    }
    header('Content-type: application/json');
    echo json_encode($data);
}




if(isset($_POST["import-file-csv"])){
    $data=array(
		"status"=>0,
		"errors"=>array(),
		"file"=>'',
	);
    $fileName = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($fileName, "r");
        $i=0; 
    	$insert_query="insert into FileData(".$PRODUCT_HEADERS['File'].") values ";
		$counter=0;
        // $column_heading = '`user_type`, `membership_type_id`, `first_name`, `last_name`, `user_email`, `is_enabled`, `created_on`';      
        while (($column = fgetcsv($file)) !== FALSE) {
            if($i==0){
            	$i=1;
				if(strcasecmp(trim(implode(",",$column)),trim($PRODUCT_HEADERS['File']))!=0)
				{
					$data['errors'][]="Headers are not in correct order or format. The Correct order is as follows: <br>".$PRODUCT_HEADERS['File'];
					$counter++;
					break;
				}
           		continue;
            }
			$check_existence_query="select * from FileData where FileName='".mysqli_real_escape_string($con,$column[5])."';";
			$result=$con->query($check_existence_query);
			if($result and $result->num_rows!=0)
			{
				$data['errors'][]="Request Failed. No records were added or updated. Duplicate records found in CSV file. Please use the ‘Edit’ pages to update existing records and use the CSV file to upload new records.";
				$counter++;
				break;
			}
			else
            {
					if(trim($column[2])!="")
					{
							$Cl1=mysqli_real_escape_string($con,$column[2]);
					}
					else
					{
						$errors[]="Error at Row $i,Column Class1:- Value is Required";
						$counter++;
					}
					if(trim($column[3])!="")
					{
						$Cl2=mysqli_real_escape_string($con,$column[3]);
					}
					else
					{
						$errors[]="Error at Row $i,Column Class2:- Value is Required";
						$counter++;
					}
					if(trim($column[4])!="")
					{
							$Cl3=mysqli_real_escape_string($con,$column[4]);
					}
					else
					{
						$errors[]="Error at Row $i,Column Class3:- Value is Required";
						$counter++;
					}
					if(trim($column[5])!="")
					{
						$FlName=mysqli_real_escape_string($con,$column[5]);
					}
					else
					{
						$errors[]="Error at Row $i,Column FileName:- Value is Required";
						$counter++;
					}
					if(trim($column[6])!="")
					{
						$FlPath=mysqli_real_escape_string($con,$column[6]);
					}
					else
					{
						$errors[]="Error at Row $i,Column FilePath:- Value is Required";
						$counter++;
					}
					if(trim($column[7])!="")
					{
						$Act_Ind=mysqli_real_escape_string($con,$column[7]);
					}
					else
					{
						$errors[]="Error at Row $i,Column Active_Indicator:- Value is Required";
						$counter++;
					}
					if(trim($column[7])=="YES" and trim($column[8])=="")
					{
						$InDate="2100-12-31";
					}
					else if(trim($column[7])=="YES" and trim($column[8])!="")
					{
						$InDate=mysqli_real_escape_string($con,mysql_date($column[8]));
					}
					else if(trim($column[7])=="NO" and trim($column[8])!="")
					{
						$InDate=mysqli_real_escape_string($con,mysql_date($column[8]));
					}
					else
					{
						$errors[]="Error at Row $i,Column Inactive_Date:- Value is Required when Active_Indicator is 'NO'";
						$counter++;
					}
					//if(trim(strtoupper($column[9]))!="HIGH" and trim(strtoupper($column[9]))!="CRITICAL" and trim(strtoupper($column[9]))!="LOW" and trim(strtoupper($column[9]))!="MEDIUM" and trim(strtoupper($column[9]))!="IGNORE")
					//{
						//$errors[]="Error at Row $i,Column Risk_Rating:- Invalid Value; Allowed Values:- High,Low,Critical,Medium,Ignore";
						//$counter++;
				//	}
				//	else
				//	{
						$rsk=mysqli_real_escape_string($con,$column[9]);
				//	}
					$Comm=mysqli_real_escape_string($con,$column[10]);
					if(trim($column[11])!="")
					{
						$Anniversary_Date=mysqli_real_escape_string($con,mysql_date($column[11]));;
					}
					else
					{
						$Anniversary_Date="NULL";
					}
					$UD1=mysqli_real_escape_string($con,$column[12]);
					$UD2=mysqli_real_escape_string($con,$column[13]);
					$UD3=mysqli_real_escape_string($con,$column[14]);
					$UD4=mysqli_real_escape_string($con,$column[15]);
					$UD5=mysqli_real_escape_string($con,$column[16]);
					if($counter==0)
					{
						$insert_query.="('','','".$Cl1."','".$Cl2."','".$Cl3."','".$FlName."','".$FlPath."','".$Act_Ind."','".$InDate."','".$rsk."','".$Comm."','".$Anniversary_Date."','".$UD1."','".$UD2."','".$UD3."','".$UD4."','".$UD5."'),";
						$i++;
					}
					else
					{
						$i++;
						continue;
					}
				}
        }
		if($counter==0)
		{
		    keep_last_good_copy();
			$insert_query=substr($insert_query,0,strlen($insert_query)-1);
			$result=$con->query($insert_query);
			if($result)
			{
				$data['status']=1;
				UpdateDateTimeFields();
			}
			else
			{
			    $data['errors'][]=$con->error;
			}
		}
    }
    header('Content-type: application/json');
    echo json_encode($data);
}





if(isset($_POST['action']) && $_POST['action']=='AddField'){
	// global $con;
	$data=array(
		"status"=>0,
		"errors"=>array(),
		"field"=>'',
	);
	if(empty($_POST['FName'])){
		$data['errors'][] = 'FieldName is required';
	}
	if(empty($data['errors'])){
		// add field 
		// check if already exists 
		$select = "select * from `FieldData` where FieldName='".mysqli_real_escape_string($con,strtoupper($_POST['FName']))."'";
		$res=$con->query($select);
		if($res->num_rows){
			$data['errors'][] = "FieldName already exists.";
		}else{
			$insert = "INSERT INTO `FieldData`(`Update_Date`, `Update_Time`, `FieldName`) values('".date('Y-m-d')."','".date('H:i:s')."','".mysqli_real_escape_string($con,strtoupper($_POST['FName']))."')";
			$res=$con->query($insert);
			if($res){
				$res = UpdateDateTimeFields();
				if($res['status']==1){
					$data['status']=1;
					$data['field'] = strtoupper($_POST['FName']);
				}else{
					$data['errors'][] = "Error updating Date Time Fields.";
				}	
			}else{
				$data['errors'][] = $con->error;
			}
		}
	}
	header('Content-type: application/json');
	echo json_encode($data);
}
?>
