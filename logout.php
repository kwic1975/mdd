<?php
include_once(dirname(__FILE__)."/site_config.php");

if(isset($_SESSION['mdd'])){
	unset($_SESSION['mdd']);
}
header("Location: ".SITE_URL);

?>