<?php 
include '_config.php'; 
include '_include.php'; 


$arrConfig = array();
$rsSetting =  $setting->getSettingData();
for ($i=0;$i<count($rsSetting);$i++){
	$code = $rsSetting[$i]['code'];
	 
	if ($rsSetting[$i]['multivalue'] == 0){ 
			if ($rsSetting[$i]['type'] == 3 )
				$arrConfig ['setting'][$code] =str_replace(chr(13),'<br>',$rsSetting[$i]['value']);
			else
				$arrConfig ['setting'][$code] = $rsSetting[$i]['value'] ;
	}else{ 
		$arrDetail = $setting->getDetailByCode($code);
		$arrConfig ['setting'][$code] = $arrDetail;
	} 
		 
}   

echo json_encode($arrConfig); 
die; 
  
?>