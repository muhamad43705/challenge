<?php 

$FILE_NAME = basename (  $_SERVER['PHP_SELF'] ,".php");	 
$classVersion = 'class';

include $DOC_ROOT. 'key/default.php';    
include $DOC_ROOT. 'key/default-config.php';
    
include $DOC_ROOT. 'include/'.$classVersion.'/BaseClass.class.php'; 
include $DOC_ROOT. 'include/'.$classVersion.'/Database.class.php';    
include $DOC_ROOT. 'include/'.$classVersion.'/Setting.class.php';  
include $DOC_ROOT. 'include/'.$classVersion.'/Security.class.php'; 
include $DOC_ROOT. 'include/'.$classVersion.'/Employee.class.php'; 


//default enginekey 
$oDbCon = new Database();
$class = new Baseclass();  
$setting = new Setting(); 	   
$security = new Security();
$employee = new Employee();

?>