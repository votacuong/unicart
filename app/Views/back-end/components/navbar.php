<nav class="navbar p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
	<a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?php echo v_base_url('public/front-end/images/home-logo.png');?>" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
	<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
	  <span class="mdi mdi-menu"></span>
	</button>
	<?php if (session()->get('user_type') == 1):?>
	<ul class="navbar-nav w-100">
	  <li class="nav-item w-100">		
		<form class="navbar-form navbar-left nav-link mt-2 mt-md-0 d-none d-lg-flex search">
			<div class="typeahead__container">
				<div class="typeahead__field">

					<span class="typeahead__query">
						<input class="js-typeahead form-control"
							   name="query"
							   type="search"
							   autofocus
							   autocomplete="off"
							   placeholder="<?php VLang::__e('USER_LISTING_SEARCH');?>" />
					</span>

				</div>
			</div>
		</form>
	  </li>
	</ul>
	<?php endif;?>
	<ul class="navbar-nav navbar-nav-right">
	  <li class="nav-item nav-settings d-none d-lg-block">
		<a class="nav-link" href="<?php echo v_base_url('');?>" target="_blank">
		  <i class="mdi mdi-home"></i>
		</a>
	  </li>
	  <li class="nav-item dropdown">
		<a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
		  <div class="navbar-profile">			
			<?php 
			if ( is_file(FCPATH . '../public/images/users/'.session()->get('id').'.png') ):?>
				<img class="img-xs rounded-circle" src="<?php echo v_base_url('public/images/users/'.session()->get('id').'.png?time='.date("Y-m-d H:i:s"));?>" />
			<?php elseif ( is_file(FCPATH . '../public/images/users/'.session()->get('id').'.jpg') ):?>
				<img class="img-xs rounded-circle" src="<?php echo v_base_url('public/images/users/'.session()->get('id').'.jpg?time='.date("Y-m-d H:i:s"));?>" />
			<?php elseif ( is_file(FCPATH . '../public/images/users/'.session()->get('id').'.jpeg') ):?>
				<img class="img-xs rounded-circle" src="<?php echo v_base_url('public/images/users/'.session()->get('id').'.jpeg?time='.date("Y-m-d H:i:s"));?>" />
			<?php else:?>
				<img class="img-xs rounded-circle" src="<?php echo v_base_url('public/images/default.jpg');?>" />
			<?php endif;
			?>
					
			<p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo session()->get('username');?></p>
			<i class="mdi mdi-menu-down d-none d-sm-block"></i>
		  </div>
		</a>
		<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
		  <h6 class="p-3 mb-0"><?php VLang::__e('USER_LISTING_PROFILE');?></h6>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item preview-item">
			<div class="preview-thumbnail">
			  <div class="preview-icon bg-dark rounded-circle">
				<i class="mdi mdi-settings text-success"></i>
			  </div>
			</div>
			<div class="preview-item-content">
			  <p class="preview-subject mb-1" onClick="window.location.href='<?php echo v_base_url('admin/user/edit/1');?>';"><?php VLang::__e('USER_LISTING_SETTINGS');?></p>
			</div>
		  </a>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item preview-item">
			<div class="preview-thumbnail">
			  <div class="preview-icon bg-dark rounded-circle">
				<i class="mdi mdi-logout text-danger"></i>
			  </div>
			</div>
			<div class="preview-item-content">
			  <p class="preview-subject mb-1" onClick="window.location.href='<?php echo v_base_url('admin/user/logout');?>';"><?php VLang::__e('USER_LISTING_LOGOUT');?></p>
			</div>
		  </a>
		  <div class="dropdown-divider"></div>
		</div>
	  </li>
	</ul>
	<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
	  <span class="mdi mdi-format-line-spacing"></span>
	</button>
  </div>
</nav>

	