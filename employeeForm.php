<?php 
include '_config.php'; 
include '_include.php'; 


$obj= $employee;
$securityObject = $obj->securityObject; // the value of security object is manually inserted to handle 
										// some modules that have different security object from that of their class

if(!$security->isAdminLogin($securityObject,10,true));
    
$useAutoCode = $obj->useAutoCode($obj->tableName);
$formAction = 'employeeList';

$parentFileName = $_GET['fileName'];
$parentPanelId = $_GET['selectedPanelId'];
$parentTitle = $_GET['title'];

$editCategoryInactiveCriteria = '';
$editWarehouseInactiveCriteria = '';

if (!empty($_GET['id'])){ 
	$id = $_GET['id'];	
	$rs = $obj->getDataRowById($id);
	
	$_POST['hidId'] = $rs[0]['pkey'];
	$_POST['memberCode'] = $rs[0]['code'];
	$_POST['memberUserName'] = $rs[0]['username'];
	$_POST['selStatus'] = $rs[0]['statuskey']; 
	$_POST['memberName'] = $rs[0]['name']; 
	
	$_POST['action'] = 'edit';
}else{
	
	$_POST['action'] = 'add';
	
	if($useAutoCode == 1) 
		$_POST['memberCode'] = 'XXXXXXXX';
}

$arrStatus = $obj->convertForCombobox($obj->getAllStatus(),'pkey','status'); 
$rsSecurityObject  = $security->generateSecurityObject();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
#security-module {padding:0; margin:0; list-style:none;} 
#security-module li{padding:0; margin:0;}
#security-module li .chkSecurityList, #security-module li .chkModuleName{font-size:1.5em;margin-right:0.2em;} 
.status-item{display:inline-block;  background-color:#dedede; padding:0.7em 1em 1em 1em; margin-left:0.2em; cursor:pointer;}
.module-item{display:inline-block; background-color:#3399CC; white-space: nowrap; padding:0.7em 1em 1em 1em; color:#FFF; width:20em; cursor:pointer;}

</style> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>  
<script type="text/javascript">  
	
	function checkSecurityModule(obj){
		
		 var objName = obj.prop("name");
		 var len = obj.closest("li").find(".chkSecurityList:not(:checked)").length;
		  
		 if (len == 0)
		  	obj.closest("li").find(".chkModuleName").first().prop("checked",true);
		 else
		  	obj.closest("li").find(".chkModuleName").first().prop("checked",false);
		 
		 
	}
	
	jQuery(document).ready(function(){  
		$("#" + selectedTab.newPanel[0].id + " #defaultForm").attr("id","defaultForm-"+selectedTab.newPanel[0].id);  
	
		 $("#security-module li .chkSecurityList").click(function() {    
		      if ($(this).prop("checked")) 
			 	 $(this).closest(".status-item").addClass("bg-green-avocado text-white");
			  else
			 	 $(this).closest(".status-item").removeClass("bg-green-avocado text-white");
				 
			 checkSecurityModule($(this));	 
		 });
	
 		 $(".chkModuleName").click(function() {     
		       var checked = $(this).prop("checked"); 
		       $(this).closest("li").find(".chkSecurityList").each(function() {   
					 if ($(this).prop("checked") != checked)
					   $(this).click();
				});
		 }); 
		 
        $('#defaultForm-' + selectedTab.newPanel[0].id +' [name=btnSelectAll]').click(function() {      
             $('#defaultForm-' + selectedTab.newPanel[0].id  +' [name^=chkSecurityModuleAccess]').prop("checked",false).click();
        }); 
        $('#defaultForm-' + selectedTab.newPanel[0].id +' [name=btnDeselectAll]').click(function() {      
             $('#defaultForm-' + selectedTab.newPanel[0].id  +' [name^=chkSecurityModuleAccess]').prop("checked",true).click();
        }); 
        
		 $('#defaultForm-' + selectedTab.newPanel[0].id )
			.bootstrapValidator({ 
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                memberCode: { 
                    validators: {
                        notEmpty: {
                            message: phpErrorMsg.code['1'],
                        }, 
                    }
                },  
              
				
				memberUserName: { 
                    validators: {
                        notEmpty: {
                            message:  phpErrorMsg.username['1'],
                        }, 
						 stringLength: {
                            min: 5,
                            max: 30,
                            message:  phpErrorMsg.username['3'],
                        }, 
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message:  phpErrorMsg.username['4'],
                        }
                    }
				}, 
	
				memberPassword: { 
                    validators: {
                       	<?php if (empty($_GET['id'])){ ?>
						 notEmpty: {
                            message:  phpErrorMsg.password['1'],
                        }, 
					   <?php } ?>	
						stringLength: {
                            min: 5,
                            max: 30,
                            message:  phpErrorMsg.password['2']
                        }, 
						identical: {
							field: 'memberPasswordConfirmation',
							message: phpErrorMsg.password['3']
						}
                    }
                },  
				memberPasswordConfirmation: { 
                    validators: {
                       
                       	<?php if (empty($_GET['id'])){ ?>
						 notEmpty: {
                            message:  phpErrorMsg.passwordConfirmation['1']
                        }, 
					   <?php } ?>	
					   
						stringLength: {
                            min: 5,
                            max: 30,
                            message:  phpErrorMsg.passwordConfirmation['2']
                        }, 
						identical: {
							field: 'memberPassword',
							message: phpErrorMsg.password['3']
						}
                    }
                },  
	
				memberName: { 
                    validators: {
                        notEmpty: {
                            message: phpErrorMsg.employee['1']
                        },  
                    }
                },    
				
            }
        })
        .on('success.form.bv', function(e) { 
           submitForm(e, "<?php echo $parentPanelId; ?>","<?php echo $parentTitle; ?>"); 
        });
	});
			
			
</script>

</head> 

<body> 
<div style="width:100%; margin:auto; " class="tab-panel-form">   
  <div class="notification-msg"></div>
  
  <form id="defaultForm" method="post" class="form-horizontal" action="<?php echo $formAction; ?>">
   	<?php echo $obj->input('hidden','hidId'); ?>
    <?php echo $obj->input('hidden','action'); ?>
    <?php echo $obj->input('hidden','hidCityKey'); ?>
     
     <div class="div-table" style="width:100%; ">
                <div class="div-table-row">
                    <div class="div-table-col"  style="width:49%; text-align:center">
                     		<div class="div-table-tab-form" style="float:left;"> 
                                      <div class="div-table-caption border-orange">Informasi Akun</div>
                                     
                                      <div class="div-table-row form-group">
                                       
                                        <div class="div-table-col-5  div-table-col-header">
                                            <label class="col-lg-1 control-label">Status</label>
                                        </div> 
                                        
                                        <div class="div-table-col-5">
                                            <div class="col-lg-12"> 
                                                 <?php echo  $obj->inputSelect('selStatus', $arrStatus); ?>
                                            </div>
                                        </div> 
                                        
                                     </div>
                                    
                                    
                                     <?php if($useAutoCode == 1)    
                                        $code = $obj->input('text','memberCode',true,'','readonly="readonly"', 'form-control readonly');  
                                     else  
                                        $code =  $obj->input('text','memberCode');   ?>
                                
                            
                                     <div class="div-table-row form-group">
                                        <div class="div-table-col-5" >
                                            <label class="col-lg-1 control-label">Kode</label>
                                        </div> 
                                        <div class="div-table-col-5">
                                            <div class="col-lg-12"> 
                                                 <?php echo  $code; ?>
                                            </div>
                                        </div> 
                                     </div>
                                    
                                     <div class="div-table-row form-group">
                                        <div class="div-table-col-5" >
                                            <label class="col-lg-1 control-label">Username</label>
                                        </div> 
                                        <div class="div-table-col-5">
                                            <div class="col-lg-12"> 
                                                  <?php echo $obj->input('text','memberUserName'); ?>
                                            </div>
                                        </div> 
                                     </div>
                                     
                                     <div class="div-table-row form-group">
                                        <div class="div-table-col-5" >
                                            <label class="col-lg-1 control-label">Password</label>
                                        </div> 
                                        <div class="div-table-col-5">
                                            <div class="col-lg-12"> 
                                                  <?php echo $obj->input('password','memberPassword'); ?>
                                            </div>
                                        </div> 
                                     </div>
                                       
                                     <div class="div-table-row form-group">
                                        <div class="div-table-col-5" >
                                            <label class="col-lg-1 control-label">Konfirmasi Password</label>
                                        </div> 
                                        <div class="div-table-col-5">
                                            <div class="col-lg-12"> 
                                                  <?php echo $obj->input('password','memberPasswordConfirmation'); ?>
                                            </div>
                                        </div> 
                                     </div>
                                    
                           </div>
                    </div> 
                    <div class="div-table-col"  style="width:2%;text-align:center;"></div>  
                    <div class="div-table-col"  style="width:49%;text-align:center">
                   		<div class="div-table-tab-form" style="float:left;"> 
                                  <div class="div-table-caption border-green">Informasi Data Diri</div>
                                 
                                 <div class="div-table-row form-group">
                                    <div class="div-table-col-5 div-table-col-header" >
                                        <label class="col-lg-1 control-label">Nama</label>
                                    </div> 
                                    <div class="div-table-col-5">
                                        <div class="col-lg-12"> 
                                              <?php echo $obj->input('text','memberName'); ?>
                                        </div>
                                    </div> 
                                 </div>                                
                       </div>
                    </div> 
                </div>
        </div>
          
 
   <div class="div-table-tab-form" style="float:left; margin-top:2em; width:100%;"> 
               <div class="div-table-caption border-blue">Hak Akses</div>
              <div>
                  <?php echo $obj->input('button','btnSelectAll',false,$obj->lang['selectAll'],'style="padding:0;"','btn btn-link'); ?>
                  <?php echo $obj->input('button','btnDeselectAll',false,$obj->lang['deselectAll'],'style="padding:0; margin-left:1em"','btn btn-link'); ?>
                    <div style="clear:both; height:1em"></div> 
              </div>
                <ul id="security-module" >
				<?php 
					$listSecurityAccess = '';
					
					for ($i=0;$i<count($rsSecurityObject);$i++){ 
						$listAccessItem = '';  
						$unChecked = false;
						
						$listSecurityAccess .= '<li>';
						
						$arrStatusName[10] = 'Lihat Semua';
						$arrStatusName[11] = 'Tambah';
						$arrStatusName[12] = 'Hapus';
						
						if ($rsSecurityObject[$i]['modulestatus'] ==  'view_only'){
								$selectedClass = '';
								$checked = '';
							 
								if (!empty($id) && $security->hasSecurityAccess($id,$rsSecurityObject[$i]['pkey'],10)){ 
									$checked = ' checked="checked"';
									$selectedClass = 'bg-green-avocado text-white';	
								} else{
									$unChecked = true;	
								}
								
								
								$listAccessItem .= '<label  class="status-item '.$selectedClass.'" ><input type="checkbox" class="chkSecurityList" value="10" name="chkList'.$rsSecurityObject[$i]['pkey'].'[]" '.$checked.'/>Lihat Semua</label>';
						}else if ($rsSecurityObject[$i]['modulestatus'] ==  'view_and_update'){
								
								$selectedClass = '';
								$checked = '';
							 
								if (!empty($id) && $security->hasSecurityAccess($id,$rsSecurityObject[$i]['pkey'],10)){ 
									$checked = ' checked="checked"';
									$selectedClass = 'bg-green-avocado text-white';	
								} else{
									$unChecked = true;	
								}
								
								
								$listAccessItem .= '<label  class="status-item '.$selectedClass.'" ><input type="checkbox" class="chkSecurityList" value="10" name="chkList'.$rsSecurityObject[$i]['pkey'].'[]" '.$checked.'/>Lihat Semua</label>';
				
				
								$selectedClass = '';
								$checked = '';
							 
								if (!empty($id) && $security->hasSecurityAccess($id,$rsSecurityObject[$i]['pkey'],11)){ 
									$checked = ' checked="checked"';
									$selectedClass = 'bg-green-avocado text-white';	
								} else{
									$unChecked = true;	
								}
								
								
								$listAccessItem .= '<label  class="status-item '.$selectedClass.'" ><input type="checkbox" class="chkSecurityList" value="11" name="chkList'.$rsSecurityObject[$i]['pkey'].'[]" '.$checked.'/>Update</label>';
						}else{
							for ($k=10;$k<=12;$k++){ 
								$selectedClass = '';
								$checked = '';
								
								if (!empty($id) && $security->hasSecurityAccess($id,$rsSecurityObject[$i]['pkey'],$k)){ 
									$checked = ' checked="checked"';
									$selectedClass = 'bg-green-avocado text-white';	
								} else{
									$unChecked = true;	
								}
								
										
								$listAccessItem .= '<label  class="status-item '.$selectedClass.'" ><input type="checkbox" class="chkSecurityList" value="'. $k .'" name="chkList'.$rsSecurityObject[$i]['pkey'].'[]" '.$checked.'/> '. $arrStatusName[$k] .'</label>';
							 }
						
						   $rsStatus = $security->getAllStatus($rsSecurityObject[$i]['modulestatus']);  
							for ($j=0;$j< count($rsStatus);$j++) { 
								$checked = '';
								$selectedClass = '';
								if (!empty($id) &&  $security->hasSecurityAccess($id,$rsSecurityObject[$i]['pkey'],$rsStatus[$j]['pkey'])){
								   $checked = ' checked="checked"';
								   $selectedClass = 'bg-green-avocado text-white';
								}else{
									$unChecked = true;	
								}
								
								$listAccessItem .= '<label class="status-item '.$selectedClass.'" ><input type="checkbox"  class="chkSecurityList"  value="'. $rsStatus[$j]['pkey'].'" name="chkList'.$rsSecurityObject[$i]['pkey'].'[]" '.$checked.'/> '.$rsStatus[$j]['status'].'</label>';
							
							} 
						}
						
					   
						 $checked = '';
						 $selectedClass = '';
						 if ($unChecked == false ){
							  $checked = ' checked="checked"';
							  $selectedClass = 'bg-green-avocado text-white';
						 }
						 	
						 $listSecurityAccess .= '<label class="module-item"><input  type="checkbox"  class="chkModuleName '.$selectedClass.'" name="chkSecurityModuleAccess '. $rsSecurityObject[$i]['pkey'].'" '.$checked.'> '.strtoupper($rsSecurityObject[$i]['modulename']).'</label>';
						 $listSecurityAccess .= $listAccessItem;
						 $listSecurityAccess .= '</li>';
					 
					}
					
					echo $listSecurityAccess;
				 ?>  
                       		 
              </ul>
			 
   </div>  
        
        <div style="clear:both"></div>
        <div class="form-button-panel" > 
       	 <?php echo $obj->generateSaveButton(); ?> 
        </div> 
        
    </form>  
</div> 
</body>

</html>
