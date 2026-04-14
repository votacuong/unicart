<?php
$product = new \App\Models\AdminProductModel();
$products = $product->select(['state'=>1]);
$AppConfig = new \Config\AppConfig();
$Currency = new \App\Libraries\Currency();

?>
<?php foreach($products as $p):?>
<div class="col mb-5">
	<div class="card h-100">		
		<?php 
		if ( is_file(FCPATH . '../public/images/product/'.$p['id'].'.gif') ):?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$p['id'].'.gif?time='.date("Y-m-d"));?>" />
		<?php elseif ( is_file(FCPATH . '../public/images/product/'.$p['id'].'.png') ):?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$p['id'].'.png?time='.date("Y-m-d H:i:s"));?>" />
		<?php elseif ( is_file(FCPATH . '../public/images/product/'.$p['id'].'.jpg') ):?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$p['id'].'.jpg?time='.date("Y-m-d H:i:s"));?>" />
		<?php elseif ( is_file(FCPATH . '../public/images/product/'.session()->get('id').'.jpeg') ):?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$p['id'].'.jpeg?time='.date("Y-m-d H:i:s"));?>" />
		<?php else:?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/default.jpg');?>" />
		<?php endif;
		?>
		<div class="card-body p-4">
			<div class="text-center">
				<!-- Product name-->
				<h5 class="fw-bolder inforproduct-title"><a class="cart-edit-link" href="<?php echo v_base_url('product/details/'.$p['id']);?>"><?php echo $p['name'];?></a></h5>
				
				<div class="product-price-form">
					<h5 class="fw-bolder inforproduct-price" id="product-<?php echo $p['id'];?>" data-value="<?php echo $p['price'];?>"><?php echo get_activities_session()['symbol'];?> <?php echo round(((float)$p['price'])*$Currency->__getExchange(get_activities_session()['currency']), 1);?></h5>
				</div>
				<p class="inforproduct-description"><?php echo $p['description'];?></p>
			</div>
		</div>
		<!-- Product actions-->
		<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
			<div class="text-center">
				<a class="btn btn-outline-dark mt-auto inforproduct-send" href="javascript:void(0);" onClick="addToCart(<?php echo $p['id'];?>);"><?php VLang::__e('INFORMATION_PRODUCT_SEND');?></a>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>
<?php
$Currency->__loadCurrent();
?>
<script type="text/javascript">
var system_currency = <?php echo $Currency->__getExchange($AppConfig->system_currency);?>;
var addCart ='<?php echo v_base_url('cart/addToCart?product_id=');?>';
var countCart = '<?php echo v_base_url('cart/countCart');?>';
</script>
<script src="<?php echo v_base_url('public/front-end/js/home.js');?>"></script>