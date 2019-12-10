<?php 
session_start();
error_reporting(E_ALL ^ E_WARNING); 
function base_url(){
    $base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
    $base_url .= '://'. $_SERVER['HTTP_HOST'];
    return $base_url;
}
define('SUB_FOLDER', "/mdd"); // without trailing slash
define('SITE_URL', base_url().SUB_FOLDER);
define('BASE_DIR', dirname(__FILE__));
define('RESOURCES_URL', base_url().SUB_FOLDER.'/resources/');
define('RESOURCES_DIR', BASE_DIR.'/resources');
?>