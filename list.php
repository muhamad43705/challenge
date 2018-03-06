<?php  
include '_config.php'; 
include '_include.php'; 

if (empty($_SESSION[$class->loginAdminSession]))
	header("location: " .  $class->defaultURLAdminPath); 
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Turboly - Challenge</title>  

<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>adminStyle.css" />  
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>jquery-ui.css" />    
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>clock.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>fileuploader.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>font-awesome.min.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>bootstrapValidator.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>jquery-ui-timepicker-addon.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>scrollToTop.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>easing.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>sol.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>jquery.contextMenu.css"/>   

     
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>jquery-1.11.1.js"></script> 
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>bootstrapValidator.js"></script>          
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>jquery-ui.js" charset="utf-8"></script> <!-- diletakan setelah bootstrap untuk menghindari kesalahan style -->
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>jquery-ui-timepicker-addon.js"></script>   
<script type='text/javascript' src='<?php echo $class->defaultJsPath; ?>clock.js'></script>
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>jquery.formatCurrency-1.4.0.min.js" ></script> 
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>fileuploader.min.js"></script>  
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>ckeditor-4.5.8/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>ckeditor-4.5.8/adapters/jquery.js"></script>	
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>ckfinder/ckfinder.js"></script>  	
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>jquery-scrollToTop.js"></script>   
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>sol.js"></script>
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>jquery.contextMenu.js"></script>  
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>jquery.ui.position.js"></script> 
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>php-variables.js"></script> 
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>main.js"></script>

    
<script>
	/*totalRowsPerPage = <?php // echo  $class->loadSetting('adminTotalRowsPerPage'); ?>; 
	var sitesName =  "<?php  //echo  $class->loadSetting('sitesName'); ?>/"; */
	CKFinder.setupCKEditor(null, '/include/js/ckfinder/');   
    
     
</script>
</head>
 
<body >

<!-- The overlay and the box -->
<div id="popupads" >
	<div class="overlay">&nbsp;</div> 
	<div class="box"> 
    	<div class="title"></div>
        <div class="closebutton"></div>
        <div class="content"></div> 
    </div>
</div>
<!-- The overlay and the box -->  
 

<div id="dialog-message" title="Pesan"></div>
<!-- header -->
<div id="page-header">
	<div class="title">Turboly Challenge</div> 
    <!-- <div  class="minerva-icon-20 bars-menu"></div> -->
    <!-- clock -->
    <div class="clock" style="margin-right:1em;">
       <div id="Date" style="margin-right:0.5em;"></div>
       <div id="hours"></div>
       <div class="point">:</div>
       <div id="min"></div>
       <div class="point">:</div>
       <div id="sec"></div> 
    </div>
    <!-- clock -->
    <div  style="clear:both"></div>
</div> 
<!-- header -->

<div class="div-table" style="width:100%; min-width:1200px; height:100vh; table-layout:fixed">
    <div class="div-table-row">
        <div class="div-table-col left-menu-col" >
            <!-- left menu --> 
                <div id="profile" >
                	<div  class="div-table" style="margin:1em;">
                       <div class="div-table-row"> 
                            <div class="div-table-col"><div class="image" <?php 
										 $profileImg = $class->loadSetting('companyLogo');
										  if (!empty($profileImg)) echo 'style="background-image:url(\''.$class->defaultURLUploadPath.'setting/companyLogo/user.png\')"';  
										  ?>></div></div>
                            <div class="div-table-col" style="padding-left:1em;">
                                <div class="name"><?php echo $_SESSION[$class->loginAdminSession]['name'];?></div> 
                                <div class="link"><a href="logout.php">Logout</a></div>
                            </div>
                        </div>	
                    </div> 
                </div>
                
                <div style="clear:both;"></div>
                
                <div id="tabs-menu" class="user-select-none"> 
                    <div id="left-menu-panel" class="menu-navigation-tab" style="padding:0px !important;">
                       <div id="main-menu"><?php include 'menu.php'; ?> </div>
                    </div>  
                    
                </div> 
                         
            <!-- left menu -->
        </div> 
        <div class="div-table-col" style="vertical-align:top; "> 
        <!-- content --> 
            <div id="tabs" > 
                <ul> 
                </ul>   
                <div id="tabs-1">
                 
                </div> 
            </div>  
        <!-- content --> 
        </div>
    </div>
 </div>
 <div id="back-to-top"></div>
</body>

</html>
<div class="modal"><!-- Place at bottom of page --></div>
