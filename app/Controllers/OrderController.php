<?php 
namespace App\Controllers;  


use App\Models\UserModel;
use App\Models\AdminUserModel;
use App\Models\CartModel;
use App\Models\AdminOrderModel;
use App\Models\AdminItemModel;
use App\Models\AdminPaymentModel;
use App\Models\AdminProductModel;
use App\Models\StripeModel;
use App\Models\PaymenthistoryModel;
use App\Libraries\VLang;
  
class OrderController extends BaseController
{
	
	public function orderdetails($id)
	{
		
		$UserModel = new UserModel(); 
		
		if ( !$UserModel->isLogin( ) )
		{
			v_redirect('user/login?return_url='.base64_encode(getUrl()));
		}
		
		helper(['form', 'Common']);
		
		$AdminOrderModel = new AdminOrderModel();
		
		$data = [
			
			'subview' => 'order/orderdetais.php',
			
			'details' => $AdminOrderModel->getDetails($id),
			
			'id' => $id,
			
			'title'=>'Orders Details'
			
		];
		
        echo view('front-end/main', $data);
		
	}
	
}