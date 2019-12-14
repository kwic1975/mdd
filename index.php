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
		// $dbname="blinkcoders_mdd";
		$dbname="mdd";
		$server="localhost";
		$con=mysqli_connect($server,$username,$password,$dbname);
		
		$username=mysqli_real_escape_string($con,$username);
		$password=mysqli_real_escape_string($con,$password);
		
		if($con)
		{
			$_SESSION['mdd']['uname']=$username;
			$_SESSION['mdd']['pass']=$password;
			if($_POST['uname']=="mdd_admin")
			// if($_POST['uname']=="blinkcoders_mdd_admin")
			{
				$_SESSION['mdd']['utype']="admin";
			}
			else if($_POST['uname']=="mdd_editor")
			// else if($_POST['uname']=="blinkcoders_mdd_editor")
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
<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
<div class="form login--form">
  <form class="" action="<?php echo SITE_URL."/index.php"; ?>" method="post">
    <div class="form-group">
      <label class="control-label" for="uname">Username:</label>
      
        <input type="uname" required class="form-control" id="uname" placeholder="Enter Username" name="uname">
      
    </div>
    <div class="form-group">
      <label class="control-label" for="pwd">Password:</label>
              
        <input type="password" required class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      
    </div>
    <div class="form-group">        
      <div class="buttonn">
		<input type="submit" class="btn btn-default" name="action" value="Login">
      </div>
    </div>
	<div class="buttonnn">
		Send a request to admin@mdd.com to get login credentials or report any issues
	</div>
  </form>
</div>
</div>
<?php include_once(dirname(__FILE__)."/footer.php"); ?>