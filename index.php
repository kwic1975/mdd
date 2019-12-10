<?php
include_once(dirname(__FILE__)."/common-header.php");
?>
<?php
	if(isset($_SESSION['mdd']))
	{
		header('Location:landing-success.php');
	}
	if(isset($_POST['action']) && $_POST['action']=='Login')
	{
		// $username=$_POST['uname'];
		// $password=$_POST['pwd'];

		//defensive sql injection
		$username=stripcslashes(stripcslashes($_POST['uname']));
		$password=stripcslashes(stripcslashes($_POST['pwd']));
		$dbname="blinkcoders_mdd";
		$server="localhost";
		$con=mysqli_connect($server,$username,$password,$dbname);
		
		$username=mysqli_real_escape_string($con,$username);
		$password=mysqli_real_escape_string($con,$password);
		
		if($con)
		{
			$_SESSION['mdd']['uname']=$username;
			$_SESSION['mdd']['pass']=$password;
			if($_POST['uname']=="blinkcoders_mdd_admin")
			{
				$_SESSION['mdd']['utype']="admin";
			}
			else if($_POST['uname']=="blinkcoders_mdd_editor")
			{
				$_SESSION['mdd']['utype']='editor';
			}
			else
			{
				$_SESSION['mdd']['utype']='user';
			}
			$_SESSION['mdd']['uname']=$_POST['uname'];
			header('Location:landing-success.php');
		}
		else
		{
			header('Location:landing-failed.php');
		}
		mysqli_close($con);
	}
?>
<div class="row">
	<div class="col-sm-12">
		<center><h1>
			User Login
		</h1></center>
	</div>
</div>
<style>
div.form
{
    margin-top:13%;
	margin-left:30%;
	display: block;
    text-align: center;
}
form
{
    margin-left: auto;
    margin-right: auto;
    text-align: left;
}
</style>
<div class="container form">
  <form class="form-horizontal" action="<?php echo htmlspecialchars(SITE_URL."/index.php"); ?>" method="post">
    <div class="form-group row">
      <label class="control-label col-sm-2 border-blue" for="uname">Username:</label>
      <div class="col-sm-4">
        <input type="uname" required class="form-control" id="uname" placeholder="Enter Username" name="uname">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-sm-2 border-blue" for="pwd">Password:</label>
      <div class="col-sm-4">          
        <input type="password" required class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-10 buttonn">
		<input type="submit" class="btn btn-default" name="action" value="Login">
      </div>
    </div>
	<div class="col-sm-5 buttonnn">
		Send a request to admin@mdd.com to get login credentials or report any issues
	</div>
  </form>
</div>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>