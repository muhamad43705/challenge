<?php  
	session_start();  
	 
 	$LANG = 'id';
	
	$WEB_FOLDER = 'turboly/';
    
    $PROTOCOL = 'http';
    if(!empty($_SERVER['HTTPS']))
     $PROTOCOL = 'https';
    
	$HTTP_HOST =  $PROTOCOL . '://' .$_SERVER ['HTTP_HOST'] ;
	if(substr($HTTP_HOST,-1) <> "/") {
		$HTTP_HOST  .= '/';
	}
	$HTTP_HOST = $HTTP_HOST.$WEB_FOLDER; 
 
	$DOC_ROOT = $_SERVER ['DOCUMENT_ROOT'] ;
	if(substr($DOC_ROOT,-1) <> "/") {
		$DOC_ROOT .= '/';
	}
	$DOC_ROOT = $DOC_ROOT.$WEB_FOLDER; 
 	
    $DOMAIN_NAME = $_SERVER['HTTP_HOST'];
 

    $patterns = array('www.',':');
    $replacements = array('','-');
    $DOMAIN_NAME = str_replace($patterns, $replacements, $DOMAIN_NAME);

    // FOR DEVELOPMENT
    //include '_development.php';  


    // ERROR LOG
	$path = $DOC_ROOT.'log/'; 
	if (!file_exists($path)) {
		mkdir($path, 0755, true);
	} 
	
	$filename = $path.md5($DOC_ROOT).'.txt'; 
				    
	ini_set('display_errors', 0);
	ini_set('log_errors', 1);
	ini_set('error_log', $filename ); 
	date_default_timezone_set('Asia/Jakarta');
	   
 	  
    // END OF ERROR LOG
	  
?>
