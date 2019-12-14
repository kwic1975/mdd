<?php
include_once(dirname(__FILE__)."/header.php");
// require_once(dirname(__FILE__)."/login-check.php"); 
?>
<div class="row">
	<div class="col-sm-12">
		<center><h2>
			Keyword Search
		</h2></center>
	</div>
</div>
<div class="row">
	
	<div class="col-sm-12 col-md-8 col-md-offset-2">
		<center>
			Quick Instructions: Enter a search keyword such as “INPUTS” in the box below. For a list of common keywords navigate to home page > reports> Most popular> keywords. If there is uncertainty of the exact term, enter % to create a wildcard search. Results of the search will be displayed below. Search terms are case insensitive and text will be converted to upper case in the box below. Some helpful examples are below:
		</center>
	</div>

</div>
<div class="row">
	
	<div class="col-sm-12 col-md-8 col-md-offset-2">
		<center>
		<br>
			Search for the keyword “Inputs” – Enter “INPUTS” in the search box<br><br>
			Search with a wildcard – Enter “INPUT%” in the search box<br><br>
		</center>
	</div>
	
</div>
<div class="row">
	
	<div class="col-sm-12 col-md-8 col-md-offset-2"><center>
		<form class="form-inline search-form" method="GET" action="<?php echo SITE_URL; ?>/keyword-search-results.php">
			<div class="form-group">
				<input type="text" required class="form-control search_input"  name="search-text" id="search-text" placeholder="ENTER KEYWORD SEARCH TEXT HERE">
			</div>
			<button type="submit" class="btn btn-primary btn-md">Search</button>
		</form>
		</center>
	</div>
</div>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>