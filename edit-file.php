<?php
require_once(dirname(__FILE__)."/header.php");
Check_permission();
$query_first="SELECT DISTINCT(FileName) from FileData order by FileName";
$result_first=$con->query($query_first);
if($result_first and $result_first->num_rows!=0)
{
	//ok
}
else
{
	echo "<center><h2>No Data Found in FileData</h2></center>";
	die();
}
$query_second="SELECT DISTINCT(Risk_Rating) from FileData where (Risk_Rating is not null and Risk_Rating!='') order by Risk_Rating";
$result_second=$con->query($query_second);
if($result_second and $result_second->num_rows!=0)
{
	//ok
}
else
{
	echo "<center><h2>No Data Found in FileData</h2></center>";
	die();
}
$query_cls1="SELECT distinct(Class1) from FileData where (Class1 is not null and Class1!='') order by Class1 ";
$result_cls1=$con->query($query_cls1);
if($result_cls1 and $result_cls1->num_rows!=0)
{
	//ok
}
else
{
	echo "<center><h2>No Data Found in FileData</h2></center>";
	die();
}
$query_cls2="SELECT distinct(Class2) from FileData where (Class2 is not null and Class2!='') order by Class2";
$result_cls2=$con->query($query_cls2);
if($result_cls2 and $result_cls2->num_rows!=0)
{
	//ok
}
else
{
	echo "<center><h2>No Data Found in FileData</h2></center>";
	die();
}
$query_cls3="SELECT distinct(Class3) from FileData where (Class3 is not null and Class3!='') order by Class3";
$result_cls3=$con->query($query_cls3);
if($result_cls3 and $result_cls3->num_rows!=0)
{
	//ok
}
else
{
	echo "<center><h2>No Data Found in FileData</h2></center>";
	die();
}
?>
<script>
    $(document).ready(function(){
        $("#Indate").datepicker();
        $("#Anndate").datepicker();
        update_act_date();
    });
</script>
<div class="row">
	<div class="col-sm-12">
	<center>
		<h2>
			Edit File Data	
		</h2>
	</center>
		<form class="form-inline" method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<div class="form-group">
				<label for="file_name">File Name:</label>
				<select id="file_name" name="file" class="form-control" onchange="this.form.submit()">
					<option disabled selected>-Select A File-</option>
					<?php 
						while($row=$result_first->fetch_assoc())
						{
							echo "<option value=".urlencode(htmlspecialchars($row['FileName']))." ";
							if(isset($_GET['file']) and urldecode($_GET['file'])==$row['FileName'])
							{
								echo "selected";
							}
							echo ">".htmlspecialchars($row['FileName'])."</option>";
						}
					?>
				</select>
			</div>
	</form>
	</div>
</div>
<?php
if(isset($_GET['file']))
{
	$query="SELECT count(*) from FileData where FileName='".mysqli_real_escape_string($con,urldecode($_GET['file']))."'";
	{
		$result=$con->query($query);
		if($result and $result->num_rows!=0)
		{
			$row_count=$result->fetch_assoc();
		}
		$count=$row_count['count(*)'];
	}
	$query="SELECT * from FileData where FileName='".mysqli_real_escape_string($con,urldecode($_GET['file']))."'";
	//echo $query;
	$result=$con->query($query);
	if($result and $result->num_rows!=0)
	{
		$row_data=$result->fetch_assoc();
	}
?>
<div class="row" id="form-file">
	<div class="col-sm-12">
		  <ul class="nav nav-tabs nav-justified">
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='1'){echo "active";}else if(!isset($_GET['tab'])){
				echo "active";
			}?>"><a data-toggle="tab" href="#1">File Information</a></li>
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='2'){echo "active";}?>"><a data-toggle="tab" href="#2">Activity Information</a></li>
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='3'){echo "active";}?>"><a data-toggle="tab" href="#3">User Defined</a></li>
		  </ul>
		  <div class="tab-content">
			<div id="1" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='1'){echo "active in";}else if(!isset($_GET['tab'])){
				echo "active in";
			}?>">
			<h3>File Information</h3>
				<form class="update-file-form" action="JavaScript:void(0);" data-next="2">
					<div class="form-group col-sm-4">
							<label for="class1">Class1:</label>
							<select id="class1" name="class1" class="form-control" required>
							    <option value=''>Select</option>
							    <?php 
            						while($row=$result_cls1->fetch_assoc())
            						{
            							echo "<option value=".htmlspecialchars($row['Class1'])." ";
            							if(isset($row['Class1']) and $row['Class1']==$row_data['Class1'])
            							{
            								echo "selected";
            							}
            							echo ">".htmlspecialchars($row['Class1'])."</option>";
            						}
            					?>
							</select>
					</div>
					<div class="form-group col-sm-4">
							<label for="class2">Class2:</label>
							<select id="class2" name="class2" class="form-control" required>
							    <option value=''>Select</option>
							    <?php 
            						while($row=$result_cls2->fetch_assoc())
            						{
            							echo "<option value=".htmlspecialchars($row['Class2'])." ";
            							if(isset($row['Class2']) and $row['Class2']==$row_data['Class2'])
            							{
            								echo "selected";
            							}
            							echo ">".htmlspecialchars($row['Class2'])."</option>";
            						}
            					?>
							</select>
					</div>
					<div class="form-group col-sm-4">
							<label for="class3">Class3:</label>
							<select id="class3" name="class3" class="form-control" required <?php if($count>1)
							{
								echo "disabled";
							}?>>
							    
							    <option value='' selected>Select</option>
							    <?php if($count>1)
    							{
    								echo "<option value='' selected>Multiple Values Found</option>";
    							}?>
							    <?php 
            						while($row=$result_cls3->fetch_assoc())
            						{
            							echo "<option value=".htmlspecialchars($row['Class3'])." ";
            							if(isset($row['Class3']) and ($row['Class3']==$row_data['Class3']) and $count==1)
            							{
            								echo "selected";
            							}
            							echo ">".htmlspecialchars($row['Class3'])."</option>";
            						}
            					?>	    
							</select>
					</div>
					<div class="form-group col-sm-12">
							<label for="fpath">FilePath:</label>
							<input type="text" id="fpath" name="fpath" class="form-control" <?php if($count>1)
							{
								echo "disabled";
							}?> required value="<?php if($count==1)
							{
								echo htmlspecialchars($row_data['FilePath']);
							}
							else
							{
							    echo "Multiple Values Found";
							}?>">
					</div>
					<div>
						<input type="submit" class="btn btn-success" value="Save and Next" name="save_step">
					</div>
					<input type="hidden" value="1" name="Step">
					<input type="hidden" value="2" name="next">
					<input type="hidden" value="<?php echo $count; ?>" name="count">
				</form>
			</div>
			<div id="2" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='2'){echo "active in";}?>">
			  <h3>Activity Information</h3>
			  <form class="update-file-form" data-next="3">
					<div class="form-group col-sm-6">
							<label for="Indate">Inactive_Date:</label>
							<input type="text" id="Indate" name="Indate" class="form-control" required value="<?php echo htmlspecialchars(ui_date($row_data['Inactive_Date'])); ?>" autocomplete="off" data-empty=<?php if(isset($row_data['Inactive_Date']) and $row_data['Inactive_Date']!=""){echo "off";}else{echo "on"; }?>>
					</div>
					<div class="form-group col-sm-6">
							<label for="rsk_rating">Risk_Rating:</label>
	                        <select id="rsk_rating" name="rsk_rating" class="form-control" >
							    <option value=''>Select</option>
							    <option value='Critical' <?php if( ('Critical'==$row_data['Risk_Rating']))
            							{
            								echo "selected";
            							}?>>Critical</option>
							    <option value='High' <?php if( ('High'==$row_data['Risk_Rating']))
            							{
            								echo "selected";
            							}?>>High</option>
    							 <option value='Ignore' <?php if( ('Ignore'==$row_data['Risk_Rating']))
            							{
            								echo "selected";
            							}?>>Ignore</option>
    							 <option value='Low' <?php if( ('Low'==$row_data['Risk_Rating']))
            							{
            								echo "selected";
            							}?>>Low</option>
                                <option value='Medium' <?php if( ('Medium'==$row_data['Risk_Rating']))
            							{
            								echo "selected";
            							}?>>Medium</option>
							</select>
					</div>
					<div class="form-group col-sm-12">
							<label for="file_comments">Comments:</label>
							<input type="text" id="file_comments" class="form-control" name="file_comments" value="<?php echo htmlspecialchars($row_data['Comments']); ?>">
					</div>
					<div class="form-group col-sm-6">
							<label for="Anndate">Anniversary Date:</label>
							<input type="text" id="Anndate" name="Anndate" class="form-control" value="<?php echo htmlspecialchars(ui_date($row_data['Anniversary_Date'])); ?>">
					</div>
					<div class="form-group col-sm-12">
					</div>
					<div class="form-group col-sm-6">
							<label for="act_indicator">Active_Indicator:</label> <input type="checkbox" id="act_indicator" name="act_indicator" 
								<?php if($row_data['Active_Indicator']=="YES")
								{
									echo "Checked";	
								}?>
							></label>
					</div>
					<div class="form-group col-sm-12">
						<input type="submit" class="btn btn-success" value="Save and Next" name="save_step">
					</div>
					<input type="hidden" value="2" name="Step">
					<input type="hidden" value="3" name="next">
					<input type="hidden" value="<?php echo $count; ?>" name="count">
				</form>
			</div>
			<div id="3" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='3'){echo "active in";}?>">
			  <h3>User Defined</h3>
			  <form class="update-file-form" data-next='3'>
					<div class="form-group">
							<label for="ud1">User Defined 1:</label>
							<input type="text" id="ud1" class="form-control" name="ud1" value="<?php echo htmlspecialchars($row_data['User_Defined1']); ?>">
					</div>
					<div class="form-group">
							<label for="ud2">User Defined 2:</label>
							<input type="text" id="ud2" class="form-control" name="ud2" value="<?php echo htmlspecialchars($row_data['User_Defined2']); ?>">
					</div>
					<div class="form-group">
							<label for="ud3">User Defined 3:</label>
							<input type="text" id="ud3" class="form-control" name="ud3" value="<?php echo htmlspecialchars($row_data['User_Defined3']); ?>">
					</div>
					<div class="form-group">
							<label for="ud4">User Defined 4:</label>
							<input type="text" id="ud4" class="form-control" name="ud4" value="<?php echo htmlspecialchars($row_data['User_Defined4']); ?>">
					</div>
					<div class="form-group">
							<label for="ud5">User Defined 5:</label>
							<input type="text" id="ud5" class="form-control" name="ud5" value="<?php echo htmlspecialchars($row_data['User_Defined5']); ?>">
					</div>
					<input type="hidden" value="3" name="Step">
					<input type="hidden" value="<?php echo $count; ?>" name="count">
					<div>
						<input type="submit" class="btn btn-success" value="Save" name="save_step">
					</div>
				</form>
			</div>
		  </div>
	</div>
</div>
<?php
}
?>
<?php require_once(dirname(__FILE__)."/footer.php"); ?>