<?php 

class BaseClass{
	  
function BaseClass(){
		
	global $WEB_FOLDER;
    global $DOMAIN_NAME;
    global $DEVELOPMENT_TEMPLATE;
	global $DOC_ROOT;
	global $LANG;
	global $HTTP_HOST; 
	global $oDbCon;
	
	$this->oDbCon= $oDbCon;
	
	$this->tableName = '';
	$this->tableStatus = '';
	$this->tableTag = 'tag';
	$this->sqlQuery = ''; 
	$this->sqlTotalRowsQuery = '';
	$this->domain = $DOMAIN_NAME;   
    
    $this->domainFolder =  $this->domain.'/' ;   
    
	// config
	$this->docRoot = $DOC_ROOT;
	$this->defaultPath = $HTTP_HOST; 
     
    
	$this->adminFolder = '';
	$this->defaultDocAdminPath = $this->docRoot . $this->adminFolder; 
	$this->defaultURLAdminPath = $this->defaultPath . $this->adminFolder; 
	$this->pageSelfLink = substr($this->defaultPath,0,strlen($this->defaultPath)-1) . $_SERVER['REQUEST_URI'];
	 
	$this->uploadTempDoc  = $this->docRoot. 'temp/' .$this->domainFolder  ;
	$this->uploadTempURL  = $this->defaultPath. 'temp/' .$this->domainFolder  ;
	$this->defaultDocUploadPath= $this->docRoot. 'upload/' .$this->domainFolder  ;  
	$this->defaultURLUploadPath= $this->defaultPath. 'upload/' .$this->domainFolder  ; 
	
	$this->phpThumbURLSrc = '/upload/' .$this->domainFolder  ;
    $this->phpThumbPath = '/phpthumb/phpThumb.php';
	
	$this->fckURLUploadPath = $this->defaultPath. 'upload/' .$this->domainFolder.'uploadeditor/';			// buat simpan path relatif img (fckeditor)
	$this->fckDOCUploadPath = $this->docRoot. 'upload/' .$this->domainFolder.'uploadeditor/';		// buat simpan path relatif img (fckeditor)

	$this->adminTotalRowsPerPage = $this->loadSetting('adminTotalRowsPerPage');

	 
	/* Create default folder for upload */
	if (!file_exists($this->defaultDocUploadPath.'setting')) 
			mkdir($this->defaultDocUploadPath.'setting', 0777, true); 
	if (!file_exists($this->defaultDocUploadPath.'setting/companyLogo')) 
			mkdir($this->defaultDocUploadPath.'setting/companyLogo', 0777, true); 


	
	$this->defaultJsPath = $this->defaultPath. 'include/js/' ;		
	$this->defaultImgPath = $this->defaultPath. 'include/img/' ;		
	$this->adminCssPath = $this->defaultPath. 'include/css/' ; 
	
    $this->secretKey = 'n-eyS:bmjSS(25';
    
	$this->loginSession =md5($this->domain.$this->secretKey);
	$this->loginAdminSession =md5($this->domain.$this->secretKey.'VEKTORMEDIASENTOSA'); 
	
	// template information
	
     if (empty($DEVELOPMENT_TEMPLATE)) 
	   $this->templateName = $this->domainFolder;	 
    else
       $this->templateName = $DEVELOPMENT_TEMPLATE;
    
    
	$this->templateDocPath = $this->docRoot . 'template/'. $this->templateName;  
	$this->templateURLPath = $this->defaultPath . 'template/' . $this->templateName;  
    
	$this->templateCssPath = $this->templateURLPath . 'css/'; 
	$this->templateSwfPath = $this->templateURLPath . 'swf/'; 
	$this->templateImgPath = $this->templateURLPath . 'img/';   
	$this->templateJsPath = $this->templateURLPath . 'js/'; 
	
	$this->arrDiscountType = array();
	$this->arrDiscountType[1] = 'IDR';
	$this->arrDiscountType[2] = '%';
	
	//TAG
		 
	$this->shadowClass = array();
	$rsTag = $this->getAllTag();
	for ($i=0;$i<count($rsTag);$i++)
		$this->shadowClass[$rsTag[$i]['pkey']] =  $rsTag[$i]['shadowclass'];
		 
	$this->criteria = '';	 
	
	// URL FILTER
	$this->arrSearch = array("%","+","?"," ","/","\\","#","<",">");
	$this->arrReplace = array("%25","%2B","","-","-","-","-","-","-");
	 
	$langCode = $this->loadSetting('defaultLang');
    if (!empty($langCode))
        $LANG = $langCode;
    
    if (!file_exists ( $this->docRoot. 'include/lang/'.$LANG.'.php' ))
        $LANG = 'id';
    
	include($this->docRoot. 'include/lang/'.$LANG.'.php'); 
	
 }
 
 function getQuery(){
		return 'select * from ' . $this->tableName . ' where 1=1 ' .$this->criteria ; 
 }
 
 function setCriteria($criteria){
	 $this->criteria = $criteria;
 }
 
 function getEmailTemplate(){
     
        //pastikan dr http agar selalu bisa diakses
        $this->defaultURLUploadPath = str_replace('https://','http://',$this->defaultURLUploadPath);
        
        $email = $this->loadSetting('emailTemplate');
     
        $patterns = array();
        $patterns[count($patterns)] = '/({{COMPANY_NAME}})/'; 
        $patterns[count($patterns)] = '/({{WEBSITE_URL}})/';  
        $patterns[count($patterns)] = '/({{COMPANY_LOGO}})/';  

        $replacement = array();
        $replacement[count($replacement)] = $this->loadSetting('companyName'); 
        $replacement[count($replacement)] = $this->loadSetting('sitesName');  
        $replacement[count($replacement)] = '<img src="'.$this->defaultURLUploadPath.'setting/emailLogo/'.$this->loadSetting('emailLogo').'" />';
         
        $email = preg_replace($patterns, $replacement, $email);  
      
		return $email; 
 }
 
 function convertForCombobox($rs,$value,$label,$preselected=''){
	      
  	 	$totalRs = count($rs);
		$returnVal = Array();
		
		if (!empty($preselected))
			 $returnVal[0] = $preselected;
			 
        for($i = 0; $i < $totalRs ; $i++){
             $returnVal[$rs[$i][$value]] = $rs[$i][$label];
        }		
        unset($resultSet);
         
		return $returnVal;
   }
   
   function getAllStatus ($tableStatus = '') { 
	 	
		if ($tableStatus == ''){
			$tableStatus = $this->tableStatus ;
		}
		
		$sql = '
				select 
					pkey,
					status
				from 
					'.$tableStatus .'
				order by
					pkey asc
			';
			
		return $this->oDbCon->doQuery($sql); 
	 
	}   
	 
   function getAllTag () { 
	  
		$sql = '
				select 
					*
				from 
					tag
				order by
					pkey asc
			';
			
		return $this->oDbCon->doQuery($sql); 
	 
	}   
	
	function getStatusById ($statuskey){
		$sql = 'select * from '.$this->tableStatus.' where pkey in(' . $statuskey. ')' ;
		return $this->oDbCon->doQuery($sql); 
	}
	
// =============================================CHANGE STATUS ======================================== //
	
  function changeStatus($id, $newStatus, $reason=''){ 
		
		$arrayToJs =  array();
			
		try{
			
			
			$rs = $this->getDataRowById($id);
			if ($rs[0]['statuskey'] == $newStatus){ 
			 	$arrayToJs[0]['valid'] = true;
				$arrayToJs[0]['message'] = '';
				
 				return $arrayToJs; 
			}
			
			if(!$this->oDbCon->startTrans())
				throw new Exception($this->errorMsg[100]); 
									 
			$sql = '
					UPDATE
						'.$this->tableName.'
					SET
						statuskey = '.$this->oDbCon->paramString($newStatus).'	
					WHERE
						pkey = '.$this->oDbCon->paramString($id) ;   	
			
			$this->oDbCon->execute($sql);
            
            
            $rsStatus = $this->getStatusById ($newStatus); 
            $this->setTransactionLog('changestatus',$id,$rsStatus[0]['status']);
            
			$this->oDbCon->endTrans();  
	
			$this->addErrorList($arrayToJs,true,$this->lang['dataHasBeenSuccessfullyUpdated']); 
		
	    } catch(Exception $e){
			$this->oDbCon->rollback(); 
			$this->addErrorList($arrayToJs,false,$e->getMessage()); 
		}		
				 
 		return $arrayToJs; 
		 
		
	}
	
	function validateInput($id){
		
		$rs = $this->getDataRowById($id);
		  
		$arrayToJs = array();
		$this->addErrorList($arrayToJs,false,'<strong>'.$rs[0]['code'].'</strong>. ' . $this->errorMsg[202]);
		
	 	return $arrayToJs;
	 }
	 
	 
 
	function validateConfirm($id){
		
		$rs = $this->getDataRowById($id); 
		  
		$arrayToJs = array();
		
		if($rs[0]['statuskey'] <> 1){   
			$this->addErrorList($arrayToJs,false,'<strong>'.$rs[0]['code'].'</strong>. ' . $this->errorMsg[203]);
		}
		
	 	return $arrayToJs;
	 }
	 
	 

	function validateClose($id){
		
		$rs = $this->getDataRowById($id); 
		  
		$arrayToJs = array();
		
		if($rs[0]['statuskey'] <> 2){   
			$this->addErrorList($arrayToJs,false,'<strong>'.$rs[0]['code'].'</strong>. ' . $this->errorMsg[204]);
		}
		
	 	return $arrayToJs;
	 }
	  
	 
      function validateCancel($id){
		$rs = $this->getDataRowById($id);
		  
		$arrayToJs = array();
		
		if($rs[0]['statuskey'] == 4){  
			$this->addErrorList($arrayToJs,false,'<strong>'.$rs[0]['code'].'</strong>. ' . $this->errorMsg[201]);
		} 
		
	 	return $arrayToJs;
	 }
	 
	 
	 function copyDataOnCancel($id){ 
			$rsHeader = $this->getDataRowById($id);
            $oldCode = 	$rsHeader[0]['code'];
         
			$data = '';
			
			// HEADER
			$pkey = $this->getNextKey($this->tableName);
			$usecode =  $this->getNewCode($this->tableName);
			
			$sql = 'show columns from ' .$this->tableName ;
			$rsColumnsName = $this->oDbCon->doQuery ($sql); 
			  
			$rsHeader[0]['pkey'] = $pkey;
			$rsHeader[0]['code'] = $usecode;
			$rsHeader[0]['statuskey'] = 1;
			  
			for ($i=0;$i<count($rsColumnsName);$i++){
				$data .=   $this->oDbCon->paramString($rsHeader[0][$rsColumnsName[$i]['Field']]);
			
				if ($i <> count($rsColumnsName) - 1)
				  $data .= ',';  
				  
			}
			 
			
			$sql = 'insert into ' .$this->tableName.' values ('.$data.')'; 
			$this->oDbCon->execute ($sql);	
			
			
			//DETAIL
            if (!isset($this->tableNameDetail) || empty($this->tableNameDetail))
                return;
         
            $rsDetail = $this->getDetailById($id);
			
			$sql = 'show columns from ' .$this->tableNameDetail ;
			$rsColumnsName = $this->oDbCon->doQuery ($sql); 
			
			
			for ($j=0;$j<count($rsDetail);$j++){
				$fields = '';
				$data = '';
				
				for ($i=1;$i<count($rsColumnsName);$i++){
					
					$fields .= $rsColumnsName[$i]['Field'];
					
					$rsDetail[$j]['refkey'] = $pkey;
					$data .=   $this->oDbCon->paramString($rsDetail[$j][$rsColumnsName[$i]['Field']]);
				
					if ($i <> count($rsColumnsName) - 1){
					  $data .= ',';   
					  $fields.= ',';    
					}
					
				}
				
					$sql = 'insert into ' .$this->tableNameDetail.'  ('.$fields.') values ('.$data.')'; 
					$this->oDbCon->execute ($sql);	
			}
			 
		
         $this->setTransactionLog('add',$pkey,'Duplicate from ' . $oldCode);	
	}
	
	function delete($id){
		
		$arrayToJs =  array();
		// tdk bisa didelete utk transaksi, tp ubah ke cancel
		if(isset( $this->tableNameDetail) &&!empty($this->tableNameDetail)){ 
				 $arrayToJs = $this->changeStatus($id, 4);  
				 return $arrayToJs; 
		} 
		
		try{ 
		
	 		$arrayToJs = $this->validateDelete($id);
			if (!empty($arrayToJs)) 
				return $arrayToJs;
					 
			 if(!$this->oDbCon->startTrans())
				throw new Exception($this->errorMsg[100]);
				 
				$sql = 'delete from  '.$this->tableName.' where pkey = ' . $this->oDbCon->paramString($id);
				$this->oDbCon->execute($sql);
			 
                $this->setTransactionLog('delete',$id);
            
				$this->oDbCon->endTrans();
					 
				$this->addErrorList($arrayToJs,true,$this->lang['dataHasBeenSuccessfullyUpdated']); 
				 
		} catch(Exception $e){
			$this->oDbCon->rollback(); 
			$this->addErrorList($arrayToJs,false, $e->getMessage()); 
			
		}		 
			 	
 		return $arrayToJs; 
	}
	 
	 
	function validateDelete($id){ 
		$arrayToJs = array();
		return $arrayToJs; 
	 } 
	
	// form component
	
	function generateSaveButton(){ 
		$security = new Security();
		if($security->isAdminLogin($this->securityObject,11,false)) 
	 		return $this->button('submit','btnSave',$this->lang['save']);  
         
	}
	
	
	function inputSelect($name, $arrOption, $overwritePostValue = true, $value = 0, $attrAndStyle='' ,$overrideClass='') { 
    	 
        
		if($overwritePostValue == true) { 
			if(isset($_POST) && !empty($_POST[$name])) { 
				$value = $_POST[$name];
			}
		}  
         
		
		$defaultClass = 'form-control';
		if ($overrideClass <> '')
			$defaultClass =  $overrideClass;
		
		$inputResult = '<select class="'.$defaultClass.'"  name="' . $name  . '" '; 
		
		if(!empty($attrAndStyle)) $inputResult .= ' ' .$attrAndStyle; 
	
		$inputResult .= '>' . chr(13);
   
		$keys = array_keys($arrOption);
		$length = count($keys);

		for($i = 0; $i < $length; $i++) {
            
            if (is_array($arrOption[$keys[$i]])){
                
                $childKeys = array_keys($arrOption[$keys[$i]]);
                $childLength = count($childKeys);
                        
                $inputResult  .= '<optgroup label="'.$keys[$i].'">';
    
                for($j = 0; $j < $childLength; $j++){
                    $inputResult  .= '<option value="' . $childKeys[$j] . '"';
                    
                    if (is_array($value)) {
                        for($k=0;$k<count($value);$k++){
                             if ($childKeys[$j] == $value[$k]['refkey']) { 
                                 $inputResult .= ' selected';  
                                 break;
                             }
                        } 
                        
                    }else{
                        if($childKeys[$j] == $value) 
                            $inputResult .= ' selected'; 
                    }
               

                    $inputResult .= '>' .
                        $arrOption[$keys[$i]][$childKeys[$j]] . '</option>' . chr(13);
                }
                
                $inputResult  .= '</optgroup>';
                
            }else{
                    $inputResult  .=  '<option value="' . $keys[$i] . '"';
                    if($keys[$i] == $value) 
                        $inputResult .= ' selected'; 

                    $inputResult .= '>' .
                        $arrOption[$keys[$i]] . '</option>' . chr(13);
            } 
            
		}

		$inputResult .= '</select>' . chr(13);

		return $inputResult;
	} 
	 
	function inputTextArea($name, $overwritePostValue = true, $value='',  $attrAndStyle='',$overrideClass='') {
		 
		if($overwritePostValue) {
			if(isset($_POST) && !empty($_POST[$name])) {
				$value = $_POST[$name];
			}
		} 
		
		$defaultClass = 'form-control';
		if ($overrideClass <> '')
			$defaultClass =  $overrideClass; 

		$inputResult = '<textarea class="'.$defaultClass.'" name="' . $name .'" '; 
  
		if(!empty($attrAndStyle)) $inputResult .= ' ' .$attrAndStyle; 
		
		$inputResult .= '>';

		$inputResult .= $value;
		$inputResult .= '</textarea>';
		

		return $inputResult;
	}
	
	function input($typeVar,$name,$overwritePostValue = true, $value='', $attrAndStyle='',$overrideClass=''){
			
			$attr = '';
			switch ($typeVar) {
				case 'button':
					$defaultClass = 'btn btn-primary'; 
					break;
				case 'submit':
					$defaultClass = 'btn btn-primary';
					break;
				default:
					$defaultClass = 'form-control'; 
					$attr = 'autocomplete="off"';
			}
			
			if ($overrideClass <> '')
				$defaultClass =  $overrideClass; 	
			 
			if($overwritePostValue) { 
				if(isset($_POST) && !empty($_POST[$name])) {
					$value = $_POST[$name];
				}
			}
			 
		$inputResult = '<input type="'.$typeVar.'" class="'.$defaultClass.'" ';
		$inputResult .= 'name="'  . $name  . '" ';
		$inputResult .= ' ' . $attr . ' ';
		
		if (!empty($value))
			$inputResult .= 'value="' . $value .'" ';
		
		if(!empty($attrAndStyle))  $inputResult = $inputResult . ' ' . $attrAndStyle; 
	
		$inputResult .= '/>';
			
			
		return $inputResult;
	}

     function button($typeVar, $name, $value='', $attrAndStyle='',$overrideClass=''){
         
        $defaultClass = 'btn btn-primary'; 
         
         if ($overrideClass <> '')
				$defaultClass =  $overrideClass; 	
			 
         
        $inputResult = '<button type="'.$typeVar.'" class="'.$defaultClass.'" ';
		$inputResult .= 'name="'  . $name  . '" '; 
		 
		
		if(!empty($attrAndStyle))  $inputResult = $inputResult . ' ' . $attrAndStyle; 
	
		$inputResult .= '>'.$value.'<div class="loading-icon"><div></button>'; 
			
		return $inputResult;
     }
    
	function isValueExisted($id,$columnname,$value,$exceptionStatus = ''){
        if (!empty($exceptionStatus))
            $exceptionStatus = ' and statuskey not in ('.$exceptionStatus.')';
            
		if (!empty($id)){
			//utk edit data, kecualikan data sendiri utk kode / nama
			$sql = 'select * from '.$this->tableName.' where '.$columnname.' = '.$this->oDbCon->paramString($value) .'  and pkey <> ' . $this->oDbCon->paramString($id) .  $exceptionStatus;
			$rs = $this->oDbCon->doQuery ($sql);
			  
			return $rs; 
		}else{			
			$sql = 'select * from '.$this->tableName.' where '.$columnname.' = '.$this->oDbCon->paramString($value).' ' . $exceptionStatus;
			$rs = $this->oDbCon->doQuery ($sql); 
			return $rs; 
		}
	
	}
	 
   
   function loadSetting($code) { 
     
		$sql = 'select value from _user_setting,_setting where _setting.pkey = _user_setting.settingkey and _setting.code = ' . $this->oDbCon->paramString($code)  ;
	  	$rs = $this->oDbCon->doQuery ($sql);
		
		if (!empty($rs))
			return $rs[0]['value'];
		else
			return '';
	}
	
   
	
	function getNextKey($tableName) {
	 
	    $fpkey = 1;
		
		$query = 'select nextkey from _nextkey where table_name = '. $this->oDbCon->paramString($tableName);		
		 
		$rs = $this->oDbCon->doQuery($query);
		
		if (!empty($rs))
		 $fpkey =  $rs[0]['nextkey'];
		 
		$query = 'update _nextkey set nextkey = '. $this->oDbCon->paramString(($fpkey + 1)).' where table_name = '. $this->oDbCon->paramString($tableName);		
		$this->oDbCon->execute($query);
		
		 
		return $fpkey;
	}
	
	function getNewCode($paramCode)
	{
		$theCode = '0';
		$counterValue = '';
		$sql = 'select code,prefix,counter,digit from  _code, _user_code where code ='.$this->oDbCon->paramString($paramCode) .' and _code.pkey = _user_code.codekey';
		$rs=$this->oDbCon->doQuery($sql);
		if(count($rs)!=0){
			$format = '%s%0' . $rs[0]['digit'] . 'd';
			$theCode = sprintf($format, $rs[0]['prefix'], $rs[0]['counter']);
		}
		$sql = 'update _user_code, _code set counter='.$this->oDbCon->paramString(($rs[0]['counter'] + 1)).'
			where code ='.$this->oDbCon->paramString($paramCode) .' and _code.pkey = _user_code.codekey';
		$this->oDbCon->execute($sql);

		unset($lastCode);
		unset($counterValue);
		unset($sql);
		unset($rs);
	 
		return $theCode;
	}
	
	  
	
	function getDataRowById($id,$searchCriteria='',$orderCriteria=''){
	
		$sql = '
					SELECT
						'.$this->tableName .'.*
					FROM	
						'.$this->tableName .'
					WHERE	
						'.$this->tableName .'.pkey = '.$this->oDbCon->paramString($id) 
			;

		
		if (!empty($orderCriteria)){
				$sql .= ' order by ' . $orderCriteria ;
		}
		 
		  
		return $this->oDbCon->doQuery($sql);		
			
	} 
	
	 
	function getDetailById($id,$searchCriteria='',$orderCriteria=''){
		$sql = 'select * from '. $this->tableNameDetail.' where refkey = ' .$this->oDbCon->paramString($id) ; 
		
         $sql  .= $searchCriteria;
        
		if (!empty($orderCriteria)) 
				$sql .= ' order by ' . $orderCriteria ;
		 
		 
		return $this->oDbCon->doQuery($sql);
	} 
	
	function getDetailByColumn($fieldname,$searchkey, $mustmatch=true,$searchCriteria='',$orderCriteria='', $limit=''){
		$criteria = '';
		 
		if(!empty($fieldname)){ 
			$criteria .= ' and ' ;
			
			if($mustmatch)
				$criteria .=  $fieldname .' = '. $this->oDbCon->paramString($searchkey);
			else
				$criteria .=  $fieldname .' like '. $this->oDbCon->paramString('%'.$searchkey.'%');
		}
		
		if($searchCriteria <> '')
			$criteria .= ' ' .$searchCriteria;
		 
		 $sql = 'select * from '.$this->tableNameDetail.'  where 1=1 ';
		 $sql  .= $criteria;
		 
		 if($orderCriteria <> ''){
			$sql .= ' ' .$orderCriteria; 
	 	}
			
		if($limit <> '')
			$sql .= ' ' .$limit; 
			 
		return $this->oDbCon->doQuery($sql);	
		 
	} 
  
	function searchData($fieldname='',$searchkey='',$mustmatch=true,$searchCriteria='',$orderCriteria='', $limit=''){
		
		$criteria = '';
		 
		if(!empty($fieldname)){
			
			$criteria .= ' and ' ;
			
			if($mustmatch)
				$criteria .=  $fieldname .' = '. $this->oDbCon->paramString($searchkey);
			else
				$criteria .=  $fieldname .' like '. $this->oDbCon->paramString('%'.$searchkey.'%');
		}
				
		if($searchCriteria <> '')
			$criteria .= ' ' .$searchCriteria;
	
		$this->setCriteria($criteria); 
		$sql = $this->getQuery();
		
		if($orderCriteria <> ''){
			$sql .= ' ' .$orderCriteria; 
	 	}
			
		if($limit <> '')
			$sql .= ' ' .$limit; 
         
		return $this->oDbCon->doQuery($sql);	
	} 
	
	
 	function deleteAll($directory, $empty = false) {
		if (empty($directory))
			return;
			
		if(substr($directory,-1) == "/") {
			$directory = substr($directory,0,-1);
		}
	
		if(!file_exists($directory) || !is_dir($directory)) {
			return false;
		} elseif(!is_readable($directory)) {
			return false;
		} else {
			$directoryHandle = opendir($directory);
		   
			while ($contents = readdir($directoryHandle)) {
				if($contents != '.' && $contents != '..') {
					$path = $directory . "/" . $contents;
				   
					if(is_dir($path)) {
						$this->deleteAll($path);
					} else {
						unlink($path);
					}
				}
			}
		   
			closedir($directoryHandle);
	
			if($empty == false) {
				if(!rmdir($directory)) {
					return false;
				}
			}
		   
			return true;
		}
	} 
	
	 function fullCopy( $source, $target ) {
		
		if(substr($source,-1) == "/") {
			$source = substr($source,0,-1);
		}
	
	
		if ( is_dir( $source ) ) {
			@mkdir( $target );
			$d = dir( $source );
			while ( FALSE !== ( $entry = $d->read() ) ) {
				if ( $entry == '.' || $entry == '..' ) {
					continue;
				}
				$Entry = $source . '/' . $entry; 
				if ( is_dir( $Entry ) ) {
					$this->fullCopy( $Entry, $target . '/' . $entry );
					continue;
				}
				copy( $Entry, $target . '/' . $entry );
			}
	 
			$d->close();
		}else {
			copy( $source, $target );
		}
	}
	
	 function getRandomData($total = 5, $status = '(1)' , $addCriteria = '', $orderByCriteria = ''  ){
	 		
				$result = array ();
	  			
				
				$this->setCriteria( ' and '.$this->tableName.'.statuskey in  '.$status.' ' .$addCriteria  );
			  	$query = $this->getQuery() . $orderByCriteria ;  
			   
				
				$rs = $this->oDbCon->doQuery($query);
				 
				if ( count($rs) == 0 )
					return $result;
				  
				if (count($rs) < $total) { 
					$total = count($rs) ;  
				} 
			
				if ($total == 1) {
					$rand_keys[0] =  array_rand($rs, $total); 
				}
				else{ 
					$rand_keys = array_rand($rs, $total); 
				}  		 
			 
				
				
				for ($i=0;$i<$total;$i++) {
					$query = 'select '.$this->tableName  .'.* from '.$this->tableName  .' where '.$this->tableName  .'.pkey = ' . $rs[$rand_keys[$i]]['pkey'] ; 	
	 			 	$rsTemp = $this->oDbCon->doQuery($query);
					array_push($result,$rsTemp[0]);	 
				} 
	 	
			return $result;
	  }
	  
	  function sendMail($from_name='',$from_email='',$subject,$msg,$to){
				 	
					if (empty($from_email))
						$from_email = 'webmaster@'.$this->domain;
						
					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
					
					// More headers 
					$headers .= 'From: '.$this->loadSetting('companyName').' <webmaster@'.$this->domain.'>' . "\r\n"; 
					
					if (!empty($from_email))
						$headers .= 'Reply-To: '.$from_name.' <'.$from_email.'>' . "\r\n"; 
					
					mail($to,$subject,$msg,$headers);
						
	}
	
	function memberLogin ($userName='',$password=''){
	 	$returnVal ='
				select 
					*
				from
					customer
				where
					username = '.$this->oDbCon->paramString($userName).' and		
					password = '.$this->oDbCon->paramString(md5($password)).'    
			';		 
		$rs = $this->oDbCon->doQuery($returnVal);
		 
	 	return $rs;
	}
	
	
	function dateDiff($dateFrom,$dateTo,$separator=' / ',$format='U'){
		 // $dt format indonesia => DD MM YYYY
		 
		// datefrom 
		$strs = explode($separator, $dateFrom);
		$day = $strs[0];
		$month = $strs[1];
		$strs = explode(" ", $strs[2]);
		$year = $strs[0];
		
		$hour = 0;
		$min = 0;
		$sec = 0;
		
		if (!empty($strs[1])) {
			$strs = explode(":", $strs[1]);
			$hour = $strs[0];
			$min =  $strs[1];
			if(!empty($strs[2]))
				$sec =  $strs[2];
		}
		 
		$dateFrom = date($format, mktime($hour,$min,$sec, $month, $day, $year )) ;
		
		
		
		// dateto 
		$strs = explode($separator, $dateTo);
		$day = $strs[0];
		$month = $strs[1];
		$strs = explode(" ", $strs[2]);
		$year = $strs[0];
		
		$hour = 0;
		$min = 0;
		$sec = 0;
		
		if (!empty($strs[1])) {
			$strs = explode(":", $strs[1]);
			$hour = $strs[0];
			$min =  $strs[1];
			if(!empty($strs[2]))
				$sec =  $strs[2];
		}
		 
		$dateTo = date($format, mktime($hour,$min,$sec, $month, $day, $year )) ;
		
		
		return $dateTo - $dateFrom;
		
	}
	
	function formatDbDate($dt,$format=''){
		// $dt format mysql => YYYY MM DD
		
		if (empty($format))
			$format = 'd / m / Y' ;
			
		$strs = explode("-", $dt);
		$year = $strs[0];
		$month = $strs[1];
		$strs = explode(" ", $strs[2]);
		$day = $strs[0];
		
		$hour = 0;
		$min = 0;
		$sec = 0;
		
		if (!empty($strs[1])) {
			$strs = explode(":", $strs[1]);
			$hour = $strs[0];
			$min =  $strs[1];
			$sec =  $strs[2];
		}
		 
		return date($format, mktime($hour,$min,$sec, $month, $day, $year ));
		
	}
	 
	 
  	function checkPassword($id,$username,$password){
			$sql = 'select * from '.$this->tableName .' where pkey = '  .$this->oDbCon->paramString($id) . '  and username = '.$this->oDbCon->paramString($username).' and password = md5('.$this->oDbCon->paramString($password).')';	
			$rs = $this->oDbCon->doQuery($sql);
 			
			if (count($rs) ==0)
				return false;
			else
				return true; 
	}
	  
	
	function setLog($msg){ 
	  
		$docRoot = $_SERVER ['DOCUMENT_ROOT'] ;
		if(substr($docRoot,-1) <> "/") {
			$docRoot .= '/';
		}
		
	 	$path = $docRoot.'log/';
		
		if (!file_exists($path)) {
			mkdir($path, 0755, true);
		} 
		
		$filename = $path.md5($docRoot).'.txt'; 
				   
		error_log ($msg.chr(13),3,$filename);
	}
	
	
		
	function updateOrder ($orderlist,$id){
			if ($this->oDbCon->startTrans()){
				
				$sql = 'select pkey from ' . $this->tableName . ' where pkey <> '.$this->oDbCon->paramString($id).' and orderlist >= ' . $this->oDbCon->paramString($orderlist) .' order by orderlist asc' ;
				$rs =  $this->oDbCon->doQuery($sql);
					
				for ($i=0;$i<count($rs);$i++){
					$orderlist++;
					$sql = 'update ' . $this->tableName . ' set orderlist = '.$orderlist.' where pkey = ' . $rs[$i]['pkey'] ;			
					$this->oDbCon->execute($sql);	
				}
		 
				//$this->addTrail($sql);
				$this->oDbCon->endTrans(); 
				return true;				
				
			}else {
				$this->oDbCon->rollback();
				return false;
			}
					
	}
	
  
  
  function uploadImage($sourcePath, $destinationPath,$fileName){ 
		
		if(!is_dir($destinationPath)) 
			mkdir ($destinationPath,  0775, true);
	  
		//always change to 0775
		chmod($destinationPath,  0775);
	 	 
		 if(substr($sourcePath,-1) <> "/")   $sourcePath  .= '/';  
		 if(substr($destinationPath,-1) <> "/")   $destinationPath  .= '/';  
	
		rename($sourcePath.$fileName,$destinationPath.$fileName); 
		
	} 
	
  
  
  function uploadFile($pkey, $arrParam,$folder='',$sourcepath =''){
				
				if(empty($arrParam['filelisttoken']))
					return;
					
				//read all file in temp folder, add to array and insert to database
								
				$arrImage = array();

				if ($sourcepath == '')
					$sourcepath = $this->uploadTempDoc.$arrParam['filelisttoken'].'/';
			
					
				if(!is_dir($sourcepath)){
					mkdir ($sourcepath,  0775);
				}
				
				//always change to 0775
				chmod($sourcepath,  0775);
				
				$dir = opendir($sourcepath);
			
				$arrImage = array();
				$imgCtr = 0;
				while($file = readdir($dir)) {
					if (is_file($sourcepath.$file)){ 
					
						$arrImage[$imgCtr]['filename'] = $file ;
						$arrImage[$imgCtr]['filesize'] = filesize($sourcepath.'/'.$file) / 1024 ;
						$arrImage[$imgCtr]['filewidth'] = 0;
						$arrImage[$imgCtr]['fileheight'] = 0;
						
						$imgCtr++;
						 
					}
				}
				closedir($dir);
					 
				
				//move (not copy) temp folder and rename it 
				if(!empty($pkey))
					$pkey = $pkey . '_file/';
					
				$targetpath = $this->defaultDocUploadPath.$folder.$pkey;
				
				
				$this->deleteAll($targetpath,true);
				if (!is_dir($targetpath))
					mkdir($targetpath,0775);
					 
				rename($sourcepath,$targetpath);
			
				return $arrImage; 	
		
	} 
	
	function formatNumber($number,$decimal=0,$thousandseparator=',',$decimalseparator='.'){
      
        if ($decimal == 0){
          global $setting; 
          $decimalNumber = $setting->loadSetting('decimalTransaction');
          
          if (!empty($decimalNumber))
              $decimal = $decimalNumber;
            
        }
        
		return number_format($number,$decimal,$decimalseparator,$thousandseparator);
	}
	
	function unFormatNumber($val){
		return str_replace(',','',$val); 
	}
	  
	
	function setTransactionLog($actiontype,$pkey,$desc = ''){
        $userkey = 0;
        
        if (!empty($_SESSION[$this->loginAdminSession]['id']))
		  $userkey = base64_decode($_SESSION[$this->loginAdminSession]['id']);
        
	  	$rs = $this->getDataRowById($pkey);	 
        
		$sql =  'insert into 
					transaction_log ( 
						createdon,
						createdby,
						action,  
						tablename,
						refkey,
						refcode,
                        trdesc
					) values( 
						now(),
						'.$this->oDbCon->paramString($userkey).',
						'.$this->oDbCon->paramString($actiontype).',  
						'.$this->oDbCon->paramString($this->tableName).',
						'.$this->oDbCon->paramString($rs[0]['pkey']).',
						'.$this->oDbCon->paramString($rs[0]['code']).' ,
						'.$this->oDbCon->paramString($desc).' 
                        
					)';
		return $this->oDbCon->execute($sql);	
	}
	 
	   
	function addErrorList(&$arrayToJs,$condition,$label){  
            //$this->setLog($label);
			array_push($arrayToJs,array("valid" => $condition, "message" => $label));  
	}
	
	function useAutoCode($table_name){	
		$sql = 'select * from _code where code = '.$this->oDbCon->paramString($table_name); 
		$rsUseAutoCode = $this->oDbCon->doQuery($sql);
		$useAutoCode = $rsUseAutoCode[0]['useautocode'];
		return $useAutoCode;
	} 
	
	function getTotalRows($criteria){
		
		$this->setCriteria($criteria); 
		$rs  = $this->oDbCon->doQuery($this->getQuery());
		return count($rs);
		
	} 
	 
	 function changeTag($id, $newTag){
		 
		 try{
			
			$arrayToJs =  array();
			
			if(!$this->oDbCon->startTrans())
				throw new Exception($this->errorMsg[100]); 
					 
			$sql = 'update ' . $this->tableName . ' set tagkey = ' . $this->oDbCon->paramString($newTag) . ' where pkey = ' . $this->oDbCon->paramString($id) ;
			$this->oDbCon->execute($sql);
			
			$this->oDbCon->endTrans();
			
			$arrayToJs[0]['valid'] = true;
			$arrayToJs[0]['message'] = $this->lang['dataHasBeenSuccessfullyUpdated'];
			
		} catch(Exception $e){
			$this->oDbCon->rollback(); 
			 
			$arrayToJs[0]['valid'] = false;
			$arrayToJs[0]['message'] = $e->getMessage(); 
		}		 
 		return $arrayToJs; 
		 
	 }
	  
	 function generateTimeStamp($obj,$id){
		$employee = new Employee();
		 
		$rstimeStamp = $obj->getDataRowById($id);
		$rsCreator = $employee->getDataRowById($rstimeStamp[0]['createdby']);
		$rsModifier = $employee->getDataRowById($rstimeStamp[0]['modifiedby']);
	
		
		$timestamp = '<div style="clear:both;"></div>';	
		$timestamp .= '<div class="timestamp">';
		$timestamp .= $rsCreator[0]['name'].' &bull; '.$obj->formatDbDate($rstimeStamp[0]['createdon'],'d / m / Y H:i:s') .'<br>'; 
		$timestamp .= $rsModifier[0]['name'].' &bull; '.$obj->formatDbDate($rstimeStamp[0]['modifiedon'],'d / m / Y H:i:s');
		$timestamp .= '</div>';  
		
		return $timestamp;
	}
	
	
	function escapeJsonString($value) { # list from www.json.org: (\b backspace, \f formfeed)
		$escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
		$replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
		$result = str_replace($escapers, $replacements, $value);
		return $result;
	}
	 
	function getDomain($string){
				
		$domain = parse_url($string);
		
		if (isset($domain["host"])){
			$domain = $domain["host"];
		}else{ 
			$domain = $domain["path"];
		}
		
		 $domain = str_replace('www.','',$domain); 
		 $domain = str_replace('www','',$domain); 
		 
	 	return $domain;
 
	}
	
	function randomPassword($length = 8) {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < $length; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
    
    function cancelGLByRefkey ($transactionPkey,$refTable){ 
        //  cancel GL
        $generalJournal = new GeneralJournal();
        
        $rs = $generalJournal->searchData('refkey',$transactionPkey,true,' and reftable = '.$this->oDbCon->paramString($refTable));   
        if (!empty($rs)) {
            
            if ($rs[0]['statuskey'] == 1 || $rs[0]['statuskey'] == 2){
                    $generalJournal->delete($rs[0]['pkey']); 
            }else if ($rs[0]['statuskey'] == 3){
                    //create reverse journal kalo jurnal sudah closed
                
                    $arr = Array();
                    $arr['code'] = 'xxxxx';
                    $arr['refkey'] = $rs[0]['refkey'];
                    $arr['trdesc'] = $rs[0]['trdesc'];
                    $arr['trDate'] = date('d / m / Y');
                    $arr['totaldebit'] = $rs[0]['totalcredit'];
                    $arr['totalcredit'] = $rs[0]['totaldebit'];
                    $arr['createdby'] = $rs[0]['createdby'];
                
                    $rsDetail = $generalJournal->getDetailById($rs[0]['pkey']);
                    $arr['hidCOAKey'] = Array();
                    $arr['debit'] = Array();
                    $arr['credit'] = Array();
                    $arr['trdesc'] = Array();
                
                    for($i=0;$i<count($rsDetail);$i++){
                        array_push($arr['hidCOAKey'],$rsDetail[$i]['coakey']);
                        array_push($arr['debit'],$rsDetail[$i]['credit']);
                        array_push($arr['credit'],$rsDetail[$i]['debit']);
                        array_push($arr['trdesc'],$rsDetail[$i]['trdesc']); 
                    }
                     
                    $generalJournal->addData($arr); 
            }
            
        }
         
    }
    
    
    function getTotalIncomeStatement(){

        $chartOfAccount = new ChartOfAccount();

        $arrCOAType = array(3,4);
        $total = 0;
        $criteria = '';

	    $arrCriteria = array();
	    for($i=0;$i<count($arrCOAType);$i++) {
	        array_push($arrCriteria,$chartOfAccount->tableName.'.coatypekey like \'%-'.$arrCOAType[$i].'-%\'');
	        array_push($arrCriteria,$chartOfAccount->tableName.'.coatypekey = \''.$arrCOAType[$i].'\'');
	    }

			$criteria = implode(' or ' , $arrCriteria);
	        $rs = $chartOfAccount->searchData('','',true, ' and '. $chartOfAccount->tableName.'.statuskey = 1 and ('.$criteria.')');

			for ($i=0;$i<count($rs);$i++){
			  
  
				if (!$rs[$i]['isleaf'] == 0){ 
					$total += $rs[$i]['amount'];
                }
			}
			return $total;
    }
    
     
  function setLayoutForDirectPrint($data,$firstStart = false){ 
          
        global $setting; 
        
        if ($firstStart){  
            
                $companyName = strtoupper($this->loadSetting('companyName')); 
                $sitesName = $this->loadSetting('sitesName');

                $rsSetting = $setting->getDetailByCode('companyPhone');
                $companyPhone = $rsSetting[0]['value'];

                $companyAddress = explode(chr(13),$this->loadSetting('companyAddress'));  

                $patterns = array();
                $patterns[count($patterns)] = '/_COMPANY_NAME_/'; 
                $patterns[count($patterns)] = '/_COMPANY_PHONE_/'; 
                $patterns[count($patterns)] = '/_SITES_NAME_/'; 

                for($i=0;$i<count($companyAddress);$i++)
                    $patterns[count($patterns)] = '/_COMPANY_ADDRESS#'.($i+1).'_/'; 


                $replacement = array();
                $replacement[count($replacement)] = $companyName;  
                $replacement[count($replacement)] = $companyPhone;  
                $replacement[count($replacement)] = $sitesName;  

                for($i=0;$i<count($companyAddress);$i++)
                   $replacement[count($replacement)] = trim($companyAddress[$i]);   

                $data = preg_replace($patterns, $replacement, $data);    
        }  
  
        $arrLine  = explode ('\n',$data);
        
        $line = array(); 
        
        $patterns = '/{{([a-zA-Z0-9_ ,-.\'\+\&\;\/\:#\(\)]+)\|(\d+)\|(\w+)}}/'; 
        
        for($ctr = 0 ;$ctr<count($arrLine);$ctr++){
            $tempLine = '';
            preg_match_all($patterns, $arrLine[$ctr],$matches);   
            
            $line_patterns = array();
            $line_replacement = array();
            $new_line_patterns = array();
            $new_line_replacement = array();
            $insufficientLine = false;
            
           // echo $arrLine[$ctr].'<br>';
            
            for($i=0;$i<count($matches[0]);$i++){
               
                array_push($line_patterns, '/{{('.preg_quote($matches[1][$i], '/').')\|'.$matches[2][$i].'\|'.$matches[3][$i].'}}/');
                array_push($line_replacement, $this->align($matches[1][$i],$matches[2][$i],$matches[3][$i])); 
                
                //cek ad yg jadi 2 baris gk...  
                array_push($new_line_patterns, '/{{('.preg_quote($matches[1][$i], '/').')\|'.$matches[2][$i].'\|'.$matches[3][$i].'}}/');
                if(strlen($matches[1][$i]) > $matches[2][$i]) { 
                    $insufficientLine = true;
                    array_push($new_line_replacement,'{{'.trim(substr($matches[1][$i],$matches[2][$i],strlen($matches[1][$i]))).'|'.$matches[2][$i].'|'.$matches[3][$i].'}}');  
                }else{ 
                    array_push($new_line_replacement,'{{ |'.$matches[2][$i].'|'.$matches[3][$i].'}}');  
                }
                    
            } 
            
            $tempLine = preg_replace($line_patterns, $line_replacement, $arrLine[$ctr]);  
  
            
             array_push($line,$tempLine);  
              
             $newLine = preg_replace($new_line_patterns, $new_line_replacement, $arrLine[$ctr]); 
             if ($insufficientLine){
                array_push($line,  $this->setLayoutForDirectPrint($newLine));
               //  echo $newLine.'<br>';
             }
        }
      
        $line = implode('\n',$line); 
        
       
        return $line;
        
    }
	
	
	
    function align($text,$length, $align = 'left'){
        
		$data="";
        $space = ' ';
		$textlength =  strlen($text);
		
		if($textlength>$length)
		 $text = substr($text,0,$length);  
	 
	 
        if($align=="left"){
            $data.=$text;
            $data.=str_repeat($space,$length-$textlength);
        }else if($align=="right"){
            $data.=str_repeat($space,$length-$textlength);
            $data.=$text;
        }
         
		return $data;
	}
    
    function checkTotalItemLimitation($tableName,$limit){
        $sql = 'select count(pkey) as total from '.$tableName .' where statuskey = 1';
        $rs = $this->oDbCon->doQuery($sql); 
        if ($rs[0]['total'] > $limit)
            return true;
        else 
            return false;
    }
	
}

?>
