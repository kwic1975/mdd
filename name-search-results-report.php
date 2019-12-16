<?php
include_once(dirname(__FILE__)."/header.php");

// get report based on variable name and variable name type 
if(!empty($_GET['name']) && !empty($_GET['type'])){
	$sql="select * from DictionaryData where Variable_Name='".mysqli_real_escape_string($con,$_GET['name'])."' and Variable_Name_Type='".mysqli_real_escape_string($con,$_GET['type'])."'";
	$res=$con->query($sql);
	if($res->num_rows){
		?>
		<div class='row'>
			
			<div class='col-md-12 col-sm-12 table-responsive'>
				<table class='table p-table'>
					<tbody>
						<tr>
							<td>Variable Name</td>
							<td>Variable Name Type</td>
							<td>Business Definition</td>
							<td>Keyword</td>
							<td>Update Date</td>
							<td>Update Time</td>
						</tr>
						<?php 
						while($row=$res->fetch_assoc()){
							?>
							<tr>
								<td><?php echo (!empty($row['Variable_Name']))?$row['Variable_Name']:''; ?></td>
								<td><?php echo (!empty($row['Variable_Name_Type']))?$row['Variable_Name_Type']:''; ?></td>
								<td><?php echo (!empty($row['Business_Definition']))?$row['Business_Definition']:''; ?></td>
								<td><?php echo (!empty($row['Keyword']))?$row['Keyword']:''; ?></td>
								<td><?php echo (!empty($row['Update_Date']))?ui_date($row['Update_Date']):''; ?></td>
								<td><?php echo (!empty($row['Update_Time']))?ui_time($row['Update_Time']):''; ?></td>
							</tr>
						<?php 
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	
	<?php 
	}else{
		?>
		<div class='alert alert-danger'>No record found.</div>
	<?php 
	}
}else{
	?>
	<div class='alert alert-danger'>Failed to get details.</div>
	<?php 
}
include_once(dirname(__FILE__)."/footer.php"); ?>