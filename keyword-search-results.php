<?php
include_once(dirname(__FILE__)."/header.php");
// include_once(dirname(__FILE__)."/login-check.php"); 

if(!empty($_GET['search-text'])){
	$str = $_GET['search-text'];
	// check if search input contains % at the end 
	if (strpos($str, '%') !== false) {
		// remove % from the end 
		$str = rtrim($str,"%");
	}
	?>
	<div class="row">
		<div class="col-sm-12">
			<center><h2>
				Search Results
			</h2></center>
		</div>
	</div>
	<?php
		// print_r($_POST);
		// get exact matches 
		$q1="select count(*) as exact_search_count from (select distinct Keyword from DictionaryData where Keyword = '".mysqli_real_escape_string($con,$str)."' order by Keyword) at";
		$result=$con->query($q1);
		$row=$result->fetch_assoc();
		$c1=$row['exact_search_count'];
	?>
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h2>
					<?php echo $c1; ?> exact matches found
				</h2>
				<?php 
				if($c1>0){
					$q2="select distinct Keyword from DictionaryData where Keyword = '".mysqli_real_escape_string($con,$str)."' order by Keyword";
					$res=$con->query($q2);
					while($row=$res->fetch_assoc()){
						echo "<a href='".SITE_URL."/keyword-search-results-report.php?key=".$row['Keyword']."'>".$row['Keyword'].'</a><br>';
					}
				}
				?>
			</center>
		</div>
	</div>
	<?php
		// print_r($_POST);
		// get exact matches 
		$q1="select count(*) as wildcard_search_count from (select distinct Keyword from DictionaryData where (Keyword LIKE '%".mysqli_real_escape_string($con,$str)."%' and Keyword!='".mysqli_real_escape_string($con,$str)."') order by Keyword) at";
		$result=$con->query($q1);
		$row=$result->fetch_assoc();
		$c1=$row['wildcard_search_count'];
	?>
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h2>
					And <?php echo $c1; ?> wildcard matches found
				</h2>
				<?php 
				if($c1>0){
					$q2="select distinct Keyword from DictionaryData where (Keyword LIKE '%".mysqli_real_escape_string($con,$str)."%' and Keyword!='".mysqli_real_escape_string($con,$str)."') order by Keyword";
					$res=$con->query($q2);
					while($row=$res->fetch_assoc()){
						echo "<a href='".SITE_URL."/keyword-search-results-report.php?key=".$row['Keyword']."'>".$row['Keyword'].'</a><br>';
					}
				}
				?>
				<h3>
				<a href="<?php echo SITE_URL;?>/keyword-search.php">Back to Keyword Search</a>
				</h3>
			</center>
		</div>
	</div>
<?php
}else{
	echo "<div class='alert alert-danger'>Failed to get results</div>";
}
include_once(dirname(__FILE__)."/footer.php"); ?>