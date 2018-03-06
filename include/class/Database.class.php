<?php
class Database {
	var $con;
	var $result;  
	
	protected $transactionCounter = 0;
	 
	function Database($new_userid = '',$new_password = '',$new_dbname = '',$new_hostname = '') { 
		global $dbname;
		global $userid;
		global $password;
		global $hostname;
		
		if (!empty($new_userid))
			$userid = $new_userid;
			
		if (!empty($new_password))
			$password = $new_password;
			
		if (!empty($new_dbname))
			$dbname = $new_dbname;
			
		if (!empty($new_hostname))
			$hostname = $new_hostname;
        
     
		$this->connect($userid,$password,$dbname,$hostname); 
	}
 
	function connect($userid,$password,$dbname,$hostname){
		 
		try {
			$this->con = new PDO('mysql:host='.$hostname.';dbname='.$dbname, $userid, $password);
		}
		catch(PDOException $e) {
			return false;
		}
		
		try {
			$this->con->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
			$this->con->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,'SET time_zone = \'Asia/Jakarta\'');
		}
		catch(PDOException $e) {
			return false;
		}
		
		return $this->con;
	}
 
	function execute($varsql,$con='') { 
	  
        if (empty($con))
            $con = $this->con; 
        
	    $this->result = $con->exec($varsql);

		if($this->result === false) {
		 	  
			$errinfo = $this->con->errorInfo();
			$this->setLog('Invalid SQL command : ' . $varsql . chr(13) . $errinfo[2] .chr(13)); 
			$this->errMsg =  $errinfo[2];  
			$this->con->rollBack();
			die;
		}

		return $this->result;
	}
 
 
	function doQuery($varsql,$con='') {
		 
        if (empty($con))
            $con = $this->con;
        
		$this->result = $con->query($varsql);

		if($this->result == false) {
		
			$errinfo = $this->con->errorInfo();
			$this->setLog('Invalid SQL command : ' . $varsql . chr(13) . $errinfo[2] .chr(13)); 
			$this->errMsg =  $errinfo[2];  
			$this->con->rollBack();
			die;
		}
		
		$resultSet = $this->result->fetchAll();
		return $resultSet;
	}
 


	 function startTrans() { 
			 if ($this->transactionCounter < 0 )
				$this->transactionCounter = 0;
				 
			if ($this->transactionCounter++ == 0) {  
				return $this->con->beginTransaction();
			}  		
			
			return true;
  	}

	function endTrans() { 
		if ($this->transactionCounter == 1) { 
            $this->transactionCounter = 0; 
            $this->con->commit();
        }
		
		$this->transactionCounter--; 
	}
	
	 

    function rollback()
    {  
		if($this->transactionCounter > 1) 
        { 
            $this->transactionCounter = 0; 
            $this->con->rollback(); 
        } 
        $this->transactionCounter = 0;   
    }	 
	 
	  
	function paramString($str) {
        if (is_array($str)){
            $temp = array();
            for($i=0;$i<count($str);$i++){
              $temp[$i] = $this->paramString($str[$i]);
            }
            return $temp;
        }
        
		$str = htmlspecialchars($str);
		$quote = '\'';
		$result = '\'';
		$length = strlen($str);
		for($i = 0; $i < $length; $i++){
			$result = $result . $str[$i];
			if($str[$i] == $quote) {
				$result = $result . $quote;
		  	}
		  	if($str[$i] == '\\'){
				$result = $result . '\\';
		  	}
		}

		$result = $result . $quote;
		return $result;
	}
	 
	 
	function paramDate($dt,$separator='/',$format='Y-m-d H:i') {
		 // $dt format indonesia => DD MM YYYY
		 
		$strs = explode($separator, $dt);
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
		 
		return '\''. date($format, mktime($hour,$min,$sec, $month, $day, $year )) . '\''; 
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
	
}
?>
