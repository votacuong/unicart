<?php 
namespace App\Controllers;  


use App\Models\UserModel;
use App\Models\AdminUserModel;
use App\Models\CartModel;
use App\Models\AdminProductModel;
use App\Models\AdminOrderModel;
use App\Models\AdminPaymentModel;
use App\Libraries\VLang;
  
class ProductController extends BaseController
{
	
	public function details($id)
    {
		
        helper(['form', 'Common']);
		
        $data = [
		
		    'subview'=>'product/index.php',
			
			'title'=>'Product',
			
			'id'=>$id
			
		];
		
        echo view('front-end/main', $data);
    }
}