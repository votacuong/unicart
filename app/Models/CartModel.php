<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Vlang;
use stdClass as stdClass;

class CartModel extends BaseModel
{
	protected $table = 'cart';
	
	protected $primaryKey = 'id';
	
	public function countCart()
	{
		helper(['form', 'Common']);
		
		$CartModel = new CartModel();
		
		$cart = $this->selectCart();
		
		$count = 0;
		
		if (is_array($cart) && isset($cart[0]['id']))
		{
			
			$cartdetails = (array)json_decode($cart[0]['cart']);
			
			foreach($cartdetails as $p)
			{
				
				$p = (array) $p;
				
				$count += (int) $p['quanlity'];
				
			}			
			
		}
		
		return $count;
		
	}
	
	public function selectCart()
	{
		
		$this->builder->where("cart_id = '".get_your_session_id()."'");
		
		return $this->builder->get()->getResultArray();
		
	}
	
}