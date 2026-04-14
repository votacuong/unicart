<?php
$UserModel = new \App\Models\UserModel();

$userdetails = $UserModel->get(session()->get('id'));

$ProductModel = new \App\Models\AdminProductModel();

$CartModel = new \App\Models\CartModel();

$product_details = $ProductModel->get($this->data['id']);

$cart = $CartModel->selectCart();

$AppConfig = new \Config\AppConfig();

$cartkey = $this->data['id'];

if (is_array($cart) && isset($cart[0]['id']))
{
	
	$cartdetails = (array)json_decode($cart[0]['cart']);
	
}
else
{
	
	$quanlity = new stdClass();
	
	$quanlity->quanlity = 1;
	
	$cartdetails[$cartkey] = $quanlity;
	
	$CartModel->store([
	
		'id'=>0,
		
		'user_id'=>session()->get('id'),
		
		'cart_id'=>get_your_session_id(),
		
		'cart'=>raw_json_encode($cartdetails)
		
	]);
}

if (!isset($cartdetails[$cartkey]))
{
	
	$quanlity = new stdClass();
	
	$quanlity->quanlity = 1;
	
	$cartdetails[$cartkey] = $quanlity;
	
	$CartModel->updateField( $cart[0]['id'], 'cart', raw_json_encode($cartdetails) );
}
?>
<script src="<?php echo v_base_url('public/front-end/js/product.js');?>"></script>
<script type="text/javascript">
var countCart = '<?php echo v_base_url('cart/countCart');?>';
var saveCart = '<?php echo v_base_url('cart/saveCart?product_id='.$this->data['id'].'&quanlity=');?>';
var cartCheckout = '<?php echo v_base_url('cart');?>';
</script>
<div class="container thecup-container-recipient">
  <div class="row">
		<div class="col-8">
		<?php 
		if ( is_file(FCPATH . '../public/images/product/'.$this->data['id'].'.gif') ):?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$this->data['id'].'.gif?time='.date("Y-m-d"));?>" />
		<?php elseif ( is_file(FCPATH . '../public/images/product/'.$this->data['id'].'.png') ):?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$this->data['id'].'.png?time='.date("Y-m-d H:i:s"));?>" />
		<?php elseif ( is_file(FCPATH . '../public/images/product/'.$this->data['id'].'.jpg') ):?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$this->data['id'].'.jpg?time='.date("Y-m-d H:i:s"));?>" />
		<?php elseif ( is_file(FCPATH . '../public/images/product/'.session()->get('id').'.jpeg') ):?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$this->data['id'].'.jpeg?time='.date("Y-m-d H:i:s"));?>" />
		<?php else:?>
			<img class="card-img-top" src="<?php echo v_base_url('public/images/default.jpg');?>" />
		<?php endif;
		?>
		</div>
		<div class="col-4">
		<div class="row">
			<div class="tract-area tract-mobile">
				<div class="recipient-tract">
					<button type="button" class="subtrat"></button>
				</div>
				<div class="recipient-tract">
					<input type="text" class="quanlity" value="<?php echo (int) $cartdetails[$cartkey]->quanlity;?>"/>
				</div>
				<div class="recipient-tract">
					<button type="button" class="addtrat"></button>
				</div>
		  </div>
		</div>
		<div class="row product-description">
			<a class="btn btn-outline-dark mt-auto inforproduct-send add-to-cart-btn" href="javascript:void(0);" onClick="addToCart();"><?php VLang::__e('INFORMATION_PRODUCT_SEND');?></a>
		</div>
		<div class="row product-description">
			<?php echo $product_details['description'];?>
		</div>
		</div>
  </div>
</div>
