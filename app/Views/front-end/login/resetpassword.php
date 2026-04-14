<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <title><?php VLang::__e('SIGN_UP_RESETPASSWORD');?></title>
	  <link rel="icon" type="image/x-icon" href="<?php echo v_base_url('public/logo.png');?>" />
      <link rel="stylesheet" href="<?php echo v_base_url('public/front-end/login/css/style.css');?>">
	  <link rel="stylesheet" href="<?php echo v_base_url('public/front-end/login/css/login.css');?>">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	  <script src="<?php echo v_base_url('public/back-end/assets/vendors/js/vendor.bundle.base.js');?>"></script>
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
            <?php VLang::__e('RESETPASSWORD_UPPER');?>
         </div>
		 <div class="lostpassword-message lostpassword-message-error" style="display:none;" id="lostpassword-message-error"><?php VLang::__e('RESET_PASSWORD_DONT_MATCH');?></div>
		 
		 <div class="lostpassword-message lostpassword-message-error lostpassword-message-misstake" style="display:none;"><?php VLang::__e('RESET_PASSWORD_DONT_MISSTAKE');?></div>
		 
         <form action="<?php echo v_base_url('user/resetpassword');?>" method="post" onSubmit="return checkInfor();">
            <div class="field">
               <div class="fas fa-lock"></div>
               <input type="password" id="password" name="password" required="required" placeholder="<?php VLang::__e('RESET_PASSWORD_1');?>">
			</div>
			<div class="field">
			   <div class="fas fa-lock"></div>
               <input type="password" id="confirmpassword" required="required" placeholder="<?php VLang::__e('RESET_PASSWORD_2');?>" name="email">
            </div>
            <button type="submit" name="submit" value="submit"><?php VLang::__e('LOSTPASSWORD_SUBMIT');?></button>
            <div class="link">
               <a href="<?php echo v_base_url('user/login');?>"><?php VLang::__e('SIGN_IN');?></a>
            </div>
			<input type="hidden" name="code" value="<?php echo $_REQUEST['code'];?>" />
         </form>
      </div>
	  <script src="<?php echo v_base_url('public/front-end/js/resetpassword.js');?>"></script>
   </body>
</html>