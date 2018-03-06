<?php
class Setting extends BaseClass{

	
    /**
    ************************************
    * Application functions section
    ************************************
    **/

    function Setting(){
    /**
    * This is class constructor, input any initialize stuffs here.
    **/

        parent::BaseClass();

       $this->tableName = '_setting';
       $this->tableNameDetail = '_setting_detail';
       $this->tableNameCategory = '_setting_category';
       $this->tableUserSetting = '_user_setting';
	   $this->securityObject = 'Setting';
	   $this->tableStatus = 'master_status';
	   $this->uploadFolder = "setting/";
       $this->securityObject = 'Setting';
 		 
	   
   }
	
	function getSettingList($catid= '') {
 
		$sql = '
				select
					*
				from 
					' . $this->tableName . ' 
			    where  
					' . $this->tableName . '.show = 1';
			
		if ($catid <> ''){
		$sql .= ' and
				categorykey = '.$this->oDbCon->paramString($catid);
		}
			$sql .= '	order by orderlist asc';
		 
		return $this->oDbCon->doQuery($sql);
	}
  
  
    function getSettingData(){
		$sql = 'select
					'. $this->tableName . '.pkey,
					'. $this->tableName . '.code,
					'. $this->tableName . '.type,
					'. $this->tableName . '.description,
					'.$this->tableName.'.multivalue,
					'.$this->tableUserSetting.'.value
				from 
					' . $this->tableName . ' left join ' . $this->tableUserSetting . ' on ' . $this->tableName . '.pkey  = ' . $this->tableUserSetting . '.settingkey 
				where 
					1=1
				';	
		return $this->oDbCon->doQuery($sql);
	}
	
	function editData($arrParam){    
	
			try {
				$arrayToJs =  array();
				 
				if(!$this->oDbCon->startTrans())
					throw new Exception($this->errorMsg[100]);
				  
					$rsContent = $this->getSettingList();
					 
					for ($k=0;$k<count($rsContent) ; $k++){  
						 
						 if ($rsContent[$k]['multivalue'] == 1){
							 $sql = 'delete from ' . $this->tableNameDetail . ' where refkey = ' .$rsContent[$k]['pkey'] ;
							 $this->oDbCon->execute($sql);
							 
							 $detailSetting = $arrParam[$rsContent[$k]['code']];
							 $labelSetting =  $arrParam[$rsContent[$k]['code'].'Label'];
							 for($i=0;$i<count($detailSetting);$i++){ 
							 	$value = trim($detailSetting[$i]);
								$label = trim($labelSetting[$i]);
								if (empty($label))
									continue;
									
								$sql = 'insert into ' . $this->tableNameDetail . ' (refkey,label,value) values ('.$this->oDbCon->paramString($rsContent[$k]['pkey']).', '.$this->oDbCon->paramString($label).', '.$this->oDbCon->paramString($value).') ';  
								$this->oDbCon->execute($sql); 
							 }
							 
						 }else{ 
						 		  
								//if (!isset($arrParam[$rsContent[$k]['code']]))
								//	continue;
								 
								if ($rsContent[$k]['type'] == 2){ 
									$updateVal = 'value  = '. $this->oDbCon->paramString($this->unFormatNumber($arrParam[$rsContent[$k]['code']]))  ;
								}else if($rsContent[$k]['type'] == 4) {
									$updateVal =  'value  = \''. addslashes( $arrParam[$rsContent[$k]['code']]).'\'' ; 
								}else if($rsContent[$k]['type'] == 6) {
								 	$fileName = $this->updateImage($rsContent[$k]['code'], $arrParam['token-item-image-uploader'.$rsContent[$k]['code']], $arrParam['item-image-uploader'.$rsContent[$k]['code']] );  
									$updateVal = 'value  = '. $this->oDbCon->paramString( $fileName)  ; 
								} else{ 
										$updateVal = 'value  = '. $this->oDbCon->paramString( $arrParam[$rsContent[$k]['code']])  ;
								}
								 
						}
							
							
                         //jika settingan update admin path
                        /*
                        if ($rsContent[$k]['code'] == 'adminPath'){
                            $oldPath = $this->loadSetting('adminPath');  
                             
                            $newPath  = preg_replace("/[^a-zA-Z0-9.]/", "", $arrParam[$rsContent[$k]['code']] );
                            
                            if (empty($newPath)) 
                                $newPath = $oldPath ;
                                 
                           // $this->updateHtaccess($newPath);

                            $docRoot = $_SERVER ['DOCUMENT_ROOT'] ;  
                            rename($docRoot .'/'.$oldPath , $docRoot .'/'.$newPath); 
                            
                            $updateVal = 'value  = '. $this->oDbCon->paramString($newPath)  ;
                        }*/
                        
						$sql = '
							update
								'. $this->tableUserSetting. '
							set
								'.$updateVal.'
							where
								settingkey = '.$this->oDbCon->paramString($rsContent[$k]['pkey']).'	 
						';
						  
						 $this->oDbCon->execute($sql);
                        
                        
					 }
						  	 
                
					//$this->addTrail($sql);
					$this->oDbCon->endTrans();  
					$this->addErrorList($arrayToJs,true,$this->lang['dataHasBeenSuccessfullyUpdated']);   
							
				
			} catch(Exception $e){
				$this->oDbCon->rollback();
				$this->addErrorList($arrayToJs,false, $e->getMessage());  
			}		
					  
	} 
	  
	 function updateImage($pkey,$token,$arrImage){		 
		 
		$sourcePath = $this->uploadTempDoc.$this->uploadFolder.$token;
		//$this->setLog('source ' . $sourcePath);
		$destinationPath = $this->defaultDocUploadPath.$this->uploadFolder;
		//$this->setLog('dest ' . $destinationPath);
		
			
		if(!is_dir($destinationPath)) 
			mkdir ($destinationPath,  0775, true);
			
		$destinationPath .= $pkey;  
 
 		//delete previous images	    
		$this->deleteAll($destinationPath);   
		 
		if(!is_dir($sourcePath)) 
			return; 
		
		if (!empty($arrImage))	{
			$arrImage = explode(",",$arrImage); 
			$this->uploadImage($sourcePath, $destinationPath,$arrImage[0]); 
			return $arrImage[0]; 
		}
		
		return '';
		
	} 

	function getSettingCategory(){
		$sql = '
				select 
					*  
				from 
					'.$this->tableNameCategory.'
				order by orderlist
			';
		  
		return $this->oDbCon->doQuery($sql);
	}
	
	function getDetailByCode ($code){
		$sql = 'select '.$this->tableNameDetail.'.* from '.$this->tableName.','.$this->tableNameDetail.' where '.$this->tableName.'.pkey = '.$this->tableNameDetail.'.refkey and '.$this->tableName.'.code = '.$this->oDbCon->paramString($code);
		return $this->oDbCon->doQuery($sql);
	}
	
	function getInput($rsContent,$forTemplate=false){
		
		$arrTemp = '';
		$disabled = '';
		if ($forTemplate){
			$disabled = 'disabled="disabled"';
		}
		if ($rsContent['multivalue']  == 1) 
			$arrTemp = '[]';
		
		if ($rsContent['type'] == 1) { 
			$inputType = $this->input('text',$rsContent['code']. $arrTemp,!$forTemplate,'',$disabled);
		}
		else if ($rsContent['type'] == 2 ){
			$inputType =  $this->input('text',$rsContent['code']. $arrTemp,!$forTemplate,'',$disabled,'form-control inputnumber'); 
		}
		else if ($rsContent['type'] == 3 ){
			$inputType = $this->inputTextArea($rsContent['code']. $arrTemp,!$forTemplate,'','style="height:14em;" ' . $disabled);
		}		
		else if ($rsContent['type'] == 4 ){
			$inputType = $this->inputTextArea($rsContent['code']. $arrTemp,!$forTemplate,'','style="height:14em;" ' . $disabled);
		}		
		else if ($rsContent['type'] == 6 ){								
		   
				$rsItemImage = array(); 
				$value =  $this->loadSetting($rsContent['code']) ;
			 	
				if( !empty($value)){
					$rsItemImage[$rsContent['code']]['file'] =  $value;
				
					$sourcePath = $this->defaultDocUploadPath.$this->uploadFolder.$rsContent['code'];
					$destinationPath = $this->uploadTempDoc.$this->uploadFolder.$rsContent['code'];  
				
					$this->deleteAll($destinationPath); 
				
					if(!is_dir($destinationPath)) 
						mkdir ($destinationPath,  0775, true);
							
					$this->fullCopy($sourcePath,$destinationPath); 
					
					$inputType = '<script>
							var arrImage = Array();
							var arrPHPThumbHash = Array();
						 ';
					for($i=0;$i<count($rsItemImage);$i++) {
						$inputType .= 'arrImage.push("'.$rsItemImage[$rsContent['code']]['file'].'"); '; 
						$inputType .= 'arrPHPThumbHash.push("'.getPHPThumbHash($rsItemImage[$rsContent['code']]['file']).'"); '; 
					
                    }
					$inputType .= 'createImageUploader(fileUploaderTarget+"'.$rsContent['code'].'",{"folder":folder, "token":"'.$rsContent['code'].'", "arrImage":arrImage,"phpThumbHash":arrPHPThumbHash},false);'; 
                       
                    
					$inputType .= '</script>';
				}else{
					$inputType = '<script>createImageUploader(fileUploaderTarget+"'.$rsContent['code'].'",{"folder":folder},false);</script>';
				}
				
				
				$inputType .= '  <div class="item-image-uploader item-image-uploader'.$rsContent['code'].'">
								<ul class="image-list" ></ul>
								<div style="clear:both; height:1em; "></div>
								<div class="file-uploader">	
									<noscript><p>Please enable JavaScript to use file uploader.</p></noscript> 
								</div>
							  </div>  ';
							  
							  
				 
		} 
		
		return $inputType;		
	}
	
    
  }

?>