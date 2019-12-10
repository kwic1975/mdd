<?php
include_once(dirname(__FILE__)."/header.php");
?>
<div class="row">
	<div class='col-sm-2'></div>
	<div class="col-sm-10">
		<center><h2>
		Maintenance Reports<br>
		Click on the following  to generate the reports
		</h2></center>
		<div class='maintenance_reports_list'>
		1. <a href='<?php echo SITE_URL ?>/report1.php'>How many FieldNames in the FieldData table do not have a corresponding entry in Variable_Name in the table DictionaryData?</a><br>
		2. List the FieldName from results above.<br>
		3. How many FileNames in the FileData table do not have a corresponding entry in Variable_Name in the table DictionaryData?<br>
		4. List the FileNames from results above.<br>
		5. Report on number of FieldNames and number of FileNames<br>
		6. Report to list all FieldNames, Business_Definitions for a drop-down list of FileNames<br>
		7. Keyword frequency report<br>
		</div>
	</div>
</div>

<?php include_once(dirname(__FILE__)."/footer.php"); ?>