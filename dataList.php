<?php    
if(!$security->isAdminLogin($securityObject,10,true)) die;
$arrStatus = $obj->convertForCombobox($obj->getAllStatus(),'pkey','status','- '.$obj->lang['changeStatus'].' -');

// ========================================================================== AJAX SECTION ==========================================================================
if (isset($_POST['generateDataRecords']) && !empty($_POST['generateDataRecords']) ){  
	include ('populateData.php');  
}

// ========================================================================== ADD DATA SECTION ==========================================================================

if (isset($_POST['action']) && !empty($_POST['action']) ){
	include ('dataProcess.php');
}

// ========================================================================== QUICK VIEW SECTION ==========================================================================
if (isset($_POST['generateQuickView']) && !empty($_POST['generateQuickView']) ){
	echo generateQuickView($obj,$_POST['id']);
	die;
}
 
?>

<script>
 	$(document).ready(function() { 
        
	 		tabParam[selectedTab.newPanel[0].id].phpDataListFile = "<?php echo $FILE_NAME; ?>";
	 		tabParam[selectedTab.newPanel[0].id].addDataFile = "<?php echo $addDataFile; ?>"; 
			
			<?php 
			if (!isset($quickView) || $quickView == true)
				echo 'tabParam[selectedTab.newPanel[0].id].quickView = true;';
			else
				echo 'tabParam[selectedTab.newPanel[0].id].quickView = false;';
			?> 
			
			updateData(false);
			 
			//console.dir(selectedTab);  
			
			// assign ID ke div data-list
			// blm tau kepake ap gk selanjutnya.... 
			$("#" + selectedTab.newPanel[0].id + " .data-list").attr("id","data-list-"+selectedTab.newPanel[0].id);   
			
			//refresh button 
			$("#" + selectedTab.newPanel[0].id + "  #btn-refresh").attr("id","btn-refresh-"+selectedTab.newPanel[0].id);   
			$("#btn-refresh-" + selectedTab.newPanel[0].id).bind( "click", function( event ) {    
			 	updateData(false);
			});
			
			//select all button 
			$("#" + selectedTab.newPanel[0].id + " #btn-select-all").attr("id","btn-select-all-"+selectedTab.newPanel[0].id); 
			$("#btn-select-all-"+selectedTab.newPanel[0].id).bind( "click", function( event ) {  
				 selectAllRows();
			});
			
			//deselect all button 
			$("#" + selectedTab.newPanel[0].id + " #btn-deselect-all").attr("id","btn-deselect-all-"+selectedTab.newPanel[0].id); 
			$("#btn-deselect-all-"+selectedTab.newPanel[0].id).bind( "click", function( event ) {   
				  deselectAllRows(); 
			});
			
			//add button 
			$("#" + selectedTab.newPanel[0].id + " #btn-add-new").attr("id","btn-add-new-"+selectedTab.newPanel[0].id); 
			$("#btn-add-new-"+selectedTab.newPanel[0].id).bind( "click", function( event ) {  
				 var title = selectedTab.newTab['context'].text;
				 addTab(phpLang.add + " - " + title ,"<?php echo $addDataFile ;?>?title=" + title + "&fileName=<?php echo $FILE_NAME; ?>&selectedPanelId="+selectedTab.newPanel[0].id); 
			});
			
			//edit button 
			$("#" + selectedTab.newPanel[0].id + " #btn-edit-data").attr("id","btn-edit-data-"+selectedTab.newPanel[0].id); 
			$("#btn-edit-data-"+selectedTab.newPanel[0].id).bind( "click", function( event ) {  
				 openTabForEdit();
            });
			
			//delete button 
			$("#" + selectedTab.newPanel[0].id + " #btn-delete").attr("id","btn-delete-"+selectedTab.newPanel[0].id); 
			$("#btn-delete-"+selectedTab.newPanel[0].id ).bind( "click", function( event ) {  
			 	 deleteData();
			});
			
			//change status
			$("#" + selectedTab.newPanel[0].id + " [name=selStatus]").attr("name","selStatus-"+selectedTab.newPanel[0].id);   
			$("[name=selStatus-"+selectedTab.newPanel[0].id+"]").bind( "change", function( event ) {  
				var statusName = $("[name=selStatus-"+selectedTab.newPanel[0].id+"]").find("option:selected").text().toUpperCase();
				var statusKey = $("[name=selStatus-"+selectedTab.newPanel[0].id+"]").find("option:selected").val();
				changeStatus(statusKey,statusName);
			});
		 
			//paging
			$("#" + selectedTab.newPanel[0].id + " [name=selPage]").attr("name","selPage-"+selectedTab.newPanel[0].id);   
			$("[name=selPage-"+selectedTab.newPanel[0].id +"]").bind( "change", function( event ) {   
				 updateData(false);
			}); 
			
			//quick search
			$("#" + selectedTab.newPanel[0].id + " [name=quick-search]").attr("name","quick-search-"+selectedTab.newPanel[0].id); 
        /*
			$("#" + selectedTab.newPanel[0].id + " [name=btn-quick-search]").attr("name","btn-quick-search-"+selectedTab.newPanel[0].id); 
			$("[name=btn-quick-search-"+selectedTab.newPanel[0].id+ "]").bind( "click", function( event ) {    
				$("[name=selPage-"+selectedTab.newPanel[0].id +"] option:first").attr('selected','selected');
			 	updateData(false);
			});
		*/
        
			//sortcolumn
			$("#" + selectedTab.newPanel[0].id + " .sortable").bind( "click", function( event ) {  
			
				var ordertype = $(this).attr("reltype");
				
				tabParam[selectedTab.newPanel[0].id].orderby = $(this).attr("relcol");
				tabParam[selectedTab.newPanel[0].id].ordertype = ordertype;
				
				$("#" + selectedTab.newPanel[0].id + " .sortable").removeClass("sortable-active");
				$("#" + selectedTab.newPanel[0].id + " .sortable .order-type").removeClass("arrow-up").removeClass("arrow-down").hide();

				$(this).addClass("sortable-active");
				
				if (ordertype == 1)
					$(this).find(".order-type:first").addClass("arrow-down").show();
				else
					$(this).find(".order-type:first").addClass("arrow-up").show();
				 
				
				$(this).attr("reltype",ordertype * -1); 
				 
				updateData(false);
			});
			
			
	  		 
	}); 
</script>
 
<div>   
    
    <div style="clear:both;"></div>
    <div class="action-bar" >
    	<div style="float:left;" >
       	 
       <?php 
		 	 $actionClass = 'btn-action';
			 $idAdd = 'btn-add-new';
			 $idEdit = 'btn-edit-data';
		 	 if(!$security->isAdminLogin($obj->securityObject,11,false)){
				 $actionClass = 'btn-action-disabled';
				 $idAdd = '';
                 $idEdit = '';
			 }
			 
			 echo '<div id="'.$idAdd.'" class="'.$actionClass.' minerva-icon-20 add-data-icon"></div>';
			 echo '<div id="'.$idEdit.'" class="'.$actionClass.' minerva-icon-20 edit-data-icon"></div>';
		?> 
               
        <?php 
		 	 $actionClass = 'btn-action';
			 $id = 'btn-delete';
		 	 if(!$security->isAdminLogin($obj->securityObject,12,false)){
				 $actionClass = 'btn-action-disabled';
				 $id = '';
			 }
			 
			 echo '<div id="'.$id.'" class="'.$actionClass.' minerva-icon-20 delete-data-icon" ></div>';
		?> 
               
       	 
       	 <div id="btn-refresh" class="btn-action minerva-icon-20 refresh-data-icon"></div> 
       	 <div id="btn-select-all" class="btn-action minerva-icon-20 select-all-data-icon" style="margin-left:1em;"></div> 
       	 <div id="btn-deselect-all" class="btn-action minerva-icon-20 deselect-all-data-icon"></div> 
          
         <div style="float:left; margin-left:1em; margin-top:0.3em;"><?php echo  $obj->inputSelect('selStatus', $arrStatus,true,'',' style="height:2em; padding:0em 0.5em;"'); ?></div>
      
      	 <div style="float:left; margin:0.7em 1em 0em 2em;  "><?php echo $obj->lang['page']; ?></div>
         <div style="float:left; margin-top:0.3em;"><?php echo  $obj->inputSelect('selPage', array(),true,'',' style="height:2em; padding:0em 0.5em;"'); ?></div>
      
      </div> 
    	<div style="float:right;  margin-bottom:0.5em">
			<?php echo $class->input('text','quick-search', true, '', 'placeholder="'.$obj->lang['search'].'" style="width:20em"','quick-search-text-box') ; ?><!-- <div class="btn-action minerva-icon-20 search-data-icon" name="btn-quick-search" style="float:right; position:relative; top:-0.3em;"></div>-->
        </div>
   		<div style="clear:both;"></div>
    </div>
    
	<div class="table-data-list" >
		<div class="div-table-row">   
		  <div class="div-table-col-5 col-header"  style="text-align:right; width:30px;">#</div> 
			<?php	  
            for($j=0;$j<count($arrColumn);$j++){  
				$alignment = 'left';
				if (isset($arrColumn[$j][4]) && !empty($arrColumn[$j][4]))
					$alignment = $arrColumn[$j][4];
                echo '<div style="text-align:'.$alignment.';  width:'.$arrColumn[$j][2].'px; " class="div-table-col-5 col-header sortable" relcol="'.$arrColumn[$j][1].'" reltype="-1">'.$arrColumn[$j][0].'<div class="order-type"></div></div>';
            }
            ?>	  
            
 	  	</div>
     </div>  
    <div class="data-list"></div>
</div>