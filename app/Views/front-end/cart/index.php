<?php
$product = new \App\Models\AdminProductModel();
$CartModel = new \App\Models\CartModel();
$AppConfig = new \Config\AppConfig();
$carts = $CartModel->selectCart();
if (is_array($carts) && isset($carts[0]['id'])){
	$carts = (array)json_decode($carts[0]['cart']);
}else{
	$carts = [];
}
$totalprice = 0;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.6/featherlight.min.css">
<script src="https://checkout.stripe.com/v2/checkout.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.6/featherlight.min.js"></script>
<style>
#coupon{
	margin-bottom: 0px;
}
</style>
<script type="text/javascript">
<?php
$Stripe = new \App\Libraries\Stripe();
$Stripe->create_payment_intent(100, get_activities_session()['currency']);
$cart_error = false;
$UserModel = new \App\Models\UserModel();
$Currency = new \App\Libraries\Currency();
$cartcount = 0;
if (is_array($carts) && count($carts) > 0){
	foreach($carts as $key => $cart){
		$cartcount++;
	}
}
$totalpriceProduct = 0;
?>
var cart_not_error = true;
var cart_error = [];

</script>
<section class="h-100 thecup-container">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
		<?php if (is_array($carts) && count($carts) == 0 || $cartcount == 0):?>
		
		<?php VLang::__e('CART_SHOPPING_CART_EMPTY');?>
		<?php elseif(is_array($carts) && count($carts) > 0):?>
		<div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0"><?php VLang::__e('CART_SHOPPING_CART');?></h3>
        </div>
		<?php foreach($carts as $key => $cart):?>
		<?php
		$key = explode('_', $key)[0];
		$productd = (object)$product->get($key);
		$assigned = [];
		$custom_price = round($productd->price*$cart->quanlity*$Currency->__getExchange(get_activities_session()['currency']), 2);
		$custom_price_item = round($productd->price*$cart->quanlity*$Currency->__getExchange(get_activities_session()['currency']), 2);
		$totalpriceProduct += $productd->price*$cart->quanlity;
		?>
        <div class="card rounded-3 mb-4" id="cart-<?php echo $key;?>">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center cart-item">
              <div class="col-md-2 col-lg-2 col-xl-2 item-cart">
				<a class="cart-edit-link" href="<?php echo v_base_url('product/details/'.$key);?>">
				<?php 
				if ( is_file(FCPATH . '../public/images/product/'.$key.'.gif') ):?>
					<img class="card-img-top image-cart" src="<?php echo v_base_url('public/images/product/'.$key.'.gif?time='.date("Y-m-d"));?>" />
				<?php elseif ( is_file(FCPATH . '../public/images/product/'.$key.'.png') ):?>
					<img class="card-img-top image-cart" src="<?php echo v_base_url('public/images/product/'.$key.'.png?time='.date("Y-m-d H:i:s"));?>" />
				<?php elseif ( is_file(FCPATH . '../public/images/product/'.$key.'.jpg') ):?>
					<img class="card-img-top image-cart" src="<?php echo v_base_url('public/images/product/'.$key.'.jpg?time='.date("Y-m-d H:i:s"));?>" />
				<?php elseif ( is_file(FCPATH . '../public/images/product/'.$key.'.jpeg') ):?>
					<img class="card-img-top image-cart" src="<?php echo v_base_url('public/images/product/'.$key.'.jpeg?time='.date("Y-m-d H:i:s"));?>" />
				<?php else:?>
					<img class="card-img-top image-cart" src="<?php echo v_base_url('public/images/default.jpg');?>" />
				<?php endif;
				?>
				</a>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3 item-cart">
                <p class="lead fw-normal mb-2">
				<a class="cart-edit-link" href="<?php echo v_base_url('product/details/'.$key);?>"><?php echo $productd->name;?></a>
				</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex item-cart">
                <label class="cart-quanlity"><?php echo $cart->quanlity;?></label>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1 product-cart item-cart">
                <h5 class="mb-0"><?php echo get_activities_session()['symbol'];?> 
				<?php 
					echo round($custom_price*$Currency->__getExchange(get_activities_session()['currency']), 2);
				?>
				</h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="javascript:cartDeleteItem('<?php echo $key;?>');" class="text-danger"><i class="bi bi-trash-fill"></i></a>
              </div>
            </div>
          </div>
        </div>
		<?php endforeach;?>
		<?php endif;?>
		<?php if(is_array($carts) && count($carts) > 0 && $cartcount > 0):?>
		<div class="row">
		<div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
				
			    <?php $totalprice = $totalpriceProduct;?>
				<div class="alert alert-dark" role="alert">
				   <?php VLang::__e('CART_SHOPPING_CART_PRODUCT');?> <?php echo get_activities_session()['symbol'].' '.(round($totalpriceProduct*$Currency->__getExchange(get_activities_session()['currency']), 2));?>
				</div>
				<div class="alert alert-dark" role="alert">
				   <?php VLang::__e('CART_SHOPPING_CART_TOTAL');?> <?php echo get_activities_session()['symbol'].' '.(round($totalprice*$Currency->__getExchange(get_activities_session()['currency']), 2));?>
				   <script type="text/javascript">
				   AMStripe.options.stripe_amount = <?php echo ($totalprice*$Currency->__getExchange(get_activities_session()['currency']));?>;
				   </script>
				</div>
			</div>
		  </div>
		</div>
        

        <div class="card">
          <div class="card-body">
            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-block btn-lg bg-dark" <?php if ($UserModel->isLogin()){echo 'id="process-pay"';}else{echo 'id="process-pay-notlogon"';}?> <?php if ($cart_error  && $UserModel->isLogin()){echo 'data-bs-toggle="modal" data-bs-target="#exampleModal"';}?> onClick="<?php if (session()->get('area') != 'front-end' && session()->get('area') != 'back-end'){echo "window.location.href='".v_base_url('user/login')."'";}?>"><?php VLang::__e('CART_SHOPPING_CART_PROCEEDTOPAY');?></button>
          </div>
        </div>
		<?php endif;?>
      </div>
    </div>
  </div>
</section>

<div id="ajax-process-pay">
	<div id="ajax-loader"></div>
</div>

<script type="text/javascript">
var deleteItemCart = '<?php echo v_base_url('cart/deleteItemCart?key=');?>';
var currency = '<?php echo get_activities_session()['currency'];?>';
var thankyou = '<?php echo v_base_url('cart/thankyou');?>';
var fail = '<?php echo v_base_url('cart/fail');?>';
var email = '<?php echo session()->get('email');?>';
var fail_message = '<?php echo VLang::__('PAYMENT_FAIL_MESSAGE');?>';
</script>
<script src="<?php echo v_base_url('public/front-end/js/cart.js?time='.time());?>"></script>