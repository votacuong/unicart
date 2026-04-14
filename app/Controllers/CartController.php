<?php 
namespace App\Controllers;  


use App\Models\UserModel;
use App\Models\AdminUserModel;
use App\Models\CartModel;
use App\Models\AdminProductModel;
use App\Models\AdminOrderModel;
use App\Models\AdminPaymentModel;
use App\Libraries\VLang;
  
class CartController extends BaseController
{
	
	public function index()
    {
		
        helper(['form', 'Common']);
		
        $data = [
		
		    'subview'=>'cart/index.php',
			
			'title'=>'Cart'
			
		];
		
        echo view('front-end/main', $data);
    }
	
	public function recipient($id)
    {
		
        helper(['form', 'Common']);
		
        $data = [
		
		    'subview'=>'recipient/index.php',
			
			'title'=>'Recipient',
			
			'id'=>$id
			
		];
		
        echo view('front-end/main', $data);
    }
	public function thankyou()
	{
		helper(['form', 'Common']);
		
        $data = [
		
		    'subview'=>'cart/thankyou.php',
			
			'title'=>'Thank you'
			
		];
		
        echo view('front-end/main', $data);
	}
	public function fail()
	{
		helper(['form', 'Common']);
		
        $data = [
		
		    'subview'=>'cart/fail.php',
			
			'title'=>'Payment fail'
			
		];
		
        echo view('front-end/main', $data);
	}
	public function deleteItemCart()
	{
		helper(['form', 'Common']);
		
		$CartModel = new CartModel();
		
		$cart = $CartModel->select(['cart_id'=>get_your_session_id()]);
		
		if (is_array($cart) && isset($cart[0]['id']))
		{
			
			$cartdetails = (array)json_decode($cart[0]['cart']);
			
			unset($cartdetails[$this->request->getVar('key')]);
			
			$CartModel->updateField( $cart[0]['id'], 'cart', raw_json_encode($cartdetails) );
			
		}
		
		die();
	}
	public function maintain()
	{
		$CartModel = new CartModel();
		
		$cartdetails = $CartModel->select(['cart_id'=>get_your_session_id()]);
		
		if (count($cartdetails) > 1)
		{
			
			$CartModel->deleteItemWhere(['cart_id'=>get_your_session_id()]);
			
		}
		
		die();
	}
	public function complete_payment()
	{
		
		$appconfig = new \Config\AppConfig();
		
		$Currency = new \App\Libraries\Currency();

		$CartModel = new CartModel();
		
		$AdminProductModel = new AdminProductModel();
		
		$AdminOrderModel = new AdminOrderModel();
		
		$UserModel = new UserModel();
		
		$AdminPaymentModel = new AdminPaymentModel();
		
		$AdminUserModel = new AdminUserModel();
		
		$Currency = new \App\Libraries\Currency();

		$cartdetails = $CartModel->select(['cart_id'=>get_your_session_id()]);
		
		if (is_array($cartdetails) && isset($cartdetails[0]['id']))
		{
			
			$carts = (array)json_decode($cartdetails[0]['cart']);
			
		}
		else
		{
			
			$carts = [];
			
		}
		
		$totalprice = 0;
		
		if (is_array($carts) && count($carts) == 0){
			
		}
		elseif(is_array($carts) && count($carts) > 0)
		{
			
			foreach($carts as $key => $cart)
			{
				
				$key = explode('_', $key)[0];
				
				$productd = $AdminProductModel->get($key);
				
				$price = $cart->quanlity*$productd['price']; 
				
				$totalprice += $price;
				
			}
			
		}
		
		$totalpriceProduct = $totalprice;
		
		$Stripe = new \App\Libraries\Stripe();
		
		$messages = [];
		
		if ( $Stripe->charge_subscription($totalprice*$Currency->__getExchange(get_activities_session()['currency']), $this->request->getVar('stripe_token')))
		{
			
			$order_id = $AdminOrderModel->store([
			
				'id'=>0,
				
				'customer_id'=>session()->get('id'),
				
				'cart'=>$cartdetails[0]['cart'],
				
				'time_add'=>date("Y-m-d")
				
			]);
			
			$AdminPaymentModel->store([
			
				'id'=>0,
				
				'order_id'=>$order_id,
				
				'customer_id'=>session()->get('id'),
				
				'total'=>$totalprice,
				
				'time_add'=>date("Y-m-d"),
				
				'status'=>'completed'
				
			]);
			
			$CartModel->updateField( $cartdetails[0]['id'], 'cart', '' );
			
			$CartModel->deleteItemWhere( ['cart_id'=>get_your_session_id()] );
			
			$Mailer = new \App\Libraries\Mailer();
						
			$data = [];

			$data['username'] = session()->get('name');
			
			$data['order_id'] = $order_id;
			
			$data['order-value'] = get_activities_session()['symbol'].' '.round($totalprice*$Currency->__getExchange(get_activities_session()['currency']), 1);
			
			$data['receiver'] = session()->get('email');
			
			ob_start();
			
			include(FCPATH . '../app/Views/front-end/mails/order-details.php');
			
			$message = ob_get_clean();

			$Mailer->sendMail(session()->get('email'), 'Order Details', $message );
			
			die('Order-Success');
			
		}
		
		die('Error');
		
	}
	
	public function countTotal()
	{
		
		helper(['form', 'Common']);
		
		$CartModel = new CartModel();
		
		$cart = $CartModel->select(['cart_id'=>get_your_session_id()]);
		
		$count = 0;
		
		if (is_array($cart) && isset($cart[0]['id']))
		{
			
			$cartdetails = (array)json_decode($cart[0]['cart']);
			
			foreach($cartdetails as $key => $p)
			{
				
				$p = (array) $p;
				
				$count += (int) $p['quanlity'];
				
			}
			
		}
		
		return $count;
	}
	
	public function countCart()
	{
		
		
		echo $this->countTotal();
		
		die();
	}
	
	public function saveCart()
	{
		helper(['form', 'Common']);
		
		$AppConfig = new \Config\AppConfig();
		
		$CartModel = new CartModel();
		
		$product = new \App\Models\AdminProductModel();
		
		$productd = $product->get($this->request->getVar('product_id'));
		
		$cart = $CartModel->select(['cart_id'=>get_your_session_id()]);
		
		if (is_array($cart) && isset($cart[0]['id']))
		{
			
			$cartdetails = (array)json_decode($cart[0]['cart']);
			
			if (isset($cartdetails[$this->request->getVar('product_id')]))
			{
				
				$product = (array) $cartdetails[$this->request->getVar('product_id')];
				
			}
			else
			{
				
				$product = [
				
					'quanlity'=>$this->request->getVar('quanlity')
					
				];
				
			}
		
			$product['quanlity'] = $this->request->getVar('quanlity');
			
			$cartdetails[$this->request->getVar('product_id')] = $product;
			
			$CartModel->updateField( $cart[0]['id'], 'cart', raw_json_encode($cartdetails) );
			
		}
		else
		{
			
			$cartdetails[$this->request->getVar('product_id')] = [
			
				'quanlity'=>$this->request->getVar('quanlity')
				
			];
			
			$CartModel->store([
			
				'id'=>0,
				
				'user_id'=>session()->get('id'),
				
				'cart_id'=>get_your_session_id(),
				
				'cart'=>raw_json_encode($cartdetails)
				
			]);
			
		}
		
		echo $this->countCart();
		
		die();
	}
	
	public function addToCart()
	{
		helper(['form', 'Common']);
		
		$AppConfig = new \Config\AppConfig();
		
		$CartModel = new CartModel();
		
		$product = new \App\Models\AdminProductModel();
		
		$productd = $product->get($this->request->getVar('product_id'));
		
		$cart = $CartModel->select(['cart_id'=>get_your_session_id()]);
		
		if (is_array($cart) && isset($cart[0]['id']))
		{
			
			$cartdetails = (array)json_decode($cart[0]['cart']);
			
			if (isset($cartdetails[$this->request->getVar('product_id')]))
			{
				
				$product = (array) $cartdetails[$this->request->getVar('product_id')];
				
			}
			else
			{
				
				$product = [
				
					'quanlity'=>0
					
				];
				
			}
		
			$product['quanlity'] += 1;
			
			$cartdetails[$this->request->getVar('product_id')] = $product;
			
			$CartModel->updateField( $cart[0]['id'], 'cart', raw_json_encode($cartdetails) );
			
		}
		else
		{
			
			$cartdetails[$this->request->getVar('product_id')] = [
			
				'quanlity' => 1
				
			];
			
			$CartModel->store([
			
				'id'=>0,
				
				'user_id'=>session()->get('id'),
				
				'cart_id'=>get_your_session_id(),
				
				'cart'=>raw_json_encode($cartdetails)
				
			]);
			
		}
		
		echo $this->countCart();
		
		die();
	}
	
	function getDropdownCart()
	{
		$CartModel = new \App\Models\CartModel();
		
		$Currency = new \App\Libraries\Currency();
		
		$product = new \App\Models\AdminProductModel();
		
		$carts = $CartModel->selectCart();
		
		$AppConfig = new \Config\AppConfig();
		
		if (is_array($carts) && isset($carts[0]['id']))
		{
			
			$carts = (array)json_decode($carts[0]['cart']);
			
		}
		else
		{
			
			$carts = [];
			
		}
		
		if (is_array($carts) && count($carts) == 0){
			?>
			<div class="cart-dropdowncart-item-empty">
				<?php VLang::__e('CART_SHOPPING_CART_EMPTY');?>
			</div>
			<?php
			
		}elseif(is_array($carts) && count($carts) > 0){
			
			?>
			<script type="text/javascript">
			function cartDeleteItem(key, $this)
			{
				jQuery.get('<?php echo v_base_url('cart/deleteItemCart?key=');?>'+key, function(){
					jQuery($this).parents('.cart-dropdowncart-item').remove();
					
					jQuery.get('<?php echo v_base_url('cart/countCart');?>', function(data){
						jQuery('#cart-count').html(data);
					});
					
				});
			}
			</script>
			<div class="dropdowncart-form">
			<?php
			$AppConfig = new \Config\AppConfig();
			foreach($carts as $key => $cart){
				$key = explode('_', $key)[0];
				
				$totalprice = 0;
				
				$productd = (object)$product->get($key);
				?>
				<div class="cart-dropdowncart-item" id="cart-<?php echo $key;?>">
					  <div class="col-md-2 col-lg-2 col-xl-2 cart-img">
						<a class="cart-edit-link" href="<?php echo v_base_url('product/details/'.$key);?>">
						<?php 
						if ( is_file(FCPATH . '../public/images/product/'.$key.'.gif') ):?>
							<img class="card-img-top image-cart dropdowncart-img" src="<?php echo v_base_url('public/images/product/'.$key.'.gif?time='.date("Y-m-d"));?>" />
						<?php elseif ( is_file(FCPATH . '../public/images/product/'.$key.'.png') ):?>
							<img class="card-img-top image-cart dropdowncart-img" src="<?php echo v_base_url('public/images/product/'.$key.'.png?time='.date("Y-m-d H:i:s"));?>" />
						<?php elseif ( is_file(FCPATH . '../public/images/product/'.$key.'.jpg') ):?>
							<img class="card-img-top image-cart dropdowncart-img" src="<?php echo v_base_url('public/images/product/'.$key.'.jpg?time='.date("Y-m-d H:i:s"));?>" />
						<?php elseif ( is_file(FCPATH . '../public/images/product/'.session()->get('id').'.jpeg') ):?>
							<img class="card-img-top image-cart dropdowncart-img" src="<?php echo v_base_url('public/images/product/'.$key.'.jpeg?time='.date("Y-m-d H:i:s"));?>" />
						<?php else:?>
							<img class="card-img-top image-cart dropdowncart-img" src="<?php echo v_base_url('public/images/default.jpg');?>" />
						<?php endif;
						?></a>
					  </div>
					  <div class="col-md-4 col-lg-4 col-xl-4">
						<p class="lead fw-normal mb-2" style="font-size: 14px;">
						<a class="cart-edit-link" href="<?php echo v_base_url('product/details/'.$key);?>"><?php echo $productd->name;?></a>
						</p>
					  </div>
					  <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
						<label><?php echo $cart->quanlity;?></label>
					  </div>
					  <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
						<?php
						
						$custom_price = $productd->price*$cart->quanlity;
						
						?>
						<h5 class="mb-0"><?php echo get_activities_session()['symbol'];?> <?php echo (round($custom_price*$Currency->__getExchange(get_activities_session()['currency']), 2));?></h5>
						
					  </div>
					  <div class="col-md-1 col-lg-1 col-xl-1 text-end">
						<a href="javascript:cartDeleteItem('<?php echo $key;?>', this);" class="text-danger"><i class="bi bi-trash-fill"></i></a>
					  </div>
				</div>
			<?php
			}
			?>
			</div>
			<?php if ($this->countTotal() > 0):?>
			<a href="<?php echo v_base_url('cart');?>" class="checkout-cart"><?php VLang::__e('CART_SHOPPING_CART');?></a>
			<?php else:?>
			<div class="cart-dropdowncart-item-empty">
				<?php VLang::__e('CART_SHOPPING_CART_EMPTY');?>
			</div>
			<?php endif;?>
			<?php
		
		}
	}
	function deleteItem()
	{
		
		helper(['form', 'Common']);
		
		$CartModel = new CartModel();
		
		$cart = $CartModel->select(['cart_id'=>get_your_session_id()]);
		
		$cartdetails = (array)json_decode($cart[0]['cart']);
		
		$product = (array) $cartdetails[$this->request->getVar('cartkey')];
		
		$cartdetails[$this->request->getVar('cartkey')] = $product;
		
		$CartModel->updateField( $cart[0]['id'], 'cart', raw_json_encode($cartdetails) );
		
		die();
		
	}
}