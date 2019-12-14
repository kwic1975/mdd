<?php
include_once(dirname(__FILE__)."/header.php");
?>
<div class="row">
	<div class="col-sm-12">
		<center><h2>
		Maintenance Reports<br>
		Click on the following  to generate the reports
		</h2></center>
		<div class='maintenance_reports_list'>
		1. <a href='<?php echo SITE_URL ?>/report1.php'>How many FieldNames in the FieldData table do not have a corresponding entry in Variable_Name in the table DictionaryData?</a><br>
		2. <a href='<?php echo SITE_URL ?>/report2.php'>List the FieldName from results above.</a><br>
		3. <a href='<?php echo SITE_URL ?>/report3.php'>How many FileNames in the FileData table do not have a corresponding entry in Variable_Name in the table DictionaryData?</a><br>
		4. <a href='<?php echo SITE_URL ?>/report4.php'>List the FileNames from results above.</a><br>
		5. <a href='<?php echo SITE_URL ?>/report5.php'>Report on number of FieldNames and number of FileNames</a><br>
		6. <a href='<?php echo SITE_URL ?>/report6.php'>Report to list all FieldNames, Business_Definitions for a drop-down list of FileNames</a><br>
		7. <a href='<?php echo SITE_URL ?>/report7.php'>Keyword frequency report</a><br>
		</div>
	</div>
</div>

<?php include_once(dirname(__FILE__)."/footer.php"); ?>