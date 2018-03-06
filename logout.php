<?php 
include '_config.php'; 
  
if (isset ($_SESSION))
	session_unset($_SESSION);   

header('location:index.php');
exit;
?>