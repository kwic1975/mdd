<?php
include_once(dirname(__FILE__)."/header.php");

$count=0;
$sql="SELECT distinct a.FileName, b.Variable_Name
	FROM FileData a LEFT JOIN
	(SELECT DISTINCT Variable_Name
	FROM DictionaryData) b ON a.FileName = b.Variable_Name
	WHERE b.Variable_Name is null";
$res=$con->query($sql);
?>
<center>
	<h3>FileNames in the FileData table that do not have a corresponding entry in Variable_Name in the table DictionaryData</h3>
	<?php 
	if($res->num_rows){
		while($row=$res->fetch_assoc()){
			?>
			<div class="col-sm-3 field_names">
			<?php echo $row['FileName']; ?>
			</div>
		<?php 
		}
	}else{
		?>
		<div class="col-sm-12">No result found</div>
	<?php 
	}
	?>
	<div class='col-sm-12'>
		<h3><a class='back_link' href="<?php echo SITE_URL;?>/reports.php">Back to Maintenance Reports</a></h3>
	</div>
</center>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>