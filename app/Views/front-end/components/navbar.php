<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar-shadow">
	<div class="container px-4 px-lg-5">
		<a class="navbar-brand" href="<?php echo v_base_url('');?>"><img src="<?php echo v_base_url('public/front-end/images/home-logo.png');?>" width="40px" title="<?php VLang::__e('THECUP_LOGON');?>"/></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
				<li class="nav-item"><a class="nav-link <?php if (getUrl() == v_base_url('')){echo 'menu-active';}?>" aria-current="page" href="<?php echo v_base_url('');?>"><?php VLang::__e('THECUP_HOME');?></a></li>
				<li class="nav-item"><a class="nav-link <?php if (getUrl() == v_base_url('market-place')){echo 'menu-active';}?>" aria-current="page" href="<?php echo v_base_url('market-place');?>"><?php VLang::__e('THECUP_MARKETPLACE');?></a></li>
				<li class="nav-item"><a class="nav-link" aria-current="page" target="_BLANK" href="https://github.com/votacuong/unicart">Download</a></li>
				<li class="nav-item"><a class="nav-link" aria-current="page" target="_BLANK" href="<?php echo v_base_url('admin');?>">Admin</a></li>
			</ul>
			 <?php $usermodel = new \App\Models\UserModel();?>
			
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 profile-menu">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdownActivitiesCurrency" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-currency-exchange"></i></a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdownActivitiesCurrency">
				    <?php
					$AdminCurrencyModel = new \App\Models\AdminCurrencyModel();
					$currencies = $AdminCurrencyModel->select(['state'=>1]);
					?>
					<li><a class="dropdown-item" href="#"><label class="currency-active"><?php echo get_activities_session()['currency'];?></label><i class="fa fa-check select" aria-hidden="true"></i></a></li>
					<?php foreach($currencies as $currency):?>
					<li><hr class="dropdown-divider" /></li>
					<li><a class="dropdown-item" href="<?php echo v_base_url('activities/currency/'.$currency['code'].'?return_url='.base64_encode(getUrl()));?>"><?php echo $currency['code'];?></a></li>
					<?php endforeach;?>
					<li><hr class="dropdown-divider" /></li>
					<li><a class="dropdown-item" href="<?php echo v_base_url('activities/edit');?>"><i class="bi bi-list-check"></i></a></li>
				</ul>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdownActivitiesLanguage" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-globe"></i></a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdownActivitiesLanguage">
				    <?php
					$languages = array('0'=>'English', '1'=>'Vietnamese');
					?>
					<li><a class="dropdown-item" href="#"><label class="currency-active"><?php echo get_activities_session()['language'];?></label><i class="fa fa-check select" aria-hidden="true"></i></a></li>
					<?php foreach($languages as $language):?>
					<li><hr class="dropdown-divider" /></li>
					<li><a class="dropdown-item" href="<?php echo v_base_url('activities/language/'.$language.'?return_url='.base64_encode(getUrl()));?>"><?php echo $language;?></a></li>
					<?php endforeach;?>
					<li><hr class="dropdown-divider" /></li>
					<li><a class="dropdown-item" href="<?php echo v_base_url('activities/edit');?>"><i class="bi bi-list-check"></i></a></li>
				</ul>
			</li>
			<?php if ($usermodel->isLogin()):?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<?php 
					if ( is_file(FCPATH . '../public/images/users/'.session()->get('id').'.png') ):?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/users/'.session()->get('id').'.png?time='.date("Y-m-d H:i:s"));?>" />
					<?php elseif ( is_file(FCPATH . '../public/images/users/'.session()->get('id').'.jpg') ):?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/users/'.session()->get('id').'.jpg?time='.date("Y-m-d H:i:s"));?>" />
					<?php elseif ( is_file(FCPATH . '../public/images/users/'.session()->get('id').'.jpeg') ):?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/users/'.session()->get('id').'.jpeg?time='.date("Y-m-d H:i:s"));?>" />
					<?php else:?>
						<img class="profile-img" src="<?php echo v_base_url('public/front-end/images/gems.gif');?>" />
					<?php endif;
					?>
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="<?php echo v_base_url('user/edit');?>"><?php VLang::__e('THECUP_PROFILE_SETTINGS');?></a></li>
					<li><hr class="dropdown-divider" /></li>
					<li><a class="dropdown-item" href="<?php echo v_base_url('user/logout');?>"><?php VLang::__e('THECUP_PROFILE_LOGOUT');?></a></li>
				</ul>
			</li>
			<?php endif;?>
			
			
			<?php if (!$usermodel->isLogin()):?>
			<li class="nav-item dropdown profile-login">
			<a class="dropdown-item"  href="<?php echo v_base_url('user/login');?>"><?php VLang::__e('THECUP_PROFILE_LOGIN');?></a>
			</li>
			<?php endif;?>
			</ul>
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 profile-button">
				<li class="nav-item dropdown">
					<form class="d-flex">
						<a class="btn btn-outline-dark cart-area" id="navbarCartDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="abbora-cart"></i>
							<?php VLang::__e('THECUP_PROFILE_CART');?>
							<span class="badge bg-dark text-white ms-1 rounded-pill" id="cart-count"><?php $cart = new \App\Models\CartModel();echo $cart->countCart();?></span>
						</a>
						<div class="dropdown-menu" id="cart-dropdown" aria-labelledby="navbarCartDropdown">
						</div>
					</form>
				</li>
			</ul>
			
		</div>
	</div>
</nav>
<script type="text/javascript">
	jQuery(document).ready(function(){
		
		jQuery('#navbarCartDropdown').click(function(){
			jQuery.get('<?php echo v_base_url('cart/getDropdownCart');?>', function(data){
				jQuery('#cart-dropdown').css({
					'margin-left':'-'+(parseFloat(jQuery('#cart-dropdown').css('width'))-parseFloat(jQuery('#navbarCartDropdown').css('width')))+'px'
				});
				jQuery('#cart-dropdown').html(data);
			});
		});
	});
</script>
<?php $usermodel = new \App\Models\UserModel();
?>
<header class="bg-dark py-5">
	<div class="container px-4 px-lg-5 my-5">
		<div class="text-center text-white">
			<h1 class="display-4 fw-bolder">
			<img src="<?php echo v_base_url('public/front-end/images/home-logo.png');?>" width="70px" title="<?php VLang::__e('THECUP_LOGON');?>"/>
			<label class="head-banner"><?php VLang::__e('THECUP_BANNER');?></label>
			</h1>
		</div>
		<div id="down">
		    <h1></h1>
		</div>
	</div>
</header>