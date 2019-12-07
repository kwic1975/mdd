<?php
require_once(dirname(__FILE__)."/header.php");
//require_once(dirname(__FILE__)."/login-check.php"); 
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
	<div class="col-sm-12 table-responsive">
			<table class="centerTable">
				<tr>
					<th>Search</th>
					<th>Reports</th>
					<?php 
						if($_SESSION['mdd']['utype']=='admin' or $_SESSION['mdd']['utype']=='editor')
						{
							?>
								<th>Edit Contents</th>
								<th>Add Contents</th>
							<?php
						}
						else
						{
							?>
								<th class="grey">Edit Contents</th>
								<th class="grey">Add Contents</th>
							<?php
						}
					?>								
				</tr>
				<tr>
					<td><a href="<?php echo SITE_URL;?>/name-search.php">Name search (can be a field name or a file name, exact or with wildcards)</a></td>
					<td>Most Popular:<ul>
						<li><a href="<?php echo SITE_URL;?>/pop.php?type=file&name=vpro_output.csv">VPro2_Output.csv</a></li>
						<li><a href="<?php echo SITE_URL;?>/pop.php?type=file&name=graph_spx_daily.csv">Graph_SPX_Daily.csv</a></li>
						<li><a href="<?php echo SITE_URL;?>/pop.php?type=keys">Keywords</a></li>
						</ul>
						</td>
					<?php 
						if($_SESSION['mdd']['utype']=='admin' or $_SESSION['mdd']['utype']=='editor')
						{
							?>
								<td>
								<a href="<?php echo SITE_URL;?>/edit-dict.php">Edit Dictionary</a><br>
								<a href="<?php echo SITE_URL;?>/edit-file.php">Edit FileNames</a><br>
								<a href="<?php echo SITE_URL;?>/edit-field.php">Edit FieldNames</a><br>
								</td>
								<td>
									<a href="<?php echo SITE_URL;?>/add-dict.php">Add to Dictionary</a><br>
									<a href="<?php echo SITE_URL;?>/add-filename.php">Add to FileNames</a><br>
									<a href="<?php echo SITE_URL;?>/add-field.php">Add to FieldNames</a><br>
								</td>		
							<?php
						}
						else
						{
							?>
								<td class="grey"></td>
								<td class="grey"></td>
							<?php
						}
					?>			
				</tr>
				<tr>
					<td><a href="<?php echo SITE_URL;?>/key-search.php">Keyword search (can be a field name or a file name, exact or with wildcards)</a></td>
					<td><a href="<?php echo SITE_URL;?>/reports.php">Set of maintenance reports</a></td>
					<?php 
						if($_SESSION['mdd']['utype']=='admin' or $_SESSION['mdd']['utype']=='editor')
						{
							?>
								<td></td>
								<td></td>		
							<?php
						}
						else
						{
							?>
								<td class="grey"></td>
								<td class="grey"></td>
							<?php
						}
					?>							
				</tr>
			</table>
	</div>
</div>
<?php require_once(dirname(__FILE__)."/footer.php"); ?>