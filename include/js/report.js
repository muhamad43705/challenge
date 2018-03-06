jQuery(document).ready(function(){ 
  
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
		
		$( ".report .toogle-criteria" ).on( "click", function() {
				$(".criteria-panel").toggle();
		}); 
		
		$( "#popupads .closebutton" ).on( "click", function() {
				hideOverlayScreen()
		});  

		 $('.multi-selectbox').searchableOptionList({
               maxHeight: '250px',
               showSelectAll: true,
               showSelectionBelowList: true
        });
		
		
		$(".sortable").bind( "click", function( event ) {  
		
			var ordertype = $(this).attr("reltype");
			var orderby = $(this).attr("relcol"); 
			$('#filterForm [name=hidOrderBy]').val(orderby); 
			$('#filterForm [name=hidOrderType]').val(ordertype); 
			
			
			$(".sortable").removeClass("sortable-active");
			$(".sortable .order-type").removeClass("arrow-up").removeClass("arrow-down").hide();
			
			$(this).addClass("sortable-active");
				
			if (ordertype == 1)
				$(this).find(".order-type:first").addClass("arrow-down").show();
			else
				$(this).find(".order-type:first").addClass("arrow-up").show();
			 
			
			$(this).attr("reltype",ordertype * -1); 
				  
			$('#filterForm').submit();
			
		});
		
		
		$("#filterForm").submit(function(e) {  
		 		e.preventDefault();
				
				if($("[name=btnSubmit]").prop('disabled'))
					return true;
				
				//prevent Default functionality 
				updateData(); 
		 	
		}); 
		
		$(".print-report").click(function(e) { 
			 window.print();
		}); 
		  
		$(document).keyup(function (e){ 
			 try{	
					switch(e.keyCode || e.which) {
						 
						case 115: toggleAll(); 
								  e.preventDefault();	
								  break; 
						default:
							break; 
					}
			 } catch (err){
				 
			 }
				 
		});
		
		$('.sortable').attr("reltype",-1);
		$(".sortable" ).append('<div class="order-type"></div>');
	 
		$(".report .toogle-criteria" ).click();
    
        if (autoLoad == 1)
		 updateData();
		
});   

function toggleAll(){
	 
	 var visibleRow = false;
	
	 $(".detail-row:visible").each(function(i) { 
			visibleRow = true;
	 });
	 
	 if (visibleRow)
	 	  $(".detail-row").hide("fast");
	 else
	 	  $(".detail-row").toggle("fast"); 
		 
}

function updateData(){
	    
        $("[name=btnSubmit]").prop('disabled', true);
		$(".rewrite-row").remove();
		$('.loading-icon').show(); 
					
        //do your own request an handle the results
        $.ajax({ 
			type: 'post',
			dataType: 'json',
			data: $("#filterForm").serialize(), 
			success: function(data) { 
					$('.loading-icon').hide();  
					
					$(".main-table").append(data.content);
					
					var filter = "";
					for (i=0;i<data.filterInformation.length;i++){
						filter += '<div class="div-table-row"><div class="div-table-col">'+data.filterInformation[i].label+'</div><div class="div-table-col">: ' +data.filterInformation[i].filter  +'</div></div>';
					}
					
					if (filter != "")
						filter = '<div class="div-table">' + filter + '</div>';
						
					$(".filter-information").html(filter); 
					
					$(".expandable-report-row").bind( "click", function( event ) {   
							$(this).next('.detail-row').toggle("fast");
					}); 
					
					$("[name=btnSubmit]").prop('disabled', false);
			  }
		}); 
			 
}
				
function clearAutoCompleteInput(obj,hidKeyName){    
	$(obj).val("");   
	$(obj).closest('form').find("[name="+hidKeyName+"]").first().val(""); 
}
