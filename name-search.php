<?php
require_once(dirname(__FILE__)."/header.php");
require_once(dirname(__FILE__)."/login-check.php"); 
?>
<div class="row">
	<div class="col-md-1 col-sm-12">
	</div>
	<div class="col-md-4 col-sm-12 user-text">
			Welcome <b><?php echo htmlspecialchars($_SESSION['mdd']['uname']); ?></b>
			<br>Home Page
			<br><a href="<?php echo SITE_URL;?>/logout.php">Logout</a>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<center><h1>
			Name Search
		</h1></center>
	</div>
</div>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<center>
			Quick Instructions: Enter a search text such as a file name or a field name in the box below. For file names please include the file extension as shown in examples below. If there is uncertainty of the exact term, enter % to create a wildcard search. Results of the search will be displayed below. Search terms are case insensitive and text will be converted to upper case in the box below. Some helpful examples are below:
		</center>
	</div>
	<div class="col-sm-2"></div>
</div>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<center>
		<br>
			Search for the Field “Count_6x_1D” – Enter “COUNT_6X_1D” in the search box<br><br>
			Search for the File “Vpro2_Output” – Enter “VPRO2_OUTPUT.CSV” in the search box<br><br>
			Search with a wildcard – Enter “VPRO2_OUTPUT%” in the search box<br><br>
		</center>
	</div>
	<div class="col-sm-2"></div>
</div>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8"><center>
		<form class="form-inline" method="post" action="<?php echo htmlspecialchars(SITE_URL); ?>/name-search-results.php">
		<div class="form-group">
			<input type="text" required class="form-control"  name="search-text" id="search-text">
			<input type="hidden" name="action" value="search-name">
		</div>
		<button type="submit" class="btn btn-primary btn-md">Search</button>
		</form>
		</center>
	</div>
	<div class="col-sm-2"></div>
</div>
<?php require_once(dirname(__FILE__)."/footer.php"); ?>