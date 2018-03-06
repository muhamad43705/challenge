<?php
 
	foreach ($_POST as $k => $v) {
		
		if (!is_array($v))
			 $v = trim($v);  
		
		$arr[$k] = $v;     
	}  
	 
	
	$arrReturn = array(); 
	 
	$arr['createdBy'] =  base64_decode($_SESSION[$obj->loginAdminSession]['id']);
	$arr['modifiedBy'] =  base64_decode($_SESSION[$obj->loginAdminSession]['id']);   	
	
    
// validasi security
// sehingga di BASECLASS tidak perlu ad validasi security sehingga bisa bypass jika ada kepentingan
// ex. User boleh delete (yg otomatis ubah status ke pembatalan, tp user tidak memiliki hak akses utk pembatalan)

	switch ($_POST['action']) {
  		case 'add': if(!$security->isAdminLogin($securityObject,11,false)) die;
						
						$arrReturn = $obj->addData($arr);
						break;
					
		case 'edit': if(!$security->isAdminLogin($securityObject,11,false)) die;
						$arrReturn = $obj->editData($arr);
						break;
				
		case 'resendEmail': if(!$security->isAdminLogin($securityObject,11,false)) die;
						$arrReturn = $obj->sendInvoice($arr['hidId']);
						break;
									
					
  		case 'delete': if(!$security->isAdminLogin($securityObject,12,false)) die;
  					
						$arrPkey = $arr['selectedPkey']; 
						
						$arrReturn  = array(); 
						for ($i=0;$i<count($arrPkey);$i++){
							$arrTemp = $obj->delete($arrPkey[$i]);
							
							for($j=0;$j<count($arrTemp);$j++)
								array_push($arrReturn, $arrTemp[$j]);
						 
						}
					
 	    				break;
				
  		case 'changestatus': if(!$security->isAdminLogin($securityObject,$arr['newStatus'],false))die; 
							 
								$arrPkey = $arr['selectedPkey'];
								
								$arrReturn  = array(); 
								for ($i=0;$i<count($arrPkey);$i++){
									 
									$arrTemp = $obj->changeStatus($arrPkey[$i],$arr['newStatus'],'',$arr['copyData']);
									
									for($j=0;$j<count($arrTemp);$j++)
										array_push($arrReturn, $arrTemp[$j]);
								 
								}
								
 	    					break;

   		case 'changetag': if(!$security->isAdminLogin($securityObject,11,false)) die;
							 
								$arrPkey = $arr['selectedPkey']; 
								
								$arrReturn  = array(); 
								for ($i=0;$i<count($arrPkey);$i++){
									
									$arrTemp = $obj->changeTag($arrPkey[$i],$arr['newTag']);
									
									for($j=0;$j<count($arrTemp);$j++)
										array_push($arrReturn, $arrTemp[$j]);
								 
								}
							
							break;

   
	}	
	 
	echo json_encode($arrReturn);  
	die; 
	
?>
