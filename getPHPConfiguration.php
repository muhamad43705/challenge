<?php 
include '_config.php'; 
include '_include.php'; 


$arrConfig = array();
$arrConfig["uploadTempDoc"] = $class->uploadTempDoc;
$arrConfig["uploadTempURL"] = $class->uploadTempURL;
$arrConfig["defaultDocUploadPath"] = $class->defaultDocUploadPath;
$arrConfig["adminTotalRowsPerPage"] = $class->adminTotalRowsPerPage;
 
echo json_encode($arrConfig); 
die; 
  
?>