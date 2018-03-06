<?php 
include '_config.php'; 
include '_include.php'; 
 
if (isset ($_SESSION[$class->loginAdminSession]))
	session_unset($_SESSION[$class->loginAdminSession]);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Turboly - Challenge</title>  

<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>adminStyle.css">  
<link rel="stylesheet" type="text/css" href="<?php echo $class->adminCssPath; ?>jquery-ui.css" />   
<link rel="stylesheet" href="<?php echo $class->adminCssPath; ?>bootstrap.css"/>
<link rel="stylesheet" href="<?php echo $class->adminCssPath; ?>bootstrapValidator.css"/>

<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>jquery-1.11.1.js"></script>         
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>jquery-ui.js"charset="utf-8"></script>  
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>bootstrapValidator.js"></script>
<script type="text/javascript" src="<?php echo $class->defaultJsPath; ?>php-variables.js"></script>
 
	 
<script type="text/javascript">
 
	
	jQuery(document).ready(function(){ 
		
		/*
        var windowheight = ($(document).height()) / 2;
		var layerheight = $('#body-login').height() / 2;
		var top = windowheight -  layerheight;
		 
		$('#body-login').css({'top': top + 'px'});
		*/ 
		
		 $('#defaultForm')
			.bootstrapValidator({
				
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                loginID: {
                    validators: {
                        notEmpty: {
                            message: phpErrorMsg.username['1'] 
                        },
                        stringLength: {
                            min: 5,
                            max: 30,
                            message: phpErrorMsg.username['3'] 
                        }, 
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message:  phpErrorMsg.username['4'] 
                        }
                    }
                }, 
                loginPassword: {
                    validators: {
                        notEmpty: {
                            message: phpErrorMsg.password['1'] 
                        }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
				 
				$(".notification-msg").hide().fadeToggle("fast"); 
                
				if (!result.valid){
					$(".notification-msg").removeClass("bg-green-avocado").addClass("bg-red-cardinal"); 
                	$(".notification-msg").html(result.message);
					
				}else{
					$(".notification-msg").removeClass("bg-red-cardinal").addClass("bg-green-avocado"); 
					$(".notification-msg").html(result.message);
					
				 	$form[0].action = "list";
					$form[0].submit();
					
				} 
				
            }, 'json');
        });
	});
			
</script>
</head>  
       
<?php
$profileImg = $class->loadSetting('companyLogo');
$bgImage = $class->loadSetting('adminBackgroundImage');

$avatarStyle = '';

  if (!empty($profileImg))
     $avatarStyle = 'style="background-image:url(\''. $class->defaultURLUploadPath.'setting/companyLogo/'.$profileImg.'\')"';  

if (empty($bgImage))
    $bgImage = '../include/img/admin-bg.jpg';
else
    $bgImage = $class->defaultURLUploadPath.'setting/adminBackgroundImage/' . $bgImage;

?>
    
<body  style="background-color:#dedede; background-size:cover;   background-repeat: no-repeat;  background-position: center;" background="<?php echo $bgImage; ?>"> 
<div id="body-login"> 
    <div class="login-panel-background"></div>
    <div style="padding:1em;">    
        <div class="avatar"  <?php echo $avatarStyle ?>></div>  
        <div style="text-align:center; line-height:2em"><?php echo strtoupper($DOMAIN_NAME); ?></div> 
        <form id="defaultForm" method="post" class="form-horizontal" action="validateLogin.php">
 
    <div class="notification-msg" style="text-align:center; width:300px; margin:auto; margin-top:0.5em; margin-bottom:0.5em"></div>

    <div class="div-table" style="width:100%; ">
        <div class="div-table-row form-group"> 
            <div class="div-table-col-5">
                <div class="col-lg-12"> 
                     <?php echo $class->input('text','loginID',false,'','placeholder="'.$class->lang['username'].'"'); ?>
                </div>
            </div> 
        </div>

         <div class="div-table-row form-group"> 
            <div class="div-table-col-5">
                <div class="col-lg-12"> 
                     <?php echo $class->input('password','loginPassword',false,'','placeholder="'.$class->lang['password'].'"'); ?>
                </div>
            </div> 
        </div>

         <div class="div-table-row form-group"> 
            <div class="div-table-col-5">
                <div class="col-lg-1"> 
                   <?php echo $class->input('submit','btnLogin',false,'Login','style="width:100%"'); ?>
                </div>
            </div> 
        </div>

    </div>



    </form> 
    </div>
</div> 
  
</body>
</html>
