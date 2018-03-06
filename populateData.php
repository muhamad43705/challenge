<?php 

function addDataListRow($rs,$arrColumn){
 	global $addDataFile; 
	global $obj;
	global $TAG_SHADOW;
	
	$datalistrow = '';
	
	for($i=0;$i<count($rs);$i++){   
	 
	 	$shadowClass = '';
		if (!empty($rs[$i]['tagkey']))
			$shadowClass = $obj->shadowClass[$rs[$i]['tagkey']]; 
		
		$inputStatusStyle = '';
		if (isset($obj->tableStatus) && ($obj->tableStatus == 'transaction_status' || $obj->tableStatus == 'ar_status' || $obj->tableStatus == 'payment_confirmation_status')){
			
		  if ($rs[$i]['statuskey'] == 1)
			$inputStatusStyle = 'text-royal-blue';
		  else if  ($rs[$i]['statuskey'] == 2)
			$inputStatusStyle = 'text-princeton-orange';
	 	  else if  ($rs[$i]['statuskey'] == 4)
			$inputStatusStyle = 'text-silver';
		}
		
		   
		$datalistrow .= '<li class="data-record '.$shadowClass.'" relId="'.$rs[$i]['pkey'].'">';
		$datalistrow .= '<div class="table-data-record-header" >'; 
			   
					  
					   $datalistrow .= ' <div class="div-table-row ">  
										 <div class="div-table-col '.$inputStatusStyle.'" style="text-align:right; width:30px; " >'.($i+1).'.</div> 
									 ';
					
							 for($j=0;$j<count($arrColumn);$j++){ 
							 
								$content = $rs[$i][$arrColumn[$j][1]];
								if(isset($arrColumn[$j][5])){
								 if ($arrColumn[$j][5] == 'integer')
										$content = $obj->formatNumber($content);
								 if ($arrColumn[$j][5] == 'decimal')
										$content = $obj->formatNumber($content,2);
								 else if($arrColumn[$j][5] == 'date')
										$content= $obj->formatDbDate($content);
								 else if($arrColumn[$j][5] == 'time')
										$content= $obj->formatDbDate($content,'H:i');
								 else if($arrColumn[$j][5] == 'datetime')
										$content= $obj->formatDbDate($content,'d / m / Y H:i');
								}
								  
								 $width = '';
								 if(!empty( $arrColumn[$j][2]))   
									 $width = 'width:' .$arrColumn[$j][2].'px;';
					
								 	 
								 $datalistrow .= ' <div style="text-align:'. $arrColumn[$j][4].';'. $width.'" class="div-table-col"><span class="unselectable '.$inputStatusStyle.'">'. $content .'</span></div> ';
					   
							 } 
								
					  $datalistrow .= '
					   </div>';
		$datalistrow .=  '</div> ';  
		
		$datalistrow .= '<div class="table-data-record-detail'.$rs[$i]['pkey'].' table-data-record-detail" ></div>'; 
	
		$datalistrow .=  '</li> '; 
	
	}
	
	
	 $datalistrow .= '
	  <script>
	  	$( document).ready(function() {   
  
			 
			  $( "#" + selectedTab.newPanel[0].id + " .selectable").selectable({
				filter : "li",	
				cancel: ".unselectable, .data-card",
				 stop: function() {    
					var selectedPkey = Array();
					$( ".ui-selected", this ).each(function() { 
					     selectedPkey.push($(this).attr("relId"));
					});
					 
					tabParam[selectedTab.newPanel[0].id].selectedPkey = selectedPkey;  
					 
				  }
			 })  
			 
		});
	 
	 </script>
';
	  
	  
	return $datalistrow;
}

function buildDataList($rs,$arrColumn){ 
	global $obj;
	 
	$datalist  = '<ol class="data-list-row selectable">';
	$datalist .= addDataListRow($rs,$arrColumn); 
	$datalist .= '</ol> '; 
	$datalist .= '<div class="load-more user-select-none">
						'.$obj->lang['nextPage'].' <span class="loading-icon"></span> 
				  </div>';   
	return $datalist; 
} 


$quicksearchcriteria = '';
$quickSearchKey = '';  
$statusCriteria = '';
$tagCriteria = '';

if (isset($_POST) && !empty($_POST['quickSearchKey'])){
	$quickSearchKey = $_POST['quickSearchKey']; 
	for($i=0;$i<count($arrSarchColumn);$i++){
		$quicksearchcriteria .= $arrSarchColumn[$i][1] .' like ('.$obj->oDbCon->paramString( '%'.$quickSearchKey.'%' ).') ';	
		
		if($i<>count($arrSarchColumn) -1 )
			$quicksearchcriteria  .= ' or ';
			
	}
	$quicksearchcriteria = ' and (' .$quicksearchcriteria.')';
}

   
$selectedCriteriaStatusKey = array();
if(!empty($_POST['selectedCriteriaStatusKey']))
  $selectedCriteriaStatusKey = $_POST['selectedCriteriaStatusKey'];

$statusKeyCriteria = '';
if (!empty($selectedCriteriaStatusKey )){
	for ($i=0;$i<count($selectedCriteriaStatusKey); $i++){
		$statusKeyCriteria .= $obj->oDbCon->paramString($selectedCriteriaStatusKey[$i]);
		
		if ($i < count($selectedCriteriaStatusKey) -1 )
			$statusKeyCriteria .= ',';
	} 
	$statusCriteria = ' and ' . $obj->tableName .'.statuskey in ('.$statusKeyCriteria.')'; 
}  


   
$selectedCriteriaTagKey = array();
if(!empty($_POST['selectedCriteriaTagKey']))
  $selectedCriteriaTagKey = $_POST['selectedCriteriaTagKey'];

$tagKeyCriteria = '';
if (!empty($selectedCriteriaTagKey )){
	for ($i=0;$i<count($selectedCriteriaTagKey); $i++){
		$tagKeyCriteria .= $obj->oDbCon->paramString($selectedCriteriaTagKey[$i]);
		
		if ($i < count($selectedCriteriaTagKey) -1 )
			$tagKeyCriteria .= ',';
	} 
	$tagCriteria = ' and ' . $obj->tableName .'.tagkey in ('.$tagKeyCriteria.')'; 
}  
 

$orderby = 'pkey';
if(!empty($_POST['orderby']))
	$orderby = $_POST['orderby'];
	
$ordertype = 'desc';
if(!empty($_POST['ordertype']))
	if ($_POST['ordertype'] == 1)
		$ordertype = 'desc';
	else
		$ordertype = 'asc';

$page = 0; 
if(!empty($_POST['page']))
	 $page =  $_POST['page']; 


if (!is_numeric ($page)) 
	die; 	  
	 
	 
$adminTotalRowsPerPage = $class->loadSetting('adminTotalRowsPerPage'); 

// for COA List
if(!empty($_POST['adminTotalRowsPerPage']))
	 $adminTotalRowsPerPage =  $_POST['adminTotalRowsPerPage']; 


$obj->setCriteria($quicksearchcriteria .$statusCriteria.$tagCriteria);  
$sortSql = ' order by '.  $orderby  .' '. $ordertype;
$rs =  $obj->oDbCon->doQuery( $obj->getQuery() . $sortSql );  

$totalDataRows = count($rs);
$totalPages = ceil($totalDataRows/$adminTotalRowsPerPage);

	 
$loadMoreTriggered = "false";
if(!empty($_POST['loadMoreTriggered']))
 	$loadMoreTriggered  = $_POST['loadMoreTriggered'];
 
if ($loadMoreTriggered == "false") { 
	$lastRowIndex = $page * $adminTotalRowsPerPage;  
}else{
	$lastRowIndex = $_POST['lastRowIndex']; 
}

if ( $lastRowIndex > $totalDataRows){
	$lastRowIndex = 0;
}
 
$rs = array_slice($rs,$lastRowIndex,$adminTotalRowsPerPage); 
 

$isEOF = false;
if ( $lastRowIndex + $adminTotalRowsPerPage >= $totalDataRows )
	$isEOF = true;

$arrReturn = array();

if ($loadMoreTriggered=="false"){
	$arrReturn['dataList'] = buildDataList($rs,$arrColumn);  
}else{
	$arrReturn['dataList'] = addDataListRow($rs,$arrColumn);  
}

$arrReturn['eof'] = $isEOF;   
$arrReturn['selectedPageIndex'] = $page;
$arrReturn['totalPages'] = $totalPages; 
$arrReturn['lastRowIndex'] = $lastRowIndex + count($rs);

//status information
$arrStatusInformation = array();
$rsStatus = $obj->getAllStatus(); 

$changeStatusCallback = ''; 
$statusContextMenu = array();

for($i=0;$i<count($rsStatus);$i++){
	$statusCriteria = $quicksearchcriteria . ' and '.$obj->tableName.'.statuskey = ' .$obj->oDbCon->paramString($rsStatus[$i]['pkey']) ;	
		
	if(!empty($tagKeyCriteria))  
		$statusCriteria .= ' and '.$obj->tableName.'.tagkey in ('.$tagKeyCriteria.')';
 
	$arrStatusInformation[$i]['statusPkey'] = $rsStatus[$i]['pkey'];
	$arrStatusInformation[$i]['statusName'] = $rsStatus[$i]['status'];
	$arrStatusInformation[$i]['totalData'] = $obj->getTotalRows($statusCriteria);
	
	$changeStatusCallback  .= 'case "'.$rsStatus[$i]['status'].'":  
								 changeStatus("'.$rsStatus[$i]['pkey'].'",key);
								 break;'.chr(13);
								 
	$statusContextMenu[$rsStatus[$i]['status']]['name'] = $rsStatus[$i]['status'];
	
}

$arrReturn['statusInformation'] = $arrStatusInformation;

//tag information
$arrTagInformation = array();
$rsTag = $obj->getAllTag();

$tagCallback = ''; 
$tagContextMenu = array();

$tagCallback  .= 'case "ClearTag":  
						 changeTag("0",key);
						 break;'.chr(13);

$tagContextMenu['ClearTag']['name'] = $obj->lang['clearTag'];
	  
	
for($i=0;$i<count($rsTag);$i++){
	$tagCriteria = $quicksearchcriteria . ' and '.$obj->tableName.'.tagkey = ' .$obj->oDbCon->paramString($rsTag[$i]['pkey']) ;	
	
	if(!empty($statusKeyCriteria))  
		$tagCriteria .= ' and '.$obj->tableName.'.statuskey in ('.$statusKeyCriteria.')';
 
	$arrTagInformation[$i]['tagPkey'] = $rsTag[$i]['pkey'];
	$arrTagInformation[$i]['tagName'] = $rsTag[$i]['tagname'];
	$arrTagInformation[$i]['hexColor'] = $rsTag[$i]['hexcolor']; 
	$arrTagInformation[$i]['totalData'] = $obj->getTotalRows($tagCriteria);
	
	
	$tagCallback  .= 'case "'.$rsTag[$i]['tagname'].'":  
								 changeTag("'.$rsTag[$i]['pkey'].'",key);
								 break;'.chr(13);
								 
	$tagContextMenu[$rsTag[$i]['tagname']]['name'] = $rsTag[$i]['tagname'];
	
}

$arrReturn['tagInformation'] = $arrTagInformation; 


   
$contextMenu = array();
$contextMenu["selectAll"] = array("name"=>$obj->lang['selectAll'], "icon"=>"selectall");
$contextMenu["deselectAll"] = array("name"=>$obj->lang['deselectAll'], "icon"=>"deselectall");
$contextMenu["separator1"] = "-----";
$contextMenu["showDetail"] = array("name" => $obj->lang['showDetail'], "icon"=>"showdetail");
$contextMenu["hideDetail"] = array("name" => $obj->lang['hideDetail'], "icon"=>"hidedetail");
$contextMenu["edit"] = array("name" => $obj->lang['viewOrEdit'], "icon" =>"edit");
$contextMenu["delete"] = array("name" =>  $obj->lang['delete'], "icon" =>"delete");
$contextMenu["changeStatus"] =  array("name" => $obj->lang['changeStatus'], "icon" =>"changestatus","items" => $statusContextMenu);
$contextMenu["changeTag"] = array("name" => $obj->lang['tag'],"icon" =>"tag", "items" => $tagContextMenu); 
$contextMenu["separator2"] = "-----";


$callbackFunction = '';
if (isset($overwriteContextMenu)){	 
	foreach ($overwriteContextMenu as $key => $value) {   
		$contextMenu[$key] = $overwriteContextMenu[$key];  
		if (!empty($contextMenu[$key]['callbackFunction']))  
		  $callbackFunction  .=  $contextMenu[$key]['callbackFunction']; 
	} 
} 

$arrReturn['contextMenu'] = array();
foreach ($contextMenu as $key => $value) {   
	if (!empty($value)) 
	  $arrReturn['contextMenu'][$key]=$contextMenu[$key];  
} 

$arrReturn['contextMenuCallback'] = '  
									  switch(key) {
											case "selectAll":    
												selectAllRows(); 
												break;
											case "deselectAll": 
												deselectAllRows();
												break;
											case "showDetail": 
												toggleAllSelectedDataDetail(2);
												deselectAllRows(); 
												break;
											case "hideDetail": 
												toggleAllSelectedDataDetail(1);
												deselectAllRows(); 
												break;
											case "edit": 
												openTabForEdit(); 
												break;
											case "delete":  
												 deleteData();
												 break;  
											'.$changeStatusCallback .' 
											'.$tagCallback .' 
											'.$callbackFunction.'
											default: 
												break;
										} '; 
 

echo json_encode($arrReturn);
die;

?>
