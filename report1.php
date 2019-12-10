<?php
include_once(dirname(__FILE__)."/header.php");

$count=0;
$sql="SELECT count(*) as count
	FROM FieldData a LEFT JOIN (SELECT DISTINCT Variable_Name FROM DictionaryData) b
	ON a.FieldName = b.Variable_Name
	where b.Variable_Name is null";
$res=$con->query($sql);
if($res->num_rows){
	$row=$res->fetch_assoc();
	$count=$row['count'];
}
?>
<center>
	<h1>Count</h1>
	<h2><?php echo $count; ?></h2>
</center>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>