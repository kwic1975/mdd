<?php
include_once(dirname(__FILE__)."/header.php");

$count=0;
$sql="SELECT COUNT(DISTINCT FieldName) as COUNT1, 'Count_FieldName_FieldData' AS t1 FROM FieldData
union
SELECT COUNT(DISTINCT FileName) as COUNT2, 'Count_FileName_FieldData' AS t2 FROM FieldData
union
SELECT COUNT(DISTINCT FileName) AS COUNT3, 'Count_FileName_FileData' AS t3 FROM FileData
union
SELECT COUNT(DISTINCT Variable_Name) AS COUNT4,  'Count_FieldName_DD' AS t4 FROM DictionaryData WHERE Variable_Name_Type='FIELD'
union
SELECT COUNT(DISTINCT Variable_Name) as COUNT5, 'Count_FileName_DD' AS t5 FROM DictionaryData WHERE Variable_Name_Type='FILE'";
$res=$con->query($sql);
?>
<div class='report_cont'>
	<center>
		<h3>Report on number of FieldNames and number of FileNames</h3>
		<?php 
		if($res->num_rows){
			while($row=$res->fetch_assoc()){
				echo "<b>".$row['t1'].'</b>: '.$row['COUNT1']."<br>";
			}
		}
		?>
		<h3><a href="<?php echo SITE_URL;?>/reports.php">Back to Maintenance Reports</a></h3>
	</center>
</div>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>