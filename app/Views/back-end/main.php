<?php
include(dirname(__FILE__).'/components/head.php');
?>
<body>
	<div class="container-scroller">
		<?php
			include(dirname(__FILE__).'/components/sidebar.php');
			
		?>
		<div class="container-fluid page-body-wrapper">
			<?php include(dirname(__FILE__).'/components/navbar.php'); ?>
			<div class="main-panel">
			  <div class="content-wrapper">
				<div class="row">
				  <?php 
				  include(dirname(__FILE__).'/components/breadcrumb.php');; 
				  include(dirname(__FILE__).'/'.$this->data['subview']); 
				  ?>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	</div>
	<script src="<?php echo v_base_url('public/back-end/assets/js/hoverable-collapse.js');?>"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo v_base_url('public/back-end/assets/editor/richtext.min.css');?>">
	<script src="<?php echo v_base_url('public/back-end/assets/editor/jquery.richtext.js');?>"></script>
    <script type="text/javascript">
		var user_edit = '<?php echo v_base_url('admin/user/edit');?>';
		var user_search = '<?php echo v_base_url('admin/user/search');?>';
		var product_edit = '<?php echo v_base_url('admin/product/edit');?>';
		var product_search = '<?php echo v_base_url('admin/product/search');?>';
		var coupon_edit = '<?php echo v_base_url('admin/coupon/edit');?>';
		var coupon_search = '<?php echo v_base_url('admin/coupon/search');?>';
		var promotionkey_search = '<?php echo v_base_url('admin/promotionkey/search');?>';
		var promotionkey_edit = '<?php echo v_base_url('admin/promotionkey/edit');?>';
		
		
	</script>
	<script src="<?php echo v_base_url('public/back-end/assets/js/main.js');?>"></script>
  </body>
</html>