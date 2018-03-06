<?php 
include '_config.php'; 
include '_include.php'; 


/* RECEIVE VALUE */
$userName=$_POST['loginID'];
$password=$_POST['loginPassword']; 

   
$arrayToJs = array();
 
$result = $security->adminLogin($userName,$password);


if (count ($result) == 0){
	
	if (isset ($_SESSION[$class->loginAdminSession]))
		session_unset($_SESSION[$class->loginAdminSession]);
	 	 
	$arrayToJs['valid'] = false;
	$arrayToJs['message'] =  $class->errorMsg[300]; 
}else{
	$_SESSION[$class->loginAdminSession]['id'] = base64_encode($result[0]['pkey']);
	$_SESSION[$class->loginAdminSession]['name'] = $result[0]['name']; 
	$_SESSION[$class->loginAdminSession]['username'] = $result[0]['username']; 
	$_SESSION[$class->loginAdminSession]['pass'] = $result[0]['password']; 
	$_SESSION[$class->loginAdminSession]['email'] = $result[0]['email'];  
	 
	$arrayToJs['valid'] = true;
	$arrayToJs['message'] = $class->lang['loginSuccessful'];  
	 
}		
	  

 echo json_encode($arrayToJs); 
 die;
  
?>