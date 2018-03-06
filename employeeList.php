<?php  
// ========================================================================== INITIALIZE ==========================================================================
include '_config.php'; 
include '_include.php'; 
 
$obj = $employee;
$securityObject = $obj->securityObject; // the value of security object is manually inserted to handle 
										// some modules that have different security object from that of their class

if(!$security->isAdminLogin($securityObject,10,true));
 
$addDataFile = 'employeeForm';
 
$arrSarchColumn = array(
	'0' => array('Kode', $obj->tableName . '.code'), 
	'1' => array('Nama', $obj->tableName . '.name'), 
); 		 
		
$arrColumn = array (
  '0' => array('Kode','code',70,'true','left'),
  '1' => array('Nama','name',250,'true','left'),
  '2'=>  array('Status','statusname','','true','left'),
);   
  
$overwriteContextMenu['print'] = '';

function generateQuickView($obj,$id){ 
	    
	$detail = '';
	   
	return $detail;  
}
 
// ========================================================================== STARTING POINT ==========================================================================
include ('dataList.php');
?>