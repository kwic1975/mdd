<?php
require_once(dirname(__FILE__)."/header.php");
if($_GET['type']=="file")
{
	if($_GET['name']=="vpro_output.csv")
	{
		$query="SELECT a.Variable_Name, a.Business_Definition, a.Keyword, b.Field_Type,b.Field_Length,b.Field_Format
			FROM DictionaryData a INNER JOIN  FieldData b ON a.Variable_Name=b.FieldName
			WHERE b.FileName='VPRO2_OUTPUT.CSV'
			ORDER BY a.Variable_Name;";
		$result=$con->query($query);
		$file="VPro2_Output.csv";
	}
	elseif($_GET['name']=="graph_spx_daily.csv")
	{
		$query="SELECT a.Variable_Name, a.Business_Definition, a.Keyword, b.Field_Type,b.Field_Length,b.Field_Format
			FROM DictionaryData a INNER JOIN  FieldData b ON a.Variable_Name=b.FieldName
			WHERE b.FileName='GRAPH_SPX_DAILY.CSV'
			ORDER BY a.Variable_Name;";
		$result=$con->query($query);
		$file="Graph_SPX_Daily.csv";		
	}
	else
	{
		?>
			<center>
				<h1>
					Invalid Filename<br> 
					<a class='back_link' href="<?php echo SITE_URL;?>/index.php"><u>Go Back</u></a>
				</h1>
			</center>
		<?php
		require_once(dirname(__FILE__)."/footer.php");
		die();
	}
	?>
	<div class="row">
	<center>
		<h2>
			<?php echo $file; ?> Report
		</h2>
	</center>
	<div class="col-sm-12 table-responsive">
			<table class="centerTable11">
				<thead class="stick_to_top"><tr>
					<th>Variable_Name</th>
					<th class="double">Business_Definition</th>
					<th>Keyword</th>
					<th>Field_Type</th>	
					<th>Field_Length</th>	
					<th>Field_Format</th>						
				</tr></thead>
				<?php
					if($result and $result->num_rows!=0)
					{
						while($row=$result->fetch_assoc())
						{
						?>
						<tr>
							<td><?php echo $row['Variable_Name']; ?></td>
							<td class="double"><?php echo $row['Business_Definition']; ?></td>
							<td><?php echo $row['Keyword']; ?></td>
							<td><?php echo $row['Field_Type']; ?></td>
							<td><?php echo $row['Field_Length']; ?></td>
							<td><?php echo $row['Field_Format']; ?></td>
						</tr>	
						<?php
						}
					}
					else
					{
						echo "<tr><td colspan='6' class='no_rows_span'>No Rows Found</td></tr>";
					}
				?>
				<tr class="stick_to_bottom">
					<th>Variable_Name</th>
					<th class="double">Business_Definition</th>
					<th>Keyword</th>
					<th>Field_Type</th>	
					<th>Field_Length</th>	
					<th>Field_Format</th>						
				</tr>
			</table>
	</div>
</div>
	<?php
}
else
{
	?>
	<div class="row">
	<center>
		<h2>
			Common Keywords
		</h2>
	</center>
	<div class="col-sm-12 table-responsive">
		<table class="centerTable">
				<thead><tr>
						<th>Keyword</th>
						<th>Useful for the following</th>
						<th>Comments</th>				
				</tr></thead>
				<tbody>
					<tr>
						<td>INPUTS</td>
						<td>Get a quick list of the input files</td>
						<td></td>
					</tr>
					<tr>
						<td>OUTPUTS</td>
						<td>
                            Get a quick list of all the outputs that are exported from the SAS/Analytical jobs
                        </td>
						<td></td>
					</tr>
					<tr>
						<td>RESULTS</td>
						<td>
						    List of all files that have final results ready for user consumption    
						</td>
						<td></td>
					</tr>
					<tr>
						<td>CODE</td>
						<td>
						    List of files that comprise the processing code for the model
						</td>
						<td></td>
					</tr>
					<tr>
						<td>GRAPH DATA</td>
						<td>
                            List of files that will be used by graphing application. This will prevent file lock while working on results.
						</td>
						<td></td>
					</tr>
				</tbody>
		</table>
	</div>
</div>
	
	
	<?php
}
require_once(dirname(__FILE__)."/footer.php"); ?>