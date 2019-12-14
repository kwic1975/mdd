<?php
include_once(dirname(__FILE__)."/header.php");

?>
<div class='row report_cont'>
	
	<div class='col-sm-12'>
		<h3><center>Keyword frequency report</center></h3>
		<?php 
		$sql="select distinct Keyword,count(*) as frequency from DictionaryData where Keyword!='' group by Keyword order by Keyword";
		$res=$con->query($sql);
		if($res->num_rows){
			?>
			<div class='table-responsive'>
				<table class='full-width-table'>
				    <thead>
				        <tr>
							<th>Keyword</th>
							<th>Frequency</th>
						</tr>
				    </thead>
					<tbody>
						<?php 
						while($row=$res->fetch_assoc()){
							?>
							<tr>
								<td><?php echo $row['Keyword']; ?></td>
								<td><?php echo $row['frequency']; ?></td>
							</tr>
						<?php 
						}
						?>
					</tbody>
				</table>
			</div>
		<?php 
		}else{
			?>
			<div class='alert alert-danger'>No Keywords found</div>
		<?php 
		}
		?>
	</div>
	<center>
		<h3><a class='back_link' href="<?php echo SITE_URL;?>/reports.php">Back to Maintenance Reports</a></h3>
	</center>
</div>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>