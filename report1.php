<?php
include_once(dirname(__FILE__)."/header.php");

$count=0;
$sql="SELECT count(*) as count
	FROM
	(SELECT distinct a.FieldName, b.Variable_Name
	FROM FieldData a LEFT JOIN (SELECT DISTINCT Variable_Name FROM DictionaryData) b
	ON a.FieldName = b.Variable_Name
	where b.Variable_Name is null) c";
$res=$con->query($sql);
if($res->num_rows){
	$row=$res->fetch_assoc();
	$count=$row['count'];
}
?>
<center>
	<h1>Count</h1>
	<h2><?php echo $count; ?></h2>
	<h3>Count of FieldNames in the FieldData table that do not have a corresponding entry in Variable_Name in the table DictionaryData</h3>
	<h3><a href="<?php echo SITE_URL;?>/reports.php">Back to Maintenance Reports</a></h3>
</center>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>
