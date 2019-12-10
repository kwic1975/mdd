<?php
include_once(dirname(__FILE__)."/header.php");

// get report based on variable name and variable name type 
if(!empty($_GET['name']) && !empty($_GET['type'])){
	$sql="select * from DictionaryData where Variable_Name='".mysqli_real_escape_string($con,$_GET['name'])."' and Variable_Name_Type='".mysqli_real_escape_string($con,$_GET['type'])."'";
	$res=$con->query($sql);
	if($res->num_rows){
		?>
		<div class='row'>
			<div class="col-md-1 col-sm-12"></div>
			<div class='col-md-10 col-sm-12 table-responsive'>
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
								<td><?php echo (!empty($row['Update_Date']))?$row['Update_Date']:''; ?></td>
								<td><?php echo (!empty($row['Update_Time']))?$row['Update_Time']:''; ?></td>
							</tr>
						<?php 
						}
						?>
					</tbody>
				</table>
				<h3>
				<a href="<?php echo SITE_URL;?>/name-search.php">Back to Name Search</a>
				</h3>
			</div>
		</div>
		<div class="col-md-1 col-sm-12"></div>
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