<?php
require_once(dirname(__FILE__)."/header.php");
Check_permission();
$query_first="SELECT DISTINCT(FieldName) from FieldData order by FieldName ASC";
$result_first=$con->query($query_first);
if($result_first and $result_first->num_rows!=0)
{
	//ok
}
else
{
	echo "<center><h2>No Data Found in FieldData</h2></center>";
	die();
}
$query_second="SELECT DISTINCT(Risk_Rating) from FieldData order by Risk_Rating";
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
$query_cls1="SELECT distinct(FileName) from FileData";
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
$query_cls3="SELECT distinct(Field_Type) from FieldData";
$result_cls3=$con->query($query_cls3);
if($result_cls3 and $result_cls3->num_rows!=0)
{
	//ok
}
else
{
	echo "<center><h2>No Data Found in FieldData</h2></center>";
	die();
}
?>
<script>
    $(document).ready(function(){
        $("#Indate").datepicker();
        $("#Anndate").datepicker();
        $("#PNdate").datepicker();
        update_act_date();
    });
</script>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-11">
	<center>
		<h2>
			Edit Field Data	
		</h2>
	</center>
		<form class="form-inline" method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<div class="form-group">
				<label for="field_name">Field Name:</label>
				<select id="field_name" name="field" class="form-control" onchange="this.form.submit()">
					<option disabled selected>-Select A Field-</option>
					<?php 
						while($row=$result_first->fetch_assoc())
						{
							echo "<option value=".$row['FieldName']." ";
							if(isset($_GET['field']) and $_GET['field']==$row['FieldName'])
							{
								echo "selected";
							}
							echo ">".$row['FieldName']."</option>";
						}
					?>
				</select>
			</div>
	</form>
	</div>
</div>
<?php
if(isset($_GET['field']))
{
	$query="SELECT count(*) from FieldData where FieldName='".mysqli_real_escape_string($con,$_GET['field'])."'";
	{
		$result=$con->query($query);
		if($result and $result->num_rows!=0)
		{
			$row_count=$result->fetch_assoc();
		}
		$count=$row_count['count(*)'];
	}
	$query="SELECT * from FieldData where FieldName='".mysqli_real_escape_string($con,$_GET['field'])."'";
	//echo $query;
	$result=$con->query($query);
	if($result and $result->num_rows!=0)
	{
		$row_data=$result->fetch_assoc();
	}
?>
<div class="row" id="form-file">
	<div class="col-sm-1"></div>
	<div class="col-sm-11">
		  <ul class="nav nav-tabs nav-justified">
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='1'){echo "active";}else if(!isset($_GET['tab'])){
				echo "active";
			}?>"><a data-toggle="tab" href="#1">Field Information</a></li>
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='2'){echo "active";}?>"><a data-toggle="tab" href="#2">Activity Information</a></li>
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='3'){echo "active";}?>"><a data-toggle="tab" href="#3">Prior Information</a></li>
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='4'){echo "active";}?>"><a data-toggle="tab" href="#4">User Defined</a></li>
		  </ul>
		  <div class="tab-content">
			<div id="1" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='1'){echo "active in";}else if(!isset($_GET['tab'])){
				echo "active in";
			}?>">
			<h3>Field Information</h3>
				<form class="update-field-form" action="JavaScript:void(0);" data-next="2">
					<div class="form-group col-sm-6">
							<label for="FileName">File Name :</label>
							<select id="FileName" name="FileName" class="form-control" <?php if($count!=1){echo "disabled"; } ?> required>
							<option value=''>Select</option>
								<?php 
									while($row=$result_cls1->fetch_assoc())
									{
										echo "<option id=".htmlspecialchars($row['FileName'])." value='".htmlspecialchars($row['FileName'])."'";
										if($row['FileName']==$row_data['FileName'] and $count==1)
										{
											echo " selected";
										}
										echo ">".htmlspecialchars($row['FileName'])."</option>";
									}
								?>
							</select>
					</div>
					<div class="form-group col-sm-6">
							<label for="Field_Type">Field Type :</label>
							<select id="Field_Type" name="Field_Type" class="form-control">
							    <option value=''>Select</option>
							    <option id='Number' value='Number' <?php if($row_data['Field_Type']=="Number"){echo "selected";}?>>Number</option>
							    <option id='String' value='String' <?php if($row_data['Field_Type']=="String"){echo "selected";}?>>String</option>
							</select>
					</div>
					<div class="form-group col-sm-6">
							<label for="FieldLength">Field Length:</label>
							<input type="number" id="FieldLength" name="FieldLength" class="form-control" value="<?php echo htmlspecialchars($row_data['Field_Length']); ?>">
					</div>
					<div class="form-group col-sm-6">
							<label for="FieldFormat">Field Format:</label>
							<input type="text" id="FieldFormat" name="FieldFormat" class="form-control" value="<?php echo htmlspecialchars($row_data['Field_Format']); ?>">
					</div>
					<div class="form-group col-sm-12">
						<input type="submit" class="btn btn-success" value="Save and Next" name="save_step">
					</div>
					<input type="hidden" value="1" name="Step">
					<input type="hidden" value="2" name="next">
					<input type="hidden" value="<?php echo $count; ?>" name="count">
				</form>
			</div>
			<div id="2" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='2'){echo "active in";}?>">
			  <h3>Activity Information</h3>
			  <form class="update-field-form" data-next="3">
					<div class="form-group col-sm-6">
							<label for="Indate">Inactive_Date:</label>
							<input type="text" id="Indate" name="Indate" class="form-control" required value="<?php echo htmlspecialchars(ui_date($row_data['Inactive_Date'])); ?>">
					</div>
					<div class="form-group col-sm-6">
							<label for="rsk_rating">Risk_Rating:</label>
							<select id="rsk_rating" name="rsk_rating" class="form-control" >
							    <option value=''>Select</option>
							    <option id='Critical' value='Critical' <?php if($row_data['Risk_Rating']=="Critical"){echo "selected";}?>>Critical</option>
							    <option id='High' value='High' <?php if($row_data['Risk_Rating']=="High"){echo "selected";}?>>High</option>
							    <option id='Medium' value='Medium' <?php if($row_data['Risk_Rating']=="Medium"){echo "selected";}?>>Medium</option>
							    <option id='Low' value='Low' <?php if($row_data['Risk_Rating']=="Low"){echo "selected";}?>>Low</option>
							    <option id='High' value='High' <?php if($row_data['Risk_Rating']=="High"){echo "selected";}?>>High</option>
							</select>
					</div>
					<div class="form-group col-sm-12">
							<label for="field_comments">Comments :</label>
							<input type="text" id="field_comments" class="form-control" name="field_comments" value="<?php echo htmlspecialchars($row_data['Comments']); ?>">
					</div>
					<div class="form-group col-sm-6">
							<label for="file_comments">Anniversary Date:</label>
							<input type="text" id="Anndate" name="Anndate" class="form-control" value="<?php echo htmlspecialchars(ui_date($row_data['Anniversary_Date'])); ?>">
					</div>
					<div class="form-group col-sm-12">
					</div>
					<div class="form-group col-sm-6">
							<label for="act_indicator">Active_Indicator : <input type="checkbox" id="act_indicator" name="act_indicator" 
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
			<h3>Prior Information</h3>
				<form class="update-field-form" action="JavaScript:void(0);" data-next="4">
					<div class="form-group col-sm-6">
							<label for="PriorName">Prior Name :</label>
							<input type="text" id="PriorName" name="PriorName" class="form-control"  value="<?php echo htmlspecialchars($row_data['Prior_Name']); ?>">
					</div>
					<div class="form-group col-sm-6">
							<label for="file_comments">Prior Name Date:</label>
							<input type="text" id="PNdate" name="PNdate" class="form-control"  value="<?php echo htmlspecialchars($row_data['Prior_Name_Date']); ?>">
					</div>
					<div class="form-group col-sm-6">
							<label for="PROC_Step">PROC_Step:</label>
							<input type="text" id="PROC_Step" name="PROC_Step" class="form-control"  value="<?php if($count==1){echo $row_data['PROC_Step'];} ?>" 
							<?php 
								if($count>1)
								{
									echo "disabled";
								} 
							?> >
					</div>
					<div class="form-group col-sm-12">
						<input type="submit" class="btn btn-success" value="Save and Next" name="save_step">
					</div>
					<input type="hidden" value="3" name="Step">
					<input type="hidden" value="4" name="next">
					<input type="hidden" value="<?php echo $count; ?>" name="count">
				</form>
			</div>
			
			<div id="4" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='4'){echo "active in";}?>">
			  <h3>User Defined</h3>
			  <form class="update-field-form" data-next='4'>
					<div class="form-group">
							<label for="ud1">User Defined 1 :</label>
							<input type="text" id="ud1" class="form-control" name="ud1" value="<?php echo $row_data['User_Defined1']; ?>">
					</div>
					<div class="form-group">
							<label for="ud2">User Defined 2:</label>
							<input type="text" id="ud2" class="form-control" name="ud2" value="<?php echo $row_data['User_Defined2']; ?>">
					</div>
					<div class="form-group">
							<label for="ud3">User Defined 3:</label>
							<input type="text" id="ud3" class="form-control" name="ud3" value="<?php echo $row_data['User_Defined3']; ?>">
					</div>
					<div class="form-group">
							<label for="ud4">User Defined 4:</label>
							<input type="text" id="ud4" class="form-control" name="ud4" value="<?php echo $row_data['User_Defined4']; ?>">
					</div>
					<div class="form-group">
							<label for="ud5">User Defined 5:</label>
							<input type="text" id="ud5" class="form-control" name="ud5" value="<?php echo $row_data['User_Defined5']; ?>">
					</div>
					<input type="hidden" value="4" name="Step">
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