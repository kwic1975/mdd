<?php
require_once(dirname(__FILE__)."/header.php");
require_once(dirname(__FILE__)."/login-check.php"); 
?>
<div class="row">
	<div class="col-md-1 col-sm-12">
	</div>
	<div class="col-md-4 col-sm-12 user-text">
			Welcome <b><?php echo htmlspecialchars($_SESSION['mdd']['uname']); ?></b>
			<br><a href="<?php echo SITE_URL;?>/landing-success.php">Home Page</a>
			<br><a href="<?php echo SITE_URL;?>/logout.php">Logout</a>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<center><h1>
			Search Results
		</h1></center>
	</div>
</div>
<center>
<h1>
Under Construction<br> 
<a href="<?php echo SITE_URL;?>/index.php"><u>Go Back</u></a>.
</h1>
</center>
<?php
	// $q1="select count(*) as exact_search_countfrom (select distinct variable_name, variable_name_type from DictionaryData where variable_name eq ".mysqli_real_escape_string($_POST['search-text'])." order by variable_name_type)";
	// $result=$con->query($q1);
	// $row=$result->fetch_assoc();
	// $c1=$row['count(*)'];
	// $q2="select distinct variable_name, variable_name_type from DictionaryData where variable_name eq ".mysqli_real_escape_string($_POST['search-text'])." order by variable_name_type";
?>
<!--<div class="row">
	<div class="col-sm-12">
		<center><h2>
			<?php echo $c1; ?> Exact Matches Found
		</h2></center>
	</div>
</div>
3.	“select distinct variable_name, variable_name_type from DictionaryData where variable_name like ‘%<search_text>%’ order by variable_name_type”
4.	“select count(*) as wildcard_search_count from (select distinct variable_name, variable_name_type from DictionaryData where variable_name like ‘%<search_text>%’ order by variable_name_type)”
-->
<?php require_once(dirname(__FILE__)."/footer.php"); ?>