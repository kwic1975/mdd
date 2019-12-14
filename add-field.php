<?php
include_once(dirname(__FILE__)."/header.php");
Check_permission();
?>
<div class="row" id="form-dict">
	
	<div class="col-sm-12">
		<center><h3>Add contents – FieldName</h3></center>
		<div class='alert alert-danger' id='error1'></div>
		<form id="add-field-form">
			<input type="hidden" value="AddField" name="action">
			<div class="form-group col-sm-6">
				<label for="FName">FieldName:</label>
				<input type="text" id="FName" name="FName" class="form-control" required>
			</div>
			<div class='form-group col-sm-12'>
				<input type="submit" class="btn btn-success" value="Save and Next" name="save_step">
			</div>
		</form>
		<div class='restore_cont'>
			<div class='restore_text'>Import CSV</div>
			<div class='alert alert-danger' id='error3' style="display:none;"></div>
		    <div class='alert alert-success' id='import-success' style="display:none;"></div>
		    <form id="import-field-csv" action="JavaScript:void(0);" class="form-inline">
		         <div class="form-group col-sm-6">
					<input type="file" name="file" id="file">
		    	</div>
		    	<div class="form-group col-sm-6">
	                <button class="btn btn-primary" id="import-field">Import</button>
		    	</div>
	    	</form>
		</div>
		<?php 
		if($_SESSION['mdd']['utype']=="admin"){
		?>
		<div class='restore_cont'>
			<div class='restore_text'>Restore "Last Good Copy"</div>
			<div class='form-group'>
				<?php
				// check if last copy is present 
				$sql='select * from FieldData_lgc';
				$res=$con->query($sql);
				if($res->num_rows){
				?>
					<div id='error2' class='alert'></div>
					<button type='button' class='btn btn-primary restore_lgc' data-table='3'>Restore</button>
				<?php 
				}else{
					echo "<div class='alert alert-danger'>No Good Copy found.</div>";
				}
				?>
			</div>
		</div>
		<?php 
		}
		?>
	</div>
</div>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>