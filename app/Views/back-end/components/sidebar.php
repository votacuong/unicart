<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
	  <a class="sidebar-brand brand-logo" href="index.html"><img src="<?php echo v_base_url('public/front-end/images/shopping-cart.png');?>" alt="logo" /></a>
	  <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="<?php echo v_base_url('public/front-end/images/home-logo.png');?>" alt="logo" /></a>
	</div>
	<ul class="nav">
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'dashboard') !== false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/dashboard');?>">
		  <span class="menu-icon">
			<i class="mdi mdi-view-dashboard"></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('DASHBOARD');?></span>
		</a>
	  </li>
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'user') !== false || strpos(getUrl(), 'reviews') !== false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/users');?>">
		  <span class="menu-icon">
			<i class="mdi mdi-account-multiple"></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('USERS');?></span>
		</a>
	  </li>
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'product') !== false && strpos(getUrl(), 'product_id') === false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/products');?>">
		  <span class="menu-icon">
			<i class="mdi mdi-paper-cut-vertical "></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('PRODUCTS');?></span>
		</a>
	  </li>
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'order') !== false && strpos(getUrl(), 'order=') === false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/orders');?>">
		  <span class="menu-icon">
			<i class="mdi mdi-briefcase "></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('ORDERS');?></span>
		</a>
	  </li>
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'payment') !== false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/payments');?>">
		  <span class="menu-icon">
			<i class=" mdi mdi-barcode-scan "></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('PAYMENTS');?></span>
		</a>
	  </li>
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'currency') !== false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/currencies');?>">
		  <span class="menu-icon">
			<i class="mdi mdi-currency-btc "></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('CURRENCY');?></span>
		</a>
	  </li>
	  <li class="nav-item menu-items <?php if ( strpos(getUrl(), 'setting') !== false){echo 'appointment-active active';}?>">
		<a class="nav-link" href="<?php echo v_base_url('admin/settings');?>">
		  <span class="menu-icon">
			<i class="mdi mdi-camera-iris"></i>
		  </span>
		  <span class="menu-title"><?php VLang::__e('SETTINGS');?></span>
		</a>
	  </li>
	</ul>
</nav>