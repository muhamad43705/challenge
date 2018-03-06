var LOADING_STYLE = "<div class=\"loading-icon\"></div>"; 

var selectedTab; // berguna untuk mengetahui tab yg sedang aktif. digunakan jg sebagai patokan fungsi QuickView 
var $tabs;
var tabParam = {};
var uploadedImage = {}; 
var uploadedFile = {};   
var objAndValueForDetailAutoComplete = {};   
 	
jQuery(document).ready(function(){ 
    
 	   $(".menu-child").click(function(){   
			var reladdr = $(this).attr("reladdr");
			var reltarget = $(this).attr("reltarget");
			 
			if (reltarget == '_blank'){ 
					var win=window.open(reladdr, reltarget);
					win.focus();  
			}else {    
					addTab($(this).text(),reladdr);  
			}  
		}); 
		
			
		$(".menu-parent").click(function(){   
			 collapseAllMenu();	  
			 $(this).removeClass('inactive').addClass('active');
			 $(this).next('ul').show(500);   
		});
		
		$(".menu-setting").click(function(){   
			 	addTab($(this).text(),$(this).attr("reladdr")); 
		});
		
			
		collapseAllMenu();	  
			
		 $tabs = $("#tabs").tabs({
		  activate: function(event, ui){
		 	//	console.dir(ui); 
				selectedTab = ui;  
				updateStatusPanel();  
                if (getSelectedTabIndex() == 0) 
                  $(".refresh-graph").click();  
                
		  },
		  beforeLoad: function( event, ui ) {
				if ( ui.tab.data( "loaded" ) ) {
					event.preventDefault();
					return;
				}
		 
				ui.jqXHR.success(function() {
					ui.tab.data( "loaded", true );
				});
		 }
			
		}); 
	 
		
		var $tabsMenu = $("#tabs-menu").tabs({
		  activate: function(event, ui){
		 		var newp = ui.newPanel.hide().attr('id'),
				oldp = ui.oldPanel.attr('id');
				$('#' + oldp).fadeOut(500);
				$('#' + newp).fadeIn(500);	
		  }, 
		});  
		
		addTab('Profile','profile',false); 
		
			
		$tabs.delegate("span.ui-icon-close","click",function(){
			 var panelID = $(this).closest("li").remove().attr("aria-controls");
			 $("#" + panelID).remove();  
			 $tabs.tabs("refresh");   
		});
		
	

		$(document).keyup(function (e){
			
			 try{	
					switch(e.keyCode || e.which) {
						
						case 46:  $("#btn-delete-"+selectedTab.newPanel[0].id).click();
								  e.preventDefault();	
								  break;
								  
						case 13: if ($("[name=quick-search-" + selectedTab.newPanel[0].id + "]").is(":focus")) {
										//$("[name=btn-quick-search-" + selectedTab.newPanel[0].id +"]").click();
                                        $("[name=selPage-"+selectedTab.newPanel[0].id +"] option:first").attr('selected','selected');
                                        updateData(false);
								  }
								  e.preventDefault();	
								  break;
						case 113: $("#btn-add-new-"+selectedTab.newPanel[0].id).click();
								  e.preventDefault();	
								  break;
						case 114: $("[name=quick-search-" + selectedTab.newPanel[0].id +"]").select();
								  e.preventDefault();	
								  break;
						case 115: toggleAllSelectedDataDetail();   
								  e.preventDefault();	
								  break;
						case 116:
								 $("#btn-refresh-" + selectedTab.newPanel[0].id).click();
								 e.preventDefault();	
								 break;
						default:
							break; 
					}
			 } catch (err){
				 
			 }
				 
		});
		
		
		$('body').scrollToTop({
			distance: 200,
			speed: 1000,
			easing: 'linear',
			animation: 'fade', // fade, slide, none
			animationSpeed: 500,
			  
			trigger: null, // Set a custom triggering element. Can be an HTML string or jQuery object
			target: null, // Set a custom target element for <a href="http://www.jqueryscript.net/tags.php?/Scroll/">scrolling</a> to. Can be element or number
			text: '<div class="back-to-top"></div>', // Text for element, can contain HTML
			 
			skin: null,
			throttle: 250,
			 
			namespace: 'scrollToTop'
		});  
		
		
		$( "#popupads .closebutton" ).on( "click", function() {
				hideOverlayScreen()
		});  
    
});  
	 
function getSelectedTabIndex() { 
    return $("#tabs").tabs('option', 'active');
}

function findTabIndexByTitle(title){
	 var num_tabs = 0;
	 var foundNeedle = false;
	 	
	 $('#tabs ul li a').each(function(i) {    
			  if (this.text.localeCompare(title) == 0) {   
			  		 foundNeedle = true;  
					 return false;                                                                              
			  }
			  num_tabs++;
	  });
	   
	  if (foundNeedle)
	  	return num_tabs;
	  else 
	   return -1;
}

// actual addTab function: adds new tab using the title input from the form above
function addTab(title,href,hasCloseButton) {  
	
	//cek dulu sudah ad blm tabnya, kalo sudah ad select aj 
	 tabNameExists = false;
 	 var num_tabs = 0; 
	  
	 num_tabs = findTabIndexByTitle(title); 
	 
	 if(num_tabs != -1 ){ 
		  $tabs.tabs( "option", "active", num_tabs );  
	 } else {
		
        var closeButton = "";
        if (hasCloseButton == undefined || hasCloseButton == true)
            closeButton = "<span class=\"ui-icon ui-icon-close\" role\"presentation\">"+phpLang.close+"</span>";
         
		$( "<li><a href='" + href + "'>" + title + "</a>" + closeButton + "</li>" ).appendTo( "#tabs .ui-tabs-nav" );
	 	$tabs.tabs( "refresh" );   
		$tabs.tabs( "option", "active",  $("#tabs ul:first li").length -1 );
		 
		tabParam[selectedTab.newPanel[0].id] = { phpDataListFile:"",addDataFile:"", selectedPkey: [],quickView:[], lastRowIndex : 0, statusInformation:[], tagInformation:[], selectedCriteriaStatusKey:[], selectedCriteriaTagKey:[],orderby:"",ordertype:""};  
	  
	  }
 
}   

function openTabForEdit(){  
	 selectedPkey = tabParam[selectedTab.newPanel[0].id].selectedPkey;
	   
    if (selectedPkey.length == 0){
		showMsgDialog ("Anda belum memilih data yang hendak dihapus.");
		return ;
	} 
    
	dataPkey = 	selectedPkey[0];
	
	var title = selectedTab.newTab['context'].text;
	var selectedTabId = selectedTab.newPanel[0].id; 
	var phpDataListFile = tabParam[selectedTabId].phpDataListFile; 
	var addDataFile = tabParam[selectedTabId].addDataFile; 
	
	addTab(phpLang.edit + " - " + title ,addDataFile + "?title=" + title + "&id=" + dataPkey + "&fileName=" + phpDataListFile + "&selectedPanelId="+selectedTabId);  
}

 

function bindAutoCompleteForTransactionDetail(targetObj,objAndValue,searchFile,onChangeFunction){ 
 
	var objTarget = $( "#" + selectedTab.newPanel[0].id + " [name='" + targetObj +"']" );
	 
	objTarget.autocomplete({
	  source: searchFile,
	  minLength: 1,
	  select: function( event, ui ) {      
	   
			if (onChangeFunction != undefined && onChangeFunction != ""){
				eval(onChangeFunction+"(this,objAndValue,ui)");
			}else{
				for(i=0;i<objAndValue.length;i++){  
					$(this).closest(".div-table-row").find("[name='" + objAndValue[i].object +"']").first().val(ui.item[objAndValue[i].value]).change().blur();  
				}
			}
			
		},  
	  search: function( event, ui ) { 	
	  			/*for(i=0;i<objAndValue.length;i++){
	  				$(this).closest(".div-table-row").find("[name='" + objAndValue[i].object +"']").first().val("").blur(); 
				}*/
	  },
	  change: function( event, ui ) { 
			if (ui.item == null) {
				$(this).val("");   
				for(i=0;i<objAndValue.length;i++){
					$(this).closest(".div-table-row").find("[name='" + objAndValue[i].object +"']").first().val("").blur();
				}
			}  
		},
	});
}

function clearAutoCompleteInput(obj,hidKeyName){   
	$(obj).val("");    
	$(obj).closest('form').find("[name="+hidKeyName+"]").first().val(""); 
	$(obj).closest('form').bootstrapValidator('revalidateField', $(obj).attr("name"));
}

function updateStatusPanel(){ 
	$("#left-status-panel").html("");
 	  
	if (tabParam[selectedTab.newPanel[0].id] == undefined ||tabParam[selectedTab.newPanel[0].id].phpDataListFile == "" ){ 
		return;	
	} 
	
	//console.dir(tabParam[selectedTab.newPanel[0].id]);
	 
	var statusInformation = tabParam[selectedTab.newPanel[0].id].statusInformation;  
 	var statusHTML = ''; 
	var totalStatus = 0;
	
	statusHTML += '<div id="status-filter"  class="div-table-status-information" ><div class="div-table-caption">' + phpLang.status.toUpperCase () + '</div>';
	for(i=0;i<statusInformation.length;i++){
		statusHTML +=  '<div class="div-table-row" >'; 
		
		var checked = '';
		var selectedClass ='';
       
		if(jQuery.inArray( statusInformation[i].statusPkey , tabParam[selectedTab.newPanel[0].id].selectedCriteriaStatusKey ) >= 0){
			checked = 'checked="checked"';
			selectedClass = "bg-blue-steel text-white";
		}

		statusHTML +=  '<div class="div-table-col div-table-col-header" ><label class="'+selectedClass+'"><input  type="checkbox" ' + checked + ' class="chk-status-filter" value="' + statusInformation[i].statusPkey + '" >' + statusInformation[i].statusName + '<div class="total-status bg-blue-steel">' + statusInformation[i].totalData + '</div></label></div>';
		statusHTML +=  '</div>';
		totalStatus += parseInt(statusInformation[i].totalData) ;
	}  
	statusHTML +=  '</div>';
	
	var totalStatusLabel = '<div class="div-table-status-information" style="margin-bottom:1em; font-weight:bold;" ><div class="div-table-row " ><div class="div-table-col" style="color:#333; " >' + phpLang.totalData.toUpperCase () + '<div class="total-status" style="color:#333;" >' + totalStatus + '</div></div></div></div>';
	statusHTML = totalStatusLabel + statusHTML; 
	$("#left-status-panel").append(statusHTML);
	 
	
	var tagInformation = tabParam[selectedTab.newPanel[0].id].tagInformation; 
	var tagHTML = '';
	
	tagHTML +=  '<div id="tag-filter" class="div-table-status-information" style="margin-top:2em;" ><div class="div-table-caption">' + phpLang.tag.toUpperCase () + '</div>';
	for(i=0;i<tagInformation.length;i++){
		tagHTML +=  '<div class="div-table-row" >'; 
		
		var checked = '';
		var selectedClass ='';
		var selectedStyle ='';
		if(jQuery.inArray( tagInformation[i].tagPkey , tabParam[selectedTab.newPanel[0].id].selectedCriteriaTagKey ) >= 0){
			checked = 'checked="checked"'; 
			selectedClass = "text-white";
			selectedStyle = 'background-color:' + tagInformation[i].hexColor;
		}
		  
		tagHTML +=  '<div class="div-table-col div-table-col-header" ><label class="'+selectedClass+'" style="'+selectedStyle+'"><input  type="checkbox" ' + checked + ' class="chk-status-filter" value="' + tagInformation[i].tagPkey + '" >' + tagInformation[i].tagName + '<div class="total-status" style="background-color:' + tagInformation[i].hexColor + '">' + tagInformation[i].totalData + '</div></label></div>';
		tagHTML +=  '</div>'; 
	}  
	
 	tagHTML +=  '</div>'; 
	
	$("#left-status-panel").append(tagHTML); 
	

	 $("#status-filter .chk-status-filter").click(function() {    
	 
		    var selectedCriteriaStatusKey = Array(); 
			$(this).closest(".div-table-status-information").find("input").each(function() {  
				 if ($(this).prop("checked") == true)
				 	selectedCriteriaStatusKey.push($(this).val());
			});
			 
			tabParam[selectedTab.newPanel[0].id].selectedCriteriaStatusKey = selectedCriteriaStatusKey;
			updateData(false);
	});
 
	 $("#tag-filter .chk-status-filter").click(function() {   
	  
		    var selectedCriteriaTagKey = Array(); 
			$(this).closest(".div-table-status-information").find("input").each(function() {  
				 if ($(this).prop("checked") == true)
				 	selectedCriteriaTagKey.push($(this).val());
			});
			 
			tabParam[selectedTab.newPanel[0].id].selectedCriteriaTagKey = selectedCriteriaTagKey;
			updateData(false);
	}); 
}

function unformatCurrency(value){ 
	if (value == undefined)
		return 0;
		
	return value.replace(/,/g,"");
}	  	
		
function collapseAllMenu(){
	$("#menu ul li").each(function(index) {  
	   $(this).removeClass('active').addClass('inactive');
	}); 
	
	$(".submenu").each(function(index) {  
	   $(this).hide();
	}); 
}

function selectAllRows(){  

	$("#" + selectedTab.newPanel[0].id + " .selectable li").addClass("ui-selected"); 
	var selectedPkey = Array();
	$( ".ui-selected", "#" + selectedTab.newPanel[0].id + " .selectable" ).each(function() {  
		 selectedPkey.push($(this).attr("relId"));
	});
	 
	tabParam[selectedTab.newPanel[0].id].selectedPkey = selectedPkey;   
}

function deselectAllRows(){
	$("#" + selectedTab.newPanel[0].id + " .selectable li").removeClass("ui-selected");  
	tabParam[selectedTab.newPanel[0].id].selectedPkey = Array();  	
}
  
function selectRow(obj){ 
	obj.addClass("ui-selected");  
	
	var selectedPkey = Array(); 
	selectedPkey.push(obj.attr("relId"));
  
	tabParam[selectedTab.newPanel[0].id].selectedPkey = selectedPkey;   
}

function toggleAllSelectedDataDetail(state){ 	  
	 selectedPkey =  tabParam[selectedTab.newPanel[0].id].selectedPkey;
	 var target =  $("#" + selectedTab.newPanel[0].id + " .data-list ol .data-record");
	 
	 if (selectedPkey.length == 0){ 
	 	// jika tidak ad data yg diselect, tutup dulu semua quick view yg terbuka
	 	var showAll = true; 
		
		 target.find(".table-data-record-detail:visible").each(function(i) { 
	 			showAll = false;
				toggleQuickView($(this).closest(".data-record"),state);
		 }); 
		  
		 if(showAll){
			  target.each(function(i) { 
				toggleQuickView($(this),state);
			  }); 
		 }
	 }else{
		 // toggle hanya data yg diselect	
		 target.each(function(i) { 
				 if(jQuery.inArray( $(this).attr("relId"),selectedPkey ) >= 0){ 
					  toggleQuickView($(this),state);
				 }  
		 }); 	
		 
	 } 
}

function toggleQuickView(obj,state){ 
	if (tabParam[selectedTab.newPanel[0].id].quickView == false)
		return;
		
	var id = obj.attr("relId") ;    
	
	phpDataListFile = tabParam[selectedTab.newPanel[0].id].phpDataListFile;  
	
	var targetContent = $("#" + selectedTab.newPanel[0].id + " .table-data-record-detail" + id);  
	var isVisible = targetContent.is( ":visible" );
	  
	if (isVisible){ 
		if (state == undefined || state == 1) 
			targetContent.slideToggle();
	}else{   
		if (state == undefined || state == 2) {
			$.ajax({
				type: "POST",
				url:  phpDataListFile,
				data: "generateQuickView=1&id=" + id ,  
				success: function(data){ 
						 targetContent.html(data);
				} 
			}).done(function( data ) {   
					if (data != "")
						targetContent.slideToggle();
			});
		} 
	}  	 
}
	   

function updateData(loadMoreTriggered, selectedTabId ){    
	 var quickSearch = ""; 
	     
	  if (selectedTabId == undefined){
   		 selectedTabId = selectedTab.newPanel[0].id; 
	  }
	  
	  phpDataListFile = tabParam[selectedTabId].phpDataListFile;
	  targetContent = $("#" + selectedTabId + " .data-list");
	  
	    
	  if (!loadMoreTriggered){ 
		targetContent.html(LOADING_STYLE);			 
	  }else{ 
		targetContent.find(".load-more:first").find(".loading-icon:first").show(); 
	  }
	   
		//adding quick search value 
		if ( $("[name=quick-search-" + selectedTabId+"]").val() != undefined)
			 quickSearch = $("[name=quick-search-" + selectedTabId+"]").val(); 
	 
		 	
	   $.ajax({
				type: "POST",
				url:  phpDataListFile,
		 		data: {generateDataRecords:1,
						quickSearchKey : quickSearch,
						page : $("[name=selPage-" + selectedTabId+"]").val(),
						loadMoreTriggered : loadMoreTriggered,
						lastRowIndex : tabParam[selectedTabId].lastRowIndex,
						selectedCriteriaStatusKey :  tabParam[selectedTabId].selectedCriteriaStatusKey,
						selectedCriteriaTagKey :  tabParam[selectedTabId].selectedCriteriaTagKey,
						orderby :  tabParam[selectedTab.newPanel[0].id].orderby,
						ordertype :  tabParam[selectedTab.newPanel[0].id].ordertype
					   } ,
				success: function(data){  
				 	     var temp = JSON.parse(data); 
						 
						 tabParam[selectedTabId].statusInformation = temp.statusInformation;  
						 tabParam[selectedTabId].tagInformation = temp.tagInformation;   
						 tabParam[selectedTabId].contextMenu = temp.contextMenu;  
						 tabParam[selectedTabId].contextMenuCallback = temp.contextMenuCallback;   
						 
						 if ( !loadMoreTriggered )  {   
						  	targetContent.html(temp.dataList); 
						 }else{ 
							 var pageIndex = Math.ceil(tabParam[selectedTabId].lastRowIndex / phpConfiguration.adminTotalRowsPerPage);
							 
							targetContent.find(".data-list-row:first").append("<div class=\"page-break\">Page " + (pageIndex + 1) + "</div><div style=\"clear:both;\"></div>");
						 	targetContent.find(".data-list-row:first").append(temp.dataList);
						 }
						  
						 if (temp.eof)
								targetContent.find(".load-more:first").hide();
						 else
								targetContent.find(".load-more:first").show();
						 
						 var loadMoreObj = targetContent.find(".load-more:first");
						 loadMoreObj.find(".loading-icon:first").hide(); 
						 loadMoreObj.click(function() {  
								$(this).unbind("click");  
								updateData(true)
						  }); 
			  			
					     tabParam[selectedTabId].lastRowIndex =  temp.lastRowIndex; 
						   
						 rebuildPaging($("[name=selPage-" + selectedTabId +"]"),temp.totalPages,temp.selectedPageIndex);
						
						 
						 updateStatusPanel();
						 updateRightClick(); 
						 deselectAllRows();
				} 
		});    
}

function updateRightClick(){  
	 var contextItem = tabParam[selectedTab.newPanel[0].id].contextMenu;  
	 var contextMenu =  $.contextMenu({
							selector: '#' + selectedTab.newPanel[0].id + ' .data-record',  
							events: {
								show: function(opt){ 
									  var selectedPkey = tabParam[selectedTab.newPanel[0].id].selectedPkey;   
									  if (selectedPkey.length <= 1){ 
											deselectAllRows(); 
											selectRow($(this).closest(".data-record")); 
									  }
								}
							 },  
							 
							callback: function(key, options) { eval(tabParam[selectedTab.newPanel[0].id].contextMenuCallback) }, 
							items: contextItem,  	
						}); 	 
	 				 
}
 
function deleteData(){ 
	var selectedTabId = selectedTab.newPanel[0].id;   
	var phpDataListFile = tabParam[selectedTabId].phpDataListFile;
	var targetContent = $("#" + selectedTabId + " .data-list"); 
	var selectedPkey = tabParam[selectedTabId].selectedPkey;
	
	if (  selectedPkey.length == 0){
		showMsgDialog ("Anda belum memilih data yang hendak dihapus.");
		return ;
	} 
	
	$( "#dialog-message" ).html("Anda yakin akan menghapus data ini ?");
	$( "#dialog-message" ).dialog({
	  width: 300,
	  modal: true,
	  title:"Konfirmasi Hapus Data", 
	  open: function() {
		  $(this).closest('.ui-dialog').find('.ui-dialog-buttonpane button:last').focus();
	  },
        
      close:function() {}, 
        
	  buttons : {
		  OK : function (){
					 $.ajax({
						type: "POST",
						url:  phpDataListFile,
						data: {action:"delete",
								selectedPkey:selectedPkey
							  }, 
					}).done(function( data ) { 
					 
						var errorMsg = parseError(data);   
						
						if (errorMsg.valid == false && errorMsg.errorMsg != '')
							showMsgDialog(errorMsg.errorMsg,"Hapus Data Gagal"); 
						 
						// tetep di refresh karena beberapa data mungkin berhasil dihapus.
						updateData(false);
						
					});    
				 	
					$( this ).dialog( "close" );
		  },
		  Cancel : function (){ 
		  	$( this ).dialog( "close" );
		  }
	  },
	});
	
	  
}

function changeStatus(statusKey,statusName){ 
	var selectedTabId = selectedTab.newPanel[0].id;    
	var selectedPkey = tabParam[selectedTabId].selectedPkey; 
	
	 
	if (selectedPkey.length == 0){
		showMsgDialog ("Anda belum memilih data yang hendak diubah statusnya.");
		 $("[name=selStatus-"+selectedTab.newPanel[0].id+"]").val(0); 	 
		return ;
	}
	  
	$( "#dialog-message" ).html("Anda yakin akan mengubah status data ini menjadi " + statusName + " ?");
	$( "#dialog-message" ).dialog({
	  width: 300,
	  modal: true,
	  title:"Konfirmasi Perubahan Status",  
	});
	
	var buttons = new Array();
	buttons.push({
					 text: "OK", 
					 id: 'OK', 
					 click:  function() {
										chageStatusData(statusKey,selectedPkey,0);
										$( this ).dialog( "close" );
							 }
					});
	
	if (statusKey == 4){
		buttons.push({
					 text: "OK & Copy", 
					 id: 'OKCopy', 
					 click:  function() {
										chageStatusData(statusKey,selectedPkey,true);
										$( this ).dialog( "close" );
							 }
					});
	}
	 				
	buttons.push({
					 text: "Cancel", 
					 id: 'Cancel', 
					 click:  function() {
										 $( this ).dialog( "close" );
							 }
					} 
					
				); 
	
	
	$('#dialog-message').dialog('option', 'buttons', buttons); 
    $('#dialog-message').closest('.ui-dialog').find('.ui-dialog-buttonpane button:last').focus(); 
	

	 $("[name=selStatus-"+selectedTab.newPanel[0].id+"]").val(0); 	 
}

function chageStatusData(statusKey,selectedPkey,copyData){
	
	var selectedTabId = selectedTab.newPanel[0].id;   
	var phpDataListFile = tabParam[selectedTabId].phpDataListFile;
	 
	$.ajax({
		type: "POST",
		url:  phpDataListFile,
		data:{action:"changestatus",
				newStatus:statusKey,
				selectedPkey:selectedPkey ,
				copyData:copyData 
			},
	}).done(function( data ) { 
		var errorMsg = parseError(data);   
		
		if (errorMsg.valid == false && errorMsg.errorMsg != '')
			showMsgDialog(errorMsg.errorMsg,"Perubahan Status Gagal"); 
		 
		// tetep di refresh karena beberapa data mungkin berhasil diubah statusnya.
		updateData(false);  
	});  
}

function changeTag(tagKey,statusName){ 
	var selectedTabId = selectedTab.newPanel[0].id;   
	var phpDataListFile = tabParam[selectedTabId].phpDataListFile;
	var selectedPkey = tabParam[selectedTabId].selectedPkey; 
	
	if (selectedPkey.length == 0){
		showMsgDialog ("Anda belum memilih data yang hendak diubah tag nya."); 
		return ;
	}
	 
	var msg =  "Anda yakin akan mengubah tag data ini menjadi " + statusName + " ?";
	if (tagKey == 0)
		msg = "Anda yakin akan menghilangkan tag data ini ?";
		
		
	$( "#dialog-message" ).html(msg);
	$( "#dialog-message" ).dialog({
	  width: 300,
	  modal: true,
	  title:"Konfirmasi Update Tag", 
	  open: function() {
		  $(this).closest('.ui-dialog').find('.ui-dialog-buttonpane button:last').focus();
	  },
	  buttons : {
		  OK : function (){
					 $.ajax({
						type: "POST",
						url:  phpDataListFile,
						data:{action:"changetag",
							newTag:tagKey,
							selectedPkey:selectedPkey
						},
					}).done(function( data ) {
						
						var errorMsg = parseError(data);   
						
						if (errorMsg.valid == false && errorMsg.errorMsg != '')
							showMsgDialog(errorMsg.errorMsg,"Penambahan Tag Data Gagal"); 
						 
						 
						// tetep di refresh karena beberapa data mungkin berhasil diubah statusnya.
						updateData(false);
						
					});  
				 	
					$( this ).dialog( "close" );
		  },
		  Cancel : function (){ 
		  	$( this ).dialog( "close" );
		  }
	  },
	}); 
		 
}

function parseError(data){  

 	var errorArr = JSON.parse(data); 
	
	var error = "";
	var status = true;
	for (i=0;i<errorArr.length;i++){ 
		   // nanti harus diupdate bisa pisah antara warning, error atau success
			status = errorArr[i].valid;
			error = error + "<li>" + errorArr[i].message + "</li>"; 
	}
	
	if (error != "")
		error = "<ul class=\"message-dialog-ul\">" + error + "</ul>";
	
	var returnArr = {};
	returnArr.valid = status; 
	returnArr.errorMsg = error;
	
	return returnArr;
}
 

function showMsgDialog(msg,title){
	if (title == undefined)
		title = "Informasi";
		
	$( "#dialog-message" ).html(msg);
	$( "#dialog-message" ).dialog({
	  width: 600,
	  modal: true,
	  title:title, 
	  buttons:{ 'OK' : function() { $( this ).dialog( "close" );} } 
	});
}
 

function rebuildPaging(objectname,totalPages,selectedPageIndex){  
	objectname.html("");
	if (totalPages == 0){
		var newOption = $('<option value="0">0 / 0</option>');
		objectname.append(newOption);
	} else{
		for(i=0;i<totalPages;i++){
			var selected = "";
			if (selectedPageIndex == i)
				selected = "selected=\"selected\"";
				
			var newOption = $('<option value="'+i+'" '+ selected + '>'+(i+1)+' / ' + totalPages + '</option>');
			objectname.append(newOption);
		} 
	} 
} 

function submitForm(e, parentPanelId, parentTitle){ 
    
    // Prevent form submission
    e.preventDefault();
    
    // Get the form instance
     var $form = $(e.target);

     var btnSave = $form.find("[name=btnSave]");
     var btnSaveEmail = $form.find("[name=btnSaveEmail]"); 
 
     btnSave.prop('disabled', true);
     btnSave.find(".loading-icon").show();
     btnSaveEmail.prop('disabled', true); 

    // Get the BootstrapValidator instance
    var bv = $form.data('bootstrapValidator');
    
    // Use Ajax to submit form data
    $.post($form.attr('action'), $form.serialize(), function(result) {
        onFormSubmitDone($form,result,parentPanelId,parentTitle);   
    }, 'json');
}


function onFormSubmitDone(form,result,parentPanelId ,parentTitle){  
 
    
		var error = ""; 
		for (i=0;i<result.length;i++)    
			error = error + "<li>" + result[i].message + "</li>";  
		
		if (error != "")
			error = "<ul class=\"message-dialog-ul\">" + error + "</ul>";  
			 
		$("#" + selectedTab.newPanel[0].id + " .notification-msg").html(error).hide().fadeToggle("fast");
			
		if (!result[0].valid){ 
			$("#" + selectedTab.newPanel[0].id + " .notification-msg").removeClass("bg-green-avocado").addClass("bg-red-cardinal"); 
			form.data('bootstrapValidator').resetForm();
			$('body').scrollTop(0);
			//$("#" + selectedTab.newPanel[0].id ).closest('form').bootstrapValidator('revalidateField');
				
		}else{
			$("#" + selectedTab.newPanel[0].id + " .notification-msg").removeClass("bg-red-cardinal").addClass("bg-green-avocado");  
			
			selectedTab.newTab[0].remove();
			$tabs.tabs("refresh");   
			  
			updateData(false,  parentPanelId ); 
			
			var num_tabs = findTabIndexByTitle(parentTitle); 
			$tabs.tabs( "option", "active", num_tabs );  
		}  
    
        var btnSave = form.find("[name=btnSave]");  
        btnSave.find(".loading-icon").hide();
 
}
 
 
// FILE UPLOADER HANDLER */  

function deleteImageUploaderThumb(obj,fileUploaderTarget,token){
	$(obj).closest("li").remove(); 
	updateItemImageArray(fileUploaderTarget,token); 
} 


function deleteFileUploaderThumb(obj,fileUploaderTarget,token){
	$(obj).closest("li").remove(); 
	updateItemFileArray(fileUploaderTarget,token); 
} 

function pushImageThumb(fileUploaderTarget,fileInfo,multipleFile,multipleColor,variantTarget){ 
     
	var target = $("#defaultForm-"+selectedTab.newPanel[0].id+ " ." + fileUploaderTarget); 
	var iconMultipleColor = '';
	 
	if (multipleFile == false){ 
		target.find(".image-list").html(""); 
	}
	 
	if (multipleColor == true){ 
//		iconMultipleColor =  "<div class=\"product-variant-icon-small minerva-icon-15\" style=\"float:right; margin-right:0.5em\" onClick=\" loadImageVariant('"+fileUploaderTarget+"',this, {'folder':'" +fileInfo.folder+ "', 'token':'" +fileInfo.token+ "', 'fileName':'" +fileInfo.fileName+ "','phpThumbHash':'" +fileInfo.phpThumbHash+ "'} ,'"+variantTarget+"')\" ></div>";
	} 
	 
	var extension = fileInfo.fileName.substr( (fileInfo.fileName.lastIndexOf('.') +1) );
	fileurl = "../phpthumb/phpThumb.php?src="+phpConfiguration.uploadTempDoc+ fileInfo.folder + fileInfo.token+ "/"+fileInfo.fileName+"&w=150&h=150&far=C&hash=" + fileInfo.phpThumbHash;
	
	if (extension == 'ico')
		fileurl = phpConfiguration.uploadTempURL + fileInfo.folder + fileInfo.token+ "/"+fileInfo.fileName;
	  
	 
 	var temp = "<li relfilename=\""+fileInfo.fileName+"\" relPHPThumbHash=\""+fileInfo.phpThumbHash+"\">";
	temp += "<div class=\"file-uploader-image\"><img src=\""+ fileurl +"\"/></div>";
	temp += "<div class=\"file-uploader-action-bar\">";
	temp += "<div class=\"delete-icon-small minerva-icon-15\" style=\"float:right;\" onClick=\"deleteImageUploaderThumb(this,'" + fileUploaderTarget  + "','" + fileInfo.token  + "')\"></div>";
	temp += iconMultipleColor;
	temp += "</div>";
	temp += "</li>"; 
	
	target.find(".image-list").append(temp);	
	   
	updateItemImageArray(fileUploaderTarget,fileInfo.token);
	  
	target.find('.image-list li:last img').load(function(){ 
	  $(this).closest(".file-uploader-image").css("background-image","none"); 
	}); 
 
			
}

function updateItemImageArray(fileUploaderTarget,token){
	
	 var selectedTabId = selectedTab.newPanel[0].id
	 var target = $("#defaultForm-"+selectedTabId+ " ." + fileUploaderTarget);  
	 
	 uploadedImage[token+selectedTabId] = Array();
	 $("#defaultForm-"+selectedTab.newPanel[0].id+ " ." +fileUploaderTarget + " .image-list li").each(function(i) {     
			 uploadedImage[token+selectedTabId].push($(this).attr("relfilename"));
	  });
	   
	 target.find("[name=" + fileUploaderTarget + "]").val(uploadedImage[token+selectedTabId]);
	 
}
 

function createImageUploader(fileUploaderTarget,fileInfo,multipleFile,multipleColor,variantTarget){ 
     
	var selectedTabId = selectedTab.newPanel[0].id
	var target = $("#defaultForm-"+selectedTabId+ " ." + fileUploaderTarget);
	  
	 if (fileInfo.token == undefined || fileInfo.token == "")  
		 fileInfo.token = Math.floor((Math.random() * 1000) + 1).toString() + $.now();     
	
	  
	uploadedImage[fileInfo.token+selectedTabId] = Array();
	target.append("<input type=\"hidden\" name=\"" + fileUploaderTarget + "\" />"); 
	target.append("<input type=\"hidden\" name=\"token-" + fileUploaderTarget + "\" value=\"" + fileInfo.token + "\" />");
	
	 
	if (multipleFile == true){
		target.append("<input type=\"hidden\" name=\"" + variantTarget + "\" />");  
	} 
     
	if (fileInfo.arrImage != undefined || fileInfo.arrImage == ""){
      	 for(i=0;i<fileInfo.arrImage.length;i++)  { 
             pushImageThumb(fileUploaderTarget,{"folder":fileInfo.folder, "token":fileInfo.token, "fileName":fileInfo.arrImage[i],"phpThumbHash":fileInfo.phpThumbHash[i]},multipleFile,multipleColor,variantTarget) 
         }
	}
	 
 
	var uploader = new qq.FileUploader({
						element: target.find('.file-uploader')[0], 
						action: 'fileuploader.php?action=upload&folder=' + fileInfo.folder + '&token='+ fileInfo.token, 
						allowedExtensions:['jpg','jpeg','png','gif','ico'],
						onComplete: function(id, fileName, responseJSON){   
							if (responseJSON.success == true)
								pushImageThumb(fileUploaderTarget,{"folder":fileInfo.folder, "token":fileInfo.token, "fileName":responseJSON.fileName,"phpThumbHash":responseJSON.phpThumbHash},multipleFile,multipleColor,variantTarget); 
						} 
					});   
	 
	return fileInfo.token;				  
}
  


function createFileUploader(fileUploaderTarget,folder,token, arrFile){
	
	var selectedTabId = selectedTab.newPanel[0].id
	var target = $("#defaultForm-"+selectedTabId+ " ." + fileUploaderTarget);
	  
	if (token == undefined || token == "")  
		 token = Math.floor((Math.random() * 1000) + 1).toString() + $.now();     
	
	 
	uploadedFile[token+selectedTabId] = Array();
	target.append("<input type=\"hidden\" name=\"" + fileUploaderTarget + "\" />"); 
	target.append("<input type=\"hidden\" name=\"token-" + fileUploaderTarget + "\" value=\"" + token + "\" />");
	  
	if (arrFile != undefined || arrFile == ""){
		 for(i=0;i<arrFile.length;i++) 
			 pushFileThumb(fileUploaderTarget,folder,token,arrFile[i]) 
	}
	 
 
	var uploader = new qq.FileUploader({
						element: target.find('.file-uploader')[0], 
						action: 'fileuploader.php?action=upload&folder=' + folder + '&token='+ token,  
						onComplete: function(id, fileName, responseJSON){  
							if (responseJSON.success == true)
								pushFileThumb(fileUploaderTarget,folder,token,responseJSON.fileName); 
						} 
					});   
	 
	return token;				  
}
  
function pushFileThumb(fileUploaderTarget,folder,token,fileName){
	 
	var target = $("#defaultForm-"+selectedTab.newPanel[0].id+ " ." + fileUploaderTarget);
	var extension = fileName.substr( (fileName.lastIndexOf('.') +1) );
	
	var xPos = 0;
	switch(extension) { 
        case 'doc':
        case 'docx':
            xPos = 35;
        break;
        case 'pdf':
              xPos = 0;
        break;
        default:
          	 xPos = 70;
    }
	 
	
 	var temp = "<li relfilename=\""+fileName+"\" >";
	temp += "<div class=\"file-uploader-image\" style=\"background-position:-" + xPos +"px 0px !important;\"></div>";
	temp += "<div class=\"file-uploader-description\">"+ fileName +"</div>"; 
	temp += "<div class=\"delete-icon-small minerva-icon-15\" style=\"float:right;\" onClick=\"deleteFileUploaderThumb(this,'" + fileUploaderTarget  + "','" + token  + "')\"></div>";
	temp += "<div style=\"clear:both;\"></div>";
	temp += "</li>"; 
	
	target.find(".file-list").append(temp);	
	   
	updateItemFileArray(fileUploaderTarget,token);
	  
	target.find('.file-list li:last img').load(function(){ 
	  $(this).closest(".file-uploader-image").css("background-image","none"); 
	}); 
 
			
}



function updateItemFileArray(fileUploaderTarget,token){
	
	 var selectedTabId = selectedTab.newPanel[0].id
	 var target = $("#defaultForm-"+selectedTabId+ " ." + fileUploaderTarget);  
	 
	 uploadedFile[token+selectedTabId] = Array();
	 $("#defaultForm-"+selectedTab.newPanel[0].id+ " ." +fileUploaderTarget + " .file-list li").each(function(i) {     
			 uploadedFile[token+selectedTabId].push($(this).attr("relfilename"));
	  });
	   
	 target.find("[name=" + fileUploaderTarget + "]").val(uploadedFile[token+selectedTabId]);
	 
}
 

  
  
  
/* IMAGE VARIANT */
 
function loadImageVariant(parentTarget,obj,fileInfo,variantTarget) {     
  	var target = $("#defaultForm-"+selectedTab.newPanel[0].id+ " ." + parentTarget);
	title = 'Update Variasi Warna'; 
 	
	var temp = target.find("[name=" + variantTarget + "]").val() ;
	var color = "#000000";
	 
	if(temp != ""){		 
		var imageList =  JSON.parse(temp); 
		
		if (imageList[fileInfo.fileName] != undefined){
			color = imageList[fileInfo.fileName][0].fileColor;
		} 
	}
	 
	 
	content = '<div class="'+variantTarget+'" reltoken ="'+fileInfo.fileName+'">'; 
	content += '<ul class="image-list">';
	content += '<li relfilename="'+fileInfo.fileName+'"  >';
	content += '<div class="file-uploader-image" ><img src="../phpthumb/phpThumb.php?src='+phpConfiguration.uploadTempDoc + fileInfo.folder +fileInfo.token+ '/'+fileInfo.fileName+'&w=150&h=150&far=C&hash='+fileInfo.phpThumbHash+'"/></div>';
	content += '<div class="file-uploader-action-bar">';  
	content += '<input type="color" class="form-control" style="padding:0 !important; width:2em; height:1.5em; border-radius:0; margin:auto;" name="variantColor[]" value="' + color +'" />'; 
	content += '</div>';
	content += '</li>';  
	content += '</ul>';
	content += '<div style="clear:both; height:1em;"></div>';
	content += '<div class="file-uploader">';
	content += '<noscript>';			
	content += '<p>Please enable JavaScript to use file uploader.</p>'; 
	content += '</noscript>'; 
	content += '</div>';
	content += '</div>'; 
			  
	loadOverlayScreen(title,content);
	 
	$( "." + variantTarget + " .image-list" ).sortable({ placeholder: "sortable-placeholder"});
	$( "." + variantTarget + " .image-list" ).disableSelection();
	
	createImageUploaderforImageVariant(parentTarget, variantTarget,{"folder":'item-variant/'});
   
	$("." + variantTarget + " .qq-upload-button").after("<div style=\"float:left; margin-left:1.5em;\"  class=\"btn btn-danger\" onClick=\"hideOverlayScreen()\">Batal</div> <div style=\"float:left; margin-left:0.5em;\" class=\"btn btn-primary\" onClick=\"updateItemImageArrayforImageVariant('" + parentTarget +"','" + variantTarget +"','" +fileInfo.token +"')\">Simpan</div>"); 
 }
 
function createImageUploaderforImageVariant(parentTarget, fileUploaderTarget,fileInfo){
	  
	var target = $("." + fileUploaderTarget);
	var parentTarget = $("#defaultForm-"+selectedTab.newPanel[0].id+ " ." + parentTarget);
	
	var fileName = target.attr("reltoken"); 
	token = fileName;
 	   
	var temp = parentTarget.find("[name=" + fileUploaderTarget + "]").val() ;
  
	if(temp != ""){		 
		var imageList =  JSON.parse(temp); 
		
		if (imageList[fileName] != undefined){
			for(i=1;i<imageList[fileName].length;i++){
				pushImageThumbforImageVariant(fileUploaderTarget,{"folder":fileInfo.folder, "token":token, "fileName":imageList[fileName][i].fileName,"phpThumbHash":imageList[fileName][i].phpThumbHash} ,imageList[fileName][i].fileColor);
			}	
		} 
	}
	 
	    
	var uploader = new qq.FileUploader({
						element: target.find('.file-uploader')[0], 
						action: 'fileuploader.php?action=upload&folder=' + fileInfo.folder + '&token='+ token, 
						allowedExtensions:['jpg','jpeg','png','gif'],
						onComplete: function(id, fileName, responseJSON){   
							if (responseJSON.success == true)
								pushImageThumbforImageVariant(fileUploaderTarget,{"folder":fileInfo.folder, "token":token, "fileName":responseJSON.fileName,"phpThumbHash":responseJSON.phpThumbHash} );  
						} 
					});   
	  			  
}
	
	
	
function pushImageThumbforImageVariant(fileUploaderTarget,fileInfo,colorValue){ 
 
  	var target = $("." + fileUploaderTarget);

    if (colorValue == undefined || colorValue == "")
		colorValue = "#000000";
		
	var temp = '<li relfilename="'+fileInfo.fileName+'" relPHPThumbHash ="'+fileInfo.phpThumbHash+'">';
	temp += '<div class="file-uploader-image" ><img src="../phpthumb/phpThumb.php?src='+phpConfiguration.uploadTempDoc + fileInfo.folder + fileInfo.token+ '/'+fileInfo.fileName+'&w=150&h=150&far=C&hash='+ fileInfo.phpThumbHash +'"/></div>';
	temp += '<div class="file-uploader-action-bar" style="width:40%; margin:auto;">';  
	temp += '<div style="width:50%;float:left;"><input type="color" class="form-control" style="padding:0 !important; width:2em; height:1.5em; border-radius:0;" name="variantColor[]" value="' + colorValue + '" /></div>'; 
 	temp += '<div style="width:50%;float:left; margin-top:0.2em;"><div class="delete-icon-small minerva-icon-15" onClick="deleteImageUploaderThumbforImageVariant(this,\'' + fileUploaderTarget  + '\',\'' + fileInfo.token  + '\')"></div></div>';
	temp += '</div>';
	temp += '</li>'; 
	
	target.find(".image-list").append(temp);	
	    
	target.find('.image-list li:last img').load(function(){ 
	  $(this).closest(".file-uploader-image").css("background-image","none"); 
	}); 
  		
}


function deleteImageUploaderThumbforImageVariant(obj,fileUploaderTarget,token){  
	$(obj).closest("li").remove();   
} 



function updateItemImageArrayforImageVariant(parentTarget,fileUploaderTarget,token){
	 var target = $("." + fileUploaderTarget); 
	 var parentTarget = $("#defaultForm-"+selectedTab.newPanel[0].id+ " ." + parentTarget);
	
	 var parentFileName = target.attr("reltoken"); 
	 
	 var arrImageVariant = parentTarget.find("[name=" + fileUploaderTarget + "]").val();
	 var fileArray = {};
	  
	 if (arrImageVariant != "")  
	   fileArray = JSON.parse(arrImageVariant);
		   
	fileArray[parentFileName] = new Array;
 	  
	 var temp;
					
	 $("." + fileUploaderTarget + " .image-list li").each(function(i) { 
			temp = new Object();
	 		temp['fileName'] = $(this).attr("relfilename"); 
			temp['fileColor'] =$(this).find('[name="variantColor[]"]').val();
            temp['phpThumbHash'] =  $(this).attr("relPHPThumbHash"); 
			 
			fileArray[parentFileName].push(temp);
	  });
	
	parentTarget.find("[name=" + fileUploaderTarget + "]").val(JSON.stringify(fileArray));
	  
	hideOverlayScreen();		
}
	
 
/* END OF IMAGE VARIANT */

function addNewTemplateRow(selector, arrValue,afterDeleteHandle){
		  var $template = $("#defaultForm-"+selectedTab.newPanel[0].id+" ." + selector),
              $newRow   = $template.clone().removeClass(selector).insertBefore($template.first()).show(); 
			    
			 if(arrValue != undefined && arrValue.length > 0){ 
			 		var temp = JSON.parse(arrValue);  
                    var i;
			 	 	for(i=0;i<temp.length;i++){   
						  $newRow.find("[name=\"" + temp[i].selector +"[]\"]").val(temp[i].value);
					}  
			  }
		 
			$newRow.find('.inputnumber').bind( "blur", function(event) { 
			   inputNumberOnBlur($(this));
			});
				
			$newRow.find('input, select, textarea').each(function(){
				$(this).removeAttr("disabled");
			});	  
			 
			$newRow.find('.ckeditor').each	(function(){  
				var newID = new Date().getTime() + Math.floor((Math.random() * 99999) + 1); 
				$(this).attr("id",newID);
				$("#" + newID).ckeditor(); 
			});	   
						  		
			// Set the label and field name 
			$newRow 
			.on('click', '.removeButton', function() {   
				// Remove element
				$newRow.remove();
				
				if (afterDeleteHandle != undefined)
					eval(afterDeleteHandle);
			});
}

function inputNumberOnBlur(obj,decimal){  	 
	  if(obj.val() == "" || !$.isNumeric(unformatCurrency(obj.val())) ) { 
		 obj.val(0);
		 
		 try {
			$(obj).closest('form').bootstrapValidator('revalidateField', $(obj).attr("name"));   
		 }
		 catch(err) {
			 
		}
 	  }
	  
	  if (decimal == undefined){
          
          if (phpSetting.setting.decimalTransaction == undefined)
              decimal = 0;
          else 
              decimal = phpSetting.setting.decimalTransaction;
          
      }  
    
	  obj.formatCurrency({roundToDecimalPlace: decimal });
}

	
function loadOverlayScreen(title,content){   
	
	$("html, body").css("overflow","hidden");
	 
	$("#popupads .box .title").html(title);
	$("#popupads .box .content").html(content);
	
	$("#popupads .overlay").fadeIn("fast",function(){ 
		$("#popupads .box").show();
		$("#popupads .box").animate({"top":"0px"},500); 
	});	  
	  
	
}


function hideOverlayScreen(){  
		 		
		$("html, body").css("overflow","auto");
		$("#popupads .overlay").fadeOut("fast");
		$("#popupads .box").hide();
		$("#popupads .box").animate({"top":"-800px"},500);  
		 
} 

function disableFormSaveOnEnter(obj){
	obj.bind('keyup keypress', function(e) {
	  var code = e.keyCode || e.which;
	  if (code == 13) { 
		e.preventDefault();
		return false;
	  }
	});
}
	
function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
function updateProfile(id) {
	addTab(phpLang.profile,'profile');
}
 
function clearDetailRows(obj){ 
    $(obj).closest(".div-table-row").find("input").not(obj).val("").blur();
    $(obj).closest(".div-table-row").find("select").prop('selectedIndex', 0);
}

function clearAllRows(formObj){
       formObj.find(".removeButton").each(function() {  
            $(this).click();
        })    
}
