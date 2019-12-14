<?php
require_once(dirname(__FILE__)."/header.php");
Check_permission();
$query_first="SELECT DISTINCT(variable_name_type) from DictionaryData";
$result_first=$con->query($query_first);
if($result_first and $result_first->num_rows!=0)
{
	//ok
}
else
{
	echo "<center><h2>No Data Found in DictionaryData</h2></center>";
	die();
}
if(isset($_GET['type']))
{
	$q1="SELECT distinct(Variable_Name) from DictionaryData where Variable_Name_Type='".mysqli_real_escape_string($con,urldecode($_GET['type']))."' order by Variable_Name";
	$result=$con->query($q1);
	if($result and $result->num_rows!=0)
	{
		//ok
	}
}
?>
<div class="row">
	<center>
		<h2>
			Edit Dictionary
		</h2>
	</center>
		<form class="form-inline">
			<div class="form-group col-sm-6">
				<label for="variable_type">Variable_Name_Type:</label>
				<select id="variable_type" class="form-control">
					<option disabled selected>-Select A Variable Type-</option>
					<?php 
						while($row=$result_first->fetch_assoc())
						{
							echo "<option value=".urlencode($row['variable_name_type'])." ";
							if(isset($_GET['type']) and urldecode($_GET['type'])==$row['variable_name_type'])
							{
								echo "selected";
							}
							echo ">".$row['variable_name_type']."</option>";
						}
					?>
				</select>
			</div>
			<div class="form-group col-sm-6">
				<label for="variable_name">Variable_Name :</label>
				<select id="variable_name" class="form-control">
					<option disabled selected>-Select A Variable-</option>
					<?php
						while($row=$result->fetch_assoc())
						{
							echo "<option value=".urlencode($row['Variable_Name'])." ";
							if(isset($_GET['var']) and urldecode($_GET['var'])==$row['Variable_Name'])
							{
								echo "selected";
							}
							echo ">".$row['Variable_Name']."</option>";
						}
					?>
				</select>
			</div>
		</form>
</div>
<?php
if(isset($_GET['type']) and isset($_GET['var']))
{
	$query="SELECT * from DictionaryData where Variable_Name_Type='".mysqli_real_escape_string($con,urldecode($_GET['type']))."' and Variable_Name='".mysqli_real_escape_string($con,urldecode($_GET['var']))."'";
	$result=$con->query($query);
	if($result and $result->num_rows!=0)
	{
		$row_data=$result->fetch_assoc();
	}
?>
<div class="alert alert-danger alert-dismissible" role="alert" id="error" style="display:none; margin-top:20px;">
</div>
<div class="row" id="form-dict">
	
	<div class="col-sm-12">
		  <ul class="nav nav-tabs nav-justified">
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='1'){echo "active";}else if(!isset($_GET['tab'])){
				echo "active";
			}?>"><a data-toggle="tab" href="#1">Business Information</a></li>
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='2'){echo "active";}?>"><a data-toggle="tab" href="#2">Technical Information</a></li>
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='3'){echo "active";}?>"><a data-toggle="tab" href="#3">Reference Information</a></li>
			<li class="<?php if(isset($_GET['tab']) and $_GET['tab']=='4'){echo "active";}?>"><a data-toggle="tab" href="#4">User Defined</a></li>
		  </ul>
		  <div class="tab-content">
			<div id="1" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='1'){echo "active in";}else if(!isset($_GET['tab'])){
				echo "active in";
			}?>">
			<h3>Business Information</h3>
				<form class="update-dict-form" action="return false" data-next="2">
					<div class="form-group">
							<label for="Bdefinition">Business_Definition :</label>
							<input type="text" id="Bdefinition" name="Bdefinition" class="form-control" required value="<?php if(isset($row_data['Business_Definition'])){echo htmlspecialchars($row_data['Business_Definition']);}?>">
					</div>
					<div class="form-group">
							<label for="Bexample">Business_Example:</label>
							<input type="text" id="Bexample" name="Bexample" class="form-control" value="<?php if(isset($row_data['Business_Example'])){echo htmlspecialchars($row_data['Business_Example']); }?>">
					</div>
					<div>
						<input type="submit" class="btn btn-success" value="Save and Next" name="save_step">
					</div>
					<input type="hidden" value="1" name="Step">
					<input type="hidden" value="2" name="next">
				</form>
			</div>
			<div id="2" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='2'){echo "active in";}?>">
			  <h3>Technical Information</h3>
			  <form class="update-dict-form" data-next="3">
				  <div class="form-group">
							<label for="Tdefinition">Technical_Definition :</label>
							<input type="text" id="Tdefinition" name="Tdefinition" class="form-control"  value="<?php if(isset($row_data['Technical_Definition'])){echo htmlspecialchars($row_data['Technical_Definition']); }?>">
					</div>
					<div class="form-group">
							<label for="Texample">Technical_Example:</label>
							<input type="text" id="Texample" name="Texample" class="form-control" value="<?php if(isset($row_data['Technical_Example'])){echo htmlspecialchars($row_data['Technical_Example']); }?>">
					</div>
					<div>
						<input type="submit" class="btn btn-success" value="Save and Next" name="save_step">
					</div>
					<input type="hidden" value="2" name="Step">
					<input type="hidden" value="3" name="next">
				</form>
			</div>
			<div id="3" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='3'){echo "active in";}?>">
			  <h3>Reference Information</h3>
			  <form class="update-dict-form" data-next="4">
					<div class="form-group col-sm-6">
							<label for="Kword">Keyword :</label>
							<input type="text" id="Kword" name="Kword" class="form-control" required value="<?php if(isset($row_data['Keyword'])){echo htmlspecialchars($row_data['Keyword']);}?>"> 
					</div>
					<div class="form-group col-sm-6">
							<label for="Ref">Reference:</label>
							<input type="text" id="Ref" name="Ref" class="form-control" value="<?php if(isset($row_data['Reference'])){echo htmlspecialchars($row_data['Reference']);}?>">
					</div>
					<div class="form-group col-sm-6">
							<label for="See_also">See_also:</label>
							<input type="text" id="See_also" name="See_also" class="form-control" value="<?php if(isset($row_data['See_also'])){echo htmlspecialchars($row_data['See_also']);}?>">
					</div>
					<div class="form-group col-sm-6">
							<label for="X_Ref">X_Ref:</label>
							<input type="text" id="X_Ref" name="X_Ref" class="form-control" value="<?php if(isset($row_data['X_Ref'])){echo htmlspecialchars($row_data['X_Ref']);}?>">
					</div>
					<input type="hidden" value="3" name="Step">
					<input type="hidden" value="4" name="next">
					<div>
						<input type="submit" class="btn btn-success" value="Save and Next" name="save_step">
					</div>
				</form>
			</div>
			<div id="4" class="tab-pane fade <?php if(isset($_GET['tab']) and $_GET['tab']=='4'){echo "active in";}?>">
			  <h3>User Defined</h3>
			  <form class="update-dict-form" data-next='4'>
					<div class="form-group">
							<label for="ud1">User_Defined1 :</label>
							<input type="text" id="ud1" class="form-control" name="ud1" value="<?php if(isset($row_data['User_Defined1'])){echo htmlspecialchars($row_data['User_Defined1']);}?>">
					</div>
					<div class="form-group">
							<label for="ud2">User_Defined2:</label>
							<input type="text" id="ud2" class="form-control" name="ud2" value="<?php if(isset($row_data['User_Defined2'])){echo htmlspecialchars($row_data['User_Defined2']);}?>">
					</div>
					<div class="form-group">
							<label for="ud3">User_Defined3:</label>
							<input type="text" id="ud3" class="form-control" name="ud3" value="<?php if(isset($row_data['User_Defined3'])){echo htmlspecialchars($row_data['User_Defined3']);}?>">
					</div>
					<div class="form-group">
							<label for="ud4">User_Defined4:</label>
							<input type="text" id="ud4" class="form-control" name="ud4" value="<?php if(isset($row_data['User_Defined4'])){echo htmlspecialchars($row_data['User_Defined4']);}?>">
					</div>
					<div class="form-group">
							<label for="ud5">User_Defined5:</label>
							<input type="text" id="ud5" class="form-control" name="ud5" value="<?php if(isset($row_data['User_Defined5'])){echo htmlspecialchars($row_data['User_Defined5']);}?>">
					</div>
					<input type="hidden" value="4" name="Step">
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