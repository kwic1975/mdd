<?php
include_once(dirname(__FILE__)."/header.php");

?>
<div class='row report_cont'>
	<div class='col-sm-1'></div>
	<div class='col-sm-11'>
		<h3>Keyword frequency report</h3>
		<?php 
		$sql="select distinct Keyword,count(*) as frequency from DictionaryData where Keyword!='' group by Keyword order by Keyword";
		$res=$con->query($sql);
		if($res->num_rows){
			?>
			<div class='table-responsive'>
				<table class=''>
					<tbody>
						<tr>
							<td>Keyword</td>
							<td>Frequency</td>
						</tr>
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
		<h3><a href="<?php echo SITE_URL;?>/reports.php">Back to Maintenance Reports</a></h3>
	</center>
</div>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>