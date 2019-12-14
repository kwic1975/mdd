<?php
include_once(dirname(__FILE__)."/header.php");

$count=0;
$sql="SELECT count(*) as count
	FROM
	(SELECT distinct a.FileName, b.Variable_Name
	FROM FileData a LEFT JOIN
	(SELECT DISTINCT Variable_Name
	FROM DictionaryData) b ON a.FileName = b.Variable_Name
	WHERE b.Variable_Name is null) c";
$res=$con->query($sql);
if($res->num_rows){
	$row=$res->fetch_assoc();
	$count=$row['count'];
}
?>
<center>
	<h1>Count</h1>
	<h2><?php echo $count; ?></h2>
	<h3>Count of FileNames in the FileData table that do not have a corresponding entry in Variable_Name in the table DictionaryData</h3>
	<h3><a class='back_link' href="<?php echo SITE_URL;?>/reports.php">Back to Maintenance Reports</a></h3>
</center>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>