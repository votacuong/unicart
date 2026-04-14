<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <title><?php VLang::__e('SIGN_UP_LOGIN');?></title>	  
	  <link rel="icon" type="image/x-icon" href="<?php echo v_base_url('public/logo.png');?>" />
      <link rel="stylesheet" href="<?php echo v_base_url('public/front-end/login/css/style.css');?>">
      <link rel="stylesheet" href="<?php echo v_base_url('public/front-end/login/css/login.css');?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	  <style> 
		input[type=text]:focus {
		  color: #cfcfcf!important;
		}
		input[type=email]:focus {
		  color: #cfcfcf!important;
		}
		input[type=password]:focus {
		  color: #cfcfcf!important;
		}
		.text-danger{
			font-size: 12px;
		}
		input:-webkit-autofill,
		input:-webkit-autofill:hover,
		input:-webkit-autofill:focus,
		input:-webkit-autofill:active {
			transition: background-color 5000s ease-in-out 0s;
			-webkit-text-fill-color: #fbfbfd !important;
		}
	</style>
   </head>
   <body>
      <div class="login-form">
		<div class="logo">
		   <a href="<?php echo v_base_url('');?>">
				<img src="<?php echo v_base_url('public/front-end/images/home-logo.png');?>" />
		    </a>
		</div>
         <div class="text">
            <?php VLang::__e('SIGN_IN_UPPER');?>
         </div>
		 <?php 
			echo showMessages();
         ?>
         <form action="<?php echo v_base_url('user/doLogin?return_url='.@$_REQUEST['return_url']);?>" method="post">
            <div class="field">
               <div class="fas fa-envelope"></div>
               <input type="email" required="required" placeholder="<?php VLang::__e('SIGN_UP_EMAIL');?>" name="username">
            </div>
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" required="required" placeholder="<?php VLang::__e('SIGN_UP_PASSWORD');?>" name="password">
            </div>
            <button><?php VLang::__e('SIGN_IN_LOGIN');?></button>
            <div class="link">
			      <a href="<?php echo v_base_url('user/signup');?>"><?php VLang::__e('SIGN_UP');?></a>
               <spam>·</spam>
               <a href="<?php echo v_base_url('user/lostpassword');?>" class="lost-password"><?php VLang::__e('LOSTPASSWORD');?></a>
            </div>
         </form>
      </div>
   </body>
</html>