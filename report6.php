<?php
include_once(dirname(__FILE__)."/header.php");

?>
<div class='row report_cont'>
	
	<div class='col-sm-12'>
		<h3><center>Report to list all FieldNames, Business_Definitions for a drop-down list of FileNames</center></h3>
		<form id="SelectFileName">
			<select class='form-control p-select' name='filename'>
				<option value=''>Select FileName</option>
				<?php 
				$sql="SELECT DISTINCT FileName as Drop_Down_List FROM FileData where Class1 <> 'PROC' ORDER BY FileName";
				$res=$con->query($sql);
				if($res->num_rows){
					while($row=$res->fetch_assoc()){
						?>
						<option value='<?php echo $row['Drop_Down_List'] ?>' <?php if(!empty($_GET['filename'])){ if($_GET['filename']==$row['Drop_Down_List']){ echo "selected"; } } ?>><?php echo $row['Drop_Down_List'] ?></option>
					<?php 
					}
				}
				?>
			</select>
			<button type='submit' class='btn btn-primary'>Get Dictionary</button>
		</form>
		<?php if(!empty($_GET['filename'])){ ?>
		<div class='table-responsive'>
			<table class='p-table centerTable11'>
				<thead class='stick_to_top'>
					<tr>
						<th>Variable_Name</th>
						<th>Variable_Name_Type</th>
						<th>Business_Definition</th>
						<th>Keyword</th>
						<th>Update_Date</th>
						<th>Update_Time</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					// $sql="SELECT Variable_Name,Variable_Name_Type, Business_Definition, Keyword, b.Update_Date, b.Update_Time FROM DictionaryData a, FileData b WHERE a.Variable_Name='".mysqli_real_escape_string($con,$_GET['filename'])."' AND a.Variable_Name_Type='FILE'";
					$sql="SELECT a.Variable_Name,a.Variable_Name_Type, a.Business_Definition, a.Keyword, a.Update_Date, a.Update_Time FROM DictionaryData a WHERE a.Variable_Name IN (SELECT DISTINCT FieldName FROM FieldData WHERE FileName='".mysqli_real_escape_string($con,$_GET['filename'])."')";
					$res=$con->query($sql);
					if($res->num_rows){
						while($row=$res->fetch_assoc()){
							?>
							<tr>
								<td><?php echo $row['Variable_Name']; ?></td>
								<td><?php echo $row['Variable_Name_Type']; ?></td>
								<td><?php echo $row['Business_Definition']; ?></td>
								<td><?php echo $row['Keyword']; ?></td>
								<td><?php echo $row['Update_Date']; ?></td>
								<td><?php echo $row['Update_Time']; ?></td>
							</tr>
						<?php 
						}
					}else{
						?>
						<tr><td colspan='6' align='center'>No records to display</td></tr>
					<?php 
					}
					?>
				</tbody>
			</table>
		</div>
		<?php } ?>
	</div>
	<center>
		<h3><a class='back_link' href="<?php echo SITE_URL;?>/reports.php">Back to Maintenance Reports</a></h3>
	</center>
</div>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>