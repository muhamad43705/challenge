<?php 

class Security extends BaseClass{
 

    function Security(){   
			parent::BaseClass(); 
			$this->securityObject = 'Security';
   }
	  
	function generateSecurityObject(){
		$sql = 'select security_object.* from security_object, user_security_object where  security_object.pkey = user_security_object.security_object_key and user_security_object.statuskey = 1 order by security_object.modulename asc';
	  	$rsObject = $this->oDbCon->doQuery($sql);
		
		return $rsObject ;
	}
	
	function getSecurityKey($objectcode){
		$sql = 'select pkey from security_object where modulecode = ' . strtolower($this->oDbCon->paramString($objectcode));
		$rsObject = $this->oDbCon->doQuery($sql);
		
		if (count($rsObject) <=0 )
			return 0;
			
		return $rsObject[0]['pkey'] ;
	}
	 
	function hasSecurityAccess($userkey,$objectkey,$statuskey){
		$sql = 'select security_access.* from security_access, employee
			 where
			security_access.userkey =  employee.pkey and
			 userkey = '.$this->oDbCon->paramString($userkey).' and objectkey = ' .$this->oDbCon->paramString($objectkey).' and security_access.statuskey = ' .$this->oDbCon->paramString( $statuskey);
	     
		$rs =  $this->oDbCon->doQuery($sql);
		 
		if (count($rs) == 0)
			return false;
		else
			return true;
	} 
	
	
   // security //
   function adminLogin ($userName='',$password=''){ 
		
		$returnVal ='
				select 
					pkey,
					email 
				from
					employee
				where
					username = '.$this->oDbCon->paramString($userName).'  and
					statuskey = 2 
			';		
		
		$resultSet = $this->oDbCon->doQuery($returnVal);
		 
		
		if (count ($resultSet) > 0 ) {
			$returnVal ='
					select 
						pkey,
						name,
						username,
						password,
						email
					from
						employee
					where
						username = '.$this->oDbCon->paramString($userName).'  and
						password = '.$this->oDbCon->paramString(md5($password)).'	 and
						statuskey <> 1 
				';		
			
			$resultSet = $this->oDbCon->doQuery($returnVal);
			
		}		
				
		 if (count ($resultSet) == 0)
		 	$statuskey = 2;
		 else	
		 	$statuskey = 1;
		 
		return $resultSet;
	}
	 
	 
	 function isAdminLogin($objectcode,$statuskey=10,$redirect = false ) {
	  
		if (empty($_SESSION[$this->loginAdminSession])){
			 if ($redirect)
				$this->kick($redirect);
			  else	
				return false;
		}
	  
		$memberkey = base64_decode($_SESSION[$this->loginAdminSession]['id']);
		  
    	$sql = '
			select
				pkey
			from 
				employee
			 where 
			 	employee.pkey=' . $this->oDbCon->paramString($memberkey) . ' and
				employee.password=' . $this->oDbCon->paramString($_SESSION[$this->loginAdminSession]['pass']) . ' and
				statuskey <> 1 
    	';
		
    	$userResultSet = $this->oDbCon->doQuery($sql);

    	if( count($userResultSet) == 0 ){
    	  if ($redirect)
		    $this->kick($redirect);
		  else	
			return false;
		}
		
		
		//cek hak akses ke modul
		$security = new Security();
		$objectkey  = $security->getSecurityKey($objectcode); 
	 
		if (!$security->hasSecurityAccess( $memberkey ,$objectkey,$statuskey)){
		  if ($redirect)
		    $this->kick($redirect);
		  else	
			return false;
		}
		
    	return true;
    }
	
	function isMemberLogin($redirect = true) { 
		
		if (empty($_SESSION[$this->loginSession]['id'])){
			 if ($redirect)
				$this->kick($redirect);
			  else	
				return false;
		}
		 
		
    	$sql = '
			select
				pkey
			from 
				customer
			 where 
			 	customer.pkey=' . $this->oDbCon->paramString(base64_decode($_SESSION[$this->loginSession]['id'])) . '
				and username = '. $this->oDbCon->paramString($_SESSION[$this->loginSession]['username']) .'  
				and password = '.$this->oDbCon->paramString($_SESSION[$this->loginSession]['pass']).'
				and statuskey = 2  
    	';
 		
		
    	$userResultSet = $this->oDbCon->doQuery($sql);
 
 
		if(empty($userResultSet)) {
		   if ($redirect){
				 $this->kick(); 
		   } else{
				return false;
			} 
    	}
		
    	return true;
    }
	
	
	
	function kick($redirect = false,$kickurl = '/') { 
		$nonAccessPage = '<script>location.href = "'.$kickurl.'"</script>';
		echo $nonAccessPage;
		die; 
    }
	    
	  
	function searchData($fieldname='',$searchkey='',$mustmatch=true,$searchCriteria='',$orderCriteria='', $limit=''){
		$sql = 'select security_object.modulename, security_access.userkey, security_access.statuskey  from security_object,security_access where security_object.pkey = security_access.objectkey ';
	
		if(!empty($fieldname)){
			
			$sql .= ' and ' ;
			
			if($mustmatch)
				$sql .=  $fieldname .' = '. $this->oDbCon->paramString($searchkey);
			else
				$sql .=  $fieldname .' like '. $this->oDbCon->paramString('%'.$searchkey.'%');
		}
				
		if($searchCriteria <> '')
			$sql .= ' ' .$searchCriteria;
	
		if($orderCriteria <> ''){
			$sql .= ' ' .$orderCriteria;
	 
	 	}
			
		if($limit <> '')
			$sql .= ' ' .$limit;
         
		return $this->oDbCon->doQuery($sql);	
	}
     
	 
  }

?>