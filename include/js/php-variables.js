var phpConfiguration = {}; 
var phpErrorMsg = {}; 
var phpLang = {}; 
var phpSetting = {}; 
 	
jQuery(document).ready(function(){ 

		$.ajax({
			type: "POST",
			url: "getPHPConfiguration.php",
			async: false, 
			success: function(data){  
					phpConfiguration = JSON.parse(data);   
			} 
		}); 
		$.ajax({
			type: "POST",
			url: "getPHPErrorMsg.php",
			async: false, 
			success: function(data){   
					phpErrorMsg = JSON.parse(data);   
			} 
		});  
        $.ajax({
			type: "POST",
			url: "getPHPLang.php",
			async: false, 
			success: function(data){   
					phpLang = JSON.parse(data);   
			} 
		});  
        $.ajax({
			type: "POST",
			url: "getPHPSetting.php",
			async: false, 
			success: function(data){   
					phpSetting = JSON.parse(data);   
			} 
		});  
		
});   