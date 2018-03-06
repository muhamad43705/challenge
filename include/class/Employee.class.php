<?php

class Employee extends BaseClass{
 
    function Employee(){ 

        parent::BaseClass();

		$this->tableName = 'employee';
		$this->tableStatus = 'employee_status';
		$this->tableSecurityAccess = 'security_access';	  
		$this->securityObject = 'Employee';	  
		 
		
   }
    
	function getQuery(){
	   
	   return '
				select
					'.$this->tableName. '.*,
					'.$this->tableStatus.'.status as statusname			
				from 
					'.$this->tableName . ', 
					'.$this->tableStatus.'
				where  		
					'.$this->tableName . '.statuskey = '.$this->tableStatus.'.pkey    
 		' .$this->criteria ; 
		 
    }
	
	function addData($arrParam){
		
		$arrayToJs =  array();
		
		try{
			   
			$arrayToJs = $this->validateForm($arrParam);
			if (!empty($arrayToJs)) 
					return $arrayToJs;
					
					
		 	if(!$this->oDbCon->startTrans())
				throw new Exception($this->errorMsg[100]);
		
			$pkey = $this->getNextKey($this->tableName); 
			$usecode = $this->useAutoCode($this->tableName);
			
			if($usecode == 1)  
				$arrParam['code'] =  $this->getNewCode($this->tableName); 
				
			$sql = '
					INSERT INTO		
					 '.$this->tableName .' ( 
						pkey, 
						code, 
						username,
						password,
						name, 
						statuskey, 
						createdon,
						createdby
					)
					VALUES	( 
						'.$pkey .',  
						'.$this->oDbCon->paramString($arrParam['code']).',
						'.$this->oDbCon->paramString($arrParam['memberUserName']).',
						'.$this->oDbCon->paramString(md5($arrParam['memberPassword'])).',
						'.$this->oDbCon->paramString($arrParam['memberName']).', 
						'.$this->oDbCon->paramString($arrParam['selStatus']).', 
						now(),
						'.$this->oDbCon->paramString($arrParam['createdBy']).'								
					)
			';
			 
			 
			$this->oDbCon->execute($sql);
			
			$arrParam['hidId'] = $pkey;
			$this->createDetail($arrParam);
			
            $this->setTransactionLog('add',$pkey);
            
			$this->oDbCon->endTrans();
					 
			$this->addErrorList($arrayToJs,true,$this->lang['dataHasBeenSuccessfullyUpdated']);   
					 
		} catch(Exception $e){
			$this->oDbCon->rollback();
			$this->addErrorList($arrayToJs,false, $e->getMessage());   
		}
		
		return $arrayToJs; 	 	
		 
	}


	function editData($arrParam){  
		
		$arrayToJs =  array();
			
		try{	 
			$arrayToJs = $this->validateForm($arrParam,$arrParam['hidId']);
			if (!empty($arrayToJs)) 
					return $arrayToJs; 
	   
		
			if(!$this->oDbCon->startTrans())
				throw new Exception($this->errorMsg[100]);
            
            $updatePassword = '';
			if (!empty($arrParam['memberPassword'])){
				$updatePassword  = ', password = '.$this->oDbCon->paramString(md5($arrParam['memberPassword']));
			}

            $updateStatus = '';
			if (empty($arrParam['updateProfile']) || (!empty($arrParam['updateProfile']) && !empty($arrParam['selStatus']))){
				$updateStatus = ', statuskey ='.$this->oDbCon->paramString($arrParam['selStatus']);
			}
            
			$sql = '
					UPDATE	
					 '.$this->tableName .'
					SET	   
					 username ='.$this->oDbCon->paramString($arrParam['memberUserName']).',	 
					 name ='.$this->oDbCon->paramString($arrParam['memberName']).',	 
					 modifiedby = '.$this->oDbCon->paramString($arrParam['modifiedBy']).',
					 modifiedon = now()
                     '.$updateStatus.'
					 '.$updatePassword.'
					WHERE	
					 pkey = '.$this->oDbCon->paramString($arrParam['hidId']).' 
					
			';    
			 
			$this->oDbCon->execute($sql);
            
			if (empty($arrParam['updateProfile'])) 
                $this->createDetail($arrParam);
          
            $this->setTransactionLog('edit',$arrParam['hidId']);
            
			$this->oDbCon->endTrans();  
			$this->addErrorList($arrayToJs,true,$this->lang['dataHasBeenSuccessfullyUpdated']);   
					
				
		} catch(Exception $e){
			$this->oDbCon->rollback();
			$this->addErrorList($arrayToJs,false, $e->getMessage());  
		}		
				 
 		return $arrayToJs; 
	}
	 
	
	function createDetail($arrParam){
		 
		$sql = 'delete from security_access where userkey = ' . $arrParam['hidId'];
		$this->oDbCon->execute($sql);
		 
		
		$security = new Security();
		$rsSecurityObject  = $security->generateSecurityObject(); 
		
		for ($i=0;$i<count($rsSecurityObject);$i++){
		 	
			if (!isset($arrParam['chkList' . $rsSecurityObject[$i]['pkey']]))
				continue;
		
			for($j=0;$j<count($arrParam['chkList' . $rsSecurityObject[$i]['pkey']]);$j++){
				$sql = '
					INSERT INTO		
					security_access ( 
						userkey,
						objectkey,
						statuskey 
						)
						VALUES	(
						'.$arrParam['hidId'].', 
						'.$this->oDbCon->paramString($rsSecurityObject[$i]['pkey']).', 
						'.$this->oDbCon->paramString($arrParam['chkList' . $rsSecurityObject[$i]['pkey']][$j]).' 
					)
				';
				
				$this->oDbCon->execute($sql);
			} 
		}
	} 
	 
	function validateForm($arr,$pkey = ''){
		  
		  
		$arrayToJs = array();
	   
	    $code =  $arr['memberCode']; 
	    $name =  $arr['memberName']; 
	 	$username = $arr['memberUserName'];  
		
		$rs = $this->isValueExisted($pkey,'code',$code);	 
		if(empty($code)){
			$this->addErrorList($arrayToJs,false,$this->errorMsg['code'][1]);
		}else if(count($rs) <> 0){
			$this->addErrorList($arrayToJs,false,$this->errorMsg['code'][2]);
		}
		  
	 	$rsUsername = $this->isValueExisted($pkey,'username',$username);	 
		if(empty($username)){
			$this->addErrorList($arrayToJs,false,$this->errorMsg['username'][1]);
		}else if(count($rsUsername) <> 0){
			$this->addErrorList($arrayToJs,false,$this->errorMsg['username'][2]);
		}
	
		if(empty($name)){
			$this->addErrorList($arrayToJs,false,$this->errorMsg['employee'][1]);
		} 
 
		
		return $arrayToJs;
	 }
	  
	 
	 function delete($id){
		 
		$arrayToJs =  array();
			
		try{
			
			$arrayToJs = $this->validateDelete($id);
				if (!empty($arrayToJs)) 
					return $arrayToJs;
		 	
			if(!$this->oDbCon->startTrans())
				throw new Exception($this->errorMsg[100]);
			  		  
			$sql = 'delete from  '.$this->tableName.' where pkey = ' . $this->oDbCon->paramString($id);
			$this->oDbCon->execute($sql);
		
			$sql = 'delete from  '.$this->tableSecurityAccess.' where userkey = ' . $this->oDbCon->paramString($id);
			$this->oDbCon->execute($sql);
            
            $this->setTransactionLog('delete',$id);
		 
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

	  function validateDelete($id){
		    
		$arrayToJs = array();
		$rs = $this->getDataRowById($id);
		
		if ($rs[0]['systemVariable'] == 1)  {
			$this->addErrorList($arrayToJs,false,'<strong>'.$rs[0]['name'].'</strong>. ' . $this->errorMsg[211]); 
		} 
		 		 
		return $arrayToJs;
	 } 
	 
	 
  }

?>
