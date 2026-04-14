<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Vlang;
use stdClass as stdClass;

class AdminOrderModel extends BaseModel
{
	protected $table = 'orders';
	
	protected $primaryKey = 'id';
	
	protected $allowedFields = [
	
		'customer_id', 
		
		'vendor_claim', 
		
		'qrcode', 
		
		'key', 
		
		'cart',
		
		'time_add'
		
	];

	protected $useTimestamps = false;

	public $validationRules = [
	
		'customer_id' => 'required'
		
	];
	
	public $validationRulesUpdate = [
	
		'customer_id' => 'required'
		
	];
	
	protected $validationMessages = [
	
		'customer_id' => [
		
		  'required' => 'customer_id field is required'
		  
		]
	];
	
	public function getDetails($id)
	{
		
		$this->builder->join('app_payment', 'app_payment.order_id = app_orders.id');
			
		$this->builder->where("app_orders.id = ".$id);
		
		return $this->builder->get()->getRow();
		
	}
	
	public function statisticData()
	{
		
		$this->builder->select("count(id) AS total, time_add");
		
		$this->builder->where('UNIX_TIMESTAMP(time_add) >= '. strtotime(date("Y-m-d")."-100 days").' GROUP BY time_add');
		
		$data = $this->builder->get()->getResultArray();
		
		foreach($data as $key => $row)
		{
			
			echo '{y:'.$row['total'].', x:new Date("'.$row['time_add'].'")},';
			
		}
		
	}
	
	public function getObject()
	{
		
		$order = new stdClass();
		
		$order->id = 0;
		
		$order->customer_id = 0;
		
		$order->vendor_claim = 0;
		
		$order->cart = '';
		
		$order->qrcode = '';
		
		$order->key = '';
		
		$order->time_add = '';
		
		return (array)$order;
		
	}
	
}