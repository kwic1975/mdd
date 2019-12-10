<?php
include_once(dirname(__FILE__)."/header.php");

?>
<div class='row report_cont'>
	<div class='col-sm-1'></div>
	<div class='col-sm-11'>
		<h3>Report to list all FieldNames, Business_Definitions for a drop-down list of FileNames</h3>
		<form id="SelectFileName">
			<select class='form-control p-select' name='filename'>
				<option value=''>Select FileName</option>
				<?php 
				$sql="SELECT DISTINCT FileName as Drop_Down_List FROM FileData ORDER BY FileName";
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
			<table class='p-table'>
				<tbody>
					<tr>
						<td>Variable_Name</td>
						<td>Variable_Name_Type</td>
						<td>Business_Definition</td>
						<td>Keyword</td>
						<td>Update_Date</td>
						<td>Update_Time</td>
					</tr>
					<?php 
					$sql="SELECT Variable_Name,Variable_Name_Type, Business_Definition, Keyword, b.Update_Date, b.Update_Time FROM DictionaryData a, FileData b WHERE a.Variable_Name='".mysqli_real_escape_string($con,$_GET['filename'])."' AND a.Variable_Name_Type='FILE'";
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
		<h3><a href="<?php echo SITE_URL;?>/reports.php">Back to Maintenance Reports</a></h3>
	</center>
</div>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>